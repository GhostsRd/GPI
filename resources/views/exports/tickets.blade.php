@php
    $tickets = collect($tickets);
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
            JOURNAL DES TICKETS
        </th>
    </tr>
    <tr>
        <th colspan="3" style="border: 1px solid #000; font-weight: bold;">Service demandeur :</th>
        <th colspan="3" style="border: 1px solid #000; font-weight: bold;">Service Maintenance :</th>
    </tr>
    <tr>
        <td colspan="3" style="border: 1px solid #000;">DSI / Support IT</td>
        <td colspan="3" style="border: 1px solid #000;">Réf : TKT-{{ now()->format('Ymd') }}</td>
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
        <th style="border: 1px solid #000; font-weight: bold;">ID</th>
        <th style="border: 1px solid #000; font-weight: bold;">Sujet</th>
        <th style="border: 1px solid #000; font-weight: bold;">Utilisateur</th>
        <th style="border: 1px solid #000; font-weight: bold;">Responsable</th>
        <th style="border: 1px solid #000; font-weight: bold;">Catégorie</th>
        <th style="border: 1px solid #000; font-weight: bold;">Priorité</th>
        <th style="border: 1px solid #000; font-weight: bold;">Statut</th>
        <th style="border: 1px solid #000; font-weight: bold;">Créé le</th>
    </tr>
    @foreach($tickets as $ticket)
    <tr>
        <td style="border: 1px solid #000; text-align: center;">#{{ $ticket->id }}</td>
        <td style="border: 1px solid #000;">{{ $ticket->sujet ?? 'N/A' }}</td>
        <td style="border: 1px solid #000;">{{ $ticket->utilisateur->nom ?? 'N/A' }}</td>
        <td style="border: 1px solid #000;">{{ $ticket->responsable->name ?? '---' }}</td>
        <td style="border: 1px solid #000;">{{ $ticket->categorie }}</td>
        <td style="border: 1px solid #000;">{{ ucfirst($ticket->priorite ?? 'normale') }}</td>
        <td style="border: 1px solid #000;">{{ $ticket->status ?? 'Nouveau' }}</td>
        <td style="border: 1px solid #000;">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
    </tr>
    @endforeach
</table>
