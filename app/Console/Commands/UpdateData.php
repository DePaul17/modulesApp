<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Detail;

class UpdateData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update module data';

    /**
     * Execute the console command.
     */
    public function handle() {
        // Récupérer tous les détails de la base de données
        //$details = Detail::all();

        // Parcourir les détails et mettre à jour les informations
        //foreach ($details as $detail) {
            // Attribuer des valeurs aléatoires aux champs spécifiés
            //$detail->duration_operation = mt_rand(1, 500);
            //$detail->number_data_sent = mt_rand(1, 1000);
            //$detail->temperature = mt_rand(-10, 99);
            //$detail->speed = mt_rand(0, 100);

            // Vérifier si la vitesse est égale à zéro
            //if ($detail->speed == 0) {
                // Si la vitesse est égale à zéro, définir l'état du module sur 2 (module en panne)
                //$detail->module_state = 2;
            //}

            // Sauvegarder les modifications dans la base de données pour cet enregistrement
            //$detail->save();
    }

        //$this->info('Informations mises à jour avec succès.');
}
