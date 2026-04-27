<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubmittedFormsSuccessfully extends Mailable
{
    use Queueable, SerializesModels;
    public $form_names;
    public $requestId;
    public $ofw_full_name;
    public $dateSubmitted;

    /**
     * Create a new message instance.
     */
    public function __construct($form_names, $requestId, $ofw_full_name, $dateSubmitted)
    {
        $this->form_names = $form_names;
        $this->requestId = $requestId;
        $this->ofw_full_name = $ofw_full_name;
        $this->dateSubmitted = $dateSubmitted;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Form Submission Successful',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.forms_submitted_success',
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
