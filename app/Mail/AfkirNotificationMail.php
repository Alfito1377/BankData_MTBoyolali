<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AfkirNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $armadaMendekatiAfkir;

    public function __construct($armadaMendekatiAfkir)
    {
        $this->armadaMendekatiAfkir = $armadaMendekatiAfkir;
    }

    public function build()
    {
        return $this->subject('Pemberitahuan: Armada Mendekati Masa Afkir')
                    ->view('emails.afkir_notification');
    }
}
