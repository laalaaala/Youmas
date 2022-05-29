<?php

namespace Tests\Feature;

use App\Models\Branch;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use App\Models\User;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class BusinessReviewTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that user can see review page.
     *
     * @return void
     */
    public function test_customer_can_see_review_page()
    {
        $user = User::factory()->create([
            'password' => bcrypt('i-love-laravel'),
            'type' => 'customer'
        ]);

        $business = User::factory()->create([
            'password' => bcrypt('i-love-laravel'),
            'type' => 'business'
        ]);
        $branch = Branch::create([
            'name' => 'Test Branch',
            'slug' => 'test-branch'
        ]);

        $category = ServiceCategory::create([
            'name' => 'Test Category',
            'branch_id' => $branch->id
        ]);

        $sub_category = ServiceSubcategory::create([
            'name' => 'test_sub',
            'category_id' => $category->id
        ]);

        $business->business()->create([
            'name' => 'Test biz',
            'description' => 'asd',
            'branch_id' => $branch->id,
            'person_to_contact' => 'Jorge perez',
            'ust_id' => 'ASD'
        ]);


        $service = Service::create([
            'name' => 'Test service',
            'duration' => 60,
            'price' => 420,
            'subcategory_id' => $sub_category->id,
            'business_id' => $business->business->id
        ]);

        $review = $business->reviews()->create([
            'token' => Uuid::uuid4()->toString(),
            'status' => 'pending',
            'customer_id' => $user->id,
            'service_id' => $service->id,
            'user_id' => $business->id
        ]);

        $response = $this->actingAs($user)->get('/businesses/2/review?token=' . $review->token);

        $response->assertStatus(200);
        $response->assertViewIs('business.reviews.create');
    }


    public function test_customer_can_create_review()
    {
        $user = User::factory()->create([
            'password' => bcrypt('i-love-laravel'),
            'type' => 'customer'
        ]);

        $business = User::factory()->create([
            'password' => bcrypt('i-love-laravel'),
            'type' => 'business'
        ]);
        $branch = Branch::create([
            'name' => 'Test Branch',
            'slug' => 'test-branch'
        ]);

        $category = ServiceCategory::create([
            'name' => 'Test Category',
            'branch_id' => $branch->id
        ]);

        $sub_category = ServiceSubcategory::create([
            'name' => 'test_sub',
            'category_id' => $category->id
        ]);

        $business->business()->create([
            'name' => 'Test biz',
            'description' => 'asd',
            'branch_id' => $branch->id,
            'person_to_contact' => 'Jorge perez',
            'ust_id' => 'ASD'
        ]);


        $service = Service::create([
            'name' => 'Test service',
            'duration' => 60,
            'price' => 420,
            'subcategory_id' => $sub_category->id,
            'business_id' => $business->business->id
        ]);

        $review = $business->reviews()->create([
            'token' => Uuid::uuid4()->toString(),
            'status' => 'pending',
            'customer_id' => $user->id,
            'service_id' => $service->id,
            'user_id' => $business->id
        ]);

        $data = [
            'ambient' => 2,
            'cleanliness' => 3,
            'service' => 5,
            'comment' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit.'
        ];

        $response = $this->actingAs($user)->post('/businesses/2/review?token=' . $review->token, $data);

        $response->assertStatus(200);

        $this->assertDatabaseHas('business_reviews', [
            'token' => $review->token,
            'ambient' => $data['ambient'],
            'cleanliness' => $data['cleanliness'],
            'service' => $data['service'],
        ]);

        // $response->assertViewIs('business.reviews.create');
    }
}
