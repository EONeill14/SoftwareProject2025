<?php include '../view/header_member.php'; ?>

<div class="row">
    <div class="col-lg-8">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $app_path; ?>">Home</a></li>
            <li class="breadcrumb-item active">My Account</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">My Account</h3>
                <form action="." method="post" class="mb-0">
                    <input type="hidden" name="action" value="view_account_edit">
                    <button type="submit" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i> Modify
                    </button>
                </form>
            </div>
            <div class="card-body">
                <p><?php echo htmlspecialchars($member_name . ' (' . $email . ')'); ?></p>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Shipping Address</h3>
                <form action="." method="post" class="mb-0">
                    <input type="hidden" name="action" value="view_address_edit">
                    <input type="hidden" name="address_type" value="shipping">
                    <button type="submit" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i> Modify
                    </button>
                </form>
            </div>
            <div class="card-body">
                <address>
                    <?php echo htmlspecialchars($ship_line1); ?><br>
                    <?php if (!empty($ship_line2)) echo htmlspecialchars($ship_line2) . '<br>'; ?>
                    <?php echo htmlspecialchars($ship_city); ?>, <?php echo htmlspecialchars($ship_county); ?><br>
                    <?php echo htmlspecialchars($ship_eircode); ?><br>
                    <?php echo htmlspecialchars($ship_phone); ?>
                </address>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Billing Address</h3>
                <form action="." method="post" class="mb-0">
                    <input type="hidden" name="action" value="view_address_edit">
                    <input type="hidden" name="address_type" value="billing">
                    <button type="submit" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i> Modify
                    </button>
                </form>
            </div>
            <div class="card-body">
                <address>
                    <?php echo htmlspecialchars($bill_line1); ?><br>
                    <?php if (!empty($bill_line2)) echo htmlspecialchars($bill_line2) . '<br>'; ?>
                    <?php echo htmlspecialchars($bill_city); ?>, <?php echo htmlspecialchars($bill_county); ?><br>
                    <?php echo htmlspecialchars($bill_eircode); ?><br>
                    <?php echo htmlspecialchars($bill_phone); ?>
                </address>
            </div>
        </div>

        <?php if (count($orders) > 0) : ?>
            <h3 class="mt-5">My Orders</h3>
            <div class="list-group">
                <?php foreach ($orders as $order) :
                    // Prepare data for display
                    $order_id = $order['orderID'];
                    $order_date = date('M j, Y', strtotime($order['orderDate']));
                    $ship_date_str = ($order['shipDate'] != NULL) ? 'Shipped on ' . date('M j, Y', strtotime($order['shipDate'])) : 'Not yet shipped';
                    $url = $app_path . 'member' . '?action=view_order&order_id=' . $order_id;
                ?>
                    <a href="<?php echo $url; ?>" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Order #<?php echo $order_id; ?></h5>
                            <small><?php echo $order_date; ?></small>
                        </div>
                        <p class="mb-1"><?php echo $ship_date_str; ?></p>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <div class="col-lg-4">
        <?php include '../view/sidebar_member.php'; ?>
    </div>
</div>

<?php include '../view/footer.php'; ?>