<?php
// Logică PHP pentru procesarea formularului
$email_trimis = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aici ar veni codul care trimite efectiv emailul (prin funcția mail() sau SMTP)
    // Momentan doar simulăm succesul pentru a afișa mesajul.
    $email_trimis = true; 
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperare Parolă - Ticketing Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.login.css">
    
    <style>
        /* Stil specific pentru mesajul de succes */
        .success-icon { font-size: 3rem; margin-bottom: 15px; display: block; }
        .success-message { color: #28a745; font-weight: bold; font-size: 1.1rem; margin-bottom: 10px; }
        .info-text { color: #666; font-size: 0.9rem; margin-bottom: 25px; line-height: 1.6; }
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
        </nav>
    </header>

    <main class="login-page">
        <div class="login-card" style="text-align: center;">
            
            <?php if ($email_trimis): ?>
                <div class="success-icon">📩</div>
                <h1 class="success-message">Email Trimis cu Succes!</h1>
                <p class="info-text">
                    Am trimis un link de resetare a parolei la adresa introdusă. 
                    Te rugăm să verifici și folderul Spam.
                </p>
                <a href="pagina.login.php" class="submit-btn" style="text-decoration: none; display: inline-block; line-height: 45px;">Înapoi la Autentificare</a>

            <?php else: ?>
                <h1>Recuperare Parolă</h1>
                <p class="subtitle">Introdu adresa de email pentru a primi instrucțiunile de resetare.</p>

                <form action="" method="POST">
                    <div class="form-group" style="text-align: left;">
                        <label for="email">Adresă Email:</label>
                        <input type="email" id="email" name="email" placeholder="exemplu@mail.com" required>
                    </div>
                    
                    <button type="submit" class="submit-btn">Trimite Link Resetare</button>
                </form>
                
                <p class="register-info">
                    <a href="pagina.login.php">« Înapoi la autentificare</a>
                </p>
            <?php endif; ?>

        </div>
    </main>

    <footer>
        <p>&copy; 2025 Ticketing Pro. Toate drepturile rezervate.</p>
    </footer>

</body>
</html>