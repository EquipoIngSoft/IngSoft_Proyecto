// ==============================================
//  dashboardAlumnoMiPerfil.js
//  Responsable: Mariana
//  EGAU Chess | Portal del Estudiante
// ==============================================

// Lógica de edición de perfil y validación de contraseña.

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const userToken = document.querySelector('meta[name="user-token"]').getAttribute('content');

const headers = {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': csrfToken,
    'Authorization': 'Bearer ' + userToken
};

window.validarPassword = function () {
    const oldPass = document.getElementById('old_pass');
    const pass = document.getElementById('new_pass');
    const confirm = document.getElementById('confirm_pass');
    if (!oldPass || !pass || !confirm) return;

    if (!oldPass.value) {
        egauAlert('Por favor, ingresa tu contraseña antigua.', 'warning')
        return;
    }

    if (pass.value !== confirm.value) {
        egauAlert('Las contraseñas no coinciden. Por favor, verifica.', 'error')
    } else if (pass.value.length < 8) {
        egauAlert('La contraseña debe tener al menos 8 caracteres.', 'warning')
    } else {
        fetch('/alumno/perfil/password', {
            method: 'PUT',
            headers: headers,
            body: JSON.stringify({
                contrasena_antigua: oldPass.value,
                contrasena_nueva: pass.value,
                contrasena_confirmar: confirm.value
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.errors || data.error) {
                    let msg = data.error || 'Revisa los datos introducidos.';
                    if (data.errors) {
                        msg = Object.values(data.errors).flat().join('\n');
                    }
                    egauAlert(msg || 'Error al actualizar la contraseña.', 'error')
                } else {
                    egauAlert('¡Contraseña actualizada con éxito!', 'success')
                    document.getElementById('formPassword')?.reset();
                }
            })
            .catch(err => {
                console.error('Error al actualizar contraseña:', err);
                egauAlert('Hubo un error al actualizar la contraseña.', 'error')
            });
    }
};

(function () {

    function cargarPerfil() {
        return fetch('/alumno/perfil', {
            headers: headers
        })
            .then(res => res.json())
            .then(data => {
                if (data.error) return;

                const a = data.alumno;
                const n = data.nivel;

                // Info Academica
                document.getElementById('info_puntaje').textContent = a.puntaje || '0';
                document.getElementById('info_sede').textContent = data.sede || '—';
                document.getElementById('info_nacimiento').textContent = a.fecha_nacimiento || '—';
                document.getElementById('info_ingreso').textContent = a.fecha_ingreso || '—';

                if (n) {
                    const nivelTexto = `Nivel ${n.numero} - ${n.nombre} ${n.emoji}`;
                    const badge = document.getElementById('perfil_nivel_badge');
                    if (badge) badge.textContent = nivelTexto;

                    const headerLevel = document.getElementById('perfil_nivel_header');
                    if (headerLevel) headerLevel.textContent = `Estudiante de ${nivelTexto}`;
                }

                // Datos Personales
                document.getElementById('perfil_nombre').value = a.nombre || '';
                document.getElementById('perfil_apellido_p').value = a.apellido_p || '';
                document.getElementById('perfil_apellido_m').value = a.apellido_m || '';
                document.getElementById('perfil_email').value = a.email || '';
                document.getElementById('perfil_telefono').value = a.telefono || '';
                document.getElementById('perfil_calle').value = a.calle || '';
                document.getElementById('perfil_ciudad').value = a.ciudad || '';
                document.getElementById('perfil_estado').value = a.estado_residencia || '';
                document.getElementById('perfil_cp').value = a.codigo_postal || '';

                // Nombre y Avatar arriba
                const fullName = (a.nombre + ' ' + (a.apellido_p || '')).trim();
                const headerName = document.getElementById('perfil_nombre_header');
                if (headerName) headerName.textContent = fullName;

                const avatar = document.getElementById('perfil_avatar_inicial');
                if (avatar && a.nombre) {
                    avatar.textContent = a.nombre.charAt(0).toUpperCase();
                }

                // Tutor
                if (data.tutor) {
                    const t = data.tutor;
                    document.getElementById('tutor_nombre').textContent = t.nombre || '—';
                    document.getElementById('tutor_apellidos').textContent = ((t.apellido_p || '') + ' ' + (t.apellido_m || '')).trim() || '—';
                    document.getElementById('tutor_parentesco').textContent = t.parentesco || '—';
                    document.getElementById('tutor_telefono').textContent = t.telefono || '—';
                    document.getElementById('tutor_email').textContent = t.email || '—';
                }
            })
            .catch(err => console.error('Error al cargar perfil:', err));
    }

    window.cargarOpciones = async function() {
        await cargarPerfil();
        initMiPerfil();
    };

    function initMiPerfil() {
        const section = document.getElementById('section-opciones');
        if (!section) return;

        if (section.dataset.perfilInit === '1') return;
        section.dataset.perfilInit = '1';

        window.cargarOpciones();

        const btnEdit = section.querySelector('#btnEditProfile');
        const btnSave = section.querySelector('#btnGuardarPerfil');
        const editables = section.querySelectorAll('.perfil-editable');

        if (!btnEdit) return;

        btnEdit.addEventListener('click', function () {
            editables.forEach(function (el) {
                el.disabled = false;
                el.style.background = '#fff';
                el.style.borderColor = 'var(--naranja)';
            });
            btnEdit.style.display = 'none';
            if (btnSave) btnSave.style.display = 'inline-flex';
        });

        if (btnSave) {
            btnSave.addEventListener('click', function () {
                const payload = {
                    nombre: document.getElementById('perfil_nombre').value,
                    apellido_p: document.getElementById('perfil_apellido_p').value,
                    apellido_m: document.getElementById('perfil_apellido_m').value,
                    email: document.getElementById('perfil_email').value,
                    telefono: document.getElementById('perfil_telefono').value,
                    calle: document.getElementById('perfil_calle').value,
                    ciudad: document.getElementById('perfil_ciudad').value,
                    estado_residencia: document.getElementById('perfil_estado').value,
                    codigo_postal: document.getElementById('perfil_cp').value
                };

                fetch('/alumno/perfil', {
                    method: 'PUT',
                    headers: headers,
                    body: JSON.stringify(payload)
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.errors || data.error) {
                            let msg = data.error || 'Revisa los datos introducidos.';
                            if (data.errors) {
                                msg = Object.values(data.errors).flat().join('\n');
                            }
                            egauAlert(msg || 'Error al guardar los cambios.', 'error')
                        } else {
                            egauAlert('¡Cambios guardados correctamente!', 'success')
                            editables.forEach(function (el) {
                                el.disabled = true;
                                el.style.background = '#f9f9f9';
                                el.style.borderColor = 'var(--borde)';
                            });
                            btnEdit.style.display = 'inline-block';
                            btnSave.style.display = 'none';
                            cargarPerfil(); // recargar
                        }
                    })
                    .catch(err => {
                        console.error('Error al guardar:', err);
                        egauAlert('Hubo un error al guardar los cambios.', 'error')
                    });
            });
        }
    }

    // Observar cuando la sección se hace visible
    const section = document.getElementById('section-opciones');
    if (!section) return;

    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (m) {
            if (m.attributeName === 'style' && section.style.display !== 'none') {
                initMiPerfil();
            }
        });
    });

    observer.observe(section, { attributes: true });

    if (section.style.display !== 'none') {
        initMiPerfil();
    }
})();
