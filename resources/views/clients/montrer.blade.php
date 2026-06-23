@extends('layouts.app')

@section('content')
    <h1>Détail du client</h1>

    <table class="table table-bordered w-50">
        <tr>
            <th>Nom</th>
            <td>{{ $client->nom }}</td>
        </tr>
        <tr>
            <th>Prénom</th>
            <td>{{ $client->prenom }}</td>
        </tr>
        <tr>
            <th>Téléphone</th>
            <td>{{ $client->telephone }}</td>
        </tr>
        <tr>
            <th>Adresse</th>
            <td>{{ $client->adresse }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $client->email }}</td>
        </tr>
    </table>

    <a href="{{ route('clients.index') }}" class="btn btn-secondary">Retour à la liste</a>
@endsection