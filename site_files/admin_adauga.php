<?php
session_start();

// 1. SECURITATE: Verificăm dacă e admin. Dacă nu, îl dăm afară.
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Acces interzis! Nu ești administrator.");
}

// 2. Conectare Bază de Date
define('DB_SERVER', 'mysql');
define('DB_USERNAME', 'user');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'studenti');
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) { die("Eroare DB: " . $conn->connect_error); }

// 3. Procesăm formularul
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $e1 = $_POST['echipa1'];
    $e2 = $_POST['echipa2'];
    $data = $_POST['data_meci'];
    $stadion = $_POST['stadion'];
    
    // Preluăm cele 4 prețuri
    $p_peluza = $_POST['pret_peluza'];
    $p_tribuna2 = $_POST['pret_tribuna2'];
    $p_tribuna1 = $_POST['pret_tribuna1'];
    $p_vip = $_POST['pret_vip'];
    
    // Inserăm în baza de date
    // s = string, d = double (număr cu virgulă)
    $sql = "INSERT INTO meciuri (echipa1, echipa2, data_meci, stadion, pret_peluza, pret_tribuna2, pret_tribuna1, pret_vip) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssdddd", $e1, $e2, $data, $stadion, $p_peluza, $p_tribuna2, $p_tribuna1, $p_vip);
    
    if($stmt->execute()) {
        // Dacă a mers, ne întoarcem la pagina de meciuri
        header("Location: pagina.meciuri.php");
    } else {
        echo "Eroare la inserare: " . $stmt->error;
    }
    
    $stmt->close();
}
$conn->close();
?>