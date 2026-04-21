// ==============================================
//  dashboardAlumnoMisGrupos.js
//  Responsable: Mariana
//  EGAU Chess | Portal del Estudiante
// ==============================================

// Lógica de botones Inscribirse / Cancelar en la sección Mis Grupos.
(function () {

    function initMisGrupos() {
        const section = document.getElementById('section-misGrupos');
        if (!section) return;

        // Evitar inicializar más de una vez
        if (section.dataset.gruposInit === '1') return;
        section.dataset.gruposInit = '1';

        section.addEventListener('click', function (e) {
            const btn = e.target.closest('.btn-inscribirse');
            if (!btn) return;

            if (btn.classList.contains('inscribir')) {
                const card = btn.closest('.card');
                const nombre = card ? (card.querySelector('h3')?.textContent.trim() ?? 'este grupo') : 'este grupo';

                if (confirm('¿Deseas inscribirte a "' + nombre + '"?')) {
                    btn.disabled = true;
                    btn.innerHTML = '<i class="ri-checkbox-circle-line"></i> Inscrito';
                    btn.classList.remove('inscribir');
                    btn.classList.add('cancelar');
                    btn.disabled = false;

                    // Marcar tarjeta como inscrita
                    if (card) {
                        card.style.borderTop = '4px solid var(--verde)';
                        const header = card.querySelector('[style*="border-bottom"]');
                        if (header) {
                            const badge = document.createElement('span');
                            badge.className = 'badge badge-verde';
                            badge.style.cssText = 'display:flex; gap:4px; align-items:center;';
                            badge.innerHTML = '<i class="ri-check-line"></i> Inscrito';
                            header.appendChild(badge);
                        }
                    }
                }

            } else if (btn.classList.contains('cancelar')) {
                const card = btn.closest('.card');
                const nombre = card ? (card.querySelector('h3')?.textContent.trim() ?? 'este grupo') : 'este grupo';

                if (confirm('¿Deseas cancelar tu inscripción a "' + nombre + '"?')) {
                    btn.innerHTML = '<i class="ri-add-circle-line"></i> Inscribirme';
                    btn.classList.remove('cancelar');
                    btn.classList.add('inscribir');

                    if (card) {
                        card.style.borderTop = '';
                        const badge = card.querySelector('.badge-verde');
                        if (badge) badge.remove();
                    }
                }
            }
        });
    }

    // Observar cuando la sección se hace visible
    const section = document.getElementById('section-misGrupos');
    if (!section) return;

    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (m) {
            if (m.attributeName === 'style' && section.style.display !== 'none') {
                initMisGrupos();
            }
        });
    });

    observer.observe(section, { attributes: true });

    // También ejecutar si ya está visible al cargar
    if (section.style.display !== 'none') {
        initMisGrupos();
    }
})();
