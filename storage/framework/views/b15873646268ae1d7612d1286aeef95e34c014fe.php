<?php $__env->startSection('content'); ?>
<h2 class="title-bar no-border-bottom">
    <?php echo e(__('Daftar Paket')); ?>

</h2>
<?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row justify-content-center">
    <?php $__currentLoopData = $list_paket; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-12 col-xl-12 mb-2">
        <div class="card shadow-0 border rounded-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                        <div class="bg-image hover-zoom ripple rounded ripple-surface">
                            <img src="<?php echo e($tour->title); ?>"class="w-100" />
                            <a href="#!">
                                <div class="hover-overlay">
                                    <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <h5><?php echo e($tour->title); ?></h5>
                        <div class="d-flex flex-row">
                            <div class="text-danger mb-1 me-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                            <span>145</span>
                        </div>
                        <div class="mt-1 mb-0 text-muted small">
                            <span>100% cotton</span>
                            <span class="text-primary"> • </span>
                            <span>Light weight</span>
                            <span class="text-primary"> • </span>
                            <span>Best finish<br /></span>
                        </div>
                        <div class="mb-2 text-muted small">
                            <span>Unique design</span>
                            <span class="text-primary"> • </span>
                            <span>For women</span>
                            <span class="text-primary"> • </span>
                            <span>Casual<br /></span>
                        </div>
                        <p class="text-truncate mb-4 mb-md-0">
                            There are many variations of passages of Lorem Ipsum available, but the
                            majority have suffered alteration in some form, by injected humour, or
                            randomised words which don't look even slightly believable.
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                        <div class="d-flex flex-row align-items-center mb-1">
                            <h4 class="mb-1 me-1">$17.99</h4>
                            <span class="text-danger"><s>$25.99</s></span>
                        </div>
                        <h6 class="text-success">Free shipping</h6>
                        <div class="d-flex flex-column mt-4">
                            <button class="btn btn-primary btn-sm" type="button">Lihat Detail</button>
                            <button class="btn btn-outline-primary btn-sm mt-2" type="button">
                                Pesan Sekarang
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u1568686/public_html/themes/Base/User/Views/frontend/listPackage.blade.php ENDPATH**/ ?>