<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create([
            'name' => 'Hair Saloon',
            'slug' => 'hair-saloon'
        ]);

        Branch::create([
            'name' => 'Tattoo/Piercing Studio',
            'slug' => 'tattoo-studio'
        ]);

        Branch::create([
            'name' => 'Beauty Saloon',
            'slug' => 'beauty-saloon'
        ]);
   
        Branch::create([
            'name' => 'Massagestudio',
            'slug' => 'massage-studio'
        ]);
    }
}
