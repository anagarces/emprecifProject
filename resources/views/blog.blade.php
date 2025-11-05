@extends('layouts.app')

@section('title', 'Blog | Guías y Recursos sobre Información Empresarial')

@section('description', 'Artículos, guías y recursos sobre información empresarial, BORME, due diligence y análisis financiero de empresas españolas.')

@section('content')
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-4xl mx-auto mb-16">
            <h1 class="text-5xl md:text-6xl font-black font-display mb-6">
                Blog de EmpreciF
            </h1>
            <p class="text-xl md:text-2xl text-gray-600 leading-relaxed">
                Guías, recursos y análisis sobre información empresarial, BORME y due diligence en España.
            </p>
        </div>

        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Artículo 1 -->
                <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="h-64 bg-gradient-to-r from-primary-600 to-secondary-600 flex items-center justify-center">
                        <span class="text-7xl">📊</span>
                    </div>
                    <div class="p-8">
                        <div class="flex gap-4 mb-4">
                            <span class="px-4 py-2 bg-gray-100 text-primary-600 rounded-full text-sm font-bold">Guías</span>
                            <span class="text-gray-500 text-sm flex items-center">28 Oct 2025</span>
                        </div>
                        <h2 class="text-2xl font-display font-bold mb-4">
                            <a href="{{ route('blog.show', 'como-interpretar-cuentas-anuales') }}" class="text-gray-900 hover:text-primary-600 transition-colors">
                                Cómo Interpretar las Cuentas Anuales de una Empresa
                            </a>
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Guía completa para entender balances, cuentas de resultados y ratios financieros. Aprende a analizar la salud financiera de cualquier empresa española.
                        </p>
                        <a href="{{ route('blog.show', 'como-interpretar-cuentas-anuales') }}" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 transition-colors">
                            Leer Artículo →
                        </a>
                    </div>
                </article>

                <!-- Artículo 2 -->
                <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="h-64 bg-gradient-to-r from-accent-500 to-secondary-600 flex items-center justify-center">
                        <span class="text-7xl">🔍</span>
                    </div>
                    <div class="p-8">
                        <div class="flex gap-4 mb-4">
                            <span class="px-4 py-2 bg-gray-100 text-accent-600 rounded-full text-sm font-bold">Due Diligence</span>
                            <span class="text-gray-500 text-sm flex items-center">25 Oct 2025</span>
                        </div>
                        <h2 class="text-2xl font-display font-bold mb-4">
                            <a href="{{ route('blog.show', 'que-es-el-borme') }}" class="text-gray-900 hover:text-primary-600 transition-colors">
                                Qué es el BORME y Cómo Utilizarlo
                            </a>
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            El Boletín Oficial del Registro Mercantil (BORME) es la fuente oficial de información empresarial en España. Descubre cómo sacarle el máximo provecho.
                        </p>
                        <a href="{{ route('blog.show', 'que-es-el-borme') }}" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 transition-colors">
                            Leer Artículo →
                        </a>
                    </div>
                </article>

                <!-- Artículo 3 -->
                <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="h-64 bg-gradient-to-r from-secondary-600 to-primary-600 flex items-center justify-center">
                        <span class="text-7xl">💰</span>
                    </div>
                    <div class="p-8">
                        <div class="flex gap-4 mb-4">
                            <span class="px-4 py-2 bg-gray-100 text-secondary-600 rounded-full text-sm font-bold">Análisis</span>
                            <span class="text-gray-500 text-sm flex items-center">22 Oct 2025</span>
                        </div>
                        <h2 class="text-2xl font-display font-bold mb-4">
                            <a href="{{ route('blog.show', 'ratios-financieros-clave') }}" class="text-gray-900 hover:text-primary-600 transition-colors">
                                Ratios Financieros Clave para Evaluar Empresas
                            </a>
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Ratio de liquidez, solvencia, rentabilidad y endeudamiento. Aprende a calcularlos e interpretarlos para tomar decisiones de inversión informadas.
                        </p>
                        <a href="{{ route('blog.show', 'ratios-financieros-clave') }}" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 transition-colors">
                            Leer Artículo →
                        </a>
                    </div>
                </article>

                <!-- Artículo 4 -->
                <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="h-64 bg-gradient-to-r from-primary-600 to-accent-500 flex items-center justify-center">
                        <span class="text-7xl">⚖️</span>
                    </div>
                    <div class="p-8">
                        <div class="flex gap-4 mb-4">
                            <span class="px-4 py-2 bg-gray-100 text-primary-600 rounded-full text-sm font-bold">Legal</span>
                            <span class="text-gray-500 text-sm flex items-center">20 Oct 2025</span>
                        </div>
                        <h2 class="text-2xl font-display font-bold mb-4">
                            <a href="{{ route('blog.show', 'due-diligence-checklist') }}" class="text-gray-900 hover:text-primary-600 transition-colors">
                                Due Diligence: Checklist Completa para Inversores
                            </a>
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Checklist paso a paso para realizar una due diligence completa antes de invertir o adquirir una empresa. Evita sorpresas desagradables.
                        </p>
                        <a href="{{ route('blog.show', 'due-diligence-checklist') }}" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 transition-colors">
                            Leer Artículo →
                        </a>
                    </div>
                </article>
            </div>

            <!-- Paginación -->
            <div class="mt-16 flex justify-center">
                <nav class="flex items-center gap-2">
                    <a href="#" class="px-4 py-2 border rounded-lg border-gray-200 text-gray-500 hover:bg-gray-50">
                        &larr; Anterior
                    </a>
                    <a href="#" class="px-4 py-2 border rounded-lg border-primary-600 bg-primary-600 text-white font-medium">
                        1
                    </a>
                    <a href="#" class="px-4 py-2 border rounded-lg border-gray-200 text-gray-700 hover:bg-gray-50">
                        2
                    </a>
                    <a href="#" class="px-4 py-2 border rounded-lg border-gray-200 text-gray-700 hover:bg-gray-50">
                        3
                    </a>
                    <span class="px-2 text-gray-500">...</span>
                    <a href="#" class="px-4 py-2 border rounded-lg border-gray-200 text-gray-700 hover:bg-gray-50">
                        10
                    </a>
                    <a href="#" class="px-4 py-2 border rounded-lg border-gray-200 text-gray-700 hover:bg-gray-50">
                        Siguiente &rarr;
                    </a>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center bg-white p-8 md:p-12 rounded-2xl shadow-lg">
            <h2 class="text-3xl md:text-4xl font-display font-bold mb-4">Suscríbete a Nuestro Boletín</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                Recibe las últimas noticias, artículos y recursos sobre información empresarial directamente en tu bandeja de entrada.
            </p>
            <form class="max-w-md mx-auto flex flex-col sm:flex-row gap-4">
                <input type="email" placeholder="Tu correo electrónico" class="flex-1 px-6 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition-colors">
                    Suscribirse
                </button>
            </form>
            <p class="text-sm text-gray-500 mt-4">
                Respetamos tu privacidad. Nunca compartiremos tu información.
            </p>
        </div>
    </div>
</section>
@endsection
