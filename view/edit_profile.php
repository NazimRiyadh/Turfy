
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['seller_id'])) {
    header("Location: customer_login.php");
    exit();
}

include "../model/mydb.php";
$conn = getDBConnection();
$seller_id = $_SESSION['seller_id'];
$seller = getTurfById($conn, $seller_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/seller-profile.css">
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        
        <form action="../controller/update_profile.php" method="POST">
            <table>
                <tr>
                    <td><label for="turf_name">Turf Name:</label></td>
                    <td><input type="text" name="turf_name" id="turf_name" value="<?php echo htmlspecialchars($seller['turf_name']); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="phone">Phone:</label></td>
                    <td><input type="tel" name="phone" id="phone" value="<?php echo htmlspecialchars($seller['phone']); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="email" name="email" id="email" value="<?php echo htmlspecialchars($seller['email']); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="address">Address:</label></td>
                    <td><input type="text" name="address" id="address" value="<?php echo htmlspecialchars($seller['address']); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="sports">Sports:</label></td>
                    <td><input type="text" name="sports" id="sports" value="<?php echo htmlspecialchars($seller['sports']); ?>"></td>
                </tr>
                <tr>
                    <td><label for="other_sport">Other Sport:</label></td>
                    <td><input type="text" name="other_sport" id="other_sport" value="<?php echo htmlspecialchars($seller['other_sport']); ?>"></td>
                </tr>
                <tr>
                    <td><label for="owner_name">Owner Name:</label></td>
                    <td><input type="text" name="owner_name" id="owner_name" value="<?php echo htmlspecialchars($seller['owner_name']); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="owner_phone">Owner Phone:</label></td>
                    <td><input type="tel" name="owner_phone" id="owner_phone" value="<?php echo htmlspecialchars($seller['owner_phone']); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="owner_email">Owner Email:</label></td>
                    <td><input type="email" name="owner_email" id="owner_email" value="<?php echo htmlspecialchars($seller['owner_email']); ?>" required></td>
                </tr>
                <tr>
                    <td><label for="owner_nid">Owner NID:</label></td>
                    <td><input type="text" name="owner_nid" id="owner_nid" value="<?php echo htmlspecialchars($seller['owner_nid']); ?>" required></td>
                </tr>
            </table>

            <div class="form-buttons">
                <input type="submit" value="Save Changes">
                <a href="seller_profile.php">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
