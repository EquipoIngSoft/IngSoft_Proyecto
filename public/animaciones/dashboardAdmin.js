// ==============================================
//  dashboard.js — Interactividad del Dashboard
//  EGAU Chess | AMAAC
// ==============================================

document.addEventListener('DOMContentLoaded', () => {

    // ---- Toggle del sidebar (Móvil y Escritorio) ----
    const menuToggle = document.getElementById('menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.querySelector('.main-content');

    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                // Modo móvil: Abrir/Cerrar drawer
                sidebar.classList.toggle('open');
            } else {
                // Modo escritorio: Colapsar/Expandir con ajuste de contenido
                sidebar.classList.toggle('collapsed');
                if (mainContent) {
                    mainContent.classList.toggle('sidebar-hidden');
                }
            }
        });

        // Cerrar sidebar al hacer clic fuera en móvil
        document.addEventListener('click', (e) => {
            if (window.innerWidth <= 768 &&
                !sidebar.contains(e.target) &&
                !menuToggle.contains(e.target)) {
                sidebar.classList.remove('open');
            }
        });
    }

    // ---- Navegación: resaltar sección activa y cambiar contenido ----
    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault(); // Evitar salto de scroll si el href es "#"

            // 1. Cambiar clase activa en el menú
            document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
            item.classList.add('active');

            // 2. Ocultar todas las secciones
            document.querySelectorAll('.section-content').forEach(sec => {
                sec.style.display = 'none';
            });

            // 3. Mostrar la sección relacionada
            const sectionId = item.getAttribute('data-section');
            const targetSection = document.getElementById('section-' + sectionId);
            if (targetSection) {
                targetSection.style.display = 'block';
            }

            // En móvil, cerrar sidebar al navegar
            if (window.innerWidth <= 768 && sidebar) {
                sidebar.classList.remove('open');
            }
        });
    });

    // ---- Búsqueda y Filtros Custom ----
    const buscador = document.getElementById('buscador');
    const btnLimpiar = document.getElementById('btn-limpiar');
    const tabla = document.getElementById('tabla-alumnos');

    if (tabla) {
        const filas = tabla.querySelectorAll('tbody tr');
        const info = document.querySelector('.pagination-info');

        // Función Principal de Filtrado
        const aplicarFiltros = () => {
            const query = buscador ? buscador.value.toLowerCase().trim() : '';
            
            // Obtener el valor de "data-value" del trigger de cada custom select
            const triggerNivel = document.querySelector('#dropdown-nivel .selected-text');
            const triggerGrupo = document.querySelector('#dropdown-grupo .selected-text');
            const triggerStatus = document.querySelector('#dropdown-status .selected-text');

            const nivel = triggerNivel ? triggerNivel.getAttribute('data-value') : '';
            const grupo = triggerGrupo ? triggerGrupo.getAttribute('data-value') : '';
            const status = triggerStatus ? triggerStatus.getAttribute('data-value') : '';

            let visibles = 0;

            filas.forEach(fila => {
                const textoGeneral = fila.textContent.toLowerCase();
                const tdNivel = fila.cells[3].textContent.toLowerCase();
                const tdGrupo = fila.cells[4].textContent.toLowerCase();
                const tdStatus = fila.cells[5].textContent.toLowerCase();

                const coincideTexto = textoGeneral.includes(query);
                const coincideNivel = nivel === '' || tdNivel.includes(nivel);
                const coincideGrupo = grupo === '' || tdGrupo.includes(grupo);
                const coincideStatus = status === '' || tdStatus.includes(status);

                if (coincideTexto && coincideNivel && coincideGrupo && coincideStatus) {
                    fila.style.display = '';
                    visibles++;
                } else {
                    fila.style.display = 'none';
                }
            });

            if (info) {
                info.textContent = `Mostrando ${visibles} resultado${visibles !== 1 ? 's' : ''}`;
            }
        };

        // Escuchar input en buscar
        if (buscador) buscador.addEventListener('input', aplicarFiltros);

        // Lógica de los Custom Dropdowns
        const customDropdowns = document.querySelectorAll('.custom-dropdown');

        customDropdowns.forEach(dropdown => {
            const trigger = dropdown.querySelector('.custom-select-trigger');
            const options = dropdown.querySelectorAll('.custom-option');
            const selectedText = dropdown.querySelector('.selected-text');

            // Abrir / Cerrar Dropdown
            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                // Cerrar cualquier otro abierto
                customDropdowns.forEach(d => {
                    if (d !== dropdown) d.classList.remove('open');
                });
                dropdown.classList.toggle('open');
            });

            // Seleccionar opción
            options.forEach(option => {
                option.addEventListener('click', (e) => {
                    e.stopPropagation();

                    // Quitar clase selected a los demás
                    options.forEach(opt => opt.classList.remove('selected'));
                    option.classList.add('selected');

                    // Actualizar texto y valor en el trigger
                    const val = option.getAttribute('data-value');
                    const text = option.textContent;
                    
                    selectedText.textContent = text;
                    selectedText.setAttribute('data-value', val);

                    // Cerrar el dropdown
                    dropdown.classList.remove('open');

                    // Aplicar Filtros a la tabla
                    aplicarFiltros();
                });
            });
        });

        // Cerrar dropdown si se hace clic fuera
        document.addEventListener('click', () => {
            customDropdowns.forEach(dropdown => dropdown.classList.remove('open'));
        });

        // Botón Limpiar
        if (btnLimpiar) {
            btnLimpiar.addEventListener('click', () => {
                if (buscador) buscador.value = '';
                
                // Reiniciar custom dropdowns
                customDropdowns.forEach(dropdown => {
                    const options = dropdown.querySelectorAll('.custom-option');
                    const selectedText = dropdown.querySelector('.selected-text');
                    
                    options.forEach(opt => opt.classList.remove('selected'));
                    
                    // Elegir por default el primer option que en teoría es "Todos..."
                    if (options.length > 0) {
                        const firstOpt = options[0];
                        firstOpt.classList.add('selected');
                        selectedText.textContent = firstOpt.textContent;
                        selectedText.setAttribute('data-value', firstOpt.getAttribute('data-value'));
                    }
                });

                aplicarFiltros();
            });
        }
    }

    // ---- Menú de Perfil (Cuenta Administrador) ----
    const profileMenu = document.getElementById('profile-menu');
    
    if (profileMenu) {
        const profileTrigger = profileMenu.querySelector('.profile-trigger');
        
        // Abrir / Cerrar al hacer clic en el nombre u avatar
        profileTrigger.addEventListener('click', (e) => {
            e.stopPropagation(); // Prevenir que el listener global lo cierre de inmediato
            profileMenu.classList.toggle('open');
        });

        // Cerrar si se da un clic fuera
        document.addEventListener('click', () => {
            profileMenu.classList.remove('open');
        });

        // Botón Configuración en el menú perfil => Lleva a la seccion Opciones
        const btnConfigPerfil = document.getElementById('btn-config-perfil');
        if (btnConfigPerfil) {
            btnConfigPerfil.addEventListener('click', () => {
                // Simulamos un click en el enlace Opciones nativo de la barra lateral
                const navOpciones = document.querySelector('.nav-footer-item[data-section="opciones"]');
                if (navOpciones) {
                    navOpciones.click();
                }
            });
        }

        // Botón Cerrar Sesión -> Regresar a logIn.html
        const btnLogout = document.getElementById('btn-logout');
        if (btnLogout) {
            btnLogout.addEventListener('click', () => {
                window.location.href = '/';
            });
        }
    }

});
