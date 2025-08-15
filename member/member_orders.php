<?php include '../view/header_member.php'; ?>

<div class="row">
    <div class="col">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $app_path; ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'member/'; ?>">My Account</a></li>
            <li class="breadcrumb-item active">Order #<?php echo $order_id; ?></li>
        </ol>

        <h2>Order Details</h2>
        <p>
            <strong>Order Number:</strong> <?php echo $order_id; ?><br>
            <strong>Order Date:</strong> <?php echo $order_date; ?>
        </p>
        <hr>
    </div>
</div>

<div class="row">
    <!-- Address Details -->
    <div class="col-md-6">
        <h4>Shipping Address</h4>
        <address>
            <?php echo htmlspecialchars($ship_line1); ?><br>
            <?php if (!empty($ship_line2)) echo htmlspecialchars($ship_line2) . '<br>'; ?>
            <?php echo htmlspecialchars($ship_city); ?>, <?php echo htmlspecialchars($ship_county); ?><br>
            <?php echo htmlspecialchars($ship_eircode); ?><br>
            Phone: <?php echo htmlspecialchars($ship_phone); ?>
        </address>
    </div>
    <div class="col-md-6">
        <h4>Billing Address</h4>
        <address>
            <?php echo htmlspecialchars($bill_line1); ?><br>
            <?php if (!empty($bill_line2)) echo htmlspecialchars($bill_line2) . '<br>'; ?>
            <?php echo htmlspecialchars($bill_city); ?>, <?php echo htmlspecialchars($bill_county); ?><br>
            <?php echo htmlspecialchars($bill_eircode); ?><br>
            Card ending in ...<?php echo substr($order['cardNumber'], -4); ?>
        </address>
    </div>
</div>

<hr>

<!-- Order Items -->
<h3 class="mt-4">Order Items</h3>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Item</th>
                <th class="text-end">Your Cost</th>
                <th class="text-center">Quantity</th>
                <th class="text-end">Line Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $subtotal = 0;
            foreach ($order_items as $item) :
                $your_cost = $item['itemPrice'] - $item['discountAmount'];
                $line_total = $your_cost * $item['quantity'];
                $subtotal += $line_total;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['productName']); ?></td>
                    <td class="text-end"><?php echo '€' . number_format($your_cost, 2); ?></td>
                    <td class="text-center"><?php echo $item['quantity']; ?></td>
                    <td class="text-end"><?php echo '€' . number_format($line_total, 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end"><strong>Subtotal:</strong></td>
                <td class="text-end"><strong><?php echo '€' . number_format($subtotal, 2); ?></strong></td>
            </tr>
            <tr>
                <td colspan="3" class="text-end">VAT (23%):</td>
                <td class="text-end"><?php echo '€' . number_format($order['taxAmount'], 2); ?></td>
            </tr>
            <tr>
                <td colspan="3" class="text-end">Shipping:</td>
                <td class="text-end"><?php echo '€' . number_format($order['shipAmount'], 2); ?></td>
            </tr>
            <tr class="table-light">
                <td colspan="3" class="text-end h5"><strong>Total:</strong></td>
                <td class="text-end h5"><strong><?php echo '€' . number_format($subtotal + $order['taxAmount'] + $order['shipAmount'], 2); ?></strong></td>
            </tr>
        </tfoot>
    </table>
</div>

<?php include '../view/footer.php'; ?>