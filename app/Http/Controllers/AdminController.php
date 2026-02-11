<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Avis;

class AdminController extends Controller
{
    public function index()
    {
        // Récupérer les statistiques
        $servicesCount = Service::count();
        $reservationsCount = Reservation::count();
        $usersCount = User::where('is_admin', false)->count(); // exclure les admins
       // $avisCount = Avis::count();
       // $avisMoyenne = Avis::avg('note'); // Calcul de la moyenne des avis

        // Récupérer les dernières activités (exemples)
        $latestServices = Service::latest()->take(3)->get();
        $latestReservations = Reservation::latest()->take(3)->get();
        $latestUsers = User::latest()->take(3)->get();

        // Passer les données à la vue
        return view('admin.dashboard', compact(
            'servicesCount', 'reservationsCount', 'usersCount',
            'latestServices', 'latestReservations', 'latestUsers'
        ));
        
    }
}
