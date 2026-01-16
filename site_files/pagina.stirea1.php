<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analiză după derby - Ticketing Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.stiri.css"> 
    
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

    <main class="article-page">
        <div class="container">
            <div class="article-header">
                <h1>Analiză după derby: "A fost un meci tacticizat"</h1>
                <p class="meta">Liga 1 | 19 Octombrie 2025 | Autor: Ion Ionel Ionut</p>
            </div>
            <img src="pozastire1.jpg" alt="Antrenori la conferință" class="main-image">
            <p><strong>BUCUREȘTI</strong> - Derby-ul așteptat al etapei s-a încheiat aseară cu un rezultat de egalitate, 0-0, lăsând fanii cu un gust amar, dar oferind analiștilor sportivi mult material de studiu tactic. Tehnicienii ambelor echipe s-au declarat mulțumiți de atitudinea jucătorilor, punând accentul pe prudența care a dominat jocul.</p>
            <p>Jocul de aseară a fost un exemplu de fotbal modern, axat pe posesie sterilă și apărare ermetică. Mijlocul terenului a fost aglomerat, cu puține spații de pătrundere. S-au înregistrat doar trei șuturi pe poartă pe tot parcursul partidei, demonstrând frica de a risca a ambelor tabere.</p>
            <p>Unul dintre antrenori a subliniat că echilibrul din teren a fost rezultatul pregătirii minuțioase din timpul săptămânii: "Ambele echipe s-au anihilat la mijlocul terenului. Nu ne-am dorit să riscăm, având în vedere miza meciului. Este un punct câștigat."</p>
            <p>Acest rezultat menține distanța dintre cele două echipe în clasament, iar antrenorii se pot concentra pe următoarea etapă, știind că echipa a dat dovadă de disciplină tactică. AMENINȚĂRILE OFENSIVE AU FOST APROAPE INEXISTENTE.</p>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Ticketing Pro. Toate drepturile rezervate.</p>
    </footer>
</body>
</html>