<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'user_id' => 1,
                'name' => 'Mohamad Raihan Farras',
                'slug' => 'mohamad-raihan-farras',
                'phone' => '081333903187',
                'email' => 'rehanfarras76@gmail.com'
            ],
            [
                'user_id' => 2,
                'name' => 'Wahyu Widyanto',
                'slug' => 'wahyu-widyanto',
                'phone' => '08234432234',
                'email' => 'wahyuwidyanto76@gmail.com'
            ]
        ];

        foreach ($admins as $key => $value) {
            Admin::create($value);
        }
    }
}
