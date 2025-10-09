<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LogicielFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $editeurs = ['Microsoft', 'Adobe', 'Google', 'Mozilla', 'JetBrains', 'Oracle', 'Apple', 'Slack', 'Zoom', 'Autodesk'];
        $systemes = ['Windows', 'macOS', 'Linux', 'Windows/macOS', 'Multiplateforme'];
        $logiciels = [
            ['nom' => 'Microsoft Office', 'version' => '2021'],
            ['nom' => 'Adobe Photoshop', 'version' => 'CC 2024'],
            ['nom' => 'Google Chrome', 'version' => '119'],
            ['nom' => 'Mozilla Firefox', 'version' => '120'],
            ['nom' => 'Visual Studio Code', 'version' => '1.84'],
            ['nom' => 'IntelliJ IDEA', 'version' => '2023.3'],
            ['nom' => 'Oracle Java', 'version' => '21'],
            ['nom' => 'Slack', 'version' => '4.32'],
            ['nom' => 'Zoom', 'version' => '5.17'],
            ['nom' => 'AutoCAD', 'version' => '2024'],
            ['nom' => 'Microsoft Teams', 'version' => '1.7'],
            ['nom' => 'Adobe Acrobat', 'version' => 'DC'],
            ['nom' => 'MySQL Workbench', 'version' => '8.0'],
            ['nom' => 'Postman', 'version' => '10.0'],
            ['nom' => 'Git', 'version' => '2.43'],
        ];

        $logiciel = $this->faker->randomElement($logiciels);
        $editeur = $this->getEditeurForLogiciel($logiciel['nom']);

        return [
            'nom' => $logiciel['nom'],
            'editeur' => $editeur,
            'version_nom' => $logiciel['version'],
            'version_systeme_exploitation' => $this->faker->randomElement($systemes),
            'nombre_installations' => $this->faker->numberBetween(0, 100),
            'nombre_licences' => $this->faker->numberBetween(0, 120),
            'description' => $this->faker->optional(0.8)->sentence(10),
            'date_achat' => $this->faker->optional(0.7)->dateTimeBetween('-2 years', 'now'),
            'date_expiration' => $this->faker->optional(0.6)->dateTimeBetween('now', '+2 years'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    /**
     * État pour les logiciels avec licences critiques
     */
    public function licencesCritiques(): static
    {
        return $this->state(function (array $attributes) {
            $installations = $this->faker->numberBetween(90, 120);
            $licences = $this->faker->numberBetween(80, 100);
            
            return [
                'nombre_installations' => $installations,
                'nombre_licences' => $licences,
            ];
        });
    }

    /**
     * État pour les logiciels sans licences
     */
    public function sansLicences(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'nombre_licences' => 0,
                'nombre_installations' => $this->faker->numberBetween(10, 50),
            ];
        });
    }

    /**
     * État pour les logiciels avec beaucoup de licences disponibles
     */
    public function licencesDisponibles(): static
    {
        return $this->state(function (array $attributes) {
            $licences = $this->faker->numberBetween(50, 100);
            
            return [
                'nombre_licences' => $licences,
                'nombre_installations' => $this->faker->numberBetween(0, $licences * 0.5),
            ];
        });
    }

    /**
     * État pour les logiciels expirés
     */
    public function expire(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'date_expiration' => $this->faker->dateTimeBetween('-1 year', '-1 day'),
            ];
        });
    }

    /**
     * État pour les logiciels gratuits
     */
    public function gratuit(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'nombre_licences' => 0,
                'date_achat' => null,
                'date_expiration' => null,
            ];
        });
    }

    /**
     * Get the appropriate editor for a software
     */
    private function getEditeurForLogiciel(string $logicielNom): string
    {
        $editeursMap = [
            'Microsoft Office' => 'Microsoft',
            'Microsoft Teams' => 'Microsoft',
            'Visual Studio Code' => 'Microsoft',
            'Adobe Photoshop' => 'Adobe',
            'Adobe Acrobat' => 'Adobe',
            'Google Chrome' => 'Google',
            'Mozilla Firefox' => 'Mozilla',
            'IntelliJ IDEA' => 'JetBrains',
            'Oracle Java' => 'Oracle',
            'Slack' => 'Slack Technologies',
            'Zoom' => 'Zoom Video Communications',
            'AutoCAD' => 'Autodesk',
            'MySQL Workbench' => 'Oracle',
            'Postman' => 'Postman',
            'Git' => 'Git Foundation',
        ];

        return $editeursMap[$logicielNom] ?? $this->faker->randomElement(['Microsoft', 'Adobe', 'Google', 'Mozilla']);
    }
}