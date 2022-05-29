<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'name' => 'Nose Piercing',
            'duration' => 15,
            'price' => 20,
            'subcategory_id' => 1,
            'business_id' => 1
        ]);

        Service::create([
            'name' => 'Arm Tattoo',
            'duration' => 30,
            'price' => 35,
            'subcategory_id' => 2,
            'business_id' => 1
        ]);

        Service::create([
            'name' => 'Tint hair',
            'duration' => 120,
            'price' => 120,
            'subcategory_id' => 3,
            'business_id' => 1
        ]);
    }
}
