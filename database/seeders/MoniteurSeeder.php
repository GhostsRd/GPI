<?php
// database/seeders/MoniteurSeeder.php

namespace Database\Seeders;

use App\Models\Moniteur;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MoniteurSeeder extends Seeder
{
    public function run()
    {
        // Créer quelques utilisateurs si nécessaire
        $users = User::factory(15)->create();

        $fabricants = ['Dell', 'Samsung', 'LG', 'HP', 'Acer', 'ASUS', 'BenQ', 'ViewSonic', 'Philips', 'AOC'];
        $types = ['LCD', 'LED', '4K', 'Ultra HD', 'IPS', 'TN', 'VA', 'Curved'];
        $entites = ['Informatique', 'Ressources Humaines', 'Comptabilité', 'Direction', 'Marketing', 'Production', 'Commercial', 'Support Technique'];
        $modeles = [
            'Dell' => ['P2419H', 'U2419H', 'P2719H', 'U2720Q', 'S2721DS'],
            'Samsung' => ['S24F350', 'S27R350', 'C24F390', 'U28R550', 'Odyssey G5'],
            'LG' => ['24MK400H', '27GN800-B', '32UN500-W', 'UltraGear 27GL83A'],
            'HP' => ['24mh', '27xq', 'P24h G4', 'Z27k G3'],
            'Acer' => ['Nitro VG240Y', 'Predator XB273U', 'R240HY'],
            'ASUS' => ['VG245H', 'TUF Gaming VG259Q', 'ProArt PA278QV'],
            'BenQ' => ['GW2283', 'GL2580H', 'PD2700U'],
            'ViewSonic' => ['VA2456-MHD', 'VX2758-2KP-MHD', 'XG2405'],
            'Philips' => ['241V8L', '275E1S', '329P1H'],
            'AOC' => ['24B2XH', '27G2U', 'CQ32G1']
        ];

        $statuts = ['En service', 'En stock', 'Hors service', 'En réparation'];

        // Probabilités pour les statuts (plus d'équipements en service)
        $statutWeights = [60, 25, 10, 5]; // 60% En service, 25% En stock, etc.

        for ($i = 1; $i <= 100; $i++) {
            $fabricant = $fabricants[array_rand($fabricants)];
            $modele = $modeles[$fabricant][array_rand($modeles[$fabricant])];
            $entite = $entites[array_rand($entites)];

            // Génération du statut avec probabilités
            $statut = $this->getWeightedRandom($statuts, $statutWeights);

            // Déterminer si attribué à un utilisateur
            $utilisateurId = null;
            $usagerId = null;

            if ($statut === 'En service' && rand(0, 100) > 30) { // 70% des moniteurs en service sont attribués
                $utilisateurId = $users->random()->id;

                // 20% des cas où l'usager est différent de l'utilisateur
                if (rand(0, 100) > 80) {
                    $usagerId = $users->where('id', '!=', $utilisateurId)->random()->id;
                }
            }

            Moniteur::create([
                'nom' => 'MON-' . strtoupper(Str::slug($entite)) . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'entite' => $entite,
                'statut' => $statut,
                'fabricant' => $fabricant,
                'numero_serie' => 'SN' . str_pad($i, 6, '0', STR_PAD_LEFT) . strtoupper(Str::random(3)),
                'utilisateur_id' => $utilisateurId,
                'usager_id' => $usagerId,
                'lieu' => $this->generateLieu($entite),
                'type' => $types[array_rand($types)],
                'modele' => $modele,
                'commentaires' => $this->generateCommentaires($statut),
                'created_at' => now()->subDays(rand(1, 365)),
                'updated_at' => now()->subDays(rand(0, 30)),
            ]);
        }

        $this->command->info('100 moniteurs de test créés avec succès!');
    }

    /**
     * Générer un lieu réaliste selon l'entité
     */
    private function generateLieu($entite)
    {
        $lieux = [
            'Informatique' => ['Bureau IT 101', 'Salle Serveurs', 'Lab Informatique', 'Bureau Support'],
            'Ressources Humaines' => ['Bureau RH 201', 'Salle Réunion RH', 'Accueil'],
            'Comptabilité' => ['Bureau Compta 301', 'Archives Comptables'],
            'Direction' => ['Bureau Directeur', 'Salle Conseil', 'Bureau DG'],
            'Marketing' => ['Bureau Marketing 401', 'Salle Créative', 'Espace Présentation'],
            'Production' => ['Atelier A', 'Ligne Production 1', 'Zone Assemblage'],
            'Commercial' => ['Bureau Commercial 501', 'Salle Ventes', 'Espace Client'],
            'Support Technique' => ['Bureau Support 601', 'Hotline', 'Lab Réparation']
        ];

        $entiteLieus = $lieux[$entite] ?? ['Bureau ' . rand(100, 600)];
        return $entiteLieus[array_rand($entiteLieus)];
    }

    /**
     * Générer des commentaires réalistes selon le statut
     */
    private function generateCommentaires($statut)
    {
        $commentaires = [
            'En service' => [
                'Bon état', 'Fonctionne parfaitement', 'Nouveau', 'Installé récemment',
                'Écran en excellent état', 'Couleurs fidèles', 'Aucun pixel mort',
                'Utilisé quotidiennement', 'Performance optimale'
            ],
            'En stock' => [
                'Neuf dans emballage', 'En attente d\'affectation', 'Stock central',
                'Réserve disponible', 'À vérifier avant utilisation', 'Garantie active'
            ],
            'Hors service' => [
                'Écran fissuré', 'Problème d\'alimentation', 'Pixels morts nombreux',
                'Couleurs délavées', 'À recycler', 'Panne irréparable', 'Obsolète'
            ],
            'En réparation' => [
                'En cours de diagnostic', 'Changement rétroéclairage', 'Réparation garantie',
                'En attente de pièces', 'Contrôle qualité en cours', 'Réparation écran'
            ]
        ];

        return rand(0, 100) > 40 ? $commentaires[$statut][array_rand($commentaires[$statut])] : null;
    }

    /**
     * Sélection aléatoire avec probabilités
     */
    private function getWeightedRandom($items, $weights)
    {
        $totalWeight = array_sum($weights);
        $random = rand(1, $totalWeight);
        $currentWeight = 0;

        foreach ($items as $index => $item) {
            $currentWeight += $weights[$index];
            if ($random <= $currentWeight) {
                return $item;
            }
        }

        return $items[0];
    }
}
