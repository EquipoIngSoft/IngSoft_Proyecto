<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cátalogo de Cursos</title>

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Iconos (Remix Icons) -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Hoja de estilos -->
    <link rel="stylesheet" href="{{ asset('./css/website/cursos.css') }}">
    <!--middleware para el buscador-->
    <script src="{{ asset('../app/Http/Middleware/Cursos/buscadorCurso.js') }}"></script>
</head>
<body>
    

    <div class="bar">
        <a href="/">
        <div class="sidebar-logo">
            <img src="{{ asset('./Logos/LogoEgau.png') }}" alt="EGAU Chess" class="sidebar-logo-img">
            <span class="sidebar-brand">EGAU Chess</span>
        </div>
        </a>

          <!-- Cabecera de controles: Búsqueda y Filtros -->
                <div class="controls-container">
                    <!-- Buscador -->
                    <div class="search-bar">
                        <i class="ri-search-line search-icon"></i>
                        <input type="text" id="buscador" placeholder="Buscar alumno..." autocomplete="off">
                    </div>

                    <!-- Filtros -->
                    <div class="filtros">
                       <select name="nivel" id="filtro-nivel" class="filtro">
                            <option value="">Todos los niveles</option>
                            <option value="principiante">Principiante</option>
                            <option value="intermedio">Intermedio</option>
                            <option value="avanzado">Avanzado</option>
                        </select>
                        <select name="sede" id="filtro-sede" class="filtro">
                            <option value="">Todas las sedes</option>
                            <option value="sede1">Sede 1</option>
                            <option value="sede2">Sede 2</option>
                        </select>
                        <select name="horario" id="filtro-horario" class="filtro">
                            <option value="">Todos los horarios</option>
                            <option value="mañana">Mañana</option>
                            <option value="tarde">Tarde</option>
                            <option value="noche">Noche</option>
                        </select>
                        <select name="modalidad" id="filtro-modalidad" class="filtro">
                            <option value="">Todas las modalidades</option>
                            <option value="presencial">Presencial</option>
                            <option value="en-linea">En línea</option>
                        </select>
                    </div>
                </div>

        <div class="bar-menu btn-container" >
            <a href="/login" class="bar-item active">Iniciar sesión</a>
        </div>
    </div>
    <br>
    <main>
      
            <div class="content">
                <h1 class="main-title">Catálogo de Cursos</h2>
                <p class="main-description">Explora nuestro catálogo de cursos de ajedrez diseñados para todos los niveles. Desde principiantes que quieren aprender las reglas básicas, hasta jugadores avanzados que buscan perfeccionar sus estrategias. Encuentra el curso perfecto para ti y mejora tu juego con EGAU Chess.</p>
                </p>
            </div>

    
    <div class="cursos">
        
        <div class="curso-card">
           <a href="/curso">
            <img src="{{ asset('./Logos/LogoAmaac.png') }}" alt="Curso 1" class="curso-image">
            <br>
            <h3 class="curso-title">Curso de Ajedrez para Principiantes</h3>
            <br>
            <p class="curso-description">Aprende las reglas básicas del ajedrez, movimientos de las piezas y estrategias iniciales para comenzar tu camino en el mundo del ajedrez.</p>
        
            <a href="/registro" class="centrar"> <button class="btn-inscribirse" >Solicitar inscripción</button></a>
         </a>
        </div>
       
    
        <div class="curso-card">
            <a href="/curso">
            <img src="{{ asset('./Logos/LogoAmaac.png') }}" alt="Curso 2" class="curso-image">
            <br>
            <h3 class="curso-title">Tácticas y Estrategias Intermedias</h3>
            <br>
            <p class="curso-description">Desarrolla tus habilidades tácticas y estratégicas con ejercicios prácticos y análisis de partidas clásicas para jugadores de nivel intermedio.</p>
         <a href="/registro" class="centrar"> <button class="btn-inscribirse" >Solicitar inscripción</button></a>
        </a>  
        </div>

        <div class="curso-card">
            <a href="/curso">
            <img src="{{ asset('./Logos/LogoAmaac.png') }}" alt="Curso 3" class="curso-image">
            <br>
            <h3 class="curso-title">Aperturas Avanzadas</h3>
            <br>
            <p class="curso-description">Explora las aperturas más populares y efectivas utilizadas por los grandes maestros, y aprende a aplicarlas en tus partidas para obtener ventaja desde el inicio.</p>
        <a href="/registro" class="centrar"> <button class="btn-inscribirse" >Solicitar inscripción</button></a>
    </a>      
    </div>
        <div class="curso-card">
            <a href="/curso">
            <img src="{{ asset('./Logos/LogoAmaac.png') }}" alt="Curso 4" class="curso-image">
            <br>
            <h3 class="curso-title">Estrategias de Final de Partida</h3>
            <br>
           
            <p class="curso-description">Domina las técnicas y estrategias necesarias para convertir ventajas en victorias en las etapas finales de las partidas.</p>
            <a href="/registro" class="centrar"> <button class="btn-inscribirse" onclick="irARegistro()">Solicitar inscripción</button></a>
        </a>    
        </div>

       <div class="curso-card">
            <a href="/curso">
            <img src="{{ asset('./Logos/LogoAmaac.png') }}" alt="Curso 4" class="curso-image">
            <br>
            <h3 class="curso-title">Estrategias de Final de Partida</h3>
            <br>
           
            <p class="curso-description">Domina las técnicas y estrategias necesarias para convertir ventajas en victorias en las etapas finales de las partidas.</p>
            <a href="/registro" class="centrar"> <button class="btn-inscribirse" onclick="irARegistro()">Solicitar inscripción</button></a>
        </a>    
        </div>
         <div class="curso-card">
            <a href="/curso">
            <img src="{{ asset('./Logos/LogoAmaac.png') }}" alt="Curso 4" class="curso-image">
            <br>
            <h3 class="curso-title">Estrategias de Final de Partida</h3>
            <br>
           
            <p class="curso-description">Domina las técnicas y estrategias necesarias para convertir ventajas en victorias en las etapas finales de las partidas.</p>
            <a href="/registro" class="centrar"> <button class="btn-inscribirse" onclick="irARegistro()">Solicitar inscripción</button></a>
        </a>    
        </div>
        </div>
    </main>
</body>
</html>