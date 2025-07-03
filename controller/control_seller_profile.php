<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "../model/mydb.php";

if (!isset($_SESSION['seller_id'])) {
    header("Location: ../view/customer_login.php");
    exit();
}

$seller_id = (int)$_SESSION['seller_id'];

$conn = getDBConnection();

$seller = getTurfById($conn, $seller_id);

if ($seller === null) {
    header("Location: ../controller/control_customer_logout.php");
    exit();
}

$conn->close();
?>
