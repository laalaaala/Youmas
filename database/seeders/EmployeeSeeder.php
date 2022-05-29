<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'genre' => 'Masculine',
            'business_id' => 1,
            'profile_picture' => 'https://randomuser.me/api/portraits/men/1.jpg'
        ]);

        Employee::create([
            'first_name' => 'Lionel',
            'last_name' => 'Messi',
            'genre' => 'Masculine',
            'business_id' => 1,
            'profile_picture' => 'https://randomuser.me/api/portraits/men/1.jpg'
        ]);

        Employee::create([
            'first_name' => 'George',
            'last_name' => 'Bush',
            'genre' => 'Feminine',
            'business_id' => 1,
            'profile_picture' => 'https://randomuser.me/api/portraits/men/1.jpg'
        ]);
    }
}
