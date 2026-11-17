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
        const stepIndicators = [...app.querySelectorAll('[data-step-indicator]')];
        const serverErrors = document.querySelector('.registration-error-summary');
        const pregnancyQuestion = form.querySelector('[data-pregnancy-question]');
        const sexField = form.elements.namedItem('sex');
        const emailField = form.elements.namedItem('email');
        const channelFields = [...form.querySelectorAll('[name="preferred_channel"]')];
        const lastDonationDateField = form.elements.namedItem('last_donation_date');
        const birthDateField = form.elements.namedItem('birth_date');

        const controlIsValid = (control) => {
            if (control.required && ['text', 'tel'].includes(control.type) && !control.value.trim()) {
                return false;
            }
            return control.checkValidity();
        };

        const updateCompletion = (step) => {
            const section = steps.find((item) => Number(item.dataset.step) === step);
            const button = form.querySelector(`[data-step-button="${step}"]`);
            const fields = [...section.querySelectorAll('[data-completion-field]')];
            const groups = [...section.querySelectorAll('[data-completion-group]')]
                .filter((group) => !group.hidden && [...group.querySelectorAll('input[type="radio"]')].some((input) => !input.disabled));
            const emailIsRequired = step === 2 && channelFields.some((input) => input.checked && input.value === 'email');
            emailField.required = emailIsRequired;

            const completedFields = fields.filter(controlIsValid).length;
            const completedGroups = groups.filter((group) => [...group.querySelectorAll('input[type="radio"]')].some((input) => input.checked)).length;
            const completedEmail = emailIsRequired && controlIsValid(emailField) ? 1 : 0;
            const total = fields.length + groups.length + Number(emailIsRequired);
            const percentage = total ? Math.round((completedFields + completedGroups + completedEmail) / total * 100) : 0;

            button.style.setProperty('--completion', `${percentage}%`);
            button.disabled = percentage !== 100;
            button.dataset.complete = String(percentage === 100);
            button.dataset.progressing = String(percentage > 0 && percentage < 100);
            button.setAttribute('aria-label', `${button.dataset.progressLabel} — ${percentage} % complété`);
            button.querySelector('[data-completion-value]').textContent = `${percentage} %`;
        };

        const showStep = (step, persist = true) => {
            const activeStep = Math.max(1, Math.min(2, step));
            steps.forEach((section) => {
                const isActive = Number(section.dataset.step) === activeStep;
                section.hidden = !isActive;
                section.setAttribute('aria-hidden', String(!isActive));
            });
            progress.setAttribute('aria-valuenow', String(activeStep));
            progressFill.style.width = `${(activeStep / 3) * 100}%`;
            stepIndicators.forEach((indicator) => {
                const indicatorStep = Number(indicator.dataset.stepIndicator);
                indicator.classList.toggle('is-current', indicatorStep === activeStep);
                indicator.classList.toggle('is-complete', indicatorStep < activeStep);
                if (indicatorStep === activeStep) {
                    indicator.setAttribute('aria-current', 'step');
                } else {
                    indicator.removeAttribute('aria-current');
                }
            });
            progressLabel.textContent = `Étape ${activeStep} sur 3`;
            updateCompletion(activeStep);
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
                const requiredMessages = {
                    first_name: 'Saisissez votre prénom.',
                    last_name: 'Saisissez votre nom.',
                    phone: 'Saisissez votre numéro de téléphone.',
                    location: 'Indiquez votre lieu de résidence.',
                    email: 'L’e-mail est nécessaire si vous choisissez ce canal de notification.',
                };
                if (requiredMessages[control.name]) return requiredMessages[control.name];
                return control.type === 'checkbox'
                    ? 'Votre accord est nécessaire pour continuer.'
                    : 'Ce champ est obligatoire.';
            }
            if (control.required && ['text', 'tel'].includes(control.type) && !control.value.trim()) {
                return {
                    first_name: 'Saisissez votre prénom.',
                    last_name: 'Saisissez votre nom.',
                    phone: 'Saisissez votre numéro de téléphone.',
                    location: 'Indiquez votre lieu de résidence.',
                }[control.name] || 'Ce champ est obligatoire.';
            }
            if (control.validity.typeMismatch) {
                return 'Saisissez une adresse e-mail valide.';
            }
            if (control.name === 'birth_date' && (control.validity.rangeUnderflow || control.validity.rangeOverflow)) {
                return 'La date de naissance doit être dans le passé.';
            }
            if (control.name === 'weight_kg' && (control.validity.rangeUnderflow || control.validity.rangeOverflow || control.validity.stepMismatch)) {
                return 'Saisissez un poids valide.';
            }
            if (control.name === 'last_donation_date' && control.validity.rangeUnderflow) {
                return 'La date ne peut pas être antérieure à votre date de naissance.';
            }
            if (control.name === 'last_donation_date' && control.validity.rangeOverflow) {
                return 'Cette date ne peut pas être dans le futur.';
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

                if (!controlIsValid(control)) {
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
            const icon = result.querySelector('[data-eligibility-icon]');
            const birthDate = dateFromInput(birthDateField.value);
            const weight = Number(form.elements.namedItem('weight_kg').value);
            const showResult = (state, titleText, messageText) => {
                result.dataset.state = state;
                icon.textContent = {
                    eligible: '✓',
                    review: '⚠',
                    deferred: '⚠',
                    'not-eligible': '✕',
                }[state];
                title.textContent = titleText;
                message.textContent = messageText;
            };
            const doctorDisclaimer = 'La décision finale revient toujours au médecin lors de la collecte.';

            if (!birthDate || !Number.isFinite(weight) || weight <= 0) {
                showResult('review', 'Votre pré-contrôle apparaîtra ici.', doctorDisclaimer);
                return;
            }

            const today = new Date();
            const age = calculateAge(birthDate, today);
            const minimumAge = Number(app.dataset.minimumAge);
            const maximumAge = Number(app.dataset.maximumAge);
            const minimumWeight = Number(app.dataset.minimumWeight);
            const answerNames = [
                'recent_fever_or_infection',
                'chronic_condition',
                'current_treatment',
                'recent_surgery_or_transfusion',
            ];
            if (sexField.value === 'female') answerNames.push('pregnancy_or_breastfeeding');
            const answersComplete = answerNames.every((name) => form.querySelector(`[name="${name}"]:checked`));
            const positiveAnswers = answerNames.some((name) => {
                const input = form.querySelector(`[name="${name}"][value="1"]`);
                return input && input.checked && !input.disabled;
            });

            if (age < minimumAge) {
                const earliestDate = new Date(birthDate);
                earliestDate.setFullYear(earliestDate.getFullYear() + minimumAge);
                showResult('deferred', `Vous pourrez envisager un don à partir du ${formatDate(earliestDate)}.`, doctorDisclaimer);
                return;
            }
            if (age > maximumAge || weight < minimumWeight) {
                showResult(
                    'not-eligible',
                    'Selon ces repères indicatifs, vous ne semblez pas éligible aujourd’hui.',
                    `Un médecin pourra confirmer votre situation. ${doctorDisclaimer}`,
                );
                return;
            }
            if (!answersComplete) {
                showResult('review', 'Répondez aux questions pour voir votre pré-contrôle.', doctorDisclaimer);
                return;
            }
            if (positiveAnswers) {
                showResult(
                    'review',
                    'Un don pourra être envisagé après avis de l’équipe médicale.',
                    `Merci pour votre transparence. Le médecin évaluera votre situation avec vous. ${doctorDisclaimer}`,
                );
                return;
            }

            const lastDonation = dateFromInput(form.elements.namedItem('last_donation_date').value);
            if (lastDonation) {
                const eligibleDate = new Date(lastDonation);
                eligibleDate.setDate(eligibleDate.getDate() + Number(app.dataset.intervalDays));
                const todayStart = new Date(today.getFullYear(), today.getMonth(), today.getDate());
                if (eligibleDate > todayStart) {
                    showResult('deferred', `Vous pourrez envisager un nouveau don à partir du ${formatDate(eligibleDate)}.`, doctorDisclaimer);
                    return;
                }
            }

            showResult('eligible', 'Vous semblez éligible.', doctorDisclaimer);
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
            if (event.target === birthDateField) {
                lastDonationDateField.min = birthDateField.value;
            }
            updateEligibility();
            updateCompletion(Number(event.target.closest('[data-step]').dataset.step));
        });
        form.addEventListener('change', (event) => {
            clearFieldError(event.target.name);
            if (event.target === sexField) updatePregnancyQuestion();
            if (event.target === birthDateField) {
                lastDonationDateField.min = birthDateField.value;
            }
            if (event.target.name === 'preferred_channel') {
                emailField.required = event.target.value === 'email';
            }
            updateEligibility();
            updateCompletion(Number(event.target.closest('[data-step]').dataset.step));
        });

        const serverStep = Number(app.dataset.initialStep) || 1;
        const savedStep = Number(window.sessionStorage.getItem(stepStorageKey)) || 1;
        form.querySelectorAll('[data-field-error][data-server-error]').forEach((error) => {
            form.querySelectorAll(`[name="${error.dataset.fieldError}"]`)
                .forEach((input) => input.setAttribute('aria-invalid', 'true'));
        });
        showStep(serverErrors && !serverErrors.hidden ? serverStep : savedStep, false);
        lastDonationDateField.min = birthDateField.value;
        updatePregnancyQuestion();
        emailField.required = channelFields.some((input) => input.checked && input.value === 'email');
        if (confirmation) window.sessionStorage.removeItem(stepStorageKey);
    }

    const scene = document.querySelector('[data-ambulance-scene]');
    const ambulance = document.querySelector('[data-ambulance]');
    const registrationCard = document.getElementById('registration-card');
    const skipButton = document.querySelector('[data-skip-animation]');

    const hasServerErrors = document.querySelector('.registration-error-summary:not([hidden])');

    if (scene && ambulance && registrationCard && skipButton && !reducedMotion && !hasServerErrors) {
        scene.hidden = false;
        skipButton.hidden = false;
        scene.classList.add('is-animating');
        app.classList.add('is-animating');
        registrationCard.inert = true;
        let finished = false;

        const finishAnimation = () => {
            if (finished) return;
            finished = true;
            app.classList.remove('is-animating');
            registrationCard.inert = false;
            scene.classList.remove('is-animating');
            scene.hidden = true;
            skipButton.hidden = true;
            if (document.activeElement === skipButton) {
                app.querySelector('.form-step:not([hidden]) h2').focus({ preventScroll: true });
            }
        };

        window.setTimeout(finishAnimation, 9000);
        skipButton.addEventListener('click', finishAnimation);
    } else if (scene) {
        scene.hidden = true;
    }

    if (confirmation) window.sessionStorage.removeItem(stepStorageKey);
})();
