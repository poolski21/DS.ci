@php
    $initialStep = max(1, min(2, (int) session('registration_step', 1)));
    $screeningQuestions = [
        ['key' => 'recent_fever_or_infection', 'label' => 'Avez-vous eu récemment de la fièvre ou une infection ?'],
        ['key' => 'chronic_condition', 'label' => 'Avez-vous une maladie chronique ?'],
        ['key' => 'current_treatment', 'label' => 'Suivez-vous actuellement un traitement médical ?'],
        ['key' => 'recent_surgery_or_transfusion', 'label' => 'Avez-vous eu récemment une intervention chirurgicale ou une transfusion ?'],
    ];
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0d0d0f">
    <meta name="color-scheme" content="light dark">
    <meta name="description" content="Inscrivez-vous pour être prévenu des prochaines collectes de sang DS.CI.">
    <title>Devenir donneur — DS.CI</title>
    <link rel="stylesheet" href="{{ asset('css/donor-registration.css') }}">
</head>
<body>
    <a class="skip-link" href="#registration-title">Aller au formulaire</a>
    <div class="ambient-drops" aria-hidden="true">
        <span style="--drop-left: 8%; --drop-duration: 13s; --drop-delay: -7s"></span>
        <span style="--drop-left: 27%; --drop-duration: 16s; --drop-delay: -2s"></span>
        <span style="--drop-left: 72%; --drop-duration: 14s; --drop-delay: -10s"></span>
        <span style="--drop-left: 91%; --drop-duration: 17s; --drop-delay: -5s"></span>
    </div>

    <header class="registration-header">
        <a class="registration-brand" href="{{ route('home') }}" aria-label="DS.CI — accueil">
            <img src="{{ asset('images/dsci-logo.jpg') }}" alt="" width="42" height="42">
            <svg class="brand-drop" viewBox="0 0 32 40" aria-hidden="true">
                <path d="M16 1C13 8 3 18 3 26a13 13 0 0 0 26 0C29 18 19 8 16 1Z" fill="currentColor"/>
                <path d="M10 27a6 6 0 0 0 6 6" fill="none" stroke="#fff" stroke-linecap="round" stroke-width="2.5" opacity=".8"/>
            </svg>
            <span class="registration-brand-copy"><strong>DS.CI</strong><small>Un geste simple, une vie sauvée.</small></span>
        </a>
        <a class="header-back" href="{{ route('home') }}">Retour à l’accueil</a>
    </header>

    <section class="ambulance-stage" data-ambulance-scene hidden aria-hidden="true">
        <div class="ambulance-road" aria-hidden="true">
            <svg class="ambulance" data-ambulance viewBox="0 0 560 280" role="img" aria-label="Une ambulance DS.CI apporte votre formulaire d’inscription">
                <defs>
                    <linearGradient id="van-body" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0" stop-color="#fffefa"/>
                        <stop offset="1" stop-color="#d9d4d1"/>
                    </linearGradient>
                    <filter id="soft-shadow" x="-30%" y="-50%" width="160%" height="200%">
                        <feGaussianBlur stdDeviation="9"/>
                    </filter>
                </defs>
                <ellipse cx="282" cy="219" rx="226" ry="15" fill="#000" opacity=".58" filter="url(#soft-shadow)"/>
                <g class="vehicle-body">
                    <path d="M56 59Q56 42 73 42h319q14 0 21 13l31 47h60q29 0 36 29l8 40q3 15-12 15H50q-13 0-13-15V76q0-17 19-17Z" fill="url(#van-body)" stroke="#d4cbca" stroke-width="3"/>
                    <path d="M421 101h67q20 0 25 22l7 28H421Z" fill="#17252d"/>
                    <path d="M428 108h57q11 0 14 13l4 19h-75Z" fill="#abd0db"/>
                    <path d="M67 52h326" stroke="#ad2028" stroke-width="9" stroke-linecap="round"/>
                    <path d="M45 155h448" stroke="#ad2028" stroke-width="8"/>
                    <rect x="176" y="73" width="104" height="70" rx="8" fill="#fff" stroke="#d4cbca" stroke-width="2"/>
                    <path d="M220 84h17v18h18v17h-18v18h-17v-18h-18v-17h18Z" fill="#b71c1c"/>
                    <rect x="288" y="112" width="76" height="5" rx="2.5" fill="#7b1019" opacity=".85"/>
                    <rect x="288" y="124" width="52" height="4" rx="2" fill="#7b1019" opacity=".48"/>
                    <g data-rear-door>
                        <path d="M52 72h74v78H52Z" fill="#f3efeb" stroke="#cfc8c4" stroke-width="2"/>
                        <path d="M82 88h13v13h13v13H95v13H82v-13H69v-13h13Z" fill="#b71c1c"/>
                        <rect x="119" y="105" width="5" height="24" rx="2.5" fill="#9e9894"/>
                    </g>
                    <path d="M402 105v47" stroke="#a9a09c" stroke-width="3"/>
                    <circle cx="508" cy="158" r="6" fill="#ffd275"/>
                    <rect x="59" y="27" width="72" height="16" rx="6" fill="#262428"/>
                    <rect x="66" y="30" width="25" height="10" rx="4" fill="#e64045" data-siren-red/>
                    <rect x="99" y="30" width="25" height="10" rx="4" fill="#438df0" data-siren-blue/>
                    <circle class="wheel" cx="137" cy="187" r="31" fill="#19191d"/>
                    <circle cx="137" cy="187" r="16" fill="#979398"/>
                    <circle cx="137" cy="187" r="6" fill="#e7e2de"/>
                    <circle class="wheel" cx="402" cy="187" r="31" fill="#19191d"/>
                    <circle cx="402" cy="187" r="16" fill="#979398"/>
                    <circle cx="402" cy="187" r="6" fill="#e7e2de"/>
                    <path d="M53 164h17" stroke="#fff4e8" stroke-width="8" stroke-linecap="round"/>
                    <path d="M512 160h14" stroke="#fff4e8" stroke-width="8" stroke-linecap="round"/>
                    <g class="paramedic paramedic-orange" data-paramedic>
                        <path d="M-8 -3q8-10 16 0v3H-8Z" fill="#fff" stroke="#d7d1ce" stroke-width="1"/>
                        <circle cy="0" r="6" fill="#bd7c4a"/>
                        <path d="M0 8v22" fill="none" stroke="#ed8b36" stroke-width="5" stroke-linecap="round"/>
                        <path d="M-2 23h4" stroke="#fff" stroke-width="3"/>
                        <g class="paramedic-arm paramedic-arm-left" transform="translate(0 13)"><path d="M0 0-8 9" fill="none" stroke="#ed8b36" stroke-width="5" stroke-linecap="round"/></g>
                        <g class="paramedic-arm paramedic-arm-right" transform="translate(0 13)"><path d="M0 0 8 9" fill="none" stroke="#ed8b36" stroke-width="5" stroke-linecap="round"/></g>
                        <g class="paramedic-leg paramedic-leg-left" transform="translate(0 29)"><path d="M0 0-8 12" fill="none" stroke="#ed8b36" stroke-width="5" stroke-linecap="round"/></g>
                        <g class="paramedic-leg paramedic-leg-right" transform="translate(0 29)"><path d="M0 0 8 12" fill="none" stroke="#ed8b36" stroke-width="5" stroke-linecap="round"/></g>
                    </g>
                    <g class="paramedic paramedic-blue" data-paramedic>
                        <path d="M-8 -3q8-10 16 0v3H-8Z" fill="#fff" stroke="#d7d1ce" stroke-width="1"/>
                        <circle cy="0" r="6" fill="#bd7c4a"/>
                        <path d="M0 8v22" fill="none" stroke="#4387c7" stroke-width="5" stroke-linecap="round"/>
                        <path d="M-2 23h4" stroke="#fff" stroke-width="3"/>
                        <g class="paramedic-arm paramedic-arm-left" transform="translate(0 13)"><path d="M0 0-8 9" fill="none" stroke="#4387c7" stroke-width="5" stroke-linecap="round"/></g>
                        <g class="paramedic-arm paramedic-arm-right" transform="translate(0 13)"><path d="M0 0 8 9" fill="none" stroke="#4387c7" stroke-width="5" stroke-linecap="round"/></g>
                        <g class="paramedic-leg paramedic-leg-left" transform="translate(0 29)"><path d="M0 0-8 12" fill="none" stroke="#4387c7" stroke-width="5" stroke-linecap="round"/></g>
                        <g class="paramedic-leg paramedic-leg-right" transform="translate(0 29)"><path d="M0 0 8 12" fill="none" stroke="#4387c7" stroke-width="5" stroke-linecap="round"/></g>
                    </g>
                    <g class="form-sheet" data-form-sheet>
                        <rect x="52" y="153" width="82" height="62" rx="4" fill="#fffefa" stroke="#b71c1c" stroke-width="3"/>
                        <path d="M65 169h54m-54 11h43m-43 11h47m-47 11h30" stroke="#777" stroke-width="3" stroke-linecap="round"/>
                        <path d="M104 153v15h15" fill="#f3d9d7" stroke="#b71c1c" stroke-width="2"/>
                    </g>
                </g>
            </svg>
        </div>
    </section>

    <main
        class="registration-page"
        data-registration-app
        data-initial-step="{{ $initialStep }}"
        data-minimum-age="{{ $eligibilityRules['minimum_age'] }}"
        data-maximum-age="{{ $eligibilityRules['maximum_age'] }}"
        data-minimum-weight="{{ $eligibilityRules['minimum_weight_kg'] }}"
        data-interval-days="{{ $eligibilityRules['donation_interval_days'] }}"
    >
        <div class="registration-error-summary" role="alert" @if ($errors->isEmpty()) hidden @endif>
            <strong>Quelques informations sont à vérifier :</strong>
        </div>

        <section class="registration-card" id="registration-card" aria-label="Inscription donneur">
            <section class="registration-intro" aria-labelledby="registration-title">
                <p class="eyebrow">Le don de sang, simplement</p>
                <h1 id="registration-title" tabindex="-1"><span class="title-emoji" aria-hidden="true">🩸</span> Un geste simple, <span>une vie sauvée.</span></h1>
                <p>Inscrivez-vous pour être prévenu de la prochaine collecte près de chez vous.</p>
            </section>

            <ol class="registration-steps" aria-label="Étapes de l’inscription">
                <li class="is-current" data-step-indicator="1" aria-current="step"><span>01</span>Médical</li>
                <li data-step-indicator="2"><span>02</span>Personnel</li>
                <li data-step-indicator="3"><span>03</span>Confirmation</li>
            </ol>

            <div class="progress-heading">
                <span data-progress-label>Étape {{ $initialStep }} sur 3</span>
                <span>Vos informations restent confidentielles</span>
            </div>
            <div class="progress-track" role="progressbar" aria-label="Progression de l’inscription" aria-valuemin="1" aria-valuemax="3" aria-valuenow="{{ $initialStep }}" data-progress>
                <span data-progress-fill></span>
            </div>

            <form id="donor-registration-form" method="POST" action="{{ route('donors.store') }}" novalidate>
                @csrf

                <section class="form-step" data-step="1" aria-labelledby="step-one-title">
                    <p class="step-kicker">01 — Pré-contrôle indicatif</p>
                    <h2 id="step-one-title" tabindex="-1"><span class="title-emoji" aria-hidden="true">🩸</span> Quelques questions sur votre santé.</h2>
                    <p class="step-description">Ces réponses aident l’équipe à vous orienter. Elles sont chiffrées et ne remplacent jamais l’avis d’un médecin.</p>

                    <div class="field-grid">
                        <div class="field">
                            <label for="birth_date">Date de naissance</label>
                            <input id="birth_date" name="birth_date" type="date" autocomplete="bday" max="{{ now()->subDay()->toDateString() }}" required data-completion-field aria-describedby="birth_date-error">
                            <p class="field-error" id="birth_date-error" data-field-error="birth_date" @error('birth_date') data-server-error @enderror>@error('birth_date'){{ $message }}@enderror</p>
                        </div>
                        <div class="field">
                            <label for="weight_kg">Poids (kg)</label>
                            <input id="weight_kg" name="weight_kg" type="number" inputmode="numeric" min="20" max="300" step="1" placeholder="Ex. 62" required data-completion-field aria-describedby="weight_kg-error">
                            <p class="field-error" id="weight_kg-error" data-field-error="weight_kg" @error('weight_kg') data-server-error @enderror>@error('weight_kg'){{ $message }}@enderror</p>
                        </div>
                        <div class="field">
                            <label for="sex">Sexe</label>
                            <select id="sex" name="sex" required data-completion-field aria-describedby="sex-error">
                                <option value="">Choisir une option</option>
                                <option value="female">Femme</option>
                                <option value="male">Homme</option>
                                <option value="other">Autre</option>
                                <option value="prefer_not_to_say">Je préfère ne pas répondre</option>
                            </select>
                            <p class="field-error" id="sex-error" data-field-error="sex" @error('sex') data-server-error @enderror>@error('sex'){{ $message }}@enderror</p>
                        </div>
                        <div class="field">
                            <label for="blood_group">Groupe sanguin</label>
                            <select id="blood_group" name="blood_group" required aria-describedby="blood_group-error">
                                <option value="unknown" selected>Je ne sais pas</option>
                                <option>A+</option><option>A-</option>
                                <option>B+</option><option>B-</option>
                                <option>AB+</option><option>AB-</option>
                                <option>O+</option><option>O-</option>
                            </select>
                            <p class="field-error" id="blood_group-error" data-field-error="blood_group" @error('blood_group') data-server-error @enderror>@error('blood_group'){{ $message }}@enderror</p>
                        </div>
                        <div class="field field-full">
                            <label for="last_donation_date">Date de votre dernier don <span>(facultatif)</span></label>
                            <input id="last_donation_date" name="last_donation_date" type="date" max="{{ now()->toDateString() }}" aria-describedby="last_donation_date-help last_donation_date-error">
                            <p class="field-help" id="last_donation_date-help">Facultatif. Laissez vide si vous n’avez encore jamais donné.</p>
                            <p class="field-error" id="last_donation_date-error" data-field-error="last_donation_date" @error('last_donation_date') data-server-error @enderror>@error('last_donation_date'){{ $message }}@enderror</p>
                        </div>
                    </div>

                    <fieldset class="question-list">
                        <legend>Pour mieux vous orienter</legend>
                        @foreach ($screeningQuestions as $question)
                            <fieldset class="yes-no-question" data-completion-group>
                                <legend>{{ $question['label'] }}</legend>
                                <div class="radio-options" role="group" aria-label="{{ $question['label'] }}">
                                    <label><input type="radio" name="{{ $question['key'] }}" value="0" required aria-describedby="{{ $question['key'] }}-error"><span>Non</span></label>
                                    <label><input type="radio" name="{{ $question['key'] }}" value="1" required aria-describedby="{{ $question['key'] }}-error"><span>Oui</span></label>
                                </div>
                                <p class="field-error" id="{{ $question['key'] }}-error" data-field-error="{{ $question['key'] }}" @error($question['key']) data-server-error @enderror>@error($question['key']){{ $message }}@enderror</p>
                            </fieldset>
                        @endforeach
                        <fieldset class="yes-no-question" data-pregnancy-question data-completion-group hidden>
                            <legend>Êtes-vous enceinte ou allaitez-vous actuellement ?</legend>
                            <div class="radio-options" role="group" aria-label="Grossesse ou allaitement">
                                <label><input type="radio" name="pregnancy_or_breastfeeding" value="0" aria-describedby="pregnancy_or_breastfeeding-error"><span>Non</span></label>
                                <label><input type="radio" name="pregnancy_or_breastfeeding" value="1" aria-describedby="pregnancy_or_breastfeeding-error"><span>Oui</span></label>
                            </div>
                            <p class="field-error" id="pregnancy_or_breastfeeding-error" data-field-error="pregnancy_or_breastfeeding" @error('pregnancy_or_breastfeeding') data-server-error @enderror>@error('pregnancy_or_breastfeeding'){{ $message }}@enderror</p>
                        </fieldset>
                    </fieldset>

                    <aside class="eligibility-result" data-eligibility-result aria-live="polite">
                        <span class="result-icon" data-eligibility-icon aria-hidden="true">…</span>
                        <div>
                            <strong data-eligibility-title>Votre pré-contrôle apparaîtra ici.</strong>
                            <p data-eligibility-message>Il s’agit d’une indication. Le médecin de la collecte prend toujours la décision finale.</p>
                        </div>
                    </aside>

                    <p class="medical-disclaimer">Repères indicatifs à confirmer auprès du CNTS-CI. Ce questionnaire ne pose aucun diagnostic et ne garantit pas l’aptitude au don ; un médecin évaluera votre situation lors de la collecte.</p>
                    <div class="step-actions step-actions-end">
                        <button class="button button-progress" type="button" data-next data-progress-button data-step-button="1" data-progress-label="Continuer" disabled aria-label="Continuer — 0 % complété">
                            <span class="button-progress-content">Continuer <span aria-hidden="true">→</span> <small data-completion-value aria-hidden="true">0 %</small></span>
                        </button>
                    </div>
                </section>

                <section class="form-step" data-step="2" aria-labelledby="step-two-title" hidden>
                    <p class="step-kicker">02 — Pour vous contacter</p>
                    <h2 id="step-two-title" tabindex="-1"><span class="title-emoji" aria-hidden="true">🩸</span> Comment pouvons-nous vous joindre ?</h2>
                    <p class="step-description">Nous utiliserons ces informations uniquement pour gérer votre inscription et vous prévenir des collectes.</p>

                    <div class="field-grid">
                        <div class="field">
                            <label for="first_name">Prénom</label>
                            <input id="first_name" name="first_name" type="text" autocomplete="given-name" maxlength="100" required data-completion-field aria-describedby="first_name-error">
                            <p class="field-error" id="first_name-error" data-field-error="first_name" @error('first_name') data-server-error @enderror>@error('first_name'){{ $message }}@enderror</p>
                        </div>
                        <div class="field">
                            <label for="last_name">Nom</label>
                            <input id="last_name" name="last_name" type="text" autocomplete="family-name" maxlength="100" required data-completion-field aria-describedby="last_name-error">
                            <p class="field-error" id="last_name-error" data-field-error="last_name" @error('last_name') data-server-error @enderror>@error('last_name'){{ $message }}@enderror</p>
                        </div>
                        <div class="field field-full">
                            <label for="phone">Téléphone</label>
                            <div class="phone-input">
                                <span aria-hidden="true">+225</span>
                                <input id="phone" name="phone" type="tel" inputmode="numeric" autocomplete="tel-national" minlength="10" maxlength="10" pattern="[0-9]{10}" placeholder="0700000000" required data-completion-field aria-describedby="phone-help phone-error">
                            </div>
                            <p class="field-help" id="phone-help">Saisissez les 10 chiffres, sans l’indicatif +225.</p>
                            <p class="field-error" id="phone-error" data-field-error="phone" @error('phone') data-server-error @enderror>@error('phone'){{ $message }}@enderror</p>
                        </div>
                        <div class="field field-full">
                            <label for="email">E-mail <span>(facultatif, sauf si vous choisissez l’e-mail)</span></label>
                            <input id="email" name="email" type="email" autocomplete="email" maxlength="254" data-completion-email aria-describedby="email-error">
                            <p class="field-error" id="email-error" data-field-error="email" @error('email') data-server-error @enderror>@error('email'){{ $message }}@enderror</p>
                        </div>
                        <div class="field field-full">
                            <label for="location">Lieu de résidence</label>
                            <input id="location" name="location" type="text" autocomplete="address-level2" maxlength="180" placeholder="Commune, ville ou quartier" required data-completion-field aria-describedby="location-error">
                            <p class="field-error" id="location-error" data-field-error="location" @error('location') data-server-error @enderror>@error('location'){{ $message }}@enderror</p>
                        </div>
                        <div class="field field-full">
                            <fieldset class="channel-fieldset">
                                <legend>Canal de notification préféré</legend>
                                <div class="channel-options">
                                    <label><input type="radio" name="preferred_channel" value="sms" required checked><span>SMS</span></label>
                                    <label><input type="radio" name="preferred_channel" value="whatsapp" required><span>WhatsApp</span></label>
                                    <label><input type="radio" name="preferred_channel" value="email" required><span>E-mail</span></label>
                                </div>
                                <p class="field-help">SMS est sélectionné par défaut ; vous pouvez choisir un autre canal.</p>
                            </fieldset>
                            <p class="field-error" id="preferred_channel-error" data-field-error="preferred_channel" @error('preferred_channel') data-server-error @enderror>@error('preferred_channel'){{ $message }}@enderror</p>
                        </div>
                    </div>

                    <div class="consent-block">
                        <label class="consent-label" for="consent">
                            <input id="consent" name="consent" type="checkbox" value="1" required data-completion-field aria-describedby="consent-help consent-error">
                            <span>J’accepte que DS.CI utilise mes informations pour gérer mon inscription et m’envoyer les notifications de collecte sur le canal choisi.</span>
                        </label>
                        <p class="field-help" id="consent-help">Vous pouvez demander l’accès, la rectification ou la suppression de vos données auprès de DS.CI. Les modalités et le responsable de traitement doivent être précisés dans les mentions légales.</p>
                        <p class="field-error" id="consent-error" data-field-error="consent" @error('consent') data-server-error @enderror>@error('consent'){{ $message }}@enderror</p>
                        <p class="privacy-note">Traitement encadré par la loi ivoirienne n° 2013-450 du 19 juin 2013. Les informations de santé du pré-contrôle sont chiffrées. Ne saisissez aucune pièce d’identité.</p>
                    </div>

                    <div class="honeypot" aria-hidden="true">
                        <label for="website">Ne pas remplir</label>
                        <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="step-actions">
                        <button class="button button-secondary" type="button" data-previous><span aria-hidden="true">←</span> Retour</button>
                        <button class="button button-progress" type="submit" data-progress-button data-step-button="2" data-progress-label="Valider mon inscription" disabled aria-label="Valider mon inscription — 0 % complété">
                            <span class="button-progress-content">Valider mon inscription <span aria-hidden="true">→</span> <small data-completion-value aria-hidden="true">0 %</small></span>
                        </button>
                    </div>
                </section>
            </form>
        </section>

        <p class="registration-footnote">Le don est volontaire et gratuit. L’inscription ne vaut pas confirmation d’aptitude.</p>
    </main>

    <button class="skip-animation" type="button" data-skip-animation hidden>Passer l’animation</button>

    <script src="{{ asset('js/donor-registration.js') }}" defer></script>
</body>
</html>
