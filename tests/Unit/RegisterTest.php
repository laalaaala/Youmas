<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\BranchTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_user_can_view_register_form()
    {
        $response = $this->get('/register');

        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    // public function test_user_cannot_view_a_register_form_when_authenticated()
    // {
    //     $user = User::factory()->make();

    //     $response = $this->actingAs($user)->get('/register');
    //     $response = $this->actingAs($user)->get('/register/customer');
    //     $response = $this->actingAs($user)->get('/register/company');

    //     $response->assertRedirect('/dashboard');
    // }


    // public function test_customer_can_view_register_form()
    // {
    //     $response = $this->get('/register/customer');

    //     $response->assertSuccessful();
    //     $response->assertViewIs('auth.customer.register');
    // }

    // public function test_company_can_view_register_form()
    // {
    //     $response = $this->get('/register/company');

    //     $response->assertSuccessful();
    //     $response->assertViewIs('auth.company.register');
    // }

    // public function test_customer_can_register()
    // {

    //     $customer = [
    //         'email' => 'test@youmas.com',
    //         'first_name' => 'William',
    //         'password' => 'youmas',
    //         'type' => 'customer',
    //         'date_of_birth' => '2021-04-14'
    //     ];

    //     $response = $this->post('/register', $customer);


    //     /**
    //      * Assert main user
    //      */
    //     $this->assertDatabaseHas('users', [
    //         'email' => $customer['email'],
    //         'type' => $customer['type'],
    //     ]);

    //     /**
    //      * Assert Customer profile
    //      */

    //     $this->assertDatabaseHas('customers', [
    //         'first_name' => $customer['first_name'],
    //         'date_of_birth' => $customer['date_of_birth'],
    //     ]);

    //     $response->assertRedirect('/dashboard');
    // }

    // public function test_customer_business_can_register()
    // {

    //     // Run the DatabaseSeeder...
    //     // $this->seed();

    //     // Run a specific seeder...
    //     $this->seed(BranchTableSeeder::class);


    //     $business = [
    //         'name' => 'McDonalds',
    //         'branch' => 1,
    //         'phone' => 631359909,
    //         'person_to_contact' => 'jesus',
    //         'ust_id' => 422932,
    //         'type' => 'business',
    //         'email' => 'test@youmas.com',
    //         'password' => 'youmas',
    //         'location' => [
    //             'street' => 'Fake Street',
    //             'street_number' => 423,
    //             'zip_code' => '08024',
    //             'city' => 'Berlin',
    //             'lat' => 44.5234,
    //             'lng' => 2.3245,
    //             'formatted_address' => 'Fake Street 423, Berlin, Germany',
    //         ]
    //     ];

    //     $response = $this->post('/register', $business);


    //     /**
    //      * Assert main user
    //      */
    //     $this->assertDatabaseHas('users', [
    //         'email' => $business['email'],
    //         'type' => $business['type'],
    //     ]);

    //     /**
    //      * Assert Customer profile
    //      */

    //     $this->assertDatabaseHas('businesses', [
    //         'name' => $business['name'],
    //         'phone' => $business['phone'],
    //         'branch_id' => $business['branch'],
    //         'person_to_contact' => $business['person_to_contact'],
    //         'ust_id' => $business['ust_id'],
    //     ]);

    //     $response->assertRedirect('/dashboard');
    // }
}