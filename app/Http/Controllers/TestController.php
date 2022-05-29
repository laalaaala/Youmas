<?php

namespace App\Http\Controllers;

use App\Mail\BookingCompletedMailable;
use App\Models\StripeSubscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;

class TestController extends Controller
{
    public function test()
    {
        dd(env('STRIPE_SECRET_KEY'));
        // $subscriptions = StripeSubscription::where('status', 'cancelled')->orWhere('status', 'trial')
        //     ->where('due_date', '<=', Carbon::now()
        //         ->toDateTimeString())
        //     ->get(); // Older than 3 days

        // foreach ($subscriptions as $subscription) {
        //     $subscription->status = 'inactive';
        //     $subscription->save();
        //     // Change status to complete
        //     $booking->status = 'completed';
        //     $booking->save();
        //     // Create and review and send email to Customer
        //     $business_id = $booking->employee->business->user_id;

        //     $review = BusinessReview::create([
        //         'token' => Uuid::uuid4()->toString(),
        //         'customer_id' => $booking->customer_id,
        //         'user_id' =>  $business_id,
        //         'service_id' => $booking->service_id
        //     ]);

        //     $customer = User::find($review->customer_id);

        //     $data = [
        //         'link' => env('APP_URL') . '/businesses/' . $business_id . '/review?token=' . $review->token,
        //         'customer' => $customer
        //     ];

        //     Mail::send(new BookingCompletedMailable($data));
    }
}
// }
