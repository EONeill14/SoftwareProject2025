<?php
// The email of your sample member user from the database
$email = 'emmetoneill18@gmail.com';

// The password you want to use for this member
$password = 'Pass123$$';

// This line creates a modern, secure hash
$hash = password_hash($password, PASSWORD_DEFAULT);

// Display the hash
echo "<h1>Secure Member Hash Generator</h1>";
echo "<p><strong>Email:</strong> " . htmlspecialchars($email) . "</p>";
echo "<p><strong>Password:</strong> " . htmlspecialchars($password) . "</p>";
echo "<p><strong>Generated Secure Hash (copy this):</strong></p>";
echo "<textarea rows='3' cols='70'>" . htmlspecialchars($hash) . "</textarea>";
?>