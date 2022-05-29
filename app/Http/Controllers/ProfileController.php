<?php

namespace App\Http\Controllers;

use App\Mail\PasswordChangedMailable;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ProfileController extends Controller
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET_KEY')
        );
    }

    public function show()
    {

        $user = Auth::user();

        return view('dashboard.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        $user->update([
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);

        if ($user->type == 'customer') {
            $this->updateCustomerProfile($user, $data);
        } elseif ($user->type == 'business') {
            $this->updateBusinessProfile($user, $data);
        }

        return response()->json([
            'message' => 'Profile updated successfully',
            'status' => 'true',
        ], 200);
    }

    public function updateCustomerProfile($user, $data)
    {
        $user->customer()->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'date_of_birth' => $data['date_of_birth']
        ]);

        $user->location()->update([
            'street' => $data['street'],
            'street_number' => $data['street_number'],
            'city' => $data['city'],
            'zip_code' => $data['zip_code'],
            'formatted_address' => $data['formatted_address']
        ]);
    }

    public function updateBusinessProfile($user, $data)
    {
        $user->business()->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'person_to_contact' => $data['person_to_contact'],
            'ust_id' => $data['ust_id'],
        ]);
    }

    public function updatePassword(Request $request)
    {
        $data = $request->all();

        $user = Auth::user();

        $user->update([
            'password' => bcrypt($data['password']),
        ]);

        
        $mail_data = [
            'email' => $user->email,
            'name' => $user->type == 'customer' ? $user->customer->first_name . ' ' . $user->customer->last_name : $user->business->name,
        ];

        Mail::send(new PasswordChangedMailable($mail_data));

        return response()->json([
            'message' => 'Profile updated successfully',
            'status' => 'true',
        ], 200);
    }

    public function connectStripeAccount()
    {
        $user = Auth::user();

        $response = $this->stripe->accounts->create([
            'type' => 'standard',
            // 'email' => $user->email,
            'email' => $user->email,
        ]);

        $user->stripeAccount()->create([
            'account_id' => $response->id,
            'status' => 'pending'
        ]);

        $response = $this->stripe->accountLinks->create([
            'account' => $response->id,
            'refresh_url' => env('STRIPE_REFRESH_URL'),
            'return_url' => env('STRIPE_REDIRECT_URL') . '?account_id=' . $response->id,
            'type' => 'account_onboarding',
        ]);


        return redirect($response->url);
    }

    public function deauthorizeStripeAccount()
    {
        $user = Auth::user();
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // $this->stripe->accounts->delete(
        //     $user->stripeAccount()->get()->toArray()[0]['account_id'],
        //     []
        // );

        $user->stripeAccount->delete();

        return redirect()->back();
    }

    public function stripeAccountOnboarding(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $account_id = $data['account_id'];

        $this->stripe->accounts->retrieve(
            $account_id,
            []
        );

        $user->stripeAccount()->update([
            'status' => 'connected'
        ]);

        return redirect('/dashboard');
    }
}
