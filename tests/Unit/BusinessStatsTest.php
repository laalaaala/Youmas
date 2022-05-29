<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\Business;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BusinessStatsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that user of type "business" can see the statistics view.
     *
     * @return void
     */
    public function test_business_can_see_stats_view()
    {
        $user = User::factory()->create([
            'id' => 1,
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'business'
        ]);

        $branch = Branch::create([
            'name' => 'Hair Saloon',
            'slug' => 'hair-saloon'
        ]);

        Business::create([
            'name' => 'Business X',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita omnis, architecto reprehenderit corrupti eaque natus ut impedit cum nulla, quos libero quasi cumque adipisci in sunt corporis. Modi, quam alias.',
            'branch_id' => $branch->id,
            'person_to_contact' => 'Bart',
            'ust_id' => 12345,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/dashboard/statistics');

        $response->assertStatus(200);
        $response->assertViewIs('business.statistics.index');
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

        $response = $this->actingAs($user)->get('/dashboard/statistics');

        $response->assertStatus(403);
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


        $response = $this->actingAs($user)->get('/dashboard/statistics/all');
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

        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'business'
        ]);

        $branch = Branch::create([
            'name' => 'Hair Saloon',
            'slug' => 'hair-saloon'
        ]);

        Business::create([
            'name' => 'Business X',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita omnis, architecto reprehenderit corrupti eaque natus ut impedit cum nulla, quos libero quasi cumque adipisci in sunt corporis. Modi, quam alias.',
            'branch_id' => $branch->id,
            'person_to_contact' => 'Bart',
            'ust_id' => 12345,
            'user_id' => $user->id
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
                [
                    'name',
                    'data' => []
                ],
            ],
        ];

        $response = $this->actingAs($user)->get('/dashboard/statistics/all?period=month&first_day=01-07-2021&today=29-07-2021');
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

        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'business'
        ]);

        $branch = Branch::create([
            'name' => 'Hair Saloon',
            'slug' => 'hair-saloon'
        ]);

        Business::create([
            'name' => 'Business X',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita omnis, architecto reprehenderit corrupti eaque natus ut impedit cum nulla, quos libero quasi cumque adipisci in sunt corporis. Modi, quam alias.',
            'branch_id' => $branch->id,
            'person_to_contact' => 'Bart',
            'ust_id' => 12345,
            'user_id' => $user->id
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
                [
                    'name',
                    'data' => []
                ],
            ],
        ];

        $response = $this->actingAs($user)->get('/dashboard/statistics/all?period=year&first_day=2020-08-01&today=2021-08-01');
        $response->assertStatus(200);
        $response->assertJsonStructure($json_to_assert);
    }
}