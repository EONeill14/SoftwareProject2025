<?php

require_once('../../utility/main.php');
require_once('../../utility/secure.php');
require_once('../../utility/check_admin.php');
require_once('../../utility/images.php');
require_once('../../model/product_lib.php');
require_once('../../model/category_lib.php');

// Get the action to perform
$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_products';

switch ($action) {
    case 'list_products':
        $category_id = (int) filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT) ?: 1;
        $rowperpage = (int) filter_input(INPUT_GET, 'rowperpage', FILTER_VALIDATE_INT) ?: 10;
        $page = (int) filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT) ?: 1;
        $offset = ($page - 1) * $rowperpage;

        $current_category = get_category($category_id);
        $categories = get_categories();
        $products_records = get_product_count($category_id);
        $products = get_products_by_category($category_id, $offset, $rowperpage);

        include('product_list.php');
        break;

    case 'deactivate_product':
        $product_id = (int) filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
        $category_id = (int) filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        if ($product_id) {
            deactivate_product($product_id);
        }
        header("Location: .?category_id=$category_id");
        break;

    case 'reactivate_product':
        $product_id = (int) filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
        $category_id = (int) filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        if ($product_id) {
            reactivate_product($product_id);
        }
        header("Location: .?category_id=$category_id");
        break;

    case 'view_product':
        $product_id = (int) filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);
        $product = get_admin_product($product_id);
        if (!$product) {
            display_error("The selected product does not exist.");
            break;
        }
        $product_order_count = get_product_order_count($product_id);
        include('product_view.php');
        break;

    case 'show_add_edit_form':
        $product_id = (int) filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);
        if ($product_id) {
            $product = get_admin_product($product_id);
        } else {
            $product = [];
        }
        $categories = get_categories();
        include('product_add_edit.php');
        break;

    case 'add_product':
        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $code = filter_input(INPUT_POST, 'code');
        $name = filter_input(INPUT_POST, 'name');
        $description = filter_input(INPUT_POST, 'description');
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $discount_percent = filter_input(INPUT_POST, 'discount_percent', FILTER_VALIDATE_FLOAT);
        $featured = isset($_POST['featured']);
        $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT); // Add this line

        if (empty($code) || empty($name) || $price === false) {
            display_error('Invalid product data.');
        } elseif (is_duplicate_product_code($code)) {
            display_error('The product code "' . htmlspecialchars($code) . '" already exists.');
        } else {
            // Pass the new $stock variable to the function
            add_product($category_id, $code, $name, $description, $price, $discount_percent, $featured, $stock);
            header("Location: .?category_id=$category_id");
        }
        break;
    case 'update_product':
        $product_id = (int) filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
        $category_id = (int) filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        $code = filter_input(INPUT_POST, 'code');
        $name = filter_input(INPUT_POST, 'name');
        $description = filter_input(INPUT_POST, 'description');
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $discount_percent = filter_input(INPUT_POST, 'discount_percent', FILTER_VALIDATE_FLOAT);
        $featured = isset($_POST['featured']);
        $stock = filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT); // Add this line

        if (empty($code) || empty($name) || empty($description) || $price === false) {
            display_error('Invalid product data. Check all fields and try again.');
        } else {
            // Pass the new $stock variable to the function
            update_product($product_id, $code, $name, $description, $price, $discount_percent, $category_id, $featured, $stock);
            header("Location: .?category_id=$category_id");
        }
        break;
    case 'upload_image':
        $product_id = (int) filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
        $product = get_product($product_id); // You might need an get_admin_product() here
        $product_code = $product['productCode'];

        $image_filename = $product_code . '.png';
        $image_dir = $doc_root . $app_path . 'images/';

        if (isset($_FILES['file1'])) {
            $source = $_FILES['file1']['tmp_name'];
            $target = $image_dir . DIRECTORY_SEPARATOR . $image_filename;
            move_uploaded_file($source, $target);
            process_image($image_dir, $image_filename);

            // Redirect back to the product view page to prevent form resubmission
            header("Location: .?action=view_product&product_id=$product_id");
        }
        break;

    // FIX: Moved this case before the 'default'
    case 'permanently_delete':
        $product_id = (int) filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
        $category_id = (int) filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
        if ($product_id && get_product_order_count($product_id) == 0) {
            permanently_delete_product($product_id);
        }
        header("Location: .?category_id=$category_id");
        break;

    // FIX: Only one 'default' case is allowed at the end of the switch
    default:
        display_error("Unknown product action: " . htmlspecialchars($action));
        break;
}
?>