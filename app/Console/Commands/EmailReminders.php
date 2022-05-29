<?php

namespace App\Console\Commands;

use App\Mail\BookingReminder24HSMailable;
use App\Mail\BookingReminder2HSMailable;
use App\Models\Bookings;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmailReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind user their booking';

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
        $bookings_24 = Bookings::where('status', 'pending')
            ->where('reminder_24hs_sent', 0)
            ->with('service')
            ->get();

        foreach ($bookings_24 as $booking) {
            $diff = Carbon::parse($booking->start)->diffInHours(Carbon::now()->toDateTimeString());

            if ($diff <= 24) {


                $business = $booking->employee->business;
                $employee = $booking->employee;
                $end = Carbon::parse($booking['time'])->addMinutes($booking['total_duration'])->toDateTimeString();

                $service = Service::find($booking->service->id)->name;
                $customer = User::where('id', $booking->customer_id)->first();

                $mail_data = [
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

                // Mail reminder
                Mail::send(new BookingReminder24HSMailable($mail_data));
                $booking->reminder_24hs_sent = 1;
                $booking->save();
            }
        }


        $bookings_2hs = Bookings::where('status', 'pending')

            ->where('reminder_2hs_sent', 0)
            ->get();

        foreach ($bookings_2hs as $booking) {

            $diff = Carbon::parse($booking->start)->diffInHours(Carbon::now()->toDateTimeString());
            if ($diff <= 2) {


                $business = $booking->employee->business;
                $employee = $booking->employee;
                $end = Carbon::parse($booking['time'])->addMinutes($booking['total_duration'])->toDateTimeString();

                $service = Service::find($booking->service->id)->name;
                $customer = User::where('id', $booking->customer_id)->first();


                $mail_data = [
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

                // Mail reminder
                Mail::send(new BookingReminder2HSMailable($mail_data));
                $booking->reminder_2hs_sent = 1;
                $booking->save();
            }
        }
    }
}
