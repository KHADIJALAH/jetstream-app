<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::latest()->get();
        return view('admin.hotels.index', compact('hotels'));
    }

    public function create()
    {
        return view('admin.hotels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'star_rating' => 'required|integer|between:1,5',
            'price_per_night' => 'required|numeric|min:0'
        ]);

        Hotel::create([
            'user_id' => Auth::id(),
            ...$validated
        ]);

        return redirect()->route('admin.hotels.index')
                         ->with('success', 'Hôtel créé avec succès');
    }

    public function edit(Hotel $hotel)
    {
        return view('admin.hotels.edit', compact('hotel'));
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'star_rating' => 'required|integer|between:1,5',
            'price_per_night' => 'required|numeric|min:0'
        ]);

        $hotel->update($validated);

        return redirect()->route('admin.hotels.index')
                         ->with('success', 'Hôtel mis à jour avec succès');
    }

    public function destroy(Hotel $hotel)
    {
        try {
            $hotel->delete();
            return redirect()->route('admin.hotels.index')
                             ->with('success', 'Hôtel supprimé avec succès');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
    }

    // Méthode show optionnelle (si utilisée)
    public function show(Hotel $hotel)
    {
        return view('admin.hotels.show', compact('hotel'));
    }
}