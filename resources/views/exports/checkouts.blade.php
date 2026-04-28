@php
    $checkouts = collect($checkouts);
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
        <th colspan="6" style="text-align: center; font-size: 16px; font-weight: bold; border: 2px solid #000; height: 40px;">
            LISTE DES CHECKOUTS
        </th>
    </tr>
    <tr>
        <th colspan="3" style="border: 1px solid #000; font-weight: bold;">Service demandeur :</th>
        <th colspan="3" style="border: 1px solid #000; font-weight: bold;">Service Maintenance :</th>
    </tr>
    <tr>
        <td colspan="3" style="border: 1px solid #000;">DSI / Support IT</td>
        <td colspan="3" style="border: 1px solid #000;">Réf : CHK-{{ now()->format('Ymd') }}</td>
    </tr>
    <tr>
        <td colspan="3" style="border: 1px solid #000;">Demandeur : {{ auth()->user()->name ?? 'Administrateur' }}</td>
        <td colspan="3" style="border: 1px solid #000;">Date d'export : {{ now()->format('d/m/Y') }}</td>
    </tr>
    <tr>
        <td colspan="8" style="border: 1px solid #000;">
            <strong>Lieu de bénéficiaire :</strong> Siège Principal | 
            <strong>Période :</strong> Du {{ now()->startOfMonth()->format('d/m/Y') }} au {{ now()->format('d/m/Y') }}
        </td>
    </tr>
    <tr><th colspan="8"></th></tr>
    <tr>
        <th style="border: 1px solid #000; font-weight: bold;">N°</th>
        <th style="border: 1px solid #000; font-weight: bold;">Utilisateur</th>
        <th style="border: 1px solid #000; font-weight: bold;">Type Matériel</th>
        <th style="border: 1px solid #000; font-weight: bold;">Détails</th>
        <th style="border: 1px solid #000; font-weight: bold;">Statut</th>
        <th style="border: 1px solid #000; font-weight: bold;">Début</th>
        <th style="border: 1px solid #000; font-weight: bold;">Fin</th>
        <th style="border: 1px solid #000; font-weight: bold;">Créé le</th>
    </tr>
    @foreach($checkouts as $index => $checkout)
    <tr>
        <td style="border: 1px solid #000; text-align: center;">{{ $index + 1 }}</td>
        <td style="border: 1px solid #000;">{{ $checkout->utilisateur->nom ?? 'N/A' }}</td>
        <td style="border: 1px solid #000;">{{ $checkout->materiel_type }}</td>
        <td style="border: 1px solid #000;">{{ $checkout->materiel_details }}</td>
        <td style="border: 1px solid #000;">
            @php
                $statut = match($checkout->statut) {
                    'en_cours' => 'En cours',
                    'termine' => 'Terminé',
                    'annule' => 'Annulé',
                    'en_retard' => 'En retard',
                    default => $checkout->statut
                };
            @endphp
            {{ $statut }}
        </td>
        <td style="border: 1px solid #000;">{{ $checkout->date_debut?->format('d/m/Y') ?? 'N/A' }}</td>
        <td style="border: 1px solid #000;">{{ $checkout->date_fin?->format('d/m/Y') ?? 'N/A' }}</td>
        <td style="border: 1px solid #000;">{{ $checkout->created_at->format('d/m/Y H:i') }}</td>
    </tr>
    @endforeach
</table>
