@extends('layouts.user')
@section('content')
    <h2 class="title-bar">
        {{__("Ubah Password")}}
    </h2>
    @include('admin.message')
    <form action="{{ route("user.change_password.update") }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>{{__("Password Saat Ini")}}</label>
                    <input type="password" required name="current-password" placeholder="{{__("Password Saat Ini")}}" class="form-control">
                </div>
                <div class="form-group">
                    <label>{{__("Password Baru")}}</label>
                    <input type="password" required name="new-password" minlength="8" placeholder="{{__("Password Baru")}}" class="form-control">
                    <p><i>{{__("* Password mengandung setidaknya satu huruf besar, satu huruf kecil, satu angka, dan satu simbol.")}}</i></p>
               </div>
                <div class="form-group">
                    <label>{{__("Konfirmasi Password")}}</label>
                    <input type="password" required name="new-password_confirmation" minlength="8" placeholder="{{__("Konfirmasi Password")}}" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <hr>
                <input type="submit" class="btn btn-primary" value="{{__("Ubah Password")}}">
                <a href="{{ route("user.profile.index") }}" class="btn btn-default">{{__("Batal")}}</a>
            </div>
        </div>
    </form>
@endsection
@push('js')

@endpush
