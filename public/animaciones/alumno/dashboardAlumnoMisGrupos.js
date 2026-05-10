// ==============================================
//  dashboardAlumnoMisGrupos.js
//  Responsable: Mariana
//  EGAU Chess | Portal del Estudiante
// ==============================================

(function () {
    const DIAS = { 1: 'Lunes', 2: 'Martes', 3: 'Miércoles', 4: 'Jueves', 5: 'Viernes', 6: 'Sábado', 7: 'Domingo' };

    function nombreDia(dia) {
        // Accepts a number (1-7) or a string like 'lunes'/'Monday'
        if (typeof dia === 'number') return DIAS[dia] || dia;
        const n = parseInt(dia);
        if (!isNaN(n)) return DIAS[n] || dia;
        // already a string name — capitalize first letter
        return dia.charAt(0).toUpperCase() + dia.slice(1).toLowerCase();
    }

    function formatHorario(h) {
        return `
            <div style="display: flex; align-items: center; gap: 10px;">
                <i class="ri-time-line" style="font-size: 16px; color: var(--naranja);"></i>
                <span>${nombreDia(h.dia_semana)}, ${h.hora_inicio.substring(0, 5)} - ${h.hora_fin.substring(0, 5)}</span>
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <i class="ri-map-pin-line" style="font-size: 16px; color: var(--naranja);"></i>
                <span>${h.ubicacion || 'Aula por definir'}</span>
            </div>`;
    }
    let gruposCargados = false;

    async function cargarGrupos() {
        const token = document.querySelector('meta[name="user-token"]')?.content;
        if (!token) return;

        try {
            const res = await fetch('/api/alumno/grupos', {
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                }
            });

            if (!res.ok) throw new Error('Error al obtener grupos');

            const data = await res.json();
            pintarMisGrupos(data.mis_grupos);
            pintarGruposDisponibles(data.grupos_disponibles);

        } catch (err) {
            console.error('[Mis Grupos] Error al cargar datos:', err);
        }
    }

    function pintarMisGrupos(grupos) {
        const contenedor = document.getElementById('lista-mis-grupos');
        if (!contenedor) return;

        if (!grupos || grupos.length === 0) {
            contenedor.innerHTML = '<p style="color: var(--texto-suave); font-size: 14px;">No estás inscrito en ningún grupo.</p>';
            return;
        }

        contenedor.innerHTML = grupos.map(g => {
            const horariosHtml = g.horarios && g.horarios.length > 0
                ? g.horarios.map(h => formatHorario(h)).join('')
                : '<div style="font-size:12px; color:var(--texto-suave);">Sin horario definido</div>';

            return `
            <div class="card" style="display: flex; flex-direction: column; gap: 16px; border-top: 4px solid var(--verde);">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 1px solid var(--borde); padding-bottom: 12px;">
                    <h3 style="font-size: 18px; font-weight: 600; color: var(--texto); margin: 0;">${g.curso_nombre}</h3>
                    <span class="badge badge-verde" style="display: flex; gap: 4px; align-items: center;"><i class="ri-check-line"></i> Inscrito</span>
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px; font-size: 14px; color: var(--texto-suave);">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="ri-user-line" style="font-size: 16px; color: var(--naranja);"></i> <span>${g.profesor_nombre} ${g.profesor_apellido}</span>
                    </div>
                    ${horariosHtml}
                </div>
                <div style="margin-top: auto; padding-top: 12px;">
                    <p style="font-size: 13px; color: var(--texto-suave); margin: 0; display: flex; align-items: center; gap: 6px;">
                        <i class="ri-information-line"></i> Para cancelar tu inscripción, contacta a la sede.
                    </p>
                </div>
            </div>
        `}).join('');
    }

    function pintarGruposDisponibles(grupos) {
        const contenedor = document.getElementById('lista-grupos-disponibles');
        if (!contenedor) return;

        if (!grupos || grupos.length === 0) {
            contenedor.innerHTML = '<p style="color: var(--texto-suave); font-size: 14px;">No hay grupos disponibles en este momento.</p>';
            return;
        }

        contenedor.innerHTML = grupos.map(g => {
            const cupoReal = Math.max(0, g.cupo_actual);
            const porcentaje = g.cupo_maximo > 0 ? Math.min((cupoReal / g.cupo_maximo) * 100, 100) : 0;
            const lleno = g.cupo_lleno;
            const casiLleno = !lleno && porcentaje >= 75;

            const horariosHtml = g.horarios && g.horarios.length > 0
                ? g.horarios.map(h => formatHorario(h)).join('')
                : '<div style="font-size:12px; color:var(--texto-suave);">Sin horario definido</div>';

            // Boton siempre generado desde JS — servidor rechaza si cupo lleno
            const boton = lleno
                ? `<button class="btn-inscribirse" style="background-color: var(--gris-light); color: var(--texto-suave); cursor: not-allowed; width: 100%; opacity:0.7;" onclick="window.accionGrupo(${g.id_grupo}, 'inscribir', this)">
                        <i class="ri-lock-line"></i> Grupo Lleno
                   </button>`
                : `<button class="btn-inscribirse inscribir" style="width: 100%;" onclick="window.accionGrupo(${g.id_grupo}, 'inscribir', this)">
                        <i class="ri-add-circle-line"></i> Inscribirme
                   </button>`;

            const avisoLleno = casiLleno
                ? `<div style="display:flex; align-items:center; gap:6px; padding: 8px 12px; background-color: rgba(217,48,37,0.08); border: 1px solid rgba(217,48,37,0.25); border-radius: 8px; color:#d93025; font-size: 12px; font-weight:600;">
                       <i class="ri-alarm-warning-line"></i> ¡Casi lleno!
                   </div>`
                : '';

            return `
            <div class="card" style="display: flex; flex-direction: column; gap: 16px; ${lleno ? 'opacity: 0.85;' : ''}">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; border-bottom: 1px solid var(--borde); padding-bottom: 12px;">
                    <h3 style="font-size: 18px; font-weight: 600; color: var(--texto); margin: 0;">${g.curso_nombre}</h3>
                    <span class="badge badge-naranja">${g.nivel}</span>
                </div>
                <div style="display: flex; flex-direction: column; gap: 10px; font-size: 14px; color: var(--texto-suave);">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="ri-user-line" style="font-size: 16px; color: var(--naranja);"></i> <span>${g.profesor_nombre} ${g.profesor_apellido}</span>
                    </div>
                    ${horariosHtml}
                </div>
                <div style="margin-top: 4px; display: flex; flex-direction: column; gap: 8px;">
                    <div style="display: flex; justify-content: space-between; font-size: 13px; color: var(--texto-suave);">
                        <span>Lugares ocupados</span>
                        <strong style="color: ${lleno || casiLleno ? '#d93025' : 'var(--texto)'};"> ${cupoReal} / ${g.cupo_maximo}</strong>
                    </div>
                    <div class="progress-wrap">
                        <div class="progress-fill ${lleno || casiLleno ? 'lleno' : ''}" style="width: ${porcentaje}%;"></div>
                    </div>
                </div>
                ${avisoLleno}
                <div style="margin-top: auto; padding-top: 4px;">
                    ${boton}
                </div>
            </div>
            `;
        }).join('');
    }

    window.accionGrupo = async function(id, accion, btn, forzar = false) {
        const token = document.querySelector('meta[name="user-token"]')?.content;
        if (!token) return;

        btn.disabled = true;
        const textoOriginal = btn.innerHTML;
        btn.innerHTML = '<i class="ri-loader-4-line"></i> Procesando...';

        try {
            const res = await fetch(`/api/alumno/grupos/${id}/${accion}`, {
                method: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                }
            });

            const data = await res.json();

            if (!res.ok) {
                if (data.requires_confirmation) {
                    btn.disabled = false;
                    btn.innerHTML = textoOriginal;
                    if (confirm(data.message)) {
                        return window.accionGrupo(id, accion, btn, true);
                    } else {
                        return;
                    }
                }

                egauAlert(data.message || 'Error al procesar la acción', 'error');
                btn.disabled = false;
                btn.innerHTML = textoOriginal;
                return;
            }

            if (accion === 'inscribir') {
                egauAlert('¡Inscripción exitosa! Puedes revisar tu factura en la sección de Pagos.', 'success');
                window.pagosCargados = false;
            }

            await cargarGrupos();

        } catch (err) {
            console.error('[Mis Grupos] Error:', err);
            btn.disabled = false;
            btn.innerHTML = textoOriginal;
        }
    };

    window.cargarMisGrupos = async function () {
        if (gruposCargados) return;
        await cargarGrupos();
        gruposCargados = true;
    };

    const section = document.getElementById('section-misGrupos');
    if (!section) return;

    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (m) {
            if (m.attributeName === 'style' && section.style.display !== 'none' && !gruposCargados) {
                window.cargarMisGrupos();
            }
        });
    });

    observer.observe(section, { attributes: true });

    if (section.style.display !== 'none' && !gruposCargados) {
        window.cargarMisGrupos();
    }
})();
