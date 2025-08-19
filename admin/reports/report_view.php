<?php include '../../view/header_admin.php'; ?>

<div class="row">
    <div class="col">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'admin/'; ?>">Home</a></li>
            <li class="breadcrumb-item active">Reports</li>
        </ol>
        <h1 class="mb-4">Sales Reports</h1>
    </div>
</div>

<!-- NEW: Sales Summary Cards -->
<div class="row mb-4">
    <div class="col-md-6 col-lg-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Revenue</h5>
                <p class="card-text fs-4 fw-bold">
                    <?php echo '€' . number_format($sales_summary['grand_total'] ?? 0, 2); ?>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Total Orders</h5>
                <p class="card-text fs-4 fw-bold">
                    <?php echo $sales_summary['total_orders'] ?? 0; ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Sales by Category Report -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header"><h3 class="mb-0">Sales by Category <a href="?action=export_sales_by_category" class="btn btn-sm btn-success">
                            <i class="fa fa-download"></i> Export
                        </a></h3></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Category</th>
                                <th class="text-end">Total Sales</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sales_by_category as $row) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['categoryName']); ?></td>
                                    <td class="text-end"><?php echo '€' . number_format($row['category_total'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Selling Products Report -->
    <div class="col-lg-6 mb-4">
        <div class="card h-100">
            <div class="card-header"><h3 class="mb-0">Top 10 Selling Products <a href="?action=export_top_products" class="btn btn-sm btn-success">
                            <i class="fa fa-download"></i> Export
                        </a></h3></div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Product</th>
                                <th class="text-center">Units Sold</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($top_products as $product) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($product['productName']); ?></td>
                                    <td class="text-center"><?php echo $product['total_sold']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../view/footer.php'; ?>
