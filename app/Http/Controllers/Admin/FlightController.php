<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::latest()->get();
        return view('admin.flights.index', compact('flights'));
    }

    public function create()
    {
        return view('admin.flights.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'airline' => 'required|string|max:255',
            'flight_number' => 'required|string|max:10',
            'departure_airport' => [
                'required',
                'string',
                'max:4',
                'regex:/^[A-Z]{3,4}$/'
            ],
            'arrival_airport' => [
                'required',
                'string',
                'max:4',
                'regex:/^[A-Z]{3,4}$/',
                'different:departure_airport'
            ],
            'departure_time' => 'required|date|after_or_equal:now',
            'arrival_time' => 'required|date|after:departure_time',
            'duration' => 'required|integer|min:30|max:1440',
            'price' => 'required|numeric|min:0|max:100000'
        ], [
            'departure_airport.regex' => 'Le code aéroport doit contenir 3 ou 4 lettres majuscules',
            'arrival_airport.different' => 'L\'aéroport d\'arrivée doit être différent du départ',
            'arrival_time.after' => 'L\'heure d\'arrivée doit être après le départ'
        ]);

        $validated['departure_time'] = Carbon::parse($validated['departure_time'])->toDateTimeString();
        $validated['arrival_time'] = Carbon::parse($validated['arrival_time'])->toDateTimeString();
        $validated['user_id'] = Auth::id();

        Flight::create($validated);

        return redirect()->route('admin.flights.index')
                         ->with('success', 'Vol créé avec succès');
    }

    public function edit(Flight $flight)
    {
        return view('admin.flights.edit', compact('flight'));
    }

    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'airline' => 'required|string|max:255',
            'flight_number' => 'required|string|max:10',
            'departure_airport' => [
                'required',
                'string',
                'max:4',
                'regex:/^[A-Z]{3,4}$/'
            ],
            'arrival_airport' => [
                'required',
                'string',
                'max:4',
                'regex:/^[A-Z]{3,4}$/',
                'different:departure_airport'
            ],
            'departure_time' => 'required|date|after_or_equal:now',
            'arrival_time' => 'required|date|after:departure_time',
            'duration' => 'required|integer|min:30|max:1440',
            'price' => 'required|numeric|min:0|max:100000'
        ], [
            'arrival_time.after' => 'L\'heure d\'arrivée doit être après le départ'
        ]);

        $validated['departure_time'] = Carbon::parse($validated['departure_time'])->toDateTimeString();
        $validated['arrival_time'] = Carbon::parse($validated['arrival_time'])->toDateTimeString();

        $flight->update($validated);

        return redirect()->route('admin.flights.index')
                         ->with('success', 'Vol mis à jour avec succès');
    }

    public function destroy(Flight $flight)
    {
        try {
            $flight->delete();
            return redirect()->route('admin.flights.index')
                             ->with('success', 'Vol supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Erreur : ' . $e->getMessage());
        }
    }
}
