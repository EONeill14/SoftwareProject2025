<?php
require_once('../../utility/main.php');
require_once('../../utility/secure.php');
require_once('../../utility/check_admin.php');
require_once('../../model/order_lib.php');

// Get the action to perform, with a safe default
$action = filter_input(INPUT_GET, 'action') ?? 'view_reports';

switch ($action) {
    case 'view_reports':
        // Get data for all on-screen reports
        $top_products = get_top_selling_products(10);
        $sales_by_category = get_sales_by_category();
        $sales_summary = get_sales_summary();
        
        // Display the main report page
        include 'report_view.php';
        break;

    case 'export_top_products':
        $data = get_top_selling_products(100); // Get all products for the export
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="top_selling_products.csv"');
        
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Rank', 'Product Name', 'Total Units Sold']); // Header row
        
        foreach ($data as $index => $row) {
            fputcsv($output, [$index + 1, $row['productName'], $row['total_sold']]);
        }
        
        fclose($output);
        exit(); // Stop the script after download

    case 'export_sales_by_category':
        $data = get_sales_by_category();
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="sales_by_category.csv"');
        
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Category', 'Units Sold', 'Total Sales (€)']); // Header row
        
        foreach ($data as $row) {
            fputcsv($output, [$row['categoryName'], $row['units_sold'], $row['category_total']]);
        }
        
        fclose($output);
        exit();

    default:
        display_error('Unknown report action: ' . htmlspecialchars($action));
        break;
}
?>
