<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Detail;
use App\Models\HistoriqueModules;
use App\Models\HistoriqueUsers;
use Smalot\PdfParser\Parser;

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
            return redirect()->back()->with('error', 'Ce module existe déjà.');
        }
    
        // On créé un nouveau module
        $module = new Module();
        $module->name = $validatedData['name'];
        $module->description = $validatedData['description'];
        $module->date_add = now();
        $module->starting = 1;
        $module->save();
    
        // Enregistrement de l'action dans l'historique des utilisateurs
        HistoriqueUsers::create([
            'user_id' => auth()->id(), // Récupère l'utilisateur connecté
            'action' => "a ajouté un nouveau module - " . $module->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Module ajouté avec succès !');
    }

    public function all_module() {
        // On récupère tous les modules avec pagination (2 par page)
        $modules = Module::with('detail')
            ->orderBy('created_at', 'desc')
            ->paginate(2);

        // On affiche dans la vue
        return view('user.ui-readmodule', compact('modules'));
    }

    public function destroy($id) {
        // On trouve le module sélectionné
        $module = Module::findOrFail($id);
    
        // On récupère le nom du module pour l'historique avant suppression
        $moduleName = $module->name;
    
        // On supprime le module
        $module->delete();
    
        // Enregistrement de l'action dans l'historique des utilisateurs
        HistoriqueUsers::create([
            'user_id' => auth()->id(), // Récupère l'utilisateur connecté
            'action' => " a supprimé le module - " . $moduleName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Module supprimé avec succès !');
    }

    public function edit($id) {
        $module = Module::findOrFail($id);
        return view('user.ui-edit', compact('module'));
    }

    public function update(Request $request, $id) {
        $module = Module::findOrFail($id);
    
        // On stocke les anciennes valeurs pour afficher dans l'historique
        $oldName = $module->name;
        $oldDescription = $module->description;
    
        $module->name = $request->input('name');
        $module->description = $request->input('description');
        $module->save();
    
        // Enregistrement de l'action dans l'historique des utilisateurs
        $action = "a modifié le module - " . $oldName . ", ";
        $action .= "Nom : " . $oldName . " → " . $module->name . ", ";
        $action .= "Description : " . $oldDescription . " → " . $module->description;
    
        HistoriqueUsers::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect('/')->with('success', 'Module mis à jour avec succès !');
    }

    public function start_module($id) {
        // On met à jour la colonne starting du module correspondant à l'ID
        $module = Module::findOrFail($id);
        $module->starting = 2;
        $module->save();
    
        // On vérifie si la table détails contient déjà les détails d'un module
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
    
            // On ajoute une entrée dans la table Historiques des modules
            $historique = new HistoriqueModules();
            $historique->module_id = $id;
            $historique->detail_id = $detail->id;
            $historique->save();
        }
    
        // Enregistrement de l'action dans l'historique des utilisateurs
        HistoriqueUsers::create([
            'user_id' => auth()->id(),
            'action' => "a lancé le module - " . $module->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Module démarré avec succès!');
    }

    public function stop_module($id) {
        // On met à jour la colonne starting du module correspondant à l'ID
        $module = Module::findOrFail($id);
        $module->starting = 1;
        $module->save();
    
        // Enregistrer l'action dans l'historique des utilisateurs
        HistoriqueUsers::create([
            'user_id' => auth()->id(), // Récupère l'utilisateur connecté
            'action' => "a arrêté le module - " . $module->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Module arrêté avec succès!');
    }

    public function repairModule($id) {
        // On trouve le détail correspondant à l'ID
        $detail = Detail::findOrFail($id);
    
        // On met à jour le module_state à 1
        $detail->module_state = 1;
        $detail->save();
    
        // Enregistrement de l'action dans l'historique des utilisateurs
        $module = Module::findOrFail($detail->module_id);
        HistoriqueUsers::create([
            'user_id' => auth()->id(),
            'action' => "Réparé le module - " . $module->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        // On redirige ou retourne une réponse
        return redirect()->back()->with('success', 'Module réparé avec succès!');
    }

    public function listModuleWhereStateIsBrokenDown(Request $request){
        // On récupère tous les modules avec l'état = 2
        $modulesBrokenDnwn = Module::whereHas('details', function ($query) {
            $query->where('module_state', 2);
        })->get();        

        // On affiche dans la vue
        return view('layouts.ui-head-bar', compact('modulesBrokenDown'));
    }

    public function searchModule(Request $request)
    {
        $query = $request->input('query');

        $modules = Module::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(2);

        return view('user.ui-readmodule', compact('modules'));
    }

    public function addModuleSinceFile(Request $request)
    {
        // Validation de la requête
        $request->validate([
            'file' => 'required|file|mimes:pdf,txt',
        ]);

        $file = $request->file('file');

        // On extrait le contenu du fichier
        if ($file->getClientOriginalExtension() === 'pdf') {
            $parser = new Parser();
            $pdf    = $parser->parseFile($file->getPathname());
            $content = $pdf->getText();
        } else {
            $content = file_get_contents($file->getRealPath());
        }

        // Expression régulière pour extraire les modules sans erreurs
        $pattern = '/\d+\.\s*Nom\s*:\s*(.*?)\s*Description\s*:\s*(.*?)(?=\d+\.\s*Nom\s*:|$)/s';
        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        $skippedModules = []; // tableau pour stocker les noms déjà existants

        // On parcourt chaque module trouvé
        foreach ($matches as $match) {
            $name = trim($match[1]);
            $description = trim($match[2]);

            // On vérifie si un module avec ce nom existe déjà
            if (Module::where('name', $name)->exists()) {
                $skippedModules[] = $name; // on enregistre le nom du module en doublon
                continue;
            }

            // Enregistrement du module
            Module::create([
                'name'        => $name,
                'description' => $description,
                'date_add'    => now(),
                'starting'    => 1,
            ]);
        }

        // Préparation du message de retour
        $message = 'Modules ajoutés avec succès.';
        if (!empty($skippedModules)) {
            $message .= ' Les modules suivants existent déjà et n\'ont pas été ajoutés : ' . implode(', ', $skippedModules) . '.';
        }

        // Enregistrement de l'action dans l'historique des utilisateurs
        HistoriqueUsers::create([
            'user_id'    => auth()->id(),
            'action'     => "a ajouté un ou des nouveaux modules avec Agro Intelligence",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('warning', $message);
    }
}
