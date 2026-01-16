<?php
session_start();

// 1. SECURITATE: Verificăm dacă e admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Acces interzis!");
}

// 2. Conectare Bază de Date
define('DB_SERVER', 'mysql');
define('DB_USERNAME', 'user');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'studenti');
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// 3. Ștergem meciul pe baza ID-ului primit
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Ne asigurăm că e număr
    
    $stmt = $conn->prepare("DELETE FROM meciuri WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// 4. Ne întoarcem la pagină
header("Location: pagina.meciuri.php");
exit;
?>