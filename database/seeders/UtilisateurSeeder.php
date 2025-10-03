<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\utilisateur;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Générer 20 utilisateurs
        for ($i = 0; $i < 20; $i++) {
            utilisateur::create([
                'matricule'       => $faker->unique()->numberBetween(1000, 9999),
                'nom'             => $faker->name,
                'poste'           => $faker->jobTitle,
                'departement'     => $faker->randomElement(['IT','Finance','RH','Marketing','Support']),
                'lieu_affectation'=> $faker->city,
                'photo'           => null,
                'sexe'            => $faker->randomElement(['Homme','Femme']),
                'date_naissance'  => $faker->date('Y-m-d', '2000-01-01'),
                'date_embauche'   => $faker->date('Y-m-d', '2024-01-01'),
                'adresse'         => $faker->address,
                'email'           => $faker->unique()->safeEmail,
                'telephone'       => $faker->unique()->phoneNumber,
                'password'        => Hash::make('12345678'), // mot de passe par défaut
                'role'            => 'user',
            ]);
        }
    }
}
