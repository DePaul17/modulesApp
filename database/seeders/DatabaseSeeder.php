<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //ADMINISTRATEUR
        User::factory()->create([
            'name' => 'Admin AgroPro',
            'email' => 'root@agropro.com',
            'password' => Hash::make('root'),
            'role' => 1, // Un utilisateur admin
        ]);

        //USER
        User::factory()->create([
            'name' => 'De Paul MOUYABI',
            'email' => 'guy-vincent-de-paul.mouyabi@mediaschool.me',
            'password' => Hash::make('passer123'),
            'role' => 2, // Un utilisateur classique (non-admin)
        ]);
    }
}
