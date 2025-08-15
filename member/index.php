<?php

// Corrected file paths to go up one directory
require_once('../utility/main.php');
require_once('../utility/secure.php');
require_once('../model/member_lib.php');
require_once('../model/address_lib.php');
require_once('../model/order_lib.php');

// Get the action to perform, with a safe default
$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action');
if (!isset($_SESSION['user'])) {
    if (!in_array($action, ['view_login', 'login', 'view_register', 'register'])) {
        $action = 'view_login';
    }
} elseif (is_null($action)) {
    $action = 'view_account';
}

switch ($action) {
    case 'view_login':
        include 'member_login.php';
        break;

    case 'login':
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');

        if (!$email || empty($password) || !is_valid_member_login($email, $password)) {
            member_error('Login failed. Please check your email and password.');
        } else {
            $_SESSION['user'] = get_member_by_email($email);
        }

        if (isset($_SESSION['checkout'])) {
            unset($_SESSION['checkout']);
            redirect('../checkout');
        } else {
            redirect('.');
        }
        break;

    case 'view_register':
        include 'member_register.php';
        break;

    case 'register':
        global $db;
        try {
            $db->beginTransaction();

            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $first_name = filter_input(INPUT_POST, 'first_name');
            $last_name = filter_input(INPUT_POST, 'last_name');
            $password_1 = filter_input(INPUT_POST, 'password_1');
            $password_2 = filter_input(INPUT_POST, 'password_2');

            // --- Full validation ---
            if (!$email || is_email_in_use($email)) {
                member_error('Invalid or duplicate email address.');
            }
            if (empty($first_name) || empty($last_name)) {
                member_error('First and last name are required.');
            }
            if (strlen($password_1) < 6) {
                member_error('Password must be at least 6 characters.');
            }
            if ($password_1 !== $password_2) {
                member_error('Passwords do not match.');
            }

            // 1. Add the member
            $member_id = add_member($email, $first_name, $last_name, $password_1);

            // 2. Add shipping address
            $ship_line1 = filter_input(INPUT_POST, 'ship_line1');
            $ship_city = filter_input(INPUT_POST, 'ship_city');
            $ship_county = filter_input(INPUT_POST, 'ship_county');
            $ship_eircode = filter_input(INPUT_POST, 'ship_eircode');
            $ship_phone = filter_input(INPUT_POST, 'ship_phone');
            if (empty($ship_line1) || empty($ship_city) || empty($ship_county) || empty($ship_eircode)) {
                member_error('A complete shipping address is required.');
            }
            $shipping_id = add_address($member_id, $ship_line1, '', $ship_city, $ship_county, $ship_eircode, $ship_phone);
            member_change_shipping_id($member_id, $shipping_id);
            member_change_billing_id($member_id, $shipping_id); // Default billing to shipping

            $db->commit();

            $_SESSION['user'] = get_member($member_id);
            redirect('.');
        } catch (Exception $e) {
            $db->rollBack();
            display_db_error($e->getMessage());
        }
        break;

    case 'view_account':
        // Safety check to make sure a user is logged in
        if (!isset($_SESSION['user'])) {
            redirect('?action=view_login');
            break;
        }

        // Prepare basic member info from the session
        $member_name = $_SESSION['user']['fName'] . ' ' . $_SESSION['user']['lName'];
        $email = $_SESSION['user']['memberEmail'];

        // --- FIX STARTS HERE ---
        // Safely get the shipping address
        $shipping_address = get_address($_SESSION['user']['shipAddressID']);
        if ($shipping_address === false) {
            // If no address, create empty variables to prevent warnings
            $ship_line1 = '<i>No shipping address on file.</i>';
            $ship_line2 = '';
            $ship_city = '';
            $ship_county = '';
            $ship_eircode = '';
            $ship_phone = '';
        } else {
            // If address exists, populate variables
            $ship_line1 = $shipping_address['line1'];
            $ship_line2 = $shipping_address['line2'];
            $ship_city = $shipping_address['city'];
            $ship_county = $shipping_address['county'];
            $ship_eircode = $shipping_address['eircode'];
            $ship_phone = $shipping_address['phone'];
        }

        // Safely get the billing address
        $billing_address = get_address($_SESSION['user']['billingAddressID']);
        if ($billing_address === false) {
            // If no address, create empty variables
            $bill_line1 = '<i>No billing address on file.</i>';
            $bill_line2 = '';
            $bill_city = '';
            $bill_county = '';
            $bill_eircode = '';
            $bill_phone = '';
        } else {
            // If address exists, populate variables
            $bill_line1 = $billing_address['line1'];
            $bill_line2 = $billing_address['line2'];
            $bill_city = $billing_address['city'];
            $bill_county = $billing_address['county'];
            $bill_eircode = $billing_address['eircode'];
            $bill_phone = $billing_address['phone'];
        }

        // --- FIX ENDS HERE ---

        $orders = get_orders_by_member_id($_SESSION['user']['memberID']);
        include 'member_view.php';
        break;
    case 'view_account_edit':
        // Safety check
        if (!isset($_SESSION['user'])) {
            redirect('.');
            break;
        }

        // This is the part that creates the variables for the form
        $email = $_SESSION['user']['memberEmail'];
        $first_name = $_SESSION['user']['fName'];
        $last_name = $_SESSION['user']['lName'];

        // Now, load the view
        include 'member_edit.php';
        break;
    case 'update_account':
        if (!isset($_SESSION['user'])) {
            redirect('.');
            break;
        }

        $member_id = $_SESSION['user']['memberID'];
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $first_name = filter_input(INPUT_POST, 'first_name');
        $last_name = filter_input(INPUT_POST, 'last_name');
        $password_1 = filter_input(INPUT_POST, 'password_1');
        $password_2 = filter_input(INPUT_POST, 'password_2');
        $old_member = get_member($member_id);

        if (!$email) {
            member_error('Invalid email format.');
        }
        if ($email != $old_member['memberEmail'] && is_email_in_use($email)) {
            member_error('That email address is already taken.');
        }

        update_member($member_id, $email, $first_name, $last_name, $password_1, $password_2);

        $_SESSION['user'] = get_member($member_id); // Refresh session data
        redirect('.');
        break;

    case 'view_address_edit':
        if (!isset($_SESSION['user'])) {
            redirect('.');
            break;
        }

        // Determine if we're editing the billing or shipping address
        $address_type = filter_input(INPUT_POST, 'address_type');
        if ($address_type == 'billing') {
            $address_id = $_SESSION['user']['billingAddressID'];
            $heading = 'Update Billing Address';
            $billing = true;
        } else {
            $address_id = $_SESSION['user']['shipAddressID'];
            $heading = 'Update Shipping Address';
            $billing = false;
        }

        // Get the address data from the database
        $address = get_address($address_id);

        // Prepare variables for the view, handling cases where no address exists yet
        $line1 = $address['line1'] ?? '';
        $line2 = $address['line2'] ?? '';
        $city = $address['city'] ?? '';
        $county = $address['county'] ?? '';
        $eircode = $address['eircode'] ?? '';
        $phone = $address['phone'] ?? '';

        include 'member_address.php';
        break;
    case 'update_address':
        if (!isset($_SESSION['user'])) {
            redirect('.');
            break;
        }
        $member_id = $_SESSION['user']['memberID'];
        $address_type = filter_input(INPUT_POST, 'address_type');
        $address_id = ($address_type == 'billing') ? $_SESSION['user']['billingAddressID'] : $_SESSION['user']['shipAddressID'];

        $line1 = filter_input(INPUT_POST, 'line1');
        $city = filter_input(INPUT_POST, 'city');
        $county = filter_input(INPUT_POST, 'county');
        $eircode = filter_input(INPUT_POST, 'eircode');
        $phone = filter_input(INPUT_POST, 'phone');

        if (empty($line1) || empty($city) || empty($county) || empty($eircode)) {
            member_error('All address fields are required.');
        }

        disable_or_delete_address($address_id);
        $new_address_id = add_address($member_id, $line1, '', $city, $county, $eircode, $phone);

        if ($address_type == 'billing') {
            member_change_billing_id($member_id, $new_address_id);
        } else {
            member_change_shipping_id($member_id, $new_address_id);
        }

        $_SESSION['user'] = get_member($member_id);
        redirect('.');
        break;

// In member/index.php
    case 'view_order':
        if (!isset($_SESSION['user'])) {
            redirect('.');
            break;
        }

        $order_id = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
        if (!$order_id) {
            member_error('Invalid order ID.');
        }

        $order = get_order($order_id);

        // Security check: Make sure the logged-in user owns this order
        if (!$order || $order['memberID'] != $_SESSION['user']['memberID']) {
            member_error('You do not have permission to view this order.');
        }

        // --- FIX STARTS HERE ---
        // Prepare all variables for the view
        $order_date = date('M j, Y', strtotime($order['orderDate']));
        $order_items = get_order_items($order_id);

        // Safely get shipping address details
        $shipping_address = get_address($order['shipAddressID']);
        $ship_line1 = $shipping_address['line1'] ?? 'N/A';
        $ship_line2 = $shipping_address['line2'] ?? '';
        $ship_city = $shipping_address['city'] ?? '';
        $ship_county = $shipping_address['county'] ?? '';
        $ship_eircode = $shipping_address['eircode'] ?? '';
        $ship_phone = $shipping_address['phone'] ?? '';

        // Safely get billing address details
        $billing_address = get_address($order['billingAddressID']);
        $bill_line1 = $billing_address['line1'] ?? 'N/A';
        $bill_line2 = $billing_address['line2'] ?? '';
        $bill_city = $billing_address['city'] ?? '';
        $bill_county = $billing_address['county'] ?? '';
        $bill_eircode = $billing_address['eircode'] ?? '';
        $bill_phone = $billing_address['phone'] ?? '';
        // --- FIX ENDS HERE ---

        include 'member_orders.php';
        break;
    case 'logout':
        unset($_SESSION['user']);
        redirect('.');
        break;

    default:
        display_error("Unknown member action: " . htmlspecialchars($action));
        break;
}
?>