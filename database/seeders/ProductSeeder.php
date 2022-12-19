<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'category_id' => 1,
                'product_name' => 'Ayam Sambel Kecap',
                'slug' => 'ayam-sambel-kecap',
                'price' => '15000',
                'description' => 'Nullam ultrices dolor sapien, a mollis neque viverra nec. Nam porta, orci in vehicula dignissim, turpis dui feugiat leo, id convallis nisl lacus sit amet est. Ut tempor feugiat laoreet. Quisque suscipit lorem vitae diam vestibulum tincidunt. Proin at malesuada lectus. Nam lacus leo, sodales vel cursus eu, condimentum et eros. Nam molestie nisl vitae arcu pharetra malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc sodales malesuada malesuada. Nam non vehicula ex, nec pharetra orci. Donec nunc orci, mollis bibendum interdum at, placerat sed sem. In commodo sapien eros, at egestas enim vestibulum quis. Sed vitae gravida arcu, vitae semper tortor. Donec tortor est, volutpat non sem vitae, aliquam dignissim sapien. Proin vel diam fermentum, tristique nisi non, euismod dui. Pellentesque interdum vehicula odio, eu semper neque luctus iaculis.',
                'status' => 'show'
            ],
            [
                'category_id' => 1,
                'product_name' => 'Ayam Panggang',
                'slug' => 'ayam-panggang',
                'price' => '12000',
                'description' => 'Nullam ultrices dolor sapien, a mollis neque viverra nec. Nam porta, orci in vehicula dignissim, turpis dui feugiat leo, id convallis nisl lacus sit amet est. Ut tempor feugiat laoreet. Quisque suscipit lorem vitae diam vestibulum tincidunt. Proin at malesuada lectus. Nam lacus leo, sodales vel cursus eu, condimentum et eros. Nam molestie nisl vitae arcu pharetra malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc sodales malesuada malesuada. Nam non vehicula ex, nec pharetra orci. Donec nunc orci, mollis bibendum interdum at, placerat sed sem. In commodo sapien eros, at egestas enim vestibulum quis. Sed vitae gravida arcu, vitae semper tortor. Donec tortor est, volutpat non sem vitae, aliquam dignissim sapien. Proin vel diam fermentum, tristique nisi non, euismod dui. Pellentesque interdum vehicula odio, eu semper neque luctus iaculis.',
                'status' => 'show'
            ],
            [
                'category_id' => 2,
                'product_name' => 'Bebek Asam Manis',
                'slug' => 'bebek-asam-manis',
                'price' => '18000',
                'description' => 'Nullam ultrices dolor sapien, a mollis neque viverra nec. Nam porta, orci in vehicula dignissim, turpis dui feugiat leo, id convallis nisl lacus sit amet est. Ut tempor feugiat laoreet. Quisque suscipit lorem vitae diam vestibulum tincidunt. Proin at malesuada lectus. Nam lacus leo, sodales vel cursus eu, condimentum et eros. Nam molestie nisl vitae arcu pharetra malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc sodales malesuada malesuada. Nam non vehicula ex, nec pharetra orci. Donec nunc orci, mollis bibendum interdum at, placerat sed sem. In commodo sapien eros, at egestas enim vestibulum quis. Sed vitae gravida arcu, vitae semper tortor. Donec tortor est, volutpat non sem vitae, aliquam dignissim sapien. Proin vel diam fermentum, tristique nisi non, euismod dui. Pellentesque interdum vehicula odio, eu semper neque luctus iaculis.',
                'status' => 'show'
            ],
            [
                'category_id' => 3,
                'product_name' => 'Nasi Goreng Jawa',
                'slug' => 'nasi-goreng-jawa',
                'price' => '20000',
                'description' => 'Nullam ultrices dolor sapien, a mollis neque viverra nec. Nam porta, orci in vehicula dignissim, turpis dui feugiat leo, id convallis nisl lacus sit amet est. Ut tempor feugiat laoreet. Quisque suscipit lorem vitae diam vestibulum tincidunt. Proin at malesuada lectus. Nam lacus leo, sodales vel cursus eu, condimentum et eros. Nam molestie nisl vitae arcu pharetra malesuada. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nunc sodales malesuada malesuada. Nam non vehicula ex, nec pharetra orci. Donec nunc orci, mollis bibendum interdum at, placerat sed sem. In commodo sapien eros, at egestas enim vestibulum quis. Sed vitae gravida arcu, vitae semper tortor. Donec tortor est, volutpat non sem vitae, aliquam dignissim sapien. Proin vel diam fermentum, tristique nisi non, euismod dui. Pellentesque interdum vehicula odio, eu semper neque luctus iaculis.',
                'status' => 'show'
            ],
        ];

        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
}
