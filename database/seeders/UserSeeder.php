<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'raihan123',
                'password' => bcrypt('test123'),
                'level' => 'administrator',
                'status' => 'active'
            ],
            [
                'username' => 'faiz123',
                'password' => bcrypt('test123'),
                'level' => 'cashier',
                'status' => 'active'
            ],
            [
                'username' => 'rizma123',
                'password' => bcrypt('test123'),
                'level' => 'kitchen',
                'status' => 'active'
            ]
        ];

        foreach ($users as $key => $value) {
            User::create($value);
        }
    }
}
