<?php

namespace Modules\Vendor\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Modules\FrontendController;
use Modules\Vendor\Events\VendorTeamRequestCreatedEvent;
use Modules\Vendor\Models\VendorTeam;
use Modules\User\Models\Role;
use Illuminate\Support\Facades\Validator;
use Modules\User\Models\User;
use Modules\User\Models\VendorReferral;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TeamController extends FrontendController
{

    public function index_(){

        $rows = auth()->user()->vendorTeams()->with('vendor')->paginate(30);
        $data = [
            'page_title'=>__("Team members"),
            'rows'=>$rows,
            'breadcrumbs'=>[
                [
                    'name'=>__("Team members")
                ]
            ]
        ];
        return view('Vendor::frontend.team.index',$data);
    }
    
    public function index() {
        $rows = auth()->user()->vendorTeams()->with('vendor')->where('deleted_at', null)->orderBy('created_at', 'desc')->paginate(30);
        
        $data = [
            'page_title'=>__("Daftar Jamaah"),
            'rows'=>$rows,
            'breadcrumbs'=>[
                [
                    'name'=>__("Daftar Jamaah")
                ]
            ]
        ];
        
        return view('Vendor::frontend.team.index',$data);
    }
    
    public function create() {
        $row = new User();
        $data = [
            'page_title'=>__("Biodata Jamaah"),
            'row' => $row,
            'breadcrumbs'=>[
                [
                    'name'=>__("Daftar Jamaah"),
                    'url'=>route('vendor.team.index')
                ],
                [
                    'name'=>__("Biodata Jamaah"),
                    'class' => 'active'
                ]
            ]
        ];
        
        return view('Vendor::frontend.team.create', $data);
    }
    
    public function edit(Request $request, $id)
    {
        $row = User::find($id);
        if (empty($row)) {
            return redirect(route('vendor.team.index'));
        }
        
        $data = [
            'page_title'=>__("Biodata Jamaah"),
            'row'   => $row,
            'roles' => Role::all(),
            'breadcrumbs'=>[
                [
                    'name'=>__("Daftar Jamaah"),
                    'url'=>route('vendor.team.index')
                ],
                [
                    'name'=>__("Ubah Jamaah"),
                    'class' => 'active'
                ],
            ]
        ];
        
        return view('Vendor::frontend.team.create', $data);
    }
    
    public function store(Request $request, $id)
    {
        if($id and $id > 0){
            $row = User::find($id);
        } else {
            $row = new User();
        }
        
        $messages = [
            'phone.required'      => __('Nomor Telp. wajib diisi'),
            'phone.unique'      => __('Nomor Telp. sudah terdaftar'),
            'email.required'      => __('Alamat Email wajib diisi'),
            'email.email'         => __('Alamat Email tidak valid'),
            'email.unique'      => __('Alamat Email sudah terdaftar'),
            'first_name.required' => __('Nama Depan wajib diisi'),
            'last_name.required'  => __('Nama Belakang wajib diisi'),
            'gender.required' => __('Jenis Kelamin belum dipilih.'),
            'wheelchair_facilities.required' => __('Kebutuhan Fasilitas Kursi Roda belum dipilih.'),
        ];
        
        $request->validate([
            'first_name' => [
                'required',
                'string',
                'max:255'
            ],
            'last_name'  => [
                'required',
                'string',
                'max:255'
            ],
            'email'      => [
                'required',
                'string',
                'email',
                'max:255',
                $id > 0 ? Rule::unique('users')->ignore($row->id) : Rule::unique('users')
            ],
            'phone' => [
                'required',
                $id > 0 ? Rule::unique('users')->ignore($row->id) : Rule::unique('users')
            ],
            'gender' => [
                'required'
            ],
            'wheelchair_facilities' => [
                'required'
            ],
        ], $messages);
        
        $data = [
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'user_name'=>$request->input('user_name'),
            'phone'=>$request->input('phone'),
            'birthday'=>$request->input('birthday') ? date("Y-m-d", strtotime($request->input('birthday'))) : null,
            'status'=>$request->input('publish','publish'),
            'avatar_id'=>$request->input('avatar_id'),
            'email'=>$request->input('email'),
            'name'=>$request->input('name'),
            'address'=>$request->input('address'),

            'father_name'=>$request->input('father_name'),
            'mother_name'=>$request->input('mother_name'),
            'birthcity'=>$request->input('birthcity'),
            'gender'=>$request->input('gender'),
            'married_status'=>$request->input('married_status'),
            'job'=>$request->input('job'),
            'last_edu'=>$request->input('last_edu'),
            'umrah_ever'=>$request->input('umrah_ever'),
            'haji_ever'=>$request->input('haji_ever'),
            'special_disease'=>$request->input('special_disease'),
            'special_handling'=>$request->input('special_handling'),
            'wheelchair_facilities'=>$request->input('wheelchair_facilities'),
            'idcard_id'=>$request->input('idcard_id'),
            'familycard_id'=>$request->input('familycard_id'),
            'passport_id'=>$request->input('passport_id'),
            'role_id'=>$request->input('3','3'),
            'password'=> Hash::make($request->input('Alibinali123!', 'Alibinali123!')),
        ];

        $row->fillByAttr(array_keys($data),$data);
        $rowSave = $row->save();

        if ($rowSave == true and $id == 0) {
            $vendorReferral = VendorReferral::where('user_id', Auth::id())->first();
            $updVendorReferral = VendorReferral::find($vendorReferral->id);
            $updVendorReferral->update([
                'referral_count' => $updVendorReferral->referral_count + 1,
                'points' => $updVendorReferral->points + 1,
            ]);
            
            $saveVendorMember = new VendorTeam();
            $saveVendorMember->vendor_id = $updVendorReferral->user_id;
            $saveVendorMember->member_id = $row->id;
            $saveVendorMember->create_user = $updVendorReferral->user_id;
            $saveVendorMember->status = VendorTeam::STATUS_PUBLISH;
            $saveVendorMember->save();
            
            return back()->with('success', ($id and $id > 0) ? __('Biodata jamaah berhasil diperbarui'):__("Biodata jamaah berhasil dibuat"));
        } else {
            return back()->with('success', ($id and $id > 0) ? __('Biodata jamaah berhasil diperbarui'):__("Biodata jamaah berhasil dibuat"));
        }
    }
    
    public function delete($id) {
        $data = User::find($id)->delete();
        if($data) {
            $idMember = VendorTeam::where('member_id', $id)->first();
            $deleteMember = VendorTeam::find($idMember->id)->delete();
            $vendorReferral = VendorReferral::where('user_id', Auth::id())->first();
            $updVendorReferral = VendorReferral::find($vendorReferral->id);
            $updVendorReferral->update([
                'referral_count' => $updVendorReferral->referral_count - 1,
                'points' => $updVendorReferral->points - 1,
            ]);
            return back()->with('success',__("Data berhasil dihapus"));
        }
    }
    
    public function add(Request $request){
        $request->validate([
            'email'=>[
                'required',
                'email',
                Rule::exists('users','email')
            ],
            'permissions'=>'required|array'
        ]);

        $email = $request->input('email');
        $member = User::whereEmail($email)->first();
        if(!$member){
            return back()->with('danger',__("Member does not exists"));
        }

        $currentUser = auth()->user();

        if($currentUser->email == $email){
            return back()->with('danger',__("You can not add yourself"));
        }

        $check = $currentUser->members()->where('member_id',$member->id)->first();
        if($check){
            return back()->with('danger',__("Request exists"));
        }

        $check = new VendorTeam();
        $check->vendor_id = $currentUser->id;
        $check->member_id = $member->id;
        $check->status = setting_item('vendor_team_auto_approved') ? VendorTeam::STATUS_PUBLISH : VendorTeam::STATUS_PENDING;
        $check->permissions = $request->input('permissions',[]);
        $check->save();

        VendorTeamRequestCreatedEvent::dispatch($check);

        return back()->with('success',__("Request created"));

    }

    public function reSendRequest(Request $request,$id){
        $vendor_team = VendorTeam::find($id);
        if(!empty($vendor_team)){
            VendorTeamRequestCreatedEvent::dispatch($vendor_team);
        }
        return back()->with(['success'=>'Sent success']);
    }

    public function accept(Request $request)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }
        $vendor_team = \request()->input('vendor_team');
        if(!empty($vendor_team)){
            $vendor_team = VendorTeam::find($vendor_team);
            if(!empty($vendor_team)){
                $vendor_team->status = VendorTeam::STATUS_PUBLISH;
                $vendor_team->save();
            }
        }
        return redirect(route('home'));
    }
}
