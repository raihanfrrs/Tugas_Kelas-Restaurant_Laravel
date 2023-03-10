<?php

namespace Database\Seeders;

use App\Models\Cashier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CashierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cashiers = [
            [
                'user_id' => 3,
                'name' => 'Faiz Abiyyu Rizqullah Saputra',
                'slug' => 'faiz-abiyyu-rizqullah-saputra',
                'phone' => '0866666666',
                'email' => 'faizabiyyu76@gmail.com'
            ]
        ];

        foreach ($cashiers as $key => $value) {
            Cashier::create($value);
        }
    }
}
