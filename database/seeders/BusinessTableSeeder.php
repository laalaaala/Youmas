<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Business::create([
            'name' => 'Business X',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita omnis, architecto reprehenderit corrupti eaque natus ut impedit cum nulla, quos libero quasi cumque adipisci in sunt corporis. Modi, quam alias.',
            'branch_id' => 1,
            'person_to_contact' => 'Bart',
            'ust_id' => 12345,
            'user_id' => 2
        ]);

        Business::create([
            'name' => 'Business Z',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita omnis, architecto reprehenderit corrupti eaque natus ut impedit cum nulla, quos libero quasi cumque adipisci in sunt corporis. Modi, quam alias.',
            'branch_id' => 3,
            'person_to_contact' => 'Lisa',
            'ust_id' => 12345,
            'user_id' => 3,
        ]);
    }
}
