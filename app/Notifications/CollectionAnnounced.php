<?php

namespace App\Notifications;

use App\Models\BloodCollection;
use App\Models\Donor;
use App\Notifications\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CollectionAnnounced extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public BloodCollection $collection) {}

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
            ->subject('Une collecte DS.CI est prévue près de chez vous')
            ->greeting('Bonjour '.$notifiable->first_name.',')
            ->line($this->collection->title)
            ->line($this->collection->location.($this->collection->address ? ' — '.$this->collection->address : ''))
            ->line('Date : '.$this->collection->starts_at->format('d/m/Y à H\hi'))
            ->line('Cette notification ne confirme pas votre aptitude au don. L’équipe médicale vous accompagnera sur place.');
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
            'message' => 'Collecte DS.CI : '.$this->collection->title.' — '.$this->collection->location.', '.$this->collection->starts_at->format('d/m/Y à H\hi').'. Aptitude évaluée sur place par l’équipe médicale.',
        ];
    }
}
