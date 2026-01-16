<?php
session_start();

// 1. Verificăm dacă utilizatorul e logat
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    echo json_encode(["status" => "error", "message" => "Trebuie să fii autentificat pentru a finaliza!"]);
    exit;
}

// 2. Conectare Bază de Date
define('DB_SERVER', 'mysql');
define('DB_USERNAME', 'user');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'studenti');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Eroare DB"]));
}

// 3. Primim datele din coș (JSON)
$inputJSON = file_get_contents('php://input');
$comenzi = json_decode($inputJSON, true);

if (!empty($comenzi)) {
    $user_id = $_SESSION["id"]; // ID-ul persoanei logate

    $sql = "INSERT INTO comenzi (user_id, meci, zona, cantitate, pret_total) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    foreach ($comenzi as $comanda) {
        // Curățăm prețul (scoatem " RON")
        $pret = floatval(preg_replace('/[^0-9.]/', '', $comanda['pretTotal']));
        $stmt->bind_param("issid", $user_id, $comanda['meci'], $comanda['zona'], $comanda['cantitate'], $pret);
        $stmt->execute();
    }

    $stmt->close();
    echo json_encode(["status" => "success", "message" => "Comanda a fost salvată în contul tău!"]);
}
$conn->close();
?>