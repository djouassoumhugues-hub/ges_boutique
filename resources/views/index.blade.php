@extends('layouts.app')
@section('content')
    <h1>Liste des clients</h1>
    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">
        + Ajouter un client
    </a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->nom }}</td>
                    <td>{{ $client->prenom }}</td>
                    <td>{{ $client->telephone }}</td>
                    <td>{{ $client->email }}</td>
                    <td>
                        <a href="{{ route('clients.show', $client) }}"
                           class="btn btn-sm btn-info">Voir</a>
                        <a href="{{ route('clients.edit', $client) }}"
                           class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('clients.destroy', $client) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Supprimer ce client ?')">
                                Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>