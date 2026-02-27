<?php

namespace Database\Seeders;

use App\Models\Books;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Books::factory()->create([
            'title' => 'Book1',
            'author' => 'Author1',
            'publisher' => 'Publisher1',
        ]);
        Books::factory()->create([
            'title' => 'Book2',
            'author' => 'Author2',
            'publisher' => 'Publisher2',
        ]);
        Books::factory()->create([
            'title' => 'Book3',
            'author' => 'Author3',
            'publisher' => 'Publisher3',
        ]);
    }
}
