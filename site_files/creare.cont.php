<?php
// Verificăm dacă utilizatorul a fost redirecționat aici cu succes
$inregistrare_reusita = false;
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    $inregistrare_reusita = true;
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creare Cont - Ticketing Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.creare.css">
    
    <style>
        /* Stiluri pentru validarea live */
        .password-requirements {
            text-align: left; margin-top: 5px; font-size: 0.85rem;
            background: #f9f9f9; padding: 8px 10px; border-radius: 5px; border: 1px solid #eee;
        }
        .requirement {
            color: #d9534f; margin-bottom: 3px; display: flex; align-items: center;
            transition: color 0.3s ease; font-weight: 500;
        }
        .requirement.valid { color: #28a745; font-weight: 700; }
        .requirement span { margin-right: 8px; font-size: 1rem; width: 15px; display: inline-block; text-align: center; }
        button:disabled { background-color: #cccccc !important; cursor: not-allowed; opacity: 0.7; transform: none !important; }

        /* STILURI PENTRU MESAJUL DE SUCCES (ca la recuperare) */
        .success-state { text-align: center; padding: 20px; }
        .success-icon { font-size: 4rem; margin-bottom: 15px; display: block; }
        .success-title { color: #28a745; font-size: 1.8rem; margin-bottom: 15px; font-weight: 700; }
        .success-text { color: #666; font-size: 1rem; margin-bottom: 30px; }
        .btn-login-success {
            background-color: #007bff; color: white; padding: 12px 30px; text-decoration: none;
            border-radius: 5px; font-weight: 600; display: inline-block; transition: background 0.3s;
        }
        .btn-login-success:hover { background-color: #0056b3; }
    </style>
</head>
<body>

    <header>
        <a href="index.php" class="logo">Ticketing Pro</a> 
        <nav>
            <a href="pagina.meciuri.php">Meciuri</a>
            <a href="pagina.clasamente.php">Clasamente</a>
            <a href="pagina.comenzi.php">Comenzile mele</a>
            <a href="pagina.ajutor.php">Ajutor</a> 
            <a href="pagina.login.php">Login</a>
        </nav>
    </header>

    <main class="register-page">
        <div class="form-wrapper">

            <?php if ($inregistrare_reusita): ?>
                
                <div class="success-state">
                    <div class="success-icon">✅</div>
                    <h2 class="success-title">Cont Creat cu Succes!</h2>
                    <p class="success-text">
                        Te-ai înregistrat cu succes pe Ticketing Pro.<br>
                        Acum te poți autentifica pentru a cumpăra bilete la meciurile favorite.
                    </p>
                    <a href="pagina.login.php" class="btn-login-success">Mergi la Autentificare</a>
                </div>

            <?php else: ?>

                <h2>Creează un Cont Nou</h2>
                <p class="subtitle">Alătură-te comunității Ticketing Pro pentru a cumpăra bilete rapid.</p>

                <form action="proceseaza_inregistrare.php" method="POST" id="registerForm">
                    <div class="form-group">
                        <label for="nume">Nume Complet</label>
                        <input type="text" id="nume" name="nume" placeholder="Ex: Ion Popescu" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Adresă de Email</label>
                        <input type="email" id="email" name="email" placeholder="exemplu@email.com" required>
                    </div>

                    <div class="form-group">
                        <label for="parola">Parolă</label>
                        <input type="password" id="parola" name="parola" placeholder="Alege o parolă sigură" required>
                        
                        <div class="password-requirements">
                            <div id="req-length" class="requirement"><span>✖</span> Minim 8 caractere</div>
                            <div id="req-uppercase" class="requirement"><span>✖</span> O literă mare (A-Z)</div>
                            <div id="req-number" class="requirement"><span>✖</span> O cifră sau caracter special</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirmare_parola">Confirmă Parola</label>
                        <input type="password" id="confirmare_parola" name="confirmare_parola" placeholder="Repetă parola" required>
                        <div class="password-requirements">
                            <div id="req-match" class="requirement"><span>✖</span> Parolele coincid</div>
                        </div>
                    </div>

                    <button type="submit" id="submitBtn" class="cta-button" disabled>Înregistrează-te</button>

                    <p class="login-link">
                        Ai deja un cont? <a href="pagina.login.php">Autentifică-te aici</a>
                    </p>
                </form>

            <?php endif; ?>

        </div>
    </main>

    <footer>
        <p>&copy; 2025 Ticketing Pro. Toate drepturile rezervate.</p>
    </footer>

    <?php if (!$inregistrare_reusita): ?>
    <script>
        const passwordInput = document.getElementById('parola');
        const confirmInput = document.getElementById('confirmare_parola');
        const submitBtn = document.getElementById('submitBtn');

        const reqLength = document.getElementById('req-length');
        const reqUppercase = document.getElementById('req-uppercase');
        const reqNumber = document.getElementById('req-number');
        const reqMatch = document.getElementById('req-match');

        function updateValidationUI(element, isValid) {
            const icon = element.querySelector('span');
            if (isValid) {
                element.classList.add('valid');
                icon.innerText = '✔';
            } else {
                element.classList.remove('valid');
                icon.innerText = '✖';
            }
        }

        function validateForm() {
            const pass = passwordInput.value;
            const confirm = confirmInput.value;
            
            const isLengthValid = pass.length >= 8;
            updateValidationUI(reqLength, isLengthValid);

            const isUppercaseValid = /[A-Z]/.test(pass);
            updateValidationUI(reqUppercase, isUppercaseValid);

            const isNumberValid = /[0-9!@#$%^&*(),.?":{}|<>]/.test(pass);
            updateValidationUI(reqNumber, isNumberValid);

            const isMatchValid = (pass === confirm) && (confirm.length > 0);
            updateValidationUI(reqMatch, isMatchValid);

            if (isLengthValid && isUppercaseValid && isNumberValid && isMatchValid) {
                submitBtn.disabled = false;
                submitBtn.style.backgroundColor = '#007bff';
                submitBtn.style.cursor = 'pointer';
            } else {
                submitBtn.disabled = true;
                submitBtn.style.backgroundColor = '#cccccc';
                submitBtn.style.cursor = 'not-allowed';
            }
        }

        passwordInput.addEventListener('input', validateForm);
        confirmInput.addEventListener('input', validateForm);
    </script>
    <?php endif; ?>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'exist'): ?>
        <script>alert("⚠️ Acest email este deja folosit! Te rugăm să te autentifici.");</script>
    <?php endif; ?>

</body>
</html>