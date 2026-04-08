// ==============================================
//  dashboardAdminGrupos.js — Sección Grupos
//  Búsqueda, Modal y Lógica de Horarios Dinámicos
//  EGAU Chess | AMAAC
// ==============================================

document.addEventListener('DOMContentLoaded', () => {

    const sectionGrupos = document.getElementById('section-grupos');
    
    // Solo se ejecuta si estamos en una vista que contiene la sección de grupos
    if (!sectionGrupos) return;

    // ---- Búsqueda de Grupos ----
    const buscadorGrupos = document.getElementById('buscador-grupos');
    const gridGrupos = document.getElementById('grid-grupos');
    const msgEmpty = document.getElementById('grupos-empty');

    if (buscadorGrupos && gridGrupos) {
        buscadorGrupos.addEventListener('input', () => {
            const query = buscadorGrupos.value.toLowerCase().trim();
            const tarjetas = gridGrupos.querySelectorAll('.grupo-card');
            let visibles = 0;

            tarjetas.forEach(tarjeta => {
                const nombre = (tarjeta.getAttribute('data-nombre') || '').toLowerCase();
                const nivel = (tarjeta.getAttribute('data-nivel') || '').toLowerCase();
                const profesor = (tarjeta.getAttribute('data-profesor') || '').toLowerCase();

                if (nombre.includes(query) || nivel.includes(query) || profesor.includes(query)) {
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
    const modalGrupo = document.getElementById('modal-agregar-grupo');
    const btnAgregarGrupo = document.getElementById('btn-agregar-grupo');
    const btnCerrarModalGrupo = document.getElementById('modal-close-grupo');
    const btnCancelarModalGrupo = document.getElementById('btn-cancelar-modal-grupo');
    const formAgregarGrupo = document.getElementById('form-agregar-grupo');
    
    // Elementos de horarios
    const btnAddHorario = document.getElementById('btn-add-horario');
    const horariosList = document.getElementById('horarios-list');

    // Plantilla para la fila de horario
    const createHorarioRow = () => {
        const row = document.createElement('div');
        row.classList.add('horario-row');
        
        row.innerHTML = `
            <select class="hora-dia" name="dias[]" required>
                <option value="" disabled selected>Día de la semana</option>
                <option value="1">Lunes</option>
                <option value="2">Martes</option>
                <option value="3">Miércoles</option>
                <option value="4">Jueves</option>
                <option value="5">Viernes</option>
                <option value="6">Sábado</option>
                <option value="0">Domingo</option>
            </select>
            <input type="text" class="hora-aula" name="aulas[]" placeholder="Aula (ej. Salón 3)" maxlength="20">
            <input type="time" class="hora-inicio" name="horas_inicio[]" required title="Hora de inicio">
            <input type="time" class="hora-fin" name="horas_fin[]" required title="Hora de fin">
            <button type="button" class="btn-remove-horario" title="Eliminar este horario">
                <i class="ri-delete-back-2-line"></i>
            </button>
        `;

        // Añadir evento para eliminar
        row.querySelector('.btn-remove-horario').addEventListener('click', () => {
            row.remove();
            // Limpiamos posible mensaje de error general al hacer cambios
            const errHorarios = document.getElementById('err-gr-horarios');
            if(errHorarios) errHorarios.textContent = '';
        });

        // Limpiar errores visuales al cambiar algo en la fila
        row.querySelectorAll('select, input').forEach(el => {
            el.addEventListener('change', () => {
                row.classList.remove('input-error');
                const errHorarios = document.getElementById('err-gr-horarios');
                if(errHorarios) errHorarios.textContent = '';
            });
        });

        return row;
    };

    const abrirModalGrupo = () => {
        if (modalGrupo) modalGrupo.classList.add('open');
        document.body.style.overflow = 'hidden';

        // Por defecto añadir una fila de horario si está vacío
        if (horariosList && horariosList.children.length === 0) {
            horariosList.appendChild(createHorarioRow());
        }
    };

    const cerrarModalGrupo = () => {
        if (modalGrupo) modalGrupo.classList.remove('open');
        document.body.style.overflow = '';
        
        // Reset form
        if (formAgregarGrupo) {
            formAgregarGrupo.reset();
        }

        // Limpiar dropdowns del modal grupo
        if (modalGrupo) {
            modalGrupo.querySelectorAll('.form-dropdown').forEach(dropdown => {
                const options = dropdown.querySelectorAll('.form-option');
                const selectedText = dropdown.querySelector('.selected-text');
                const hiddenInput = dropdown.querySelector('input[type="hidden"]');
                
                dropdown.classList.remove('input-error', 'input-ok');
                options.forEach(opt => opt.classList.remove('selected'));
                
                if (options.length > 0) {
                    options[0].classList.add('selected'); // Selección por defecto
                    if (selectedText) {
                        selectedText.textContent = options[0].textContent;
                        selectedText.setAttribute('data-value', options[0].getAttribute('data-value'));
                    }
                    if (hiddenInput) hiddenInput.value = options[0].getAttribute('data-value');
                }
            });

            // Limpiar estados de error general
            modalGrupo.querySelectorAll('.form-group-modal input, .horario-row').forEach(inp => {
                inp.classList.remove('input-error', 'input-ok');
            });
            modalGrupo.querySelectorAll('.error-msg-modal').forEach(msg => {
                msg.textContent = '';
            });

            // Vaciar horarios
            if (horariosList) {
                horariosList.innerHTML = '';
            }
        }
    };

    // Eventos principales del modal grupos
    if (btnAgregarGrupo) btnAgregarGrupo.addEventListener('click', abrirModalGrupo);
    if (btnCerrarModalGrupo) btnCerrarModalGrupo.addEventListener('click', cerrarModalGrupo);
    if (btnCancelarModalGrupo) btnCancelarModalGrupo.addEventListener('click', cerrarModalGrupo);

    if (modalGrupo) {
        modalGrupo.addEventListener('click', (e) => {
            if (e.target === modalGrupo) cerrarModalGrupo();
        });
    }

    // ---- Lógica del Modal y Tabla de Cursos ----
    const buscadorCursos = document.getElementById('buscador-tabla-cursos');
    const tablaCursos = document.getElementById('tabla-cursos');

    if (buscadorCursos && tablaCursos) {
        buscadorCursos.addEventListener('input', () => {
            const query = buscadorCursos.value.toLowerCase().trim();
            const filas = tablaCursos.querySelectorAll('tbody tr');

            filas.forEach(fila => {
                // Obtenemos el texto visible de la fila
                const textoFila = fila.textContent.toLowerCase();
                
                if (textoFila.includes(query)) {
                    fila.style.display = '';
                } else {
                    fila.style.display = 'none';
                }
            });
        });
    }

    const modalCurso = document.getElementById('modal-agregar-curso');
    const btnAgregarCurso = document.getElementById('btn-agregar-curso');
    const btnCerrarModalCurso = document.getElementById('modal-close-curso');
    const btnCancelarModalCurso = document.getElementById('btn-cancelar-modal-curso');
    const formAgregarCurso = document.getElementById('form-agregar-curso');

    const abrirModalCurso = () => {
        if (modalCurso) modalCurso.classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    const cerrarModalCurso = () => {
        if (modalCurso) modalCurso.classList.remove('open');
        document.body.style.overflow = '';
        if (formAgregarCurso) formAgregarCurso.reset();

        // Limpiar dropdowns
        if (modalCurso) {
            modalCurso.querySelectorAll('.form-dropdown').forEach(dropdown => {
                const options = dropdown.querySelectorAll('.form-option');
                const selectedText = dropdown.querySelector('.selected-text');
                const hiddenInput = dropdown.querySelector('input[type="hidden"]');
                
                dropdown.classList.remove('input-error', 'input-ok');
                options.forEach(opt => opt.classList.remove('selected'));
                
                if (options.length > 0) {
                    options[0].classList.add('selected'); // Selección por defecto
                    if (selectedText) {
                        selectedText.textContent = options[0].textContent;
                        selectedText.setAttribute('data-value', options[0].getAttribute('data-value'));
                    }
                    if (hiddenInput) hiddenInput.value = options[0].getAttribute('data-value');
                }
            });

            // Limpiar errores
            modalCurso.querySelectorAll('.form-group-modal input, .form-group-modal textarea').forEach(inp => {
                inp.classList.remove('input-error', 'input-ok');
            });
            modalCurso.querySelectorAll('.error-msg-modal').forEach(msg => {
                msg.textContent = '';
            });
        }
    };

    if (btnAgregarCurso) btnAgregarCurso.addEventListener('click', abrirModalCurso);
    if (btnCerrarModalCurso) btnCerrarModalCurso.addEventListener('click', cerrarModalCurso);
    if (btnCancelarModalCurso) btnCancelarModalCurso.addEventListener('click', cerrarModalCurso);

    if (modalCurso) {
        modalCurso.addEventListener('click', (e) => {
            if (e.target === modalCurso) cerrarModalCurso();
        });
    }

    // ---- Lógica para Form Dropdowns del modal Grupo ----
    const formDropdownsGrupo = document.querySelectorAll('#modal-agregar-grupo .form-dropdown');
    formDropdownsGrupo.forEach(dropdown => {
        const trigger = dropdown.querySelector('.form-select-trigger');
        const options = dropdown.querySelectorAll('.form-option');
        const selectedText = dropdown.querySelector('.selected-text');
        const hiddenInput = dropdown.querySelector('input[type="hidden"]');
        if (!trigger || !selectedText) return;
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            formDropdownsGrupo.forEach(d => { if (d !== dropdown) d.classList.remove('open'); });
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
        formDropdownsGrupo.forEach(d => d.classList.remove('open'));
    });

    // ---- Lógica para Form Dropdowns del modal Curso ----
    const formDropdownsCurso = document.querySelectorAll('#modal-agregar-curso .form-dropdown');
    formDropdownsCurso.forEach(dropdown => {
        const trigger = dropdown.querySelector('.form-select-trigger');
        const options = dropdown.querySelectorAll('.form-option');
        const selectedText = dropdown.querySelector('.selected-text');
        const hiddenInput = dropdown.querySelector('input[type="hidden"]');
        if (!trigger || !selectedText) return;
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            formDropdownsCurso.forEach(d => { if (d !== dropdown) d.classList.remove('open'); });
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
        formDropdownsCurso.forEach(d => d.classList.remove('open'));
    });


    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (modalGrupo && modalGrupo.classList.contains('open')) cerrarModalGrupo();
            if (modalCurso && modalCurso.classList.contains('open')) cerrarModalCurso();
        }
    });

    // Agregar Nueva Fila de Horario
    if (btnAddHorario && horariosList) {
        btnAddHorario.addEventListener('click', () => {
            horariosList.appendChild(createHorarioRow());
        });
    }


    // ---- Validación del formulario ----
    if (formAgregarGrupo) {
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

        formAgregarGrupo.addEventListener('submit', (e) => {
            e.preventDefault();
            let valido = true;

            // 1. Validar Selects Ocultos (dropdown)
            const validarDropdown = (hiddenId, dropdownId, errorId, errorMsg) => {
                const hiddenInput = document.getElementById(hiddenId);
                const visualDropdown = document.getElementById(dropdownId);
                if (!hiddenInput || hiddenInput.value.trim() === '') {
                    if (visualDropdown) visualDropdown.classList.add('input-error');
                    const msg = document.getElementById(errorId);
                    if (msg) msg.textContent = errorMsg;
                    return false;
                } else {
                    if (visualDropdown) visualDropdown.classList.remove('input-error');
                    const msg = document.getElementById(errorId);
                    if (msg) msg.textContent = '';
                    return true;
                }
            };

            // Curso
            if (!validarDropdown('gr-curso', 'dropdown-gr-curso', 'err-gr-curso', 'Selecciona el curso a impartir.')) {
                valido = false;
            }

            // Instructor
            if (!validarDropdown('gr-instructor', 'dropdown-gr-instructor', 'err-gr-instructor', 'Asigna un instructor a este grupo.')) {
                valido = false;
            }

            // 2. Validar Texts/Dates normales
            const codigo = document.getElementById('gr-codigo');
            if (!codigo || codigo.value.trim() === '') {
                setError('gr-codigo', 'err-gr-codigo', 'El código de grupo es necesario.');
                valido = false;
            } else { setOk('gr-codigo', 'err-gr-codigo'); }

            const fechaInicio = document.getElementById('gr-fecha-inicio');
            if (!fechaInicio || fechaInicio.value === '') {
                setError('gr-fecha-inicio', 'err-gr-fecha-inicio', 'Selecciona la fecha de inicio.');
                valido = false;
            } else { setOk('gr-fecha-inicio', 'err-gr-fecha-inicio'); }

            const fechaFin = document.getElementById('gr-fecha-fin');
            if (!fechaFin || fechaFin.value === '') {
                setError('gr-fecha-fin', 'err-gr-fecha-fin', 'Selecciona la fecha de término.');
                valido = false;
            } else {
                // Compara fechas
                if (fechaInicio && fechaInicio.value !== '') {
                    const fInicio = new Date(fechaInicio.value);
                    const fFin = new Date(fechaFin.value);
                    if (fFin <= fInicio) {
                        setError('gr-fecha-fin', 'err-gr-fecha-fin', 'Debe ser posterior a la fecha de inicio.');
                        valido = false;
                    } else {
                        setOk('gr-fecha-fin', 'err-gr-fecha-fin');
                    }
                } else {
                    setOk('gr-fecha-fin', 'err-gr-fecha-fin');
                }
            }

            const cupo = document.getElementById('gr-cupo-maximo');
            if (!cupo || cupo.value.trim() === '' || cupo.value <= 0) {
                setError('gr-cupo-maximo', 'err-gr-cupo-maximo', 'Ingresa un cupo mayor a 0.');
                valido = false;
            } else { setOk('gr-cupo-maximo', 'err-gr-cupo-maximo'); }

            // 3. Validar Horarios Dinámicos
            const filasHorarios = document.querySelectorAll('.horario-row');
            const msgHorarios = document.getElementById('err-gr-horarios');
            
            if (filasHorarios.length === 0) {
                if(msgHorarios) msgHorarios.textContent = 'Debes añadir al menos un día de clase para este grupo.';
                valido = false;
            } else {
                let errorEnHorario = false;
                
                filasHorarios.forEach(fila => {
                    const dia = fila.querySelector('.hora-dia').value;
                    const hInicio = fila.querySelector('.hora-inicio').value;
                    const hFin = fila.querySelector('.hora-fin').value;
                    
                    if (dia === '' || hInicio === '' || hFin === '') {
                        errorEnHorario = true;
                        fila.classList.add('input-error');
                    } else {
                        // Validar lógica de horas (Inicio < Fin)
                        if (hInicio >= hFin) {
                            errorEnHorario = true;
                            fila.classList.add('input-error');
                        } else {
                            fila.classList.remove('input-error');
                        }
                    }
                });

                if (errorEnHorario) {
                    valido = false;
                    if(msgHorarios) msgHorarios.textContent = 'Completa todos los horarios de forma válida (Hora inicio antes que hora de fin).';
                } else {
                    if(msgHorarios) msgHorarios.textContent = '';
                }
            }


            // RESULTADO
            if (valido) {
                // TODO: Mandar backend
                console.log('Formulario de Grupo válido, enviando a servidor...');

                const btnSubmit = formAgregarGrupo.querySelector('.btn-modal-submit');
                if (btnSubmit) {
                    const originalHTML = btnSubmit.innerHTML;
                    btnSubmit.innerHTML = '<i class="ri-loader-4-line ri-spin"></i> Guardando Grupo...';
                    btnSubmit.disabled = true;
                    
                    setTimeout(() => {
                        btnSubmit.innerHTML = originalHTML;
                        btnSubmit.disabled = false;
                        cerrarModalGrupo();
                        // Simulación updateUI
                        const cardGruposEmpty = document.getElementById('grupos-empty');
                        if(cardGruposEmpty) cardGruposEmpty.style.display = 'none';

                        alert("Simulación: Grupo Guardado. El grupo fue persistido, y los horarios vinculados mediante su Id.");
                    }, 1200);
                }
            }
        });
    }

    // ---- Validación del formulario Cursos ----
    if (formAgregarCurso) {
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

        formAgregarCurso.addEventListener('submit', (e) => {
            e.preventDefault();
            let valido = true;

            const cuNombre = document.getElementById('cu-nombre');
            if (!cuNombre || cuNombre.value.trim() === '') {
                setError('cu-nombre', 'err-cu-nombre', 'El nombre del curso es obligatorio.');
                valido = false;
            } else { setOk('cu-nombre', 'err-cu-nombre'); }

            const dropdownSede = document.getElementById('dropdown-cu-sede');
            const hiddenSede = document.getElementById('cu-sede');
            if (!hiddenSede || hiddenSede.value.trim() === '') {
                if (dropdownSede) dropdownSede.classList.add('input-error');
                const msg = document.getElementById('err-cu-sede');
                if (msg) msg.textContent = 'Selecciona una sede.';
                valido = false;
            } else {
                if (dropdownSede) dropdownSede.classList.remove('input-error');
                const msg = document.getElementById('err-cu-sede');
                if (msg) msg.textContent = '';
            }

            if (valido) {
                const btnSubmit = formAgregarCurso.querySelector('.btn-modal-submit');
                if (btnSubmit) {
                    const originalHTML = btnSubmit.innerHTML;
                    btnSubmit.innerHTML = '<i class="ri-loader-4-line ri-spin"></i> Guardando Curso...';
                    btnSubmit.disabled = true;
                    
                    setTimeout(() => {
                        btnSubmit.innerHTML = originalHTML;
                        btnSubmit.disabled = false;
                        cerrarModalCurso();
                        alert("Simulación: Curso guardado.");
                    }, 1000);
                }
            }
        });
    }

});
