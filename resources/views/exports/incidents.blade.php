@php
    $incidents = collect($incidents);
@endphp
<table>
    <tr>
        <td colspan="2" rowspan="4" style="border: 2px solid #000; text-align: center; vertical-align: middle;">
            @if(isset($is_pdf) && $is_pdf)
                <img src="{{ public_path('images/logoPivot.png') }}" style="width: 100px;">
            @else
                <!-- Le logo Excel est géré par WithDrawings -->
            @endif
        </td>
        <th colspan="4" style="text-align: center; font-size: 16px; font-weight: bold; border: 2px solid #000; height: 40px;">
            LISTE DES INCIDENTS
        </th>
    </tr>
    <tr>
        <th colspan="2" style="border: 1px solid #000; font-weight: bold;">Service demandeur :</th>
        <th colspan="2" style="border: 1px solid #000; font-weight: bold;">Service Maintenance :</th>
    </tr>
    <tr>
        <td colspan="2" style="border: 1px solid #000;">DSI / Support IT</td>
        <td colspan="2" style="border: 1px solid #000;">Réf : INC-{{ now()->format('Ymd') }}</td>
    </tr>
    <tr>
        <td colspan="2" style="border: 1px solid #000;">Demandeur : {{ auth()->user()->name ?? 'Administrateur' }}</td>
        <td colspan="2" style="border: 1px solid #000;">Date d'export : {{ now()->format('d/m/Y') }}</td>
    </tr>
    <tr>
        <td colspan="6" style="border: 1px solid #000;">
            <strong>Lieu de bénéficiaire :</strong> Siège Principal | 
            <strong>Période :</strong> Du {{ now()->startOfMonth()->format('d/m/Y') }} au {{ now()->format('d/m/Y') }}
        </td>
    </tr>
    
    <tr>
        <th style="border: 1px solid #000; font-weight: bold;">N°</th>
        <th style="border: 1px solid #000; font-weight: bold;">ID</th>
        <th style="border: 1px solid #000; font-weight: bold;">Utilisateur</th>
        <th style="border: 1px solid #000; font-weight: bold;">Type Matériel</th>
        <th style="border: 1px solid #000; font-weight: bold;">Statut</th>
        <th style="border: 1px solid #000; font-weight: bold;">Date Création</th>
    </tr>
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
</table>
