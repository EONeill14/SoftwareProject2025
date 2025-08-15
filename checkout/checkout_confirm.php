<?php include '../view/header_member.php'; ?>

<div class="row">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $app_path; ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'cart/'; ?>">Cart</a></li>
            <li class="breadcrumb-item active">Confirm Order</li>
        </ol>

        <h2 class="mb-3">Order Summary</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Item</th>
                        <th class="text-end">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $item) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td class="text-end"><?php echo '€' . number_format($item['unit_price'], 2); ?></td>
                            <td class="text-center"><?php echo $item['quantity']; ?></td>
                            <td class="text-end"><?php echo '€' . number_format($item['line_price'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Shipping To</h3>
            </div>
            <div class="card-body">
                <address>
                    <strong><?php echo htmlspecialchars($_SESSION['user']['fName'] . ' ' . $_SESSION['user']['lName']); ?></strong><br>
                    <?php echo htmlspecialchars($shipping_address['line1']); ?><br>
                    <?php if (!empty($shipping_address['line2'])) echo htmlspecialchars($shipping_address['line2']) . '<br>'; ?>
                    <?php echo htmlspecialchars($shipping_address['city']); ?>, <?php echo htmlspecialchars($shipping_address['county']); ?><br>
                    <?php echo htmlspecialchars($shipping_address['eircode']); ?>
                </address>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h3 class="mb-0">Order Totals</h3>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                    <span>Subtotal:</span>
                    <strong><?php echo '€' . number_format($subtotal, 2); ?></strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Shipping:</span>
                    <strong><?php echo '€' . number_format($shipping_cost, 2); ?></strong>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>VAT (23%):</span>
                    <strong><?php echo '€' . number_format($tax, 2); ?></strong>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <span class="h5">Total:</span>
                    <strong class="h5"><?php echo '€' . number_format($total, 2); ?></strong>
                </li>
            </ul>
        </div>
        
        <div class="d-grid mt-4">
            <a href="?action=payment" class="btn btn-primary btn-lg">Proceed to Payment</a>
        </div>
    </div>
</div>

<?php include '../view/footer.php'; ?>