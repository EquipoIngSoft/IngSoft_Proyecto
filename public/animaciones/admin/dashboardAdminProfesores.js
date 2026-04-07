// ==============================================
//  dashboardAdminProfesores.js — Sección Profesores
//  Búsqueda, Modal y Validación
//  EGAU Chess | AMAAC
// ==============================================

document.addEventListener('DOMContentLoaded', () => {

    const sectionProfesores = document.getElementById('section-profesores');
    
    // Solo ejecutamos si hay al menos un elemento de profesores en pantalla
    if (!sectionProfesores) return;

    // ---- Búsqueda de Profesores ----
    const buscadorProf = document.getElementById('buscador-profesores');
    const gridProfesores = document.getElementById('grid-profesores');
    const msgEmpty = document.getElementById('profesores-empty');

    if (buscadorProf && gridProfesores) {
        // Asumiendo que las tarjetas no se cargan por AJAX de inmediato, si se cargaran,
        // deberías hacer la query document.querySelectorAll dentro del input. 
        // Por ahora lo hacemos dinámicamente:
        
        buscadorProf.addEventListener('input', () => {
            const query = buscadorProf.value.toLowerCase().trim();
            const tarjetas = gridProfesores.querySelectorAll('.profesor-card');
            let visibles = 0;

            tarjetas.forEach(tarjeta => {
                const nombre = (tarjeta.getAttribute('data-nombre') || '').toLowerCase();
                const email = (tarjeta.getAttribute('data-email') || '').toLowerCase();

                if (nombre.includes(query) || email.includes(query)) {
                    tarjeta.style.display = 'flex';
                    visibles++;
                } else {
                    tarjeta.style.display = 'none';
                }
            });

            if (msgEmpty) {
                if (visibles === 0 && tarjetas.length > 0) {
                    msgEmpty.style.display = 'block';
                } else {
                    msgEmpty.style.display = 'none';
                }
            }
        });
    }

    // ---- Modal: Agregar Profesor ----
    const modalProfesor = document.getElementById('modal-agregar-profesor');
    const btnAgregarProfesor = document.getElementById('btn-agregar-profesor');
    const btnCerrarModalProf = document.getElementById('modal-close-profesor');
    const btnCancelarModalProf = document.getElementById('btn-cancelar-modal-profesor');
    const formAgregarProf = document.getElementById('form-agregar-profesor');

    const abrirModalProfesor = () => {
        if (modalProfesor) modalProfesor.classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    const cerrarModalProfesor = () => {
        if (modalProfesor) modalProfesor.classList.remove('open');
        document.body.style.overflow = '';
        if (formAgregarProf) formAgregarProf.reset();

        // Limpiar dropdowns dentro del modal de profesor (Ej: Género)
        if (modalProfesor) {
            modalProfesor.querySelectorAll('.form-dropdown').forEach(dropdown => {
                const options = dropdown.querySelectorAll('.form-option');
                const selectedText = dropdown.querySelector('.selected-text');
                const hiddenInput = dropdown.querySelector('input[type="hidden"]');
                
                dropdown.classList.remove('input-error', 'input-ok');
                options.forEach(opt => opt.classList.remove('selected'));
                
                if (options.length > 0) {
                    options[0].classList.add('selected'); // "Selecciona una opción"
                    if (selectedText) {
                        selectedText.textContent = options[0].textContent;
                        selectedText.setAttribute('data-value', options[0].getAttribute('data-value'));
                    }
                    if (hiddenInput) hiddenInput.value = options[0].getAttribute('data-value');
                }
            });

            // Limpiar estados de validación de inputs
            modalProfesor.querySelectorAll('.form-group-modal input').forEach(inp => {
                inp.classList.remove('input-error', 'input-ok');
            });
            modalProfesor.querySelectorAll('.error-msg-modal').forEach(msg => {
                msg.textContent = '';
            });
            
            // Revertir tipo de inputs de password
            modalProfesor.querySelectorAll('input[type="text"]').forEach(inp => {
                if(inp.id.includes('password')) {
                    inp.type = 'password';
                    const icon = inp.nextElementSibling.querySelector('i');
                    if (icon) icon.classList.replace('ri-eye-off-line', 'ri-eye-line');
                }
            });
        }
    };

    if (btnAgregarProfesor) btnAgregarProfesor.addEventListener('click', abrirModalProfesor);
    if (btnCerrarModalProf) btnCerrarModalProf.addEventListener('click', cerrarModalProfesor);
    if (btnCancelarModalProf) btnCancelarModalProf.addEventListener('click', cerrarModalProfesor);

    // Cerrar al hacer clic en el overlay (fuera del modal-box)
    if (modalProfesor) {
        modalProfesor.addEventListener('click', (e) => {
            if (e.target === modalProfesor) cerrarModalProfesor();
        });
    }

    // Cerrar con Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modalProfesor && modalProfesor.classList.contains('open')) {
            cerrarModalProfesor();
        }
    });

    // ---- Toggle mostrar/ocultar contraseña (específico para profesor) ----
    if (modalProfesor) {
        modalProfesor.querySelectorAll('.toggle-password').forEach(btn => {
            // Evitar duplicados si hay scripts globales
            const newBtn = btn.cloneNode(true);
            btn.parentNode.replaceChild(newBtn, btn);
            
            newBtn.addEventListener('click', () => {
                const targetId = newBtn.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = newBtn.querySelector('i');
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
    }

    // ---- Validación del formulario de Profesor ----
    if (formAgregarProf) {
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

        formAgregarProf.addEventListener('submit', (e) => {
            e.preventDefault();
            let valido = true;

            // Nombre
            const prNombre = document.getElementById('pr-nombre');
            if (!prNombre || prNombre.value.trim() === '') {
                setError('pr-nombre', 'err-pr-nombre', 'El nombre es requerido.');
                valido = false;
            } else { setOk('pr-nombre', 'err-pr-nombre'); }

            // Apellido paterno
            const prApP = document.getElementById('pr-ap-paterno');
            if (!prApP || prApP.value.trim() === '') {
                setError('pr-ap-paterno', 'err-pr-ap-paterno', 'El apellido paterno es requerido.');
                valido = false;
            } else { setOk('pr-ap-paterno', 'err-pr-ap-paterno'); }

            // Correo
            const prCorreo = document.getElementById('pr-correo');
            const emailReg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!prCorreo || !emailReg.test(prCorreo.value.trim())) {
                setError('pr-correo', 'err-pr-correo', 'Ingresa un correo válido.');
                valido = false;
            } else { setOk('pr-correo', 'err-pr-correo'); }

            // Género
            const prGeneroDropdown = document.getElementById('dropdown-pr-genero');
            const prGeneroInput = document.getElementById('pr-genero');
            if (!prGeneroInput || prGeneroInput.value === '') {
                if (prGeneroDropdown) {
                    prGeneroDropdown.classList.add('input-error');
                    prGeneroDropdown.classList.remove('input-ok');
                }
                const msg = document.getElementById('err-pr-genero');
                if (msg) msg.textContent = 'Selecciona un género.';
                valido = false;
            } else { 
                if (prGeneroDropdown) {
                    prGeneroDropdown.classList.remove('input-error');
                    prGeneroDropdown.classList.add('input-ok');
                }
                const msg = document.getElementById('err-pr-genero');
                if (msg) msg.textContent = '';
            }

            // Contraseña
            const prPass = document.getElementById('pr-password');
            if (!prPass || prPass.value.length < 6) {
                setError('pr-password', 'err-pr-password', 'La contraseña debe tener al menos 6 caracteres.');
                valido = false;
            } else { setOk('pr-password', 'err-pr-password'); }

            // Confirmar contraseña
            const prPassConf = document.getElementById('pr-password-confirm');
            if (!prPassConf || prPassConf.value !== (prPass ? prPass.value : '')) {
                setError('pr-password-confirm', 'err-pr-password-confirm', 'Las contraseñas no coinciden.');
                valido = false;
            } else if (prPassConf.value !== '') { setOk('pr-password-confirm', 'err-pr-password-confirm'); }

            // Dirección: Estado
            const prEstado = document.getElementById('pr-estado');
            if (!prEstado || prEstado.value === '') {
                setError('dropdown-pr-estado', 'err-pr-estado', 'Selecciona un estado.');
                valido = false;
            } else { setOk('dropdown-pr-estado', 'err-pr-estado'); }

            // Dirección: Ciudad
            const prCiudad = document.getElementById('pr-ciudad');
            if (!prCiudad || prCiudad.value.trim() === '') {
                setError('pr-ciudad', 'err-pr-ciudad', 'La ciudad es requerida.');
                valido = false;
            } else { setOk('pr-ciudad', 'err-pr-ciudad'); }

            // Dirección: Calle
            const prCalle = document.getElementById('pr-calle');
            if (!prCalle || prCalle.value.trim() === '') {
                setError('pr-calle', 'err-pr-calle', 'La calle es requerida.');
                valido = false;
            } else { setOk('pr-calle', 'err-pr-calle'); }

            // Dirección: CP
            const prCP = document.getElementById('pr-cp');
            const cpReg = /^\d{5}$/;
            if (!prCP || !cpReg.test(prCP.value.trim())) {
                setError('pr-cp', 'err-pr-cp', 'Ingresa un CP válido (5 dígitos).');
                valido = false;
            } else { setOk('pr-cp', 'err-pr-cp'); }

            // Sede
            const prSede = document.getElementById('pr-sede');
            if (!prSede || prSede.value === '') {
                setError('dropdown-pr-sede', 'err-pr-sede', 'Selecciona una sede.');
                valido = false;
            } else { setOk('dropdown-pr-sede', 'err-pr-sede'); }

            // Teléfono
            const prTelefono = document.getElementById('pr-telefono');
            if (prTelefono && prTelefono.value.trim() !== '') {
                if (prTelefono.value.length !== 10) {
                     setError('pr-telefono', 'err-pr-telefono', 'Ingrese un teléfono o celular de 10 dígitos.');
                     valido = false;
                } else { setOk('pr-telefono', 'err-pr-telefono'); }
            } else { setOk('pr-telefono', 'err-pr-telefono'); } // Limpiar error si está vacío


            if (valido) {
                // TODO: Mandar fecth(POST) a backend Laravel o procesar
                console.log('Formulario de profesor válido. Listo para enviar.');
                
                // Efecto visual de enviar
                const btnSubmit = formAgregarProf.querySelector('.btn-modal-submit');
                if (btnSubmit) {
                    const originalHTML = btnSubmit.innerHTML;
                    btnSubmit.innerHTML = '<i class="ri-loader-4-line ri-spin"></i> Guardando...';
                    btnSubmit.disabled = true;
                    
                    setTimeout(() => {
                        btnSubmit.innerHTML = originalHTML;
                        btnSubmit.disabled = false;
                        cerrarModalProfesor();
                        alert("Simulación: Profesor guardado exitosamente");
                    }, 1500);
                }
            }
        });
    }

});
