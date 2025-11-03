@extends('subscription.layout')

@section('title', 'Planes de Suscripción')

@push('styles')
<style>
    .pricing-card {
        transition: all 0.3s ease;
    }
    .pricing-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .feature-list {
        min-height: 200px;
    }
</style>
@endpush

@section('content')
<div class="text-center mb-12">
    <h1 class="text-4xl font-bold text-gray-900 mb-4">Elige el mejor plan para ti</h1>
    <p class="text-xl text-gray-600">Precios simples y transparentes que escalan con tu negocio.</p>
</div>

<div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
    @foreach($plans as $priceId => $plan)
    <div class="pricing-card bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
        <div class="px-6 py-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $plan['name'] }}</h2>
            <div class="flex items-baseline mb-6">
                <span class="text-4xl font-extrabold text-gray-900">€{{ number_format($plan['price'], 2) }}</span>
                <span class="ml-1 text-gray-600">/mes</span>
            </div>
            
            <ul class="feature-list mb-8 space-y-3">
                @foreach($plan['features'] as $feature)
                <li class="flex items-center">
                    <svg class="h-5 w-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ $feature }}
                </li>
                @endforeach
            </ul>

            @auth
                @if($onTrial)
                    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-md text-sm">
                        <p class="font-medium">¡Período de prueba activo!</p>
                        <p>Tu prueba gratuita finaliza el {{ $trialEndsAt->format('d/m/Y') }}</p>
                    </div>
                @endif

                @if(auth()->user()->subscribed('default') && auth()->user()->subscribedToPrice($priceId, 'default'))
                    <button class="w-full bg-gray-100 text-gray-700 font-medium py-3 px-6 rounded-md cursor-not-allowed" disabled>
                        Plan Actual
                    </button>
                @else
                    @if(!$onTrial && !auth()->user()->hasPaymentMethod())
                        <!-- Botón para iniciar prueba gratuita sin tarjeta -->
                        <button 
                            onclick="startFreeTrial('{{ $priceId }}')"
                            class="w-full mb-2 bg-green-600 text-white font-medium py-3 px-6 rounded-md hover:bg-green-700 transition-colors"
                        >
                            Probar Gratis por 15 días
                        </button>
                    @endif
                    
                    <button 
                        id="checkout-button-{{ $priceId }}"
                        data-secret="{{ auth()->user()->createSetupIntent()->client_secret }}"
                        data-price="{{ $priceId }}"
                        class="w-full bg-indigo-600 text-white font-medium py-3 px-6 rounded-md hover:bg-indigo-700 transition-colors"
                    >
                        {{ auth()->user()->subscribed('default') ? 'Cambiar Plan' : 'Seleccionar Plan' }}
                    </button>
                @endif
            @else
                <a href="{{ route('login') }}" class="block w-full bg-indigo-600 text-white text-center font-medium py-3 px-6 rounded-md hover:bg-indigo-700 transition-colors mb-2">
                    Iniciar Sesión para Suscribirse
                </a>
                <a href="{{ route('register') }}" class="block w-full bg-green-600 text-white text-center font-medium py-3 px-6 rounded-md hover:bg-green-700 transition-colors">
                    Probar Gratis por 15 días
                </a>
            @endauth
        </div>
    </div>
    @endforeach
</div>

@auth
@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Función para iniciar el período de prueba
    async function startTrial(planId) {
        if(confirm('¿Estás seguro de que deseas comenzar tu período de prueba de 15 días?\n\nNo se requiere tarjeta de crédito y podrás cancelar en cualquier momento.')) {
            // Mostrar indicador de carga
            const button = document.getElementById('trialButton' + planId);
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Procesando...';
            
            // Enviar solicitud al servidor
            fetch('{{ route("subscription.subscribe") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    plan: planId,
                    trial: true,
                    _token: '{{ csrf_token() }}'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mostrar mensaje de éxito y recargar la página
                    window.location.href = data.redirect || '{{ route("dashboard") }}';
                } else {
                    // Mostrar error
                    alert(data.error || 'Ocurrió un error al iniciar el período de prueba');
                    button.disabled = false;
                    button.innerHTML = originalText;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al procesar tu solicitud');
                button.disabled = false;
                button.innerHTML = originalText;
            });
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const stripe = Stripe('{{ config('cashier.key') }}');
        
        // Manejar clic en los botones de suscripción
        document.querySelectorAll('[id^=checkout-button-]').forEach(button => {
            button.addEventListener('click', async function() {
                const priceId = this.getAttribute('data-price');
                const clientSecret = this.getAttribute('data-secret');
                
                // Deshabilitar el botón para evitar múltiples clics
                this.disabled = true;
                this.textContent = 'Procesando...';
                
                try {
                    const { error } = await stripe.confirmCardPayment(clientSecret, {
                        payment_method: {
                            card: await stripe.createToken('card'),
                            billing_details: {
                                name: '{{ auth()->user()->name }}',
                                email: '{{ auth()->user()->email }}',
                            },
                        },
                    });
                    
                    if (error) {
                        console.error('Error:', error);
                        alert('Hubo un error al procesar el pago: ' + error.message);
                        this.disabled = false;
                        this.textContent = '{{ auth()->user()->subscribed('default') ? 'Cambiar Plan' : 'Seleccionar Plan' }}';
                    } else {
                        // Enviar el formulario para crear la suscripción
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = '{{ route('subscription.subscribe') }}';
                        form.innerHTML = `
                            @csrf
                            <input type="hidden" name="payment_method" value="pm_card_visa">
                            <input type="hidden" name="plan" value="${priceId}">
                        `;
                        document.body.appendChild(form);
                        form.submit();
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Hubo un error inesperado. Por favor, inténtalo de nuevo.');
                    this.disabled = false;
                    this.textContent = '{{ auth()->user()->subscribed('default') ? 'Cambiar Plan' : 'Seleccionar Plan' }}';
                }
            });
        });
    });
</script>
@endpush
@endauth
@endsection
