<?php

namespace App\Console\Commands;

use App\Models\BtnTransaction;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use \App\Traits\ApiTrait;
use Illuminate\Http\Request;

class GenerateReport extends Command
{

    use ApiTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'btnva:report {trxdate?*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Report Virtual Account BTN';


    // protected $transaction_date;
    // public function __construct(Request $request)
    // {
    //     parent::__construct();

    //     $this->transaction_date = $$request->transaction_date;
    // }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $trxDate = $this->argument('trxdate');
        $response = $this->mokeupReport();
        if (!$trxDate)
            $trxDate = date('Y-m-d', strtotime("-1 days"));

        /** report va btn */
        // $partnerServiceId = env('BTN_API_PARTNER_SERVICE_ID');
        // $xTimeStamp = date('c');
        // /** begin prepare akses token */
        // $bodyRequestAT = [
        //     'grantType' => "client_credentials",
        //     'additionalInfo' => []
        // ];
        // $responseAT = $this->aksesToken([
        //     'timestamp' => $xTimeStamp,
        //     'signature' => $this->signatureAccessToken($xTimeStamp),
        //     'body_request' => $bodyRequestAT
        // ]);
        // $responseAccToken = $responseAT->object();
        // $accessToken = $responseAccToken->accessToken;
        // /** end prepare akses token */
        // $jayParsedAry = [
        //     "partnerServiceId" => $partnerServiceId,
        //     "startDate" => $trxDate,
        //     "endDate" => ""
        // ];

        // $minifyBody = json_encode($jayParsedAry);
        // $shaBody = hash('sha256', $minifyBody);
        // $stringToSign = 'POST' . ":" . "/snap/v1/transfer-va/report" . ":" . $accessToken . ":" . $shaBody . ":" . $xTimeStamp;
        // $xClientSecret = env('BTN_API_SECRET_KEY');
        // $signatureVa = hash_hmac(
        //     'sha512',
        //     $stringToSign,
        //     $xClientSecret,
        //     true
        // );

        // $va['token'] = $accessToken;
        // $va['timestamp'] = $xTimeStamp;
        // $va['signature'] = base64_encode($signatureVa);
        // $va['external_id'] = strtoupper(Str::random(16));
        // $va['channel_id'] = substr(str_shuffle("0123456789"), 0, 5);
        // $va['body_request'] = $jayParsedAry;
        // $response = $this->reportVA($va);

        $hasil = json_decode($response, true);
        if (isset($hasil['virtualAccountData'])) {
            $hasilVA = $hasil['virtualAccountData'];
            $reportVa = [];
            foreach ($hasilVA as $key => $value) {
                $reportVa[] = [
                    'va_number' => $value['virtualAccountNo'],
                    'va_name' => $value['virtualAccountName'],
                    'teller' => $value['teller'],
                    'transaction_code' => $value['transactionCode'],
                    'sequence' => $value['sequence'],
                    'payment_date' => $value['paymentDate'],
                    'amount' => $value['amount'],
                    'reversal_flag' => $value['reversalFlag'],
                    'reversal_sequence' => $value['reversalSequence'],
                    'reversal_tme' => $value['reversalTime'],
                    'total_amount' => $value['totalAmount'],
                    'total_paid' => $value['totalPaid'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'transaction_date' => $trxDate,
                ];
            }
            if ($reportVa) {
                BtnTransaction::where('transaction_date', $trxDate)->delete();
                BtnTransaction::insert($reportVa);
            }
        }

        return Command::SUCCESS;
    }
}
