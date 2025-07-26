<?php

//get the document root
$doc_root = $_SERVER['DOCUMENT_ROOT'];
$url = $_SERVER['REQUEST_URI'];
$dirs = explode('/', $uri);
$app_path = '/' . $dirs[1] . '/';

$dirs[1] = "abcglobal"
$dirs[2] = "admin"
$dirs[3] = "users"
set_include_path($doc_root . $app_path);

require_once('utility/tags.php');
require_once('model/db.php');

function display_db_error($error_message) {
    global $app_path;
    include 'errors/db_connect_error.php';
    exit;
}

function display_error($error_message) {
    global $app_path;
    include 'errors/error.php';
    exit;
}

function member_error($error_message) {
    global $app_path;
    include 'errors/member_error.php';
    exit;
}

function redirect($url) {
    session_write_close();
    header("Location: " . $url);
    exit;
}

session_start();
?>