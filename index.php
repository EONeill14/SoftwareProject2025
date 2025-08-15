<?php
    require_once('utility/main.php');
    include 'view/header_member.php';
?>

<div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="images/golf-banner-1.jpg" class="d-block w-100" alt="New Season Golf Clubs">
            <div class="carousel-caption d-none d-md-block">
                <h1>New Season Drivers</h1>
                <p>Discover the latest technology to improve your game.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/golf-banner-2.jpg" class="d-block w-100" alt="Premium Golf Apparel">
            <div class="carousel-caption d-none d-md-block">
                <h1>Premium Golf Apparel</h1>
                <p>Look sharp on the course with our new collection of golf wear.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="images/golf-banner-3.jpg" class="d-block w-100" alt="Golf Balls on Sale">
            <div class="carousel-caption d-none d-md-block">
                <h1>Top-Rated Golf Balls</h1>
                <p>Stock up on the best golf balls for distance and control.</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container py-5">
    <div class="row text-center">
        <div class="col-12">
            <h2 class="section-head mb-4">Our Services</h2>
        </div>
        <div class="col-md-4">
            <div class="service-box">
                <i class="fa fa-truck fa-3x text-primary mb-3"></i>
                <h3>Nationwide Delivery</h3>
                <p>Fast and reliable shipping to anywhere in Ireland.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-box">
                <i class="fa fa-cog fa-3x text-primary mb-3"></i>
                <h3>Custom Fittings</h3>
                <p>Get your clubs professionally fitted by our experts.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-box">
                <i class="fa fa-comments fa-3x text-primary mb-3"></i>
                <h3>Expert Advice</h3>
                <p>Our team of golf pros is always ready to help you with your game.</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-light py-5">
    <div class="container">
        <div class="row text-center">
            <div class="col-12">
                <h2 class="section-head mb-4">What Our Customers Say</h2>
            </div>
            <div class="col-md-6">
                <div class="testimonial">
                    <img src="images/customer-1.jpg" alt="Customer photo" class="rounded-circle mb-3" style="width:100px; height:100px;">
                    <p class="fst-italic">"Great selection of clubs and the staff were incredibly helpful. The custom fitting made a huge difference to my game!"</p>
                    <strong>John D. - Dublin</strong>
                </div>
            </div>
            <div class="col-md-6">
                <div class="testimonial">
                    <img src="images/customer-2.jpg" alt="Customer photo" class="rounded-circle mb-3" style="width:100px; height:100px;">
                    <p class="fst-italic">"My order arrived the next day. Fantastic service and the prices are the best I've found online. Highly recommend."</p>
                    <strong>Sarah K. - Cork</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row text-center">
        <div class="col-12">
            <h2 class="section-head mb-4">Recent News</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="images/news-1.jpg" class="card-img-top" alt="Golfer on a course">
                <div class="card-body">
                    <h5 class="card-title">Tips for Winter Golf</h5>
                    <p class="card-text text-muted">August 5, 2025</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="images/news-2.jpg" class="card-img-top" alt="New golf clubs">
                <div class="card-body">
                    <h5 class="card-title">New Titleist Drivers Arrive</h5>
                    <p class="card-text text-muted">July 28, 2025</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="images/news-3.jpg" class="card-img-top" alt="Golf course championship">
                <div class="card-body">
                    <h5 class="card-title">Sponsoring the Local Championship</h5>
                    <p class="card-text text-muted">July 22, 2025</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="images/news-4.jpg" class="card-img-top" alt="Golf apparel">
                <div class="card-body">
                    <h5 class="card-title">Guide to Wet Weather Gear</h5>
                    <p class="card-text text-muted">July 15, 2025</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'view/footer.php'; ?>