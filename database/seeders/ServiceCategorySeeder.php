<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceCategory::create([
            'name' => 'Hair',
            'branch_id' => 1
        ]);

        ServiceCategory::create([
            'name' => 'Face',
            'branch_id' => 1
        ]);

        ServiceCategory::create([
            'name' => 'Tattoo',
            'branch_id' => 2
        ]);

        ServiceCategory::create([
            'name' => 'Piercing',
            'branch_id' => 2
        ]);

        ServiceCategory::create([
            'name' => 'Hair',
            'branch_id' => 3
        ]);

        ServiceCategory::create([
            'name' => 'Face',
            'branch_id' => 3
        ]);

        ServiceCategory::create([
            'name' => 'Nail',
            'branch_id' => 3
        ]);
 
        ServiceCategory::create([
            'name' => 'Massage',
            'branch_id' => 4
        ]);

        // ServiceCategory::create([
        //     'name' => 'Lymphdrainage',
        //     'branch_id' => 4
        // ]);

        // ServiceCategory::create([
        //     'name' => 'Breuss Massage',
        //     'branch_id' => 4
        // ]);

        // ServiceCategory::create([
        //     'name' => 'Schröpfmassage',
        //     'branch_id' => 4
        // ]);

        // ServiceCategory::create([
        //     'name' => 'Thai Massage',
        //     'branch_id' => 4
        // ]);

        // ServiceCategory::create([
        //     'name' => 'Fußreflexzonenmassage',
        //     'branch_id' => 4
        // ]);

        // ServiceCategory::create([
        //     'name' => 'Akupressur',
        //     'branch_id' => 4
        // ]);

        // ServiceCategory::create([
        //     'name' => 'Ayurveda Massage',
        //     'branch_id' => 4
        // ]);
    }
}
