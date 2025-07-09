<?php
session_start();
require_once '../model/mydb.php';

if (!isset($_SESSION['player_id'])) {
    header("Location: player_login.php");
    exit;
}

$player_id = $_SESSION['player_id'];
$conn = getDBConnection();

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get player profile
$stmt = $conn->prepare("SELECT * FROM players WHERE id = ?");
if (!$stmt) {
    die("Prepare failed (player profile): (" . $conn->errno . ") " . $conn->error);
}
$stmt->bind_param("i", $player_id);
$stmt->execute();
$result = $stmt->get_result();
$player = $result->fetch_assoc();
$stmt->close();

// Total bookings
$stmt = $conn->prepare("SELECT COUNT(*) FROM bookings WHERE player_id = ?");
if (!$stmt) {
    die("Prepare failed (total bookings): (" . $conn->errno . ") " . $conn->error);
}
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($total_bookings);
$stmt->fetch();
$stmt->close();

// Upcoming bookings
$stmt = $conn->prepare("
    SELECT b.*, t.turf_name, t.address AS turf_address
    FROM bookings b
    JOIN turfs t ON b.turf_id = t.id
    WHERE b.player_id = ? AND b.booking_date >= CURDATE()
    ORDER BY b.booking_date ASC
");
if (!$stmt) {
    die("Prepare failed (upcoming bookings): (" . $conn->errno . ") " . $conn->error);
}
$stmt->bind_param("i", $player_id);
$stmt->execute();
$upcoming_bookings = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$upcoming_bookings_count = count($upcoming_bookings);
$stmt->close();

// Booking history
$stmt = $conn->prepare("
    SELECT b.*, t.turf_name, t.address AS turf_address
    FROM bookings b
    JOIN turfs t ON b.turf_id = t.id
    WHERE b.player_id = ? AND b.booking_date < CURDATE()
    ORDER BY b.booking_date DESC
");
if (!$stmt) {
    die("Prepare failed (booking history): (" . $conn->errno . ") " . $conn->error);
}
$stmt->bind_param("i", $player_id);
$stmt->execute();
$booking_history = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Monthly bookings
$stmt = $conn->prepare("
    SELECT COUNT(*) FROM bookings
    WHERE player_id = ? AND MONTH(booking_date) = MONTH(CURDATE()) AND YEAR(booking_date) = YEAR(CURDATE())
");
if (!$stmt) {
    die("Prepare failed (monthly bookings): (" . $conn->errno . ") " . $conn->error);
}
$stmt->bind_param("i", $player_id);
$stmt->execute();
$stmt->bind_result($monthly_bookings);
$stmt->fetch();
$stmt->close();

// Include view
include '../view/player_dashboard.php';
?>
