<?php include '../../view/header_admin.php'; ?>

<?php
// Use !empty() to correctly check if we are editing an existing product
if (!empty($product_id)) {
    $heading_text = 'Edit Product';
} else {
    $heading_text = 'Add Product';
}
?>

<div class="row">
    <!-- Main Form Column -->
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'admin/'; ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'admin/product/'; ?>">Products</a></li>
            <li class="breadcrumb-item active"><?php echo $heading_text; ?></li>
        </ol>

        <form action="." method="post" id="add_edit_product_form">
            
            <?php if (!empty($product_id)) : ?>
                <input type="hidden" name="action" value="update_product">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
            <?php else : ?>
                <input type="hidden" name="action" value="add_product">
            <?php endif; ?>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    <?php foreach ($categories as $category) : ?>
                        <?php $selected = ($category['categoryID'] == ($product['categoryID'] ?? '')) ? 'selected' : ''; ?>
                        <option value="<?php echo $category['categoryID']; ?>" <?php echo $selected; ?>>
                            <?php echo htmlspecialchars($category['categoryName']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="code" class="form-label">Product Code</label>
                <input type="text" id="code" name="code" class="form-control" required
                       value="<?php echo htmlspecialchars($product['productCode'] ?? ''); ?>">
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" id="name" name="name" class="form-control" required
                       value="<?php echo htmlspecialchars($product['productName'] ?? ''); ?>">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="price" class="form-label">List Price (€)</label>
                    <input type="text" id="price" name="price" class="form-control" required
                           value="<?php echo htmlspecialchars($product['listPrice'] ?? ''); ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="discount_percent" class="form-label">Discount Percent (%)</label>
                    <input type="text" id="discount_percent" name="discount_percent" class="form-control" required
                           value="<?php echo htmlspecialchars($product['discountPercent'] ?? '0'); ?>">
                </div>
            </div>
            
            <!-- FIX: Moved the Stock Quantity field inside the form -->
            <div class="mb-3">
                <label for="stock" class="form-label">Stock Quantity</label>
                <input type="number" id="stock" name="stock" class="form-control" 
                       value="<?php echo htmlspecialchars($product['stock'] ?? '0'); ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" rows="6"><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" id="featured" name="featured" class="form-check-input"
                    <?php if (!empty($product['featured'])) : ?> checked <?php endif; ?>>
                <label for="featured" class="form-check-label">Featured Product</label>
            </div>

            <button type="submit" class="btn btn-primary">Save Product</button>
            <a href="." class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Right Column: Instructions -->
    <div class="col-md-4">
        <h4>How to work with the description</h4>
        <ul>
            <li>Use two returns to start a new paragraph.</li>
            <li>Use an asterisk to mark items in a bulleted list.</li>
            <li>Use one return between items in a bulleted list.</li>
            <li>Use standard HTML tags for bold and italics.</li>
        </ul>
    </div>
</div>

<?php include '../../view/footer.php'; ?>
