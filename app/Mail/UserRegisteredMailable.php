<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->name = $data['name'];
        $this->user_email = $data['user_email'];
        $this->verification_token = $data['verification_token'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name = $this->name;
        $user_email = $this->user_email;
        $verification_token = $this->verification_token;

        $link = 'https://youmas.de' . '/auth/' . $verification_token . '/verify';
        
        return $this->view('email.common.user_registered', [
            'name' => $name,
            'link' => $link
        ])
            ->to($user_email)
            ->replyTo('info@youmas.de', 'Youmas')
            ->subject('Registrierung');;
    }
}
