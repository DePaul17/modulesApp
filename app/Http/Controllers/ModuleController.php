<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Detail;
use App\Models\Historique;

class ModuleController extends Controller
{
    public function add_module(Request $request) {
        // On valide les données du formulaire
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
    
        // On vérifie si le nom du module existe déjà
        $existingModule = Module::where('name', $validatedData['name'])->first();
        if ($existingModule) {
            // Si le module existe déjà, on renvoie un message d'erreur
            return redirect()->back()->with('error', 'Ce module existe déjà.');
        }
    
        // On créé un nouveau module
        $module = new Module();
        $module->name = $validatedData['name'];
        $module->description = $validatedData['description'];
        $module->date_add = now();
        $module->starting = 1;
        $module->save();
    
        return redirect()->back()->with('success', 'Module ajouté avec succès !');
    }

    public function all_module() {
        // Récupérer tous les modules avec leurs détails
        $modules = Module::with('detail')->get();

        // Afficher dans la vue
        return view('ui-readmodule', compact('modules'));
    }

    public function destroy($id) {
        // On trouve le module selectionné
        $module = Module::findOrFail($id);

        // On supprime
        $module->delete();

        return redirect()->back()->with('success', 'Module supprimé avec succès !');
    }

    public function edit($id) {
        $module = Module::findOrFail($id);
        return view('ui-edit', compact('module'));
    }

    public function update(Request $request, $id) {
        $module = Module::findOrFail($id);
        $module->name = $request->input('name');
        $module->description = $request->input('description');
        $module->save();

        return redirect('/');
    }

    public function start_module($id) {
        // On met à jour la colonne starting du module correspondant à l'ID
        $module = Module::findOrFail($id);
        $module->starting = 2;
        $module->save();
    
        // On verifie si la table détails contient déjà les détails d'un module
        $existingDetail = Detail::where('module_id', $id)->exists();
    
        if (!$existingDetail) {
            // Si aucune entrée n'existe, ajoutez les détails du module
            $detail = new Detail();
            $detail->module_id = $id;
            $detail->module_state = 1;
            $detail->duration_operation = mt_rand(1, 500);
            $detail->number_data_sent = mt_rand(1, 1000);
            $detail->temperature = mt_rand(-10, 99);
            $detail->speed = mt_rand(0, 100);
            $detail->save();
    
            // On ajoute une entrée dans la table Historiques
            $historique = new Historique();
            $historique->module_id = $id;
            $historique->detail_id = $detail->id;
            $historique->save();
        }
    
        return redirect()->back()->with('success', 'Module démarré avec succès!');
    }
    

    public function stop_module($id) {
        // On met à jour la colonne starting du module correspondant à l'ID
        $module = Module::findOrFail($id);
        $module->starting = 1;
        $module->save();

        return redirect()->back()->with('success', 'Module démarré avec succès!');
    }

    public function repairModule($id) {
        // On trouve le détail correspondant à l'ID
        $detail = Detail::findOrFail($id);

        // On met à jour le module_state à 1
        $detail->module_state = 1;
        $detail->save();

        // On rédirige ou retourner une réponse
        return redirect()->back()->with('success', 'Module state updated successfully!');
    }
}
