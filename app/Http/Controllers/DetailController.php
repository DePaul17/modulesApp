<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail;
use App\Models\Module;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{   
    public function updateDetails() {
        // On récupère tous les détails
        $details = Detail::all();
    
        // On parcourt chaque détail
        foreach ($details as $detail) {
            // On récupère le module associé à ce détail
            $module = Module::find($detail->module_id);
    
            // On vérifie si le module existe et si starting == 1
            if ($module && $module->starting == 2) {
                // On met à jour les champs spécifiés
                $detail->duration_operation = mt_rand(1, 500);
                $detail->number_data_sent = mt_rand(1, 1000);
                $detail->temperature = mt_rand(-10, 99);
                $detail->speed = mt_rand(0, 100);
    
                // On vérifie si la vitesse est égale à zéro
                if ($detail->speed == 0) {
                    // Si la vitesse est égale à zéro, définir l'état du module sur 2. Module en panne.
                    $detail->module_state = 2;
    
                    // On met à jour le champ "starting" du module à 1
                    $module->starting = 1;
                    $module->save();
                }
    
                // On sauvegarde les modifications dans la base de données pour cet enregistrement
                $detail->save();
            }
        }
    
        return redirect()->back()->with('success', 'Détails mis à jour avec succès!');
    }          

    public function afficherGraphique($moduleId) {
        $module = Module::find($moduleId);
        if (!$module) {
            abort(404, 'Module non trouvé.');
        }
    
        $details = Detail::where('module_id', $moduleId)->get();
        $labels = $details->pluck('number_data_sent');
        $values = $details->pluck('number_data_sent'); 
    
        return view('user.ui-chart', [
            'labels' => $labels,
            'values' => $values,
            'module' => $module 
        ]);
    }        
}
