<div class="row">
    <div class="col-12 text-center">
        <h2>Contact Us</h2>
        <p>Have a question about an order, a product, or a custom fitting? We'd love to hear from you.</p>
        <hr>
    </div>
</div>
<div class="row">
    <div class="col-md-8">
        <form action="<?php echo $app_path . 'contact.php' ?>" method="POST">
            <div class="mb-3">
                <label for="customer_name" class="form-label">Your Name</label>
                <input type="text" id="customer_name" name="customer_name" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="customer_email" class="form-label">Your Email</label>
                <input type="email" id="customer_email" name="customer_email" required class="form-control">
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <select id="subject" name="subject" class="form-select">
                    <option selected value="General Inquiry">General Inquiry</option>
                    <option value="Question About an Order">Question About an Order</option>
                    <option value="Custom Fitting Inquiry">Custom Fitting Inquiry</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea id="message" name="message" class="form-control" rows="7" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>

    <div class="col-md-4">
        <address>
            <h4><i class="fa fa-map-marker"></i> Our Shop</h4>
            <strong>The TeeTime Golf Shop</strong><br>
            123 Fairway Drive<br>
            Dublin, Ireland
        </address>
        <hr>
        <p><i class="fa fa-phone"></i> <strong>Phone:</strong> (01) 234 5678</p>
        <hr>
        <p><i class="fa fa-envelope"></i> <strong>Email:</strong>
           <a href="mailto:sales@teetimegolf.ie">sales@teetimegolf.ie</a>
        </p>
    </div>
</div>