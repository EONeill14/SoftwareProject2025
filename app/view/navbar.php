<div id="main-navbar">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo $app_path ?>index.php">
            <img src="<?php echo $app_path . 'images/logo.png' ?>" width="30" height="30" class="d-inline-block align-top" alt="Golf Shop Logo">
            The Golf Shop
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo $app_path ?>index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#products">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#categories">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact Us</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="<?php echo $app_path ?>cart.php">
                        <span class="fa fa-shopping-cart"></span> Cart
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
