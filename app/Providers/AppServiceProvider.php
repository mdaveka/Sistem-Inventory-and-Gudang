<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Custom Tampilan Email Reset Password DANGGU
        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            return (new MailMessage)
                ->subject('Reset Password - Sistem DANGGU')
                ->greeting('Halo, ' . $notifiable->name . '!')
                ->line('Anda menerima email ini karena kami mendapat permintaan untuk mengatur ulang (reset) password akun DANGGU Anda.')
                ->action('Reset Password Sekarang', url(route('password.reset', [
                    'token' => $token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ], false)))
                ->line('Link reset password ini akan kedaluwarsa secara otomatis dalam 60 menit.')
                ->line('Jika Anda tidak merasa meminta reset password, abaikan saja email ini. Akun Anda tetap aman.')
                ->salutation('Salam hormat, Tim DANGGU');
        });
    }
}