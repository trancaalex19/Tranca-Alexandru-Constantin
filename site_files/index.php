<?php
// 1. Pornim sesiunea
session_start();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticketing Pro - Pagina Principală</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.principal.css"> 

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
<body id="top">

    <header>
        <div class="container">
            <a href="index.php" class="logo">Ticketing Pro</a> 
            <nav>
                <a href="pagina.meciuri.php">Meciuri</a>
                <a href="pagina.clasamente.php">Clasamente</a>
                <a href="pagina.comenzi.php">Comenzile mele</a>
                <a href="pagina.ajutor.php">Ajutor</a>
                
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

    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Bilete Liga 1 – Meciurile Săptămânii</h1>
                <p>Cele mai așteptate derby-uri și evenimente sportive, acum disponibile online.</p>
                <a href="pagina.meciuri.php" class="cta-button">Vezi Meciurile</a>
            </div>
        </section>

        <section id="meciuri-urmatoare" class="upcoming-matches">
            <div class="container">
                <h2>Cele Mai Importante Meciuri Ale Etapei</h2>
                <div class="match-list">
                    <div class="match-card">
                        <h3>FCSB vs. Rapid București</h3>
                        <p class="match-info"><strong>Dată:</strong> Sâmbătă, 25 Octombrie - 20:30<br><strong>Stadion:</strong> Național Arena</p>
                        <a href="pagina.meciuri.php" class="ticket-button buy-btn" style="text-decoration:none; display:inline-block; text-align:center;">Cumpără Bilete »</a>
                    </div>
                    <div class="match-card">
                        <h3>CFR Cluj vs. Universitatea Craiova</h3>
                        <p class="match-info"><strong>Dată:</strong> Duminică, 26 Octombrie - 17:00<br><strong>Stadion:</strong> Dr. C. Rădulescu</p>
                         <a href="pagina.meciuri.php" class="ticket-button buy-btn" style="text-decoration:none; display:inline-block; text-align:center;">Cumpără Bilete »</a>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="stiri" class="news-section">
            <div class="container">
                <h2>Știrile Săptămânii</h2>
                <div class="news-list">
                    <div class="news-card">
                        <img src="stire1.jpg" alt="Analiză meci"> 
                        <div class="news-content">
                            <p class="news-meta">Liga 1 | 19 Octombrie 2025</p>
                            <h3>Analiză după derby: "A fost un meci tacticizat"</h3>
                            <a href="pagina.stirea1.php" class="read-more">Citește mai mult »</a>
                        </div>
                    </div>
                    <div class="news-card">
                        <img src="stire2.jpg" alt="Jucător accidentat">
                        <div class="news-content">
                            <p class="news-meta">Transferuri | 18 Octombrie 2025</p>
                            <h3>Mutare de ultimă oră! Atacantul Harlem Gnohéré semnează cu FCSB</h3>
                            <a href="pagina.stirea2.php" class="read-more">Citește mai mult »</a>
                        </div>
                    </div>
                    <div class="news-card">
                        <img src="stire3.jpg" alt="Conferință de presă">
                        <div class="news-content">
                            <p class="news-meta">Națională | 17 Octombrie 2025</p>
                            <h3>Selecționerul a anunțat lotul pentru meciurile viitoare</h3>
                            <a href="pagina.stirea3.php" class="read-more">Citește mai mult »</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Ticketing Pro. Toate drepturile rezervate.</p>
    </footer>
</body>
</html>