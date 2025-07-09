<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Customer Login</title>
    <link rel="stylesheet" href="../css/customer_login.css">
        
</head>
<body>
    <div class="login-container">
        <h2>Customer Login</h2>
        
        <div class="error-message" id="errorMessage" style="display: none;">
            Invalid username or password.
        </div>
        
        <form action="../controller/control_customer_login.php" method="post" id="loginForm">
           <form action="../controller/control_customer_login.php" method="post" id="loginForm">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required />
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required />
                </div>

                <input type="submit" value="Login" />
            </form>

        <div class="register-section">
            <p>Don't have an account? 
                <a href="seller.php" class="register-btn">Register Here</a>
            </p>
        </div>
    </div>

    <script>
        // Show error message if URL contains error parameter
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('error')) {
            document.getElementById('errorMessage').style.display = 'block';
        }

        // Add loading state on form submission
        document.getElementById('loginForm').addEventListener('submit', function() {
            this.classList.add('loading');
        });

        // Add subtle hover effects to inputs
        const inputs = document.querySelectorAll('input[type="text"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-1px)';
            });
            
            input.addEventListener('mouseleave', function() {
                if (this !== document.activeElement) {
                    this.style.transform = 'translateY(0)';
                }
            });
        });
    </script>
</body>
</html>