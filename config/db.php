<?php

$dsn = 'mysql:host=localhost;dbname=teetime';
$username = 'root';
$password = 'mysql';

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try {
    $db = new pdo($dsn, $username, $password, $options);
} catch (Exception $e) {
    $error_message = $e->get_message();
    include('error/db_connect_error.php');
    exit();
}
?>