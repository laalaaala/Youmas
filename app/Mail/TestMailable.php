<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMailable extends Mailable
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
        $this->msg = $data['message'];
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
        $msg = $this->msg;

        return $this->view('email.support', [
            'email' => $email,
            'name' => $name,
            'msg' => $msg,
        ])
            ->to('santi.duendes@gmail.com')
            ->replyTo('info@youmas.de', 'Youmas')
            ->subject(' Test Support Message');
    }
}
