<?php

namespace Database\Factories;

use App\Models\Donor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Donor>
 */
class DonorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'phone' => fake()->unique()->numerify('##########'),
            'email' => fake()->safeEmail(),
            'preferred_channel' => 'email',
            'location' => fake()->city(),
            'blood_group' => 'O+',
            'consent_at' => now(),
            'consent_version' => '2026-11',
            'screening_data' => [
                'birth_date' => '1990-01-01',
                'weight_kg' => 65,
                'sex' => 'prefer_not_to_say',
                'last_donation_date' => null,
                'answers' => [],
            ],
            'eligibility_result' => [
                'status' => 'eligible',
                'message' => 'Vous semblez éligible.',
                'eligible_from' => null,
            ],
        ];
    }
}
