<?php

namespace App\Http\Livewire\Acceuil;

use Livewire\Component;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Ordinateur;
use App\Models\Imprimante;
use App\Models\Telephone;
use App\Models\Logiciel;
use App\Models\Peripherique;
use App\Models\Moniteur;
use App\Models\MaterielReseau;
use App\Models\Checkout;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Acceuil extends Component
{
    public $activityFilter = 'today';
    public $stats = [];
    public $name_field = 'nom';


    public function mount()
    {
        $this->chargerStatistiques();
    }

    public function chargerStatistiques()
    {
        try {
            // 🧩 Statistiques utilisateurs
            $totalUsers = User::count();
            $activeUsers = User::where('is_active', true)
                              ->orWhere('actif', true)
                              ->orWhere('status', 'actif')
                              ->count();

            // 🧩 Statistiques tickets
            $totalTickets = Ticket::count();
            $ticketsOuverts = Ticket::where('status', 'ouvert')
                                   ->orWhere('statut', 'ouvert')
                                   ->orWhere('status', 'open')
                                   ->orWhere('statut', 'open')
                                   ->count();

            $ticketsFermes = Ticket::where('status', 'fermé')
                                  ->orWhere('statut', 'fermé')
                                  ->orWhere('status', 'closed')
                                  ->orWhere('statut', 'closed')
                                  ->count();

            // 🧩 Total équipements = somme de toutes les tables d'équipements
            $totalEquipments = $this->getTotalEquipmentsCount();
            $availableEquipments = $this->getAvailableEquipmentsCount();

            // 🧩 Statistiques checkouts
            $totalCheckouts = Checkout::count();
            $pendingCheckouts = Checkout::where('statut', 'en_attente')
                                       ->orWhere('status', 'pending')
                                       ->count();

            // Enregistrer toutes les stats dans un tableau pour la vue
            $this->stats = [
                'total_equipements' => $totalEquipments,
                'total_users' => $totalUsers,
                'active_users' => $activeUsers,
                'total_tickets' => $totalTickets,
                'tickets_ouverts' => $ticketsOuverts,
                'tickets_fermes' => $ticketsFermes,
                'available_equipments' => $availableEquipments,
                'total_checkouts' => $totalCheckouts,
                'pending_checkouts' => $pendingCheckouts,
            ];

        } catch (\Exception $e) {
            // En cas d'erreur, initialiser avec des valeurs par défaut
            $this->stats = [
                'total_equipements' => 0,
                'total_users' => 0,
                'active_users' => 0,
                'total_tickets' => 0,
                'tickets_ouverts' => 0,
                'tickets_fermes' => 0,
                'available_equipments' => 0,
                'total_checkouts' => 0,
                'pending_checkouts' => 0,
            ];
            $this->addError('stats', 'Erreur lors du chargement des statistiques : ' . $e->getMessage());
        }
    }

    /**
     * Calcule le nombre total d'équipements
     */
    private function getTotalEquipmentsCount()
    {
        $total = 0;
        
        $tables = [
            'ordinateurs' => Ordinateur::class,
            'imprimantes' => Imprimante::class,
            'telephones' => Telephone::class,
            'logiciels' => Logiciel::class,
            'peripheriques' => Peripherique::class,
            'moniteurs' => Moniteur::class,
            'materiel_reseaus' => MaterielReseau::class,
        ];

        foreach ($tables as $tableName => $modelClass) {
            if (Schema::hasTable($tableName)) {
                $total += $modelClass::count();
            }
        }

        return $total;
    }

    /**
     * Calcule le nombre d'équipements disponibles
     */
    private function getAvailableEquipmentsCount()
    {
        $available = 0;

        // Ordinateurs disponibles
        if (Schema::hasTable('ordinateurs')) {
            $available += Ordinateur::where('statut', 'disponible')
                          ->orWhere('status', 'available')
                          ->count();
        }

        // Imprimantes disponibles
        if (Schema::hasTable('imprimantes')) {
            $available += Imprimante::where('statut', 'disponible')
                           ->orWhere('status', 'available')
                           ->count();
        }

        // Téléphones disponibles
        if (Schema::hasTable('telephones')) {
            $available += Telephone::where('statut', 'disponible')
                          ->orWhere('status', 'available')
                          ->count();
        }

        // Périphériques disponibles
        if (Schema::hasTable('peripheriques')) {
            $available += Peripherique::where('statut', 'disponible')
                            ->orWhere('status', 'available')
                            ->count();
        }

        // Moniteurs disponibles
        if (Schema::hasTable('moniteurs')) {
            $available += Moniteur::where('statut', 'disponible')
                         ->orWhere('status', 'available')
                         ->count();
        }

        // Matériel réseau disponible
        if (Schema::hasTable('materiel_reseaus')) {
            $available += MaterielReseau::where('statut', 'disponible')
                              ->orWhere('status', 'available')
                              ->count();
        }

        return $available;
    }

    /**
     * Récupère les tickets récents
     */
    public function getRecentTicketsProperty()
    {
        if (!Schema::hasTable('tickets')) {
            return collect();
        }

        return Ticket::latest()
            ->take(5)
            ->get()
            ->map(function($ticket) {
                return [
                    'id' => $ticket->id,
                    'title' => $ticket->titre ?? $ticket->sujet ?? $ticket->title ?? 'Sans titre',
                    'status' => $ticket->statut ?? $ticket->status ?? 'inconnu',
                    'status_class' => $this->getStatusClass($ticket->statut ?? $ticket->status),
                    'created_at' => $ticket->created_at->diffForHumans()
                ];
            });
    }

    /**
     * Récupère les équipements récents
     */
    public function getRecentEquipmentsProperty()
    {
        $equipments = collect();

        // Récupérer les équipements récents de chaque table
        $tables = [
            'ordinateurs' => [
                'model' => Ordinateur::class,
                'name_field' => 'nom',
                'type' => 'Ordinateur'
            ],
            'imprimantes' => [
                'model' => Imprimante::class,
                'name_field' => 'nom',
                'type' => 'Imprimante'
            ],
            'telephones' => [
                'model' => Telephone::class,
                'name_field' => 'nom',
                'type' => 'Téléphone'
            ],
            'peripheriques' => [
                'model' => Peripherique::class,
                'name_field' => 'nom',
                'type' => 'Périphérique'
            ],
            'moniteurs' => [
                'model' => Moniteur::class,
                'name_field' => 'nom',
                'type' => 'Moniteur'
            ],
        ];

        foreach ($tables as $tableName => $config) {
    if (Schema::hasTable($tableName)) {
        $items = $config['model']::latest()->take(2)->get()->map(function($item) use ($config) {
            $nameField = $config['name_field'];
            return [
                'name' => $item->$nameField ?? $item->modele ?? $config['type'],
                'type' => $config['type'],
                'status' => $item->statut ?? $item->status ?? 'inconnu',
                'status_class' => $this->getEquipmentStatusClass($item->statut ?? $item->status),
                'added_date' => $item->created_at->diffForHumans()
            ];
        });
        $equipments = $equipments->merge($items);
    }
}


        // Trier par date de création et prendre les 5 plus récents
        return $equipments->sortByDesc(function($item) {
            return strtotime($item['added_date']);
        })->take(5)->values();
    }

    /**
     * Récupère les activités récentes
     */
    public function getRecentActivitiesProperty()
    {
        $activities = [];

        // Tickets récents
        if (Schema::hasTable('tickets')) {
            $recentTickets = Ticket::latest()->take(2)->get();
            foreach ($recentTickets as $ticket) {
                $activities[] = [
                    'icon' => 'ticket-alt',
                    'description' => 'Nouveau ticket #' . $ticket->id,
                    'time' => $ticket->created_at->diffForHumans()
                ];
            }
        }

        // Équipements récents
        $recentEquipments = $this->recentEquipments->take(2);
        foreach ($recentEquipments as $equipment) {
            $activities[] = [
                'icon' => 'laptop',
                'description' => 'Nouvel équipement: ' . $equipment['name'],
                'time' => $equipment['added_date']
            ];
        }

        // Utilisateurs récents
        if (Schema::hasTable('users')) {
            $recentUsers = User::latest()->take(1)->get();
            foreach ($recentUsers as $user) {
                $activities[] = [
                    'icon' => 'user-plus',
                    'description' => 'Nouvel utilisateur: ' . ($user->name ?? $user->nom ?? 'Utilisateur'),
                    'time' => $user->created_at->diffForHumans()
                ];
            }
        }

        // Si pas d'activités réelles, on en crée des statiques
        if (empty($activities)) {
            $activities = [
                ['icon' => 'check-circle', 'description' => 'Système initialisé', 'time' => 'Maintenant'],
                ['icon' => 'user-plus', 'description' => 'Bienvenue sur GPI Pivot', 'time' => 'Aujourd\'hui'],
                ['icon' => 'laptop', 'description' => 'Dashboard prêt à l\'emploi', 'time' => 'Récemment'],
            ];
        }

        return $activities;
    }

    /**
     * Détermine la classe CSS pour le statut des tickets
     */
    private function getStatusClass($status)
    {
        return match(strtolower($status)) {
            'ouvert', 'open' => 'warning',
            'en_cours', 'in_progress', 'en cours' => 'info',
            'résolu', 'resolved', 'fermé', 'closed' => 'success',
            default => 'light'
        };
    }

    /**
     * Détermine la classe CSS pour le statut des équipements
     */
    private function getEquipmentStatusClass($status)
    {
        return match(strtolower($status)) {
            'disponible', 'available' => 'success',
            'affecté', 'in_use', 'utilisé' => 'info',
            'maintenance', 'réparation' => 'warning',
            'hors_service', 'broken', 'cassé' => 'danger',
            default => 'light'
        };
    }

    /**
     * Rafraîchit les graphiques
     */
    public function refreshCharts()
    {
        $this->chargerStatistiques();
        $this->dispatchBrowserEvent('chartsRefreshed');
    }

    /**
     * Rend la vue avec toutes les données
     */
    public function render()
    {
        return view('livewire.acceuil.acceuil', [
            // Statistiques principales
            'totalTickets' => $this->stats['total_tickets'] ?? 0,
            'openTickets' => $this->stats['tickets_ouverts'] ?? 0,
            'totalUsers' => $this->stats['total_users'] ?? 0,
            'activeUsers' => $this->stats['active_users'] ?? 0,
            'totalEquipments' => $this->stats['total_equipements'] ?? 0,
            'availableEquipments' => $this->stats['available_equipments'] ?? 0,
            'totalCheckouts' => $this->stats['total_checkouts'] ?? 0,
            'pendingCheckouts' => $this->stats['pending_checkouts'] ?? 0,

            // Données récentes
            'recentTickets' => $this->recentTickets,
            'recentEquipments' => $this->recentEquipments,
            'recentActivities' => $this->recentActivities,
        ]);
    }
}