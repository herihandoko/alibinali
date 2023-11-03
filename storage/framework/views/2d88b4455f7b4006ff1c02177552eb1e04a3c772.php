<div class="panel">
    <div class="panel-title"><strong><?php echo e(__("COGS")); ?></strong></div>
    <div class="panel-body">
        <div class="form-group">
            <label class="control-label"><?php echo e(__("COGS Package")); ?></label>
            <div class="">
                <select id="cogs_id" name="cogs_id" class="form-control">
                    <option value=""><?php echo e(__("-- Please Select --")); ?></option>
                    <?php $__currentLoopData = $cogs_packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($val->id); ?>" data-harga="<?php echo e($val->hpp->total_hpp); ?>" <?php if($val->id == $row->cogs_id): ?> selected <?php endif; ?>><?php echo e($val->nama_makanan); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    </div>
</div>
<?php $__env->startPush('js'); ?>
<script>
    $('select#cogs_id').change(function (data) {
        var price = $(this).find(':selected').data('harga');
        $('input#tour_price').val(price);
    });
    $('select#cogs_id').select2();
</script>
<?php $__env->stopPush(); ?><?php /**PATH /home/u1568686/public_html/modules/Tour/Views/admin/tour/cogs.blade.php ENDPATH**/ ?>