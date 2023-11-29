<?php

namespace Modules\User\Controllers;

use App\Models\BtnTransaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Matrix\Exception;
use Modules\Boat\Models\Boat;
use Modules\Booking\Models\Service;
use Modules\Car\Models\Car;
use Modules\Event\Models\Event;
use Modules\Flight\Models\Flight;
use Modules\FrontendController;
use Modules\Hotel\Models\Hotel;
use Modules\Space\Models\Space;
use Modules\Tour\Models\Tour;
use Modules\User\Events\NewVendorRegistered;
use Modules\User\Events\UserSubscriberSubmit;
use Modules\User\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Vendor\Models\VendorRequest;
use Validator;
use Modules\Booking\Models\Booking;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Modules\Booking\Models\Enquiry;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Modules\User\Models\VendorReferral;
use \App\Traits\ApiTrait;
use App\Rules\VirtualAccountRule;
use App\Rules\HandphoneRule;

class UserController extends FrontendController {

    use AuthenticatesUsers;
    use ApiTrait;

    protected $enquiryClass;

    public function __construct() {
        $this->enquiryClass = Enquiry::class;
        parent::__construct();
        $this->tourClass = Tour::class;
    }

    public function dashboard(Request $request) {
        $this->checkPermission('dashboard_vendor_access');
        $user_id = Auth::id();
        $data = [
            'cards_report' => Booking::getTopCardsReportForVendor($user_id),
            'earning_chart_data' => Booking::getEarningChartDataForVendor(strtotime('monday this week'), time(), $user_id),
            'page_title' => __("Agent Dashboard"),
            'breadcrumbs' => [
                [
                    'name' => __('Dashboard'),
                    'class' => 'active'
                ]
            ]
        ];
        return view('User::frontend.dashboard', $data);
    }

    public function reloadChart(Request $request) {
        $chart = $request->input('chart');
        $user_id = Auth::id();
        switch ($chart) {
            case "earning":
                $from = $request->input('from');
                $to = $request->input('to');
                return $this->sendSuccess([
                            'data' => Booking::getEarningChartDataForVendor(strtotime($from), strtotime($to), $user_id)
                ]);
                break;
        }
    }

    public function profile(Request $request) {
        $user = Auth::user();
        $data = [
            'dataUser' => $user,
            'page_title' => __("Profil"),
            'breadcrumbs' => [
                [
                    'name' => __('Profil'),
                    'class' => 'active'
                ]
            ],
            'is_vendor_access' => $this->hasPermission('dashboard_vendor_access')
        ];
        return view('User::frontend.profile', $data);
    }

    public function profileUpdate(Request $request) {
        if (is_demo_mode()) {
            return back()->with('error', "Demo mode: disabled");
        }
        $user = Auth::user();
        $messages = [
            'gender.required' => __('Jenis Kelamin belum dipilih.'),
            'wheelchair_facilities.required' => __('Kebutuhan Fasilitas Kursi Roda belum dipilih.'),
        ];
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'gender' => [
                'required'
            ],
            'wheelchair_facilities' => [
                'required'
            ],
            //            'user_name'=> [
            //                'required',
            //                'max:255',
            //                'min:4',
            //                'string',
            //                'alpha_dash',
            //                Rule::unique('users')->ignore($user->id)
            //            ],
            'phone' => ['required', 'min:9', 'max:13', Rule::unique('users')->ignore($user->id), new HandphoneRule($request)],
            'va_number' => ['min:18', 'max:18', 'sometimes', 'nullable', 'string', new VirtualAccountRule($request)]
                ], $messages);
        $input = $request->except('address');
        $user->fill($input);
        $user->address = clean($request->input('address'));
        $user->birthday = date("Y-m-d", strtotime($user->birthday));
//        $user->user_name = Str::slug($request->input('user_name'), "_");
//        $user->status_profile = 1;
//        if ($user->save()) {
//            if (!$user->va_number) {
        $this->prepareVa($user);
