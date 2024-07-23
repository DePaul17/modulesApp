<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historique;

class HistoriqueController extends Controller
{
    public function showHistory()
    {
        // On récupère toutes les données historiques avec les relations
        $historiques = Historique::with(['module', 'detail'])->get();

        // On passe les données à la vue
        return view('ui-history', compact('historiques'));
    }
}
