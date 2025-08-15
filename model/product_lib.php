<?php

// ADMIN-FACING: Shows all products for management.
// Fetches the 'orderCount' to prevent N+1 queries in the view.
function get_products_by_category($category_id, $offset, $rowperpage) {
    global $db;
    $query = "
        SELECT p.*, c.categoryName, COUNT(oi.orderID) AS orderCount
        FROM products AS p
        INNER JOIN categories AS c ON p.categoryID = c.categoryID
        LEFT JOIN orderItems AS oi ON p.productID = oi.productID
        WHERE p.categoryID = :category_id
        GROUP BY p.productID
        ORDER BY p.productName
        LIMIT :limit OFFSET :offset";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);
        $statement->bindValue(':limit', (int) $rowperpage, PDO::PARAM_INT);
        $statement->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

// CUSTOMER-FACING: Only shows active products for a category.
function get_products_by_category_member($category_id) {
    global $db;
    $query = "
        SELECT *
        FROM products p
        INNER JOIN categories c ON p.categoryID = c.categoryID
        WHERE p.categoryID = :category_id AND p.is_active = 1";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function get_product_count($category_id) {
    global $db;
    $query = "
        SELECT COUNT(*) AS total_product_records
        FROM products p
        INNER JOIN categories c ON p.categoryID = c.categoryID
        WHERE p.categoryID = :category_id";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $result = $statement->fetch();
        $total_product_records = $result['total_product_records'];
        $statement->closeCursor();
        return $total_product_records;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function first_category() {
    global $db;
    $query = "
        SELECT MIN(categoryID) AS first_category
        FROM categories";
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetch();
        $first_category = $result['first_category'];
        $statement->closeCursor();
        return $first_category;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

// CUSTOMER-FACING: Gets a single product, but only if it's active.
function get_product($product_id) {
    global $db;
    $query = '
        SELECT *
        FROM products p
        INNER JOIN categories c ON p.categoryID = c.categoryID
        WHERE productID = :product_id AND p.is_active = 1';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function get_product_order_count($product_id) {
    global $db;
    $query = '
        SELECT COUNT(*) AS orderCount
        FROM orderItems
        WHERE productID = :product_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $product = $statement->fetch();
        $order_count = $product['orderCount'];
        $statement->closeCursor();
        return $order_count;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

// In model/product_lib.php

function is_duplicate_product_code($product_code) {
    global $db;
    $query = 'SELECT productID FROM products WHERE productCode = :product_code';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_code', $product_code);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();

    // If a row was found, it's a duplicate
    return ($result !== false);
}

function add_product($category_id, $code, $name, $description,
        $price, $discount_percent, $featured, $stock) { // Add $stock here
    global $db;
    $featured = !empty($featured) ? 1 : 0;

    // Add 'stock' to the query
    $query = 'INSERT INTO products
                 (categoryID, productCode, productName, description, listPrice,
                  discountPercent, dateAdded, featured, stock)
              VALUES
                 (:category_id, :code, :name, :description, :price,
                  :discount_percent, NOW(), :featured, :stock)'; // Add :stock here
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':code', $code);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':discount_percent', $discount_percent);
        $statement->bindValue(':featured', $featured);
        $statement->bindValue(':stock', $stock); // Bind the new value
        $statement->execute();
        $statement->closeCursor();
        return $db->lastInsertId();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function update_product($product_id, $code, $name, $desc,
        $price, $discount, $category_id, $featured, $stock) { // 1. Add $stock here
    global $db;
    $featured = !empty($featured) ? 1 : 0;
    $query = '
        UPDATE products
        SET productName = :name,
            productCode = :code,
            description = :desc,
            listPrice = :price,
            discountPercent = :discount,
            categoryID = :category_id,
            featured = :featured,
            stock = :stock  -- 2. Add this line to the query
        WHERE productID = :product_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':code', $code);
        $statement->bindValue(':desc', $desc);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':discount', $discount);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':product_id', $product_id);
        $statement->bindValue(':featured', $featured);
        $statement->bindValue(':stock', $stock); // 3. Bind the new value
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

// "Soft deletes" a product by marking it as inactive.
function deactivate_product($product_id) {
    global $db;
    $query = 'UPDATE products SET is_active = 0 WHERE productID = :product_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

// Brings an archived product back to the store.
function reactivate_product($product_id) {
    global $db;
    $query = 'UPDATE products SET is_active = 1 WHERE productID = :product_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

// CUSTOMER-FACING: Only show active featured products.
function get_featured_product() {
    global $db;
    $query = '
        SELECT *
        FROM products p
        WHERE featured = 1 AND is_active = 1';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function permanently_delete_product($product_id) {
    global $db;
    // This should only be called if the product has no orders.
    $query = 'DELETE FROM products WHERE productID = :product_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function get_admin_product($product_id) {
    global $db;
    $query = '
        SELECT *
        FROM products p
        INNER JOIN categories c ON p.categoryID = c.categoryID
        WHERE productID = :product_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function decrease_product_stock($product_id, $quantity_to_remove) {
    global $db;
    $query = 'UPDATE products SET stock = stock - :quantity
              WHERE productID = :product_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':quantity', $quantity_to_remove);
    $statement->bindValue(':product_id', $product_id);
    $statement->execute();
    $statement->closeCursor();
}

?>