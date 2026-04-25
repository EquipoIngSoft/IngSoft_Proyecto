// ==============================================
//  dashboardAdminPerfil.js
//  Perfil del Personal — Navbar, Sección, Edición
//  EGAU Chess | AMAAC
// ==============================================

document.addEventListener('DOMContentLoaded', () => {

    const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';
    const generoLabel = { f: 'Femenino', m: 'Masculino', o: 'Otro' };

    const getIniciales = (nombre, apellido_p) =>
        ((nombre?.[0] || '') + (apellido_p?.[0] || '')).toUpperCase() || '?';

    const formatFecha = (str) => {
        if (!str) return '—';
        const parte = str.split('T')[0];
        const [y, m, d] = parte.split('-');
        return d ? `${d}/${m}/${y}` : str;
    };

    const showFeedback = (msg, ok) => {
        const el = document.getElementById('perfil-feedback');
        if (!el) return;
        el.textContent = msg;
        el.style.display = 'block';
        el.style.background = ok ? '#e6f9ed' : '#fce8e6';
        el.style.color = ok ? '#1e8e3e' : '#d93025';
        el.style.border = `1px solid ${ok ? '#b7dfbf' : '#f5c6c2'}`;
    };

    const hideFeedback = () => {
        const el = document.getElementById('perfil-feedback');
        if (el) el.style.display = 'none';
    };

    const setError = (inputId, msgId, msg) => {
        const inp = document.getElementById(inputId);
        const err = document.getElementById(msgId);
        if (inp) { inp.classList.add('input-error'); inp.classList.remove('input-ok'); }
        if (err) err.textContent = msg;
    };

    const clearErrors = () => {
        ['nombre', 'apellido_p', 'telefono', 'email', 'fecha_nacimiento',
            'ciudad', 'calle', 'codigo_postal'].forEach(f => {
                const inp = document.getElementById('edit-' + f);
                const err = document.getElementById('err-edit-' + f);
                if (inp) inp.classList.remove('input-error', 'input-ok');
                if (err) err.textContent = '';
            });
        const ddGenero = document.getElementById('dropdown-edit-genero');
        if (ddGenero) ddGenero.classList.remove('input-error');
        const errG = document.getElementById('err-edit-genero');
        if (errG) errG.textContent = '';
        // ── Corregido: usar el ID que genera el partial ──
        const ddEstado = document.getElementById('dropdown-edit-estado');
        if (ddEstado) ddEstado.classList.remove('input-error');
        const errE = document.getElementById('err-edit-estado_residencia');
        if (errE) errE.textContent = '';
        const errPwd = document.getElementById('err-edit-pwd-antiguo');
        if (errPwd) errPwd.textContent = '';
    };

    const cargarPerfil = () => {
        fetch('/personal/perfil', {
            credentials: 'same-origin',
            headers: { 'Accept': 'application/json' }
        })
            .then(r => r.json())
            .then(d => {
                if (d.error) return;
                window._perfilPersonal = d;

                const nombreCompleto = [d.nombre, d.apellido_p, d.apellido_m]
                    .filter(Boolean).join(' ');

                const navNombre = document.querySelector('.profile-trigger .admin-name');
                const navAvatar = document.querySelector('.profile-trigger .avatar');
                const ddNombre = document.querySelector('.profile-dropdown .profile-name');
                const ddEmail = document.querySelector('.profile-dropdown .profile-email');

                if (navNombre) navNombre.textContent = d.nombre || 'Personal';
                if (navAvatar) navAvatar.textContent = getIniciales(d.nombre, d.apellido_p);
                if (ddNombre) ddNombre.textContent = nombreCompleto;
                if (ddEmail) ddEmail.textContent = d.email || '—';
            })
            .catch(err => console.error('Error cargando perfil:', err));
    };

    cargarPerfil();

    const poblarRead = (d) => {
        const set = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.textContent = val || '—';
        };
        set('read-nombre', d.nombre);
        set('read-apellido_p', d.apellido_p);
        set('read-apellido_m', d.apellido_m || '—');
        set('read-telefono', d.telefono);
        set('read-email', d.email);
        set('read-fecha_nacimiento', formatFecha(d.fecha_nacimiento));
        set('read-genero', generoLabel[d.genero] || d.genero || '—');
        set('read-estado_residencia', d.estado_residencia);
        set('read-ciudad', d.ciudad);
        set('read-calle', d.calle);
        set('read-codigo_postal', d.codigo_postal);
        set('read-nombre_rol', d.nombre_rol);
    };

    const poblarEdit = (d) => {
        document.getElementById('edit-nombre').value = d.nombre || '';
        document.getElementById('edit-apellido_p').value = d.apellido_p || '';
        document.getElementById('edit-apellido_m').value = d.apellido_m || '';
        document.getElementById('edit-telefono').value = d.telefono || '';
        document.getElementById('edit-email').value = d.email || '';
        document.getElementById('edit-fecha_nacimiento').value = d.fecha_nacimiento
            ? d.fecha_nacimiento.split('T')[0] : '';
        document.getElementById('edit-ciudad').value = d.ciudad || '';
        document.getElementById('edit-calle').value = d.calle || '';
        document.getElementById('edit-codigo_postal').value = d.codigo_postal || '';

        // Dropdown género
        const opts = document.querySelectorAll('#dropdown-edit-genero .form-option');
        const selText = document.querySelector('#dropdown-edit-genero .selected-text');
        const hiddenGen = document.getElementById('edit-genero');

        opts.forEach(opt => {
            opt.classList.remove('selected');
            if (opt.getAttribute('data-value') === d.genero) {
                opt.classList.add('selected');
                if (selText) {
                    selText.textContent = opt.textContent;
                    selText.setAttribute('data-value', d.genero);
                }
                if (hiddenGen) hiddenGen.value = d.genero;
            }
        });

        // Dropdown estado — ID que genera el partial: dropdown-edit-estado
        if (d.estado_residencia) {
            const optE = [...document.querySelectorAll('#dropdown-edit-estado .form-option')]
                .find(o => o.getAttribute('data-value').toLowerCase() === d.estado_residencia.toLowerCase());
            if (optE) optE.click();
        }

        ['edit-pwd-antiguo', 'edit-pwd-nuevo', 'edit-pwd-confirmar']
            .forEach(id => { document.getElementById(id).value = ''; });
    };

    window.poblarSeccion = (d) => {
        if (!d) return;

        const nombreCompleto = [d.nombre, d.apellido_p, d.apellido_m]
            .filter(Boolean).join(' ');

        const avatar = document.getElementById('perfil-avatar-seccion');
        const nombre = document.getElementById('perfil-nombre-seccion');
        const rol = document.getElementById('perfil-rol-seccion');

        if (avatar) avatar.textContent = getIniciales(d.nombre, d.apellido_p);
        if (nombre) nombre.textContent = nombreCompleto;
        if (rol) rol.textContent = d.nombre_rol || '—';

        poblarRead(d);

        document.getElementById('perfil-view-read').style.display = 'block';
        document.getElementById('perfil-view-edit').style.display = 'none';
        hideFeedback();
        clearErrors();
    };

    const navOpciones = document.querySelector('.nav-footer-item[data-section="opciones"]');
    if (navOpciones) {
        navOpciones.addEventListener('click', () => {
            poblarSeccion(window._perfilPersonal);
        });
    }

    const btnOrig = document.getElementById('btn-config-perfil');
    if (btnOrig) {
        const btnNuevo = btnOrig.cloneNode(true);
        btnOrig.parentNode.replaceChild(btnNuevo, btnOrig);
        btnNuevo.addEventListener('click', () => {
            document.getElementById('profile-menu')?.classList.remove('open');
            navOpciones?.click();
        });
    }

    document.getElementById('btn-modo-editar')
        ?.addEventListener('click', () => {
            poblarEdit(window._perfilPersonal);
            document.getElementById('perfil-view-read').style.display = 'none';
            document.getElementById('perfil-view-edit').style.display = 'block';
            hideFeedback();
            clearErrors();
        });

    document.getElementById('btn-cancelar-edicion')
        ?.addEventListener('click', () => {
            document.getElementById('perfil-view-read').style.display = 'block';
            document.getElementById('perfil-view-edit').style.display = 'none';
            hideFeedback();
            clearErrors();
        });

    // ── Dropdown género ───────────────────────────────────────────────
    const ddGenero = document.getElementById('dropdown-edit-genero');
    if (ddGenero) {
        const trigger = ddGenero.querySelector('.form-select-trigger');
        const opts = ddGenero.querySelectorAll('.form-option');
        const selText = ddGenero.querySelector('.selected-text');
        const hidden = document.getElementById('edit-genero');

        trigger?.addEventListener('click', (e) => {
            e.stopPropagation();
            ddGenero.classList.toggle('open');
        });

        opts.forEach(opt => {
            opt.addEventListener('click', (e) => {
                e.stopPropagation();
                opts.forEach(o => o.classList.remove('selected'));
                opt.classList.add('selected');
                selText.textContent = opt.textContent;
                selText.setAttribute('data-value', opt.getAttribute('data-value'));
                hidden.value = opt.getAttribute('data-value');
                ddGenero.classList.remove('open', 'input-error');
                const errG = document.getElementById('err-edit-genero');
                if (errG) errG.textContent = '';
            });
        });

        document.addEventListener('click', () => ddGenero.classList.remove('open'));
    }

    // ── Dropdown estado — ID que genera el partial: dropdown-edit-estado ──
    const ddEstado = document.getElementById('dropdown-edit-estado');
    if (ddEstado) {
        const trigger = ddEstado.querySelector('.form-select-trigger');
        const opts = ddEstado.querySelectorAll('.form-option');
        const selText = ddEstado.querySelector('.selected-text');
        const hidden = ddEstado.querySelector('input[type="hidden"]');

        trigger?.addEventListener('click', (e) => {
            e.stopPropagation();
            ddEstado.classList.toggle('open');
        });

        opts.forEach(opt => {
            opt.addEventListener('click', (e) => {
                e.stopPropagation();
                opts.forEach(o => o.classList.remove('selected'));
                opt.classList.add('selected');
                selText.textContent = opt.textContent;
                selText.setAttribute('data-value', opt.getAttribute('data-value'));
                if (hidden) hidden.value = opt.getAttribute('data-value');
                ddEstado.classList.remove('open', 'input-error');
                const errE = document.getElementById('err-edit-estado_residencia');
                if (errE) errE.textContent = '';
            });
        });

        document.addEventListener('click', () => ddEstado.classList.remove('open'));
    }

    // ── Guardar cambios ───────────────────────────────────────────────
    document.getElementById('btn-guardar-perfil')
        ?.addEventListener('click', async () => {
            hideFeedback();
            clearErrors();

            const nombre = document.getElementById('edit-nombre').value.trim();
            const apellido_p = document.getElementById('edit-apellido_p').value.trim();
            const apellido_m = document.getElementById('edit-apellido_m').value.trim();
            const telefono = document.getElementById('edit-telefono').value.trim();
            const email = document.getElementById('edit-email').value.trim();
            const fecha_nacimiento = document.getElementById('edit-fecha_nacimiento').value;
            const genero = document.getElementById('edit-genero').value;
            const ciudad = document.getElementById('edit-ciudad').value.trim();
            const calle = document.getElementById('edit-calle').value.trim();
            const codigo_postal = document.getElementById('edit-codigo_postal').value.trim();
            // ID del hidden que genera el partial: edit-estado
            const estado_residencia = document.getElementById('edit-estado')?.value || '';
            const pwdAntiguo = document.getElementById('edit-pwd-antiguo').value;
            const pwdNuevo = document.getElementById('edit-pwd-nuevo').value;
            const pwdConfirmar = document.getElementById('edit-pwd-confirmar').value;

            let valido = true;
            const emailReg = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const telefonoReg = /^\d{10}$/;
            const cpReg = /^\d{5}$/;

            if (!nombre) {
                setError('edit-nombre', 'err-edit-nombre', 'El nombre es requerido.');
                valido = false;
            }
            if (!apellido_p) {
                setError('edit-apellido_p', 'err-edit-apellido_p', 'El apellido paterno es requerido.');
                valido = false;
            }
            if (!telefono) {
                setError('edit-telefono', 'err-edit-telefono', 'El teléfono es requerido.');
                valido = false;
            } else if (!telefonoReg.test(telefono)) {
                setError('edit-telefono', 'err-edit-telefono', 'El teléfono debe tener exactamente 10 dígitos.');
                valido = false;
            }
            if (!emailReg.test(email)) {
                setError('edit-email', 'err-edit-email', 'Ingresa un correo válido.');
                valido = false;
            }
            if (!fecha_nacimiento) {
                setError('edit-fecha_nacimiento', 'err-edit-fecha_nacimiento', 'La fecha de nacimiento es requerida.');
                valido = false;
            } else {
                const hoy = new Date();
                const nac = new Date(fecha_nacimiento);
                const edad = hoy.getFullYear() - nac.getFullYear();
                if (nac >= hoy) {
                    setError('edit-fecha_nacimiento', 'err-edit-fecha_nacimiento', 'La fecha de nacimiento no puede ser futura.');
                    valido = false;
                } else if (edad < 18) {
                    setError('edit-fecha_nacimiento', 'err-edit-fecha_nacimiento', 'El personal debe ser mayor de 18 años.');
                    valido = false;
                } else if (edad > 90) {
                    setError('edit-fecha_nacimiento', 'err-edit-fecha_nacimiento', 'Ingresa una fecha de nacimiento válida.');
                    valido = false;
                }
            }
            if (!genero) {
                document.getElementById('dropdown-edit-genero')?.classList.add('input-error');
                const errG = document.getElementById('err-edit-genero');
                if (errG) errG.textContent = 'Selecciona un género.';
                valido = false;
            }
            if (!estado_residencia) {
                document.getElementById('dropdown-edit-estado')?.classList.add('input-error');
                const errE = document.getElementById('err-edit-estado_residencia');
                if (errE) errE.textContent = 'Selecciona un estado.';
                valido = false;
            }
            if (!ciudad) {
                setError('edit-ciudad', 'err-edit-ciudad', 'La ciudad es requerida.');
                valido = false;
            }
            if (!calle) {
                setError('edit-calle', 'err-edit-calle', 'La calle es requerida.');
                valido = false;
            }
            if (!cpReg.test(codigo_postal)) {
                setError('edit-codigo_postal', 'err-edit-codigo_postal', 'Ingresa un CP válido (5 dígitos).');
                valido = false;
            }
            if (!valido) return;

            const cambiarPwd = pwdAntiguo || pwdNuevo || pwdConfirmar;
            if (cambiarPwd) {
                if (!pwdAntiguo || !pwdNuevo || !pwdConfirmar) {
                    showFeedback('Para cambiar la contraseña completa los tres campos.', false);
                    return;
                }
                if (pwdNuevo.length < 6) {
                    showFeedback('La nueva contraseña debe tener al menos 6 caracteres.', false);
                    return;
                }
                if (pwdNuevo !== pwdConfirmar) {
                    showFeedback('La nueva contraseña y su confirmación no coinciden.', false);
                    return;
                }
            }

            const btnGuardar = document.getElementById('btn-guardar-perfil');
            const textoOrig = btnGuardar.innerHTML;
            btnGuardar.innerHTML = '<i class="ri-loader-4-line ri-spin"></i> Guardando...';
            btnGuardar.disabled = true;

            try {
                const resData = await fetch('/personal/perfil', {
                    method: 'PUT',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': CSRF,
                    },
                    body: JSON.stringify({
                        nombre, apellido_p, apellido_m, telefono, email,
                        fecha_nacimiento, genero,
                        estado_residencia, ciudad, calle, codigo_postal
                    })
                });

                const dataRes = await resData.json().catch(() => ({}));
                if (!resData.ok) throw new Error(
                    dataRes.errors
                        ? Object.values(dataRes.errors).flat().join('\n')
                        : (dataRes.error || 'Error al guardar.')
                );

                if (cambiarPwd) {
                    const resPwd = await fetch('/personal/perfil/password', {
                        method: 'PUT',
                        credentials: 'same-origin',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': CSRF,
                        },
                        body: JSON.stringify({
                            contrasena_antigua: pwdAntiguo,
                            contrasena_nueva: pwdNuevo,
                            contrasena_confirmar: pwdConfirmar,
                        })
                    });

                    const pwdRes = await resPwd.json().catch(() => ({}));
                    if (!resPwd.ok) {
                        const errPwd = document.getElementById('err-edit-pwd-antiguo');
                        if (errPwd && pwdRes.error) errPwd.textContent = pwdRes.error;
                        throw new Error(pwdRes.error || 'Error al cambiar la contraseña.');
                    }
                }

                const nuevos = {
                    ...window._perfilPersonal,
                    nombre, apellido_p, apellido_m, telefono, email,
                    fecha_nacimiento, genero,
                    estado_residencia, ciudad, calle, codigo_postal
                };
                window._perfilPersonal = nuevos;

                const nombreCompleto = [nombre, apellido_p, apellido_m].filter(Boolean).join(' ');
                const iniciales = getIniciales(nombre, apellido_p);

                const navNombre = document.querySelector('.profile-trigger .admin-name');
                const navAvatar = document.querySelector('.profile-trigger .avatar');
                const ddNombre = document.querySelector('.profile-dropdown .profile-name');
                const ddEmail = document.querySelector('.profile-dropdown .profile-email');

                if (navNombre) navNombre.textContent = nombre;
                if (navAvatar) navAvatar.textContent = iniciales;
                if (ddNombre) ddNombre.textContent = nombreCompleto;
                if (ddEmail) ddEmail.textContent = email;

                const avatarSec = document.getElementById('perfil-avatar-seccion');
                const nombreSec = document.getElementById('perfil-nombre-seccion');
                if (avatarSec) avatarSec.textContent = iniciales;
                if (nombreSec) nombreSec.textContent = nombreCompleto;

                poblarRead(nuevos);
                document.getElementById('perfil-view-edit').style.display = 'none';
                document.getElementById('perfil-view-read').style.display = 'block';

                if (typeof window.buscarPersonalBackend === 'function') {
                    window.buscarPersonalBackend();
                }

                showFeedback(
                    cambiarPwd
                        ? '¡Perfil y contraseña actualizados correctamente!'
                        : '¡Perfil actualizado correctamente!',
                    true
                );

            } catch (err) {
                showFeedback(err.message, false);
            } finally {
                btnGuardar.innerHTML = textoOrig;
                btnGuardar.disabled = false;
            }
        });

});