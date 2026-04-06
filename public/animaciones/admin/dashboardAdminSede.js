/* ==============================================
   dashboardAdminSede.js — Sección Sedes
   Búsqueda y Modal
   EGAU Chess | AMAAC
   ============================================== */

document.addEventListener('DOMContentLoaded', () => {

    // ---- Modal: Agregar Sede ----
    const modalOverlay = document.getElementById('modal-agregar-sede');
    const btnAgregar = document.getElementById('btn-agregar-sede');
    const btnCerrarModal = document.querySelector('#modal-agregar-sede #modal-close');
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
        formAgregar.addEventListener('submit', (e) => {
            e.preventDefault();
            // Lógica de validación simplificada
            const nombre = document.getElementById('se-nombre');
            if (!nombre || nombre.value.trim() === '') {
                nombre.classList.add('input-error');
                const err = document.getElementById('err-se-nombre');
                if (err) err.textContent = 'El nombre de la sede es requerido.';
            } else {
                console.log('Formulario Sede válido.');
                cerrarModal();
            }
        });
    }

});
