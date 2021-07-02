<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TicketPurchaseEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $ticket;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $ticket)
    {
        $this->email = $email;
        $this->ticket = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.ticket')->to($this->email)->from('yurii.hrytsak.knm.2018@lpnu.ua')->with("ticket", $this->ticket);
    }
}
