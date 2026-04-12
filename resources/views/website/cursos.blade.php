<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos - EGAU Chess</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/website/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/website/cursos.css') }}">
</head>
<body>

    @include('website.header')

    <section class="page-hero">
        <h1>Catálogo de Cursos</h1>
        <p>Encuentra el curso perfecto para tu nivel y objetivos</p>
    </section>

    <div class="filtros-bar">
        <div class="filtros-contenedor">
            <input type="text" class="filtro-busqueda" id="busqueda" placeholder="🔍  Buscar curso...">
            <select class="filtro-select" id="filtroNivel">
                <option value="">Todos los niveles</option>
                <option value="principiante">Principiante</option>
                <option value="intermedio">Intermedio</option>
                <option value="avanzado">Avanzado</option>
            </select>
            <select class="filtro-select" id="filtroSede">
                <option value="">Todas las sedes</option>
                <option value="centro">Sede Centro</option>
                <option value="norte">Sede Norte</option>
            </select>
            <select class="filtro-select" id="filtroModalidad">
                <option value="">Modalidad</option>
                <option value="presencial">Presencial</option>
                <option value="en-linea">En línea</option>
            </select>
        </div>
    </div>

    <section class="seccion">
        <div class="contenedor">
            <div class="tarjetas" id="listaCursos">

                <div class="curso-tarjeta" data-nivel="principiante" data-sede="centro norte" data-modalidad="presencial">
                    <div class="tarjeta-nivel principiante">Principiante</div>
                    <div class="curso-header">
                        <h3>Ajedrez básico</h3>
                        <div class="curso-precio">$800 <span>/mes</span></div>
                    </div>
                    <p>Aprende las reglas, movimientos de cada pieza y estrategias fundamentales del ajedrez. Ideal para quienes no tienen ninguna experiencia previa.</p>
                    <div class="curso-detalles">
                        <span>⏱ Duración: 3 meses</span>
                        <span>📍 Todas las sedes</span>
                        <span>🕐 Lun / Mié / Vie</span>
                        <span>💻 Presencial</span>
                    </div>
                    <p class="curso-requisito">Requisito: Ninguno. Apto para todas las edades.</p>
                    <a href="{{ route('contacto') }}" class="btn-primario btn-completo">Pre-inscribirse</a>
                </div>

                <div class="curso-tarjeta" data-nivel="principiante" data-sede="centro" data-modalidad="en-linea">
                    <div class="tarjeta-nivel principiante">Principiante</div>
                    <div class="curso-header">
                        <h3>Ajedrez en línea para niños</h3>
                        <div class="curso-precio">$600 <span>/mes</span></div>
                    </div>
                    <p>Versión en línea del curso básico, adaptada para niños de 6 a 12 años con dinámicas interactivas y plataforma digital.</p>
                    <div class="curso-detalles">
                        <span>⏱ Duración: 3 meses</span>
                        <span>📍 En línea</span>
                        <span>🕐 Mar / Jue</span>
                        <span>💻 En línea</span>
                    </div>
                    <p class="curso-requisito">Requisito: Ninguno. Niños 6-12 años.</p>
                    <a href="{{ route('contacto') }}" class="btn-primario btn-completo">Pre-inscribirse</a>
                </div>

                <div class="curso-tarjeta" data-nivel="intermedio" data-sede="centro" data-modalidad="presencial">
                    <div class="tarjeta-nivel intermedio">Intermedio</div>
                    <div class="curso-header">
                        <h3>Táctica y estrategia</h3>
                        <div class="curso-precio">$950 <span>/mes</span></div>
                    </div>
                    <p>Perfecciona tu juego con tácticas avanzadas, estudio de aperturas reconocidas y técnicas de final de partida.</p>
                    <div class="curso-detalles">
                        <span>⏱ Duración: 4 meses</span>
                        <span>📍 Sede Centro</span>
                        <span>🕐 Lun / Mié / Vie</span>
                        <span>💻 Presencial</span>
                    </div>
                    <p class="curso-requisito">Requisito: Curso básico o conocimiento previo.</p>
                    <a href="{{ route('contacto') }}" class="btn-primario btn-completo">Pre-inscribirse</a>
                </div>

                <div class="curso-tarjeta" data-nivel="intermedio" data-sede="norte" data-modalidad="presencial">
                    <div class="tarjeta-nivel intermedio">Intermedio</div>
                    <div class="curso-header">
                        <h3>Finales de partida</h3>
                        <div class="curso-precio">$900 <span>/mes</span></div>
                    </div>
                    <p>Domina los finales más importantes: rey y peón, torres, alfiles y caballos. Fundamento esencial para subir de nivel.</p>
                    <div class="curso-detalles">
                        <span>⏱ Duración: 2 meses</span>
                        <span>📍 Sede Norte</span>
                        <span>🕐 Mar / Jue / Sáb</span>
                        <span>💻 Presencial</span>
                    </div>
                    <p class="curso-requisito">Requisito: Nivel básico aprobado.</p>
                    <a href="{{ route('contacto') }}" class="btn-primario btn-completo">Pre-inscribirse</a>
                </div>

                <div class="curso-tarjeta" data-nivel="avanzado" data-sede="centro" data-modalidad="presencial">
                    <div class="tarjeta-nivel avanzado">Avanzado</div>
                    <div class="curso-header">
                        <h3>Preparación para torneos</h3>
                        <div class="curso-precio">$1,200 <span>/mes</span></div>
                    </div>
                    <p>Entrenamiento intensivo para competencias locales, estatales y nacionales. Análisis de partidas, apertura profunda y psicología competitiva.</p>
                    <div class="curso-detalles">
                        <span>⏱ Duración: 6 meses</span>
                        <span>📍 Sede Centro</span>
                        <span>🕐 Lun a Vie</span>
                        <span>💻 Presencial</span>
                    </div>
                    <p class="curso-requisito">Requisito: Nivel intermedio + evaluación.</p>
                    <a href="{{ route('contacto') }}" class="btn-primario btn-completo">Pre-inscribirse</a>
                </div>

                <div class="curso-tarjeta" data-nivel="avanzado" data-sede="centro norte" data-modalidad="en-linea">
                    <div class="tarjeta-nivel avanzado">Avanzado</div>
                    <div class="curso-header">
                        <h3>Análisis con motor de ajedrez</h3>
                        <div class="curso-precio">$1,000 <span>/mes</span></div>
                    </div>
                    <p>Aprende a usar motores de análisis (Stockfish) para revisar tus partidas, identificar errores y diseñar tu repertorio de aperturas.</p>
                    <div class="curso-detalles">
                        <span>⏱ Duración: 2 meses</span>
                        <span>📍 En línea</span>
                        <span>🕐 Sáb</span>
                        <span>💻 En línea</span>
                    </div>
                    <p class="curso-requisito">Requisito: Nivel intermedio o superior.</p>
                    <a href="{{ route('contacto') }}" class="btn-primario btn-completo">Pre-inscribirse</a>
                </div>

            </div>

            <p class="sin-resultados" id="sinResultados">No se encontraron cursos con los filtros seleccionados.</p>
        </div>
    </section>

    @include('website.footer')

    <script>
        const busqueda      = document.getElementById('busqueda');
        const nivel         = document.getElementById('filtroNivel');
        const sede          = document.getElementById('filtroSede');
        const modalidad     = document.getElementById('filtroModalidad');
        const tarjetas      = document.querySelectorAll('.curso-tarjeta');
        const sinResultados = document.getElementById('sinResultados');

        function filtrar() {
            const q = busqueda.value.toLowerCase();
            const n = nivel.value;
            const s = sede.value;
            const m = modalidad.value;
            let visibles = 0;

            tarjetas.forEach(t => {
                const texto  = t.innerText.toLowerCase();
                const ok = (!q || texto.includes(q))
                        && (!n || t.dataset.nivel === n)
                        && (!s || t.dataset.sede.includes(s))
                        && (!m || t.dataset.modalidad === m);

                t.style.display = ok ? '' : 'none';
                if (ok) visibles++;
            });

            sinResultados.classList.toggle('visible', visibles === 0);
        }

        [busqueda, nivel, sede, modalidad].forEach(el => el.addEventListener('input', filtrar));
    </script>
</body>
</html>