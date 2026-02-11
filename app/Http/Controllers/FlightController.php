<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlightController extends Controller
{
    /**
     * Affiche la liste des vols disponibles.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Récupère les vols disponibles triés par heure de départ
        $flights = Flight::available()
            ->orderBy('departure_time')
            ->paginate(15);

        return view('flights.index', compact('flights'));
    }

    /**
     * Affiche les détails d'un vol spécifique.
     *
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\View\View
     */
    public function show(Flight $flight)
    {
        $availableSeats = $flight->seats()->available()->get();
        return view('flights.show', compact('flight', 'availableSeats'));
    }

    /**
     * Permet de réserver un vol.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flight  $flight
     * @return \Illuminate\Http\RedirectResponse
     */
    public function book(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'seat_id' => 'required|exists:seats,id',
            'passengers' => 'required|array',
            'passengers.*.name' => 'required|string',
            'passengers.*.passport' => 'required|string',
        ]);

        $reservation = $flight->reservations()->create([
            'user_id' => Auth::id(),
            'total_price' => $this->calculateFlightPrice($flight, $validated),
            'status' => 'confirmed',
        ]);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Flight booked successfully!');
    }

    /**
     * Calcule le prix total d'un vol en fonction des passagers.
     *
     * @param  \App\Models\Flight  $flight
     * @param  array  $data
     * @return float
     */
    private function calculateFlightPrice(Flight $flight, array $data): float
    {
        $seat = $flight->seats()->findOrFail($data['seat_id']);
        return $seat->price * count($data['passengers']);
    }

    /**
     * Recherche des vols en fonction des critères.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $flights = Flight::searchCriteria($request->all())->get();
        return view('flights.search_results', compact('flights'));
    }
}