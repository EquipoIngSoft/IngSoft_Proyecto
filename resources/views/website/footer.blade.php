<footer class="footer">
    <div class="footer-grid">

        <!-- Marca -->
        <div class="footer-col">
            <span class="footer-brand-nombre">EGAU Chess</span>
            <p class="footer-brand-desc">Escuela de ajedrez comprometida con el desarrollo intelectual y competitivo de nuestros alumnos. Formando campeones desde la primera movida.</p>
            <span class="footer-badge">Asociación AMAAC</span>
        </div>

        <!-- Navegación -->
        <div class="footer-col">
            <h4>Sitio</h4>
            <a href="{{ route('landing') }}">Inicio</a>
            <a href="{{ route('cursos') }}">Cursos</a>
            <a href="{{ route('sedes') }}">Sedes</a>
            <a href="{{ route('testimonios') }}">Testimonios</a>
            <a href="{{ route('blog') }}">Blog</a>
        </div>

        <!-- Contacto -->
        <div class="footer-col">
            <h4>Contacto</h4>
            <div class="footer-info-row">
                <i class="ri-map-pin-2-line"></i>
                <span>Av. Principal #123, Centro, Morelia</span>
            </div>
            <div class="footer-info-row">
                <i class="ri-phone-line"></i>
                <span>(443) 123-4567</span>
            </div>
            <div class="footer-info-row">
                <i class="ri-mail-line"></i>
                <span>info@egauchess.mx</span>
            </div>
            <div class="footer-info-row">
                <i class="ri-time-line"></i>
                <span>Lun – Vie: 9:00 – 19:00</span>
            </div>
        </div>

        <!-- Legal -->
        <div class="footer-col">
            <h4>Legal</h4>
            <a href="#">Aviso de privacidad</a>
            <a href="#">Términos y condiciones</a>
            <a href="{{ route('login') }}">Portal de acceso</a>
        </div>

    </div>

    <div class="footer-copy">
        <span>© {{ date('Y') }} EGAU Chess · Escuela de Ajedrez · Todos los derechos reservados</span>
        <span><i class="ri-heart-line" style="color:#e05c2a;"></i> Hecho en Morelia, Michoacán</span>
    </div>
</footer>