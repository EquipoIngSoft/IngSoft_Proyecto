// =============================================================
//  dashboardAlumnoExtraescolares.js — Sección Extraescolares
//  EGAU Chess | Portal del Estudiante | SCRUM-51
// =============================================================

// NO llamar cargarExtraescolares() desde aquí — lo maneja dashboardAlumno.js en paralelo

let catalogoGlobal = [];

async function cargarExtraescolares() {
    const token = document.querySelector('meta[name="user-token"]')?.content;
    if (!token) return;

    try {
        const res = await fetch('/api/alumno/extraescolares', {
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json',
            }
        });

        if (!res.ok) throw new Error('Error ' + res.status);

        const data = await res.json();
        catalogoGlobal = data.catalogo;

        pintarMisInscripciones(data.mis_inscripciones);
        pintarCatalogo(catalogoGlobal);
        iniciarBusqueda();

    } catch (err) {
        console.error('[Extraescolares] Error al cargar datos:', err);
    }
}

function pintarMisInscripciones(inscripciones) {
    const contenedor = document.querySelector('#section-extraescolares .mis-inscripciones');
    if (!contenedor) return;

    if (!inscripciones || inscripciones.length === 0) {
        contenedor.innerHTML = `
            <div class="mis-inscripciones-titulo">MIS INSCRIPCIONES</div>
            <p style="font-size:13px; color:var(--texto-suave);">No estás inscrito en ninguna actividad extraescolar.</p>
        `;
        return;
    }

    const etiquetas = {
        enproceso: { texto: 'Pago pendiente', color: '#b7770d', bg: '#fef9ec' },
        pagado:    { texto: 'Pagado',          color: '#1e8449', bg: '#eafaf1' },
        cancelado: { texto: 'Cancelado',       color: '#888',    bg: '#f5f5f5' },
        expirado:  { texto: 'Pago expirado',   color: '#d93025', bg: '#fdf0ef' },
    };

    const items = inscripciones.map(i => {
        const v   = etiquetas[i.vigencia] ?? etiquetas.enproceso;
        const badge = `<span style="
            font-size:11px; font-family:'Inter',sans-serif; font-weight:600;
            padding:2px 10px; border-radius:20px;
            color:${v.color}; background:${v.bg};">
            ${v.texto}
        </span>`;

        return `
            <div class="inscripcion-activa">
                <div>
                    <div class="inscripcion-activa-nombre">${i.nombre}</div>
                    <div class="inscripcion-activa-horario">${i.ubicacion} · ${formatearFecha(i.fecha_inicio)} - ${formatearFecha(i.fecha_fin)}</div>
                    <div style="margin-top:6px;">${badge}</div>
                </div>
                <i class="ri-checkbox-circle-fill inscripcion-activa-check"></i>
            </div>
        `;
    }).join('');

    contenedor.innerHTML = `
        <div class="mis-inscripciones-titulo">MIS INSCRIPCIONES</div>
        ${items}
    `;
}

