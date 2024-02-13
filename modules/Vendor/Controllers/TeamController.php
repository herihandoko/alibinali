<?php

namespace Modules\Vendor\Controllers;

use App\Rules\HandphoneRule;
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
use Illuminate\View\View;
use Modules\User\Models\Kabupaten;
use Modules\User\Models\Kecamatan;
use Modules\User\Models\Provinsi;
use \App\Traits\ApiTrait;
use Illuminate\Support\Str;

class TeamController extends FrontendController
{
    use ApiTrait;

    public function index_()
    {

        $rows = auth()->user()->vendorTeams()->with('vendor')->paginate(30);
        $data = [
            'page_title' => __("Team members"),
            'rows' => $rows,
            'breadcrumbs' => [
                [
                    'name' => __("Team members")
                ]
            ]
        ];
        return view('Vendor::frontend.team.index', $data);
    }

    public function index()
    {
        $rows = auth()->user()->vendorTeams()->with('vendor')->where('deleted_at', null)->orderBy('created_at', 'desc')->paginate(30);
        // $member = VendorTeam::where('vendor_id',auth()->user()->id)->get()->toArray();

        $data = [
            'page_title' => __("Daftar Jamaah"),
            'rows' => $rows,
            'breadcrumbs' => [
                [
                    'name' => __("Daftar Jamaah")
                ]
            ]
        ];

        return view('Vendor::frontend.team.index', $data);
    }

