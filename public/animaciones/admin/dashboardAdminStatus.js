// ==============================================
//  dashboardAdminStatus.js — Sección Status / KPIs
//  EGAU Chess | AMAAC
// ==============================================

document.addEventListener('DOMContentLoaded', () => {

    const token = document.querySelector('meta[name="user-token"]')?.getAttribute('content') || '';

    // Referencias DOM
    const kpiAlumnos = document.getElementById('kpi-alumnos');
    const kpiActividades = document.getElementById('kpi-actividades');
    const kpiProfesores = document.getElementById('kpi-profesores');
    const kpiCrecimiento = document.getElementById('kpi-crecimiento');
    // Si la lista tiene un ul/div específico o simplemente se llama lista-actividad-reciente
    const listActividad = document.getElementById('lista-actividad-reciente'); 
    const btnRefresh = document.getElementById('btn-refresh-status');

    const cargarStatus = async () => {
        try {
            // Mostrar estado de carga temporal
            if(kpiAlumnos) kpiAlumnos.textContent = '...';
            if(kpiActividades) kpiActividades.textContent = '...';
            if(kpiProfesores) kpiProfesores.textContent = '...';
            if(kpiCrecimiento) {
                kpiCrecimiento.textContent = '...';
                kpiCrecimiento.style.color = '#888';
            }
            if(listActividad) listActividad.innerHTML = '<div style="padding:12px 0; color:#888; font-size:14px; text-align:center;">Cargando...</div>';
            
            const resp = await fetch('/admin/status/datos', {
                headers: { 'Authorization': `Bearer ${token}` }
            });

            if (!resp.ok) throw new Error('Error en petición');
            
            const data = await resp.json();

            // Actualizar KPIs
            if(kpiAlumnos) kpiAlumnos.textContent = data.total_alumnos;
            if(kpiActividades) kpiActividades.textContent = data.total_extraescolares;
            if(kpiProfesores) kpiProfesores.textContent = data.total_profesores;
            
            if(kpiCrecimiento) {
                kpiCrecimiento.textContent = data.crecimiento;
                if (data.crecimiento.startsWith('+')) {
                    kpiCrecimiento.style.color = 'var(--exito, #34a853)'; 
                } else if (data.crecimiento.startsWith('-')) {
                    kpiCrecimiento.style.color = 'var(--peligro, #ea4335)';
                } else {
                    kpiCrecimiento.style.color = 'var(--texto-suave, #888)';
                }
            }

            // Renderizar actividad reciente
            if (listActividad) {
                listActividad.innerHTML = '';
                if (data.actividad_reciente && data.actividad_reciente.length > 0) {
                    data.actividad_reciente.forEach(item => {
                        const row = document.createElement('div');
                        row.style.display = 'flex';
                        row.style.justifyContent = 'space-between';
                        row.style.alignItems = 'center';
                        row.style.padding = '14px 0';
                        row.style.borderBottom = '1px solid var(--borde, #eee)';

                        let textoMain = '';
                        if (item.tipo === 'alumno') {
                            textoMain = `Nuevo alumno registrado: <strong>${item.descripcion}</strong>`;
                        } else if (item.tipo === 'grupo') {
                            textoMain = `Grupo creado: <strong>${item.descripcion}</strong>`;
                        }

                        row.innerHTML = `
                            <span style="font-size:14px; color:var(--texto, #333); flex-grow:1; padding-right:16px;">${textoMain}</span>
                            <span style="font-size:12px; color:var(--texto-suave, #888); white-space:nowrap; text-align:right;">${item.hace}</span>
                        `;
                        listActividad.appendChild(row);
                    });
                } else {
                    listActividad.innerHTML = '<div style="padding:12px 0; color:var(--texto-suave, #888); font-size:14px;">No hay actividad reciente.</div>';
                }
            }

        } catch (error) {
            console.error('Error al cargar status:', error);
            if(kpiAlumnos) kpiAlumnos.textContent = '—';
            if(kpiActividades) kpiActividades.textContent = '—';
            if(kpiProfesores) kpiProfesores.textContent = '—';
            if(kpiCrecimiento) {
                kpiCrecimiento.textContent = '—';
                kpiCrecimiento.style.color = 'var(--texto-suave, #888)';
            }
            if(listActividad) {
                listActividad.innerHTML = '<div style="padding:12px 0; color:var(--peligro, #ea4335); font-size:14px;">Error al cargar la actividad.</div>';
            }
        }
    };

    // Llamada inicial
    cargarStatus();

    // Evento del botón de actualización manual (si existe)
    if (btnRefresh) {
        btnRefresh.addEventListener('click', () => {
            // Se puede agregar una clase de rotación al ícono si se desea
            const icon = btnRefresh.querySelector('i');
            if(icon) {
                icon.style.transition = 'transform 0.5s ease';
                icon.style.transform = 'rotate(360deg)';
                setTimeout(() => { icon.style.transform = ''; }, 500);
            }
            cargarStatus();
        });
    }

});
