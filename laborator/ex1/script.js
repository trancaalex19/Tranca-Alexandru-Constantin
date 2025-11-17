// 1. Selectăm elementele din DOM
const inputActivitate = document.getElementById('inputActivitate');
const btnAdauga = document.getElementById('btnAdauga');
const listaActivitati = document.getElementById('listaActivitati');

// 2. Definim tabloul de șiruri pentru lunile anului în limba română
const luni = [
    "Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie",
    "Iulie", "August", "Septembrie", "Octombrie", "Noiembrie", "Decembrie"
];

// 3. Adăugăm evenimentul de click pe buton
btnAdauga.addEventListener('click', function() {
    
    // Citim textul introdus (folosim trim() pentru a elimina spațiile goale inutile)
    const textActivitate = inputActivitate.value.trim();

    // Verificăm dacă textul nu este gol
    if (textActivitate !== "") {
        
        // -- A. Obținerea și formatarea datei --
        const dataCurenta = new Date();
        
        const ziua = dataCurenta.getDate();          // Ziua din lună (1-31)
        const indexLuna = dataCurenta.getMonth();    // Luna (0-11)
        const an = dataCurenta.getFullYear();        // Anul (ex: 2025)
        
        // Obținem numele lunii din tabloul definit anterior
        const numeLuna = luni[indexLuna];

        // -- B. Crearea elementului de listă --
        const elementNou = document.createElement('li');
        
        // Construim textul final conform formatului cerut:
        // "Activitate – adăugată la: 16 Noiembrie 2025"
        elementNou.textContent = `${textActivitate} – adăugată la: ${ziua} ${numeLuna} ${an}`;

        // -- C. Adăugarea în pagină --
        listaActivitati.appendChild(elementNou);

        // -- D. Golirea câmpului de input --
        inputActivitate.value = "";
        
        // Opțional: Punem focus înapoi pe input pentru a scrie rapid următoarea activitate
        inputActivitate.focus();

    } else {
        alert("Te rog introdu o activitate validă!");
    }
});