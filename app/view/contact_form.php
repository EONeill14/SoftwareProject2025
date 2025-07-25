<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Contact Us - The Golf Shop</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Font Awesome for icons is kept, as it's part of the structure -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Other CSS links removed as requested -->
    </head>
    <body>

        <?php
        // The navbar would be included here in a non-MVC structure
        // require_once('navbar.php'); 
        ?>

        <!-- Main Contact Form Section -->
        <div class="container page-overlay" style="padding-top: 20px;">
            <h3>Contact Us</h3>
            <hr class="hr">
            <div class="row">
                <div class="col-md-8">
                    <form action="contact_handler.php" method="POST">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" size="40" name="customer_name" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" size="40" name="customer_email" required placeholder="me@example.com" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Subject of Inquiry</label>
                            <select name="subject" class="form-control">
                                <option selected="selected" value="general_inquiry">General Inquiry</option>
                                <option value="order_question">Question About an Order</option>
                                <option value="product_question">Question About a Product</option>
                                <option value="fitting_inquiry">Custom Fitting Inquiry</option>
                                <option value="feedback">Website Feedback</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>How did you hear about us?</label><br>
                            <input type="radio" name="referral" value="search_engine" checked="checked"> Search Engine<br>
                            <input type="radio" name="referral" value="social_media"> Social Media<br>
                            <input type="radio" name="referral" value="friend"> From a Friend<br>
                            <input type="radio" name="referral" value="other"> Other
                        </div>

                        <div class="form-group">
                            <label>Sign up for our newsletter for special offers?</label><br>
                            <input type="checkbox" name="newsletter_signup" value="yes" checked="checked"> Yes, please sign me up!
                        </div>

                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="message" class="form-control" rows="7" required></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-warning btn-block">Send Message</button>
                        </div>
                    </form>
                </div>

                <!-- Contact Details Sidebar -->
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

        <?php require_once('footer.php'); ?>

    </body>
</html>
