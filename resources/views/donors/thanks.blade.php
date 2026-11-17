<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0d0d0f">
    <meta name="description" content="Merci de rejoindre la communauté des donneurs DS.CI.">
    <title>Merci pour votre inscription — DS.CI</title>
    <link rel="stylesheet" href="{{ asset('css/donor-registration.css') }}">
</head>
<body>
    <a class="skip-link" href="#confirmation-title">Aller à la confirmation</a>
    <header class="registration-header">
        <a class="registration-brand" href="{{ route('home') }}" aria-label="DS.CI — accueil">
            <img src="{{ asset('images/dsci-logo.jpg') }}" alt="" width="42" height="42">
            <span>DS.CI</span>
        </a>
        <a class="header-back" href="{{ route('home') }}">Retour à l’accueil</a>
    </header>

    <main class="registration-page confirmation-page">
        <section class="registration-card confirmation-card" aria-labelledby="confirmation-title" data-confirmation>
            <ol class="registration-steps" aria-label="Étapes de l’inscription">
                <li class="is-complete"><span>01</span>Médical</li>
                <li class="is-complete"><span>02</span>Personnel</li>
                <li class="is-current" aria-current="step"><span>03</span>Confirmation</li>
            </ol>
            <div class="progress-heading">
                <span>Étape 3 sur 3</span>
                <span>Inscription terminée</span>
            </div>
            <div class="progress-track" role="progressbar" aria-label="Progression de l’inscription" aria-valuemin="1" aria-valuemax="3" aria-valuenow="3">
                <span style="width: 100%"></span>
            </div>
            <div class="confirmation-art">
                <svg viewBox="0 0 180 170" role="img" aria-labelledby="heart-title heart-description">
                    <title id="heart-title">Une goutte remplit un cœur</title>
                    <desc id="heart-description">Illustration animée de solidarité et de don.</desc>
                    <defs>
                        <clipPath id="heart-clip">
                            <path d="M90 148S22 107 22 60C22 23 67 15 90 49c23-34 68-26 68 11 0 47-68 88-68 88Z"/>
                        </clipPath>
                        <linearGradient id="heart-gradient" x1="0" x2="1" y1="0" y2="1">
                            <stop offset="0" stop-color="#e34d50"/>
                            <stop offset="1" stop-color="#94121d"/>
                        </linearGradient>
                    </defs>
                    <path d="M90 148S22 107 22 60C22 23 67 15 90 49c23-34 68-26 68 11 0 47-68 88-68 88Z" fill="#241216" stroke="#d65a60" stroke-width="3"/>
                    <g clip-path="url(#heart-clip)">
                        <rect data-heart-fill x="12" y="8" width="160" height="140" fill="url(#heart-gradient)"/>
                        <path d="M15 98q20-10 40 0t40 0 40 0 40 0" fill="none" stroke="#ff9a94" stroke-opacity=".65" stroke-width="3"/>
                    </g>
                    <path data-heart-drop d="M90 10s14 17 14 29a14 14 0 0 1-28 0C76 27 90 10 90 10Z" fill="#f06467"/>
                </svg>
            </div>
            <p class="step-kicker">03 — Un geste qui compte</p>
            <h1 id="confirmation-title" tabindex="-1">Merci !</h1>
            <p class="confirmation-message">Vous serez prévenu(e) de la prochaine collecte.</p>
            <p class="step-description">Votre inscription est bien enregistrée. L’équipe médicale évaluera toujours votre aptitude au moment du don.</p>
            <a class="button button-primary" href="{{ route('home') }}">Retour à l’accueil <span aria-hidden="true">→</span></a>
        </section>
    </main>
    <script src="{{ asset('js/donor-registration.js') }}" defer></script>
</body>
</html>
