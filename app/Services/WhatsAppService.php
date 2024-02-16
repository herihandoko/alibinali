<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class WhatsAppService
{
    public static function sendMessage(array $params)
    {
        $client = new Client();
        $baseUrl = config('services.whatsapp.base_url');
        $token = config('services.whatsapp.token');
        try {
            $response = $client->post($baseUrl . '/send', [
                RequestOptions::JSON => $params,
                'headers' => [
                    'Authorization' => $token,
                ],
            ]);
            return [
                'status' => true,
                'message' => 'success send notification.',
                'response' => json_decode($response->getBody(), true)
            ];
        } catch (\Exception $e) {
            return [
                'status' => false,
                'message' => 'failed send notification.',
                'response' => $e->getMessage()
            ];
        }
    }
}
