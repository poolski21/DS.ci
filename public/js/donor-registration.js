(() => {
    const app = document.querySelector('[data-registration-app]');
    const confirmation = document.querySelector('[data-confirmation]');
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const stepStorageKey = 'dsci-registration-step';

    if (app) {
        const form = document.getElementById('donor-registration-form');
        const steps = [...form.querySelectorAll('[data-step]')];
        const progress = app.querySelector('[data-progress]');
        const progressFill = app.querySelector('[data-progress-fill]');
        const progressLabel = app.querySelector('[data-progress-label]');
        const serverErrors = document.querySelector('.registration-error-summary');
        const pregnancyQuestion = form.querySelector('[data-pregnancy-question]');
        const sexField = form.elements.namedItem('sex');
        const emailField = form.elements.namedItem('email');
        const channelFields = [...form.querySelectorAll('[name="preferred_channel"]')];

        const showStep = (step, persist = true) => {
            const activeStep = Math.max(1, Math.min(2, step));
            steps.forEach((section) => {
                const isActive = Number(section.dataset.step) === activeStep;
                section.hidden = !isActive;
                section.setAttribute('aria-hidden', String(!isActive));
            });
            progressLabel.textContent = `Étape ${activeStep} sur 3`;
            progress.setAttribute('aria-valuenow', String(activeStep));
            progressFill.style.width = `${(activeStep / 3) * 100}%`;
            if (persist) {
                window.sessionStorage.setItem(stepStorageKey, String(activeStep));
            }
        };

        const errorFor = (name) => form.querySelector(`[data-field-error="${name}"]`);

        const clearFieldError = (name) => {
            const error = errorFor(name);
            if (error) {
                error.textContent = '';
                error.removeAttribute('data-server-error');
            }
            form.querySelectorAll(`[name="${name}"]`).forEach((input) => input.removeAttribute('aria-invalid'));
            if (serverErrors && !form.querySelector('[data-server-error]')) {
                serverErrors.hidden = true;
            }
        };

        const validationMessage = (control) => {
            if (control.validity.valueMissing) {
                return control.type === 'checkbox'
                    ? 'Votre accord est nécessaire pour continuer.'
                    : 'Ce champ est obligatoire.';
            }
            if (control.validity.typeMismatch) {
                return 'Saisissez une adresse e-mail valide.';
            }
            if (control.validity.patternMismatch || control.validity.tooShort) {
                return 'Saisissez les 10 chiffres du numéro, sans indicatif.';
            }
            if (control.validity.rangeUnderflow || control.validity.rangeOverflow) {
                return 'Saisissez une valeur valide.';
            }
            return 'Vérifiez cette information.';
        };

        const validateStep = (step) => {
            const section = steps.find((item) => Number(item.dataset.step) === step);
            const controls = [...section.querySelectorAll('input, select, textarea')]
                .filter((control) => !control.disabled && control.willValidate);
            const checkedGroups = new Set();
            let firstInvalid = null;
            let valid = true;

            controls.forEach((control) => {
                if (control.type === 'radio') {
                    if (checkedGroups.has(control.name)) return;
                    checkedGroups.add(control.name);
                    const group = controls.filter((item) => item.type === 'radio' && item.name === control.name);
                    const groupIsValid = group.some((item) => item.checked);
                    if (!groupIsValid) {
                        valid = false;
                        firstInvalid ||= control;
                        const message = 'Choisissez une option.';
                        const error = errorFor(control.name);
                        if (error) error.textContent = message;
                        group.forEach((item) => item.setAttribute('aria-invalid', 'true'));
                    } else {
                        clearFieldError(control.name);
                    }
                    return;
                }

                if (!control.checkValidity()) {
                    valid = false;
                    firstInvalid ||= control;
                    control.setAttribute('aria-invalid', 'true');
                    const error = errorFor(control.name);
                    if (error) error.textContent = validationMessage(control);
                } else {
                    clearFieldError(control.name);
                }
            });

            if (firstInvalid) firstInvalid.focus();
            return valid;
        };

        const updatePregnancyQuestion = () => {
            const pregnancyError = errorFor('pregnancy_or_breastfeeding');
            const showQuestion = sexField.value === 'female'
                || (!sexField.value && pregnancyError && pregnancyError.hasAttribute('data-server-error'));
            pregnancyQuestion.hidden = !showQuestion;
            pregnancyQuestion.querySelectorAll('input').forEach((input) => {
                input.required = showQuestion;
                input.disabled = !showQuestion;
                if (!showQuestion) input.checked = false;
            });
            if (!showQuestion) clearFieldError('pregnancy_or_breastfeeding');
            updateEligibility();
        };

        const dateFromInput = (value) => value ? new Date(`${value}T12:00:00`) : null;

        const formatDate = (date) => new Intl.DateTimeFormat('fr-FR').format(date);

        const calculateAge = (birthDate, today) => {
            let age = today.getFullYear() - birthDate.getFullYear();
            const birthdayHasPassed = today.getMonth() > birthDate.getMonth()
                || (today.getMonth() === birthDate.getMonth() && today.getDate() >= birthDate.getDate());
            if (!birthdayHasPassed) age -= 1;
            return age;
        };

        const updateEligibility = () => {
            const result = app.querySelector('[data-eligibility-result]');
            const title = result.querySelector('[data-eligibility-title]');
            const message = result.querySelector('[data-eligibility-message]');
            const birthDate = dateFromInput(form.elements.namedItem('birth_date').value);
            const weight = Number(form.elements.namedItem('weight_kg').value);
            if (!birthDate || !weight) return;

            const today = new Date();
            const age = calculateAge(birthDate, today);
            const minimumAge = Number(app.dataset.minimumAge);
            const maximumAge = Number(app.dataset.maximumAge);
            const minimumWeight = Number(app.dataset.minimumWeight);
            const positiveAnswers = ['recent_fever_or_infection', 'chronic_condition', 'current_treatment', 'recent_surgery_or_transfusion', 'pregnancy_or_breastfeeding']
                .some((name) => {
                    const input = form.querySelector(`[name="${name}"][value="1"]`);
                    return input && input.checked && !input.disabled;
                });

            result.dataset.state = 'review';
            if (age < minimumAge) {
                const earliestDate = new Date(birthDate);
                earliestDate.setFullYear(earliestDate.getFullYear() + minimumAge);
                title.textContent = `Vous pourrez envisager un don à partir du ${formatDate(earliestDate)}.`;
                message.textContent = 'Cette date est indicative et reste soumise à l’avis du médecin lors de la collecte.';
                return;
            }
            if (age > maximumAge || weight < minimumWeight) {
                title.textContent = 'Un échange avec l’équipe médicale sera nécessaire.';
                message.textContent = 'Les critères affichés sont indicatifs. Le médecin pourra étudier votre situation.';
                return;
            }
            if (positiveAnswers) {
                title.textContent = 'L’équipe médicale pourra vous conseiller.';
                message.textContent = 'Merci pour votre transparence. Le médecin évaluera votre situation avec vous.';
                return;
            }

            const lastDonation = dateFromInput(form.elements.namedItem('last_donation_date').value);
            if (lastDonation) {
                const eligibleDate = new Date(lastDonation);
                eligibleDate.setDate(eligibleDate.getDate() + Number(app.dataset.intervalDays));
                const todayStart = new Date(today.getFullYear(), today.getMonth(), today.getDate());
                if (eligibleDate > todayStart) {
                    title.textContent = `Vous pourrez envisager un nouveau don à partir du ${formatDate(eligibleDate)}.`;
                    message.textContent = 'Le médecin confirmera toujours votre aptitude lors de la collecte.';
                    return;
                }
            }

            result.dataset.state = 'eligible';
            title.textContent = 'Vous semblez éligible.';
            message.textContent = 'La décision finale revient toujours au médecin lors de la collecte.';
        };

        form.querySelectorAll('[data-next]').forEach((button) => {
            button.addEventListener('click', () => {
                if (validateStep(1)) {
                    showStep(2);
                    steps[1].querySelector('h2').focus({ preventScroll: true });
                }
            });
        });
        form.querySelectorAll('[data-previous]').forEach((button) => {
            button.addEventListener('click', () => {
                showStep(1);
                steps[0].querySelector('h2').focus({ preventScroll: true });
            });
        });
        form.addEventListener('submit', (event) => {
            if (!validateStep(2)) {
                event.preventDefault();
                return;
            }
            window.sessionStorage.setItem(stepStorageKey, '2');
        });
        form.addEventListener('input', (event) => {
            clearFieldError(event.target.name);
            updateEligibility();
        });
        form.addEventListener('change', (event) => {
            clearFieldError(event.target.name);
            if (event.target === sexField) updatePregnancyQuestion();
            if (event.target.name === 'preferred_channel') {
                emailField.required = event.target.value === 'email';
            }
            updateEligibility();
        });

        const serverStep = Number(app.dataset.initialStep) || 1;
        const savedStep = Number(window.sessionStorage.getItem(stepStorageKey)) || 1;
        form.querySelectorAll('[data-field-error][data-server-error]').forEach((error) => {
            form.querySelectorAll(`[name="${error.dataset.fieldError}"]`)
                .forEach((input) => input.setAttribute('aria-invalid', 'true'));
        });
        showStep(serverErrors && !serverErrors.hidden ? serverStep : savedStep, false);
        updatePregnancyQuestion();
        emailField.required = channelFields.some((input) => input.checked && input.value === 'email');
        if (confirmation) window.sessionStorage.removeItem(stepStorageKey);
    }

    const scene = document.querySelector('[data-ambulance-scene]');
    const ambulance = document.querySelector('[data-ambulance]');
    const registrationCard = document.getElementById('registration-card');
    const skipButton = document.querySelector('[data-skip-animation]');

    if (scene && ambulance && registrationCard && !reducedMotion && window.gsap) {
        scene.hidden = false;
        skipButton.hidden = false;
        const rearDoor = scene.querySelector('[data-rear-door]');
        const mobile = window.matchMedia('(max-width: 600px)').matches;
        const entryDuration = mobile ? .65 : .95;
        const doorDuration = mobile ? .18 : .28;
        const cardDuration = mobile ? .5 : .62;
        const exitDuration = mobile ? .58 : .82;
        const fadeDuration = mobile ? .2 : .28;
        let timeline;
        let finished = false;

        const finishAnimation = () => {
            if (finished) return;
            finished = true;
            timeline?.kill();
            registrationCard.style.visibility = 'visible';
            registrationCard.style.opacity = '1';
            registrationCard.style.transform = 'none';
            scene.hidden = true;
            skipButton.hidden = true;
        };

        gsap.set(registrationCard, { autoAlpha: 0, scaleX: .08, x: -30, transformOrigin: 'left center' });
        gsap.set(ambulance, { x: '-120vw', y: '-50%' });
        timeline = gsap.timeline({ onComplete: finishAnimation });
        timeline
            .to(ambulance, { x: '-8vw', duration: entryDuration, ease: 'power2.out' })
            .to(ambulance, { x: '0vw', duration: mobile ? .14 : .2, ease: 'power1.out' })
            .to(rearDoor, { rotationY: -62, transformOrigin: 'left center', duration: doorDuration, ease: 'power2.out' }, mobile ? '+=.03' : '+=.08')
            .to(registrationCard, { autoAlpha: 1, scaleX: 1, x: 0, duration: cardDuration, ease: 'back.out(1.3)' }, mobile ? '+=.04' : '+=.06')
            .to(ambulance, { x: '120vw', duration: exitDuration, ease: 'power2.in' }, mobile ? '+=.12' : '+=.28')
            .to(scene, { autoAlpha: 0, duration: fadeDuration, ease: 'power1.out' });

        skipButton.addEventListener('click', finishAnimation);
    } else if (scene) {
        scene.hidden = true;
        if (registrationCard) registrationCard.style.visibility = 'visible';
    }

    if (confirmation) {
        window.sessionStorage.removeItem(stepStorageKey);
        const fill = confirmation.querySelector('[data-heart-fill]');
        const drop = confirmation.querySelector('[data-heart-drop]');
        if (fill && drop && !reducedMotion && window.gsap) {
            gsap.set(drop, { y: -8, scale: .86, transformOrigin: 'center center' });
            gsap.timeline({ repeat: -1, repeatDelay: .7 })
                .to(drop, { y: 58, duration: .8, ease: 'power2.in' })
                .to(drop, { autoAlpha: 0, duration: .12 }, '-=.12')
                .to(fill, { attr: { y: 62, height: 84 }, duration: .9, ease: 'power1.out' }, '-=.24')
                .to(confirmation.querySelector('svg'), { scale: 1.035, duration: .25, yoyo: true, repeat: 1 }, '-=.2')
                .set(fill, { attr: { y: 146, height: 0 } })
                .set(drop, { y: -8, autoAlpha: 1 });
        }
    }
})();
