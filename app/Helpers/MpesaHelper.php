<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class MpesaHelper
{
    public static function generateToken()
    {
        // Live uses CONSUMER KEY + CONSUMER SECRET
        $key = env('MPESA_CONSUMER_KEY');
        $secret = env('MPESA_CONSUMER_SECRET');

        $credentials = base64_encode($key . ':' . $secret);

        $url = env('MPESA_ENV') === 'live'
            ? 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials'
            : 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . $credentials
        ])->get($url);

        if (!isset($response->json()['access_token'])) {
            dd($response->json());
        }

        return $response->json()['access_token'];
    }
}
