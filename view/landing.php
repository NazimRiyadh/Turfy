
<?php
// Handle form submission
$message = '';
if ($_POST['email']) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Here you would typically save to database or send email
        // For now, we'll just show a success message
        $message = 'Thank you for joining our waitlist! We\'ll be in touch soon.';
    } else {
        $message = 'Please enter a valid email address.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turfy - The Ultimate Turf Booking Solution</title>
    <link rel="stylesheet" href="../css/landing.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <i class="fas fa-futbol"></i>
                <span>Turfy</span>
            </div>
            <div class="nav-menu">
                <a href="#features" class="nav-link">Features</a>
                <a href="#user-types" class="nav-link">Get Started</a>
                <a href="#about" class="nav-link">About</a>
                <a href="#contact" class="nav-link">Contact</a>
            </div>
            <div class="hamburger" onclick="toggleMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title">
                    THE SOLUTION TO<br>
                    YOUR <span class="highlight">TURF BOOKING</span><br>
                    PROBLEMS
                </h1>
                <p class="hero-description">
                    The modern booking platform that's integrated with GPS tech. It can
                    instantly search for the best turf, find the nearest parking spot with a variety
                    of price ranges.
                </p>
                
                <?php if ($message): ?>
                    <div class="message <?php echo strpos($message, 'Thank you') !== false ? 'success' : 'error'; ?>">
                        <?php echo htmlspecialchars($message); ?>
                    </div>
                <?php endif; ?>

                <div class="hero-buttons">
                    <button class="btn-primary player-btn" onclick="redirectToPlayer()">
                        <i class="fas fa-play"></i>
                        Start as Player
                    </button>
                    <button class="btn-secondary seller-btn" onclick="redirectToSeller()">
                        <i class="fas fa-store"></i>
                        Start as Seller
                    </button>
                </div>

                <div class="features-list">
                    <div class="feature-item">
                        <i class="fas fa-check"></i>
                        <span>No appointment</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check"></i>
                        <span>24/7 Support System</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check"></i>
                        <span>Free trial 15 days</span>
                    </div>
                </div>
            </div>
            
            <div class="hero-visual">
                <div class="phone-mockup">
                    <div class="phone-screen">
                        <div class="app-interface">
                            <div class="map-area">
                                <div class="location-pin" style="top: 20%; left: 30%;">
                                    <span class="price">$2.0/h</span>
                                </div>
                                <div class="location-pin" style="top: 40%; left: 60%;">
                                    <span class="price">$3.0/h</span>
                                </div>
                                <div class="location-pin" style="top: 60%; left: 25%;">
                                    <span class="price">$2.0/h</span>
                                </div>
                                <div class="location-pin" style="top: 75%; left: 70%;">
                                    <span class="price">$5.0/h</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- User Types Section -->
    <section id="user-types" class="user-types">
        <div class="user-types-container">
            <h2>Choose Your Path</h2>
            <p>Whether you're looking to play or manage turfs, we have the perfect solution for you</p>
            
            <div class="user-cards">
                <div class="user-card player-card">
                    <div class="card-icon">
                        <i class="fas fa-running"></i>
                    </div>
                    <h3>For Players</h3>
                    <p>Find and book the perfect turf for your game. Compare prices, check availability, and reserve your spot instantly.</p>
                    <ul class="features-list-card">
                        <li><i class="fas fa-check"></i> Find nearby turfs</li>
                        <li><i class="fas fa-check"></i> Compare prices</li>
                        <li><i class="fas fa-check"></i> Instant booking</li>
                        <li><i class="fas fa-check"></i> Real-time availability</li>
                    </ul>
                    <button class="btn-access" onclick="redirectToPlayer()">Start Playing</button>
                </div>

                <div class="user-card seller-card">
                    <div class="card-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3>For Turf Owners</h3>
                    <p>List your turf, manage bookings, and grow your business. Reach more customers and maximize your revenue.</p>
                    <ul class="features-list-card">
                        <li><i class="fas fa-check"></i> List your turf</li>
                        <li><i class="fas fa-check"></i> Manage bookings</li>
                        <li><i class="fas fa-check"></i> Track revenue</li>
                        <li><i class="fas fa-check"></i> Customer management</li>
                    </ul>
                    <button class="btn-access" onclick="redirectToSeller()">Start Selling</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Email Signup Section -->
    <section class="email-signup">
        <div class="email-signup-container">
            <h2>Stay Updated</h2>
            <p>Be the first to know when we launch. Join our waitlist today!</p>
            
            <div class="email-form">
                <form method="POST" action="">
                    <input type="email" name="email" placeholder="Enter your email address" required>
                    <button type="submit" class="btn-access">Join Waitlist</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features">
        <div class="features-container">
            <div class="section-header">
                <h2>Why Choose Turfy?</h2>
                <p>Experience the future of turf booking with our innovative platform</p>
            </div>

            <div class="feature-card main-feature">
                <div class="feature-content">
                    <h3>THE SOLUTION TO YOUR TURF BOOKING PROBLEMS</h3>
                    <p>We've researched many ways that will make it difficult if you search to book the best turfs. We present a booking application that makes everything easier for you.</p>
                    <div class="feature-buttons">
                        <button class="btn-secondary" onclick="redirectToPlayer()">Book Now</button>
                        <button class="btn-secondary" onclick="redirectToSeller()">List Your Turf</button>
                    </div>
                </div>
                <div class="feature-visual">
                    <div class="phone-preview">
                        <div class="app-screen">
                            <div class="turf-listing">
                                <div class="turf-item">
                                    <div class="turf-image"></div>
                                    <div class="turf-info">
                                        <h4>Premium Turf</h4>
                                        <div class="rating">
                                            <span>4.8</span>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="feature-card">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3>BE PART OF THE FUTURE BOOKING ERA NOW</h3>
                </div>
                <p>We bring the experience of making reservations, providing flexibility to make reservations at any time.</p>
                <div class="card-visual">
                    <div class="booking-interface">
                        <div class="time-slots">
                            <div class="time-slot active" onclick="selectTimeSlot(this)">9:00 AM</div>
                            <div class="time-slot" onclick="selectTimeSlot(this)">10:00 AM</div>
                            <div class="time-slot" onclick="selectTimeSlot(this)">11:00 AM</div>
                        </div>
                    </div>
                </div>
                <button class="btn-access" onclick="redirectToPlayer()">Get Started</button>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="about-container">
            <h2>About Turfy</h2>
            <p>Turfy is revolutionizing the way people book sports facilities. Our platform combines cutting-edge technology with user-friendly design to make turf booking effortless and efficient.</p>
            <div class="about-features">
                <div class="about-feature">
                    <i class="fas fa-map-marker-alt"></i>
                    <h4>GPS Integration</h4>
                    <p>Find the nearest turfs with real-time location tracking</p>
                </div>
                <div class="about-feature">
                    <i class="fas fa-clock"></i>
                    <h4>Real-time Availability</h4>
                    <p>Check live availability and book instantly</p>
                </div>
                <div class="about-feature">
                    <i class="fas fa-dollar-sign"></i>
                    <h4>Best Prices</h4>
                    <p>Compare prices and find the best deals</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="contact-container">
            <h2>Get in Touch</h2>
            <p>Have questions? We'd love to hear from you.</p>
            <div class="contact-info">
                <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>hello@turfy.com</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-phone"></i>
                    <span>+1 (555) 123-4567</span>
                </div>
                <div class="contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>San Francisco, CA</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>TURFY</h4>
                    <p>Experience the future of professional sports field booking with our innovative platform.</p>
                </div>
                <div class="footer-section">
                    <h4>ACCESS</h4>
                    <ul>
                        <li><a href="#features">Book Turf Online</a></li>
                        <li><a href="#about">Find Nearby Fields</a></li>
                        <li><a href="#contact">Premium Locations</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>CONTACT INFO</h4>
                    <ul>
                        <li>hello@turfy.com</li>
                        <li>+1 (555) 123-4567</li>
                        <li>San Francisco, CA</li>
                    </ul>
                </div>
            </div>
            <div class="footer-social">
                <a href="#" onclick="openSocial('twitter')"><i class="fab fa-twitter"></i></a>
                <a href="#" onclick="openSocial('instagram')"><i class="fab fa-instagram"></i></a>
                <a href="#" onclick="openSocial('linkedin')"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
    </footer>

    <script>
        // Redirect functions for different user types
        function redirectToPlayer() {
            // Replace with your actual player/customer page URL
             window.location.href = 'player_login.php';
            // window.location.href = '/player-dashboard.php';
        }

        function redirectToSeller() {
            window.location.href = 'customer_login.php'; // Use relative or absolute path
        }

        // Mobile menu toggle
        function toggleMenu() {
            const hamburger = document.querySelector('.hamburger');
            const navMenu = document.querySelector('.nav-menu');
            
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        }

        // Time slot selection
        function selectTimeSlot(element) {
            // Remove active class from all time slots
            document.querySelectorAll('.time-slot').forEach(slot => {
                slot.classList.remove('active');
            });
            
            // Add active class to clicked slot
            element.classList.add('active');
        }

        // Social media links
        function openSocial(platform) {
            const urls = {
                twitter: 'https://twitter.com/turfy',
                instagram: 'https://instagram.com/turfy',
                linkedin: 'https://linkedin.com/company/turfy'
            };
            
            if (urls[platform]) {
                window.open(urls[platform], '_blank');
            }
        }

        // Initialize page functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Add scroll effect to navbar
            window.addEventListener('scroll', () => {
                const navbar = document.querySelector('.navbar');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        });
    </script>
</body>
</html>
