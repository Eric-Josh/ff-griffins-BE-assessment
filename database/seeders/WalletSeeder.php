<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Wallet::insert([
            [
                'wallet_tranx_id' => bin2hex(random_bytes(12)),
                'wallet_type_id' => 1,
                'balance' => 500.00,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'wallet_tranx_id' => bin2hex(random_bytes(12)),
                'wallet_type_id' => 4,
                'balance' => 150.00,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'wallet_tranx_id' => bin2hex(random_bytes(12)),
                'wallet_type_id' => 2,
                'balance' => 300.00,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'wallet_tranx_id' => bin2hex(random_bytes(12)),
                'wallet_type_id' => 3,
                'balance' => 100.00,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
