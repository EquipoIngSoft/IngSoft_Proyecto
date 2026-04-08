<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - EGAU Chess</title>
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Iconos (Remix Icons) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Hojas de estilos -->
    <link rel="stylesheet" href="{{ asset('css/admin/dashboardAdmin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboardAdminPersonal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboardAdminAlumnos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboardAdminProfesores.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboardAdminSede.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboardAdminGrupos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboardAdminExtraescolares.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboardAdminNiveles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/dashboardAdminRoles.css') }}">
</head>

<body>

    <!-- ===================== SIDEBAR ===================== -->
    <aside class="sidebar" id="sidebar">

        <!-- Logo / Nombre -->
        <div class="sidebar-logo">
            <img src="{{ asset('Logos/LogoEgau.png') }}" alt="EGAU Chess" class="sidebar-logo-img">
            <span class="sidebar-brand">EGAU Chess</span>
        </div>

        <!-- Navegación -->
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item active" data-section="alumnos">
                    <a href="#">
                        <i class="ri-group-line"></i>
                        <span>Alumnos</span>
                    </a>
                </li>
                <li class="nav-item" data-section="profesores">
                    <a href="#">
                        <i class="ri-user-star-line"></i>
                        <span>Profesores</span>
                    </a>
                </li>
                <li class="nav-item" data-section="personal">
                    <a href="#">
                        <i class="ri-user-settings-line"></i>
                        <span>Personal</span>
                    </a>
                </li>
                <li class="nav-item" data-section="roles">
                    <a href="#">
                        <i class="ri-shield-user-line"></i>
                        <span>Roles</span>
                    </a>
                </li>
                <li class="nav-item" data-section="sede">
                    <a href="#">
                        <i class="ri-map-pin-line"></i>
                        <span>Sede</span>
                    </a>
                </li>
                <li class="nav-item" data-section="grupos">
                    <a href="#">
                        <i class="ri-grid-line"></i>
                        <span>Grupos</span>
                    </a>
                </li>
                <li class="nav-item" data-section="extraescolares">
                    <a href="#">
                        <i class="ri-bar-chart-2-line"></i>
                        <span>Extraescolares</span>
                    </a>
                </li>
                <li class="nav-item" data-section="status">
                    <a href="#">
                        <i class="ri-bookmark-line"></i>
                        <span>Status</span>
                    </a>
                </li>
                <li class="nav-item" data-section="pagos">
                    <a href="#">
                        <i class="ri-bank-card-line"></i>
                        <span>Pagos</span>
                    </a>
                </li>
                <li class="nav-item" data-section="niveles">
                    <a href="#">
                        <i class="ri-book-open-line"></i>
                        <span>Niveles</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Opciones al fondo -->
        <div class="sidebar-footer">
            <a href="#" class="nav-footer-item nav-item" data-section="opciones">
                <i class="ri-settings-3-line"></i>
                <span>Opciones</span>
            </a>
        </div>

    </aside>

    <!-- ===================== CONTENIDO PRINCIPAL ===================== -->
    <main class="main-content">

        <!-- Topbar -->
        <header class="topbar">
            <!-- Botón hamburguesa -->
            <button class="menu-toggle" id="menu-toggle" title="Ocultar/Mostrar menú">
                <i class="ri-menu-line"></i>
            </button>
            <div class="topbar-right">
                <div class="profile-menu-wrapper" id="profile-menu">
                    <!-- Área clickeable (Nombre + Círculo) -->
                    <div class="profile-trigger">
                        <span class="admin-name">Administrador</span>
                        <div class="avatar">A</div>
                    </div>

                    <!-- Menú desplegable flotante -->
                    <div class="profile-dropdown">
                        <div class="profile-header">
                            <span class="profile-name">Administrador</span>
                            <span class="profile-email">admin@egau.com</span>
                        </div>
                        <ul class="profile-options">
                            <li id="btn-config-perfil"><i class="ri-settings-3-line"></i> Configuración</li>
                            <li id="btn-logout" class="text-danger"><i class="ri-logout-box-r-line"></i> Cerrar sesión
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- Área de sección activa: PERSONAL -->
        <section class="section-content" id="section-personal" style="display: none;">

            <!-- Cabecera de sección -->
            <div class="section-header">
                <h1 class="section-title">Gestión de Personal</h1>
                <button class="btn-primary" id="btn-agregar-personal">
                    <i class="ri-add-line"></i> Agregar Personal
                </button>
            </div>

            <!-- Tarjeta de tabla -->
            <div class="card">

                <!-- Cabecera de controles: Búsqueda y Filtros -->
                <div class="controls-container">
                    <!-- Buscador -->
                    <div class="search-bar">
                        <i class="ri-search-line search-icon"></i>
                        <input type="text" id="buscador-personal" placeholder="Buscar personal..." autocomplete="off">
                    </div>

                    <!-- Filtros -->
                    <div class="filters-row">
                        <!-- Rol -->
                        <div class="select-wrapper custom-dropdown" id="dropdown-nivel-personal">
                            <div class="custom-select-trigger">
                                <span class="selected-text" data-value="">Todos los roles</span>
                                <i class="ri-arrow-down-s-line"></i>
                            </div>
                            <div class="custom-options-container">
                                <div class="custom-option selected" data-value="">Todos los roles</div>
                                <div class="custom-option" data-value="administrativo">Administrativo</div>
                                <div class="custom-option" data-value="mantenimiento">Mantenimiento</div>
                                <div class="custom-option" data-value="seguridad">Seguridad</div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="select-wrapper custom-dropdown" id="dropdown-status-personal">
                            <div class="custom-select-trigger">
                                <span class="selected-text" data-value="">Todos los estatus</span>
                                <i class="ri-arrow-down-s-line"></i>
                            </div>
                            <div class="custom-options-container">
                                <div class="custom-option selected" data-value="">Todos los estatus</div>
                                <div class="custom-option" data-value="activo">Activo</div>
                                <div class="custom-option" data-value="inactivo">Inactivo</div>
                            </div>
                        </div>

                        <!-- Sede -->
                        <div class="select-wrapper custom-dropdown" id="dropdown-sede-personal">
                            <div class="custom-select-trigger">
                                <span class="selected-text" data-value="">Todas las sedes</span>
                                <i class="ri-arrow-down-s-line"></i>
                            </div>
                            <div class="custom-options-container">
                                <div class="custom-option selected" data-value="">Todas las sedes</div>
                                <div class="custom-option" data-value="sede central">Sede Central</div>
                                <div class="custom-option" data-value="sede norte">Sede Norte</div>
                            </div>
                        </div>

                        <button id="btn-limpiar-personal" class="btn-clear-filters">
                            Limpiar filtros
                        </button>
                    </div>
                </div>

                <!-- Tabla -->
                <div class="table-wrapper">
                    <table class="data-table" id="tabla-personal">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Rol</th>
                                <th>Sede</th>
                                <th>Status</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Roberto Sánchez</td>
                                <td>Administrativo</td>
                                <td>Sede Central</td>
                                <td><span class="badge badge-activo">Activo</span></td>
                                <td class="acciones">
                                    <button class="btn-icon btn-ver" title="Ver"><i class="ri-eye-line"></i></button>
                                    <button class="btn-icon btn-editar" title="Editar"><i
                                            class="ri-edit-line"></i></button>
                                    <button class="btn-icon btn-eliminar" title="Eliminar"><i
                                            class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="pagination">
                    <div class="pagination-info">Mostrando 1 resultado</div>
                    <div class="pagination-btns">
                        <button class="pag-btn" disabled><i class="ri-arrow-left-s-line"></i></button>
                        <button class="pag-btn active">1</button>
                        <button class="pag-btn" disabled><i class="ri-arrow-right-s-line"></i></button>
                    </div>
                </div>

            </div><!-- /card -->
        </section>

        <!-- Área de sección activa: ROLES -->
        <section class="section-content" id="section-roles" style="display: none;">

            <!-- Cabecera de sección -->
            <div class="section-header">
                <h1 class="section-title">Gestión de Roles</h1>
                <button class="btn-primary" id="btn-agregar-rol">
                    <i class="ri-add-line"></i> Agregar Rol
                </button>
            </div>

            <!-- Tarjeta de tabla -->
            <div class="card">

                <!-- Cabecera de controles: Búsqueda y Filtros -->
                <div class="controls-container">
                    <!-- Buscador -->
                    <div class="search-bar">
                        <i class="ri-search-line search-icon"></i>
                        <input type="text" id="buscador-roles" placeholder="Buscar roles por nombre o ID..."
                            autocomplete="off">
                    </div>

                    <!-- Filtros -->
                    <div class="filters-row">
                        <!-- Status -->
                        <div class="select-wrapper custom-dropdown" id="dropdown-status-roles">
                            <div class="custom-select-trigger">
                                <span class="selected-text" data-value="">Todos los estatus</span>
                                <i class="ri-arrow-down-s-line"></i>
                            </div>
                            <div class="custom-options-container">
                                <div class="custom-option selected" data-value="">Todos los estatus</div>
                                <div class="custom-option" data-value="activo">Activo</div>
                                <div class="custom-option" data-value="inactivo">Inactivo</div>
                            </div>
                        </div>

                        <button id="btn-limpiar-roles" class="btn-clear-filters">
                            Limpiar filtros
                        </button>
                    </div>
                </div>

                <!-- Tabla -->
                <div class="table-wrapper">
                    <table class="data-table" id="tabla-roles">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Administrador</td>
                                <td>
                                    <div class="role-description">Acceso total al sistema, gestión de sedes, personal y
                                        configuración avanzada.</div>
                                </td>
                                <td><span class="badge badge-rol-activo">Activo</span></td>
                                <td class="acciones">
                                    <button class="btn-icon btn-ver" title="Ver"><i class="ri-eye-line"></i></button>
                                    <button class="btn-icon btn-editar" title="Editar"><i
                                            class="ri-edit-line"></i></button>
                                    <button class="btn-icon btn-eliminar" title="Eliminar"><i
                                            class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Editor Académico</td>
                                <td>
                                    <div class="role-description">Gestión de alumnos, grupos, niveles y extraescolares.
                                        Sin acceso a finanzas.</div>
                                </td>
                                <td><span class="badge badge-rol-activo">Activo</span></td>
                                <td class="acciones">
                                    <button class="btn-icon btn-ver" title="Ver"><i class="ri-eye-line"></i></button>
                                    <button class="btn-icon btn-editar" title="Editar"><i
                                            class="ri-edit-line"></i></button>
                                    <button class="btn-icon btn-eliminar" title="Eliminar"><i
                                            class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Consultor</td>
                                <td>
                                    <div class="role-description">Acceso de solo lectura para reportes y visualización
                                        de datos generales.</div>
                                </td>
                                <td><span class="badge badge-rol-inactivo">Inactivo</span></td>
                                <td class="acciones">
                                    <button class="btn-icon btn-ver" title="Ver"><i class="ri-eye-line"></i></button>
                                    <button class="btn-icon btn-editar" title="Editar"><i
                                            class="ri-edit-line"></i></button>
                                    <button class="btn-icon btn-eliminar" title="Eliminar"><i
                                            class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="pagination">
                    <div class="pagination-info">Mostrando 3 resultados</div>
                    <div class="pagination-btns">
                        <button class="pag-btn" disabled><i class="ri-arrow-left-s-line"></i></button>
                        <button class="pag-btn active">1</button>
                        <button class="pag-btn" disabled><i class="ri-arrow-right-s-line"></i></button>
                    </div>
                </div>

            </div><!-- /card -->
        </section>

        <!-- Área de sección activa: ALUMNOS -->
        <section class="section-content" id="section-alumnos">

            <!-- Cabecera de sección -->
            <div class="section-header">
                <h1 class="section-title">Gestión de Alumnos</h1>
                <button class="btn-primary" id="btn-agregar">
                    <i class="ri-add-line"></i> Agregar Alumno
                </button>
            </div>

            <!-- Tarjeta de tabla -->
            <div class="card">

                <!-- Cabecera de controles: Búsqueda y Filtros -->
                <div class="controls-container">
                    <!-- Buscador -->
                    <div class="search-bar">
                        <i class="ri-search-line search-icon"></i>
                        <input type="text" id="buscador" placeholder="Buscar alumno..." autocomplete="off">
                    </div>

                    <!-- Filtros -->
                    <div class="filters-row">
                        <!-- Nivel -->
                        <div class="select-wrapper custom-dropdown" id="dropdown-nivel">
                            <div class="custom-select-trigger">
                                <span class="selected-text" data-value="">Todos los niveles</span>
                                <i class="ri-arrow-down-s-line"></i>
                            </div>
                            <div class="custom-options-container">
                                <div class="custom-option selected" data-value="">Todos los niveles</div>
                                <div class="custom-option" data-value="principiante">Principiante</div>
                                <div class="custom-option" data-value="intermedio">Intermedio</div>
                                <div class="custom-option" data-value="avanzado">Avanzado</div>
                            </div>
                        </div>

                        <!-- Sede -->
                        <div class="select-wrapper custom-dropdown" id="dropdown-sede">
                            <div class="custom-select-trigger">
                                <span class="selected-text" data-value="">Todas las sedes</span>
                                <i class="ri-arrow-down-s-line"></i>
                            </div>
                            <div class="custom-options-container">
                                <div class="custom-option selected" data-value="">Todas las sedes</div>
                                <div class="custom-option" data-value="sede central">Sede Central</div>
                                <div class="custom-option" data-value="sede norte">Sede Norte</div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="select-wrapper custom-dropdown" id="dropdown-status">
                            <div class="custom-select-trigger">
                                <span class="selected-text" data-value="">Todos los estatus</span>
                                <i class="ri-arrow-down-s-line"></i>
                            </div>
                            <div class="custom-options-container">
                                <div class="custom-option selected" data-value="">Todos los estatus</div>
                                <div class="custom-option" data-value="activo">Activo</div>
                                <div class="custom-option" data-value="inactivo">Inactivo</div>
                            </div>
                        </div>

                        <button id="btn-limpiar" class="btn-clear-filters">
                            Limpiar filtros
                        </button>
                    </div>
                </div>

                <!-- Tabla -->
                <div class="table-wrapper">
                    <table class="data-table" id="tabla-alumnos">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Nivel</th>
                                <th>Sede</th>
                                <th>Status</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Ana García Martínez</td>
                                <td>10</td>
                                <td><span class="badge badge-principiante">Principiante</span></td>
                                <td>Sede Central</td>
                                <td><span class="badge badge-activo">Activo</span></td>
                                <td class="acciones">
                                    <button class="btn-icon btn-ver" title="Ver"><i class="ri-eye-line"></i></button>
                                    <button class="btn-icon btn-editar" title="Editar"><i
                                            class="ri-edit-line"></i></button>
                                    <button class="btn-icon btn-eliminar" title="Eliminar"><i
                                            class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Carlos López Hernández</td>
                                <td>12</td>
                                <td><span class="badge badge-intermedio">Intermedio</span></td>
                                <td>Sede Norte</td>
                                <td><span class="badge badge-activo">Activo</span></td>
                                <td class="acciones">
                                    <button class="btn-icon btn-ver" title="Ver"><i class="ri-eye-line"></i></button>
                                    <button class="btn-icon btn-editar" title="Editar"><i
                                            class="ri-edit-line"></i></button>
                                    <button class="btn-icon btn-eliminar" title="Eliminar"><i
                                            class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>María Rodríguez Pérez</td>
                                <td>9</td>
                                <td><span class="badge badge-principiante">Principiante</span></td>
                                <td>Sede Central</td>
                                <td><span class="badge badge-activo">Activo</span></td>
                                <td class="acciones">
                                    <button class="btn-icon btn-ver" title="Ver"><i class="ri-eye-line"></i></button>
                                    <button class="btn-icon btn-editar" title="Editar"><i
                                            class="ri-edit-line"></i></button>
                                    <button class="btn-icon btn-eliminar" title="Eliminar"><i
                                            class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Juan Sánchez Torres</td>
                                <td>11</td>
                                <td><span class="badge badge-avanzado">Avanzado</span></td>
                                <td>Sede Norte</td>
                                <td><span class="badge badge-activo">Activo</span></td>
                                <td class="acciones">
                                    <button class="btn-icon btn-ver" title="Ver"><i class="ri-eye-line"></i></button>
                                    <button class="btn-icon btn-editar" title="Editar"><i
                                            class="ri-edit-line"></i></button>
                                    <button class="btn-icon btn-eliminar" title="Eliminar"><i
                                            class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Laura Fernández Ruiz</td>
                                <td>10</td>
                                <td><span class="badge badge-intermedio">Intermedio</span></td>
                                <td>Sede Norte</td>
                                <td><span class="badge badge-activo">Activo</span></td>
                                <td class="acciones">
                                    <button class="btn-icon btn-ver" title="Ver"><i class="ri-eye-line"></i></button>
                                    <button class="btn-icon btn-editar" title="Editar"><i
                                            class="ri-edit-line"></i></button>
                                    <button class="btn-icon btn-eliminar" title="Eliminar"><i
                                            class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Diego Morales Vega</td>
                                <td>13</td>
                                <td><span class="badge badge-avanzado">Avanzado</span></td>
                                <td>Sede Central</td>
                                <td><span class="badge badge-inactivo">Inactivo</span></td>
                                <td class="acciones">
                                    <button class="btn-icon btn-ver" title="Ver"><i class="ri-eye-line"></i></button>
                                    <button class="btn-icon btn-editar" title="Editar"><i
                                            class="ri-edit-line"></i></button>
                                    <button class="btn-icon btn-eliminar" title="Eliminar"><i
                                            class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="pagination">
                    <div class="pagination-btns">
                        <button class="pag-btn" disabled><i class="ri-arrow-left-s-line"></i></button>
                        <button class="pag-btn active">1</button>
                        <button class="pag-btn"><i class="ri-arrow-right-s-line"></i></button>
                    </div>
                </div>

            </div><!-- /card -->
        </section>

        <!-- ===================== MODAL: AGREGAR PERSONAL ===================== -->
        <div class="modal-overlay" id="modal-agregar-personal">
            <div class="modal-box">

                <!-- Cabecera del modal -->
                <div class="modal-header">
                    <div class="modal-title-group">
                        <i class="ri-user-add-line modal-title-icon"></i>
                        <h2 class="modal-title">Agregar Personal</h2>
                    </div>
                    <button class="modal-close-btn" id="modal-close-personal" title="Cerrar">
                        <i class="ri-close-line"></i>
                    </button>
                </div>

                <!-- Cuerpo del modal con scroll -->
                <div class="modal-body">
                    <form id="form-agregar-personal" novalidate>

                        <div class="modal-section-label">
                            <i class="ri-id-card-line"></i> Información del Personal
                        </div>

                        <div class="modal-grid">
                            <div class="form-group-modal">
                                <label for="pe-nombre">Nombre <span style="color:var(--naranja)">*</span></label>
                                <input type="text" id="pe-nombre" name="pe_nombre" placeholder="Nombre(s)" required>
                                <span class="error-msg-modal" id="err-pe-nombre"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="pe-ap-paterno">Apellido Paterno <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="text" id="pe-ap-paterno" name="pe_ap_paterno"
                                    placeholder="Apellido paterno" required>
                                <span class="error-msg-modal" id="err-pe-ap-paterno"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="pe-ap-materno">Apellido Materno</label>
                                <input type="text" id="pe-ap-materno" name="pe_ap_materno"
                                    placeholder="Apellido materno">
                            </div>
                            <div class="form-group-modal">
                                <label for="pe-fecha-nacimiento">Fecha de Nacimiento <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="date" id="pe-fecha-nacimiento" name="pe_fecha_nacimiento" required>
                                <span class="error-msg-modal" id="err-pe-fecha-nacimiento"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="pe-telefono">Número de Teléfono</label>
                                <input type="tel" id="pe-telefono" name="pe_telefono" placeholder="10 dígitos"
                                    maxlength="10">
                                <span class="error-msg-modal" id="err-pe-telefono"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="pe-genero">Género</label>
                                <div class="form-dropdown" id="dropdown-pe-genero" tabindex="0">
                                    <div class="form-select-trigger">
                                        <span class="selected-text" data-value="">Selecciona una opción</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container">
                                        <div class="form-option" data-value="F">Femenino (F)</div>
                                        <div class="form-option" data-value="M">Masculino (M)</div>
                                        <div class="form-option" data-value="O">Otro (O)</div>
                                    </div>
                                    <input type="hidden" id="pe-genero" name="pe_genero" value="">
                                </div>
                                <span class="error-msg-modal" id="err-pe-genero"></span>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="pe-sede">Sede <span style="color:var(--naranja)">*</span></label>
                                <div class="form-dropdown" id="dropdown-pe-sede" tabindex="0">
                                    <div class="form-select-trigger">
                                        <span class="selected-text" data-value="">Selecciona una sede</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container">
                                        <div class="form-option" data-value="sede central">Sede Central</div>
                                        <div class="form-option" data-value="sede norte">Sede Norte</div>
                                    </div>
                                    <input type="hidden" id="pe-sede" name="pe_sede" value="">
                                </div>
                                <span class="error-msg-modal" id="err-pe-sede"></span>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="pe-rol">Rol <span style="color:var(--naranja)">*</span></label>
                                <div class="form-dropdown" id="dropdown-pe-rol" tabindex="0">
                                    <div class="form-select-trigger">
                                        <span class="selected-text" data-value="">Selecciona una opción</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container">
                                        <div class="form-option" data-value="administrativo">Administrativo</div>
                                        <div class="form-option" data-value="mantenimiento">Mantenimiento</div>
                                        <div class="form-option" data-value="seguridad">Seguridad</div>
                                    </div>
                                    <input type="hidden" id="pe-rol" name="pe_rol" value="">
                                </div>
                                <span class="error-msg-modal" id="err-pe-rol"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="pe-estado">Estado <span style="color:var(--naranja)">*</span></label>
                                <div class="form-dropdown" id="dropdown-pe-estado" tabindex="0">
                                    <div class="form-select-trigger">
                                        <span class="selected-text" data-value="">Selecciona un estado</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container" style="max-height: 200px; overflow-y: auto;">
                                        <div class="form-option" data-value="Aguascalientes">Aguascalientes</div>
                                        <div class="form-option" data-value="Baja California">Baja California</div>
                                        <div class="form-option" data-value="Baja California Sur">Baja California Sur
                                        </div>
                                        <div class="form-option" data-value="Campeche">Campeche</div>
                                        <div class="form-option" data-value="Chiapas">Chiapas</div>
                                        <div class="form-option" data-value="Chihuahua">Chihuahua</div>
                                        <div class="form-option" data-value="Ciudad de México">Ciudad de México</div>
                                        <div class="form-option" data-value="Coahuila">Coahuila</div>
                                        <div class="form-option" data-value="Colima">Colima</div>
                                        <div class="form-option" data-value="Durango">Durango</div>
                                        <div class="form-option" data-value="Estado de México">Estado de México</div>
                                        <div class="form-option" data-value="Guanajuato">Guanajuato</div>
                                        <div class="form-option" data-value="Guerrero">Guerrero</div>
                                        <div class="form-option" data-value="Hidalgo">Hidalgo</div>
                                        <div class="form-option" data-value="Jalisco">Jalisco</div>
                                        <div class="form-option" data-value="Michoacán">Michoacán</div>
                                        <div class="form-option" data-value="Morelos">Morelos</div>
                                        <div class="form-option" data-value="Nayarit">Nayarit</div>
                                        <div class="form-option" data-value="Nuevo León">Nuevo León</div>
                                        <div class="form-option" data-value="Oaxaca">Oaxaca</div>
                                        <div class="form-option" data-value="Puebla">Puebla</div>
                                        <div class="form-option" data-value="Querétaro">Querétaro</div>
                                        <div class="form-option" data-value="Quintana Roo">Quintana Roo</div>
                                        <div class="form-option" data-value="San Luis Potosí">San Luis Potosí</div>
                                        <div class="form-option" data-value="Sinaloa">Sinaloa</div>
                                        <div class="form-option" data-value="Sonora">Sonora</div>
                                        <div class="form-option" data-value="Tabasco">Tabasco</div>
                                        <div class="form-option" data-value="Tamaulipas">Tamaulipas</div>
                                        <div class="form-option" data-value="Tlaxcala">Tlaxcala</div>
                                        <div class="form-option" data-value="Veracruz">Veracruz</div>
                                        <div class="form-option" data-value="Yucatán">Yucatán</div>
                                        <div class="form-option" data-value="Zacatecas">Zacatecas</div>
                                    </div>
                                    <input type="hidden" id="pe-estado" name="pe_estado" value="">
                                </div>
                                <span class="error-msg-modal" id="err-pe-estado"></span>
                            </div>
                            <div class="form-group-modal">
                                <div style="display: flex; gap: 1rem;">
                                    <div style="flex: 2;">
                                        <label for="pe-ciudad">Ciudad <span
                                                style="color:var(--naranja)">*</span></label>
                                        <input type="text" id="pe-ciudad" name="pe_ciudad" placeholder="Ciudad"
                                            required>
                                        <span class="error-msg-modal" id="err-pe-ciudad"></span>
                                    </div>
                                    <div style="flex: 1;">
                                        <label for="pe-cp">CP <span style="color:var(--naranja)">*</span></label>
                                        <input type="text" id="pe-cp" name="pe_cp" placeholder="CP" maxlength="5"
                                            required>
                                        <span class="error-msg-modal" id="err-pe-cp"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="pe-calle">Calle y Número <span style="color:var(--naranja)">*</span></label>
                                <input type="text" id="pe-calle" name="pe_calle" placeholder="Calle, número, colonia..."
                                    required>
                                <span class="error-msg-modal" id="err-pe-calle"></span>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="pe-correo">Correo Electrónico <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="email" id="pe-correo" name="pe_correo" placeholder="correo@ejemplo.com"
                                    required>
                                <span class="error-msg-modal" id="err-pe-correo"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="pe-password">Contraseña <span style="color:var(--naranja)">*</span></label>
                                <div class="input-password-wrapper">
                                    <input type="password" id="pe-password" name="pe_password"
                                        placeholder="Mínimo 6 caracteres" required>
                                    <button type="button" class="toggle-password" data-target="pe-password">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                </div>
                                <span class="error-msg-modal" id="err-pe-password"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="pe-password-confirm">Confirmar Contraseña <span
                                        style="color:var(--naranja)">*</span></label>
                                <div class="input-password-wrapper">
                                    <input type="password" id="pe-password-confirm" name="pe_password_confirm"
                                        placeholder="Repite la contraseña" required>
                                    <button type="button" class="toggle-password" data-target="pe-password-confirm">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                </div>
                                <span class="error-msg-modal" id="err-pe-password-confirm"></span>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn-modal-cancel"
                                id="btn-cancelar-modal-personal">Cancelar</button>
                            <button type="submit" class="btn-modal-submit">
                                <i class="ri-save-line"></i> Guardar Personal
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- ===================== MODAL: AGREGAR ALUMNO ===================== -->
        <div class="modal-overlay" id="modal-agregar-alumno">
            <div class="modal-box">

                <!-- Cabecera del modal -->
                <div class="modal-header">
                    <div class="modal-title-group">
                        <i class="ri-user-add-line modal-title-icon"></i>
                        <h2 class="modal-title">Agregar Alumno</h2>
                    </div>
                    <button class="modal-close-btn" id="modal-close-alumno" title="Cerrar">
                        <i class="ri-close-line"></i>
                    </button>
                </div>

                <!-- Cuerpo del modal con scroll -->
                <div class="modal-body">
                    <form id="form-agregar-alumno" novalidate>

                        <!-- ===== SECCIÓN: Datos del Alumno ===== -->
                        <div class="modal-section-label">
                            <i class="ri-graduation-cap-line"></i> Datos del Alumno
                        </div>

                        <div class="modal-grid">
                            <div class="form-group-modal">
                                <label for="al-nombre">Nombre</label>
                                <input type="text" id="al-nombre" name="al_nombre" placeholder="Nombre(s)" required>
                                <span class="error-msg-modal" id="err-al-nombre"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="al-ap-paterno">Apellido Paterno</label>
                                <input type="text" id="al-ap-paterno" name="al_ap_paterno"
                                    placeholder="Apellido paterno" required>
                                <span class="error-msg-modal" id="err-al-ap-paterno"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="al-ap-materno">Apellido Materno</label>
                                <input type="text" id="al-ap-materno" name="al_ap_materno"
                                    placeholder="Apellido materno">
                            </div>
                            <div class="form-group-modal">
                                <label for="al-fecha-nacimiento">Fecha de Nacimiento <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="date" id="al-fecha-nacimiento" name="al_fecha_nacimiento" required>
                                <span class="error-msg-modal" id="err-al-fecha-nacimiento"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="al-telefono">Número de Teléfono</label>
                                <input type="tel" id="al-telefono" name="al_telefono" placeholder="10 dígitos"
                                    maxlength="10">
                                <span class="error-msg-modal" id="err-al-telefono"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="al-genero">Género</label>
                                <div class="form-dropdown" id="dropdown-al-genero" tabindex="0">
                                    <div class="form-select-trigger" id="trigger-al-genero">
                                        <span class="selected-text" data-value="">Selecciona una opción</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container">
                                        <div class="form-option" data-value="F">Femenino (F)</div>
                                        <div class="form-option" data-value="M">Masculino (M)</div>
                                        <div class="form-option" data-value="O">Otro (O)</div>
                                    </div>
                                    <input type="hidden" id="al-genero" name="al_genero" value="">
                                </div>
                                <span class="error-msg-modal" id="err-al-genero"></span>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="al-sede">Sede <span style="color:var(--naranja)">*</span></label>
                                <div class="form-dropdown" id="dropdown-al-sede" tabindex="0">
                                    <div class="form-select-trigger">
                                        <span class="selected-text" data-value="">Selecciona una sede</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container">
                                        <div class="form-option" data-value="sede central">Sede Central</div>
                                        <div class="form-option" data-value="sede norte">Sede Norte</div>
                                    </div>
                                    <input type="hidden" id="al-sede" name="al_sede" value="">
                                </div>
                                <span class="error-msg-modal" id="err-al-sede"></span>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="al-puntos-inicial">Puntaje Inicial <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="number" id="al-puntos-inicial" name="al_puntos_inicial"
                                    placeholder="Ej. 500" min="0" max="2000" value="0" required>
                                <span class="error-msg-modal" id="err-al-puntos-inicial"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="al-estado">Estado <span style="color:var(--naranja)">*</span></label>
                                <div class="form-dropdown" id="dropdown-al-estado" tabindex="0">
                                    <div class="form-select-trigger">
                                        <span class="selected-text" data-value="">Selecciona un estado</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container" style="max-height: 200px; overflow-y: auto;">
                                        <div class="form-option" data-value="Aguascalientes">Aguascalientes</div>
                                        <div class="form-option" data-value="Baja California">Baja California</div>
                                        <div class="form-option" data-value="Baja California Sur">Baja California Sur
                                        </div>
                                        <div class="form-option" data-value="Campeche">Campeche</div>
                                        <div class="form-option" data-value="Chiapas">Chiapas</div>
                                        <div class="form-option" data-value="Chihuahua">Chihuahua</div>
                                        <div class="form-option" data-value="Ciudad de México">Ciudad de México</div>
                                        <div class="form-option" data-value="Coahuila">Coahuila</div>
                                        <div class="form-option" data-value="Colima">Colima</div>
                                        <div class="form-option" data-value="Durango">Durango</div>
                                        <div class="form-option" data-value="Estado de México">Estado de México</div>
                                        <div class="form-option" data-value="Guanajuato">Guanajuato</div>
                                        <div class="form-option" data-value="Guerrero">Guerrero</div>
                                        <div class="form-option" data-value="Hidalgo">Hidalgo</div>
                                        <div class="form-option" data-value="Jalisco">Jalisco</div>
                                        <div class="form-option" data-value="Michoacán">Michoacán</div>
                                        <div class="form-option" data-value="Morelos">Morelos</div>
                                        <div class="form-option" data-value="Nayarit">Nayarit</div>
                                        <div class="form-option" data-value="Nuevo León">Nuevo León</div>
                                        <div class="form-option" data-value="Oaxaca">Oaxaca</div>
                                        <div class="form-option" data-value="Puebla">Puebla</div>
                                        <div class="form-option" data-value="Querétaro">Querétaro</div>
                                        <div class="form-option" data-value="Quintana Roo">Quintana Roo</div>
                                        <div class="form-option" data-value="San Luis Potosí">San Luis Potosí</div>
                                        <div class="form-option" data-value="Sinaloa">Sinaloa</div>
                                        <div class="form-option" data-value="Sonora">Sonora</div>
                                        <div class="form-option" data-value="Tabasco">Tabasco</div>
                                        <div class="form-option" data-value="Tamaulipas">Tamaulipas</div>
                                        <div class="form-option" data-value="Tlaxcala">Tlaxcala</div>
                                        <div class="form-option" data-value="Veracruz">Veracruz</div>
                                        <div class="form-option" data-value="Yucatán">Yucatán</div>
                                        <div class="form-option" data-value="Zacatecas">Zacatecas</div>
                                    </div>
                                    <input type="hidden" id="al-estado" name="al_estado" value="">
                                </div>
                                <span class="error-msg-modal" id="err-al-estado"></span>
                            </div>
                            <div class="form-group-modal">
                                <div style="display: flex; gap: 1rem;">
                                    <div style="flex: 2;">
                                        <label for="al-ciudad">Ciudad <span
                                                style="color:var(--naranja)">*</span></label>
                                        <input type="text" id="al-ciudad" name="al_ciudad" placeholder="Ciudad"
                                            required>
                                        <span class="error-msg-modal" id="err-al-ciudad"></span>
                                    </div>
                                    <div style="flex: 1;">
                                        <label for="al-cp">CP <span style="color:var(--naranja)">*</span></label>
                                        <input type="text" id="al-cp" name="al_cp" placeholder="CP" maxlength="5"
                                            required>
                                        <span class="error-msg-modal" id="err-al-cp"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="al-calle">Calle y Número <span style="color:var(--naranja)">*</span></label>
                                <input type="text" id="al-calle" name="al_calle" placeholder="Calle, número, colonia..."
                                    required>
                                <span class="error-msg-modal" id="err-al-calle"></span>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="al-correo">Correo Electrónico</label>
                                <input type="email" id="al-correo" name="al_correo" placeholder="correo@ejemplo.com"
                                    required>
                                <span class="error-msg-modal" id="err-al-correo"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="al-password">Contraseña</label>
                                <div class="input-password-wrapper">
                                    <input type="password" id="al-password" name="al_password"
                                        placeholder="Mínimo 6 caracteres" required minlength="6">
                                    <button type="button" class="toggle-password" data-target="al-password"
                                        title="Mostrar/Ocultar">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                </div>
                                <span class="error-msg-modal" id="err-al-password"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="al-password-confirm">Confirmar Contraseña</label>
                                <div class="input-password-wrapper">
                                    <input type="password" id="al-password-confirm" name="al_password_confirm"
                                        placeholder="Repite la contraseña" required>
                                    <button type="button" class="toggle-password" data-target="al-password-confirm"
                                        title="Mostrar/Ocultar">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                </div>
                                <span class="error-msg-modal" id="err-al-password-confirm"></span>
                            </div>
                        </div>

                        <!-- ===== DIVISOR ===== -->
                        <div class="modal-divider">
                            <span>Datos del Tutor (OPCIONAL)</span>
                        </div>

                        <!-- ===== SECCIÓN: Datos del Tutor ===== -->
                        <div class="modal-section-label">
                            <i class="ri-parent-line"></i> Información del Tutor
                        </div>

                        <div class="modal-grid">
                            <div class="form-group-modal">
                                <label for="tu-nombre">Nombre</label>
                                <input type="text" id="tu-nombre" name="tu_nombre" placeholder="Nombre(s)">
                                <span class="error-msg-modal" id="err-tu-nombre"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="tu-ap-paterno">Apellido Paterno</label>
                                <input type="text" id="tu-ap-paterno" name="tu_ap_paterno"
                                    placeholder="Apellido paterno">
                                <span class="error-msg-modal" id="err-tu-ap-paterno"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="tu-ap-materno">Apellido Materno</label>
                                <input type="text" id="tu-ap-materno" name="tu_ap_materno"
                                    placeholder="Apellido materno">
                            </div>
                            <div class="form-group-modal">
                                <label for="tu-telefono">Número de Teléfono</label>
                                <input type="tel" id="tu-telefono" name="tu_telefono" placeholder="10 dígitos"
                                    maxlength="10">
                                <span class="error-msg-modal" id="err-tu-telefono"></span>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="tu-parentesco">Parentesco</label>
                                <div class="form-dropdown" id="dropdown-tu-parentesco" tabindex="0">
                                    <div class="form-select-trigger">
                                        <span class="selected-text" data-value="">Selecciona el parentesco</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container">
                                        <div class="form-option" data-value="padre">Padre</div>
                                        <div class="form-option" data-value="madre">Madre</div>
                                        <div class="form-option" data-value="abuelo_a">Abuelo/a</div>
                                        <div class="form-option" data-value="tutor_legal">Tutor Legal</div>
                                        <div class="form-option" data-value="familiar">Familiar</div>
                                        <div class="form-option" data-value="otro">Otro</div>
                                    </div>
                                    <input type="hidden" id="tu-parentesco" name="tu_parentesco" value="">
                                </div>
                                <span class="error-msg-modal" id="err-tu-parentesco"></span>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="tu-correo">Correo Electrónico</label>
                                <input type="email" id="tu-correo" name="tu_correo" placeholder="correo@ejemplo.com">
                                <span class="error-msg-modal" id="err-tu-correo"></span>
                            </div>
                        </div>

                        <!-- ===== PIE DEL FORMULARIO ===== -->
                        <div class="modal-footer">
                            <button type="button" class="btn-modal-cancel" id="btn-cancelar-modal">Cancelar</button>
                            <button type="submit" class="btn-modal-submit">
                                <i class="ri-save-line"></i> Guardar Alumno
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        <!-- ======================= SECCIÓN PROFESORES ======================= -->
        <section class="section-content" id="section-profesores" style="display: none;">

            <!-- Cabecera de sección -->
            <div class="section-header">
                <h1 class="section-title">Profesores</h1>
                <button class="btn-primary" id="btn-agregar-profesor">
                    <i class="ri-add-line"></i> Agregar Profesor
                </button>
            </div>

            <!-- Buscador -->
            <div class="search-bar" style="margin-bottom: 24px;">
                <i class="ri-search-line search-icon"></i>
                <input type="text" id="buscador-profesores"
                    placeholder="Buscar profesor por nombre, especialidad o email..." autocomplete="off">
            </div>

            <!-- Grid de tarjetas -->
            <div class="profesores-grid" id="grid-profesores">

                <div class="profesor-card" data-nombre="Maestro González" data-email="gonzalez@egau.edu">
                    <div class="profesor-card-body">
                        <h3 class="profesor-nombre">Maestro González</h3>
                        <div class="profesor-info">
                            <span><i class="ri-mail-line"></i> gonzalez@egau.edu</span>
                            <span><i class="ri-phone-line"></i> 555-0101</span>
                        </div>
                    </div>
                    <div class="profesor-card-footer">
                        <button class="btn-profesor-ver" title="Ver"><i class="ri-eye-line"></i> Ver</button>
                        <button class="btn-profesor-editar"><i class="ri-edit-line"></i> Editar</button>
                        <button class="btn-profesor-eliminar"><i class="ri-delete-bin-line"></i></button>
                    </div>
                </div>

                <div class="profesor-card" data-nombre="Maestra Ramírez" data-email="ramirez@egau.edu">
                    <div class="profesor-card-body">
                        <h3 class="profesor-nombre">Maestra Ramírez</h3>
                        <div class="profesor-info">
                            <span><i class="ri-mail-line"></i> ramirez@egau.edu</span>
                            <span><i class="ri-phone-line"></i> 555-0102</span>
                        </div>
                    </div>
                    <div class="profesor-card-footer">
                        <button class="btn-profesor-ver" title="Ver"><i class="ri-eye-line"></i> Ver</button>
                        <button class="btn-profesor-editar"><i class="ri-edit-line"></i> Editar</button>
                        <button class="btn-profesor-eliminar"><i class="ri-delete-bin-line"></i></button>
                    </div>
                </div>

                <div class="profesor-card" data-nombre="Maestro López" data-email="lopez@egau.edu">
                    <div class="profesor-card-body">
                        <h3 class="profesor-nombre">Maestro López</h3>
                        <div class="profesor-info">
                            <span><i class="ri-mail-line"></i> lopez@egau.edu</span>
                            <span><i class="ri-phone-line"></i> 555-0103</span>
                        </div>
                    </div>
                    <div class="profesor-card-footer">
                        <button class="btn-profesor-ver" title="Ver"><i class="ri-eye-line"></i> Ver</button>
                        <button class="btn-profesor-editar"><i class="ri-edit-line"></i> Editar</button>
                        <button class="btn-profesor-eliminar"><i class="ri-delete-bin-line"></i></button>
                    </div>
                </div>

            </div>
            <!-- Mensaje sin resultados -->
            <p class="profesores-empty" id="profesores-empty" style="display:none;">No se encontraron profesores.</p>

        </section>

        <!-- ======================= SECCIÓN SEDES ======================= -->
        <section class="section-content" id="section-sede" style="display: none;">

            <!-- Cabecera de sección -->
            <div class="section-header">
                <h1 class="section-title">Gestión de Sedes</h1>
                <button class="btn-primary" id="btn-agregar-sede">
                    <i class="ri-add-line"></i> Agregar Sede
                </button>
            </div>

            <!-- Tarjeta de tabla -->
            <div class="card card-sedes">
                <div class="controls-container" style="padding: 24px;">
                    <div class="search-bar search-sede">
                        <i class="ri-search-line search-icon"></i>
                        <input type="text" id="buscador-sedes" placeholder="Buscar sede por nombre o dirección..."
                            autocomplete="off">
                    </div>
                </div>

                <div class="table-wrapper">
                    <table class="data-table" id="tabla-sedes">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th>Tipo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Sede Central</td>
                                <td>Av. Universidad 123, Col. Centro</td>
                                <td>555-0100</td>
                                <td><span class="sede-status-badge status-principal">Principal</span></td>
                                <td class="acciones">
                                    <button class="btn-icon btn-ver" title="Ver"><i class="ri-eye-line"></i></button>
                                    <button class="btn-icon btn-editar" title="Editar"><i
                                            class="ri-edit-line"></i></button>
                                    <button class="btn-icon btn-eliminar" title="Eliminar"><i
                                            class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- ======================= MODAL: AGREGAR PROFESOR ======================= -->
        <div class="modal-overlay" id="modal-agregar-profesor">
            <div class="modal-box">

                <!-- Header -->
                <div class="modal-header">
                    <div class="modal-title-group">
                        <span class="modal-title-icon"><i class="ri-user-star-line"></i></span>
                        <h2 class="modal-title">Agregar Profesor</h2>
                    </div>
                    <button type="button" class="modal-close-btn" id="modal-close-profesor" title="Cerrar">
                        <i class="ri-close-line"></i>
                    </button>
                </div>

                <!-- Cuerpo con scroll -->
                <div class="modal-body">
                    <form id="form-agregar-profesor" novalidate>
                        @csrf
                        <input type="hidden" name="rol" value="profesor">

                        <!-- ===== DATOS PERSONALES ===== -->
                        <div class="modal-section-label">
                            <i class="ri-user-line"></i> Información del Profesor
                        </div>

                        <div class="modal-grid">
                            <div class="form-group-modal">
                                <label for="pr-nombre">Nombre <span style="color:var(--naranja)">*</span></label>
                                <input type="text" id="pr-nombre" name="pr_nombre" placeholder="Nombre(s)" required>
                                <span class="error-msg-modal" id="err-pr-nombre"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="pr-ap-paterno">Apellido Paterno <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="text" id="pr-ap-paterno" name="pr_ap_paterno"
                                    placeholder="Apellido paterno" required>
                                <span class="error-msg-modal" id="err-pr-ap-paterno"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="pr-ap-materno">Apellido Materno</label>
                                <input type="text" id="pr-ap-materno" name="pr_ap_materno"
                                    placeholder="Apellido materno">
                            </div>
                            <div class="form-group-modal">
                                <label for="pr-fecha-nacimiento">Fecha de Nacimiento <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="date" id="pr-fecha-nacimiento" name="pr_fecha_nacimiento" required>
                                <span class="error-msg-modal" id="err-pr-fecha-nacimiento"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="pr-telefono">Número de Teléfono</label>
                                <input type="tel" id="pr-telefono" name="pr_telefono" placeholder="10 dígitos"
                                    maxlength="10">
                                <span class="error-msg-modal" id="err-pr-telefono"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="pr-genero">Género</label>
                                <div class="form-dropdown" id="dropdown-pr-genero" tabindex="0">
                                    <div class="form-select-trigger" id="trigger-pr-genero">
                                        <span class="selected-text" data-value="">Selecciona una opción</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container">
                                        <div class="form-option" data-value="F">Femenino (F)</div>
                                        <div class="form-option" data-value="M">Masculino (M)</div>
                                        <div class="form-option" data-value="O">Otro (O)</div>
                                    </div>
                                    <input type="hidden" id="pr-genero" name="pr_genero" value="">
                                </div>
                                <span class="error-msg-modal" id="err-pr-genero"></span>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="pr-sede">Sede <span style="color:var(--naranja)">*</span></label>
                                <div class="form-dropdown" id="dropdown-pr-sede" tabindex="0">
                                    <div class="form-select-trigger">
                                        <span class="selected-text" data-value="">Selecciona una sede</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container">
                                        <div class="form-option" data-value="sede central">Sede Central</div>
                                        <div class="form-option" data-value="sede norte">Sede Norte</div>
                                    </div>
                                    <input type="hidden" id="pr-sede" name="pr_sede" value="">
                                </div>
                                <span class="error-msg-modal" id="err-pr-sede"></span>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="pr-puntos">Puntos<span style="color:var(--naranja)">*</span></label>
                                <input type="number" id="pr-puntos" name="pr_puntos" placeholder="Ej. 100" min="0"
                                    max="2000" value="0" required>
                                <span class="error-msg-modal" id="err-pr-puntos"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="pr-estado">Estado <span style="color:var(--naranja)">*</span></label>
                                <div class="form-dropdown" id="dropdown-pr-estado" tabindex="0">
                                    <div class="form-select-trigger">
                                        <span class="selected-text" data-value="">Selecciona un estado</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container" style="max-height: 200px; overflow-y: auto;">
                                        <div class="form-option" data-value="Aguascalientes">Aguascalientes</div>
                                        <div class="form-option" data-value="Baja California">Baja California</div>
                                        <div class="form-option" data-value="Baja California Sur">Baja California Sur
                                        </div>
                                        <div class="form-option" data-value="Campeche">Campeche</div>
                                        <div class="form-option" data-value="Chiapas">Chiapas</div>
                                        <div class="form-option" data-value="Chihuahua">Chihuahua</div>
                                        <div class="form-option" data-value="Ciudad de México">Ciudad de México</div>
                                        <div class="form-option" data-value="Coahuila">Coahuila</div>
                                        <div class="form-option" data-value="Colima">Colima</div>
                                        <div class="form-option" data-value="Durango">Durango</div>
                                        <div class="form-option" data-value="Estado de México">Estado de México</div>
                                        <div class="form-option" data-value="Guanajuato">Guanajuato</div>
                                        <div class="form-option" data-value="Guerrero">Guerrero</div>
                                        <div class="form-option" data-value="Hidalgo">Hidalgo</div>
                                        <div class="form-option" data-value="Jalisco">Jalisco</div>
                                        <div class="form-option" data-value="Michoacán">Michoacán</div>
                                        <div class="form-option" data-value="Morelos">Morelos</div>
                                        <div class="form-option" data-value="Nayarit">Nayarit</div>
                                        <div class="form-option" data-value="Nuevo León">Nuevo León</div>
                                        <div class="form-option" data-value="Oaxaca">Oaxaca</div>
                                        <div class="form-option" data-value="Puebla">Puebla</div>
                                        <div class="form-option" data-value="Querétaro">Querétaro</div>
                                        <div class="form-option" data-value="Quintana Roo">Quintana Roo</div>
                                        <div class="form-option" data-value="San Luis Potosí">San Luis Potosí</div>
                                        <div class="form-option" data-value="Sinaloa">Sinaloa</div>
                                        <div class="form-option" data-value="Sonora">Sonora</div>
                                        <div class="form-option" data-value="Tabasco">Tabasco</div>
                                        <div class="form-option" data-value="Tamaulipas">Tamaulipas</div>
                                        <div class="form-option" data-value="Tlaxcala">Tlaxcala</div>
                                        <div class="form-option" data-value="Veracruz">Veracruz</div>
                                        <div class="form-option" data-value="Yucatán">Yucatán</div>
                                        <div class="form-option" data-value="Zacatecas">Zacatecas</div>
                                    </div>
                                    <input type="hidden" id="pr-estado" name="pr_estado" value="">
                                </div>
                                <span class="error-msg-modal" id="err-pr-estado"></span>
                            </div>
                            <div class="form-group-modal">
                                <div style="display: flex; gap: 1rem;">
                                    <div style="flex: 2;">
                                        <label for="pr-ciudad">Ciudad <span
                                                style="color:var(--naranja)">*</span></label>
                                        <input type="text" id="pr-ciudad" name="pr_ciudad" placeholder="Ciudad"
                                            required>
                                        <span class="error-msg-modal" id="err-pr-ciudad"></span>
                                    </div>
                                    <div style="flex: 1;">
                                        <label for="pr-cp">CP <span style="color:var(--naranja)">*</span></label>
                                        <input type="text" id="pr-cp" name="pr_cp" placeholder="CP" maxlength="5"
                                            required>
                                        <span class="error-msg-modal" id="err-pr-cp"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="pr-calle">Calle y Número <span style="color:var(--naranja)">*</span></label>
                                <input type="text" id="pr-calle" name="pr_calle" placeholder="Calle, número, colonia..."
                                    required>
                                <span class="error-msg-modal" id="err-pr-calle"></span>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="pr-correo">Correo Electrónico <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="email" id="pr-correo" name="pr_correo" placeholder="correo@ejemplo.com"
                                    required>
                                <span class="error-msg-modal" id="err-pr-correo"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="pr-password">Contraseña <span style="color:var(--naranja)">*</span></label>
                                <div class="input-password-wrapper">
                                    <input type="password" id="pr-password" name="pr_password"
                                        placeholder="Mínimo 6 caracteres" required minlength="6">
                                    <button type="button" class="toggle-password" data-target="pr-password"
                                        title="Mostrar/Ocultar">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                </div>
                                <span class="error-msg-modal" id="err-pr-password"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="pr-password-confirm">Confirmar Contraseña <span
                                        style="color:var(--naranja)">*</span></label>
                                <div class="input-password-wrapper">
                                    <input type="password" id="pr-password-confirm" name="pr_password_confirm"
                                        placeholder="Repite la contraseña" required>
                                    <button type="button" class="toggle-password" data-target="pr-password-confirm"
                                        title="Mostrar/Ocultar">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                </div>
                                <span class="error-msg-modal" id="err-pr-password-confirm"></span>
                            </div>
                        </div>

                        <!-- ===== PIE DEL FORMULARIO ===== -->
                        <div class="modal-footer">
                            <button type="button" class="btn-modal-cancel"
                                id="btn-cancelar-modal-profesor">Cancelar</button>
                            <button type="submit" class="btn-modal-submit">
                                <i class="ri-save-line"></i> Guardar Profesor
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- ======================= MODAL: AGREGAR SEDE ======================= -->
        <div class="modal-overlay" id="modal-agregar-sede">
            <div class="modal-box" style="max-width: 500px;">
                <div class="modal-header">
                    <div class="modal-title-group">
                        <span class="modal-title-icon"><i class="ri-map-pin-line"></i></span>
                        <h2 class="modal-title">Agregar Sede</h2>
                    </div>
                    <button type="button" class="modal-close-btn" id="modal-close-sede" title="Cerrar">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-agregar-sede" novalidate>
                        <div class="modal-grid">
                            <div class="form-group-modal modal-col-full">
                                <label for="se-nombre">Nombre de la Sede <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="text" id="se-nombre" name="se_nombre" placeholder="Ej. Sede Central"
                                    required>
                                <span class="error-msg-modal" id="err-se-nombre"></span>
                            </div>

                            <div class="form-group-modal">
                                <label for="se-estado">Estado <span style="color:var(--naranja)">*</span></label>
                                <div class="form-dropdown" id="dropdown-se-estado" tabindex="0">
                                    <div class="form-select-trigger">
                                        <span class="selected-text" data-value="">Selecciona un estado</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container" style="max-height: 200px; overflow-y: auto;">
                                        <div class="form-option" data-value="Aguascalientes">Aguascalientes</div>
                                        <div class="form-option" data-value="Baja California">Baja California</div>
                                        <div class="form-option" data-value="Baja California Sur">Baja California Sur
                                        </div>
                                        <div class="form-option" data-value="Campeche">Campeche</div>
                                        <div class="form-option" data-value="Chiapas">Chiapas</div>
                                        <div class="form-option" data-value="Chihuahua">Chihuahua</div>
                                        <div class="form-option" data-value="Ciudad de México">Ciudad de México</div>
                                        <div class="form-option" data-value="Coahuila">Coahuila</div>
                                        <div class="form-option" data-value="Colima">Colima</div>
                                        <div class="form-option" data-value="Durango">Durango</div>
                                        <div class="form-option" data-value="Estado de México">Estado de México</div>
                                        <div class="form-option" data-value="Guanajuato">Guanajuato</div>
                                        <div class="form-option" data-value="Guerrero">Guerrero</div>
                                        <div class="form-option" data-value="Hidalgo">Hidalgo</div>
                                        <div class="form-option" data-value="Jalisco">Jalisco</div>
                                        <div class="form-option" data-value="Michoacán">Michoacán</div>
                                        <div class="form-option" data-value="Morelos">Morelos</div>
                                        <div class="form-option" data-value="Nayarit">Nayarit</div>
                                        <div class="form-option" data-value="Nuevo León">Nuevo León</div>
                                        <div class="form-option" data-value="Oaxaca">Oaxaca</div>
                                        <div class="form-option" data-value="Puebla">Puebla</div>
                                        <div class="form-option" data-value="Querétaro">Querétaro</div>
                                        <div class="form-option" data-value="Quintana Roo">Quintana Roo</div>
                                        <div class="form-option" data-value="San Luis Potosí">San Luis Potosí</div>
                                        <div class="form-option" data-value="Sinaloa">Sinaloa</div>
                                        <div class="form-option" data-value="Sonora">Sonora</div>
                                        <div class="form-option" data-value="Tabasco">Tabasco</div>
                                        <div class="form-option" data-value="Tamaulipas">Tamaulipas</div>
                                        <div class="form-option" data-value="Tlaxcala">Tlaxcala</div>
                                        <div class="form-option" data-value="Veracruz">Veracruz</div>
                                        <div class="form-option" data-value="Yucatán">Yucatán</div>
                                        <div class="form-option" data-value="Zacatecas">Zacatecas</div>
                                    </div>
                                    <input type="hidden" id="se-estado" name="se_estado" value="">
                                </div>
                                <span class="error-msg-modal" id="err-se-estado"></span>
                            </div>

                            <div class="form-group-modal">
                                <div style="display: flex; gap: 1rem;">
                                    <div style="flex: 2;">
                                        <label for="se-ciudad">Ciudad <span
                                                style="color:var(--naranja)">*</span></label>
                                        <input type="text" id="se-ciudad" name="se_ciudad" placeholder="Ciudad"
                                            required>
                                        <span class="error-msg-modal" id="err-se-ciudad"></span>
                                    </div>
                                    <div style="flex: 1;">
                                        <label for="se-cp">CP <span style="color:var(--naranja)">*</span></label>
                                        <input type="text" id="se-cp" name="se_cp" placeholder="CP" maxlength="5"
                                            required>
                                        <span class="error-msg-modal" id="err-se-cp"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group-modal modal-col-full">
                                <label for="se-calle">Dirección (Calle y Número) <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="text" id="se-calle" name="se_calle" placeholder="Calle, número, colonia..."
                                    required>
                                <span class="error-msg-modal" id="err-se-calle"></span>
                            </div>

                            <div class="form-group-modal">
                                <label for="se-telefono">Teléfono <span style="color:var(--naranja)">*</span></label>
                                <input type="tel" id="se-telefono" name="se_telefono" placeholder="10 dígitos"
                                    maxlength="10" required>
                                <span class="error-msg-modal" id="err-se-telefono"></span>
                            </div>

                            <div class="form-group-modal">
                                <label for="se-correo">Email de Contacto <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="email" id="se-correo" name="se_correo" placeholder="correo@egau.com"
                                    required>
                                <span class="error-msg-modal" id="err-se-correo"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-modal-cancel"
                                id="btn-cancelar-modal-sede">Cancelar</button>
                            <button type="submit" class="btn-modal-submit">Guardar Sede</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ======================= SECCIÓN GRUPOS ======================= -->
        <section class="section-content" id="section-grupos" style="display: none;">

            <!-- Cabecera de sección -->
            <div class="section-header">
                <h1 class="section-title">Grupos y Cursos</h1>
                <div style="display: flex; gap: 12px;">
                    <button class="btn-secondary" id="btn-agregar-curso">
                        <i class="ri-book-open-line"></i> Crear Curso
                    </button>
                    <button class="btn-primary" id="btn-agregar-grupo">
                        <i class="ri-add-line"></i> Crear Grupo
                    </button>
                </div>
            </div>

            <!-- Buscador -->
            <div class="search-bar" style="margin-bottom: 24px;">
                <i class="ri-search-line search-icon"></i>
                <input type="text" id="buscador-grupos" placeholder="Buscar grupo por nombre, nivel o profesor..."
                    autocomplete="off">
            </div>

            <!-- Grid de tarjetas de grupos -->
            <div class="grupos-grid" id="grid-grupos">

                <!-- Tarjeta 1 -->
                <div class="grupo-card" data-nombre="Grupo A" data-nivel="principiantes"
                    data-profesor="Maestro González">
                    <div class="grupo-card-header">
                        <h3 class="grupo-nombre">Grupo A</h3>
                        <span class="badge badge-principiantes">Principiantes</span>
                    </div>
                    <div class="grupo-card-body">
                        <div class="grupo-info-line">
                            <i class="ri-user-star-line"></i> Maestro González
                        </div>
                        <div class="grupo-inscritos-wrapper">
                            <div class="grupo-info-line">
                                <i class="ri-group-line"></i> 15 / 20 inscritos
                            </div>
                            <div class="progress-bar-container">
                                <div class="progress-bar-fill" style="width: 75%;"></div>
                            </div>
                        </div>
                        <div class="grupo-info-line">
                            <i class="ri-time-line"></i> Lunes y Miércoles 14:00-15:30
                        </div>
                    </div>
                    <div class="grupo-card-footer">
                        <button class="btn-grupo-ver" title="Ver"><i class="ri-eye-line"></i> Ver</button>
                        <button class="btn-grupo-editar"><i class="ri-edit-line"></i> Editar</button>
                        <button class="btn-grupo-eliminar"><i class="ri-delete-bin-line"></i></button>
                    </div>
                </div>

                <!-- Tarjeta 2 -->
                <div class="grupo-card" data-nombre="Grupo B" data-nivel="intermedios" data-profesor="Maestra Ramírez">
                    <div class="grupo-card-header">
                        <h3 class="grupo-nombre">Grupo B</h3>
                        <span class="badge badge-intermedios">Intermedios</span>
                    </div>
                    <div class="grupo-card-body">
                        <div class="grupo-info-line">
                            <i class="ri-user-star-line"></i> Maestra Ramírez
                        </div>
                        <div class="grupo-inscritos-wrapper">
                            <div class="grupo-info-line">
                                <i class="ri-group-line"></i> 12 / 15 inscritos
                            </div>
                            <div class="progress-bar-container">
                                <div class="progress-bar-fill" style="width: 80%;"></div>
                            </div>
                        </div>
                        <div class="grupo-info-line">
                            <i class="ri-time-line"></i> Martes y Jueves 16:00-17:30
                        </div>
                    </div>
                    <div class="grupo-card-footer">
                        <button class="btn-grupo-ver" title="Ver"><i class="ri-eye-line"></i> Ver</button>
                        <button class="btn-grupo-editar"><i class="ri-edit-line"></i> Editar</button>
                        <button class="btn-grupo-eliminar"><i class="ri-delete-bin-line"></i></button>
                    </div>
                </div>

                <!-- Tarjeta 3 -->
                <div class="grupo-card" data-nombre="Grupo C" data-nivel="avanzados" data-profesor="Maestro López">
                    <div class="grupo-card-header">
                        <h3 class="grupo-nombre">Grupo C</h3>
                        <span class="badge badge-avanzados">Avanzados</span>
                    </div>
                    <div class="grupo-card-body">
                        <div class="grupo-info-line">
                            <i class="ri-user-star-line"></i> Maestro López
                        </div>
                        <div class="grupo-inscritos-wrapper">
                            <div class="grupo-info-line">
                                <i class="ri-group-line"></i> 8 / 20 inscritos
                            </div>
                            <div class="progress-bar-container">
                                <div class="progress-bar-fill" style="width: 40%;"></div>
                            </div>
                        </div>
                        <div class="grupo-info-line">
                            <i class="ri-time-line"></i> Viernes 17:00-19:00
                        </div>
                    </div>
                    <div class="grupo-card-footer">
                        <button class="btn-grupo-ver" title="Ver"><i class="ri-eye-line"></i> Ver</button>
                        <button class="btn-grupo-editar"><i class="ri-edit-line"></i> Editar</button>
                        <button class="btn-grupo-eliminar"><i class="ri-delete-bin-line"></i></button>
                    </div>
                </div>

            </div>
            <!-- Mensaje sin resultados -->
            <p class="grupos-empty" id="grupos-empty" style="display:none;">No se encontraron grupos.</p>

            <!-- ======================= TABLA DEMOSTRATIVA DE CURSOS ======================= -->
            <div style="margin-top: 40px;">
                <div
                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; gap: 24px;">
                    <h2
                        style="font-family: 'Inter', sans-serif; font-size: 18px; color: var(--texto); margin: 0; white-space: nowrap;">
                        Catálogo de Cursos</h2>
                    <div class="search-bar" style="flex-grow: 1; max-width: 600px; margin: 0;">
                        <i class="ri-search-line search-icon"></i>
                        <input type="text" id="buscador-tabla-cursos" placeholder="Buscar por clave, nombre o sede..."
                            autocomplete="off">
                    </div>
                </div>

                <div
                    style="overflow-x: auto; background-color: var(--blanco); border-radius: 12px; border: 1px solid var(--borde); box-shadow: 0 4px 12px rgba(0,0,0,0.02);">
                    <table id="tabla-cursos" style="width: 100%; border-collapse: collapse; text-align: left;">
                        <thead style="background-color: #fafafa; border-bottom: 1px solid var(--borde);">
                            <tr>
                                <th
                                    style="padding: 16px; font-weight: 600; font-size: 13px; color: var(--texto-suave);">
                                    ID</th>
                                <th
                                    style="padding: 16px; font-weight: 600; font-size: 13px; color: var(--texto-suave);">
                                    Nombre del Curso</th>
                                <th
                                    style="padding: 16px; font-weight: 600; font-size: 13px; color: var(--texto-suave);">
                                    Nivel</th>
                                <th
                                    style="padding: 16px; font-weight: 600; font-size: 13px; color: var(--texto-suave);">
                                    Duración</th>
                                <th
                                    style="padding: 16px; font-weight: 600; font-size: 13px; color: var(--texto-suave);">
                                    Costo Base</th>
                                <th
                                    style="padding: 16px; font-weight: 600; font-size: 13px; color: var(--texto-suave);">
                                    Sede</th>
                                <th
                                    style="padding: 16px; font-weight: 600; font-size: 13px; color: var(--texto-suave);">
                                    Estatus</th>
                                <th
                                    style="padding: 16px; font-weight: 600; font-size: 13px; color: var(--texto-suave); text-align: center;">
                                    Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="border-bottom: 1px solid var(--borde); transition: background-color 0.2s;">
                                <td style="padding: 16px; font-size: 14px; color: var(--texto);">1</td>
                                <td style="padding: 16px; font-size: 14px; color: var(--texto); font-weight: 500;">
                                    Ajedrez Principiantes</td>
                                <td style="padding: 16px;"><span class="badge badge-principiantes">Principiante</span>
                                </td>
                                <td style="padding: 16px; font-size: 14px; color: var(--texto);">12 Semanas (24 hrs)
                                </td>
                                <td style="padding: 16px; font-size: 14px; color: var(--texto);">$1,200.00</td>
                                <td style="padding: 16px; font-size: 14px; color: var(--texto);">Sede Central</td>
                                <td style="padding: 16px;"><span
                                        style="color: #1e8e3e; font-size: 12px; font-weight: 600;"><i
                                            class="ri-checkbox-circle-fill"></i> Activo</span></td>
                                <td style="padding: 16px; text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <button title="Editar"
                                            style="background:none; border:none; color:var(--texto-suave); font-size:18px; cursor:pointer;"
                                            onmouseover="this.style.color='var(--naranja)'"
                                            onmouseout="this.style.color='var(--texto-suave)'"><i
                                                class="ri-edit-line"></i></button>
                                        <button title="Eliminar"
                                            style="background:none; border:none; color:var(--texto-suave); font-size:18px; cursor:pointer;"
                                            onmouseover="this.style.color='#d93025'"
                                            onmouseout="this.style.color='var(--texto-suave)'"><i
                                                class="ri-delete-bin-line"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr style="border-bottom: 1px solid var(--borde); transition: background-color 0.2s;">
                                <td style="padding: 16px; font-size: 14px; color: var(--texto);">2</td>
                                <td style="padding: 16px; font-size: 14px; color: var(--texto); font-weight: 500;">
                                    Ajedrez Intermedio (Táctica)</td>
                                <td style="padding: 16px;"><span class="badge badge-intermedios">Intermedio</span></td>
                                <td style="padding: 16px; font-size: 14px; color: var(--texto);">16 Semanas (48 hrs)
                                </td>
                                <td style="padding: 16px; font-size: 14px; color: var(--texto);">$1,800.00</td>
                                <td style="padding: 16px; font-size: 14px; color: var(--texto);">Sede Norte</td>
                                <td style="padding: 16px;"><span
                                        style="color: #1e8e3e; font-size: 12px; font-weight: 600;"><i
                                            class="ri-checkbox-circle-fill"></i> Activo</span></td>
                                <td style="padding: 16px; text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <button title="Editar"
                                            style="background:none; border:none; color:var(--texto-suave); font-size:18px; cursor:pointer;"
                                            onmouseover="this.style.color='var(--naranja)'"
                                            onmouseout="this.style.color='var(--texto-suave)'"><i
                                                class="ri-edit-line"></i></button>
                                        <button title="Eliminar"
                                            style="background:none; border:none; color:var(--texto-suave); font-size:18px; cursor:pointer;"
                                            onmouseover="this.style.color='#d93025'"
                                            onmouseout="this.style.color='var(--texto-suave)'"><i
                                                class="ri-delete-bin-line"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr style="transition: background-color 0.2s;">
                                <td style="padding: 16px; font-size: 14px; color: var(--texto);">3</td>
                                <td style="padding: 16px; font-size: 14px; color: var(--texto); font-weight: 500;">
                                    Estrategia y Finales</td>
                                <td style="padding: 16px;"><span class="badge badge-avanzados">Avanzado</span></td>
                                <td style="padding: 16px; font-size: 14px; color: var(--texto);">20 Semanas (60 hrs)
                                </td>
                                <td style="padding: 16px; font-size: 14px; color: var(--texto);">$2,500.00</td>
                                <td style="padding: 16px; font-size: 14px; color: var(--texto);">Sede Central</td>
                                <td style="padding: 16px;"><span
                                        style="color: var(--texto-suave); font-size: 12px; font-weight: 600;"><i
                                            class="ri-close-circle-fill"></i> Inactivo</span></td>
                                <td style="padding: 16px; text-align: center;">
                                    <div style="display: flex; gap: 8px; justify-content: center;">
                                        <button title="Editar"
                                            style="background:none; border:none; color:var(--texto-suave); font-size:18px; cursor:pointer;"
                                            onmouseover="this.style.color='var(--naranja)'"
                                            onmouseout="this.style.color='var(--texto-suave)'"><i
                                                class="ri-edit-line"></i></button>
                                        <button title="Eliminar"
                                            style="background:none; border:none; color:var(--texto-suave); font-size:18px; cursor:pointer;"
                                            onmouseover="this.style.color='#d93025'"
                                            onmouseout="this.style.color='var(--texto-suave)'"><i
                                                class="ri-delete-bin-line"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </section>

        <!-- ======================= MODAL: AGREGAR GRUPO ======================= -->
        <div class="modal-overlay" id="modal-agregar-grupo">
            <div class="modal-box modal-box-large"> <!-- Una clase extra por si es más ancho debido a los horarios -->

                <div class="modal-header">
                    <div class="modal-title-group">
                        <span class="modal-title-icon"><i class="ri-group-line"></i></span>
                        <h2 class="modal-title">Crear Nuevo Grupo</h2>
                    </div>
                    <button type="button" class="modal-close-btn" id="modal-close-grupo" title="Cerrar">
                        <i class="ri-close-line"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="form-agregar-grupo" novalidate>
                        @csrf

                        <!-- ===== DATOS DEL GRUPO ===== -->
                        <div class="modal-section-label">
                            <i class="ri-information-line"></i> Datos Generales
                        </div>
                        <div class="modal-grid">

                            <!-- Curso (Dropdown en vez de ID) -->
                            <div class="form-group-modal">
                                <label for="gr-curso">Curso <span style="color:var(--naranja)">*</span></label>
                                <div class="form-dropdown" id="dropdown-gr-curso" tabindex="0">
                                    <div class="form-select-trigger" id="trigger-gr-curso">
                                        <span class="selected-text" data-value="">Selecciona un curso...</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container">
                                        <!-- Esto se llenará con un loop de Laravel en un futuro -->
                                        <div class="form-option" data-value="1">Ajedrez Principiantes</div>
                                        <div class="form-option" data-value="2">Ajedrez Intermedio</div>
                                        <div class="form-option" data-value="3">Ajedrez Avanzado (Estrategia)</div>
                                    </div>
                                    <input type="hidden" id="gr-curso" name="id_curso" value="">
                                </div>
                                <span class="error-msg-modal" id="err-gr-curso"></span>
                            </div>

                            <!-- Instructor (Dropdown en vez de ID) -->
                            <div class="form-group-modal">
                                <label for="gr-instructor">Instructor <span
                                        style="color:var(--naranja)">*</span></label>
                                <div class="form-dropdown" id="dropdown-gr-instructor" tabindex="0">
                                    <div class="form-select-trigger" id="trigger-gr-instructor">
                                        <span class="selected-text" data-value="">Asignar un profesor...</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container">
                                        <!-- Simulación de Profesores -->
                                        <div class="form-option" data-value="1">Maestro González</div>
                                        <div class="form-option" data-value="2">Maestra Ramírez</div>
                                        <div class="form-option" data-value="3">Maestro López</div>
                                    </div>
                                    <input type="hidden" id="gr-instructor" name="id_instructor" value="">
                                </div>
                                <span class="error-msg-modal" id="err-gr-instructor"></span>
                            </div>

                            <div class="form-group-modal">
                                <label for="gr-codigo">Código de Grupo <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="text" id="gr-codigo" name="codigo_grupo" placeholder="Ej. AJE-PRIN-01"
                                    required>
                                <span class="error-msg-modal" id="err-gr-codigo"></span>
                            </div>

                            <div class="form-group-modal">
                                <label for="gr-periodo">Periodo</label>
                                <input type="text" id="gr-periodo" name="periodo" placeholder="Ej. 2026-A"
                                    maxlength="10">
                            </div>

                            <div class="form-group-modal">
                                <label for="gr-fecha-inicio">Fecha de Inicio <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="date" id="gr-fecha-inicio" name="fecha_inicio" required>
                                <span class="error-msg-modal" id="err-gr-fecha-inicio"></span>
                            </div>

                            <div class="form-group-modal">
                                <label for="gr-fecha-fin">Fecha de Fin <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="date" id="gr-fecha-fin" name="fecha_fin" required>
                                <span class="error-msg-modal" id="err-gr-fecha-fin"></span>
                            </div>

                            <div class="form-group-modal">
                                <label for="gr-cupo-maximo">Cupo Máximo <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="number" id="gr-cupo-maximo" name="cupo_maximo"
                                    placeholder="Número de estudiantes" min="1" required>
                                <span class="error-msg-modal" id="err-gr-cupo-maximo"></span>
                            </div>

                            <div class="form-group-modal">
                                <label for="gr-estatus-general">Estatus Módulo</label>
                                <div class="form-dropdown" id="dropdown-gr-estatus" tabindex="0">
                                    <div class="form-select-trigger" id="trigger-gr-estatus">
                                        <span class="selected-text" data-value="activo">Activo</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container">
                                        <div class="form-option selected" data-value="activo">Activo</div>
                                        <div class="form-option" data-value="inactivo">Inactivo</div>
                                        <div class="form-option" data-value="cerrado">Cerrado</div>
                                    </div>
                                    <input type="hidden" id="gr-estatus-general" name="estatus" value="activo">
                                </div>
                            </div>



                        </div>

                        <!-- ===== HORARIOS (DINÁMICOS) ===== -->
                        <div class="modal-section-label"
                            style="margin-top:20px; display:flex; justify-content:space-between; align-items:center;">
                            <span><i class="ri-calendar-todo-fill"></i> Horarios de Clases</span>
                            <button type="button" class="btn-agregar-horario" id="btn-add-horario">
                                <i class="ri-add-line"></i> Añadir día
                            </button>
                        </div>
                        <p style="font-size:13px; color:var(--texto-suave); margin-bottom:12px;">Agrega los días de la
                            semana y las horas en las que se impartirá este grupo.</p>

                        <div class="horarios-container" id="horarios-list">
                            <!-- Aquí se insertan dinámicamente las filas de horarios -->
                        </div>
                        <span class="error-msg-modal" id="err-gr-horarios"
                            style="display:block; margin-top:5px; margin-bottom: 20px;"></span>


                        <!-- ===== PIE DEL FORMULARIO ===== -->
                        <div class="modal-footer">
                            <button type="button" class="btn-modal-cancel"
                                id="btn-cancelar-modal-grupo">Cancelar</button>
                            <button type="submit" class="btn-modal-submit">
                                <i class="ri-save-line"></i> Guardar Grupo
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- ======================= MODAL: AGREGAR CURSO ======================= -->
        <div class="modal-overlay" id="modal-agregar-curso">
            <div class="modal-box">
                <div class="modal-header">
                    <div class="modal-title-group">
                        <span class="modal-title-icon"><i class="ri-book-open-line"></i></span>
                        <h2 class="modal-title">Crear Nuevo Curso</h2>
                    </div>
                    <button type="button" class="modal-close-btn" id="modal-close-curso" title="Cerrar">
                        <i class="ri-close-line"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="form-agregar-curso" novalidate>
                        @csrf

                        <div class="modal-section-label">
                            <i class="ri-information-line"></i> Datos del Curso
                        </div>
                        <div class="modal-grid">

                            <!-- Nombre -->
                            <div class="form-group-modal modal-col-full">
                                <label for="cu-nombre">Nombre <span style="color:var(--naranja)">*</span></label>
                                <input type="text" id="cu-nombre" name="nombre"
                                    placeholder="Ej. Táctica y Estrategia Avanzada" required>
                                <span class="error-msg-modal" id="err-cu-nombre"></span>
                            </div>

                            <!-- Sede (Dropdown) -->
                            <div class="form-group-modal">
                                <label for="cu-sede">Sede <span style="color:var(--naranja)">*</span></label>
                                <div class="form-dropdown" id="dropdown-cu-sede" tabindex="0">
                                    <div class="form-select-trigger" id="trigger-cu-sede">
                                        <span class="selected-text" data-value="">Selecciona una sede...</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container" style="z-index:100;">
                                        <div class="form-option" data-value="1">Sede Central</div>
                                        <div class="form-option" data-value="2">Sede Norte</div>
                                    </div>
                                    <input type="hidden" id="cu-sede" name="id_sede" value="">
                                </div>
                                <span class="error-msg-modal" id="err-cu-sede"></span>
                            </div>

                            <!-- Nivel -->
                            <div class="form-group-modal">
                                <label for="cu-nivel">Nivel</label>
                                <div class="form-dropdown" id="dropdown-cu-nivel" tabindex="0">
                                    <div class="form-select-trigger" id="trigger-cu-nivel">
                                        <span class="selected-text" data-value="">Selecciona un nivel...</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container" style="z-index:99;">
                                        <div class="form-option" data-value="Principiante">Principiante</div>
                                        <div class="form-option" data-value="Intermedio">Intermedio</div>
                                        <div class="form-option" data-value="Avanzado">Avanzado</div>
                                    </div>
                                    <input type="hidden" id="cu-nivel" name="nivel" value="">
                                </div>
                            </div>

                            <!-- Duración Semanas -->
                            <div class="form-group-modal">
                                <label for="cu-duracion">Duración (Semanas)</label>
                                <input type="number" id="cu-duracion" name="duracion_semanas" placeholder="Ej. 16"
                                    min="1">
                            </div>

                            <!-- Horas Totales -->
                            <div class="form-group-modal">
                                <label for="cu-horas">Horas Totales</label>
                                <input type="number" id="cu-horas" name="horas_totales" placeholder="Ej. 48" min="1">
                            </div>

                            <!-- Costo Base -->
                            <div class="form-group-modal">
                                <label for="cu-costo">Costo Base ($)</label>
                                <input type="number" id="cu-costo" name="costo_base" placeholder="Ej. 1500.00" min="0"
                                    step="0.01">
                            </div>

                            <!-- Estatus -->
                            <div class="form-group-modal">
                                <label for="cu-estatus">Estatus</label>
                                <div class="form-dropdown" id="dropdown-cu-estatus" tabindex="0">
                                    <div class="form-select-trigger" id="trigger-cu-estatus">
                                        <span class="selected-text" data-value="1">Activo</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container">
                                        <div class="form-option selected" data-value="1">Activo</div>
                                        <div class="form-option" data-value="0">Inactivo</div>
                                    </div>
                                    <input type="hidden" id="cu-estatus" name="estatus" value="1">
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="form-group-modal modal-col-full">
                                <label for="cu-descripcion">Descripción</label>
                                <textarea id="cu-descripcion" name="descripcion"
                                    placeholder="Breve descripción del curso..." rows="3"
                                    style="width:100%; padding:10px; border:1px solid var(--borde); border-radius:8px; font-family:'Inter', sans-serif; resize:vertical;"></textarea>
                            </div>

                            <!-- Requisitos -->
                            <div class="form-group-modal modal-col-full">
                                <label for="cu-requisitos">Requisitos</label>
                                <textarea id="cu-requisitos" name="requisitos"
                                    placeholder="Requisitos previos para tomar el curso..." rows="2"
                                    style="width:100%; padding:10px; border:1px solid var(--borde); border-radius:8px; font-family:'Inter', sans-serif; resize:vertical;"></textarea>
                            </div>

                        </div>

                        <!-- ===== PIE DEL FORMULARIO ===== -->
                        <div class="modal-footer">
                            <button type="button" class="btn-modal-cancel"
                                id="btn-cancelar-modal-curso">Cancelar</button>
                            <button type="submit" class="btn-modal-submit">
                                <i class="ri-save-line"></i> Guardar Curso
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ======================= SECCIÓN EXTRAESCOLARES ======================= -->
        <section class="section-content" id="section-extraescolares" style="display: none;">

            <div class="section-header">
                <h1 class="section-title">Actividades Extraescolares</h1>
                <button class="btn-primary" id="btn-agregar-extraescolar">
                    <i class="ri-add-line"></i> Agregar Actividad
                </button>
            </div>

            <div class="search-bar" style="margin-bottom: 24px;">
                <i class="ri-search-line search-icon"></i>
                <input type="text" id="buscador-extraescolares" placeholder="Buscar actividad por nombre..."
                    autocomplete="off">
            </div>

            <div class="extraescolares-grid" id="grid-extraescolares">
                <!-- Tarjeta de ejemplo -->
                <div class="extraescolar-card" data-nombre="Taller de Ajedrez Rápido">
                    <div class="extraescolar-card-header">
                        <h3 class="extraescolar-nombre">Taller de Ajedrez Rápido</h3>
                    </div>
                    <div class="extraescolar-card-body">
                        <div class="extraescolar-info-line">
                            <i class="ri-text-wrap"></i> Técnicas avanzadas de Blitz y Bullet.
                        </div>
                        <div class="extraescolar-inscritos-wrapper">
                            <div class="extraescolar-info-line">
                                <i class="ri-group-line"></i> 5 / 20 inscritos
                            </div>
                            <div class="progress-bar-container">
                                <div class="progress-bar-fill" style="width: 25%;"></div>
                            </div>
                        </div>
                        <div class="extraescolar-info-line">
                            <i class="ri-money-dollar-circle-line"></i> Costo: $300.00
                        </div>
                        <div class="extraescolar-info-line">
                            <i class="ri-calendar-line"></i> 2026-05-01 / 2026-06-15
                        </div>
                    </div>
                    <div class="extraescolar-card-footer">
                        <button class="btn-extraescolar-ver" title="Ver"><i class="ri-eye-line"></i> Ver</button>
                        <button class="btn-extraescolar-editar"><i class="ri-edit-line"></i> Editar</button>
                        <button class="btn-extraescolar-eliminar"><i class="ri-delete-bin-line"></i></button>
                    </div>
                </div>
            </div>
            <p class="extraescolares-empty" id="extraescolares-empty" style="display:none;">No se encontraron
                actividades.</p>

        </section>

        <!-- ======================= MODAL: AGREGAR EXTRAESCOLAR ======================= -->
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

                            <!-- Nombre -->
                            <div class="form-group-modal modal-col-full">
                                <label for="ex-nombre">Nombre <span style="color:var(--naranja)">*</span></label>
                                <input type="text" id="ex-nombre" name="nombre"
                                    placeholder="Ej. Taller de Ajedrez Computarizado" required maxlength="100">
                                <span class="error-msg-modal" id="err-ex-nombre"></span>
                            </div>

                            <!-- Cupo máximo -->
                            <div class="form-group-modal">
                                <label for="ex-cupo-maximo">Cupo Máximo <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="number" id="ex-cupo-maximo" name="cupo_maximo" placeholder="Ej. 30"
                                    required min="1">
                                <span class="error-msg-modal" id="err-ex-cupo-maximo"></span>
                            </div>

                            <!-- Duración (Semanas) -->
                            <div class="form-group-modal">
                                <label for="ex-semanas">Duración (Semanas)</label>
                                <input type="number" id="ex-semanas" name="semanas_duracion" placeholder="Ej. 6"
                                    min="1">
                            </div>

                            <!-- Costo -->
                            <div class="form-group-modal">
                                <label for="ex-costo">Costo ($)</label>
                                <input type="number" id="ex-costo" name="costo" placeholder="Ej. 500.00" min="0"
                                    step="0.01">
                            </div>

                            <!-- Fecha Inicio -->
                            <div class="form-group-modal">
                                <label for="ex-fecha-inicio">Fecha de Inicio <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="date" id="ex-fecha-inicio" name="fecha_inicio" required>
                                <span class="error-msg-modal" id="err-ex-fecha-inicio"></span>
                            </div>

                            <!-- Fecha Fin -->
                            <div class="form-group-modal">
                                <label for="ex-fecha-fin">Fecha de Fin <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="date" id="ex-fecha-fin" name="fecha_fin" required>
                                <span class="error-msg-modal" id="err-ex-fecha-fin"></span>
                            </div>

                            <!-- Estatus -->
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

                            <!-- Ubicación -->
                            <div class="form-group-modal modal-col-full">
                                <label for="ex-ubicacion">Ubicación</label>
                                <input type="text" id="ex-ubicacion" name="ubicacion"
                                    placeholder="Ej. Aula 4, Cancha Principal..." maxlength="100">
                            </div>

                            <!-- Descripción -->
                            <div class="form-group-modal modal-col-full">
                                <label for="ex-descripcion">Descripción</label>
                                <textarea id="ex-descripcion" name="descripcion"
                                    placeholder="Breve descripción de la actividad..." rows="3"
                                    style="width:100%; padding:10px; border:1px solid var(--borde); border-radius:8px; font-family:'Inter', sans-serif; resize:vertical;"></textarea>
                            </div>

                            <!-- Requisitos -->
                            <div class="form-group-modal modal-col-full">
                                <label for="ex-requisitos">Requisitos</label>
                                <textarea id="ex-requisitos" name="requisitos" placeholder="Requisitos previos..."
                                    rows="2"
                                    style="width:100%; padding:10px; border:1px solid var(--borde); border-radius:8px; font-family:'Inter', sans-serif; resize:vertical;"></textarea>
                            </div>

                        </div>

                        <!-- ===== PIE DEL FORMULARIO ===== -->
                        <div class="modal-footer">
                            <button type="button" class="btn-modal-cancel"
                                id="btn-cancelar-modal-extraescolar">Cancelar</button>
                            <button type="submit" class="btn-modal-submit">
                                <i class="ri-save-line"></i> Guardar Actividad
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <section class="section-content" id="section-status" style="display: none;">
            <div class="section-header">
                <h1 class="section-title">Status</h1>
            </div>
            <div class="card"
                style="min-height: 480px; display: flex; align-items: center; justify-content: center; color: var(--texto-suave);">
                Página en construcción
            </div>
        </section>

        <section class="section-content" id="section-pagos" style="display: none;">
            <div class="section-header">
                <h1 class="section-title">Pagos</h1>
            </div>
            <div class="card"
                style="min-height: 480px; display: flex; align-items: center; justify-content: center; color: var(--texto-suave);">
                Página en construcción
            </div>
        </section>

        <section class="section-content" id="section-niveles" style="display: none;">
            <div class="section-header">
                <h1 class="section-title">Niveles de Estudiantes</h1>
            </div>

            <!-- KPI Cards -->
            <div class="niveles-kpi-container">
                <div class="niveles-kpi-card">
                    <span class="kpi-label">Promedio de Puntos</span>
                    <span class="kpi-value">1169</span>
                </div>
                <div class="niveles-kpi-card">
                    <span class="kpi-label">Nivel Promedio</span>
                    <span class="kpi-value">4.4</span>
                </div>
                <div class="niveles-kpi-card">
                    <span class="kpi-label">Total Estudiantes</span>
                    <span class="kpi-value">5</span>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="card card-niveles">
                <!-- Controls -->
                <div class="niveles-controls">
                    <div class="search-bar search-niveles">
                        <i class="ri-search-line search-icon"></i>
                        <input type="text" id="buscador-niveles" placeholder="Buscar estudiante por nombre...">
                    </div>

                    <div class="select-wrapper custom-dropdown" id="dropdown-niv-grupo">
                        <div class="custom-select-trigger niveles-select">
                            <span class="selected-text" data-value="">Grupo</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="custom-options-container">
                            <div class="custom-option selected" data-value="">Grupo</div>
                            <div class="custom-option" data-value="Grupo A">Grupo A</div>
                            <div class="custom-option" data-value="Grupo B">Grupo B</div>
                            <div class="custom-option" data-value="Grupo C">Grupo C</div>
                        </div>
                    </div>

                    <div class="select-wrapper custom-dropdown" id="dropdown-niv-nivel">
                        <div class="custom-select-trigger niveles-select">
                            <span class="selected-text" data-value="">Nivel</span>
                            <i class="ri-arrow-down-s-line"></i>
                        </div>
                        <div class="custom-options-container">
                            <div class="custom-option selected" data-value="">Nivel</div>
                            <div class="custom-option" data-value="3">Nivel 3</div>
                            <div class="custom-option" data-value="4">Nivel 4</div>
                            <div class="custom-option" data-value="5">Nivel 5</div>
                            <div class="custom-option" data-value="6">Nivel 6</div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-wrapper">
                    <table class="data-table" id="tabla-niveles">
                        <thead>
                            <tr>
                                <th>Alumno</th>
                                <th>Puntos</th>
                                <th>Nivel</th>
                                <th>Grupo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ana García</td>
                                <td><span class="puntos-actual">1450</span> <span class="puntos-max">/ 2000</span></td>
                                <td>
                                    <div class="badge-nivel badge-nivel-5"><span class="badge-nivel-texto">Nivel</span>
                                        <span class="badge-nivel-num">5</span>
                                    </div>
                                </td>
                                <td>Grupo A</td>
                                <td class="acciones-puntos">
                                    <button class="btn-modificar-puntos"><i class="ri-edit-line"></i> Modificar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Carlos López</td>
                                <td><span class="puntos-actual">875</span> <span class="puntos-max">/ 2000</span></td>
                                <td>
                                    <div class="badge-nivel badge-nivel-4"><span class="badge-nivel-texto">Nivel</span>
                                        <span class="badge-nivel-num">4</span>
                                    </div>
                                </td>
                                <td>Grupo B</td>
                                <td class="acciones-puntos">
                                    <button class="btn-modificar-puntos"><i class="ri-edit-line"></i> Modificar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>María Rodríguez</td>
                                <td><span class="puntos-actual">1720</span> <span class="puntos-max">/ 2000</span></td>
                                <td>
                                    <div class="badge-nivel badge-nivel-6"><span class="badge-nivel-texto">Nivel</span>
                                        <span class="badge-nivel-num">6</span>
                                    </div>
                                </td>
                                <td>Grupo A</td>
                                <td class="acciones-puntos">
                                    <button class="btn-modificar-puntos"><i class="ri-edit-line"></i> Modificar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Juan Sánchez</td>
                                <td><span class="puntos-actual">650</span> <span class="puntos-max">/ 2000</span></td>
                                <td>
                                    <div class="badge-nivel badge-nivel-3"><span class="badge-nivel-texto">Nivel</span>
                                        <span class="badge-nivel-num">3</span>
                                    </div>
                                </td>
                                <td>Grupo C</td>
                                <td class="acciones-puntos">
                                    <button class="btn-modificar-puntos"><i class="ri-edit-line"></i> Modificar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Laura Fernández</td>
                                <td><span class="puntos-actual">1150</span> <span class="puntos-max">/ 2000</span></td>
                                <td>
                                    <div class="badge-nivel badge-nivel-4"><span class="badge-nivel-texto">Nivel</span>
                                        <span class="badge-nivel-num">4</span>
                                    </div>
                                </td>
                                <td>Grupo B</td>
                                <td class="acciones-puntos">
                                    <button class="btn-modificar-puntos"><i class="ri-edit-line"></i> Modificar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- ======================= MODAL: MODIFICAR PUNTOS ======================= -->
        <div class="modal-overlay" id="modal-modificar-puntos">
            <div class="modal-box" style="max-width: 400px; width: 90%;">
                <div class="modal-header">
                    <div class="modal-title-group">
                        <span class="modal-title-icon"><i class="ri-award-line"></i></span>
                        <h2 class="modal-title">Modificar Puntuación</h2>
                    </div>
                    <button type="button" class="modal-close-btn" id="modal-close-puntos" title="Cerrar">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-puntos-info">
                        <h3 id="puntos-modal-nombre">Nombre Alumno</h3>
                        <p style="color: var(--texto-suave); font-size: 14px; margin: 0;">Puntos actuales: <strong
                                id="puntos-modal-actuales" style="color: var(--naranja); font-size: 18px;">0</strong> /
                            2000</p>
                    </div>

                    <div class="form-group-modal">
                        <label for="puntos-modal-cantidad" class="puntos-modal-label">Cantidad de puntos:</label>
                        <input type="number" id="puntos-modal-cantidad" placeholder="Ej. 50" min="1" max="2000">
                    </div>

                    <div class="modal-puntos-actions">
                        <button type="button" id="btn-puntos-restar" class="btn-modal-action btn-modal-restar">
                            <i class="ri-subtract-line"></i> Quitar
                        </button>
                        <button type="button" id="btn-puntos-sumar" class="btn-modal-action btn-modal-sumar">
                            <i class="ri-add-line"></i> Añadir
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ======================= MODAL: AGREGAR ROL ======================= -->
        <div class="modal-overlay" id="modal-agregar-rol">
            <div class="modal-box modal-box-large">
                <!-- Cabecera del modal -->
                <div class="modal-header">
                    <div class="modal-title-group">
                        <i class="ri-shield-keyhole-line modal-title-icon"></i>
                        <h2 class="modal-title">Agregar Nuevo Rol</h2>
                    </div>
                    <button class="modal-close-btn" id="modal-close-rol" title="Cerrar">
                        <i class="ri-close-line"></i>
                    </button>
                </div>

                <!-- Cuerpo del modal -->
                <div class="modal-body">
                    <form id="form-agregar-rol" novalidate>

                        <!-- Sección: Detalles del Rol -->
                        <div class="modal-section-label">
                            <i class="ri-information-line"></i> Detalles del Rol
                        </div>
                        <div class="modal-grid">
                            <div class="form-group-modal modal-col-full">
                                <label for="ro-nombre">Nombre del Rol <span
                                        style="color:var(--naranja)">*</span></label>
                                <input type="text" id="ro-nombre" name="ro_nombre" placeholder="Ej. Editor Académico"
                                    required>
                                <span class="error-msg-modal" id="err-ro-nombre"></span>
                            </div>
                            <div class="form-group-modal modal-col-full">
                                <label for="ro-descripcion">Descripción <span
                                        style="color:var(--naranja)">*</span></label>
                                <textarea id="ro-descripcion" name="ro_descripcion"
                                    placeholder="Explica qué funciones tendrá este rol..." rows="2"></textarea>
                                <span class="error-msg-modal" id="err-ro-descripcion"></span>
                            </div>
                            <div class="form-group-modal">
                                <label for="ro-tipo">Tipo de Acceso <span style="color:var(--naranja)">*</span></label>
                                <div class="form-dropdown" id="dropdown-ro-tipo" tabindex="0">
                                    <div class="form-select-trigger">
                                        <span class="selected-text" data-value="estandar">Estándar</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container">
                                        <div class="form-option selected" data-value="estandar">Estándar</div>
                                        <div class="form-option" data-value="admin">Administrador</div>
                                    </div>
                                    <input type="hidden" id="ro-tipo" name="ro_tipo" value="estandar">
                                </div>
                            </div>
                            <div class="form-group-modal">
                                <label for="ro-estatus">Estatus <span style="color:var(--naranja)">*</span></label>
                                <div class="form-dropdown" id="dropdown-ro-estatus" tabindex="0">
                                    <div class="form-select-trigger">
                                        <span class="selected-text" data-value="activo">Activo</span>
                                        <i class="ri-arrow-down-s-line"></i>
                                    </div>
                                    <div class="form-options-container">
                                        <div class="form-option selected" data-value="activo">Activo</div>
                                        <div class="form-option" data-value="inactivo">Inactivo</div>
                                    </div>
                                    <input type="hidden" id="ro-estatus" name="ro_estatus" value="activo">
                                </div>
                            </div>
                        </div>

                        <!-- Sección: Matriz de Permisos -->
                        <div class="modal-section-label">
                            <i class="ri-lock-password-line"></i> Matriz de Permisos
                        </div>

                        <div class="permissions-matrix-wrapper">
                            <table class="permissions-table">
                                <thead>
                                    <tr>
                                        <th>Módulo</th>
                                        <th class="text-center">Ver (Acceso)</th>
                                        <th class="text-center">Crear/Editar (Escritura)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $modulos = [
                                            ['id' => 'alumnos', 'nombre' => 'Alumnos'],
                                            ['id' => 'profesores', 'nombre' => 'Profesores'],
                                            ['id' => 'personal', 'nombre' => 'Personal'],
                                            ['id' => 'roles', 'nombre' => 'Roles'],
                                            ['id' => 'sedes', 'nombre' => 'Sedes'],
                                            ['id' => 'grupos', 'nombre' => 'Grupos'],
                                            ['id' => 'extraescolares', 'nombre' => 'Extraescolares'],
                                            ['id' => 'status', 'nombre' => 'Status'],
                                            ['id' => 'pagos', 'nombre' => 'Pagos'],
                                            ['id' => 'niveles', 'nombre' => 'Niveles'],
                                        ];
                                    @endphp
                                    @foreach($modulos as $mod)
                                        <tr>
                                            <td><strong>{{ $mod['nombre'] }}</strong></td>
                                            <td class="text-center">
                                                <label class="custom-checkbox-container">
                                                    <input type="checkbox" name="permiso_{{ $mod['id'] }}_ver" value="1">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                @if($mod['id'] !== 'status')
                                                    <label class="custom-checkbox-container">
                                                        <input type="checkbox" name="permiso_{{ $mod['id'] }}_crear" value="1">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                @else
                                                    <span style="color: var(--texto-suave); font-size: 0.8rem;">N/A</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- ===== PIE DEL FORMULARIO ===== -->
                        <div class="modal-footer">
                            <button type="button" class="btn-modal-cancel" id="btn-cancelar-modal-rol">Cancelar</button>
                            <button type="submit" class="btn-modal-submit">
                                <i class="ri-save-line"></i> Guardar Rol
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Nueva sección Opciones / Configuración -->
        <section class="section-content" id="section-opciones" style="display: none;">
            <div class="section-header">
                <h1 class="section-title">Configuración</h1>
            </div>
            <div class="card"
                style="min-height: 480px; display: flex; align-items: center; justify-content: center; color: var(--texto-suave);">
                Página en construcción (Ajustes del sistema)
            </div>
        </section>

    </main>


    <!-- JS General -->
    <script src="{{ asset('animaciones/admin/dashboardAdmin.js') }}"></script>
    <!-- JS Sección Personal -->
    <script src="{{ asset('animaciones/admin/dashboardAdminPersonal.js') }}"></script>
    <!-- JS Sección Alumnos -->
    <script src="{{ asset('animaciones/admin/dashboardAdminAlumnos.js') }}"></script>
    <!-- JS Sección Profesores -->
    <script src="{{ asset('animaciones/admin/dashboardAdminProfesores.js') }}"></script>
    <!-- JS Sección Sede -->
    <script src="{{ asset('animaciones/admin/dashboardAdminSede.js') }}"></script>
    <!-- JS Sección Grupos -->
    <script src="{{ asset('animaciones/admin/dashboardAdminGrupos.js') }}"></script>
    <!-- JS Sección Extraescolares -->
    <script src="{{ asset('animaciones/admin/dashboardAdminExtraescolares.js') }}"></script>
    <!-- JS Sección Niveles -->
    <script src="{{ asset('animaciones/admin/dashboardAdminNiveles.js') }}"></script>
    <!-- JS Sección Roles -->
    <script src="{{ asset('animaciones/admin/dashboardAdminRoles.js') }}"></script>

</body>

</html>