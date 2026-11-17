<?php

namespace App\Services;

use App\Contracts\SmsGateway;
use RuntimeException;

class UnconfiguredSmsGateway implements SmsGateway
{
    public function send(string $recipient, string $message, string $channel): void
    {
        throw new RuntimeException('La passerelle SMS/WhatsApp DS.CI doit être configurée avant l’envoi.');
    }
}
