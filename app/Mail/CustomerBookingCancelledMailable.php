<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerBookingCancelledMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->business_name = $data['business_name'];
        $this->booking_number = $data['booking_number'];
        $this->business_email = $data['business_email'];
        $this->customer_email = $data['customer_email'];
        $this->customer_name = $data['customer_name'];
        $this->booking_start = $data['booking_start'];
        $this->service_name = $data['service_name'];
        $this->total_price = $data['total_price'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        $business_name = $this->business_name;
        $booking_number = $this->booking_number;
        $business_email = $this->business_email;
        $customer_email = $this->customer_email;
        $customer_name = $this->customer_name;
        $booking_start = $this->booking_start;
        $service_name = $this->service_name;
        $total_price = $this->total_price;

        return $this->view('email.customer.booking_cancelled', [
            'business_name' => $business_name,
            'customer_name' => $customer_name,
            'booking_number' => $booking_number,
            'business_email' => $business_email,
            'booking_start' => $booking_start,
            'service_name' => $service_name,
            'total_price' => $total_price,
            'cancelled_time' => Carbon::now()->toDateTimeString()
        ])
            ->to($customer_email)
            ->replyTo('noreply@youmas.de', 'Youmas')
            ->subject('Dienstleister hat storniert');
    }
}
