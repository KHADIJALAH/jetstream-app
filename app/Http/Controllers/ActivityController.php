<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $activities = Activity::paginate(10);
        return view('activities.index', compact('activities'));
    }

    public function create()
    {
        return view('activities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string', // Added description
            'price' => 'required|numeric|min:0', // Changed price_per_night to price, added min:0
            'location' => 'nullable|string|max:255', // Added location
            'duration' => 'nullable|string|max:255', // Added duration
            // Add other validation rules relevant to your Activity model
        ]);

        $activity = Auth::user()->activities()->create($validated);
        return redirect()->route('activities.show', $activity)->with('success', 'Activity created successfully!');
    }

    public function show(Activity $activity)
    {
        return view('activities.show', compact('activity')); // Corrected variable name
    }

    public function edit(Activity $activity)
    {
        if ($activity->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('activities.edit', compact('activity')); // Corrected variable name
    }

    public function update(Request $request, Activity $activity)
    {
        if ($activity->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            // Add other validation rules
        ]);

        $activity->update($validated);

        return redirect()->route('activities.show', $activity)->with('success', 'Activity updated successfully!');
    }

    public function destroy(Activity $activity)
    {
        if ($activity->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        $activity->delete();
        return redirect()->route('activities.index')->with('success', 'Activity deleted successfully!');
    }
}