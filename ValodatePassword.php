<?php
// reset_password.php

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
$reset_token = $_POST['reset_token'];
$new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);

// Prepare and execute query
$stmt = $conn->prepare("SELECT reset_token FROM password_resets WHERE email = ? AND reset_token = ?");
$stmt->bind_param("ss", $email, $reset_token);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Token is valid; update password
    $stmt->close();
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $new_password, $email);
    if ($stmt->execute()) {
        // Remove the reset token
        $stmt->close();
        $stmt = $conn->prepare("DELETE FROM password_resets WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        echo "Password reset successful";
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Invalid reset token";
}

$stmt->close();
$conn->close();
?>
