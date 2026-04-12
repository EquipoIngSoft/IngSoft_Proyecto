/* =============================================
   extraescolares.js — Filtros, búsqueda e inscripciones (mock)
   EGAU Chess | Portal del Estudiante
   TODO: Conectar fetch() a endpoints reales cuando el backend esté listo
   ============================================= */

document.addEventListener('DOMContentLoaded', () => {

    const buscador      = document.getElementById('buscador-extra');
    const btnFiltros    = document.querySelectorAll('.btn-filtro');
    const tarjetas      = document.querySelectorAll('.actividad-card');
    const empty         = document.getElementById('extra-empty');
    const listaInscrip  = document.getElementById('lista-mis-inscripciones');
    const sinInscrip    = document.getElementById('sin-inscripciones');

    let categoriaActiva = 'todas';

    /* FILTROS DE CATEGORÍA */
    btnFiltros.forEach(btn => {
        btn.addEventListener('click', () => {
            btnFiltros.forEach(b => b.classList.remove('activo'));
            btn.classList.add('activo');
            categoriaActiva = btn.dataset.categoria;
            filtrar();
        });
    });

    /* BÚSQUEDA EN TIEMPO REAL */
    if (buscador) buscador.addEventListener('input', filtrar);

    function filtrar() {
        const texto = buscador ? buscador.value.toLowerCase().trim() : '';
        let visibles = 0;
        tarjetas.forEach(card => {
            const nombre    = (card.dataset.nombre    || '').toLowerCase();
            const categoria = (card.dataset.categoria || '').toLowerCase();
            const ok = nombre.includes(texto) &&
                       (categoriaActiva === 'todas' || categoria === categoriaActiva);
            card.style.display = ok ? '' : 'none';
            if (ok) visibles++;
        });
        if (empty) empty.style.display = visibles === 0 ? 'block' : 'none';
    }

    /* INSCRIPCIÓN / CANCELACIÓN (mock)
       TODO: reemplazar bloque interno por fetch() POST/DELETE al backend */
    tarjetas.forEach(card => {
        const btn = card.querySelector('.btn-inscribirse');
        if (!btn) return;

        btn.addEventListener('click', () => {
            const inscrito = btn.classList.contains('cancelar');
            const nombre   = card.dataset.nombre || '';
            const horario  = card.dataset.horario || '';

            if (inscrito) {
                /* --- CANCELAR --- */
                // TODO: fetch(`/api/extraescolares/${card.dataset.id}/cancelar`, { method: 'DELETE' })
                const check = card.querySelector('.actividad-card-check');
                if (check) check.remove();
                btn.classList.replace('cancelar', 'inscribir');
                btn.innerHTML = '<i class="ri-checkbox-circle-line"></i> Inscribirse';
                const item = listaInscrip
                    ? listaInscrip.querySelector(`[data-ref="${nombre}"]`)
                    : null;
                if (item) item.remove();

            } else {
                /* --- INSCRIBIRSE --- */
                // TODO: fetch(`/api/extraescolares/${card.dataset.id}/inscribir`, { method: 'POST' })
                if (!card.querySelector('.actividad-card-check')) {
                    const check = document.createElement('i');
                    check.className = 'ri-checkbox-circle-line actividad-card-check';
                    card.prepend(check);
                }
                btn.classList.replace('inscribir', 'cancelar');
                btn.innerHTML = '<i class="ri-close-circle-line"></i> Cancelar Inscripción';
                if (listaInscrip) {
                    const item = document.createElement('div');
                    item.className = 'inscripcion-activa';
                    item.dataset.ref = nombre;
                    item.innerHTML = `
                        <div>
                            <div class="inscripcion-activa-nombre">${capitalizar(nombre)}</div>
                            <div class="inscripcion-activa-horario">${horario}</div>
                        </div>
                        <i class="ri-checkbox-circle-line inscripcion-activa-check"></i>`;
                    listaInscrip.appendChild(item);
                }
            }

            if (sinInscrip && listaInscrip)
                sinInscrip.style.display = listaInscrip.children.length === 0 ? 'block' : 'none';
        });
    });

    function capitalizar(str) {
        return str.replace(/\b\w/g, l => l.toUpperCase());
    }

});