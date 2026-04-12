<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonios - EGAU Chess</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/website/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/website/testimonios.css') }}">
</head>
<body>

    @include('website.header')

    <section class="page-hero">
        <h1>Lo que dicen nuestros alumnos</h1>
        <p>Historias reales de quienes confían en EGAU Chess</p>
    </section>

    <section class="seccion">
        <div class="contenedor">
            <div class="tarjetas">

                <div class="testimonio-card">
                    <div class="testimonio-comilla">"</div>
                    <p class="testimonio-texto">Gracias a EGAU mi hijo mejoró muchísimo su concentración en la escuela. Los maestros son pacientes y muy profesionales. En solo 4 meses ya participó en su primer torneo.</p>
                    <div class="testimonio-footer">
                        <div class="testimonio-avatar">👩</div>
                        <div class="testimonio-info">
                            <h4>María G.</h4>
                            <p>Madre de alumno · Sede Centro</p>
                            <div class="testimonio-estrellas">★★★★★</div>
                        </div>
                    </div>
                </div>

                <div class="testimonio-card">
                    <div class="testimonio-comilla">"</div>
                    <p class="testimonio-texto">Empecé sin saber absolutamente nada de ajedrez y en 6 meses ya participé en mi primer torneo. Los métodos de enseñanza son muy buenos. Lo recomiendo al 100%.</p>
                    <div class="testimonio-footer">
                        <div class="testimonio-avatar">👨</div>
                        <div class="testimonio-info">
                            <h4>Carlos R.</h4>
                            <p>Alumno nivel intermedio · Sede Norte</p>
                            <div class="testimonio-estrellas">★★★★★</div>
                        </div>
                    </div>
                </div>

                <div class="testimonio-card">
                    <div class="testimonio-comilla">"</div>
                    <p class="testimonio-texto">El ambiente es muy bueno y los instructores se adaptan al ritmo de cada estudiante. Excelente escuela. Ya llevo dos años aquí y sigo aprendiendo cosas nuevas.</p>
                    <div class="testimonio-footer">
                        <div class="testimonio-avatar">👩</div>
                        <div class="testimonio-info">
                            <h4>Laura M.</h4>
                            <p>Alumna nivel avanzado · Sede Centro</p>
                            <div class="testimonio-estrellas">★★★★★</div>
                        </div>
                    </div>
                </div>

                <div class="testimonio-card">
                    <div class="testimonio-comilla">"</div>
                    <p class="testimonio-texto">Me inscribí pensando que no iba a poder con el nivel, pero los profesores me guiaron muy bien. Ahora el ajedrez es mi pasatiempo favorito y participo en torneos regionales.</p>
                    <div class="testimonio-footer">
                        <div class="testimonio-avatar">👦</div>
                        <div class="testimonio-info">
                            <h4>Andrés P.</h4>
                            <p>Alumno competencia · Sede Centro</p>
                            <div class="testimonio-estrellas">★★★★★</div>
                        </div>
                    </div>
                </div>

                <div class="testimonio-card">
                    <div class="testimonio-comilla">"</div>
                    <p class="testimonio-texto">Mis dos hijos estudian aquí desde hace un año. Además de ajedrez, han desarrollado mucha paciencia y habilidad para resolver problemas. Una inversión que vale la pena.</p>
                    <div class="testimonio-footer">
                        <div class="testimonio-avatar">👨</div>
                        <div class="testimonio-info">
                            <h4>Roberto F.</h4>
                            <p>Padre de familia · Sede Norte</p>
                            <div class="testimonio-estrellas">★★★★☆</div>
                        </div>
                    </div>
                </div>

                <div class="testimonio-card">
                    <div class="testimonio-comilla">"</div>
                    <p class="testimonio-texto">Las clases en línea son igual de buenas que las presenciales. La plataforma funciona muy bien y el profesor siempre está disponible para resolver dudas fuera de horario.</p>
                    <div class="testimonio-footer">
                        <div class="testimonio-avatar">👩</div>
                        <div class="testimonio-info">
                            <h4>Daniela S.</h4>
                            <p>Alumna en línea · Principiante</p>
                            <div class="testimonio-estrellas">★★★★★</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="seccion seccion-gris">
        <div class="contenedor">
            <h2 class="seccion-titulo">¿Ya eres alumno? Deja tu testimonio</h2>
            <p class="seccion-subtitulo">Tu experiencia ayuda a otros a tomar la decisión</p>
            <div class="form-testimonio-wrap">
                <h3>Cuéntanos tu experiencia</h3>
                <p>Tu reseña será revisada y publicada en un máximo de 48 horas.</p>
                <div class="form-grupo">
                    <label for="tnombre">Nombre *</label>
                    <input type="text" id="tnombre" placeholder="Tu nombre">
                </div>
                <div class="form-grupo">
                    <label for="tcorreo">Correo (no se publicará) *</label>
                    <input type="email" id="tcorreo" placeholder="tucorreo@ejemplo.com">
                </div>
                <div class="form-grupo">
                    <label for="tsede">Sede</label>
                    <select id="tsede">
                        <option value="">Selecciona una sede</option>
                        <option>Sede Centro</option>
                        <option>Sede Norte</option>
                        <option>En línea</option>
                    </select>
                </div>
                <div class="form-grupo">
                    <label>Calificación *</label>
                    <div class="estrellas-selector" id="estrellas">
                        <span data-val="1">★</span>
                        <span data-val="2">★</span>
                        <span data-val="3">★</span>
                        <span data-val="4">★</span>
                        <span data-val="5">★</span>
                    </div>
                </div>
                <div class="form-grupo">
                    <label for="tmensaje">Tu testimonio *</label>
                    <textarea id="tmensaje" placeholder="Cuéntanos tu experiencia en EGAU Chess..."></textarea>
                </div>
                <button type="submit" class="btn-primario btn-completo">Enviar testimonio</button>
            </div>
        </div>
    </section>

    @include('website.footer')

    <script>
        const estrellas = document.querySelectorAll('#estrellas span');
        let seleccionadas = 0;

        estrellas.forEach((s, i) => {
            s.addEventListener('click', () => {
                seleccionadas = i + 1;
                estrellas.forEach((e, j) => {
                    e.style.color = j < seleccionadas ? '#f59e0b' : '#d1d5db';
                });
            });
        });
    </script>
</body>
</html>