<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClassConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nomEstudiants;
    public $mentorNom;
    public $classDetalles;
    public $mentor;

    /**
     * Create a new message instance.
     */
    public function __construct($nomEstudiants, $mentorNom, $classDetalles, $mentor)
    {
        $this->nomEstudiants = $nomEstudiants;
        $this->mentorNom = $mentorNom;
        $this->classDetalles = $classDetalles;
        // $this->mentor = $mentor;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->mentor ?
                'Nova inscripcio a la teva classe' :
                'Class Confirmation Mail'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->mentor ?
                'emails.mentorClassNotification' :
                'emails.estudiantClassNotification',
            with: [
                'nomEstudiants' => $this->nomEstudiants,
                'mentorNom' => $this->mentorNom,
                'detallesClase' => $this->classDetalles,
            ]
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
