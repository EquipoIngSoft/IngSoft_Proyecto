{{-- ===================== SECCIÓN: EXTRAESCOLARES ===================== --}}
<section class="section-content" id="section-extraescolares" style="display: none;">

    <div class="section-header">
        <h1 class="section-title">Actividades Extraescolares</h1>
        @if($permisos->extracurriculares_edit ?? false)
            <button class="btn-primary" id="btn-agregar-extraescolar">
                <i class="ri-add-line"></i> Agregar Actividad
            </button>
        @endif
    </div>

    <div class="search-bar" style="margin-bottom: 24px;">
        <i class="ri-search-line search-icon"></i>
        <input type="text" id="buscador-extraescolares" placeholder="Buscar actividad por nombre..." autocomplete="off">
    </div>

    <div class="extraescolares-grid" id="grid-extraescolares">
        <div id="extraescolares-loading" style="grid-column:1/-1;text-align:center;padding:3rem;color:var(--texto-suave);">
            <i class="ri-loader-4-line ri-spin" style="font-size:2rem;"></i>
        </div>
    </div>
    <p class="extraescolares-empty" id="extraescolares-empty" style="display:none;">No se encontraron actividades.</p>

</section>

{{-- ===================== MODAL: AGREGAR EXTRAESCOLAR ===================== --}}
<div class="modal-overlay" id="modal-agregar-extraescolar">
    <div class="modal-box">
        <div class="modal-header">
            <div class="modal-title-group">
                <span class="modal-title-icon"><i class="ri-bar-chart-2-line"></i></span>
                <h2 class="modal-title">Agregar Actividad Extraescolar</h2>
            </div>
            <button type="button" class="modal-close-btn" id="modal-close-extraescolar" title="Cerrar">
                <i class="ri-close-line"></i>
            </button>
        </div>
        <div class="modal-body">
            <form id="form-agregar-extraescolar" novalidate>
                @csrf
                <div class="modal-section-label">
                    <i class="ri-information-line"></i> Datos de la Actividad
                </div>
                <div class="modal-grid">
                    <div class="form-group-modal modal-col-full">
                        <label for="ex-nombre">Nombre <span style="color:var(--naranja)">*</span></label>
                        <input type="text" id="ex-nombre" name="nombre" placeholder="Ej. Taller de Ajedrez Rápido" required maxlength="20">
                        <span class="error-msg-modal" id="err-ex-nombre"></span>
                    </div>
                    <div class="form-group-modal">
                        <label for="ex-cupo-maximo">Cupo Máximo</label>
                        <input type="number" id="ex-cupo-maximo" name="cupo_maximo" placeholder="Ej. 30" min="1">
                        <span class="error-msg-modal" id="err-ex-cupo-maximo"></span>
                    </div>
                    <div class="form-group-modal">
                        <label for="ex-semanas">Duración (Semanas) <span style="color:var(--naranja)">*</span></label>
                        <input type="text" id="ex-semanas" name="duracion_semanas" placeholder="Ej. 8 semanas" maxlength="20" required>
                        <span class="error-msg-modal" id="err-ex-semanas"></span>
                    </div>
                    <div class="form-group-modal">
                        <label for="ex-costo">Costo Base ($)</label>
                        <input type="number" id="ex-costo" name="costo_base" placeholder="Ej. 500.00" min="0" step="0.01">
                    </div>
                    <div class="form-group-modal">
                        <label for="ex-fecha-inicio">Fecha de Inicio <span style="color:var(--naranja)">*</span></label>
                        <input type="date" id="ex-fecha-inicio" name="fecha_inicio" required>
                        <span class="error-msg-modal" id="err-ex-fecha-inicio"></span>
                    </div>
                    <div class="form-group-modal">
                        <label for="ex-fecha-fin">Fecha de Fin <span style="color:var(--naranja)">*</span></label>
                        <input type="date" id="ex-fecha-fin" name="fecha_fin" required>
                        <span class="error-msg-modal" id="err-ex-fecha-fin"></span>
                    </div>
                    <div class="form-group-modal">
                        <label for="ex-estatus">Estatus</label>
                        <div class="form-dropdown" id="dropdown-ex-estatus" tabindex="0">
                            <div class="form-select-trigger" id="trigger-ex-estatus">
                                <span class="selected-text" data-value="1">Activo</span>
                                <i class="ri-arrow-down-s-line"></i>
                            </div>
                            <div class="form-options-container">
                                <div class="form-option selected" data-value="1">Activo</div>
                                <div class="form-option" data-value="0">Inactivo</div>
                            </div>
                            <input type="hidden" id="ex-estatus" name="estatus" value="1">
                        </div>
                    </div>
                    <div class="form-group-modal">
                        <label for="ex-ubicacion">Ubicación <span style="color:var(--naranja)">*</span></label>
                        <input type="text" id="ex-ubicacion" name="ubicacion" placeholder="Ej. Aula 4" maxlength="20" required>
                        <span class="error-msg-modal" id="err-ex-ubicacion"></span>
                    </div>
                    <div class="form-group-modal modal-col-full">
                        <label for="ex-descripcion">Descripción</label>
                        <textarea id="ex-descripcion" name="descripcion" placeholder="Breve descripción de la actividad..." rows="3"
                            style="width:100%;padding:10px;border:2px solid var(--borde);border-radius:10px;font-family:'Inter',sans-serif;resize:vertical;background:#fafafa;"></textarea>
                    </div>
                    <div class="form-group-modal modal-col-full">
                        <label for="ex-requisitos">Requisitos</label>
                        <textarea id="ex-requisitos" name="requisitos" placeholder="Requisitos previos..." rows="2"
                            style="width:100%;padding:10px;border:2px solid var(--borde);border-radius:10px;font-family:'Inter',sans-serif;resize:vertical;background:#fafafa;"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-modal-cancel" id="btn-cancelar-modal-extraescolar">Cancelar</button>
                    <button type="submit" class="btn-modal-submit">
                        <i class="ri-save-line"></i> Guardar Actividad
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===================== MODAL: VER EXTRAESCOLAR ===================== --}}
<div class="modal-overlay" id="modal-ver-extraescolar">
    <div class="modal-box modal-box-large">
        <div class="modal-header">
            <div class="modal-title-group">
                <i class="ri-eye-line modal-title-icon"></i>
                <h2 class="modal-title">Detalle de Actividad</h2>
            </div>
            <button class="modal-close-btn" id="modal-close-ver-extraescolar" title="Cerrar">
                <i class="ri-close-line"></i>
            </button>
        </div>
        <div class="modal-body">
            <div id="ver-extra-loader" style="text-align:center;padding:2rem;">
                <i class="ri-loader-4-line ri-spin" style="font-size:2rem;color:var(--naranja)"></i>
            </div>
            <div id="ver-extra-content" style="display:none;">
                <div class="modal-section-label"><i class="ri-information-line"></i> Información General</div>
                <div class="modal-grid" style="margin-bottom:1.2rem;">
                    <div class="form-group-modal"><label>Nombre</label><p id="ve-nombre" class="detalle-valor">—</p></div>
                    <div class="form-group-modal"><label>Ubicación</label><p id="ve-ubicacion" class="detalle-valor">—</p></div>
                    <div class="form-group-modal"><label>Cupo Máximo</label><p id="ve-cupo" class="detalle-valor">—</p></div>
                    <div class="form-group-modal"><label>Inscritos Activos</label><p id="ve-inscritos" class="detalle-valor">—</p></div>
                    <div class="form-group-modal"><label>Duración</label><p id="ve-duracion" class="detalle-valor">—</p></div>
                    <div class="form-group-modal"><label>Costo Base</label><p id="ve-costo" class="detalle-valor">—</p></div>
                    <div class="form-group-modal"><label>Fecha Inicio</label><p id="ve-inicio" class="detalle-valor">—</p></div>
                    <div class="form-group-modal"><label>Fecha Fin</label><p id="ve-fin" class="detalle-valor">—</p></div>
                    <div class="form-group-modal"><label>Estatus</label><p id="ve-estatus" class="detalle-valor">—</p></div>
                    <div class="form-group-modal modal-col-full"><label>Descripción</label><p id="ve-descripcion" class="detalle-valor">—</p></div>
                    <div class="form-group-modal modal-col-full"><label>Requisitos</label><p id="ve-requisitos" class="detalle-valor">—</p></div>
                </div>

                <div class="modal-section-label"><i class="ri-group-line"></i> Alumnos Inscritos</div>
                <div class="table-wrapper" style="max-height:260px;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido P</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Inscripción</th>
                            </tr>
                        </thead>
                        <tbody id="ve-inscritos-tbody">
                            <tr><td colspan="5" style="text-align:center;color:var(--texto-suave);">Sin inscritos activos</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-modal-cancel" id="btn-cerrar-ver-extra">Cerrar</button>
        </div>
    </div>
