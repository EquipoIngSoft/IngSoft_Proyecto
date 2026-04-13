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
    <!-- Hojas de estilos -->
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

        <!-- Pie del sidebar -->
        <div class="sidebar-footer">
            <a href="{{ url('/') }}" class="nav-footer-item">
                <i class="ri-logout-box-r-line"></i>
                <span>Cerrar Sesión</span>
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
                <span class="alumno-name-topbar">Ana García</span>
                <div class="avatar-topbar">A</div>
            </div>
        </header>


        <!-- =============================================
             SECCIÓN: INICIO
             Responsable: Angel | S-23
             ============================================= -->
        <div id="section-inicio" class="section-content">
            <div class="page-content">
                <div class="page-header">
                    <h1 class="page-title">Bienvenida, Ana</h1>
                    <p class="page-subtitle">Aquí tienes un resumen de tu situación académica</p>
                </div>

                <!-- KPI Cards -->
                <div class="kpi-grid">
                    <div class="kpi-card">
                        <div class="kpi-icon-wrap kpi-icon-naranja">
                            <i class="ri-chess-line"></i>
                        </div>
                        <div class="kpi-info">
                            <span class="kpi-label">Nivel Actual</span>
                            <span class="kpi-value">Intermedio</span>
                            <span class="kpi-badge">ELO 1250</span>
                        </div>
                    </div>
                    <div class="kpi-card">
                        <div class="kpi-icon-wrap kpi-icon-morado">
                            <i class="ri-medal-line"></i>
                        </div>
                        <div class="kpi-info">
                            <span class="kpi-label">Puntos Acumulados</span>
                            <span class="kpi-value">340 <small>/ 500</small></span>
                            <span class="kpi-sub">Siguiente nivel: 160 pts</span>
                        </div>
                    </div>
                    <div class="kpi-card">
                        <div class="kpi-icon-wrap kpi-icon-azul">
                            <i class="ri-group-line"></i>
                        </div>
                        <div class="kpi-info">
                            <span class="kpi-label">Grupo Asignado</span>
                            <span class="kpi-value">G-INT-02</span>
                            <span class="kpi-sub">Sede Central · Lun / Mié / Vie</span>
                        </div>
                    </div>
                </div>

                <!-- Horario + Actividad Reciente -->
                <div class="bottom-grid">
                    <!-- Horario -->
                    <div class="card">
                        <div class="section-card-title">
                            <i class="ri-calendar-schedule-line"></i>
                            <span>Mi Horario de Clases</span>
                        </div>
                        <ul class="horario-list">
                            <li class="horario-item">
                                <div class="horario-dia">LUN</div>
                                <div class="horario-detalle">
                                    <span class="horario-hora">16:00 – 17:30</span>
                                    <span class="horario-aula">Aula 3 · Sede Central</span>
                                </div>
                            </li>
                            <li class="horario-item">
                                <div class="horario-dia">MIÉ</div>
                                <div class="horario-detalle">
                                    <span class="horario-hora">16:00 – 17:30</span>
                                    <span class="horario-aula">Aula 3 · Sede Central</span>
                                </div>
                            </li>
                            <li class="horario-item">
                                <div class="horario-dia">VIE</div>
                                <div class="horario-detalle">
                                    <span class="horario-hora">16:00 – 17:30</span>
                                    <span class="horario-aula">Aula 3 · Sede Central</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Actividad Reciente -->
                    <div class="card">
                        <div class="section-card-title">
                            <i class="ri-history-line"></i>
                            <span>Actividad Reciente</span>
                        </div>
                        <ul class="actividad-list">
                            <li class="actividad-item">
                                <div class="actividad-icon actividad-logro"><i class="ri-trophy-line"></i></div>
                                <div class="actividad-info">
                                    <span class="actividad-texto">Ganaste el torneo interno de abril</span>
                                    <span class="actividad-fecha">Hace 2 días</span>
                                </div>
                            </li>
                            <li class="actividad-item">
                                <div class="actividad-icon actividad-pago"><i class="ri-bank-card-line"></i></div>
                                <div class="actividad-info">
                                    <span class="actividad-texto">Pago de mensualidad registrado</span>
                                    <span class="actividad-fecha">Hace 5 días</span>
                                </div>
                            </li>
                            <li class="actividad-item">
                                <div class="actividad-icon actividad-clase"><i class="ri-book-open-line"></i></div>
                                <div class="actividad-info">
                                    <span class="actividad-texto">Clase completada: Aperturas de rey</span>
                                    <span class="actividad-fecha">Hace 1 semana</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
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
                    <p class="page-subtitle">Directorio de instructores y contacto para asesorías</p>
                </div>

                <div class="profesores-grid">
                    <div class="profesor-card">
                        <div class="profesor-header">
                            <div class="profesor-avatar">R</div>
                            <div>
                                <div class="profesor-nombre">Roberto Méndez</div>
                                <span class="badge badge-naranja">Gran Maestro</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div class="profesor-detalles">
                            <div class="profesor-fila"><i class="ri-chess-line"></i> Finales y Estrategia</div>
                            <div class="profesor-fila"><i class="ri-time-line"></i> 12 años de experiencia</div>
                            <div class="profesor-fila"><i class="ri-map-pin-line"></i> Sede Central</div>
                        </div>
                        <div class="profesor-certs">
                            <span class="cert-tag">FIDE 2480</span>
                            <span class="cert-tag">Coach FIDE</span>
                            <span class="cert-tag">Árbitro Nacional</span>
                        </div>
                        <a href="mailto:rmendez@egau.mx" class="btn-contactar">
                            <i class="ri-mail-line"></i> Contactar
                        </a>
                    </div>

                    <div class="profesor-card">
                        <div class="profesor-header">
                            <div class="profesor-avatar" style="background:var(--morado-light);color:var(--morado)">L</div>
                            <div>
                                <div class="profesor-nombre">Laura Sánchez</div>
                                <span class="badge badge-morado">Maestra Internacional</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div class="profesor-detalles">
                            <div class="profesor-fila"><i class="ri-chess-line"></i> Aperturas y Táctica</div>
                            <div class="profesor-fila"><i class="ri-time-line"></i> 8 años de experiencia</div>
                            <div class="profesor-fila"><i class="ri-map-pin-line"></i> Sede Norte</div>
                        </div>
                        <div class="profesor-certs">
                            <span class="cert-tag">FIDE 2310</span>
                            <span class="cert-tag">Coach Nivel 2</span>
                        </div>
                        <a href="mailto:lsanchez@egau.mx" class="btn-contactar">
                            <i class="ri-mail-line"></i> Contactar
                        </a>
                    </div>

                    <div class="profesor-card">
                        <div class="profesor-header">
                            <div class="profesor-avatar" style="background:var(--azul-light);color:var(--azul)">C</div>
                            <div>
                                <div class="profesor-nombre">Carlos Herrera</div>
                                <span class="badge badge-azul">Maestro FIDE</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div class="profesor-detalles">
                            <div class="profesor-fila"><i class="ri-chess-line"></i> Iniciación y Juvenil</div>
                            <div class="profesor-fila"><i class="ri-time-line"></i> 6 años de experiencia</div>
                            <div class="profesor-fila"><i class="ri-map-pin-line"></i> Sede Sur</div>
                        </div>
                        <div class="profesor-certs">
                            <span class="cert-tag">FIDE 2180</span>
                            <span class="cert-tag">Coach Nivel 1</span>
                        </div>
                        <a href="mailto:cherrera@egau.mx" class="btn-contactar">
                            <i class="ri-mail-line"></i> Contactar
                        </a>
                    </div>

                    <div class="profesor-card">
                        <div class="profesor-header">
                            <div class="profesor-avatar" style="background:var(--verde-light);color:var(--verde)">M</div>
                            <div>
                                <div class="profesor-nombre">María Valdés</div>
                                <span class="badge badge-verde">Candidato a Maestro</span>
                            </div>
                        </div>
                        <hr class="profesor-divider">
                        <div class="profesor-detalles">
                            <div class="profesor-fila"><i class="ri-chess-line"></i> Táctica Avanzada</div>
                            <div class="profesor-fila"><i class="ri-time-line"></i> 4 años de experiencia</div>
                            <div class="profesor-fila"><i class="ri-map-pin-line"></i> Sede Central</div>
                        </div>
                        <div class="profesor-certs">
                            <span class="cert-tag">FIDE 2050</span>
                        </div>
                        <a href="mailto:mvaldes@egau.mx" class="btn-contactar">
                            <i class="ri-mail-line"></i> Contactar
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <!-- /SECCIÓN PROFESORES -->


        <!-- =============================================
             SECCIÓN: EXTRAESCOLARES
             Responsable: Angel | S-27
             ============================================= -->
        <div id="section-extraescolares" class="section-content" style="display:none;">
            <div class="page-content">
                <div class="page-header">
                    <h1 class="page-title">Actividades Extraescolares</h1>
                    <p class="page-subtitle">Torneos, talleres y eventos disponibles para ti</p>
                </div>

                <div class="extra-filtros">
                    <button class="filtro-btn filtro-activo" data-filtro="todos">Todos</button>
                    <button class="filtro-btn" data-filtro="torneo">Torneos</button>
                    <button class="filtro-btn" data-filtro="taller">Talleres</button>
                    <button class="filtro-btn" data-filtro="evento">Eventos</button>
                </div>

                <div class="extra-grid" id="extra-grid">
                    <div class="extra-card" data-tipo="torneo">
                        <div class="extra-card-header">
                            <div class="extra-icon extra-torneo"><i class="ri-trophy-line"></i></div>
                            <span class="badge badge-naranja">Torneo</span>
                        </div>
                        <h3 class="extra-titulo">Torneo Interno de Primavera</h3>
                        <p class="extra-desc">Torneo round-robin entre alumnos de nivel intermedio y avanzado. Premiación a los 3 primeros lugares.</p>
                        <div class="extra-meta">
                            <span><i class="ri-calendar-line"></i> 20 Abr 2026</span>
                            <span><i class="ri-map-pin-line"></i> Sede Central</span>
                            <span><i class="ri-user-line"></i> 16 participantes</span>
                        </div>
                        <button class="btn-inscribir">Inscribirme</button>
                    </div>

                    <div class="extra-card" data-tipo="taller">
                        <div class="extra-card-header">
                            <div class="extra-icon extra-taller"><i class="ri-book-open-line"></i></div>
                            <span class="badge badge-azul">Taller</span>
                        </div>
                        <h3 class="extra-titulo">Taller: Finales de Torre</h3>
                        <p class="extra-desc">Taller intensivo de 3 horas enfocado en técnicas de finales con torre. Nivel recomendado: intermedio.</p>
                        <div class="extra-meta">
                            <span><i class="ri-calendar-line"></i> 26 Abr 2026</span>
                            <span><i class="ri-map-pin-line"></i> Sede Norte</span>
                            <span><i class="ri-time-line"></i> 10:00 – 13:00</span>
                        </div>
                        <button class="btn-inscribir">Inscribirme</button>
                    </div>

                    <div class="extra-card" data-tipo="evento">
                        <div class="extra-card-header">
                            <div class="extra-icon extra-evento"><i class="ri-star-line"></i></div>
                            <span class="badge badge-verde">Evento</span>
                        </div>
                        <h3 class="extra-titulo">Exhibición con Maestro Invitado</h3>
                        <p class="extra-desc">Partida de exhibición con el MI Raúl Flores. Entrada libre para alumnos inscritos.</p>
                        <div class="extra-meta">
                            <span><i class="ri-calendar-line"></i> 3 May 2026</span>
                            <span><i class="ri-map-pin-line"></i> Sede Central</span>
                            <span><i class="ri-user-line"></i> Cupo libre</span>
                        </div>
                        <button class="btn-inscribir">Inscribirme</button>
                    </div>

                    <div class="extra-card" data-tipo="torneo">
                        <div class="extra-card-header">
                            <div class="extra-icon extra-torneo"><i class="ri-trophy-line"></i></div>
                            <span class="badge badge-naranja">Torneo</span>
                        </div>
                        <h3 class="extra-titulo">Copa EGAU Interserial</h3>
                        <p class="extra-desc">Torneo clasificatorio entre alumnos de todas las sedes. Los 4 finalistas representan a EGAU en el torneo estatal.</p>
                        <div class="extra-meta">
                            <span><i class="ri-calendar-line"></i> 10 May 2026</span>
                            <span><i class="ri-map-pin-line"></i> Todas las sedes</span>
                            <span><i class="ri-user-line"></i> 32 participantes</span>
                        </div>
                        <button class="btn-inscribir">Inscribirme</button>
                    </div>
                </div>

            </div>
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
                    <p class="page-subtitle">Sección en desarrollo — Mariana</p>
                </div>
                <div class="stub-placeholder">
                    <i class="ri-bar-chart-line"></i>
                    <span>Mi Nivel</span>
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
                    <p class="page-subtitle">Sección en desarrollo — Mariana</p>
                </div>
                <div class="stub-placeholder">
                    <i class="ri-group-line"></i>
                    <span>Mis Grupos</span>
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
                    <p class="page-subtitle">Sección en desarrollo — Mariana</p>
                </div>
                <div class="stub-placeholder">
                    <i class="ri-bank-card-line"></i>
                    <span>Pagos</span>
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
                    <p class="page-subtitle">Sección en desarrollo — Mariana</p>
                </div>
                <div class="stub-placeholder">
                    <i class="ri-user-line"></i>
                    <span>Mi Perfil</span>
                </div>
            </div>
        </div>
        <!-- /SECCIÓN MI PERFIL -->

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
