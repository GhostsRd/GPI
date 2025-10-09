<?php
// database/factories/MoniteurFactory.php

namespace Database\Factories;

use App\Models\Moniteur;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MoniteurFactory extends Factory
{
    protected $model = Moniteur::class;

    public function definition()
    {
        $fabricants = ['Dell', 'Samsung', 'LG', 'HP', 'Acer', 'ASUS', 'BenQ', 'ViewSonic'];
        $types = ['LCD', 'LED', '4K', 'Ultra HD', 'IPS', 'TN'];
        $entites = ['Informatique', 'RH', 'Comptabilité', 'Direction', 'Marketing'];

        $fabricant = $this->faker->randomElement($fabricants);

        return [
            'nom' => 'MON-' . strtoupper($this->faker->randomElement($entites)) . '-' . $this->faker->unique()->numberBetween(100, 999),
            'entite' => $this->faker->randomElement($entites),
            'statut' => $this->faker->randomElement(['En service', 'En stock', 'Hors service', 'En réparation']),
            'fabricant' => $fabricant,
            'numero_serie' => 'SN' . $this->faker->unique()->numberBetween(100000, 999999) . $this->faker->randomLetter(),
            'utilisateur_id' => User::inRandomOrder()->first()?->id,
            'usager_id' => $this->faker->optional(0.2)->passthrough(User::inRandomOrder()->first()?->id),
            'lieu' => 'Bureau ' . $this->faker->numberBetween(100, 500),
            'type' => $this->faker->randomElement($types),
            'modele' => $fabricant . ' ' . $this->faker->randomElement(['Pro', 'Ultra', 'Basic', 'Gaming']) . ' ' . $this->faker->numberBetween(100, 5000),
            'commentaires' => $this->faker->optional(0.7)->sentence(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }

    /**
     * État pour moniteurs en service
     */
    public function enService()
    {
        return $this->state(function (array $attributes) {
            return [
                'statut' => 'En service',
                'utilisateur_id' => User::inRandomOrder()->first()?->id,
            ];
        });
    }

    /**
     * État pour moniteurs en stock
     */
    public function enStock()
    {
        return $this->state(function (array $attributes) {
            return [
                'statut' => 'En stock',
                'utilisateur_id' => null,
                'usager_id' => null,
            ];
        });
    }

    /**
     * État pour moniteurs hors service
     */
    public function horsService()
    {
        return $this->state(function (array $attributes) {
            return [
                'statut' => 'Hors service',
                'commentaires' => $this->faker->randomElement(['Écran cassé', 'Problème d\'alimentation', 'Pixels morts']),
            ];
        });
    }
}
