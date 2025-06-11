<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "../model/mydb.php";

if (!isset($_SESSION['seller_id'])) {
    header("Location: ../view/customer_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['seller_id'])) {
    $seller_id = intval($_SESSION['seller_id']);
    $conn = getDBConnection();

    if (deleteTurfById($conn, $seller_id)) {
        session_destroy();
        header("Location: ../view/customer_login.php");
        exit();
    } else {
        echo "Failed to delete account.";
    }

    $conn->close();
} else {
    echo "Invalid request.";
}
?>