<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sedes - EGAU Chess</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/website/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/website/sedes.css') }}">
</head>
<body>

    @include('website.header')

    <section class="page-hero">
        <h1>Nuestras Sedes</h1>
        <p>Encuéntranos cerca de ti en Morelia, Michoacán</p>
    </section>

    <section class="seccion">
        <div class="contenedor">
            <div class="tarjetas">

                <div class="sede-card">
                    <div class="sede-card-mapa"><i class="ri-map-pin-2-line"></i></div>
                    <div class="sede-card-body">
                        <h3>Sede Centro</h3>
                        <div class="sede-info-fila">
                            <span class="icono"><i class="ri-road-map-line"></i></span>
                            <span>Av. Principal #123, Col. Centro, Morelia, Michoacán</span>
                        </div>
                        <div class="sede-info-fila">
                            <span class="icono"><i class="ri-phone-line"></i></span>
                            <span>(443) 123-4567</span>
                        </div>
                        <div class="sede-info-fila">
                            <span class="icono"><i class="ri-mail-line"></i></span>
                            <span>centro@egauchess.mx</span>
                        </div>
                        <div class="sede-horarios">
                            <h4>Horarios de atención</h4>
                            <div class="horario-fila"><span>Lunes a Viernes</span><span>9:00 - 19:00</span></div>
                            <div class="horario-fila"><span>Sábado</span><span>9:00 - 14:00</span></div>
                            <div class="horario-fila"><span>Domingo</span><span>Cerrado</span></div>
                        </div>
                        <a href="{{ route('contacto') }}" class="btn-primario btn-completo" style="margin-top:8px;">Agendar visita</a>
                    </div>
                </div>

                <div class="sede-card">
                    <div class="sede-card-mapa"><i class="ri-map-pin-2-line"></i></div>
                    <div class="sede-card-body">
                        <h3>Sede Norte</h3>
                        <div class="sede-info-fila">
                            <span class="icono"><i class="ri-road-map-line"></i></span>
                            <span>Calle Norte #456, Col. Las Palmas, Morelia, Michoacán</span>
                        </div>
                        <div class="sede-info-fila">
                            <span class="icono"><i class="ri-phone-line"></i></span>
                            <span>(443) 765-4321</span>
                        </div>
                        <div class="sede-info-fila">
                            <span class="icono"><i class="ri-mail-line"></i></span>
                            <span>norte@egauchess.mx</span>
                        </div>
                        <div class="sede-horarios">
                            <h4>Horarios de atención</h4>
                            <div class="horario-fila"><span>Lunes a Viernes</span><span>10:00 - 18:00</span></div>
                            <div class="horario-fila"><span>Sábado</span><span>10:00 - 15:00</span></div>
                            <div class="horario-fila"><span>Domingo</span><span>Cerrado</span></div>
                        </div>
                        <a href="{{ route('contacto') }}" class="btn-primario btn-completo" style="margin-top:8px;">Agendar visita</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="seccion seccion-gris">
        <div class="contenedor">
            <h2 class="seccion-titulo">Nuestros instructores</h2>
            <p class="seccion-subtitulo">Maestros certificados y apasionados por el ajedrez</p>
            <div class="instructores-grid">

                <div class="instructor-card">
                    <div class="instructor-avatar"><i class="ri-user-star-line"></i></div>
                    <h4>Prof. Roberto Sánchez</h4>
                    <p>15 años de experiencia. Campeón estatal 2018.</p>
                    <span class="instructor-especialidad">Táctica avanzada</span>
                </div>

                <div class="instructor-card">
                    <div class="instructor-avatar"><i class="ri-user-smile-line"></i></div>
                    <h4>Profa. Ana Martínez</h4>
                    <p>Especialista en ajedrez infantil. FIDE Trainer.</p>
                    <span class="instructor-especialidad">Nivel principiante</span>
                </div>

                <div class="instructor-card">
                    <div class="instructor-avatar"><i class="ri-medal-line"></i></div>
                    <h4>Prof. Diego Herrera</h4>
                    <p>Maestro FIDE. Múltiple ganador de torneos nacionales.</p>
                    <span class="instructor-especialidad">Competencia</span>
                </div>

                <div class="instructor-card">
                    <div class="instructor-avatar"><i class="ri-user-line"></i></div>
                    <h4>Profa. Sofía Ramos</h4>
                    <p>Especialista en finales y estrategia posicional.</p>
                    <span class="instructor-especialidad">Finales</span>
                </div>

            </div>
        </div>
    </section>

    @include('website.footer')

</body>
</html>