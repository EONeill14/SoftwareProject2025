<?php include '../../view/header_admin.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'admin/'; ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'admin/users/'; ?>">Admin Accounts</a></li>
            <li class="breadcrumb-item active">Delete Admin Account</li>
        </ol>

        <hr>

        <h2>Delete Account</h2>
        <p>Are you sure you want to permanently delete the account for:</p>
        
        <p class="lead">
            <strong><?php echo htmlspecialchars($first_name . ' ' . $last_name); ?></strong>
            (<?php echo htmlspecialchars($email); ?>)
        </p>

        <hr>

        <form action="." method="post" class="mt-3">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
            
            <button type="submit" class="btn btn-danger">Yes, Delete This Account</button>
            
            <a href="." class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include '../../view/footer.php'; ?>