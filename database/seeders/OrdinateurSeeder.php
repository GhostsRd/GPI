<?php
// database/seeders/OrdinateurSeeder.php

namespace Database\Seeders;

use App\Models\Ordinateur;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrdinateurSeeder extends Seeder
{
    public function run(): void
    {
        // Créer d'abord quelques utilisateurs si nécessaire
        if (User::count() === 0) {
            User::factory()->count(10)->create();
        }

        // Créer 50 ordinateurs de test
        Ordinateur::factory()->count(10)->create();

        $this->command->info('10 ordinateurs de test créés avec succès!');
    }
}
