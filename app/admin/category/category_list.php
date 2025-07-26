<?php include 'view/header_admin.php'; ?>

<div class="container section page-overlay table-border">
    <div class="row">
        <div class="col-12">
            <h2 class="section-head">Category Manager</h2>
        </div>
        <div class="col-md-4 mx-auto">
            <table class="table table-content table-border">
                <tbody>
                <?php if (!empty($categories)): // Check if $categories array is not empty ?>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td>
                                <form action="index.php" method="post">
                                    <div class="form-group text-box">
                                        <input type="text" name="name" value="<?php echo htmlspecialchars($category['categoryName']); ?>" class="form-control">
                                    </div>
                                </td>
                                <td>
                                    <input type="hidden" name="action" value="update_category">
                                    <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($category['categoryID']); ?>">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-warning btn-block" value="Update">
                                            <span class="fa fa-edit"></span>
                                        </button>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <?php if ($category['productCount'] == 0): ?>
                                    <form action="index.php" method="post">
                                        <input type="hidden" name="action" value="delete_category">
                                        <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($category['categoryID']); ?>">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger btn-block" value="Delete">
                                                <span class="fa fa-trash"></span>
                                            </button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">No categories found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

            <hr class="hr">

            <h4 class="section-head">Add Category</h4>
            <table class="table"> <tbody>
                    <tr>
                        <form action="index.php" method="post">
                            <input type="hidden" name="action" value="add_category">
                            <td>
                                <div class="form-group text-box">
                                    <input type="text" name="name" placeholder="New Category Name" class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning btn-block" value="Add">
                                        <span class="fa fa-plus"></span>
                                    </button>
                                </div>
                            </td>
                        </form>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'view/footer.php'; ?>