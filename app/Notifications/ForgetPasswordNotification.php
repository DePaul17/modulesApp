<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Models\User;

class ForgetPasswordNotification extends ResetPassword
{

    public $email;

    /**
     * Create a new notification instance.
     */
    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $url = route('password.reset', [
            'token' => $this->token,
            'email' => urlencode(encrypt($this->email)),
        ]);

        return (new MailMessage)
            ->subject('Réinitialisation de votre mot de passe')
            ->markdown('mails.passwordResetEmailPage', [
                'url' => $url
            ]);
    }
}