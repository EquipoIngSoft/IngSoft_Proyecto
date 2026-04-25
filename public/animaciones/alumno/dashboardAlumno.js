// ==============================================
//  dashboardAlumno.js — Interactividad General
//  Sidebar, Navegación entre Secciones y Menú de Perfil
//  EGAU Chess | Portal del Estudiante
// ==============================================

document.addEventListener('DOMContentLoaded', async () => {

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

        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768 &&
                !sidebar.contains(e.target) &&
                !menuToggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });
    }

    // ---- Navegación ----
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();

            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            item.classList.add('active');

            document.querySelectorAll('.section-content').forEach(sec => {
                sec.style.display = 'none';
            });

            const sectionId = item.getAttribute('data-section');
            const target = document.getElementById('section-' + sectionId);
            if (target) target.style.display = 'block';

            if (window.innerWidth <= 768 && sidebar) {
                sidebar.classList.remove('open');
            }
        });
    });

    // ---- Menú de Perfil ----
    const profileMenu = document.getElementById('profile-menu');

    if (profileMenu) {
        const profileTrigger = profileMenu.querySelector('.profile-trigger');

        profileTrigger.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu.classList.toggle('open');
        });

        document.addEventListener('click', () => {
            profileMenu.classList.remove('open');
        });

        const btnConfigPerfil = document.getElementById('btn-config-perfil');
        if (btnConfigPerfil) {
            btnConfigPerfil.addEventListener('click', () => {
                const navOpciones = document.querySelector('.nav-footer-item[data-section="opciones"]');
                if (navOpciones) navOpciones.click();
                profileMenu.classList.remove('open');
            });
        }

        const btnLogout = document.getElementById('btn-logout');
        if (btnLogout) {
            btnLogout.addEventListener('click', async () => {
                try {
                    const csrf  = document.querySelector('meta[name="csrf-token"]')?.content;
                    const token = document.querySelector('meta[name="user-token"]')?.content;

                    await fetch('/api/logout', {
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Content-Type': 'application/json',
                        }
                    });

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

    // ---- Carga paralela de TODAS las secciones ----
    // Cada función es definida en su propio JS — si no existe, se ignora
    const cargas = [
        // Secciones de Angel
        typeof cargarInicio         === 'function' ? cargarInicio()         : Promise.resolve(),
        typeof cargarProfesores     === 'function' ? cargarProfesores()     : Promise.resolve(),
        typeof cargarExtraescolares === 'function' ? cargarExtraescolares() : Promise.resolve(),
        // Secciones de Mariana — se activan cuando ella implemente sus funciones
        typeof cargarMiNivel        === 'function' ? cargarMiNivel()        : Promise.resolve(),
        typeof cargarMisGrupos      === 'function' ? cargarMisGrupos()      : Promise.resolve(),
        typeof cargarPagos          === 'function' ? cargarPagos()          : Promise.resolve(),
        typeof cargarOpciones       === 'function' ? cargarOpciones()       : Promise.resolve(),
    ];

    try {
        await Promise.all(cargas);
    } catch (err) {
        console.error('[Dashboard] Error en carga inicial:', err);
    } finally {
        // Ocultar pantalla de carga cuando todo esté listo
        const loading = document.getElementById('loading-screen');
        if (loading) loading.style.display = 'none';
    }

});