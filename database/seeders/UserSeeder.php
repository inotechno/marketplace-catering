<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrator = User::create([
            'name' => 'Administrator',
            'username' => 'administrator',
            'email' => 'administrator@test.com',
            'password' => bcrypt('password'),
        ]);

        $administrator->assignRole('Administrator');

        $merchant = User::create([
            'name' => 'Merchant',
            'username' => 'merchant',
            'email' => 'merchant@test.com',
            'password' => bcrypt('password'),
        ]);

        $merchant->assignRole('Merchant');

        $customer = User::create([
            'name' => 'Customer',
            'username' => 'customer',
            'email' => 'customer@test.com',
            'password' => bcrypt('password'),
        ]);

        $customer->assignRole('Customer');
    }
}
