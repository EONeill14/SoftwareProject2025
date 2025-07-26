<?php

function get_categories() {
    global $db;
    $query = 'SELECT *, (SELECT COUNT(*) FROM products WHERE products.categoryID = categories.categoryID) AS productCount FROM categories ORDER BY categoryID';

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_category($category_id) {
    global $db;
    $query = 'DELETE FROM categories WHERE categoryID= :category_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->execute();
        $statement->closecursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function add_category($name) {
    global $db;
    $query = 'INSERT INTO categories (categoryName) VALUES (:name)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->execute();
        $statement->closeCursor();
        //Get the last categoryID
        $category_id = $db->lastInsertID();
        return $category_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
