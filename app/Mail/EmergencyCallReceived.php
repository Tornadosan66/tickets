<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmergencyCallReceived extends Mailable
{
    use Queueable, SerializesModels;
     protected $registro;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registro)
    {
        $this->registro = $registro;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('correo.email')
            ->subject("Nuevo Ticket")
            ->with([
                "registro" => $this->registro,
            ]);
    }
}
