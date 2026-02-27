<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::insert([
            [
                'name' => 'Spring Jacket',
                'stock' => 10,
                'category' => 'Spring',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Summer Hat',
                'stock' => 3,
                'category' => 'Summer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Autumn Sweater',
                'stock' => 7,
                'category' => 'Autumn',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Winter Coat',
                'stock' => 0,
                'category' => 'Winter',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'All Season Backpack',
                'stock' => 15,
                'category' => 'Spring',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
