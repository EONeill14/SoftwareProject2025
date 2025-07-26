<?php

require_once('utility/images.php');
require_once('model/product_lib.php');

else {
    $action = 'list_products';
}

$action = strtolower($action);
switch ($action) {
    case 'list_products':
        //get categories and products
        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
        } else {
            $category_id = 1;
        }
}

if (isset($_POST['num_rows'])) {
    $rowperpage = $_POST['num_rows'];
} else {
    $rowperpage = 10;
}
if (isset($_GET['rowperpage'])) {
    $rowperpage = $_GET['rowperpage'];
}

if(isset($_GET['page'])) {
    $page=$_GET['page'];
}
else{
    $page=1;
}
$offset=($page -1) *$rowperpage;

$current_category = get_category($category_id);
$categories = get_categories();
//the get_product_count function is called to get number of products by category for pagination
$products_records =get_product_count($category_id);
$products =get_products_by_category($category_id, $offset, $rowperpage);

//display products list
include('product_list.php');
break;