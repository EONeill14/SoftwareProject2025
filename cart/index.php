<?php
require_once '../utility/main.php';
require_once '../model/cart.php';
require_once '../model/product_lib.php';

// Get the action, defaulting to 'view'
$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'view';

switch ($action) {
    case 'view':
        $cart = cart_get_items();
        include './cart_view.php';
        break;

    case 'add':
        // FIX: Read product_id and quantity from $_POST
        $product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

        // Basic validation
        if ($product_id === false || $quantity === false || $quantity <= 0) {
            member_error('Invalid product data. Please try again.');
            break;
        }

        cart_add_item($product_id, $quantity);
        // Redirect to the cart view page to prevent re-submission on refresh
        redirect('.');
        break;

    case 'update':
        $items = filter_input(INPUT_POST, 'items', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        if ($items) {
            foreach ($items as $product_id => $quantity) {
                if ((int)$quantity <= 0) {
                    cart_remove_item($product_id);
                } else {
                    cart_update_item($product_id, $quantity);
                }
            }
        }
        // Redirect back to the cart view
        redirect('.');
        break;
        
    default:
        member_error("Unknown cart action: " . htmlspecialchars($action));
        break;
}