<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $contactName;
    public $contactEmail;
    public $contactPhone;
    public $contactMessage;

    public function __construct(string $name, string $email, ?string $phone, string $message)
    {
        $this->contactName = $name;
        $this->contactEmail = $email;
        $this->contactPhone = $phone;
        $this->contactMessage = $message;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Message - Exitem',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
