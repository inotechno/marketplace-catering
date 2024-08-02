<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryProduct::insert([
            [
                'name' => 'Food',
                'slug' => Str::slug('Food', '-'),
                'description' => 'Various food items',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Drinks',
                'slug' => Str::slug('Drinks', '-'),
                'description' => 'Various drinks',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Snacks',
                'slug' => Str::slug('Snacks', '-'),
                'description' => 'Various snacks',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
