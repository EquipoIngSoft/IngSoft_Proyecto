{{-- =============================================
     dashboardAlumno/sidebar.blade.php
     Include reutilizable — Portal del Estudiante
     Uso: @include('dashboardAlumno.sidebar', ['seccionActiva' => 'inicio'])
     ============================================= --}}

<aside class="sidebar" id="sidebar">

    {{-- Logo --}}
    <div class="sidebar-logo">
        <img src="{{ asset('Logos/LogoEgau.png') }}" alt="EGAU Chess" class="sidebar-logo-img">
        <span class="sidebar-brand">EGAU Chess</span>
    </div>

    {{-- Navegación --}}
    <nav class="sidebar-nav">
        <ul>
            <li class="nav-item {{ ($seccionActiva ?? '') === 'inicio' ? 'active' : '' }}">
                <a href="{{ route('alumno.inicio') }}">
                    <i class="ri-home-4-line"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <li class="nav-item {{ ($seccionActiva ?? '') === 'miNivel' ? 'active' : '' }}">
                <a href="{{ route('alumno.miNivel') }}">
                    <i class="ri-bar-chart-line"></i>
                    <span>Mi Nivel</span>
                </a>
            </li>
            <li class="nav-item {{ ($seccionActiva ?? '') === 'misGrupos' ? 'active' : '' }}">
                <a href="{{ route('alumno.misGrupos') }}">
                    <i class="ri-group-line"></i>
                    <span>Mis Grupos</span>
                </a>
            </li>
            <li class="nav-item {{ ($seccionActiva ?? '') === 'extraescolares' ? 'active' : '' }}">
                <a href="{{ route('alumno.extraescolares') }}">
                    <i class="ri-star-line"></i>
                    <span>Extraescolares</span>
                </a>
            </li>
            <li class="nav-item {{ ($seccionActiva ?? '') === 'profesores' ? 'active' : '' }}">
                <a href="{{ route('alumno.profesores') }}">
                    <i class="ri-user-star-line"></i>
                    <span>Profesores</span>
                </a>
            </li>
            <li class="nav-item {{ ($seccionActiva ?? '') === 'pagos' ? 'active' : '' }}">
                <a href="{{ route('alumno.pagos') }}">
                    <i class="ri-bank-card-line"></i>
                    <span>Pagos</span>
                </a>
            </li>
            <li class="nav-item {{ ($seccionActiva ?? '') === 'miPerfil' ? 'active' : '' }}">
                <a href="{{ route('alumno.miPerfil') }}">
                    <i class="ri-user-line"></i>
                    <span>Mi Perfil</span>
                </a>
            </li>
        </ul>
    </nav>

    {{-- Pie del sidebar --}}
    <div class="sidebar-footer">
        <a href="{{ route('landing') }}" class="nav-footer-item">
            <i class="ri-logout-box-r-line"></i>
            <span>Cerrar Sesión</span>
        </a>
    </div>

</aside>