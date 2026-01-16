<?php
session_start();

// 1. Conectare Bază de Date
define('DB_SERVER', 'mysql');
define('DB_USERNAME', 'user');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'studenti');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) { die("Eroare conexiune: " . $conn->connect_error); }

$conn->set_charset("utf8mb4");

$isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Meciuri - Ticketing Pro</title> 
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.meciuri.css?v=<?php echo time(); ?>"> 
    
    <style>
        /* Acestea sunt stilurile care au funcționat perfect dincolo */
        header nav { display: flex !important; align-items: center !important; gap: 15px !important; }
        
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

        /* Fix Modal */
        .force-visible {
            display: block !important; width: 100% !important; padding: 10px;
            margin: 10px 0; border: 1px solid #ccc; border-radius: 8px;
        }
    </style>
</head>
<body>

    <header>
        <div class="container">
            <a href="index.php" class="logo">Ticketing Pro</a>
            
            <nav>
                <a href="pagina.meciuri.php" class="active">Meciuri</a>
                <a href="pagina.clasamente.php">Clasamente</a>
                <a href="pagina.comenzi.php">Comenzile mele</a>
                <a href="pagina.ajutor.php">Ajutor</a>

                <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
                    <div class="user-profile">
                        <div class="user-icon" title="<?php echo htmlspecialchars($_SESSION['nume']); ?>">
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

    <main class="container main-content-area">
        <h2 class="page-title">Program Meciuri</h2>

        <?php if($isAdmin): ?>
            <div class="admin-panel">
                <h3>👑 Panou Admin: Adaugă Meci Nou</h3>
                <form action="admin_adauga.php" method="POST" class="admin-form">
                    <div class="form-row">
                        <input type="text" name="echipa1" placeholder="Echipa Gazdă" required>
                        <input type="text" name="echipa2" placeholder="Echipa Oaspete" required>
                        <input type="datetime-local" name="data_meci" required>
                        <input type="text" name="stadion" placeholder="Stadion" required>
                    </div>
                    <div class="form-row">
                        <input type="number" name="pret_peluza" placeholder="Preț Peluză" step="0.01" required>
                        <input type="number" name="pret_tribuna2" placeholder="Preț T2" step="0.01" required>
                        <input type="number" name="pret_tribuna1" placeholder="Preț T1" step="0.01" required>
                        <input type="number" name="pret_vip" placeholder="Preț VIP" step="0.01" required>
                    </div>
                    <button type="submit" class="btn-admin-add">+ Adaugă Meci</button>
                </form>
            </div>
        <?php endif; ?>
        <div class="match-grid">
            <?php
            $res = $conn->query("SELECT * FROM meciuri ORDER BY data_meci ASC");
            if ($res->num_rows > 0):
                while($row = $res->fetch_assoc()):
                    $timestamp = strtotime($row['data_meci']);
                    $zile = ['Sunday'=>'Duminică','Monday'=>'Luni','Tuesday'=>'Marți','Wednesday'=>'Miercuri','Thursday'=>'Joi','Friday'=>'Vineri','Saturday'=>'Sâmbătă'];
                    $luni = ['January'=>'Ianuarie','February'=>'Februarie','March'=>'Martie','April'=>'Aprilie','May'=>'Mai','June'=>'Iunie','July'=>'Iulie','August'=>'August','September'=>'Septembrie','October'=>'Octombrie','November'=>'Noiembrie','December'=>'Decembrie'];
                    
                    $zi_en = date('l', $timestamp);
                    $luna_en = date('F', $timestamp);
                    $data_formatata = $zile[$zi_en] . ", " . date('d', $timestamp) . " " . $luni[$luna_en] . " - " . date('H:i', $timestamp);
            ?>
                <div class="match-card">
                    <h3><?php echo htmlspecialchars($row['echipa1']); ?> vs. <?php echo htmlspecialchars($row['echipa2']); ?></h3>
                    
                    <div class="match-info">
                        <p><strong>Dată:</strong> <?php echo $data_formatata; ?></p>
                        <p><strong>Stadion:</strong> <?php echo htmlspecialchars($row['stadion']); ?></p>
                    </div>
                    
                    <button class="btn-ticket" 
                            data-meci="<?php echo $row['echipa1'] . ' vs. ' . $row['echipa2']; ?>"
                            data-p1="<?php echo $row['pret_peluza']; ?>"
                            data-p2="<?php echo $row['pret_tribuna2']; ?>"
                            data-p3="<?php echo $row['pret_tribuna1']; ?>"
                            data-p4="<?php echo $row['pret_vip']; ?>">
                        Cumpără Bilete »
                    </button>

                    <?php if($isAdmin): ?>
                        <a href="admin_sterge.php?id=<?php echo $row['id']; ?>" class="admin-link" onclick="return confirm('Sigur?')">Șterge</a>
                    <?php endif; ?>
                </div>
            <?php 
                endwhile; 
            else:
                echo "<p>Nu există meciuri programate.</p>";
            endif; 
            ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Ticketing Pro. Toate drepturile rezervate.</p>
    </footer>

    <div id="modal-overlay">
        <div class="modal-box">
            <h2 id="modal-title" style="margin-top:0; color:#333;">Rezervare</h2>
            <form id="purchase-form">
                <div style="margin-bottom:15px; text-align:left;">
                    <label style="font-weight:600;">Alege Zona:</label>
                    <select id="select-zona" class="force-visible" required>
                        <option value="" disabled selected>-- Selectează --</option>
                        <option value="" id="opt-1"></option>
                        <option value="" id="opt-2"></option>
                        <option value="" id="opt-3"></option>
                        <option value="" id="opt-4"></option>
                    </select>
                </div>
                
                <div style="margin-bottom:15px; text-align:left;">
                    <label style="font-weight:600;">Număr Bilete:</label>
                    <input type="number" id="input-qty" class="force-visible" min="1" max="10" value="1" required>
                </div>

                <div class="total-price">Total: <span id="display-total">0</span> RON</div>
                
                <button type="submit" class="btn-confirm">ADĂUGARE ÎN COȘ</button>
                <button type="button" class="btn-close-modal">Anulează</button>
            </form>
        </div>
    </div>

    <script>
        const overlay = document.getElementById('modal-overlay');
        const totalSpan = document.getElementById('display-total');
        const zonaSelect = document.getElementById('select-zona');
        const qtyInput = document.getElementById('input-qty');
        let currentMatch = "";

        document.querySelectorAll('.btn-ticket').forEach(btn => {
            btn.addEventListener('click', () => {
                currentMatch = btn.getAttribute('data-meci');
                document.getElementById('modal-title').innerText = currentMatch;
                setupOption('opt-1', 'Peluza', btn.getAttribute('data-p1'));
                setupOption('opt-2', 'Tribuna 2', btn.getAttribute('data-p2'));
                setupOption('opt-3', 'Tribuna 1', btn.getAttribute('data-p3'));
                setupOption('opt-4', 'VIP', btn.getAttribute('data-p4'));
                zonaSelect.value = "";
                qtyInput.value = 1;
                totalSpan.innerText = "0";
                overlay.style.display = 'flex';
            });
        });

        function setupOption(id, name, price) {
            const el = document.getElementById(id);
            el.innerText = `${name} (${price} RON)`;
            el.value = price;
        }

        function calcTotal() {
            const p = parseFloat(zonaSelect.value) || 0;
            const q = parseInt(qtyInput.value) || 1;
            totalSpan.innerText = (p * q).toFixed(2);
        }
        zonaSelect.addEventListener('change', calcTotal);
        qtyInput.addEventListener('input', calcTotal);

        document.querySelector('.btn-close-modal').addEventListener('click', () => { overlay.style.display = 'none'; });

        document.getElementById('purchase-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const zonaName = zonaSelect.options[zonaSelect.selectedIndex].text.split(' (')[0];
            const order = {
                meci: currentMatch,
                zona: zonaName,
                cantitate: qtyInput.value,
                pretTotal: totalSpan.innerText,
                data: new Date().toLocaleString(),
                finalizata: false
            };
            let cart = JSON.parse(localStorage.getItem('comenziBilete')) || [];
            cart.push(order);
            localStorage.setItem('comenziBilete', JSON.stringify(cart));
            alert("Bilet adăugat în coș!");
            overlay.style.display = 'none';
        });
    </script>
</body>
</html>