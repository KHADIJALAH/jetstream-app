<?php

namespace App\Http\Controllers;

use App\Models\Cruise;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CruiseController extends Controller
{
    public function index()
    {
        $cruises = Cruise::with(['user', 'reviews'])
            ->available()
            ->filter(request(['search', 'cruise_line', 'min_price', 'max_price']))
            ->paginate(12);

        return view('cruises.index', compact('cruises'));
    }

    public function show(Cruise $cruise)
    {
        $availableCabins = $cruise->cabins()->available()->get();
        return view('cruises.show', compact('cruise', 'availableCabins'));
    }

    public function book(Request $request, Cruise $cruise)
    {
        $validated = $request->validate([
            'cabin_id' => 'required|exists:cabins,id',
            'passengers' => 'required|integer|min:1|max:4',
            'departure_date' => 'required|date|after_or_equal:today'
        ]);

        $reservation = $cruise->reservations()->create([
            'user_id' => Auth::id(),
            'start_date' => $validated['departure_date'],
            'total_price' => $this->calculateCruisePrice($cruise, $validated),
            'status' => 'pending'
        ]);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Cruise booked successfully!');
    }

    private function calculateCruisePrice(Cruise $cruise, array $data): float
    {
        $cabin = $cruise->cabins()->findOrFail($data['cabin_id']);
        return $cabin->price_per_night * $cruise->duration * $data['passengers'];
    }
}