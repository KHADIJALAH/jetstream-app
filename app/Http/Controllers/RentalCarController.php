<?php

namespace App\Http\Controllers;

use App\Models\RentalCar;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RentalCarController extends Controller
{
    public function index()
    {
        $cars = RentalCar::available()
            ->filter(request(['car_type', 'min_price', 'max_price']))
            ->with('user')
            ->paginate(10);

        return view('cars.index', compact('cars'));
    }

    public function show(RentalCar $car)
    {
        return view('cars.show', compact('car'));
    }

    public function reserve(Request $request, RentalCar $car)
    {
        $validated = $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'pickup_location' => 'required|string'
        ]);

        $days = Carbon::parse($validated['end_date'])
            ->diffInDays($validated['start_date']);

        $reservation = Reservation::create([
            'user_id' => Auth::id(),
            'reservable_type' => RentalCar::class,
            'reservable_id' => $car->id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'total_price' => $car->daily_price * $days,
            'status' => 'confirmed'
        ]);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Car reserved successfully!');
    }

    public function availability(RentalCar $car)
    {
        $availability = $car->availableDates();
        return response()->json($availability);
    }
}