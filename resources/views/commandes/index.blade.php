@extends('layouts.app')

@section('content')
    <h1>Liste des commandes</h1>
    <a href="{{ route('commandes.create') }}" class="btn btn-primary mb-3">+ Nouvelle commande</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Numéro</th>
                <th>Date</th>
                <th>Client</th>
                <th>Montant total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandes as $commande)
                <tr>
                    <td>{{ $commande->numero_commande }}</td>
                    <td>{{ \Carbon\Carbon::parse($commande->date_commande)->format('d/m/Y') }}</td>
                    <td>{{ $commande->client->nom }} {{ $commande->client->prenom }}</td>
                    <td>{{ number_format($commande->montant_total, 0, ',', ' ') }} FCFA</td>
                    <td>
                        <a href="{{ route('commandes.show', $commande) }}" class="btn btn-sm btn-info">Voir / Facture</a>
                        <form action="{{ route('commandes.destroy', $commande) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette commande ? Le stock sera restauré.')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection