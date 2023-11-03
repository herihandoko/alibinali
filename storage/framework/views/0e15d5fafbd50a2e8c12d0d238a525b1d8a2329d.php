<?php if(auth()->user()->status_profile == 0): ?>
<div class="alert alert-danger alert-block" style="color:#ff0018 !important;">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong><?php echo clean('Informasi'); ?></strong>
    <p><?php echo clean('Silahkan lengkapi data diri Anda pada menu Profile untuk mendapatkan Virtual Account Number pembayaran.'); ?> <b><a href="<?php echo e(route('user.profile.index')); ?>">Lengkapi</a></b></p>
</div>
<?php endif; ?><?php /**PATH /home/u1568686/public_html/resources/views/admin/notifva.blade.php ENDPATH**/ ?>