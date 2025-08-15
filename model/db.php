<?php
$dsn = 'mysql:host=localhost;dbname=teetime';
$username = 'root';
$password = '';

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try 
{
  $db = new PDO($dsn, $username, $password, $options);
} 
catch (PDOException $e) 
{
  $error_message = $e->getMessage();
  include('errors/db_connect_error.php');
  exit();
}
?>