function pintarCatalogo(catalogo) {
    const grid = document.querySelector('#section-extraescolares .actividades-grid');
    const empty = document.querySelector('#section-extraescolares .actividades-empty');
    if (!grid) return;

    if (!catalogo || catalogo.length === 0) {
        grid.innerHTML = '';
        if (empty) empty.style.display = 'block';
        return;
    }

    if (empty) empty.style.display = 'none';

    grid.innerHTML = catalogo.map(e => {
        const porcentaje = e.cupo_maximo > 0
            ? Math.min((e.cupo_actual / e.cupo_maximo) * 100, 100)
            : 0;

        const lleno = e.cupo_lleno && !e.inscrito;

        // DESPUÉS
        const vigencia  = e.vigencia_factura ?? 'enproceso';
        const bloqueado = vigencia === 'pagado';
        const tituloBloqueado = 'Tu inscripción ya fue pagada. Contacta a la sede para cancelar.';

        const boton = e.inscrito
            ? `<button class="btn-inscribirse cancelar"
                    onclick="accionExtraescolar(${e.id_extraescolar}, 'cancelar', this)"
                    ${bloqueado ? `disabled title="${tituloBloqueado}"` : ''}>
                    <i class="ri-close-circle-line"></i> Cancelar Inscripción
            </button>`
            : `<button class="btn-inscribirse inscribir" onclick="accionExtraescolar(${e.id_extraescolar}, 'inscribir', this)" ${lleno ? 'disabled' : ''}>
                    <i class="ri-add-circle-line"></i> Inscribirse
               </button>`;

        const checkInscrito = e.inscrito
            ? `<i class="ri-checkbox-circle-fill actividad-card-check"></i>`
            : '';

        return `
            <div class="actividad-card" data-nombre="${e.nombre.toLowerCase()}">
                ${checkInscrito}
                <div class="actividad-nombre">${e.nombre}</div>

                ${e.descripcion ? `<div class="actividad-info-row"><i class="ri-information-line"></i>${e.descripcion}</div>` : ''}

                <div class="actividad-info-row">
                    <i class="ri-map-pin-line"></i>${e.ubicacion}
                </div>
                <div class="actividad-info-row">
                    <i class="ri-calendar-line"></i>${formatearFecha(e.fecha_inicio)} - ${formatearFecha(e.fecha_fin)}
                </div>

                <div>
                    <div class="cupo-label">
                        <span>Cupo disponible</span>
                        <span>${e.cupo_actual} / ${e.cupo_maximo}</span>
                    </div>
                    <div class="progress-wrap">
                        <div class="progress-fill ${e.cupo_lleno ? 'lleno' : ''}" style="width:${porcentaje}%"></div>
                    </div>
                </div>

                ${boton}
            </div>
        `;
    }).join('');
}

async function accionExtraescolar(id, accion, btn) {
    const token = document.querySelector('meta[name="user-token"]')?.content;
    if (!token) return;

    btn.disabled = true;
    const textoOriginal = btn.innerHTML;
    btn.innerHTML = '<i class="ri-loader-4-line"></i> Procesando...';

    try {
        const res = await fetch(`/api/alumno/extraescolares/${id}/${accion}`, {
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
            if (data.message === 'cupo_lleno') {
                mostrarToast('El cupo se llenó justo antes de tu inscripción.', 'error');
            } else {
                mostrarToast(data.message ?? 'Error al procesar.', 'error');
            }
            btn.disabled = false;
            btn.innerHTML = textoOriginal;
            return;
        }

        mostrarToast(data.message, 'success');
        await cargarExtraescolares();

    } catch (err) {
        console.error('[Extraescolares] Error en acción:', err);
        mostrarToast('Error de conexión, intenta de nuevo.', 'error');
        btn.disabled = false;
        btn.innerHTML = textoOriginal;
    }
}

function iniciarBusqueda() {
    const input = document.querySelector('#section-extraescolares .search-bar-extra input');
    if (!input) return;

    input.addEventListener('input', () => {
        const query = input.value.toLowerCase().trim();
        const filtrado = query
            ? catalogoGlobal.filter(e => e.nombre.toLowerCase().includes(query))
            : catalogoGlobal;
        pintarCatalogo(filtrado);
    });
}

function mostrarToast(mensaje, tipo = 'success') {
    const toast = document.createElement('div');
    toast.textContent = mensaje;
    toast.style.cssText = `
        position: fixed; bottom: 24px; right: 24px; z-index: 9999;
        padding: 14px 20px; border-radius: 10px; font-size: 14px; font-weight: 500;
        font-family: 'Inter', sans-serif; box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        background-color: ${tipo === 'success' ? '#2e7d32' : '#d93025'};
        color: white; transition: opacity 0.3s;
    `;
    document.body.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

function formatearFecha(fechaStr) {
    if (!fechaStr) return '';
    const fecha = new Date(fechaStr);
    return fecha.toLocaleDateString('es-MX', { day: '2-digit', month: 'short', year: 'numeric' });
}