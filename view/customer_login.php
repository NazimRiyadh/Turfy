<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Customer Login</title>
    <link rel="stylesheet" href="../css/customer_login.css" />
</head>
<body>
    <main class="login-container" role="main" aria-labelledby="login-title">
        <h1 id="login-title">Customer Login</h1>

        <?php if (isset($_GET['error'])): ?>
            <p class="error-message" role="alert">Invalid username or password.</p>
        <?php endif; ?>

        <form action="../controller/control_customer_login.php" method="post" autocomplete="on" novalidate>
            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                required
                autocomplete="username"
                placeholder="Enter your username"
                aria-describedby="usernameHelp"
            />
            <small id="usernameHelp" class="sr-only">Your unique username</small>

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Enter your password"
            />

            <button type="submit" class="btn-submit">Log In</button>
        </form>

        <p class="register-text">
            Don't have an account?
            <a href="seller.php" class="register-link">Register here</a>
        </p>
    </main>
</body>
</html>
