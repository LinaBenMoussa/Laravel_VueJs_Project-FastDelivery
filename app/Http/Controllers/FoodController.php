<?php
namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
      /**
 * Display a listing of the menus for a specific restaurant.
 *
 * @param  int  $menu_id
 * @return \Illuminate\Http\Response
 */
public function foodsByMenu($menu_id)
{
$foods = Food::where('menu_id', $menu_id)->get();

if ($foods->isEmpty()) {
    return response()->json(['error' => 'No menus found for this restaurant'], 404);
}

return response()->json($foods);
}
    public function index()
    {
        $foods = Food::all();

        return response()->json($foods);
    }

    public function show(Food $food)
    {
        return response()->json($food);
    }

    public function store(Request $request)
    {
        $food = Food::create($request->all());

        return response()->json($food, 201);
    }

    public function update(Food $food, Request $request)
    {
        $food->update($request->all());

        return response()->json($food);
    }

    public function destroy(Food $food)
    {
        $food->delete();

        return response()->json(null, 204);
    }
}
