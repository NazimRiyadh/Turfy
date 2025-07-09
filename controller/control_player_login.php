<?php
session_start();
require_once '../model/mydb.php'; // DB connection file

$errors = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../view/player_login.php");
    exit();
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '') {
    $errors[] = "Username is required.";
}
if ($password === '') {
    $errors[] = "Password is required.";
}

if (!empty($errors)) {
    header("Location: ../view/player_login.php?error=1");
    exit();
}

// Connect to DB
$conn = getDBConnection();

// Prepare and execute query
$stmt = $conn->prepare("SELECT * FROM players WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows === 1) {
    $player = $result->fetch_assoc();

    // Compare plain-text passwords directly (not secure)
    if ($password === $player['password']) {
        // Save session data
        $_SESSION['player_id'] = $player['id'];
        $_SESSION['player_username'] = $player['username'];
        $_SESSION['player_name'] = $player['full_name'];

        header("Location: control_player_dashboard.php");
        exit();
    } else {
        // Wrong password
        header("Location: ../view/player_login.php?error=1");
        exit();
    }
} else {
    // Username not found
    header("Location: ../view/player_login.php?error=1");
    exit();
}
