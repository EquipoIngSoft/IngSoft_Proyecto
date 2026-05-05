<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-token" content="{{ session('token') }}">
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

        <nav class="sidebar-nav">
            <ul>
                @if($permisos->alumno_ver ?? false)
                    <li class="nav-item active" data-section="alumnos">
                        <a href="#"><i class="ri-group-line"></i><span>Alumnos</span></a>
                    </li>
                @endif

                @if($permisos->profesor_ver ?? false)
                    <li class="nav-item" data-section="profesores">
                        <a href="#"><i class="ri-user-star-line"></i><span>Profesores</span></a>
                    </li>
                @endif

                @if($permisos->personal_ver ?? false)
                    <li class="nav-item" data-section="personal">
                        <a href="#"><i class="ri-user-settings-line"></i><span>Personal</span></a>
                    </li>
                @endif

                @if($permisos->roles_ver ?? false)
                    <li class="nav-item" data-section="roles">
                        <a href="#"><i class="ri-shield-user-line"></i><span>Roles</span></a>
                    </li>
                @endif

                @if($permisos->sedes_ver ?? false)
                    <li class="nav-item" data-section="sede">
                        <a href="#"><i class="ri-map-pin-line"></i><span>Sede</span></a>
                    </li>
                @endif

                @if($permisos->grupos_ver ?? false)
                    <li class="nav-item" data-section="grupos">
                        <a href="#"><i class="ri-grid-line"></i><span>Grupos</span></a>
                    </li>
                @endif

                @if($permisos->extracurriculares_ver ?? false)
                    <li class="nav-item" data-section="extraescolares">
                        <a href="#"><i class="ri-bar-chart-2-line"></i><span>Extraescolares</span></a>
                    </li>
                @endif

                @if($permisos->estatus_ver ?? false)
                    <li class="nav-item" data-section="status">
                        <a href="#"><i class="ri-bookmark-line"></i><span>Status</span></a>
                    </li>
                @endif

                @if($permisos->pagos_ver ?? false)
                    <li class="nav-item" data-section="pagos">
                        <a href="#"><i class="ri-bank-card-line"></i><span>Pagos</span></a>
                    </li>
                @endif

                @if($permisos->niveles_ver ?? false)
                    <li class="nav-item" data-section="niveles">
                        <a href="#"><i class="ri-book-open-line"></i><span>Niveles</span></a>
                    </li>
                @endif
            </ul>
        </nav>

        <!-- Opciones al fondo -->
        <div class="sidebar-footer">
            <a href="#" class="nav-footer-item nav-item" data-section="opciones">
                <i class="ri-settings-3-line"></i>
                <span>Configuración</span>
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



        <!-- Área de sección activa: ROLES -->
        <section class="section-content" id="section-roles" style="display: none;">

            <!-- Cabecera de sección -->
            <div class="section-header">
                <h1 class="section-title">Gestión de Roles</h1>
                @if($permisos->roles_edit ?? false)
                    <button class="btn-primary" id="btn-agregar-rol">
                        <i class="ri-add-line"></i> Agregar Rol
                    </button>
                @endif
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
                                    @if($permisos->roles_edit ?? false)
                                        <button class="btn-icon btn-editar" title="Editar"><i
                                                class="ri-edit-line"></i></button>
                                    @endif
                                    @if(($permisos->roles_edit ?? false) && $administrativo)
                                        <button class="btn-icon btn-eliminar" title="Eliminar"><i
                                                class="ri-delete-bin-line"></i></button>
                                    @endif
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
                                    @if($permisos->roles_edit ?? false)
                                        <button class="btn-icon btn-editar" title="Editar"><i
                                                class="ri-edit-line"></i></button>
                                    @endif
                                    @if(($permisos->roles_edit ?? false) && $administrativo)
                                        <button class="btn-icon btn-eliminar" title="Eliminar"><i
                                                class="ri-delete-bin-line"></i></button>
                                    @endif
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
                                    @if($permisos->roles_edit ?? false)
                                        <button class="btn-icon btn-editar" title="Editar"><i
                                                class="ri-edit-line"></i></button>
                                    @endif
                                    @if(($permisos->roles_edit ?? false) && $administrativo)
                                        <button class="btn-icon btn-eliminar" title="Eliminar"><i
                                                class="ri-delete-bin-line"></i></button>
                                    @endif
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



        {{-- ===================== ALUMNOS ===================== --}}
        <script>
            window.PERMISOS_ALUMNOS = {
                edit: {{ ($permisos->alumno_edit ?? false) ? 'true' : 'false' }},
                admin: {{ ($administrativo ?? false) ? 'true' : 'false' }}
    };
        </script>

        @include('admin.alumnos')

        {{-- ===================== PROFESORES ===================== --}}
        <script>
            window.PERMISOS_PROFESORES = {
                edit: {{ ($permisos->profesor_edit ?? false) ? 'true' : 'false' }},
                admin: {{ ($administrativo ?? false) ? 'true' : 'false' }}
    };
        </script>
        @include('admin.profesores')

        {{-- ===================== PERSONAL ===================== --}}
        <script>
            window.PERMISOS_PERSONAL = {
                edit: {{ ($permisos->personal_edit ?? false) ? 'true' : 'false' }},
                admin: {{ ($administrativo ?? false) ? 'true' : 'false' }}
    };
        </script>
        @include('admin.personal')

        {{-- ===================== SEDES ===================== --}}
        <script>
            window.PERMISOS_SEDES = {
                ver:  {{ ($permisos->sedes_ver ?? false) ? 'true' : 'false' }},
                edit: {{ ($permisos->sedes_edit ?? false) ? 'true' : 'false' }},
                admin: {{ ($administrativo ?? false) ? 'true' : 'false' }}
    };
        </script>
        @include('admin.sedes')

        <!-- ======================= SECCIÓN GRUPOS ======================= -->
        <section class="section-content" id="section-grupos" style="display: none;">

            <!-- Cabecera de sección -->
            <div class="section-header">
                <h1 class="section-title">Grupos y Cursos</h1>
                @if($permisos->grupos_edit ?? false)
                    <div style="display: flex; gap: 12px;">
                        <button class="btn-secondary" id="btn-agregar-curso"><i class="ri-book-open-line"></i> Crear
                            Curso</button>
                        <button class="btn-primary" id="btn-agregar-grupo"><i class="ri-add-line"></i> Crear Grupo</button>
                    </div>
                @endif
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
                        @if($permisos->grupos_edit ?? false)
                            <button class="btn-grupo-editar"><i class="ri-edit-line"></i> Editar</button>
                        @endif
                        @if(($permisos->grupos_edit ?? false) && $administrativo)
                            <button class="btn-grupo-eliminar"><i class="ri-delete-bin-line"></i></button>
                        @endif
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
                        @if($permisos->grupos_edit ?? false)
                            <button class="btn-grupo-editar"><i class="ri-edit-line"></i> Editar</button>
                        @endif
                        @if(($permisos->grupos_edit ?? false) && $administrativo)
                            <button class="btn-grupo-eliminar"><i class="ri-delete-bin-line"></i></button>
                        @endif
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
                        @if($permisos->grupos_edit ?? false)
                            <button class="btn-grupo-editar"><i class="ri-edit-line"></i> Editar</button>
                        @endif
                        @if(($permisos->grupos_edit ?? false) && $administrativo)
                            <button class="btn-grupo-eliminar"><i class="ri-delete-bin-line"></i></button>
                        @endif
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
                                        <div class="form-option" data-value="Peón">♟ Peón</div>
                                        <div class="form-option" data-value="Caballo">♞ Caballo</div>
                                        <div class="form-option" data-value="Alfil">♝ Alfil</div>
                                        <div class="form-option" data-value="Torre">♜ Torre</div>
                                        <div class="form-option" data-value="Reina">♛ Reina</div>
                                        <div class="form-option" data-value="Rey">♚ Rey</div>
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
                @if($permisos->extracurriculares_edit ?? false)
                    <button class="btn-primary" id="btn-agregar-extraescolar">
                        <i class="ri-add-line"></i> Agregar Actividad
                    </button>
                @endif
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
                        @if($permisos->extracurriculares_edit ?? false)
                            <button class="btn-extraescolar-editar"><i class="ri-edit-line"></i> Editar</button>
                        @endif
                        @if(($permisos->extracurriculares_edit ?? false) && $administrativo)
                            <button class="btn-extraescolar-eliminar"><i class="ri-delete-bin-line"></i></button>
                        @endif
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
                                    @if($permisos->niveles_edit ?? false)
                                        <button class="btn-modificar-puntos"><i class="ri-edit-line"></i> Modificar</button>
                                    @endif
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
                                    @if($permisos->niveles_edit ?? false)
                                        <button class="btn-modificar-puntos"><i class="ri-edit-line"></i> Modificar</button>
                                    @endif
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
                                    @if($permisos->niveles_edit ?? false)
                                        <button class="btn-modificar-puntos"><i class="ri-edit-line"></i> Modificar</button>
                                    @endif
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
                                    @if($permisos->niveles_edit ?? false)
                                        <button class="btn-modificar-puntos"><i class="ri-edit-line"></i> Modificar</button>
                                    @endif
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
                                    @if($permisos->niveles_edit ?? false)
                                        <button class="btn-modificar-puntos"><i class="ri-edit-line"></i> Modificar</button>
                                    @endif
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

        <section class="section-content" id="section-opciones" style="display: none;">
            @include('admin.partials.configuracion')
        </section>
    </main>

    <!-- Sedes disponibles (dinámicas desde DB) -->
    <script>
        window.SEDES_MAP = {
            @foreach($sedes as $s)
                {{ $s->id_sede }}: "{{ $s->nombre }}",
            @endforeach
        };
    </script>
    <!-- JS General -->
    <script src="{{ asset('animaciones/admin/dashboardAdmin.js') }}?v={{ time() }}"></script>
    <!-- JS Sección Personal -->
    <script src="{{ asset('animaciones/admin/dashboardAdminPersonal.js') }}?v={{ time() }}"></script>
    <!-- JS Sección Alumnos -->
    <script src="{{ asset('animaciones/admin/dashboardAdminAlumnos.js') }}?v={{ time() }}"></script>
    <!-- JS Sección Profesores -->
    <script src="{{ asset('animaciones/admin/dashboardAdminProfesores.js') }}?v={{ time() }}"></script>
    <!-- JS Sección Sede -->
    <script src="{{ asset('animaciones/admin/dashboardAdminSede.js') }}?v={{ time() }}"></script>
    <!-- JS Sección Grupos -->
    <script src="{{ asset('animaciones/admin/dashboardAdminGrupos.js') }}?v={{ time() }}"></script>
    <!-- JS Sección Extraescolares -->
    <script src="{{ asset('animaciones/admin/dashboardAdminExtraescolares.js') }}?v={{ time() }}"></script>
    <!-- JS Sección Niveles -->
    <script src="{{ asset('animaciones/admin/dashboardAdminNiveles.js') }}?v={{ time() }}"></script>
    <!-- JS Sección Roles -->
    <script src="{{ asset('animaciones/admin/dashboardAdminRoles.js') }}?v={{ time() }}"></script>
    <!-- JS Sección Configuración -->
    <script src="{{ asset('animaciones/admin/dashboardAdminPerfil.js') }}?v={{ time() }}"></script>

</body>

</html>