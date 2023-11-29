<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use \App\Traits\ApiTrait;

class InquiryVa extends Command
{
    use ApiTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'btnva:inquiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Service Inquiry VA digunakan untuk melakukan penarikan informasi atau inquiry nomor virtual account
    yang sudah dibuat.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $customerNumber = '6281287888899';
        $trxId = 'TRX000000112685';
        // if (strlen($user->phone) < 13) {
        //     $customerNumber = '6281380001903';
        // }

        $partnerServiceId = env('BTN_API_PARTNER_SERVICE_ID');
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
        dd($response);
        // return Command::SUCCESS;
    }
}