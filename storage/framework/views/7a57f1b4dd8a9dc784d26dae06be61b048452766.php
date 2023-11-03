

<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(route('user.admin.store',['id'=>$row->id ?? -1])); ?>" method="post" class="needs-validation" novalidate>
        <?php echo csrf_field(); ?>
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar"><?php echo e($row->id ? 'Edit: '.$row->getDisplayName() : 'Add new user'); ?></h1>
                </div>
            </div>
            <?php echo $__env->make('admin.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('Informasi User')); ?></strong></div>
                        <div class="panel-body">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><?php echo e(__("Nama Perusahaan")); ?> <span class="text-danger">*</span></label>
                                        <input type="text" value="<?php echo e(old('business_name',$row->business_name)); ?>" name="business_name" placeholder="<?php echo e(__("Nama Perusahaan")); ?>" class="form-control">
                                    </div>
                                </div>
<!--                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("User name")); ?></label>
                                        <input type="text" name="user_name" required value="<?php echo e(old('user_name',$row->user_name)); ?>" placeholder="<?php echo e(__("User name")); ?>" class="form-control">
                                    </div>
                                </div>-->
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Nama Depan (sesuai paspor)")); ?> <span class="text-danger">*</span></label>
                                        <input type="text" value="<?php echo e(old('first_name',$row->first_name)); ?>" name="first_name" placeholder="<?php echo e(__("Nama Depan")); ?>" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Nama Belakang (sesuai paspor)")); ?> <span class="text-danger">*</span></label>
                                        <input type="text" value="<?php echo e(old('last_name',$row->last_name)); ?>" name="last_name" placeholder="<?php echo e(__("Nama Belakang")); ?>" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Nama Ayah Kandung")); ?></label>
                                        <input type="text" value="<?php echo e(old('father_name',$row->father_name)); ?>" name="father_name" placeholder="<?php echo e(__("Nama Ayah Kandung")); ?>" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Nama Ibu Kandung")); ?> <span class="text-danger">*</span></label>
                                        <input type="text" value="<?php echo e(old('mother_name',$row->mother_name)); ?>" name="mother_name" placeholder="<?php echo e(__("Nama Ibu Kandung")); ?>" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo e(__("Tempat Lahir")); ?> <span class="text-danger">*</span></label>
                                        <input type="text" value="<?php echo e(old('birthcity',$row->birthcity)); ?>" name="birthcity" placeholder="<?php echo e(__("Tempat Lahir")); ?>" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo e(__("Tgl Lahir")); ?> <span class="text-danger">*</span></label>
                                        <input type="text" value="<?php echo e(old('birthday',$row->birthday ? date("Y/m/d",strtotime($row->birthday)) :'')); ?>" placeholder="<?php echo e(__('Tgl Lahir')); ?>" name="birthday" class="form-control has-datepicker input-group date" required>
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
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("No. HP Aktif")); ?> <span class="text-danger">*</span></label>
                                        <input type="text" value="<?php echo e(old('phone',$row->phone)); ?>" name="phone" placeholder="<?php echo e(__("No. HP Aktif")); ?>" class="form-control" required>
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
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Pekerjaan/Jabatan")); ?></label>
                                        <input type="text" name="job" value="<?php echo e(old('job',$row->job)); ?>" placeholder="<?php echo e(__("Pekerjaan/Jabatan")); ?>" class="form-control">
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
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__("Sebutkan penanganan khusus Anda (jika ada)")); ?></label>
                                        <input type="text" name="special_handling" value="<?php echo e(old('special_handling',$row->special_handling)); ?>" placeholder="<?php echo e(__("Sebutkan penanganan khusus Anda (jika ada)")); ?>" class="form-control">
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
                            <hr>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="panel">
                                        <div class="panel-title"><strong><?php echo e(__('Foto')); ?></strong></div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('avatar_id',old('avatar_id',$row->avatar_id)); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="panel">
                                        <div class="panel-title"><strong><?php echo e(__('KTP')); ?></strong></div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('idcard_id',old('idcard_id',$row->idcard_id)); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="panel">
                                        <div class="panel-title"><strong><?php echo e(__('Kartu Keluarga')); ?></strong></div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('familycard_id',old('familycard_id',$row->familycard_id)); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="panel">
                                        <div class="panel-title"><strong><?php echo e(__('Paspor')); ?></strong></div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <?php echo \Modules\Media\Helpers\FileHelper::fieldUpload('passport_id',old('passport_id',$row->passport_id)); ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

