/* =============================================
   dashboardAlumno.js — Sidebar toggle
   EGAU Chess | Portal del Estudiante
   ============================================= */

document.addEventListener('DOMContentLoaded', () => {
    const sidebar    = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const menuToggle = document.getElementById('menu-toggle');

    if (menuToggle && sidebar && mainContent) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('sidebar-hidden');
        });
    }
});