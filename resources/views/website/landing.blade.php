<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EGAU Chess - Escuela de Ajedrez</title>
    <link rel="stylesheet" href="{{ asset('css/website/landing.css') }}">
</head>
<body>

    {{-- SCRUM-7: Header --}}
    @include('website.header')

    {{-- SCRUM-9: Banner principal --}}
    <section class="banner">
        <div class="banner-contenido">
            <h1>Aprende ajedrez con los mejores</h1>
            <p>Desarrolla tu mente, estrategia y concentración en la Escuela de Ajedrez EGAU. Cursos para todas las edades y niveles.</p>
            <div class="banner-botones">
                <a href="#cursos" class="btn-primario">Ver cursos</a>
                <a href="#contacto" class="btn-secundario">Contáctanos</a>
            </div>
        </div>
    </section>

    {{-- SCRUM-9: Cursos destacados --}}
    <section class="seccion" id="cursos">
        <div class="contenedor">
            <h2 class="seccion-titulo">Cursos destacados</h2>
            <div class="tarjetas">

                <div class="tarjeta">
                    <div class="tarjeta-nivel principiante">Principiante</div>
                    <h3>Ajedrez básico</h3>
                    <p>Aprende las reglas, movimientos y estrategias fundamentales del ajedrez desde cero.</p>
                    <div class="tarjeta-info">
                        <span>⏱ 3 meses</span>
                        <span>📍 Todas las sedes</span>
                    </div>
                    <a href="#contacto" class="btn-primario">Pre-inscribirse</a>
                </div>

                <div class="tarjeta">
                    <div class="tarjeta-nivel intermedio">Intermedio</div>
                    <h3>Táctica y estrategia</h3>
                    <p>Perfecciona tu juego con tácticas avanzadas, aperturas y finales de partida.</p>
                    <div class="tarjeta-info">
                        <span>⏱ 4 meses</span>
                        <span>📍 Sede principal</span>
                    </div>
                    <a href="#contacto" class="btn-primario">Pre-inscribirse</a>
                </div>

                <div class="tarjeta">
                    <div class="tarjeta-nivel avanzado">Avanzado</div>
                    <h3>Competencia</h3>
                    <p>Preparación intensiva para torneos locales, estatales y nacionales.</p>
                    <div class="tarjeta-info">
                        <span>⏱ 6 meses</span>
                        <span>📍 Sede principal</span>
                    </div>
                    <a href="#contacto" class="btn-primario">Pre-inscribirse</a>
                </div>

            </div>
        </div>
    </section>

    {{-- SCRUM-9: Información de sedes --}}
    <section class="seccion seccion-gris" id="sedes">
        <div class="contenedor">
            <h2 class="seccion-titulo">Nuestras sedes</h2>
            <div class="tarjetas">

                <div class="sede-tarjeta">
                    <h3>Sede Centro</h3>
                    <p>📍 Av. Principal #123, Centro</p>
                    <p>📞 (443) 123-4567</p>
                    <p>🕐 Lun - Vie: 9:00 - 19:00</p>
                </div>

                <div class="sede-tarjeta">
                    <h3>Sede Norte</h3>
                    <p>📍 Calle Norte #456, Col. Las Palmas</p>
                    <p>📞 (443) 765-4321</p>
                    <p>🕐 Lun - Sáb: 10:00 - 18:00</p>
                </div>

            </div>
        </div>
    </section>

    {{-- SCRUM-9: Testimonios --}}
    <section class="seccion" id="testimonios">
        <div class="contenedor">
            <h2 class="seccion-titulo">Lo que dicen nuestros alumnos</h2>
            <div class="tarjetas">

                <div class="testimonio">
                    <p>"Gracias a EGAU mi hijo mejoró muchísimo su concentración en la escuela. Los maestros son excelentes."</p>
                    <div class="testimonio-autor">— María G., madre de alumno</div>
                </div>

                <div class="testimonio">
                    <p>"Empecé sin saber nada de ajedrez y en 6 meses ya participé en mi primer torneo. Lo recomiendo al 100%."</p>
                    <div class="testimonio-autor">— Carlos R., alumno nivel intermedio</div>
                </div>

                <div class="testimonio">
                    <p>"El ambiente es muy bueno y los instructores se adaptan al ritmo de cada estudiante. Excelente escuela."</p>
                    <div class="testimonio-autor">— Laura M., alumna nivel avanzado</div>
                </div>

            </div>
        </div>
    </section>

    {{-- SCRUM-9: Blog reciente --}}
    <section class="seccion seccion-gris" id="blog">
        <div class="contenedor">
            <h2 class="seccion-titulo">Últimas noticias</h2>
            <div class="tarjetas">

                <div class="blog-tarjeta">
                    <div class="blog-fecha">15 de marzo, 2026</div>
                    <h3>EGAU obtiene primer lugar en torneo estatal</h3>
                    <p>Nuestros alumnos de nivel avanzado representaron a la escuela con orgullo en el torneo estatal de Michoacán.</p>
                    <a href="#" class="enlace-blog">Leer más →</a>
                </div>

                <div class="blog-tarjeta">
                    <div class="blog-fecha">2 de marzo, 2026</div>
                    <h3>Nuevos cursos de verano disponibles</h3>