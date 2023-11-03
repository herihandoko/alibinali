<?php $__env->startSection('content'); ?>
    <h2 class="title-bar no-border-bottom">
        <?php echo e(__("Biodata Jamaah")); ?>

    </h2>
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <form action="<?php echo e(route('vendor.team.store', ['vendorTeam'=>$row->id ?? '0'])); ?>" method="post" class="input-has-icon">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Nama Depan (sesuai paspor)")); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo e(old('first_name',$row->first_name)); ?>" name="first_name" placeholder="<?php echo e(__("Nama Depan")); ?>" class="form-control form-control-sm" required>
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Nama Belakang (sesuai paspor)")); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo e(old('last_name',$row->last_name)); ?>" name="last_name" placeholder="<?php echo e(__("Nama Belakang")); ?>" class="form-control form-control-sm" required>
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Nama Ayah Kandung")); ?></label>
                            <input type="text" value="<?php echo e(old('father_name',$row->father_name)); ?>" name="father_name" placeholder="<?php echo e(__("Nama Ayah Kandung")); ?>" class="form-control form-control-sm">
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Nama Ibu Kandung")); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo e(old('mother_name',$row->mother_name)); ?>" name="mother_name" placeholder="<?php echo e(__("Nama Ibu Kandung")); ?>" class="form-control form-control-sm" required>
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo e(__("Tempat Lahir")); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo e(old('birthcity',$row->birthcity)); ?>" name="birthcity" placeholder="<?php echo e(__("Tempat Lahir")); ?>" class="form-control form-control-sm" required>
                            <i class="fa fa-building input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo e(__("Tgl Lahir")); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo e(old('birthday',$row->birthday? display_date($row->birthday) :'')); ?>" name="birthday" placeholder="<?php echo e(__("Tgl Lahir")); ?>" class="form-control date-picker" required>
                            <i class="fa fa-birthday-cake input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo e(__("Jenis Kelamin")); ?> <span class="text-danger">*</span></label>
                            <div>
                                <input <?php if($row->gender=='lakilaki'): ?> checked <?php endif; ?> type="radio" name="gender" value="lakilaki"> <?php echo e(__("Laki-Laki")); ?>

                                <input <?php if($row->gender=='perempuan'): ?> checked <?php endif; ?> type="radio" name="gender" value="perempuan"> <?php echo e(__("Perempuan")); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo e(__("Status Pernikahan")); ?> <span class="text-danger">*</span></label>
                            <select name="married_status" class="form-control" required>
                                <option value=""><?php echo e(__('-- Pilih --')); ?></option>
                                <?php $__currentLoopData = get_married_status_lists(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if((old('married_status',$row->married_status ?? '')) == $id): ?> selected <?php endif; ?> value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Alamat E-mail Aktif")); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="email" value="<?php echo e(old('email',$row->email)); ?>" placeholder="<?php echo e(__("Alamat E-mail Aktif")); ?>" class="form-control" required>
                            <i class="fa fa-envelope input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("No. HP Aktif")); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo e(old('phone',$row->phone)); ?>" name="phone" placeholder="<?php echo e(__("No. HP Aktif")); ?>" class="form-control" required>
                            <i class="fa fa-phone input-icon"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo e(__("Alamat")); ?> <span class="text-danger">*</span></label>
                            <textarea name="address" rows="5" cols="5" placeholder="<?php echo e(__("Alamat")); ?>" class="form-control" required>
                                <?php echo e(old('address') ?? isset($row)?$row->address:''); ?>

                            </textarea>
                            <i class="fa fa-location-arrow input-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Pekerjaan/Jabatan")); ?></label>
                            <input type="text" name="job" value="<?php echo e(old('job',$row->job)); ?>" placeholder="<?php echo e(__("Pekerjaan/Jabatan")); ?>" class="form-control">
                            <i class="fa fa-suitcase input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Pendidikan Terakhir")); ?></label>
                            <select name="last_edu" class="form-control">
                                <option value=""><?php echo e(__('-- Pilih --')); ?></option>
                                <?php $__currentLoopData = get_last_edu_lists(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if((old('last_edu',$row->last_edu ?? '')) == $id): ?> selected <?php endif; ?> value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Sebutkan penyakit khusus Anda (jika ada)")); ?></label>
                            <input type="text" name="special_disease" value="<?php echo e(old('special_disease',$row->special_disease)); ?>" placeholder="<?php echo e(__("Sebutkan penyakit khusus Anda (jika ada)")); ?>" class="form-control">
                            <i class="fa fa-medkit input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Sebutkan penanganan khusus Anda (jika ada)")); ?></label>
                            <input type="text" name="special_handling" value="<?php echo e(old('special_handling',$row->special_handling)); ?>" placeholder="<?php echo e(__("Sebutkan penanganan khusus Anda (jika ada)")); ?>" class="form-control">
                            <i class="fa fa-stethoscope input-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(__("Pernah Pergi Umrah?")); ?></label>
                            <div>
                                <input <?php if($row->umrah_ever=='ya'): ?> checked <?php endif; ?> type="radio" name="umrah_ever" value="ya"> <?php echo e(__("Ya")); ?>

                                <input <?php if($row->umrah_ever=='tidak'): ?> checked <?php endif; ?> type="radio" name="umrah_ever" value="tidak" checked> <?php echo e(__("Tidak")); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(__("Pernah Pergi Haji?")); ?></label>
                            <div>
                                <input <?php if($row->haji_ever=='ya'): ?> checked <?php endif; ?> type="radio" name="haji_ever" value="ya"> <?php echo e(__("Ya")); ?>

                                <input <?php if($row->haji_ever=='tidak'): ?> checked <?php endif; ?> type="radio" name="haji_ever" value="tidak" checked> <?php echo e(__("Tidak")); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(__("Kebutuhan Fasilitas Kursi Roda")); ?> <span class="text-danger">*</span></label>
                            <div>
                                <input <?php if($row->wheelchair_facilities=='ya'): ?> checked <?php endif; ?> type="radio" name="wheelchair_facilities" value="ya"> <?php echo e(__("Ya")); ?>

                                <input <?php if($row->wheelchair_facilities=='tidak'): ?> checked <?php endif; ?> type="radio" name="wheelchair_facilities" value="tidak" checked> <?php echo e(__("Tidak")); ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Foto")); ?> <span class="text-danger">*</span></label>
                            <div class="upload-btn-wrapper upload-foto">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file btn-foto">
                                            <?php echo e(__("Browse")); ?>… <input type="file" accept=".png, .jpg, .jpeg">
                                        </span>
                                    </span>
                                    <input type="text" data-error="<?php echo e(__("Error upload...")); ?>" data-loading="<?php echo e(__("Loading...")); ?>" class="form-control text-view text-foto" readonly value="<?php echo e(get_file_url( old('avatar_id',$row->avatar_id) ) ?? $row->getAvatarUrl()?? __("No Image")); ?>">
                                </div>
                                <input type="hidden" class="form-control" name="avatar_id" value="<?php echo e(old('avatar_id',$row->avatar_id)?? ""); ?>">
                                <img class="image-demo image-foto" src="<?php echo e(get_file_url( old('avatar_id',$row->avatar_id) ) ??  $row->getAvatarUrl() ?? ""); ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("KTP")); ?> <span class="text-danger">*</span></label>
                            <div class="upload-btn-wrapper upload-ktp">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file btn-ktp">
                                            <?php echo e(__("Browse")); ?>… <input type="file" accept=".png, .jpg, .jpeg">
                                        </span>
                                    </span>
                                    <input type="text" data-error="<?php echo e(__("Error upload...")); ?>" data-loading="<?php echo e(__("Loading...")); ?>" class="form-control text-view text-ktp" readonly value="<?php echo e(get_file_url( old('idcard_id',$row->idcard_id) ) ?? $row->getIdcardUrl()?? __("No Image")); ?>">
                                </div>
                                <input type="hidden" class="form-control" name="idcard_id" value="<?php echo e(old('idcard_id',$row->idcard_id)?? ""); ?>">
                                <img class="image-demo image-ktp" src="<?php echo e(get_file_url( old('idcard_id',$row->idcard_id) ) ??  $row->getIdcardUrl() ?? ""); ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Kartu Keluarga")); ?> <span class="text-danger">*</span></label>
                            <div class="upload-btn-wrapper upload-kk">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file btn-kk">
                                            <?php echo e(__("Browse")); ?>… <input type="file" accept=".png, .jpg, .jpeg">
                                        </span>
                                    </span>
                                    <input type="text" data-error="<?php echo e(__("Error upload...")); ?>" data-loading="<?php echo e(__("Loading...")); ?>" class="form-control text-view text-kk" readonly value="<?php echo e(get_file_url( old('familycard_id',$row->familycard_id) ) ?? $row->getFamilycardUrl()?? __("No Image")); ?>">
                                </div>
                                <input type="hidden" class="form-control" name="familycard_id" value="<?php echo e(old('familycard_id',$row->familycard_id)?? ""); ?>">
                                <img class="image-demo image-kk" src="<?php echo e(get_file_url( old('familycard_id',$row->familycard_id) ) ??  $row->getFamilycardUrl() ?? ""); ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Paspor")); ?></label>
                            <div class="upload-btn-wrapper upload-paspor">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file btn-paspor">
                                            <?php echo e(__("Browse")); ?>… <input type="file" accept=".png, .jpg, .jpeg">
                                        </span>
                                    </span>
                                    <input type="text" data-error="<?php echo e(__("Error upload...")); ?>" data-loading="<?php echo e(__("Loading...")); ?>" class="form-control text-view text-paspor" readonly value="<?php echo e(get_file_url( old('passport_id',$row->passport_id) ) ?? $row->getPassportUrl()?? __("No Image")); ?>">
                                </div>
                                <input type="hidden" class="form-control" name="passport_id" value="<?php echo e(old('passport_id',$row->passport_id)?? ""); ?>">
                                <img class="image-demo image-paspor" src="<?php echo e(get_file_url( old('passport_id',$row->passport_id) ) ??  $row->getPassportUrl() ?? ""); ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-md-12">
            <a class="btn btn-danger btn-sm" href="<?php echo e(route('vendor.team.index')); ?>">
                <i class="fa fa-backward"></i> <?php echo e(__('Batal')); ?>

            </a>
            <button class="btn btn-success btn-sm" type="submit">
                <i class="fa fa-save"></i> <?php echo e(__('Simpan')); ?>

            </button>
        </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u1568686/public_html/themes/Base/Vendor/Views/frontend/team/create.blade.php ENDPATH**/ ?>