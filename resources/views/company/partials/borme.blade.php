<div style="background:white;padding:3rem;border-radius:20px;box-shadow:0 10px 40px rgba(0,0,0,0.06);margin-bottom:2rem;">
    <h2 style="font-family:'Space Grotesk';font-size:2.2rem;font-weight:800;margin-bottom:2rem;">
        Últimos Actos del BORME
    </h2>

    <div style="display:flex;flex-direction:column;gap:1.5rem;">
        @if(!empty($company->shareholders))
            @foreach($company->shareholders as $act)
                <div style="padding:1.5rem;background:var(--light);border-radius:12px;border-left:4px solid var(--primary);">
                    <p style="font-size:0.875rem;color:var(--gray);margin-bottom:0.5rem;">
                        {{ $act['date'] ?? '--' }}
                    </p>
                    <p style="font-size:1.125rem;font-weight:700;">
                        {{ $act['description'] ?? 'Acto registral' }}
                    </p>
                </div>
            @endforeach
        @else
            <p style="text-align:center;color:var(--gray);padding:1rem;">
                Sin actos BORME registrados.
            </p>
        @endif
    </div>
</div>
