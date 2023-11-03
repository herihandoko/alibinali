<?php

namespace App\Http\Controllers;

use App\User;
use Modules\Hotel\Models\Hotel;
use Modules\Location\Models\LocationCategory;
use Modules\Page\Models\Page;
use Modules\News\Models\NewsCategory;
use Modules\News\Models\Tag;
use Modules\News\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Traits\ApiTrait;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    // use ApiTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $home_page_id = setting_item('home_page_id');
        if ($home_page_id && $page = Page::where("id", $home_page_id)->where("status", "publish")->first()) {
            $this->setActiveMenu($page);
            $translation = $page->translate();
            $seo_meta = $page->getSeoMetaWithTranslation(app()->getLocale(), $translation);
            $seo_meta['full_url'] = url("/");
            $seo_meta['is_homepage'] = true;
            $data = [
                'row' => $page,
                "seo_meta" => $seo_meta,
                'translation' => $translation,
                'is_home' => true,
            ];
            return view('Page::frontend.detail', $data);
        }
        $model_News = News::where("status", "publish");
        $data = [
            'rows' => $model_News->paginate(5),
            'model_category'    => NewsCategory::where("status", "publish"),
            'model_tag'         => Tag::query(),
            'model_news'        => News::where("status", "publish"),
            'breadcrumbs' => [
                ['name' => __('News'), 'url' => url("/news"), 'class' => 'active'],
            ],
            "seo_meta" => News::getSeoMetaForPageList()
        ];
        return view('News::frontend.index', $data);
    }

    public function checkConnectDatabase(Request $request)
    {
        $connection = $request->input('database_connection');
        config([
            'database' => [
                'default' => $connection . "_check",
                'connections' => [
                    $connection . "_check" => [
                        'driver' => $connection,
                        'host' => $request->input('database_hostname'),
                        'port' => $request->input('database_port'),
                        'database' => $request->input('database_name'),
                        'username' => $request->input('database_username'),
                        'password' => $request->input('database_password'),
                    ],
                ],
            ],
        ]);
        try {
            DB::connection()->getPdo();
            $check = DB::table('information_schema.tables')->where("table_schema", "performance_schema")->get();
            if (empty($check) and $check->count() == 0) {
                return $this->sendSuccess(false, __("Access denied for user!. Please check your configuration."));
            }
            if (DB::connection()->getDatabaseName()) {
                return $this->sendSuccess(false, __("Yes! Successfully connected to the DB: " . DB::connection()->getDatabaseName()));
            } else {
                return $this->sendSuccess(false, __("Could not find the database. Please check your configuration."));
            }
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

     public function apitest()
     {
    //     echo '<pre>';
    //     $apiKeyId = $partnerId = "940dcd7e-85bf-430a-9712-aefd2b7da4a4";
    //     $apiScretKey = $xClientSecret = "f7d83962-32dd-400e-afda-39a33396aaa1";
    //     $apiOAuth = $xClientKey = "87dae0ae-87f7-43f0-aa41-f2c482c89c3c";
    //     $partnerServiceId = "96000";
    //     $xTimeStamp = date('c');
    //     $bodyRequest = [
    //         'grantType' => "client_credentials",
    //         'additionalInfo' => []
    //     ];
    //     $response = $this->aksesToken([
    //         'client_key' => $xClientKey,
    //         'timestamp' => $xTimeStamp,
    //         'signature' => $this->signatureAccessToken($xTimeStamp),
    //         'body_request' => $bodyRequest
    //     ]);
    //     $response = $response->object();
    //     $accessToken = $response->accessToken;
    //     // dd($accessToken);
    //     /** create virtual account */
    //     $bodyRequest  = [
    //         "partnerServiceId" => $partnerServiceId,
    //         "customerNo" => "6281380001904",
    //         // "partnerReferenceNo" => "",
    //         "virtualAccountNo" => $partnerServiceId . "6281380001904",
    //         "virtualAccountName" => "payumroh",
    //         "trxId" => "2023103200100000045",
    //         "totalAmount" => ["value" => "0.00", "currency" => "IDR"],
    //         // "amount" => ["value" => "10000.00", "currency" => "IDR"],
    //         "virtualAccountTrxType" => "P",
    //         "expiredDate" => "",
    //         "additionalInfo" => [
    //             "description" => "12345679237",
    //             "payment" => "PEMBAYARAN COBA",
    //             "paymentCode" => "330089",
    //             "currentAccountNo" => ""
    //         ],
    //     ];

    //     // $bodyRequest = [
    //     //     "partnerServiceId" => $partnerServiceId,
    //     //     "customerNo" => "62813800019031",
    //     //     "virtualAccountNo" => $partnerServiceId . "62813800019031",
    //     //     "trxId" => "BTN0000000004",
    //     // ];

    //     $minifyBody = json_encode($bodyRequest);
    //     $shaBody = hash('sha256', $minifyBody);
    //     $stringToSign = 'POST' . ":" . "/snap/v1/transfer-va/create-va" . ":" . $accessToken . ":" . $shaBody . ":" . $xTimeStamp;
    //     // $stringToSign = 'POST' . ":" . "/snap/v1/transfer-va/inquiry-va" . ":" . $accessToken . ":" . $shaBody . ":" . $xTimeStamp;
    //     $signatureVa = hash_hmac(
    //         'sha512',
    //         $stringToSign,
    //         $xClientSecret,
    //         true
    //     );

    //     /** without token */
    //     $va['token'] = $accessToken;
    //     $va['timestamp'] = $xTimeStamp;
    //     $va['signature'] = base64_encode($signatureVa);
    //     $va['partner_id'] = $apiKeyId;
    //     $va['external_id'] = strtoupper(Str::random(16));
    //     $va['channel_id'] = '10023';
    //     $va['body_request'] = $bodyRequest;
    //     $response = $this->createVA($va);
    //     echo 'BODY : <textarea style="width: 700px; height: 50px;">' . $minifyBody . '</textarea>';
    //     echo '<br>';
    //     print_r($bodyRequest);
    //     echo '<br>';
    //     echo 'BEARER-TOKEN :  <textarea style="width: 700px; height: 50px;">' . $accessToken . '</textarea>';
    //     echo '<br>';
    //     echo 'X-CLIENT-KEY :  <textarea style="width: 700px; height: 50px;">' . $xClientKey . '</textarea>';
    //     echo '<br>';
    //     echo 'X-TIMESTAMP :  <textarea style="width: 700px; height: 50px;">' . $xTimeStamp . '</textarea>';
    //     echo '<br>';
    //     echo 'X-SIGNATURE :  <textarea style="width: 700px; height: 50px;">' . base64_encode($signatureVa) . '</textarea>';
    //     echo '<br>';
    //     echo 'X-PARTNER-ID :  <textarea style="width: 700px; height: 50px;">' . $apiKeyId . '</textarea>';
    //     echo '<br>';
    //     echo 'X-EXTERNAL-ID :  <textarea style="width: 700px; height: 50px;">' . $va['external_id'] . '</textarea>';
    //     echo '<br>';
    //     echo 'CHANNEL-ID :  <textarea style="width: 700px; height: 50px;">' . $va['channel_id'] . '</textarea>';
    //     echo '<br> RESPONSE <br>';
    //     // $response = $response->getBody()->getContents();
    //     // $response = json_decode($response);
    //     print_r($response);
    //     echo '<br>';
//         die();
    //     // return view('home');
     }
}
