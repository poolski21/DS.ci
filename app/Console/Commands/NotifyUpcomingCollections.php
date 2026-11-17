<?php

namespace App\Console\Commands;

use App\Jobs\NotifyDonorOfCollection;
use App\Models\BloodCollection;
use App\Models\Donor;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

#[Signature('donors:notify-upcoming-collections')]
#[Description('Met en file les notifications pour les collectes à venir.')]
class NotifyUpcomingCollections extends Command
{
    public function handle(): int
    {
        BloodCollection::query()
            ->whereNotNull('notification_at')
            ->where('notification_at', '<=', now())
            ->whereNull('notifications_queued_at')
            ->orderBy('notification_at')
            ->chunkById(50, function (Collection $collections): void {
                foreach ($collections as $collection) {
                    $claimed = BloodCollection::query()
                        ->whereKey($collection->id)
                        ->whereNull('notifications_queued_at')
                        ->update(['notifications_queued_at' => now()]);

                    if ($claimed !== 1) {
                        continue;
                    }

                    Donor::query()
                        ->select('id')
                        ->orderBy('id')
                        ->chunkById(200, function (Collection $donors) use ($collection): void {
                            foreach ($donors as $donor) {
                                NotifyDonorOfCollection::dispatch($donor->id, $collection->id);
                            }
                        });

                    $this->info("Notifications mises en file pour la collecte {$collection->id}.");
                }
            });

        return self::SUCCESS;
    }
}
