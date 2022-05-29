<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingReminder24HSMailable extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct($data)
    {
        $this->booking_id = $data['booking_id'];
        $this->service_name = $data['service_name'];
        $this->business_email = $data['business_email'];
        $this->business_phone = $data['business_phone'];
        $this->employee = $data['employee'];
        $this->customer_name = $data['customer_name'];
        $this->customer_first_name = $data['customer_first_name'];
        $this->customer_last_name = $data['customer_last_name'];
        $this->customer_mobile_phone = $data['customer_mobile_phone'];
        $this->customer_zip_code = $data['customer_zip_code'];
        $this->customer_city = $data['customer_city'];
        $this->booking_start = $data['booking_start'];
        $this->booking_end = $data['booking_end'];
        $this->business_name = $data['business_name'];
        $this->business_location = $data['business_location'];
        $this->booking_created_date = $data['booking_created_date'];
        $this->total_price = $data['total_price'];
        $this->customer_salutation = $data['customer_salutation'];
        $this->customer_email = $data['customer_email'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $booking_id = $this->booking_id;
        $service_name = $this->service_name;
        $business_email = $this->business_email;
        $business_phone = $this->business_phone;
        $customer_name = $this->customer_name;
        $customer_email = $this->customer_email;
        $employee = $this->employee;
        $booking_start = $this->booking_start;
        $booking_end = $this->booking_end;
        $business_name = $this->business_name;
        $business_location = $this->business_location;
        $booking_created_date = $this->booking_created_date;
        $total_price = $this->total_price;

        $customer_first_name = $this->customer_first_name;
        $customer_last_name = $this->customer_last_name;
        $customer_zip_code = $this->customer_zip_code;
        $customer_city = $this->customer_city;
        $customer_salutation = $this->customer_salutation;
        $customer_mobile_phone = $this->customer_mobile_phone;

        return $this->view('email.booking.reminder_24hs', [
            'service_name' => $service_name,
            'customer_name' => $customer_name,
            'employee_name' => $employee,
            'booking_start' => $booking_start,
            'business_email' => $business_email,
            'booking_end' => $booking_end,
            'business_name' => $business_name,
            'business_location' => $business_location,
            'booking_created_date' => $booking_created_date,
            'total_price' => $total_price,
            'customer_first_name' => $customer_first_name,
            'customer_last_name' => $customer_last_name,
            'customer_zip_code' => $customer_zip_code,
            'customer_city' => $customer_city,
            'customer_salutation' => $customer_salutation,
            'customer_mobile_phone' => $customer_mobile_phone,
            'business_email' => $business_email,
            'business_phone' => $business_phone,
            'booking_id' => $booking_id,
        ])
            ->to($customer_email)
            ->replyTo('noreply@youmas.de', 'Youmas')
            ->subject('Erinnerung - Ihr Termin steht kurz bevor');
    }
}
