<?php $__env->startSection('content'); ?>
<h2 class="title-bar no-border-bottom">
    <?php echo e(__('Virtual Account')); ?>

</h2>
<?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.notifva', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="booking-history-manager">
    <div class="text-center">
        <img src="/images/btn-logo.png" class="rounded" alt="BTN Logo" height="50px">
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <table class="table">
                <tbody>
                    <tr>
                        <td style="border-top: 1px solid #ffffff;" width="50%"><?php echo e(__('Virtual Code')); ?></td>
                        <td style="border-top: 1px solid #ffffff;" width="5%">:</td>
                        <td style="border-top: 1px solid #ffffff;"><?php echo e(isset($dataUser->va_number) ? '9600' : '-'); ?></td>
                    </tr>
                    <tr>
                        <td width="50%"> <?php echo e(__('Virtual Account Name')); ?></td>
                        <td width="5%">:</td>
                        <td><?php echo e(isset($dataUser->va_name) ? $dataUser->va_name : '-'); ?></td>
                    </tr>
                    <tr>
                        <td width="50%"><?php echo e(__('Virtual Account Number')); ?></td>
                        <td width="5%">:</td>
                        <td><?php echo e(isset($dataUser->va_number) ? $dataUser->va_number : '-'); ?></td>
                    </tr>
                    <tr>
                        <td width="50%"><?php echo e(__('Jamaah Number')); ?></td>
                        <td width="5%">:</td>
                        <td><?php echo e(isset($dataUser->customer_number) ? $dataUser->customer_number : '-'); ?></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid #dee2e6;" width="50%"><?php echo e(__('Balance')); ?></td>
                        <td style="border-bottom: 1px solid #dee2e6;" width="5%">:</td>
                        <td style="border-bottom: 1px solid #dee2e6;"><a href="<?php echo e(route("user.booking_history")); ?>"><?php echo e(isset($dataUser->balance) ? 'Rp 0.00' : '-'); ?></a></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid #dee2e6;" width="50%"><?php echo e(__('Expired Date')); ?></td>
                        <td style="border-bottom: 1px solid #dee2e6;" width="5%">:</td>
                        <td style="border-bottom: 1px solid #dee2e6;">-</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u1568686/public_html/themes/Base/User/Views/frontend/virtualAccount.blade.php ENDPATH**/ ?>