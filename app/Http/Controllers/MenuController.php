<?php
namespace App\Http\Controllers;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
 * Display a listing of the menus for a specific restaurant.
 *
 * @param  int  $restaurant_id
 * @return \Illuminate\Http\Response
 */
    public function MenusByRestaurant($restaurant_id)
    {
    $menus = Menu::where('restaurant_id', $restaurant_id)->get();

    if ($menus->isEmpty()) {
        return response()->json(['error' => 'No menus found for this restaurant'], 404);
    }

    return response()->json($menus);
    }
    /**
     * Display a listing of the menus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();

        return response()->json($menus);
    }

    /**
     * Store a newly created menu in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'restaurant_id' => 'required|integer|exists:restaurants,id',
        ]);

        $menu = Menu::create($request->all());

        return response()->json($menu, 201);
    }

    /**
     * Display the specified menu.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json(['error' => 'Menu not found'], 404);
        }

        return response()->json($menu);
    }

    /**
     * Update the specified menu in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json(['error' => 'Menu not found'], 404);
        }

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'restaurant_id' => 'required|integer|exists:restaurants,id',
            'image' => 'nullable|string',

        ]);

        $menu->update($request->all());

        return response()->json($menu);
    }

    /**
     * Remove the specified menu from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json(['error' => 'Menu not found'], 404);
        }

        $menu->delete();

        return response()->json(null, 204);
    }
}