//            }
//        }
        return redirect()->back()->with('success', __('Ubah data berhasil'));
    }

    public function bookingHistory(Request $request) {
        $user_id = Auth::id();
        $data = [
            'bookings' => Booking::getBookingHistory($request->input('status'), $user_id),
            'statues' => config('booking.statuses'),
            'breadcrumbs' => [
                [
                    'name' => __('Booking History'),
                    'class' => 'active'
                ]
            ],
            'page_title' => __("Booking History"),
        ];
        return view('User::frontend.bookingHistory', $data);
    }

    public function subscribe(Request $request) {
        $this->validate($request, [
            'email' => 'required|email|max:255'
        ]);
        $check = Subscriber::withTrashed()->where('email', $request->input('email'))->first();
        if ($check) {
            if ($check->trashed()) {
                $check->restore();
                return $this->sendSuccess([], __('Thank you for subscribing'));
            }
            return $this->sendError(__('You are already subscribed'));
        } else {
            $a = new Subscriber();
            $a->email = $request->input('email');
            $a->first_name = $request->input('first_name');
            $a->last_name = $request->input('last_name');
            $a->save();

            event(new UserSubscriberSubmit($a));

            return $this->sendSuccess([], __('Thank you for subscribing'));
        }
    }

    public function upgradeVendor(Request $request) {
        $user = Auth::user();
        $vendorRequest = VendorRequest::query()->where("user_id", $user->id)->where("status", "pending")->first();
        if (!empty($vendorRequest)) {
            return redirect()->back()->with('warning', __("Anda sudah mengajukan permintaan menjadi Agent, silakan tunggu sampai disetujui oleh Admin."));
        }

        // check vendor auto approved
        $vendorAutoApproved = setting_item('vendor_auto_approved');
        $dataVendor['role_request'] = setting_item('vendor_role');
        if ($vendorAutoApproved) {
            if ($dataVendor['role_request']) {
                $user->assignRole($dataVendor['role_request']);
            }
            $dataVendor['status'] = 'approved';
            $dataVendor['approved_time'] = now();
        } else {
            $dataVendor['status'] = 'pending';
        }

        $vendorRequestData = $user->vendorRequest()->save(new VendorRequest($dataVendor));

        try {
            event(new NewVendorRegistered($user, $vendorRequestData));
        } catch (Exception $exception) {
            Log::warning("NewVendorRegistered: " . $exception->getMessage());
        }

        return redirect()->back()->with('success', __('Permintaan menjadi Agent sukses diajukan!'));
    }

    public function permanentlyDelete(Request $request) {
        if (is_demo_mode()) {
            return back()->with('error', "Demo mode: disabled");
        }
        if (!empty(setting_item('user_enable_permanently_delete'))) {
            $user = Auth::user();
            \DB::beginTransaction();
            try {
                Service::where('author_id', $user->id)->delete();
                Tour::where('author_id', $user->id)->delete();
                Car::where('author_id', $user->id)->delete();
                Space::where('author_id', $user->id)->delete();
                Hotel::where('author_id', $user->id)->delete();
                Event::where('author_id', $user->id)->delete();
                Boat::where('author_id', $user->id)->delete();
                Flight::where('author_id', $user->id)->delete();
                $user->sendEmailPermanentlyDelete();
                $user->delete();
                \DB::commit();
                Auth::logout();
                if (is_api()) {
                    return $this->sendSuccess([], 'Deleted');
                }
                return redirect(route('home'));
            } catch (\Exception $exception) {
                \DB::rollBack();
            }
        }
        if (is_api()) {
            return $this->sendError('Error. You can\'t permanently delete');
        }
        return back()->with('error', __('Error. You can\'t permanently delete'));
    }

    public function virtualAccount(Request $request): View {
        Artisan::call('btnva:report', [
            'trxdate' => date('Y-m-d')
        ]);
        $user = Auth::user();
        $balance = BtnTransaction::select('amount')->where('va_number', $user->va_number)->sum('amount');
        $history = BtnTransaction::where('va_number', $user->va_number)->orderBy('payment_date', 'desc')->get();
        $data = [
            'dataUser' => $user,
            'history' => $history,
            'balance' => $balance,
            'page_title' => __("Virtual Account"),
            'breadcrumbs' => [
                [
                    'name' => __('Virtual Account'),
                    'class' => 'active'
                ]
            ],
            'page_title' => __("Virtual Account"),
        ];
        return view('User::frontend.virtualAccount', $data);
    }

    public function prepareVa($user) {
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

    public function prepareInquiry($user) {
        $customerNumber = '6281380001903';
        if (strlen($user->phone) < 13) {
            $customerNumber = '6281380001903';
        }
        $partnerServiceId = env('BTN_API_PARTNER_SERVICE_ID');
        $trxId = '2023103200100000044';
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
        /** prepare inquiry VA */
        $jayParsedAry = [
            "partnerServiceId" => $partnerServiceId,
            "customerNo" => $customerNumber,
            "virtualAccountNo" => $partnerServiceId . $customerNumber,
            "trxId" => $trxId
        ];

        $minifyBody = json_encode($jayParsedAry);
        $shaBody = hash('sha256', $minifyBody);
        $stringToSign = 'POST' . ":" . "/snap/v1/transfer-va/inquiry-va" . ":" . $accessToken . ":" . $shaBody . ":" . $xTimeStamp;
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
        $va['body_request'] = $jayParsedAry;
        $response = $this->inquiryVA($va);
        $user->response_va = $response;
    }

    public function prepareDelete($user) {
        $customerNumber = '6281380001904';
        if (strlen($user->phone) < 13) {
            $customerNumber = '6281380001904';
        }
        $partnerServiceId = env('BTN_API_PARTNER_SERVICE_ID');
        $trxId = '2023103200100000045';
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
        /** prepare delete VA */
        $jayParsedAry = [
            "partnerServiceId" => $partnerServiceId,
            "customerNo" => $customerNumber,
            "virtualAccountNo" => $partnerServiceId . $customerNumber,
            "trxId" => $trxId
        ];

        $minifyBody = json_encode($jayParsedAry);
        $shaBody = hash('sha256', $minifyBody);
        $stringToSign = 'POST' . ":" . "/snap/v1/transfer-va/delete-va" . ":" . $accessToken . ":" . $shaBody . ":" . $xTimeStamp;
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
        $va['body_request'] = $jayParsedAry;
        $response = $this->deleteVA($va);
        $user->response_va = $response;
    }

    public function prepareReport($user) {
        $customerNumber = '6281380001904';
        if (strlen($user->phone) < 13) {
            $customerNumber = '6281380001904';
        }
        $partnerServiceId = env('BTN_API_PARTNER_SERVICE_ID');
        $trxId = '2023103200100000045';
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
        /** prepare delete VA */
        $jayParsedAry = [
            "partnerServiceId" => $partnerServiceId,
            "startDate" => "2023-10-01",
            "endDate" => ""
        ];

        $minifyBody = json_encode($jayParsedAry);
        $shaBody = hash('sha256', $minifyBody);
        $stringToSign = 'POST' . ":" . "/snap/v1/transfer-va/report" . ":" . $accessToken . ":" . $shaBody . ":" . $xTimeStamp;
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
        $va['body_request'] = $jayParsedAry;
        $response = $this->reportVA($va);
        $user->response_va = $response;
    }

    public function listPackage(Request $request): View {
        $user = Auth::user();
        $q = $this->tourClass::query();

        if ($request->query('s')) {
            $q->where('title', 'like', '%' . $request->query('s') . '%');
        }

//        if ($cat_id = $request->query('cat_id')) {
//            $cat = TourCategory::find($cat_id);
//            if(!empty($cat)) {
//                $q->join('bravo_tour_category', function ($join) use ($cat) {
//                    $join->on('bravo_tour_category.id', '=', 'bravo_tours.category_id')
//                        ->where('bravo_tour_category._lft','>=',$cat->_lft)
//                        ->where('bravo_tour_category._rgt','>=',$cat->_lft);
//                });
//            }
//        }

        if (!$this->hasPermission('tour_manage_others')) {
            $q->where('author_id', $this->currentUser()->id);
        }

        $q->orderBy('bravo_tours.id', 'desc');

        $rows = $q->paginate(10);

        $data = [
            'dataUser' => $user,
            'page_title' => __("Virtual Account"),
            'breadcrumbs' => [
                [
                    'name' => __('Virtual Account'),
                    'class' => 'active'
                ]
            ],
            'page_title' => __("Virtual Account"),
            'list_paket' => $rows
        ];
        return view('User::frontend.listPackage', $data);
    }
}
