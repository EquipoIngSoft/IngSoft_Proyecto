<footer class="footer">
    <div class="footer-grid">
        <div class="footer-col">
            <h4>EGAU Chess</h4>
            <p>Escuela de ajedrez comprometida con el desarrollo intelectual y competitivo de nuestros alumnos.</p>
        </div>
        <div class="footer-col">
            <h4>Navegación</h4>
            <a href="{{ route('cursos') }}">Cursos</a>
            <a href="{{ route('sedes') }}">Sedes</a>
            <a href="{{ route('testimonios') }}">Testimonios</a>
            <a href="{{ route('blog') }}">Blog</a>
        </div>
        <div class="footer-col">
            <h4>Contacto</h4>
            <p>📍 Av. Principal #123, Centro</p>
            <p>📞 (443) 123-4567</p>
            <p>✉️ info@egauchess.mx</p>
        </div>
        <div class="footer-col">
            <h4>Legal</h4>
            <a href="#">Aviso de privacidad</a>
            <a href="#">Términos y condiciones</a>
        </div>
    </div>
    <div class="footer-copy">
        © {{ date('Y') }} EGAU Chess · Escuela de Ajedrez · Todos los derechos reservados
    </div>
</footer>