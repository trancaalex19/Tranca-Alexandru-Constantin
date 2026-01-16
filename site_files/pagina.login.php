<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificare - Ticketing Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.login.css">
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
        <div class="login-card">
            <h1>Acces Cont Client</h1>
            <p class="subtitle">Vă rugăm să vă introduceți datele pentru a accesa biletele.</p>
            
            <form action="proceseaza_login.php" method="POST">
                
                <div class="form-group">
                    <label for="email">Adresă Email:</label>
                    <input type="email" id="email" name="email" placeholder="exemplu@mail.com" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Parolă:</label>
                    <input type="password" id="password" name="password" placeholder="Parola ta" required>
                </div>
                
                <div class="options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Ține-mă minte
                    </label>
                    <a href="pagina.recuperare.php" class="forgot-password">Am uitat parola</a>
                </div>
                
                <button type="submit" class="submit-btn">Autentificare</button>
            </form>
            
            <p class="register-info">
                Ești client nou? 
                <a href="creare.cont.php">Creează un cont</a>
            </p>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Ticketing Pro. Toate drepturile rezervate.</p>
    </footer>

    <?php if (isset($_GET['error'])): ?>
        <script>
            const error = "<?php echo $_GET['error']; ?>";
            if (error === 'invalid') {
                alert("❌ Email sau parolă incorectă!");
            } else if (error === 'nouser') {
                alert("⚠️ Nu există un cont cu acest email.");
            }
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname);
            }
        </script>
    <?php endif; ?>

</body>
</html>