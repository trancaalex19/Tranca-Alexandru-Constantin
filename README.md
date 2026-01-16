# ⚽ Ticketing Pro - Platformă de Rezervare Bilete

Acesta este un proiect de dezvoltare web realizat pentru gestionarea și comercializarea biletelor la evenimente sportive (fotbal). Aplicația permite utilizatorilor să vizualizeze meciuri, să consulte clasamente și să achiziționeze bilete, oferind în același timp o interfață de administrare pentru gestionarea evenimentelor.

---

## 👤 Detalii Student

* **Nume:** Trancă Alexandru-Constantin
* **Facultatea:** Inginerie Industrială și Robotică (FIIR)
* **Universitatea:** Politehnica București
* **Grupa:** 634 AB

---

## 🚀 Funcționalități Principale

### Pentru Clienți (Utilizatori):
* **Autentificare & Înregistrare:** Sistem securizat de creare cont și login.
* **Recuperare Parolă:** Funcționalitate de resetare a parolei via email (simulare).
* **Vizualizare Meciuri:** Listă interactivă cu meciurile viitoare, afișând data, ora și stadionul.
* **Coș de Cumpărături:** Adăugarea biletelor în coș, selectarea zonei (Peluză, Tribună, VIP) și calcularea automată a prețului.
* **Istoric Comenzi:** Vizualizarea biletelor achiziționate anterior.
* **Clasamente:** Pagini dedicate pentru vizualizarea clasamentelor (Liga 1, Liga 2, etc.).

### Pentru Administratori:
* **Panou de Control:** Accesibil doar utilizatorilor cu rolul de `admin`.
* **Gestionare Meciuri:** Posibilitatea de a adăuga meciuri noi (echipe, dată, prețuri per zonă).
* **Ștergere Meciuri:** Eliminarea meciurilor care au trecut sau au fost anulate.

---

## 🛠️ Tehnologii Utilizate

* **Frontend:**
    * HTML5 & CSS3 (Design Responsiv, Flexbox, CSS Grid).
    * JavaScript (Manipulare DOM, LocalStorage pentru coșul temporar).
    * Fonturi: Google Fonts (Poppins).
* **Backend:**
    * PHP (Procedural).
* **Bază de Date:**
    * MySQL (Stocare utilizatori, meciuri, comenzi).
* **Server:**
    * Apache (XAMPP/WAMP).

---

## 📂 Structura Bazei de Date

Pentru ca aplicația să funcționeze, baza de date `studenti` trebuie să conțină următoarele tabele:

### 1. Tabelul `users`
```sql
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    nume_complet VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
