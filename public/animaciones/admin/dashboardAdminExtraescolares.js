// ==============================================
//  dashboardAdminExtraescolares.js — Sección Extraescolares
//  EGAU Chess | AMAAC
// ==============================================

document.addEventListener('DOMContentLoaded', () => {

    const sectionExtraescolares = document.getElementById('section-extraescolares');

    if (!sectionExtraescolares) return;

    // ---- Búsqueda de Extraescolares ----
    const buscadorExtraescolares = document.getElementById('buscador-extraescolares');
    const gridExtraescolares = document.getElementById('grid-extraescolares');
    const msgEmpty = document.getElementById('extraescolares-empty');

    if (buscadorExtraescolares && gridExtraescolares) {
        buscadorExtraescolares.addEventListener('input', () => {
            const query = buscadorExtraescolares.value.toLowerCase().trim();
            const tarjetas = gridExtraescolares.querySelectorAll('.extraescolar-card');
            let visibles = 0;

            tarjetas.forEach(tarjeta => {
                const nombre = (tarjeta.getAttribute('data-nombre') || '').toLowerCase();

                if (nombre.includes(query)) {
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

    // ---- Lógica del Modal y Botones ----
    const modalExtraescolar = document.getElementById('modal-agregar-extraescolar');
    const btnAgregarExtraescolar = document.getElementById('btn-agregar-extraescolar');
    const btnCerrarModalExtraescolar = document.getElementById('modal-close-extraescolar');
    const btnCancelarModalExtraescolar = document.getElementById('btn-cancelar-modal-extraescolar');
    const formAgregarExtraescolar = document.getElementById('form-agregar-extraescolar');

    const abrirModalExtraescolar = () => {
        if (modalExtraescolar) modalExtraescolar.classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    const cerrarModalExtraescolar = () => {
        if (modalExtraescolar) modalExtraescolar.classList.remove('open');
        document.body.style.overflow = '';

        if (formAgregarExtraescolar) {
            formAgregarExtraescolar.reset();
        }

        if (modalExtraescolar) {
            modalExtraescolar.querySelectorAll('.form-dropdown').forEach(dropdown => {
                const options = dropdown.querySelectorAll('.form-option');
                const selectedText = dropdown.querySelector('.selected-text');
                const hiddenInput = dropdown.querySelector('input[type="hidden"]');

                dropdown.classList.remove('input-error', 'input-ok');
                options.forEach(opt => opt.classList.remove('selected'));

                if (options.length > 0) {
                    options[0].classList.add('selected');
                    if (selectedText) {
                        selectedText.textContent = options[0].textContent;
                        selectedText.setAttribute('data-value', options[0].getAttribute('data-value'));
                    }
                    if (hiddenInput) hiddenInput.value = options[0].getAttribute('data-value');
                }
            });

            modalExtraescolar.querySelectorAll('.form-group-modal input, .form-group-modal textarea').forEach(inp => {
                inp.classList.remove('input-error', 'input-ok');
            });
            modalExtraescolar.querySelectorAll('.error-msg-modal').forEach(msg => {
                msg.textContent = '';
            });
        }
    };

    if (btnAgregarExtraescolar) btnAgregarExtraescolar.addEventListener('click', abrirModalExtraescolar);
    if (btnCerrarModalExtraescolar) btnCerrarModalExtraescolar.addEventListener('click', cerrarModalExtraescolar);
    if (btnCancelarModalExtraescolar) btnCancelarModalExtraescolar.addEventListener('click', cerrarModalExtraescolar);

    if (modalExtraescolar) {
        modalExtraescolar.addEventListener('click', (e) => {
            if (e.target === modalExtraescolar) cerrarModalExtraescolar();
        });
    }

    // ---- Lógica para Form Dropdowns del modal Extraescolar ----
    const formDropdownsExt = document.querySelectorAll('#modal-agregar-extraescolar .form-dropdown');
    formDropdownsExt.forEach(dropdown => {
        const trigger = dropdown.querySelector('.form-select-trigger');
        const options = dropdown.querySelectorAll('.form-option');
        const selectedText = dropdown.querySelector('.selected-text');
        const hiddenInput = dropdown.querySelector('input[type="hidden"]');
        if (!trigger || !selectedText) return;
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            formDropdownsExt.forEach(d => { if (d !== dropdown) d.classList.remove('open'); });
            dropdown.classList.toggle('open');
        });
        options.forEach(option => {
            option.addEventListener('click', (e) => {
                e.stopPropagation();
                options.forEach(opt => opt.classList.remove('selected'));
                option.classList.add('selected');
                selectedText.textContent = option.textContent;
                selectedText.setAttribute('data-value', option.getAttribute('data-value'));
                if (hiddenInput) hiddenInput.value = option.getAttribute('data-value');
                dropdown.classList.remove('open');
                dropdown.classList.remove('input-error');
            });
        });
    });
    document.addEventListener('click', () => {
        formDropdownsExt.forEach(d => d.classList.remove('open'));
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (modalExtraescolar && modalExtraescolar.classList.contains('open')) cerrarModalExtraescolar();
        }
    });

    // ---- Validación del formulario ----
    if (formAgregarExtraescolar) {
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

        formAgregarExtraescolar.addEventListener('submit', (e) => {
            e.preventDefault();
            let valido = true;

            const nombre = document.getElementById('ex-nombre');
            if (!nombre || nombre.value.trim() === '') {
                setError('ex-nombre', 'err-ex-nombre', 'El nombre de la actividad es necesario.');
                valido = false;
            } else { setOk('ex-nombre', 'err-ex-nombre'); }

            const fechaInicio = document.getElementById('ex-fecha-inicio');
            if (!fechaInicio || fechaInicio.value === '') {
                setError('ex-fecha-inicio', 'err-ex-fecha-inicio', 'Selecciona la fecha de inicio.');
                valido = false;
            } else { setOk('ex-fecha-inicio', 'err-ex-fecha-inicio'); }

            const fechaFin = document.getElementById('ex-fecha-fin');
            if (!fechaFin || fechaFin.value === '') {
                setError('ex-fecha-fin', 'err-ex-fecha-fin', 'Selecciona la fecha de término.');
                valido = false;
            } else {
                if (fechaInicio && fechaInicio.value !== '') {
                    const fInicio = new Date(fechaInicio.value);
                    const fFin = new Date(fechaFin.value);
                    if (fFin <= fInicio) {
                        setError('ex-fecha-fin', 'err-ex-fecha-fin', 'Debe ser posterior a la fecha de inicio.');
                        valido = false;
                    } else {
                        setOk('ex-fecha-fin', 'err-ex-fecha-fin');
                    }
                } else {
                    setOk('ex-fecha-fin', 'err-ex-fecha-fin');
                }
            }

            const cupo = document.getElementById('ex-cupo-maximo');
            if (!cupo || cupo.value.trim() === '' || cupo.value <= 0) {
                setError('ex-cupo-maximo', 'err-ex-cupo-maximo', 'Ingresa un cupo mayor a 0.');
                valido = false;
            } else { setOk('ex-cupo-maximo', 'err-ex-cupo-maximo'); }

            if (valido) {
                const btnSubmit = formAgregarExtraescolar.querySelector('.btn-modal-submit');
                if (btnSubmit) {
                    const originalHTML = btnSubmit.innerHTML;
                    btnSubmit.innerHTML = '<i class="ri-loader-4-line ri-spin"></i> Guardando Actividad...';
                    btnSubmit.disabled = true;

                    setTimeout(() => {
                        btnSubmit.innerHTML = originalHTML;
                        btnSubmit.disabled = false;
                        cerrarModalExtraescolar();
                        const cardEmpty = document.getElementById('extraescolares-empty');
                        if (cardEmpty) cardEmpty.style.display = 'none';

                        alert("¡Actividad Extraescolar guardada con éxito!");
                    }, 1200);
                }
            }
        });
    }

});
