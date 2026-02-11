<?php

namespace App\Http\Controllers;

use App\Models\VacationRental;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class VacationRentalController extends Controller
{
    public function index()
    {
        $rentals = VacationRental::with(['user', 'amenities'])
            ->available()
            ->filter(request(['property_type', 'bedrooms', 'min_price', 'location'])) // Added location to filter
            ->paginate(12);

        return view('rentals.index', compact('rentals'));
    }

    public function show(VacationRental $rental)
    {
        $bookedDates = $rental->reservations()
            ->pluck('start_date', 'end_date')
            ->toArray();

        return view('rentals.show', compact('rental', 'bookedDates'));
    }

    public function book(Request $request, VacationRental $rental)
    {
        $validated = $request->validate([
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:' . $rental->max_guests, // Added min:1
        ]);

        // Check for availability
        $overlappingReservation = $rental->reservations()->where(function ($query) use ($validated) {
            $query->where('start_date', '<', $validated['check_out'])
                  ->where('end_date', '>', $validated['check_in']);
        })->exists();

        if ($overlappingReservation) {
            return back()->withErrors(['availability' => 'This rental is not available for the selected dates.']);
        }

        $checkInDate = Carbon::parse($validated['check_in']);
        $checkOutDate = Carbon::parse($validated['check_out']);
        $days = $checkOutDate->diffInDays($checkInDate);

        $reservation = $rental->reservations()->create([
            'user_id' => Auth::id(),
            'start_date' => $validated['check_in'],
            'end_date' => $validated['check_out'],
            'total_price' => $rental->price_per_night * $days,
            'status' => 'pending', // Or 'confirmed' based on your workflow
            'guests' => $validated['guests'],
        ]);

        return redirect()->route('reservations.show', $reservation)
            ->with('success', 'Rental booked successfully! Your reservation is pending confirmation.');
    }

    public function calendar(VacationRental $rental)
    {
        $period = CarbonPeriod::create(now(), now()->addMonths(6));
        return view('rentals.calendar', compact('rental', 'period'));
    }

    // Add methods for creating, editing, and deleting rentals if needed, with appropriate authorization
}