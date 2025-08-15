<?php include '../../view/header_admin.php'; ?>

<div class="row">
    <div class="col-md-2">
        <?php include '../../view/sidebar_admin.php'; ?>
    </div>

    <div class="col-md-10">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0"><?php echo htmlspecialchars($current_category['categoryName']); ?></h2>
            <a href="?action=show_add_edit_form" class="btn btn-primary">
                <i class="fa fa-plus"></i> Add Product
            </a>
        </div>

        <?php if (count($products) == 0) : ?>
            <p class="alert alert-warning">There are no products in this category.</p>
        <?php else : ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr class="<?php if (!$product['is_active']) echo 'table-secondary text-muted'; ?>">
                                <td>
                                    <?php $image_filename = $product['productCode'] . '_s.png'; ?>
                                    <img src="<?php echo $app_path . 'images/' . $image_filename; ?>" 
                                         alt="Product Image" style="width: 60px; height: 60px; object-fit: cover;">
                                </td>
                                <td><?php echo htmlspecialchars($product['productName']); ?></td>
                                <td>
                                    <?php if ($product['is_active']) : ?>
                                        <span class="badge bg-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo sprintf('€%.2f', $product['listPrice']); ?></td>
                                <td class="text-center" style="min-width: 240px;">
                                    <a href="?action=show_add_edit_form&product_id=<?php echo $product['productID']; ?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Modify
                                    </a>
                                    
                                    <?php if ($product['is_active']) : ?>
                                        <form action="." method="post" class="d-inline">
                                            <input type="hidden" name="action" value="deactivate_product">
                                            <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                            <input type="hidden" name="category_id" value="<?php echo $product['categoryID']; ?>">
                                            <button type="submit" class="btn btn-secondary btn-sm">
                                                <i class="fa fa-archive"></i> Deactivate
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <form action="." method="post" class="d-inline">
                                            <input type="hidden" name="action" value="reactivate_product">
                                            <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                            <input type="hidden" name="category_id" value="<?php echo $product['categoryID']; ?>">
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="fa fa-undo"></i> Reactivate
                                            </button>
                                        </form>

                                        <?php if ($product['orderCount'] == 0) : ?>
                                            <form action="." method="post" class="d-inline">
                                                <input type="hidden" name="action" value="permanently_delete">
                                                <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                                <input type="hidden" name="category_id" value="<?php echo $product['categoryID']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('This will PERMANENTLY delete the product. Are you sure?');">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <form method="get" action="." class="d-flex align-items-center">
                    <input type="hidden" name="category_id" value="<?php echo $current_category['categoryID']; ?>">
                    <label for="rowperpage" class="form-label me-2 mb-0">Rows:</label>
                    <select id="rowperpage" name="rowperpage" class="form-select form-select-sm" style="width: 70px;" onchange="this.form.submit()">
                        <?php $numrows_arr = ["10", "25", "50", "100"]; ?>
                        <?php foreach ($numrows_arr as $nrow) : ?>
                            <option value="<?php echo $nrow; ?>" <?php if ($rowperpage == $nrow) echo 'selected'; ?>>
                                <?php echo $nrow; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>

                <nav>
                    <?php
                        $link_category_id = $current_category['categoryID'];
                        $base_url = "?rowperpage=$rowperpage&category_id=$link_category_id&page=";
                        $total_pages = ceil($products_records / $rowperpage);

                        if ($total_pages > 1) {
                            echo '<ul class="pagination mb-0">';
                            if ($page > 1) {
                                echo '<li class="page-item"><a class="page-link" href="' . $base_url . ($page - 1) . '">Previous</a></li>';
                            }
                            for ($i = 1; $i <= $total_pages; $i++) {
                                $active_class = ($i == $page) ? "active" : "";
                                echo '<li class="page-item ' . $active_class . '"><a class="page-link" href="' . $base_url . $i . '">' . $i . '</a></li>';
                            }
                            if ($total_pages > $page) {
                                echo '<li class="page-item"><a class="page-link" href="' . $base_url . ($page + 1) . '">Next</a></li>';
                            }
                            echo '</ul>';
                        }
                    ?>
                </nav>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include '../../view/footer.php'; ?>