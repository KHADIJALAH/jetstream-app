<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $bookings = Reservation::with(['user', 'reservable'])
            ->latest()
            ->paginate(25);
            
        return view('admin.bookings.index', compact('bookings'));
    }

    public function destroy(Reservation $booking)
    {
        $booking->delete();
        return back();
    }
}