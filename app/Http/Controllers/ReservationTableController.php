<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReservationTable;
use Illuminate\Validation\ValidationException;

class ReservationTableController extends Controller
{
    /**
     * Display a listing of the reservations.
     *
     * @return \Illuminate\Http\Response
     */
    public function ReservationsByRestaurant($restaurant_id)
    {
        $reservations = ReservationTable::where('restaurant_id', $restaurant_id)->get();

        return response()->json($reservations);
    }
    public function index()
    {
        $reservations = ReservationTable::all();
        return response()->json($reservations);
    }

    /**
     * Store a newly created reservation in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required|date',
                'time' => 'required|date_format:H:i',
                'table_id' => 'required|exists:tables,id',
                'restaurant_id'=> 'required|exists:restaurants,id',
                'email' => 'required',
                'secretCode'=>'required',
                'numpersonnes'=>'required',
            ]);
    
            $reservation = new ReservationTable();
            $reservation->date = $request->input('date');
            $reservation->time = $request->input('time');
            $reservation->email = $request->input('email');
            $reservation->secretCode = $request->input('secretCode');
            $reservation->numpersonnes = $request->input('numpersonnes');
            $reservation->table_id = $request->input('table_id');
            $reservation->restaurant_id = $request->input('restaurant_id');
            $reservation->save();
    
            return response()->json($reservation, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            info('Error creating reservation: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Display the specified reservation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = ReservationTable::find($id);

        return response()->json($reservation);
    }

    /**
     * Update the specified reservation in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'table_id' => 'required|exists:tables,id',
        ]);

        $reservation = ReservationTable::find($id);
        $reservation->date = $request->input('date');
        $reservation->time = $request->input('time');
        $reservation->table_id = $request->input('table_id');
        $reservation->save();

        return response()->json($reservation);
    }

    /**
     * Remove the specified reservation from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = ReservationTable::find($id);
        $reservation->delete();

        return response()->json(null, 204);
    }
}
