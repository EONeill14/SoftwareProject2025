<?php include '../../view/header_admin.php'; ?>

<div class="row">
    <div class="col">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'admin/'; ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'admin/orders/'; ?>">Orders</a></li>
            <li class="breadcrumb-item active">Order #<?php echo $order_id; ?></li>
        </ol>
    </div>
</div>

<!-- Page Header with Action Buttons -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Order #<?php echo $order_id; ?></h2>
    <div>
        <?php if ($order['shipDate'] === NULL) : ?>
            <form action="." method="post" class="d-inline">
                <input type="hidden" name="action" value="set_ship_date" />
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-truck"></i> Mark as Shipped
                </button>
            </form>
            <form action="." method="post" class="d-inline">
                <input type="hidden" name="action" value="confirm_delete" />
                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Delete Order
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>
<hr>

<div class="row">
    <!-- Left Column: Order & Customer Info -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header"><h4>Order Information</h4></div>
            <div class="card-body">
                <p>
                    <strong>Order Date:</strong> <?php echo $order_date; ?><br>
                    <strong>Ship Date:</strong> 
                    <?php if ($order['shipDate'] === NULL) : ?>
                        Not yet shipped
                    <?php else: ?>
                        <?php echo date('M j, Y', strtotime($order['shipDate'])); ?>
                    <?php endif; ?>
                </p>
                <p>
                    <strong>Customer:</strong><br>
                    <?php echo htmlspecialchars($name); ?><br>
                    <?php echo htmlspecialchars($email); ?>
                </p>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h4>Billing Information</h4></div>
            <div class="card-body">
                <p>
                    <strong>Card Type:</strong> <?php echo htmlspecialchars($card_name); ?><br>
                    <strong>Card Number:</strong> ...<?php echo substr($card_number, -4); ?><br>
                    <strong>Expires:</strong> <?php echo htmlspecialchars($card_expires); ?>
                </p>
                <address>
                    <strong>Billing Address:</strong><br>
                    <?php echo htmlspecialchars($bill_line1); ?><br>
                    <?php if (!empty($bill_line2)) echo htmlspecialchars($bill_line2) . '<br>'; ?>
                    <?php echo htmlspecialchars($bill_city); ?>, <?php echo htmlspecialchars($bill_county); ?><br>
                    <?php echo htmlspecialchars($bill_eircode); ?>
                </address>
            </div>
        </div>
    </div>
    <!-- Right Column: Shipping Info -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h4>Shipping Information</h4></div>
            <div class="card-body">
                <address>
                    <strong>Shipping Address:</strong><br>
                    <?php echo htmlspecialchars($ship_line1); ?><br>
                    <?php if (!empty($ship_line2)) echo htmlspecialchars($ship_line2) . '<br>'; ?>
                    <?php echo htmlspecialchars($ship_city); ?>, <?php echo htmlspecialchars($ship_county); ?><br>
                    <?php echo htmlspecialchars($ship_eircode); ?><br>
                    <strong>Phone:</strong> <?php echo htmlspecialchars($ship_phone); ?>
                </address>
            </div>
        </div>
    </div>
</div>

<!-- Order Items Table -->
<h3 class="mt-5">Order Items</h3>
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

<?php include '../../view/footer.php'; ?>
