<?php

namespace Database\Factories;

use App\Models\BloodCollection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BloodCollection>
 */
class BloodCollectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Collecte de sang DS.CI',
            'location' => fake()->city(),
            'address' => fake()->streetAddress(),
            'starts_at' => now()->addDays(7),
            'notification_at' => now()->subMinute(),
            'notifications_queued_at' => null,
        ];
    }
}
