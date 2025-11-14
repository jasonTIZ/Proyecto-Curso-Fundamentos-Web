<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Negocio;

class ContactBusinessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $negocio;
    public $contactData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Negocio $negocio, array $contactData)
    {
        $this->negocio = $negocio;
        $this->contactData = $contactData;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contacto desde el Directorio Comercial: ' . $this->contactData['nombre_interesado'],
            replyTo: $this->contactData['correo_interesado'],
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_business',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments(): array
    {
        return [];
    }
}
