<?php include '../../view/header_admin.php'; ?>

<div class="row">
    <div class="col">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'admin/'; ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'admin/product/'; ?>">Products</a></li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars($product['productName']); ?></li>
        </ol>
    </div>
</div>

<!-- Page Header with Product Name and Action Buttons -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0"><?php echo htmlspecialchars($product['productName']); ?></h2>
    <div>
        <!-- Modify Button -->
        <form action="." method="post" class="d-inline">
            <input type="hidden" name="action" value="show_add_edit_form">
            <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
            <button type="submit" class="btn btn-warning">
                <i class="fa fa-edit"></i> Modify
            </button>
        </form>
        <!-- Deactivate/Reactivate Buttons -->
        <?php if ($product['is_active']) : ?>
            <form action="." method="post" class="d-inline">
                <input type="hidden" name="action" value="deactivate_product">
                <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                <input type="hidden" name="category_id" value="<?php echo $product['categoryID']; ?>">
                <button type="submit" class="btn btn-secondary">
                    <i class="fa fa-archive"></i> Deactivate
                </button>
            </form>
        <?php else: ?>
            <form action="." method="post" class="d-inline">
                <input type="hidden" name="action" value="reactivate_product">
                <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                <input type="hidden" name="category_id" value="<?php echo $product['categoryID']; ?>">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-undo"></i> Reactivate
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>

<hr>

<div class="row">
    <!-- Left Column: Product Details -->
    <div class="col-md-8">
        <h4>Product Details</h4>
        <p>
            <strong>Product Code:</strong> <?php echo htmlspecialchars($product['productCode']); ?><br>
            <strong>Category:</strong> <?php echo htmlspecialchars($product['categoryName']); ?><br>
            <strong>List Price:</strong> <?php echo sprintf('€%.2f', $product['listPrice']); ?><br>
            <strong>Discount:</strong> <?php echo $product['discountPercent']; ?>%<br>
            <!-- NEW: Display the stock level -->
            <strong>Stock Quantity:</strong> <?php echo $product['stock']; ?><br>
        </p>
        <h5>Description</h5>
        <div><?php echo nl2br(htmlspecialchars($product['description'])); ?></div>
    </div>

    <!-- Right Column: Image Manager -->
    <div class="col-md-4">
        <h4>Image Manager</h4>
        <div class="mb-3">
            <img src="<?php echo $app_path . 'images/' . $product['productCode'] . '_m.png'; ?>"
                 alt="Medium product image" class="img-fluid rounded shadow-sm">
        </div>
        <form action="." method="post" enctype="multipart/form-data" id="upload_image_form">
            <input type="hidden" name="action" value="upload_image">
            <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
            <div class="mb-3">
                <label for="file1" class="form-label">Upload New Image:</label>
                <input class="form-control" type="file" id="file1" name="file1">
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-upload"></i> Upload
            </button>
        </form>
    </div>
</div>

<?php include '../../view/footer.php'; ?>
