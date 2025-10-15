<?php
// database/seeders/ImprimanteSeeder.php

namespace Database\Seeders;

use App\Models\Imprimante;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ImprimanteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $imprimantes = [
            // Informatique - En service
            [
                'nom' => 'IMP-IT-001',
                'entite' => 'Informatique',
                'statut' => 'En service',
                'fabricant' => 'HP',
                'reseau_ip' => '192.168.1.50',
                'numero_serie' => 'SNHP123456789',
                'lieu' => 'Salle Serveur Bâtiment A',
                'type' => 'Laser',
                'modele' => 'LaserJet Pro M404dn',
                'description' => 'Imprimante laser réseau haute capacité pour le service informatique',
                'date_achat' => Carbon::now()->subYears(2),
                'date_installation' => Carbon::now()->subYears(2),
                'date_garantie' => Carbon::now()->addMonths(6),
                'created_at' => Carbon::now()->subYears(2),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'nom' => 'IMP-IT-002',
                'entite' => 'Informatique',
                'statut' => 'En service',
                'fabricant' => 'Canon',
                'reseau_ip' => '192.168.1.51',
                'numero_serie' => 'SNCA987654321',
                'lieu' => 'Bureau Support IT',
                'type' => 'Multifonction',
                'modele' => 'imageRUNNER ADVANCE C3530i',
                'description' => 'Imprimante multifonction couleur pour impressions techniques',
                'date_achat' => Carbon::now()->subYear(),
                'date_installation' => Carbon::now()->subYear(),
                'date_garantie' => Carbon::now()->addYear(),
                'created_at' => Carbon::now()->subYear(),
                'updated_at' => Carbon::now()->subDays(3),
            ],

            // Ressources Humaines
            [
                'nom' => 'IMP-RH-001',
                'entite' => 'Ressources Humaines',
                'statut' => 'En service',
                'fabricant' => 'Brother',
                'reseau_ip' => '192.168.1.60',
                'numero_serie' => 'SNBR111222333',
                'lieu' => 'Bureau RH 201',
                'type' => 'Laser',
                'modele' => 'HL-L8360CDW',
                'description' => 'Imprimante laser couleur pour documents RH confidentiels',
                'date_achat' => Carbon::now()->subMonths(18),
                'date_installation' => Carbon::now()->subMonths(18),
                'date_garantie' => Carbon::now()->subMonths(6),
                'created_at' => Carbon::now()->subMonths(18),
                'updated_at' => Carbon::now()->subWeek(),
            ],

            // Commercial
            [
                'nom' => 'IMP-COM-001',
                'entite' => 'Commercial',
                'statut' => 'En service',
                'fabricant' => 'Epson',
                'reseau_ip' => '192.168.1.70',
                'numero_serie' => 'SNEP555666777',
                'lieu' => 'Espace Commercial Open Space',
                'type' => 'Jet d\'encre',
                'modele' => 'WorkForce WF-7820',
                'description' => 'Imprimante jet d\'encre pour documents commerciaux et présentations',
                'date_achat' => Carbon::now()->subMonths(9),
                'date_installation' => Carbon::now()->subMonths(9),
                'date_garantie' => Carbon::now()->addMonths(3),
                'created_at' => Carbon::now()->subMonths(9),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'nom' => 'IMP-COM-002',
                'entite' => 'Commercial',
                'statut' => 'En maintenance',
                'fabricant' => 'HP',
                'reseau_ip' => '192.168.1.71',
                'numero_serie' => 'SNHP444555666',
                'lieu' => 'Bureau Chef des Ventes',
                'type' => 'Laser',
                'modele' => 'LaserJet Pro M203dw',
                'description' => 'Imprimante personnelle du chef des ventes - En réparation',
                'date_achat' => Carbon::now()->subMonths(6),
                'date_installation' => Carbon::now()->subMonths(6),
                'date_garantie' => Carbon::now()->addMonths(6),
                'created_at' => Carbon::now()->subMonths(6),
                'updated_at' => Carbon::now()->subDay(),
            ],

            // Direction
            [
                'nom' => 'IMP-DIR-001',
                'entite' => 'Direction',
                'statut' => 'En service',
                'fabricant' => 'Xerox',
                'reseau_ip' => '192.168.1.80',
                'numero_serie' => 'SNXE777888999',
                'lieu' => 'Bureau du Directeur Général',
                'type' => 'Multifonction',
                'modele' => 'VersaLink C400',
                'description' => 'Imprimante haut de gamme pour la direction - Sécurisée',
                'date_achat' => Carbon::now()->subMonths(3),
                'date_installation' => Carbon::now()->subMonths(3),
                'date_garantie' => Carbon::now()->addMonths(21),
                'created_at' => Carbon::now()->subMonths(3),
                'updated_at' => Carbon::now()->subHours(5),
            ],

            // Comptabilité
            [
                'nom' => 'IMP-COMPTA-001',
                'entite' => 'Comptabilité',
                'statut' => 'En service',
                'fabricant' => 'Lexmark',
                'reseau_ip' => '192.168.1.90',
                'numero_serie' => 'SNLM333222111',
                'lieu' => 'Service Comptabilité - Bureau 301',
                'type' => 'Laser',
                'modele' => 'MX421ade',
                'description' => 'Imprimante dédiée aux documents comptables et fiscaux',
                'date_achat' => Carbon::now()->subYears(3),
                'date_installation' => Carbon::now()->subYears(3),
                'date_garantie' => Carbon::now()->subYear(),
                'created_at' => Carbon::now()->subYears(3),
                'updated_at' => Carbon::now()->subDays(7),
            ],

            // Marketing
            [
                'nom' => 'IMP-MKT-001',
                'entite' => 'Marketing',
                'statut' => 'En service',
                'fabricant' => 'Epson',
                'reseau_ip' => '192.168.1.100',
                'numero_serie' => 'SNEP888999000',
                'lieu' => 'Service Marketing - Salle Créa',
                'type' => 'Jet d\'encre',
                'modele' => 'SureColor P700',
                'description' => 'Imprimante photo professionnelle pour supports marketing',
                'date_achat' => Carbon::now()->subMonths(4),
                'date_installation' => Carbon::now()->subMonths(4),
                'date_garantie' => Carbon::now()->addMonths(20),
                'created_at' => Carbon::now()->subMonths(4),
                'updated_at' => Carbon::now()->subDays(1),
            ],

            // Stock - En stock
            [
                'nom' => 'IMP-STOCK-001',
                'entite' => 'IT',
                'statut' => 'En stock',
                'fabricant' => 'HP',
                'reseau_ip' => null,
                'numero_serie' => 'SNHP000111222',
                'lieu' => 'Réserve IT - Local RDC',
                'type' => 'Laser',
                'modele' => 'LaserJet Pro MFP M428fdw',
                'description' => 'Imprimante de rechange - Neuf en stock',
                'date_achat' => Carbon::now()->subMonths(2),
                'date_installation' => null,
                'date_garantie' => Carbon::now()->addMonths(34),
                'created_at' => Carbon::now()->subMonths(2),
                'updated_at' => Carbon::now()->subDays(30),
            ],
            [
                'nom' => 'IMP-STOCK-002',
                'entite' => 'IT',
                'statut' => 'En stock',
                'fabricant' => 'Brother',
                'reseau_ip' => null,
                'numero_serie' => 'SNBR555444333',
                'lieu' => 'Réserve IT - Local RDC',
                'type' => 'Multifonction',
                'modele' => 'MFC-L3750CDW',
                'description' => 'Imprimante révisée - Prête à être déployée',
                'date_achat' => Carbon::now()->subYears(1),
                'date_installation' => null,
                'date_garantie' => Carbon::now()->addMonths(6),
                'created_at' => Carbon::now()->subMonths(6),
                'updated_at' => Carbon::now()->subDays(45),
            ],

            // Hors service
            [
                'nom' => 'IMP-HS-001',
                'entite' => 'Informatique',
                'statut' => 'Hors service',
                'fabricant' => 'Canon',
                'reseau_ip' => '192.168.1.200',
                'numero_serie' => 'SNCA666777888',
                'lieu' => 'Local Technique - En attente recyclage',
                'type' => 'Laser',
                'modele' => 'i-SENSYS LBP6230dn',
                'description' => 'Imprimante obsolète - Pièces défectueuses irréparables',
                'date_achat' => Carbon::now()->subYears(5),
                'date_installation' => Carbon::now()->subYears(5),
                'date_garantie' => Carbon::now()->subYears(3),
                'created_at' => Carbon::now()->subYears(5),
                'updated_at' => Carbon::now()->subMonths(2),
            ],
            [
                'nom' => 'IMP-HS-002',
                'entite' => 'Commercial',
                'statut' => 'Hors service',
                'fabricant' => 'Epson',
                'reseau_ip' => null,
                'numero_serie' => 'SNEP222333444',
                'lieu' => 'Local Technique',
                'type' => 'Jet d\'encre',
                'modele' => 'Stylus SX235W',
                'description' => 'Tête d\'impression bouchée - Coût de réparation trop élevé',
                'date_achat' => Carbon::now()->subYears(4),
                'date_installation' => Carbon::now()->subYears(4),
                'date_garantie' => Carbon::now()->subYears(2),
                'created_at' => Carbon::now()->subYears(4),
                'updated_at' => Carbon::now()->subMonths(1),
            ],

            // Production
            [
                'nom' => 'IMP-PROD-001',
                'entite' => 'Production',
                'statut' => 'En service',
                'fabricant' => 'Zebra',
                'reseau_ip' => '192.168.2.10',
                'numero_serie' => 'SNZB123456789',
                'lieu' => 'Atelier Production - Ligne A',
                'type' => 'Thermique',
                'modele' => 'ZT410',
                'description' => 'Imprimante étiquettes pour codes-barres production',
                'date_achat' => Carbon::now()->subMonths(8),
                'date_installation' => Carbon::now()->subMonths(8),
                'date_garantie' => Carbon::now()->addMonths(16),
                'created_at' => Carbon::now()->subMonths(8),
                'updated_at' => Carbon::now()->subDays(10),
            ],

            // Réception
            [
                'nom' => 'IMP-REC-001',
                'entite' => 'Réception',
                'statut' => 'En service',
                'fabricant' => 'Brother',
                'reseau_ip' => '192.168.1.110',
                'numero_serie' => 'SNBR999888777',
                'lieu' => 'Poste Accueil Principal',
                'type' => 'Multifonction',
                'modele' => 'DCP-L3550CDW',
                'description' => 'Imprimante réception pour badges visiteurs et documents',
                'date_achat' => Carbon::now()->subMonths(12),
                'date_installation' => Carbon::now()->subMonths(12),
                'date_garantie' => Carbon::now()->addYear(),
                'created_at' => Carbon::now()->subMonths(12),
                'updated_at' => Carbon::now()->subDays(5),
            ],

            // Salle de réunion
            [
                'nom' => 'IMP-REUNION-001',
                'entite' => 'Direction',
                'statut' => 'En service',
                'fabricant' => 'HP',
                'reseau_ip' => '192.168.1.120',
                'numero_serie' => 'SNHP333444555',
                'lieu' => 'Salle de Réunion Conseil',
                'type' => 'Laser',
                'modele' => 'LaserJet Enterprise M506dn',
                'description' => 'Imprimante sécurisée pour documents confidentiels réunions',
                'date_achat' => Carbon::now()->subMonths(7),
                'date_installation' => Carbon::now()->subMonths(7),
                'date_garantie' => Carbon::now()->addMonths(29),
                'created_at' => Carbon::now()->subMonths(7),
                'updated_at' => Carbon::now()->subHours(12),
            ],
        ];

        foreach ($imprimantes as $imprimante) {
            Imprimante::create($imprimante);
        }

        $this->command->info(count($imprimantes) . ' imprimantes créées avec succès!');
        $this->command->info('Répartition par statut:');
        $this->command->info('- En service: ' . collect($imprimantes)->where('statut', 'En service')->count());
        $this->command->info('- En maintenance: ' . collect($imprimantes)->where('statut', 'En maintenance')->count());
        $this->command->info('- En stock: ' . collect($imprimantes)->where('statut', 'En stock')->count());
        $this->command->info('- Hors service: ' . collect($imprimantes)->where('statut', 'Hors service')->count());
    }
}
