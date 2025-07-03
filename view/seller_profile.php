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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Profile</title>
    <link rel="stylesheet" href="../css/customer_profile.css" />
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($seller['username']); ?>!</h1>
    <h2>Your Profile Information:</h2>
    
    <table>
        <tr><th>Field</th><th>Details</th></tr>
        <tr><td>Turf Name</td><td><?php echo htmlspecialchars($seller['turf_name']); ?></td></tr>
        <tr><td>Phone</td><td><?php echo htmlspecialchars($seller['phone']); ?></td></tr>
        <tr><td>Email</td><td><?php echo htmlspecialchars($seller['email']); ?></td></tr>
        <tr><td>Address</td><td><?php echo htmlspecialchars($seller['address']); ?></td></tr>
        <tr><td>Sports</td><td><?php echo htmlspecialchars($seller['sports']); ?></td></tr>
        <tr><td>Other Sport</td><td><?php echo htmlspecialchars($seller['other_sport']); ?></td></tr>
        <tr><td>Owner Name</td><td><?php echo htmlspecialchars($seller['owner_name']); ?></td></tr>
        <tr><td>Owner Phone</td><td><?php echo htmlspecialchars($seller['owner_phone']); ?></td></tr>
        <tr><td>Owner Email</td><td><?php echo htmlspecialchars($seller['owner_email']); ?></td></tr>
        <tr><td>Owner NID</td><td><?php echo htmlspecialchars($seller['owner_nid']); ?></td></tr>
        <tr><td>Created At</td><td><?php echo htmlspecialchars($seller['created_at']); ?></td></tr>
    </table>

    <div class="actions">
        <a href="edit_profile.php" class="btn primary">Update Profile</a>
        <a href="owner_dashboard.php" class="btn secondary">Back to Dashboard</a>
        <a href="../controller/control_customer_logout.php" class="btn logout">Logout</a>
        <form action="../controller/control_delete.php" method="POST" style="display: inline;">
        <button type="submit" class="btn delete" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">Delete Account</button>
        </form>
    </div>
</body>
</html>