<?php
namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
    
    public function getFoodDetails($food_id)
{
    try {
        // Fetch food details
        $food = Food::findOrFail($food_id);

        // Fetch menu details
        $menu = Menu::findOrFail($food->menu_id);

        // Fetch restaurant details
        $restaurant = Restaurant::findOrFail($menu->restaurant_id);

        // Prepare the response
        $result = [
            'product' => $food,
            'menu' => $menu,
            'restaurant' => $restaurant,
        ];

        return response()->json($result, 200);
    } catch (\Exception $e) {
        // Handle other errors

        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}
}


