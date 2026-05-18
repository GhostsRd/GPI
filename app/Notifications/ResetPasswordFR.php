<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class ResetPasswordFR extends ResetPassword
{
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject(Lang::get('Réinitialisation du mot de passe'))
            ->greeting('Bonjour !')
            ->line(Lang::get('Vous recevez cet e-mail car nous avons reçu une demande de réinitialisation du mot de passe pour votre compte.'))
            ->action(Lang::get('Réinitialiser le mot de passe'), $url)
            ->line(Lang::get('Ce lien de réinitialisation expirera dans :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
            ->line(Lang::get("Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune action supplémentaire n'est requise."))
            ->salutation('Cordialement, L\'équipe GPI');
    }
}
