<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio — EGAU Chess</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboardAlumno/dashboardAlumno.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboardAlumno/inicio.css') }}">
</head>
<body>

    @include('dashboardAlumno.sidebar', ['seccionActiva' => 'inicio'])

    <main class="main-content" id="main-content">

        {{-- Topbar --}}
        <header class="topbar">
            <button class="menu-toggle" id="menu-toggle"><i class="ri-menu-line"></i></button>
            <span class="topbar-label">Portal del Estudiante</span>
            <div class="topbar-right">
                <span class="alumno-name-topbar">Ana García</span>
                <div class="avatar-topbar">A</div>
            </div>
        </header>

        {{-- Contenido --}}
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
    </main>

    <script src="{{ asset('animaciones/alumno/dashboardAlumno.js') }}"></script>
</body>
</html>