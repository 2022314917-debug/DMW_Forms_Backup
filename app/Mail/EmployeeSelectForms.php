<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmployeeSelectForms extends Mailable
{
    use Queueable, SerializesModels;

    public $requestId;
    public $recipientName;
    public $selectedForms;

    /**
     * Create a new message instance.
     */
    public function __construct($requestId, $recipientName, array $selectedForms)
    {
        $this->requestId = $requestId;
        $this->recipientName = $recipientName;
        $this->selectedForms = $selectedForms;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Forms Required for Request #{$this->requestId}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.employee_select_forms',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
