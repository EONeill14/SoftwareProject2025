<!doctype html>
<html lang="en">
<head>
    <title>Contact Us - The Golf Shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo APP_PATH ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo APP_PATH ?>style.css">
</head>
<body>
    <?php 
        // In a real application, the main setup and header files would be included here.
        // require_once('utility/main.php'); 
        // require_once('view/header_member.php'); 
    ?>
    
    <div class="container page-overlay" style="padding-top: 20px;">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="section-head">Contact Us</h2>
                <p>Have a question about an order, a product, or a custom fitting? We'd love to hear from you.</p>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <!-- The action should point to your controller that handles the form submission -->
                <form action="contact_handler.php" method="POST">
                    <div class="form-group">
                        <label for="contact-name">Your Name</label>
                        <input type="text" id="contact-name" name="customer_name" required class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="contact-email">Your Email</label>
                        <input type="email" id="contact-email" name="customer_email" required placeholder="me@example.com" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="contact-subject">Subject</label>
                        <select id="contact-subject" name="subject" class="form-control">
                            <option selected value="general_inquiry">General Inquiry</option>
                            <option value="order_question">Question About an Order</option>
                            <option value="product_question">Question About a Product</option>
                            <option value="fitting_inquiry">Custom Fitting Inquiry</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="contact-message">Message</label>
                        <textarea id="contact-message" name="message" class="form-control" rows="7" required></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Send Message</button>
                    </div>
                </form>
            </div>

            <div class="col-md-4">
                <address>
                    <h4><i class="fa fa-map-marker"></i> Our Shop</h4>
                    <strong>The Golf Shop Ltd.</strong><br>
                    123 Fairway Drive<br>
                    Dublin, D04 F4K3<br>
                    Ireland
                </address>
                <hr>
                <p>
                    <i class="fa fa-phone"></i> <strong>Phone:</strong> (01) 234 5678<br>
                </p>
                <hr>
                <p>
                    <i class="fa fa-envelope"></i> <strong>Email:</strong>
                    <a href="mailto:sales@thegolfshop.ie?Subject=Website%20Inquiry">sales@thegolfshop.ie</a>
                </p>
                <hr>
                 <p>
                    <i class="fa fa-clock-o"></i> <strong>Opening Hours:</strong><br>
                    Mon - Sat: 9:00 AM - 6:00 PM<br>
                    Sun: 12:00 PM - 5:00 PM
                </p>
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <footer class="bg-dark text-light mt-5">
        <div class="info container py-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="info-widget">
                        <h4>About The Golf Shop</h4>
                        <p>Based in Ireland, we are dedicated to providing golfers with the highest quality clubs, apparel, and accessories from the world's leading brands.</p>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="info-widget">
                        <h4>Useful Links</h4>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-light">Shipping & Returns</a></li>
                            <li><a href="#" class="text-light">My Account</a></li>
                            <li><a href="#" class="text-light">Size Guide</a></li>
                            <li><a href="#" class="text-light">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="info-widget">
                        <h4>Contact Us</h4>
                        <address>
                            <strong>The Golf Shop Ltd.</strong><br>
                            123 Fairway Drive<br>
                            Dublin, D04 F4K3<br>
                            P: (01) 234 5678
                        </address>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="info-widget">
                        <h4>Newsletter</h4>
                        <p>Sign up for exclusive offers and the latest news.</p>
                        <form action="<?php echo APP_PATH; ?>subscribe.php" method="post">
                            <div class="form-group">
                                <input type="email" name="subemail" required placeholder="me@example.com" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-warning btn-block"><span class="fa fa-envelope"></span> Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="crsl" class="bg-secondary text-center py-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-md-left">
                        &copy; <?php echo date("Y"); ?> - The Golf Shop Ltd. All Rights Reserved.
                    </div>
                    <div class="col-md-6 text-md-right">
                        <ul id="social-icons" class="list-inline mb-0">
                            <li class="list-inline-item"><a href="#" class="text-light fa fa-facebook"></a></li>
                            <li class="list-inline-item"><a href="#" class="text-light fa fa-twitter"></a></li>
                            <li class="list-inline-item"><a href="#" class="text-light fa fa-instagram"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" xintegrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