    public function create()
    {
        $row = new User();
        $data = [
            'page_title' => __("Biodata Jamaah"),
            'row' => $row,
            'breadcrumbs' => [
                [
                    'name' => __("Daftar Jamaah"),
                    'url' => route('vendor.team.index')
                ],
                [
                    'name' => __("Biodata Jamaah"),
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
            'page_title' => __("Biodata Jamaah"),
            'row'   => $row,
            'roles' => Role::all(),
            'breadcrumbs' => [
                [
                    'name' => __("Daftar Jamaah"),
                    'url' => route('vendor.team.index')
                ],
                [
                    'name' => __("Ubah Jamaah"),
                    'class' => 'active'
                ],
            ]
        ];

        return view('Vendor::frontend.team.create', $data);
    }

    public function store(Request $request, $id)
    {
        if ($id and $id > 0) {
            $row = User::find($id);
        } else {
            $row = new User();
        }

        $messages = [
            'gender.required' => __('Title belum dipilih.'),
            'name.required' => __('Nama Jamaah wajib diisi'),
            'father_name.required' => __('Nama Ayah wajib diisi'),

            'jenis_identitas.required' =>  __('Jenis Identitas belum dipilih.'),
            'no_identitas.required' =>  __('Nomor Identitas wajib diisi.'),
            'birthcity.required' =>  __('Tempat Lahir wajib diisi.'),
            'birthday.required' =>  __('Tanggal Lahir wajib diisi.'),
            'address.required' =>  __('Alamat wajib diisi.'),
            'provinsi.required' =>  __('Provinsi belum dipilih.'),
            'kabupaten.required' =>  __('Kabupaten/Kota belum dipilih.'),
            'kecamatan.required' =>  __('Kecamatan belum dipilih.'),
            'kelurahan.required' =>  __('Kelurahan wajib diisi.'),
            'no_telp.required' =>  __('No Telp wajib diisi.'),

            'phone.required'      => __('Nomor Hp. wajib diisi'),
            'phone.unique'      => __('Nomor Hp. sudah terdaftar'),

            'kewarganegaraan.required' =>  __('Kewarganegaraan belum dipilih.'),
            'married_status.required' =>  __('Status Pernikahaan belum dipilih.'),
            'last_edu.required' =>  __('Jenis Pendidikan belum dipilih.'),
            'job.required' =>  __('Jenis Pekerjaan belum dipilih.'),

            'email.required'      => __('Alamat Email wajib diisi'),
            'email.email'         => __('Alamat Email tidak valid'),
            'email.unique'      => __('Alamat Email sudah terdaftar')
        ];

        $request->validate([
            'gender' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'father_name' => ['required', 'string', 'max:255'],
            'jenis_identitas' => ['required'],
            'no_identitas' => ['required'],
            'birthcity' => ['required'],
            'birthday' => ['required'],
            'address' => ['required'],
            'provinsi' => ['required'],
            'kabupaten' => ['required'],
            'kecamatan' => ['required'],
            'kelurahan' => ['required'],
            'no_telp' => ['required'],
            'kewarganegaraan' => ['required'],
            'married_status' => ['required'],
            'last_edu' => ['required'],
            'job' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', $id > 0 ? Rule::unique('users')->ignore($row->id) : Rule::unique('users')],
            'phone' => ['required', $id > 0 ? Rule::unique('users')->ignore($row->id) : Rule::unique('users'), new HandphoneRule($request)],
        ], $messages);

        $provinsi = Provinsi::select('name')->where('code', $request->input('provinsi'))->first();
        $kabupaten = Kabupaten::select('name')->where('code', $request->input('kabupaten'))->first();
        $kecamatan = Kecamatan::select('name')->where('code', $request->input('kecamatan'))->first();

        $data = [
            'first_name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'user_name' => $request->input('user_name'),
            'phone' => $request->input('phone'),
            'birthday' => $request->input('birthday') ? date("Y-m-d", strtotime($request->input('birthday'))) : null,
            'status' => $request->input('publish', 'publish'),
            'avatar_id' => $request->input('avatar_id'),
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'father_name' => $request->input('father_name'),
            'mother_name' => $request->input('mother_name'),
            'birthcity' => $request->input('birthcity'),
            'gender' => $request->input('gender'),
            'married_status' => $request->input('married_status'),
            'job' => $request->input('job'),
            'last_edu' => $request->input('last_edu'),
            'umrah_ever' => $request->input('umrah_ever'),
            'haji_ever' => $request->input('haji_ever'),
            'special_disease' => $request->input('special_disease'),
            'special_handling' => $request->input('special_handling'),
            'wheelchair_facilities' => $request->input('wheelchair_facilities'),
            'idcard_id' => $request->input('idcard_id'),
            'familycard_id' => $request->input('familycard_id'),
            'passport_id' => $request->input('passport_id'),
            'role_id' => $request->input('3', '3'),
            'password' => Hash::make($request->input('Alibinali123!', 'Alibinali123!')),

            'jenis_identitas' => $request->input('jenis_identitas'),
            'no_identitas' => $request->input('no_identitas'),

            'prov_code' => $request->input('provinsi'),
            'provinsi' => $provinsi->name,
            'kab_code' => $request->input('kabupaten'),
            'kabupaten' => $kabupaten->name,
            'kec_code' => $request->input('kecamatan'),
            'kecamatan' => $kecamatan->name,

            'kelurahan' => $request->input('kelurahan'),
            'no_telp' => $request->input('no_telp'),
            'kewarganegaraan' => $request->input('kewarganegaraan'),
            'nama_paspor' => $request->input('nama_paspor'),
            'no_paspor' => $request->input('no_paspor'),
            'kota_paspor' => $request->input('kota_paspor'),
            'tgl_release_paspor' => $request->input('tgl_release_paspor'),
            'tgl_expired_paspor' => $request->input('tgl_expired_paspor'),
            'provider' => $request->input('provider'),
            'asuransi' => $request->input('asuransi'),
        ];

        $row->fillByAttr(array_keys($data), $data);
        $rowSave = $row->save();

        if ($rowSave == true and $id == 0) {
            $this->prepareVa($row);
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

            return back()->with('success', ($id and $id > 0) ? __('Biodata jamaah berhasil diperbarui') : __("Biodata jamaah berhasil dibuat"));
        } else {
            return back()->with('success', ($id and $id > 0) ? __('Biodata jamaah berhasil diperbarui') : __("Biodata jamaah berhasil dibuat"));
        }
    }

    public function delete($id)
    {
        $data = User::find($id)->delete();
        if ($data) {
            $idMember = VendorTeam::where('member_id', $id)->first();
            $deleteMember = VendorTeam::find($idMember->id)->delete();
            $vendorReferral = VendorReferral::where('user_id', Auth::id())->first();
            $updVendorReferral = VendorReferral::find($vendorReferral->id);
            $updVendorReferral->update([
                'referral_count' => $updVendorReferral->referral_count - 1,
                'points' => $updVendorReferral->points - 1,
            ]);
            return back()->with('success', __("Data berhasil dihapus"));
        }
    }

    public function add(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::exists('users', 'email')
            ],
            'permissions' => 'required|array'
        ]);

        $email = $request->input('email');
        $member = User::whereEmail($email)->first();
        if (!$member) {
            return back()->with('danger', __("Member does not exists"));
        }

        $currentUser = auth()->user();

        if ($currentUser->email == $email) {
            return back()->with('danger', __("You can not add yourself"));
        }

        $check = $currentUser->members()->where('member_id', $member->id)->first();
        if ($check) {
            return back()->with('danger', __("Request exists"));
        }

