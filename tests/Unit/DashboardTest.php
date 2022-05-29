<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that admin can see /dashboard page
     *
     * @return void
     */
    public function test_admin_can_see_dashboard_view()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'admin'
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('admin.dashboard');
    }

    /**
     * Test that customer can see /dashboard page
     *
     * @return void
     */
    public function test_customer_can_see_dashboard_view()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'customer'
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('customer.dashboard');
    }

    /**
     * Test that business can see /dashboard page
     *
     * @return void
     */
    public function test_business_can_see_dashboard_view()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'business'
        ]);

        $branch = Branch::create([
            'name' => 'Hair Saloon',
            'slug' => 'hair-saloon'
        ]);

        $business = Business::create([
            'name' => 'Business X',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita omnis, architecto reprehenderit corrupti eaque natus ut impedit cum nulla, quos libero quasi cumque adipisci in sunt corporis. Modi, quam alias.',
            'branch_id' => $branch->id,
            'person_to_contact' => 'Bart',
            'ust_id' => 12345,
            'user_id' => $user->id,
        ]);

        $user->subscription()->create([
            'subscription_id' => 'test',
            'product_id' => 'test',
            'plan_name' => 'test',
            'plan_price' => '5000',
            'status' => 'active',
       ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertViewIs('business.dashboard');
    }
}
