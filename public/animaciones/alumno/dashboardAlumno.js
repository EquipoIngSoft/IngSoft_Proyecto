// ==============================================
//  dashboardAlumno.js — Interactividad General
//  Sidebar, Navegación entre Secciones
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

});
