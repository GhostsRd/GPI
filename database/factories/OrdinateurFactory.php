<?php
// database/factories/OrdinateurFactory.php

namespace Database\Factories;

use App\Models\Ordinateur;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdinateurFactory extends Factory
{
    protected $model = Ordinateur::class;

    public function definition()
    {
        $fabricants = ['Dell', 'HP', 'Lenovo', 'Apple', 'Asus', 'Acer', 'MSI'];
        $statuts = ['En service', 'En stock', 'Hors service', 'En réparation'];
        $entites = ['IT Department', 'Marketing', 'Finance', 'RH', 'Production', 'Commercial'];
        $sous_entites = ['Équipe A', 'Équipe B', 'Équipe C', 'Équipe D'];
        $os_versions = ['Windows 11 Pro', 'Windows 10 Pro', 'macOS Ventura', 'Ubuntu 22.04', 'Windows Server 2022'];

        return [
            'nom' => 'PC-' . $this->faker->unique()->bothify('??-##'),
            'entite' => $this->faker->randomElement($entites),
            'sous_entite' => $this->faker->randomElement($sous_entites),
            'statut' => $this->faker->randomElement($statuts),
            'fabricant' => $this->faker->randomElement($fabricants),
            'modele' => $this->faker->randomElement(['Latitude', 'EliteBook', 'ThinkPad', 'MacBook Pro', 'ZenBook']),
            'numero_serie' => $this->faker->unique()->bothify('SN??#######'),
            'utilisateur_id' => User::inRandomOrder()->first()?->id,
            'usager_id' => $this->faker->boolean(30) ? User::inRandomOrder()->first()?->id : null,
            'date_dernier_inventaire' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'assistance_tickets' => $this->faker->numberBetween(0, 10),
            'reseau_ip' => $this->faker->unique()->ipv4,
            'disque_dur' => $this->faker->randomElement(['256 Go SSD', '512 Go SSD', '1 To HDD', '1 To SSD', '2 To HDD']),
            'os_version' => $this->faker->randomElement($os_versions),
            'os_noyau' => $this->faker->randomElement(['10.0.19045', '10.0.22621', '22.04.1', '13.0.1']),
            'derniere_date_demarrage' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'notes' => $this->faker->boolean(20) ? $this->faker->sentence() : null,
        ];
    }
}
