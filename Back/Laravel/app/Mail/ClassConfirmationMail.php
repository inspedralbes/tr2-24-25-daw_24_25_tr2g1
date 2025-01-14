<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClassConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $detallesClase;

    public function __construct($detallesClase)
    {
        $this->detallesClase = $detallesClase;
    }

    public function build()
    {
        return $this->subject('Confirmació de Classe')
                    ->view('emails.estudiantClassNotification', [
                        'classDetalles' => $this->detallesClase
                    ]);
    }
}
