<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Player Registration</title>
    <link rel="stylesheet" href="../css/seller.css">
    <script defer src="validation.js"></script>
</head>
<body>
    <h1>Register as a Player</h1>

    <form id="player-form" action="../controller/player_validation.php" method="post" onsubmit="return validate(event)">
        <fieldset>
            <legend><h3>Login Credentials</h3></legend>
            <table>
                <tr>
                    <td><label for="username">Username:</label></td>
                    <td>
                        <input type="text" id="username" name="username" value="<?= ($old['username'] ?? '') ?>">
                        <span id="username_error" class="error" style="color:red;"><?= ($errors['username'] ?? '') ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="password">Password:</label></td>
                    <td>
                        <input type="password" id="password" name="password">
                        <span id="password_error" class="error" style="color:red;"><?= ($errors['password'] ?? '') ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="confirm_password">Confirm Password:</label></td>
                    <td>
                        <input type="password" id="confirm_password" name="confirm_password">
                        <span id="confirm_password_error" class="error" style="color:red;"><?= ($errors['confirm_password'] ?? '') ?></span>
                    </td>
                </tr>
            </table>
        </fieldset>

        <fieldset>
            <legend><h3>Player Information</h3></legend>
            <table>
                <tr>
                    <td><label for="full_name">Full Name:</label></td>
                    <td>
                        <input type="text" id="full_name" name="full_name" value="<?= ($old['full_name'] ?? '') ?>">
                        <span id="full_name_error" class="error" style="color:red;"><?= ($errors['full_name'] ?? '') ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td>
                        <input type="email" id="email" name="email" value="<?= ($old['email'] ?? '') ?>">
                        <span id="email_error" class="error" style="color:red;"><?= ($errors['email'] ?? '') ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="phone">Phone Number:</label></td>
                    <td>
                        <input type="tel" id="phone" name="phone" value="<?= ($old['phone'] ?? '') ?>">
                        <span id="phone_error" class="error" style="color:red;"><?= ($errors['phone'] ?? '') ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="dob">Date of Birth:</label></td>
                    <td>
                        <input type="date" id="dob" name="dob" value="<?= ($old['dob'] ?? '') ?>">
                        <span id="dob_error" class="error" style="color:red;"><?= ($errors['dob'] ?? '') ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td>
                        <input type="text" id="address" name="address" value="<?= ($old['address'] ?? '') ?>">
                        <span id="address_error" class="error" style="color:red;"><?= ($errors['address'] ?? '') ?></span>
                    </td>
                </tr>
                <tr>
                    <td><label>Interested Sports:</label></td>
                    <td>
                        <input type="checkbox" name="sports[]" id="football" value="Football">
                        <label for="football">Football</label><br>
                        <input type="checkbox" name="sports[]" id="cricket" value="Cricket">
                        <label for="cricket">Cricket</label><br>
                        <input type="checkbox" name="sports[]" id="badminton" value="Badminton">
                        <label for="badminton">Badminton</label><br>
                        <input type="text" name="other_sport" placeholder="Other (optional)">
                        <span id="sports_error" class="error" style="color:red;"><?= ($errors['sports'] ?? '') ?></span>
                    </td>
                </tr>
            </table>
        </fieldset><br>

        <input type="submit" value="Register Player">
        <div class="back-button-container">
            <a href="player-login.php" class="back-button">⬅ Back to Sign In</a>
        </div>
    </form>
</body>
</html>
