@extends('layouts.app')

@section('content')
    <h1>Facture {{ $commande->numero_commande }}</h1>

    <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}</p>
    <p><strong>Client :</strong> {{ $commande->client->nom }} {{ $commande->client->prenom }}</p>
    <p><strong>Téléphone :</strong> {{ $commande->client->telephone }}</p>
    <p><strong>Adresse :</strong> {{ $commande->client->adresse }}</p>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->ligneCommandes as $ligne)
                <tr>
                    <td>{{ $ligne->produit->designation }}</td>
                    <td>{{ $ligne->quantite }}</td>
                    <td>{{ number_format($ligne->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($ligne->prix_unitaire * $ligne->quantite, 0, ',', ' ') }} FCFA</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Montant total</th>
                <th>{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</th>
            </tr>
        </tfoot>
    </table>

    <a href="{{ route('commandes.index') }}" class="btn btn-secondary">Retour à la liste</a>
    <a href="{{ route('commandes.facture', $commande) }}" class="btn btn-primary">
    Télécharger la facture PDF
</a>
@endsection