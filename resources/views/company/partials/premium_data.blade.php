<div style="background:white;padding:3rem;border-radius:20px;box-shadow:0 10px 40px rgba(0,0,0,0.06);margin-bottom:3rem;">
    <h2 style="font-family:'Space Grotesk';font-size:2.2rem;font-weight:800;margin-bottom:2rem;">
        Cuentas Anuales y Datos Financieros
    </h2>

    @if(!empty($company->financials))
    <table style="width:100%;border-collapse:collapse;">
        <thead style="background:var(--light);">
            <tr>
                <th class="table-header">Ejercicio</th>
                <th class="table-header" style="text-align:right;">Facturación</th>
                <th class="table-header" style="text-align:right;">Resultado Neto</th>
                <th class="table-header" style="text-align:right;">Empleados</th>
            </tr>
        </thead>

        <tbody>
            @foreach($company->financials as $year => $data)
            <tr class="table-row">
                <td class="table-cell">{{ $year }}</td>
                <td class="table-cell" style="text-align:right;">{{ number_format($data['revenue'], 0, ',', '.') }} €</td>
                <td class="table-cell" style="text-align:right;">{{ number_format($data['profit'], 0, ',', '.') }} €</td>
                <td class="table-cell" style="text-align:right;">{{ $data['employees'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p style="color:var(--gray);">No hay datos financieros disponibles.</p>
    @endif
</div>
