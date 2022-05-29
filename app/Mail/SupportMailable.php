<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupportMailable extends Mailable
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

        return $this->view('email.admin-support', [
            'email' => $email,
            'name' => $name,
            'msg' => $message,
            'timestamp' => Carbon::now()->toDateTimeString()
        ])
            // ->to('info@youmas.de')
            ->to('it@sidenodes.com')
            // ->replyTo('info@youmas.de', 'Youmas')
            ->replyTo('it@sidenodes.com', 'Youmas')
            ->subject($subject . 'Formular erhalten');
    }
}
