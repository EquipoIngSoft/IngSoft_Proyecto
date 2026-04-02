// ==============================================
//  dashboardAdminAlumnos.js — Sección Alumnos
//  Búsqueda, Filtros, Modal y Validación
//  EGAU Chess | AMAAC
// ==============================================

document.addEventListener('DOMContentLoaded', () => {

    // ---- Búsqueda y Filtros Custom ----
    const buscador = document.getElementById('buscador');
    const btnLimpiar = document.getElementById('btn-limpiar');
    const tabla = document.getElementById('tabla-alumnos');

    if (tabla) {
        const filas = tabla.querySelectorAll('tbody tr');
        const info = document.querySelector('.pagination-info');

        // Función Principal de Filtrado
        const aplicarFiltros = () => {
            const query = buscador ? buscador.value.toLowerCase().trim() : '';

            // Obtener el valor de "data-value" del trigger de cada custom select
            const triggerNivel = document.querySelector('#dropdown-nivel .selected-text');
            const triggerGrupo = document.querySelector('#dropdown-grupo .selected-text');
            const triggerStatus = document.querySelector('#dropdown-status .selected-text');

            const nivel = triggerNivel ? triggerNivel.getAttribute('data-value') : '';
            const grupo = triggerGrupo ? triggerGrupo.getAttribute('data-value') : '';
            const status = triggerStatus ? triggerStatus.getAttribute('data-value') : '';

            let visibles = 0;

            filas.forEach(fila => {
                const textoGeneral = fila.textContent.toLowerCase();
                const tdNivel = fila.cells[3].textContent.toLowerCase();
                const tdGrupo = fila.cells[4].textContent.toLowerCase();
                const tdStatus = fila.cells[5].textContent.toLowerCase();

                const coincideTexto = textoGeneral.includes(query);
                const coincideNivel = nivel === '' || tdNivel.includes(nivel);
                const coincideGrupo = grupo === '' || tdGrupo.includes(grupo);
                const coincideStatus = status === '' || tdStatus.includes(status);

                if (coincideTexto && coincideNivel && coincideGrupo && coincideStatus) {
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

        // Lógica de los Custom Dropdowns
        const customDropdowns = document.querySelectorAll('.custom-dropdown');

        customDropdowns.forEach(dropdown => {
            const trigger = dropdown.querySelector('.custom-select-trigger');
            const options = dropdown.querySelectorAll('.custom-option');
            const selectedText = dropdown.querySelector('.selected-text');

            // Abrir / Cerrar Dropdown
            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                // Cerrar cualquier otro abierto
                customDropdowns.forEach(d => {
                    if (d !== dropdown) d.classList.remove('open');
                });
                dropdown.classList.toggle('open');
            });

            // Seleccionar opción
            options.forEach(option => {
                option.addEventListener('click', (e) => {
                    e.stopPropagation();

                    // Quitar clase selected a los demás
                    options.forEach(opt => opt.classList.remove('selected'));
                    option.classList.add('selected');

                    // Actualizar texto y valor en el trigger
                    const val = option.getAttribute('data-value');
                    const text = option.textContent;

                    selectedText.textContent = text;
                    selectedText.setAttribute('data-value', val);

                    // Cerrar el dropdown
                    dropdown.classList.remove('open');

                    // Aplicar Filtros a la tabla
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

                // Reiniciar custom dropdowns
                customDropdowns.forEach(dropdown => {
                    const options = dropdown.querySelectorAll('.custom-option');
                    const selectedText = dropdown.querySelector('.selected-text');

                    options.forEach(opt => opt.classList.remove('selected'));

                    // Elegir por default el primer option que en teoría es "Todos..."
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

        // ---- Lógica para Form Dropdowns (Independiente de Filtros) ----
        const formDropdowns = document.querySelectorAll('.form-dropdown');
        formDropdowns.forEach(dropdown => {
            const trigger = dropdown.querySelector('.form-select-trigger');
            const options = dropdown.querySelectorAll('.form-option');
            const selectedText = dropdown.querySelector('.selected-text');
            const hiddenInput = dropdown.querySelector('input[type="hidden"]');

            if (!trigger || !selectedText) return;

            // Abrir / Cerrar Dropdown
            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                // Cerrar cualquier otro abierto
                formDropdowns.forEach(d => {
                    if (d !== dropdown) d.classList.remove('open');
                });
                dropdown.classList.toggle('open');
            });

            // Seleccionar opción
            options.forEach(option => {
                option.addEventListener('click', (e) => {
                    e.stopPropagation();

                    // Quitar clase selected a los demás
                    options.forEach(opt => opt.classList.remove('selected'));
                    option.classList.add('selected');

                    // Actualizar texto y valor en el trigger
                    const val = option.getAttribute('data-value');
                    const text = option.textContent;

                    selectedText.textContent = text;
                    selectedText.setAttribute('data-value', val);

                    if (hiddenInput) {
                        hiddenInput.value = val;
                    }

                    // Cerrar el dropdown
                    dropdown.classList.remove('open');

                    // Limpiar error visual si es un campo de formulario
                    if (val !== "") {
                        dropdown.classList.remove('input-error');
                        const errorMsg = document.querySelector(`#err-${hiddenInput.id}`);
                        if (errorMsg) errorMsg.textContent = '';
                    }
                });
            });
        });

        // Cerrar dropdown si se hace clic fuera
        document.addEventListener('click', () => {
            formDropdowns.forEach(dropdown => dropdown.classList.remove('open'));
        });

    }

    // ---- Modal: Agregar Alumno ----
    const modalOverlay = document.getElementById('modal-agregar-alumno');
    const btnAgregar = document.getElementById('btn-agregar');
    const btnCerrarModal = document.getElementById('modal-close');
    const btnCancelarModal = document.getElementById('btn-cancelar-modal');
    const formAgregar = document.getElementById('form-agregar-alumno');

    const abrirModal = () => {
        if (modalOverlay) modalOverlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    const cerrarModal = () => {
        if (modalOverlay) modalOverlay.classList.remove('open');
        document.body.style.overflow = '';
        if (formAgregar) formAgregar.reset();
        // Limpiar form-dropdowns
        document.querySelectorAll('.form-dropdown').forEach(dropdown => {
            const options = dropdown.querySelectorAll('.form-option');
            const selectedText = dropdown.querySelector('.selected-text');
            const hiddenInput = dropdown.querySelector('input[type="hidden"]');
            
            dropdown.classList.remove('input-error', 'input-ok');
            options.forEach(opt => opt.classList.remove('selected'));
            
            if (options.length > 0) {
                // Selecciona una opción...
                options[0].classList.add('selected');
                if (selectedText) {
                    selectedText.textContent = options[0].textContent;
                    selectedText.setAttribute('data-value', options[0].getAttribute('data-value'));
                }
                if (hiddenInput) hiddenInput.value = options[0].getAttribute('data-value');
            }
        });

        // Limpiar estados de validación
        document.querySelectorAll('.form-group-modal input').forEach(inp => {
            inp.classList.remove('input-error', 'input-ok');
        });
        document.querySelectorAll('.error-msg-modal').forEach(msg => {
            msg.textContent = '';
        });
    };

    if (btnAgregar) btnAgregar.addEventListener('click', abrirModal);
    if (btnCerrarModal) btnCerrarModal.addEventListener('click', cerrarModal);
    if (btnCancelarModal) btnCancelarModal.addEventListener('click', cerrarModal);

    // Cerrar al hacer clic en el overlay (fuera del modal-box)
    if (modalOverlay) {
        modalOverlay.addEventListener('click', (e) => {
            if (e.target === modalOverlay) cerrarModal();
        });
    }

    // Cerrar con la tecla Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modalOverlay && modalOverlay.classList.contains('open')) {
            cerrarModal();
        }
    });

    // ---- Toggle mostrar/ocultar contraseña ----
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = btn.querySelector('i');
            if (!input) return;
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('ri-eye-line', 'ri-eye-off-line');
            } else {
                input.type = 'password';
                icon.classList.replace('ri-eye-off-line', 'ri-eye-line');
            }
        });
    });

    // ---- Validación del formulario ----
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

            // Nombre alumno
            const alNombre = document.getElementById('al-nombre');
            if (!alNombre || alNombre.value.trim() === '') {
                setError('al-nombre', 'err-al-nombre', 'El nombre es requerido.');
                valido = false;
            } else { setOk('al-nombre', 'err-al-nombre'); }

            // Apellido paterno alumno
            const alApP = document.getElementById('al-ap-paterno');
            if (!alApP || alApP.value.trim() === '') {
                setError('al-ap-paterno', 'err-al-ap-paterno', 'El apellido paterno es requerido.');
                valido = false;
            } else { setOk('al-ap-paterno', 'err-al-ap-paterno'); }

            // Correo alumno
            const alCorreo = document.getElementById('al-correo');
            const emailReg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!alCorreo || !emailReg.test(alCorreo.value.trim())) {
                setError('al-correo', 'err-al-correo', 'Ingresa un correo válido.');
                valido = false;
            } else { setOk('al-correo', 'err-al-correo'); }

            // Género alumno
            const alGenero = document.getElementById('al-genero');
            if (!alGenero || alGenero.value === '') {
                setError('dropdown-al-genero', 'err-al-genero', 'Selecciona un género.');
                valido = false;
            } else { setOk('dropdown-al-genero', 'err-al-genero'); }

            // Dirección alumno
            const alDireccion = document.getElementById('al-direccion');
            if (!alDireccion || alDireccion.value.trim() === '') {
                setError('al-direccion', 'err-al-direccion', 'La dirección es requerida.');
                valido = false;
            } else { setOk('al-direccion', 'err-al-direccion'); }

            // Contraseña alumno
            const alPass = document.getElementById('al-password');
            if (!alPass || alPass.value.length < 6) {
                setError('al-password', 'err-al-password', 'La contraseña debe tener al menos 6 caracteres.');
                valido = false;
            } else { setOk('al-password', 'err-al-password'); }

            // Confirmar contraseña alumno
            const alPassConf = document.getElementById('al-password-confirm');
            if (!alPassConf || alPassConf.value !== (alPass ? alPass.value : '')) {
                setError('al-password-confirm', 'err-al-password-confirm', 'Las contraseñas no coinciden.');
                valido = false;
            } else if (alPassConf.value !== '') { setOk('al-password-confirm', 'err-al-password-confirm'); }

            // Nombre tutor (Opcional)
            const tuNombre = document.getElementById('tu-nombre');
            setOk('tu-nombre', 'err-tu-nombre');

            // Apellido paterno tutor (Opcional)
            const tuApP = document.getElementById('tu-ap-paterno');
            setOk('tu-ap-paterno', 'err-tu-ap-paterno');

            // Correo tutor (Opcional, pero validar formato si se ingresa)
            const tuCorreo = document.getElementById('tu-correo');
            if (tuCorreo && tuCorreo.value.trim() !== '') {
                if (!emailReg.test(tuCorreo.value.trim())) {
                    setError('tu-correo', 'err-tu-correo', 'Ingresa un correo válido para el tutor.');
                    valido = false;
                } else {
                    setOk('tu-correo', 'err-tu-correo');
                }
            } else {
                setOk('tu-correo', 'err-tu-correo');
            }

            if (valido) {
                // TODO: Enviar datos al servidor
                console.log('Formulario válido. Listo para enviar.');
                cerrarModal();
            }
        });
    }

});
