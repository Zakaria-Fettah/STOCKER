<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewUserNotification extends Notification
{
    use Queueable;

    public $email;
    public $password;

    /**
     * Create a new notification instance.
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Bienvenue sur notre plateforme')
            ->greeting('Bonjour et bienvenue !')
            ->line("Nous sommes ravis de vous accueillir sur notre plateforme.")
            ->line("Voici vos identifiants de connexion :")
            ->line("**Email :** {$this->email}")
            ->line("**Mot de passe provisoire :** {$this->password}")
            ->action('Accéder à votre compte', url('/login'))
            ->line("⚠️ Pour des raisons de sécurité, veuillez modifier votre mot de passe dès votre première connexion.")
            ->salutation('Cordialement, L’équipe de support');
    }
    

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
