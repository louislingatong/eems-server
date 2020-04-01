<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailDetails;

    /**
     * Create a new message instance.
     *
     * @param mixed $mailDetails
     */
    public function __construct($mailDetails)
    {
        $this->mailDetails = $mailDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->mailDetails['name'])
            ->from('no-reply@eems.test')
            ->view('email.eventTemplate')
            ->with('details', $this->mailDetails);
    }
}
