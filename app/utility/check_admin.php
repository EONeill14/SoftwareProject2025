<?php

if (!isset($_SESSION['admin'])) {
    header('Location: ' . $app_path . 'admin/users/');
}
?>


