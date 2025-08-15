<?php include '../../view/header_admin.php'; ?>

<div class="row">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'admin/'; ?>">Home</a></li>
            <li class="breadcrumb-item active">Admin Accounts</li>
        </ol>

        <h3>Your Account</h3>
        <table class="table table-bordered">
            <tr>
                <td><?php echo htmlspecialchars($name . ' (' . $email . ')'); ?></td>
                <td style="width: 120px;">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="view_edit">
                        <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
                        <button type="submit" class="btn btn-warning w-100">
                            <i class="fa fa-edit"></i> Modify
                        </button>
                    </form>
                </td>
            </tr>
        </table>

        <?php if (count($admins) > 1) : ?>
            <h3 class="mt-4">Other Administrators</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admins as $admin) : ?>
                            <?php if ($admin['adminID'] != $admin_id) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($admin['fName'] . ' ' . $admin['lName']); ?></td>
                                    <td class="text-center" style="width: 220px;">
                                        <form action="." method="post" class="d-inline">
                                            <input type="hidden" name="action" value="view_edit">
                                            <input type="hidden" name="admin_id" value="<?php echo $admin['adminID']; ?>">
                                            <button type="submit" class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i> Modify
                                            </button>
                                        </form>
                                        <form action="." method="post" class="d-inline">
                                            <input type="hidden" name="action" value="view_delete_confirm">
                                            <input type="hidden" name="admin_id" value="<?php echo $admin['adminID']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <div class="col-md-4">
        <h3>Add Administrator</h3>
        <hr>
        <form action="." method="post">
            <input type="hidden" name="action" value="create">

            <div class="mb-3">
                <label for="email" class="form-label">E-Mail</label>
                <input type="email" id="email" name="email" class="form-control" required
                       value="<?php echo htmlspecialchars($_SESSION['form_data']['email'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required
                       value="<?php echo htmlspecialchars($_SESSION['form_data']['first_name'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required
                       value="<?php echo htmlspecialchars($_SESSION['form_data']['last_name'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="password_1" class="form-label">Password</label>
                <input type="password" id="password_1" name="password_1" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password_2" class="form-label">Retype password</label>
                <input type="password" id="password_2" name="password_2" class="form-control" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Administrator
                </button>
            </div>
        </form>
    </div>
</div>

<?php
// Clean up session data after displaying the form
if (isset($_SESSION['form_data'])) {
    unset($_SESSION['form_data']);
}
?>

<?php include '../../view/footer.php'; ?>