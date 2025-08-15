<?php
require_once('utility/main.php');
require_once('model/product_lib.php');

$search_query = filter_input(INPUT_GET, 'query');
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);

// Case 1: User selected a category but didn't type anything.
// Redirect them to that category's main page.
if (empty($search_query) && $category_id > 0) {
    header('Location: ' . $app_path . 'catalog/?category_id=' . $category_id);
    exit();
}

// Case 2: User didn't type anything or select a category.
// Send them back to the homepage.
if (empty($search_query)) {
    redirect('.');
}

// Case 3: A search was performed.
// Get the matching products from the database.
$products = search_products($search_query, $category_id);

// Display the results using your existing view file.
include 'show_products.php';
?>