@php
$tickerItems = [
    [
        'icon' => '🔴',
        'icon_alt' => 'En directo',
        'label' => 'LIVE:',
        'text' => '3.247.891 empresas activas',
        'class' => 'text-red-500'
    ],
    [
        'icon' => '📈',
        'icon_alt' => 'Tendencia al alza',
        'label' => 'ACTUALIZACIÓN:',
        'text' => 'Datos actualizados hoy',
        'class' => 'text-yellow-400'
    ],
    [
        'icon' => '⚡',
        'icon_alt' => 'Rayo',
        'label' => 'NUEVO:',
        'text' => 'Consulta de actos registrales',
        'class' => 'text-blue-400'
    ]
];
@endphp

<!-- Top Bar Live Ticker -->
<div class="bg-gray-900 text-white py-2 overflow-hidden" role="marquee" aria-live="polite">
    <div class="container mx-auto px-4">
        <div class="flex gap-8 md:gap-16 whitespace-nowrap overflow-hidden">
            @foreach(array_merge($tickerItems, $tickerItems) as $item)
            <div class="animate-marquee flex items-center gap-2">
                <span class="{{ $item['class'] }}" aria-hidden="true">{{ $item['icon'] }}</span>
                <span class="font-medium">{{ $item['label'] }}</span>
                <span>{{ $item['text'] }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

@push('styles')
<style>
    @keyframes marquee {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    .animate-marquee {
        display: inline-block;
        animation: marquee 30s linear infinite;
        padding-right: 32px;
    }
</style>
@endpush
