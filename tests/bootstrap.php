<?php
// This file sets up the environment for our tests.

// Define the project root.
if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', dirname(__DIR__));
}

// Set the include path.
set_include_path(PROJECT_ROOT);

// Load all the libraries needed for our tests.
require_once(PROJECT_ROOT . '/model/db.php');
require_once(PROJECT_ROOT . '/model/product_lib.php');
require_once(PROJECT_ROOT . '/model/cart.php');
require_once(PROJECT_ROOT . '/model/order_lib.php');

// Define dummy error functions for the test environment.
if (!function_exists('display_db_error')) {
    function display_db_error($msg) { throw new Exception("DB Error: " . $msg); }
}
if (!function_exists('member_error')) {
    function member_error($msg) { throw new Exception("Member Error: ". $msg); }
}

// Start a session for cart functions.
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
