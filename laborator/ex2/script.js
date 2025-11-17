// 1. Selectăm elementele necesare din DOM
const btnDetalii = document.getElementById('btnDetalii');
const divDetalii = document.getElementById('detalii');
const spanData = document.getElementById('dataProdus');

// Tabloul de luni în limba română
const luni = [
    "Ianuarie", "Februarie", "Martie", "Aprilie", "Mai", "Iunie",
    "Iulie", "August", "Septembrie", "Octombrie", "Noiembrie", "Decembrie"
];

// 2. Logica executată la încărcarea paginii (imediat ce scriptul rulează)
// a) Ascundem detaliile inițial adăugând clasa .ascuns
divDetalii.classList.add('ascuns');

// b) Obținem și formatăm data curentă
const dataCurenta = new Date();
const ziua = dataCurenta.getDate();
const lunaText = luni[dataCurenta.getMonth()]; // getMonth returnează 0-11
const anul = dataCurenta.getFullYear();

// c) Injectăm data în elementul HTML
spanData.textContent = `${ziua} ${lunaText} ${anul}`;

// 3. Evenimentul de click pe buton
btnDetalii.addEventListener('click', function() {
    
    // a) Comutăm vizibilitatea (toggle scoate clasa dacă există, o pune dacă nu există)
    divDetalii.classList.toggle('ascuns');

    // b) Modificăm textul butonului în funcție de starea curentă
    // Verificăm dacă elementul are clasa 'ascuns'
    if (divDetalii.classList.contains('ascuns')) {
        // Dacă este ascuns, butonul trebuie să invite la afișare
        btnDetalii.textContent = "Afișează detalii";
    } else {
        // Dacă este vizibil, butonul trebuie să invite la ascundere
        btnDetalii.textContent = "Ascunde detalii";
    }
});