@extends('admin.layouts.app')

@section('content')
    <form action="{{route('user.admin.store',['id'=>$row->id ?? -1])}}" method="post" class="needs-validation" novalidate>
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? 'Edit: '.$row->getDisplayName() : 'Add new user'}}</h1>
                </div>
            </div>
            @include('admin.message')
            <div class="row">
                <div class="col-md-9">
                    <div class="panel">
                        <div class="panel-title"><strong>{{ __('Informasi User')}}</strong></div>
                        <div class="panel-body">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{__("Nama Perusahaan")}} <span class="text-danger">*</span></label>
                                        <input type="text" value="{{old('business_name',$row->business_name)}}" name="business_name" placeholder="{{__("Nama Perusahaan")}}" class="form-control">
                                    </div>
                                </div>
<!--                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("User name")}}</label>
                                        <input type="text" name="user_name" required value="{{old('user_name',$row->user_name)}}" placeholder="{{__("User name")}}" class="form-control">
                                    </div>
                                </div>-->
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Nama Depan (sesuai paspor)")}} <span class="text-danger">*</span></label>
                                        <input type="text" value="{{old('first_name',$row->first_name)}}" name="first_name" placeholder="{{__("Nama Depan")}}" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Nama Belakang (sesuai paspor)")}} <span class="text-danger">*</span></label>
                                        <input type="text" value="{{old('last_name',$row->last_name)}}" name="last_name" placeholder="{{__("Nama Belakang")}}" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Nama Ayah Kandung")}}</label>
                                        <input type="text" value="{{old('father_name',$row->father_name)}}" name="father_name" placeholder="{{__("Nama Ayah Kandung")}}" class="form-control form-control-sm">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Nama Ibu Kandung")}} <span class="text-danger">*</span></label>
                                        <input type="text" value="{{old('mother_name',$row->mother_name)}}" name="mother_name" placeholder="{{__("Nama Ibu Kandung")}}" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{__("Tempat Lahir")}} <span class="text-danger">*</span></label>
                                        <input type="text" value="{{old('birthcity',$row->birthcity)}}" name="birthcity" placeholder="{{__("Tempat Lahir")}}" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>{{__("Tgl Lahir")}} <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('birthday',$row->birthday ? date("Y/m/d",strtotime($row->birthday)) :'') }}" placeholder="{{ __('Tgl Lahir')}}" name="birthday" class="form-control has-datepicker input-group date" required>
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
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("No. HP Aktif")}} <span class="text-danger">*</span></label>
                                        <input type="text" value="{{old('phone',$row->phone)}}" name="phone" placeholder="{{__("No. HP Aktif")}}" class="form-control" required>
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
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Pekerjaan/Jabatan")}}</label>
                                        <input type="text" name="job" value="{{old('job',$row->job)}}" placeholder="{{__("Pekerjaan/Jabatan")}}" class="form-control">
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
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{__("Sebutkan penanganan khusus Anda (jika ada)")}}</label>
                                        <input type="text" name="special_handling" value="{{old('special_handling',$row->special_handling)}}" placeholder="{{__("Sebutkan penanganan khusus Anda (jika ada)")}}" class="form-control">
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
                            <hr>
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="panel">
                                        <div class="panel-title"><strong>{{ __('Foto')}}</strong></div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('avatar_id',old('avatar_id',$row->avatar_id)) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="panel">
                                        <div class="panel-title"><strong>{{ __('KTP')}}</strong></div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('idcard_id',old('idcard_id',$row->idcard_id)) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="panel">
                                        <div class="panel-title"><strong>{{ __('Kartu Keluarga')}}</strong></div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('familycard_id',old('familycard_id',$row->familycard_id)) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="panel">
                                        <div class="panel-title"><strong>{{ __('Paspor')}}</strong></div>
                                        <div class="panel-body">
                                            <div class="form-group">
                                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('passport_id',old('passport_id',$row->passport_id)) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

