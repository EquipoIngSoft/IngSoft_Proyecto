<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extraescolares — EGAU Chess</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboardAlumno/dashboardAlumno.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboardAlumno/extraescolares.css') }}">
</head>
<body>

    @include('dashboardAlumno.sidebar', ['seccionActiva' => 'extraescolares'])

    <main class="main-content" id="main-content">

        <header class="topbar">
            <button class="menu-toggle" id="menu-toggle"><i class="ri-menu-line"></i></button>
            <span class="topbar-label">Portal del Estudiante</span>
            <div class="topbar-right">
                <span class="alumno-name-topbar">Ana García</span>
                <div class="avatar-topbar">A</div>
            </div>
        </header>

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
    </main>

    <script src="{{ asset('animaciones/alumno/dashboardAlumno.js') }}"></script>
    <script src="{{ asset('animaciones/alumno/extraescolares.js') }}"></script>
</body>
</html>