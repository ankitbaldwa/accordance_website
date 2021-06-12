<!-- page-title --><?php //pr($page); ?>
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
                    <h1><?= $page->title ?></h1>
                    <?php if($page->type == 'Main'){ ?>
                    <p><?= $page->heading ?></p>
                    <?php } ?>
                </div>
                <ul class="bread-crumb pull-right">
                    <li><?= $page->title ?></li>
                    <li><a href="<?= $this->Url->build('/')?>">Home</a></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- page-title end -->


    <!-- our-history -->
    <section class="our-history">
        <div class="container">
            <div class="row">
                <?php if($page->slug == 'about-us') { ?>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div id="content_block_53">
                        <div class="content-box wow fadeInLeft" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="sec-title"><h2>Our History</h2></div>
                            <div class="text">
                                <!--<p>Over the years we have grown in all aspects — and continue to every day — but our goals have remained the same. Have fun while working with the best technology at hand. Design and create the finest product we can. Compete with the top in the industry. Learn from the best.</p>
                                <p>Focus on the essential. Cultivate openness and respect in all communication. Be friends with one another. Learn constantly.</p>-->
                                <?= $page->content ?>
                            </div>
                            <h5>A. Baldwa, CEO.</h5>
                            <figure class="signatur"><img src="<?= $this->Url->assetUrl('images/icons/sign3.png') ?>" alt=""></figure>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div id="image_block_47">
                        <div class="image-box js-tilt">
                            <figure class="image wow slideInRight" data-wow-delay="00ms" data-wow-duration="1500ms"><img src="<?= $this->Url->assetUrl('images/resource/illustration-41.png') ?>" alt=""></figure>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 content-column">
                    <div id="content_block_53">
                        <div class="content-box wow fadeInLeft" data-wow-delay="00ms" data-wow-duration="1500ms">
                            <div class="sec-title"><h2>Our <?= $page->heading ?></div>
                            <div class="text">
                                <!--<p>Over the years we have grown in all aspects — and continue to every day — but our goals have remained the same. Have fun while working with the best technology at hand. Design and create the finest product we can. Compete with the top in the industry. Learn from the best.</p>
                                <p>Focus on the essential. Cultivate openness and respect in all communication. Be friends with one another. Learn constantly.</p>-->
                                <?= $page->content ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- our-history end -->


    <!-- video-section -->
    <!--<section class="video-section">
        <div class="bg-column" style="background-image: url(<?= $this->Url->assetUrl('images/background/video-bg.jpg') ?>);"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 video-column">
                    <div class="video-inner">
                        <a href="https://www.youtube.com/watch?v=nfP5N9Yc72A&amp;t=28s" class="lightbox-image" data-caption="">
                            <i class="flaticon-play-button"></i>
                            <span class="ripple"></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div id="content_block_04">
                        <div class="content-box">
                            <div class="sec-title"><h2>Video Demo App</h2></div>
                            <div class="text">Retarget past customers with second-chance offers and reach new audiences with geo-targeted campaigns during peak dining times using Forks’ push notifications.</div>
                            <div class="btn-box"><a href="#" class="theme-btn-two">Play Video Now</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <!-- video-section end -->


    <!-- counter-style-three -->
    <?php if($page->slug == 'about-us') { ?>
    <section class="counter-style-three">
        <div class="anim-icons">
            <div class="icon icon-1 rotate-me"></div>
            <div class="icon icon-2"></div>
            <div class="icon icon-3 rotate-me"></div>
        </div>
        <div class="container">
            <div class="sec-title center">
                <h2>Some Happy Clients</h2>
                <!-- <p>The full monty burke posh excuse my French Richard cheeky bobby spiffing crikey<br />Why gormless, pear shaped.!</p> -->
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="inner-box wow zoomIn animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="layer-bg" style="background-image: url(<?= $this->Url->assetUrl('images/icons/pattern-25.png') ?>);"></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500" data-stop="693">0</span>
                        </div>
                        <div class="text">Happy Clients</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="inner-box wow zoomIn animated" data-wow-delay="300ms" data-wow-duration="1500ms">
                        <div class="layer-bg" style="background-image: url(<?= $this->Url->assetUrl('images/icons/pattern-26.png') ?>);"></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500" data-stop="453">0</span>
                        </div>
                        <div class="text">Trusted Users</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="inner-box wow zoomIn animated" data-wow-delay="600ms" data-wow-duration="1500ms">
                        <div class="layer-bg" style="background-image: url(<?= $this->Url->assetUrl('images/icons/pattern-27.png') ?>);"></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500" data-stop="276">0</span>
                        </div>
                        <div class="text">Our Projects</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 counter-block">
                    <div class="inner-box wow zoomIn animated" data-wow-delay="900ms" data-wow-duration="1500ms">
                        <div class="layer-bg" style="background-image: url(<?= $this->Url->assetUrl('images/icons/pattern-28.png') ?>);"></div>
                        <div class="count-outer count-box">
                            <span class="count-text" data-speed="1500" data-stop="93">0</span>
                        </div>
                        <div class="text">Our Awards</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <!-- counter-style-three end -->


    <!-- subscribe-style-five -->
    <?php if($page->slug == 'about-us') { ?>
    <section class="subscribe-style-five">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 image-column">
                    <div id="image_block_38">
                        <div class="image-box">
                            <div class="bg-layer" style="background-image: url(<?= $this->Url->assetUrl('images/icons/user-icon.png') ?>);"></div>
                            <figure class="image float-bob-y clearfix"><img src="<?= $this->Url->assetUrl('images/resources/user-16.png') ?>" alt=""></figure>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 content-column">
                    <div id="content_block_41">
                        <div class="content-box">
                            <div class="sec-title"><h2>Subscribe our Newsletter</h2></div>
                            <div class="text">To get latest updates on our company please subscribe our news letter.</div>
                            <form action="#" method="post" class="subscribe-form">
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Enter Your Email" required="">
                                    <button type="submit" class="theme-btn-two">Subscribe Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
    <!-- subscribe-style-five end -->


    <!-- clients-style-four -->
    <?php if($page->slug == 'about-us') { ?>
    <section class="clients-style-four style-five">
        <div class="image-layer" style="background-image: url(<?= $this->Url->assetUrl('images/icons/layer-image-7.png') ?>);"></div>
        <div class="container">
            <div class="clients-carousel owl-carousel owl-theme owl-dots-none">
                <figure class="image-box"><a href="#"><img src="<?= $this->Url->assetUrl('images/clients/client-1.png') ?>" alt=""></a></figure>
                <figure class="image-box"><a href="#"><img src="<?= $this->Url->assetUrl('images/clients/client-2.png') ?>" alt=""></a></figure>
                <figure class="image-box"><a href="#"><img src="<?= $this->Url->assetUrl('images/clients/client-3.png') ?>" alt=""></a></figure>
                <figure class="image-box"><a href="#"><img src="<?= $this->Url->assetUrl('images/clients/client-4.png') ?>" alt=""></a></figure>
            </div>
        </div>
    </section>
    <?php } ?>
    <!-- clients-style-four end -->