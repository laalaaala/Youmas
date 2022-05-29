<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */


    /**
     * Build the message.
     *
     * @return $this
     */
    public function __construct($data)
    {
        $this->email = $data['email'];
        $this->name = $data['name'];
        $this->token = $data['token'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->email;
        $name = $this->name;
        $token = $this->token;

        $link = "http://localhost/password/reset/" . $this->token . "?email=" . $email;

        return $this->view('email.common.forgot_password', [
            'email' => $email,
            'name' => $name,
            'link' => $link
        ])
            ->to($email)
            ->replyTo('noreply@youmas.de', 'Youmas')
            ->subject('Passwort vergessen');
    }
}
