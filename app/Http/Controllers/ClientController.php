<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Afficher la liste des clients
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', compact('clients'));
    }

    // Afficher le formulaire de création
    public function create()
    {
        return view('clients.create');
    }

    // Enregistrer un nouveau client
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'email' => 'nullable|email|unique:clients,email',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client ajouté avec succès.');
    }

    // Afficher un client précis
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    // Afficher le formulaire de modification
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // Mettre à jour un client
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string',
            'email' => 'nullable|email|unique:clients,email,' . $client->id,
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client modifié avec succès.');
    }

    // Supprimer un client
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client supprimé avec succès.');
    }
}