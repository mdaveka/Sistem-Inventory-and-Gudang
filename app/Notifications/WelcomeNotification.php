<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Selamat Bergabung di DANGGU!')
                    ->greeting('Halo, ' . $this->user->name . '!')
                    ->line('Selamat! Akun Anda telah berhasil dibuat di Sistem Manajemen Inventory DANGGU.')
                    ->line('Sekarang Anda sudah resmi terdaftar dan dapat menggunakan seluruh layanan yang tersedia di dalam sistem kami.')
                    ->line('Terima kasih telah bergabung bersama kami!');
    }
}