<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_tranx_id',
        'wallet_type_id',
        'balance',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function type()
    {
        return $this->belongsTo(\App\Models\WalletType::class, 'wallet_type_id');
    }
}
