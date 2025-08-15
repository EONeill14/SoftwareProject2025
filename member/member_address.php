<?php include '../view/header_member.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'member'; ?>">My Account</a></li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars($heading); ?></li>
        </ol>

        <form action="." method="post" id="edit_address_form">
            <input type="hidden" name="action" value="update_address" />

            <?php if ($billing) : ?>
                <input type="hidden" name="address_type" value="billing" />
            <?php else: ?>
                <input type="hidden" name="address_type" value="shipping" />
            <?php endif; ?>

            <div class="mb-3">
                <label for="line1" class="form-label">Address Line 1</label>
                <input type="text" id="line1" name="line1" class="form-control" value="<?php echo htmlspecialchars($line1); ?>" required>
            </div>
            <div class="mb-3">
                <label for="line2" class="form-label">Address Line 2 (Optional)</label>
                <input type="text" id="line2" name="line2" class="form-control" value="<?php echo htmlspecialchars($line2); ?>">
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City/Town</label>
                <input type="text" id="city" name="city" class="form-control" value="<?php echo htmlspecialchars($city); ?>" required>
            </div>
            <div class="mb-3">
                <label for="county" class="form-label">County</label>
                <input type="text" id="county" name="county" class="form-control" value="<?php echo htmlspecialchars($county); ?>" required>
            </div>
            <div class="mb-3">
                <label for="eircode" class="form-label">Eircode</label>
                <input type="text" id="eircode" name="eircode" class="form-control" value="<?php echo htmlspecialchars($eircode); ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($phone); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Address</button>
            <a href="." class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include '../view/footer.php'; ?>