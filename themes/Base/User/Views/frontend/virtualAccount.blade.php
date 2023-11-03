@extends('layouts.user')
@section('content')
<h2 class="title-bar no-border-bottom">
    {{ __('Virtual Account') }}
</h2>
@include('admin.message')
@include('admin.notifva')
<div class="booking-history-manager">
    <div class="text-center">
        <img src="/images/btn-logo.png" class="rounded" alt="BTN Logo" height="50px">
    </div>
    <hr>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <table class="table">
                <tbody>
                    <tr>
                        <td style="border-top: 1px solid #ffffff;" width="50%">{{ __('Virtual Code') }}</td>
                        <td style="border-top: 1px solid #ffffff;" width="5%">:</td>
                        <td style="border-top: 1px solid #ffffff;">{{ isset($dataUser->va_number) ? '9600' : '-'}}</td>
                    </tr>
                    <tr>
                        <td width="50%"> {{ __('Virtual Account Name') }}</td>
                        <td width="5%">:</td>
                        <td>{{ isset($dataUser->va_name) ? $dataUser->va_name : '-' }}</td>
                    </tr>
                    <tr>
                        <td width="50%">{{ __('Virtual Account Number') }}</td>
                        <td width="5%">:</td>
                        <td>{{ isset($dataUser->va_number) ? $dataUser->va_number : '-'}}</td>
                    </tr>
                    <tr>
                        <td width="50%">{{ __('Jamaah Number') }}</td>
                        <td width="5%">:</td>
                        <td>{{ isset($dataUser->customer_number) ? $dataUser->customer_number : '-'}}</td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid #dee2e6;" width="50%">{{ __('Balance') }}</td>
                        <td style="border-bottom: 1px solid #dee2e6;" width="5%">:</td>
                        <td style="border-bottom: 1px solid #dee2e6;"><a href="{{ route("user.booking_history") }}">{{ isset($dataUser->balance) ? 'Rp 0.00' : '-'  }}</a></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 1px solid #dee2e6;" width="50%">{{ __('Expired Date') }}</td>
                        <td style="border-bottom: 1px solid #dee2e6;" width="5%">:</td>
                        <td style="border-bottom: 1px solid #dee2e6;">-</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection
