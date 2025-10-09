<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Logiciel;
use App\Models\Equipement;
use Carbon\Carbon;

class LogicielSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $logiciels = [
            [
                'nom' => 'Microsoft Office 365',
                'editeur' => 'Microsoft',
                'version_nom' => '2023',
                'version_systeme_exploitation' => 'Windows, macOS',
                'nombre_installations' => 45,
                'nombre_licences' => 50,
                'description' => 'Suite bureautique complète incluant Word, Excel, PowerPoint',
                'date_achat' => '2023-01-15',
                'date_expiration' => '2024-01-15',
            ],
            [
                'nom' => 'Adobe Photoshop',
                'editeur' => 'Adobe',
                'version_nom' => 'CC 2024',
                'version_systeme_exploitation' => 'Windows, macOS',
                'nombre_installations' => 12,
                'nombre_licences' => 10,
                'description' => 'Logiciel de retouche photo professionnel',
                'date_achat' => '2023-03-10',
                'date_expiration' => '2024-03-10',
            ],
            [
                'nom' => 'Google Chrome',
                'editeur' => 'Google',
                'version_nom' => '119',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 85,
                'nombre_licences' => 0,
                'description' => 'Navigateur web gratuit',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'Visual Studio Code',
                'editeur' => 'Microsoft',
                'version_nom' => '1.84',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 25,
                'nombre_licences' => 0,
                'description' => 'Éditeur de code source gratuit',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'AutoCAD',
                'editeur' => 'Autodesk',
                'version_nom' => '2024',
                'version_systeme_exploitation' => 'Windows',
                'nombre_installations' => 8,
                'nombre_licences' => 8,
                'description' => 'Logiciel de conception assistée par ordinateur',
                'date_achat' => '2023-02-20',
                'date_expiration' => '2024-02-20',
            ],
            [
                'nom' => 'Slack',
                'editeur' => 'Slack Technologies',
                'version_nom' => '4.32',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 60,
                'nombre_licences' => 100,
                'description' => 'Application de messagerie d\'équipe',
                'date_achat' => '2023-01-01',
                'date_expiration' => '2024-01-01',
            ],
            [
                'nom' => 'FortiClient',
                'editeur' => 'Fortinet',
                'version_nom' => '7.2',
                'version_systeme_exploitation' => 'Windows',
                'nombre_installations' => 75,
                'nombre_licences' => 80,
                'description' => 'Solution de sécurité endpoint',
                'date_achat' => '2023-04-05',
                'date_expiration' => '2024-04-05',
            ],
            [
                'nom' => 'VMware Workstation',
                'editeur' => 'VMware',
                'version_nom' => '17',
                'version_systeme_exploitation' => 'Windows, Linux',
                'nombre_installations' => 15,
                'nombre_licences' => 15,
                'description' => 'Virtualisation de postes de travail',
                'date_achat' => '2023-05-12',
                'date_expiration' => '2024-05-12',
            ],
        ];

        foreach ($logiciels as $logiciel) {
            Logiciel::create($logiciel);
        }

        // Création de quelques équipements de test
        $equipements = [
            [
                'nom' => 'PC-001',
                'type' => 'Ordinateur portable',
                'reference' => 'HP EliteBook 840 G8',
                'date_acquisition' => '2023-01-10',
                'prix_achat' => 1200.00,
                'etat' => 'En service',
                'emplacement' => 'Bureau 101',
            ],
            [
                'nom' => 'PC-002',
                'type' => 'Ordinateur fixe',
                'reference' => 'Dell OptiPlex 7090',
                'date_acquisition' => '2023-02-15',
                'prix_achat' => 850.00,
                'etat' => 'En service',
                'emplacement' => 'Bureau 102',
            ],
            [
                'nom' => 'PC-003',
                'type' => 'Ordinateur portable',
                'reference' => 'Lenovo ThinkPad T14',
                'date_acquisition' => '2023-03-20',
                'prix_achat' => 1100.00,
                'etat' => 'En service',
                'emplacement' => 'Bureau 103',
            ],
        ];

        foreach ($equipements as $equipement) {
            Equipement::create($equipement);
        }

        // Installation de logiciels sur des équipements
        $pc1 = Equipement::where('nom', 'PC-001')->first();
        $pc2 = Equipement::where('nom', 'PC-002')->first();
        $pc3 = Equipement::where('nom', 'PC-003')->first();

        $office = Logiciel::where('nom', 'Microsoft Office 365')->first();
        $chrome = Logiciel::where('nom', 'Google Chrome')->first();
        $vscode = Logiciel::where('nom', 'Visual Studio Code')->first();
        $slack = Logiciel::where('nom', 'Slack')->first();

        // Installations sur PC-001
        $pc1->logiciels()->attach($office->id, [
            'date_installation' => '2023-01-20',
            'version_installee' => '2023'
        ]);
        $pc1->logiciels()->attach($chrome->id, [
            'date_installation' => '2023-01-20',
            'version_installee' => '119'
        ]);
        $pc1->logiciels()->attach($slack->id, [
            'date_installation' => '2023-01-25',
            'version_installee' => '4.32'
        ]);

        // Installations sur PC-002
        $pc2->logiciels()->attach($office->id, [
            'date_installation' => '2023-02-20',
            'version_installee' => '2023'
        ]);
        $pc2->logiciels()->attach($chrome->id, [
            'date_installation' => '2023-02-20',
            'version_installee' => '119'
        ]);
        $pc2->logiciels()->attach($vscode->id, [
            'date_installation' => '2023-02-25',
            'version_installee' => '1.84'
        ]);

        // Installations sur PC-003
        $pc3->logiciels()->attach($office->id, [
            'date_installation' => '2023-03-25',
            'version_installee' => '2023'
        ]);
        $pc3->logiciels()->attach($chrome->id, [
            'date_installation' => '2023-03-25',
            'version_installee' => '119'
        ]);
        $pc3->logiciels()->attach($slack->id, [
            'date_installation' => '2023-03-30',
            'version_installee' => '4.32'
        ]);
        $pc3->logiciels()->attach($vscode->id, [
            'date_installation' => '2023-04-01',
            'version_installee' => '1.84'
        ]);
    }
}