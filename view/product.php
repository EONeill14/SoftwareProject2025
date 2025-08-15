<?php
    // Parse data from the $product array
    $product_name = $product['productName'];
    $description = $product['description'];
    $list_price = $product['listPrice'];
    $discount_percent = $product['discountPercent'];
    $stock_quantity = $product['stock'];

    // Calculate discounts
    $discount_amount = round($list_price * ($discount_percent / 100), 2);
    $unit_price = $list_price - $discount_amount;

    // Get image URL
    $image_filename = $product['productCode'] . '_m.png';
    $image_path = $app_path . 'images/' . $image_filename;
?>

<!-- Main Product Display -->
<div class="row">
    <!-- Product Image Column -->
    <div class="col-md-5">
        <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($product_name); ?>" class="img-fluid rounded shadow-sm">
    </div>
    
    <!-- Product Details Column -->
    <div class="col-md-7">
        <h3><?php echo htmlspecialchars($product_name); ?></h3>
        <hr>
        
        <p>
            List Price: <span class="text-decoration-line-through">€<?php echo number_format($list_price, 2); ?></span><br>
            <strong class="fs-4">Your Price: €<?php echo number_format($unit_price, 2); ?></strong>
        </p>

        <!-- INVENTORY CHECK -->
        <?php if ($stock_quantity > 0) : ?>
            <!-- If in stock, show the "Add to Cart" form -->
            <form action="<?php echo $app_path . 'cart/' ?>" method="post" class="mt-3">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                <div class="input-group" style="max-width: 200px;">
                    <label for="quantity" class="input-group-text">Quantity:</label>
                    <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo $stock_quantity; ?>" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-3">
                    <i class="fa fa-shopping-cart"></i> Add to Cart
                </button>
            </form>
        <?php else: ?>
            <!-- If out of stock, show a message -->
            <p class="alert alert-danger mt-3">Out of Stock</p>
        <?php endif; ?>
    </div>
</div>

<!-- Full Description -->
<div class="row mt-5">
    <div class="col">
        <h2>Description</h2>
        <hr>
        <div><?php echo nl2br(htmlspecialchars($description)); ?></div>
    </div>
</div>