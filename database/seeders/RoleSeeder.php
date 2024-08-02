<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $administrator = Role::create([
            'name' => 'Administrator',
        ]);

        $merchant = Role::create([
            'name' => 'Merchant',
        ]);

        $customer = Role::create([
            'name' => 'Customer',
        ]);
    }
}
