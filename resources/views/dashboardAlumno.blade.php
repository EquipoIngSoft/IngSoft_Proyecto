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
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
    <link rel="stylesheet" href="{{ asset('css/dashboardAlumno/dashboardAlumno.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboardAlumno/inicio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboardAlumno/profesores.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboardAlumno/extraescolares.css') }}">
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
                <li class="nav-item" data-section="miPerfil">
                    <a href="#">
                        <i class="ri-user-line"></i>
                        <span>Mi Perfil</span>
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
                        <span class="alumno-name-topbar">Ana García</span>
                        <div class="avatar-topbar">A</div>
                    </div>

                    <!-- Menú desplegable flotante -->
                    <div class="profile-dropdown">
                        <div class="profile-header">
                            <span class="profile-name">Ana García</span>
                            <span class="profile-email">ana.garcia@egau.com</span>
                        </div>
                        <ul class="profile-options">
                            <li id="btn-config-perfil"><i class="ri-settings-3-line"></i> Configuración</li>
                            <li id="btn-logout" class="text-danger"><i class="ri-logout-box-r-line"></i> Cerrar sesión</li>
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
                    <h1 class="page-title">Bienvenido, Ana García</h1>
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
                            <span class="kpi-badge">Nivel 5</span>
                        </div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-icon-wrap kpi-icon-morado">
                            <i class="ri-line-chart-line"></i>
                        </div>
                        <div class="kpi-info">
                            <span class="kpi-label">Puntos</span>
                            <span class="kpi-value">1450</span>
                            <span class="kpi-sub">de 2000</span>
                        </div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-icon-wrap kpi-icon-azul">
                            <i class="ri-group-line"></i>
                        </div>
                        <div class="kpi-info">
                            <span class="kpi-label">Grupo</span>
                            <span class="kpi-value">Grupo A</span>
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
                            <div class="horario-item">
                                <div class="horario-dia">
                                    Lunes
                                    <span>14:00 - 15:30</span>
                                </div>
                                <div>
                                    <div class="horario-materia">Táctica</div>
                                    <div class="horario-aula">Aula 101</div>
                                </div>
                            </div>
                            <div class="horario-item">
                                <div class="horario-dia">
                                    Miércoles
                                    <span>14:00 - 15:30</span>
                                </div>
                                <div>
                                    <div class="horario-materia">Estrategia</div>
                                    <div class="horario-aula">Aula 101</div>
                                </div>
                            </div>
                            <div class="horario-item">
                                <div class="horario-dia">
                                    Viernes
                                    <span>16:00 - 17:00</span>
                                </div>
                                <div>
                                    <div class="horario-materia">Ajedrez Avanzado</div>
                                    <div class="horario-aula">Aula 203</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Actividad Reciente --}}
                    <div class="card">
                        <div class="section-card-title">
                            <i class="ri-history-line"></i>
                            Actividad Reciente
                        </div>
                        <div class="actividad-list">
                            <div class="actividad-item">
                                <div class="actividad-dot dot-verde"></div>
                                <div>
                                    <div class="actividad-texto">Nuevo logro desbloqueado</div>
                                    <div class="actividad-sub">Has alcanzado el Nivel 5 · hace 2 días</div>
                                </div>
                            </div>
                            <div class="actividad-item">
                                <div class="actividad-dot dot-azul"></div>
                                <div>
                                    <div class="actividad-texto">Pago registrado</div>
                                    <div class="actividad-sub">Mensualidad de Febrero · hace 3 días</div>
                                </div>
                            </div>
                            <div class="actividad-item">
                                <div class="actividad-dot dot-morado"></div>
                                <div>
                                    <div class="actividad-texto">Clase completada</div>
                                    <div class="actividad-sub">Táctica Avanzada · hace 1 semana</div>
                                </div>
                            </div>
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
                    <div class="mis-inscripciones-titulo">Mis Inscripciones</div>
                    <div id="sin-inscripciones" style="display:none; font-size:14px; color:var(--texto-suave); padding:8px 0;">Sin inscripciones activas.</div>
                    <div id="lista-mis-inscripciones"><div class="inscripcion-activa">
                        <div>
                            <div class="inscripcion-activa-nombre">Táctica y Estrategia</div>
                            <div class="inscripcion-activa-horario">Lunes y Miércoles · 14:00 - 15:30</div>
                        </div>
                        <i class="ri-checkbox-circle-line inscripcion-activa-check"></i>
                    </div></div>
                </div>

                {{-- Buscador + Filtros --}}
                <div class="search-filtros-card">
                    <div class="search-bar-extra">
                        <i class="ri-search-line"></i>
                        <input type="text" id="buscador-extra" placeholder="Buscar actividad...">
                    </div>
                    <div class="filtros-categorias">
                        <button class="btn-filtro activo" data-categoria="todas">Todas</button>
                        <button class="btn-filtro" data-categoria="ajedrez">Ajedrez</button>
                        <button class="btn-filtro" data-categoria="teoria">Teoría</button>
                    </div>
                </div>

                {{-- Catálogo de actividades --}}
                <div class="actividades-grid" id="actividades-grid">

                    {{-- Tarjeta 1: Ajedrez Avanzado --}}
                    <div class="actividad-card" data-nombre="ajedrez avanzado" data-categoria="ajedrez" data-id="1" data-horario="Martes y Jueves · 16:00 - 18:00">
                        <div class="actividad-nombre">Ajedrez Avanzado</div>
                        <span class="badge badge-naranja" style="align-self:flex-start;">Ajedrez</span>
                        <p style="font-size:13px; color:var(--texto-suave); margin:0;">Entrenamiento intensivo para torneos</p>
                        <div class="actividad-info-row"><i class="ri-user-star-line"></i> Maestro González</div>
                        <div class="actividad-info-row"><i class="ri-calendar-line"></i> Martes y Jueves</div>
                        <div class="actividad-info-row"><i class="ri-time-line"></i> 16:00 - 18:00</div>
                        <div>
                            <div class="cupo-label">
                                <span>Cupo disponible</span>
                                <span>12 / 15</span>
                            </div>
                            <div class="progress-wrap">
                                <div class="progress-fill" style="width:80%;"></div>
                            </div>
                        </div>
                        <button class="btn-inscribirse inscribir">
                            <i class="ri-checkbox-circle-line"></i> Inscribirse
                        </button>
                    </div>

                    {{-- Tarjeta 2: Táctica y Estrategia (inscrito) --}}
                    <div class="actividad-card" data-nombre="tactica y estrategia" data-categoria="ajedrez" data-id="2" data-horario="Lunes y Miércoles · 14:00 - 15:30">
                        <i class="ri-checkbox-circle-line actividad-card-check"></i>
                        <div class="actividad-nombre">Táctica y Estrategia</div>
                        <span class="badge badge-naranja" style="align-self:flex-start;">Ajedrez</span>
                        <p style="font-size:13px; color:var(--texto-suave); margin:0;">Desarrollo de habilidades tácticas</p>
                        <div class="actividad-info-row"><i class="ri-user-star-line"></i> Maestra Ramírez</div>
                        <div class="actividad-info-row"><i class="ri-calendar-line"></i> Lunes y Miércoles</div>
                        <div class="actividad-info-row"><i class="ri-time-line"></i> 14:00 - 15:30</div>
                        <div>
                            <div class="cupo-label">
                                <span>Cupo disponible</span>
                                <span>18 / 20</span>
                            </div>
                            <div class="progress-wrap">
                                <div class="progress-fill" style="width:90%;"></div>
                            </div>
                        </div>
                        <button class="btn-inscribirse cancelar">
                            <i class="ri-close-circle-line"></i> Cancelar Inscripción
                        </button>
                    </div>

                    {{-- Tarjeta 3: Finales de Partida --}}
                    <div class="actividad-card" data-nombre="finales de partida" data-categoria="ajedrez" data-id="3" data-horario="Viernes · 17:00 - 18:30">
                        <div class="actividad-nombre">Finales de Partida</div>
                        <span class="badge badge-naranja" style="align-self:flex-start;">Ajedrez</span>
                        <p style="font-size:13px; color:var(--texto-suave); margin:0;">Especialización en finales</p>
                        <div class="actividad-info-row"><i class="ri-user-star-line"></i> Maestro López</div>
                        <div class="actividad-info-row"><i class="ri-calendar-line"></i> Viernes</div>
                        <div class="actividad-info-row"><i class="ri-time-line"></i> 17:00 - 18:30</div>
                        <div>
                            <div class="cupo-label">
                                <span>Cupo disponible</span>
                                <span>8 / 12</span>
                            </div>
                            <div class="progress-wrap">
                                <div class="progress-fill" style="width:67%;"></div>
                            </div>
                        </div>
                        <button class="btn-inscribirse inscribir">
                            <i class="ri-checkbox-circle-line"></i> Inscribirse
                        </button>
                    </div>

                    {{-- Tarjeta 4: Análisis de Partidas Magistrales --}}
                    <div class="actividad-card" data-nombre="analisis de partidas magistrales" data-categoria="teoria" data-id="4" data-horario="Sábado · 15:00 - 16:30">
                        <div class="actividad-nombre">Análisis de Partidas Magistrales</div>
                        <span class="badge badge-azul" style="align-self:flex-start;">Teoría</span>
                        <p style="font-size:13px; color:var(--texto-suave); margin:0;">Estudio de partidas históricas</p>
                        <div class="actividad-info-row"><i class="ri-user-star-line"></i> Maestro Hernández</div>
                        <div class="actividad-info-row"><i class="ri-calendar-line"></i> Sábado</div>
                        <div class="actividad-info-row"><i class="ri-time-line"></i> 15:00 - 16:30</div>
                        <div>
                            <div class="cupo-label">
                                <span>Cupo disponible</span>
                                <span>14 / 15</span>
                            </div>
                            <div class="progress-wrap">
                                <div class="progress-fill lleno" style="width:93%;"></div>
                            </div>
                        </div>
                        <button class="btn-inscribirse inscribir">
                            <i class="ri-checkbox-circle-line"></i> Inscribirse
                        </button>
                    </div>

                </div>{{-- /actividades-grid --}}

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
                    <h1 class="page-title">Mi Nivel</h1>
                    <p class="page-subtitle">Esta sección estará disponible próximamente</p>
                </div>
                <div class="card" style="min-height:400px; display:flex; align-items:center; justify-content:center; flex-direction:column; gap:16px; color:var(--texto-suave);">
                    <i class="ri-bar-chart-line" style="font-size:48px; color:var(--borde);"></i>
                    <p style="font-size:15px;">Sección en construcción</p>
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
                    <p class="page-subtitle">Esta sección estará disponible próximamente</p>
                </div>
                <div class="card" style="min-height:400px; display:flex; align-items:center; justify-content:center; flex-direction:column; gap:16px; color:var(--texto-suave);">
                    <i class="ri-group-line" style="font-size:48px; color:var(--borde);"></i>
                    <p style="font-size:15px;">Sección en construcción</p>
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
                <div class="card" style="min-height:400px; display:flex; align-items:center; justify-content:center; flex-direction:column; gap:16px; color:var(--texto-suave);">
                    <i class="ri-bank-card-line" style="font-size:48px; color:var(--borde);"></i>
                    <p style="font-size:15px;">Sección en construcción</p>
                </div>
            </div>
        </div>
        <!-- /SECCIÓN PAGOS -->


        <!-- =============================================
             SECCIÓN: MI PERFIL
             Responsable: Mariana
             ============================================= -->
        <div id="section-miPerfil" class="section-content" style="display:none;">
            <div class="page-content">
                <div class="page-header">
                    <h1 class="page-title">Mi Perfil</h1>
                    <p class="page-subtitle">Esta sección estará disponible próximamente</p>
                </div>
                <div class="card" style="min-height:400px; display:flex; align-items:center; justify-content:center; flex-direction:column; gap:16px; color:var(--texto-suave);">
                    <i class="ri-user-line" style="font-size:48px; color:var(--borde);"></i>
                    <p style="font-size:15px;">Sección en construcción</p>
                </div>
            </div>
        </div>
        <!-- /SECCIÓN MI PERFIL -->


        <!-- =============================================
             SECCIÓN: OPCIONES
             ============================================= -->
        <div id="section-opciones" class="section-content" style="display:none;">
            <div class="page-content">
                <div class="page-header">
                    <h1 class="page-title">Opciones</h1>
                    <p class="page-subtitle">Configuración y preferencias de tu cuenta</p>
                </div>
                <div class="card" style="min-height:400px; display:flex; align-items:center; justify-content:center; flex-direction:column; gap:16px; color:var(--texto-suave);">
                    <i class="ri-settings-3-line" style="font-size:48px; color:var(--borde);"></i>
                    <p style="font-size:15px;">Sección en construcción</p>
                </div>
            </div>
        </div>
        <!-- /SECCIÓN OPCIONES -->


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
    {{-- JS vistas fusionadas --}}
    <script src="{{ asset('animaciones/alumno/extraescolares.js') }}"></script>

</body>
</html>
