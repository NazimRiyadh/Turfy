<?php
session_start();
require_once __DIR__ . '/../model/mydb.php';

if (!isset($_SESSION['seller_id']) || !isset($_SESSION['seller_username'])) {
    header("Location: ../view/customer_login.php");
    exit();
}

$conn = getDBConnection();

$today = date('Y-m-d');
if (isset($_GET['date'])) {
    $today = $_GET['date'];
}

$username = $_SESSION['seller_username'];
$turf = getTurfByUsername($conn, $username);

if ($turf) {
    $turf_id = $turf['id'];
    $slots = getSlotsForTurf($conn, $turf_id, $today);
} else {
    echo "Turf not found.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Owner Dashboard</title>
    <link rel="stylesheet" href="../css/owner_dashboard.css">
</head>
<body>
    <div class="top-right-buttons">
        <a href="seller_profile.php" class="action-btn">👤 View Profile</a>
        <a href="../controller/control_customer_logout.php" class="action-btn logout">🚪 Log Out</a>
    </div>


<h2>Welcome, <?= htmlspecialchars($turf['owner_name']) ?>!</h2>
<h3>Your Turf: <?= htmlspecialchars($turf['turf_name']) ?> (<?= htmlspecialchars($turf['address']) ?>)</h3>

<form method="get" class="date-form">
    <tr>
    <td><label>Select Date:</label></td>
    <td><input type="date" name="date" value="<?= htmlspecialchars($today) ?>"></td>
    <td><button type="submit">View</button></td>
    </tr>
    </table>
</form>


<form method="post" action="update_slot_prices.php">
    <input type="hidden" name="date" value="<?= htmlspecialchars($today) ?>">
    <table>
        <tr>
            <th>Attribute</th>
            <?php foreach ($slots as $slot): ?>
                <th><?= htmlspecialchars($slot['time_slot']) ?></th>
            <?php endforeach; ?>
        </tr>

        <!-- Status Row -->
        <tr>
            <td>Status</td>
            <?php foreach ($slots as $slot): ?>
                <td>
                    <?php if ($slot['status'] === 'Booked'): ?>
                        <a href="../controller/toggle_slot.php?date=<?= urlencode($today) ?>&slot=<?= urlencode($slot['time_slot']) ?>" style="color: red;">
                            ❌ Booked (Click to Free)
                        </a>
                    <?php else: ?>
                        <a href="../controller/toggle_slot.php?date=<?= urlencode($today) ?>&slot=<?= urlencode($slot['time_slot']) ?>" style="color: green;">
                            ✅ Available (Click to Book)
                        </a>
                    <?php endif; ?>
                </td>
            <?php endforeach; ?>
        </tr>

        <!-- Current Price Row -->
        <tr>
            <td>Current Price (Tk)</td>
            <?php foreach ($slots as $slot): ?>
                <td><?= number_format($slot['price'], 2) ?></td>
            <?php endforeach; ?>
        </tr>

        <!-- Update Price Row -->
        <tr>
            <td>Update Price</td>
            <?php foreach ($slots as $slot): ?>
                <td>
                    <input type="number" name="prices[<?= htmlspecialchars($slot['time_slot']) ?>]" 
                           value="<?= number_format($slot['price'], 2) ?>" step="100" min="0">
                </td>
            <?php endforeach; ?>
        </tr>
    </table>

    <div class="button-container">
    <button type="submit" class="submit-btn">Save Prices</button>
</div>

</form>

</body>
</html>
