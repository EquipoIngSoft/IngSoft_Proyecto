<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Nivel — EGAU Chess</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboardAlumno/dashboardAlumno.css') }}">
</head>
<body>

    @include('dashboardAlumno.sidebar', ['seccionActiva' => 'miNivel'])

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
                <h1 class="page-title">Mi Nivel</h1>
                <p class="page-subtitle">Esta sección estará disponible próximamente</p>
            </div>
            <div class="card" style="min-height:400px; display:flex; align-items:center; justify-content:center; flex-direction:column; gap:16px; color:var(--texto-suave);">
                <i class="ri-bar-chart-line" style="font-size:48px; color:var(--borde);"></i>
                <p style="font-size:15px;">Sección en construcción</p>
            </div>
        </div>
    </main>

    <script src="{{ asset('animaciones/alumno/dashboardAlumno.js') }}"></script>
</body>
</html>