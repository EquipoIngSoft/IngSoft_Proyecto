document.addEventListener('DOMContentLoaded', () => {

    const tableRows = document.querySelectorAll('#tabla-niveles tbody tr');
    const buscador = document.getElementById('buscador-niveles');
    
    // Dropdowns de filtros
    const filters = [
        { id: 'dropdown-niv-sede', value: '' },
        { id: 'dropdown-niv-nivel', value: '' }
    ];

    // Lógica para dropdowns
    filters.forEach(filter => {
        const dd = document.getElementById(filter.id);
        if(!dd) return;
        const trigger = dd.querySelector('.custom-select-trigger');
        const options = dd.querySelectorAll('.custom-option');
        const selectedText = trigger.querySelector('.selected-text');

        // Toggle open
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            document.querySelectorAll('.custom-dropdown').forEach(d => {
                if (d !== dd) d.classList.remove('open');
            });
            dd.classList.toggle('open');
        });

        // Seleccionar opcion
        options.forEach(opt => {
            opt.addEventListener('click', () => {
                const val = opt.getAttribute('data-value');
                options.forEach(o => o.classList.remove('selected'));
                opt.classList.add('selected');
                
                if (val === '') {
                    selectedText.textContent = opt.textContent; // Texto por defecto "Periodo", "Sede", "Nivel"
                } else {
                    selectedText.textContent = opt.textContent; // Mostrar el texto de la opción seleccionada
                }
                
                selectedText.setAttribute('data-value', val);
                filter.value = val.toLowerCase();
                
                dd.classList.remove('open');
                applyFilters();
            });
        });
    });

    // Cerrar dropdowns al hacer clic fuera
    document.addEventListener('click', () => {
        document.querySelectorAll('.custom-dropdown').forEach(dd => {
            dd.classList.remove('open');
        });
    });

    // Buscador interactivo
    if (buscador) {
        buscador.addEventListener('input', () => {
            applyFilters();
        });
    }

    // --- Lógica del Modal de Puntos ---
    const modalPuntos = document.getElementById('modal-modificar-puntos');
    const btnModificarList = document.querySelectorAll('.btn-modificar-puntos');
    const btnClosePuntos = document.getElementById('modal-close-puntos');
    
    const puntosModalNombre = document.getElementById('puntos-modal-nombre');
    const puntosModalActuales = document.getElementById('puntos-modal-actuales');
    const puntosModalCantidad = document.getElementById('puntos-modal-cantidad');
    const btnPuntosSumar = document.getElementById('btn-puntos-sumar');
    const btnPuntosRestar = document.getElementById('btn-puntos-restar');

    let currentRowPtsElem = null; // Para saber qué celda actualizar

    // Abrir modal
    btnModificarList.forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const name = row.cells[0].textContent;
            const ptsElem = row.querySelector('.puntos-actual');
            const ptsActual = ptsElem.textContent;

            puntosModalNombre.textContent = name;
            puntosModalActuales.textContent = ptsActual;
            puntosModalCantidad.value = '';
            
            currentRowPtsElem = ptsElem;
            modalPuntos.classList.add('open');
        });
    });

    // Cerrar modal
    function cerrarModalPuntos() {
        modalPuntos.classList.remove('open');
    }

    if (btnClosePuntos) btnClosePuntos.addEventListener('click', cerrarModalPuntos);
    
    window.addEventListener('click', (e) => {
        if (e.target === modalPuntos) cerrarModalPuntos();
    });

    // Sumar Puntos
    if (btnPuntosSumar) {
        btnPuntosSumar.addEventListener('click', () => {
            const val = parseInt(puntosModalCantidad.value);
            if (isNaN(val) || val <= 0) return alert('Ingresa una cantidad válida');

            let currentPts = parseInt(currentRowPtsElem.textContent);
            let newPts = currentPts + val;
            
            if (newPts > 2000) newPts = 2000;
            
            currentRowPtsElem.textContent = newPts;
            cerrarModalPuntos();
        });
    }

    // Restar Puntos
    if (btnPuntosRestar) {
        btnPuntosRestar.addEventListener('click', () => {
            const val = parseInt(puntosModalCantidad.value);
            if (isNaN(val) || val <= 0) return alert('Ingresa una cantidad válida');

            let currentPts = parseInt(currentRowPtsElem.textContent);
            let newPts = currentPts - val;
            
            if (newPts < 0) newPts = 0;
            
            currentRowPtsElem.textContent = newPts;
            cerrarModalPuntos();
        });
    }

    // Filtrar tabla
    function applyFilters() {
        const searchTerm = (buscador.value || '').toLowerCase().trim();
        const sedeSearch = filters[0].value;
        const nivelSearch = filters[1].value;

        tableRows.forEach(row => {
            const cols = row.querySelectorAll('td');
            if(cols.length < 4) return;

            const name = cols[0].textContent.toLowerCase();
            const nivel = cols[2].textContent.toLowerCase(); 
            const sede = cols[3].textContent.toLowerCase();

            // Match conditions
            const matchName = name.includes(searchTerm);
            const matchSede = !sedeSearch || sede.includes(sedeSearch);
            const matchNivel = !nivelSearch || nivel.includes(nivelSearch);

            if (matchName && matchSede && matchNivel) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

});
