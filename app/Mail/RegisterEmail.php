<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailSubject, $title, $user)
    {
        $this->subject = $emailSubject;
        $this->title = $title;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fromaddress = 'janeexampexample@example.com';
        $subject = 'This is a demo!';
        $name = 'Jane Doe';

        return $this->view('emails.register')
            ->to($this->user->email)
            ->from($fromaddress, $name)
//            ->cc($fromaddress, $name)
//            ->bcc($fromaddress, $name)
//            ->replyTo($fromaddress, $name)
            ->subject($subject)
            ->with(
                [
                'user' => $this->user,
                'title' => $this->title
            ]);
    }
}
