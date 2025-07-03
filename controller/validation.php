<?php

include_once '../model/mydb.php';

$errors = [];
$old = [];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../view/seller.php");
    exit;
}


$old['username']        = $username    = $_POST['username'] ?? '';
$old['password']        = $password    = $_POST['password'] ?? '';
$old['confirm_password']= $confirm_pw  = $_POST['confirm_password'] ?? '';
$old['turf_name']       = $turf_name   = $_POST['turf_name'] ?? '';
$old['phone']           = $phone       = $_POST['phone'] ?? '';
$old['email']           = $email       = $_POST['email'] ?? '';
$old['address']         = $address     = $_POST['address'] ?? '';
$sportsArr              = $_POST['sports'] ?? [];
$old['sports']          = $sportsArr;
$old['other_sport']     = $other_sport = $_POST['other_sport'] ?? '';
$old['owner_name']      = $owner_name  = $_POST['owner_name'] ?? '';
$old['owner_phone']     = $owner_phone = $_POST['owner_phone'] ?? '';
$old['owner_email']     = $owner_email = $_POST['owner_email'] ?? '';
$old['owner_nid']       = $owner_nid   = $_POST['owner_nid'] ?? '';
$created_at             = date("Y-m-d H:i:s");


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

if ($turf_name === '') {
    $errors['turf_name'] = "Turf name is required.";
} elseif (strlen($turf_name) < 5) {
    $errors['turf_name'] = "Turf name must be at least 5 characters.";
}

if ($phone === '') {
    $errors['phone'] = "Phone number is required.";
} elseif (!preg_match('/^\d{11}$/', $phone)) {
    $errors['phone'] = "Phone number must be exactly 11 digits.";
}

if ($email === '') {
    $errors['email'] = "Email is required.";
} elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
    $errors['email'] = "Invalid email format.";
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

if (!isset($_FILES['images']) || $_FILES['images']['error'][0] === UPLOAD_ERR_NO_FILE) {
    $errors['images'] = "At least one image must be uploaded.";
}

if ($owner_name === '') {
    $errors['owner_name'] = "Owner's name is required.";
} elseif (strlen($owner_name) < 3) {
    $errors['owner_name'] = "Owner's name must be at least 3 characters.";
}

if ($owner_phone === '') {
    $errors['owner_phone'] = "Owner's phone is required.";
} elseif (!preg_match('/^\d{11}$/', $owner_phone)) {
    $errors['owner_phone'] = "Owner's phone must be exactly 11 digits.";
}

if ($owner_nid === '') {
    $errors['owner_nid'] = "Owner's NID is required.";
} elseif (!preg_match('/^\d{10,17}$/', $owner_nid)) {
    $errors['owner_nid'] = "Owner's NID must be between 10 and 17 digits.";
}
if(!empty($errors))
{
    include '../view/seller.php';
    exit;
}

if (empty($errors)) {
    $uploadDir = __DIR__ . '/../uploads/';
    $imagePaths = [];

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    foreach ($_FILES['images']['tmp_name'] as $i => $tmp) {
        if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
            $name = basename($_FILES['images']['name'][$i]);
        $target = $uploadDir . $name;

        if (move_uploaded_file($tmp, $target)) {
            $imagePaths[] = $name;
        } else {
            die("Failed to move uploaded file: " . $_FILES['images']['name'][$i]);
        }
    }
}

$image_paths_str = implode(',', $imagePaths);

if ($image_paths_str === '') {
    die("No images were uploaded successfully.");
}


$conn = getDBConnection();
$data = [
    'username'    => $username,
    'password'    => $password, 
    'turf_name'   => $turf_name,
    'phone'       => $phone,
    'email'       => $email,
    'address'     => $address,
    'sports'      => implode(',', $sportsArr),
    'other_sport' => $other_sport,
    'image_paths' => $image_paths_str,
    'owner_name'  => $owner_name,
    'owner_phone' => $owner_phone,
    'owner_email' => $owner_email,
    'owner_nid'   => $owner_nid,
    'created_at'  => $created_at,
];

if (insert_turf($conn, $data)) {
    header("Location: ../view/customer_login.php");
    exit;
}

die("Database error: Could not insert turf.");
}
?>
