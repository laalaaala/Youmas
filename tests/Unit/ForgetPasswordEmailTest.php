<?php

namespace Tests\Unit;

use App\Mail\ForgotPasswordMailable;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgetPasswordEmailTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_user_can_view_password_reset_page()
    {
        $response = $this->get('/password/reset');

        $response->assertViewIs('auth.passwords.email');
        $response->assertSuccessful(200);
    }

    public function test_user_can_recover_password()
    {
        $user = User::factory()->create();

        $response = $this->post('password/email', ['email' => $user->email]);

        $response->assertStatus(302);
    }
    public function test_admin_can_recover_password()
    {
        $user = User::factory()->create([
            'type' => 'admin'
        ]);

        $response = $this->post('password/email', ['email' => $user->email]);

        $response->assertStatus(302);
    }

    public function test_customer_can_recover_password()
    {
        $user = User::factory()->create([
            'type' => 'customer'
        ]);

        $response = $this->post('password/email', ['email' => $user->email]);

        $response->assertStatus(302);
    }


    public function test_business_can_recover_password()
    {
        $user = User::factory()->create([
            'type' => 'business'
        ]);

        $response = $this->post('password/email', ['email' => $user->email]);

        $response->assertStatus(302);
    }
}