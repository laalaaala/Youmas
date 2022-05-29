<?php

namespace App\Console\Commands;

use App\Mail\BookingCompletedMailable;
use App\Models\Bookings;
use App\Models\BusinessReview;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Ramsey\Uuid\Uuid;

class ChangeBookingsToComplete extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:complete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change bookings to complete';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /** Booking completed **/
        $bookings = Bookings::where('status', 'pending')
            ->where('start', '<=', Carbon::now()
                ->subDays(1)
                ->toDateTimeString())
            ->get(); // Older than 3 days

        foreach ($bookings as $booking) {
            // Change status to complete
            $booking->status = 'completed';
            $booking->save();
            // Create and review and send email to Customer
            $business_id = $booking->employee->business->user_id;

            $review = BusinessReview::create([
                'token' => Uuid::uuid4()->toString(),
                'customer_id' => $booking->customer_id,
                'user_id' =>  $business_id,
                'service_id' => $booking->service_id
            ]);

            $customer = User::find($review->customer_id);
            $service = Service::find($booking->service->id)->name;
            $employee = $booking->employee;
            $end = Carbon::parse($booking['time'])->addMinutes($booking['total_duration'])->toDateTimeString();
            $business = $booking->employee->business;

            $data = [
                'link' => env('APP_URL') . '/businesses/' . $business_id . '/review?token=' . $review->token,
                // 'customer' => $customer,
                'booking_id' => $booking->id,
                'service_name' => $service,
                'employee' => $employee->first_name . " " . $employee->last_name,
                'booking_start' => $booking->time,
                'booking_end' => $end,
                'booking_created_date' => Carbon::parse($booking->created_at)->toDateTimeString(),
                'customer_name' => $customer->customer->first_name . " " . $customer->customer->last_name,
                'customer_salutation' => $customer->customer->salutation,
                'customer_first_name' => $customer->customer->first_name,
                'customer_last_name' => $customer->customer->last_name,
                'customer_email' => $customer->email,
                'customer_mobile_phone' => $customer->phone,
                'customer_zip_code' => $customer->location->zip_code,
                'customer_city' => $customer->location->city,
                'business_email' => $business->user->email,
                'business_phone' => $business->user->phone,
                'business_name' => $business->name,
                'business_location' => $business->user->location,
                'total_price' => $booking->total_price
            ];

            Mail::send(new BookingCompletedMailable($data));
        }
    }
}
