<?php

require_once('../utility/main.php');
require_once('../utility/secure.php');
require_once('../utility/validation.php');
require_once('../model/cart.php');
require_once('../model/order_lib.php');
require_once('../model/member_lib.php');
require_once('../model/address_lib.php');

// Force user to be logged in to access checkout
if (!isset($_SESSION['user'])) {
    $_SESSION['checkout'] = true;
    redirect('../member');
    exit();
}

$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'confirm';

switch ($action) {
    case 'confirm':
        if (cart_item_count() == 0) {
            redirect('../cart');
            break;
        }

        // Get cart items for the view
        $cart = cart_get_items();

        // Safely get and check for a shipping address
        $shipping_address = get_address($_SESSION['user']['shipAddressID']);
        if ($shipping_address === false) {
            member_error("Please set a shipping address for your account before checking out.");
        }

        $subtotal = cart_subtotal();
        $shipping_cost = shipping_cost();
        $tax = tax_amount($subtotal);
        $total = $subtotal + $tax + $shipping_cost;

        include 'checkout_confirm.php';
        break;

    case 'payment':
        if (cart_item_count() == 0) {
            redirect('../cart');
            break;
        }

        $billing_address = get_address($_SESSION['user']['billingAddressID']);
        if ($billing_address === false) {
            member_error("Please set a billing address for your account before checking out.");
        }

        // Prepare variables for the view using Irish format
        $bill_line1 = $billing_address['line1'];
        $bill_line2 = $billing_address['line2'];
        $bill_city = $billing_address['city'];
        $bill_county = $billing_address['county'];
        $bill_eircode = $billing_address['eircode'];
        $bill_phone = $billing_address['phone'];

        include 'checkout_payment.php';
        break;

    case 'process':
        if (cart_item_count() == 0) {
            redirect('../cart');
            break;
        }

        // --- Full card validation logic ---
        $card_type = filter_input(INPUT_POST, 'card_type', FILTER_VALIDATE_INT);
        $card_number = filter_input(INPUT_POST, 'card_number');
        $card_cvv = filter_input(INPUT_POST, 'card_cvv');
        $card_expires = filter_input(INPUT_POST, 'card_expires');

        if (!is_valid_card_type($card_type) || !is_valid_card_number($card_number, $card_type) || !is_valid_card_cvv($card_cvv, $card_type) || !is_valid_card_expires($card_expires)) {
            member_error('Invalid credit card information. Please check all fields.');
        }
        // --- End of validation ---

        global $db;
        try {
            $db->beginTransaction();

            // 1. Check if items are in stock before processing
            $cart = cart_get_items();
            foreach ($cart as $product_id => $item) {
                $product = get_product($product_id); // Assumes get_product fetches stock level
                if ($product['stock'] < $item['quantity']) {
                    member_error('Sorry, ' . htmlspecialchars($item['name']) . ' is out of stock. Please update your cart.');
                }
            }

            // 2. Add the main order record
            $order_id = add_order($card_type, $card_number, $card_cvv, $card_expires);

            // 3. Add each item from the cart to the order
            foreach ($cart as $product_id => $item) {
                add_order_item($order_id, $product_id,
                        $item['list_price'], $item['discount_amount'], $item['quantity']);
            }

            // 4. Decrease the stock for each item
            foreach ($cart as $product_id => $item) {
                decrease_product_stock($product_id, $item['quantity']);
            }

            // 5. If everything was successful, commit the transaction
            $db->commit();

            clear_cart();
            redirect('../member?action=view_order&order_id=' . $order_id);
        } catch (Exception $e) {
            $db->rollBack();
            display_db_error($e->getMessage());
        }
        break;
    default:
        member_error('Unknown checkout action: ' . htmlspecialchars($action));
        break;
}
?>