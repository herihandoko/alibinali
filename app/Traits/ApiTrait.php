<?php

namespace App\Traits;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\JsonResponse;

trait ApiTrait
{
    public function aksesToken($param): Response
    {
        $response = Http::withHeaders([
            'X-CLIENT-KEY' => env('BTN_API_CLIENT_KEY'),
            'X-TIMESTAMP' => $param['timestamp'],
            'X-SIGNATURE' => $param['signature'],
            'Origin' => env('APP_NAME')
        ])->bodyFormat('raw')->withBody(
            json_encode($param['body_request']),
            "application/json;charset=utf-8"
        )->send('post', env('BTN_URL') . 'access-token/b2b');
        return $response;
    }

    public function createVA($param)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  env('BTN_URL') . 'transfer-va/create-va',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($param['body_request']),
            CURLOPT_HTTPHEADER => array(
                'X-CLIENT-KEY: ' . env('BTN_API_CLIENT_KEY'),
                'X-TIMESTAMP: ' . $param['timestamp'],
                'X-SIGNATURE: ' . $param['signature'],
                'Origin: ' . env('APP_NAME'),
                'X-PARTNER-ID: ' . env('BTN_API_KEY_ID'),
                'X-EXTERNAL-ID: ' . $param['external_id'],
                'CHANNEL-ID: ' . $param['channel_id'],
                'Content-Type: application/json',
                'Authorization: Bearer ' . $param['token'],
                'Cookie: incap_ses_1113_2938089=jSKIAqdn7hRIvOMopixyDwDtI2UAAAAA0qn9HMBPO290HfzzjOZYfg==; visid_incap_2938089=0BD+q+k2T1mw+D0ZgAL6bO7LwmQAAAAAQUIPAAAAAAAiiuU7R66W/WY1eDgRX5D6'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return (string) $response;
    }

    public function inquiryVA($param)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  env('BTN_URL') . 'transfer-va/inquiry-va',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($param['body_request']),
            CURLOPT_HTTPHEADER => array(
                'X-CLIENT-KEY: ' . env('BTN_API_CLIENT_KEY'),
                'X-TIMESTAMP: ' . $param['timestamp'],
                'X-SIGNATURE: ' . $param['signature'],
                'Origin: ' . env('APP_NAME'),
                'X-PARTNER-ID: ' . env('BTN_API_KEY_ID'),
                'X-EXTERNAL-ID: ' . $param['external_id'],
                'CHANNEL-ID: ' . $param['channel_id'],
                'Content-Type: application/json',
                'Authorization: Bearer ' . $param['token'],
                'Cookie: incap_ses_1113_2938089=jSKIAqdn7hRIvOMopixyDwDtI2UAAAAA0qn9HMBPO290HfzzjOZYfg==; visid_incap_2938089=0BD+q+k2T1mw+D0ZgAL6bO7LwmQAAAAAQUIPAAAAAAAiiuU7R66W/WY1eDgRX5D6'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return (string) $response;
    }

    public function deleteVA($param)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  env('BTN_URL') . 'transfer-va/delete-va',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($param['body_request']),
            CURLOPT_HTTPHEADER => array(
                'X-CLIENT-KEY: ' . env('BTN_API_CLIENT_KEY'),
                'X-TIMESTAMP: ' . $param['timestamp'],
                'X-SIGNATURE: ' . $param['signature'],
                'Origin: ' . env('APP_NAME'),
                'X-PARTNER-ID: ' . env('BTN_API_KEY_ID'),
                'X-EXTERNAL-ID: ' . $param['external_id'],
                'CHANNEL-ID: ' . $param['channel_id'],
                'Content-Type: application/json',
                'Authorization: Bearer ' . $param['token'],
                'Cookie: incap_ses_1113_2938089=jSKIAqdn7hRIvOMopixyDwDtI2UAAAAA0qn9HMBPO290HfzzjOZYfg==; visid_incap_2938089=0BD+q+k2T1mw+D0ZgAL6bO7LwmQAAAAAQUIPAAAAAAAiiuU7R66W/WY1eDgRX5D6'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return (string) $response;
    }

    public function reportVA($param)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL =>  env('BTN_URL') . 'transfer-va/report',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($param['body_request']),
            CURLOPT_HTTPHEADER => array(
                'X-CLIENT-KEY: ' . env('BTN_API_CLIENT_KEY'),
                'X-TIMESTAMP: ' . $param['timestamp'],
                'X-SIGNATURE: ' . $param['signature'],
                'Origin: ' . env('APP_NAME'),
                'X-PARTNER-ID: ' . env('BTN_API_KEY_ID'),
                'X-EXTERNAL-ID: ' . $param['external_id'],
                'CHANNEL-ID: ' . $param['channel_id'],
                'Content-Type: application/json',
                'Authorization: Bearer ' . $param['token'],
                'Cookie: incap_ses_1113_2938089=jSKIAqdn7hRIvOMopixyDwDtI2UAAAAA0qn9HMBPO290HfzzjOZYfg==; visid_incap_2938089=0BD+q+k2T1mw+D0ZgAL6bO7LwmQAAAAAQUIPAAAAAAAiiuU7R66W/WY1eDgRX5D6'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return (string) $response;
    }

    public function signatureAccessToken($xTimeStamp)
    {
        $xClientKey = env('BTN_API_CLIENT_KEY');
        $private_key = file_get_contents(env('APP_PRIVATE_KEY'));
        $stringToSign = $xClientKey . '|' . $xTimeStamp;
        $algo = OPENSSL_ALGO_SHA256;
        openssl_sign($stringToSign, $signature, $private_key, $algo);
        $signature = base64_encode($signature);
        return $signature;
    }

    public function mokeupReport()
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://0dbfbbd0784e4fb09e2ccc824b035b76.api.mockbin.io',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: __cf_bm=H.yR0R42ICEZye1nuNNTmInEXLhDaajv2x3DeBY1DeY-1701271385-0-ATsXgq5c+bUv8KJcWSk+CGuygnpmC+B0CIRXcUb7El6hpboB1vRfw6pUpJ7+ctTZ2D1uUrtTx4PI7jnBF7+XRaU='
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return (string) $response;
    }
}