<?php

namespace Tests\Feature;

use App\Models\Business;
use App\Models\User;
use App\Models\UserLocation;
use Database\Factories\BusinessFactory;
use Database\Seeders\BranchTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_customer_can_view_profile()
    {
        $user = User::factory()->make(['type' => 'customer']);

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
    }

    public function test_customer_can_edit_profile()
    {
        $user = User::factory(App\User::class)->create(['type' => 'customer']);
        $user->customer()->create([
            'first_name' => 'George',
            'last_name' => 'Clooney',
            'date_of_birth' => '06-02-1985'
        ]);

        $update_data = [
            'email' => 'newemail@gmail.com',
            'phone' => '654321',
            'first_name' => 'Quentin',
            'last_name' => 'Tarantino',
            'date_of_birth' => '05-10-1992',
            'password' => 'password'
        ];

        $response = $this->actingAs($user)->put('/dashboard/profile', $update_data);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => $update_data['email'],
            'type' => $user->type,
        ]);

        $this->assertTrue(Hash::check('password', $user->password));

        $this->assertDatabaseHas('customers', [
            'id' => $user->id,
            'first_name' => $update_data['first_name'],
            'date_of_birth' => $update_data['date_of_birth'],
        ]);
    }

    public function test_business_can_view_profile()
    {
        $this->seed(BranchTableSeeder::class);

        $user = User::factory()->create(['type' => 'business']);
        // $user->location()->save(UserLocation::factory()->create());

        $user->business()->create([
            'name' => 'Business',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'phone' => 123456,
            'person_to_contact' => 'Rod',
            'ust_id' => 'IDP',
            'branch_id' => 1,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
    }

    public function test_business_can_edit_profile()
    {

        $this->seed(BranchTableSeeder::class);

        $user = User::factory()->create(['type' => 'business']);
        $user->business()->create([
            'name' => 'Business',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
            'phone' => 123456,
            'person_to_contact' => 'Rod',
            'ust_id' => 'IDP',
            'branch_id' => 1,
        ]);

        $update_data = [
            'name' => 'Other business',
            'email' => 'businessnewemail@youmas.com',
            'description' => 'New description is cooler',
            'phone' => 654321,
            'person_to_contact' => 'Barak',
            'ust_id' => 'IDP',
            'password' => 'password'
        ];

        $response = $this->actingAs($user)->put('/dashboard/profile', $update_data);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => $update_data['email'],
            'type' => $user->type,
        ]);

        $this->assertTrue(Hash::check('password', $user->password));

        $this->assertDatabaseHas('businesses', [
            'id' => $user->business->id,
            'name' => $update_data['name'],
            'description' => $update_data['description'],
            'phone' => $update_data['phone'],
            'person_to_contact' => $update_data['person_to_contact'],
            'ust_id' => $update_data['ust_id'],
            'branch_id' => $user->business->branch_id,
        ]);


        $response->assertStatus(200);
    }
}