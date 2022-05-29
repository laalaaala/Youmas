<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BusinessSubscriptionTest extends TestCase
{
    /**
     * Business can see subscriptions page.
     *
     * @return void
     */
    /**  @test */
    public function business_can_see_subscription_view()
    {
        $user = User::factory()->make([
            'password' => bcrypt('i-love-laravel'),
            'type' => 'business'
        ]);

        $response = $this->actingAs($user)->get('/businesses/subscriptions');

        $response->assertStatus(200);
        $response->assertViewIs('business.subscriptions.index');
    }

    /**
     * Customer cannot see subscriptions page.
     *
     * @return void
     */

    /**  @test */
    public function customer_cannot_see_subscription_page()
    {
        $user = User::factory()->make([
            'password' => bcrypt('i-love-laravel'),
            'type' => 'customer'
        ]);

        $response = $this->actingAs($user)->get('businesses/subscriptions');

        $response->assertStatus(403);
    }
}