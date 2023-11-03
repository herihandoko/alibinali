<?php $__env->startSection('content'); ?>
    <h2 class="title-bar">
        <?php echo e(__("Profil")); ?>

        <a href="<?php echo e(route('user.change_password')); ?>" class="btn-change-password"><?php echo e(__("Ubah Password")); ?></a>
    </h2>
    <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <form action="<?php echo e(route('user.profile.update')); ?>" method="post" class="input-has-icon">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="form-title">
                    <strong><?php echo e(__("Informasi Pribadi")); ?></strong>
                </div>
                <?php if($is_vendor_access): ?>
                    <div class="form-group">
                        <label><?php echo e(__("Business name")); ?></label>
                        <input type="text" value="<?php echo e(old('business_name',$dataUser->business_name)); ?>" name="business_name" placeholder="<?php echo e(__("Business name")); ?>" class="form-control">
                        <i class="fa fa-user input-icon"></i>
                    </div>
                <?php endif; ?>
<!--                <div class="form-group">
                    <label><?php echo e(__("User name")); ?> <span class="text-danger">*</span></label>
                    <input type="text" required minlength="4" name="user_name" value="<?php echo e(old('user_name',$dataUser->user_name)); ?>" placeholder="<?php echo e(__("User name")); ?>" class="form-control">
                    <i class="fa fa-user input-icon"></i>
                </div>-->
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Nama Depan (sesuai paspor)")); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo e(old('first_name',$dataUser->first_name)); ?>" name="first_name" placeholder="<?php echo e(__("Nama Depan")); ?>" class="form-control form-control-sm" required>
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Nama Belakang (sesuai paspor)")); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo e(old('last_name',$dataUser->last_name)); ?>" name="last_name" placeholder="<?php echo e(__("Nama Belakang")); ?>" class="form-control form-control-sm" required>
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Nama Ayah Kandung")); ?></label>
                            <input type="text" value="<?php echo e(old('father_name',$dataUser->father_name)); ?>" name="father_name" placeholder="<?php echo e(__("Nama Ayah Kandung")); ?>" class="form-control form-control-sm">
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Nama Ibu Kandung")); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo e(old('mother_name',$dataUser->mother_name)); ?>" name="mother_name" placeholder="<?php echo e(__("Nama Ibu Kandung")); ?>" class="form-control form-control-sm" required>
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo e(__("Tempat Lahir")); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo e(old('birthcity',$dataUser->birthcity)); ?>" name="birthcity" placeholder="<?php echo e(__("Tempat Lahir")); ?>" class="form-control form-control-sm" required>
                            <i class="fa fa-building input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo e(__("Tgl Lahir")); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo e(old('birthday',$dataUser->birthday? display_date($dataUser->birthday) :'')); ?>" name="birthday" placeholder="<?php echo e(__("Tgl Lahir")); ?>" class="form-control date-picker" required>
                            <i class="fa fa-birthday-cake input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo e(__("Jenis Kelamin")); ?> <span class="text-danger">*</span></label>
                            <div>
                                <input <?php if($dataUser->gender=='lakilaki'): ?> checked <?php endif; ?> type="radio" name="gender" value="lakilaki"> <?php echo e(__("Laki-Laki")); ?>

                                <input <?php if($dataUser->gender=='perempuan'): ?> checked <?php endif; ?> type="radio" name="gender" value="perempuan"> <?php echo e(__("Perempuan")); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><?php echo e(__("Status Pernikahan")); ?> <span class="text-danger">*</span></label>
                            <select name="married_status" class="form-control" required>
                                <option value=""><?php echo e(__('-- Pilih --')); ?></option>
                                <?php $__currentLoopData = get_married_status_lists(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if((old('married_status',$dataUser->married_status ?? '')) == $id): ?> selected <?php endif; ?> value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Alamat E-mail Aktif")); ?> <span class="text-danger">*</span></label>
                            <input type="text" name="email" value="<?php echo e(old('email',$dataUser->email)); ?>" placeholder="<?php echo e(__("E-mail")); ?>" class="form-control" required>
                            <i class="fa fa-envelope input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("No. HP Aktif")); ?> <span class="text-danger">*</span></label>
                            <input type="text" value="<?php echo e(old('phone',$dataUser->phone)); ?>" name="phone" placeholder="<?php echo e(__("No. HP Aktif")); ?>" class="form-control" required>
                            <i class="fa fa-phone input-icon"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label><?php echo e(__("Alamat")); ?> <span class="text-danger">*</span></label>
                            <textarea name="address" rows="5" cols="5" placeholder="<?php echo e(__("Alamat")); ?>" class="form-control" required>
                                <?php echo e(old('address') ?? isset($dataUser)?$dataUser->address:''); ?>

                            </textarea>
                            <i class="fa fa-location-arrow input-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Pekerjaan/Jabatan")); ?></label>
                            <input type="text" name="job" value="<?php echo e(old('job',$dataUser->job)); ?>" placeholder="<?php echo e(__("Pekerjaan/Jabatan")); ?>" class="form-control">
                            <i class="fa fa-suitcase input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Pendidikan Terakhir")); ?></label>
                            <select name="last_edu" class="form-control">
                                <option value=""><?php echo e(__('-- Pilih --')); ?></option>
                                <?php $__currentLoopData = get_last_edu_lists(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option <?php if((old('last_edu',$dataUser->last_edu ?? '')) == $id): ?> selected <?php endif; ?> value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Sebutkan penyakit khusus Anda (jika ada)")); ?></label>
                            <input type="text" name="special_disease" value="<?php echo e(old('special_disease',$dataUser->special_disease)); ?>" placeholder="<?php echo e(__("Sebutkan penyakit khusus Anda (jika ada)")); ?>" class="form-control">
                            <i class="fa fa-medkit input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Sebutkan penanganan khusus Anda (jika ada)")); ?></label>
                            <input type="text" name="special_handling" value="<?php echo e(old('special_handling',$dataUser->special_handling)); ?>" placeholder="<?php echo e(__("Sebutkan penanganan khusus Anda (jika ada)")); ?>" class="form-control">
                            <i class="fa fa-stethoscope input-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(__("Pernah Pergi Umrah?")); ?></label>
                            <div>
                                <input <?php if($dataUser->umrah_ever=='ya'): ?> checked <?php endif; ?> type="radio" name="umrah_ever" value="ya"> <?php echo e(__("Ya")); ?>

                                <input <?php if($dataUser->umrah_ever=='tidak'): ?> checked <?php endif; ?> type="radio" name="umrah_ever" value="tidak" checked> <?php echo e(__("Tidak")); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(__("Pernah Pergi Haji?")); ?></label>
                            <div>
                                <input <?php if($dataUser->haji_ever=='ya'): ?> checked <?php endif; ?> type="radio" name="haji_ever" value="ya"> <?php echo e(__("Ya")); ?>

                                <input <?php if($dataUser->haji_ever=='tidak'): ?> checked <?php endif; ?> type="radio" name="haji_ever" value="tidak" checked> <?php echo e(__("Tidak")); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><?php echo e(__("Kebutuhan Fasilitas Kursi Roda")); ?> <span class="text-danger">*</span></label>
                            <div>
                                <input <?php if($dataUser->wheelchair_facilities=='ya'): ?> checked <?php endif; ?> type="radio" name="wheelchair_facilities" value="ya"> <?php echo e(__("Ya")); ?>

                                <input <?php if($dataUser->wheelchair_facilities=='tidak'): ?> checked <?php endif; ?> type="radio" name="wheelchair_facilities" value="tidak" checked> <?php echo e(__("Tidak")); ?>

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
                                    <input type="text" data-error="<?php echo e(__("Error upload...")); ?>" data-loading="<?php echo e(__("Loading...")); ?>" class="form-control text-view text-foto" readonly value="<?php echo e(get_file_url( old('avatar_id',$dataUser->avatar_id) ) ?? $dataUser->getAvatarUrl()?? __("No Image")); ?>">
                                </div>
                                <input type="hidden" class="form-control" name="avatar_id" value="<?php echo e(old('avatar_id',$dataUser->avatar_id)?? ""); ?>">
                                <img class="image-demo image-foto" src="<?php echo e(get_file_url( old('avatar_id',$dataUser->avatar_id) ) ??  $dataUser->getAvatarUrl() ?? ""); ?>"/>
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
                                    <input type="text" data-error="<?php echo e(__("Error upload...")); ?>" data-loading="<?php echo e(__("Loading...")); ?>" class="form-control text-view text-ktp" readonly value="<?php echo e(get_file_url( old('idcard_id',$dataUser->idcard_id) ) ?? $dataUser->getIdcardUrl()?? __("No Image")); ?>">
                                </div>
                                <input type="hidden" class="form-control" name="idcard_id" value="<?php echo e(old('idcard_id',$dataUser->idcard_id)?? ""); ?>">
                                <img class="image-demo image-ktp" src="<?php echo e(get_file_url( old('idcard_id',$dataUser->idcard_id) ) ??  $dataUser->getIdcardUrl() ?? ""); ?>"/>
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
                                    <input type="text" data-error="<?php echo e(__("Error upload...")); ?>" data-loading="<?php echo e(__("Loading...")); ?>" class="form-control text-view text-kk" readonly value="<?php echo e(get_file_url( old('familycard_id',$dataUser->familycard_id) ) ?? $dataUser->getFamilycardUrl()?? __("No Image")); ?>">
                                </div>
                                <input type="hidden" class="form-control" name="familycard_id" value="<?php echo e(old('familycard_id',$dataUser->familycard_id)?? ""); ?>">
                                <img class="image-demo image-kk" src="<?php echo e(get_file_url( old('familycard_id',$dataUser->familycard_id) ) ??  $dataUser->getFamilycardUrl() ?? ""); ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><?php echo e(__("Paspor")); ?> <span class="text-danger">*</span></label>
                            <div class="upload-btn-wrapper upload-paspor">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file btn-paspor">
                                            <?php echo e(__("Browse")); ?>… <input type="file" accept=".png, .jpg, .jpeg">
                                        </span>
                                    </span>
                                    <input type="text" data-error="<?php echo e(__("Error upload...")); ?>" data-loading="<?php echo e(__("Loading...")); ?>" class="form-control text-view text-paspor" readonly value="<?php echo e(get_file_url( old('passport_id',$dataUser->passport_id) ) ?? $dataUser->getPassportUrl()?? __("No Image")); ?>">
                                </div>
                                <input type="hidden" class="form-control" name="passport_id" value="<?php echo e(old('passport_id',$dataUser->passport_id)?? ""); ?>">
                                <img class="image-demo image-paspor" src="<?php echo e(get_file_url( old('passport_id',$dataUser->passport_id) ) ??  $dataUser->getPassportUrl() ?? ""); ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!--            <div class="col-md-4">
                <div class="form-title">
                    <strong><?php echo e(__("Location Information")); ?></strong>
                </div>
                <div class="form-group">
                    <label><?php echo e(__("Address Line 1")); ?></label>
                    <input type="text" value="<?php echo e(old('address',$dataUser->address)); ?>" name="address" placeholder="<?php echo e(__("Address")); ?>" class="form-control">
                    <i class="fa fa-location-arrow input-icon"></i>
                </div>
                <div class="form-group">
                    <label><?php echo e(__("Address Line 2")); ?></label>
                    <input type="text" value="<?php echo e(old('address2',$dataUser->address2)); ?>" name="address2" placeholder="<?php echo e(__("Address2")); ?>" class="form-control">
                    <i class="fa fa-location-arrow input-icon"></i>
                </div>
                <div class="form-group">
                    <label><?php echo e(__("City")); ?></label>
                    <input type="text" value="<?php echo e(old('city',$dataUser->city)); ?>" name="city" placeholder="<?php echo e(__("City")); ?>" class="form-control">
                    <i class="fa fa-street-view input-icon"></i>
                </div>
                <div class="form-group">
                    <label><?php echo e(__("State")); ?></label>
                    <input type="text" value="<?php echo e(old('state',$dataUser->state)); ?>" name="state" placeholder="<?php echo e(__("State")); ?>" class="form-control">
                    <i class="fa fa-map-signs input-icon"></i>
                </div>
                <div class="form-group">
                    <label><?php echo e(__("Country")); ?></label>
                    <select name="country" class="form-control">
                        <option value=""><?php echo e(__('-- Select --')); ?></option>
                        <?php $__currentLoopData = get_country_lists(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if((old('country',$dataUser->country ?? '')) == $id): ?> selected <?php endif; ?> value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo e(__("Zip Code")); ?></label>
                    <input type="text" value="<?php echo e(old('zip_code',$dataUser->zip_code)); ?>" name="zip_code" placeholder="<?php echo e(__("Zip Code")); ?>" class="form-control">
                    <i class="fa fa-map-pin input-icon"></i>
                </div>

            </div>-->
            <div class="col-md-12">
                <hr>
                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> <?php echo e(__('Simpan')); ?></button>
            </div>
        </div>
    </form>
    <?php if(!empty(setting_item('user_enable_permanently_delete')) and !is_admin()): ?>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-danger">
                <?php echo e(__("Delete account")); ?>

            </h4>
            <div class="mb-4 mt-2">
                <?php echo clean(setting_item_with_lang('user_permanently_delete_content','',__('Your account will be permanently deleted. Once you delete your account, there is no going back. Please be certain.'))); ?>

            </div>
            <a data-toggle="modal" data-target="#permanentlyDeleteAccount" class="btn btn-danger" href=""><?php echo e(__('Delete your account')); ?></a>
        </div>

        <!-- Modal -->
        <div class="modal  fade" id="permanentlyDeleteAccount" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo e(__('Confirm permanently delete account')); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="my-3">
                            <?php echo clean(setting_item_with_lang('user_permanently_delete_content_confirm')); ?>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                        <a href="<?php echo e(route('user.permanently.delete')); ?>" class="btn btn-danger"><?php echo e(__('Confirm')); ?></a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Library/WebServer/alibinali/themes/Base/User/Views/frontend/profile.blade.php ENDPATH**/ ?>