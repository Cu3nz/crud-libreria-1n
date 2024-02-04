<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactoMaillabe extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public string $nombre, public string $email, public string $contenido)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->email, $this->nombre),
            subject: 'Formulario de contacto',
        );
    }

    /**
     * Get the message content definition.
     */

    //todo Con markdown s
    public function content(): Content
    {
        return new Content(
            markdown: 'plantillasmail.plantillamark',
            with: [
                'nombre' => $this->nombre,
                'email' => $this->email,
                'contenido' => $this->contenido
            ]
        );
    }




    //todo Con la vista

    /* public function content(): Content
    {
        return new Content(
            view: 'plantillasmail.contacto',
            with:[
                'nombre' => $this -> nombre,
                'email' => $this -> email,
                'contenido' => $this -> contenido
            ]
        );
    } */

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
