<?php

namespace Database\Seeders;

use App\Models\ServiceSubcategory;
use Illuminate\Database\Seeder;

class ServiceSubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Hair saloon
         */
        ServiceSubcategory::create([
            'name' => 'Hair ladies',
            'category_id' => 1
        ]);

        ServiceSubcategory::create([
            'name' => 'Hair men',
            'category_id' => 1
        ]);

        ServiceSubcategory::create([
            'name' => 'Hair children',
            'category_id' => 1
        ]);

        ServiceSubcategory::create([
            'name' => 'Beard',
            'category_id' => 2
        ]);

        ServiceSubcategory::create([
            'name' => 'Eyebrows',
            'category_id' => 2
        ]);


        /**
         * Tattoo/Piercing studio
         */

        ServiceSubcategory::create([
            'name' => 'Tattoo',
            'category_id' => 3
        ]);

        ServiceSubcategory::create([
            'name' => 'Piercing',
            'category_id' => 4
        ]);

        /**
         * Beauty Saloon
         */

        ServiceSubcategory::create([
            'name' => 'Hair Removal',
            'category_id' => 5
        ]);

        ServiceSubcategory::create([
            'name' => 'Permanent Make-up',
            'category_id' => 6
        ]);

        ServiceSubcategory::create([
            'name' => 'Eyelashes',
            'category_id' => 6
        ]);

        ServiceSubcategory::create([
            'name' => 'Eyebrows',
            'category_id' => 6
        ]);

        ServiceSubcategory::create([
            'name' => 'Pedicure',
            'category_id' => 7
        ]);

        ServiceSubcategory::create([
            'name' => 'Manicure',
            'category_id' => 7
        ]);

        ServiceSubcategory::create([
            'name' => 'Klassische Massage',
            'category_id' => 8
        ]);

        ServiceSubcategory::create([
            'name' => 'Lymphdrainage',
            'category_id' => 8
        ]);

        ServiceSubcategory::create([
            'name' => 'Breuss Massage',
            'category_id' => 8
        ]);

        ServiceSubcategory::create([
            'name' => 'Schröpfmassage',
            'category_id' => 8
        ]);

        ServiceSubcategory::create([
            'name' => 'Thai Massage',
            'category_id' => 8
        ]);

        ServiceSubcategory::create([
            'name' => 'Fußreflexzonenmassage',
            'category_id' => 8
        ]);

        ServiceSubcategory::create([
            'name' => 'Akupressur',
            'category_id' => 8
        ]);

        ServiceSubcategory::create([
            'name' => 'Ayurveda Massage',
            'category_id' => 8
        ]);
    }
}
