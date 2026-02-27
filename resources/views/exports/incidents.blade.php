<table>
    <thead>
        <tr>
            <th colspan="6" style="text-align: center; font-size: 16px; font-weight: bold; border: 2px solid #000;">
                LISTE DES INCIDENTS
            </th>
        </tr>
        <tr>
            <th colspan="2" style="border: 1px solid #000; font-weight: bold;">Service demandeur :</th>
            <th colspan="2" style="border: 1px solid #000; font-weight: bold;">Lieu de bénéficiaire :</th>
            <th colspan="2" style="border: 1px solid #000; font-weight: bold;">Service Maintenance :</th>
        </tr>
        <tr>
            <td colspan="2" style="border: 1px solid #000;">DSI / Support IT</td>
            <td colspan="2" style="border: 1px solid #000;">Siège Principal</td>
            <td colspan="2" style="border: 1px solid #000;">Réf : INC-{{ now()->format('Ymd') }}</td>
        </tr>
        <tr>
            <td colspan="2" style="border: 1px solid #000;">Demandeur : {{ auth()->user()->name ?? 'Administrateur' }}</td>
            <td colspan="2" style="border: 1px solid #000;">Période : {{ now()->format('d/m/Y') }}</td>
            <td colspan="2" style="border: 1px solid #000;">Date : {{ now()->format('d/m/Y') }}</td>
        </tr>
        <tr><th></th></tr> <!-- Spacer -->
        <tr style="background-color: #e9ecef;">
            <th style="border: 1px solid #000; font-weight: bold; width: 50px;">N°</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 100px;">ID</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 200px;">Utilisateur</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 150px;">Type Matériel</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 150px;">Statut</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 150px;">Date Création</th>
        </tr>
    </thead>
    <tbody>
        @foreach($incidents as $index => $incident)
        <tr>
            <td style="border: 1px solid #000; text-align: center;">{{ $index + 1 }}</td>
            <td style="border: 1px solid #000; text-align: center;">#{{ $incident->id }}</td>
            <td style="border: 1px solid #000;">{{ $incident->utilisateur->nom ?? 'N/A' }}</td>
            <td style="border: 1px solid #000;">{{ $incident->equipement_type }}</td>
            <td style="border: 1px solid #000;">
                @if($incident->statut == 1) En cours
                @elseif($incident->statut == 2) En traitement
                @elseif($incident->statut == 0) Demande annulation
                @else {{ $incident->statut }}
                @endif
            </td>
            <td style="border: 1px solid #000;">{{ $incident->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
