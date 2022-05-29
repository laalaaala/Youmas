<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserSupportMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->email = $data['email'];
        $this->name = $data['name'];
        $this->message = $data['message'];
        $this->subject = $data['subject'];
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
        $message = $this->message;
        $subject = $this->subject;

        return $this->view('email.support', [
            'email' => $email,
            'name' => $name,
            'msg' => $message,
        ])
            ->to($email)
            ->replyTo('noreply@youmas.de', 'Youmas')
            ->subject('Formular abgeschickt');
    }
}
