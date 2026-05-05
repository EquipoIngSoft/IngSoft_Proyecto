{{-- ===================== PERFIL: VISTA LECTURA ===================== --}}
<div id="perfil-view-read">

    {{-- Card Avatar + Nombre --}}
    <div class="card" style="display:flex; align-items:center; gap:24px; margin-bottom:24px; padding:28px;">
        <div id="perfil-avatar-seccion"
             style="width:80px; height:80px; border-radius:50%; background:var(--naranja);
                    display:flex; align-items:center; justify-content:center;
                    font-size:32px; font-weight:700; color:#fff; flex-shrink:0;">?</div>
        <div style="flex:1;">
            <p id="perfil-nombre-seccion" style="font-size:22px; font-weight:700; color:var(--texto); margin:0;"></p>
            <p id="perfil-rol-seccion" style="font-size:13px; color:var(--texto-suave); margin:4px 0 0;"></p>
        </div>
        <button type="button" id="btn-modo-editar"
                style="display:flex; align-items:center; gap:6px; background:none;
                       border:1.5px solid var(--naranja); color:var(--naranja);
                       font-size:13px; font-weight:600; padding:8px 18px;
                       border-radius:10px; cursor:pointer; font-family:'Inter',sans-serif;">
            <i class="ri-edit-line"></i> Editar Perfil
        </button>
    </div>

    {{-- Datos Personales --}}
    <div class="card" style="margin-bottom:24px; padding:28px;">
        <div class="modal-section-label"><i class="ri-user-line"></i> Datos Personales</div>
        <div class="modal-grid" style="margin-top:16px;">
            <div class="form-group-modal">
                <label>Nombre Completo</label>
                <p class="detalle-valor" id="read-nombre-completo">—</p>
            </div>
            <div class="form-group-modal">
                <label>Correo Electrónico</label>
                <p class="detalle-valor" id="read-email">—</p>
            </div>
            <div class="form-group-modal">
                <label>Teléfono</label>
                <p class="detalle-valor" id="read-telefono">—</p>
            </div>
            <div class="form-group-modal">
                <label>Fecha de Nacimiento</label>
                <p class="detalle-valor" id="read-fecha_nacimiento">—</p>
            </div>
            <div class="form-group-modal">
                <label>Género</label>
                <p class="detalle-valor" id="read-genero">—</p>
            </div>
            <div class="form-group-modal">
                <label>Rol</label>
                <p class="detalle-valor" id="read-nombre_rol">—</p>
            </div>
        </div>
    </div>

    {{-- Dirección --}}
    <div class="card" style="margin-bottom:24px; padding:28px;">
        <div class="modal-section-label"><i class="ri-map-pin-line"></i> Dirección</div>
        <div class="modal-grid" style="margin-top:16px;">
            <div class="form-group-modal">
                <label>Estado</label>
                <p class="detalle-valor" id="read-estado_residencia">—</p>
            </div>
            <div class="form-group-modal">
                <label>Ciudad</label>
                <p class="detalle-valor" id="read-ciudad">—</p>
            </div>
            <div class="form-group-modal">
                <label>Calle</label>
                <p class="detalle-valor" id="read-calle">—</p>
            </div>
            <div class="form-group-modal">
                <label>Código Postal</label>
                <p class="detalle-valor" id="read-codigo_postal">—</p>
            </div>
        </div>
    </div>

    {{-- Seguridad --}}
    <div class="card" style="padding:28px;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:16px;">
            <div class="modal-section-label" style="margin:0;"><i class="ri-lock-password-line"></i> Seguridad</div>
            <button type="button" id="btn-cambiar-pwd"
                    style="display:flex; align-items:center; gap:6px; background:none;
                           border:1.5px solid var(--naranja); color:var(--naranja);
                           font-size:13px; font-weight:600; padding:8px 18px;
                           border-radius:10px; cursor:pointer; font-family:'Inter',sans-serif;">
                <i class="ri-lock-line"></i> Cambiar Contraseña
            </button>
        </div>

        <div id="pwd-read">
            <div class="form-group-modal">
                <label>Contraseña</label>
                <p class="detalle-valor">••••••••</p>
            </div>
        </div>

        <div id="pwd-form" style="display:none;">
            <div class="modal-grid">
                <div class="form-group-modal modal-col-full">
                    <label>Nueva Contraseña</label>
                    <input type="password" id="edit-pwd-nuevo" placeholder="Mínimo 6 caracteres">
                </div>
                <div class="form-group-modal">
                    <label>Confirmar Contraseña</label>
                    <input type="password" id="edit-pwd-confirmar" placeholder="Repite la nueva">
                </div>
            </div>
            <div id="pwd-feedback" style="display:none; font-size:13px; padding:8px 12px; border-radius:8px; margin-top:16px;"></div>
            <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:24px; padding-top:20px; border-top:1px solid var(--borde);">
                <button type="button" class="btn-modal-cancel" id="btn-cancelar-pwd">Cancelar</button>
                <button type="button" class="btn-modal-submit" id="btn-guardar-pwd">
                    <i class="ri-save-line"></i> Guardar Contraseña
                </button>
            </div>
        </div>
    </div>

