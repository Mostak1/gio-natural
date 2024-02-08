<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    // public $name='';
    // public $email='';
    // public $phone='';
    // public $subject='';
    // public $message='';
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $comment;
    // public function __construct($name, $email, $phone, $subject, $message)
    public function __construct($formData)
    {
        $this->name = $formData['name'];
        $this->email = $formData['email'];
        $this->phone = $formData['phone'];
        $this->subject = $formData['subject'];
        $this->comment = $formData['comment'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Form Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-form',
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
