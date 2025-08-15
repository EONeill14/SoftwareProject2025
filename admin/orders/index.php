<?php
/**
 * Controller for the admin order management area.
 */

// Define the project root if not already defined
if (!defined('PROJECT_ROOT')) {
    define('PROJECT_ROOT', dirname(__DIR__, 2));
}

// Require necessary setup and model files
require_once(PROJECT_ROOT . '/utility/main.php');
require_once(PROJECT_ROOT . '/utility/secure.php');
require_once(PROJECT_ROOT . '/utility/check_admin.php');
require_once(PROJECT_ROOT . '/model/order_lib.php');
require_once(PROJECT_ROOT . '/model/member_lib.php');
require_once(PROJECT_ROOT . '/model/address_lib.php');
require_once(PROJECT_ROOT . '/model/product_lib.php');

// Get the action to perform, with a safe default
$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_orders';

switch ($action) {
    case 'list_orders':
        $new_orders = outstanding_orders();
        $old_orders = shipped_orders();
        include('order_status.php');
        break;

    case 'view_order':
        $order_id = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
        if (!$order_id) {
            display_error("Invalid order ID.");
        }
        
        $order = get_order($order_id);
        if (!$order) {
            display_error("The selected order does not exist.");
        }

        $order_date = date('M j, Y', strtotime($order['orderDate']));
        $member = get_member($order['memberID']);
        $order_items = get_order_items($order_id);

        // --- FIX: Prepare ALL variables for the view ---
        $name = $member['fName'] . ' ' . $member['lName'];
        $email = $member['memberEmail'];
        
        // Safely get shipping address details
        // FIX: The shipping address ID should come from the member's record, not the order.
        $shipping_address = get_address($member['shipAddressID']);
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
        
        // Prepare card details
        $card_number = $order['cardNumber'];
        $card_expires = $order['cardExpires'];
        $card_name = card_name($order['cardType']);

        include('order.php');
        break;

    case 'set_ship_date':
        $order_id = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
        if ($order_id) {
            set_ship_date($order_id);
        }
        redirect('?action=view_order&order_id=' . $order_id);
        break;

    case 'confirm_delete':
        $order_id = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
        if (!$order_id) {
            display_error("Invalid order ID.");
        }
        $order = get_order($order_id);
        // Prepare variables needed by the delete confirmation view
        $member = get_member($order['memberID']);
        $name = $member['fName'] . ' ' . $member['lName'];
        $email = $member['memberEmail'];
        include 'order_delete.php';
        break;

    case 'delete':
        $order_id = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);
        if ($order_id) {
            delete_order($order_id);
        }
        redirect('.');
        break;

    default:
        display_error('Unknown order action: ' . htmlspecialchars($action));
        break;
}
?>
