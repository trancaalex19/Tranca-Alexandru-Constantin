<?php
// 1. Configurare Conexiune
define('DB_SERVER', 'mysql');         
define('DB_USERNAME', 'user');        
define('DB_PASSWORD', 'password');    
define('DB_NAME', 'studenti');        

// 2. Verificăm metoda
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Conectare
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Verificare erori conexiune
    if ($conn->connect_error) {
        die("Eroare conexiune: " . $conn->connect_error);
    }

    // Preluare date
    $nume = isset($_POST['nume']) ? trim($_POST['nume']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $subiect = isset($_POST['subiect']) ? trim($_POST['subiect']) : '';
    $mesaj = isset($_POST['mesaj']) ? trim($_POST['mesaj']) : '';

    // Inserare SQL
    $sql = "INSERT INTO mesaje_contact (nume, email, subiect, mesaj) VALUES (?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssss", $nume, $email, $subiect, $mesaj); 
        
        if ($stmt->execute()) {
            // --- SUCCES ---
            $stmt->close();
            $conn->close();
            
            // REDIRECȚIONARE: Trimitem utilizatorul înapoi la formular cu un semnal de succes
            header("Location: pagina.ajutor.php?status=success");
            exit; 
            
        } else {
            die("Eroare la salvare: " . $stmt->error);
        }
    } else {
         die("Eroare la pregătirea interogării: " . $conn->error);
    }
    
} else {
    // Dacă intră cineva direct pe pagină, îl trimitem acasă
    header("Location: pagina.ajutor.php");
    exit;
}
?>