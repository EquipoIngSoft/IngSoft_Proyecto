<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Tokens de Sanctum — NO MODIFICAR --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-token" content="{{ session('token') }}">
    <title>Portal del Estudiante - EGAU Chess</title>
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Iconos (Remix Icons) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Hojas de estilos — SPA principal -->
    <link rel="stylesheet" href="{{ asset('css/alumno/dashboardAlumno.css') }}">
    {{-- CSS secciones Angel --}}
    <link rel="stylesheet" href="{{ asset('css/alumno/dashboardAlumnoInicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alumno/dashboardAlumnoProfesores.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alumno/dashboardAlumnoExtraescolares.css') }}">
    {{-- CSS secciones Mariana --}}
    <link rel="stylesheet" href="{{ asset('css/alumno/dashboardAlumnoMiNivel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alumno/dashboardAlumnoMisGrupos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alumno/dashboardAlumnoPagos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alumno/dashboardAlumnoMiPerfil.css') }}">

    <!-- Hojas de estilos — vistas fusionadas de la carpeta dashboardAlumno -->
    {{-- CSS interacciones dinámicas Mariana --}}
    {{-- (clases integradas en dashboardAlumno.css desde S-46) --}}
</head>

<body>

    <div id="loading-screen" style="
    position: fixed; inset: 0; z-index: 9999;
    background-color: #f4f6f9;
    display: flex; align-items: center; justify-content: center;
    flex-direction: column; gap: 16px;">
        <img src="{{ asset('Logos/LogoEgau.png') }}" style="width: 80px; opacity: 0.8;">
        <span style="font-family:'Cinzel',serif; font-size: 13px; color: #888; letter-spacing: 3px;">CARGANDO...</span>
    </div>

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
                <!-- ---- Secciones de Angel ---- -->
                <li class="nav-item active" data-section="inicio">
                    <a href="#">
                        <i class="ri-home-4-line"></i>
                        <span>Inicio</span>
                    </a>
                </li>
                <li class="nav-item" data-section="profesores">
                    <a href="#">
                        <i class="ri-user-star-line"></i>
                        <span>Profesores</span>
                    </a>
                </li>
                <li class="nav-item" data-section="extraescolares">
                    <a href="#">
                        <i class="ri-trophy-line"></i>
                        <span>Extraescolares</span>
                    </a>
                </li>

                <!-- ---- Secciones de Mariana ---- -->
                <li class="nav-item" data-section="miNivel">
                    <a href="#">
                        <i class="ri-bar-chart-line"></i>
                        <span>Mi Nivel</span>
                    </a>
                </li>
                <li class="nav-item" data-section="misGrupos">
                    <a href="#">
                        <i class="ri-group-line"></i>
                        <span>Mis Grupos</span>
                    </a>
                </li>
                <li class="nav-item" data-section="pagos">
                    <a href="#">
                        <i class="ri-bank-card-line"></i>
                        <span>Pagos</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Opciones al fondo -->
        <div class="sidebar-footer">
            <a href="#" class="nav-footer-item nav-item" data-section="opciones">
                <i class="ri-user-line"></i>
                <span>Mi Perfil</span>
            </a>
        </div>

    </aside>
    <!-- /SIDEBAR -->


    <!-- ===================== CONTENIDO PRINCIPAL ===================== -->
    <main class="main-content" id="main-content">

        <!-- Topbar -->
        <header class="topbar">
            <button class="menu-toggle" id="menu-toggle">
                <i class="ri-menu-line"></i>
            </button>
            <span class="topbar-label">Portal del Estudiante</span>
            <div class="topbar-right">
                <div class="profile-menu-wrapper" id="profile-menu">
                    <!-- Área clickeable (Nombre + Círculo) -->
                    <div class="profile-trigger">
                        <span class="alumno-name-topbar">—</span>
                        <div class="avatar-topbar">—</div>
                    </div>

                    <!-- Menú desplegable flotante -->
                    <div class="profile-dropdown">
                        <div class="profile-header">
                            <span class="profile-name">—</span>
                            <span class="profile-email">—</span>
                        </div>
                        <ul class="profile-options">
                            <li id="btn-logout" class="text-danger"><i class="ri-logout-box-r-line"></i> Cerrar sesión
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>


        <!-- =============================================
             SECCIÓN: INICIO
             Responsable: Angel | S-23
             ============================================= -->
        <div id="section-inicio" class="section-content">
            <div class="page-content">

                {{-- Encabezado --}}
                <div class="page-header">
                    <h1 class="page-title">Bienvenido</h1>
                    <p class="page-subtitle">Aquí está tu resumen académico</p>
                </div>

                {{-- KPI Cards --}}
                <div class="kpi-grid">

                    <div class="kpi-card">
                        <div class="kpi-icon-wrap kpi-icon-naranja">
                            <i class="ri-line-chart-line"></i>
                        </div>
                        <div class="kpi-info">
                            <span class="kpi-label">Nivel Actual</span>
                            <span class="kpi-badge">—</span>
                        </div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-icon-wrap kpi-icon-morado">
                            <i class="ri-line-chart-line"></i>
                        </div>
                        <div class="kpi-info">
                            <span class="kpi-label">Puntos</span>
                            <span class="kpi-value">—</span>
                            <span class="kpi-sub">de 0</span>
                        </div>
                    </div>

                </div>{{-- /kpi-grid --}}

                {{-- Fila inferior --}}
                <div class="bottom-grid">

                    {{-- Horario de Clases --}}
                    <div class="card">
                        <div class="section-card-title">
                            <i class="ri-time-line"></i>
                            Mi Horario de Clases
                        </div>
                        <div class="horario-list">
                            <!-- cargado por dashboardAlumnoInicio.js -->
                        </div>
                    </div>

                    {{-- Actividad Reciente --}}
                    <div class="card">
                        <div class="section-card-title">
                            <i class="ri-history-line"></i>
                            Actividad Reciente
                        </div>
                        <div class="actividad-list">
                            <!-- cargado por dashboardAlumnoInicio.js -->
                        </div>
                    </div>

                    {{-- Mis Grupos --}}
                    <div class="card">
                        <div class="section-card-title">
                            <i class="ri-group-line"></i>
                            Mis Grupos
                        </div>
                        <div class="grupos-list">
                            <!-- cargado por dashboardAlumnoInicio.js -->
                        </div>
                    </div>

                </div>{{-- /bottom-grid --}}

            </div>{{-- /page-content --}}
        </div>
        <!-- /SECCIÓN INICIO -->


        <!-- =============================================
             SECCIÓN: PROFESORES
             Responsable: Angel | S-26
             ============================================= -->
        <div id="section-profesores" class="section-content" style="display:none;">
            <div class="page-content">

                <div class="page-header">
                    <h1 class="page-title">Profesores</h1>
                    <p class="page-subtitle">Directorio y contacto para asesorías</p>
                </div>

                <div class="profesores-grid">

                    {{-- Profesor 1 --}}
                    <div class="profesor-card">
                        <div class="profesor-card-header">
                            <div class="profesor-avatar">G</div>
                            <div>
                                <div class="profesor-nombre">Maestro González</div>
                                <span class="badge badge-maestro-internacional">Maestro Internacional</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div class="profesor-detalles">
                            <div class="profesor-detalle-row">
                                <i class="ri-book-open-line"></i>
                                <span><strong>Especialidad</strong></span>
                            </div>
                            <div class="profesor-detalle-row" style="padding-left:23px; color:var(--texto-suave);">
                                Ajedrez Avanzado
                            </div>
                            <div class="profesor-detalle-row">
                                <i class="ri-award-line"></i>
                                <span><strong>Experiencia</strong></span>
                            </div>
                            <div class="profesor-detalle-row" style="padding-left:23px; color:var(--texto-suave);">
                                15 años de experiencia
                            </div>
                        </div>
                        <div>
                            <div class="profesor-certs-label">Certificaciones</div>
                            <div class="profesor-certs">
                                <span class="cert-badge">Maestro FIDE</span>
                                <span class="cert-badge">Instructor Certificado AMAAC</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div>
                            <div class="profesor-contacto-label">Información de Contacto</div>
                            <div class="profesor-contacto">
                                <div class="contacto-row">
                                    <i class="ri-mail-line"></i>
                                    <a href="mailto:gonzalez@egau.edu">gonzalez@egau.edu</a>
                                </div>
                                <div class="contacto-row">
                                    <i class="ri-phone-line"></i>
                                    <span>555-0101</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Profesor 2 --}}
                    <div class="profesor-card">
                        <div class="profesor-card-header">
                            <div class="profesor-avatar">R</div>
                            <div>
                                <div class="profesor-nombre">Maestra Ramírez</div>
                                <span class="badge badge-maestra-fide">Maestra FIDE</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div class="profesor-detalles">
                            <div class="profesor-detalle-row">
                                <i class="ri-book-open-line"></i>
                                <span><strong>Especialidad</strong></span>
                            </div>
                            <div class="profesor-detalle-row" style="padding-left:23px; color:var(--texto-suave);">
                                Táctica y Estrategia
                            </div>
                            <div class="profesor-detalle-row">
                                <i class="ri-award-line"></i>
                                <span><strong>Experiencia</strong></span>
                            </div>
                            <div class="profesor-detalle-row" style="padding-left:23px; color:var(--texto-suave);">
                                10 años de experiencia
                            </div>
                        </div>
                        <div>
                            <div class="profesor-certs-label">Certificaciones</div>
                            <div class="profesor-certs">
                                <span class="cert-badge">Maestra FIDE</span>
                                <span class="cert-badge">Especialista en Táctica</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div>
                            <div class="profesor-contacto-label">Información de Contacto</div>
                            <div class="profesor-contacto">
                                <div class="contacto-row">
                                    <i class="ri-mail-line"></i>
                                    <a href="mailto:ramirez@egau.edu">ramirez@egau.edu</a>
                                </div>
                                <div class="contacto-row">
                                    <i class="ri-phone-line"></i>
                                    <span>555-0102</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Profesor 3 --}}
                    <div class="profesor-card">
                        <div class="profesor-card-header">
                            <div class="profesor-avatar">L</div>
                            <div>
                                <div class="profesor-nombre">Maestro López</div>
                                <span class="badge badge-gran-maestro">Gran Maestro</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div class="profesor-detalles">
                            <div class="profesor-detalle-row">
                                <i class="ri-book-open-line"></i>
                                <span><strong>Especialidad</strong></span>
                            </div>
                            <div class="profesor-detalle-row" style="padding-left:23px; color:var(--texto-suave);">
                                Finales y Aperturas
                            </div>
                            <div class="profesor-detalle-row">
                                <i class="ri-award-line"></i>
                                <span><strong>Experiencia</strong></span>
                            </div>
                            <div class="profesor-detalle-row" style="padding-left:23px; color:var(--texto-suave);">
                                20 años de experiencia
                            </div>
                        </div>
                        <div>
                            <div class="profesor-certs-label">Certificaciones</div>
                            <div class="profesor-certs">
                                <span class="cert-badge">Gran Maestro FIDE</span>
                                <span class="cert-badge">Campeón Nacional 2015</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div>
                            <div class="profesor-contacto-label">Información de Contacto</div>
                            <div class="profesor-contacto">
                                <div class="contacto-row">
                                    <i class="ri-mail-line"></i>
                                    <a href="mailto:lopez@egau.edu">lopez@egau.edu</a>
                                </div>
                                <div class="contacto-row">
                                    <i class="ri-phone-line"></i>
                                    <span>555-0103</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Profesor 4 --}}
                    <div class="profesor-card">
                        <div class="profesor-card-header">
                            <div class="profesor-avatar">T</div>
                            <div>
                                <div class="profesor-nombre">Maestra Torres</div>
                                <span class="badge badge-maestra-internacional">Maestra Internacional</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div class="profesor-detalles">
                            <div class="profesor-detalle-row">
                                <i class="ri-book-open-line"></i>
                                <span><strong>Especialidad</strong></span>
                            </div>
                            <div class="profesor-detalle-row" style="padding-left:23px; color:var(--texto-suave);">
                                Entrenamiento de Alto Rendimiento
                            </div>
                            <div class="profesor-detalle-row">
                                <i class="ri-award-line"></i>
                                <span><strong>Experiencia</strong></span>
                            </div>
                            <div class="profesor-detalle-row" style="padding-left:23px; color:var(--texto-suave);">
                                12 años de experiencia
                            </div>
                        </div>
                        <div>
                            <div class="profesor-certs-label">Certificaciones</div>
                            <div class="profesor-certs">
                                <span class="cert-badge">Maestra FIDE</span>
                                <span class="cert-badge">Coach Certificado</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div>
                            <div class="profesor-contacto-label">Información de Contacto</div>
                            <div class="profesor-contacto">
                                <div class="contacto-row">
                                    <i class="ri-mail-line"></i>
                                    <a href="mailto:torres@egau.edu">torres@egau.edu</a>
                                </div>
                                <div class="contacto-row">
                                    <i class="ri-phone-line"></i>
                                    <span>555-0104</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Profesor 5 --}}
                    <div class="profesor-card">
                        <div class="profesor-card-header">
                            <div class="profesor-avatar">H</div>
                            <div>
                                <div class="profesor-nombre">Maestro Hernández</div>
                                <span class="badge badge-candidato-maestro">Candidato a Maestro</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div class="profesor-detalles">
                            <div class="profesor-detalle-row">
                                <i class="ri-book-open-line"></i>
                                <span><strong>Especialidad</strong></span>
                            </div>
                            <div class="profesor-detalle-row" style="padding-left:23px; color:var(--texto-suave);">
                                Iniciación y Fundamentos
                            </div>
                            <div class="profesor-detalle-row">
                                <i class="ri-award-line"></i>
                                <span><strong>Experiencia</strong></span>
                            </div>
                            <div class="profesor-detalle-row" style="padding-left:23px; color:var(--texto-suave);">
                                8 años de experiencia
                            </div>
                        </div>
                        <div>
                            <div class="profesor-certs-label">Certificaciones</div>
                            <div class="profesor-certs">
                                <span class="cert-badge">Instructor Nivel 1 AMAAC</span>
                                <span class="cert-badge">Pedagogo Certificado</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div>
                            <div class="profesor-contacto-label">Información de Contacto</div>
                            <div class="profesor-contacto">
                                <div class="contacto-row">
                                    <i class="ri-mail-line"></i>
                                    <a href="mailto:hernandez@egau.edu">hernandez@egau.edu</a>
                                </div>
                                <div class="contacto-row">
                                    <i class="ri-phone-line"></i>
                                    <span>555-0105</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Profesor 6 --}}
                    <div class="profesor-card">
                        <div class="profesor-card-header">
                            <div class="profesor-avatar">S</div>
                            <div>
                                <div class="profesor-nombre">Maestra Sánchez</div>
                                <span class="badge badge-maestra-fide">Maestra FIDE</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div class="profesor-detalles">
                            <div class="profesor-detalle-row">
                                <i class="ri-book-open-line"></i>
                                <span><strong>Especialidad</strong></span>
                            </div>
                            <div class="profesor-detalle-row" style="padding-left:23px; color:var(--texto-suave);">
                                Ajedrez Infantil
                            </div>
                            <div class="profesor-detalle-row">
                                <i class="ri-award-line"></i>
                                <span><strong>Experiencia</strong></span>
                            </div>
                            <div class="profesor-detalle-row" style="padding-left:23px; color:var(--texto-suave);">
                                11 años de experiencia
                            </div>
                        </div>
                        <div>
                            <div class="profesor-certs-label">Certificaciones</div>
                            <div class="profesor-certs">
                                <span class="cert-badge">Maestra FIDE</span>
                                <span class="cert-badge">Especialista en Educación Infantil</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div>
                            <div class="profesor-contacto-label">Información de Contacto</div>
                            <div class="profesor-contacto">
                                <div class="contacto-row">
                                    <i class="ri-mail-line"></i>
                                    <a href="mailto:sanchez@egau.edu">sanchez@egau.edu</a>
                                </div>
                                <div class="contacto-row">
                                    <i class="ri-phone-line"></i>
                                    <span>555-0106</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>{{-- /profesores-grid --}}
            </div>{{-- /page-content --}}
        </div>
        <!-- /SECCIÓN PROFESORES -->


        <!-- =============================================
             SECCIÓN: EXTRAESCOLARES
             Responsable: Angel | S-27
             ============================================= -->
        <div id="section-extraescolares" class="section-content" style="display:none;">
            <div class="page-content">

                <div class="page-header">
                    <h1 class="page-title">Extraescolares</h1>
                    <p class="page-subtitle">Inscríbete en actividades extraescolares y desarrolla tus habilidades</p>
                </div>

                {{-- Mis Inscripciones --}}
                <div class="mis-inscripciones">
                    <div class="mis-inscripciones-titulo">MIS INSCRIPCIONES</div>
                    <div id="lista-mis-inscripciones">
                        <!-- cargado por dashboardAlumnoExtraescolares.js -->
                    </div>
                </div>

                {{-- Buscador + Filtros --}}
                <div class="search-filtros-card">
                    <div class="search-bar-extra">
                        <i class="ri-search-line"></i>
                        <input type="text" id="buscador-extra" placeholder="Buscar actividad...">
                    </div>
                </div>

                {{-- Catálogo de actividades --}}
                <div class="actividades-grid" id="actividades-grid">
                    <!-- cargado por dashboardAlumnoExtraescolares.js -->
                </div>

                <p class="actividades-empty" id="extra-empty">No se encontraron actividades.</p>

            </div>{{-- /page-content --}}
        </div>
        <!-- /SECCIÓN EXTRAESCOLARES -->


        <!-- =============================================
             SECCIÓN: MI NIVEL
             Responsable: Mariana
             ============================================= -->
        <div id="section-miNivel" class="section-content" style="display:none;">
            <div class="page-content">
                <div class="page-header">
                    <h1 class="page-title">Mi Nivel y Progreso</h1>
                    <p class="page-subtitle">Puntuaciones, progreso académico y tablas de clasificación.</p>
                </div>

                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px; margin-bottom: 40px;">

                    <div class="card"
                        style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 32px 24px; border-top: 4px solid var(--naranja); align-self: start;">
                        <div
                            style="width: 80px; height: 80px; background-color: var(--naranja-light); border-radius: 50%; display: flex; justify-content: center; align-items: center; margin-bottom: 16px;">
                            <span id="nivel_icono"
                                style="font-size: 48px; color: var(--naranja); visibility: hidden;"></span>
                        </div>
                        <h2 id="nivel_nombre"
                            style="font-size: 28px; font-weight: 700; color: var(--texto); margin: 0 0 8px 0; font-family: 'Cinzel', serif; visibility: hidden;">
                            —</h2>
                        <p id="nivel_desc"
                            style="font-size: 15px; color: var(--texto-suave); margin: 0 0 24px 0; visibility: hidden;">
                            —</p>

                        <div style="width: 100%; display: flex; flex-direction: column; gap: 8px;">
                            <div
                                style="display: flex; justify-content: space-between; font-size: 14px; font-weight: 600;">
                                <span id="nivel_siguiente_texto" style="color: var(--texto-suave);">Progreso a
                                    Torre</span>
                                <span id="nivel_progreso" style="color: var(--naranja);">0 / 200</span>
                            </div>
                            <div class="progress-wrap" style="height: 12px; border-radius: 10px;">
                                <div id="progress-fill-nivel" class="progress-fill"
                                    style="width: 0%; border-radius: 10px;"></div>
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        <h3 style="font-size: 18px; font-weight: 600; color: var(--texto); margin: 0;">Tus logros</h3>

                        <div style="display: grid; grid-template-columns: 1fr; gap: 16px;">

                            {{-- Posición en Ranking Sede --}}
                            <div class="card"
                                style="display: flex; align-items: center; gap: 16px; padding: 16px 20px;">
                                <div
                                    style="width: 48px; height: 48px; background-color: rgba(46, 125, 50, 0.1); border-radius: 12px; display: flex; justify-content: center; align-items: center;">
                                    <i class="ri-arrow-up-circle-fill"
                                        style="font-size: 24px; color: var(--verde);"></i>
                                </div>
                                <div>
                                    <p style="font-size: 13px; color: var(--texto-suave); margin: 0 0 4px 0;">Tu
                                        Posición Local</p>
                                    <h4 id="puesto_sede"
                                        style="font-size: 20px; font-weight: 700; color: var(--texto); margin: 0;"></h4>
                                </div>
                            </div>

                            {{-- Posición en Ranking Global --}}
                            <div class="card"
                                style="display: flex; align-items: center; gap: 16px; padding: 16px 20px;">
                                <div
                                    style="width: 48px; height: 48px; background-color: rgba(26, 115, 232, 0.1); border-radius: 12px; display: flex; justify-content: center; align-items: center;">
                                    <i class="ri-trophy-fill" style="font-size: 24px; color: var(--azul);"></i>
                                </div>
                                <div>
                                    <p style="font-size: 13px; color: var(--texto-suave); margin: 0 0 4px 0;">Tu
                                        Posición Global</p>
                                    <h4 id="puesto_global"
                                        style="font-size: 20px; font-weight: 700; color: var(--texto); margin: 0;"></h4>
                                </div>
                            </div>

                            {{-- Logros (colapsable) --}}
                            <div class="card" id="card-logros"
                                style="display: flex; align-items: center; gap: 16px; padding: 16px 20px; cursor: pointer; transition: background-color 0.2s;">
                                <div
                                    style="width: 48px; height: 48px; background-color: var(--naranja-light); border-radius: 12px; display: flex; justify-content: center; align-items: center;">
                                    <i class="ri-star-smile-fill" style="font-size: 24px; color: var(--naranja);"></i>
                                </div>
                                <div style="flex-grow: 1;">
                                    <p style="font-size: 13px; color: var(--texto-suave); margin: 0 0 4px 0;">Logros
                                        Desbloqueados</p>
                                    <h4 style="font-size: 20px; font-weight: 700; color: var(--texto); margin: 0;"></h4>
                                </div>
                                <i class="ri-arrow-down-s-line" id="icon-logros"
                                    style="font-size: 24px; color: var(--texto-suave); transition: transform 0.3s ease;"></i>
                            </div>

                            {{-- Logros Desplegables (ocultos por defecto) --}}
                            <div id="logros-desplegables"
                                style="display: none; flex-direction: column; gap: 12px; margin-top: 12px;">
                            </div>

                        </div>
                    </div>
                </div>

                <div>
                    <h2
                        style="font-size: 20px; font-weight: 600; color: var(--texto); margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                        <i class="ri-bar-chart-grouped-fill" style="color: var(--naranja);"></i>Clasificación Local
                        <small>(Top 10)</small>
                    </h2>
                    <div class="card" style="padding: 0; overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 600px;">
                            <thead>
                                <tr style="background-color: #f8f9fa; border-bottom: 2px solid var(--borde);">
                                    <th
                                        style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--texto-suave); text-transform: uppercase;">
                                        Pos</th>
                                    <th
                                        style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--texto-suave); text-transform: uppercase;">
                                        Alumno</th>
                                    <th
                                        style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--texto-suave); text-transform: uppercase;">
                                        Nivel</th>
                                    <th
                                        style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--texto-suave); text-transform: uppercase; text-align: right;">
                                        Puntos Totales</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-ranking-sede-body">
                                <tr style="border-bottom: 1px solid var(--borde);">
                                    <td style="padding: 16px; font-weight: 700; color: #d4af37;"><i
                                            class="ri-medal-fill"></i> 1</td>
                                    <td style="padding: 16px; font-weight: 500; color: var(--texto);">Daniela Paz Alfaro
                                    </td>
                                    <td style="padding: 16px;"><span class="badge badge-naranja">Nivel 6</span></td>
                                    <td
                                        style="padding: 16px; text-align: right; font-weight: 600; color: var(--texto);">
                                        1650</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br><br>
                <div>
                    <h2
                        style="font-size: 20px; font-weight: 600; color: var(--texto); margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                        <i class="ri-bar-chart-grouped-fill" style="color: var(--naranja);"></i>Clasificación Global
                        <small>(Top 10)</small>
                    </h2>

                    <div class="card" style="padding: 0; overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 600px;">
                            <thead>
                                <tr style="background-color: #f8f9fa; border-bottom: 2px solid var(--borde);">
                                    <th
                                        style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--texto-suave); text-transform: uppercase;">
                                        Pos</th>
                                    <th
                                        style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--texto-suave); text-transform: uppercase;">
                                        Alumno</th>
                                    <th
                                        style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--texto-suave); text-transform: uppercase;">
                                        Nivel</th>
                                    <th
                                        style="padding: 16px; font-size: 13px; font-weight: 600; color: var(--texto-suave); text-transform: uppercase; text-align: right;">
                                        Puntos Totales</th>
                                </tr>
                            </thead>
                            <tbody id="tabla-ranking-body">
                                <tr style="border-bottom: 1px solid var(--borde);">
                                    <td style="padding: 16px; font-weight: 700; color: #d4af37;"><i
                                            class="ri-medal-fill"></i> 1</td>
                                    <td style="padding: 16px; font-weight: 500; color: var(--texto);">Daniela Paz Alfaro
                                    </td>
                                    <td style="padding: 16px;"><span class="badge badge-naranja">Nivel 6</span></td>
                                    <td
                                        style="padding: 16px; text-align: right; font-weight: 600; color: var(--texto);">
                                        1650</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- /SECCIÓN MI NIVEL -->


        <!-- =============================================
             SECCIÓN: MIS GRUPOS
             Responsable: Mariana
             ============================================= -->
        <div id="section-misGrupos" class="section-content" style="display:none;">
            <div class="page-content">
                <div class="page-header">
                    <h1 class="page-title">Mis Grupos</h1>
                    <p class="page-subtitle">Gestiona tus inscripciones y explora nuevas opciones para tu nivel.</p>
                </div>

                <div
                    style="background-color: var(--azul-light); color: var(--azul); padding: 16px; border-radius: 12px; margin-bottom: 32px; display: flex; align-items: flex-start; gap: 12px; border: 1px solid rgba(26, 115, 232, 0.2);">
                    <i class="ri-information-line" style="font-size: 20px;"></i>
                    <div>
                        <h4 style="margin: 0 0 4px 0; font-size: 15px;">Periodo de inscripción abierto</h4>
                        <p style="margin: 0; font-size: 14px; opacity: 0.9;">Tienes hasta el viernes para realizar
                            cambios en tus grupos actuales o inscribirte a nuevos módulos de Nivel 5.</p>
                    </div>
                </div>

                <div style="margin-bottom: 40px;">
                    <h2
                        style="font-size: 20px; font-weight: 600; color: var(--texto); margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                        <i class="ri-bookmark-3-line" style="color: var(--naranja);"></i> Grupos Inscritos
                    </h2>

                    <div id="lista-mis-grupos"
                        style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
                        <!-- JS renders enrolled groups here -->
                    </div>
                </div>

                <hr style="border: none; border-top: 1px dashed var(--borde); margin: 30px 0;">

                <div>
                    <h2
                        style="font-size: 20px; font-weight: 600; color: var(--texto); margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
                        <i class="ri-search-eye-line" style="color: var(--azul);"></i> Grupos Disponibles
                    </h2>
                    <div id="lista-grupos-disponibles"
                        style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 24px;">
                        <!-- JS renders available groups here -->
                    </div>
                </div>

            </div>
        </div>
        <!-- /SECCIÓN MIS GRUPOS -->


        <!-- =============================================
             SECCIÓN: PAGOS
             Responsable: Mariana
             ============================================= -->
        <div id="section-pagos" class="section-content" style="display:none;">
            <div class="page-content">
                <div class="page-header">
                    <h1 class="page-title">Pagos</h1>
                    <p class="page-subtitle">Esta sección estará disponible próximamente</p>
                </div>
                <div class="card"
                    style="min-height:400px; display:flex; align-items:center; justify-content:center; flex-direction:column; gap:16px; color:var(--texto-suave);">
                    <i class="ri-bank-card-line" style="font-size:48px; color:var(--borde);"></i>
                    <p style="font-size:15px;">Sección en construcción</p>
                </div>
            </div>
        </div>
        <!-- /SECCIÓN PAGOS -->


        <!-- =============================================
             SECCIÓN: MI PERFIL (stub — contenido movido a Opciones S-46)
             ============================================= -->
        <div id="section-miPerfil" class="section-content" style="display:none;">
            <div class="page-content">
                <div class="stub-placeholder">
                    <i class="ri-user-line"></i>
                    <span>Usa "Mi Perfil" en la parte inferior del menú lateral.</span>
                </div>
            </div>
        </div>
        <!-- /SECCIÓN MI PERFIL -->


        <!-- =============================================
             SECCIÓN: MI PERFIL / OPCIONES
             S-46: recibe contenido de Mi Perfil
             ============================================= -->
        <div id="section-opciones" class="section-content" style="display:none;">
            <div class="page-content">

                <div class="page-header">
                    <h1 class="page-title">Mi Perfil</h1>
                    <p class="page-subtitle">Gestiona tu información personal, académica y de seguridad.</p>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 32px; align-items: start;">

                    <div style="display: flex; flex-direction: column; gap: 24px;">
                        <div class="card" style="text-align: center; padding: 40px 24px;">
                            <div style="position: relative; width: 120px; height: 120px; margin: 0 auto 20px;">
                                <div id="perfil_avatar_inicial"
                                    style="width: 100%; height: 100%; border-radius: 50%; background-color: var(--naranja); color: white; display: flex; align-items: center; justify-content: center; font-size: 48px; font-weight: 700;">
                                    A</div>
                                <button
                                    style="position: absolute; bottom: 0; right: 0; background: var(--blanco); border: 1px solid var(--borde); width: 36px; height: 36px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; color: var(--texto);">
                                    <i class="ri-camera-line"></i>
                                </button>
                            </div>
                            <h2 id="perfil_nombre_header" style="margin: 0; font-size: 20px; color: var(--texto);">
                                Alumno</h2>
                            <p id="perfil_nivel_header"
                                style="color: var(--texto-suave); font-size: 14px; margin: 4px 0 20px;">Estudiante de
                                Nivel </p>
                            <button class="btn-inscribirse" style="width: auto; padding: 8px 20px;">Editar Foto</button>
                        </div>

                        <div class="card" style="padding: 24px;">
                            <h3
                                style="font-size: 16px; margin-bottom: 20px; border-bottom: 1px solid var(--borde); padding-bottom: 10px;">
                                Información Académica</h3>
                            <div style="display: flex; flex-direction: column; gap: 16px;">
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: var(--texto-suave); font-size: 14px;">Nivel Actual:</span>
                                    <span id="perfil_nivel_badge" class="badge badge-naranja">Nivel </span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: var(--texto-suave); font-size: 14px;">Puntos Totales:</span>
                                    <span style="font-weight: 600; color: var(--texto);" id="info_puntaje">—</span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: var(--texto-suave); font-size: 14px;">Sede:</span>
                                    <span style="font-weight: 600; color: var(--texto);" id="info_sede">—</span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: var(--texto-suave); font-size: 14px;">Fecha de
                                        Nacimiento:</span>
                                    <span style="font-weight: 600; color: var(--texto);" id="info_nacimiento">—</span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="color: var(--texto-suave); font-size: 14px;">Fecha de Ingreso:</span>
                                    <span style="font-weight: 600; color: var(--texto);" id="info_ingreso">—</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 24px;">

                        <div class="card" style="padding: 32px;">
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                                <h3 style="font-size: 18px; margin: 0;"><i class="ri-user-settings-line"
                                        style="color: var(--naranja);"></i> Datos Personales</h3>
                                <button id="btnEditProfile"
                                    style="color: var(--naranja); background: none; border: none; font-weight: 600; cursor: pointer; text-decoration: underline;">Editar
                                    Perfil</button>
                            </div>
                            <form id="form-personal" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    <label
                                        style="font-size: 13px; font-weight: 600; color: var(--texto-suave);">Nombre(s)</label>
                                    <input type="text" id="perfil_nombre" disabled class="perfil-editable"
                                        style="padding: 10px; border: 1px solid var(--borde); border-radius: 8px; font-family: 'Inter', sans-serif;">
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    <label
                                        style="font-size: 13px; font-weight: 600; color: var(--texto-suave);">Apellido
                                        Paterno</label>
                                    <input type="text" id="perfil_apellido_p" disabled class="perfil-editable"
                                        style="padding: 10px; border: 1px solid var(--borde); border-radius: 8px; font-family: 'Inter', sans-serif;">
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    <label
                                        style="font-size: 13px; font-weight: 600; color: var(--texto-suave);">Apellido
                                        Materno</label>
                                    <input type="text" id="perfil_apellido_m" disabled class="perfil-editable"
                                        style="padding: 10px; border: 1px solid var(--borde); border-radius: 8px; font-family: 'Inter', sans-serif;">
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    <label style="font-size: 13px; font-weight: 600; color: var(--texto-suave);">Correo
                                        Electrónico</label>
                                    <input type="email" id="perfil_email" disabled class="perfil-editable"
                                        style="padding: 10px; border: 1px solid var(--borde); border-radius: 8px; font-family: 'Inter', sans-serif;">
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    <label
                                        style="font-size: 13px; font-weight: 600; color: var(--texto-suave);">Teléfono</label>
                                    <input type="text" id="perfil_telefono" disabled class="perfil-editable"
                                        style="padding: 10px; border: 1px solid var(--borde); border-radius: 8px; font-family: 'Inter', sans-serif;">
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    <label
                                        style="font-size: 13px; font-weight: 600; color: var(--texto-suave);">Calle</label>
                                    <input type="text" id="perfil_calle" disabled class="perfil-editable"
                                        style="padding: 10px; border: 1px solid var(--borde); border-radius: 8px; font-family: 'Inter', sans-serif;">
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    <label
                                        style="font-size: 13px; font-weight: 600; color: var(--texto-suave);">Ciudad</label>
                                    <input type="text" id="perfil_ciudad" disabled class="perfil-editable"
                                        style="padding: 10px; border: 1px solid var(--borde); border-radius: 8px; font-family: 'Inter', sans-serif;">
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    <label
                                        style="font-size: 13px; font-weight: 600; color: var(--texto-suave);">Estado</label>
                                    <input type="text" id="perfil_estado" disabled class="perfil-editable"
                                        style="padding: 10px; border: 1px solid var(--borde); border-radius: 8px; font-family: 'Inter', sans-serif;">
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    <label style="font-size: 13px; font-weight: 600; color: var(--texto-suave);">Código
                                        Postal</label>
                                    <input type="text" id="perfil_cp" disabled class="perfil-editable"
                                        style="padding: 10px; border: 1px solid var(--borde); border-radius: 8px; font-family: 'Inter', sans-serif;">
                                </div>
                                <div
                                    style="display: flex; flex-direction: column; gap: 8px; justify-content: flex-end;">
                                    <button type="button" id="btnGuardarPerfil" class="btn-inscribirse inscribir"
                                        style="display: none;">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>

                        <div class="card"
                            style="padding: 32px; background-color: #fafafa; border: 1px dashed var(--borde);">
                            <h3 style="font-size: 18px; margin-bottom: 24px;"><i class="ri-parent-line"
                                    style="color: var(--azul);"></i> Información del Tutor</h3>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                                <div>
                                    <p style="font-size: 13px; color: var(--texto-suave); margin-bottom: 4px;">Nombre(s)
                                    </p>
                                    <p style="font-weight: 600; color: var(--texto);" id="tutor_nombre">—</p>
                                </div>
                                <div>
                                    <p style="font-size: 13px; color: var(--texto-suave); margin-bottom: 4px;">Apellidos
                                    </p>
                                    <p style="font-weight: 600; color: var(--texto);" id="tutor_apellidos">—</p>
                                </div>
                                <div>
                                    <p style="font-size: 13px; color: var(--texto-suave); margin-bottom: 4px;">
                                        Parentesco</p>
                                    <p style="font-weight: 600; color: var(--texto);" id="tutor_parentesco">—</p>
                                </div>
                                <div>
                                    <p style="font-size: 13px; color: var(--texto-suave); margin-bottom: 4px;">Teléfono
                                    </p>
                                    <p style="font-weight: 600; color: var(--texto);" id="tutor_telefono">—</p>
                                </div>
                                <div>
                                    <p style="font-size: 13px; color: var(--texto-suave); margin-bottom: 4px;">Correo
                                    </p>
                                    <p style="font-weight: 600; color: var(--texto);" id="tutor_email">—</p>
                                </div>
                            </div>
                        </div>

                        <div class="card" style="padding: 32px;">
                            <h3 style="font-size: 18px; margin-bottom: 24px;"><i class="ri-lock-password-line"
                                    style="color: var(--naranja);"></i> Seguridad</h3>
                            <form id="formPassword"
                                style="display: flex; flex-direction: column; gap: 16px; max-width: 400px;">
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    <label
                                        style="font-size: 13px; font-weight: 600; color: var(--texto-suave);">Contraseña
                                        Antigua</label>
                                    <input type="password" id="old_pass" placeholder="••••••••"
                                        style="padding: 10px; border: 1px solid var(--borde); border-radius: 8px; font-family: 'Inter', sans-serif;">
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    <label style="font-size: 13px; font-weight: 600; color: var(--texto-suave);">Nueva
                                        Contraseña</label>
                                    <input type="password" id="new_pass" placeholder="Mínimo 8 caracteres"
                                        style="padding: 10px; border: 1px solid var(--borde); border-radius: 8px; font-family: 'Inter', sans-serif;">
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 8px;">
                                    <label
                                        style="font-size: 13px; font-weight: 600; color: var(--texto-suave);">Confirmar
                                        Nueva Contraseña</label>
                                    <input type="password" id="confirm_pass" placeholder="Repite la contraseña"
                                        style="padding: 10px; border: 1px solid var(--borde); border-radius: 8px; font-family: 'Inter', sans-serif;">
                                </div>
                                <div style="display: flex; justify-content: flex-end; width: 100%;">
                                    <button type="button" onclick="validarPassword()" class="btn-inscribirse inscribir"
                                        style="width: auto; padding: 10px 24px;">
                                        Actualizar Contraseña
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- /SECCIÓN MI PERFIL / OPCIONES -->


    </main>
    <!-- /CONTENIDO PRINCIPAL -->

    <!-- JS -->
    <script src="{{ asset('animaciones/alumno/dashboardAlumno.js') }}"></script>
    {{-- JS secciones Angel --}}
    <script src="{{ asset('animaciones/alumno/dashboardAlumnoInicio.js') }}"></script>
    <script src="{{ asset('animaciones/alumno/dashboardAlumnoProfesores.js') }}"></script>
    <script src="{{ asset('animaciones/alumno/dashboardAlumnoExtraescolares.js') }}"></script>
    {{-- JS secciones Mariana --}}
    <script src="{{ asset('animaciones/alumno/dashboardAlumnoMiNivel.js') }}"></script>
    <script src="{{ asset('animaciones/alumno/dashboardAlumnoMisGrupos.js') }}"></script>
    <script src="{{ asset('animaciones/alumno/dashboardAlumnoPagos.js') }}"></script>
    <script src="{{ asset('animaciones/alumno/dashboardAlumnoMiPerfil.js') }}"></script>
</body>

</html>