<?php

namespace App\Notifications;

use App\Models\Donor;
use App\Notifications\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DonorRegistrationConfirmed extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return match ($notifiable->preferred_channel) {
            'email' => ['mail'],
            'sms', 'whatsapp' => [SmsChannel::class],
            default => [],
        };
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre inscription DS.CI est confirmée')
            ->greeting('Bonjour '.$notifiable->first_name.',')
            ->line('Merci de rejoindre la communauté des donneurs DS.CI.')
            ->line('Nous vous préviendrons lorsqu’une prochaine collecte sera disponible.')
            ->line('Le pré-contrôle en ligne est indicatif. La décision finale revient au médecin lors de la collecte.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toSms(Donor $notifiable): array
    {
        return [
            'channel' => $notifiable->preferred_channel,
            'message' => 'Merci pour votre inscription DS.CI. Nous vous informerons de la prochaine collecte. La décision finale d’aptitude revient au médecin.',
        ];
    }
}
