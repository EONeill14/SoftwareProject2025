<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin Panel - TeeTime Golf Shop</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $app_path ?>public/css/All_Styles.css" />
    </head>
    <body>

        <?php
        $dashboard_url = $app_path . 'admin/';
        $products_url = $app_path . 'admin/product/';
        $orders_url = $app_path . 'admin/orders/';
        $categories_url = $app_path . 'admin/category/';
        $reports_url = $app_path . 'admin/reports/'; // New URL for reports
        $account_url = $app_path . 'admin/users/';
        $logout_url = $account_url . '?action=logout';
        ?>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo $dashboard_url; ?>">TeeTime Admin</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="adminNavbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="<?php echo $products_url; ?>">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $orders_url; ?>">Orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo $categories_url; ?>">Categories</a></li>
                        <!-- NEW: Reports Link Added -->
                        <li class="nav-item"><a class="nav-link" href="<?php echo $reports_url; ?>">Reports</a></li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php if (isset($_SESSION['admin'])) : ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <span class="fa fa-user"></span> Hi, <?php echo htmlspecialchars($_SESSION['admin']['fName']); ?>!
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="<?php echo $account_url; ?>">Manage Accounts</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="<?php echo $logout_url; ?>"><span class="fa fa-sign-out"></span> Logout</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="<?php echo $account_url; ?>"><span class="fa fa-sign-in"></span> Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container mt-4">
