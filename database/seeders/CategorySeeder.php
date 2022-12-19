<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'category' => 'Ayam',
                'slug' => 'ayam',
                'status' => 'show'
            ],
            [
                'category' => 'Bebek',
                'slug' => 'bebek',
                'status' => 'show'
            ],
            [
                'category' => 'Nasi Goreng',
                'slug' => 'nasi-goreng',
                'status' => 'show'
            ]
        ];

        foreach ($categories as $key => $value) {
            Category::create($value);
        }
    }
}
