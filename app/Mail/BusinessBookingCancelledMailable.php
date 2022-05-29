<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BusinessBookingCancelledMailable extends Mailable
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
        $booking_start = $this->booking_start;
        $service_name = $this->service_name;
        $total_price = $this->total_price;

        return $this->view('email.business.booking_cancelled', [
            'business_name' => $business_name,
            'booking_number' => $booking_number,
            'business_email' => $business_email,
            'booking_start' => $booking_start,
            'service_name' => $service_name,
            'total_price' => $total_price,
            'cancelled_time' => Carbon::now()->toDateTimeString()
        ])
            ->to($business_email)
            ->replyTo('noreply@youmas.de', 'Youmas')
            ->subject('Buchung storniert Kunde');
    }
}
