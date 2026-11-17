@php
    // Garder les textes, les coordonnées provisoires et les chiffres d'exemple au même endroit.
    $copy = [
        'brand' => 'DS.CI',
        'accessibility' => [
            'skip' => 'Aller au contenu',
            'navigation' => 'Navigation principale',
            'home' => 'accueil',
            'back_home' => 'retour à l’accueil',
            'scroll' => 'Faire défiler',
            'scroll_label' => 'Faire défiler vers notre mission',
            'steps' => 'Les étapes du don',
            'donor' => 'DONNEUR',
            'card_title' => 'Carte donneur',
            'card_descriptor' => 'FIDÉLITÉ · SOLIDARITÉ',
        ],
        'nav' => [
            ['label' => 'Notre mission', 'href' => '#parcours'],
            ['label' => 'Le parcours', 'href' => '#parcours'],
            ['label' => 'Les collectes', 'href' => '#collectes'],
        ],
        'hero' => [
            'eyebrow' => 'Le don de sang, simplement',
            'title_start' => 'Une goutte peut',
            'title_focus' => 'sauver',
            'title_end' => 'une vie.',
            'description' => 'En Côte d’Ivoire, chaque don compte. Rejoignez une communauté de donneurs et aidez les patients à recevoir le sang dont ils ont besoin.',
            'primary' => 'Devenir donneur',
            'secondary' => 'Découvrir le parcours',
            'note' => 'Un geste solidaire. Un accompagnement à chaque étape.',
            'visual_label' => 'Une goutte de solidarité',
        ],
        'mission' => [
            'eyebrow' => 'Ensemble, faisons la différence',
            'title' => 'Un geste simple. Un impact immense.',
            'description' => 'Le don de sang est volontaire, encadré par des professionnels et essentiel aux soins. DS.CI vous aide à trouver une collecte et à franchir le premier pas.',
            'steps' => [
                ['number' => '01', 'title' => 'Inscrivez-vous', 'description' => 'Créez votre profil et trouvez un lieu de collecte près de vous.'],
                ['number' => '02', 'title' => 'Donnez', 'description' => 'Une équipe médicale vous accompagne en toute sécurité.'],
                ['number' => '03', 'title' => 'Sauvez', 'description' => 'Votre don contribue aux soins de plusieurs patients.'],
            ],
            'bag_label' => 'Votre don fait la différence',
            'bag_note' => 'Un don peut aider jusqu’à trois patients.',
        ],
        'impact' => [
            'eyebrow' => 'La solidarité en mouvement',
            'title' => 'Chaque don fait avancer les choses.',
            'note' => 'Chiffres de démonstration — à remplacer par les données DS.CI.',
            'stats' => [
                ['value' => 12480, 'suffix' => '+', 'label' => 'donneurs engagés'],
                ['value' => 8360, 'suffix' => '+', 'label' => 'poches collectées'],
                ['value' => 25100, 'suffix' => '+', 'label' => 'vies soutenues'],
            ],
        ],
        'card' => [
            'eyebrow' => 'La fidélité récompensée',
            'title' => 'Après votre 3ᵉ don, votre carte donneur vous attend.',
            'description' => 'Merci pour votre engagement. La carte donneur DS.CI reconnaît votre fidélité et vous ouvre l’accès à des réductions partenaires sur certains soins.',
            'benefits' => [
                'Une carte personnelle après trois dons enregistrés',
                'Des réductions auprès de partenaires santé participants',
                'Un moyen simple de suivre votre engagement',
            ],
            'disclaimer' => 'Avantages et conditions à confirmer auprès des partenaires participants.',
            'cta' => 'Découvrir le parcours',
        ],
        'events' => [
            'eyebrow' => 'Près de chez vous',
            'title' => 'Les prochaines collectes.',
            'description' => 'Choisissez un créneau et prenez rendez-vous. Les informations ci-dessous sont des exemples à remplacer par le calendrier réel.',
            'cta' => 'Prendre rendez-vous',
            'items' => [
                ['day' => '12', 'month' => 'DÉC.', 'city' => 'Abidjan · Cocody', 'place' => 'Lieu de collecte à confirmer', 'time' => '09 h 00 — 15 h 00', 'status' => 'Exemple'],
                ['day' => '18', 'month' => 'DÉC.', 'city' => 'Abidjan · Yopougon', 'place' => 'Lieu de collecte à confirmer', 'time' => '08 h 30 — 14 h 30', 'status' => 'Exemple'],
                ['day' => '21', 'month' => 'DÉC.', 'city' => 'Bouaké · Centre-ville', 'place' => 'Lieu de collecte à confirmer', 'time' => '09 h 00 — 13 h 00', 'status' => 'Exemple'],
            ],
        ],
        'footer' => [
            'title' => 'Un petit geste peut tout changer.',
            'description' => 'Faites partie du mouvement. Votre prochaine bonne action est peut-être à quelques minutes.',
            'contact_title' => 'Restons en contact',
            'email' => 'contact@ds.ci',
            'contact_note' => 'Adresse e-mail à confirmer avant publication.',
            'phone_label' => 'Numéro vert',
            'phone' => '80 00 XX XX XX',
            'phone_note' => 'Numéro vert à confirmer avant publication.',
            'legal_note' => 'Éditeur, hébergeur et politique de confidentialité à renseigner avant publication.',
            'legal' => 'Mentions légales',
            'privacy' => 'Confidentialité',
            'copyright' => '© ' . date('Y') . ' DS.CI — Tous droits réservés.',
            'made' => 'Fait avec le cœur, en Côte d’Ivoire.',
        ],
    ];
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0d0d0f">
    <meta name="description" content="{{ $copy['hero']['description'] }}">
    <title>{{ $copy['brand'] }} — {{ implode(' ', [$copy['hero']['title_start'], $copy['hero']['title_focus'], $copy['hero']['title_end']]) }}</title>

    <script>
        window.tailwind = window.tailwind || {};
        window.tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        blood: '#B71C1C',
                        wine: '#5A0A12',
                        ink: '#0D0D0F',
                        paper: '#F6F1EA'
                    }
                }
            }
        };
    </script>
    <script src="https://cdn.tailwindcss.com/3.4.17" defer></script>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <style>
        :root {
            color-scheme: dark;
            --ink: #0d0d0f;
            --paper: #f6f1ea;
            --red: #b71c1c;
            --wine: #5a0a12;
            --muted: #b8adb0;
            --line: rgba(255, 255, 255, .12);
            --font: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; scroll-padding-top: 5rem; }
        body {
            margin: 0;
            background: var(--ink);
            color: var(--paper);
            font-family: var(--font);
            -webkit-font-smoothing: antialiased;
        }
        a { color: inherit; text-decoration: none; }
        button, a { -webkit-tap-highlight-color: transparent; }
        a:focus-visible, button:focus-visible {
            outline: 3px solid #ffaaa8;
            outline-offset: 4px;
        }
        .skip-link {
            position: fixed; z-index: 100; top: .75rem; left: .75rem;
            transform: translateY(-160%); background: var(--paper); color: var(--ink);
            padding: .8rem 1rem; border-radius: .75rem; font-weight: 700;
        }
        .skip-link:focus { transform: translateY(0); }
        .wrap { width: min(1160px, calc(100% - 3rem)); margin-inline: auto; }
        .eyebrow {
            display: inline-flex; align-items: center; gap: .65rem;
            color: #efaaaa; font-size: .72rem; font-weight: 750;
            letter-spacing: .16em; text-transform: uppercase;
        }
        .eyebrow::before { content: ""; width: 1.5rem; height: 1px; background: #d34b50; }
        .section-title {
            max-width: 760px; margin: 1.1rem 0 0;
            font-size: clamp(2.4rem, 5vw, 4.65rem); line-height: .99;
            letter-spacing: -.055em; font-weight: 650;
        }
        .section-copy { color: var(--muted); line-height: 1.8; max-width: 570px; }
        .button {
            min-height: 3.25rem; display: inline-flex; align-items: center; justify-content: center;
            gap: .7rem; padding: .9rem 1.25rem; border-radius: 999px;
            font-size: .9rem; font-weight: 700; transition: transform .25s ease, background .25s ease, box-shadow .25s ease;
        }
        .button:hover { transform: translateY(-3px); }
        .button-primary { background: var(--red); color: white; box-shadow: 0 10px 30px rgba(183, 28, 28, .22); }
        .button-primary:hover { background: #cb272b; box-shadow: 0 14px 34px rgba(183, 28, 28, .32); }
        .button-quiet { border: 1px solid rgba(255,255,255,.25); color: var(--paper); background: rgba(255,255,255,.03); }
        .button-quiet:hover { background: rgba(255,255,255,.09); }
        .button svg { width: 1rem; height: 1rem; }

        .hero {
            min-height: 760px; min-height: max(760px, 100svh); position: relative; overflow: hidden;
            isolation: isolate; background: radial-gradient(ellipse at 70% 38%, #501018 0%, #26090f 30%, #0d0d0f 69%);
        }
        .hero::before {
            content: ""; position: absolute; inset: 0; z-index: -1;
            background: linear-gradient(90deg, rgba(13,13,15,.93) 0%, rgba(13,13,15,.76) 42%, rgba(13,13,15,.06) 100%),
                linear-gradient(0deg, #0d0d0f 0%, transparent 32%);
        }
        .hero-canvas { position: absolute; inset: 0; z-index: -2; }
        .hero-canvas canvas { display: block; width: 100%; height: 100%; }
        .hero-header { position: relative; z-index: 2; height: 92px; display: flex; align-items: center; justify-content: space-between; }
        .brand { display: inline-flex; align-items: center; gap: .7rem; font-weight: 850; letter-spacing: .08em; }
        .brand img { width: 2.45rem; height: 2.45rem; border-radius: 50%; object-fit: cover; background: white; }
        .brand span { font-size: 1rem; }
        .nav-links { display: flex; align-items: center; gap: 2rem; color: #ddd4d3; font-size: .83rem; }
        .nav-links a:not(.button):hover { color: #fff; }
        .nav-cta { min-height: 2.8rem; padding: .7rem 1rem; font-size: .8rem; }
        .hero-content { min-height: 640px; display: flex; align-items: center; padding-bottom: 5.2rem; }
        .hero-copy { position: relative; z-index: 1; width: min(650px, 65%); padding-top: 1rem; }
        .hero h1 { font-size: clamp(3.45rem, 7.6vw, 7rem); line-height: .91; letter-spacing: -.075em; font-weight: 650; margin: 1.5rem 0; }
        .hero h1 em { color: #ef7c7b; font-style: normal; }
        .hero-description { max-width: 520px; color: #d2c8c9; font-size: clamp(1rem, 1.35vw, 1.15rem); line-height: 1.75; }
        .hero-actions { display: flex; flex-wrap: wrap; gap: .85rem; margin-top: 2rem; }
        .hero-note { display: flex; align-items: center; gap: .65rem; margin-top: 2rem; color: #c1b6b8; font-size: .82rem; }
        .hero-note svg { flex: 0 0 auto; width: 1rem; color: #ee7b7b; }
        .hero-visual-label {
            position: absolute; z-index: 1; right: 7%; bottom: 17%;
            display: flex; align-items: center; gap: .7rem; color: #e8dada; font-size: .78rem;
        }
        .hero-visual-label::before { content: ""; width: 2.2rem; height: 1px; background: #df696c; }
        .scroll-cue {
            position: absolute; z-index: 1; bottom: 2.2rem; left: 50%; transform: translateX(-50%);
            display: flex; align-items: center; gap: .75rem; color: #a99da0; font-size: .65rem;
            letter-spacing: .14em; text-transform: uppercase;
        }
        .scroll-cue::after { content: ""; width: 1px; height: 2.3rem; position: absolute; top: 1.6rem; left: 50%; background: linear-gradient(#d85359, transparent); }

        .mission { position: relative; padding: 8rem 0 7rem; background: #0d0d0f; overflow: hidden; }
        .mission::after {
            content: ""; position: absolute; right: -14rem; top: 2rem; width: 36rem; height: 36rem;
            border: 1px solid rgba(183,28,28,.12); border-radius: 50%; box-shadow: 0 0 0 4rem rgba(183,28,28,.025), 0 0 0 8rem rgba(183,28,28,.018);
            pointer-events: none;
        }
        .mission-grid { display: grid; grid-template-columns: 1fr .75fr; gap: 5rem; align-items: center; }
        .mission-intro { position: relative; z-index: 1; }
        .mission-intro .section-copy { margin-top: 1.6rem; }
        .story-card {
            position: relative; min-height: 370px; border: 1px solid rgba(255,255,255,.1); border-radius: 1.4rem;
            display: flex; align-items: center; justify-content: center; overflow: hidden;
            background: radial-gradient(ellipse at 50% 85%, rgba(183,28,28,.2), transparent 55%), linear-gradient(145deg, #171416, #101012);
        }
        .story-card::before, .story-card::after { content: ""; position: absolute; border: 1px solid rgba(255,255,255,.07); border-radius: 50%; width: 17rem; height: 17rem; }
        .story-card::after { width: 23rem; height: 23rem; }
        .story-bag { position: relative; z-index: 1; width: 148px; height: 210px; filter: drop-shadow(0 20px 35px rgba(160,15,24,.24)); }
        .story-bag__liquid {
            position: absolute; z-index: 0; left: 12%; right: 12%; bottom: 10%; height: 8%;
            border-radius: 0 0 36px 36px; background: linear-gradient(100deg, #8b101c, #e34143 50%, #8d111c);
            box-shadow: inset 0 9px 16px rgba(255,159,153,.22), 0 0 25px rgba(183,28,28,.25);
        }
        .story-bag__outline {
            position: absolute; inset: 7% 5% 2%; border: 2px solid rgba(255,255,255,.46);
            border-radius: 13px 13px 40px 40px; background: linear-gradient(120deg, rgba(255,255,255,.11), rgba(255,255,255,.015) 45%);
            clip-path: polygon(20% 0,80% 0,80% 8%,91% 8%,91% 91%,81% 100%,19% 100%,9% 91%,9% 8%,20% 8%);
        }
        .story-bag__tube { position: absolute; left: 47%; top: -4%; width: 8px; height: 22px; border: 2px solid rgba(255,255,255,.48); border-bottom: 0; }
        .story-bag__shine { position: absolute; left: 21%; top: 19%; width: 8px; height: 76px; border-radius: 99px; background: rgba(255,255,255,.28); transform: rotate(5deg); }
        .bag-caption { position: absolute; left: 1.5rem; bottom: 1.5rem; z-index: 1; }
        .bag-caption strong { display: block; font-size: .94rem; }
        .bag-caption span { color: var(--muted); font-size: .75rem; }
        .steps { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.3rem; margin-top: 4rem; position: relative; z-index: 1; }
        .step { padding: 1.4rem 1.4rem 1.2rem 0; border-top: 1px solid var(--line); }
        .step-number { color: #ed7474; font-size: .72rem; font-weight: 750; letter-spacing: .1em; }
        .step h3 { margin: 1rem 0 .45rem; font-size: 1.1rem; }
        .step p { margin: 0; color: var(--muted); line-height: 1.65; font-size: .88rem; max-width: 290px; }

        .impact { padding: 7.5rem 0; background: linear-gradient(115deg, #2c080e, #4a0d14 52%, #21090d); position: relative; overflow: hidden; }
        .impact::before { content: ""; position: absolute; width: 38rem; height: 38rem; border-radius: 50%; right: -8rem; top: -24rem; border: 1px solid rgba(255,255,255,.09); box-shadow: 0 0 0 4rem rgba(255,255,255,.018), 0 0 0 8rem rgba(255,255,255,.014); }
        .impact .section-copy { margin-top: 1.1rem; }
        .impact-note { margin-top: 1.25rem; color: #d4a9aa; font-size: .75rem; }
        .stats { position: relative; display: grid; grid-template-columns: repeat(3, 1fr); margin-top: 4rem; border-top: 1px solid rgba(255,255,255,.17); }
        .stat { padding: 2rem 1rem 0 0; }
        .stat + .stat { padding-left: 2rem; border-left: 1px solid rgba(255,255,255,.17); }
        .stat-value { display: block; font-size: clamp(2.7rem, 6vw, 5.5rem); letter-spacing: -.07em; line-height: 1; font-variant-numeric: tabular-nums; }
        .stat-label { display: block; margin-top: .9rem; color: #e2c6c6; font-size: .88rem; }

        .card-section { padding: 8rem 0; background: #f2ede7; color: #1a1718; position: relative; overflow: hidden; }
        .card-section .eyebrow { color: #9c1b23; }
        .card-section .eyebrow::before { background: #a41f28; }
        .card-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center; }
        .card-section .section-copy { color: #61585a; margin-top: 1.3rem; }
        .card-visual {
            min-height: 350px; position: relative; display: flex; align-items: center; justify-content: center;
            background: radial-gradient(ellipse at 50% 50%, #fff 0%, #e4d8d1 72%); border-radius: 1.5rem; overflow: hidden;
        }
        .donor-card {
            position: relative; z-index: 1; width: min(390px, 82%); aspect-ratio: 1.62;
            border-radius: 1.15rem; padding: 1.35rem; color: white; overflow: hidden;
            background: linear-gradient(120deg, #170d10, #681119 68%, #a6222c);
            box-shadow: 0 28px 55px rgba(51,11,15,.26); transform: rotate(-6deg);
        }
        .donor-card::after { content: ""; position: absolute; width: 15rem; height: 15rem; right: -5rem; top: -7rem; border: 1px solid rgba(255,255,255,.28); border-radius: 50%; box-shadow: 0 0 0 1.6rem rgba(255,255,255,.035), 0 0 0 3.3rem rgba(255,255,255,.025); }
        .donor-card__top { display: flex; align-items: center; justify-content: space-between; font-size: .63rem; font-weight: 750; letter-spacing: .15em; }
        .donor-card__drop { width: 2rem; height: 2rem; display: grid; place-items: center; border: 1px solid rgba(255,255,255,.3); border-radius: 50%; }
        .donor-card__drop svg { width: .9rem; height: .9rem; }
        .donor-card__title { position: absolute; left: 1.35rem; bottom: 1.45rem; font-size: 1.32rem; font-weight: 650; letter-spacing: -.03em; }
        .donor-card__number { position: absolute; bottom: 1.55rem; right: 1.35rem; color: #f7c4c0; font-size: .6rem; letter-spacing: .16em; }
        .benefits { margin: 2rem 0; padding: 0; list-style: none; display: grid; gap: .95rem; }
        .benefits li { display: flex; gap: .75rem; align-items: flex-start; color: #3e3839; font-size: .91rem; line-height: 1.55; }
        .benefits svg { width: 1.1rem; height: 1.1rem; flex: 0 0 auto; margin-top: .1rem; color: #a51d27; }
        .disclaimer { color: #756c6c; font-size: .72rem; line-height: 1.6; margin-bottom: 1.6rem; }

        .events { padding: 8rem 0; background: #111012; }
        .events-head { display: flex; justify-content: space-between; align-items: end; gap: 2rem; }
        .events-head .section-copy { margin-top: 1.1rem; }
        .event-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-top: 3.2rem; }
        .event {
            display: flex; gap: 1rem; min-height: 180px; padding: 1.4rem;
            border: 1px solid rgba(255,255,255,.1); border-radius: 1rem;
            background: linear-gradient(145deg, rgba(255,255,255,.055), rgba(255,255,255,.015));
            transition: transform .25s ease, border-color .25s ease;
        }
        .event:hover { transform: translateY(-4px); border-color: rgba(230,110,110,.48); }
        .event-date { flex: 0 0 3.6rem; height: 4rem; display: grid; align-content: center; justify-items: center; border-radius: .8rem; background: rgba(183,28,28,.17); color: #ffb0ac; }
        .event-date strong { font-size: 1.4rem; line-height: 1; }
        .event-date span { font-size: .55rem; font-weight: 800; letter-spacing: .12em; margin-top: .3rem; }
        .event-info { min-width: 0; }
        .event-status { color: #ed9696; text-transform: uppercase; letter-spacing: .13em; font-weight: 750; font-size: .58rem; }
        .event h3 { margin: .4rem 0; font-size: 1rem; }
        .event p { margin: .3rem 0; color: #b6abad; font-size: .76rem; line-height: 1.5; }
        .event-time { color: #e0d4d4 !important; }
        .events-action { margin-top: 2rem; display: flex; justify-content: center; }

        .footer { padding: 5rem 0 1.6rem; background: #09090a; }
        .footer-top { display: grid; grid-template-columns: 1.5fr 1fr 1fr; gap: 3rem; padding-bottom: 4rem; }
        .footer-top h2 { font-size: clamp(2.2rem, 4.5vw, 3.7rem); line-height: 1; letter-spacing: -.06em; max-width: 500px; margin: 1rem 0; }
        .footer-top p { color: var(--muted); max-width: 400px; line-height: 1.7; font-size: .88rem; }
        .footer-col h3 { margin: .2rem 0 1rem; color: #f5eded; font-size: .85rem; }
        .footer-col a, .footer-col span { display: block; margin: .7rem 0; color: #bcb2b4; font-size: .82rem; }
        .footer-col a:hover { color: #fff; }
        .footer-note { color: #8e8587 !important; font-size: .67rem !important; line-height: 1.5; }
        .footer-bottom { border-top: 1px solid var(--line); padding-top: 1.3rem; display: flex; justify-content: space-between; gap: 1rem; color: #8f8688; font-size: .7rem; }
        .footer-bottom p { margin: 0; }

        @media (max-width: 900px) {
            .wrap { width: min(100% - 2.5rem, 720px); }
            .hero { min-height: 780px; min-height: max(780px, 100svh); }
            .hero::before { background: linear-gradient(90deg, rgba(13,13,15,.88), rgba(13,13,15,.25)), linear-gradient(0deg, #0d0d0f, transparent 47%); }
            .hero-content { min-height: 680px; }
            .hero-copy { width: min(600px, 90%); }
            .hero-visual-label { right: 5%; bottom: 15%; }
            .mission-grid, .card-grid { grid-template-columns: 1fr; gap: 3rem; }
            .story-card { min-height: 330px; }
            .card-grid { gap: 2.5rem; }
            .card-visual { order: 2; }
            .event-grid { grid-template-columns: 1fr; }
            .event { min-height: unset; }
        }
        @media (max-width: 640px) {
            .wrap { width: calc(100% - 2rem); }
            .hero { min-height: 740px; min-height: max(740px, 100svh); }
            .hero-header { height: 76px; }
            .brand img { width: 2.1rem; height: 2.1rem; }
            .nav-links { gap: .8rem; }
            .nav-links > a:not(.button) { display: none; }
            .nav-cta { min-height: 2.55rem; padding: .65rem .85rem; font-size: .72rem; }
            .hero-content { min-height: 630px; align-items: flex-start; padding-top: 6.5rem; }
            .hero-copy { width: 100%; padding: 0; }
            .hero h1 { font-size: clamp(3.3rem, 15vw, 5.1rem); margin: 1.1rem 0; }
            .hero-description { max-width: 440px; font-size: .96rem; }
            .hero-actions { flex-direction: column; align-items: stretch; max-width: 300px; margin-top: 1.5rem; }
            .hero-actions .button { width: 100%; }
            .hero-note { max-width: 300px; font-size: .74rem; margin-top: 1.35rem; }
            .hero-visual-label { right: 1rem; bottom: 11%; font-size: .65rem; }
            .scroll-cue { bottom: 1.5rem; }
            .mission, .card-section, .events { padding: 5rem 0; }
            .section-title { font-size: clamp(2.55rem, 12vw, 4rem); }
            .mission-grid { gap: 2rem; }
            .story-card { min-height: 290px; }
            .steps { grid-template-columns: 1fr; gap: 0; margin-top: 3rem; }
            .step { display: grid; grid-template-columns: 2rem 1fr; column-gap: .8rem; padding: 1.15rem 0; }
            .step-number { grid-row: span 2; padding-top: .2rem; }
            .step h3 { margin: 0 0 .35rem; }
            .step p { max-width: none; }
            .impact { padding: 5rem 0; }
            .stats { margin-top: 2.5rem; grid-template-columns: 1fr; }
            .stat, .stat + .stat { display: flex; align-items: baseline; justify-content: space-between; gap: 1rem; padding: 1.2rem 0; border-left: 0; border-bottom: 1px solid rgba(255,255,255,.14); }
            .stat-value { font-size: 2.7rem; }
            .stat-label { margin-top: 0; text-align: right; }
            .card-visual { min-height: 280px; }
            .events-head { display: block; }
            .events-head > .button { margin-top: 1.5rem; }
            .event-grid { margin-top: 2rem; }
            .footer { padding-top: 4rem; }
            .footer-top { grid-template-columns: 1fr 1fr; gap: 2rem 1rem; padding-bottom: 2.5rem; }
            .footer-brand { grid-column: 1 / -1; }
            .footer-bottom { flex-direction: column; }
        }
        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; transition-duration: .01ms !important; }
            .hero-canvas { display: none; }
            .hero { background: radial-gradient(ellipse at 78% 42%, #54121a 0%, #25090f 35%, #0d0d0f 75%); }
        }
    </style>
</head>
<body class="bg-ink text-paper antialiased">
    <a class="skip-link" href="#contenu">{{ $copy['accessibility']['skip'] }}</a>
    <header class="hero" id="accueil">
        <div class="hero-canvas" id="hero-canvas" aria-hidden="true"></div>
        <nav class="hero-header wrap" aria-label="{{ $copy['accessibility']['navigation'] }}">
            <a class="brand" href="#accueil" aria-label="{{ $copy['brand'] }} — {{ $copy['accessibility']['home'] }}">
                <img src="{{ asset('images/dsci-logo.jpg') }}" alt="" width="44" height="44">
                <span>{{ $copy['brand'] }}</span>
            </a>
            <div class="nav-links">
                @foreach ($copy['nav'] as $item)
                    <a href="{{ $item['href'] }}">{{ $item['label'] }}</a>
                @endforeach
                <a class="button button-primary nav-cta" href="{{ route('donors.create') }}">{{ $copy['hero']['primary'] }}</a>
            </div>
        </nav>

            <section class="hero-content wrap" aria-labelledby="hero-title">
                <div class="hero-copy">
                    <span class="eyebrow">{{ $copy['hero']['eyebrow'] }}</span>
                    <h1 id="hero-title">{{ $copy['hero']['title_start'] }} <em>{{ $copy['hero']['title_focus'] }}</em> {{ $copy['hero']['title_end'] }}</h1>
                    <p class="hero-description">{{ $copy['hero']['description'] }}</p>
                    <div class="hero-actions">
                        <a class="button button-primary" href="{{ route('donors.create') }}">
                            {{ $copy['hero']['primary'] }}
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                        <a class="button button-quiet" href="#parcours">{{ $copy['hero']['secondary'] }}</a>
                    </div>
                    <p class="hero-note">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 21s-8-4.4-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 6.6-8 11-8 11Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/></svg>
                        {{ $copy['hero']['note'] }}
                    </p>
                </div>
            </section>
            <span class="hero-visual-label" aria-hidden="true">{{ $copy['hero']['visual_label'] }}</span>
            <a class="scroll-cue" href="#parcours" aria-label="{{ $copy['accessibility']['scroll_label'] }}">{{ $copy['accessibility']['scroll'] }}</a>
    </header>

    <main id="contenu">
    <section class="mission" id="parcours" aria-labelledby="mission-title">
        <div class="wrap">
            <div class="mission-grid">
                <div class="mission-intro">
                    <span class="eyebrow">{{ $copy['mission']['eyebrow'] }}</span>
                    <h2 class="section-title" id="mission-title">{{ $copy['mission']['title'] }}</h2>
                    <p class="section-copy">{{ $copy['mission']['description'] }}</p>
                </div>
                <div class="story-card" aria-label="{{ $copy['mission']['bag_label'] }}">
                    <div class="story-bag" aria-hidden="true">
                        <div class="story-bag__liquid" id="bag-liquid"></div>
                        <div class="story-bag__outline"></div>
                        <div class="story-bag__tube"></div>
                        <div class="story-bag__shine"></div>
                    </div>
                    <div class="bag-caption">
                        <strong>{{ $copy['mission']['bag_label'] }}</strong>
                        <span>{{ $copy['mission']['bag_note'] }}</span>
                    </div>
                </div>
            </div>
            <div class="steps" aria-label="{{ $copy['accessibility']['steps'] }}">
                @foreach ($copy['mission']['steps'] as $step)
                    <article class="step">
                        <span class="step-number">{{ $step['number'] }}</span>
                        <h3>{{ $step['title'] }}</h3>
                        <p>{{ $step['description'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="impact" id="impact" aria-labelledby="impact-title">
        <div class="wrap">
            <span class="eyebrow">{{ $copy['impact']['eyebrow'] }}</span>
            <h2 class="section-title" id="impact-title">{{ $copy['impact']['title'] }}</h2>
            <p class="section-copy">{{ $copy['impact']['note'] }}</p>
            <div class="stats">
                @foreach ($copy['impact']['stats'] as $stat)
                    <div class="stat">
                        <span class="stat-value" data-count="{{ $stat['value'] }}" data-suffix="{{ $stat['suffix'] }}">{{ number_format($stat['value'], 0, ',', ' ') }}{{ $stat['suffix'] }}</span>
                        <span class="stat-label">{{ $stat['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="card-section" id="carte-donneur" aria-labelledby="card-title">
        <div class="wrap card-grid">
            <div class="card-visual" aria-hidden="true">
                <div class="donor-card">
                    <div class="donor-card__top">
                        <span>{{ $copy['brand'] }} · {{ $copy['accessibility']['donor'] }}</span>
                        <span class="donor-card__drop">
                            <svg viewBox="0 0 24 24" fill="none"><path d="M12 3s6 7 6 12a6 6 0 1 1-12 0c0-5 6-12 6-12Z" fill="currentColor"/></svg>
                        </span>
                    </div>
                    <span class="donor-card__title">{{ $copy['accessibility']['card_title'] }}</span>
                    <span class="donor-card__number">{{ $copy['accessibility']['card_descriptor'] }}</span>
                </div>
            </div>
            <div>
                <span class="eyebrow">{{ $copy['card']['eyebrow'] }}</span>
                <h2 class="section-title" id="card-title">{{ $copy['card']['title'] }}</h2>
                <p class="section-copy">{{ $copy['card']['description'] }}</p>
                <ul class="benefits">
                    @foreach ($copy['card']['benefits'] as $benefit)
                        <li>
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span>{{ $benefit }}</span>
                        </li>
                    @endforeach
                </ul>
                <p class="disclaimer">{{ $copy['card']['disclaimer'] }}</p>
                <a class="button button-primary" href="#parcours">
                    {{ $copy['card']['cta'] }}
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>
    </section>

    <section class="events" id="collectes" aria-labelledby="events-title">
        <div class="wrap">
            <div class="events-head">
                <div>
                    <span class="eyebrow">{{ $copy['events']['eyebrow'] }}</span>
                    <h2 class="section-title" id="events-title">{{ $copy['events']['title'] }}</h2>
                    <p class="section-copy">{{ $copy['events']['description'] }}</p>
                </div>
                <a class="button button-quiet" href="mailto:{{ $copy['footer']['email'] }}?subject=Rendez-vous%20pour%20un%20don">
                    {{ $copy['events']['cta'] }}
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
            <div class="event-grid">
                @foreach ($copy['events']['items'] as $event)
                    <article class="event">
                        <div class="event-date" aria-label="{{ $event['day'] }} {{ $event['month'] }}">
                            <strong>{{ $event['day'] }}</strong><span>{{ $event['month'] }}</span>
                        </div>
                        <div class="event-info">
                            <span class="event-status">{{ $event['status'] }}</span>
                            <h3>{{ $event['city'] }}</h3>
                            <p>{{ $event['place'] }}</p>
                            <p class="event-time">{{ $event['time'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="events-action">
                <a class="button button-primary" href="mailto:{{ $copy['footer']['email'] }}?subject=Rendez-vous%20pour%20un%20don">
                    {{ $copy['events']['cta'] }}
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 12h14m-6-6 6 6-6 6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>
    </section>

    </main>

    <footer class="footer" id="mentions-legales">
        <div class="wrap">
            <div class="footer-top">
                <div class="footer-brand">
                    <a class="brand" href="#accueil" aria-label="{{ $copy['brand'] }} — {{ $copy['accessibility']['back_home'] }}">
                        <img src="{{ asset('images/dsci-logo.jpg') }}" alt="" width="44" height="44">
                        <span>{{ $copy['brand'] }}</span>
                    </a>
                    <h2>{{ $copy['footer']['title'] }}</h2>
                    <p>{{ $copy['footer']['description'] }}</p>
                    <a class="button button-primary" href="{{ route('donors.create') }}">{{ $copy['hero']['primary'] }}</a>
                </div>
                <div class="footer-col">
                    <h3>{{ $copy['footer']['contact_title'] }}</h3>
                    <a href="mailto:{{ $copy['footer']['email'] }}">{{ $copy['footer']['email'] }}</a>
                    <span>{{ $copy['footer']['phone_label'] }} : {{ $copy['footer']['phone'] }}</span>
                    <p class="footer-note">{{ $copy['footer']['contact_note'] }}</p>
                    <p class="footer-note">{{ $copy['footer']['phone_note'] }}</p>
                </div>
                <div class="footer-col">
                    <h3>{{ $copy['footer']['legal'] }}</h3>
                    <a href="#mentions-legales">{{ $copy['footer']['legal'] }}</a>
                    <a href="#mentions-legales">{{ $copy['footer']['privacy'] }}</a>
                    <p class="footer-note">{{ $copy['footer']['legal_note'] }}</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>{{ $copy['footer']['copyright'] }}</p>
                <p>{{ $copy['footer']['made'] }}</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const liquid = document.getElementById('bag-liquid');
            const stats = document.querySelectorAll('[data-count]');

            if (!reducedMotion && window.gsap) {
                if (window.ScrollTrigger) {
                    gsap.registerPlugin(ScrollTrigger);
                    gsap.to(liquid, {
                        height: '72%',
                        ease: 'none',
                        scrollTrigger: {
                            trigger: '#parcours',
                            start: 'top 72%',
                            end: 'bottom 52%',
                            scrub: 1
                        }
                    });
                    gsap.from('.step', {
                        y: 22,
                        opacity: 0,
                        duration: .65,
                        stagger: .13,
                        ease: 'power2.out',
                        scrollTrigger: { trigger: '.steps', start: 'top 78%' }
                    });
                    gsap.from('.event', {
                        y: 18,
                        opacity: 0,
                        duration: .55,
                        stagger: .12,
                        ease: 'power2.out',
                        scrollTrigger: { trigger: '.event-grid', start: 'top 82%' }
                    });
                } else {
                    liquid.style.height = '72%';
                }

                if (window.ScrollTrigger) {
                    stats.forEach((element) => {
                        const target = Number(element.dataset.count);
                        const suffix = element.dataset.suffix || '';
                        const counter = { value: 0 };
                        gsap.to(counter, {
                            value: target,
                            duration: 1.8,
                            ease: 'power2.out',
                            snap: { value: 1 },
                            scrollTrigger: { trigger: element, start: 'top 88%', once: true },
                            onUpdate: () => {
                                element.textContent = Math.round(counter.value).toLocaleString('fr-FR') + suffix;
                            }
                        });
                    });
                }
            } else {
                liquid.style.height = '72%';
            }

            if (reducedMotion) return;

            const initThreeScene = () => {
                if (!window.THREE) return;

                const host = document.getElementById('hero-canvas');
                const mobile = window.matchMedia('(max-width: 640px)').matches;
                let renderer;
                try {
                    renderer = new THREE.WebGLRenderer({ alpha: true, antialias: !mobile, powerPreference: 'low-power' });
                } catch (error) {
                    console.warn('La scène 3D DS.CI ne peut pas être initialisée sur cet appareil.', error);
                    return;
                }

                renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
                renderer.setSize(host.clientWidth, host.clientHeight);
                renderer.outputColorSpace = THREE.SRGBColorSpace;
                renderer.toneMapping = THREE.ACESFilmicToneMapping;
                renderer.toneMappingExposure = 1.15;
                host.appendChild(renderer.domElement);

                const scene = new THREE.Scene();
                const camera = new THREE.PerspectiveCamera(38, host.clientWidth / host.clientHeight, .1, 40);
                camera.position.set(0, .05, 8.8);

                scene.add(new THREE.HemisphereLight(0xffe6e1, 0x17070b, 1.35));
                const keyLight = new THREE.DirectionalLight(0xffd5c9, 3.2);
                keyLight.position.set(-3, 5, 5);
                scene.add(keyLight);
                const rimLight = new THREE.PointLight(0xff303c, 48, 12, 2);
                rimLight.position.set(2.8, 1.2, 1.3);
                scene.add(rimLight);

                const floorMaterial = new THREE.MeshStandardMaterial({ color: 0x211115, metalness: .48, roughness: .22 });
                const floor = new THREE.Mesh(new THREE.CircleGeometry(3.5, 40), floorMaterial);
                floor.rotation.x = -Math.PI / 2;
                floor.position.set(.5, -2.05, -.15);
                scene.add(floor);

                const dropMaterial = new THREE.MeshPhysicalMaterial({
                    color: 0xa20e1b,
                    metalness: .08,
                    roughness: .12,
                    transmission: .24,
                    thickness: .85,
                    ior: 1.33,
                    clearcoat: 1,
                    clearcoatRoughness: .08,
                    emissive: 0x300008,
                    emissiveIntensity: .28
                });
                const points = [
                    new THREE.Vector2(0, .43), new THREE.Vector2(.055, .39),
                    new THREE.Vector2(.13, .25), new THREE.Vector2(.21, .06),
                    new THREE.Vector2(.24, -.1), new THREE.Vector2(.21, -.24),
                    new THREE.Vector2(.13, -.34), new THREE.Vector2(0, -.38)
                ];
                const drop = new THREE.Mesh(new THREE.LatheGeometry(points, mobile ? 12 : 20), dropMaterial);
                drop.position.set(.45, 1.1, .2);
                drop.scale.set(1.05, .72, 1);
                scene.add(drop);

                const ringMaterial = new THREE.MeshBasicMaterial({ color: 0xe84149, transparent: true, opacity: .48, side: THREE.DoubleSide });
                const ripple = new THREE.Mesh(new THREE.RingGeometry(.19, .205, mobile ? 24 : 40), ringMaterial);
                ripple.rotation.x = -Math.PI / 2;
                ripple.position.set(.45, -2.015, .18);
                ripple.visible = false;
                scene.add(ripple);

                const bagGroup = new THREE.Group();
                bagGroup.position.set(1.65, -1.05, -.2);
                const bagShape = new THREE.Shape();
                bagShape.moveTo(-.34, .58);
                bagShape.lineTo(.34, .58);
                bagShape.lineTo(.34, .45);
                bagShape.quadraticCurveTo(.47, .42, .47, .29);
                bagShape.lineTo(.42, -.5);
                bagShape.quadraticCurveTo(.4, -.63, .27, -.66);
                bagShape.lineTo(-.27, -.66);
                bagShape.quadraticCurveTo(-.4, -.63, -.42, -.5);
                bagShape.lineTo(-.47, .29);
                bagShape.quadraticCurveTo(-.47, .42, -.34, .45);
                bagShape.closePath();
                const bag = new THREE.Mesh(
                    new THREE.ExtrudeGeometry(bagShape, { depth: .035, bevelEnabled: true, bevelSegments: 2, steps: 1, bevelSize: .025, bevelThickness: .025 }),
                    new THREE.MeshPhysicalMaterial({ color: 0x9eaab6, transparent: true, opacity: .19, roughness: .2, metalness: .08, clearcoat: .8, side: THREE.DoubleSide })
                );
                bagGroup.add(bag);

                const fillShape = new THREE.Shape();
                fillShape.moveTo(-.35, -.53);
                fillShape.lineTo(.35, -.53);
                fillShape.lineTo(.4, .18);
                fillShape.lineTo(-.4, .18);
                fillShape.closePath();
                const fillGroup = new THREE.Group();
                fillGroup.position.z = .045;
                const fill = new THREE.Mesh(
                    new THREE.ShapeGeometry(fillShape, 8),
                    new THREE.MeshPhysicalMaterial({ color: 0xb71c2a, transparent: true, opacity: .84, roughness: .16, clearcoat: 1, side: THREE.DoubleSide, emissive: 0x3c0008, emissiveIntensity: .18 })
                );
                fillGroup.add(fill);
                bagGroup.add(fillGroup);

                const tube = new THREE.Mesh(
                    new THREE.CylinderGeometry(.025, .025, .26, 8),
                    new THREE.MeshStandardMaterial({ color: 0xd0d5da, metalness: .22, roughness: .28, transparent: true, opacity: .5 })
                );
                tube.position.set(0, .68, 0);
                bagGroup.add(tube);
                scene.add(bagGroup);

                const dust = [];
                const dustCount = mobile ? 5 : 12;
                for (let index = 0; index < dustCount; index += 1) {
                    const particle = new THREE.Mesh(
                        new THREE.SphereGeometry(.012 + Math.random() * .018, 6, 6),
                        new THREE.MeshBasicMaterial({ color: 0xff9a95, transparent: true, opacity: .32 + Math.random() * .28 })
                    );
                    particle.position.set((Math.random() - .5) * 5, (Math.random() - .5) * 3.4, -1.4 + Math.random() * .8);
                    particle.userData.phase = Math.random() * Math.PI * 2;
                    scene.add(particle);
                    dust.push(particle);
                }

                const pointer = { x: 0, y: 0 };
                const target = { x: 0, y: 0 };
                const onPointerMove = (event) => {
                    target.x = (event.clientX / window.innerWidth - .5) * .22;
                    target.y = (event.clientY / window.innerHeight - .5) * .12;
                };
                window.addEventListener('pointermove', onPointerMove, { passive: true });

                let orientationEnabled = false;
                const onOrientation = (event) => {
                    if (event.gamma === null || event.beta === null) return;
                    target.x = THREE.MathUtils.clamp(event.gamma / 90, -.12, .12);
                    target.y = THREE.MathUtils.clamp((event.beta - 35) / 180, -.08, .08);
                };
                if (window.DeviceOrientationEvent && typeof window.DeviceOrientationEvent.requestPermission !== 'function') {
                    window.addEventListener('deviceorientation', onOrientation, { passive: true });
                    orientationEnabled = true;
                } else if (window.DeviceOrientationEvent) {
                    const enableOrientation = () => {
                        if (orientationEnabled) return;
                        window.DeviceOrientationEvent.requestPermission().then((permission) => {
                            if (permission === 'granted') {
                                window.addEventListener('deviceorientation', onOrientation, { passive: true });
                                orientationEnabled = true;
                            }
                        }).catch((error) => console.warn('Accès au gyroscope indisponible.', error));
                        window.removeEventListener('touchstart', enableOrientation);
                    };
                    window.addEventListener('touchstart', enableOrientation, { once: true, passive: true });
                }

                const clock = new THREE.Clock();
                let animationFrame = 0;
                let heroInView = true;
                let phase = 'form';
                let phaseTime = 0;
                let previousWidth = host.clientWidth;
                const render = () => {
                    animationFrame = window.requestAnimationFrame(render);
                    const delta = Math.min(clock.getDelta(), .05);
                    const elapsed = clock.elapsedTime;
                    phaseTime += delta;
                    pointer.x += (target.x - pointer.x) * .025;
                    pointer.y += (target.y - pointer.y) * .025;
                    camera.position.x = pointer.x;
                    camera.position.y = .05 - pointer.y;
                    camera.lookAt(.35 + pointer.x * .25, -.1, 0);

                    // Rejoue les phases de formation, impact, ondulation et remplissage sans créer de géométrie à chaque frame.
                    if (phase === 'form') {
                        const progress = Math.min(phaseTime / 2.3, 1);
                        drop.scale.y = .5 + progress * .38;
                        drop.position.y = 1.06 - progress * .08;
                        if (progress === 1) { phase = 'fall'; phaseTime = 0; }
                    } else if (phase === 'fall') {
                        const progress = Math.min(phaseTime / 1.05, 1);
                        drop.position.y = 1 - progress * 2.62;
                        drop.scale.y = .88 + Math.sin(progress * Math.PI) * .12;
                        if (progress === 1) {
                            drop.visible = false;
                            ripple.visible = true;
                            phase = 'ripple';
                            phaseTime = 0;
                        }
                    } else if (phase === 'ripple') {
                        const progress = Math.min(phaseTime / 1.4, 1);
                        ripple.scale.setScalar(.7 + progress * 5.5);
                        ringMaterial.opacity = .48 * (1 - progress);
                        drop.position.set(1.65, 1.1, -.1);
                        if (progress === 1) {
                            ripple.visible = false;
                            ripple.scale.setScalar(.7);
                            ringMaterial.opacity = .48;
                            drop.visible = true;
                            drop.scale.set(1.05, .2, 1);
                            phase = 'second-form';
                            phaseTime = 0;
                        }
                    } else if (phase === 'second-form') {
                        const progress = Math.min(phaseTime / 1.2, 1);
                        drop.scale.y = .2 + progress * .65;
                        if (progress === 1) { phase = 'second-fall'; phaseTime = 0; }
                    } else if (phase === 'second-fall') {
                        const progress = Math.min(phaseTime / .8, 1);
                        drop.position.y = 1.1 - progress * 2.05;
                        if (progress === 1) {
                            drop.visible = false;
                            phase = 'fill';
                            phaseTime = 0;
                        }
                    } else if (phase === 'fill') {
                        const progress = Math.min(phaseTime / 1.4, 1);
                        fill.scale.y = progress;
                        fill.position.y = -.53 * (1 - progress);
                        if (progress === 1) {
                            phase = 'pause';
                            phaseTime = 0;
                        }
                    } else if (phase === 'pause' && phaseTime > 1.5) {
                        fill.scale.y = 0;
                        fill.position.y = 0;
                        drop.position.set(.45, 1.1, .2);
                        drop.scale.set(1.05, .5, 1);
                        drop.visible = true;
                        phase = 'form';
                        phaseTime = 0;
                    }

                    bagGroup.position.y = -1.05 + Math.sin(elapsed * .8) * .025;
                    dust.forEach((particle) => {
                        particle.position.y += Math.sin(elapsed + particle.userData.phase) * .0007;
                    });
                    renderer.render(scene, camera);
                };

                const resizeObserver = new ResizeObserver(() => {
                    if (host.clientWidth === previousWidth) return;
                    previousWidth = host.clientWidth;
                    camera.aspect = host.clientWidth / host.clientHeight;
                    camera.updateProjectionMatrix();
                    renderer.setSize(host.clientWidth, host.clientHeight);
                    renderer.setPixelRatio(Math.min(window.devicePixelRatio || 1, 2));
                });
                const stopRender = () => {
                    if (!animationFrame) return;
                    window.cancelAnimationFrame(animationFrame);
                    animationFrame = 0;
                    clock.stop();
                };
                const startRender = () => {
                    if (animationFrame || document.hidden || !heroInView) return;
                    clock.start();
                    render();
                };
                const sceneObserver = new IntersectionObserver((entries) => {
                    heroInView = entries[0].isIntersecting;
                    if (heroInView) startRender();
                    else stopRender();
                });
                const onVisibilityChange = () => {
                    if (document.hidden) stopRender();
                    else startRender();
                };
                resizeObserver.observe(host);
                sceneObserver.observe(host);
                document.addEventListener('visibilitychange', onVisibilityChange);

                window.addEventListener('pagehide', () => {
                    stopRender();
                    sceneObserver.disconnect();
                    resizeObserver.disconnect();
                    document.removeEventListener('visibilitychange', onVisibilityChange);
                    window.removeEventListener('pointermove', onPointerMove);
                    if (orientationEnabled) window.removeEventListener('deviceorientation', onOrientation);
                    renderer.dispose();
                }, { once: true });
            };

            if (window.THREE) {
                initThreeScene();
            } else {
                const threeScript = document.createElement('script');
                threeScript.src = 'https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.min.js';
                threeScript.async = true;
                threeScript.onload = initThreeScene;
                threeScript.onerror = () => console.warn('La bibliothèque 3D DS.CI n’a pas pu être chargée.');
                document.head.appendChild(threeScript);
            }
        });
    </script>
</body>
</html>
