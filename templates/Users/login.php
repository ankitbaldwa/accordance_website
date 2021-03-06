<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v6 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
            <div class="kt-grid__item  kt-grid__item--order-tablet-and-mobile-2  kt-grid kt-grid--hor kt-login__aside">
                <div class="kt-login__wrapper">
                    <div class="kt-login__container">
                        <div class="kt-login__body">
                            <div class="kt-login__logo">
                                <a href="<?= $this->Url->build(['_name'=> 'Home']) ?>">
                                    <?= $this->Html->image('logo-sm.png', ['alt'=>'Logo']); ?>
                                </a>
                            </div>
                            <div class="kt-login__signin">
                                <div class="kt-login__head">
                                    <h3 class="kt-login__title">Sign In</h3>
                                </div>
                                <div class="kt-login__form">
                                    <form class="kt-form" action="">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control form-control-last" type="password" placeholder="Password" name="password">
                                        </div>
                                        <div class="kt-login__extra">
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="remember"> Remember me
                                                <span></span>
                                            </label>
                                            <a href="javascript:;" id="kt_login_forgot">Forget Password ?</a>
                                        </div>
                                        <div class="kt-login__actions">
                                            <button id="kt_login_signin_submit" class="btn btn-brand btn-pill btn-elevate">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="kt-login__signup">
                                <div class="kt-login__head">
                                    <h3 class="kt-login__title">Sign Up</h3>
                                    <div class="kt-login__desc">Enter your details to create your account:</div>
                                </div>
                                <div class="kt-login__form">
                                    <form class="kt-form" action="">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Fullname" name="fullname">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" type="password" placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control form-control-last" type="password" placeholder="Confirm Password" name="rpassword">
                                        </div>
                                        <div class="kt-login__extra">
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="agree"> I Agree the <a href="#">terms and conditions</a>.
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-login__actions">
                                            <button id="kt_login_signup_submit" class="btn btn-brand btn-pill btn-elevate">Sign Up</button>
                                            <button id="kt_login_signup_cancel" class="btn btn-outline-brand btn-pill">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="kt-login__forgot">
                                <div class="kt-login__head">
                                    <h3 class="kt-login__title">Forgotten Password ?</h3>
                                    <div class="kt-login__desc">Enter your email to reset your password:</div>
                                </div>
                                <div class="kt-login__form">
                                    <form class="kt-form" action="">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
                                        </div>
                                        <div class="kt-login__actions">
                                            <button id="kt_login_forgot_submit" class="btn btn-brand btn-pill btn-elevate">Request</button>
                                            <button id="kt_login_forgot_cancel" class="btn btn-outline-brand btn-pill">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-login__account">
                        <span class="kt-login__account-msg">
                            Don't have an account yet ?
                        </span>&nbsp;&nbsp;
                        <a href="javascript:;" id="kt_login_signup" class="kt-login__account-link">Sign Up!</a>
                    </div>
                </div>
            </div>
            <div class="kt-grid__item kt-grid__item--fluid kt-grid__item--center kt-grid kt-grid--ver kt-login__content" style="background-image: url(<?= $this->Url->assetUrl('assets/media/bg/bg-4.jpg') ?>);">
                <div class="kt-login__section">
                    <div class="kt-login__block">
                        <h3 class="kt-login__title">Join Our Community</h3>
                        <div class="kt-login__desc">
                            <div class="kt-section">
                                <div class="kt-section__content--border kt-section__content--fit">
                                    <ul class="kt-nav kt-nav--bold kt-nav--md-space kt-nav--v4" role="tablist">
                                        <li class="kt-nav">
                                            <a class="kt-nav__link-text color-white" href="<?= $this->Url->build(['_name'=> 'Home']) ?>">Home</a>
                                        </li>
                                        <li class="kt-nav">
                                            <a class="kt-nav__link-text color-white" href="<?= $this->Url->build(['_name'=> 'contact']) ?>">Contact</a>
                                        </li>
                                        <?php foreach ($footer as $key => $value) { ?>
                                            <li class="kt-nav"><a class="kt-nav__link-text color-white" href="<?= $this->Url->build(["controller"=>"pages", "action"=>"view",$value->slug]) ?>"><?= $value->title ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->
<?= $this->Html->script(['../assets/js/pages/custom/login/login-general']) ?>
