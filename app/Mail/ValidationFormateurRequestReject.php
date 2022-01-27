<?php

namespace App\Mail;

use App\Models\RequestFormateur;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ValidationFormateurRequestReject extends Mailable
{
    use Queueable, SerializesModels;
    public $demande;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(RequestFormateur $demande)
    {
        $this->demande = $demande;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Votre rendez-vous a été validé";
        return $this->subject($subject)->view('admin.mail.validationFormateurRequestReject');
    }
}
