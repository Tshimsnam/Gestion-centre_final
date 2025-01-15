<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $message;
    public $codeqr; // Chemin vers le QR code
    public $lieu;
    public $prenom;
    public $nom;
    public $date;
    public $title;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $message, $codeqr, $lieu, $prenom, $nom, $date, $title)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->codeqr = $codeqr;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->date = $date;
        $this->title = $title;
    }

    public function build()
    {

        $body = str_replace('[Nom de l\'activité]', $this->title, $this->message);


        $filePath = storage_path('app/public/' . $this->codeqr);

        return $this->view('notifications.mail')
            ->subject($this->subject)
            ->with([
                'prenom' => $this->prenom,
                'nom' => $this->nom,
                'body' => $body,
                'date' => $this->date,
                'lieu' => $this->lieu,
                'image' => $filePath
            ])
            ->attach($filePath, [
                'as' => 'qrcode.png',
                'mime' => 'image/png',
            ]);
    }
}
