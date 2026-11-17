<?php

namespace App\Models;

use Database\Factories\DonorFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

#[Fillable([
    'first_name',
    'last_name',
    'phone',
    'email',
    'preferred_channel',
    'location',
    'blood_group',
    'consent_at',
    'consent_version',
    'screening_data',
    'eligibility_result',
])]
#[Hidden(['blood_group', 'screening_data', 'eligibility_result'])]
class Donor extends Model
{
    /** @use HasFactory<DonorFactory> */
    use HasFactory, Notifiable;

    /**
     * Keep health details encrypted at rest and out of serialized models.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'blood_group' => 'encrypted',
            'consent_at' => 'immutable_datetime',
            'screening_data' => 'encrypted:array',
            'eligibility_result' => 'encrypted:array',
        ];
    }

    public function routeNotificationForSms(?Notification $notification = null): string
    {
        return '+225'.$this->phone;
    }
}
