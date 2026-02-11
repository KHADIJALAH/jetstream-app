<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Hotel;
use Illuminate\Http\Request;

class AdminAvisController extends Controller
{
    // Afficher les avis d'un hôtel
    public function show(Hotel $hotel)
    {
        // Charger les avis associés à l'hôtel
        $hotel->load('avis');
        return view('admin.avis.show', compact('hotel'));
    }

    // Supprimer un avis
    public function destroy(Avis $avis)
    {
        // Supprimer l'avis
        $avis->delete();

        // Rediriger avec un message de succès
        return redirect()->route('admin.avis.show', $avis->hotel_id)
            ->with('success', 'Avis supprimé avec succès');
    }

    // (Optionnel) Modifier un avis
    public function edit(Avis $avis)
    {
        return view('admin.avis.edit', compact('avis'));
    }

    // (Optionnel) Mettre à jour un avis
    public function update(Request $request, Avis $avis)
    {
        // Validation et mise à jour
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:255',
        ]);

        $avis->update($request->only(['rating', 'comment']));

        return redirect()->route('admin.avis.show', $avis->hotel_id)
            ->with('success', 'Avis mis à jour avec succès');
    }
    public function store(Request $request)
{
    $request->validate([
        'commentaire' => 'required|string',
        'service_id' => 'required|exists:services,id',
    ]);

    Avis::create([
        'commentaire' => $request->commentaire,
        'user_id' => auth()->id(),
        'service_id' => $request->service_id,
    ]);

    return back()->with('success', 'Avis enregistré avec succès !');
}

}
