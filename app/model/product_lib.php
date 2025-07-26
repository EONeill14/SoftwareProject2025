<?php

function get_products_by_category($category_id, $offset, $rowperpage) {
    global $db;
    $query = "SELECT * FROM products p INNSER JOIN categories c ON p.categoryID = c.categoryID WHERE p.categor = :category_id LIMIT $offset, $rowperpage";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
