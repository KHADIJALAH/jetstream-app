<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $hotels = Hotel::latest()->take(3)->get();
        $flights = Flight::latest('departure_time') // Utilisation de departure_time
            ->take(3)
            ->get();

        return view('home', [
            'hotels' => $hotels,
            'flights' => $flights
        ]);
    }

    public function search(Request $request): Renderable
    {
        $validated = $request->validate([
            'query' => 'required|string|max:255'
        ]);

        $searchTerm = $validated['query'];

        $hotels = Hotel::with(['amenities', 'reviews'])
            ->where('name', 'like', "%{$searchTerm}%")
            ->orWhere('description', 'like', "%{$searchTerm}%")
            ->orWhere('location', 'like', "%{$searchTerm}%")
            ->paginate(10)
            ->appends(['query' => $searchTerm]);

        return view('search.results', [
            'hotels' => $hotels,
            'searchTerm' => $searchTerm
        ]);
    }
}