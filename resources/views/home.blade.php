@extends('layouts.app')

@section('title', 'EmpreciF | Home (diagnóstico)')

@push('head')
    {{-- Metas/JSON-LD opcionales para la prueba: déjalo vacío de momento --}}
@endpush

@section('content')

<!--Hero Section-->
<section class="relative bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-16 md:py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background: url('{{ asset('images/pattern.png') }}') center;"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 font-space-grotesk">
                Consulta <span class="text-yellow-300">datos de empresas</span> españolas
            </h1>
            <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                Accede a información oficial del BORME de más de 3.2 millones de empresas en España
            </p>
            
            <!-- Search Box -->
            <div class="max-w-2xl mx-auto mb-12">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <div class="relative">
                        <input 
                            type="text" 
                            name="q"
                            placeholder="Busca por nombre, CIF o actividad..." 
                            class="w-full px-6 py-4 pr-40 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent shadow-lg"
                            autocomplete="off"
                        >
                        <button type="submit" class="absolute right-2 top-2 bg-indigo-700 hover:bg-indigo-800 text-white font-semibold py-2 px-6 rounded-full transition duration-300 transform hover:scale-105">
                            Buscar
                        </button>
                    </div>
                </form>
                <p class="text-sm text-indigo-100 mt-2">
                    Ejemplo: "Telefónica", "A12345678", "restaurante en Madrid"
                </p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @guest
                    <a href="{{ route('register') }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105 flex items-center gap-2">
                        <span>Empezar gratis</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="{{ route('pricing') }}" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-indigo-700 font-semibold py-3 px-8 rounded-full transition duration-300 flex items-center gap-2">
                        Ver planes
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105 flex items-center gap-2">
                        <span>Ir al panel de control</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endguest
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-space-grotesk">¿Qué información puedes consultar en EmpreciF?</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Accede a la base de datos más completa de información empresarial de España. Datos oficiales del BORME (Boletín Oficial del Registro Mercantil) actualizados diariamente desde 2009.
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                <div class="text-5xl mb-6 text-indigo-600">
                    🏢
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-900 font-space-grotesk">Datos Mercantiles Completos</h3>
                <p class="text-gray-600 mb-4">
                    Accede a toda la información oficial de empresas: denominación, NIF, domicilio social, fecha de constitución, capital social, objeto social, administradores, cargos y más.
                </p>
                <a href="#" class="text-indigo-600 font-medium inline-flex items-center hover:text-indigo-800 transition-colors">
                    Ver ejemplo
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            
            <!-- Feature 2 -->
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                <div class="text-5xl mb-6 text-green-600">
                    📊
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-900 font-space-grotesk">Cuentas Anuales</h3>
                <p class="text-gray-600 mb-4">
                    Consulta las cuentas anuales depositadas en el Registro Mercantil: balance, cuenta de pérdidas y ganancias, memoria, informe de gestión y dictamen de auditoría.
                </p>
                <a href="#" class="text-indigo-600 font-medium inline-flex items-center hover:text-indigo-800 transition-colors">
                    Ver ejemplo
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            
            <!-- Feature 3 -->
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                <div class="text-5xl mb-6 text-blue-600">
                    🔍
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-900 font-space-grotesk">Información de Contacto</h3>
                <p class="text-gray-600 mb-4">
                    Encuentra teléfonos, correos electrónicos y direcciones de contacto de empresas, incluyendo datos de contacto de administradores y representantes legales.
                </p>
                <a href="#" class="text-indigo-600 font-medium inline-flex items-center hover:text-indigo-800 transition-colors">
                    Ver ejemplo
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            
            <!-- Feature 4 -->
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                <div class="text-5xl mb-6 text-purple-600">
                    📈
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-900 font-space-grotesk">Informes Avanzados</h3>
                <p class="text-gray-600 mb-4">
                    Obtén informes detallados con análisis financieros, ratios, evolución histórica, comparativas del sector y evaluación de riesgos crediticios.
                </p>
                <a href="#" class="text-indigo-600 font-medium inline-flex items-center hover:text-indigo-800 transition-colors">
                    Ver ejemplo
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            
            <!-- Feature 5 -->
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                <div class="text-5xl mb-6 text-red-500">
                    🔔
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-900 font-space-grotesk">Alertas Personalizadas</h3>
                <p class="text-gray-600 mb-4">
                    Configura alertas para recibir notificaciones sobre cambios en empresas que te interesan: modificaciones de capital, cambios de administradores, concursos de acreedores, etc.
                </p>
                <a href="#" class="text-indigo-600 font-medium inline-flex items-center hover:text-indigo-800 transition-colors">
                    Configurar alertas
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
            
            <!-- Feature 6 -->
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                <div class="text-5xl mb-6 text-yellow-500">
                    🔄
                </div>
                <h3 class="text-xl font-bold mb-3 text-gray-900 font-space-grotesk">Datos en Tiempo Real</h3>
                <p class="text-gray-600 mb-4">
                    Accede a información actualizada diariamente directamente del BORME y otras fuentes oficiales. Recibe notificaciones de cambios en las empresas que sigas.
                </p>
                <a href="#" class="text-indigo-600 font-medium inline-flex items-center hover:text-indigo-800 transition-colors">
                    Ver actualizaciones
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-20 bg-gradient-to-r from-indigo-600 to-purple-700 text-white">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-8 text-center">
            <div class="p-6">
                <div class="text-4xl font-bold mb-2">3.2M+</div>
                <p class="text-indigo-100">Empresas activas</p>
            </div>
            <div class="p-6">
                <div class="text-4xl font-bold mb-2">15M+</div>
                <p class="text-indigo-100">Documentos indexados</p>
            </div>
            <div class="p-6">
                <div class="text-4xl font-bold mb-2">99.9%</div>
                <p class="text-indigo-100">Precisión en datos</p>
            </div>
            <div class="p-6">
                <div class="text-4xl font-bold mb-2">24/7</div>
                <p class="text-indigo-100">Actualización continua</p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 font-space-grotesk">¿Cómo funciona EmpreciF?</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Obtén la información que necesitas en solo 3 sencillos pasos
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <!-- Step 1 -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 text-2xl font-bold mb-4 mx-auto">1</div>
                <h3 class="text-xl font-bold mb-3 text-gray-900">Busca una empresa</h3>
                <p class="text-gray-600">
                    Introduce el nombre, CIF o actividad de la empresa que deseas consultar en nuestro buscador.
                </p>
            </div>
            
            <!-- Step 2 -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 text-2xl font-bold mb-4 mx-auto">2</div>
                <h3 class="text-xl font-bold mb-3 text-gray-900">Selecciona el informe</h3>
                <p class="text-gray-600">
                    Elige entre los diferentes tipos de informes disponibles según la información que necesites.
                </p>
            </div>
            
            <!-- Step 3 -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 text-2xl font-bold mb-4 mx-auto">3</div>
                <h3 class="text-xl font-bold mb-3 text-gray-900">Descarga o consulta</h3>
                <p class="text-gray-600">
                    Visualiza la información directamente en la plataforma o descarga el informe en PDF.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-indigo-600 to-purple-700 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 font-space-grotesk">¿Listo para empezar?</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">
            Únete a miles de profesionales que ya utilizan EmpreciF para tomar decisiones empresariales informadas.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @guest
                <a href="{{ route('register') }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                    Crear cuenta gratis
                </a>
                <a href="{{ route('pricing') }}" class="bg-transparent border-2 border-white text-white hover:bg-white hover:text-indigo-700 font-semibold py-3 px-8 rounded-full transition duration-300">
                    Ver planes y precios
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-semibold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                    Ir al panel de control
                </a>
            @endguest
        </div>
        <p class="mt-4 text-indigo-100">
            Sin compromiso. Sin tarjeta de crédito necesaria.
        </p>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Lo que dicen nuestros clientes</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Descubre la experiencia de quienes ya utilizan nuestra plataforma</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="text-yellow-400 text-xl">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"Increíble plataforma. Nos ha ayudado a verificar la solvencia de nuestros proveedores de manera rápida y confiable."</p>
                <div class="flex items-center">
                    <div class="bg-gray-200 w-10 h-10 rounded-full flex items-center justify-center text-gray-600 font-bold">JD</div>
                    <div class="ml-3">
                        <p class="font-semibold">Juan Díaz</p>
                        <p class="text-sm text-gray-500">Director Financiero, Empresa XYZ</p>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="text-yellow-400 text-xl">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"La interfaz es muy intuitiva y los informes son detallados. Una herramienta esencial para nuestro departamento de riesgos."</p>
                <div class="flex items-center">
                    <div class="bg-gray-200 w-10 h-10 rounded-full flex items-center justify-center text-gray-600 font-bold">MP</div>
                    <div class="ml-3">
                        <p class="font-semibold">María Pérez</p>
                        <p class="text-sm text-gray-500">Gerente de Riesgos, ABC Corp</p>
                    </div>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                    <div class="text-yellow-400 text-xl">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
                <p class="text-gray-600 mb-4">"Excelente servicio al cliente y actualizaciones constantes. Han mejorado significativamente nuestros procesos de debida diligencia."</p>
                <div class="flex items-center">
                    <div class="bg-gray-200 w-10 h-10 rounded-full flex items-center justify-center text-gray-600 font-bold">LG</div>
                    <div class="ml-3">
                        <p class="font-semibold">Laura Gómez</p>
                        <p class="text-sm text-gray-500">Directora de Cumplimiento, 123 S.A.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection