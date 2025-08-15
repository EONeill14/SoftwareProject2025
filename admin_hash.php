<?php
// The password you want to use for your admin account
$password = 'Pass123$$';

// This line MUST match the hashing logic in your admin_lib.php
$hash = password_hash($password, PASSWORD_DEFAULT);

// Display the hash
echo "<h1>Secure Password Hash Generator</h1>";
echo "<p><strong>Password:</strong> " . htmlspecialchars($password) . "</p>";
echo "<p><strong>Generated Hash (copy this):</strong></p>";
echo "<textarea rows='3' cols='70'>" . htmlspecialchars($hash) . "</textarea>";
?>