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
    <!-- Hoja de estilos -->
    <link rel="stylesheet" href="{{ asset('css/dashboardAdmin.css') }}">
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
                            <li id="btn-logout" class="text-danger"><i class="ri-logout-box-r-line"></i> Cerrar sesión</li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- Área de sección activa -->
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

                        <!-- Grupo -->
                        <div class="select-wrapper custom-dropdown" id="dropdown-grupo">
                            <div class="custom-select-trigger">
                                <span class="selected-text" data-value="">Todos los grupos</span>
                                <i class="ri-arrow-down-s-line"></i>
                            </div>
                            <div class="custom-options-container">
                                <div class="custom-option selected" data-value="">Todos los grupos</div>
                                <div class="custom-option" data-value="grupo a">Grupo A</div>
                                <div class="custom-option" data-value="grupo b">Grupo B</div>
                                <div class="custom-option" data-value="grupo c">Grupo C</div>
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
                                <th>Grupo</th>
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
                                <td>Grupo A</td>
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
                                <td>Grupo B</td>
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
                                <td>Grupo A</td>
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
                                <td>Grupo C</td>
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
                                <td>Grupo B</td>
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
                                <td>Grupo C</td>
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
                    <span class="pagination-info">Mostrando 1–6 de 6 alumnos</span>
                    <div class="pagination-btns">
                        <button class="pag-btn" disabled><i class="ri-arrow-left-s-line"></i></button>
                        <button class="pag-btn active">1</button>
                        <button class="pag-btn"><i class="ri-arrow-right-s-line"></i></button>
                    </div>
                </div>

            </div><!-- /card -->
        </section>

        <!-- ======================= OTRAS SECCIONES ======================= -->
        <section class="section-content" id="section-profesores" style="display: none;">
            <div class="section-header">
                <h1 class="section-title">Gestión de Profesores</h1>
                <button class="btn-primary" style="opacity: 0.5; pointer-events: none;"><i class="ri-add-line"></i> Agregar Profesor</button>
            </div>
            <div class="card" style="min-height: 480px; display: flex; align-items: center; justify-content: center; color: var(--texto-suave);">
                Página en construcción
            </div>
        </section>

        <section class="section-content" id="section-grupos" style="display: none;">
            <div class="section-header">
                <h1 class="section-title">Gestión de Grupos</h1>
            </div>
            <div class="card" style="min-height: 480px; display: flex; align-items: center; justify-content: center; color: var(--texto-suave);">
                Página en construcción
            </div>
        </section>

        <section class="section-content" id="section-extraescolares" style="display: none;">
            <div class="section-header">
                <h1 class="section-title">Extraescolares</h1>
            </div>
            <div class="card" style="min-height: 480px; display: flex; align-items: center; justify-content: center; color: var(--texto-suave);">
                Página en construcción
            </div>
        </section>

        <section class="section-content" id="section-status" style="display: none;">
            <div class="section-header">
                <h1 class="section-title">Status</h1>
            </div>
            <div class="card" style="min-height: 480px; display: flex; align-items: center; justify-content: center; color: var(--texto-suave);">
                Página en construcción
            </div>
        </section>

        <section class="section-content" id="section-pagos" style="display: none;">
            <div class="section-header">
                <h1 class="section-title">Pagos</h1>
            </div>
            <div class="card" style="min-height: 480px; display: flex; align-items: center; justify-content: center; color: var(--texto-suave);">
                Página en construcción
            </div>
        </section>

        <section class="section-content" id="section-niveles" style="display: none;">
            <div class="section-header">
                <h1 class="section-title">Niveles</h1>
            </div>
            <div class="card" style="min-height: 480px; display: flex; align-items: center; justify-content: center; color: var(--texto-suave);">
                Página en construcción
            </div>
        </section>

        <!-- Nueva sección Opciones / Configuración -->
        <section class="section-content" id="section-opciones" style="display: none;">
            <div class="section-header">
                <h1 class="section-title">Configuración</h1>
            </div>
            <div class="card" style="min-height: 480px; display: flex; align-items: center; justify-content: center; color: var(--texto-suave);">
                Página en construcción (Ajustes del sistema)
            </div>
        </section>

    </main>

    <!-- JS -->
    <script src="{{ asset('animaciones/dashboardAdmin.js') }}"></script>

</body>

</html>