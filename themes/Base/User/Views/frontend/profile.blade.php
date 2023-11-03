@extends('layouts.user')
@section('content')
    <h2 class="title-bar">
        {{__("Profil")}}
        <a href="{{route('user.change_password')}}" class="btn-change-password">{{__("Ubah Password")}}</a>
    </h2>
    @include('admin.message')
    @include('admin.notifva')
    <div class="booking-history-manager">
        <form action="{{route('user.profile.update')}}" method="post" class="input-has-icon">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-title">
                        <strong>{{__("BTN Virtual Account")}}</strong>
                    </div>
                    <div class="form-group">
                        <label>{{__("Virtual Account Name")}}</label>
                        <input type="text" value="{{old('va_name',$dataUser->va_name)}}" name="va_name" placeholder="{{__("Virtual Account Name")}}" class="form-control" @if($dataUser->va_status == '2002700') disabled @endif>
                        <i class="fa fa-user input-icon"></i>
                    </div>
                    <div class="form-group">
                        <label>{{__("Virtual Account Number")}}</label>
                        <input type="number" value="{{old('va_number',$dataUser->va_number)}}" name="va_number" placeholder="{{__("96000081380001XXXX")}}" class="form-control" @if($dataUser->va_status == '2002700') disabled @endif>
                        <i class="fa fa-user input-icon"></i>
                    </div>
                    <hr>
                    <div class="form-title">
                        <strong>{{__("Data Pribadi")}}</strong>
                    </div>
                    @if($is_vendor_access)
                        <div class="form-group">
                            <label>{{__("Business name")}}</label>
                            <input type="text" value="{{old('business_name',$dataUser->business_name)}}" name="business_name" placeholder="{{__("Business name")}}" class="form-control">
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    @endif
    <!--                <div class="form-group">
                        <label>{{__("User name")}} <span class="text-danger">*</span></label>
                        <input type="text" required minlength="4" name="user_name" value="{{old('user_name',$dataUser->user_name)}}" placeholder="{{__("User name")}}" class="form-control">
                        <i class="fa fa-user input-icon"></i>
                    </div>-->
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Nama Depan (sesuai paspor)")}} <span class="text-danger">*</span></label>
                                <input type="text" value="{{old('first_name',$dataUser->first_name)}}" name="first_name" placeholder="{{__("Nama Depan")}}" class="form-control form-control-sm" required>
                                <i class="fa fa-user input-icon"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Nama Belakang (sesuai paspor)")}} <span class="text-danger">*</span></label>
                                <input type="text" value="{{old('last_name',$dataUser->last_name)}}" name="last_name" placeholder="{{__("Nama Belakang")}}" class="form-control form-control-sm" required>
                                <i class="fa fa-user input-icon"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Nama Ayah Kandung")}}</label>
                                <input type="text" value="{{old('father_name',$dataUser->father_name)}}" name="father_name" placeholder="{{__("Nama Ayah Kandung")}}" class="form-control form-control-sm">
                                <i class="fa fa-user input-icon"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Nama Ibu Kandung")}} <span class="text-danger">*</span></label>
                                <input type="text" value="{{old('mother_name',$dataUser->mother_name)}}" name="mother_name" placeholder="{{__("Nama Ibu Kandung")}}" class="form-control form-control-sm" required>
                                <i class="fa fa-user input-icon"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{__("Tempat Lahir")}} <span class="text-danger">*</span></label>
                                <input type="text" value="{{old('birthcity',$dataUser->birthcity)}}" name="birthcity" placeholder="{{__("Tempat Lahir")}}" class="form-control form-control-sm" required>
                                <i class="fa fa-building input-icon"></i>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{__("Tgl Lahir")}} <span class="text-danger">*</span></label>
                                <input type="text" value="{{ old('birthday',$dataUser->birthday? display_date($dataUser->birthday) :'') }}" name="birthday" placeholder="{{__("Tgl Lahir")}}" class="form-control date-picker" required>
                                <i class="fa fa-birthday-cake input-icon"></i>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{__("Jenis Kelamin")}} <span class="text-danger">*</span></label>
                                <div>
                                    <input @if($dataUser->gender=='lakilaki') checked @endif type="radio" name="gender" value="lakilaki"> {{__("Laki-Laki")}}
                                    <input @if($dataUser->gender=='perempuan') checked @endif type="radio" name="gender" value="perempuan"> {{__("Perempuan")}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>{{__("Status Pernikahan")}} <span class="text-danger">*</span></label>
                                <select name="married_status" class="form-control" required>
                                    <option value="">{{__('-- Pilih --')}}</option>
                                    @foreach(get_married_status_lists() as $id=>$name)
                                        <option @if((old('married_status',$dataUser->married_status ?? '')) == $id) selected @endif value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Alamat E-mail Aktif")}} <span class="text-danger">*</span></label>
                                <input type="text" name="email" value="{{old('email',$dataUser->email)}}" placeholder="{{__("E-mail")}}" class="form-control" required>
                                <i class="fa fa-envelope input-icon"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("No. HP Aktif")}} <span class="text-danger">*</span></label>
                                <input type="text" value="{{old('phone',$dataUser->phone)}}" name="phone" placeholder="{{__("No. HP Aktif")}}" class="form-control" required>
                                <i class="fa fa-phone input-icon"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__("Alamat")}} <span class="text-danger">*</span></label>
                                <textarea name="address" rows="5" cols="5" placeholder="{{__("Alamat")}}" class="form-control" required>
                                    {{old('address') ?? isset($dataUser)?$dataUser->address:''}}
                                </textarea>
                                <i class="fa fa-location-arrow input-icon"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Pekerjaan/Jabatan")}}</label>
                                <input type="text" name="job" value="{{old('job',$dataUser->job)}}" placeholder="{{__("Pekerjaan/Jabatan")}}" class="form-control">
                                <i class="fa fa-suitcase input-icon"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Pendidikan Terakhir")}}</label>
                                <select name="last_edu" class="form-control">
                                    <option value="">{{__('-- Pilih --')}}</option>
                                    @foreach(get_last_edu_lists() as $id=>$name)
                                        <option @if((old('last_edu',$dataUser->last_edu ?? '')) == $id) selected @endif value="{{$id}}">{{$name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Sebutkan penyakit khusus Anda (jika ada)")}}</label>
                                <input type="text" name="special_disease" value="{{old('special_disease',$dataUser->special_disease)}}" placeholder="{{__("Sebutkan penyakit khusus Anda (jika ada)")}}" class="form-control">
                                <i class="fa fa-medkit input-icon"></i>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Sebutkan penanganan khusus Anda (jika ada)")}}</label>
                                <input type="text" name="special_handling" value="{{old('special_handling',$dataUser->special_handling)}}" placeholder="{{__("Sebutkan penanganan khusus Anda (jika ada)")}}" class="form-control">
                                <i class="fa fa-stethoscope input-icon"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__("Pernah Pergi Umrah?")}}</label>
                                <div>
                                    <input @if($dataUser->umrah_ever=='ya') checked @endif type="radio" name="umrah_ever" value="ya"> {{__("Ya")}}
                                    <input @if($dataUser->umrah_ever=='tidak') checked @endif type="radio" name="umrah_ever" value="tidak" checked> {{__("Tidak")}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__("Pernah Pergi Haji?")}}</label>
                                <div>
                                    <input @if($dataUser->haji_ever=='ya') checked @endif type="radio" name="haji_ever" value="ya"> {{__("Ya")}}
                                    <input @if($dataUser->haji_ever=='tidak') checked @endif type="radio" name="haji_ever" value="tidak" checked> {{__("Tidak")}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>{{__("Kebutuhan Fasilitas Kursi Roda")}} <span class="text-danger">*</span></label>
                                <div>
                                    <input @if($dataUser->wheelchair_facilities=='ya') checked @endif type="radio" name="wheelchair_facilities" value="ya"> {{__("Ya")}}
                                    <input @if($dataUser->wheelchair_facilities=='tidak') checked @endif type="radio" name="wheelchair_facilities" value="tidak" checked> {{__("Tidak")}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-title">
                        <strong>{{__("Data Manifest")}}</strong>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Foto")}} <span class="text-danger">*</span></label>
                                <div class="upload-btn-wrapper upload-foto">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file btn-foto">
                                                {{__("Browse")}}… <input type="file" accept=".png, .jpg, .jpeg">
                                            </span>
                                        </span>
                                        <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view text-foto" readonly value="{{ get_file_url( old('avatar_id',$dataUser->avatar_id) ) ?? $dataUser->getAvatarUrl()?? __("No Image")}}">
                                    </div>
                                    <input type="hidden" class="form-control" name="avatar_id" value="{{ old('avatar_id',$dataUser->avatar_id)?? ""}}">
                                    <img class="image-demo image-foto" src="{{ get_file_url( old('avatar_id',$dataUser->avatar_id) ) ??  $dataUser->getAvatarUrl() ?? ""}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("KTP")}} <span class="text-danger">*</span></label>
                                <div class="upload-btn-wrapper upload-ktp">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file btn-ktp">
                                                {{__("Browse")}}… <input type="file" accept=".png, .jpg, .jpeg">
                                            </span>
                                        </span>
                                        <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view text-ktp" readonly value="{{ get_file_url( old('idcard_id',$dataUser->idcard_id) ) ?? $dataUser->getIdcardUrl()?? __("No Image")}}">
                                    </div>
                                    <input type="hidden" class="form-control" name="idcard_id" value="{{ old('idcard_id',$dataUser->idcard_id)?? ""}}">
                                    <img class="image-demo image-ktp" src="{{ get_file_url( old('idcard_id',$dataUser->idcard_id) ) ??  $dataUser->getIdcardUrl() ?? ""}}"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Kartu Keluarga")}} <span class="text-danger">*</span></label>
                                <div class="upload-btn-wrapper upload-kk">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file btn-kk">
                                                {{__("Browse")}}… <input type="file" accept=".png, .jpg, .jpeg">
                                            </span>
                                        </span>
                                        <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view text-kk" readonly value="{{ get_file_url( old('familycard_id',$dataUser->familycard_id) ) ?? $dataUser->getFamilycardUrl()?? __("No Image")}}">
                                    </div>
                                    <input type="hidden" class="form-control" name="familycard_id" value="{{ old('familycard_id',$dataUser->familycard_id)?? ""}}">
                                    <img class="image-demo image-kk" src="{{ get_file_url( old('familycard_id',$dataUser->familycard_id) ) ??  $dataUser->getFamilycardUrl() ?? ""}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__("Paspor")}} <span class="text-danger">*</span></label>
                                <div class="upload-btn-wrapper upload-paspor">
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file btn-paspor">
                                                {{__("Browse")}}… <input type="file" accept=".png, .jpg, .jpeg">
                                            </span>
                                        </span>
                                        <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view text-paspor" readonly value="{{ get_file_url( old('passport_id',$dataUser->passport_id) ) ?? $dataUser->getPassportUrl()?? __("No Image")}}">
                                    </div>
                                    <input type="hidden" class="form-control" name="passport_id" value="{{ old('passport_id',$dataUser->passport_id)?? ""}}">
                                    <img class="image-demo image-paspor" src="{{ get_file_url( old('passport_id',$dataUser->passport_id) ) ??  $dataUser->getPassportUrl() ?? ""}}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <!--            <div class="col-md-4">
                    <div class="form-title">
                        <strong>{{__("Location Information")}}</strong>
                    </div>
                    <div class="form-group">
                        <label>{{__("Address Line 1")}}</label>
                        <input type="text" value="{{old('address',$dataUser->address)}}" name="address" placeholder="{{__("Address")}}" class="form-control">
                        <i class="fa fa-location-arrow input-icon"></i>
                    </div>
                    <div class="form-group">
                        <label>{{__("Address Line 2")}}</label>
                        <input type="text" value="{{old('address2',$dataUser->address2)}}" name="address2" placeholder="{{__("Address2")}}" class="form-control">
                        <i class="fa fa-location-arrow input-icon"></i>
                    </div>
                    <div class="form-group">
                        <label>{{__("City")}}</label>
                        <input type="text" value="{{old('city',$dataUser->city)}}" name="city" placeholder="{{__("City")}}" class="form-control">
                        <i class="fa fa-street-view input-icon"></i>
                    </div>
                    <div class="form-group">
                        <label>{{__("State")}}</label>
                        <input type="text" value="{{old('state',$dataUser->state)}}" name="state" placeholder="{{__("State")}}" class="form-control">
                        <i class="fa fa-map-signs input-icon"></i>
                    </div>
                    <div class="form-group">
                        <label>{{__("Country")}}</label>
                        <select name="country" class="form-control">
                            <option value="">{{__('-- Select --')}}</option>
                            @foreach(get_country_lists() as $id=>$name)
                                <option @if((old('country',$dataUser->country ?? '')) == $id) selected @endif value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>{{__("Zip Code")}}</label>
                        <input type="text" value="{{old('zip_code',$dataUser->zip_code)}}" name="zip_code" placeholder="{{__("Zip Code")}}" class="form-control">
                        <i class="fa fa-map-pin input-icon"></i>
                    </div>

                </div>-->
                <div class="col-md-12">
                    <hr>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{__('Simpan')}}</button>
                </div>
            </div>
        </form>
        @if(!empty(setting_item('user_enable_permanently_delete')) and !is_admin())
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-danger">
                    {{__("Delete account")}}
                </h4>
                <div class="mb-4 mt-2">
                    {!! clean(setting_item_with_lang('user_permanently_delete_content','',__('Your account will be permanently deleted. Once you delete your account, there is no going back. Please be certain.'))) !!}
                </div>
                <a data-toggle="modal" data-target="#permanentlyDeleteAccount" class="btn btn-danger" href="">{{__('Delete your account')}}</a>
            </div>

            <!-- Modal -->
            <div class="modal  fade" id="permanentlyDeleteAccount" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('Confirm permanently delete account')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="my-3">
                                {!! clean(setting_item_with_lang('user_permanently_delete_content_confirm')) !!}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                            <a href="{{route('user.permanently.delete')}}" class="btn btn-danger">{{__('Confirm')}}</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection