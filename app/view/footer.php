<!--
This is the main footer for the website.
It uses Bootstrap classes for styling and layout.
-->
<footer class="bg-dark text-light mt-5">
    <div class="info container py-5">
        <div class="row">

            <!-- About Company Widget -->
            <div class="col-md-3">
                <div class="info-widget">
                    <h4>About The Golf Shop</h4>
                    <p>Based in Ireland, we are dedicated to providing golfers with the highest quality clubs, apparel, and accessories from the world's leading brands.</p>
                </div>
            </div>

            <!-- Useful Links Widget -->
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

            <!-- Contact Information Widget -->
            <div class="col-md-3">
                <div class="info-widget">
                    <h4>Contact Us</h4>
                    <address>
                        <strong>The Golf Shop Ltd.</strong><br>
                        123 Fairway Drive<br>
                        Dublin, D04 F4K3<br>
                        Ireland<br>
                        P: (01) 234 5678<br>
                        <a href="contact_form.php" class="text-warning">Send us a message</a>
                    </address>
                </div>
            </div>

            <!-- Newsletter Signup Widget -->
            <div class="col-md-3">
                <div class="info-widget">
                    <h4>Newsletter</h4>
                    <p>Sign up for exclusive offers and the latest news.</p>
                    <form action="<?php echo $app_path; ?>subscribe.php" method="post">
                        <div class="form-group">
                            <input type="email" name="subemail" required placeholder="me@example.com" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-warning btn-block"><span class="fa fa-envelope"></span> Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright and Social Links Bar -->
    <div id="copyright-bar" class="bg-secondary text-center py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-md-left">
                    &copy; <?php echo date("Y"); ?> - The Golf Shop Ltd. All Rights Reserved.
                </div>
                <div class="col-md-6 text-md-right">
                    <ul id="social-icons" class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="#" class="text-light fa fa-facebook"></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-light fa fa-twitter"></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="text-light fa fa-instagram"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap and jQuery JavaScript files -->
<!-- These are often placed at the end of the body, so including them in the footer is a common practice. -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" xintegrity="sha384-DfXdz2htPJ0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-ho+j7jyWK8fNQe+A12Hb8Ahrq26LrZ/jpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
