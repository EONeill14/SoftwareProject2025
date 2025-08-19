<?php

/**
 * Adds an item to the cart in the session.
 */
function cart_add_item($product_id, $quantity) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $_SESSION['cart'][(int) $product_id] = (int) $quantity;
}

/**
 * Updates an item's quantity in the cart.
 */
function cart_update_item($product_id, $quantity) {
    $quantity = (int) $quantity;
    if (isset($_SESSION['cart'][$product_id])) {
        if ($quantity <= 0) {
            cart_remove_item($product_id); // Remove if quantity is 0 or less
        } else {
            $_SESSION['cart'][$product_id] = $quantity;
        }
    }
}

/**
 * Removes an item from the cart.
 */
function cart_remove_item($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

/**
 * Gets the total number of all items in the cart.
 * This function is extremely fast and does NOT access the database.
 */
function cart_item_count() {
    // FIX: Safely handles an empty cart for new visitors.
    if (empty($_SESSION['cart'])) {
        return 0;
    }
    return array_sum($_SESSION['cart']);
}

/**
 * Gets the number of unique products in the cart.
 */
function cart_product_count() {
    // FIX: Safely handles an empty cart.
    if (empty($_SESSION['cart'])) {
        return 0;
    }
    return count($_SESSION['cart']);
}

/**
 * Gets a detailed array of items for the cart, fetching all product data in a single query.
 */
function cart_get_items() {
    if (empty($_SESSION['cart'])) {
        return [];
    }

    global $db;

    $product_ids = array_keys($_SESSION['cart']);
    $placeholders = implode(',', array_fill(0, count($product_ids), '?'));

    $query = "SELECT * FROM products WHERE productID IN ($placeholders)";

    try {
        $statement = $db->prepare($query);
        $statement->execute($product_ids);
        $products = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
        return [];
    }

    $items = [];
    foreach ($products as $product) {
        $product_id = $product['productID'];
        $quantity = $_SESSION['cart'][$product_id];

        $discount_amount = round($product['listPrice'] * ($product['discountPercent'] / 100.0), 2);
        $unit_price = $product['listPrice'] - $discount_amount;

        $items[$product_id] = [
            'name' => $product['productName'],
            'list_price' => $product['listPrice'],
            'discount_amount' => $discount_amount,
            'quantity' => $quantity,
            'unit_price' => $unit_price,
            'line_price' => $unit_price * $quantity
        ];
    }
    return $items;
}

/**
 * Gets the subtotal for the cart.
 */
function cart_subtotal() {
    $subtotal = 0;
    $items = cart_get_items();
    foreach ($items as $item) {
        $subtotal += $item['line_price'];
    }
    return $subtotal;
}

/**
 * Removes all items from the cart.
 */
function clear_cart() {
    $_SESSION['cart'] = [];
}

?>