</div>

{{-- ===================== PERFIL: VISTA EDICIÓN ===================== --}}
<div id="perfil-view-edit" style="display:none;">

    <div class="card" style="margin-bottom:24px; padding:28px;">
        <div class="modal-section-label"><i class="ri-user-settings-line"></i> Datos Personales</div>
        <div class="modal-grid" style="margin-top:16px;">
            <div class="form-group-modal">
                <label>Nombre <span style="color:var(--naranja)">*</span></label>
                <input type="text" id="edit-nombre" maxlength="50">
                <span class="error-msg-modal" id="err-edit-nombre"></span>
            </div>
            <div class="form-group-modal">
                <label>Apellido Paterno <span style="color:var(--naranja)">*</span></label>
                <input type="text" id="edit-apellido_p" maxlength="50">
                <span class="error-msg-modal" id="err-edit-apellido_p"></span>
            </div>
            <div class="form-group-modal">
                <label>Apellido Materno</label>
                <input type="text" id="edit-apellido_m" maxlength="50">
            </div>
            <div class="form-group-modal">
                <label>Teléfono <span style="color:var(--naranja)">*</span></label>
                <input type="tel" id="edit-telefono" maxlength="10">
                <span class="error-msg-modal" id="err-edit-telefono"></span>
            </div>
            <div class="form-group-modal modal-col-full">
                <label>Correo Electrónico <span style="color:var(--naranja)">*</span></label>
                <input type="email" id="edit-email" maxlength="100">
                <span class="error-msg-modal" id="err-edit-email"></span>
            </div>
            <div class="form-group-modal">
                <label>Fecha de Nacimiento <span style="color:var(--naranja)">*</span></label>
                <input type="date" id="edit-fecha_nacimiento">
                <span class="error-msg-modal" id="err-edit-fecha_nacimiento"></span>
            </div>
            <div class="form-group-modal">
                <label>Género <span style="color:var(--naranja)">*</span></label>
                <div class="form-dropdown" id="dropdown-edit-genero" tabindex="0">
                    <div class="form-select-trigger">
                        <span class="selected-text" data-value="">Selecciona...</span>
                        <i class="ri-arrow-down-s-line"></i>
                    </div>
                    <div class="form-options-container">
                        <div class="form-option" data-value="m">Masculino</div>
                        <div class="form-option" data-value="f">Femenino</div>
                        <div class="form-option" data-value="o">Otro</div>
                    </div>
                    <input type="hidden" id="edit-genero" value="">
                </div>
                <span class="error-msg-modal" id="err-edit-genero"></span>
            </div>
            <div class="form-group-modal">
                <label>Estado <span style="color:var(--naranja)">*</span></label>
                @include('admin.partials.dropdown-estados', ['prefix' => 'edit'])
                <span class="error-msg-modal" id="err-edit-estado_residencia"></span>
            </div>
            <div class="form-group-modal">
                <label>Ciudad <span style="color:var(--naranja)">*</span></label>
                <input type="text" id="edit-ciudad" maxlength="50">
                <span class="error-msg-modal" id="err-edit-ciudad"></span>
            </div>
            <div class="form-group-modal">
                <label>Calle <span style="color:var(--naranja)">*</span></label>
                <input type="text" id="edit-calle" maxlength="50">
                <span class="error-msg-modal" id="err-edit-calle"></span>
            </div>
            <div class="form-group-modal">
                <label>Código Postal <span style="color:var(--naranja)">*</span></label>
                <input type="text" id="edit-codigo_postal" maxlength="5">
                <span class="error-msg-modal" id="err-edit-codigo_postal"></span>
            </div>
        </div>

        <div id="perfil-feedback"
             style="display:none; font-size:13px; padding:8px 12px;
                    border-radius:8px; margin-top:16px;"></div>

        <div style="display:flex; justify-content:flex-end; gap:12px;
                    margin-top:24px; padding-top:20px; border-top:1px solid var(--borde);">
            <button type="button" class="btn-modal-cancel" id="btn-cancelar-edicion">Cancelar</button>
            <button type="button" class="btn-modal-submit" id="btn-guardar-perfil">
                <i class="ri-save-line"></i> Guardar Cambios
            </button>
        </div>
    </div>

</div>