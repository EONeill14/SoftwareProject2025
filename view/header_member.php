<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The TeeTime Golf Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $app_path ?>public/css/All_Styles.css" />
</head>
<body>

<?php
    // This PHP block builds the correct URLs using the $app_path variable
    $home_url = $app_path;
    $products_url = $app_path . 'products.php';
    $contact_url = $app_path . 'contact.php';
    $cart_url = $app_path . 'cart/';
    $member_account_url = $app_path . 'member/';
    $logout_url = $member_account_url . '?action=logout';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $home_url; ?>">TeeTime Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#memberNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="memberNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $products_url; ?>">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $contact_url; ?>">Contact</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $cart_url; ?>">
                        <i class="fa fa-shopping-cart"></i> Cart (<?php echo cart_item_count(); ?>)
                    </a>
                </li>
                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fa fa-user"></i> Hi, <?php echo htmlspecialchars($_SESSION['user']['fName']); ?>!
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?php echo $member_account_url; ?>">My Account</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?php echo $logout_url; ?>">
                                <i class="fa fa-sign-out"></i> Logout
                            </a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $member_account_url; ?>">
                            <i class="fa fa-sign-in"></i> Login/Register
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4">