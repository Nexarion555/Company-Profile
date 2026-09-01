<?php

namespace App\Mail;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Appointment $appointment,
        public array $company,
        public string $templateSubject,
        public string $templateBody,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->templateSubject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.appointment-status',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
