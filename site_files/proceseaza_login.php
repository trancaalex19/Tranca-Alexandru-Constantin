<?php
session_start(); // PORNEȘTE SESIUNEA

// 1. Configurare
define('DB_SERVER', 'mysql');         
define('DB_USERNAME', 'user');        
define('DB_PASSWORD', 'password');    
define('DB_NAME', 'studenti');        

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Eroare conexiune: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // MODIFICARE 1: Am adăugat ', role' în lista de coloane selectate
    $sql = "SELECT user_id, nume_complet, password_hash, role FROM users WHERE email = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        
        // Verificăm dacă există emailul
        if ($stmt->num_rows == 1) {
            // MODIFICARE 2: Am adăugat variabila $role aici
            $stmt->bind_result($id, $nume, $hashed_password, $role);
            $stmt->fetch();
            
            // Verificăm parola
            if (password_verify($password, $hashed_password)) {
                // --- PAROLA E CORECTĂ! ---
                
                // Salvăm datele în sesiune
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $id;
                $_SESSION["nume"] = $nume;
                
                // MODIFICARE 3: Salvăm rolul în sesiune (CRITIC PENTRU ADMIN)
                $_SESSION["role"] = $role;                            
                
                // Redirecționăm către pagina de meciuri
                header("location: pagina.meciuri.php");
            } else {
                // Parolă greșită
                header("location: pagina.login.php?error=invalid");
            }
        } else {
            // Email inexistent
            header("location: pagina.login.php?error=nouser");
        }
        $stmt->close();
    }
    $conn->close();
}
?>