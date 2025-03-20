<?php
// Check if email exists using MailboxLayer API
/*function verifyEmail($email) {
   
   
    $response = file_get_contents($apiUrl);
    $result = json_decode($response, true);

    if (!$result['format_valid'] || !$result['smtp_check']) {
        return false; // Email is invalid
    }
    return true; // Email exists
}*/

// Validate Name
if (empty($_POST["name"])) {
    die("Name is required");
}

// Validate Email
$email = $_POST["email"];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

/*if (!verifyEmail($email)) {
    die("The email address does not exist or is invalid.");
}*/

// Validate Password
if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}
if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}
if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

// Check Password Confirmation
if ($_POST["password"] !== $_POST["password-confirmation"]) {
    die("Passwords must match");
}

// Hash Password
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Database Connection
$mysqli = require __DIR__ . "/database.php";

// Check if email already exists
$sql = "SELECT id FROM user WHERE email = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_POST["email"]);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    die("Email already exists");
}
$stmt->close();

// Insert New User
$sql = "INSERT INTO user (name, email, password_hash) VALUES (?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sss", $_POST["name"], $_POST["email"], $password_hash);

if ($stmt->execute()) {
    header("Location: signup-success.html");
    exit;
} else {
    die("Signup failed: " . $mysqli->error);
}
?>