<!--                            <div class="form-group">
                                <label class="control-label"><?php echo e(__('Biographical')); ?></label>
                                <div class="">
                                    <textarea name="bio" class="d-none has-ckeditor" cols="30" rows="10"><?php echo e(old('bio',$row->bio)); ?></textarea>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('Publish')); ?></strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label><?php echo e(__('Status')); ?></label>
                                <select required class="custom-select" name="status">
                                    <option <?php if(old('status',$row->status) =='publish'): ?> selected <?php endif; ?> value="publish"><?php echo e(__('Publish')); ?></option>
                                    <option <?php if(old('status',$row->status) =='blocked'): ?> selected <?php endif; ?> value="blocked"><?php echo e(__('Blocked')); ?></option>
                                </select>
                            </div>
                            <?php if(is_admin()): ?>
                                <?php if(empty($user_type) or $user_type != 'vendor'): ?>
                                    <div class="form-group">
                                        <label><?php echo e(__('Role')); ?> <span class="text-danger">*</span></label>
                                        <select required class="form-control" name="role_id">
                                            <option value=""><?php echo e(__('-- Pilih --')); ?></option>
                                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($role->id); ?>" <?php if(old('role_id',$row->role_id) == $role->id): ?> selected <?php elseif(old('role_id')  == $role->id ): ?> selected <?php elseif(request()->input("user_type")  == strtolower($role->name) ): ?> selected <?php endif; ?> ><?php echo e(ucfirst($role->name)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label><?php echo e(__('Email Terverifikasi?')); ?></label>
                                    <select  class="form-control" name="is_email_verified">
                                        <option value=""><?php echo e(__('Tidak')); ?></option>
                                        <option <?php if(old('is_email_verified',$row->email_verified_at ? 1 : 0)): ?> selected <?php endif; ?> value="1"><?php echo e(__('Ya')); ?></option>
                                    </select>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('User Cogs')); ?></strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label><?php echo e(__('Status')); ?></label>
                                <select required class="custom-select" name="cogs">
                                    <option <?php if(old('cogs',$row->cogs) == 1): ?> selected <?php endif; ?> value="1"><?php echo e(__('Ya')); ?></option>
                                    <option <?php if(old('cogs',$row->cogs) == 0): ?> selected <?php endif; ?> value="0"><?php echo e(__('Tidak')); ?></option>
                                </select>
                            </div>
                            <?php if(is_admin()): ?>
                                <?php if(empty($user_type) or $user_type != 'vendor'): ?>
                                    <div class="form-group">
                                        <label><?php echo e(__('Role')); ?> <span class="text-danger">*</span></label>
                                        <select required class="form-control" name="level">
                                            <option value=""><?php echo e(__('-- Pilih --')); ?></option>
                                            <option value="admin" <?php if(old('level',$row->level) == 'admin'): ?> selected <?php elseif(old('level')  == 'admin'): ?> selected <?php elseif(request()->input("level")  == 'admin' ): ?> selected <?php endif; ?> >Admin</option>
                                            <option value="user" <?php if(old('level',$row->level) == 'user'): ?> selected <?php elseif(old('level')  == 'user'): ?> selected <?php elseif(request()->input("level")  == 'user' ): ?> selected <?php endif; ?> >User</option>
                                        </select>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="panel">
                        <div class="panel-title"><strong><?php echo e(__('Agent')); ?></strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label><?php echo e(__('Jenis Komisi Agent')); ?></label>
                                <div class="form-controls">
                                    <select name="vendor_commission_type" class="form-control">
                                        <option value=""><?php echo e(__("Default")); ?></option>
                                        <option value="percent" <?php echo e(old("vendor_commission_type",($row->vendor_commission_type ?? '')) == 'percent' ? 'selected' : ''); ?>><?php echo e(__('Percent')); ?></option>
                                        <option value="amount" <?php echo e(old("vendor_commission_type",($row->vendor_commission_type ?? '')) == 'amount' ? 'selected' : ''); ?>><?php echo e(__('Amount')); ?></option>
                                        <option value="disable" <?php echo e(old("vendor_commission_type",($row->vendor_commission_type ?? '')) == 'disable' ? 'selected' : ''); ?>><?php echo e(__('Disable Commission')); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?php echo e(__('Nilai Komisi Agent')); ?></label>
                                <div class="form-controls">
                                    <input type="text" class="form-control" name="vendor_commission_amount" value="<?php echo e(old("vendor_commission_amount",($row->vendor_commission_amount ?? ''))); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <span></span>
                <button class="btn btn-primary" type="submit"><?php echo e(__('Simpan')); ?></button>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u1568686/public_html/modules/User/Views/admin/detail.blade.php ENDPATH**/ ?>