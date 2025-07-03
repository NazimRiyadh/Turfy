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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?= htmlspecialchars($turf['turf_name']) ?></title>
    <link rel="stylesheet" href="../css/owner_dashboard.css">
</head>
<body>
    <!-- Navigation Header -->
    <header class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <h1>TurfManager</h1>
            </div>
            <nav class="nav-actions">
                <a href="seller_profile.php" class="nav-btn secondary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Profile
                </a>
                <a href="../controller/control_customer_logout.php" class="nav-btn logout">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16,17 21,12 16,7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Sign Out
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Welcome Section -->
            <section class="welcome-section">
                <div class="welcome-content">
                    <h2>Welcome back, <?= htmlspecialchars($turf['owner_name']) ?></h2>
                    <p class="turf-info">
                        <span class="turf-name"><?= htmlspecialchars($turf['turf_name']) ?></span>
                        <span class="turf-address"><?= htmlspecialchars($turf['address']) ?></span>
                    </p>
                </div>
            </section>

            <!-- Date Selection -->
            <section class="date-section">
                <div class="card">
                    <form method="get" class="date-form">
                        <label for="date" class="form-label">Select Date</label>
                        <div class="date-input-group">
                            <input type="date" id="date" name="date" value="<?= htmlspecialchars($today) ?>" class="date-input">
                            <button type="submit" class="btn primary">View Slots</button>
                        </div>
                    </form>
                </div>
            </section>

            <!-- Slots Management -->
            <section class="slots-section">
                <div class="card">
                    <div class="card-header">
                        <h3>Slot Management</h3>
                        <p class="card-subtitle">Manage availability and pricing for <?= date('M d, Y', strtotime($today)) ?></p>
                    </div>
                    
                    <form method="post" action="update_slot_prices.php">
                        <input type="hidden" name="date" value="<?= htmlspecialchars($today) ?>">
                        
                        <div class="slots-grid">
                            <?php foreach ($slots as $slot): ?>
                                <div class="slot-card">
                                    <div class="slot-header">
                                        <h4 class="slot-time"><?= htmlspecialchars($slot['time_slot']) ?></h4>
                                        <div class="slot-status">
                                            <?php if ($slot['status'] === 'Booked'): ?>
                                                <a href="../controller/toggle_slot.php?date=<?= urlencode($today) ?>&slot=<?= urlencode($slot['time_slot']) ?>" 
                                                   class="status-badge booked">
                                                    <span class="status-indicator"></span>
                                                    Booked
                                                </a>
                                            <?php else: ?>
                                                <a href="../controller/toggle_slot.php?date=<?= urlencode($today) ?>&slot=<?= urlencode($slot['time_slot']) ?>" 
                                                   class="status-badge available">
                                                    <span class="status-indicator"></span>
                                                    Available
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    
                                    <div class="slot-body">
                                        <div class="current-price">
                                            <span class="price-label">Current Price</span>
                                            <span class="price-value">৳<?= number_format($slot['price'], 0) ?></span>
                                        </div>
                                        
                                        <div class="price-input-group">
                                            <label for="price_<?= htmlspecialchars($slot['time_slot']) ?>" class="price-input-label">
                                                Update Price
                                            </label>
                                            <div class="price-input-wrapper">
                                                <span class="currency-symbol">৳</span>
                                                <input type="number" 
                                                       id="price_<?= htmlspecialchars($slot['time_slot']) ?>"
                                                       name="prices[<?= htmlspecialchars($slot['time_slot']) ?>]" 
                                                       value="<?= number_format($slot['price'], 0) ?>" 
                                                       step="100" 
                                                       min="0"
                                                       class="price-input">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn primary large">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                    <polyline points="17,21 17,13 7,13 7,21"></polyline>
                                    <polyline points="7,3 7,8 15,8"></polyline>
                                </svg>
                                Save All Prices
                            </button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </main>
</body>
</html>