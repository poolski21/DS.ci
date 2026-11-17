<?php

namespace App\Services;

use Carbon\CarbonImmutable;

class DonorEligibility
{
    /**
     * @param  array<string, bool|null>  $answers
     * @return array{status: string, message: string, eligible_from: string|null}
     */
    public function assess(
        CarbonImmutable $birthDate,
        int $weightKg,
        ?CarbonImmutable $lastDonationDate,
        array $answers,
    ): array {
        $today = CarbonImmutable::today();
        $rules = config('donor.eligibility');
        $eligibleFrom = null;

        if ($birthDate->age < $rules['minimum_age']) {
            $eligibleFrom = $birthDate->addYears($rules['minimum_age'])->toDateString();

            return [
                'status' => 'not_yet_old_enough',
                'message' => 'Vous pourrez envisager un don à partir du '.CarbonImmutable::parse($eligibleFrom)->format('d/m/Y').', sous réserve de l’avis du médecin.',
                'eligible_from' => $eligibleFrom,
            ];
        }

        if ($birthDate->age > $rules['maximum_age']) {
            return [
                'status' => 'not_eligible',
                'message' => 'Selon les repères indicatifs, vous ne semblez pas éligible aujourd’hui. Un médecin pourra confirmer votre situation.',
                'eligible_from' => null,
            ];
        }

        if ($weightKg < $rules['minimum_weight_kg']) {
            return [
                'status' => 'not_eligible',
                'message' => 'Selon les repères indicatifs, vous ne semblez pas éligible aujourd’hui. Un médecin pourra confirmer votre situation.',
                'eligible_from' => null,
            ];
        }

        if (in_array(true, $answers, true)) {
            return [
                'status' => 'medical_review',
                'message' => 'Merci pour votre transparence. L’équipe médicale pourra échanger avec vous avant le don.',
                'eligible_from' => null,
            ];
        }

        if ($lastDonationDate !== null) {
            $eligibleDate = $lastDonationDate->addDays($rules['donation_interval_days']);

            if ($eligibleDate->greaterThan($today)) {
                $eligibleFrom = $eligibleDate->toDateString();

                return [
                    'status' => 'deferred',
                    'message' => 'Vous pourrez envisager un nouveau don à partir du '.$eligibleDate->format('d/m/Y').'.',
                    'eligible_from' => $eligibleFrom,
                ];
            }
        }

        return [
            'status' => 'eligible',
            'message' => 'Vous semblez éligible. La décision finale revient toujours au médecin lors de la collecte.',
            'eligible_from' => null,
        ];
    }
}
