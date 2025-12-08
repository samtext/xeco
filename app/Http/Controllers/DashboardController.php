<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaction;



class DashboardController extends Controller
{
    public function index()
    {
        // Get all transactions, newest first
        $transaction = Transaction::orderBy('created_at', 'desc')->get();

        // Pass transactions to view
        return view('dashboard', compact('transaction'));
    }
}
