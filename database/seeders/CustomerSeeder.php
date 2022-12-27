<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [
            [
                'name' => 'bayu',
                'slug' => 'bayu'
            ],
            [
                'name' => 'santi',
                'slug' => 'santi'
            ],
            [
                'name' => 'fani',
                'slug' => 'fani'
            ]
        ];

        foreach ($customers as $key => $value) {
            Customer::create($value);
        }
    }
}
