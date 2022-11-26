<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class forgetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected String $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function envelope() : Envelope
    {
        return new Envelope(
            subject: 'Zmiana hasła w '.config('app.name'),
        );
    }

    public function content() : Content
    {
        return new Content(
            markdown: 'emails.forget-password',
            with: [
                'token' => $this->token,
            ],
        );
    }
}
