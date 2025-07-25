<?php

$con = mysqli_connect("localhost", "root", "", "teetime");
if (!$con) {
    die("Could not connect: " . mysqli_connect_error());
}

$customer_name = $_POST['customer_name'];
$customer_email = $_POST['customer_email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$customer_name = mysqli_real_escape_string($con, $customer_name);
$customer_email = mysqli_real_escape_string($con, $customer_email);
$subject = mysqli_real_escape_string($con, $subject);
$message = mysqli_real_escape_string($con, $message);

$sql = "INSERT INTO contact_messages (customer_name, customer_email, subject, message) VALUES ('$customer_name', '$customer_email', '$subject', '$message')";

if (mysqli_query($con, $sql)) {
    header('Location: success.php');
    exit(); 
} else {
    die('Error: ' . mysqli_error($con));
}

mysqli_close($con);

?>
