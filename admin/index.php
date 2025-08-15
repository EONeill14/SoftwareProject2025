<?php
// Main entry point for the admin section
require_once('../utility/main.php');
require_once('../utility/secure.php');
require_once('../utility/check_admin.php'); // Security check is crucial

// Include the modern admin header
include '../view/header_admin.php'; 
?>

<div class="row">
    <div class="col">
        <h1 class="mb-4">Admin Menu</h1>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="fa fa-shopping-bag fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Manage Products</h5>
                <p class="card-text">Add, edit, and deactivate products in your store's catalog.</p>
                <a href="<?php echo $app_path . 'admin/product/'; ?>" class="btn btn-primary">Go to Products</a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="fa fa-truck fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Manage Orders</h5>
                <p class="card-text">View customer orders, update shipping status, and manage sales.</p>
                <a href="<?php echo $app_path . 'admin/orders/'; ?>" class="btn btn-primary">Go to Orders</a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="fa fa-list-alt fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Manage Categories</h5>
                <p class="card-text">Organize your products by adding or editing store categories.</p>
                <a href="<?php echo $app_path . 'admin/category/'; ?>" class="btn btn-primary">Go to Categories</a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <i class="fa fa-users fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Manage Admins</h5>
                <p class="card-text">Add or edit administrator accounts for this control panel.</p>
                <a href="<?php echo $app_path . 'admin/users/'; ?>" class="btn btn-primary">Go to Admins</a>
            </div>
        </div>
    </div>
</div>

<?php 
// Include the standard footer
include '../view/footer.php'; 
?>