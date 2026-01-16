<?php
session_start();

// 1. Configurare DB
define('DB_SERVER', 'mysql');
define('DB_USERNAME', 'user');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'studenti');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
$istoric_db = []; 
$user_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;
$is_logged_in = isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true;

// 2. Dacă e logat, aducem istoricul permanent
if ($is_logged_in && !$conn->connect_error) {
    $conn->set_charset("utf8mb4");
    $sql = "SELECT * FROM comenzi WHERE user_id = ? ORDER BY data_comanda DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $istoric_db[] = $row;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comenzile Mele - Ticketing Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.comenzi.css">
    
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
                <a href="pagina.comenzi.php" class="active">Comenzile mele</a>
                <a href="pagina.ajutor.php">Ajutor</a>

                <?php if($is_logged_in): ?>
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

    <main class="order-history-page">
        <div class="container">
            
            <h2 id="cart-title" class="section-title">Coșul Curent (Nefinalizate)</h2>
            
            <div id="orders-list"></div>
            
            <div id="empty-state" class="empty-state-container">
                <div class="empty-state-icon">🛒</div> 
                <p class="empty-state-text">Coșul tău este gol.</p>
            </div>

            <?php if($is_logged_in): ?>
                
                <h2 class="section-title">Istoric Comenzi (Confirmate)</h2>

                <?php if(empty($istoric_db)): ?>
                    <p style="text-align:center; color:#888; margin-top:20px;">Nu ai comenzi anterioare salvate.</p>
                <?php else: ?>
                    <div style="max-width: 800px; margin: 0 auto;">
                        <?php foreach($istoric_db as $dbOrder): ?>
                            <div class="order-card history-card">
                                <div class="order-info">
                                    <h3><?php echo htmlspecialchars($dbOrder['meci']); ?></h3>
                                    <div class="order-details">
                                        <strong>Zona:</strong> <?php echo htmlspecialchars($dbOrder['zona']); ?> <br>
                                        <strong>Bilete:</strong> <?php echo $dbOrder['cantitate']; ?> buc. <br>
                                        <strong>Data:</strong> <?php echo date('d.m.Y H:i', strtotime($dbOrder['data_comanda'])); ?>
                                    </div>
                                </div>
                                <div class="order-actions">
                                    <div class="order-price">
                                        <?php echo number_format($dbOrder['pret_total'], 2); ?> RON
                                    </div>
                                    <span class="status-finalized">✔ Finalizată</span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <div style="text-align:center; margin-top:60px; color:#999; font-size:0.9rem;">
                    Autentifică-te pentru a vedea istoricul permanent al comenzilor.
                </div>
            <?php endif; ?>

        </div>
    </main>

    <footer>
        <p>&copy; 2025 Ticketing Pro. Toate drepturile rezervate.</p>
    </footer>

    <script>
        const userIsLoggedIn = <?php echo $is_logged_in ? 'true' : 'false'; ?>;

        document.addEventListener('DOMContentLoaded', function() {
            const ordersList = document.getElementById('orders-list');
            const emptyState = document.getElementById('empty-state');
            const cartTitle = document.getElementById('cart-title');

            function incarcaCos() {
                let comenzi = JSON.parse(localStorage.getItem('comenziBilete')) || [];

                if (comenzi.length === 0) {
                    ordersList.style.display = 'none';
                    emptyState.style.display = 'block';
                    return;
                } 
                
                ordersList.style.display = 'block';
                emptyState.style.display = 'none';
                ordersList.innerHTML = '';

                comenzi.slice().reverse().forEach((comanda, index) => {
                    const indexReal = comenzi.length - 1 - index;
                    
                    const card = document.createElement('div');
                    card.className = 'order-card'; 
                    
                    card.innerHTML = `
                        <div class="order-info">
                            <h3>${comanda.meci}</h3>
                            <div class="order-details">
                                <strong>Zona:</strong> ${comanda.zona} <br>
                                <strong>Bilete:</strong> ${comanda.cantitate} buc. <br>
                                <span style="font-size:0.85rem; color:#999;">În coș (nefinalizat)</span>
                            </div>
                        </div>
                        <div class="order-actions">
                            <div class="order-price">${comanda.pretTotal} RON</div>
                            <button class="finalize-btn" onclick="finalizeazaComanda()">Finalizează</button>
                            <button class="delete-btn" onclick="stergeDinCos(${indexReal})">Șterge</button>
                        </div>
                    `;
                    ordersList.appendChild(card);
                });
            }

            window.finalizeazaComanda = function() {
                if (!userIsLoggedIn) {
                    alert("⚠️ Trebuie să fii autentificat pentru a finaliza comanda!");
                    window.location.href = "pagina.login.php";
                    return;
                }

                let comenzi = JSON.parse(localStorage.getItem('comenziBilete')) || [];
                if (comenzi.length === 0) return;

                fetch('proceseaza_finalizare.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(comenzi)
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert("✅ " + data.message);
                        localStorage.removeItem('comenziBilete'); 
                        window.location.reload(); 
                    } else {
                        alert("❌ Eroare: " + data.message);
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Eroare de comunicare cu serverul.");
                });
            };

            window.stergeDinCos = function(index) {
                if(confirm("Ștergi acest bilet din coș?")) {
                    let comenzi = JSON.parse(localStorage.getItem('comenziBilete')) || [];
                    comenzi.splice(index, 1);
                    localStorage.setItem('comenziBilete', JSON.stringify(comenzi));
                    incarcaCos();
                }
            };

            incarcaCos();
        });
    </script>

</body>
</html>