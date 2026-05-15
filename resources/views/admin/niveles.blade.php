{{-- ===================== SECCIÓN: NIVELES DE ESTUDIANTES ===================== --}}
<section class="section-content" id="section-niveles" style="display: none;">

    <div class="section-header">
        <h1 class="section-title">Niveles de Estudiantes</h1>
    </div>

    {{-- ── KPI Cards ──────────────────────────────────────────────────── --}}
    <div class="niveles-kpi-container">
        <div class="niveles-kpi-card">
            <span class="kpi-label">Total Estudiantes</span>
            <span class="kpi-value" id="kpi-total">—</span>
        </div>
        <div class="niveles-kpi-card">
            <span class="kpi-label">Promedio de Puntos</span>
            <span class="kpi-value" id="kpi-prom-pts">—</span>
        </div>
        <div class="niveles-kpi-card">
            <span class="kpi-label">Nivel Promedio</span>
            <span class="kpi-value" id="kpi-prom-niv">—</span>
        </div>
    </div>

    {{-- ── Card principal ─────────────────────────────────────────────── --}}
    <div class="card card-niveles">

        {{-- Controles ─────────────────────────────────────────────────── --}}
        <div class="niveles-controls">

            {{-- Buscador --}}
            <div class="search-bar search-niveles">
                <i class="ri-search-line search-icon"></i>
                <input type="text" id="buscador-niveles" placeholder="Buscar estudiante por nombre..." autocomplete="off">
            </div>

            {{-- Filtro Sede (solo administrativos) --}}
            @if($administrativo)
            <div class="select-wrapper custom-dropdown" id="dropdown-niv-sede">
                <div class="custom-select-trigger niveles-select">
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

            {{-- Filtro Grupo (se llena desde JS con AJAX) --}}
            <div class="select-wrapper custom-dropdown" id="dropdown-niv-grupo">
                <div class="custom-select-trigger niveles-select">
                    <span class="selected-text" data-value="">Todos los grupos</span>
                    <i class="ri-arrow-down-s-line"></i>
                </div>
                <div class="custom-options-container" id="niv-grupo-options">
                    <div class="custom-option selected" data-value="">Todos los grupos</div>
                </div>
            </div>

            {{-- Filtro Nivel --}}
            <div class="select-wrapper custom-dropdown" id="dropdown-niv-nivel">
                <div class="custom-select-trigger niveles-select">
                    <span class="selected-text" data-value="">Todos los niveles</span>
                    <i class="ri-arrow-down-s-line"></i>
                </div>
                <div class="custom-options-container">
                    <div class="custom-option selected" data-value="">Todos los niveles</div>
                    <div class="custom-option" data-value="1">
                        <span class="niv-emoji">♟</span> Nivel 1 — Peón
                    </div>
                    <div class="custom-option" data-value="2">
                        <span class="niv-emoji">♞</span> Nivel 2 — Caballo
                    </div>
                    <div class="custom-option" data-value="3">
                        <span class="niv-emoji">♝</span> Nivel 3 — Alfil
                    </div>
                    <div class="custom-option" data-value="4">
                        <span class="niv-emoji">♜</span> Nivel 4 — Torre
                    </div>
                    <div class="custom-option" data-value="5">
                        <span class="niv-emoji">♛</span> Nivel 5 — Reina
                    </div>
                    <div class="custom-option" data-value="6">
                        <span class="niv-emoji">♚</span> Nivel 6 — Rey
                    </div>
                </div>
            </div>

            <button id="btn-limpiar-niveles" class="btn-clear-filters">Limpiar filtros</button>
        </div>

        {{-- Tabla ─────────────────────────────────────────────────────── --}}
        <div class="table-wrapper">
            <table class="data-table" id="tabla-niveles">
                <thead>
                    <tr>
                        <th>Alumno</th>
                        <th>Sede</th>
                        <th>Puntos</th>
                        <th>Nivel</th>
                        <th>Grupo</th>
                        @if($permisos->niveles_edit ?? false)
                            <th>Acciones</th>
                        @endif
                    </tr>
                </thead>
                <tbody id="tbody-niveles">
                    <tr>
                        <td colspan="{{ ($permisos->niveles_edit ?? false) ? 6 : 5 }}"
                            style="text-align:center;padding:2rem;color:var(--texto-suave);">
                            <i class="ri-loader-4-line ri-spin" style="font-size:1.5rem;"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Paginación ──────────────────────────────────────────────────  --}}
        <div class="pagination">
            <div class="pagination-info" id="niv-pag-info">—</div>
            <div class="pagination-btns" id="niv-pag-btns"></div>
        </div>

    </div>
</section>
