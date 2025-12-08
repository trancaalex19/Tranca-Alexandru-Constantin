<?php
// --- PARTEA DE PHP (SERVER-SIDE) ---
// Verificăm dacă cererea este de tip POST (formular trimis)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json'); // Setăm răspunsul ca JSON

    $nume = trim($_POST['nume'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mesaj = trim($_POST['mesaj'] ?? '');

    $errors = [];

    // 1. Validare Nume (minim 3 caractere)
    if (strlen($nume) < 3) {
        $errors['nume'] = "Numele trebuie să aibă minim 3 caractere.";
    }

    // 2. Validare Email (format valid)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Introduceți o adresă de email validă.";
    }

    // 3. Validare Mesaj (minim 10 caractere)
    if (strlen($mesaj) < 10) {
        $errors['mesaj'] = "Mesajul trebuie să conțină minim 10 caractere.";
    }

    // Verificăm dacă există erori
    if (count($errors) > 0) {
        // Trimitem erorile înapoi către JavaScript
        echo json_encode(['status' => 'error', 'errors' => $errors]);
    } else {
        // Totul este valid, trimitem succesul
        echo json_encode([
            'status' => 'success', 
            'nume' => htmlspecialchars($nume), 
            'mesaj' => htmlspecialchars($mesaj)
        ]);
    }
    exit; // Oprim execuția scriptului aici pentru a nu afișa și HTML-ul de jos în răspunsul JSON
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formular Contact</title>
    <style>
        /* Stiluri simple pentru aspect */
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 2rem auto; padding: 1rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: .5rem; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; box-sizing: border-box; }
        .error-msg { color: red; font-size: 0.85rem; margin-top: 5px; display: none; }
        #successMessage { display: none; background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; border: 1px solid #c3e6cb; }
        button { padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>

    <h2>Contactează-ne</h2>

    <div id="successMessage"></div>

    <form id="contactForm">
        <div class="form-group">
            <label for="nume">Nume:</label>
            <input type="text" id="nume" name="nume">
            <div id="error-nume" class="error-msg"></div>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <div id="error-email" class="error-msg"></div>
        </div>

        <div class="form-group">
            <label for="mesaj">Mesaj:</label>
            <textarea id="mesaj" name="mesaj" rows="4"></textarea>
            <div id="error-mesaj" class="error-msg"></div>
        </div>

        <button type="submit">Trimite</button>
    </form>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Previne reîncărcarea standard a paginii

            const formData = new FormData(this);
            
            // Ascundem mesajele anterioare
            document.querySelectorAll('.error-msg').forEach(el => el.style.display = 'none');
            document.getElementById('successMessage').style.display = 'none';

            // Trimitem datele către același fișier PHP folosind Fetch API
            fetch('contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'error') {
                    // Dacă PHP a găsit erori, le afișăm sub câmpurile relevante
                    if (data.errors.nume) {
                        const err = document.getElementById('error-nume');
                        err.textContent = data.errors.nume;
                        err.style.display = 'block';
                    }
                    if (data.errors.email) {
                        const err = document.getElementById('error-email');
                        err.textContent = data.errors.email;
                        err.style.display = 'block';
                    }
                    if (data.errors.mesaj) {
                        const err = document.getElementById('error-mesaj');
                        err.textContent = data.errors.mesaj;
                        err.style.display = 'block';
                    }
                } else if (data.status === 'success') {
                    // Dacă totul e valid, ascundem formularul și afișăm mesajul
                    document.getElementById('contactForm').style.display = 'none';
                    
                    const successDiv = document.getElementById('successMessage');
                    successDiv.innerHTML = `<strong>Vă mulțumim, ${data.nume}!</strong><br>Mesajul dumneavoastră a fost recepționat:<br><em>"${data.mesaj}"</em>`;
                    successDiv.style.display = 'block';
                }
            })
            .catch(error => console.error('Eroare:', error));
        });
    </script>

</body>
</html>