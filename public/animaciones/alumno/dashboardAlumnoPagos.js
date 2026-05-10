// ==============================================
//  dashboardAlumnoPagos.js
//  Responsable: Mariana
//  EGAU Chess | Portal del Estudiante
// ==============================================

let facturasData = [];

document.addEventListener('DOMContentLoaded', () => {
    // Escuchar el evento de navegación del sidebar para cargar los pagos cuando se active la pestaña
    const pagosLink = document.querySelector('[data-section="pagos"]');
    if (pagosLink) {
        pagosLink.addEventListener('click', cargarPagos);
    }
    
    // Filtro de estado
    const filtroEstado = document.getElementById('filtro-estado-pagos');
    if (filtroEstado) {
        filtroEstado.addEventListener('change', () => {
            renderFacturas(facturasData);
        });
    }
});

window.pagosCargados = false;

async function cargarPagos() {
    if (window.pagosCargados) return;

    const tbody = document.getElementById('tabla-pagos-body');
    if (tbody) tbody.innerHTML = '<tr><td colspan="7" style="padding: 30px; text-align: center; color: var(--texto-suave);">Cargando facturas...</td></tr>';

    try {
        const token = document.querySelector('meta[name="user-token"]').content;
        const res = await fetch('/api/alumno/pagos', {
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json'
            }
        });
        
        if (res.ok) {
            const data = await res.json();
            facturasData = data.facturas;
            
            // Actualizar info de sede
            if (data.sede) {
                document.getElementById('sede-telefono').textContent = data.sede.telefono || 'N/A';
                document.getElementById('sede-email').textContent = data.sede.email || 'N/A';
            }
            
            window.pagosCargados = true;
            renderFacturas(facturasData);
        } else {
            console.error('Error al cargar pagos');
            if (tbody) tbody.innerHTML = '<tr><td colspan="7" style="padding: 30px; text-align: center; color: var(--rojo);">Error al cargar los pagos.</td></tr>';
        }
    } catch (error) {
        console.error(error);
        if (tbody) tbody.innerHTML = '<tr><td colspan="7" style="padding: 30px; text-align: center; color: var(--rojo);">Error de conexión.</td></tr>';
    }
}

function renderFacturas(facturas) {
    const tbody = document.getElementById('tabla-pagos-body');
    if (!tbody) return;

    const filtro = document.getElementById('filtro-estado-pagos').value;
    
    const filtradas = facturas.filter(f => {
        if (filtro === 'todos') return true;
        return f.vigencia === filtro;
    });

    if (filtradas.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" style="padding: 30px; text-align: center; color: var(--texto-suave);">No se encontraron facturas.</td></tr>';
        return;
    }

    tbody.innerHTML = '';
    filtradas.forEach(f => {
        let badgeClass = 'badge-gris';
        let estadoLabel = f.vigencia;
        
        switch(f.vigencia) {
            case 'pagado':
                badgeClass = 'badge-verde';
                estadoLabel = 'Pagado';
                break;
            case 'enproceso':
                badgeClass = 'badge-naranja';
                estadoLabel = 'En Proceso';
                break;
            case 'cancelado':
                badgeClass = 'badge-rojo';
                estadoLabel = 'Cancelado';
                break;
            case 'expirado':
                badgeClass = 'badge-rojo';
                estadoLabel = 'Expirado';
                break;
        }

        const fechaEmi = new Date(f.fecha_emision).toLocaleDateString('es-MX', { year: 'numeric', month: 'short', day: 'numeric' });
        const fechaLim = new Date(f.fecha_limite).toLocaleDateString('es-MX', { year: 'numeric', month: 'short', day: 'numeric' });

        const tr = document.createElement('tr');
        tr.style.borderBottom = '1px solid var(--borde)';
        tr.innerHTML = `
            <td style="padding: 16px; font-weight: 600; color: var(--texto);">#F-${String(f.id_factura).padStart(4, '0')}</td>
            <td style="padding: 16px; color: var(--texto);">${f.concepto}</td>
            <td style="padding: 16px; color: var(--texto-suave);">${fechaEmi}</td>
            <td style="padding: 16px; color: var(--texto-suave);">${fechaLim}</td>
            <td style="padding: 16px; font-weight: 600; color: var(--texto);">$${parseFloat(f.total_pago).toFixed(2)}</td>
            <td style="padding: 16px;">
                <span class="badge ${badgeClass}" style="display:inline-block; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">${estadoLabel}</span>
            </td>
            <td style="padding: 16px; text-align: center;">
                <button onclick='abrirModalFactura(${JSON.stringify(f)})' class="btn-inscribirse" style="padding: 6px 12px; width: auto; font-size: 13px;">Ver Detalle</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

function abrirModalFactura(f) {
    const alumnoNombre = document.querySelector('.alumno-name-topbar').textContent;
    
    document.getElementById('modal-folio').textContent = `F-${String(f.id_factura).padStart(4, '0')}`;
    document.getElementById('modal-alumno').textContent = alumnoNombre;
    document.getElementById('modal-fecha-emision').textContent = new Date(f.fecha_emision).toLocaleDateString('es-MX', { year: 'numeric', month: 'long', day: 'numeric' });
    document.getElementById('modal-fecha-limite').textContent = new Date(f.fecha_limite).toLocaleDateString('es-MX', { year: 'numeric', month: 'long', day: 'numeric' });
    
    let estadoColor = 'var(--texto)';
    let estadoLabel = f.vigencia;
    if(f.vigencia === 'pagado') { estadoColor = 'var(--verde)'; estadoLabel = 'Pagado'; }
    if(f.vigencia === 'enproceso') { estadoColor = 'var(--naranja)'; estadoLabel = 'En Proceso'; }
    if(f.vigencia === 'cancelado') { estadoColor = 'var(--rojo)'; estadoLabel = 'Cancelado'; }
    if(f.vigencia === 'expirado') { estadoColor = 'var(--rojo)'; estadoLabel = 'Expirado'; }
    
    const estadoEl = document.getElementById('modal-estado');
    estadoEl.textContent = estadoLabel;
    estadoEl.style.color = estadoColor;
    
    document.getElementById('modal-concepto').textContent = f.concepto;
    document.getElementById('modal-descripcion').textContent = f.descripcion || 'Sin descripción';
    document.getElementById('modal-total').textContent = parseFloat(f.total_pago).toFixed(2);
    
    document.getElementById('modalFactura').style.display = 'flex';
}

function imprimirFactura() {
    // Clonamos el contenido a imprimir
    const contenido = document.getElementById('pdf-content').cloneNode(true);
    
    // Obtenemos el folio para el nombre del archivo
    const folio = document.getElementById('modal-folio').textContent || '';

    // Creamos una ventana de impresión
    const printWindow = window.open('', '', 'height=800,width=800');
    printWindow.document.write(`<html><head><title>Factura EGAU Chess - ${folio}</title>`);
    printWindow.document.write('<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">');
    printWindow.document.write('<style>');
    printWindow.document.write('body { font-family: "Inter", sans-serif; padding: 40px; color: #333; }');
    printWindow.document.write('h2 { font-family: "Cinzel", serif; }');
    printWindow.document.write('</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(contenido.innerHTML);
    printWindow.document.write('</body></html>');
    
    printWindow.document.close();
    
    printWindow.onload = function() {
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    };
}
