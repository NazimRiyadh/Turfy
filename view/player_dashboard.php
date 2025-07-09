<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Dashboard - Turfy</title>
    <link rel="stylesheet" href="../css/owner_dashboard.css">
    <link rel="stylesheet" href="../css/player_dashboard.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <h1>Turfy</h1>
            </div>
            <div class="nav-actions">
                <a href="book_turf.php" class="nav-btn secondary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                    <span>Book Turf</span>
                </a>
                <a href="profile.php" class="nav-btn secondary">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    <span>Profile</span>
                </a>
                <a href="logout.php" class="nav-btn logout">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16,17 21,12 16,7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <!-- Welcome Section -->
            <section class="welcome-section">
                <div class="welcome-content">
                    <h2>Welcome back, <?= htmlspecialchars($player['full_name']) ?>!</h2>
                    <div class="player-info">
                        <span class="player-email"><?= htmlspecialchars($player['email']) ?></span>
                        <span class="player-joined">Member since <?= date('M Y', strtotime($player['created_at'])) ?></span>
                    </div>
                </div>
            </section>

            <!-- Summary Cards -->
            <section class="summary-section">
                <div class="summary-grid">
                    <div class="summary-card">
                        <div class="summary-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="summary-content">
                            <h3><?= $total_bookings ?></h3>
                            <p>Total Bookings</p>
                        </div>
                    </div>
                    
                    <div class="summary-card">
                        <div class="summary-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"/>
                                <polyline points="12,6 12,12 16,14"/>
                            </svg>
                        </div>
                        <div class="summary-content">
                            <h3><?= $upcoming_bookings_count ?></h3>
                            <p>Upcoming Bookings</p>
                        </div>
                    </div>
                    
                    <div class="summary-card">
                        <div class="summary-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="summary-content">
                            <h3><?= $monthly_bookings ?></h3>
                            <p>This Month</p>
                        </div>
                    </div>
                    
                    <div class="summary-card cta-card">
                        <div class="summary-content">
                            <h3>Ready to Play?</h3>
                            <p>Find and book your next turf</p>
                            <a href="book_turf.php" class="btn primary">Book New Turf</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Upcoming Bookings Section -->
            <section class="bookings-section">
                <div class="card">
                    <div class="card-header">
                        <h3>Upcoming Bookings</h3>
                        <p class="card-subtitle">Your scheduled turf sessions</p>
                    </div>
                    <div class="bookings-content">
                        <?php if (empty($upcoming_bookings)): ?>
                            <div class="empty-state">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <path d="M8 12h8"/>
                                </svg>
                                <h4>No upcoming bookings</h4>
                                <p>Book a turf to get started!</p>
                                <a href="book_turf.php" class="btn primary">Book Now</a>
                            </div>
                        <?php else: ?>
                            <div class="bookings-table-wrapper">
                                <table class="bookings-table">
                                    <thead>
                                        <tr>
                                            <th>Turf Name</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($upcoming_bookings as $booking): ?>
                                            <tr>
                                                <td>
                                                    <div class="turf-cell">
                                                        <strong><?= htmlspecialchars($booking['turf_name']) ?></strong>
                                                        <span class="turf-location"><?= htmlspecialchars($booking['turf_address']) ?></span>
                                                    </div>
                                                </td>
                                                <td><?= date('M j, Y', strtotime($booking['booking_date'])) ?></td>
                                                <td><?= htmlspecialchars($booking['time_slot']) ?></td>
                                                <td class="price-cell">₹<?= number_format($booking['price'], 2) ?></td>
                                                <td>
                                                    <span class="status-badge <?= strtolower($booking['status']) ?>">
                                                        <span class="status-indicator"></span>
                                                        <?= ucfirst($booking['status']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="booking_details.php?id=<?= $booking['id'] ?>" class="action-btn view">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                                                <circle cx="12" cy="12" r="3"/>
                                                            </svg>
                                                        </a>
                                                        <?php if ($booking['status'] === 'confirmed'): ?>
                                                            <a href="cancel_booking.php?id=<?= $booking['id'] ?>" class="action-btn cancel" onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                    <line x1="18" y1="6" x2="6" y2="18"/>
                                                                    <line x1="6" y1="6" x2="18" y2="18"/>
                                                                </svg>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <!-- Booking History Section -->
            <section class="history-section">
                <div class="card">
                    <div class="card-header">
                        <h3>Booking History</h3>
                        <p class="card-subtitle">Your past turf bookings</p>
                    </div>
                    <div class="bookings-content">
                        <?php if (empty($booking_history)): ?>
                            <div class="empty-state">
                                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M12 2L2 7l10 5 10-5-10-5z"/>
                                    <path d="M2 17l10 5 10-5"/>
                                    <path d="M2 12l10 5 10-5"/>
                                </svg>
                                <h4>No booking history</h4>
                                <p>Your completed bookings will appear here</p>
                            </div>
                        <?php else: ?>
                            <div class="bookings-table-wrapper">
                                <table class="bookings-table">
                                    <thead>
                                        <tr>
                                            <th>Turf Name</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($booking_history as $booking): ?>
                                            <tr>
                                                <td>
                                                    <div class="turf-cell">
                                                        <strong><?= htmlspecialchars($booking['turf_name']) ?></strong>
                                                        <span class="turf-location"><?= htmlspecialchars($booking['turf_address']) ?></span>
                                                    </div>
                                                </td>
                                                <td><?= date('M j, Y', strtotime($booking['booking_date'])) ?></td>
                                                <td><?= htmlspecialchars($booking['time_slot']) ?></td>
                                                <td class="price-cell">₹<?= number_format($booking['price'], 2) ?></td>
                                                <td>
                                                    <span class="status-badge <?= strtolower($booking['status']) ?>">
                                                        <span class="status-indicator"></span>
                                                        <?= ucfirst($booking['status']) ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href="booking_details.php?id=<?= $booking['id'] ?>" class="action-btn view">
                                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                                                <circle cx="12" cy="12" r="3"/>
                                                            </svg>
                                                        </a>
                                                        <?php if ($booking['status'] === 'completed'): ?>
                                                            <a href="book_again.php?turf_id=<?= $booking['turf_id'] ?>" class="action-btn book-again">
                                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                                    <path d="M1 4v6h6"/>
                                                                    <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"/>
                                                                </svg>
                                                            </a>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>

            <!-- Profile Overview Section -->
            <section class="profile-section">
                <div class="card">
                    <div class="card-header">
                        <h3>Profile Overview</h3>
                        <p class="card-subtitle">Your account information</p>
                    </div>
                    <div class="profile-content">
                        <div class="profile-grid">
                            <div class="profile-field">
                                <label class="profile-label">Full Name</label>
                                <input type="text" class="profile-input" value="<?= htmlspecialchars($player['full_name']) ?>" readonly>
                            </div>
                            <div class="profile-field">
                                <label class="profile-label">Email Address</label>
                                <input type="email" class="profile-input" value="<?= htmlspecialchars($player['email']) ?>" readonly>
                            </div>
                            <div class="profile-field">
                                <label class="profile-label">Phone Number</label>
                                <input type="tel" class="profile-input" value="<?= htmlspecialchars($player['phone']) ?>" readonly>
                            </div>
                            <div class="profile-field">
                                <label class="profile-label">Member Since</label>
                                <input type="text" class="profile-input" value="<?= date('F j, Y', strtotime($player['created_at'])) ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <a href="edit_profile.php" class="btn primary">Edit Profile</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <p>&copy; 2025 Turfy. All rights reserved.</p>
                <div class="footer-links">
                    <a href="privacy.php">Privacy Policy</a>
                    <a href="terms.php">Terms of Service</a>
                    <a href="support.php">Support</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>