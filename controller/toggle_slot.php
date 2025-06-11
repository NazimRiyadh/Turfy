<?php
session_start();
require_once __DIR__ . '/../model/mydb.php';

if (!isset($_SESSION['seller_id']) || !isset($_GET['slot']) || !isset($_GET['date'])) {
    die("Invalid request");
}

$turf_id = $_SESSION['seller_id'];
$time_slot = $_GET['slot'];
$date = $_GET['date'];

$conn = getDBConnection();

// Check current status
$stmt = $conn->prepare("SELECT status FROM bookings WHERE turf_id = ? AND booking_date = ? AND time_slot = ?");
$stmt->bind_param("iss", $turf_id, $date, $time_slot);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $new_status = ($row['status'] === 'Booked') ? 'Available' : 'Booked';

    $update = $conn->prepare("UPDATE bookings SET status = ? WHERE turf_id = ? AND booking_date = ? AND time_slot = ?");
    $update->bind_param("siss", $new_status, $turf_id, $date, $time_slot);
    $update->execute();
} else {
    
    $default_price = 3000.00;  // default price
    $new_status = 'Booked';
    $insert = $conn->prepare("INSERT INTO bookings (turf_id, booking_date, time_slot, price, status) VALUES (?, ?, ?, ?, ?)");
    $insert->bind_param("issds", $turf_id, $date, $time_slot, $default_price, $new_status);
    $insert->execute();
}

header("Location: ../view/owner_dashboard.php?date=" . urlencode($date));
exit();
