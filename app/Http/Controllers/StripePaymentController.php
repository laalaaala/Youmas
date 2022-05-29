<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Review;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripePaymentController extends Controller
{

    protected $stripe;

    public function __construct()
    {
        // $this->stripe = new \Stripe\StripeClient('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');
    }

    public function customerPurchase(Request $request)
    {
        $data = $request->all();

        // \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        \Stripe\Stripe::setApiKey('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');

        \Stripe\Account::update(
            $data['stripe_account'],
            [
                'settings' => [
                    'payouts' => [
                        'schedule' => [
                            'interval' => 'manual',
                        ],
                    ],
                ],
            ]
        );

        $orderId = Str::random(10);
        // Create a PaymentIntent:
        try {

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $data['total_price'] . '00',
                'currency' => 'eur',
                'payment_method_types' => ['card'],
                'transfer_group' => $orderId,
            ]);

            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
                'payment_id' => $paymentIntent->id,
                'order_id' => $orderId,
                'status' => true,
                'message' => 'Booking created successfully. You\'ll be redirected to your dashboard soon.'
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'status' => false,
                'message' => 'There has been an error'
            ], 422);
        }
    }

    public function payout(Request $request)
    {

        \Stripe\Stripe::setApiKey('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');
        $data = $request->all();
        $business = User::find($data['business_id']);
        $businessStripeAccount = $business->stripeAccount()->get()->toArray();

        $amount = $data['amount'];
        $connectedAccount = $businessStripeAccount[0]['account_id'];
        $transfer_group = $data['transfer_group'];
        // Create a Transfer to a connected account (later):

        $transfer = \Stripe\Transfer::create([
            'amount' => $amount . '00',
            'currency' => 'eur',
            'destination' => $connectedAccount,
            'transfer_group' => $transfer_group,
        ]);

        $transaction = Transaction::where('order_id', $transfer_group)->first();
        $booking = Bookings::where('transaction_id', $transaction->transaction_id)->first();
        $booking->status = 'completed';
        $booking->save();
        $transaction->status = 'completed';
        $transaction->save();

        // Mail::send(new TransactionMailable());

    }
}
