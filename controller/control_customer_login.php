<?php
session_start();
include_once '../model/mydb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $conn = getDBConnection();
    $seller = getTurfByUsername($conn, $username);

    if ($seller !== null && $password === $seller['password']) {
        $_SESSION['seller_id'] = $seller['id'];
        $_SESSION['seller_username'] = $seller['username'];
        header("Location: ../view/owner_dashboard.php");
        exit();
    }

    header("Location: ../view/customer_login.php");
    exit();
} else {
    header("Location: ../view/customer_login.php");
    exit();
}
