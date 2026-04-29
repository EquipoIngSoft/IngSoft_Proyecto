// ==============================================
//  dashboardAlumnoMiNivel.js
//  Responsable: Mariana
//  EGAU Chess | Portal del Estudiante
// ==============================================

// Toggle de logros desplegables en la sección Mi Nivel.
(function () {



    function calcularRango(puntos) {
        if (puntos >= 3000) return { numero: 6, nombre: 'Rey', emoji: '♚', desc: 'Si caes tú, caemos todos, serás el último en pie', min: 3000, max: 3000, sig: null, animClass: 'anim-rey' };

        if (puntos >= 1500) return { numero: 5, nombre: 'Reina', emoji: '♛', desc: 'Todos lo que pidas se lo lleva la joya de la corona', min: 1500, max: 3000, sig: 'Rey', animClass: 'anim-reina' };

        if (puntos >= 800) return { numero: 4, nombre: 'Torre', emoji: '♜', desc: 'Va directo al grano, si alguien debe caer esa no será la Torre', min: 800, max: 1500, sig: 'Reina', animClass: 'anim-torre' };

        if (puntos >= 400) return { numero: 3, nombre: 'Alfil', emoji: '♝', desc: 'Se desliza por el tablero, algunos le han visto derrapar', min: 400, max: 800, sig: 'Torre', animClass: 'anim-alfil' };

        if (puntos >= 150) return { numero: 2, nombre: 'Caballo', emoji: '♞', desc: 'Saltar sobre los oponentes se siente injusto, ¿no?', min: 150, max: 400, sig: 'Alfil', animClass: 'anim-caballo' };

        return { numero: 1, nombre: 'Peón', emoji: '♟', desc: 'Al frente de las filas, sueña con la victoria', min: 0, max: 150, sig: 'Caballo', animClass: 'anim-peon' };
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

                const iconoElement = document.getElementById('nivel_icono');

                // Asignar datos
                iconoElement.textContent = rango.emoji;
                document.getElementById('nivel_nombre').textContent = rango.nombre;
                document.getElementById('nivel_desc').textContent = rango.desc;

                // Animación de la pieza de ajedrez
                // Limpiamos clases anteriores por si el nivel cambia dinámicamente
                iconoElement.className = '';

                // Forzamos un reflow (esto reinicia la animación si ya estaba aplicada)
                void iconoElement.offsetWidth;

                // Agregamos la clase de la animación
                iconoElement.classList.add(rango.animClass);
                // ----------------------------------

                // Revelar ahora que hay datos reales
                iconoElement.style.visibility = 'visible';
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
                    // Porcentaje calculado
                    const rango_size = rango.max - rango.min;
                    const en_nivel = puntos - rango.min;
                    const porcentaje = Math.min((en_nivel / rango_size) * 100, 100);
                    document.getElementById('progress-fill-nivel').style.width = porcentaje + '%';
                }

                // (Resto de tu código intacto...)
                if (data.posicion_global) {
                    const elGlobal = document.getElementById('puesto_global');
                    if (elGlobal) elGlobal.textContent = `#${data.posicion_global} Global`;
                }

                if (data.posicion_sede) {
                    const elSede = document.getElementById('puesto_sede');
                    if (elSede) elSede.textContent = `#${data.posicion_sede} en tu Sede`;
                }

                if (data.ranking) {
                    pintarRanking(data.ranking, data.alumno.id_alumno);
                }

                if (data.ranking_sede) {
                    pintarRanking_sede(data.ranking_sede, data.alumno.id_alumno);
                }

                pintarLogros(data);
            })
            .catch(err => console.error('Error al cargar nivel:', err));
    }

    function pintarRanking(ranking, idActual) {
        const tbody = document.getElementById('tabla-ranking-body');
        if (!tbody) return;

        const medalColors = { 1: '#d4af37', 2: '#c0c0c0', 3: '#cd7f32' };

        let posActual = 0;
        let puntajeAnterior = null;

        tbody.innerHTML = ranking.map((al) => {
            // Lógica de empate: si el puntaje es diferente al anterior, bajamos de puesto
            if (al.puntaje !== puntajeAnterior) {
                posActual++;
                puntajeAnterior = al.puntaje;
            }

            const pos = posActual;
            const esYo = al.id_alumno === idActual;
            const medal = pos <= 3 ? `<i class="ri-medal-fill"></i> ` : '';
            const color = medalColors[pos] || (esYo ? 'var(--naranja)' : 'var(--texto-suave)');

            const rowStyle = esYo
                ? 'background-color: var(--naranja-light); border-left: 4px solid var(--naranja); border-bottom: 1px solid var(--borde);'
                : 'border-bottom: 1px solid var(--borde);';

            const textStyle = esYo ? 'font-weight: 700; color: var(--naranja);' : 'font-weight: 500; color: var(--texto);';

            return `
                <tr style="${rowStyle}">
                    <td style="padding: 16px; font-weight: 700; color: ${color};">${medal}${pos}</td>
                    <td style="padding: 16px; ${textStyle}">${al.nombre}${esYo ? ' (Tú)' : ''}</td>
                    <td style="padding: 16px;"><span class="badge badge-naranja">Nivel ${al.nivel}</span></td>
                    <td style="padding: 16px; text-align: right; font-weight: 600; color: ${esYo ? 'var(--naranja)' : 'var(--texto)'};">${al.puntaje}</td>
                </tr>
            `;
        }).join('');


    }


    function pintarRanking_sede(ranking_sede, idActual) {
        const tbody = document.getElementById('tabla-ranking-sede-body');
        if (!tbody) {
            console.warn("No se encontró el elemento 'tabla-ranking-sede-body'");
            return;
        }

        const medalColors = { 1: '#d4af37', 2: '#c0c0c0', 3: '#cd7f32' };
        let posActual = 0;
        let puntajeAnterior = null;

        tbody.innerHTML = ranking_sede.map((al) => {
            if (al.puntaje !== puntajeAnterior) {
                posActual++;
                puntajeAnterior = al.puntaje;
            }

            const pos = posActual;
            const esYo = al.id_alumno === idActual;
            const medal = pos <= 3 ? `<i class="ri-medal-fill"></i> ` : '';
            const color = medalColors[pos] || (esYo ? 'var(--naranja)' : 'var(--texto-suave)');

            const rowStyle = esYo
                ? 'background-color: var(--naranja-light); border-left: 4px solid var(--naranja); border-bottom: 1px solid var(--borde);'
                : 'border-bottom: 1px solid var(--borde);';

            const textStyle = esYo ? 'font-weight: 700; color: var(--naranja);' : 'font-weight: 500; color: var(--texto);';

            return `
            <tr style="${rowStyle}">
                <td style="padding: 16px; font-weight: 700; color: ${color};">${medal}${pos}</td>
                <td style="padding: 16px; ${textStyle}">${al.nombre}${esYo ? ' (Tú)' : ''}</td>
                <td style="padding: 16px;"><span class="badge badge-naranja">Nivel ${al.nivel}</span></td>
                <td style="padding: 16px; text-align: right; font-weight: 600; color: ${esYo ? 'var(--naranja)' : 'var(--texto)'};">${al.puntaje}</td>
            </tr>
        `;
        }).join('');
    }


    window.cargarMiNivel = async function () {
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



    //Todos los logros disponibles 
    function pintarLogros(data) {
        const contenedor = document.getElementById('logros-desplegables');
        const contadorTexto = document.querySelector('#card-logros h4');
        if (!contenedor) return;

        const logros = [];
        const p = data.alumno.puntaje || 0;
        const posSede = data.posicion_sede;
        const posGlobal = data.posicion_global;

        // --- LÓGICA DE LOGROS ---

        //Logros de ranking

        //Primer lugar Global
        if (posGlobal === 1 && p > 0) {
            logros.push({
                titulo: 'Algún tipo de deidad',
                desc: '¡Eres el mejor de todo nuestro mundo!',
                icono: 'ri-star-fill',
                color: '#d4af37' // Oro de la tabla
            });
        }

        //Logro Top 2 Global
        if (posGlobal <= 2 && p > 0) {
            logros.push({
                titulo: 'Mecenas de Plata',
                desc: '¡Felicidades, has alcanzado el segundo lugar de la plataforma!',
                icono: 'ri-star-half-fill',
                color: '#c0c0c0' // Plata de la tabla
            });
        }

        //Logro Top 3 Global
        if (posGlobal <= 3 && p > 0) {
            logros.push({
                titulo: 'Ajjajaja, felicidades',
                desc: '¡Felicidades, has alcanzado el tercer lugar de la plataforma!',
                icono: 'ri-chat-smile-3-line',
                color: '#cd7f32' // Bronce de la tabla
            });
        }

        //Logro Top 5 Global
        if (posGlobal <= 5 && p > 0) {
            logros.push({
                titulo: '¿Perteneces a alguna organización secreta de ajedrez?',
                desc: '¡Felicidades, has alcanzado el quinto lugar de la plataforma!',
                icono: 'ri-emotion-2-fill',
                color: 'var(--azul)'
            });
        }

        //Logro Top 10 Global
        if (posGlobal <= 10 && p > 0) {
            logros.push({
                titulo: 'Poniendo mucho en esto',
                desc: 'Estás entre los 10 mejores de toda la plataforma.',
                icono: 'ri-heart-pulse-line',
                color: 'var(--naranja)'
            });
        }

        //Logro Top 50 Global
        if (posGlobal <= 50 && p > 0) {
            logros.push({
                titulo: 'Líder Regional',
                desc: '¡Felicidades, has alcanzado el puesto 50 de la plataforma!',
                icono: 'ri-global-fill',
                color: 'var(--verde)'
            });
        }

        // Logro: No. 1 en Sede
        if (posSede === 1 && p > 0) {
            logros.push({
                titulo: 'Rey de la Sede',
                desc: '¡Eres el puntaje más alto de tu sucursal!',
                icono: 'ri-vip-crown-2-fill',
                color: '#d4af37' // Oro de la tabla
            });
        }

        //Logro: No. 2 en Sede
        if (posSede <= 2 && p > 0) {
            logros.push({
                titulo: 'Príncipe de la Sede',
                desc: '¡Felicidades, has alcanzado el segundo lugar de tu sucursal!',
                icono: 'ri-vip-crown-line',
                color: '#c0c0c0' // Plata de la tabla
            });
        }

        //Logro: No. 3 en sede
        if (posSede <= 3 && p > 0) {
            logros.push({
                titulo: 'Duque de la Sede',
                desc: '¡Felicidades, has alcanzado el tercer lugar de tu sucursal!',
                icono: 'ri-vip-diamond-fill',
                color: '#cd7f32' // Bronce de la tabla
            });
        }

        //Logro No. 5 en sede
        if (posSede <= 5 && p > 0) {
            logros.push({
                titulo: 'Barón de la Sede',
                desc: '¡Felicidades, has alcanzado el quinto lugar de tu sucursal!',
                icono: 'ri-bookmark-3-line',
                color: 'var(--azul)'
            });
        }

        //Logro No. 10 en Sede
        if (posSede <= 10 && p > 0) {
            logros.push({
                titulo: 'Vizconde de la Sede',
                desc: '¡Felicidades, estás entre los 10 mejores de tu sucursal!',
                icono: 'ri-emotion-laugh-fill',
                color: 'var(--naranja)'
            });
        }

        //Logros de puntajes

        if (p >= 3500) {
            logros.push({
                titulo: '¡Tus puntos han llenado el tiempo y el espacio! (O algo así)',
                desc: '¡Has acumulado 3500 puntos en la plataforma!',
                icono: 'ri-sparkling-2-line',
                color: '#d4af37'
            });
        }

        //Logro: Por puntaje: 3000 puntos
        if (p >= 3000) {
            logros.push({
                titulo: '¡El Sistema Puntual está en la Vía Láctea!',
                desc: '¡Has acumulado 3000 puntos en la plataforma!',
                icono: 'ri-planet-line',
                color: 'var(--azul)'
            });

            logros.push({
                titulo: 'Larga vida al rey',
                desc: 'Danzas suave, siempre un cuadro a la vez',
                icono: 'ri-gem-fill',
                color: '#d4af37'
            });
        }

        //Logro: Por puntaje: 2500 puntos
        if (p >= 2500) {
            logros.push({
                titulo: 'Ahora hay 4 continentes, el otro lo inundaste de puntos',
                desc: 'Has acumulado 2500 puntos en la plataforma.',
                icono: 'ri-earth-fill',
                color: 'var(--verde)'
            });
        }

        //Logro: Por puntaje: 2000 puntos
        if (p >= 2000) {
            logros.push({
                titulo: '¿Qué país estaba ahí antes?',
                desc: 'Has acumulado 2000 puntos en la plataforma.',
                icono: 'ri-landscape-ai-line',
                color: 'var(--naranja)'
            });
        }

        //Logro: Por puntaje: 1500 puntos
        if (p >= 1500) {
            logros.push({
                titulo: 'Una bella ciudad... de puntos',
                desc: 'Has acumulado 1500 puntos en la plataforma.',
                icono: 'ri-building-fill',
                color: 'var(--azul)'
            });

            logros.push({
                titulo: 'Nadie contradice a la reina...',
                desc: '...o pierde la cabeza y peor... ¡pierde una pieza!',
                icono: 'ri-skull-line',
                color: '#d4af37'
            });
        }

        //Logro: Por puntaje: 1000 puntos
        if (p >= 1000) {
            logros.push({
                titulo: 'Una casa se ha hundido en tus puntos',
                desc: 'Has acumulado 1000 puntos en la plataforma.',
                icono: 'ri-home-heart-fill',
                color: 'var(--naranja)'
            });
        }

        //Logro: Por puntaje: 800 puntos
        if (p >= 800) {
            logros.push({
                titulo: 'Cuarto de herencia del abuelo',
                desc: 'Has acumulado 800 puntos en la plataforma.',
                icono: 'ri-glasses-2-line',
                color: 'var(--texto-suave)'
            });

            logros.push({
                titulo: 'La Torre Amurallada',
                desc: 'Si las torres no se mueven, ¿cómo has llegado tan lejos?',
                icono: 'ri-building-4-fill',
                color: 'var(--texto)'
            });
        }

        //Logro: Por puntaje: 500 puntos
        if (p >= 500) {
            logros.push({
                titulo: 'Dormir sobre puntos... ¿te resulta cómodo?',
                desc: 'Has acumulado 500 puntos en la plataforma.',
                icono: 'ri-hotel-bed-line',
                color: 'var(--azul)'
            });
        }

        if (p >= 400) {
            logros.push({
                titulo: 'Caballero de la mesa redonda',
                desc: 'EL alfil avanza en diagonal, la dirección más rápida del tablero',
                icono: 'ri-sword-line',
                color: 'var(--naranja)'
            });
        }

        //Logro: Por puntaje: 300 puntos
        if (p >= 300) {
            logros.push({
                titulo: 'Cofre repleto de puntos',
                desc: 'Has acumulado 300 puntos en la plataforma.',
                icono: 'ri-treasure-map-line',
                color: '#cd7f32' // Tono madera/bronce
            });
        }

        if (p >= 150) {
            logros.push({
                titulo: '¡Relincha y galopa!',
                desc: 'A veces come reyes, lo cual no es muy normal en un caballo.',
                icono: 'ri-omega',
                color: 'var(--naranja)'
            });
        }

        //Logro: Por puntaje: 100 puntos
        if (p >= 100) {
            logros.push({
                titulo: 'Cajón de puntos',
                desc: 'Has acumulado 100 puntos en la plataforma.',
                icono: 'ri-inbox-fill',
                color: 'var(--texto-suave)'
            });
        }

        //Logro: Por puntaje: 50 puntos
        if (p >= 50) {
            logros.push({
                titulo: '¡Hoy peón, mañana Reina!',
                desc: 'Has acumulado 50 puntos en la plataforma.',
                icono: 'ri-hand-heart-line',
                color: 'var(--verde)'
            });
        }


        // --- RENDERIZADO ---

        if (logros.length === 0) {
            contenedor.innerHTML = `
            <p style="text-align:center; color:var(--texto-suave); font-size:12px; padding:10px;">
                Aún no tienes logros. ¡Sigue practicando!
            </p>`;
            contadorTexto.textContent = "0 Logros";
            return;
        }

        // Actualizar contador
        contadorTexto.textContent = `${logros.length} Desbloqueados`;

        // Pintar los cuadros de logros
        contenedor.innerHTML = logros.map(logro => `
        <div style="background: var(--blanco); padding: 12px; border-radius: 8px; border: 1px solid var(--borde); border-left: 4px solid ${logro.color}; display: flex; align-items: center; gap: 12px;">
            <i class="${logro.icono}" style="color: ${logro.color}; font-size: 20px;"></i>
            <div>
                <h5 style="margin: 0; font-size: 14px; color: var(--texto);">${logro.titulo}</h5>
                <p style="margin: 0; font-size: 12px; color: var(--texto-suave);">${logro.desc}</p>
            </div>
        </div>
    `).join('');
    }

    // Lógica para abrir y cerrar los logros
    document.addEventListener('click', function (e) {
        // Verificamos si el clic fue en la tarjeta de logros o en sus hijos
        const card = e.target.closest('#card-logros');

        if (card) {
            const desplegable = document.getElementById('logros-desplegables');
            const icono = document.getElementById('icon-logros');

            if (desplegable.style.display === 'none' || desplegable.style.display === '') {
                desplegable.style.display = 'flex';
                if (icono) icono.style.transform = 'rotate(180deg)';
            } else {
                desplegable.style.display = 'none';
                if (icono) icono.style.transform = 'rotate(0deg)';
            }
        }
    });
})();
