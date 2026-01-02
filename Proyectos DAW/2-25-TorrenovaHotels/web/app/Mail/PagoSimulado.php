<?php

namespace App\Mail;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class PagoSimulado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $datos;
    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    /**
     * Get the message envelope.
     */
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Pago Simulado',
    //     );
    // }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        $pdf = Pdf::loadView('CorreoPDF', ['reserva' => $this->datos]);
    
        return $this->view('CorreoPDF')
                    ->with('reserva', $this->datos)
                    ->attachData($pdf->output(), "reserva.pdf", [
                        'mime' => 'application/pdf',
                    ]);

    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
