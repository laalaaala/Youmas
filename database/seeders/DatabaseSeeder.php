<?php

namespace Database\Seeders;

use App\Models\ConversationMessage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BranchTableSeeder::class);
        $this->call(ServiceCategorySeeder::class);
        $this->call(ServiceSubCategorySeeder::class);
        $this->call(UserTableSeeder::class);
        // $this->call(BusinessTableSeeder::class);
        // $this->call(BusinessPicturesTableSeeder::class);
        // $this->call(EmployeeSeeder::class);
        // $this->call(ServiceSeeder::class);
        $this->call(FaqSeeder::class);
    }
}