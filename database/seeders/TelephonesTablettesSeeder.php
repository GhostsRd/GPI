<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TelephonesTablettesSeeder extends Seeder
{
    /**
     * Exécuter le seeder
     */
    public function run(): void
    {
        $telephones = [
            // Téléphones en service
            [
                'nom' => 'iPhone 13 Pro - Direction',
                'entite' => 'Direction Générale',
                'usager' => 'Pierre Martin',
                'lieu' => 'Siège Social - Bureau 301',
                'services' => 'Communication direction, appels clients importants',
                'type' => 'Téléphone',
                'marque' => 'Apple',
                'modele' => 'iPhone 13 Pro',
                'numero_serie' => 'SNIP13P001',
                'statut' => 'En service',
                'emplacement_actuel' => 'Bureau 301 - Direction',
                'imei' => '356789012345678',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Samsung Galaxy S22 - Commercial',
                'entite' => 'Service Commercial',
                'usager' => 'Marie Dubois',
                'lieu' => 'Service Commercial - Bureau 205',
                'services' => 'Prospection clients, déplacements commerciaux',
                'type' => 'Téléphone',
                'marque' => 'Samsung',
                'modele' => 'Galaxy S22',
                'numero_serie' => 'SNGS22C001',
                'statut' => 'En service',
                'emplacement_actuel' => 'Bureau 205 - Commercial',
                'imei' => '356789012345679',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Google Pixel 7 - IT',
                'entite' => 'Service Informatique',
                'usager' => 'Thomas Leroy',
                'lieu' => 'Service IT - Bureau 110',
                'services' => 'Support technique, interventions terrain',
                'type' => 'Téléphone',
                'marque' => 'Google',
                'modele' => 'Pixel 7',
                'numero_serie' => 'SNGP7IT001',
                'statut' => 'En service',
                'emplacement_actuel' => 'Bureau 110 - IT',
                'imei' => '356789012345680',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Téléphones en stock
            [
                'nom' => 'iPhone 14 - Stock',
                'entite' => null,
                'usager' => null,
                'lieu' => 'Réserve IT',
                'services' => 'Équipement de remplacement',
                'type' => 'Téléphone',
                'marque' => 'Apple',
                'modele' => 'iPhone 14',
                'numero_serie' => 'SNIP14S001',
                'statut' => 'En stock',
                'emplacement_actuel' => 'Armoire stockage - Réserve',
                'imei' => '356789012345681',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Samsung A54 - Stock',
                'entite' => null,
                'usager' => null,
                'lieu' => 'Réserve IT',
                'services' => 'Équipement nouveau collaborateur',
                'type' => 'Téléphone',
                'marque' => 'Samsung',
                'modele' => 'Galaxy A54',
                'numero_serie' => 'SNGA54S001',
                'statut' => 'En stock',
                'emplacement_actuel' => 'Armoire stockage - Réserve',
                'imei' => '356789012345682',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Téléphones en réparation
            [
                'nom' => 'iPhone 12 - En réparation',
                'entite' => 'Service Marketing',
                'usager' => 'Sophie Bernard',
                'lieu' => 'Atelier réparation externe',
                'services' => 'Écran cassé - En réparation',
                'type' => 'Téléphone',
                'marque' => 'Apple',
                'modele' => 'iPhone 12',
                'numero_serie' => 'SNIP12R001',
                'statut' => 'En réparation',
                'emplacement_actuel' => 'SAV Partenaire - Paris',
                'imei' => '356789012345683',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Téléphones hors service
            [
                'nom' => 'Samsung S10 - Hors service',
                'entite' => 'Ancien équipement',
                'usager' => null,
                'lieu' => 'Stockage archives',
                'services' => 'Équipement obsolète',
                'type' => 'Téléphone',
                'marque' => 'Samsung',
                'modele' => 'Galaxy S10',
                'numero_serie' => 'SNGS10H001',
                'statut' => 'Hors service',
                'emplacement_actuel' => 'Local archives - Sous-sol',
                'imei' => '356789012345684',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            // Tablettes
            [
                'nom' => 'iPad Air - Présentation',
                'entite' => 'Service Commercial',
                'usager' => 'Équipe Commerciale',
                'lieu' => 'Salle de réunion',
                'services' => 'Présentations clients, démonstrations',
                'type' => 'Tablette',
                'marque' => 'Apple',
                'modele' => 'iPad Air',
                'numero_serie' => 'SNIPADA001',
                'statut' => 'En service',
                'emplacement_actuel' => 'Salle réunion 1',
                'imei' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Samsung Tab S8 - Réunion',
                'entite' => 'Direction',
                'usager' => 'Comité de Direction',
                'lieu' => 'Salle du Conseil',
                'services' => 'Consultation documents, réunions',
                'type' => 'Tablette',
                'marque' => 'Samsung',
                'modele' => 'Galaxy Tab S8',
                'numero_serie' => 'SNGTS8D001',
                'statut' => 'En service',
                'emplacement_actuel' => 'Salle Conseil',
                'imei' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nom' => 'Lenovo Tab P11 - Stock',
                'entite' => null,
                'usager' => null,
                'lieu' => 'Réserve IT',
                'services' => 'Équipement de remplacement',
                'type' => 'Tablette',
                'marque' => 'Lenovo',
                'modele' => 'Tab P11',
                'numero_serie' => 'SNLTP11S001',
                'statut' => 'En stock',
                'emplacement_actuel' => 'Armoire stockage - Réserve',
                'imei' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        // Insérer les données
        DB::table('telephones_tablettes')->insert($telephones);

        $this->command->info(count($telephones) . ' équipements téléphones/tablettes créés avec succès.');
    }
}