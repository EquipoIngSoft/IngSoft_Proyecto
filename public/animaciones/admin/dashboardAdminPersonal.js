/* ==============================================
   dashboardAdminPersonal.js — Sección Personal
   Búsqueda, Filtros, Modal y Validación
   EGAU Chess | AMAAC
   ============================================== */

document.addEventListener('DOMContentLoaded', () => {

    // ---- Búsqueda y Filtros Custom ----
    const buscador = document.getElementById('buscador-personal');
    const btnLimpiar = document.getElementById('btn-limpiar-personal');
    const tabla = document.getElementById('tabla-personal');

    if (tabla) {
        const filas = tabla.querySelectorAll('tbody tr');
        const info = document.querySelector('#section-personal .pagination-info');

        // Función Principal de Filtrado
        const aplicarFiltros = () => {
            const query = buscador ? buscador.value.toLowerCase().trim() : '';

            // Obtener el valor de "data-value" del trigger de cada custom select
            const triggerRol = document.querySelector('#dropdown-nivel-personal .selected-text');
            const triggerSede = document.querySelector('#dropdown-sede-personal .selected-text');
            const triggerStatus = document.querySelector('#dropdown-status-personal .selected-text');

            const rol = triggerRol ? triggerRol.getAttribute('data-value') : '';
            const sede = triggerSede ? triggerSede.getAttribute('data-value') : '';
            const status = triggerStatus ? triggerStatus.getAttribute('data-value') : '';

            let visibles = 0;

            filas.forEach(fila => {
                const textoGeneral = fila.textContent.toLowerCase();
                const tdRol = fila.cells[2] ? fila.cells[2].textContent.toLowerCase() : '';
                const tdSede = fila.cells[3] ? fila.cells[3].textContent.toLowerCase() : '';
                const tdStatus = fila.cells[4] ? fila.cells[4].textContent.toLowerCase() : '';

                const coincideTexto = textoGeneral.includes(query);
                const coincideRol = rol === '' || tdRol.includes(rol);
                const coincideSede = sede === '' || tdSede.includes(sede);
                const coincideStatus = status === '' || tdStatus.includes(status);

                if (coincideTexto && coincideRol && coincideSede && coincideStatus) {
                    fila.style.display = '';
                    visibles++;
                } else {
                    fila.style.display = 'none';
                }
            });

            if (info) {
                info.textContent = `Mostrando ${visibles} resultado${visibles !== 1 ? 's' : ''}`;
            }
        };

        // Escuchar input en buscar
        if (buscador) buscador.addEventListener('input', aplicarFiltros);

        // Lógica de los Custom Dropdowns (Específicos de Personal)
        const customDropdowns = document.querySelectorAll('#section-personal .custom-dropdown');

        customDropdowns.forEach(dropdown => {
            const trigger = dropdown.querySelector('.custom-select-trigger');
            const options = dropdown.querySelectorAll('.custom-option');
            const selectedText = dropdown.querySelector('.selected-text');

            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                customDropdowns.forEach(d => {
                    if (d !== dropdown) d.classList.remove('open');
                });
                dropdown.classList.toggle('open');
            });

            options.forEach(option => {
                option.addEventListener('click', (e) => {
                    e.stopPropagation();
                    options.forEach(opt => opt.classList.remove('selected'));
                    option.classList.add('selected');

                    const val = option.getAttribute('data-value');
                    const text = option.textContent;

                    selectedText.textContent = text;
                    selectedText.setAttribute('data-value', val);

                    dropdown.classList.remove('open');
                    aplicarFiltros();
                });
            });
        });

        // Cerrar dropdown si se hace clic fuera
        document.addEventListener('click', () => {
            customDropdowns.forEach(dropdown => dropdown.classList.remove('open'));
        });

        // Botón Limpiar
        if (btnLimpiar) {
            btnLimpiar.addEventListener('click', () => {
                if (buscador) buscador.value = '';
                customDropdowns.forEach(dropdown => {
                    const options = dropdown.querySelectorAll('.custom-option');
                    const selectedText = dropdown.querySelector('.selected-text');
                    options.forEach(opt => opt.classList.remove('selected'));
                    if (options.length > 0) {
                        const firstOpt = options[0];
                        firstOpt.classList.add('selected');
                        selectedText.textContent = firstOpt.textContent;
                        selectedText.setAttribute('data-value', firstOpt.getAttribute('data-value'));
                    }
                });
                aplicarFiltros();
            });
        }

    }

    // ---- Lógica para Form Dropdowns (Modal de Personal) ----
    // IMPORTANTE: debe estar FUERA del bloque if(tabla) para funcionar siempre
    const formDropdownsPersonal = document.querySelectorAll('#modal-agregar-personal .form-dropdown');
    formDropdownsPersonal.forEach(dropdown => {
        const trigger = dropdown.querySelector('.form-select-trigger');
        const options = dropdown.querySelectorAll('.form-option');
        const selectedText = dropdown.querySelector('.selected-text');
        const hiddenInput = dropdown.querySelector('input[type="hidden"]');

        if (!trigger || !selectedText) return;

        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            formDropdownsPersonal.forEach(d => {
                if (d !== dropdown) d.classList.remove('open');
            });
            dropdown.classList.toggle('open');
        });

        options.forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();
                options.forEach(opt => opt.classList.remove('selected'));
                option.classList.add('selected');

                const val = option.getAttribute('data-value');
                const text = option.textContent;

                selectedText.textContent = text;
                selectedText.setAttribute('data-value', val);
                if (hiddenInput) hiddenInput.value = val;

                dropdown.classList.remove('open');

                if (val !== "") {
                    dropdown.classList.remove('input-error');
                    if (hiddenInput) {
                        const errorMsg = document.getElementById(`err-${hiddenInput.id}`);
                        if (errorMsg) errorMsg.textContent = '';
                    }
                }
            });
        });
    });

    document.addEventListener('click', () => {
        formDropdownsPersonal.forEach(dropdown => dropdown.classList.remove('open'));
    });

    // ---- Modal: Agregar Personal ----
    const modalOverlay = document.getElementById('modal-agregar-personal');
    const btnAgregar = document.getElementById('btn-agregar-personal');
    const btnCerrarModal = document.getElementById('modal-close-personal');
    const btnCancelarModal = document.getElementById('btn-cancelar-modal-personal');
    const formAgregar = document.getElementById('form-agregar-personal');

    const abrirModal = () => {
        if (modalOverlay) modalOverlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    const cerrarModal = () => {
        if (modalOverlay) modalOverlay.classList.remove('open');
        document.body.style.overflow = '';
        if (formAgregar) formAgregar.reset();

        // Limpiar form-dropdowns
        document.querySelectorAll('#modal-agregar-personal .form-dropdown').forEach(dropdown => {
            const options = dropdown.querySelectorAll('.form-option');
            const selectedText = dropdown.querySelector('.selected-text');
            const hiddenInput = dropdown.querySelector('input[type="hidden"]');
            dropdown.classList.remove('input-error', 'input-ok');
            options.forEach(opt => opt.classList.remove('selected'));
            if (options.length > 0) {
                // No seleccionamos el primero por defecto si es "Selecciona..."
                if (selectedText) {
                    selectedText.textContent = "Selecciona una opción";
                    selectedText.setAttribute('data-value', "");
                }
                if (hiddenInput) hiddenInput.value = "";
            }
        });

        // Limpiar estados de validación
        document.querySelectorAll('#modal-agregar-personal .form-group-modal input').forEach(inp => {
            inp.classList.remove('input-error', 'input-ok');
        });
        document.querySelectorAll('#modal-agregar-personal .error-msg-modal').forEach(msg => {
            msg.textContent = '';
        });
    };

    if (btnAgregar) btnAgregar.addEventListener('click', abrirModal);
    if (btnCerrarModal) btnCerrarModal.addEventListener('click', cerrarModal);
    if (btnCancelarModal) btnCancelarModal.addEventListener('click', cerrarModal);

    if (modalOverlay) {
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) cerrarModal();
        });
    }

    // ---- Validación del formulario Personal ----
    if (formAgregar) {
        const setError = (inputId, msgId, mensaje) => {
            const inp = document.getElementById(inputId);
            const msg = document.getElementById(msgId);
            const dropdown = inp ? inp.closest('.form-dropdown') : null;

            if (dropdown) {
                dropdown.classList.add('input-error');
                dropdown.classList.remove('input-ok');
            } else if (inp) {
                inp.classList.add('input-error');
                inp.classList.remove('input-ok');
            }
            if (msg) msg.textContent = mensaje;
        };

        const setOk = (inputId, msgId) => {
            const inp = document.getElementById(inputId);
            const msg = document.getElementById(msgId);
            const dropdown = inp ? inp.closest('.form-dropdown') : null;

            if (dropdown) {
                dropdown.classList.remove('input-error');
                dropdown.classList.add('input-ok');
            } else if (inp) {
                inp.classList.remove('input-error');
                inp.classList.add('input-ok');
            }
            if (msg) msg.textContent = '';
        };

        formAgregar.addEventListener('submit', (e) => {
            e.preventDefault();
            let valido = true;

            const fields = [
                { id: 'pe-nombre', err: 'err-pe-nombre', msg: 'El nombre es requerido.' },
                { id: 'pe-ap-paterno', err: 'err-pe-ap-paterno', msg: 'El apellido paterno es requerido.' },
                { id: 'pe-fecha-nacimiento', err: 'err-pe-fecha-nacimiento', msg: 'La fecha de nacimiento es requerida.' },
                { id: 'pe-rol', target: 'dropdown-pe-rol', err: 'err-pe-rol', msg: 'Selecciona un rol.' },
                { id: 'pe-sede', target: 'dropdown-pe-sede', err: 'err-pe-sede', msg: 'Selecciona una sede.' },
                { id: 'pe-genero', target: 'dropdown-pe-genero', err: 'err-pe-genero', msg: 'Selecciona un género.' },
                { id: 'pe-estado', target: 'dropdown-pe-estado', err: 'err-pe-estado', msg: 'Selecciona un estado.' },
                { id: 'pe-ciudad', err: 'err-pe-ciudad', msg: 'La ciudad es requerida.' },
                { id: 'pe-calle', err: 'err-pe-calle', msg: 'La calle es requerida.' },
                { id: 'pe-cp', err: 'err-pe-cp', msg: 'Ingresa un CP válido (5 dígitos).', type: 'cp' },
                { id: 'pe-correo', err: 'err-pe-correo', msg: 'Ingresa un correo válido.', type: 'email' },
                { id: 'pe-password', err: 'err-pe-password', msg: 'La contraseña debe tener al menos 6 caracteres.', min: 6 }
            ];

            fields.forEach(f => {
                const el = document.getElementById(f.id);
                const targetId = f.target || f.id;
                if (!el || el.value.trim() === '' || (f.min && el.value.length < f.min)) {
                    setError(targetId, f.err, f.msg);
                    valido = false;
                } else if (f.type === 'email') {
                    const reg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!reg.test(el.value.trim())) {
                        setError(targetId, f.err, f.msg);
                        valido = false;
                    } else { setOk(targetId, f.err); }
                } else if (f.type === 'cp') {
                    const reg = /^\d{5}$/;
                    if (!reg.test(el.value.trim())) {
                        setError(targetId, f.err, f.msg);
                        valido = false;
                    } else { setOk(targetId, f.err); }
                } else { setOk(targetId, f.err); }
            });

            // Confirmar contraseña
            const pePass = document.getElementById('pe-password');
            const pePassConf = document.getElementById('pe-password-confirm');
            if (pePassConf && pePassConf.value !== (pePass ? pePass.value : '')) {
                setError('pe-password-confirm', 'err-pe-password-confirm', 'Las contraseñas no coinciden.');
                valido = false;
            } else if (pePassConf) { setOk('pe-password-confirm', 'err-pe-password-confirm'); }

            if (valido) {
                console.log('Formulario Personal válido.');
                cerrarModal();
            }
        });
    }

});
