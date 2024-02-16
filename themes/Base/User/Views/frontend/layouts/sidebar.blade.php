<?php
$dataUser = Auth::user();
$menus = [
    'dashboard' => [
        'url' => route("vendor.dashboard"),
        'title' => __("Dashboard"),
        'icon' => 'fa fa-home',
        'permission' => 'dashboard_vendor_access',
        'position' => 10
    ],
    "daftar-paket" => [
        'url' => route("user.list_package"),
        'title' => __("Daftar Paket"),
        'icon' => 'fa fa-list',
        'position' => 15
    ],
    "virtual-account" => [
        'url' => route("user.virtual_account"),
        'title' => __("Tabungan Jamaah"),
        'icon' => 'fa fa-money',
        'position' => 21
    ],
    'booking-history' => [
        'url' => route("user.booking_history"),
        'title' => __("Daftar Pemesanan"),
        'icon' => 'fa fa-clock-o',
        'position' => 20
    ],
//    "wishlist"=>[
//        'url'   => route("user.wishList.index"),
//        'title' => __("Wishlist"),
//        'icon'  => 'fa fa-heart-o',
//        'position' => 21
//    ],
    'profile' => [
        'url' => route("user.profile.index"),
        'title' => __("Profil"),
        'icon' => 'fa fa-cogs',
        'position' => 99
    ],
    'password' => [
        'url' => route("user.change_password"),
        'title' => __("Ubah Password"),
        'icon' => 'fa fa-lock',
        'position' => 100
    ],
    'admin' => [
        'url' => route('admin.index'),
        'title' => __("Admin Dashboard"),
        'icon' => 'icon ion-ios-ribbon',
        'permission' => 'dashboard_access',
        'position' => 110
    ]
];

// Modules
$custom_modules = \Modules\ServiceProvider::getModules();
if (!empty($custom_modules)) {
    foreach ($custom_modules as $module) {
        $moduleClass = "\\Modules\\" . ucfirst($module) . "\\ModuleProvider";
        if (class_exists($moduleClass)) {
            $menuConfig = call_user_func([$moduleClass, 'getUserMenu']);
            if (!empty($menuConfig)) {
                $menus = array_merge($menus, $menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass, 'getUserSubMenu']);
            if (!empty($menuSubMenu)) {
                foreach ($menuSubMenu as $k => $submenu) {
                    $submenu['id'] = $submenu['id'] ?? '_' . $k;
                    if (!empty($submenu['parent']) and isset($menus[$submenu['parent']])) {
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                                    return $value['position'] ?? 100;
                                }));
                    }
                }
            }
        }
    }
}

// Plugins Menu
$plugins_modules = \Plugins\ServiceProvider::getModules();
if (!empty($plugins_modules)) {
    foreach ($plugins_modules as $module) {
        $moduleClass = "\\Plugins\\" . ucfirst($module) . "\\ModuleProvider";
        if (class_exists($moduleClass)) {
            $menuConfig = call_user_func([$moduleClass, 'getUserMenu']);
            if (!empty($menuConfig)) {
                $menus = array_merge($menus, $menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass, 'getUserSubMenu']);
            if (!empty($menuSubMenu)) {
                foreach ($menuSubMenu as $k => $submenu) {
                    $submenu['id'] = $submenu['id'] ?? '_' . $k;
                    if (!empty($submenu['parent']) and isset($menus[$submenu['parent']])) {
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                                    return $value['position'] ?? 100;
                                }));
                    }
                }
            }
        }
    }
}

// Custom Menu
$custom_modules = \Custom\ServiceProvider::getModules();
if (!empty($custom_modules)) {
    foreach ($custom_modules as $module) {
        $moduleClass = "\\Custom\\" . ucfirst($module) . "\\ModuleProvider";
        if (class_exists($moduleClass)) {
            $menuConfig = call_user_func([$moduleClass, 'getUserMenu']);
            if (!empty($menuConfig)) {
                $menus = array_merge($menus, $menuConfig);
            }
            $menuSubMenu = call_user_func([$moduleClass, 'getUserSubMenu']);
            if (!empty($menuSubMenu)) {
                foreach ($menuSubMenu as $k => $submenu) {
                    $submenu['id'] = $submenu['id'] ?? '_' . $k;
                    if (!empty($submenu['parent']) and isset($menus[$submenu['parent']])) {
                        $menus[$submenu['parent']]['children'][$submenu['id']] = $submenu;
                        $menus[$submenu['parent']]['children'] = array_values(\Illuminate\Support\Arr::sort($menus[$submenu['parent']]['children'], function ($value) {
                                    return $value['position'] ?? 100;
                                }));
                    }
                }
            }
        }
    }
}

$currentUrl = url(Illuminate\Support\Facades\Route::current()->uri());
if (!empty($menus))
    $menus = array_values(\Illuminate\Support\Arr::sort($menus, function ($value) {
                return $value['position'] ?? 100;
            }));
