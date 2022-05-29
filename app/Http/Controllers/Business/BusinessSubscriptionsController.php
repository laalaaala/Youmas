<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Mail\SubscriptionCancelledMailable;
use App\Mail\SubscriptionCreatedMailable;
use App\Models\StripeSubscription;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stripe\Subscription;

class BusinessSubscriptionsController extends Controller
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET_KEY'));
        // $this->stripe = new \Stripe\StripeClient('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');
    }
    public function index()
    {
        $user = Auth::user();
        $subscription = $user->subscription;
        return view('business.subscriptions.index', compact('user', 'subscription'));
    }

    public function createCustomer(Request $request)
    {


        $data = $request->all();
        $user = User::where('email', $data['user_email'])->first();

        // Authorize that the user trying to create a customer is the owner of that account
        $this->authorize('create-stripe-customer', $user);

        if (!$user->stripe_business_customer_id) {

            $customerEmail = $data['user_email'];

            $customer = $this->stripe->customers->create([
                'email' => $customerEmail
            ]);

            $user->stripe_business_customer_id = $customer->id;
            $user->save();
        } else {
            $customer = [
                'id' => $user->stripe_business_customer_id
            ];
        }

        return response()->json(['customer' => $customer]);
    }

    public function createSubscription(Request $request)
    {
        $user = Auth::user();
        if ($user->subscription && $user->subscription->status != 'inactive') {
            return response()->json([
                'message' => 'There has been an error',
                'status' => false
            ], 422);
        } else {

            $data = $request->all();
            if ($data['planName'] == 'trial') {
                $local_subscription = StripeSubscription::create([
                    'plan_price' => 0,
                    'subscription_id' => Str::uuid(),
                    'product_id' => '',
                    'status' => 'trial',
                    'customer_id' => '',
                    'start_date' => Carbon::now()->toDateString(),
                    'due_date' => Carbon::now()->addDays(30)->toDateString(),
                    'plan_name' => 'silver',
                    'user_id' => $user->id
                ]);

                return response()->json([
                    'data' => $data,
                    'status' => true,
                    'message' => 'Your subscription has been created.'
                ], 200);
            } else {


                $customer_id = $data['customerId'];
                $price_id = $data['priceId'];

                $subscription = $this->stripe->subscriptions->create([
                    'customer' => $customer_id,
                    'items' => [[
                        'price' => $price_id,
                    ]],
                    'payment_behavior' => 'default_incomplete',
                    'expand' => ['latest_invoice.payment_intent'],
                ]);

                $subscription_id = $subscription->id;
                $payment_intent_id = $subscription->latest_invoice->payment_intent->id;

                # Retrieve the payment intent used to pay the subscription
                $payment_intent = $this->stripe->paymentIntents->retrieve(
                    $payment_intent_id,
                    []
                );

                try {

                    // Set the payment method as default payment method
                    $response = $this->stripe->subscriptions->update(
                        $subscription_id,
                        ['default_payment_method' => $payment_intent->payment_method],
                    );

                    $start_date = date('d/m/Y', $response->current_period_start);
                    $end_date = date('d/m/Y', $response->current_period_end);



                    $local_subscription = StripeSubscription::updateOrCreate(
                        ['user_id' => $user->id],
                        [
                            'plan_price' => $subscription->items->data[0]['plan']['amount'] / 100,
                            'subscription_id' => $subscription_id,
                            'product_id' => $price_id,
                            'status' => 'inactive',
                            'customer_id' => $customer_id,
                            'start_date' => $start_date,
                            'due_date' => $end_date,
                            'plan_name' => $data['planName'],
                            'user_id' => $user->id
                        ]
                    );


                    $data = [
                        'subscription_id' => $subscription->id,
                        'client_secret' => $subscription->latest_invoice->payment_intent->client_secret,
                        'local_subscription_id' => $local_subscription->id
                    ];
                    $mail_data = [
                        'business_name' => $user->business->name,
                        'user_email' => $user->email,
                        'plan_name' => $local_subscription->plan_name,
                        'start_date' => $local_subscription->start_date,
                        'due_date' => $local_subscription->due_date,
                        'plan_price' => $local_subscription->plan_price
                    ];
                    Mail::send(new SubscriptionCreatedMailable($mail_data)); 

                    return response()->json([
                        'data' => $data,
                        'status' => true,
                        'message' => 'Your subscription has been created.'
                    ], 200);
                } catch (Exception $error) {
                    return response()->json([
                        'status' => true,
                        'message' => 'There has been a problem.',
                        "error" => $error->getMessage(),
                    ], 422);
                }
            }
        }
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $subscription = StripeSubscription::find($id);

        // Authorize that the logged user is the owner of the subscription 
        $this->authorize('update', $subscription);

        try {

            $subscription->update(
                [
                    'status' => $data['status']
                ]
            );

            return response()->json([
                'message' => 'Subscription updated successfully',
                'status' => true
            ], 200);
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function cancel(Request $request)
    {
        $data = $request->all();
        $subscription = StripeSubscription::where('subscription_id', $data['subscription_id'])->first();
        $user = User::find($subscription->user_id);

        // Authorize that the logged user is the owner of the subscription 
        $this->authorize('update', $subscription);

        try {

            $subscription->status = 'cancelled';
            $subscription->save();

            $this->stripe->subscriptions->update(
                $data['subscription_id'],
                [
                    'cancel_at_period_end' => true,
                ]
            );

            $mail_data = [
                'business_name' => $user->business->name,
                'user_email' => $user->email,
                'plan_name' => $subscription->plan_name,
                'start_date' => $subscription->start_date,
                'due_date' => $subscription->due_date,
                'plan_price' => $subscription->plan_price
            ];
            Mail::send(new SubscriptionCancelledMailable($mail_data));


            return response()->json([
                'message' => 'Subscription canceled Successfully',
                'status' => true
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'There has been an error.',
                'status' => false
            ], 422);
        }
    }

    public function reactivate(Request $request)
    {
        $data = $request->all();
        $subscription = StripeSubscription::where('subscription_id', $data['subscription_id'])->first();

        // Authorize that the logged user is the owner of the subscription 
        $this->authorize('update', $subscription);
        try {

            $subscription->status = 'active';
            $subscription->save();

            $this->stripe->subscriptions->update(
                $data['subscription_id'],
                [
                    'cancel_at_period_end' => false,
                ]
            );

            return response()->json([
                'message' => 'Subscription canceled Successfully',
                'status' => true
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'There has been an error.',
                'status' => false
            ], 422);
        }
    }
}
