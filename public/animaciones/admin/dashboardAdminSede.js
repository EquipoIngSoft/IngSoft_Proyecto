/* ==============================================
   dashboardAdminSede.js — Sección Sedes
   Búsqueda y Modal
   EGAU Chess | AMAAC
   ============================================== */

document.addEventListener('DOMContentLoaded', () => {

    // ---- Modal: Agregar Sede ----
    const modalOverlay = document.getElementById('modal-agregar-sede');
    const btnAgregar = document.getElementById('btn-agregar-sede');
    const btnCerrarModal = document.getElementById('modal-close-sede');
    const btnCancelarModal = document.getElementById('btn-cancelar-modal-sede');
    const formAgregar = document.getElementById('form-agregar-sede');

    const abrirModal = () => {
        if (modalOverlay) modalOverlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    const cerrarModal = () => {
        if (modalOverlay) modalOverlay.classList.remove('open');
        document.body.style.overflow = '';
        if (formAgregar) formAgregar.reset();
        
        // Limpiar form-dropdowns
        document.querySelectorAll('#modal-agregar-sede .form-dropdown').forEach(dropdown => {
            const options = dropdown.querySelectorAll('.form-option');
            const selectedText = dropdown.querySelector('.selected-text');
            const hiddenInput = dropdown.querySelector('input[type="hidden"]');
            
            dropdown.classList.remove('input-error', 'input-ok');
            options.forEach(opt => opt.classList.remove('selected'));
            
            if (options.length > 0) {
                if (selectedText) {
                    selectedText.textContent = 'Selecciona un estado';
                    selectedText.setAttribute('data-value', '');
                }
                if (hiddenInput) hiddenInput.value = '';
            }
        });

        // Limpiar estados de validación
        document.querySelectorAll('#modal-agregar-sede .form-group-modal input').forEach(inp => {
            inp.classList.remove('input-error', 'input-ok');
        });
        document.querySelectorAll('#modal-agregar-sede .error-msg-modal').forEach(msg => {
            msg.textContent = '';
        });
    };

    if (btnAgregar) btnAgregar.addEventListener('click', abrirModal);
    if (btnCerrarModal) btnCerrarModal.addEventListener('click', cerrarModal);
    if (btnCancelarModal) btnCancelarModal.addEventListener('click', cerrarModal);

    if (modalOverlay) {
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) {
                cerrarModal();
            }
        });
    }

    // ---- Búsqueda de Sedes ----
    const buscador = document.getElementById('buscador-sedes');
    const tabla = document.getElementById('tabla-sedes');

    if (buscador && tabla) {
        buscador.addEventListener('input', () => {
            const query = buscador.value.toLowerCase().trim();
            const filas = tabla.querySelectorAll('tbody tr');

            filas.forEach(fila => {
                const visible = fila.textContent.toLowerCase().includes(query);
                fila.style.display = visible ? '' : 'none';
            });
        });
    }

    // ---- Validación del formulario Sede ----
    if (formAgregar) {
        const setError = (inputId, msgId, mensaje) => {
            const inp = document.getElementById(inputId);
            const msg = document.getElementById(msgId);
            if (inp) { inp.classList.add('input-error'); inp.classList.remove('input-ok'); }
            if (msg) msg.textContent = mensaje;
        };

        const setOk = (inputId, msgId) => {
            const inp = document.getElementById(inputId);
            const msg = document.getElementById(msgId);
            if (inp) { inp.classList.remove('input-error'); inp.classList.add('input-ok'); }
            if (msg) msg.textContent = '';
        };

        formAgregar.addEventListener('submit', (e) => {
            e.preventDefault();
            let valido = true;

            const fields = [
                { id: 'se-nombre', err: 'err-se-nombre', msg: 'El nombre es obligatorio.' },
                { id: 'se-estado', target: 'dropdown-se-estado', err: 'err-se-estado', msg: 'Selecciona un estado.' },
                { id: 'se-ciudad', err: 'err-se-ciudad', msg: 'La ciudad es obligatoria.' },
                { id: 'se-cp', err: 'err-se-cp', msg: 'CP inválido (5 dígitos).', type: 'cp' },
                { id: 'se-calle', err: 'err-se-calle', msg: 'La dirección es obligatoria.' },
                { id: 'se-telefono', err: 'err-se-telefono', msg: 'Teléfono inválido (10 dígitos).', type: 'tel' },
                { id: 'se-correo', err: 'err-se-correo', msg: 'Email inválido.', type: 'email' }
            ];

            fields.forEach(f => {
                const el = document.getElementById(f.id);
                const targetId = f.target || f.id;

                if (!el || el.value.trim() === '') {
                    setError(targetId, f.err, f.msg);
                    valido = false;
                } else if (f.type === 'cp') {
                    if (!/^\d{5}$/.test(el.value.trim())) {
                        setError(targetId, f.err, f.msg);
                        valido = false;
                    } else { setOk(targetId, f.err); }
                } else if (f.type === 'tel') {
                    if (!/^\d{10}$/.test(el.value.trim())) {
                        setError(targetId, f.err, f.msg);
                        valido = false;
                    } else { setOk(targetId, f.err); }
                } else if (f.type === 'email') {
                    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(el.value.trim())) {
                        setError(targetId, f.err, f.msg);
                        valido = false;
                    } else { setOk(targetId, f.err); }
                } else {
                    setOk(targetId, f.err);
                }
            });

            if (valido) {
                console.log('Formulario Sede válido. Enviando...');
                cerrarModal();
            }
        });
    }

});
