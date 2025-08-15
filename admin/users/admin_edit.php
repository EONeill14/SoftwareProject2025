<?php include '../../view/header_admin.php'; ?>

<div class="row">
    <div class="col-md-8">
        <form action="." method="post" id="edit_admin_form">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo $app_path . 'admin/'; ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $app_path . 'admin/users/'; ?>">Admin Accounts</a></li>
                <li class="breadcrumb-item active">Edit Admin Account</li>
            </ol>

            <div class="mb-3">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" id="email" name="email" class="form-control" 
                       value="<?php echo htmlspecialchars($email); ?>" required>
            </div>

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" id="first_name" name="first_name" class="form-control" 
                       value="<?php echo htmlspecialchars($first_name); ?>" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-control" 
                       value="<?php echo htmlspecialchars($last_name); ?>" required>
            </div>
            
            <hr>
            <p><strong>Update Password (Optional)</strong></p>

            <div class="mb-3">
                <label for="password_1" class="form-label">New Password</label>
                <input type="password" id="password_1" name="password_1" class="form-control">
                <div class="form-text">Leave blank to keep current password.</div>
            </div>

            <div class="mb-3">
                <label for="password_2" class="form-label">Retype Password</label>
                <input type="password" id="password_2" name="password_2" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update Account</button>
            <a href="." class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include '../../view/footer.php'; ?>