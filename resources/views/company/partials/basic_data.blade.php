<div style="background:white;padding:3rem;border-radius:20px;box-shadow:0 10px 40px rgba(0,0,0,0.06);margin-bottom:3rem;">
    <h2 style="font-family:'Space Grotesk';font-size:2.2rem;font-weight:800;margin-bottom:2rem;">
        Datos Mercantiles
    </h2>

    <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:2rem;">
        <div>
            <p class="label">Razón Social</p>
            <p class="value">{{ $company->legal_name ?? $company->name }}</p>
        </div>

        <div>
            <p class="label">NIF</p>
            <p class="value">{{ $company->cif }}</p>
        </div>

        <div>
            <p class="label">Domicilio Social</p>
            <p class="value">{{ $company->address }}, {{ $company->postal_code }} {{ $company->city }}</p>
        </div>

        <div>
            <p class="label">Provincia</p>
            <p class="value">{{ $company->province }}</p>
        </div>

        <div>
            <p class="label">Sector</p>
            <p class="value">{{ $company->sector }}</p>
        </div>

        <div>
            <p class="label">Fecha de Fundación</p>
            <p class="value">{{ $company->founded_at ? $company->founded_at->format('d/m/Y') : 'N/A' }}</p>
        </div>
    </div>
</div>
