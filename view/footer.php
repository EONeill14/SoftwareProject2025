</main> <footer class="bg-dark text-light mt-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-4">
                <h4>About The Golf Shop</h4>
                <p>Based in Ireland, we are dedicated to providing golfers with the highest quality clubs, apparel, and accessories.</p>
            </div>
            <div class="col-md-4">
                <h4>Useful Links</h4>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light">Shipping & Returns</a></li>
                    <li><a href="<?php echo $app_path . 'member/'; ?>" class="text-light">My Account</a></li>
                    <li><a href="#" class="text-light">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>Newsletter</h4>
                <p>Sign up for exclusive offers and the latest news.</p>
                <form action="<?php echo $app_path . 'subscribe.php'; ?>" method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="subemail" required placeholder="me@example.com" class="form-control">
                        <button type="submit" class="btn btn-warning"><i class="fa fa-envelope"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-secondary text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; <?php echo date("Y"); ?> - The Golf Shop Ltd. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>