<?php

namespace Database\Seeders;

use App\Models\Kitchen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KitchenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kitchens = [
            [
                'user_id' => 3,
                'name' => 'Widya Nurizma',
                'phone' => '087777777777',
                'email' => 'widyanurizma76@gmail.com'
            ]
        ];

        foreach ($kitchens as $key => $value) {
            Kitchen::create($value);
        }
    }
}
