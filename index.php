<?php
// This is the view file for the homepage.
// The controller will be responsible for loading this file.
?>

<div id="home">
    <!-- Bootstrap Carousel for featured products or promotions -->
    <div id="carouselindicators" class="carousel slide" data-ride="carousel" data-pause="hover">

        <!-- Indicators for the slides -->
        <ol class="carousel-indicators">
            <li data-target="#carouselindicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselindicators" data-slide-to="1"></li>
            <li data-target="#carouselindicators" data-slide-to="2"></li>
        </ol>

        <!-- Slideshow Wrapper -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/golf-banner-1.jpg" class="d-block w-100" alt="New Season Golf Clubs">
                <div class="bg-overlay"></div>
                <div class="carousel-caption">
                    <h1>New Season Drivers<br><span>Unleash Your Power</span></h1>
                    <p>Discover the latest technology in golf clubs to improve your game.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/golf-banner-2.jpg" class="d-block w-100" alt="Premium Golf Apparel">
                <div class="bg-overlay"></div>
                <div class="carousel-caption">
                    <h1>Premium Golf Apparel</h1>
                    <p>Look sharp on the course with our new collection of golf wear.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/golf-banner-3.jpg" class="d-block w-100" alt="Golf Balls on Sale">
                <div class="bg-overlay"></div>
                <div class="carousel-caption">
                    <h1>Top-Rated Golf Balls</h1>
                    <p>Stock up on the best golf balls for distance and control.</p>
                </div>
            </div>
        </div>

        <!-- Previous and Next Controls -->
        <a class="carousel-control-prev" href="#carouselindicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselindicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <!-- Services Section -->
    <div id="services" class="container mt-5">
        <div class="row text-center">
            <div class="col-md-12">
                <h2 class="section-head">Our Services</h2>
            </div>
            <div class="col-md-4">
                <div class="service-box">
                    <i class="fa fa-truck fa-3x"></i>
                    <h3 class="mt-3">Nationwide Delivery</h3>
                    <p>Fast and reliable shipping to anywhere in Ireland.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box">
                    <i class="fa fa-cog fa-3x"></i>
                    <h3 class="mt-3">Custom Fittings</h3>
                    <p>Get your clubs professionally fitted by our experts.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-box">
                    <i class="fa fa-comments fa-3x"></i>
                    <h3 class="mt-3">Expert Advice</h3>
                    <p>Our team is always ready to help you with your game.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div id="testimonials" class="container mt-5">
        <div class="row text-center">
            <div class="col-md-12">
                <h2 class="section-head">What Our Customers Say</h2>
            </div>
            <div class="col-md-6">
                <div class="testimonial">
                    <img src="images/customer-1.jpg" width="100" height="100" alt="Customer photo" class="rounded-circle mb-3">
                    <p>"Great selection of clubs and the staff were incredibly helpful. The custom fitting made a huge difference to my game!"</p>
                    <footer class="blockquote-footer">John D. from Dublin</footer>
                </div>
            </div>
            <div class="col-md-6">
                <div class="testimonial">
                    <img src="images/customer-2.jpg" width="100" height="100" alt="Customer photo" class="rounded-circle mb-3">
                    <p>"My order arrived the next day. Fantastic service and the prices are the best I've found online. Highly recommend."</p>
                    <footer class="blockquote-footer">Sarah K. from Cork</footer>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent News Section -->
    <div id="news" class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="section-head">Recent News</h2>
            </div>
            <div class="col-md-3">
                <div class="news-post">
                    <img src="images/news-1.jpg" class="img-fluid mb-2" alt="Golfer on a course">
                    <h3><a href="#">Tips for Winter Golf</a></h3>
                    <div class="post-date">July 10, 2025</div>
                    <p>Don't let the cold stop you. Here are our top tips for enjoying golf all year round.</p>
                    <a href="#" class="readmore">Read More</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="news-post">
                    <img src="images/news-2.jpg" class="img-fluid mb-2" alt="New golf clubs">
                    <h3><a href="#">New Titleist Drivers Arrive</a></h3>
                    <div class="post-date">July 5, 2025</div>
                    <p>The latest line of Titleist drivers are now in stock. Come in for a fitting today!</p>
                    <a href="#" class="readmore">Read More</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="news-post">
                    <img src="images/news-3.jpg" class="img-fluid mb-2" alt="Golf course championship">
                    <h3><a href="#">Sponsoring the Local Championship</a></h3>
                    <div class="post-date">June 28, 2025</div>
                    <p>We're proud to be a main sponsor for this year's local club championship.</p>
                    <a href="#" class="readmore">Read More</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="news-post">
                    <img src="images/news-4.jpg" class="img-fluid mb-2" alt="Golf apparel">
                    <h3><a href="#">Guide to Wet Weather Gear</a></h3>
                    <div class="post-date">June 21, 2025</div>
                    <p>Stay dry and comfortable on the course with our guide to the best waterproofs.</p>
                    <a href="#" class="readmore">Read More</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="news-post">
                    <img src="images/pexels-6.jpg" alt="image missing">
                    <h3><a href="">News Heading here</a></h3>
                    <div class="post-date">Oct 7, 2020</div>
                    <p>jfskladfjsakldfjslkadfjka</p>
                    <a href="" class="readmore">Read more</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/view/footer.php'; ?>