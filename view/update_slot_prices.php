<?php
session_start();
require_once __DIR__ . '/../model/mydb.php';

if (!isset($_SESSION['seller_id'])) {
    die("Unauthorized access.");
}

$conn = getDBConnection();
$turf_id = $_SESSION['seller_id'];
$date = $_POST['date'];
$prices = $_POST['prices'];

foreach ($prices as $time_slot => $price) {
    // Check if booking exists for the slot and date
    $stmt = $conn->prepare("SELECT id FROM bookings WHERE turf_id = ? AND booking_date = ? AND time_slot = ?");
    $stmt->bind_param("iss", $turf_id, $date, $time_slot);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // Update price
        $stmt = $conn->prepare("UPDATE bookings SET price = ? WHERE turf_id = ? AND booking_date = ? AND time_slot = ?");
        $stmt->bind_param("diss", $price, $turf_id, $date, $time_slot);
        $stmt->execute();
    } else {
        $price_to_insert = ($price > 0) ? $price : 3000.00;
        $stmt = $conn->prepare("INSERT INTO bookings (turf_id, booking_date, time_slot, price, status) VALUES (?, ?, ?, ?, 'Available')");
        $stmt->bind_param("issd", $turf_id, $date, $time_slot, $price_to_insert);
        $stmt->execute();

    }
}

header("Location: owner_dashboard.php?date=" . urlencode($date));
exit();
