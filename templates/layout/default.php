<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Accordance';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <?= $this->Html->css(['font-awesome-all', 'flaticon.css', 'owl', 'bootstrap', 'jquery.fancybox.min', 'animate', 'style', 'responsive']) ?>
    <?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>

    <?php $this->fetch('meta') ?>
    <?php $this->fetch('css') ?>
    <?php $this->fetch('script') ?>
</head>
<body class="boxed_wrapper">
    <!-- preloader -->
    <div class="preloader"></div>
    <!-- preloader -->
    <!-- main header -->
    <header class="main-header home-4">
        <div class="outer-container">
            <div class="container">
                <div class="main-box clearfix">
                    <div class="logo-box pull-left">
                        <figure class="logo"><a href="<?= $this->Url->build(['_name'=> 'Home']) ?>">
                        <?= $this->Html->image('logo-sm.png', ['alt'=>'Logo']); ?>
                        </a></figure>
                    </div>
                    <div class="menu-area pull-right clearfix">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li>
                                        <a href="<?= $this->Url->build(['_name'=> 'Home']) ?>">Home</a>
                                    </li>
                                    <li><a href="<?= $this->Url->build(["controller"=>"pages", "action"=>"view",'slug'=>$main->slug]) ?>"><?= $main->title ?></a>
                                    </li>
                                    <?php if($product_count){ ?>
                                    <li class="dropdown"><a href="javascript: void;">Products</a>
                                        <ul>
                                            <?php foreach($product as $key => $value){ ?>
                                                <li><a href="<?= $this->Url->build(["controller"=>"products", "action"=>"view",'slug'=>$value->slug]) ?>"><?= $value->name ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <li><a href="<?= $this->Url->build(['_name'=> 'contact']) ?>">Contact</a></li>
                                    <li><a href="<?= $this->Url->build(['_name'=> 'login']) ?>">Login</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!--sticky Header-->
        <div class="sticky-header">
            <div class="container clearfix">
                <figure class="logo-box"><a href="<?= $this->Url->build('/') ?>"><?= $this->Html->image('logo-sm.png', ['alt'=>'Logo']); ?></a></figure>
                <div class="menu-area">
                    <nav class="main-menu clearfix">
                        <!--Keep This Empty / Menu will come through Javascript-->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- main-header end -->
    <!-- Mobile Menu  -->
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><i class="fas fa-times"></i></div>

        <nav class="menu-box">
            <div class="nav-logo"><a href="<?= $this->Url->build(['_name'=> 'Home']) ?>"><?= $this->Html->image('logo-sm.png', ['alt'=>'Logo']); ?></a></div>
            <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
            <div class="contact-info">
                <h4>Contact Info</h4>
                <ul>
                    <li>Laxmi Nagar, Nagpur City, Maharastra</li>
                    <li><a href="tel:+919970192831">+91 997 0192 831</a></li>
                    <li><a href="mailto:support@accordance.co.in">support@accordance.co.in</a></li>
                </ul>
            </div>
            <div class="social-links">
                <ul class="clearfix">
                    <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                    <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                    <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                    <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                    <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- End Mobile Menu -->
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
    <!-- main-footer -->
    <footer class="main-footer style-two">
        <div class="image-layer" style="background-image: url(<?= $this->Url->assetUrl('images/icons/footer-bg-5.png') ?>);"></div>
        <div class="container">
            <div class="footer-top">
                <div class="widget-section">
                    <div class="row">
                        <div class="col-lg-5 col-md-6 col-sm-12 footer-column">
                            <div class="about-widget footer-widget">
                                <figure class="footer-logo"><a href="<?= $this->Url->build(['_name'=> 'Home']) ?>"><?= $this->Html->image('logo-sm.png', ['alt'=>'Logo']); ?></a></figure>
                                <div class="text">Accordance is committed to provide process transparency & high quality products to our customers within the confines of their budget & schedules.</div>
                                <ul class="social-links">
                                    <li><h6>Follow Us :</h6></li>
                                    <li><a href="https://www.facebook.com/accordanceIndia" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <!-- <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-skype"></i></a></li> -->
                                    <li><a href="https://www.linkedin.com/company/accordance-india" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                                <figure class="footer-logo"><a href="https://play.google.com/store/apps/details?id=in.co.accordance.invoice&hl=en_IN" target="_blank"><?= $this->Html->image('play-store.png', ['alt'=>'Logo','style'=>'width:30%;']); ?></a></figure>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="links-widget footer-widget">
                                <h4 class="widget-title">Links</h4>
                                <div class="widget-content">
                                    <ul class="list clearfix">
                                        <li><a href="<?= $this->Url->build(["controller"=>"pages", "action"=>"index"]) ?>">Home</a></li>
                                        <li><a href="<?= $this->Url->build(["controller"=>"pages", "action"=>"view",$main->slug]) ?>">About Us</a></li>
                                        <?php foreach ($footer as $key => $value) { ?>
                                        <li><a href="<?= $this->Url->build(["controller"=>"pages", "action"=>"view",$value->slug]) ?>"><?= $value->title ?></a></li>
                                        <?php } ?>
                                        <li><a href="<?= $this->Url->build(['_name'=> 'contact']) ?>">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="contact-widget footer-widget">
                                <h4 class="widget-title">Contact Info</h4>
                                <div class="widget-content">
                                    <ul class="list clearfix">
                                        <li><i class="fas fa-map-marker-alt"></i>IT Park, South Ambazari Road, <br />Nagpur, Maharashtra - 440022</li>
                                        <li>
                                            <i class="fas fa-phone-volume"></i>
                                            <a href="tel:+919970192831">(+91) 997 - 019 - 2831</a><br />
                                            <a href="tel:+917276070179">(+91) 727 - 607 - 0179</a>
                                        </li>
                                        <li>
                                            <i class="fas fa-envelope"></i>
                                            <a href="mailto:support@accordance.co.in">support@accordance.co.in</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="copyright">&copy; <?= date('Y') ?> <a href="<?= $this->Url->build(['_name'=> 'Home']) ?>">Accordance</a>. All rights reserved</div>
            </div>
        </div>
    </footer>
    <!-- main-footer end -->
    <!--Scroll to top-->
    <button class="scroll-top scroll-to-target" data-target="html">
        <span class="fa fa-arrow-up"></span>
    </button>
    <!-- Request for Demo popup -->
    <div class="modal fade bd-example-modal-lg" id="requestDemo" tabindex="-1" role="dialog" aria-labelledby="requestDemoCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="requestDemoLongTitle">Request for Demo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <section class="contact-section request-section">
                        <div class="contact-form-area">
                            <div class="form-inner">
                                <form method="post" action="<?= $this->Url->build(["controller"=>"pages", "action"=>"request"]) ?>" id="request-form" class="default-form">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <i class="fas fa-user"></i>
                                                <input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" name="name" id="name">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <i class="fas fa-envelope"></i>
                                                <input type="text" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" name="email" id="email">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <i class="fas fa-phone"></i>
                                                <input type="text" name="mobile" id="mobile" class="allownumericwithoutdecimal form-control" maxlength="10" placeholder="Mobile" aria-label="Mobile" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <textarea name="message" id="message" row="2" class="form-control" style="height:150px;" placeholder="Your Requirement"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group message-btn centred">
                                                <button type="submit" class="theme-btn-two" id="request" name="submit-form">Submit Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- jequery plugins -->
    <?= $this->Html->script(['jquery', 'popper.min', 'bootstrap.min', 'owl', 'wow', 'validation', 'jquery.fancybox', 'appear', 'scrollbar', 'jquery.paroller.min', 'tilt.jquery', 'http://maps.google.com/maps/api/js?key=AIzaSyATY4Rxc8jNvDpsK8ZetC7JyN4PFVYGCGM', 'gmaps', 'map-helper','sweetalert.min.js'])?>

    <!-- main-js -->
    <?php /* echo $this->Html->scriptBlock(sprintf(
        'var csrfToken = %s;',
        json_encode($this->request->getAttribute('csrfToken'))
    ));  */?>
    <?= $this->Html->script('script') ?>
</body>
</html>
