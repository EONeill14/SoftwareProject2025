<?php

$con = mysqli_connect("localhost", "root", "mysql");
if (!con) {
    die('Could not connect: ' . mysqli_error($con));
}
mysqli-select_db($con,"abcglobal");
$s_Email=$_POST['subemail'];
$sql = "INSERT INTO subscribe (email,sub) VALUES('$s_Email', 1)";

if(!mysqli_query($con,$sql))
{
    die('Error: ' . mysqli_error($con));
}

mysqli_close($con);

function sanitize_email($recipient_email) {
    $recipient_email = filter_var($recipient_email, FILTER_SANITIZ_EMAIL);
    if(filter_var($recipient_email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

$to = $_POST['subemail'];
$subject="Newsletter subscription confirmation";
$message="Hi,\n\n this message is sent to you from Abc Global consulting inc. as a confirmation to your newsletter subscription to request.";
$header = "From.Administrator <admin@abc.com> \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";

$valid_email =sanitize_email($to);
if($valid_email ==false) {
    echo "Invalid input -message not sent";
}
else {
    mail($to, $subject, $message, $header);
    include('utility/main.php');
    include 'confirm_subscribe.php';
}

?>