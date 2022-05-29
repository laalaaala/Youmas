<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create customer
         */
        $user = User::create([
            'email' => 'admin@youmas.de',
            'password' => bcrypt('password'),
            'email_verified_at' => date("Y-m-d H:i:s"),
            'phone' => '123456',
            'type' => 'admin'
        ]);

        // $user = User::create([
        //     'email' => 'user@youmas.com',
        //     'password' => bcrypt('password'),
        //     'phone' => '123456',
        //     'type' => 'customer'
        // ]);


        // $user = User::create([
        //     'email' => 'user1@youmas.com',
        //     'phone' => '123456',
        //     'password' => bcrypt('password'),
        //     'type' => 'business'
        // ]);

        // $user->location()->create([
        //     'street' => 'Oranienstraße',
        //     'street_number' => '114',
        //     'zip_code' => '10969',
        //     'city' => 'Berlin',
        //     'lat' => '52.505954',
        //     'lng' => '13.4001273,17',
        //     'formatted_address' => 'Berliner Innenstadt, 10969 Berlín, Germany',
        //     'user_id' => $user->id,
        // ]);

        // $user = User::create([
        //     'email' => 'user2@youmas.com',
        //     'phone' => '123456',
        //     'password' => bcrypt('password'),
        //     'type' => 'business'
        // ]);

        // $user->location()->create([
        //     'street' => 'Edenstraße',
        //     'street_number' => '32',
        //     'zip_code' => '30161',
        //     'city' => 'Hannover',
        //     'lat' => '52.3862362',
        //     'lng' => '9.748387',
        //     'formatted_address' => 'Edenstraße 32, 30161 Hannover, Alemania',
        //     'user_id' => $user->id,
        // ]);

        // \App\Models\User::factory()->count(30)->create()->each(function ($s) {
        //     $business = $s->business()->save(\App\Models\Business::factory()->make());
        //     $days = [
        //         'Montag',
        //         'Dienstag',
        //         'Mittwoch',
        //         'Donnerstag',
        //         'Freitag',
        //         'Samstag',
        //     ];
        //     foreach ($days as $day) {
        //         $business->openingHours()->create([
        //             'day' => $day,
        //             'start' => '10:00',
        //             'end' => '20:00'
        //         ]);
        //     }
        //     $s->location()->save(\App\Models\UserLocation::factory()->make());
        // });
    }
}
