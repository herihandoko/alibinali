@extends('layouts.user')
@section('content')
    <h2 class="title-bar no-border-bottom">
        {{__("Biodata Jamaah")}}
    </h2>
    @include('admin.message')
    <form action="{{route('vendor.team.store', ['vendorTeam'=>$row->id ?? '0'])}}" method="post" class="input-has-icon">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("Nama Depan (sesuai paspor)")}} <span class="text-danger">*</span></label>
                            <input type="text" value="{{old('first_name',$row->first_name)}}" name="first_name" placeholder="{{__("Nama Depan")}}" class="form-control form-control-sm" required>
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("Nama Belakang (sesuai paspor)")}} <span class="text-danger">*</span></label>
                            <input type="text" value="{{old('last_name',$row->last_name)}}" name="last_name" placeholder="{{__("Nama Belakang")}}" class="form-control form-control-sm" required>
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("Nama Ayah Kandung")}}</label>
                            <input type="text" value="{{old('father_name',$row->father_name)}}" name="father_name" placeholder="{{__("Nama Ayah Kandung")}}" class="form-control form-control-sm">
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("Nama Ibu Kandung")}} <span class="text-danger">*</span></label>
                            <input type="text" value="{{old('mother_name',$row->mother_name)}}" name="mother_name" placeholder="{{__("Nama Ibu Kandung")}}" class="form-control form-control-sm" required>
                            <i class="fa fa-user input-icon"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{__("Tempat Lahir")}} <span class="text-danger">*</span></label>
                            <input type="text" value="{{old('birthcity',$row->birthcity)}}" name="birthcity" placeholder="{{__("Tempat Lahir")}}" class="form-control form-control-sm" required>
                            <i class="fa fa-building input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{__("Tgl Lahir")}} <span class="text-danger">*</span></label>
                            <input type="text" value="{{ old('birthday',$row->birthday? display_date($row->birthday) :'') }}" name="birthday" placeholder="{{__("Tgl Lahir")}}" class="form-control date-picker" required>
                            <i class="fa fa-birthday-cake input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{__("Jenis Kelamin")}} <span class="text-danger">*</span></label>
                            <div>
                                <input @if($row->gender=='lakilaki') checked @endif type="radio" name="gender" value="lakilaki"> {{__("Laki-Laki")}}
                                <input @if($row->gender=='perempuan') checked @endif type="radio" name="gender" value="perempuan"> {{__("Perempuan")}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>{{__("Status Pernikahan")}} <span class="text-danger">*</span></label>
                            <select name="married_status" class="form-control" required>
                                <option value="">{{__('-- Pilih --')}}</option>
                                @foreach(get_married_status_lists() as $id=>$name)
                                    <option @if((old('married_status',$row->married_status ?? '')) == $id) selected @endif value="{{$id}}">{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("Alamat E-mail Aktif")}} <span class="text-danger">*</span></label>
                            <input type="text" name="email" value="{{old('email',$row->email)}}" placeholder="{{__("Alamat E-mail Aktif")}}" class="form-control" required>
                            <i class="fa fa-envelope input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("No. HP Aktif")}} <span class="text-danger">*</span></label>
                            <input type="text" value="{{old('phone',$row->phone)}}" name="phone" placeholder="{{__("No. HP Aktif")}}" class="form-control" required>
                            <i class="fa fa-phone input-icon"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>{{__("Alamat")}} <span class="text-danger">*</span></label>
                            <textarea name="address" rows="5" cols="5" placeholder="{{__("Alamat")}}" class="form-control" required>
                                {{old('address') ?? isset($row)?$row->address:''}}
                            </textarea>
                            <i class="fa fa-location-arrow input-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("Pekerjaan/Jabatan")}}</label>
                            <input type="text" name="job" value="{{old('job',$row->job)}}" placeholder="{{__("Pekerjaan/Jabatan")}}" class="form-control">
                            <i class="fa fa-suitcase input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("Pendidikan Terakhir")}}</label>
                            <select name="last_edu" class="form-control">
                                <option value="">{{__('-- Pilih --')}}</option>
                                @foreach(get_last_edu_lists() as $id=>$name)
                                    <option @if((old('last_edu',$row->last_edu ?? '')) == $id) selected @endif value="{{$id}}">{{$name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("Sebutkan penyakit khusus Anda (jika ada)")}}</label>
                            <input type="text" name="special_disease" value="{{old('special_disease',$row->special_disease)}}" placeholder="{{__("Sebutkan penyakit khusus Anda (jika ada)")}}" class="form-control">
                            <i class="fa fa-medkit input-icon"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("Sebutkan penanganan khusus Anda (jika ada)")}}</label>
                            <input type="text" name="special_handling" value="{{old('special_handling',$row->special_handling)}}" placeholder="{{__("Sebutkan penanganan khusus Anda (jika ada)")}}" class="form-control">
                            <i class="fa fa-stethoscope input-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{__("Pernah Pergi Umrah?")}}</label>
                            <div>
                                <input @if($row->umrah_ever=='ya') checked @endif type="radio" name="umrah_ever" value="ya"> {{__("Ya")}}
                                <input @if($row->umrah_ever=='tidak') checked @endif type="radio" name="umrah_ever" value="tidak" checked> {{__("Tidak")}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{__("Pernah Pergi Haji?")}}</label>
                            <div>
                                <input @if($row->haji_ever=='ya') checked @endif type="radio" name="haji_ever" value="ya"> {{__("Ya")}}
                                <input @if($row->haji_ever=='tidak') checked @endif type="radio" name="haji_ever" value="tidak" checked> {{__("Tidak")}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>{{__("Kebutuhan Fasilitas Kursi Roda")}} <span class="text-danger">*</span></label>
                            <div>
                                <input @if($row->wheelchair_facilities=='ya') checked @endif type="radio" name="wheelchair_facilities" value="ya"> {{__("Ya")}}
                                <input @if($row->wheelchair_facilities=='tidak') checked @endif type="radio" name="wheelchair_facilities" value="tidak" checked> {{__("Tidak")}}
                            </div>
                        </div>
                    </div>
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
                                    <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view text-foto" readonly value="{{ get_file_url( old('avatar_id',$row->avatar_id) ) ?? $row->getAvatarUrl()?? __("No Image")}}">
                                </div>
                                <input type="hidden" class="form-control" name="avatar_id" value="{{ old('avatar_id',$row->avatar_id)?? ""}}">
                                <img class="image-demo image-foto" src="{{ get_file_url( old('avatar_id',$row->avatar_id) ) ??  $row->getAvatarUrl() ?? ""}}"/>
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
                                    <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view text-ktp" readonly value="{{ get_file_url( old('idcard_id',$row->idcard_id) ) ?? $row->getIdcardUrl()?? __("No Image")}}">
                                </div>
                                <input type="hidden" class="form-control" name="idcard_id" value="{{ old('idcard_id',$row->idcard_id)?? ""}}">
                                <img class="image-demo image-ktp" src="{{ get_file_url( old('idcard_id',$row->idcard_id) ) ??  $row->getIdcardUrl() ?? ""}}"/>
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
                                    <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view text-kk" readonly value="{{ get_file_url( old('familycard_id',$row->familycard_id) ) ?? $row->getFamilycardUrl()?? __("No Image")}}">
                                </div>
                                <input type="hidden" class="form-control" name="familycard_id" value="{{ old('familycard_id',$row->familycard_id)?? ""}}">
                                <img class="image-demo image-kk" src="{{ get_file_url( old('familycard_id',$row->familycard_id) ) ??  $row->getFamilycardUrl() ?? ""}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>{{__("Paspor")}}</label>
                            <div class="upload-btn-wrapper upload-paspor">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-default btn-file btn-paspor">
                                            {{__("Browse")}}… <input type="file" accept=".png, .jpg, .jpeg">
                                        </span>
                                    </span>
                                    <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view text-paspor" readonly value="{{ get_file_url( old('passport_id',$row->passport_id) ) ?? $row->getPassportUrl()?? __("No Image")}}">
                                </div>
                                <input type="hidden" class="form-control" name="passport_id" value="{{ old('passport_id',$row->passport_id)?? ""}}">
                                <img class="image-demo image-paspor" src="{{ get_file_url( old('passport_id',$row->passport_id) ) ??  $row->getPassportUrl() ?? ""}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="col-md-12">
            <a class="btn btn-danger btn-sm" href="{{ route('vendor.team.index') }}">
                <i class="fa fa-backward"></i> {{__('Batal')}}
            </a>
            <button class="btn btn-success btn-sm" type="submit">
                <i class="fa fa-save"></i> {{__('Simpan')}}
            </button>
        </div>
        </div>
    </form>
@endsection