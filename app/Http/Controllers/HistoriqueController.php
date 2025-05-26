<?php

namespace App\Http\Controllers;

use App\Models\HistoriqueModules;
use App\Models\User;

class HistoriqueController extends Controller
{
    public function showHistory()
    {
        //On récupère les users
        $users = User::all();

        // On récupère toutes les données historiques avec les relations
        $historiques = HistoriqueModules::with(['module', 'detail'])
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        // On passe les données à la vue
        return view('ui-notification', compact('historiques', 'users'));
    }
}
