<?php

namespace App\Notifications\Channels;

use App\Contracts\SmsGateway;
use Illuminate\Notifications\Notification;

class SmsChannel
{
    public function __construct(private SmsGateway $gateway) {}

    public function send(object $notifiable, Notification $notification): void
    {
        if (! method_exists($notification, 'toSms')) {
            throw new \LogicException('La notification doit fournir une méthode toSms().');
        }

        $message = $notification->toSms($notifiable);

        $this->gateway->send(
            $notifiable->routeNotificationFor('sms', $notification),
            $message['message'],
            $message['channel'],
        );
    }
}
