<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $name;
    public $verificationUrl;

    public function __construct(string $otp, string $name, string $verificationUrl)
    {
        $this->otp = $otp;
        $this->name = $name;
        $this->verificationUrl = $verificationUrl;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Password OTP - Exitem',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.auth.reset-password-otp',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
