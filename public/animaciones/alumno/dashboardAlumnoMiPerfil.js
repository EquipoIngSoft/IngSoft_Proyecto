// ==============================================
//  dashboardAlumnoMiPerfil.js
//  Responsable: Mariana
//  EGAU Chess | Portal del Estudiante
// ==============================================

// Lógica de edición de perfil y validación de contraseña.

// validarPassword se llama con onclick desde el HTML, debe ser global
window.validarPassword = function () {
    const pass    = document.getElementById('new_pass');
    const confirm = document.getElementById('confirm_pass');
    if (!pass || !confirm) return;

    if (pass.value !== confirm.value) {
        alert('Las contraseñas no coinciden. Por favor, verifica.');
    } else if (pass.value.length < 8) {
        alert('La contraseña debe tener al menos 8 caracteres.');
    } else {
        alert('¡Contraseña actualizada con éxito!');
        document.getElementById('formPassword')?.reset();
    }
};

(function () {

    function initMiPerfil() {
        const section = document.getElementById('section-miPerfil');
        if (!section) return;

        // Evitar inicializar más de una vez
        if (section.dataset.perfilInit === '1') return;
        section.dataset.perfilInit = '1';

        const btnEdit    = section.querySelector('#btnEditProfile');
        const btnSave    = section.querySelector('#btnGuardarPerfil');
        const editables  = section.querySelectorAll('.perfil-editable');

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
                editables.forEach(function (el) {
                    el.disabled = true;
                    el.style.background = '#f9f9f9';
                    el.style.borderColor = 'var(--borde)';
                });
                btnEdit.style.display = 'inline-block';
                btnSave.style.display = 'none';
                alert('¡Cambios guardados correctamente!');
            });
        }
    }

    // Observar cuando la sección se hace visible
    const section = document.getElementById('section-miPerfil');
    if (!section) return;

    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (m) {
            if (m.attributeName === 'style' && section.style.display !== 'none') {
                initMiPerfil();
            }
        });
    });

    observer.observe(section, { attributes: true });

    // También ejecutar si ya está visible al cargar
    if (section.style.display !== 'none') {
        initMiPerfil();
    }
})();
