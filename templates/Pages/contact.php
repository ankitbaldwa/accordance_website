<!-- page-title -->
<section class="page-title" style="background-image: url(<?= $this->Url->assetUrl('images/background/control-bg.png') ?>);">
        <div class="anim-icons">
            <div class="icon icon-1"><img src="<?= $this->Url->assetUrl('images/icons/anim-icon-17.png') ?>" alt=""></div>
            <div class="icon icon-2 rotate-me"><img src="<?= $this->Url->assetUrl('images/icons/anim-icon-18.png') ?>" alt=""></div>
            <div class="icon icon-3 rotate-me"><img src="<?= $this->Url->assetUrl('images/icons/anim-icon-19.png') ?>" alt=""></div>
            <div class="icon icon-4"></div>
        </div>
        <div class="container">
            <div class="content-box clearfix">
                <div class="title-box pull-left">
                    <h1>Contact Us</h1>
                    <p>Reach out to the world’s most reliable IT services.</p>
                </div>
                <ul class="bread-crumb pull-right">
                    <li>Contact Us</li>
                    <li><a href="<?= $this->Url->build('/') ?>">Home</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- page-title end -->


    <!-- contact-section -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-md-12 col-sm-12 offset-lg-1 big-column">
                    <div class="info-content centred">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                                <div class="single-info-box">
                                    <figure class="icon-box"><img src="images/icons/info-icon-1.png" alt=""></figure>
                                    <h2>Phone</h2>
                                    <!--<div class="text">Start working with Landrick that can provide everything</div>-->
                                    <div class="phone"><a href="tel:+919970192831">(+91) 997 - 019 - 2831</a></div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                                <div class="single-info-box">
                                    <figure class="icon-box"><img src="images/icons/info-icon-2.png" alt=""></figure>
                                    <h2>E-mail</h2>
                                    <!--<div class="text">Start working with Landrick that can provide everything</div>-->
                                    <div class="phone"><a href="mailto:support@accordance.co.in">support@accordance.co.in</a></div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 info-column">
                                <div class="single-info-box">
                                    <figure class="icon-box"><img src="images/icons/info-icon-3.png" alt=""></figure>
                                    <h2>Address</h2>
                                    <div class="text">IT Park, South Ambazari Road, Nagpur, Maharashtra - 440022</div>
                                    <div class="phone"><a href="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14887.172653050398!2d79.0476504!3d21.1208108!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x14cb8984d8ca4763!2sThe%20Block%20Data%20IT%20Solution!5e0!3m2!1sen!2sin!4v1618679038537!5m2!1sen!2sin">View on Google map</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="image-container">
                        <figure class="image-box"><img src="images/resource/contact-1.png" alt=""></figure>
                    </div>
                    <div class="contact-form-area">
                        <div class="sec-title center"><h2>Contact us</h2></div>
                        <div class="form-inner">
                            <form method="post" action="http://azim.commonsupport.com/Appway/sendemail.php" id="contact-form" class="default-form">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            <i class="fas fa-user"></i>
                                            <input type="text" name="username" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            <i class="fas fa-envelope"></i>
                                            <input type="email" name="email" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            <i class="fas fa-file"></i>
                                            <input type="text" name="subject" placeholder="Subject" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            <i class="fas fa-phone"></i>
                                            <input type="text" name="phone" placeholder="Phone" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 column">
                                        <div class="form-group">
                                            <textarea name="message" placeholder="Write here message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 column">
                                        <div class="form-group message-btn centred">
                                            <button type="submit" class="theme-btn-two" name="submit-form">Submit Now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact-section end -->


    <!-- map-section -->
    <section class="map-section">
        <div class="google-map-area">
            <!--<div
                class="google-map"
                id="contact-google-map"
                data-map-lat="40.712776"
                data-map-lng="-74.005974"
                data-icon-path="images/icons/map-marker.png"
                data-map-title="Brooklyn, New York, United Kingdom"
                data-map-zoom="12"
                data-markers='{
                    "marker-1": [40.712776, -74.005974, "<h4>Branch Office</h4><p>77/99 New York</p>","images/icons/map-marker.png"]
                }'>

            </div>-->
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14887.172653050398!2d79.0476504!3d21.1208108!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x14cb8984d8ca4763!2sThe%20Block%20Data%20IT%20Solution!5e0!3m2!1sen!2sin!4v1618652670209!5m2!1sen!2sin" style="border:0;width:100%;height: 700px" allowfullscreen="" loading="lazy" class="google-map"></iframe>
        </div>
    </section>
    <!-- map-section end -->
