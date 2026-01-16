<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajutor & Contact - Ticketing Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.ajutor.css">
    
    <style>
        header nav { display: flex !important; align-items: center !important; gap: 15px; }
        .user-profile {
            display: flex !important; align-items: center !important; gap: 12px !important;
            margin-left: 20px !important; padding-left: 20px; border-left: 1px solid #e0e0e0; height: 30px;
        }
        .user-icon {
            display: flex !important; justify-content: center !important; align-items: center !important;
            width: 38px !important; height: 38px !important;
            background: linear-gradient(135deg, #ff6b6b, #d9534f) !important;
            color: white !important; border-radius: 50% !important; font-weight: 700 !important;
            font-size: 18px !important; text-transform: uppercase; cursor: default;
        }
        .logout-link {
            color: #d9534f !important; border: 2px solid #d9534f; background-color: transparent;
            padding: 5px 15px !important; border-radius: 20px; font-weight: 600 !important;
            text-decoration: none !important; font-size: 0.85rem !important; text-transform: uppercase;
            transition: all 0.3s ease;
        }
        .logout-link:hover { 
            background-color: #d9534f !important; color: white !important; text-decoration: none !important;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <header>
        <div class="container">
            <a href="index.php" class="logo">Ticketing Pro</a> 
            <nav>
                <a href="pagina.meciuri.php">Meciuri</a>
                <a href="pagina.clasamente.php">Clasamente</a>
                <a href="pagina.comenzi.php">Comenzile mele</a>
                <a href="pagina.ajutor.php" class="active">Ajutor</a> 
                
                <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                    <div class="user-profile">
                        <div class="user-icon"><?php echo !empty($_SESSION["nume"]) ? strtoupper(substr($_SESSION["nume"], 0, 1)) : "U"; ?></div>
                        <a href="logout.php" class="logout-link">Logout</a>
                    </div>
                <?php else: ?>
                    <a href="pagina.login.php">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="help-page">
        <div class="container">
            <h2>Contact și Ajutor</h2>
            <p class="page-subtitle">Aveți o problemă sau o întrebare? Suntem aici pentru a vă ajuta.</p>

            <div class="help-container">
                <div class="contact-form-wrapper">
                    <h3>Trimite-ne un mesaj</h3>
                    <form id="contact-form" action="proceseaza_mesaj.php" method="POST">
                        <div class="form-group">
                            <label for="nume">Numele dumneavoastră:</label>
                            <input type="text" id="nume" name="nume" placeholder="Introduceți numele complet" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Adresa de Email:</label>
                            <input type="email" id="email" name="email" placeholder="exemplu@domeniu.ro" required>
                        </div>
                        <div class="form-group">
                            <label for="subiect">Subiect:</label>
                            <input type="text" id="subiect" name="subiect" placeholder="Ex: Problema cu biletul #12345" required>
                        </div>
                        <div class="form-group">
                            <label for="mesaj">Ce vă deranjează?</label>
                            <textarea id="mesaj" name="mesaj" rows="6" placeholder="Descrieți problema aici..." required></textarea>
                        </div>
                        <button type="submit" class="cta-button">Trimite Mesajul</button>
                    </form>
                </div>
                
                <div class="contact-details-wrapper">
                    <h3>Informații Contact</h3>
                    <h4>Sediul Firmei:</h4>
                    <p>Strada Biletelor Nr. 1, Sector 1<br>București, 010101<br>România</p>
                    <h4>Număr de Contact:</h4>
                    <p>+40 123 456 789<br>(Luni - Vineri, 09:00 - 17:00)</p>
                    <h4>Email Suport:</h4>
                    <p>contact@ticketingpro.ro</p>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Ticketing Pro. Toate drepturile rezervate.</p>
    </footer>

    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
        <script>
            alert("✅ Mesajul tău a fost trimis și salvat cu succes în baza de date!");
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.pathname);
            }
        </script>
    <?php endif; ?>

</body>
</html>