<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\Client;
use App\Models\Produit;
use App\Models\LigneCommande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CommandeController extends Controller
{
    // Liste des commandes
    public function index()
    {
        $commandes = Commande::with('client')->latest()->get();
        return view('commandes.index', compact('commandes'));
    }

    // Formulaire de création
    public function create()
    {
        $clients = Client::all();
        $produits = Produit::all();
        return view('commandes.create', compact('clients', 'produits'));
    }

    // Enregistrer une nouvelle commande
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'date_commande' => 'required|date',
            'produits' => 'required|array|min:1',
            'produits.*.id' => 'required|exists:produits,id',
            'produits.*.quantite' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            // Créer la commande
            $commande = Commande::create([
                'numero_commande' => 'CMD-' . strtoupper(uniqid()),
                'date_commande' => $request->date_commande,
                'client_id' => $request->client_id,
                'montant_total' => 0,
            ]);

            $montantTotal = 0;

            // Ajouter chaque produit à la commande
            foreach ($request->produits as $item) {
                $produit = Produit::findOrFail($item['id']);
                $quantite = $item['quantite'];

                // Vérifier le stock disponible
                if ($produit->quantite_stock < $quantite) {
                    abort(422, "Stock insuffisant pour le produit : {$produit->designation}");
                }

                LigneCommande::create([
                    'commande_id' => $commande->id,
                    'produit_id' => $produit->id,
                    'quantite' => $quantite,
                    'prix_unitaire' => $produit->prix_unitaire,
                ]);

                // Mettre à jour le stock
                $produit->decrement('quantite_stock', $quantite);

                $montantTotal += $produit->prix_unitaire * $quantite;
            }

            // Mettre à jour le montant total de la commande
            $commande->update(['montant_total' => $montantTotal]);
        });

        return redirect()->route('commandes.index')->with('success', 'Commande créée avec succès.');
    }

    // Afficher le détail d'une commande
    public function show(Commande $commande)
    {
        $commande->load('client', 'ligneCommandes.produit');
        return view('commandes.show', compact('commande'));
    }

    public function edit(Commande $commande)
    {
        // La modification de commande est volontairement omise (complexité de gestion du stock)
        return redirect()->route('commandes.index');
    }

    public function update(Request $request, Commande $commande)
    {
        return redirect()->route('commandes.index');
    }

    // Supprimer une commande (remet le stock)
    public function destroy(Commande $commande)
    {
        DB::transaction(function () use ($commande) {
            foreach ($commande->ligneCommandes as $ligne) {
                $ligne->produit->increment('quantite_stock', $ligne->quantite);
            }
            $commande->delete();
        });

        return redirect()->route('commandes.index')->with('success', 'Commande supprimée et stock restauré.');
    }
    public function telechargerFacture(Commande $commande)
{
    $commande->load('client', 'ligneCommandes.produit');
    $pdf = PDF::loadView('commandes.facture', compact('commande'));
    return $pdf->download('facture-' . $commande->numero_commande . '.pdf');
}
}