<?php

// FILE: /SoftWareProject/admin/users/index.php

/**
   * Controller for the admin account area.
    */
// Define the project root, which is two directories up from this file's location.
define('PROJECT_ROOT', dirname(__DIR__, 2));

// Now that the root path is defined, we can safely require the main setup files.
require_once(PROJECT_ROOT . '/utility/main.php');
require_once(PROJECT_ROOT . '/utility/secure.php');
require_once(PROJECT_ROOT . '/model/admin_lib.php');

// --- Action Controller ---
$action = 'view_login'; // Default action

if (isset($_SESSION['user'])) {
    display_error('Already logged in as a member.');
}

if (admin_count() == 0) {
    if (isset($_POST['action']) && $_POST['action'] == 'create') {
        $action = 'create';
    } else {
        $action = 'view_account'; // This will show the form to create the first admin
    }
} elseif (isset($_SESSION['admin'])) {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
    } elseif (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = 'view_account';
    }
} elseif (isset($_POST['action']) && $_POST['action'] == 'login') {
    $action = 'login';
}

switch ($action) {
    case 'view_login':
        include 'admin_login.php';
        break;
    case 'login':
        $email = $_POST['usremail'];
        $password = $_POST['password'];

        if (is_valid_admin_login($email, $password)) {
            $_SESSION['admin'] = get_admin_by_email($email);
            redirect('.'); // Redirect back to this controller
        } else {
            display_error('Login failed. Invalid email or password.');
        }
        break;
    case 'create':
        $email = $_POST['email'];
        // FIX: Get first and last name separately
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $password_1 = $_POST['password_1'];
        $password_2 = $_POST['password_2'];

        if ($password_1 !== $password_2) {
            display_error('Passwords do not match.');
        }

        // FIX: Call the function with the correct 5 arguments
        $admin_id = add_admin($email, $first_name, $last_name, $password_1, $password_2);

        if (!isset($_SESSION['admin'])) {
            $_SESSION['admin'] = get_admin($admin_id);
        }
        redirect('.');
        break;
    case 'view_account':
        if (!isset($_SESSION['admin'])) {
            if (admin_count() == 0) {
                include 'admin_add.php'; // A view to create the first admin
            } else {
                include 'admin_login.php';
            }
            break;
        }

        // CORRECTED: Using the correct array keys from your database table
        // This is the corrected version
        $name = $_SESSION['admin']['fName'] . ' ' . $_SESSION['admin']['lName'];
        $email = $_SESSION['admin']['adminemail'];
        $admin_id = $_SESSION['admin']['adminID'];

        $admins = get_all_admins();

        include 'admin_view.php';
        break;
    case 'view_edit':
        $admin_id = intval($_POST['admin_id']);
        $admin = get_admin($admin_id);

        // FIX: Use correct database columns AND define the variables the view needs
        $email = $admin['adminemail'];
        $first_name = $admin['fName'];
        $last_name = $admin['lName'];

        include 'admin_edit.php';
        break;
    case 'update':
        $admin_id = intval($_POST['admin_id']);
        // FIX: Read separate first_name and last_name from the form
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password_1 = $_POST['password_1'];
        $password_2 = $_POST['password_2'];

        // This function call now matches what the model expects
        update_admin($admin_id, $email, $first_name, $last_name, $password_1, $password_2);

        // Update the session if the currently logged-in admin is editing their own account
        if ($admin_id == $_SESSION['admin']['adminID']) {
            $_SESSION['admin'] = get_admin($admin_id);
        }

        redirect('.'); // Redirect back to the admin list
        break;
    case 'view_delete_confirm':
        $admin_id = intval($_POST['admin_id']);
        if ($admin_id == $_SESSION['admin']['adminID']) {
            display_error('You cannot delete your own account.');
        }
        $admin = get_admin($admin_id);

        // --- FIX STARTS HERE ---
        // Use the correct database column names to get the data
        $first_name = $admin['fName'];
        $last_name = $admin['lName'];
        $email = $admin['adminemail'];
        // --- FIX ENDS HERE ---

        include 'admin_delete.php';
        break;
    case 'delete':
        $admin_id = intval($_POST['admin_id']);
        delete_admin($admin_id);
        redirect('.');
        break;
    case 'logout':
        unset($_SESSION['admin']);
        redirect('.');
        break;
    default:
        display_error('Unknown account action: ' . $action);
        break;
}
?>
