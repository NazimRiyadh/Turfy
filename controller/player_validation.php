<?php

include_once '../model/mydb.php';

$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../view/player-register.php");
    exit;
}

// Collect and store old values
$old['username']        = $username    = $_POST['username'] ?? '';
$old['password']        = $password    = $_POST['password'] ?? '';
$old['confirm_password']= $confirm_pw  = $_POST['confirm_password'] ?? '';
$old['full_name']       = $full_name   = $_POST['full_name'] ?? '';
$old['phone']           = $phone       = $_POST['phone'] ?? '';
$old['email']           = $email       = $_POST['email'] ?? '';
$old['dob']             = $dob         = $_POST['dob'] ?? '';
$old['address']         = $address     = $_POST['address'] ?? '';
$sportsArr              = $_POST['sports'] ?? [];
$old['sports']          = $sportsArr;
$old['other_sport']     = $other_sport = $_POST['other_sport'] ?? '';
$created_at             = date("Y-m-d H:i:s");

// ====================== VALIDATION ======================

if ($username === '') {
    $errors['username'] = "Username is required.";
} elseif (strlen($username) < 4) {
    $errors['username'] = "Username must be at least 4 characters.";
}

if ($password === '') {
    $errors['password'] = "Password is required.";
} elseif (strlen($password) < 6) {
    $errors['password'] = "Password must be at least 6 characters.";
}

if ($confirm_pw === '') {
    $errors['confirm_password'] = "Please confirm your password.";
} elseif ($password !== $confirm_pw) {
    $errors['confirm_password'] = "Passwords do not match.";
}

if ($full_name === '') {
    $errors['full_name'] = "Full name is required.";
} elseif (strlen($full_name) < 3) {
    $errors['full_name'] = "Full name must be at least 3 characters.";
}

if ($phone === '') {
    $errors['phone'] = "Phone number is required.";
} elseif (!preg_match('/^\d{11}$/', $phone)) {
    $errors['phone'] = "Phone number must be exactly 11 digits.";
}

if ($email === '') {
    $errors['email'] = "Email is required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Invalid email format.";
}

if ($dob === '') {
    $errors['dob'] = "Date of birth is required.";
}

if ($address === '') {
    $errors['address'] = "Address is required.";
} elseif (strlen($address) < 5) {
    $errors['address'] = "Address must be at least 5 characters.";
}

if (empty($sportsArr) && $other_sport === '') {
    $errors['sports'] = "Please select at least one sport or specify another.";
} elseif (strlen($other_sport) > 20) {
    $errors['sports'] = "Other sport name must be under 20 characters.";
}

// If errors found, go back to form
if (!empty($errors)) {
    include '../view/player_register.php';
    exit;
}


$conn = getDBConnection();
$data = [
    'username'     => $username,
    'password'     => $password, // (Store hashed in real apps)
    'full_name'    => $full_name,
    'phone'        => $phone,
    'email'        => $email,
    'dob'          => $dob,
    'address'      => $address,
    'sports'       => implode(',', $sportsArr),
    'other_sport'  => $other_sport,
    'created_at'   => $created_at,
];

// Insert into database
if (insert_player($conn, $data)) {
    header("Location: ../view/player_login.php");
    exit;
}

die("Database error: Could not insert player.");
?>