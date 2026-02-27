<table>
    <thead>
        <tr>
            <th colspan="8" style="text-align: center; font-size: 16px; font-weight: bold; border: 2px solid #000;">
                JOURNAL DES ACTIVITÉS
            </th>
        </tr>
        <tr>
            <th colspan="3" style="border: 1px solid #000; font-weight: bold;">Service demandeur :</th>
            <th colspan="2" style="border: 1px solid #000; font-weight: bold;">Lieu de bénéficiaire :</th>
            <th colspan="3" style="border: 1px solid #000; font-weight: bold;">Service Maintenance :</th>
        </tr>
        <tr>
            <td colspan="3" style="border: 1px solid #000;">DSI / Support IT</td>
            <td colspan="2" style="border: 1px solid #000;">Siège Principal</td>
            <td colspan="3" style="border: 1px solid #000;">Réf : ACT-{{ now()->format('Ymd') }}</td>
        </tr>
        <tr>
            <td colspan="3" style="border: 1px solid #000;">Demandeur : Administrateur</td>
            <td colspan="2" style="border: 1px solid #000;">Période : {{ now()->format('d/m/Y') }}</td>
            <td colspan="3" style="border: 1px solid #000;">Date : {{ now()->format('d/m/Y') }}</td>
        </tr>
        <tr><th></th></tr> <!-- Spacer -->
        <tr style="background-color: #e9ecef;">
            <th style="border: 1px solid #000; font-weight: bold; width: 50px;">N°</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 150px;">Date & Heure</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 100px;">Type</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 300px;">Description</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 150px;">Utilisateur</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 100px;">Assigné à</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 100px;">Statut</th>
            <th style="border: 1px solid #000; font-weight: bold; width: 100px;">Priorité</th>
        </tr>
    </thead>
    <tbody>
        @foreach($activities as $index => $activity)
        <tr>
            <td style="border: 1px solid #000; text-align: center;">{{ $index + 1 }}</td>
            <td style="border: 1px solid #000;">{{ $activity['date']->format('d/m/Y H:i') }}</td>
            <td style="border: 1px solid #000;">{{ $activity['type'] }}</td>
            <td style="border: 1px solid #000;">{{ $activity['title'] }}</td>
            <td style="border: 1px solid #000;">{{ $activity['user'] }}</td>
            <td style="border: 1px solid #000;">{{ $activity['assigned_to'] }}</td>
            <td style="border: 1px solid #000;">{{ $activity['status'] }}</td>
            <td style="border: 1px solid #000;">{{ $activity['priority'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
