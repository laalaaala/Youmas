<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminStatsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that user of type "admin" can see the statistics view.
     *
     * @return void
     */
    public function test_admin_can_see_stats_view()
    {
        $user = User::factory()->make([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'admin'
        ]);

        $response = $this->actingAs($user)->get('/login');
        $response = $this->get('/admin/stats');

        $response->assertStatus(200);
        $response->assertViewIs('admin.stats');
    }

    /**
     * Test that user of type "customer" can not see the statistics view.
     *
     * @return void
     */
    public function test_customer_can_not_see_stats_view()
    {
        $user = User::factory()->make([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'customer'
        ]);

        $response = $this->actingAs($user)->get('/admin/stats');

        $response->assertStatus(403);
    }

    /**
     * Test that user of type "business" can not see the statistics view.
     *
     * @return void
     */

    public function test_business_can_not_see_stats_view()
    {
        $user = User::factory()->make([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'business'
        ]);

        $response = $this->actingAs($user)->get('/admin/stats');

        $response->assertStatus(403);
    }

    /**
     * Test that admin can get stats data
     *
     * @return void
     */

    public function test_admin_can_get_stats_data()
    {
        $user = User::factory()->make([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'admin'
        ]);

        $response = $this->actingAs($user)->get('/admin/stats/user?period=month&first_day=01-07-2021&today=29-07-2021');
        $response->assertStatus(200);
    }

    /**
     * Test that customer cannot get stats data
     *
     * @return void
     */

    public function test_customer_cannot_get_user_stats_data()
    {
        $user = User::factory()->make([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'customer'
        ]);

        $response = $this->actingAs($user)->get('/admin/stats/user');
        $response->assertStatus(403);
    }

    /**
     * Test that business cannot get stats data
     *
     * @return void
     */

    public function test_business_cannot_get_user_stats_data()
    {
        $user = User::factory()->make([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'business'
        ]);

        $response = $this->actingAs($user)->get('/admin/stats/user');
        $response->assertStatus(403);
    }

    /**
     * Test that filter function returns Monthly data
     *
     * @return void
     */

    public function test_filter_function_returns_monthly_user_data()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->make([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'admin'
        ]);

        $json_to_assert = [
            'data' => [
                [
                    'name',
                    'data' => []
                ],
                [
                    'name',
                    'data' => []
                ],
            ],
        ];

        $response = $this->actingAs($user)->get('/admin/stats/user?period=month&first_day=01-07-2021&today=29-07-2021');
        $response->assertStatus(200);
        $response->assertJsonStructure($json_to_assert);
    }
    /**
     * Test that filter function returns Yearly data
     *
     * @return void
     */
    public function test_filter_function_returns_yearly_user_data()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->make([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'admin'
        ]);

        $json_to_assert = [
            'data' => [
                [
                    'name',
                    'data' => []
                ],
                [
                    'name',
                    'data' => []
                ],
            ],
        ];

        $response = $this->actingAs($user)->get('/admin/stats/user?period=year&first_day=2020-08-01&today=2021-08-01');
        $response->assertStatus(200);
        $response->assertJsonStructure($json_to_assert);
    }
}