<footer>
    <div class="footer-content">
        <div class="footer-brand">
            <img src="{{ asset('images/logo_emprecif_wordmark.png') }}" alt="EmpreciF" style="height: 40px; margin-bottom: 1rem;">
            <p>
                La plataforma líder en información empresarial de España.
            </p>
            <div class="social-links">
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>

        <div class="footer-section">
            <h4>Empresa</h4>
            <ul class="footer-links">
                <li><a href="{{ route('about') }}">Sobre Nosotros</a></li>
                <li><a href="{{ route('about') }}#equipo">Nuestro Equipo</a></li>
                <li><a href="{{ route('about') }}#trabaja-con-nosotros">Trabaja con Nosotros</a></li>
                <li><a href="{{ route('blog.index') }}">Blog</a></li>
                <li><a href="{{ route('contact') }}">Contacto</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Producto</h4>
            <ul class="footer-links">
                <li><a href="{{ route('pricing') }}">Precios</a></li>
                <li><a href="{{ route('home') }}#features">Características</a></li>
                <li><a href="#" class="coming-soon">API para Desarrolladores <span>Próximamente</span></a></li>
                <li><a href="#" class="coming-soon">Integraciones <span>Próximamente</span></a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Recursos</h4>
            <ul class="footer-links">
                <li><a href="{{ route('contact') }}">Centro de Ayuda</a></li>
                <li><a href="#" class="coming-soon">Tutoriales <span>Próximamente</span></a></li>
                <li><a href="#" class="coming-soon">Webinars <span>Próximamente</span></a></li>
                <li><a href="{{ route('contact') }}">Preguntas Frecuentes</a></li>
                <li><a href="{{ route('contact') }}">Soporte Técnico</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Legal</h4>
            <ul class="footer-links">
                <li><a href="{{ route('legal.terms') }}">Términos y Condiciones</a></li>
                <li><a href="{{ route('legal.privacy') }}">Política de Privacidad</a></li>
                <li><a href="{{ route('legal.cookies') }}">Política de Cookies</a></li>
                <li><a href="{{ route('legal.notice') }}">Aviso Legal</a></li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <div>
            &copy; {{ date('Y') }} EmpreciF - Todos los derechos reservados.
        </div>
        <div>
            Datos oficiales del BORME • Actualizado diariamente • Registro Mercantil de Alicante
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="backToTop" class="back-to-top" aria-label="Volver arriba">
    <i class="fas fa-arrow-up"></i>
</button>
