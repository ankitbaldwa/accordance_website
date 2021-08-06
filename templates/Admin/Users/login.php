<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v2 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(assets/media/bg/bg-1.jpg);">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                <div class="kt-login__container">
                    <div class="kt-login__logo">
                        <a href="#">
                            <?php echo $this->Html->image('Accordance_logo.png', ['alt' => 'Logo','width'=>'70%']); ?>
                        </a>
                    </div>
                    <div class="kt-login__signin">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Sign In To Admin</h3>
                        </div>
                        <?= $this->Form->create(null, ['class'=>'kt-form']) ?>
                            <div class="input-group">
                                <?= $this->Form->text('email', ['class' => 'form-control', 'placeholder'=>'Email', 'name'=>'email', 'autocomplete'=>'off']) ?>
                            </div>
                            <div class="input-group">
                                <?= $this->Form->password('password', ['class' => 'form-control', 'placeholder'=>'Password', 'name'=>'password', 'autocomplete'=>'off']) ?>
                            </div>
                            <div class="row kt-login__extra">
                                <div class="col">
                                    <label class="kt-checkbox">
                                        <?= $this->Form->checkbox('remember', ['hiddenField' => false]); ?>
                                        Remember me
                                        <span></span>
                                    </label>
                                </div>
                                <!--<div class="col kt-align-right">
                                    <a href="javascript:;" id="kt_login_forgot" class="kt-link kt-login__link">Forget Password ?</a>
                                </div>-->
                            </div>
                            <div class="kt-login__actions">
                                <?= $this->Form->button('Sign In',['type' => 'submit','escapeTitle' => false, 'class'=>'btn btn-pill kt-login__btn-primary','id'=>'kt_login_signin_submit']); ?>
                            </div>
                        <?= $this->Form->end() ?>
                    </div>
                    <!--<div class="kt-login__signup">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Sign Up</h3>
                            <div class="kt-login__desc">Enter your details to create your account:</div>
                        </div>
                        <form class="kt-login__form kt-form" action="">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Fullname" name="fullname">
                            </div>
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Email" name="email" autocomplete="off">
                            </div>
                            <div class="input-group">
                                <input class="form-control" type="password" placeholder="Password" name="password">
                            </div>
                            <div class="input-group">
                                <input class="form-control" type="password" placeholder="Confirm Password" name="rpassword">
                            </div>
                            <div class="row kt-login__extra">
                                <div class="col kt-align-left">
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="agree">I Agree the <a href="#" class="kt-link kt-login__link kt-font-bold">terms and conditions</a>.
                                        <span></span>
                                    </label>
                                    <span class="form-text text-muted"></span>
                                </div>
                            </div>
                            <div class="kt-login__actions">
                                <button id="kt_login_signup_submit" class="btn btn-pill kt-login__btn-primary">Sign Up</button>&nbsp;&nbsp;
                                <button id="kt_login_signup_cancel" class="btn btn-pill kt-login__btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>-->
                    <!--<div class="kt-login__forgot">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Forgotten Password ?</h3>
                            <div class="kt-login__desc">Enter your email to reset your password:</div>
                        </div>
                        <form class="kt-form" action="">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Email" name="email" id="kt_email" autocomplete="off">
                            </div>
                            <div class="kt-login__actions">
                                <button id="kt_login_forgot_submit" class="btn btn-pill kt-login__btn-primary">Request</button>&nbsp;&nbsp;
                                <button id="kt_login_forgot_cancel" class="btn btn-pill kt-login__btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>-->
                    <!--<div class="kt-login__account">
                        <span class="kt-login__account-msg">
                            Don't have an account yet ?
                        </span>&nbsp;&nbsp;
                        <a href="javascript:;" id="kt_login_signup" class="kt-link kt-link--light kt-login__account-link">Sign Up</a>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<!--begin::Page Scripts(used by this page) -->
<?= $this->Html->script(['../assets/js/pages/custom/login/login-general.js']) ?>

<!--end::Page Scripts -->