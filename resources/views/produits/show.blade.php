@extends('layouts.app')

@section('content')
    <h1>Détail du produit</h1>

    <table class="table table-bordered w-50">
        <tr>
            <th>Référence</th>
            <td>{{ $produit->reference }}</td>
        </tr>
        <tr>
            <th>Désignation</th>
            <td>{{ $produit->designation }}</td>
        </tr>
        <tr>
            <th>Prix unitaire</th>
            <td>{{ number_format($produit->prix_unitaire, 0, ',', ' ') }} FCFA</td>
        </tr>
        <tr>
            <th>Quantité en stock</th>
            <td>{{ $produit->quantite_stock }}</td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $produit->description }}</td>
        </tr>
    </table>

    <a href="{{ route('produits.index') }}" class="btn btn-secondary">Retour à la liste</a>
@endsection