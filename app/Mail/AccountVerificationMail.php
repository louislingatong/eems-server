<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $mailDetails;

    /**
     * Create a new message instance.
     *
     * @param string $mailDetails
     * @return void
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
        return $this->subject('Account Verification')
            ->from('no-reply@eems.local')
            ->view('email.accountVerificationTemplate')
            ->with('details', $this->mailDetails);
    }
}
