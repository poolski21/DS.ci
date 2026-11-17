<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonorRequest;
use App\Jobs\SendDonorRegistrationConfirmation;
use App\Models\Donor;
use App\Services\DonorEligibility;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class DonorRegistrationController extends Controller
{
    public function create(): View
    {
        return view('donors.register', [
            'eligibilityRules' => config('donor.eligibility'),
        ]);
    }

    public function store(StoreDonorRequest $request, DonorEligibility $eligibility): RedirectResponse
    {
        $data = $request->validated();

        if (filled($data['website'] ?? null)) {
            return redirect()->route('donors.thanks');
        }

        $answers = [
            'recent_fever_or_infection' => (bool) $data['recent_fever_or_infection'],
            'chronic_condition' => (bool) $data['chronic_condition'],
            'current_treatment' => (bool) $data['current_treatment'],
            'recent_surgery_or_transfusion' => (bool) $data['recent_surgery_or_transfusion'],
            'pregnancy_or_breastfeeding' => isset($data['pregnancy_or_breastfeeding'])
                ? (bool) $data['pregnancy_or_breastfeeding']
                : null,
        ];

        $screeningData = [
            'birth_date' => $data['birth_date'],
            'weight_kg' => (int) $data['weight_kg'],
            'sex' => $data['sex'],
            'last_donation_date' => $data['last_donation_date'] ?? null,
            'answers' => $answers,
        ];
        $eligibilityResult = $eligibility->assess(
            CarbonImmutable::parse($data['birth_date']),
            (int) $data['weight_kg'],
            isset($data['last_donation_date'])
                ? CarbonImmutable::parse($data['last_donation_date'])
                : null,
            $answers,
        );

        $donor = Donor::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'preferred_channel' => $data['preferred_channel'],
            'location' => $data['location'],
            'blood_group' => $data['blood_group'],
            'consent_at' => now(),
            'consent_version' => config('donor.consent_version'),
            'screening_data' => $screeningData,
            'eligibility_result' => $eligibilityResult,
        ]);

        SendDonorRegistrationConfirmation::dispatch($donor->id);

        return redirect()->route('donors.thanks');
    }

    public function thanks(): View
    {
        return view('donors.thanks');
    }
}
