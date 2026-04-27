// ==============================================
//  dashboardAlumnoMiNivel.js
//  Responsable: Mariana
//  EGAU Chess | Portal del Estudiante
// ==============================================

// Toggle de logros desplegables en la sección Mi Nivel.
(function () {
    function initLogrosToggle() {
        const cardLogros      = document.getElementById('card-logros');
        const logrosPanel     = document.getElementById('logros-desplegables');
        const iconLogros      = document.getElementById('icon-logros');

        if (!cardLogros || !logrosPanel || !iconLogros) return;

        // Evitar registrar el listener más de una vez
        if (cardLogros.dataset.logrosInit === '1') return;
        cardLogros.dataset.logrosInit = '1';

        cardLogros.addEventListener('click', function () {
            const visible = logrosPanel.style.display === 'flex';
            logrosPanel.style.display = visible ? 'none' : 'flex';
            iconLogros.style.transform = visible ? 'rotate(0deg)' : 'rotate(180deg)';
        });
    }

    function calcularRango(puntos) {
        // Mismos umbrales y nombres que AlumnoController::calcularNivel()
        if (puntos >= 3000) return { numero: 6, nombre: 'Rey',     emoji: '♚', desc: 'Maestro absoluto del tablero', min: 3000, max: 3000, sig: null };
        if (puntos >= 1500) return { numero: 5, nombre: 'Reina',   emoji: '♛', desc: 'Dominio total del juego',      min: 1500, max: 3000, sig: 'Rey' };
        if (puntos >= 800)  return { numero: 4, nombre: 'Torre',   emoji: '♜', desc: 'Dominio estratégico',          min: 800,  max: 1500, sig: 'Reina' };
        if (puntos >= 400)  return { numero: 3, nombre: 'Alfil',   emoji: '♝', desc: 'Ataque a larga distancia',     min: 400,  max: 800,  sig: 'Torre' };
        if (puntos >= 150)  return { numero: 2, nombre: 'Caballo', emoji: '♞', desc: 'Movimientos tácticos',         min: 150,  max: 400,  sig: 'Alfil' };
        return              { numero: 1, nombre: 'Peón',    emoji: '♟', desc: 'Iniciando tu camino',         min: 0,    max: 150,  sig: 'Caballo' };
    }

    function cargarDatosNivel() {
        const token = document.querySelector('meta[name="user-token"]')?.content;
        if (!token) return Promise.resolve();

        return fetch('/alumno/perfil', {
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.error) return;
            const puntos = data.alumno.puntaje || 0;
            const rango = calcularRango(puntos);

            document.getElementById('nivel_icono').textContent = rango.emoji;
            document.getElementById('nivel_nombre').textContent = rango.nombre;
            document.getElementById('nivel_desc').textContent = rango.desc;

            // Revelar ahora que hay datos reales
            document.getElementById('nivel_icono').style.visibility = 'visible';
            document.getElementById('nivel_nombre').style.visibility = 'visible';
            document.getElementById('nivel_desc').style.visibility = 'visible';

            if (!rango.sig) {
                // Nivel máximo (Rey)
                document.getElementById('nivel_siguiente_texto').textContent = 'Nivel Máximo Alcanzado';
                document.getElementById('nivel_progreso').textContent = puntos;
                document.getElementById('progress-fill-nivel').style.width = '100%';
            } else {
                document.getElementById('nivel_siguiente_texto').textContent = 'Progreso a ' + rango.sig;
                document.getElementById('nivel_progreso').textContent = `${puntos} / ${rango.max}`;
                // Porcentaje calculado entre el umbral inferior y superior del nivel actual
                const rango_size = rango.max - rango.min;
                const en_nivel = puntos - rango.min;
                const porcentaje = Math.min((en_nivel / rango_size) * 100, 100);
                document.getElementById('progress-fill-nivel').style.width = porcentaje + '%';
            }
        })
        .catch(err => console.error('Error al cargar nivel:', err));
    }

    window.cargarMiNivel = async function() {
        initLogrosToggle();
        await cargarDatosNivel();
    };

    // Ejecutar cuando el section-miNivel se hace visible
    // (el SPA lo muestra/oculta cambiando display)
    const section = document.getElementById('section-miNivel');
    if (!section) return;

    function initMiNivel() {
        if (section.dataset.perfilInit === '1') return;
        section.dataset.perfilInit = '1';
        window.cargarMiNivel();
    }

    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (m) {
            if (m.attributeName === 'style' && section.style.display !== 'none') {
                initMiNivel();
            }
        });
    });

    observer.observe(section, { attributes: true });

    if (section.style.display !== 'none') {
        initMiNivel();
    }
})();
