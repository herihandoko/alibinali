@extends('layouts.user')
@section('content')
<h2 class="title-bar no-border-bottom">
    {{ __('Daftar Paket') }}
</h2>
@include('admin.message')
<div class="row justify-content-center">
    @foreach($list_paket as $key => $tour)
    {{-- <?= dd($tour) ?> --}}
    <div class="col-md-12 col-xl-12 mb-2">
        <div class="card shadow-0 border rounded-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                        <div class="bg-image hover-zoom ripple rounded ripple-surface">
                            <img src="{{ $tour->getImageUrl('thumb') }}" width="225" height="150"/>
                            <a href="#!">
                                <div class="hover-overlay">
                                    <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <h5>{{ $tour->title }}</h5>
                        <div class="d-flex flex-row">
                            <div class="text-danger mb-1 me-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p class="text-truncate mb-4 mb-md-0">
                            <p class="mt-3 mb-1"><i class="simple-icon-plane mr-1"></i>
                                Dari: <span class="text-primary font-weight-bold ml-1">JAKARTA</span>
                            </p> 
                                <p class="mb-3"><i class="simple-icon-calendar mr-1"></i>
                                Keberangkatan: <span class="text-primary font-weight-bold ml-1">24 Des 2023</span>
                            </p> 
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                        <div class="d-flex flex-row align-items-center mb-1">
                            <h4 class="mb-1 me-1">{{ number_format($tour->price,0) }}</h4>
                        </div>
                        <div class="d-flex flex-column mt-4">
                            <a class="btn btn-primary btn-sm" href="{{ url('/tour/'.$tour->slug) }}" target="_blank">Lihat Detail</a>
                            <button class="btn btn-outline-primary btn-sm mt-2" type="button"> Pesan Sekarang </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
