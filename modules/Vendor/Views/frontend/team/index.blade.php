@extends('layouts.user')

@section('content')
    <style>
        .btn {
            border: none;
            border-radius: 3px;
            box-shadow: none;
            font-size: 12px;
            font-weight: 500;
            padding: 8px 20px;
            transition: background .2s,color .2s
        }

        .bootstrap-table .fixed-table-container .fixed-table-body {
            overflow-x: auto;
            overflow-y: auto;
            min-height: 200px !important;
        }
    </style>
    
    <h2 class="title-bar no-border-bottom">
        {{__("Daftar Jamaah")}}
    </h2>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="float-left d-inline">
                <a href="{{ route('admin.company.create') }}" class="btn btn-success btn-sm mt-3">
                    <i class="fa fa-plus"></i> Tambah
                </a>
            </div>
            <table class="table table-bordered table-striped table-sm" data-toggle="table" data-search="true" data-show-columns="true" width="100%" cellspacing="0" style="font-size: small;">
                <thead style="text-align: center;">
                    <tr>
                        <th width="2%" data-sortable="true">{{__("No.")}}</th>
                        <th data-field="name" data-sortable="true">{{__("Nama")}}</th>
                        <th data-field="email" data-sortable="true">{{__("Alamat Email")}}</th>
                        <th data-field="phone" data-sortable="true">{{__("No. Telpon")}}</th>
                        <th data-field="phone" data-sortable="true">{{ __('Virtual Account') }}</th>
                        <th data-field="created_at" data-sortable="true">{{__("Tgl Pendaftaran")}}</th>
                        <th data-field="status" data-sortable="true">{{__("Status")}}</th>
                        <th data-sortable="true">{{__("Aksi")}}</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i=0; @endphp
                    @foreach($rows as $vendorTeam)
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td>
                                {{ $vendorTeam->member->display_name ?? '-' }}
                            </td>
                            <td>
                                {{ $vendorTeam->member->email?? '-' }}
                            </td>
                            <td>
                                {{ $vendorTeam->member->phone?? '-' }}
                            </td>
                            <td>
                                {{ $vendorTeam->member->va_number ?? '-' }}
                            </td>
                            <td style="text-align: center;">
                                @if($vendorTeam->member->created_at)
                                    {!! date('d-m-Y H:i:s', strtotime($vendorTeam->member->created_at)) !!}
                                @else
                                    {{ '-' }}
                                @endif
                            </td>
                            <td style="text-align: center;">
                                <span class="btn-success btn-sm">
                                    {{$vendorTeam->status_text}}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <div class="dropdown">
                                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        {{__("Aksi")}}
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('user.list_package', ['member_id' => $vendorTeam->member->id]) }}">{{ __('Pilih Paket') }}</a>
                                        <a class="dropdown-item" href="{{route('vendor.team.edit',['vendorTeam'=>$vendorTeam])}}">{{__("Ubah")}}</a>
                                        @if($vendorTeam->status == Modules\Vendor\Models\VendorTeam::STATUS_PENDING)
                                            <a class="dropdown-item" href="{{route('vendor.team.re-send-request',['vendorTeam'=>$vendorTeam])}}">{{__("Send email")}}</a>
                                        @endif
                                        <a class="dropdown-item" href="{{URL::signedRoute('vendor.team.delete',['vendorTeam'=>$vendorTeam->id])}}">{{__("Hapus")}}</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection