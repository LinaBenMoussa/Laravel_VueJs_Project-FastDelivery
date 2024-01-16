<?php
// app/Http/Controllers/CommandeController.php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index()
    {
        $commandes = Commande::all();

        return response()->json($commandes);
    }

    public function show(Commande $commande)
    {
        return response()->json($commande);
    }

    public function store(Request $request)
    {
        $commande = Commande::create($request->all());

        return response()->json($commande, 201);
    }

    public function update(Commande $commande, Request $request)
    {
        $commande->update($request->all());

        return response()->json($commande);
    }

    // public function destroy(Commande $commande)
    // {
    //     $commande->delete();

    //     return response()->json(null, 204);
    // }
    public function destroy($panier)
    {
        // Supprimez toutes les commandes liées à ce panier
        Commande::where('panier', $panier)->delete();
    
        // Vous pouvez également supprimer le panier lui-même si nécessaire
        // Panier::where('id', $panier)->delete();
    
        return response()->json(null, 204);
    }
    
}
?>