        $check = new VendorTeam();
        $check->vendor_id = $currentUser->id;
        $check->member_id = $member->id;
        $check->status = setting_item('vendor_team_auto_approved') ? VendorTeam::STATUS_PUBLISH : VendorTeam::STATUS_PENDING;
        $check->permissions = $request->input('permissions', []);
        $check->save();

        VendorTeamRequestCreatedEvent::dispatch($check);

        return back()->with('success', __("Request created"));
    }

    public function reSendRequest(Request $request, $id)
    {
        $vendor_team = VendorTeam::find($id);
        if (!empty($vendor_team)) {
            VendorTeamRequestCreatedEvent::dispatch($vendor_team);
        }
        return back()->with(['success' => 'Sent success']);
    }

    public function accept(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }
        $vendor_team = \request()->input('vendor_team');
        if (!empty($vendor_team)) {
            $vendor_team = VendorTeam::find($vendor_team);
            if (!empty($vendor_team)) {
                $vendor_team->status = VendorTeam::STATUS_PUBLISH;
                $vendor_team->save();
            }
        }
        return redirect(route('home'));
    }

    public function genealogy(): View
    {
        $teams = VendorTeam::where('vendor_id', auth()->user()->id)->get();
        $data = [
            'teams' => $teams
        ];
        return view('Vendor::frontend.team.genealogy', $data);
    }

    public function prepareVa($user)
    {
        if ($user->phone) {
            if (!$user->va_number) {
                $customerNumber = $user->phone;
                if (strlen($user->phone) < 13) {
                    $customerNumber = str_pad($user->phone, 13, "0", STR_PAD_LEFT);
                }
                $partnerServiceId = env('BTN_API_PARTNER_SERVICE_ID');
                $trxId = date('YmdHi') . str_pad($user->id, 7, "0", STR_PAD_LEFT);
                $xTimeStamp = date('c');

                /** begin prepare akses token */
                $bodyRequestAT = [
                    'grantType' => "client_credentials",
                    'additionalInfo' => []
                ];
                $responseAT = $this->aksesToken([
                    'timestamp' => $xTimeStamp,
                    'signature' => $this->signatureAccessToken($xTimeStamp),
                    'body_request' => $bodyRequestAT
                ]);
                $responseAccToken = $responseAT->object();
                $accessToken = $responseAccToken->accessToken;
                /** end prepare akses token */
                /** prepare create VA */
                $bodyRequestCVA = [
                    "partnerServiceId" => $partnerServiceId,
                    "customerNo" => $customerNumber,
                    "virtualAccountNo" => $partnerServiceId . $customerNumber,
                    "virtualAccountName" => substr(strtoupper($user->name), 0, 40),
                    "trxId" => $trxId,
                    "totalAmount" => ["value" => "0.00", "currency" => "IDR"],
                    "virtualAccountTrxType" => "P",
                    "expiredDate" => "",
                    "additionalInfo" => [
                        "description" => "PEMBAYARAN JAMAAH BARU",
                        "payment" => "VA JAMAAH BARU",
                        "paymentCode" => substr(str_shuffle("0123456789"), 0, 5),
                        "currentAccountNo" => ""
                    ],
                ];
                //            dd($bodyRequestCVA);
                $minifyBody = json_encode($bodyRequestCVA);
                $shaBody = hash('sha256', $minifyBody);
                $stringToSign = 'POST' . ":" . "/snap/v1/transfer-va/create-va" . ":" . $accessToken . ":" . $shaBody . ":" . $xTimeStamp;
                $xClientSecret = env('BTN_API_SECRET_KEY');
                $signatureVa = hash_hmac(
                    'sha512',
                    $stringToSign,
                    $xClientSecret,
                    true
                );

                $va['token'] = $accessToken;
                $va['timestamp'] = $xTimeStamp;
                $va['signature'] = base64_encode($signatureVa);
                $va['external_id'] = strtoupper(Str::random(16));
                $va['channel_id'] = substr(str_shuffle("0123456789"), 0, 5);
                $va['body_request'] = $bodyRequestCVA;
                $response = $this->createVA($va);
                $hasil = json_decode($response, true);
                if (isset($hasil['responseCode'])) {
                    if ($hasil['responseCode'] == '2002700') {
                        $user->va_number = $partnerServiceId . $customerNumber;
                        $user->va_name = substr(strtoupper($user->name), 0, 40);
                        $user->customer_number = $customerNumber;
                        $user->va_status = '2002700';
                        $user->status_profile = 1;
                    } else {
                        return redirect()->back()->with('error', $hasil['responseMessage']);
                    }
                }
                $user->response_va = $response;
            }
            $user->save();
        }
    }
}
