// Așteptăm ca pagina să se încarce complet
document.addEventListener('DOMContentLoaded', function() {
    
    // Selectăm elementele formularului
    const form = document.getElementById('contact-form');
    const nume = document.getElementById('nume');
    const email = document.getElementById('email');
    const subiect = document.getElementById('subiect');
    const mesaj = document.getElementById('mesaj');

    // Oprim funcționarea scriptului dacă formularul nu există pe pagină
    if (!form) {
        return;
    }

    // Adăugăm un "ascultător" pentru evenimentul de "submit"
    form.addEventListener('submit', function(event) {
        // Oprim trimiterea normală a formularului
        event.preventDefault();
        
        // Verificăm formularul
        let isValid = validateForm();
        
        if (isValid) {
            // Dacă totul e OK, afișăm un mesaj de succes
            alert('Mesajul tău a fost trimis cu succes!');
            
            // Aici s-ar trimite formularul către server
            // form.submit(); // (Deocamdată doar resetăm)
            
            form.reset(); // Ștergem câmpurile
            clearErrors(); // Ștergem și mesajele de eroare după reset
        }
    });

    function validateForm() {
        let valid = true; // Presupunem că e valid
        
        // Ștergem erorile vechi
        clearErrors();

        // 1. Verifică Numele
        if (nume.value.trim() === '') {
            showError(nume, 'Numele este obligatoriu.');
            valid = false;
        }

        // 2. Verifică Email-ul
        if (email.value.trim() === '') {
            showError(email, 'Adresa de email este obligatorie.');
            valid = false;
        } else if (!isValidEmail(email.value.trim())) {
            showError(email, 'Adresa de email nu este validă.');
            valid = false;
        }

        // 3. Verifică Subiectul
        if (subiect.value.trim() === '') {
            showError(subiect, 'Subiectul este obligatoriu.');
            valid = false;
        }

        // 4. Verifică Mesajul
        if (mesaj.value.trim() === '') {
            showError(mesaj, 'Mesajul este obligatoriu.');
            valid = false;
        }

        return valid;
    }

    // Funcție care afișează eroarea
    function showError(inputElement, message) {
        const formGroup = inputElement.parentElement;
        const errorDiv = formGroup.querySelector('.error-message');
        
        // Adăugăm clasa de eroare pe input
        inputElement.classList.add('error');
        // Adăugăm textul erorii
        errorDiv.textContent = message;
    }

    // Funcție care șterge toate erorile
    function clearErrors() {
        const errorMessages = document.querySelectorAll('.error-message');
        errorMessages.forEach(div => div.textContent = '');
        
        const errorInputs = document.querySelectorAll('.form-group input.error, .form-group textarea.error');
        errorInputs.forEach(input => input.classList.remove('error'));
    }

    // Funcție simplă de validare email
    function isValidEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

});