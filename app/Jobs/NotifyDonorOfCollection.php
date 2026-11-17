<?php

namespace App\Jobs;

use App\Models\BloodCollection;
use App\Models\Donor;
use App\Notifications\CollectionAnnounced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class NotifyDonorOfCollection implements ShouldQueue
{
    use Queueable;

    public int $tries = 3;

    /**
     * @var array<int, int>
     */
    public array $backoff = [60, 300, 900];

    public function __construct(public int $donorId, public int $collectionId) {}

    public function handle(): void
    {
        $donor = Donor::query()->findOrFail($this->donorId);
        $collection = BloodCollection::query()->findOrFail($this->collectionId);

        $donor->notify(new CollectionAnnounced($collection));
    }
}
