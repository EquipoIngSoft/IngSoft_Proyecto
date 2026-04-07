/* ============================================================ */
/*  dashboardAdminRoles.js — Interactivity for Roles section    */
/*  EGAU Chess | AMAAC                                         */
/* ============================================================ */

document.addEventListener('DOMContentLoaded', () => {

    const buscadorRoles = document.getElementById('buscador-roles');
    const tablaRoles = document.getElementById('tabla-roles');
    const filasRoles = tablaRoles ? tablaRoles.querySelectorAll('tbody tr') : [];

    const statusFilter = document.getElementById('dropdown-status-roles');
    let activeStatus = '';

    // ---- FUNCIÓN DE FILTRADO ----
    const aplicarFiltros = () => {
        const textoBusqueda = buscadorRoles ? buscadorRoles.value.toLowerCase().trim() : '';

        filasRoles.forEach(fila => {
            const id = fila.cells[0].textContent.toLowerCase();
            const nombre = fila.cells[1].textContent.toLowerCase();
            const descripcion = fila.cells[2].textContent.toLowerCase();
            const estatus = fila.cells[3].textContent.toLowerCase();

            const coincideTexto = id.includes(textoBusqueda) || 
                                 nombre.includes(textoBusqueda) || 
                                 descripcion.includes(textoBusqueda);
            
            const coincideEstatus = !activeStatus || estatus.includes(activeStatus.toLowerCase());

            if (coincideTexto && coincideEstatus) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    };

    // ---- EVENTO BUSCADOR ----
    if (buscadorRoles) {
        buscadorRoles.addEventListener('input', aplicarFiltros);
    }

    // ---- EVENTO DROPDOWN STATUS (Usa la lógica global de custom-dropdown) ----
    if (statusFilter) {
        const options = statusFilter.querySelectorAll('.custom-option');
        options.forEach(opt => {
            opt.addEventListener('click', () => {
                activeStatus = opt.getAttribute('data-value');
                aplicarFiltros();
            });
        });
    }

    // ---- LÓGICA DEL MODAL: AGREGAR ROL ----
    const modalRol = document.getElementById('modal-agregar-rol');
    const btnAbrirRol = document.getElementById('btn-agregar-rol');
    const btnCerrarRol = document.getElementById('modal-close-rol');
    const btnCancelarRol = document.getElementById('btn-cancelar-modal-rol');
    const formRol = document.getElementById('form-agregar-rol');

    const abrirModalRol = () => {
        if (modalRol) modalRol.classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    const cerrarModalRol = () => {
        if (modalRol) {
            modalRol.classList.remove('open');
            if (formRol) formRol.reset();
            
            // Limpiar errores
            document.querySelectorAll('.error-msg-modal').forEach(msg => msg.textContent = '');
            document.querySelectorAll('.form-group-modal input, .form-group-modal textarea').forEach(inp => {
                inp.classList.remove('input-error', 'input-ok');
            });

            // Reset custom dropdown
            const ddStatus = document.getElementById('dropdown-ro-estatus');
            if (ddStatus) {
                const selectedText = ddStatus.querySelector('.selected-text');
                const firstOpt = ddStatus.querySelector('.form-option'); // Cambiado a form-option para este dropdown
                if (selectedText && firstOpt) {
                    selectedText.textContent = firstOpt.textContent;
                    selectedText.setAttribute('data-value', firstOpt.getAttribute('data-value'));
                }
                const hiddenInput = ddStatus.querySelector('input[type="hidden"]');
                if (hiddenInput) hiddenInput.value = 'activo';
            }
        }
        document.body.style.overflow = '';
    };

    if (btnAbrirRol) btnAbrirRol.addEventListener('click', abrirModalRol);
    if (btnCerrarRol) btnCerrarRol.addEventListener('click', cerrarModalRol);
    if (btnCancelarRol) btnCancelarRol.addEventListener('click', cerrarModalRol);

    if (modalRol) {
        modalRol.addEventListener('click', (e) => {
            if (e.target === modalRol) cerrarModalRol();
        });
    }

    // ---- VALIDACIÓN DEL FORMULARIO ----
    if (formRol) {
        formRol.addEventListener('submit', (e) => {
            e.preventDefault();
            let valido = true;

            const roNombre = document.getElementById('ro-nombre');
            const roDesc = document.getElementById('ro-descripcion');

            const setError = (id, msgId, text) => {
                const inp = document.getElementById(id);
                const msg = document.getElementById(msgId);
                if (inp) inp.classList.add('input-error');
                if (msg) msg.textContent = text;
            };

            const setOk = (id, msgId) => {
                const inp = document.getElementById(id);
                const msg = document.getElementById(msgId);
                if (inp) {
                    inp.classList.remove('input-error');
                    inp.classList.add('input-ok');
                }
                if (msg) msg.textContent = '';
            };

            if (!roNombre || roNombre.value.trim() === '') {
                setError('ro-nombre', 'err-ro-nombre', 'El nombre del rol es obligatorio.');
                valido = false;
            } else { setOk('ro-nombre', 'err-ro-nombre'); }

            if (!roDesc || roDesc.value.trim() === '') {
                setError('ro-descripcion', 'err-ro-descripcion', 'La descripción es obligatoria.');
                valido = false;
            } else { setOk('ro-descripcion', 'err-ro-descripcion'); }

            if (valido) {
                console.log('Role validado. Datos preparados para envío.');
                // Aquí iría el fetch o lógica de guardado
                cerrarModalRol();
            }
        });
    }

    // ---- BOTÓN LIMPIAR FILTROS ----
    const btnLimpiar = document.getElementById('btn-limpiar-roles');
    if (btnLimpiar) {
        btnLimpiar.addEventListener('click', () => {
            if (buscadorRoles) buscadorRoles.value = '';
            activeStatus = '';
            
            // Reset Dropdown UI
            if (statusFilter) {
                const selectedText = statusFilter.querySelector('.selected-text');
                const firstOpt = statusFilter.querySelector('.custom-option');
                if (selectedText && firstOpt) {
                    selectedText.textContent = firstOpt.textContent;
                    selectedText.setAttribute('data-value', '');
                }
            }
            
            aplicarFiltros();
        });
    }

});
