<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WalletTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\WalletType::insert([
            [
                'name' => 'Zelle',
                'minimum_balance' => 0.00,
                'monthly_interest_rate' => 3.10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Garmin',
                'minimum_balance' => 0.00,
                'monthly_interest_rate' => 4.50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Freecharge',
                'minimum_balance' => 0.00,
                'monthly_interest_rate' => 2.99,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Google',
                'minimum_balance' => 0.00,
                'monthly_interest_rate' => 3.95,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
