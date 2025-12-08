<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class MpesaController extends Controller
{
    public function handleCallback(Request $request)
    {
        $data = $request->all();

        // Save transaction to database using correct keys
        Transaction::create([
            'transaction_id' => $data['TransID'] ?? 'N/A',
            'phone' => $data['MSISDN'] ?? 'N/A',
            'amount' => $data['TransAmount'] ?? 0,
            'status' => 'Completed'
        ]);

        // Respond to Safaricom
        return response()->json([
            'ResultCode' => 0,
            'ResultDesc' => 'Accepted'
        ]);
    }
}
