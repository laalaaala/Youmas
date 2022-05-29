<?php

namespace Tests\Unit;

use App\Mail\SupportMailable;
use App\Mail\UserSupportMailable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SupportEmailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_customer_can_view_support_page()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'customer'
        ]);

        $response = $this->actingAs($user)->get('/dashboard/support');

        $response->assertStatus(200);
    }

    public function test_customer_can_send_support_email()
    {
        Mail::fake();

        // Email Building
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'customer'
        ]);

        $data = [
            'email' => 'testcodeverze@gmail.com',
            'name' => 'Test name',
            'message' => 'message',
        ];

        $response = $this->actingAs($user)->post('/dashboard/support', $data);
        //

        // Testing
        // Mail to Support
        Mail::assertSent(SupportMailable::class, function ($email) {
            Mail::to('info@youmas.de')->send($email);
            return $email->hasTo('info@youmas.de');
        });
        // Email copy to the user
        Mail::assertSent(UserSupportMailable::class, function ($email) use ($data) {
            Mail::to($data['email'])->send($email);
            return $email->hasTo($data['email']);
        });
    }

    public function test_business_can_view_support_page()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'business'
        ]);

        $response = $this->actingAs($user)->get('/dashboard/support');

        $response->assertStatus(200);
    }

    public function test_business_can_send_support_email()
    {
        Mail::fake();

        // Email Building
        $user = User::factory()->create([
            'password' => bcrypt($password = 'i-love-laravel'),
            'type' => 'business'
        ]);
        $data = [
            'email' => 'testcodeverze@gmail.com',
            'name' => 'Test name',
            'message' => 'message',
        ];
        $response = $this->actingAs($user)->post('/dashboard/support', $data);
        //

        // Testing
        // Mail to Support
        Mail::assertSent(SupportMailable::class, function ($email) {
            Mail::to('info@youmas.de')->send($email);
            return $email->hasTo('info@youmas.de');
        });
        // Email copy to the user
        Mail::assertSent(UserSupportMailable::class, function ($email) use ($data) {
            Mail::to($data['email'])->send($email);
            return $email->hasTo($data['email']);
        });
    }
}