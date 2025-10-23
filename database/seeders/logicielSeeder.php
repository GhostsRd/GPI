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
            [
                'nom' => 'Adobe Illustrator',
                'editeur' => 'Adobe',
                'version_nom' => 'CC 2024',
                'version_systeme_exploitation' => 'Windows, macOS',
                'nombre_installations' => 8,
                'nombre_licences' => 8,
                'description' => 'Logiciel de création graphique vectorielle',
                'date_achat' => '2023-03-15',
                'date_expiration' => '2024-03-15',
            ],
            [
                'nom' => 'Microsoft Teams',
                'editeur' => 'Microsoft',
                'version_nom' => '2.1',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 70,
                'nombre_licences' => 100,
                'description' => 'Plateforme de collaboration et visioconférence',
                'date_achat' => '2023-01-10',
                'date_expiration' => '2024-01-10',
            ],
            [
                'nom' => 'Zoom',
                'editeur' => 'Zoom Video Communications',
                'version_nom' => '5.15',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 40,
                'nombre_licences' => 50,
                'description' => 'Application de visioconférence',
                'date_achat' => '2023-02-01',
                'date_expiration' => '2024-02-01',
            ],
            [
                'nom' => 'Mozilla Firefox',
                'editeur' => 'Mozilla Foundation',
                'version_nom' => '119',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 30,
                'nombre_licences' => 0,
                'description' => 'Navigateur web open source',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'Microsoft Edge',
                'editeur' => 'Microsoft',
                'version_nom' => '119',
                'version_systeme_exploitation' => 'Windows, macOS',
                'nombre_installations' => 50,
                'nombre_licences' => 0,
                'description' => 'Navigateur web basé sur Chromium',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'Adobe Acrobat Reader',
                'editeur' => 'Adobe',
                'version_nom' => 'DC',
                'version_systeme_exploitation' => 'Windows, macOS',
                'nombre_installations' => 80,
                'nombre_licences' => 0,
                'description' => 'Lecteur de fichiers PDF',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'WinRAR',
                'editeur' => 'RARLAB',
                'version_nom' => '6.24',
                'version_systeme_exploitation' => 'Windows',
                'nombre_installations' => 65,
                'nombre_licences' => 50,
                'description' => 'Utilitaire de compression de fichiers',
                'date_achat' => '2023-01-20',
                'date_expiration' => '2024-01-20',
            ],
            [
                'nom' => '7-Zip',
                'editeur' => 'Igor Pavlov',
                'version_nom' => '23.01',
                'version_systeme_exploitation' => 'Windows',
                'nombre_installations' => 25,
                'nombre_licences' => 0,
                'description' => 'Logiciel de compression open source',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'VLC Media Player',
                'editeur' => 'VideoLAN',
                'version_nom' => '3.0.18',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 55,
                'nombre_licences' => 0,
                'description' => 'Lecteur multimédia polyvalent',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'Notepad++',
                'editeur' => 'Don Ho',
                'version_nom' => '8.6',
                'version_systeme_exploitation' => 'Windows',
                'nombre_installations' => 35,
                'nombre_licences' => 0,
                'description' => 'Éditeur de texte avancé',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'Git',
                'editeur' => 'Software Freedom Conservancy',
                'version_nom' => '2.42',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 20,
                'nombre_licences' => 0,
                'description' => 'Système de contrôle de version',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'Node.js',
                'editeur' => 'OpenJS Foundation',
                'version_nom' => '20.9.0',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 15,
                'nombre_licences' => 0,
                'description' => 'Environnement d\'exécution JavaScript',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'Python',
                'editeur' => 'Python Software Foundation',
                'version_nom' => '3.11',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 18,
                'nombre_licences' => 0,
                'description' => 'Langage de programmation interprété',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'Java Runtime Environment',
                'editeur' => 'Oracle',
                'version_nom' => '21',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 40,
                'nombre_licences' => 0,
                'description' => 'Environnement d\'exécution pour applications Java',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'MySQL Workbench',
                'editeur' => 'Oracle',
                'version_nom' => '8.0',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 12,
                'nombre_licences' => 0,
                'description' => 'Outil de modélisation de bases de données',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'PostgreSQL',
                'editeur' => 'PostgreSQL Global Development Group',
                'version_nom' => '16',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 8,
                'nombre_licences' => 0,
                'description' => 'Système de gestion de base de données relationnelle',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'Docker Desktop',
                'editeur' => 'Docker Inc.',
                'version_nom' => '4.24',
                'version_systeme_exploitation' => 'Windows, macOS',
                'nombre_installations' => 10,
                'nombre_licences' => 15,
                'description' => 'Plateforme de conteneurisation',
                'date_achat' => '2023-06-01',
                'date_expiration' => '2024-06-01',
            ],
            [
                'nom' => 'VirtualBox',
                'editeur' => 'Oracle',
                'version_nom' => '7.0',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 8,
                'nombre_licences' => 0,
                'description' => 'Logiciel de virtualisation',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'Wireshark',
                'editeur' => 'Wireshark Foundation',
                'version_nom' => '4.0.8',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 5,
                'nombre_licences' => 0,
                'description' => 'Analyseur de protocoles réseau',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'PuTTY',
                'editeur' => 'Simon Tatham',
                'version_nom' => '0.78',
                'version_systeme_exploitation' => 'Windows',
                'nombre_installations' => 15,
                'nombre_licences' => 0,
                'description' => 'Client SSH et Telnet',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'FileZilla',
                'editeur' => 'Tim Kosse',
                'version_nom' => '3.66',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 12,
                'nombre_licences' => 0,
                'description' => 'Client FTP open source',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'TeamViewer',
                'editeur' => 'TeamViewer AG',
                'version_nom' => '15.44',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 8,
                'nombre_licences' => 10,
                'description' => 'Logiciel d\'accès à distance',
                'date_achat' => '2023-03-01',
                'date_expiration' => '2024-03-01',
            ],
            [
                'nom' => 'AnyDesk',
                'editeur' => 'AnyDesk Software GmbH',
                'version_nom' => '8.0',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 6,
                'nombre_licences' => 5,
                'description' => 'Solution de bureau à distance',
                'date_achat' => '2023-04-10',
                'date_expiration' => '2024-04-10',
            ],
            [
                'nom' => 'Malwarebytes',
                'editeur' => 'Malwarebytes Inc.',
                'version_nom' => '4.6',
                'version_systeme_exploitation' => 'Windows, macOS',
                'nombre_installations' => 25,
                'nombre_licences' => 25,
                'description' => 'Antivirus et anti-malware',
                'date_achat' => '2023-02-15',
                'date_expiration' => '2024-02-15',
            ],
            [
                'nom' => 'CCleaner',
                'editeur' => 'Piriform',
                'version_nom' => '6.15',
                'version_systeme_exploitation' => 'Windows',
                'nombre_installations' => 20,
                'nombre_licences' => 20,
                'description' => 'Outil d\'optimisation et de nettoyage',
                'date_achat' => '2023-01-30',
                'date_expiration' => '2024-01-30',
            ],
            [
                'nom' => 'Microsoft SQL Server',
                'editeur' => 'Microsoft',
                'version_nom' => '2022',
                'version_systeme_exploitation' => 'Windows',
                'nombre_installations' => 3,
                'nombre_licences' => 3,
                'description' => 'Système de gestion de base de données',
                'date_achat' => '2023-01-05',
                'date_expiration' => '2026-01-05',
            ],
            [
                'nom' => 'Oracle Database',
                'editeur' => 'Oracle',
                'version_nom' => '19c',
                'version_systeme_exploitation' => 'Windows, Linux',
                'nombre_installations' => 2,
                'nombre_licences' => 2,
                'description' => 'SGBD relationnel d\'Oracle',
                'date_achat' => '2023-02-10',
                'date_expiration' => '2026-02-10',
            ],
            [
                'nom' => 'SAP Business One',
                'editeur' => 'SAP',
                'version_nom' => '10.0',
                'version_systeme_exploitation' => 'Windows',
                'nombre_installations' => 1,
                'nombre_licences' => 1,
                'description' => 'Logiciel de gestion intégré',
                'date_achat' => '2023-01-20',
                'date_expiration' => '2025-01-20',
            ],
            [
                'nom' => 'QuickBooks',
                'editeur' => 'Intuit',
                'version_nom' => '2023',
                'version_systeme_exploitation' => 'Windows',
                'nombre_installations' => 4,
                'nombre_licences' => 5,
                'description' => 'Logiciel de comptabilité',
                'date_achat' => '2023-03-05',
                'date_expiration' => '2024-03-05',
            ],
            [
                'nom' => 'Sage 100',
                'editeur' => 'Sage Group',
                'version_nom' => '2023',
                'version_systeme_exploitation' => 'Windows',
                'nombre_installations' => 2,
                'nombre_licences' => 2,
                'description' => 'Solution de gestion d\'entreprise',
                'date_achat' => '2023-02-28',
                'date_expiration' => '2024-02-28',
            ],
            [
                'nom' => 'MATLAB',
                'editeur' => 'MathWorks',
                'version_nom' => 'R2023b',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 6,
                'nombre_licences' => 6,
                'description' => 'Environnement de calcul numérique',
                'date_achat' => '2023-09-01',
                'date_expiration' => '2024-09-01',
            ],
            [
                'nom' => 'SolidWorks',
                'editeur' => 'Dassault Systèmes',
                'version_nom' => '2023',
                'version_systeme_exploitation' => 'Windows',
                'nombre_installations' => 4,
                'nombre_licences' => 4,
                'description' => 'Logiciel de CAO 3D',
                'date_achat' => '2023-01-15',
                'date_expiration' => '2024-01-15',
            ],
            [
                'nom' => 'SketchUp',
                'editeur' => 'Trimble Inc.',
                'version_nom' => '2023',
                'version_systeme_exploitation' => 'Windows, macOS',
                'nombre_installations' => 3,
                'nombre_licences' => 3,
                'description' => 'Logiciel de modélisation 3D',
                'date_achat' => '2023-04-01',
                'date_expiration' => '2024-04-01',
            ],
            [
                'nom' => 'Blender',
                'editeur' => 'Blender Foundation',
                'version_nom' => '3.6',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 5,
                'nombre_licences' => 0,
                'description' => 'Logiciel de modélisation 3D gratuit',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'GIMP',
                'editeur' => 'The GIMP Team',
                'version_nom' => '2.10.34',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 8,
                'nombre_licences' => 0,
                'description' => 'Éditeur d\'image open source',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'Inkscape',
                'editeur' => 'Inkscape Project',
                'version_nom' => '1.3',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 6,
                'nombre_licences' => 0,
                'description' => 'Logiciel de dessin vectoriel gratuit',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'OBS Studio',
                'editeur' => 'OBS Project',
                'version_nom' => '29.1',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 4,
                'nombre_licences' => 0,
                'description' => 'Logiciel d\'enregistrement et streaming vidéo',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'Audacity',
                'editeur' => 'Audacity Team',
                'version_nom' => '3.3',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 7,
                'nombre_licences' => 0,
                'description' => 'Éditeur audio numérique gratuit',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'HandBrake',
                'editeur' => 'HandBrake Team',
                'version_nom' => '1.7',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 3,
                'nombre_licences' => 0,
                'description' => 'Convertisseur vidéo open source',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'KeePass',
                'editeur' => 'Dominik Reichl',
                'version_nom' => '2.53',
                'version_systeme_exploitation' => 'Windows',
                'nombre_installations' => 12,
                'nombre_licences' => 0,
                'description' => 'Gestionnaire de mots de passe',
                'date_achat' => null,
                'date_expiration' => null,
            ],
            [
                'nom' => 'Bitwarden',
                'editeur' => 'Bitwarden Inc.',
                'version_nom' => '2023.10',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 8,
                'nombre_licences' => 10,
                'description' => 'Gestionnaire de mots de passe sécurisé',
                'date_achat' => '2023-05-01',
                'date_expiration' => '2024-05-01',
            ],
            [
                'nom' => 'Trello',
                'editeur' => 'Atlassian',
                'version_nom' => '2.0',
                'version_systeme_exploitation' => 'Web, Mobile',
                'nombre_installations' => 35,
                'nombre_licences' => 50,
                'description' => 'Outil de gestion de projet visuel',
                'date_achat' => '2023-02-01',
                'date_expiration' => '2024-02-01',
            ],
            [
                'nom' => 'Jira',
                'editeur' => 'Atlassian',
                'version_nom' => '9.12',
                'version_systeme_exploitation' => 'Web, Windows, macOS, Linux',
                'nombre_installations' => 15,
                'nombre_licences' => 20,
                'description' => 'Outil de suivi de projets et bugs',
                'date_achat' => '2023-01-10',
                'date_expiration' => '2024-01-10',
            ],
            [
                'nom' => 'Confluence',
                'editeur' => 'Atlassian',
                'version_nom' => '8.7',
                'version_systeme_exploitation' => 'Web, Windows, macOS, Linux',
                'nombre_installations' => 12,
                'nombre_licences' => 15,
                'description' => 'Plateforme de collaboration et documentation',
                'date_achat' => '2023-01-10',
                'date_expiration' => '2024-01-10',
            ],
            [
                'nom' => 'Postman',
                'editeur' => 'Postman Inc.',
                'version_nom' => '10.18',
                'version_systeme_exploitation' => 'Windows, macOS, Linux',
                'nombre_installations' => 10,
                'nombre_licences' => 12,
                'description' => 'Plateforme API',
                'date_achat' => '2023-03-20',
                'date_expiration' => '2024-03-20',
            ]
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
        $teams = Logiciel::where('nom', 'Microsoft Teams')->first();
        $forticlient = Logiciel::where('nom', 'FortiClient')->first();

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
        $pc1->logiciels()->attach($forticlient->id, [
            'date_installation' => '2023-01-18',
            'version_installee' => '7.2'
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
        $pc2->logiciels()->attach($teams->id, [
            'date_installation' => '2023-02-22',
            'version_installee' => '2.1'
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
        $pc3->logiciels()->attach($teams->id, [
            'date_installation' => '2023-03-28',
            'version_installee' => '2.1'
        ]);
    }
}
