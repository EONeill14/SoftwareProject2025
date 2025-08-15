<?php include '../view/header_member.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $app_path; ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'cart/'; ?>">Cart</a></li>
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'checkout/'; ?>">Confirm</a></li>
            <li class="breadcrumb-item active">Payment</li>
        </ol>

        <div class="row">
            <!-- Billing Address Column -->
            <div class="col-md-6">
                <h3>Billing Address</h3>
                <hr>
                <address>
                    <strong><?php echo htmlspecialchars($_SESSION['user']['fName'] . ' ' . $_SESSION['user']['lName']); ?></strong><br>
                    <?php echo htmlspecialchars($bill_line1); ?><br>
                    <?php if (!empty($bill_line2)) echo htmlspecialchars($bill_line2) . '<br>'; ?>
                    <?php echo htmlspecialchars($bill_city); ?>, <?php echo htmlspecialchars($bill_county); ?><br>
                    <?php echo htmlspecialchars($bill_eircode); ?><br>
                    <?php echo htmlspecialchars($bill_phone); ?>
                </address>
            </div>

            <!-- Payment Information Column -->
            <div class="col-md-6">
                <h3>Payment Information</h3>
                <hr>
                <form action="." method="post" id="payment_form">
                    <input type="hidden" name="action" value="process" />
                    
                    <div class="mb-3">
                        <label for="card_type" class="form-label">Card Type</label>
                        <select name="card_type" id="card_type" class="form-select">
                            <option value="1">MasterCard</option>
                            <option value="2">Visa</option>
                            <option value="3">Discover</option>
                            <option value="4">American Express</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="card_number" class="form-label">Card Number</label>
                        <input type="text" id="card_number" name="card_number" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="card_cvv" class="form-label">CVV</label>
                        <input type="text" id="card_cvv" name="card_cvv" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="card_expires" class="form-label">Expiration (MM/YYYY)</label>
                        <input type="text" id="card_expires" name="card_expires" class="form-control" placeholder="MM/YYYY" required>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../view/footer.php'; ?>