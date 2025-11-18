<?php

namespace App\Http\Livewire\Acceuil;

use Livewire\Component;
use Livewire\WithPagination;
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
    use WithPagination;

    public $activityFilter = 'today';
    public $stats = [];
    public $name_field = 'nom';
    public $equipmentChartData = [];
    public $ticketStatusData = [];
    public $equipmentStatusData = [];
    public $monthlyTicketsData = [];
    public $monthlyCheckoutsData = [];
    
    // Variables pour les incidents
    public $totalIncidents = 0;
    public $incidentsEnCours = 0;
    public $incidentsResolus = 0;
    public $incidentsAnnules = 0;
    public $chartPeriod = 'month';
    
    // Variables supplémentaires pour les cartes incidents
    public $incidentsSemaine = 0;
    public $incidentsEnAttente = 0;
    public $incidentsMoisResolus = 0;
    public $evolutionIncidents = 0;
    public $tauxObjectif = 75;
    public $incidentsPrioriteHaute = 0;
    public $incidentsImpactEleve = 0;
    
    // Variables pour la recherche et tri
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $selectedTickets = [];
    public $selectAll = false;
    public $perPage = 10;

    public function mount()
    {
        $this->chargerStatistiques();
        $this->chargerDonneesGraphiques();
        $this->calculateIncidentsStatistics();
    }

    /**
     * Propriété calculée pour les incidents paginés
     */
    public function getIncidentsProperty()
    {
        try {
            // Si vous avez un modèle Incident, utilisez-le
            if (class_exists('App\Models\Incident') && Schema::hasTable('incidents')) {
                return \App\Models\Incident::with(['utilisateur', 'ordinateur', 'telephone'])
                    ->when($this->search, function($query) {
                        $query->where(function($q) {
                            $q->where('id', 'like', '%'.$this->search.'%')
                              ->orWhereHas('utilisateur', function($q) {
                                  $q->where('nom', 'like', '%'.$this->search.'%');
                              });
                        });
                    })
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);
            } else {
                // Sinon, utilisez les tickets paginés
                return Ticket::with(['utilisateur'])
                    ->when($this->search, function($query) {
                        $query->where(function($q) {
                            $q->where('id', 'like', '%'.$this->search.'%')
                              ->orWhereHas('utilisateur', function($q) {
                                  $q->where('nom', 'like', '%'.$this->search.'%');
                              });
                        });
                    })
                    ->orderBy($this->sortBy, $this->sortDirection)
                    ->paginate($this->perPage);
            }
        } catch (\Exception $e) {
            // Retournez une pagination vide en cas d'erreur
            return Ticket::where('id', 0)->paginate($this->perPage);
        }
    }

    /**
     * Méthodes de tri et recherche
     */
    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $field;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedTickets = $this->Incidents->pluck('id')->toArray();
        } else {
            $this->selectedTickets = [];
        }
    }

    /**
     * Calcule les statistiques des incidents
     */
    private function calculateIncidentsStatistics()
    {
        try {
            // Si vous avez un modèle Incident, utilisez-le
            if (class_exists('App\Models\Incident') && Schema::hasTable('incidents')) {
                $this->totalIncidents = \App\Models\Incident::count();
                $this->incidentsEnCours = \App\Models\Incident::where('statut', 1)->count();
                $this->incidentsResolus = \App\Models\Incident::where('statut', 2)->count();
                $this->incidentsAnnules = \App\Models\Incident::where('statut', 0)->count();
                
                // Statistiques supplémentaires
                $this->incidentsSemaine = \App\Models\Incident::where('created_at', '>=', now()->subWeek())->count();
                $this->incidentsEnAttente = \App\Models\Incident::where('statut', 1)->count();
                $this->incidentsMoisResolus = \App\Models\Incident::where('statut', 2)
                    ->whereMonth('created_at', now()->month)
                    ->count();
            } else {
                // Sinon, utilisez les tickets comme incidents
                $this->totalIncidents = $this->stats['total_tickets'] ?? 0;
                $this->incidentsEnCours = $this->stats['tickets_en_cours'] ?? 0;
                $this->incidentsResolus = $this->stats['tickets_fermes'] ?? 0;
                $this->incidentsAnnules = 0;
                
                // Statistiques supplémentaires basées sur les tickets
                $this->incidentsSemaine = Ticket::where('created_at', '>=', now()->subWeek())->count();
                $this->incidentsEnAttente = $this->stats['tickets_en_cours'] ?? 0;
                $this->incidentsMoisResolus = Ticket::where('statut', 2)
                    ->whereMonth('created_at', now()->month)
                    ->count();
            }
            
            // Calcul de l'évolution
            $lastWeek = Ticket::whereBetween('created_at', [now()->subWeeks(2), now()->subWeek()])->count();
            $this->evolutionIncidents = $lastWeek > 0 ? round((($this->incidentsSemaine - $lastWeek) / $lastWeek) * 100, 1) : 0;
            
            // Calcul du taux objectif
            $this->tauxObjectif = $this->totalIncidents > 0 ? 
                min(round(($this->incidentsResolus / $this->totalIncidents) * 100, 1), 95) : 0;
                
        } catch (\Exception $e) {
            // Valeurs par défaut en cas d'erreur
            $this->totalIncidents = $this->stats['total_tickets'] ?? 0;
            $this->incidentsEnCours = $this->stats['tickets_en_cours'] ?? 0;
            $this->incidentsResolus = $this->stats['tickets_fermes'] ?? 0;
            $this->incidentsAnnules = 0;
            $this->incidentsSemaine = 0;
            $this->incidentsEnAttente = 0;
            $this->incidentsMoisResolus = 0;
            $this->evolutionIncidents = 0;
            $this->tauxObjectif = 75;
        }
    }

    /**
     * Récupère les données pour le graphique des incidents
     */
    public function getIncidentsChartDataProperty()
    {
        return [
            'Ordinateurs' => $this->equipmentChartData['Ordinateurs'] ?? 12,
            'Téléphones' => $this->equipmentChartData['Téléphones'] ?? 8,
            'Imprimantes' => $this->equipmentChartData['Imprimantes'] ?? 5,
            'Périphériques' => $this->equipmentChartData['Périphériques'] ?? 3,
            'Réseau' => $this->equipmentChartData['Réseau'] ?? 7,
        ];
    }

    public function chargerStatistiques()
    {
        try {
            // 🧩 Statistiques utilisateurs
            $totalUsers = User::count();
            $activeUsers = $this->getActiveUsersCount();

            // 🧩 Statistiques tickets
            $totalTickets = Ticket::count();
            $ticketsOuverts = $this->getTicketsByStatus(['ouvert', 'open']);
            $ticketsEnCours = $this->getTicketsByStatus(['en_cours', 'in_progress', 'en cours', 'in progress']);
            $ticketsFermes = $this->getTicketsByStatus(['fermé', 'closed', 'resolved', 'résolu']);

            // 🧩 Total équipements = somme de toutes les tables d'équipements
            $totalEquipments = $this->getTotalEquipmentsCount();
            $availableEquipments = $this->getAvailableEquipmentsCount();

            // 🧩 Statistiques détaillées par type d'équipement
            $equipmentStats = $this->getDetailedEquipmentStats();

            // 🧩 Statistiques checkouts
            $totalCheckouts = Checkout::count();
            $pendingCheckouts = $this->getCheckoutsByStatus(['en_attente', 'pending']);
            $approvedCheckouts = $this->getCheckoutsByStatus(['approuvé', 'approved']);

            // Enregistrer toutes les stats dans un tableau pour la vue
            $this->stats = [
                'total_equipements' => $totalEquipments,
                'total_users' => $totalUsers,
                'active_users' => $activeUsers,
                'total_tickets' => $totalTickets,
                'tickets_ouverts' => $ticketsOuverts,
                'tickets_en_cours' => $ticketsEnCours,
                'tickets_fermes' => $ticketsFermes,
                'available_equipments' => $availableEquipments,
                'total_checkouts' => $totalCheckouts,
                'pending_checkouts' => $pendingCheckouts,
                'approved_checkouts' => $approvedCheckouts,
                'equipment_stats' => $equipmentStats,
            ];

        } catch (\Exception $e) {
            $this->stats = [
                'total_equipements' => 0,
                'total_users' => 0,
                'active_users' => 0,
                'total_tickets' => 0,
                'tickets_ouverts' => 0,
                'tickets_en_cours' => 0,
                'tickets_fermes' => 0,
                'available_equipments' => 0,
                'total_checkouts' => 0,
                'pending_checkouts' => 0,
                'approved_checkouts' => 0,
                'equipment_stats' => [],
            ];
        }
    }

    /**
     * Compte les utilisateurs actifs en détectant les colonnes existantes
     */
    private function getActiveUsersCount()
    {
        $userTable = (new User())->getTable();
        $columns = Schema::getColumnListing($userTable);
        
        $query = User::query();
        
        if (in_array('is_active', $columns)) {
            $query->orWhere('is_active', true);
        }
        if (in_array('actif', $columns)) {
            $query->orWhere('actif', true);
        }
        if (in_array('status', $columns)) {
            $query->orWhere('status', 'actif');
        }
        if (in_array('statut', $columns)) {
            $query->orWhere('statut', 'actif');
        }
        
        // Si aucune colonne de statut n'existe, on considère tous les utilisateurs comme actifs
        if (!in_array('is_active', $columns) && !in_array('actif', $columns) && 
            !in_array('status', $columns) && !in_array('statut', $columns)) {
            return User::count();
        }
        
        return $query->count();
    }

    /**
     * Compte les tickets par statut en détectant les colonnes existantes
     */
    private function getTicketsByStatus($statuses)
    {
        if (!Schema::hasTable('tickets')) {
            return 0;
        }

        $ticketTable = (new Ticket())->getTable();
        $columns = Schema::getColumnListing($ticketTable);
        
        $query = Ticket::query();
        $hasWhere = false;

        foreach ($statuses as $status) {
            if (in_array('status', $columns)) {
                $query->orWhere('status', $status);
                $hasWhere = true;
            }
            if (in_array('statut', $columns)) {
                $query->orWhere('statut', $status);
                $hasWhere = true;
            }
        }

        return $hasWhere ? $query->count() : 0;
    }

    /**
     * Compte les checkouts par statut en détectant les colonnes existantes
     */
    private function getCheckoutsByStatus($statuses)
    {
        if (!Schema::hasTable('checkouts')) {
            return 0;
        }

        $checkoutTable = (new Checkout())->getTable();
        $columns = Schema::getColumnListing($checkoutTable);
        
        $query = Checkout::query();
        $hasWhere = false;

        foreach ($statuses as $status) {
            if (in_array('status', $columns)) {
                $query->orWhere('status', $status);
                $hasWhere = true;
            }
            if (in_array('statut', $columns)) {
                $query->orWhere('statut', $status);
                $hasWhere = true;
            }
        }

        return $hasWhere ? $query->count() : 0;
    }

    /**
     * Charge les données pour les graphiques
     */
    public function chargerDonneesGraphiques()
    {
        $this->equipmentChartData = $this->getEquipmentChartData();
        $this->ticketStatusData = $this->getTicketStatusData();
        $this->equipmentStatusData = $this->getEquipmentStatusData();
        $this->monthlyTicketsData = $this->getMonthlyTicketsData();
        $this->monthlyCheckoutsData = $this->getMonthlyCheckoutsData();
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

        $tables = [
            'ordinateurs' => Ordinateur::class,
            'imprimantes' => Imprimante::class,
            'telephones' => Telephone::class,
            'peripheriques' => Peripherique::class,
            'moniteurs' => Moniteur::class,
            'materiel_reseaus' => MaterielReseau::class,
        ];

        foreach ($tables as $tableName => $modelClass) {
            if (Schema::hasTable($tableName)) {
                $model = new $modelClass();
                $table = $model->getTable();
                $columns = Schema::getColumnListing($table);
                
                $query = $modelClass::query();
                $hasWhere = false;

                $availableStatuses = ['disponible', 'available', 'libre', 'free'];
                
                foreach ($availableStatuses as $status) {
                    if (in_array('status', $columns)) {
                        $query->orWhere('status', $status);
                        $hasWhere = true;
                    }
                    if (in_array('statut', $columns)) {
                        $query->orWhere('statut', $status);
                        $hasWhere = true;
                    }
                }

                if ($hasWhere) {
                    $available += $query->count();
                } else {
                    // Si aucune colonne de statut n'existe, on compte tous les équipements
                    $available += $modelClass::count();
                }
            }
        }

        return $available;
    }

    /**
     * Récupère les statistiques détaillées par type d'équipement
     */
    private function getDetailedEquipmentStats()
    {
        $stats = [];

        $equipmentTypes = [
            'ordinateurs' => [
                'class' => Ordinateur::class,
                'name' => 'Ordinateurs'
            ],
            'imprimantes' => [
                'class' => Imprimante::class,
                'name' => 'Imprimantes'
            ],
            'telephones' => [
                'class' => Telephone::class,
                'name' => 'Téléphones'
            ],
            'peripheriques' => [
                'class' => Peripherique::class,
                'name' => 'Périphériques'
            ],
            'moniteurs' => [
                'class' => Moniteur::class,
                'name' => 'Moniteurs'
            ],
            'materiel_reseaus' => [
                'class' => MaterielReseau::class,
                'name' => 'Réseau'
            ],
        ];

        foreach ($equipmentTypes as $tableName => $config) {
            if (Schema::hasTable($tableName)) {
                $modelClass = $config['class'];
                $model = new $modelClass();
                $table = $model->getTable();
                $columns = Schema::getColumnListing($table);
                
                $stats[$tableName] = [
                    'total' => $modelClass::count(),
                    'disponibles' => $this->countEquipmentByStatus($modelClass, $columns, ['disponible', 'available', 'libre', 'free']),
                    'en_utilisation' => $this->countEquipmentByStatus($modelClass, $columns, ['utilisé', 'in_use', 'affecté', 'assigned', 'en_utilisation']),
                    'en_maintenance' => $this->countEquipmentByStatus($modelClass, $columns, ['maintenance', 'réparation', 'repair']),
                    'hors_service' => $this->countEquipmentByStatus($modelClass, $columns, ['hors_service', 'out_of_service', 'cassé', 'broken']),
                ];
            }
        }

        return $stats;
    }

    /**
     * Compte les équipements par statut
     */
    private function countEquipmentByStatus($modelClass, $columns, $statuses)
    {
        $query = $modelClass::query();
        $hasWhere = false;

        foreach ($statuses as $status) {
            if (in_array('status', $columns)) {
                $query->orWhere('status', $status);
                $hasWhere = true;
            }
            if (in_array('statut', $columns)) {
                $query->orWhere('statut', $status);
                $hasWhere = true;
            }
        }

        return $hasWhere ? $query->count() : 0;
    }

    /**
     * Récupère les données pour le graphique des équipements par type - CORRIGÉ
     */
    public function getEquipmentChartData()
    {
        $data = [];
        
        $equipmentTypes = [
            'Ordinateurs' => Ordinateur::class,
            'Imprimantes' => Imprimante::class,
            'Téléphones' => Telephone::class,
            'Périphériques' => Peripherique::class,
            'Moniteurs' => Moniteur::class,
            'Réseau' => MaterielReseau::class,
            'Logiciels' => Logiciel::class,
        ];

        foreach ($equipmentTypes as $name => $modelClass) {
            try {
                $tableName = (new $modelClass())->getTable();
                if (Schema::hasTable($tableName)) {
                    $count = $modelClass::count();
                    $data[$name] = $count;
                } else {
                    $data[$name] = 0;
                }
            } catch (\Exception $e) {
                \Log::error("Erreur pour $name: " . $e->getMessage());
                $data[$name] = 0;
            }
        }

        return $data;
    }

    /**
     * Récupère les données pour le graphique des tickets par statut - CORRIGÉ
     */
    public function getTicketStatusData()
    {
        try {
            if (!Schema::hasTable('tickets')) {
                return ['Ouverts' => 0, 'En cours' => 0, 'Fermés' => 0];
            }

            // Compter directement avec des requêtes séparées pour plus de fiabilité
            $ouverts = Ticket::where(function($query) {
                $query->where('status', 'ouvert')
                      ->orWhere('status', 'open')
                      ->orWhere('statut', 'ouvert')
                      ->orWhere('statut', 'open');
            })->count();

            $enCours = Ticket::where(function($query) {
                $query->where('status', 'en_cours')
                      ->orWhere('status', 'in_progress')
                      ->orWhere('status', 'en cours')
                      ->orWhere('statut', 'en_cours')
                      ->orWhere('statut', 'in_progress')
                      ->orWhere('statut', 'en cours');
            })->count();

            $fermes = Ticket::where(function($query) {
                $query->where('status', 'fermé')
                      ->orWhere('status', 'closed')
                      ->orWhere('status', 'resolved')
                      ->orWhere('status', 'résolu')
                      ->orWhere('statut', 'fermé')
                      ->orWhere('statut', 'closed')
                      ->orWhere('statut', 'resolved')
                      ->orWhere('statut', 'résolu');
            })->count();

            $data = [
                'Ouverts' => $ouverts,
                'En cours' => $enCours,
                'Fermés' => $fermes,
            ];

            return $data;
            
        } catch (\Exception $e) {
            \Log::error('Erreur dans getTicketStatusData: ' . $e->getMessage());
            return ['Ouverts' => 0, 'En cours' => 0, 'Fermés' => 0];
        }
    }

    /**
     * Récupère les données pour le graphique des statuts d'équipements - CORRIGÉ
     */
    public function getEquipmentStatusData()
    {
        $data = [
            'Disponibles' => 0,
            'En utilisation' => 0,
            'En maintenance' => 0,
            'Hors service' => 0,
        ];

        $tables = [
            'ordinateurs' => Ordinateur::class,
            'imprimantes' => Imprimante::class,
            'telephones' => Telephone::class,
            'peripheriques' => Peripherique::class,
            'moniteurs' => Moniteur::class,
            'materiel_reseaus' => MaterielReseau::class,
        ];

        foreach ($tables as $tableName => $modelClass) {
            try {
                if (Schema::hasTable($tableName)) {
                    $model = new $modelClass();
                    $columns = Schema::getColumnListing($model->getTable());
                    
                    // Compter avec des requêtes plus précises
                    $disponibles = $modelClass::where(function($query) use ($columns) {
                        if (in_array('status', $columns)) {
                            $query->where('status', 'disponible')
                                  ->orWhere('status', 'available')
                                  ->orWhere('status', 'libre')
                                  ->orWhere('status', 'free');
                        }
                        if (in_array('statut', $columns)) {
                            $query->orWhere('statut', 'disponible')
                                  ->orWhere('statut', 'available')
                                  ->orWhere('statut', 'libre')
                                  ->orWhere('statut', 'free');
                        }
                    })->count();

                    $enUtilisation = $modelClass::where(function($query) use ($columns) {
                        if (in_array('status', $columns)) {
                            $query->where('status', 'utilisé')
                                  ->orWhere('status', 'in_use')
                                  ->orWhere('status', 'affecté')
                                  ->orWhere('status', 'assigned')
                                  ->orWhere('status', 'en_utilisation');
                        }
                        if (in_array('statut', $columns)) {
                            $query->orWhere('statut', 'utilisé')
                                  ->orWhere('statut', 'in_use')
                                  ->orWhere('statut', 'affecté')
                                  ->orWhere('statut', 'assigned')
                                  ->orWhere('statut', 'en_utilisation');
                        }
                    })->count();

                    $maintenance = $modelClass::where(function($query) use ($columns) {
                        if (in_array('status', $columns)) {
                            $query->where('status', 'maintenance')
                                  ->orWhere('status', 'réparation')
                                  ->orWhere('status', 'repair');
                        }
                        if (in_array('statut', $columns)) {
                            $query->orWhere('statut', 'maintenance')
                                  ->orWhere('statut', 'réparation')
                                  ->orWhere('statut', 'repair');
                        }
                    })->count();

                    $horsService = $modelClass::where(function($query) use ($columns) {
                        if (in_array('status', $columns)) {
                            $query->where('status', 'hors_service')
                                  ->orWhere('status', 'out_of_service')
                                  ->orWhere('status', 'cassé')
                                  ->orWhere('status', 'broken');
                        }
                        if (in_array('statut', $columns)) {
                            $query->orWhere('statut', 'hors_service')
                                  ->orWhere('statut', 'out_of_service')
                                  ->orWhere('statut', 'cassé')
                                  ->orWhere('statut', 'broken');
                        }
                    })->count();

                    $data['Disponibles'] += $disponibles;
                    $data['En utilisation'] += $enUtilisation;
                    $data['En maintenance'] += $maintenance;
                    $data['Hors service'] += $horsService;
                }
            } catch (\Exception $e) {
                \Log::error("Erreur statut équipement $tableName: " . $e->getMessage());
            }
        }

        return $data;
    }

    /**
     * Récupère les données des tickets par mois pour l'année en cours
     */
    public function getMonthlyTicketsData()
    {
        if (!Schema::hasTable('tickets')) {
            return array_fill(0, 12, 0);
        }

        $currentYear = date('Y');
        $monthlyData = [];

        for ($month = 1; $month <= 12; $month++) {
            $count = Ticket::whereYear('created_at', $currentYear)
                          ->whereMonth('created_at', $month)
                          ->count();
            $monthlyData[] = $count;
        }

        return $monthlyData;
    }

    /**
     * Récupère les données des checkouts par mois pour l'année en cours
     */
    public function getMonthlyCheckoutsData()
    {
        if (!Schema::hasTable('checkouts')) {
            return array_fill(0, 12, 0);
        }

        $currentYear = date('Y');
        $monthlyData = [];

        for ($month = 1; $month <= 12; $month++) {
            $count = Checkout::whereYear('created_at', $currentYear)
                            ->whereMonth('created_at', $month)
                            ->count();
            $monthlyData[] = $count;
        }

        return $monthlyData;
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
                // Détection du champ de titre
                $title = 'Sans titre';
                if (isset($ticket->titre)) $title = $ticket->titre;
                elseif (isset($ticket->sujet)) $title = $ticket->sujet;
                elseif (isset($ticket->title)) $title = $ticket->title;
                
                // Détection du champ de statut
                $status = 'inconnu';
                if (isset($ticket->statut)) $status = $ticket->statut;
                elseif (isset($ticket->status)) $status = $ticket->status;

                return [
                    'id' => $ticket->id,
                    'title' => $title,
                    'status' => $status,
                    'status_class' => $this->getStatusClass($status),
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
                    // Détection du nom
                    $nameField = $config['name_field'];
                    $name = $config['type'];
                    if (isset($item->$nameField)) $name = $item->$nameField;
                    elseif (isset($item->modele)) $name = $item->modele;
                    elseif (isset($item->marque)) $name = $item->marque;
                    
                    // Détection du statut
                    $status = 'inconnu';
                    if (isset($item->statut)) $status = $item->statut;
                    elseif (isset($item->status)) $status = $item->status;

                    return [
                        'name' => $name,
                        'type' => $config['type'],
                        'status' => $status,
                        'status_class' => $this->getEquipmentStatusClass($status),
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
                $name = 'Utilisateur';
                if (isset($user->name)) $name = $user->name;
                elseif (isset($user->nom)) $name = $user->nom;
                elseif (isset($user->prenom)) $name = $user->prenom;
                
                $activities[] = [
                    'icon' => 'user-plus',
                    'description' => 'Nouvel utilisateur: ' . $name,
                    'time' => $user->created_at->diffForHumans()
                ];
            }
        }

        // Checkouts récents
        if (Schema::hasTable('checkouts')) {
            $recentCheckouts = Checkout::latest()->take(1)->get();
            foreach ($recentCheckouts as $checkout) {
                $activities[] = [
                    'icon' => 'exchange-alt',
                    'description' => 'Nouveau checkout',
                    'time' => $checkout->created_at->diffForHumans()
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
        $status = strtolower($status);
        
        if (in_array($status, ['ouvert', 'open'])) return 'warning';
        if (in_array($status, ['en_cours', 'in_progress', 'en cours', 'in progress'])) return 'info';
        if (in_array($status, ['résolu', 'resolved', 'fermé', 'closed'])) return 'success';
        
        return 'light';
    }

    /**
     * Détermine la classe CSS pour le statut des équipements
     */
    private function getEquipmentStatusClass($status)
    {
        $status = strtolower($status);
        
        if (in_array($status, ['disponible', 'available', 'libre', 'free'])) return 'success';
        if (in_array($status, ['affecté', 'in_use', 'utilisé', 'en_utilisation', 'assigned'])) return 'info';
        if (in_array($status, ['maintenance', 'réparation', 'repair'])) return 'warning';
        if (in_array($status, ['hors_service', 'broken', 'cassé', 'out_of_service'])) return 'danger';
        
        return 'light';
    }

    /**
     * Méthodes d'action
     */
    public function Visualiser($incidentId)
    {
        session()->flash('message', 'Visualisation de l\'incident #' . $incidentId);
    }

    public function SupprimerDemande($incidentId)
    {
        try {
            if (class_exists('App\Models\Incident')) {
                $incident = \App\Models\Incident::find($incidentId);
                if ($incident) {
                    $incident->delete();
                    $this->calculateIncidentsStatistics();
                }
            } else {
                $ticket = Ticket::find($incidentId);
                if ($ticket) {
                    $ticket->delete();
                    $this->chargerStatistiques();
                    $this->calculateIncidentsStatistics();
                }
            }
            session()->flash('message', 'Incident supprimé avec succès.');
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression.');
        }
    }

    public function confirmDelete($incidentId)
    {
        $this->dispatchBrowserEvent('confirm-delete', ['id' => $incidentId]);
    }

    public function refreshCharts()
    {
        $this->chargerStatistiques();
        $this->chargerDonneesGraphiques();
        $this->calculateIncidentsStatistics();
        $this->dispatchBrowserEvent('chartsRefreshed');
    }

    public function render()
    {
        return view('livewire.acceuil.acceuil', [
            // Statistiques principales
            'totalTickets' => $this->stats['total_tickets'] ?? 0,
            'openTickets' => $this->stats['tickets_ouverts'] ?? 0,
            'ticketsEnCours' => $this->stats['tickets_en_cours'] ?? 0,
            'closedTickets' => $this->stats['tickets_fermes'] ?? 0,
            'totalUsers' => $this->stats['total_users'] ?? 0,
            'activeUsers' => $this->stats['active_users'] ?? 0,
            'totalEquipments' => $this->stats['total_equipements'] ?? 0,
            'availableEquipments' => $this->stats['available_equipments'] ?? 0,
            'totalCheckouts' => $this->stats['total_checkouts'] ?? 0,
            'pendingCheckouts' => $this->stats['pending_checkouts'] ?? 0,
            'approvedCheckouts' => $this->stats['approved_checkouts'] ?? 0,

            // Données pour graphiques
            'equipmentChartData' => $this->equipmentChartData,
            'ticketStatusData' => $this->ticketStatusData,
            'equipmentStatusData' => $this->equipmentStatusData,
            'monthlyTicketsData' => $this->monthlyTicketsData,
            'monthlyCheckoutsData' => $this->monthlyCheckoutsData,

            // Données récentes
            'recentTickets' => $this->recentTickets,
            'recentEquipments' => $this->recentEquipments,
            'recentActivities' => $this->recentActivities,

            // Nouvelles variables pour les incidents
            'totalIncidents' => $this->totalIncidents,
            'incidentsEnCours' => $this->incidentsEnCours,
            'incidentsResolus' => $this->incidentsResolus,
            'incidentsAnnules' => $this->incidentsAnnules,
            'incidentsChartData' => $this->incidentsChartData,

            // Variables supplémentaires pour les cartes incidents
            'incidentsSemaine' => $this->incidentsSemaine,
            'incidentsEnAttente' => $this->incidentsEnAttente,
            'incidentsMoisResolus' => $this->incidentsMoisResolus,
            'evolutionIncidents' => $this->evolutionIncidents,
            'tauxObjectif' => $this->tauxObjectif,

            // Incidents paginés
            'Incidents' => $this->Incidents,
        ]);
    }
}