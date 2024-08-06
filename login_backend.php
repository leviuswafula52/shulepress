<?php
// login_backend.php

// Retrieve form data
$email = $_POST['email'];
$password = $_POST['password'];

// Debug output
error_log("Email: $email");
error_log("Password: $password");

// Replace these credentials with actual validation logic
$valid_email = 'user@example.com';
$valid_password = 'password123';

// Validate credentials
if ($email === $valid_email && $password === $valid_password) {
    echo 'success';
} else {
    echo 'Invalid email or password';
}
?>
