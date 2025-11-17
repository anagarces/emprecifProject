<div style="position:relative;background:white;padding:3rem;border-radius:20px;box-shadow:0 10px 40px rgba(0,0,0,0.06);margin-bottom:3rem;">
    <h2 style="font-family:'Space Grotesk';font-size:2.2rem;font-weight:800;margin-bottom:2rem;">
        Cuentas Anuales y Datos Financieros
    </h2>

    {{-- Contenido difuminado --}}
    <div style="filter:blur(5px);opacity:0.3;pointer-events:none;">
        <p>Contenido Premium bloqueado.</p>
        <p>Se mostrarán cuando contrates un plan Premium.</p>
    </div>

    {{-- Overlay --}}
    <div style="
        position:absolute;
        top:50%;left:50%;
        transform:translate(-50%, -50%);
        background:white;
        padding:3rem;
        border-radius:15px;
        box-shadow:0 20px 60px rgba(0,0,0,0.2);
        max-width:450px;
        text-align:center;
        border:3px solid var(--primary);
    ">
        <div style="font-size:3rem;margin-bottom:1rem;">🔒</div>
        <h3 style="font-size:2rem;font-weight:900;margin-bottom:1rem;">Contenido Premium</h3>
        <p style="font-size:1.125rem;color:var(--gray);margin-bottom:2rem;">
            Accede a cuentas anuales, balances financieros y ratios de solvencia.
        </p>

        <a href="{{ route('subscription.plans') }}"
           style="display:inline-block;padding:1rem 2rem;background:var(--primary);
           color:white;border-radius:12px;font-weight:700;text-decoration:none;">
            🚀 Actualiza a Premium
        </a>
    </div>
</div>
