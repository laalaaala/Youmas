<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BusinessTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase;

    public function test_user_can_view_a_business_list()
    {
        $response = $this->get('/businesses');

        $response->assertSuccessful();
        $response->assertViewIs('business.index');
    }

    // public function test_user_can_view_a_single_business()
    // {
    //     $business = \App\Models\Business::factory()->make();
    //     $response = $this->get('/businesses/1');
    //     $response->assertSuccessful();
    //     $response->assertViewIs('business.show');
    // }
}
