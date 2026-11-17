<?php

namespace Tests\Feature;

use App\Jobs\NotifyDonorOfCollection;
use App\Jobs\SendDonorRegistrationConfirmation;
use App\Models\BloodCollection;
use App\Models\Donor;
use App\Notifications\DonorRegistrationConfirmed;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class DonorRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_page_is_linked_from_the_homepage(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee(route('donors.create'));

        $this->get(route('donors.create'))
            ->assertOk()
            ->assertSee('Quelques questions sur votre santé')
            ->assertSee('data-ambulance')
            ->assertSee('Repères indicatifs à confirmer auprès du CNTS-CI')
            ->assertSee('Passer l’animation');
    }

    public function test_valid_registration_stores_encrypted_screening_data_and_queues_confirmation(): void
    {
        Queue::fake();

        $response = $this->post(route('donors.store'), $this->validPayload());
        $donor = Donor::query()->sole();

        $response->assertRedirect(route('donors.thanks'));
        $this->assertModelExists($donor);
        $this->assertSame('eligible', $donor->eligibility_result['status']);
        $this->assertSame('1990-04-12', $donor->screening_data['birth_date']);
        $this->assertNull($donor->email);

        $storedScreening = DB::table('donors')->where('id', $donor->id)->value('screening_data');
        $storedBloodGroup = DB::table('donors')->where('id', $donor->id)->value('blood_group');

        $this->assertStringNotContainsString('1990-04-12', $storedScreening);
        $this->assertNotSame('O+', $storedBloodGroup);
        Queue::assertPushed(SendDonorRegistrationConfirmation::class, fn (SendDonorRegistrationConfirmation $job): bool => $job->donorId === $donor->id);
    }

    public function test_positive_health_response_is_stored_as_a_medical_review(): void
    {
        Queue::fake();
        $payload = $this->validPayload();
        $payload['chronic_condition'] = '1';

        $this->post(route('donors.store'), $payload)->assertRedirect(route('donors.thanks'));

        $donor = Donor::query()->sole();
        $this->assertSame('medical_review', $donor->eligibility_result['status']);
        $this->assertStringContainsString('équipe médicale', $donor->eligibility_result['message']);
    }

    public function test_recent_donation_returns_the_configured_next_eligibility_date(): void
    {
        Queue::fake();
        $this->travelTo('2026-11-17 10:00:00');
        $payload = $this->validPayload();
        $payload['last_donation_date'] = '2026-10-01';

        $this->post(route('donors.store'), $payload)->assertRedirect(route('donors.thanks'));

        $this->assertSame('2026-12-30', Donor::query()->sole()->eligibility_result['eligible_from']);
    }

    public function test_age_below_the_configured_minimum_returns_a_future_date(): void
    {
        Queue::fake();
        $this->travelTo('2026-11-17 10:00:00');
        $payload = $this->validPayload();
        $payload['birth_date'] = '2009-11-18';

        $this->post(route('donors.store'), $payload)->assertRedirect(route('donors.thanks'));

        $donor = Donor::query()->sole();
        $this->assertSame('not_yet_old_enough', $donor->eligibility_result['status']);
        $this->assertSame('2027-11-18', $donor->eligibility_result['eligible_from']);
    }

    public function test_unknown_blood_group_is_retained_as_an_encrypted_choice(): void
    {
        Queue::fake();
        $payload = $this->validPayload();
        $payload['blood_group'] = 'unknown';

        $this->post(route('donors.store'), $payload)->assertRedirect(route('donors.thanks'));

        $donor = Donor::query()->sole();
        $this->assertSame('unknown', $donor->blood_group);
        $this->assertNotSame('unknown', DB::table('donors')->where('id', $donor->id)->value('blood_group'));
    }

    public function test_pregnancy_question_is_required_for_women(): void
    {
        $payload = $this->validPayload();
        unset($payload['pregnancy_or_breastfeeding']);

        $this->from(route('donors.create'))
            ->post(route('donors.store'), $payload)
            ->assertRedirect(route('donors.create'))
            ->assertSessionHasErrors('pregnancy_or_breastfeeding');

        $this->assertDatabaseCount('donors', 0);
    }

    public function test_pregnancy_question_is_not_stored_as_a_negative_answer_for_other_sexes(): void
    {
        Queue::fake();
        $payload = $this->validPayload();
        $payload['sex'] = 'male';
        unset($payload['pregnancy_or_breastfeeding']);

        $this->post(route('donors.store'), $payload)->assertRedirect(route('donors.thanks'));

        $this->assertNull(Donor::query()->sole()->screening_data['answers']['pregnancy_or_breastfeeding']);
    }

    public function test_email_is_required_when_email_is_the_preferred_channel(): void
    {
        $payload = $this->validPayload();
        $payload['preferred_channel'] = 'email';

        $this->from(route('donors.create'))
            ->post(route('donors.store'), $payload)
            ->assertRedirect(route('donors.create'))
            ->assertSessionHasErrors([
                'email' => 'L’e-mail est nécessaire si vous choisissez ce canal de notification.',
            ]);

        $this->assertDatabaseCount('donors', 0);
    }

    public function test_medical_thresholds_are_read_from_configuration(): void
    {
        Queue::fake();
        config(['donor.eligibility.minimum_weight_kg' => 70]);

        $this->post(route('donors.store'), $this->validPayload())
            ->assertRedirect(route('donors.thanks'));

        $this->assertSame('not_eligible', Donor::query()->sole()->eligibility_result['status']);
    }

    public function test_age_above_the_configured_maximum_is_stored_as_not_eligible(): void
    {
        Queue::fake();
        $this->travelTo('2026-11-17 10:00:00');
        $payload = $this->validPayload();
        $payload['birth_date'] = '1955-11-16';

        $this->post(route('donors.store'), $payload)->assertRedirect(route('donors.thanks'));

        $this->assertSame('not_eligible', Donor::query()->sole()->eligibility_result['status']);
    }

    public function test_weight_below_the_configured_minimum_is_stored_as_not_eligible(): void
    {
        Queue::fake();
        $payload = $this->validPayload();
        $payload['weight_kg'] = '49';

        $this->post(route('donors.store'), $payload)->assertRedirect(route('donors.thanks'));

        $this->assertSame('not_eligible', Donor::query()->sole()->eligibility_result['status']);
    }

    public function test_invalid_phone_and_missing_consent_do_not_store_or_flash_sensitive_input(): void
    {
        $payload = $this->validPayload();
        $payload['phone'] = '123';
        unset($payload['consent']);

        $response = $this->from(route('donors.create'))->post(route('donors.store'), $payload);

        $response->assertRedirect(route('donors.create'));
        $response->assertSessionHasErrors([
            'phone' => 'Saisissez les 10 chiffres de votre numéro, sans indicatif.',
            'consent' => 'Votre accord est nécessaire pour finaliser l’inscription.',
        ]);
        $response->assertSessionMissing('_old_input');
        $this->assertDatabaseCount('donors', 0);
    }

    public function test_honeypot_submission_returns_a_generic_success_without_registration(): void
    {
        Queue::fake();

        $this->post(route('donors.store'), ['website' => 'automated-spam'])
            ->assertRedirect(route('donors.thanks'));

        $this->assertDatabaseCount('donors', 0);
        Queue::assertNothingPushed();
    }

    public function test_due_collection_queues_a_notification_for_each_donor_once(): void
    {
        Queue::fake();
        Donor::factory()->count(2)->create();
        $collection = BloodCollection::factory()->create([
            'notification_at' => now()->subMinute(),
        ]);

        $this->artisan('donors:notify-upcoming-collections')->assertSuccessful();
        $this->artisan('donors:notify-upcoming-collections')->assertSuccessful();

        Queue::assertPushed(NotifyDonorOfCollection::class, 2);
        $this->assertNotNull($collection->fresh()->notifications_queued_at);
    }

    public function test_confirmation_email_escapes_untrusted_name_content(): void
    {
        $donor = Donor::factory()->make([
            'first_name' => "<script>alert('x')</script>",
        ]);

        $html = (new DonorRegistrationConfirmed)->toMail($donor)->render();

        $this->assertStringContainsString('&lt;script&gt;', $html);
        $this->assertStringNotContainsString("<script>alert('x')</script>", $html);
    }

    public function test_registration_is_rate_limited(): void
    {
        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->post(route('donors.store'), []);
        }

        $this->post(route('donors.store'), [])
            ->assertTooManyRequests();

        $this->assertDatabaseCount('donors', 0);
    }

    /**
     * @return array<string, string>
     */
    private function validPayload(): array
    {
        return [
            'first_name' => 'Awa',
            'last_name' => 'Kouassi',
            'phone' => '0700000001',
            'email' => '',
            'preferred_channel' => 'whatsapp',
            'location' => 'Cocody, Abidjan',
            'birth_date' => '1990-04-12',
            'weight_kg' => '65',
            'sex' => 'female',
            'blood_group' => 'O+',
            'last_donation_date' => '',
            'recent_fever_or_infection' => '0',
            'chronic_condition' => '0',
            'current_treatment' => '0',
            'recent_surgery_or_transfusion' => '0',
            'pregnancy_or_breastfeeding' => '0',
            'consent' => '1',
        ];
    }
}
