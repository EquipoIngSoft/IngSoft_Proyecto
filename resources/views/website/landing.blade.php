<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EGAU Chess - Escuela de Ajedrez</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/website/landing.css') }}">
</head>
<body>

    @include('website.header')

    {{-- SCRUM-9: Banner principal --}}
    <section class="banner">
        <div class="banner-contenido">
            <h1>Aprende ajedrez con los mejores</h1>
            <p>Desarrolla tu mente, estrategia y concentración en la Escuela de Ajedrez EGAU. Cursos para todas las edades y niveles.</p>
            <div class="banner-botones">
                <a href="{{ route('cursos') }}" class="btn-primario">Ver cursos</a>
                <a href="{{ route('contacto') }}" class="btn-secundario">Contáctanos</a>
            </div>
        </div>
    </section>

    {{-- SCRUM-9: Cursos destacados --}}
    <section class="seccion" id="cursos">
        <div class="contenedor">
            <h2 class="seccion-titulo">Cursos destacados</h2>
            <p class="seccion-subtitulo">Elige el nivel que mejor se adapte a ti</p>
            <div class="tarjetas">

                <div class="tarjeta">
                    <div class="tarjeta-nivel principiante">Principiante</div>
                    <h3>Ajedrez básico</h3>
                    <p>Aprende las reglas, movimientos y estrategias fundamentales del ajedrez desde cero.</p>
                    <div class="tarjeta-info">
                        <span>⏱ 3 meses</span>
                        <span>📍 Todas las sedes</span>
                    </div>
                    <a href="{{ route('cursos') }}" class="btn-primario">Pre-inscribirse</a>
                </div>

                <div class="tarjeta">
                    <div class="tarjeta-nivel intermedio">Intermedio</div>
                    <h3>Táctica y estrategia</h3>
                    <p>Perfecciona tu juego con tácticas avanzadas, aperturas y finales de partida.</p>
                    <div class="tarjeta-info">
                        <span>⏱ 4 meses</span>
                        <span>📍 Sede principal</span>
                    </div>
                    <a href="{{ route('cursos') }}" class="btn-primario">Pre-inscribirse</a>
                </div>

                <div class="tarjeta">
                    <div class="tarjeta-nivel avanzado">Avanzado</div>
                    <h3>Competencia</h3>
                    <p>Preparación intensiva para torneos locales, estatales y nacionales.</p>
                    <div class="tarjeta-info">
                        <span>⏱ 6 meses</span>
                        <span>📍 Sede principal</span>
                    </div>
                    <a href="{{ route('cursos') }}" class="btn-primario">Pre-inscribirse</a>
                </div>

            </div>
            <div style="text-align:center; margin-top:36px;">
                <a href="{{ route('cursos') }}" class="btn-primario">Ver todos los cursos</a>
            </div>
        </div>
    </section>

    {{-- SCRUM-9: Información de sedes --}}
    <section class="seccion seccion-gris" id="sedes">
        <div class="contenedor">
            <h2 class="seccion-titulo">Nuestras sedes</h2>
            <p class="seccion-subtitulo">Encuéntranos cerca de ti</p>
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
            <div style="text-align:center; margin-top:36px;">
                <a href="{{ route('sedes') }}" class="btn-primario">Ver todas las sedes</a>
            </div>
        </div>
    </section>

    {{-- SCRUM-9: Testimonios --}}
    <section class="seccion" id="testimonios">
        <div class="contenedor">
            <h2 class="seccion-titulo">Lo que dicen nuestros alumnos</h2>
            <div class="tarjetas">

                <div class="testimonio">
                    <p>Gracias a EGAU mi hijo mejoró muchísimo su concentración en la escuela. Los maestros son excelentes.</p>
                    <div class="testimonio-autor">— María G., madre de alumno</div>
                </div>

                <div class="testimonio">
                    <p>Empecé sin saber nada de ajedrez y en 6 meses ya participé en mi primer torneo. Lo recomiendo al 100%.</p>
                    <div class="testimonio-autor">— Carlos R., alumno nivel intermedio</div>
                </div>

                <div class="testimonio">
                    <p>El ambiente es muy bueno y los instructores se adaptan al ritmo de cada estudiante. Excelente escuela.</p>
                    <div class="testimonio-autor">— Laura M., alumna nivel avanzado</div>
                </div>

            </div>
            <div style="text-align:center; margin-top:36px;">
                <a href="{{ route('testimonios') }}" class="btn-primario">Ver más testimonios</a>
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
                    <a href="{{ route('blog') }}" class="enlace-blog">Leer más →</a>
                </div>

                <div class="blog-tarjeta">
                    <div class="blog-fecha">2 de marzo, 2026</div>
                    <h3>Nuevos cursos de verano disponibles</h3>
                    <p>Inscríbete a tiempo a nuestros cursos intensivos de verano. Cupos limitados para todas las sedes.</p>
                    <a href="{{ route('blog') }}" class="enlace-blog">Leer más →</a>
                </div>

                <div class="blog-tarjeta">
                    <div class="blog-fecha">18 de febrero, 2026</div>
                    <h3>Taller gratuito de ajedrez para niños</h3>
                    <p>Este fin de semana realizamos un taller abierto a la comunidad. Más de 40 niños aprendieron los fundamentos.</p>
                    <a href="{{ route('blog') }}" class="enlace-blog">Leer más →</a>
                </div>

            </div>
            <div style="text-align:center; margin-top:36px;">
                <a href="{{ route('blog') }}" class="btn-primario">Ver todas las noticias</a>
            </div>
        </div>
    </section>

    {{-- SCRUM-9: Contacto --}}
    <section class="seccion" id="contacto">
        <div class="contenedor contenedor-angosto">
            <h2 class="seccion-titulo">Contáctanos</h2>
            <p class="seccion-subtitulo">Resolvemos todas tus dudas</p>
            <div class="form-contacto">
                <div class="form-grupo">
                    <label for="nombre">Nombre completo *</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required>
                </div>
                <div class="form-grupo">
                    <label for="correo">Correo electrónico *</label>
                    <input type="email" id="correo" name="correo" placeholder="tucorreo@ejemplo.com" required>
                </div>
                <div class="form-grupo">
                    <label for="telefono">Teléfono (opcional)</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="(443) 000-0000">
                </div>
                <div class="form-grupo">
                    <label for="asunto">Asunto *</label>
                    <input type="text" id="asunto" name="asunto" placeholder="¿En qué te podemos ayudar?" required>
                </div>
                <div class="form-grupo">
                    <label for="mensaje">Mensaje *</label>
                    <textarea id="mensaje" name="mensaje" placeholder="Escribe tu mensaje aquí..." required></textarea>
                </div>
                <button type="submit" class="btn-primario btn-completo">Enviar mensaje</button>
            </div>
        </div>
    </section>

    @include('website.footer')

</body>
</html>