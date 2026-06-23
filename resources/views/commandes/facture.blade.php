<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #212121;
            margin: 0;
            padding: 20px;
        }
        .header {
            background-color: #1565c0;
            color: white;
            padding: 20px 25px;
            border-radius: 6px;
            margin-bottom: 25px;
        }
        .header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: bold;
        }
        .header p {
            margin: 4px 0 0;
            font-size: 12px;
            opacity: 0.85;
        }
        .infos {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .infos-left, .infos-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .infos-right {
            text-align: right;
        }
        .label {
            color: #757575;
            font-size: 11px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .value {
            font-size: 13px;
            font-weight: bold;
            color: #212121;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        thead tr {
            background-color: #1565c0;
            color: white;
        }
        thead th {
            padding: 10px 12px;
            text-align: left;
            font-size: 12px;
        }
        tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }
        tbody td {
            padding: 9px 12px;
            border-bottom: 1px solid #e0e0e0;
        }
        .total-row {
            background-color: #e3f2fd !important;
        }
        .total-row td {
            font-weight: bold;
            font-size: 14px;
            color: #1565c0;
            border-top: 2px solid #1565c0;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #9e9e9e;
            font-size: 11px;
            border-top: 1px solid #e0e0e0;
            padding-top: 12px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>FACTURE</h1>
        <p>Boutique Monsieur Ali — N'Djaména, Tchad</p>
    </div>

    <div class="infos">
        <div class="infos-left">
            <div class="label">Facture N°</div>
            <div class="value">{{ $commande->numero_commande }}</div>
            <br>
            <div class="label">Date</div>
            <div class="value">{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}</div>
        </div>
        <div class="infos-right">
            <div class="label">Client</div>
            <div class="value">{{ $commande->client->nom }} {{ $commande->client->prenom }}</div>
            <br>
            <div class="label">Téléphone</div>
            <div class="value">{{ $commande->client->telephone ?? '—' }}</div>
            <br>
            <div class="label">Adresse</div>
            <div class="value">{{ $commande->client->adresse ?? '—' }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Désignation</th>
                <th>Prix unitaire</th>
                <th>Quantité</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->ligneCommandes as $ligne)
            <tr>
                <td>{{ $ligne->produit->designation }}</td>
                <td>{{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                <td>{{ $ligne->quantite }}</td>
                <td>{{ number_format($ligne->prix_unitaire * $ligne->quantite, 0, ',', ' ') }} FCFA</td>
            </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3" style="text-align:right">MONTANT TOTAL</td>
                <td>{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Merci pour votre confiance — Boutique M. Ali · N'Djaména, Tchad
    </div>

</body>
</html>