</div>

{{-- ===================== MODAL: EDITAR EXTRAESCOLAR ===================== --}}
<div class="modal-overlay" id="modal-editar-extraescolar">
    <div class="modal-box modal-box-large">
        <div class="modal-header">
            <div class="modal-title-group">
                <i class="ri-edit-line modal-title-icon"></i>
                <h2 class="modal-title">Editar Actividad</h2>
            </div>
            <button class="modal-close-btn" id="modal-close-editar-extraescolar" title="Cerrar">
                <i class="ri-close-line"></i>
            </button>
        </div>
        <div class="modal-body">
            <div id="editar-extra-loader" style="text-align:center;padding:2rem;">
                <i class="ri-loader-4-line ri-spin" style="font-size:2rem;color:var(--naranja)"></i>
            </div>
            {{-- Banner para confirmar edición --}}
           <div id="editar-extra-lock-banner" class="editar-lock-banner" style="display:none;">
                    <i class="ri-lock-line"></i>
                    <span>Los campos están bloqueados. Haz clic en "Habilitar edición" para modificarlos.</span>
                    <button type="button" id="btn-habilitar-edicion-extra" class="btn-habilitar-edicion">
                        <i class="ri-lock-unlock-line"></i> Habilitar edición
                    </button>
                </div>

            <div id="editar-extra-content" style="display:none;">

                <form id="form-editar-extraescolar" novalidate>
                    @csrf
                    <input type="hidden" id="edit-extra-id" value="">
                    <div class="modal-section-label"><i class="ri-information-line"></i> Datos de la Actividad</div>
                    <div class="modal-grid">
                        <div class="form-group-modal modal-col-full">
                            <label for="edit-ex-nombre">Nombre <span style="color:var(--naranja)">*</span></label>
                            <input type="text" id="edit-ex-nombre" name="nombre" placeholder="Nombre" required maxlength="20" disabled>
                            <span class="error-msg-modal" id="err-edit-ex-nombre"></span>
                        </div>
                        <div class="form-group-modal">
                            <label for="edit-ex-cupo">Cupo Máximo</label>
                            <input type="number" id="edit-ex-cupo" name="cupo_maximo" min="1" disabled>
                        </div>
                        <div class="form-group-modal">
                            <label for="edit-ex-semanas">Duración (Semanas) <span style="color:var(--naranja)">*</span></label>
                            <input type="text" id="edit-ex-semanas" name="duracion_semanas" maxlength="20" required disabled>
                            <span class="error-msg-modal" id="err-edit-ex-semanas"></span>
                        </div>
                        <div class="form-group-modal">
                            <label for="edit-ex-costo">Costo Base ($)</label>
                            <input type="number" id="edit-ex-costo" name="costo_base" min="0" step="0.01" disabled>
                        </div>
                        <div class="form-group-modal">
                            <label for="edit-ex-inicio">Fecha Inicio <span style="color:var(--naranja)">*</span></label>
                            <input type="date" id="edit-ex-inicio" name="fecha_inicio" required disabled>
                            <span class="error-msg-modal" id="err-edit-ex-inicio"></span>
                        </div>
                        <div class="form-group-modal">
                            <label for="edit-ex-fin">Fecha Fin <span style="color:var(--naranja)">*</span></label>
                            <input type="date" id="edit-ex-fin" name="fecha_fin" required disabled>
                            <span class="error-msg-modal" id="err-edit-ex-fin"></span>
                        </div>
                        <div class="form-group-modal">
                            <label>Estatus</label>
                            <div class="form-dropdown" id="dropdown-edit-ex-estatus" tabindex="0">
                                <div class="form-select-trigger" id="trigger-edit-ex-estatus">
                                    <span class="selected-text" data-value="1">Activo</span>
                                    <i class="ri-arrow-down-s-line"></i>
                                </div>
                                <div class="form-options-container">
                                    <div class="form-option selected" data-value="1">Activo</div>
                                    <div class="form-option" data-value="0">Inactivo</div>
                                </div>
                                <input type="hidden" id="edit-ex-estatus" name="estatus" value="1">
                            </div>
                        </div>
                        <div class="form-group-modal">
                            <label for="edit-ex-ubicacion">Ubicación <span style="color:var(--naranja)">*</span></label>
                            <input type="text" id="edit-ex-ubicacion" name="ubicacion" maxlength="20" required disabled>
                            <span class="error-msg-modal" id="err-edit-ex-ubicacion"></span>
                        </div>
                        <div class="form-group-modal modal-col-full">
                            <label for="edit-ex-descripcion">Descripción</label>
                            <textarea id="edit-ex-descripcion" name="descripcion" rows="3" disabled
                                style="width:100%;padding:10px;border:2px solid var(--borde);border-radius:10px;font-family:'Inter',sans-serif;resize:vertical;background:#fafafa;"></textarea>
                        </div>
                        <div class="form-group-modal modal-col-full">
                            <label for="edit-ex-requisitos">Requisitos</label>
                            <textarea id="edit-ex-requisitos" name="requisitos" rows="2" disabled
                                style="width:100%;padding:10px;border:2px solid var(--borde);border-radius:10px;font-family:'Inter',sans-serif;resize:vertical;background:#fafafa;"></textarea>
                        </div>
                    </div>

                    {{-- Tabla de inscritos con opción de baja --}}
                    <div class="modal-section-label" style="margin-top:24px;"><i class="ri-group-line"></i> Alumnos Inscritos</div>
                    <div class="table-wrapper" style="max-height:240px;">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido P</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody id="edit-inscritos-tbody">
                                <tr><td colspan="5" style="text-align:center;color:var(--texto-suave);">Sin inscritos activos</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" id="btn-cancelar-editar-extra">Cancelar</button>
                        <button type="submit" class="btn-modal-submit" id="btn-submit-editar-extra" disabled>
                            <i class="ri-save-line"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
