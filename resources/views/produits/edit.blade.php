@extends('layouts.app')

@section('content')
    <h1>Modifier le produit</h1>

    <form action="{{ route('produits.update', $produit) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Référence</label>
            <input type="text" name="reference" class="form-control" value="{{ old('reference', $produit->reference) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Désignation</label>
            <input type="text" name="designation" class="form-control" value="{{ old('designation', $produit->designation) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Prix unitaire</label>
            <input type="number" step="0.01" name="prix_unitaire" class="form-control" value="{{ old('prix_unitaire', $produit->prix_unitaire) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Quantité en stock</label>
            <input type="number" name="quantite_stock" class="form-control" value="{{ old('quantite_stock', $produit->quantite_stock) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $produit->description) }}</textarea>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="{{ route('produits.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection