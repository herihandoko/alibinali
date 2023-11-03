<form class="form bravo-form-register" method="post" action="<?php echo e(route('auth.register.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="form-row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <input type="text" class="form-control" name="first_name" autocomplete="off" placeholder="<?php echo e(__("Nama Depan")); ?>">
                <i class="input-icon field-icon icofont-waiter-alt"></i>
                <span class="invalid-feedback error error-first_name"></span>
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <input type="text" class="form-control" name="last_name" autocomplete="off" placeholder="<?php echo e(__("Nama Belakang")); ?>">
                <i class="input-icon field-icon icofont-waiter-alt"></i>
                <span class="invalid-feedback error error-last_name"></span>
            </div>
        </div>
    </div>
    
    <div class="form-row">
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <input type="text" class="form-control" name="phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off" placeholder="<?php echo e(__('Nomor Telp. Aktif')); ?>">
                <i class="input-icon field-icon icofont-ui-touch-phone"></i>
                <span class="invalid-feedback error error-phone"></span>
            </div>
        </div>
        
        <div class="col-lg-6 col-md-12">
            <div class="form-group">
                <input type="email" class="form-control" name="email" autocomplete="off" placeholder="<?php echo e(__('Alamat Email Aktif')); ?>">
                <i class="input-icon field-icon icofont-mail"></i>
                <span class="invalid-feedback error error-email"></span>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <input type="password" class="form-control" name="password" autocomplete="off" placeholder="<?php echo e(__('Password')); ?>">
        <i class="input-icon field-icon icofont-ui-password"></i>
        <span class="invalid-feedback error error-password"></span>
    </div>
    
    <div class="form-group">
        <input type="text" class="form-control" name="referral_code" autocomplete="off" placeholder="<?php echo e(__('Kode Referral')); ?>">
        <i class="input-icon field-icon icofont-group"></i>
        <span class="invalid-feedback error error-referral_code"></span>
    </div>
    
    <div class="form-group">
        <label for="term">
            <input id="term" type="checkbox" name="term" class="mr5">
            <?php echo __("Saya telah membaca dan menerima <a href=':link' target='_blank'>Syarat dan Kebijakan Privasi</a>",['link'=>get_page_url(setting_item('booking_term_conditions'))]); ?>

            <span class="checkmark fcheckbox"></span>
        </label>
        <div><span class="invalid-feedback error error-term"></span></div>
    </div>
    <?php if(setting_item("user_enable_register_recaptcha")): ?>
        <div class="form-group">
            <?php echo e(recaptcha_field($captcha_action ?? 'register')); ?>

        </div>
        <div><span class="invalid-feedback error error-g-recaptcha-response"></span></div>
    <?php endif; ?>
    <div class="error message-error invalid-feedback"></div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary form-submit">
            <?php echo e(__('Daftar')); ?>

            <span class="spinner-grow spinner-grow-sm icon-loading" role="status" aria-hidden="true"></span>
        </button>
    </div>
    <?php if(setting_item('facebook_enable') or setting_item('google_enable') or setting_item('twitter_enable')): ?>
        <div class="advanced">
            <p class="text-center f14 c-grey"><?php echo e(__("or continue with")); ?></p>
            <div class="row">
                <?php if(setting_item('facebook_enable')): ?>
                    <div class="col-xs-12 col-sm-4">
                        <a href="<?php echo e(url('/social-login/facebook')); ?>" class="btn btn_login_fb_link"
                           data-channel="facebook">
                            <i class="input-icon fa fa-facebook"></i>
                            <?php echo e(__('Facebook')); ?>

                        </a>
                    </div>
                <?php endif; ?>
                <?php if(setting_item('google_enable')): ?>
                    <div class="col-xs-12 col-sm-4">
                        <a href="<?php echo e(url('social-login/google')); ?>" class="btn btn_login_gg_link" data-channel="google">
                            <i class="input-icon fa fa-google"></i>
                            <?php echo e(__('Google')); ?>

                        </a>
                    </div>
                <?php endif; ?>
                <?php if(setting_item('twitter_enable')): ?>
                    <div class="col-xs-12 col-sm-4">
                        <a href="<?php echo e(url('social-login/twitter')); ?>" class="btn btn_login_tw_link" data-channel="twitter">
                            <i class="input-icon fa fa-twitter"></i>
                            <?php echo e(__('Twitter')); ?>

                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="c-grey f14 text-center">
       <?php echo e(__("Sudah memiliki akun?")); ?>

        <a href="#" data-target="#login" data-toggle="modal"><?php echo e(__("Log In")); ?></a>
    </div>
</form>
<?php /**PATH /home/u1568686/public_html/modules/Layout/auth/register-form.blade.php ENDPATH**/ ?>