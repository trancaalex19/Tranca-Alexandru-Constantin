<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clasamente - Ticketing Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.clasamente.css">
    
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
                <a href="pagina.clasamente.php" class="active">Clasamente</a>
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
        <section id="clasamente" class="standings page-section">
            <div class="container">
                <h2>Clasamente</h2>
                
                <div class="standings-wrapper">
                    <h3>Liga 1</h3>
                    <table>
                        <thead><tr><th>Poz</th><th>Echipă</th><th>MJ</th><th>Pct</th></tr></thead>
                        <tbody>
                            <tr><td>1</td><td>FCSB</td><td>12</td><td><strong>30</strong></td></tr>
                            <tr><td>2</td><td>CFR Cluj</td><td>12</td><td><strong>28</strong></td></tr>
                            <tr><td>3</td><td>Rapid București</td><td>12</td><td><strong>25</strong></td></tr>
                            <tr><td>4</td><td>Universitatea Craiova</td><td>12</td><td><strong>22</strong></td></tr>
                            <tr><td>5</td><td>Farul Constanța</td><td>12</td><td><strong>20</strong></td></tr>
                            <tr><td>6</td><td>Sepsi OSK</td><td>12</td><td><strong>18</strong></td></tr>
                            <tr><td>7</td><td>Oțelul Galați</td><td>12</td><td><strong>17</strong></td></tr>
                            <tr><td>8</td><td>FC Hermannstadt</td><td>12</td><td><strong>16</strong></td></tr>
                            <tr><td>9</td><td>Petrolul Ploiești</td><td>12</td><td><strong>15</strong></td></tr>
                            <tr><td>10</td><td>UTA Arad</td><td>12</td><td><strong>14</strong></td></tr>
                            <tr><td>11</td><td>FC U Craiova 1948</td><td>12</td><td><strong>13</strong></td></tr>
                            <tr><td>12</td><td>Dinamo București</td><td>12</td><td><strong>12</strong></td></tr>
                            <tr><td>13</td><td>Politehnica Iași</td><td>12</td><td><strong>11</strong></td></tr>
                            <tr><td>14</td><td>FC Voluntari</td><td>12</td><td><strong>10</strong></td></tr>
                            <tr><td>15</td><td>FC Botoșani</td><td>12</td><td><strong>8</strong></td></tr>
                            <tr><td>16</td><td>Gloria Buzău</td><td>12</td><td><strong>7</strong></td></tr>
                        </tbody>
                    </table>

                    <h3>Liga 2</h3>
                    <table>
                         <thead><tr><th>Poz</th><th>Echipă</th><th>MJ</th><th>Pct</th></tr></thead>
                        <tbody>
                            <tr><td>1</td><td>Unirea Slobozia</td><td>10</td><td><strong>25</strong></td></tr>
                            <tr><td>2</td><td>Corvinul Hunedoara</td><td>10</td><td><strong>22</strong></td></tr>
                            <tr><td>3</td><td>CS Mioveni</td><td>10</td><td><strong>20</strong></td></tr>
                            <tr><td>4</td><td>Șelimbăr</td><td>10</td><td><strong>19</strong></td></tr>
                            <tr><td>5</td><td>CFC Argeș</td><td>10</td><td><strong>18</strong></td></tr>
                            <tr><td>6</td><td>Chindia Târgoviște</td><td>10</td><td><strong>17</strong></td></tr>
                            <tr><td>7</td><td>Metaloglobus</td><td>10</td><td><strong>15</strong></td></tr>
                            <tr><td>8</td><td>Viitorul Pandurii</td><td>10</td><td><strong>14</strong></td></tr>
                            <tr><td>9</td><td>CSM Reșița</td><td>10</td><td><strong>12</strong></td></tr>
                            <tr><td>10</td><td>CSC Dumbrăvița</td><td>10</td><td><strong>11</strong></td></tr>
                        </tbody>
                    </table>
                    
                     <h3>Liga 3 (Seria 1)</h3>
                    <table>
                        <thead><tr><th>Poz</th><th>Echipă</th><th>MJ</th><th>Pct</th></tr></thead>
                        <tbody>
                            <tr><td>1</td><td>Bucovina Rădăuți</td><td>9</td><td><strong>23</strong></td></tr>
                            <tr><td>2</td><td>CSM Focșani</td><td>9</td><td><strong>21</strong></td></tr>
                            <tr><td>3</td><td>Foresta Suceava</td><td>9</td><td><strong>19</strong></td></tr>
                            <tr><td>4</td><td>Știința Miroslava</td><td>9</td><td><strong>17</strong></td></tr>
                            <tr><td>5</td><td>CSM Vaslui</td><td>9</td><td><strong>15</strong></td></tr>
                            <tr><td>6</td><td>Rapid Brodoc</td><td>9</td><td><strong>12</strong></td></tr>
                            <tr><td>7</td><td>FC Bacău</td><td>9</td><td><strong>10</strong></td></tr>
                            <tr><td>8</td><td>Aerostar Bacău</td><td>9</td><td><strong>8</strong></td></tr>
                            <tr><td>9</td><td>Șomuz Fălticeni</td><td>9</td><td><strong>6</strong></td></tr>
                            <tr><td>10</td><td>CSM Pașcani</td><td>9</td><td><strong>4</strong></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Ticketing Pro. Toate drepturile rezervate.</p>
    </footer>

</body>
</html>