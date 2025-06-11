<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "../controller/control_seller_profile.php";

if (!isset($_SESSION['seller_id'])) {
    header("Location: ../view/customer_login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Seller Profile</title>
    <link rel="stylesheet" href="../css/customer_profile.css" />
</head>
<body>
    <h1>Welcome, <?php echo ($seller['username']); ?>!</h1>
    <h2>Your Profile Information:</h2>
    <table>
        <tr><th>Field</th><th>Details</th></tr>
        <tr><td>Turf Name</td><td><?php echo ($seller['turf_name']); ?></td></tr>
        <tr><td>Phone</td><td><?php echo ($seller['phone']); ?></td></tr>
        <tr><td>Email</td><td><?php echo ($seller['email']); ?></td></tr>
        <tr><td>Address</td><td><?php echo ($seller['address']); ?></td></tr>
        <tr><td>Sports</td><td><?php echo ($seller['sports']); ?></td></tr>
        <tr><td>Other Sport</td><td><?php echo ($seller['other_sport']); ?></td></tr>
        <tr><td>Owner Name</td><td><?php echo ($seller['owner_name']); ?></td></tr>
        <tr><td>Owner Phone</td><td><?php echo ($seller['owner_phone']); ?></td></tr>
        <tr><td>Owner Email</td><td><?php echo ($seller['owner_email']); ?></td></tr>
        <tr><td>Owner NID</td><td><?php echo ($seller['owner_nid']); ?></td></tr>
        <tr><td>Created At</td><td><?php echo ($seller['created_at']); ?></td></tr>
    </table>
    <form action="../controller/control_delete.php" method="POST">
        <button type="submit" class="delete-btn">Delete Account</button>
    </form>

    <a href="edit_profile.php" class="logout-btn">Update Profile</a>
    <a href="../controller/control_customer_logout.php" class="logout-btn">Logout</a>
    <a href="owner_dashboard.php" class="logout-btn">Back to Dashboard</a>
</body>
</html>
