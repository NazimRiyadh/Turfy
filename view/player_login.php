<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Player Login</title>
    <link rel="stylesheet" href="../css/customer_login.css" />
</head>
<body>
    <div class="login-container">
        <h2>Player Login</h2>
        <?php
        if (isset($_GET['error'])) {
            echo '<p style="color:red;">Invalid username or password.</p>';
        }
        ?>
        <form action="../controller/control_player_login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required />

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required />

            <input type="submit" value="Login" />
        </form>

        <p>Don't have an account? 
            <a href="player_register.php" class="register-btn">Register Here</a>
        </p>
    </div>
</body>
</html>
