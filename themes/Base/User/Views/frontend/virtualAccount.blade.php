@extends('layouts.user')
@section('content')
    <h2 class="title-bar no-border-bottom">
        {{ __('Tabungan Jamaah') }}
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
                            <td style="border-top: 1px solid #ffffff;" width="50%">{{ __('Kode Virtual Account') }}</td>
                            <td style="border-top: 1px solid #ffffff;" width="5%">:</td>
                            <td style="border-top: 1px solid #ffffff;">{{ isset($dataUser->va_number) ? '9600' : '-' }}</td>
                        </tr>
                        <tr>
                            <td width="50%"> {{ __('Nama Virtual Account') }}</td>
                            <td width="5%">:</td>
                            <td>{{ isset($dataUser->va_name) ? $dataUser->va_name : '-' }}</td>
                        </tr>
                        <tr>
                            <td width="50%">{{ __('Nomo Virtual Account') }}</td>
                            <td width="5%">:</td>
                            <td>{{ isset($dataUser->va_number) ? $dataUser->va_number : '-' }}</td>
                        </tr>
                        <tr>
                            <td width="50%">{{ __('Nomor Jamaah') }}</td>
                            <td width="5%">:</td>
                            <td>{{ isset($dataUser->customer_number) ? $dataUser->customer_number : '-' }}</td>
                        </tr>
                        <tr>
                            <td style="border-bottom: 1px solid #dee2e6;" width="50%">{{ __('Balance') }}</td>
                            <td style="border-bottom: 1px solid #dee2e6;" width="5%">:</td>
                            <td style="border-bottom: 1px solid #dee2e6;">{{ number_format($balance, 2) }}</td>
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
    <div class="page-content page-container mt-1" id="page-content">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ __('Riwayat Transaksi') }}</h5>
                        <p class="card-description">Daftar riwayat transaksi pada akun virtual BTN</p>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Kode Transaksi</th>
                                        <th class="text-center">Tanggal Pembayaran</th>
                                        <th class="text-center">Nominal (IDR)</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                @if ($balance > 0)
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($history as $key => $val)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $val->transaction_code }}</td>
                                                <td class="text-center">
                                                    {{ date('d M Y', strtotime($val->payment_date)) }}<br>
                                                    <p style="color:gray; font-size:10px;">
                                                        {{ date('h:m:s A', strtotime($val->payment_date)) }}</p>
                                                </td>
                                                <td class="text-right">{{ number_format($val->amount, 2) }}</td>
                                                <td><label class="badge badge-success">Success</label></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                @else
                                    <tbody>
                                        <tr>
                                            <td class="text-center" colspan="5">No Transaction History</td>
                                        </tr>
                                    </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection