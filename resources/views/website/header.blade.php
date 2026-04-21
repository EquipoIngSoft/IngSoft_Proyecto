<header class="header">
    <div class="header-contenedor">
        <a href="{{ route('landing') }}" class="header-logo">
            <img src="{{ asset('Logos/LogoEgau.png') }}" alt="EGAU Chess">
            <span class="header-nombre">EGAU CHESS</span>
        </a>
        <nav class="header-nav">
            <a href="{{ route('cursos') }}" class="{{ request()->routeIs('cursos') ? 'activo' : '' }}">Cursos</a>
            <a href="{{ route('sedes') }}" class="{{ request()->routeIs('sedes') ? 'activo' : '' }}">Sedes</a>
            <a href="{{ route('testimonios') }}" class="{{ request()->routeIs('testimonios') ? 'activo' : '' }}">Testimonios</a>
            <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog') ? 'activo' : '' }}">Blog</a>
            <a href="{{ route('login') }}" class="header-btn">Iniciar sesión</a>
        </nav>
    </div>
</header>