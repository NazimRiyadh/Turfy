<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "../model/mydb.php";

if (!isset($_SESSION['seller_id'])) {
    header("Location: ../view/customer_login.php");
    exit();
}

$conn = getDBConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seller_id = $_SESSION['seller_id'];


    $data = [
        'turf_name'   => htmlspecialchars($_POST['turf_name']),
        'phone'       => htmlspecialchars($_POST['phone']),
        'email'       => htmlspecialchars($_POST['email']),
        'address'     => htmlspecialchars($_POST['address']),
        'sports'      => htmlspecialchars($_POST['sports']),
        'other_sport' => htmlspecialchars($_POST['other_sport']),
        'owner_name'  => htmlspecialchars($_POST['owner_name']),
        'owner_phone' => htmlspecialchars($_POST['owner_phone']),
        'owner_email' => htmlspecialchars($_POST['owner_email']),
        'owner_nid'   => htmlspecialchars($_POST['owner_nid'])
    ];

    if (updateTurfProfile($conn, $seller_id, $data)) {
        header("Location: ../view/seller_profile.php");
        exit();
    } else {
        header("Location: ../view/edit_profile.php?error=1");
        exit();
    }
}
?>
