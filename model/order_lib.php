<?php

/**
 * Calculates a shipping charge of €5 per item, capped at 5 items.
 * @return int The total shipping cost.
 */
function shipping_cost() {
    $item_count = cart_item_count();
    $item_shipping = 5;  // €5 per item
    // A simpler way to calculate the cost, capped at €25.
    return min($item_count, 5) * $item_shipping;
}

/**
 * Calculates sales tax (VAT) for an order.
 * Assumes a standard 23% VAT rate for Irish addresses.
 * @param float $subtotal The order subtotal.
 * @return float The calculated tax amount.
 */
function tax_amount($subtotal) {
    $shipping_address = get_address($_SESSION['user']['shipAddressID']);
    if ($shipping_address === false) {
        return 0; // No address, no tax.
    }
    
    // Assuming all sales are within Ireland for a 23% VAT rate
    $vat_rate = 0.23;
    
    return round($subtotal * $vat_rate, 2);
}

/**
 * Gets the string name for a card type ID.
 * @param int $card_type The ID of the card type.
 * @return string The name of the card.
 */
function card_name($card_type) {
    switch($card_type){
        case 1: return 'MasterCard';
        case 2: return 'Visa';
        case 3: return 'Discover';
        case 4: return 'American Express';
        default: return 'Unknown Card Type';
    }
}

/**
 * Adds the main order record to the database.
 * @return int The ID of the newly created order.
 */
function add_order($card_type, $card_number, $card_cvv, $card_expires) {
    global $db;
    $member_id = $_SESSION['user']['memberID'];
    $billing_id = $_SESSION['user']['billingAddressID'];
    $shipping_id = $_SESSION['user']['shipAddressID'];
    $shipping_cost = shipping_cost();
    $tax = tax_amount(cart_subtotal());
    $order_date = date("Y-m-d H:i:s");

    $query = 'INSERT INTO orders (memberID, orderDate, shipAmount, taxAmount,
                                  shipAddressID, cardType, cardNumber,
                                  cardExpires, billingAddressID)
              VALUES (:member_id, :order_date, :ship_amount, :tax_amount,
                      :shipping_id, :card_type, :card_number,
                      :card_expires, :billing_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':member_id', $member_id);
    $statement->bindValue(':order_date', $order_date);
    $statement->bindValue(':ship_amount', $shipping_cost);
    $statement->bindValue(':tax_amount', $tax);
    $statement->bindValue(':shipping_id', $shipping_id);
    $statement->bindValue(':card_type', $card_type);
    $statement->bindValue(':card_number', $card_number);
    $statement->bindValue(':card_expires', $card_expires);
    $statement->bindValue(':billing_id', $billing_id);
    $statement->execute();
    $order_id = $db->lastInsertId();
    $statement->closeCursor();
    return $order_id;
}

/**
 * Adds a single item to an order.
 */
function add_order_item($order_id, $product_id, $item_price, $discount, $quantity) {
    global $db;
    $query = 'INSERT INTO orderItems (orderID, productID, itemPrice, discountAmount, quantity)
              VALUES (:order_id, :product_id, :item_price, :discount, :quantity)';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->bindValue(':product_id', $product_id);
    $statement->bindValue(':item_price', $item_price);
    $statement->bindValue(':discount', $discount);
    $statement->bindValue(':quantity', $quantity);
    $statement->execute();
    $statement->closeCursor();
}

/**
 * Gets a single order's details.
 */
function get_order($order_id) {
    global $db;
    $query = 'SELECT * FROM orders WHERE orderID = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $order = $statement->fetch();
    $statement->closeCursor();
    return $order;
}

/**
 * Gets all items for an order, including product details, in one query.
 */
function get_order_items($order_id) {
    global $db;
    // PERFORMANCE FIX: Use a JOIN to get product names in one query.
    $query = 'SELECT oi.*, p.productName
              FROM orderItems as oi
              JOIN products as p ON oi.productID = p.productID
              WHERE oi.orderID = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $order_items = $statement->fetchAll();
    $statement->closeCursor();
    return $order_items;
}

/**
 * Gets all orders for a specific member.
 */
function get_orders_by_member_id($member_id) {
    global $db;
    $query = 'SELECT * FROM orders WHERE memberID = :member_id ORDER BY orderDate DESC';
    $statement = $db->prepare($query);
    $statement->bindValue(':member_id', $member_id);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    return $orders;
}

/**
 * Gets all outstanding (unshipped) orders.
 */
function outstanding_orders() {
    global $db;
    $query = 'SELECT * FROM orders
              INNER JOIN members ON members.memberID = orders.memberID
              WHERE shipDate IS NULL ORDER BY orderDate';
    $statement = $db->prepare($query);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    return $orders;
}

/**
 * Gets all shipped orders.
 */
function shipped_orders() {
    global $db;
    $query = 'SELECT * FROM orders
              INNER JOIN members ON members.memberID = orders.memberID
              WHERE shipDate IS NOT NULL ORDER BY orderDate DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    return $orders;
}

/**
 * Sets the ship date for an order to the current time.
 */
function set_ship_date($order_id) {
    global $db;
    $ship_date = date("Y-m-d H:i:s");
    $query = 'UPDATE orders SET shipDate = :ship_date WHERE orderID = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':ship_date', $ship_date);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $statement->closeCursor();
}

/**
 * Deletes an order and its items within a database transaction for safety.
 */
function delete_order($order_id) {
    global $db;
    // DATA INTEGRITY FIX: Wrap deletions in a transaction.
    try {
        $db->beginTransaction();

        // 1. Delete ordered items
        $query1 = 'DELETE FROM orderItems WHERE orderID = :order_id';
        $statement1 = $db->prepare($query1);
        $statement1->bindValue(':order_id', $order_id);
        $statement1->execute();
        $statement1->closeCursor();

        // 2. Delete the main order
        $query2 = 'DELETE FROM orders WHERE orderID = :order_id';
        $statement2 = $db->prepare($query2);
        $statement2->bindValue(':order_id', $order_id);
        $statement2->execute();
        $statement2->closeCursor();

        $db->commit();
    } catch (Exception $e) {
        $db->rollBack();
        display_db_error($e->getMessage());
    }
}
?>