<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::insert([
            [
                'name' => 'Credit Card',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cash',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Online Transfer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'E-Wallet',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
