<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\User;
use App\Models\HistoriqueModules;

class NotificationController extends Controller
{
    public function showNotifications() {
        //On récupère les notifications des modules avec une pagination de 5 par défaut
        $details = Detail::with('module')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        //On récupère les users
        $users = User::all();

        // On récupère toutes les données historiques avec les relations
        $historiques = HistoriqueModules::with(['module', 'detail'])
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        //On retourne la vue
        return view('user.ui-notification', compact('details', 'users', 'historiques'));
    }
}
