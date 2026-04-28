<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PV d'Attribution - Carte SIM</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body { 
            font-family: 'Helvetica Neue', 'Helvetica', Arial, sans-serif; 
            color: #1e293b; 
            line-height: 1.5; 
            font-size: 13px;
            background: #fff;
        }

        /* ===== HEADER WITH LOGO ===== */
        .header {
            text-align: center;
            padding: 25px 0 20px;
            border-bottom: 3px solid #5BC4BF;
            margin-bottom: 25px;
            position: relative;
        }
        .header::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 80px;
            height: 3px;
            background: #f97316;
        }
        .header-logo {
            width: 80px;
            height: auto;
            margin-bottom: 8px;
        }
        .header-company {
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #94a3b8;
            margin-bottom: 12px;
        }
        .header-title {
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            color: #0f172a;
            letter-spacing: 1px;
        }
        .header-subtitle {
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
        }
        .header-ref {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 8px;
        }

        /* ===== SECTIONS ===== */
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #5BC4BF;
            padding: 6px 12px;
            border-left: 4px solid #5BC4BF;
            background: #f0fdfa;
            margin-bottom: 12px;
        }

        /* ===== DATA TABLE ===== */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        .data-table td {
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            font-size: 12px;
        }
        .data-table .label {
            font-weight: bold;
            width: 35%;
            background: #f8fafc;
            color: #475569;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .data-table .value {
            color: #1e293b;
            font-weight: 500;
        }

        /* ===== ENGAGEMENT TEXT ===== */
        .engagement {
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 15px 18px;
            background: #fefce8;
            font-size: 11px;
            color: #713f12;
            line-height: 1.6;
        }
        .engagement strong {
            color: #92400e;
        }

        /* ===== SIGNATURES ===== */
        .signatures-table {
            width: 100%;
            margin-top: 35px;
        }
        .sig-box {
            width: 45%;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            height: 100px;
            padding: 10px 15px;
            text-align: center;
            vertical-align: top;
        }
        .sig-box .sig-label {
            font-size: 11px;
            font-weight: bold;
            color: #5BC4BF;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .sig-name {
            font-size: 10px;
            color: #94a3b8;
            font-style: italic;
        }
        .sig-mention {
            font-size: 9px;
            color: #94a3b8;
            margin-top: 5px;
        }

        /* ===== FOOTER ===== */
        .footer {
            margin-top: 30px;
            text-align: center;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
        }
        .footer-text {
            font-size: 10px;
            color: #94a3b8;
        }
        .footer-brand {
            font-size: 10px;
            color: #5BC4BF;
            font-weight: bold;
            margin-top: 3px;
        }

        /* ===== BADGE ===== */
        .badge {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-teal { background: #ccfbf1; color: #0d9488; }
        .badge-orange { background: #ffedd5; color: #c2410c; }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <img src="{{ public_path('images/logoPivot.png') }}" class="header-logo" alt="Pivot">
        <div class="header-company">Gestion de Parc Informatique</div>
        <div class="header-title">Procès-Verbal d'Attribution</div>
        <div class="header-subtitle">Carte SIM & Ligne Téléphonique</div>
        <div class="header-ref">Réf : PV-SIM-{{ str_pad($sim->id, 5, '0', STR_PAD_LEFT) }} — {{ now()->format('d/m/Y') }}</div>
    </div>

    <!-- SECTION 1: ATTRIBUTAIRE -->
    <div class="section">
        <div class="section-title">Informations de l'Attributaire</div>
        <table class="data-table">
            <tr>
                <td class="label">Nom complet</td>
                <td class="value">{{ $user->name }}</td>
            </tr>
            <tr>
                <td class="label">Poste / Service</td>
                <td class="value">{{ $user->poste ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td class="value">{{ $user->email }}</td>
            </tr>
        </table>
    </div>

    <!-- SECTION 2: CARTE SIM -->
    <div class="section">
        <div class="section-title">Détails de la Carte SIM</div>
        <table class="data-table">
            <tr>
                <td class="label">Numéro de téléphone</td>
                <td class="value" style="font-size: 14px; font-weight: bold; color: #5BC4BF;">{{ $sim->phone_number }}</td>
            </tr>
            <tr>
                <td class="label"> MSISDN</td>
                <td class="value" style="font-family: monospace; font-size: 11px;">{{ $sim->iccid }}</td>
            </tr>
            <tr>
                <td class="label">Opérateur</td>
                <td class="value">
                    <span class="badge {{ strtolower($sim->operator) == 'orange' ? 'badge-orange' : 'badge-teal' }}">
                        {{ $sim->operator }}
                    </span>
                </td>
            </tr>
            <tr>
                <td class="label">Date d'activation</td>
                <td class="value">{{ $sim->activation_date ? $sim->activation_date->format('d/m/Y') : 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <!-- SECTION 3: MATERIEL -->
    <div class="section">
        <div class="section-title">Matériel Associé</div>
        <table class="data-table">
            <tr>
                <td class="label">Modèle Téléphone</td>
                <td class="value">{{ $sim->device_model ?: 'Non renseigné' }}</td>
            </tr>
            <tr>
                <td class="label">IMEI</td>
                <td class="value" style="font-family: monospace; font-size: 11px;">{{ $sim->imei ?: 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <!-- ENGAGEMENT -->
    <div class="section">
        <div class="section-title">Engagement</div>
        <div class="engagement">
            <strong>Clause d'utilisation :</strong> Le soussigné reconnaît avoir reçu la carte SIM susmentionnée et s'engage à 
            l'utiliser exclusivement dans le cadre de ses fonctions professionnelles au sein de l'organisation. 
            En cas de <strong>perte, vol ou détérioration</strong>, le bénéficiaire s'engage à informer immédiatement 
            le service IT afin que les mesures de sécurité nécessaires soient prises dans les meilleurs délais.
        </div>
    </div>

    <!-- SIGNATURES -->
    <table class="signatures-table">
        <tr>
            <td class="sig-box">
                <div class="sig-label">Le Responsable IT</div>
                <br>
                <div class="sig-mention">(Cachet et Signature)</div>
            </td>
            <td style="width: 10%;"></td>
            <td class="sig-box">
                <div class="sig-label">Le Bénéficiaire</div>
                <div class="sig-name">{{ $signedBy ?? $user->name }}</div>
                <br>
                <div class="sig-mention">Mention « Lu et approuvé »</div>
            </td>
        </tr>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        <div class="footer-brand">GPI — Pivot · Gestion de Parc Informatique</div>
    </div>

</body>
</html>
