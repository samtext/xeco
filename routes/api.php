<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MpesaController;
use App\Models\Transaction; // ← ADD THIS

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/c2b/callback', [MpesaController::class, 'handleCallback']);

// Corrected transactions API
Route::get('/transaction', function() {
    return Transaction::orderBy('created_at', 'desc')->get();
});
