# ⚽ Ticketing Pro - Platformă de Rezervare Bilete

Acesta este un proiect de dezvoltare web realizat pentru gestionarea și comercializarea biletelor la evenimente sportive (fotbal). Aplicația este containerizată folosind Docker și permite utilizatorilor să vizualizeze meciuri, să consulte clasamente, să achiziționeze bilete și să trimită mesaje de contact.

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
* **Recuperare Parolă:** Funcționalitate de resetare a parolei (simulare vizuală).
* **Vizualizare Meciuri:** Listă interactivă cu meciurile viitoare.
* **Coș de Cumpărături:** Adăugarea biletelor în coș cu calculare automată a prețului în funcție de zonă (Peluză, Tribună, VIP).
* **Istoric Comenzi:** Vizualizarea biletelor achiziționate.
* **Contact:** Formular de suport pentru trimiterea de mesaje.

### Pentru Administratori:
* **Panou de Control:** Accesibil doar utilizatorilor cu rolul de `admin`.
* **Gestionare Meciuri:** Adăugare meciuri noi prin interfață dedicată.
* **Ștergere Meciuri:** Eliminarea meciurilor din baza de date.

---

## 🛠️ Tehnologii Utilizate

* **Frontend:** HTML5, CSS3 (Custom CSS, Flexbox/Grid), JavaScript.
* **Backend:** PHP 8.x.
* **Bază de Date:** MySQL 8.0.
* **Infrastructură:** * **Docker & Docker Compose:** Pentru containerizarea aplicației (servicii separate pentru webserver și bază de date).
* **Unelte de Dezvoltare:**
    * **DataGrip:** Pentru managementul și interogarea bazei de date.

---

## ⚙️ Configurare și Rulare (Docker)

Proiectul rulează în containere izolate. Pentru a porni aplicația, urmați pașii:

### 1. Pornire Containere
Asigurați-vă că Docker Desktop rulează, apoi executați în terminal, în rădăcina proiectului:


* **docker-compose up -d

Această comandă va porni două servicii:

* **php-apache (Serverul web, accesibil la localhost:80)

* **mysql (Baza de date, accesibilă intern la host mysql)

### 2. Configurare Bază de Date (via DataGrip)
Deoarece baza de date este goală la prima rulare, trebuie creată structura tabelelor folosind DataGrip.

Conectați-vă cu DataGrip la containerul MySQL:

* **Host: localhost

* **Port: 3306 (sau portul mapat în docker-compose)

* **User: user

* **Password: password

Deschideți o consolă SQL în DataGrip și rulați scriptul de mai jos pentru a genera tabelele.

📂 Structura Bazei de Date (SQL)
Rulați acest cod în DataGrip pentru a inițializa proiectul complet:

SQL
```bash
CREATE DATABASE IF NOT EXISTS studenti;
USE studenti;

-- 1. Tabel Utilizatori
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    nume_complet VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Tabel Meciuri
CREATE TABLE meciuri (
    id INT AUTO_INCREMENT PRIMARY KEY,
    echipa1 VARCHAR(100) NOT NULL,
    echipa2 VARCHAR(100) NOT NULL,
    data_meci DATETIME NOT NULL,
    stadion VARCHAR(100) NOT NULL,
    pret_peluza DECIMAL(10,2) NOT NULL,
    pret_tribuna2 DECIMAL(10,2) NOT NULL,
    pret_tribuna1 DECIMAL(10,2) NOT NULL,
    pret_vip DECIMAL(10,2) NOT NULL
);

-- 3. Tabel Comenzi
CREATE TABLE comenzi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    meci VARCHAR(255) NOT NULL,
    zona VARCHAR(50) NOT NULL,
    cantitate INT NOT NULL,
    pret_total DECIMAL(10,2) NOT NULL,
    data_comanda TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

-- 4. Tabel Mesaje (Contact/Ajutor)
CREATE TABLE mesaje (
    mesaj_id INT AUTO_INCREMENT PRIMARY KEY,
    nume VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    subiect VARCHAR(255) NOT NULL,
    mesaj TEXT NOT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
### 3. Configurare Admin
Pentru a testa funcționalitățile de administrator:

* **Creați un cont nou din interfața web (localhost/creare.cont.php).

În DataGrip, rulați comanda:

SQL
```bash
UPDATE users SET role = 'admin' WHERE email = 'adresa_ta@email.com';
```
Relogați-vă în aplicație.

📸 Accesare
După pornirea containerelor, aplicația este disponibilă în browser la adresa:

* **http://localhost/

© 2025 Trancă Alexandru-Constantin. Toate drepturile rezervate.
