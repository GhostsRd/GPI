@php
    $activities = collect($activities);
@endphp
<table>
    <tr>
        <td style="border: 2px solid #000; text-align: center; vertical-align: middle;">
            @if(isset($is_pdf) && $is_pdf)
                <img src="{{ public_path('images/logoPivot.png') }}" style="width: 100px;">
            @else
                <!-- Le logo Excel est géré par WithDrawings -->
            @endif
        </td>
        <th colspan="5" style="text-align: center; font-size: 16px; font-weight: bold; border: 2px solid #000; height: 40px;">
            JOURNAL DES ACTIVITÉS
        </th>
    </tr>
    <tr>
        <th colspan="3" style="border: 1px solid #000; font-weight: bold;">Service demandeur :</th>
        <th colspan="3" style="border: 1px solid #000; font-weight: bold;">Service Maintenance :</th>
    </tr>
    <tr>
        <td colspan="3" style="border: 1px solid #000;">GPI / Support IT</td>
        <td colspan="3" style="border: 1px solid #000;">Réf : ACT-{{ now()->format('Ymd') }}</td>
    </tr>
    <tr>
        <td colspan="3" style="border: 1px solid #000;">Demandeur : {{ auth()->user()->name ?? 'Administrateur' }}</td>
        <td colspan="3" style="border: 1px solid #000;">Date d'export : {{ now()->format('d/m/Y') }}</td>
    </tr>
    <tr>
        <td colspan="6" style="border: 1px solid #000;">
            <strong>Lieu de bénéficiaire :</strong> Siège Principal | 
            <strong>Période :</strong> Du {{ now()->startOfMonth()->format('d/m/Y') }} au {{ now()->format('d/m/Y') }}
        </td>
    </tr>
    <tr><th colspan="6"></th></tr>
    <tr>
        <th style="border: 1px solid #000; font-weight: bold;">N°</th>
        <th style="border: 1px solid #000; font-weight: bold;">Date & Heure</th>
        <th style="border: 1px solid #000; font-weight: bold;">Type</th>
        <th style="border: 1px solid #000; font-weight: bold;">Description</th>
        <th style="border: 1px solid #000; font-weight: bold;">Utilisateur</th>
        <th style="border: 1px solid #000; font-weight: bold;">Assigné à</th>
    </tr>
    @foreach($activities as $index => $activity)
    <tr>
        <td style="border: 1px solid #000; text-align: center;">{{ $index + 1 }}</td>
        <td style="border: 1px solid #000;">{{ is_object($activity['date']) ? $activity['date']->format('d/m/Y H:i') : $activity['date'] }}</td>
        <td style="border: 1px solid #000;">{{ $activity['type'] }}</td>
        <td style="border: 1px solid #000;">{{ $activity['title'] }}</td>
        <td style="border: 1px solid #000;">{{ $activity['user'] }}</td>
        <td style="border: 1px solid #000;">{{ $activity['assigned_to'] }}</td>
    </tr>
    @endforeach
</table>
