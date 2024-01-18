@extends('layouts.user')

@section('content')
    <div class="row">
        <div class="col-md-10">
            <h4 class="title-bar no-border-bottom" style="padding-bottom:5px;">
                {{ __('Genealogy Tree') }}
            </h4>
            <p style="color:#ccc !important;">Anda dapat melihat daftar jumlah jamaah dan sahring profit yang anda dapatkan
                di sini.</p>
        </div>
        <div class="col-md-2 text-right">
            {{-- <a href="{{ route('vendor.team.create') }}" class="btn btn-success btn-sm mt-3">
                <i class="fa fa-plus"></i> {{ __('Invite Member') }}
            </a> --}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body" style="font-size:90%;">
                    <div class="row mb-3">
                        <div class="col-md-1">
                            <img src="{{ auth()->user()->getAvatarUrl() }}" class="rounded-circle mr-1 ml-2" width="60"
                                height="60">
                        </div>
                        <div class="col-md-4 text-left ml-5">
                            <h5 class="display-name">{{ auth()->user()->getDisplayName() }}</h5>
                            <p style="color: #ccc;">
                                {{ __('Member Since :time', ['time' => date('M Y', strtotime(auth()->user()->created_at))]) }}
                            </p>
                        </div>
                        <div class="col-md-3 text-center">
                            <h5 class="display-name">Rp 0.00</h5>
                            <p style="color: #ccc;">
                                {{ __('Paid to you') }}</p>
                        </div>
                        <div class="col-md-3 text-center">
                            <h5 class="display-name">
                                {{ Modules\Vendor\Models\VendorTeam::where('vendor_id', auth()->user()->id)->count() }}</h5>
                            <p style="color: #ccc;">
                                {{ __('Level 1') }}</p>
                        </div>
                    </div>
                    <table class="table table-hover ml-3">
                        <tbody>
                            {!! buildTreeTable(auth()->user()->id, 1) !!}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5>Top Perfomers</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <p style="color: #ccc; font-size:10px;">{{ __('Paid to you') }}</p>
                        </div>
                    </div>
                    @foreach ($teams as $key => $team)
                        <div class="row pt-1">
                            <div class="col-md-2">
                                <img src="{{ $team->member->getAvatarUrl() }}" class="rounded-circle mr-1 ml-2"
                                    width="30" height="30">
                            </div>
                            <div class="col-md-5 pl-4" style="border-bottom: #ccc solid 1px; margin-top:6px;">
                                <p style="font-size:12px; margin-bottom:0px;">{{ $team->member->display_name ?? '-' }}</p>
                                <p style="font-size:8px; color:#ccc;">{{ $team->membertree->count() }} Members</p>
                            </div>
                            <div class="col-md-5 pl-4 text-right" style="border-bottom: #ccc solid 1px; margin-top:6px;">
                                <p style="font-size:12px; color:#6ea832;">Rp 0.00</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .dot {
            height: 10px;
            width: 10px;
            background-color: #00acac !important;
            border-radius: 50%;
            display: inline-block;
        }

        .dot-red {
            height: 10px;
            width: 10px;
            background-color: #ff5b57 !important;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
@endpush
