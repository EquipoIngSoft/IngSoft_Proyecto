// =============================================================
//  dashboardAlumnoInicio.js — Sección Inicio
//  EGAU Chess | Portal del Estudiante | SCRUM-49
// =============================================================

document.addEventListener('DOMContentLoaded', () => {
    cargarInicio();
});

async function cargarInicio() {
    const token = document.querySelector('meta[name="user-token"]')?.content;
    if (!token) return;

    try {
        const res = await fetch('/api/alumno/inicio', {
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json',
            }
        });

        if (!res.ok) throw new Error('Error ' + res.status);

        const data = await res.json();

        pintarEncabezado(data.alumno);
        pintarKPIs(data.alumno, data.nivel, data.puntaje_siguiente_nivel, data.grupos_activos, data.grupo_nombre);
        pintarHorario(data.horarios);
        pintarActividad(data.actividad_reciente);

    } catch (err) {
        console.error('[Inicio] Error al cargar datos:', err);
    } finally {
        const loading = document.getElementById('loading-screen');
        if (loading) loading.style.display = 'none';
    }
}

function pintarEncabezado(alumno) {
    document.querySelectorAll('.alumno-name-topbar').forEach(el => el.textContent = alumno.nombre);
    document.querySelectorAll('.avatar-topbar').forEach(el => el.textContent = alumno.inicial);

    const profileName  = document.querySelector('.profile-name');
    const profileEmail = document.querySelector('.profile-email');
    if (profileName)  profileName.textContent  = alumno.nombre;
    if (profileEmail) profileEmail.textContent = alumno.email;

    const titulo = document.querySelector('#section-inicio .page-title');
    if (titulo) titulo.textContent = 'Bienvenido, ' + alumno.nombre;
}

function pintarKPIs(alumno, nivel, puntajeSiguiente, gruposActivos, grupoNombre) {
    // KPI Nivel — emoji + nombre
    const nivelBadge = document.querySelector('#section-inicio .kpi-badge');
    if (nivelBadge) nivelBadge.textContent = nivel.emoji + ' Nivel ' + nivel.numero + ' · ' + nivel.nombre;

    const kpiCards = document.querySelectorAll('#section-inicio .kpi-card');

    // Emoji en el ícono del KPI de nivel
    if (kpiCards[0]) {
        const iconWrap = kpiCards[0].querySelector('.kpi-icon-wrap');
        if (iconWrap) iconWrap.innerHTML = `<span style="font-size:24px;">${nivel.emoji}</span>`;
    }

    // KPI Puntos
    if (kpiCards[1]) {
        const val = kpiCards[1].querySelector('.kpi-value');
        const sub = kpiCards[1].querySelector('.kpi-sub');
        if (val) val.textContent = alumno.puntaje;
        if (sub) sub.textContent = 'de ' + puntajeSiguiente;
    }

    // KPI Grupo — nombre del curso
    if (kpiCards[2]) {
        const val = kpiCards[2].querySelector('.kpi-value');
        if (val) val.textContent = grupoNombre;
    }
}

function pintarHorario(horarios) {
    const lista = document.querySelector('#section-inicio .horario-list');
    if (!lista) return;

    if (!horarios || horarios.length === 0) {
        lista.innerHTML = '<p class="inicio-sin-datos">Sin horarios asignados actualmente.</p>';
        return;
    }

    lista.innerHTML = horarios.map(h => `
        <div class="horario-item">
            <div class="horario-dia">
                ${h.dia}
                <span>${h.hora_inicio} - ${h.hora_fin}</span>
            </div>
            <div>
                <div class="horario-materia">${h.curso}</div>
                <div class="horario-aula">${h.ubicacion}</div>
            </div>
        </div>
    `).join('');
}

function pintarActividad(actividad) {
    const lista = document.querySelector('#section-inicio .actividad-list');
    if (!lista) return;

    if (!actividad || actividad.length === 0) {
        lista.innerHTML = '<p class="inicio-sin-datos">Sin actividad reciente.</p>';
        return;
    }

    const colorPorTipo = {
        inscripcion:  'dot-azul',
        extraescolar: 'dot-morado',
        factura:      'dot-verde',
    };

    lista.innerHTML = actividad.map(a => {
        const color = colorPorTipo[a.tipo] ?? 'dot-azul';
        const hace  = tiempoRelativo(new Date(a.fecha));
        return `
            <div class="actividad-item">
                <div class="actividad-dot ${color}"></div>
                <div>
                    <div class="actividad-texto">${a.descripcion}</div>
                    <div class="actividad-sub">${hace}</div>
                </div>
            </div>
        `;
    }).join('');
}

function tiempoRelativo(fecha) {
    const diff    = Date.now() - fecha.getTime();
    const minutos = Math.floor(diff / 60000);
    const horas   = Math.floor(minutos / 60);
    const dias    = Math.floor(horas / 24);
    const semanas = Math.floor(dias / 7);

    if (semanas >= 1) return `hace ${semanas} semana${semanas > 1 ? 's' : ''}`;
    if (dias    >= 1) return `hace ${dias} día${dias > 1 ? 's' : ''}`;
    if (horas   >= 1) return `hace ${horas} hora${horas > 1 ? 's' : ''}`;
    if (minutos >= 1) return `hace ${minutos} minuto${minutos > 1 ? 's' : ''}`;
    return 'hace un momento';
}