<!--                            <div class="form-group">
                                <label class="control-label">{{ __('Biographical')}}</label>
                                <div class="">
                                    <textarea name="bio" class="d-none has-ckeditor" cols="30" rows="10">{{old('bio',$row->bio)}}</textarea>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-title"><strong>{{ __('Publish')}}</strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>{{__('Status')}}</label>
                                <select required class="custom-select" name="status">
                                    <option @if(old('status',$row->status) =='publish') selected @endif value="publish">{{ __('Publish')}}</option>
                                    <option @if(old('status',$row->status) =='blocked') selected @endif value="blocked">{{ __('Blocked')}}</option>
                                </select>
                            </div>
                            @if(is_admin())
                                @if(empty($user_type) or $user_type != 'vendor')
                                    <div class="form-group">
                                        <label>{{__('Role')}} <span class="text-danger">*</span></label>
                                        <select required class="form-control" name="role_id">
                                            <option value="">{{ __('-- Pilih --')}}</option>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" @if(old('role_id',$row->role_id) == $role->id) selected @elseif(old('role_id')  == $role->id ) selected @elseif(request()->input("user_type")  == strtolower($role->name) ) selected @endif >{{ucfirst($role->name)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label>{{__('Email Terverifikasi?')}}</label>
                                    <select  class="form-control" name="is_email_verified">
                                        <option value="">{{ __('Tidak')}}</option>
                                        <option @if(old('is_email_verified',$row->email_verified_at ? 1 : 0)) selected @endif value="1">{{__('Ya')}}</option>
                                    </select>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="panel">
                        <div class="panel-title"><strong>{{ __('User Cogs')}}</strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>{{__('Status')}}</label>
                                <select required class="custom-select" name="cogs">
                                    <option @if(old('cogs',$row->cogs) == 1) selected @endif value="1">{{ __('Ya')}}</option>
                                    <option @if(old('cogs',$row->cogs) == 0) selected @endif value="0">{{ __('Tidak')}}</option>
                                </select>
                            </div>
                            @if(is_admin())
                                @if(empty($user_type) or $user_type != 'vendor')
                                    <div class="form-group">
                                        <label>{{__('Role')}} <span class="text-danger">*</span></label>
                                        <select required class="form-control" name="level">
                                            <option value="">{{ __('-- Pilih --')}}</option>
                                            <option value="admin" @if(old('level',$row->level) == 'admin') selected @elseif(old('level')  == 'admin') selected @elseif(request()->input("level")  == 'admin' ) selected @endif >Admin</option>
                                            <option value="user" @if(old('level',$row->level) == 'user') selected @elseif(old('level')  == 'user') selected @elseif(request()->input("level")  == 'user' ) selected @endif >User</option>
                                        </select>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    
                    <div class="panel">
                        <div class="panel-title"><strong>{{ __('Agent')}}</strong></div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>{{__('Jenis Komisi Agent')}}</label>
                                <div class="form-controls">
                                    <select name="vendor_commission_type" class="form-control">
                                        <option value="">{{__("Default")}}</option>
                                        <option value="percent" {{old("vendor_commission_type",($row->vendor_commission_type ?? '')) == 'percent' ? 'selected' : ''  }}>{{__('Percent')}}</option>
                                        <option value="amount" {{old("vendor_commission_type",($row->vendor_commission_type ?? '')) == 'amount' ? 'selected' : ''  }}>{{__('Amount')}}</option>
                                        <option value="disable" {{old("vendor_commission_type",($row->vendor_commission_type ?? '')) == 'disable' ? 'selected' : ''  }}>{{__('Disable Commission')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{__('Nilai Komisi Agent')}}</label>
                                <div class="form-controls">
                                    <input type="text" class="form-control" name="vendor_commission_amount" value="{{old("vendor_commission_amount",($row->vendor_commission_amount ?? '')) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between">
                <span></span>
                <button class="btn btn-primary" type="submit">{{ __('Simpan')}}</button>
            </div>
        </div>
    </form>
@endsection
