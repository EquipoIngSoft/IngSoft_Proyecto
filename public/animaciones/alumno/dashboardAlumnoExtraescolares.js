// ==============================================
//  dashboardAlumnoExtraescolares.js — Vista: Extraescolares
//  Responsable: Angel | S-27
//  EGAU Chess | Portal del Estudiante
// ==============================================

document.addEventListener('DOMContentLoaded', () => {

    // ---- Filtros de actividades ----
    const filtros = document.querySelectorAll('.filtro-btn');

    filtros.forEach(btn => {
        btn.addEventListener('click', () => {

            // Actualizar botón activo
            filtros.forEach(b => b.classList.remove('filtro-activo'));
            btn.classList.add('filtro-activo');

            const tipo = btn.getAttribute('data-filtro');

            // Mostrar / ocultar tarjetas
            document.querySelectorAll('.extra-card').forEach(card => {
                if (tipo === 'todos' || card.getAttribute('data-tipo') === tipo) {
                    card.classList.remove('oculto');
                } else {
                    card.classList.add('oculto');
                }
            });
        });
    });

});
