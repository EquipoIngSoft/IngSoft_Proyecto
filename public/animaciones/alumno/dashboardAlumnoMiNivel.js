// ==============================================
//  dashboardAlumnoMiNivel.js
//  Responsable: Mariana
//  EGAU Chess | Portal del Estudiante
// ==============================================

// Toggle de logros desplegables en la sección Mi Nivel.
(function () {
    function initLogrosToggle() {
        const cardLogros      = document.getElementById('card-logros');
        const logrosPanel     = document.getElementById('logros-desplegables');
        const iconLogros      = document.getElementById('icon-logros');

        if (!cardLogros || !logrosPanel || !iconLogros) return;

        // Evitar registrar el listener más de una vez
        if (cardLogros.dataset.logrosInit === '1') return;
        cardLogros.dataset.logrosInit = '1';

        cardLogros.addEventListener('click', function () {
            const visible = logrosPanel.style.display === 'flex';
            logrosPanel.style.display = visible ? 'none' : 'flex';
            iconLogros.style.transform = visible ? 'rotate(0deg)' : 'rotate(180deg)';
        });
    }

    // Ejecutar cuando el section-miNivel se hace visible
    // (el SPA lo muestra/oculta cambiando display)
    const section = document.getElementById('section-miNivel');
    if (!section) return;

    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (m) {
            if (m.attributeName === 'style' && section.style.display !== 'none') {
                initLogrosToggle();
            }
        });
    });

    observer.observe(section, { attributes: true });

    // También ejecutar si ya está visible al cargar (por si acaso)
    if (section.style.display !== 'none') {
        initLogrosToggle();
    }
})();
