<?php
$doc_root = $_SERVER['DOCUMENT_ROOT'];

$uri = $_SERVER['REQUEST_URI'];

$dirs = explode('/', $uri);
//echo 'The value is: '.$dirs[1];  
//echo ' The value is: '.$dirs[2]; 
//echo ' The value is: '.$dirs[3];  


$app_path = '/' . $dirs[1] . '/'; 

// Set the include path 
set_include_path($doc_root . $app_path);

// Get common code
require_once('utility/tags.php');
require_once('model/db.php');
require_once('model/cart.php');
require_once('model/category_lib.php');
$categories = get_categories();



// Function to handle database errors 
function display_db_error($error_message) {
    global $app_path;
    include 'errors/db_connect_error.php';
    exit;
}

// Function to handle general errors (For Admins to display errors with their headers)
function display_error($error_message) {
    global $app_path;
    include 'errors/error.php';
    exit;
}

// Function to handle general errors (For Members to display errors with their headers)
function member_error($error_message) {
    global $app_path;
    include 'errors/member_error.php';
    exit;
}


// Redirect function
function redirect($url) {
    session_write_close();
    header("Location: " . $url);
    exit;
}

// Start session to store user and cart data
session_start();
?>
