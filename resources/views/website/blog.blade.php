<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - EGAU Chess</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/website/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/website/blog.css') }}">
</head>
<body>

    @include('website.header')

    <section class="page-hero">
        <h1>Blog y Noticias</h1>
        <p>Torneos, consejos, curiosidades y todo sobre el ajedrez en EGAU</p>
    </section>

    <section class="seccion">
        <div class="contenedor">

            <div class="articulo-destacado">
                <div class="articulo-img">🏆</div>
                <div class="articulo-body">
                    <span class="badge-destacado">Destacado</span>
                    <div class="articulo-meta">
                        <span class="articulo-categoria">Torneos</span>
                        <span class="articulo-fecha">15 de marzo, 2026</span>
                    </div>
                    <h3>EGAU obtiene primer lugar en el Torneo Estatal de Ajedrez Michoacán 2026</h3>
                    <p>Nuestros alumnos de nivel avanzado representaron a la escuela con orgullo. Tres estudiantes lograron podio en sus categorías respectivas en un torneo con más de 200 participantes de todo el estado.</p>
                    <div class="articulo-footer">
                        <span class="articulo-autor">✍️ Prof. Roberto Sánchez</span>
                        <a href="#" class="enlace-blog">Leer más →</a>
                    </div>
                </div>
            </div>

            <div class="categorias-bar">
                <button class="cat-btn activo" data-cat="">Todos</button>
                <button class="cat-btn" data-cat="torneos">Torneos</button>
                <button class="cat-btn" data-cat="consejos">Consejos</button>
                <button class="cat-btn" data-cat="noticias">Noticias</button>
                <button class="cat-btn" data-cat="eventos">Eventos</button>
            </div>

            <div class="tarjetas" id="gridArticulos">

                <div class="articulo-card" data-cat="noticias">
                    <div class="articulo-img">📚</div>
                    <div class="articulo-body">
                        <div class="articulo-meta">
                            <span class="articulo-categoria">Noticias</span>
                            <span class="articulo-fecha">2 de marzo, 2026</span>
                        </div>
                        <h3>Nuevos cursos de verano disponibles</h3>
                        <p>Inscríbete a tiempo a nuestros cursos intensivos de verano. Cupos limitados para todas las sedes. Precios especiales hasta el 30 de abril.</p>
                        <div class="articulo-footer">
                            <span class="articulo-autor">✍️ EGAU Chess</span>
                            <a href="#" class="enlace-blog">Leer más →</a>
                        </div>
                    </div>
                </div>

                <div class="articulo-card" data-cat="consejos">
                    <div class="articulo-img">♟️</div>
                    <div class="articulo-body">
                        <div class="articulo-meta">
                            <span class="articulo-categoria">Consejos</span>
                            <span class="articulo-fecha">18 de febrero, 2026</span>
                        </div>
                        <h3>5 errores comunes en principiantes (y cómo evitarlos)</h3>
                        <p>Desde mover siempre la misma pieza hasta ignorar el centro del tablero. Nuestros instructores comparten los errores más frecuentes y cómo corregirlos desde el inicio.</p>
                        <div class="articulo-footer">
                            <span class="articulo-autor">✍️ Profa. Ana Martínez</span>
                            <a href="#" class="enlace-blog">Leer más →</a>
                        </div>
                    </div>
                </div>

                <div class="articulo-card" data-cat="eventos">
                    <div class="articulo-img">🎉</div>
                    <div class="articulo-body">
                        <div class="articulo-meta">
                            <span class="articulo-categoria">Eventos</span>
                            <span class="articulo-fecha">10 de febrero, 2026</span>
                        </div>
                        <h3>Taller gratuito de ajedrez para niños — resumen</h3>
                        <p>Más de 40 niños participaron en nuestro taller abierto. Fue una tarde llena de aprendizaje, juego y mucha diversión. Mira el resumen del evento.</p>
                        <div class="articulo-footer">
                            <span class="articulo-autor">✍️ EGAU Chess</span>
                            <a href="#" class="enlace-blog">Leer más →</a>
                        </div>
                    </div>
                </div>

                <div class="articulo-card" data-cat="consejos">
                    <div class="articulo-img">🧠</div>
                    <div class="articulo-body">
                        <div class="articulo-meta">
                            <span class="articulo-categoria">Consejos</span>
                            <span class="articulo-fecha">28 de enero, 2026</span>
                        </div>
                        <h3>Cómo estudiar aperturas de manera eficiente</h3>
                        <p>No memorices jugadas: entiende ideas. Te explicamos cómo estructurar tu estudio de aperturas para que realmente queden y te funcionen en partida.</p>
                        <div class="articulo-footer">
                            <span class="articulo-autor">✍️ Prof. Diego Herrera</span>
                            <a href="#" class="enlace-blog">Leer más →</a>
                        </div>
                    </div>
                </div>

                <div class="articulo-card" data-cat="torneos">
                    <div class="articulo-img">🥈</div>
                    <div class="articulo-body">
                        <div class="articulo-meta">
                            <span class="articulo-categoria">Torneos</span>
                            <span class="articulo-fecha">15 de enero, 2026</span>
                        </div>
                        <h3>Segundo lugar en el Torneo Regional Infantil</h3>
                        <p>Nuestra categoría sub-12 logró un extraordinario segundo lugar. Los chicos jugaron con una madurez y concentración que llenó de orgullo a toda la escuela.</p>
                        <div class="articulo-footer">
                            <span class="articulo-autor">✍️ EGAU Chess</span>
                            <a href="#" class="enlace-blog">Leer más →</a>
                        </div>
                    </div>
                </div>

                <div class="articulo-card" data-cat="noticias">
                    <div class="articulo-img">🏫</div>
                    <div class="articulo-body">
                        <div class="articulo-meta">
                            <span class="articulo-categoria">Noticias</span>
                            <span class="articulo-fecha">5 de enero, 2026</span>
                        </div>
                        <h3>Apertura de nuestra nueva sede Norte</h3>
                        <p>Con gran éxito abrimos las puertas de nuestra segunda sede en la ciudad. Más de 60 alumnos ya están inscritos y las clases comenzaron con todo.</p>
                        <div class="articulo-footer">
                            <span class="articulo-autor">✍️ EGAU Chess</span>
                            <a href="#" class="enlace-blog">Leer más →</a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="paginacion">
                <button class="pag-btn activo">1</button>
                <button class="pag-btn">2</button>
                <button class="pag-btn">3</button>
                <button class="pag-btn">›</button>
            </div>

        </div>
    </section>

    @include('website.footer')

    <script>
        const catBtns   = document.querySelectorAll('.cat-btn');
        const articulos = document.querySelectorAll('.articulo-card');

        catBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                catBtns.forEach(b => b.classList.remove('activo'));
                btn.classList.add('activo');
                const cat = btn.dataset.cat;
                articulos.forEach(a => {
                    a.style.display = (!cat || a.dataset.cat === cat) ? '' : 'none';
                });
            });
        });
    </script>
</body>
</html>