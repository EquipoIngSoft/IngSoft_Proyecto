{{-- ===================== SECCIÓN: PAGOS / FACTURAS ===================== --}}
<section class="section-content" id="section-pagos" style="display: none;">

    <div class="section-header">
        <h1 class="section-title">Gestión de Facturas</h1>
    </div>

    <div class="facturas-layout">

        {{-- ===== Panel izquierdo: tabla + filtros ===== --}}
        <div class="facturas-table-panel card">

            {{-- Controles --}}
            <div class="controls-container">
                <div class="search-bar">
                    <i class="ri-search-line search-icon"></i>
                    <input type="text" id="buscador-facturas" placeholder="Buscar por alumno, concepto..." autocomplete="off">
                </div>
                <div class="filters-row">

                    @if($administrativo)
                    {{-- Filtro Sede (solo para administrativos) --}}
                    <div class="select-wrapper custom-dropdown" id="dropdown-factura-sede">
                        <div class="custom-select-trigger">
                            <span class="selected-text" data-value="">Todas las sedes</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="custom-options-container">
                            <div class="custom-option selected" data-value="">Todas las sedes</div>
                            @foreach($sedes as $s)
                                <div class="custom-option" data-value="{{ $s->id_sede }}">{{ $s->nombre }}</div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Filtro Vigencia --}}
                    <div class="select-wrapper custom-dropdown" id="dropdown-factura-vigencia">
                        <div class="custom-select-trigger">
                            <span class="selected-text" data-value="">Todos los estados</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="custom-options-container">
                            <div class="custom-option selected" data-value="">Todos los estados</div>
                            <div class="custom-option" data-value="pagado">Pagado</div>
                            <div class="custom-option" data-value="enproceso">En Proceso</div>
                            <div class="custom-option" data-value="cancelado">Cancelado</div>
                            <div class="custom-option" data-value="expirado">Expirado</div>
                        </div>
                    </div>

                    {{-- Filtro Tipo --}}
                    <div class="select-wrapper custom-dropdown" id="dropdown-factura-tipo">
                        <div class="custom-select-trigger">
                            <span class="selected-text" data-value="">Todos los tipos</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="custom-options-container">
                            <div class="custom-option selected" data-value="">Todos los tipos</div>
                            <div class="custom-option" data-value="grupo">Grupo / Inscripción</div>
                            <div class="custom-option" data-value="extraescolar">Extraescolar</div>
                        </div>
                    </div>

                    <button id="btn-limpiar-facturas" class="btn-clear-filters">Limpiar filtros</button>
                </div>
            </div>

            {{-- Tabla --}}
            <div class="table-wrapper">
                <table class="data-table" id="tabla-facturas">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Alumno</th>
                            <th>Concepto</th>
                            <th>Total</th>
                            <th>Tipo</th>
                            <th>Vigencia</th>
                            <th>Vence</th>
                            <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-facturas">
                        <tr id="facturas-loading-row">
                            <td colspan="8" style="text-align:center; padding:2rem; color:var(--texto-suave);">
                                <i class="ri-loader-4-line ri-spin" style="font-size:1.5rem;"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Paginación --}}
            <div class="pagination">
                <div class="pagination-info" id="facturas-pag-info">—</div>
                <div class="pagination-btns" id="facturas-pag-btns"></div>
            </div>
        </div>

        {{-- ===== Panel derecho: detalle de factura ===== --}}
        <div class="facturas-detail-panel card" id="factura-detail-panel">
            <div id="factura-detail-empty" class="facturas-detail-empty">
                <i class="ri-file-list-3-line"></i>
                <p>Selecciona una factura para ver sus detalles</p>
            </div>
            <div id="factura-detail-content" style="display:none;">
                <div class="facturas-detail-header">
                    <div>
                        <h3 id="fd-concepto" class="fd-title">—</h3>
                        <span id="fd-tipo-badge" class="badge">—</span>
                    </div>
                    <span id="fd-vigencia-badge" class="badge">—</span>
                </div>

                <div class="fd-section-label"><i class="ri-user-line"></i> Alumno</div>
                <div class="fd-grid">
                    <div class="fd-field"><label>Nombre</label><p id="fd-alumno">—</p></div>
                    <div class="fd-field"><label>Correo</label><p id="fd-email">—</p></div>
                    <div class="fd-field"><label>Sede</label><p id="fd-sede">—</p></div>
                </div>

                <div class="fd-section-label"><i class="ri-money-dollar-circle-line"></i> Pago</div>
                <div class="fd-grid">
                    <div class="fd-field"><label>Total</label><p id="fd-total">—</p></div>
                    <div class="fd-field"><label>Emisión</label><p id="fd-emision">—</p></div>
                    <div class="fd-field"><label>Fecha límite</label><p id="fd-limite">—</p></div>
                </div>

                <div class="fd-section-label"><i class="ri-file-text-line"></i> Descripción</div>
                <p id="fd-descripcion" class="fd-descripcion-text">—</p>

                @if($permisos->pagos_edit ?? false)
                <div class="fd-cambiar-vigencia">
                    <div class="fd-section-label"><i class="ri-exchange-line"></i> Cambiar Vigencia</div>
                    <div class="fd-vigencia-actions">
                        <button id="btn-marcar-pagado" class="btn-fd-vigencia btn-fd-pagado">
                            <i class="ri-checkbox-circle-line"></i> Marcar como Pagado
                        </button>
                        <button id="btn-marcar-cancelado" class="btn-fd-vigencia btn-fd-cancelado">
                            <i class="ri-close-circle-line"></i> Cancelar Factura
                        </button>
                    </div>
                    <p class="fd-vigencia-nota">Solo se puede cambiar a "Pagado" o "Cancelado".</p>
                </div>
                @endif

                <input type="hidden" id="fd-id-factura" value="">
            </div>
        </div>

    </div>
</section>
