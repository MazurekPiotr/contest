<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WinnerChosen extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $contest;

    public function __construct($user, $contest)
    {
        $this->user = $user;
        $this->contest = $contest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.winnerchose')
            ->with(['user' => $this->user, 'contest' => $this->contest]);
    }
}
