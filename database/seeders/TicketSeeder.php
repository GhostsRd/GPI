<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\utilisateur;
use App\Models\ticket;
use App\Models\User;

use Faker\Factory as Faker;


class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ticket $ticket)
    {
        $faker = Faker::create();

        // Récupérer tous les utilisateurs pour assigner un ticket aléatoire
        $users = utilisateur::all()->pluck('id')->toArray();
        $responsable = User::all()->pluck('id')->toArray();
        

        // Générer 50 tickets
        for ($i = 0; $i < 50; $i++) {
            $ticket = new Ticket();
            $ticket->sujet = $faker->sentence(5);
            $ticket->details = $faker->paragraph(1);
            $ticket->utilisateur_id = $faker->randomElement($users); 
            $ticket->responsable_id = $faker->randomElement($responsable); // assigner un utilisateur aléatoire
            // assigner un utilisateur aléatoire
            $ticket->equipement = $faker->randomElement(['PC','Imprimante','Serveur','Switch','Routeur']);
            $ticket->categorie = $faker->randomElement(['Réseau','Logiciel','Matériel','Sécurité','Autre']);
            $ticket->impact = $faker->randomElement(['Utilisateur','Service','Organisation']);
            $ticket->state = 2;
            $ticket->status = "en attente";
            $ticket->archive = false;
            $ticket->priorite = $faker->boolean(30); // 30% de chance que ce soit vrai
            $ticket->save();
        }
}
}