<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubscriptionCancelledMailable extends Mailable
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
        $this->user_email = $data['user_email'];
        $this->plan_name = $data['plan_name'];
        $this->start_date = $data['start_date'];
        $this->due_date = $data['due_date'];
        $this->plan_price = $data['plan_price'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $business_name = $this->business_name;
        $user_email = $this->user_email;
        $plan_name = $this->plan_name;
        $start_date = $this->start_date;
        $due_date = $this->due_date;
        $plan_price = $this->plan_price;

        return $this->view('email.admin.subscription_cancelled', [
            'business_name' => $business_name,
            'plan_name' => $plan_name,
            'start_date' => $start_date,
            'due_date' => $due_date,
            'plan_price' => $plan_price,
        ])
            ->to($user_email)
            ->replyTo('info@youmas.de', 'Youmas')
            ->subject('Youmas Subscription Confirmation');
    }
}
