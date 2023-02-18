<?php

namespace App\Mail;

use App\VerificationToken;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendVerificationToken extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var VerificationToken
     */
    public $token;

    /**
     * SendVerificationToken constructor.
     *
     * @param VerificationToken $token
     */
    public function __construct(VerificationToken $token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Please verify your email')
            ->view('email.auth.verification');

    }
}
