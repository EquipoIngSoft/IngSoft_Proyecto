<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesores — EGAU Chess</title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboardAlumno/dashboardAlumno.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboardAlumno/profesores.css') }}">
</head>
<body>

    @include('dashboardAlumno.sidebar', ['seccionActiva' => 'profesores'])

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
    </main>

    <script src="{{ asset('animaciones/alumno/dashboardAlumno.js') }}"></script>
</body>
</html>