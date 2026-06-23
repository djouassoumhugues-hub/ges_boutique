@extends('layouts.app')

@section('content')
    <h1>Liste des produits</h1>
    <a href="{{ route('produits.create') }}" class="btn btn-primary mb-3">+ Ajouter un produit</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Référence</th>
                <th>Désignation</th>
                <th>Prix unitaire</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produits as $produit)
                <tr>
                    <td>{{ $produit->reference }}</td>
                    <td>{{ $produit->designation }}</td>
                    <td>{{ number_format($produit->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                    <td>{{ $produit->quantite_stock }}</td>
                    <td>
                        <a href="{{ route('produits.show', $produit) }}" class="btn btn-sm btn-info">Voir</a>
                        <a href="{{ route('produits.edit', $produit) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('produits.destroy', $produit) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce produit ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection