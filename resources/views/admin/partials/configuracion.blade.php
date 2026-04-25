{{-- Vista de lectura --}}
<div id="perfil-view-read">
    <div class="card" style="margin-bottom: 24px;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;">
            <div style="display:flex; align-items:center; gap:16px;">
                <div id="perfil-avatar-seccion"
                     style="width:64px; height:64px; border-radius:50%; background:var(--naranja);
                            display:flex; align-items:center; justify-content:center;
                            font-size:24px; font-weight:700; color:#fff; flex-shrink:0;">
                    ?
                </div>
                <div>
                    <p id="perfil-nombre-seccion"
                       style="font-size:18px; font-weight:700; color:var(--texto); margin:0;"></p>
                    <p id="perfil-rol-seccion"
                       style="font-size:13px; color:var(--texto-suave); margin:4px 0 0;"></p>
                </div>
            </div>
            <button type="button" id="btn-modo-editar"
                    style="display:flex; align-items:center; gap:6px; background:none;
                           border:1.5px solid var(--naranja); color:var(--naranja);
                           font-size:13px; font-weight:600; padding:8px 18px;
                           border-radius:10px; cursor:pointer; font-family:'Inter',sans-serif;
                           transition: background-color 0.2s;">
                <i class="ri-edit-line"></i> Editar Perfil
            </button>
        </div>

        <div class="modal-section-label">
            <i class="ri-user-line"></i> Datos Personales
        </div>
        <div class="modal-grid" style="margin-bottom:24px;">
            <div class="form-group-modal">
                <label>Nombre</label>
                <p class="detalle-valor" id="read-nombre">—</p>
            </div>
            <div class="form-group-modal">
                <label>Apellido paterno</label>
                <p class="detalle-valor" id="read-apellido_p">—</p>
            </div>
            <div class="form-group-modal">
                <label>Apellido materno</label>
                <p class="detalle-valor" id="read-apellido_m">—</p>
            </div>
            <div class="form-group-modal">
                <label>Teléfono</label>
                <p class="detalle-valor" id="read-telefono">—</p>
            </div>
            <div class="form-group-modal modal-col-full">
                <label>Correo electrónico</label>
                <p class="detalle-valor" id="read-email">—</p>
            </div>
            <div class="form-group-modal">
                <label>Fecha de nacimiento</label>
                <p class="detalle-valor" id="read-fecha_nacimiento">—</p>
            </div>
            <div class="form-group-modal">
                <label>Género</label>
                <p class="detalle-valor" id="read-genero">—</p>
            </div>
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
                <label>Código postal</label>
                <p class="detalle-valor" id="read-codigo_postal">—</p>
            </div>
            <div class="form-group-modal">
                <label>Rol</label>
                <p class="detalle-valor" id="read-nombre_rol">—</p>
            </div>
            <div class="form-group-modal modal-col-full">
                <label>Contraseña</label>
                <p class="detalle-valor">••••••••</p>
            </div>
        </div>
    </div>
</div>

{{-- Vista de edición --}}
<div id="perfil-view-edit" style="display:none;">
    <div class="card">

        <div class="modal-section-label">
            <i class="ri-edit-line"></i> Datos personales
        </div>
        <div class="modal-grid">
            <div class="form-group-modal">
                <label>Nombre <span style="color:var(--naranja)">*</span></label>
                <input type="text" id="edit-nombre" maxlength="50">
                <span class="error-msg-modal" id="err-edit-nombre"></span>
            </div>
            <div class="form-group-modal">
                <label>Apellido paterno <span style="color:var(--naranja)">*</span></label>
                <input type="text" id="edit-apellido_p" maxlength="50">
                <span class="error-msg-modal" id="err-edit-apellido_p"></span>
            </div>
            <div class="form-group-modal">
                <label>Apellido materno</label>
                <input type="text" id="edit-apellido_m" maxlength="50">
            </div>
            <div class="form-group-modal">
                <label>Teléfono <span style="color:var(--naranja)">*</span></label>
                <input type="tel" id="edit-telefono" maxlength="10">
                <span class="error-msg-modal" id="err-edit-telefono"></span>
            </div>
            <div class="form-group-modal modal-col-full">
                <label>Correo electrónico <span style="color:var(--naranja)">*</span></label>
                <input type="email" id="edit-email" maxlength="100">
                <span class="error-msg-modal" id="err-edit-email"></span>
            </div>
            <div class="form-group-modal">
                <label>Fecha de nacimiento <span style="color:var(--naranja)">*</span></label>
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

            {{-- Campos de dirección --}}
            <div class="form-group-modal">
                <label>Estado <span style="color:var(--naranja)">*</span></label>
              @include('admin.partials.dropdown-estados', ['prefix' => 'edit'])
{{-- El partial genera: id="dropdown-edit-estado" y id="edit-estado" --}}
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
                <label>Código postal <span style="color:var(--naranja)">*</span></label>
                <input type="text" id="edit-codigo_postal" maxlength="5">
                <span class="error-msg-modal" id="err-edit-codigo_postal"></span>
            </div>
        </div>

        <div class="modal-section-label" style="margin-top:24px;">
            <i class="ri-lock-password-line"></i> Cambiar contraseña
            <span style="font-size:10px; font-weight:400; color:var(--texto-suave);
                         text-transform:none; letter-spacing:0; margin-left:6px;">
                (opcional — déjalo vacío si no quieres cambiarla)
            </span>
        </div>
        <div class="modal-grid">
            <div class="form-group-modal modal-col-full">
                <label>Contraseña antigua</label>
                <input type="password" id="edit-pwd-antiguo" placeholder="Tu contraseña actual">
                <span class="error-msg-modal" id="err-edit-pwd-antiguo"></span>
            </div>
            <div class="form-group-modal">
                <label>Nueva contraseña</label>
                <input type="password" id="edit-pwd-nuevo" placeholder="Mínimo 6 caracteres">
            </div>
            <div class="form-group-modal">
                <label>Confirmar contraseña</label>
                <input type="password" id="edit-pwd-confirmar" placeholder="Repite la nueva">
            </div>
        </div>

        <div id="perfil-feedback"
             style="display:none; font-size:13px; padding:8px 12px;
                    border-radius:8px; margin-top:16px;"></div>

        <div style="display:flex; justify-content:flex-end; gap:12px;
                    margin-top:24px; padding-top:20px; border-top:1px solid var(--borde);">
            <button type="button" class="btn-modal-cancel" id="btn-cancelar-edicion">
                Cancelar
            </button>
            <button type="button" class="btn-modal-submit" id="btn-guardar-perfil">
                <i class="ri-save-line"></i> Guardar cambios
            </button>
        </div>

    </div>
</div>