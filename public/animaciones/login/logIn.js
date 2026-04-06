// ==============================================
//  logIn.js — Animación de tabs + Validación
//  EGAU Chess | AMAAC
// ==============================================

/**
 * Mueve el pill naranja al botón activo y actualiza el estado del formulario.
 * @param {string} tipo - 'alumno' o 'personal'
 */
function switchTab(tipo) {
    const buttons = document.querySelectorAll('.tab-btn');
    const pill    = document.getElementById('tab-pill');

    buttons.forEach(btn => btn.classList.remove('active'));

    const activeBtn = document.getElementById('tab-' + tipo);
    activeBtn.classList.add('active');

    // Mover el pill naranja al botón seleccionado
    pill.style.width  = activeBtn.offsetWidth  + 'px';
    pill.style.left   = activeBtn.offsetLeft   + 'px';

    // Actualizar campo oculto
    document.getElementById('tipo-usuario').value = tipo;
}

// ---- Validación de campos ----

/**
 * Muestra u oculta el mensaje de error y aplica clase al input.
 * @param {HTMLInputElement} input
 * @param {HTMLElement} errorSpan
 * @param {string} msg - mensaje de error (vacío = campo correcto)
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

/** Valida el campo de correo. Retorna mensaje de error o cadena vacía. */
function validateEmail(value) {
    if (!value.trim()) return 'El correo es obligatorio.';
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(value)) return 'Ingresa un correo electrónico válido.';
    return '';
}

/** Valida el campo de contraseña. Retorna mensaje de error o cadena vacía. */
function validatePassword(value) {
    if (!value) return 'La contraseña es obligatoria.';
    if (value.length < 6) return 'La contraseña debe tener al menos 6 caracteres.';
    return '';
}

// Inicializar al cargar la página
window.addEventListener('DOMContentLoaded', () => {

    // ---- Pill inicial ----
    const initialBtn = document.querySelector('.tab-btn.active');
    const pill       = document.getElementById('tab-pill');
    if (initialBtn && pill) {
        pill.style.width = initialBtn.offsetWidth + 'px';
        pill.style.left  = initialBtn.offsetLeft  + 'px';
    }

    // ---- Referencias del formulario ----
    const form          = document.getElementById('login-form');
    const emailInput    = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const errorEmail    = document.getElementById('error-username');
    const errorPassword = document.getElementById('error-password');

    if (!form) return;

    // Validar en tiempo real al salir del campo (blur)
    emailInput.addEventListener('blur', () => {
        setFieldState(emailInput, errorEmail, validateEmail(emailInput.value));
    });

    passwordInput.addEventListener('blur', () => {
        setFieldState(passwordInput, errorPassword, validatePassword(passwordInput.value));
    });

    // Limpiar error mientras el usuario escribe si ya hay un error marcado
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

    // Validar todo al intentar enviar
    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const emailMsg    = validateEmail(emailInput.value);
        const passwordMsg = validatePassword(passwordInput.value);

        setFieldState(emailInput,    errorEmail,    emailMsg);
        setFieldState(passwordInput, errorPassword, passwordMsg);

        if (!emailMsg && !passwordMsg) {
            // Sin errores: verificar qué tab está seleccionada
            const tipoUsuario = document.getElementById('tipo-usuario').value;
            
            if (tipoUsuario === 'personal') {
                window.location.href = '/dashboardAdmin';
            } else {
                window.location.href = '/dashboardAlumno'; // Página en blanco provisional
            }
        } else {
            // Hacer foco en el primer campo con error
            if (emailMsg) emailInput.focus();
            else           passwordInput.focus();
        }
    });
});
