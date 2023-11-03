<?php $__env->startSection('content'); ?>
    <style>
        .btn {
            border: none;
            border-radius: 3px;
            box-shadow: none;
            font-size: 12px;
            font-weight: 500;
            padding: 8px 20px;
            transition: background .2s,color .2s
        }
    </style>
    
    <h2 class="title-bar no-border-bottom">
        <?php echo e(__("Daftar Jamaah")); ?>

    </h2>
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-left d-inline">
                <a href="<?php echo e(route('vendor.team.create')); ?>" class="btn btn-success btn-sm mt-3">
                    <i class="fa fa-plus"></i> Tambah
                </a>
            </div>
            <table class="table table-bordered table-striped table-sm" data-toggle="table" data-search="true" data-show-columns="true" width="100%" cellspacing="0" style="font-size: small;">
                <thead style="text-align: center;">
                    <tr>
                        <th width="2%" data-sortable="true"><?php echo e(__("No.")); ?></th>
                        <th data-field="name" data-sortable="true"><?php echo e(__("Nama")); ?></th>
                        <th data-field="email" data-sortable="true"><?php echo e(__("Alamat Email")); ?></th>
                        <th data-field="phone" data-sortable="true"><?php echo e(__("No. Telpon")); ?></th>
                        <th data-field="created_at" data-sortable="true"><?php echo e(__("Tgl Pendaftaran")); ?></th>
                        <th data-field="status" data-sortable="true"><?php echo e(__("Status")); ?></th>
                        <th data-sortable="true"><?php echo e(__("Aksi")); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0; ?>
                    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendorTeam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="text-align: center;"><?php echo e($loop->iteration); ?></td>
                            <td>
                                <?php echo e($vendorTeam->member->display_name ?? '-'); ?>

                            </td>
                            <td>
                                <?php echo e($vendorTeam->member->email?? '-'); ?>

                            </td>
                            <td>
                                <?php echo e($vendorTeam->member->phone?? '-'); ?>

                            </td>
                            <td style="text-align: center;">
                                <?php if($vendorTeam->member->created_at): ?>
                                    <?php echo date('d-m-Y H:i:s', strtotime($vendorTeam->member->created_at)); ?>

                                <?php else: ?>
                                    <?php echo e('-'); ?>

                                <?php endif; ?>
                            </td>
                            <td style="text-align: center;">
                                <span class="btn-success btn-sm">
                                    <?php echo e($vendorTeam->status_text); ?>

                                </span>
                            </td>
                            <td style="text-align: center;">
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        <?php echo e(__("Aksi")); ?>

                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="<?php echo e(route('vendor.team.edit',['vendorTeam'=>$vendorTeam->member->id])); ?>"><?php echo e(__("Ubah")); ?></a>
                                        <?php if($vendorTeam->status == Modules\Vendor\Models\VendorTeam::STATUS_PENDING): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('vendor.team.re-send-request',['vendorTeam'=>$vendorTeam])); ?>"><?php echo e(__("Send email")); ?></a>
                                        <?php endif; ?>
                                        <a class="dropdown-item" href="<?php echo e(URL::signedRoute('vendor.team.delete',['vendorTeam'=>$vendorTeam->member->id])); ?>"><?php echo e(__("Hapus")); ?></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u1568686/public_html/themes/Base/Vendor/Views/frontend/team/index.blade.php ENDPATH**/ ?>