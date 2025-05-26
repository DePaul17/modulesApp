<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoriqueUsers;

class HistoriqueUserController extends Controller
{
    public function showUserHistorical()
    {
        // On récupère tous les enregistrements de la table historique_users
        $historiques = HistoriqueUsers::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(8);

        // On passe les données à la vue
        return view('user.ui-history', compact('historiques'));
    }

    public function searchHistoriqueUsers(Request $request)
    {
        $query = $request->input('query');

        $historiques = HistoriqueUsers::whereHas('user', function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->orWhere('action', 'LIKE', "%{$query}%")
            ->paginate(5);

        return view('user.ui-history', compact('historiques'));
    }
}
