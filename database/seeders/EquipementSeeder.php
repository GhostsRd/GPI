<<?php

namespace Database\Seeders;

use App\Models\Equipement;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EquipementSeeder extends Seeder
{
    public function run()
    {
        $equipements = [
            // IMPRIMANTES
            [
                'identification' => 'IMP-001',
                'nom_public' => 'Imprimante Bureau Direction',
                'emplacement' => 'Bureau Direction',
                'marque' => 'HP',
                'model' => 'LaserJet Pro M404dn',
                'type' => 'Imprimante',
                'numero_serie' => 'CNB8C3D1K7',
                'couleur' => 'noir',
                'technologie_impression' => 'laser',
                'reference_cartouche' => 'HP 83A',
                'date_entree_stock' => Carbon::now()->subMonths(6),
                'adresse_ip' => '192.168.1.100',
                'statut' => 'en_stock',
                'description' => 'Imprimante laser monochrome haute capacité'
            ],
            [
                'identification' => 'IMP-002',
                'nom_public' => 'Imprimante Comptabilité',
                'emplacement' => 'Service Comptabilité',
                'marque' => 'Canon',
                'model' => 'imageRUNNER 2204',
                'type' => 'Imprimante',
                'numero_serie' => 'CNJ7H4F2M9',
                'couleur' => 'blanc',
                'technologie_impression' => 'laser',
                'reference_cartouche' => 'Canon 125',
                'date_entree_stock' => Carbon::now()->subMonths(3),
                'adresse_ip' => '192.168.1.101',
                'statut' => 'en_pret',
                'description' => 'Imprimante réseau pour service comptable'
            ],
            [
                'identification' => 'IMP-003',
                'nom_public' => 'Imprimante Couleur Marketing',
                'emplacement' => 'Service Marketing',
                'marque' => 'Epson',
                'model' => 'WorkForce WF-7820',
                'type' => 'Imprimante',
                'numero_serie' => 'CNK5D8G3L2',
                'couleur' => 'noir',
                'technologie_impression' => 'jet encre',
                'reference_cartouche' => 'Epson 212',
                'date_entree_stock' => Carbon::now()->subMonths(2),
                'adresse_ip' => '192.168.1.102',
                'statut' => 'en_maintenance',
                'description' => 'Imprimante couleur format A3 - En révision technique'
            ],

            // ORDINATEURS
            [
                'identification' => 'ORD-001',
                'nom_public' => 'PC Directeur Général',
                'emplacement' => 'Bureau DG',
                'marque' => 'Dell',
                'model' => 'OptiPlex 7080',
                'type' => 'Ordinateur',
                'numero_serie' => 'SNDL845J9K3L',
                'couleur' => 'noir',
                'technologie_impression' => null,
                'reference_cartouche' => null,
                'date_entree_stock' => Carbon::now()->subMonths(8),
                'adresse_ip' => '192.168.1.10',
                'statut' => 'en_stock',
                'description' => 'Station de travail haute performance'
            ],
            [
                'identification' => 'ORD-002',
                'nom_public' => 'PC Développeur',
                'emplacement' => 'Open Space IT',
                'marque' => 'HP',
                'model' => 'EliteDesk 800 G6',
                'type' => 'Ordinateur',
                'numero_serie' => 'SNHP7M2N4P6Q',
                'couleur' => 'gris',
                'technologie_impression' => null,
                'reference_cartouche' => null,
                'date_entree_stock' => Carbon::now()->subMonths(1),
                'adresse_ip' => '192.168.1.11',
                'statut' => 'en_pret',
                'description' => 'PC développement - 16GB RAM - SSD 512GB'
            ],
            [
                'identification' => 'ORD-003',
                'nom_public' => 'PC Réception',
                'emplacement' => 'Accueil',
                'marque' => 'Lenovo',
                'model' => 'ThinkCentre M75s',
                'type' => 'Ordinateur',
                'numero_serie' => 'SNLV3B8C1D9F',
                'couleur' => 'noir',
                'technologie_impression' => null,
                'reference_cartouche' => null,
                'date_entree_stock' => Carbon::now()->subWeeks(2),
                'adresse_ip' => '192.168.1.12',
                'statut' => 'en_maintenance',
                'description' => 'PC accueil - écran cassé à remplacer'
            ],

            // SCANNERS
            [
                'identification' => 'SCN-001',
                'nom_public' => 'Scanner Archives',
                'emplacement' => 'Service Archives',
                'marque' => 'Fujitsu',
                'model' => 'ScanSnap iX1500',
                'type' => 'Scanner',
                'numero_serie' => 'SNFJ5H7J3K8L',
                'couleur' => 'blanc',
                'technologie_impression' => null,
                'reference_cartouche' => null,
                'date_entree_stock' => Carbon::now()->subMonths(4),
                'adresse_ip' => null,
                'statut' => 'en_stock',
                'description' => 'Scanner document double flux'
            ],
            [
                'identification' => 'SCN-002',
                'nom_public' => 'Scanner Comptabilité',
                'emplacement' => 'Comptabilité',
                'marque' => 'Canon',
                'model' => 'DR-C240',
                'type' => 'Scanner',
                'numero_serie' => 'SNCN9M2B4V6C',
                'couleur' => 'gris',
                'technologie_impression' => null,
                'reference_cartouche' => null,
                'date_entree_stock' => Carbon::now()->subMonths(5),
                'adresse_ip' => null,
                'statut' => 'en_pret',
                'description' => 'Scanner à défilement pour factures'
            ],

            // ÉQUIPEMENTS RÉSEAU
            [
                'identification' => 'RES-001',
                'nom_public' => 'Switch Principal',
                'emplacement' => 'Local Serveurs',
                'marque' => 'Cisco',
                'model' => 'Catalyst 2960X',
                'type' => 'Réseau',
                'numero_serie' => 'SNCS2K8L4P9M',
                'couleur' => 'noir',
                'technologie_impression' => null,
                'reference_cartouche' => null,
                'date_entree_stock' => Carbon::now()->subYears(1),
                'adresse_ip' => '192.168.1.1',
                'statut' => 'en_stock',
                'description' => 'Switch 48 ports Gigabit Ethernet'
            ],
            [
                'identification' => 'RES-002',
                'nom_public' => 'Routeur Filiale',
                'emplacement' => 'Filiale Paris',
                'marque' => 'Ubiquiti',
                'model' => 'EdgeRouter X',
                'type' => 'Réseau',
                'numero_serie' => 'SNUB7N3M1K5J',
                'couleur' => 'blanc',
                'technologie_impression' => null,
                'reference_cartouche' => null,
                'date_entree_stock' => Carbon::now()->subMonths(2),
                'adresse_ip' => '192.168.2.1',
                'statut' => 'en_maintenance',
                'description' => 'Routeur pour site distant - Configuration nécessaire'
            ],

            // PÉRIPHÉRIQUES DIVERS
            [
                'identification' => 'PER-001',
                'nom_public' => 'Écran Réunion',
                'emplacement' => 'Salle Réunion A',
                'marque' => 'Samsung',
                'model' => 'UR55 Series',
                'type' => 'Écran',
                'numero_serie' => 'SNSS8J2H4G6F',
                'couleur' => 'noir',
                'technologie_impression' => null,
                'reference_cartouche' => null,
                'date_entree_stock' => Carbon::now()->subMonths(3),
                'adresse_ip' => null,
                'statut' => 'en_stock',
                'description' => 'Écran 28" 4K UHD pour présentation'
            ],
            [
                'identification' => 'PER-002',
                'nom_public' => 'Vidéoprojecteur',
                'emplacement' => 'Salle Conférence',
                'marque' => 'Epson',
                'model' => 'EB-U05',
                'type' => 'Projecteur',
                'numero_serie' => 'SNEP5K9L3M7N',
                'couleur' => 'blanc',
                'technologie_impression' => null,
                'reference_cartouche' => null,
                'date_entree_stock' => Carbon::now()->subMonths(7),
                'adresse_ip' => null,
                'statut' => 'en_pret',
                'description' => 'Vidéoprojecteur 3LCD 3300 lumens'
            ],
            [
                'identification' => 'PER-003',
                'nom_public' => 'Tablette Graphique',
                'emplacement' => 'Service Design',
                'marque' => 'Wacom',
                'model' => 'Intuos Pro',
                'type' => 'Périphérique',
                'numero_serie' => 'SNWC4M8P2L6K',
                'couleur' => 'noir',
                'technologie_impression' => null,
                'reference_cartouche' => null,
                'date_entree_stock' => Carbon::now()->subWeeks(1),
                'adresse_ip' => null,
                'statut' => 'en_stock',
                'description' => 'Tablette graphique format moyen'
            ]
        ];

        foreach ($equipements as $equipement) {
            Equipement::create($equipement);
        }

        $this->command->info(count($equipements) . ' équipements de test créés avec succès!');
        $this->command->info('Répartition des statuts:');
        $this->command->info('- En stock: ' . Equipement::where('statut', 'en_stock')->count());
        $this->command->info('- En prêt: ' . Equipement::where('statut', 'en_pret')->count());
        $this->command->info('- En maintenance: ' . Equipement::where('statut', 'en_maintenance')->count());
    }
}
