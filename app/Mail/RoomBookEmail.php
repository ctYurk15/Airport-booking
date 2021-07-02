<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RoomBookEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $room;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $room)
    {
        $this->email = $email;
        $this->room = $room;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.room')->to($this->email)->from('yurii.hrytsak.knm.2018@lpnu.ua')->with("room", $this->room);
    }
}
