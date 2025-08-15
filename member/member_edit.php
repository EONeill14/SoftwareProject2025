<?php include '../view/header_member.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'member'; ?>">My Account</a></li>
            <li class="breadcrumb-item active">Edit Account</li>
        </ol>

        <form action="." method="post" id="edit_account_form">
            <input type="hidden" name="action" value="update_account">

            <div class="mb-3">
                <label for="email" class="form-label">E-Mail Address</label>
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
            <p class="text-muted">Update Password (Optional)</p>

            <div class="mb-3">
                <label for="password_1" class="form-label">New Password</label>
                <input type="password" id="password_1" name="password_1" class="form-control">
                <div class="form-text">Leave blank to keep your current password.</div>
            </div>
            <div class="mb-3">
                <label for="password_2" class="form-label">Retype New Password</label>
                <input type="password" id="password_2" name="password_2" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update Account</button>
            <a href="." class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include '../view/footer.php'; ?>