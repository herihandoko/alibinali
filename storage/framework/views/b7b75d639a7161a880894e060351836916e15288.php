
<?php $__env->startSection('content'); ?>
    <h2 class="title-bar">
        <?php echo e(__("Ubah Password")); ?>

    </h2>
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <form action="<?php echo e(route("user.change_password.update")); ?>" method="post">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><?php echo e(__("Password Saat Ini")); ?></label>
                    <input type="password" required name="current-password" placeholder="<?php echo e(__("Password Saat Ini")); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label><?php echo e(__("Password Baru")); ?></label>
                    <input type="password" required name="new-password" minlength="8" placeholder="<?php echo e(__("Password Baru")); ?>" class="form-control">
                    <p><i><?php echo e(__("* Password mengandung setidaknya satu huruf besar, satu huruf kecil, satu angka, dan satu simbol.")); ?></i></p>
               </div>
                <div class="form-group">
                    <label><?php echo e(__("Konfirmasi Password")); ?></label>
                    <input type="password" required name="new-password_confirmation" minlength="8" placeholder="<?php echo e(__("Konfirmasi Password")); ?>" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <hr>
                <input type="submit" class="btn btn-primary" value="<?php echo e(__("Ubah Password")); ?>">
                <a href="<?php echo e(route("user.profile.index")); ?>" class="btn btn-default"><?php echo e(__("Batal")); ?></a>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u1568686/public_html/themes/Base/User/Views/frontend/changePassword.blade.php ENDPATH**/ ?>