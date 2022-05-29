<?php

namespace App\Http\Controllers;

use App\Mail\BusinessBookingCancelledMailable;
use App\Models\Bookings;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CustomerBookingController extends Controller
{
    public function index()
    {
        $customer = Auth::user();
        $bookings = $customer->bookings()->with('employee')->with('service')->with('transaction')->get()->toArray();


        return view('customer.bookings', compact('bookings'));
    }

    public function show($id)
    {
        $user = User::find($id);
        $customer = $user->customer()->first();
        return response()->json(['customer_data' => $customer, 'user_data' => $user], 200);
    }

    public function destroy($id, Request $request)
    {

        $customer = Auth::user();

        $customer->bookings()->where('id', $id)->delete();

        return view('customer.bookings');
    }

    public function update($id, Request $request)
    {
        
        $data = $request->all();
        
        
        $booking = Bookings::find($id);
        if($booking->transaction_id) {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $transaction = Transaction::find($booking->transaction_id);
            $refund_amount = round((($transaction->amount * 0.971) - 0.3), 2) * 100;
            $regex = "_secret_";
            $transaction_id = $transaction->transaction_id;
            $parts = explode($regex, $transaction_id);
            $payment_intent = $parts[0];

            try {
                if ($transaction->status == 'pending') {
                    \Stripe\Refund::create([
                        'amount' => $refund_amount,
                        'payment_intent' => $payment_intent,
                    ]);

                    $transaction->status = 'refunded';
                    $transaction->save();
                }
            } catch (Exception $error) {
                dd($error->getMessage());
            }
            
        }
        $booking->status = $data['status'];
        $booking->save();
        
        
        $mail_data = [
            'business_name' => $booking->employee->business->name,
            'booking_number' => $booking->id,
            'business_email' => $booking->employee->business->user->email,
            'booking_start' => $booking->start,
            'service_name' => $booking->service->name,
            'total_price' => $booking->total_price
        ];
        
        Mail::send(new BusinessBookingCancelledMailable($mail_data));

    }
}
