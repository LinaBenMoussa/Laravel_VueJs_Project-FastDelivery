<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Restaurant;


class RestaurantController extends Controller
{
    /**
     * Display a listing of the restaurants.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();

        return response()->json($restaurants);
    }

    /**
     * Store a newly created restaurant in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'logo' => 'nullable|string',
            'description' => 'required|string',
            'city'=> 'required|string',
        ]);

        $restaurant = new Restaurant();
        $restaurant->name = $request->input('name');
        $restaurant->address = $request->input('address');
        $restaurant->phone = $request->input('phone');
        $restaurant->email = $request->input('email');
        $restaurant->logo = $request->input('logo');
        $restaurant->description = $request->input('description');
        $restaurant->city = $request->input('city');
        $restaurant->save();

        return response()->json($restaurant, 201);
    }

    /**
     * Display the specified restaurant.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::find($id);

        return response()->json($restaurant);
    }

    /**
     * Update the specified restaurant in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|string',
            'logo' => 'nullable|string',
            'description' => 'required|string',
            'city' => 'required|string',
        ]);

        $restaurant = Restaurant::find($id);
        $restaurant->name = $request->input('name');
        $restaurant->address = $request->input('address');
        $restaurant->phone = $request->input('phone');
        $restaurant->email = $request->input('email');
        $restaurant->logo = $request->input('logo');
        $restaurant->description = $request->input('description');
        $restaurant->city = $request->input('city');
        $restaurant->save();

        return response()->json($restaurant);
    }

    /**
     * Remove the specified restaurant from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);
        $restaurant->delete();

        return response()->json(null, 204);
    }
}
