<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Http;
use App\Helpers\MpesaHelper;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index']);
Route::get('/mpesa-token', function() {
    $token = MpesaHelper::generateToken();
    return $token;
});

Route::get('/register-c2b', function () {
    $token = \App\Helpers\MpesaHelper::generateToken();
    $shortCode = env('MPESA_SHORTCODE');

    $url = 'https://api.safaricom.co.ke/mpesa/c2b/v2/registerurl';

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $token,
        'Content-Type' => 'application/json'
    ])->post($url, [
        "ShortCode" => $shortCode,
        "ResponseType" => "Completed",
        "ConfirmationURL" => "https://060ae01ba956.ngrok-free.app/api/c2b/callback",
        "ValidationURL" => "https://060ae01ba956.ngrok-free.app/api/c2b/callback"
    ]);

    return $response->json();
});

Route::get('/test-live-token', function() {
    $token = MpesaHelper::generateToken(); // make sure it now uses live shortcode + passkey
    return $token;
});





