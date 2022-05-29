<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $stripe_fee = $data['amount'] * 0.02;
        $youmas_revenue = ($data['amount'] - $stripe_fee) * 0.015;
        $business_revenue = ($data['amount'] - $stripe_fee) - $youmas_revenue;

        try {
            $transaction = Transaction::create([
                'transaction_id' => $data['transaction_id'],
                'status' => 'pending',
                'amount' => $data['amount'],
                'youmas_revenue' => $youmas_revenue,
                'business_revenue' => $business_revenue,
                'customer_id' => $data['customer_id'],
                'business_id' => $data['business_id'],
                'order_id' => $data['order_id'],
            ]);

            $transaction->save();

            return response()->json([
                'data' => $transaction,
                'status' => true
            ], 200);
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function refund($id)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // Cancel booking
        $booking = Bookings::find($id);
        $transaction = Transaction::find($booking->transaction_id);
        if ($transaction) {
            $regex = "_secret_";
            $transaction_id = $transaction->transaction_id;
            $parts = explode($regex, $transaction_id);
            $payment_intent = $parts[0];
            try {
                if ($transaction->status == 'pending') {
                    $refund_amount = round((($transaction->amount * 0.971) - 0.3), 2) * 100;
                    \Stripe\Refund::create([
                        'amount' => $refund_amount,
                        'payment_intent' => $payment_intent,
                    ]);

                    $transaction->status = 'refunded';
                    $transaction->save();
                }

                return response()->json([
                    'message' => 'Transaction refunded successfully',
                    'status' => true
                ], 200);
            } catch (Exception $error) {
                dd($error->getMessage());
            }
        }
    }

    public function show($id)
    {
        $transaction = Transaction::find($id);
        $transaction_status = $transaction->status;
        if ($transaction_status == 'completed') {
            return response()->json(['paymentStatus' => 'bezahlt'], 200);
        }
        return response()->json(['paymentStatus' => $transaction_status], 200);
    }
}