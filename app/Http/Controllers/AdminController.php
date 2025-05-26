<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function list_user()
    {
        // On récupère tous les users par 5 sauf l'utilisateur conecté
        $users = User::where('id', '!=', Auth::id())->paginate(5);

        // On passe les données à la vue
        return view('admin.ui-list-user', compact('users'));
    }

    public function searchHistoriqueUsers(Request $request)
    {
        $query = $request->input('query');

        $users = User::where('name', 'LIKE', "%{$query}%")
                        ->orWhere('email', 'LIKE', "%{$query}%")
                        ->paginate(5);

        return view('admin.ui-list-user', compact('users'));
    }

    public function all_module() {
        // On récupère tous les modules avec pagination (2 par page)
        $modules = Module::with('detail')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        // On affiche dans la vue
        return view('admin.ui-list-module', compact('modules'));
    }
}
