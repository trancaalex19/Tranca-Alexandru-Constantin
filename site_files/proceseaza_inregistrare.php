<?php
// proceseaza_inregistrare.php

// 1. Configurare Conexiune Bază de Date
define('DB_SERVER', 'mysql');
define('DB_USERNAME', 'user');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'studenti');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificare conexiune
if ($conn->connect_error) {
    die("EROARE CONEXIUNE DB: " . $conn->connect_error);
}

// 2. Procesare Formular
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Preluăm datele și le curățăm de spații
    $nume = trim($_POST['nume']);
    $email = trim($_POST['email']);
    $parola = $_POST['parola'];
    $confirmare_parola = $_POST['confirmare_parola'];

    // A. Validare simplă: Parolele coincid?
    if ($parola !== $confirmare_parola) {
        $conn->close();
        // Trimitem înapoi cu eroare (deși JS-ul ar trebui să prindă asta)
        header("Location: creare.cont.php?status=mismatch");
        exit;
    }

    // B. Validare: Email-ul există deja în baza de date?
    // NOTĂ: Asigură-te că tabelul tău se numește 'users' sau 'utilizatori'
    $check_sql = "SELECT user_id FROM users WHERE email = ?";
    if ($stmt_check = $conn->prepare($check_sql)) {
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            // Emailul există deja
            $stmt_check->close();
            $conn->close();
            header("Location: creare.cont.php?status=exist");
            exit;
        }
        $stmt_check->close();
    }

    // C. Salvare Utilizator Nou
    // Criptăm parola
    $password_hash = password_hash($parola, PASSWORD_DEFAULT);

    // Inserăm în tabelul 'users' (Verifică dacă coloanele tale sunt: nume_complet, email, password_hash)
    $sql = "INSERT INTO users (nume_complet, email, password_hash) VALUES (?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $nume, $email, $password_hash);
        
        if ($stmt->execute()) {
            // --- SUCCES ---
            // Aici este partea importantă: Redirecționăm către aceeași pagină cu ?status=success
            $stmt->close();
            $conn->close();
            header("Location: creare.cont.php?status=success");
            exit; 
        } else {
            echo "Eroare la salvare: " . $stmt->error;
        }
    } else {
         echo "Eroare SQL (Verifică numele tabelului/coloanelor): " . $conn->error;
    }

} else {
    // Dacă cineva încearcă să intre direct pe acest fișier fără formular
    header("Location: creare.cont.php");
    exit;
}
?>