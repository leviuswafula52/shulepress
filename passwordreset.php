<?php
// generate_reset_token.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shulepress";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$reset_token = bin2hex(random_bytes(32));

// Prepare and bind
$stmt = $conn->prepare("REPLACE INTO password_resets (email, reset_token) VALUES (?, ?)");
$stmt->bind_param("ss", $email, $reset_token);

if ($stmt->execute()) {
    // Send the reset token to the user's email
    mail($email, "Password Reset", "Here is your reset token: $reset_token");
    echo "success";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
