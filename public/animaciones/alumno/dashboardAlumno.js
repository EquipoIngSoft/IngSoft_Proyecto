// ==============================================
//  dashboardAlumno.js — Interactividad General
//  Sidebar, Navegación entre Secciones y Menú de Perfil
//  EGAU Chess | Portal del Estudiante
// ==============================================

document.addEventListener('DOMContentLoaded', () => {

    // ---- Toggle del sidebar ----
    const menuToggle  = document.getElementById('menu-toggle');
    const sidebar     = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');

    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('open');
            } else {
                sidebar.classList.toggle('collapsed');
                if (mainContent) mainContent.classList.toggle('sidebar-hidden');
            }
        });

        // Cerrar sidebar al hacer clic fuera en móvil
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768 &&
                !sidebar.contains(e.target) &&
                !menuToggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });
    }

    // ---- Navegación: resaltar sección activa y cambiar contenido ----
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();

            // 1. Cambiar clase activa en el menú
            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            item.classList.add('active');

            // 2. Ocultar todas las secciones
            document.querySelectorAll('.section-content').forEach(sec => {
                sec.style.display = 'none';
            });

            // 3. Mostrar la sección relacionada
            const sectionId = item.getAttribute('data-section');
            const target = document.getElementById('section-' + sectionId);
            if (target) target.style.display = 'block';

            // En móvil, cerrar sidebar al navegar
            if (window.innerWidth <= 768 && sidebar) {
                sidebar.classList.remove('open');
            }
        });
    });

    // ---- Menú de Perfil (Cuenta del Alumno) ----
    const profileMenu = document.getElementById('profile-menu');

    if (profileMenu) {
        const profileTrigger = profileMenu.querySelector('.profile-trigger');

        // Abrir / Cerrar al hacer clic en el nombre u avatar
        profileTrigger.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevenir que el listener global lo cierre de inmediato
            profileMenu.classList.toggle('open');
        });

        // Cerrar si se da un clic fuera
        document.addEventListener('click', () => {
            profileMenu.classList.remove('open');
        });

        // Botón Configuración en el menú perfil => Lleva a la sección Opciones
        const btnConfigPerfil = document.getElementById('btn-config-perfil');
        if (btnConfigPerfil) {
            btnConfigPerfil.addEventListener('click', () => {
                // Simulamos un click en el enlace Opciones nativo de la barra lateral
                const navOpciones = document.querySelector('.nav-footer-item[data-section="opciones"]');
                if (navOpciones) {
                    navOpciones.click();
                }
                profileMenu.classList.remove('open');
            });
        }

        // Botón Cerrar Sesión
        const btnLogout = document.getElementById('btn-logout');
        if (btnLogout) {
            btnLogout.addEventListener('click', async () => {
                try {
                    const csrf  = document.querySelector('meta[name="csrf-token"]')?.content;
                    const token = document.querySelector('meta[name="user-token"]')?.content;

                    // Borrar token de Sanctum en la BD
                    await fetch('/api/logout', {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Content-Type': 'application/json',
                        }
                    });

                    // Limpiar sesión en servidor
                    await fetch('/guardar-token', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrf ?? '',
                        },
                        body: JSON.stringify({ token: null })
                    });

                } catch (err) {
                    console.error('Error al cerrar sesión:', err);
                } finally {
                    localStorage.clear();
                    window.location.href = '/login';
                }
            });
        }
    }

});
