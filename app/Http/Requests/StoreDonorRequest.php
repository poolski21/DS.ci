<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreDonorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->filled('website')) {
            return ['website' => ['nullable', 'string', 'max:255']];
        }

        return [
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'regex:/^[0-9]{10}$/D', Rule::unique('donors', 'phone')],
            'email' => [
                Rule::requiredIf($this->input('preferred_channel') === 'email'),
                'nullable',
                'email',
                'max:254',
            ],
            'preferred_channel' => ['required', Rule::in(['sms', 'whatsapp', 'email'])],
            'location' => ['required', 'string', 'max:180'],
            'birth_date' => ['required', 'date', 'before:today'],
            'weight_kg' => ['required', 'integer', 'min:20', 'max:300'],
            'sex' => ['required', Rule::in(['female', 'male', 'other', 'prefer_not_to_say'])],
            'blood_group' => ['required', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'unknown'])],
            'last_donation_date' => ['nullable', 'date', 'before_or_equal:today', 'after_or_equal:birth_date'],
            'recent_fever_or_infection' => ['required', 'boolean'],
            'chronic_condition' => ['required', 'boolean'],
            'current_treatment' => ['required', 'boolean'],
            'recent_surgery_or_transfusion' => ['required', 'boolean'],
            'pregnancy_or_breastfeeding' => [
                Rule::excludeUnless($this->input('sex') === 'female'),
                Rule::requiredIf($this->input('sex') === 'female'),
                'boolean',
            ],
            'consent' => ['accepted'],
            'website' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'Ce champ est obligatoire.',
            'required_if' => 'Ce champ est obligatoire.',
            'accepted' => 'Votre accord est nécessaire pour finaliser l’inscription.',
            'boolean' => 'Choisissez « Oui » ou « Non ».',
            'date' => 'Saisissez une date valide.',
            'before' => 'La date de naissance doit être dans le passé.',
            'before_or_equal' => 'Cette date ne peut pas être dans le futur.',
            'after_or_equal' => 'La date ne peut pas être antérieure à votre date de naissance.',
            'integer' => 'Saisissez un nombre entier.',
            'min' => 'La valeur doit être au moins de :min.',
            'max' => 'La valeur ne peut pas dépasser :max caractères.',
            'email' => 'Saisissez une adresse e-mail valide.',
            'regex' => 'Saisissez les 10 chiffres de votre numéro, sans indicatif.',
            'unique' => 'Ce numéro est déjà inscrit. Contactez-nous si vous souhaitez modifier vos préférences.',
            'in' => 'Choisissez une option dans la liste.',
            'first_name.max' => 'Le prénom ne peut pas dépasser 100 caractères.',
            'last_name.max' => 'Le nom ne peut pas dépasser 100 caractères.',
            'email.max' => 'L’adresse e-mail est trop longue.',
            'weight_kg.min' => 'Saisissez un poids valide.',
            'weight_kg.max' => 'Saisissez un poids valide.',
            'first_name.required' => 'Saisissez votre prénom.',
            'last_name.required' => 'Saisissez votre nom.',
            'phone.required' => 'Saisissez votre numéro de téléphone.',
            'email.required' => 'L’e-mail est nécessaire si vous choisissez ce canal de notification.',
            'location.required' => 'Indiquez votre lieu de résidence.',
            'birth_date.required' => 'Indiquez votre date de naissance.',
            'weight_kg.required' => 'Indiquez votre poids.',
            'sex.required' => 'Choisissez une option.',
            'blood_group.required' => 'Choisissez votre groupe sanguin, ou « Je ne sais pas ».',
            'last_donation_date.date' => 'Saisissez une date valide.',
        ];
    }

    /**
     * Avoid flashing health and contact details into the session on validation errors.
     */
    protected function failedValidation(Validator $validator): void
    {
        $personalFields = [
            'first_name',
            'last_name',
            'phone',
            'email',
            'preferred_channel',
            'location',
            'consent',
        ];
        $step = collect($validator->errors()->keys())
            ->contains(fn (string $field): bool => in_array($field, $personalFields, true))
                ? 2
                : 1;

        throw new HttpResponseException(
            redirect()
                ->route('donors.create')
                ->withErrors($validator)
                ->with('registration_step', $step)
        );
    }
}
