document.addEventListener('DOMContentLoaded', function() {
    
    const modal = document.getElementById('ticket-modal');
    const closeBtn = document.querySelector('.modal-close');
    const buyButtons = document.querySelectorAll('.buy-btn');
    const matchTitle = document.getElementById('modal-match-title');
    
    const zoneSelect = document.getElementById('zone-select');
    const quantityInput = document.getElementById('inputActivitate');
    const totalPriceSpan = document.getElementById('total-price');
    const purchaseForm = document.getElementById('purchase-form');

    // DESCHIDERE MODAL
    buyButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const matchName = this.getAttribute('data-meci');
            matchTitle.textContent = matchName; 
            
            // Resetare formular
            zoneSelect.selectedIndex = 0;
            quantityInput.value = 1;
            totalPriceSpan.textContent = "0";
            
            modal.classList.add('active');
        });
    });

    // ÎNCHIDERE MODAL
    closeBtn.addEventListener('click', () => modal.classList.remove('active'));
    window.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.remove('active');
    });

    // CALCUL PREȚ
    function updatePrice() {
        const selectedOption = zoneSelect.options[zoneSelect.selectedIndex];
        if (selectedOption && !selectedOption.disabled) {
            const price = selectedOption.getAttribute('data-price');
            const quantity = quantityInput.value;
            totalPriceSpan.textContent = price * quantity;
        } else {
            totalPriceSpan.textContent = "0";
        }
    }

    zoneSelect.addEventListener('change', updatePrice);
    quantityInput.addEventListener('input', updatePrice);

    // ADĂUGARE ÎN COȘ (LOCAL STORAGE)
    purchaseForm.addEventListener('submit', function(e) {
        e.preventDefault();

        if (!zoneSelect.value) {
            alert("Te rog selectează o zonă.");
            return;
        }

        // Colectăm datele comenzii
        const comandaNoua = {
            id: Date.now(), // ID unic bazat pe timp
            meci: matchTitle.textContent,
            zona: zoneSelect.options[zoneSelect.selectedIndex].text.split('(')[0].trim(),
            cantitate: quantityInput.value,
            pretTotal: totalPriceSpan.textContent,
            data: new Date().toLocaleDateString('ro-RO')
        };

        // 1. Luăm comenzile vechi din LocalStorage (dacă există)
        let comenzi = JSON.parse(localStorage.getItem('comenziBilete')) || [];

        // 2. Adăugăm comanda nouă
        comenzi.push(comandaNoua);

        // 3. Salvăm totul înapoi în LocalStorage
        localStorage.setItem('comenziBilete', JSON.stringify(comenzi));

        // Mesaj confirmare și închidere modal
        alert("Biletul a fost adăugat în coș! Mergi la pagina 'Comenzile mele' pentru a finaliza.");
        modal.classList.remove('active');
    });
});