<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ActivityController extends Controller
{
    public function index(): View
    {
        return view('admin.activities.index', [
            'activities' => Activity::with(['media', 'user'])
                ->withCount(['bookings as total_reservations'])
                ->latest()
                ->paginate(10)
        ]);
    }

    // ✅ Méthode create ajoutée
    public function create(): View
    {
        return view('admin.activities.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->validationRules());

        $activity = Activity::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . uniqid(),
            'description' => strip_tags($validated['description']),
            'location' => $validated['location'],
            'price' => $validated['price'] * 100,
            'duration' => $validated['duration'],
            'category' => $validated['category'],
            'user_id' => auth()->id()
        ]);

        $this->handleMedia($request, $activity);

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activité créée avec succès');
    }

    public function update(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $validated = $request->validate($this->validationRules($activity));

        $activity->update([
            'name' => $validated['name'],
            'slug' => $activity->name === $validated['name']
                ? $activity->slug
                : Str::slug($validated['name']) . '-' . uniqid(),
            'description' => strip_tags($validated['description']),
            'location' => $validated['location'],
            'price' => $validated['price'] * 100,
            'duration' => $validated['duration'],
            'category' => $validated['category']
        ]);

        if ($request->hasFile('image')) {
            $this->handleMedia($request, $activity, true);
        }

        return redirect()->route('admin.activities.index')->with('success', 'Activité modifiée avec succès.');
    }

    private function validationRules(?Activity $activity = null): array
    {
        return [
            'name' => 'required|min:3|max:255|unique:activities,name,' . ($activity?->id ?? ''),
            'description' => 'required|string|min:50|max:5000',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|between:0,9999.99',
            'duration' => 'required|integer|min:1|max:24',
            'category' => 'required|in:' . implode(',', array_keys(config('activity_categories'))),
            'image' => ($activity ? 'nullable' : 'required') . '|image|max:5120|mimes:jpg,jpeg,png,webp|dimensions:min_width=600,min_height=400'
        ];
    }

    private function handleMedia(Request $request, Activity $activity, bool $replace = false): void
    {
        if ($replace) {
            $activity->clearMediaCollection('activities');
        }

        $activity->addMediaFromRequest('image')
            ->usingFileName(Str::slug(pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $request->file('image')->extension())
            ->withCustomProperties([
                'uploader_id' => auth()->id(),
                'original_name' => $request->file('image')->getClientOriginalName()
            ])
            ->toMediaCollection('activities');
    }
    public function edit($id)
{
    $activity = Activity::findOrFail($id); // ou avec route model binding : public function edit(Activity $activity)
    return view('admin.activities.edit', compact('activity'));
}
public function destroy($id)
{
    $activity = Activity::findOrFail($id);
    $activity->delete();

    return redirect()->route('admin.activities.index')->with('success', 'Activity deleted successfully.');
}
}
