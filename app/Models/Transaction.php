<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'tranx_ref',
        'user_id',
        'from_wallet_id',
        'to_wallet_id',
        'amount',
        'tranx_fee',
        'commission',
        'type',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function fromWallet()
    {
        return $this->belongsTo(\App\Models\Wallet::class, 'from_wallet_id');
    }

    public function toWallet()
    {
        return $this->belongsTo(\App\Models\Wallet::class, 'to_wallet_id');
    }
}
