<?php

namespace Database\Seeders;

use App\Models\BusinessPicture;
use Illuminate\Database\Seeder;

class BusinessPicturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create pictures 
         */
        \App\Models\BusinessPicture::factory()->count(180)->create();
    }
}
