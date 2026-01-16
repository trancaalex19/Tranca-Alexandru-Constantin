<?php
// 1. Pornim sesiunea
session_start();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anunț lot Național - Ticketing Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.stiri.css"> 
    
    <style>
        /* Meniu */
        header nav { display: flex !important; align-items: center !important; gap: 15px; }
        
        /* Profil Utilizator */
        .user-profile {
            display: flex !important; align-items: center !important; gap: 12px !important;
            margin-left: 20px !important; padding-left: 20px; border-left: 1px solid #e0e0e0; height: 30px;
        }
        
        /* Iconita Rotundă */
        .user-icon {
            display: flex !important; justify-content: center !important; align-items: center !important;
            width: 38px !important; height: 38px !important;
            background: linear-gradient(135deg, #ff6b6b, #d9534f) !important;
            color: white !important; border-radius: 50% !important; font-weight: 700 !important;
            font-size: 18px !important; text-transform: uppercase; cursor: default;
        }
        
        /* Buton Logout Modern */
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
                        <div class="user-icon" title="Contul lui <?php echo htmlspecialchars($_SESSION['nume']); ?>">
                            <?php echo !empty($_SESSION["nume"]) ? strtoupper(substr($_SESSION["nume"], 0, 1)) : "U"; ?>
                        </div>
                        <a href="logout.php" class="logout-link">Logout</a>
                    </div>
                <?php else: ?>
                    <a href="pagina.login.php">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="article-page">
        <div class="container">
            <div class="article-header">
                <h1>Selecționerul a anunțat lotul pentru meciurile viitoare</h1>
                <p class="meta">Națională | 17 Octombrie 2025 | Autor: FRF Press</p>
            </div>

            <img src="stire33.jpg" alt="Conferință de presă" class="main-image">

            <p>
                <strong>CLUJ-NAPOCA</strong> - În cadrul unei conferințe de presă, selecționerul echipei naționale a României a prezentat lista finală a jucătorilor convocați pentru următoarele două meciuri de calificare. Lotul include o serie de surprize, punând accentul pe tinerii talentați din Liga 1.
            </p>

            <p>
                Lista finală include portarul debutant Andrei Vlad și atacantul Florinel Coman, ambii în mare formă. Marea surpriză este însă revenirea veteranului Cristi Săpunaru, care va aduce un plus de experiență și leadership în apărare. JUCĂTORII VOR INTRA ÎN CANTONAMENT LUNI.
            </p>

            <p>
                Printre noutățile absolute se numără doi debutanți, în timp ce un veteran al echipei naționale revine în lot după o pauză de aproape un an, aducând un plus de experiență.
            </p>
            
            <p>
                Selecționerul a subliniat că obiectivul principal este calificarea. "Avem încredere în acești băieți. Adversarii sunt puternici, dar suntem pregătiți să luptăm pentru fiecare punct," a concluzionat acesta. SPERĂM LA O EVOLUȚIE EXCELENTĂ.
            </p>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Ticketing Pro. Toate drepturile rezervate.</p>
    </footer>
</body>
</html>