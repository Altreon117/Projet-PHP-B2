/**
 * Validation de formulaires (validation.js).
 *
 * Ajoute une validation client simple pour les formulaires.
 * Affiche des messages d'erreur si les champs sont vides ou invalides.
 */
document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    if (!form) return;

    form.setAttribute('novalidate', true);

    const showError = (input, message) => {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.style.color = '#ff4444'; 
        errorDiv.style.fontSize = '0.85rem';
        errorDiv.style.marginTop = '5px';
        errorDiv.style.marginBottom = '10px';
        errorDiv.textContent = message;
        input.insertAdjacentElement('afterend', errorDiv);
    };

    const clearErrors = () => {
        const errors = form.querySelectorAll('.error-message');
        errors.forEach(error => error.remove());
    };

    form.addEventListener('submit', (e) => {
        clearErrors();
        let isValid = true;

        const requiredInputs = form.querySelectorAll('input[required]');
        requiredInputs.forEach(input => {
            if (!input.value.trim()) {
                showError(input, 'Ce champ est requis.');
                isValid = false;
            }
        });

        const emailInput = form.querySelector('input[type="email"]');
        if (emailInput && emailInput.value.trim()) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailInput.value.trim())) {
                showError(emailInput, 'Veuillez entrer une adresse email valide.');
                isValid = false;
            }
        }

        const passwordInput = form.querySelector('input[name="password"]');
        const confirmPasswordInput = form.querySelector('input[name="password_confirm"]');

        if (passwordInput && confirmPasswordInput) {
            if (passwordInput.value !== confirmPasswordInput.value) {
                showError(confirmPasswordInput, 'Les mots de passe ne correspondent pas.');
                isValid = false;
            }
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
});
