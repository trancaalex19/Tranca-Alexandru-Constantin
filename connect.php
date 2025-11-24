<?php
// Detalii de conectare la baza de date
define('DB_SERVER', 'mysql');         // Numele serviciului Docker (NU localhost)
define('DB_USERNAME', 'user');        // MYSQL_USER din docker-compose
define('DB_PASSWORD', 'password');    // MYSQL_PASSWORD din docker-compose
define('DB_NAME', 'studenti');        // MYSQL_DATABASE din docker-compose

// Tentativă de conectare folosind MySQLi
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificare conexiune
if($conn === false){
    die("EROARE: Nu s-a putut conecta la baza de date. " . $conn->connect_error);
}

echo "Conexiunea la baza de date a reușit!";

// Puteți închide conexiunea la sfârșitul scriptului
//$conn->close();
?>