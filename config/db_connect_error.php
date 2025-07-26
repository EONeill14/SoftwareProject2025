<?php include 'view/header/admin.php'; ?>
<div class="container section page-overlay">
    <div class="row">
        <div class="col-md-12">
            <h2 class=section-head>database Error</h2>
            <p>The following error encountered while connecting to the database.</p>
            <p>Error message: <?php echo $error_messsage; ?></p>
        </div>
    </div>
</div>
<?php include 'view/footer.php'; ?>
