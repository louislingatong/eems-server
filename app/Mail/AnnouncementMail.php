<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnnouncementMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailDetails;

    /**
     * Create a new message instance.
     *
     * @param string $mailDetails
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
        return $this->subject($this->mailDetails['subject'])
            ->from('no-reply@eems.test')
            ->view('email.announcementTemplate')
            ->with('body', $this->mailDetails['body']);
    }
}
