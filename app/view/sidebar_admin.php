<div class="col-md-2">
    <?php if (isset($categories)): ?>
        <h2>Categories</h2>
        <hr class="hr">
        <?php foreach ($categories as $category) : ?>
            <ol style="list-style-type:none">
                <li><a href="<?php echo $app_path . 'admin/product?action=list_products' . '&amp;category_id=' . $category['categoryID']; ?>">
                    </a>
                </li>
            </ol>
        <?php endforeach; ?>
    <?php endif; ?>
</div>