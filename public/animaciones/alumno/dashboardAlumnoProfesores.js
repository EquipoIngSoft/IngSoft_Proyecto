// =============================================================
//  dashboardAlumnoProfesores.js — Sección Profesores
//  EGAU Chess | Portal del Estudiante | SCRUM-50
// =============================================================

document.addEventListener('DOMContentLoaded', () => {
    cargarProfesores();
});

async function cargarProfesores() {
    const token = document.querySelector('meta[name="user-token"]')?.content;
    if (!token) return;

    try {
        const res = await fetch('/api/alumno/profesores', {
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json',
            }
        });

        if (!res.ok) throw new Error('Error ' + res.status);

        const data = await res.json();
        pintarProfesores(data.profesores);

    } catch (err) {
        console.error('[Profesores] Error al cargar datos:', err);
    }
}

function pintarProfesores(profesores) {
    const grid = document.querySelector('#section-profesores .profesores-grid');
    if (!grid) return;

    if (!profesores || profesores.length === 0) {
        grid.innerHTML = `
            <div class="profesores-empty">
                <i class="ri-user-search-line" style="font-size:48px; color:var(--borde);"></i>
                <p>No hay profesores registrados en tu sede.</p>
            </div>
        `;
        return;
    }

    grid.innerHTML = profesores.map(p => {
        const especialidades = p.especialidades.length > 0
            ? p.especialidades.map(e => `<span class="cert-badge">${e}</span>`).join('')
            : '<span class="cert-badge">Sin cursos asignados</span>';

        const puntaje = p.puntaje ?? 0;

        return `
            <div class="profesor-card">
                <div class="profesor-card-header">
                    <div class="profesor-avatar">${p.inicial}</div>
                    <div>
                        <div class="profesor-nombre">${p.nombre_completo}</div>
                        <span class="badge badge-naranja">Puntaje: ${puntaje}</span>
                    </div>
                </div>

                <hr class="profesor-divider">

                <div>
                    <div class="profesor-certs-label">Especialidad</div>
                    <div class="profesor-certs">${especialidades}</div>
                </div>

                <hr class="profesor-divider">

                <div class="profesor-contacto-label">Información de Contacto</div>
                <div class="profesor-contacto">
                    <div class="contacto-row">
                        <i class="ri-mail-line"></i>
                        <a href="mailto:${p.email}">${p.email}</a>
                    </div>
                    <div class="contacto-row">
                        <i class="ri-phone-line"></i>
                        <span>${p.telefono}</span>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}