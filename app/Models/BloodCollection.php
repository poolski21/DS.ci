<?php

namespace App\Models;

use Database\Factories\BloodCollectionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodCollection extends Model
{
    /** @use HasFactory<BloodCollectionFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'location',
        'address',
        'starts_at',
        'notification_at',
        'notifications_queued_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'starts_at' => 'immutable_datetime',
            'notification_at' => 'immutable_datetime',
            'notifications_queued_at' => 'immutable_datetime',
        ];
    }
}
