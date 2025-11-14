<div style="background:white;padding:3rem;border-radius:20px;box-shadow:0 10px 40px rgba(0,0,0,0.06);margin-bottom:3rem;">
    <h2 style="font-family:'Space Grotesk';font-size:2.2rem;font-weight:800;margin-bottom:2rem;">
        Administradores Actuales
    </h2>

    <table style="width:100%;border-collapse:collapse;">
        <thead style="background:var(--light);">
            <tr>
                <th class="table-header">Nombre</th>
                <th class="table-header">Cargo</th>
                <th class="table-header">Fecha</th>
            </tr>
        </thead>

        <tbody>
            @if(!empty($company->directors))
                @foreach($company->directors as $director)
                <tr class="table-row">
                    <td class="table-cell">{{ $director['name'] }}</td>
                    <td class="table-cell">{{ $director['role'] }}</td>
                    <td class="table-cell">{{ $director['date'] }}</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" style="padding:1rem;text-align:center;color:var(--gray);">
                        No hay administradores públicos registrados.
                    </td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
