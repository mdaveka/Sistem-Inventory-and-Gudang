<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Notifikasi Login - Sistem Inventory')
                    ->html('<h3>Halo ' . $this->user->name . '</h3><p>Akun kamu baru saja login ke sistem inventory.</p>');
    }
}