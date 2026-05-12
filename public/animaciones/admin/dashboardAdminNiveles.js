/**
 * dashboardAdminNiveles.js
 * EGAU Chess — Sección Niveles de Estudiantes
 *
 * calcularRango() es copia exacta de dashboardAlumnoMiNivel.js — NO modificar.
 */
(function () {
    'use strict';

    // ── calcularRango — copia exacta del JS del alumno ───────────────
    function calcularRango(puntos) {
        if (puntos >= 3000) return { numero: 6, nombre: 'Rey', emoji: '♚', animClass: 'anim-rey' };
        if (puntos >= 1500) return { numero: 5, nombre: 'Reina', emoji: '♛', animClass: 'anim-reina' };
        if (puntos >= 800) return { numero: 4, nombre: 'Torre', emoji: '♜', animClass: 'anim-torre' };
        if (puntos >= 400) return { numero: 3, nombre: 'Alfil', emoji: '♝', animClass: 'anim-alfil' };
        if (puntos >= 150) return { numero: 2, nombre: 'Caballo', emoji: '♞', animClass: 'anim-caballo' };
        return { numero: 1, nombre: 'Peón', emoji: '♟', animClass: 'anim-peon' };
    }

    // ── Config ───────────────────────────────────────────────────────
    const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';
    const PERMISOS = window.PERMISOS_NIVELES || { ver: false, edit: false, admin: false };

    const $ = id => document.getElementById(id);
    const qs = (sel, ctx = document) => ctx.querySelector(sel);

    // ── Estado ───────────────────────────────────────────────────────
    const state = {
        alumnos: [],
        filtros: { q: '', id_sede: '', id_grupo: '', nivel: '' },
        paginaActual: 1,
        porPagina: 15,
        // modal edición
        idAlumnoEditar: null,
        nombreAlumnoEditar: '',
        puntajeActual: 0,
    };

    // ── Init (se llama una sola vez cuando la sección se hace visible) ──
    function init() {
        cargarGrupos();
        cargarAlumnos();
        bindFiltros();
        bindModal();
    }

    // ── Carga de grupos para el dropdown ────────────────────────────
    function cargarGrupos() {
        fetch('/admin/niveles/grupos', { headers: { Accept: 'application/json', 'X-CSRF-TOKEN': CSRF } })
            .then(r => r.json())
            .then(json => {
                const container = $('niv-grupo-options');
                if (!container) return;
                const grupos = json.data || [];
                grupos.forEach(g => {
                    const div = document.createElement('div');
                    div.className = 'custom-option';
                    div.dataset.value = g.id_grupo;
                    div.textContent = g.codigo_grupo + (g.nombre_curso ? ` — ${g.nombre_curso}` : '');
                    container.appendChild(div);
                });
                // Re-bind con pequeño delay para que el DOM se actualice
                setTimeout(() => {
                    bindDropdownOpts($('dropdown-niv-grupo'), val => {
                        state.filtros.id_grupo = val;
                        state.paginaActual = 1;
                        cargarAlumnos();
                    });
                }, 100);
            })
            .catch(() => { });
    }

    // ── Carga principal de alumnos ───────────────────────────────────
    function cargarAlumnos() {
        mostrarLoading();

        const params = new URLSearchParams();
        if (state.filtros.id_sede) params.set('id_sede', state.filtros.id_sede);
        if (state.filtros.id_grupo) params.set('id_grupo', state.filtros.id_grupo);
        if (state.filtros.nivel) params.set('nivel', state.filtros.nivel);
        if (state.filtros.q) params.set('q', state.filtros.q);

        fetch(`/admin/niveles/alumnos?${params}`, {
            headers: { Accept: 'application/json', 'X-CSRF-TOKEN': CSRF }
        })
            .then(r => r.json())
            .then(json => {
                state.alumnos = json.data || [];
                actualizarKpis(json.stats || {});
                renderTabla();
                renderPaginacion();
            })
            .catch(() => {
                const tbody = $('tbody-niveles');
                if (tbody) tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;color:#c0392b;padding:1.5rem;">Error al cargar los datos.</td></tr>';
            });
    }

    function mostrarLoading() {
        const tbody = $('tbody-niveles');
        const cols = PERMISOS.edit ? 6 : 5;
        if (tbody) tbody.innerHTML = `<tr><td colspan="${cols}" style="text-align:center;padding:2rem;color:var(--texto-suave);"><i class="ri-loader-4-line ri-spin" style="font-size:1.5rem;"></i></td></tr>`;
    }

    // ── KPI Cards ────────────────────────────────────────────────────
    function actualizarKpis(stats) {
        setText('kpi-total', stats.total ?? '—');
        setText('kpi-prom-pts', stats.prom_puntos ?? '—');
        setText('kpi-prom-niv', stats.prom_nivel ?? '—');
    }

    // ── Renderizado de tabla ─────────────────────────────────────────
    function renderTabla() {
        const tbody = $('tbody-niveles');
        if (!tbody) return;

        const inicio = (state.paginaActual - 1) * state.porPagina;
        const pagina = state.alumnos.slice(inicio, inicio + state.porPagina);
        const cols = PERMISOS.edit ? 6 : 5;

        if (pagina.length === 0) {
            tbody.innerHTML = `<tr><td colspan="${cols}" style="text-align:center;padding:2rem;color:var(--texto-suave);">No se encontraron estudiantes.</td></tr>`;
            return;
        }

        tbody.innerHTML = pagina.map(a => {
            const puntos = parseInt(a.puntaje) || 0;
            const rango = calcularRango(puntos);
            const badgeCls = `badge-nivel badge-nivel-${rango.numero}`;

            return `
            <tr data-id="${a.id_alumno}" data-puntaje="${puntos}" data-nombre="${esc(a.nombre)}">
                <td><strong>${esc(a.nombre)}</strong></td>
                <td>${esc(a.nombre_sede)}</td>
                <td>
                    <span class="puntos-actual">${puntos}</span>
                    <span class="puntos-max">/ pts</span>
                </td>
                <td>
                    <div class="${badgeCls}">
                        <span class="badge-nivel-emoji">${rango.emoji}</span>
                        <span class="badge-nivel-texto">${rango.nombre}</span>
                        <span class="badge-nivel-num">Nv.${rango.numero}</span>
                    </div>
                </td>
                <td>${esc(a.codigo_grupo)}</td>
                ${PERMISOS.edit ? `
                <td class="acciones-puntos">
                    <button class="btn-modificar-puntos btn-niv-edit"
                            data-id="${a.id_alumno}"
                            data-nombre="${esc(a.nombre)}"
                            data-puntaje="${puntos}">
                        <i class="ri-edit-line"></i> Modificar
                    </button>
                </td>` : ''}
            </tr>`;
        }).join('');

        // Listeners botones editar
        tbody.querySelectorAll('.btn-niv-edit').forEach(btn => {
            btn.addEventListener('click', () => {
                abrirModalPuntos(
                    parseInt(btn.dataset.id),
                    btn.dataset.nombre,
                    parseInt(btn.dataset.puntaje)
                );
            });
        });
    }

    // ── Paginación ───────────────────────────────────────────────────
    function renderPaginacion() {
        const info = $('niv-pag-info');
        const btns = $('niv-pag-btns');
        if (!btns) return;

        const total = state.alumnos.length;
        const paginas = Math.ceil(total / state.porPagina) || 1;
        if (info) info.textContent = `${total} estudiante${total !== 1 ? 's' : ''}`;

        btns.innerHTML = '';

        const prev = document.createElement('button');
        prev.className = 'pag-btn';
        prev.innerHTML = '<i class="ri-arrow-left-s-line"></i>';
        prev.disabled = state.paginaActual === 1;
        prev.addEventListener('click', () => {
            if (state.paginaActual > 1) { state.paginaActual--; renderTabla(); renderPaginacion(); }
        });
        btns.appendChild(prev);

        for (let i = 1; i <= paginas; i++) {
            const b = document.createElement('button');
            b.className = `pag-btn${i === state.paginaActual ? ' active' : ''}`;
            b.textContent = i;
            b.addEventListener('click', () => { state.paginaActual = i; renderTabla(); renderPaginacion(); });
            btns.appendChild(b);
        }

        const next = document.createElement('button');
        next.className = 'pag-btn';
        next.innerHTML = '<i class="ri-arrow-right-s-line"></i>';
        next.disabled = state.paginaActual >= paginas;
        next.addEventListener('click', () => {
            if (state.paginaActual < paginas) { state.paginaActual++; renderTabla(); renderPaginacion(); }
        });
        btns.appendChild(next);
    }

    // ── Filtros ──────────────────────────────────────────────────────
    function bindFiltros() {
        // Buscador
        const buscador = $('buscador-niveles');
        if (buscador) {
            let t;
            buscador.addEventListener('input', () => {
                clearTimeout(t);
                t = setTimeout(() => {
                    state.filtros.q = buscador.value.trim();
                    state.paginaActual = 1;
                    cargarAlumnos();
                }, 350);
            });
        }

        // Filtro nivel (estático)
        bindDropdownOpts($('dropdown-niv-nivel'), val => {
            state.filtros.nivel = val;
            state.paginaActual = 1;
            cargarAlumnos();
        });

        // Filtro sede (solo admin)
        const ddSede = $('dropdown-niv-sede');
        if (ddSede) {
            bindDropdownOpts(ddSede, val => {
                state.filtros.id_sede = val;
                state.paginaActual = 1;
                cargarAlumnos();
            });
        }

        // Limpiar filtros
        const btnLimpiar = $('btn-limpiar-niveles');
        if (btnLimpiar) btnLimpiar.addEventListener('click', limpiarFiltros);

        // Cerrar dropdowns al clic fuera
        document.addEventListener('click', () => {
            document.querySelectorAll('#section-niveles .custom-dropdown.open')
                .forEach(d => d.classList.remove('open'));
        });
    }

    function limpiarFiltros() {
        state.filtros = { q: '', id_sede: '', id_grupo: '', nivel: '' };
        state.paginaActual = 1;

        const buscador = $('buscador-niveles');
        if (buscador) buscador.value = '';

        document.querySelectorAll('#section-niveles .custom-dropdown').forEach(dd => {
            const first = qs('.custom-option', qs('.custom-options-container', dd));
            if (!first) return;
            qs('.selected-text', dd).textContent = first.textContent.trim();
            qs('.selected-text', dd).dataset.value = first.dataset.value || '';
            dd.querySelectorAll('.custom-option').forEach(o => o.classList.remove('selected'));
            first.classList.add('selected');
        });

        cargarAlumnos();
    }

    function bindDropdownOpts(dd, onChange) {
        if (!dd) return;
        const trigger = qs('.custom-select-trigger', dd);
        const optsCont = qs('.custom-options-container', dd);
        if (!trigger || !optsCont) return;

        // Toggle open
        trigger.addEventListener('click', e => {
            e.stopPropagation();
            const wasOpen = dd.classList.contains('open');
            document.querySelectorAll('#section-niveles .custom-dropdown.open')
                .forEach(d => d.classList.remove('open'));
            if (!wasOpen) dd.classList.add('open');
        });

        // Seleccionar opción (incluye las que se añadan después)
        optsCont.addEventListener('click', e => {
            const opt = e.target.closest('.custom-option');
            if (!opt) return;
            const val = opt.dataset.value || '';
            qs('.selected-text', trigger).textContent = opt.textContent.trim();
            qs('.selected-text', trigger).dataset.value = val;
            optsCont.querySelectorAll('.custom-option').forEach(o => o.classList.remove('selected'));
            opt.classList.add('selected');
            dd.classList.remove('open');
            onChange(val);
        });
    }

    // ── Modal modificar puntaje ──────────────────────────────────────
    function bindModal() {
        const modal = $('modal-modificar-puntos');
        const btnClose = $('modal-close-puntos');
        const btnSumar = $('btn-puntos-sumar');
        const btnRestar = $('btn-puntos-restar');

        if (btnClose) btnClose.addEventListener('click', cerrarModal);
        if (modal) modal.addEventListener('click', e => { if (e.target === modal) cerrarModal(); });

        if (btnSumar) btnSumar.addEventListener('click', () => aplicarPuntos('sumar'));
        if (btnRestar) btnRestar.addEventListener('click', () => aplicarPuntos('restar'));
    }

    function abrirModalPuntos(idAlumno, nombre, puntaje) {
        state.idAlumnoEditar = idAlumno;
        state.nombreAlumnoEditar = nombre;
        state.puntajeActual = puntaje;

        const modal = $('modal-modificar-puntos');
        setText('puntos-modal-nombre', nombre);
        setText('puntos-modal-actuales', puntaje);
        const input = $('puntos-modal-cantidad');
        if (input) input.value = '';
        if (modal) modal.classList.add('open');
    }

    function cerrarModal() {
        const modal = $('modal-modificar-puntos');
        if (modal) modal.classList.remove('open');
    }

    function aplicarPuntos(operacion) {
        const input = $('puntos-modal-cantidad');
        const cant = parseInt(input?.value || '0');

        if (!cant || cant <= 0) {
            alert('Ingresa una cantidad válida mayor a 0.');
            return;
        }

        fetch(`/admin/niveles/alumnos/${state.idAlumnoEditar}/puntaje`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF,
            },
            body: JSON.stringify({ operacion, cantidad: cant }),
        })
            .then(r => r.json())
            .then(res => {
                if (res.error) { alert(res.error); return; }
                if (res.errors) { alert(Object.values(res.errors)[0][0]); return; }

                cerrarModal();

                // Actualizar en el estado local sin recargar toda la tabla
                const alumno = state.alumnos.find(a => a.id_alumno == state.idAlumnoEditar);
                if (alumno) {
                    alumno.puntaje = res.puntaje_nuevo;
                    alumno.nivel_num = res.nivel_num;
                    alumno.nivel_nombre = res.nivel_nombre;
                    alumno.nivel_emoji = res.nivel_emoji;
                }

                renderTabla();
                renderPaginacion();

                // Actualizar KPIs recargando stats
                const total = state.alumnos.length;
                const promPts = total > 0 ? +(state.alumnos.reduce((s, a) => s + (parseInt(a.puntaje) || 0), 0) / total).toFixed(1) : 0;
                const promNiv = total > 0 ? +(state.alumnos.reduce((s, a) => s + calcularRango(parseInt(a.puntaje) || 0).numero, 0) / total).toFixed(1) : 0;
                actualizarKpis({ total, prom_puntos: promPts, prom_nivel: promNiv });
            })
            .catch(() => alert('Error de conexión al actualizar el puntaje.'));
    }

    // ── Utilidades ───────────────────────────────────────────────────
    function setText(id, val) { const e = $(id); if (e) e.textContent = val; }
    function esc(str) {
        return String(str ?? '').replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    }

    // ── Boot: inicializa solo cuando la sección se muestra ───────────
    document.addEventListener('DOMContentLoaded', () => {
        const seccion = $('section-niveles');
        if (!seccion) return;

        let inicializado = false;
        function tryInit() {
            if (!inicializado && seccion.style.display !== 'none') {
                inicializado = true;
                init();
            }
        }
        tryInit();
        const obs = new MutationObserver(tryInit);
        obs.observe(seccion, { attributes: true, attributeFilter: ['style'] });
    });

})();