foreach ($menus as $k => $menuItem) {
    if (!empty($menuItem['permission']) and !Auth::user()->hasPermission($menuItem['permission'])) {
        unset($menus[$k]);
        continue;
    }
    $menus[$k]['class'] = $currentUrl == url($menuItem['url']) ? 'active' : '';
    if (!empty($menuItem['children'])) {
        $menus[$k]['class'] .= ' has-children';
        foreach ($menuItem['children'] as $k2 => $menuItem2) {
            if (!empty($menuItem2['permission']) and !Auth::user()->hasPermission($menuItem2['permission'])) {
                unset($menus[$k]['children'][$k2]);
                continue;
            }
            $menus[$k]['children'][$k2]['class'] = $currentUrl == url($menuItem2['url']) ? 'active active_child' : '';
        }
    }
}
?>
<div class="sidebar-user">
    <div class="bravo-close-menu-user"><i class="icofont-scroll-left"></i></div>
    <div class="logo">
        @if($avatar_url = $dataUser->getAvatarUrl())
        <div class="avatar avatar-cover" style="background-image: url('{{$dataUser->getAvatarUrl()}}')"></div>
        @else
        <span class="avatar-text">{{ucfirst($dataUser->getDisplayName()[0])}}</span>
        @endif
    </div>
    <div class="user-profile-avatar">
        <div class="info-new">
            <span class="role-name badge badge-info">
                @if($dataUser->role_name == 'Vendor')
                    Mitra
                @else
                    {{ $dataUser->role_name }}  
                @endif      
            </span>
            <h5>{{$dataUser->getDisplayName()}}</h5>
            <p>{{ __("Terdaftar Sejak :time",["time"=> date("d M Y",strtotime($dataUser->created_at))]) }}</p>
        </div>
    </div>
    <div class="user-profile-plan">
        @if( !Auth::user()->hasPermission("dashboard_vendor_access") and setting_item('vendor_enable'))
        {{-- <a href=" {{ route("user.upgrade_vendor") }}">{{ __("Jadi Mitra") }}</a> --}}
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target=".bd-example-modal-lg">{{ __("Jadi Mitra") }}</button>
        @else
        <span class="role-name badge badge-success">
            {{ __("Kode Referral:") }}
        </span>
        {{-- <span>{{ isset($dataUser->userReferralCode()->referral_code)?$dataUser->userReferralCode()->referral_code:'-' }}</span> --}}
        <div class="col-md-12 mt-2">
            <input type="text" class="form-control" value="{{ isset($dataUser->userReferralCode()->referral_code)?$dataUser->userReferralCode()->referral_code:'-' }}" disabled style="text-align: center;" id="input-kode-referal">
            <div class="row mt-1">
                <div class="col-md-6 mt-1">
                    <button class="btn btn-info mr-1 btn-block" type="button" id="button-copy-kode-referal" onclick="copyToClipboard('{!! isset($dataUser->userReferralCode()->referral_code)?$dataUser->userReferralCode()->referral_code:'-' !!}')" data-toggle="tooltip" data-placement="bottom" title="Copy Kode Referal">
                        <i class="fa fa-copy"></i> Copy
                    </button>
                </div>
                <div class="col-md-6 mt-1">
                    <button class="btn btn-success btn-block" type="button" id="button-share-kode-referal" onclick="shareToWhatsapp('{!! isset($dataUser->userReferralCode()->referral_code)?url('refferal/'.$dataUser->userReferralCode()->referral_code):'-' !!}')" data-toggle="tooltip" data-placement="bottom" title="Share Kode Referal">
                        <i class="fa fa-share"></i> Bagikan
                    </button>
                </div>    
            </div>  
        </div>
                   
        @endif
    </div>
    <div class="sidebar-menu">
        <ul class="main-menu">
            @foreach($menus as $menuItem)
            <li class="{{$menuItem['class']}}" position="{{$menuItem['position'] ?? ""}}">
                <a href="{{ url($menuItem['url']) }}">
                    @if(!empty($menuItem['icon']))
                    <span class="icon text-center"><i class="{{$menuItem['icon']}}"></i></span>
                    @endif
                    {!! clean($menuItem['title']) !!}

                </a>
                @if(!empty($menuItem['children']))
                <i class="caret"></i>
                @endif
                @if(!empty($menuItem['children']))
                <ul class="children">
                    @foreach($menuItem['children'] as $menuItem2)
                    <li class="{{$menuItem2['class']}}"><a href="{{ url($menuItem2['url']) }}">
                            @if(!empty($menuItem2['icon']))
                            <i class="{{$menuItem2['icon']}}"></i>
                            @endif
                            {!! clean($menuItem2['title']) !!}</a></li>
                    @endforeach
                </ul>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
    <div class="logout">
        <form id="logout-form-vendor" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-vendor').submit();"><i class="fa fa-sign-out"></i> {{__("Keluar")}}
        </a>
    </div>
    <div class="logout">
        <a href="{{url('/')}}" style="color: #1ABC9C"><i class="fa fa-long-arrow-left"></i> {{__("Website")}}</a>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: black;">Perjanjian Kerja Sama</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <embed src="{{ url('uploads/pks.pdf') }}" frameborder="0" width="100%" height="400px">
                    <p style="color: black" class="mt-3">
                        <input type="checkbox" name="agree" id="chk-agree" onchange="showButtonTNC()"> Saya telah membaca dan menyetujui syarat dan ketentuan.
                    </p>    
              </div>
              <div class="modal-footer">
                <a href="{{ route("user.upgrade_vendor") }}" id="btn-pks-agree" class="btn btn-primary w-100 disabled">{{ __("Saya Setuju") }}</a>
              </div>
        </div>
    </div>
</div>
@push('js')
<script>
    function copyToClipboard(params) {
        var textToCopy = $('input#input-kode-referal').val();
        navigator.clipboard.writeText(textToCopy).then(function() {
            $('#button-copy-kode-referal').tooltip('hide')
            .attr('data-original-title', 'Copied: ' + params)
            .tooltip('show');
        }).catch(function(err) {
            console.error('Unable to copy text', err);
        });
    }

    function shareToWhatsapp(params) {
        var whatsapp_url = "https://wa.me/?text=" + encodeURIComponent(params);
        window.open(whatsapp_url, '_blank');
    }

    function showButtonTNC(){
        if($('input#chk-agree').is(":checked")){
            $('#btn-pks-agree').attr('class','btn btn-success w-100');
        }else{
            $('#btn-pks-agree').attr('class','btn btn-primary w-100 disabled');
        }
    }
</script>
@endpush
