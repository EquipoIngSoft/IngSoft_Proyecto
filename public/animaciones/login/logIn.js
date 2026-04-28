// ==============================================
//  logIn.js — Animación de tabs + Validación (cliente)
//  EGAU Chess | AMAAC
// ==============================================

/**
 * Mueve el pill naranja al botón activo y actualiza el campo oculto 'tipo'.
 * @param {string} tipo - 'alumno' o 'personal'
 */
function switchTab(tipo) {
    const buttons = document.querySelectorAll('.tab-btn');
    const pill = document.getElementById('tab-pill');

    buttons.forEach(btn => btn.classList.remove('active'));

    const activeBtn = document.getElementById('tab-' + tipo);
    activeBtn.classList.add('active');

    // Mover el pill naranja al botón seleccionado
    pill.style.width = activeBtn.offsetWidth + 'px';
    pill.style.left = activeBtn.offsetLeft + 'px';

    // Actualizar campo oculto que el backend leerá
    document.getElementById('tipo-usuario').value = tipo;
}

// ---- Funciones de validación visual ----

/**
 * Muestra u oculta el mensaje de error y aplica clase al input.
 */
function setFieldState(input, errorSpan, msg) {
    if (msg) {
        input.classList.add('input-error');
        input.classList.remove('input-ok');
        errorSpan.textContent = msg;
    } else {
        input.classList.remove('input-error');
        input.classList.add('input-ok');
        errorSpan.textContent = '';
    }
}

/** Valida correo — retorna mensaje de error o cadena vacía. */
function validateEmail(value) {
    if (!value.trim()) return 'El correo es obligatorio.';
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(value)) return 'Ingresa un correo electrónico válido.';
    return '';
}

/** Valida contraseña — retorna mensaje de error o cadena vacía. */
function validatePassword(value) {
    if (!value) return 'La contraseña es obligatoria.';
    if (value.length < 6) return 'La contraseña debe tener al menos 6 caracteres.';
    return '';
}

// ---- Inicialización ----
window.addEventListener('DOMContentLoaded', () => {

    // Pill inicial
    const initialBtn = document.querySelector('.tab-btn.active');
    const pill = document.getElementById('tab-pill');
    if (initialBtn && pill) {
        pill.style.width = initialBtn.offsetWidth + 'px';
        pill.style.left = initialBtn.offsetLeft + 'px';
    }

    // Si el servidor devolvió un campo 'tipo' (old input), restaurar el tab activo
    const tipoInput = document.getElementById('tipo-usuario');
    if (tipoInput && tipoInput.value) {
        switchTab(tipoInput.value);
    }

    // Marcar campo de correo con error si el servidor ya envió uno
    const emailInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const errorEmail = document.getElementById('error-username');
    const errorPassword = document.getElementById('error-password');

    if (errorEmail && errorEmail.textContent.trim()) {
        emailInput.classList.add('input-error');
    }
    if (errorPassword && errorPassword.textContent.trim()) {
        passwordInput.classList.add('input-error');
    }

    const form = document.getElementById('login-form');
    if (!form) return;

    // Validar en tiempo real al salir del campo
    emailInput.addEventListener('blur', () => {
        setFieldState(emailInput, errorEmail, validateEmail(emailInput.value));
    });

    passwordInput.addEventListener('blur', () => {
        setFieldState(passwordInput, errorPassword, validatePassword(passwordInput.value));
    });

    // Limpiar error mientras el usuario escribe (sólo si ya hay error)
    emailInput.addEventListener('input', () => {
        if (emailInput.classList.contains('input-error')) {
            setFieldState(emailInput, errorEmail, validateEmail(emailInput.value));
        }
    });

    passwordInput.addEventListener('input', () => {
        if (passwordInput.classList.contains('input-error')) {
            setFieldState(passwordInput, errorPassword, validatePassword(passwordInput.value));
        }
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const emailMsg = validateEmail(emailInput.value);
        const passwordMsg = validatePassword(passwordInput.value);

        setFieldState(emailInput, errorEmail, emailMsg);
        setFieldState(passwordInput, errorPassword, passwordMsg);

        if (emailMsg || passwordMsg) {
            if (emailMsg) emailInput.focus();
            else passwordInput.focus();
            return;
        }

        try {
            const csrf = document.querySelector('meta[name="csrf-token"]').content;

            // 1. Pedir token a Sanctum
            const res = await fetch('/api/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    username: emailInput.value,
                    password: passwordInput.value,
                    tipo: document.getElementById('tipo-usuario').value,
                })
            });

            const data = await res.json();

            if (!res.ok) {
                setFieldState(emailInput, errorEmail, data.message ?? 'Error al iniciar sesión');
                return;
            }

            // 2. Guardar token en sesión de Laravel
            await fetch('/guardar-token', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                },
                body: JSON.stringify({
                    token: data.token,
                    tipo: data.tipo,
                    id_sede: data.id_sede,
                    administrativo: data.administrativo,
                    permisos: data.permisos,
                })
            });

            // 3. Guardar info en localStorage para el frontend
            localStorage.setItem('tipo', data.tipo);
            localStorage.setItem('usuario', JSON.stringify(data.usuario));

            // 4. Redirigir según tipo
            if (data.tipo === 'alumno') {
                window.location.href = '/dashboardAlumno';
            } else {
                window.location.href = '/dashboardAdmin';
            }

        } catch (err) {
            setFieldState(emailInput, errorEmail, 'Error de conexión, intenta de nuevo.');
        }
    });
});
