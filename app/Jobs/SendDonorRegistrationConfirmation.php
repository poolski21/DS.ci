<?php

namespace App\Jobs;

use App\Models\Donor;
use App\Notifications\DonorRegistrationConfirmed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendDonorRegistrationConfirmation implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    /**
     * @var array<int, int>
     */
    public array $backoff = [60, 300, 900];

    public function __construct(public int $donorId) {}

    public function handle(): void
    {
        Donor::query()->findOrFail($this->donorId)
            ->notify(new DonorRegistrationConfirmed);
    }
}
