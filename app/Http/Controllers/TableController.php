<?php 
namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    public function TableByRestaurant($restaurant_id)
    {
    $tables = Table::where('restaurant_id', $restaurant_id)->get();

    if ($tables->isEmpty()) {
        return response()->json(['error' => 'No tables found for this restaurant'], 404);
    }
    return response()->json($tables);
}
    public function index()
    {
        // Récupérer toutes les tables
        $tables = Table::all();

        return response()->json($tables);
    }

    public function show($id)
    {
        // Récupérer une table par ID
        $table = Table::findOrFail($id);

        return response()->json($table);
    }

    public function store(Request $request)
    {
        // Valider les données
        $request->validate([
            'table_number' => 'required',
            'seating_capacity' => 'required|integer',
            // Ajoutez d'autres règles de validation au besoin
        ]);

        // Créer une nouvelle table
        $table = Table::create($request->all());

        return response()->json($table, 201);
    }

    public function update(Request $request, $id)
    {
        // Valider les données
        $request->validate([
            'table_number' => 'required',
            'seating_capacity' => 'required|integer',
            // Ajoutez d'autres règles de validation au besoin
        ]);

        // Mettre à jour la table existante
        $table = Table::findOrFail($id);
        $table->update($request->all());

        return response()->json($table);
    }

    public function destroy($id)
    {
        // Supprimer une table par ID
        $table = Table::findOrFail($id);
        $table->delete();

        return response()->json(['message' => 'Table supprimée avec succès']);
    }
}
?>