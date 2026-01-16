<?php
// 1. Pornim sesiunea
session_start();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mutare de ultimă oră - Ticketing Pro</title>
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
                <h1>Mutare de ultimă oră! Atacantul Harlem Gnohéré semnează cu FCSB</h1>
                <p class="meta">Transferuri | 18 Octombrie 2025 | Autor: Redacția Sport</p>
            </div>

            <img src="stire22.jpg" alt="Jucător semnează contract" class="main-image">

            <p>
                <strong>BUCUREȘTI</strong> - După săptămâni de negocieri intense, Clubul Sportiv Fotbal Club Steaua București (FCSB) a anunțat oficial transferul atacantului Harlem Gnohéré. Jucătorul, cunoscut pentru forța fizică și experiența sa, revine astfel în Liga 1 după o perioadă petrecută în străinătate.
            </p>

            <p>
                Contractul a fost semnat pe o perioadă de doi ani, cu opțiune de prelungire pentru încă un sezon, dacă se îndeplinesc obiectivele sportive. Suma transferului nu a fost dezvăluită, dar se zvonește că salariul atacantului se ridică la 300.000 de euro pe sezon. Fan base-ul este entuziasmat de revenirea "Bizonului".
            </p>
            
            <p>
                Conducerea clubului și-a exprimat încrederea că această mutare va consolida atacul și va oferi soluții valoroase pentru meciurile viitoare. Gnohéré va purta tricoul cu numărul 99 și se va alătura echipei în cantonamentul de la începutul săptămânii viitoare.
            </p>
            
            <p>
                "Gnohéré este o garanție a golului și aduce experiență de necontestat în vestiar. El va fi un atu esențial în lupta pentru titlu," a declarat directorul sportiv al clubului. NE AȘTEPTĂM LA MULTĂ FORȚĂ ȘI GOLURI DIN PARTEA LUI.
            </p>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Ticketing Pro. Toate drepturile rezervate.</p>
    </footer>
</body>
</html>