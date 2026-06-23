@extends('layouts.app')

@section('content')
    <h1>Nouvelle commande</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('commandes.store') }}" method="POST" id="commandeForm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Client</label>
            <select name="client_id" class="form-control" required>
                <option value="">-- Sélectionner un client --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->nom }} {{ $client->prenom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Date de la commande</label>
            <input type="date" name="date_commande" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>

        <h5 class="mt-4">Produits commandés</h5>
        <div id="lignesProduits">
            <div class="row mb-2 ligne-produit">
                <div class="col-md-6">
                    <select name="produits[0][id]" class="form-control" required>
                        <option value="">-- Sélectionner un produit --</option>
                        @foreach($produits as $produit)
                            <option value="{{ $produit->id }}">
                                {{ $produit->designation }} ({{ $produit->quantite_stock }} en stock - {{ number_format($produit->prix_unitaire, 0, ',', ' ') }} FCFA)
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" name="produits[0][quantite]" class="form-control" placeholder="Quantité" min="1" required>
                </div>
            </div>
        </div>

        <button type="button" id="ajouterLigne" class="btn btn-outline-secondary btn-sm mb-3">+ Ajouter un produit</button>

        <br>
        <button type="submit" class="btn btn-success">Créer la commande</button>
        <a href="{{ route('commandes.index') }}" class="btn btn-secondary">Annuler</a>
    </form>

    <script>
        let index = 1;
        document.getElementById('ajouterLigne').addEventListener('click', function () {
            const container = document.getElementById('lignesProduits');
            const original = container.querySelector('.ligne-produit');
            const clone = original.cloneNode(true);

            clone.querySelectorAll('select, input').forEach(el => {
                const name = el.getAttribute('name').replace('[0]', '[' + index + ']');
                el.setAttribute('name', name);
                el.value = '';
            });

            container.appendChild(clone);
            index++;
        });
    </script>
@endsection