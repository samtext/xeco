<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Table name (optional if following Laravel naming)
    protected $table = 'transaction';

    // Columns that are mass assignable
    protected $fillable = [
        'transaction_id',
        'phone',
        'amount',
        'status'
    ];
}
