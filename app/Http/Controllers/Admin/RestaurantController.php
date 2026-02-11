<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    public function index()
    {
        return view('admin.restaurants.index', [
            'restaurants' => Restaurant::with('media')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.restaurants.create', [
            'cuisineTypes' => config('cuisine_types'),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'cuisine_type' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'image' => 'required|image|max:2048',
        ]);

        $restaurant = Restaurant::create([
            'name' => $validated['name'],
            'cuisine_type' => $validated['cuisine_type'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
            'rating' => 0,
            'opening_hours' => [],
            'slug' => $this->generateUniqueSlug($validated['name']),
        ]);

        // Gérer l'image avec Spatie Media Library
        $restaurant->addMediaFromRequest('image')
            ->sanitizingFileName(function ($name) {
                return Str::slug(pathinfo($name, PATHINFO_FILENAME)) . '.' . pathinfo($name, PATHINFO_EXTENSION);
            })
            ->toMediaCollection('restaurants');

        return redirect()->route('admin.restaurants.index')
                         ->with('success', 'Restaurant créé avec succès.');
    }

    public function edit(Restaurant $restaurant)
    {
        return view('admin.restaurants.edit', [
            'restaurant' => $restaurant,
            'cuisineTypes' => config('cuisine_types'),
        ]);
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'name' => 'required|min:3|max:255',
            'cuisine_type' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $restaurant->update([
            'name' => $validated['name'],
            'cuisine_type' => $validated['cuisine_type'],
            'address' => $validated['address'],
            'phone' => $validated['phone'],
        ]);

        // Si nouvelle image, on remplace l'ancienne
        if ($request->hasFile('image')) {
            $restaurant->clearMediaCollection('restaurants');

            $restaurant->addMediaFromRequest('image')
                ->sanitizingFileName(function ($name) {
                    return Str::slug(pathinfo($name, PATHINFO_FILENAME)) . '.' . pathinfo($name, PATHINFO_EXTENSION);
                })
                ->toMediaCollection('restaurants');
        }

        return redirect()->route('admin.restaurants.index')
                         ->with('success', 'Restaurant mis à jour avec succès.');
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return back()->with('success', 'Restaurant supprimé avec succès.');
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        while (Restaurant::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
