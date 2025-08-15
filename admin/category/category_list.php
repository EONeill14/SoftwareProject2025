<?php include '../../view/header_admin.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $app_path . 'admin/'; ?>">Home</a></li>
            <li class="breadcrumb-item active">Category Manager</li>
        </ol>
        
        <hr>
        
        <h2 class="mb-3">Edit Categories</h2>

        <?php foreach ($categories as $category) : ?>
            <div class="mb-2 d-flex">
                <form action="." method="post" class="d-flex flex-grow-1">
                    <input type="hidden" name="action" value="update_category">
                    <input type="hidden" name="category_id" 
                           value="<?php echo $category['categoryID']; ?>">
                    
                    <input type="text" name="name" value="<?php echo htmlspecialchars($category['categoryName']); ?>" class="form-control me-2">
                    
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-edit"></i>
                    </button>
                </form>

                <?php if ($category['productCount'] == 0) : ?>
                    <form action="." method="post" class="ms-2">
                        <input type="hidden" name="action" value="delete_category">
                        <input type="hidden" name="category_id" 
                               value="<?php echo $category['categoryID']; ?>">
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <hr class="mt-4">

        <h2 class="mb-3">Add Category</h2>
        <form action="." method="post" class="d-flex">
            <input type="hidden" name="action" value="add_category">
            <input type="text" name="name" placeholder="New Category Name" class="form-control me-2" required>
            <button type="submit" class="btn btn-success">
                <i class="fa fa-plus"></i> Add
            </button>
        </form>

    </div>
</div>

<?php include '../../view/footer.php'; ?>