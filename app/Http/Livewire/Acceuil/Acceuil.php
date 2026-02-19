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
use App\Models\Incident;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Acceuil extends Component
{
    use WithPagination;

    public $activityFilter = 'today';
    public $stats = [];
    public $name_field = 'nom';
    public $onlyActive = false; // Filter for active items only

    
    // Données pour les graphiques
    public $equipmentChartData = [];
    public $ticketStatusData = [];
    public $equipmentStatusData = [];
    public $monthlyTicketsData = [];
    public $monthlyCheckoutsData = [];
    
    // Nouvelles données pour graphiques
    public $userRoleData = [];
    public $softwareCategoryData = [];
    public $checkoutStatusData = [];
    public $incidentPriorityData = [];
    public $equipmentAgeData = [];
    public $equipmentTypeData = [];
    public $ticketResolutionTimeData = [];
    public $departmentTicketData = [];
    public $monthlyIncidentsData = [];

    // Variables pour les graphiques Incidents
    public $incidentsChartData = [];
    public $incidentTrendData = [];
    public $incidentsByPriority = [];
    public $incidentsByType = [];

    // Variables pour les incidents
    public $totalIncidents = 0;
    public $incidentsEnCours = 0;
    public $incidentsResolus = 0;
    public $incidentsAnnules = 0;
    public $chartPeriod = 'month';
    
    // Variables supplémentaires
    public $incidentsSemaine = 0;
    public $incidentsEnAttente = 0;
    public $incidentsMoisResolus = 0;
    public $evolutionIncidents = 0;
    public $evolutionTickets = 0;
    public $evolutionCheckouts = 0;
    public $tauxObjectif = 75;
    public $incidentsPrioriteHaute = 0;
    public $incidentsImpactEleve = 0;
    public $averageIncidentResponse;

    
    // Variables pour la recherche et tri
    public $search = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';
    public $selectedTickets = [];
    public $selectAll = false;
    public $perPage = 10;
    
    // Données récentes
    public $recentTickets = [];
    public $recentEquipments = [];
    public $recentActivities = [];
    
    // Filtres avancés
    public $filters = [
        'date_start' => null,
        'date_end' => null,
        'department' => null,
        'priority' => null
    ];
    
    // Thème
    public $darkMode = false;

    public function mount()
    {
        $this->chargerStatistiques();
        $this->chargerDonneesGraphiques();
        $this->calculateIncidentsStatistics();
        $this->loadRecentData();
        $this->checkDarkMode();
        $this->chargerGraphiquesSupplementaires();
        $this->calculateGlobalTrends();
    }

    /**
     * Calcule les tendances globales
     */
    private function calculateGlobalTrends()
    {
        // Indicateurs Tickets
        $currentMonthTickets = end($this->monthlyTicketsData) ?: 0;
        $prevMonthTickets = prev($this->monthlyTicketsData) ?: 0;
        
        if ($prevMonthTickets > 0) {
            $this->evolutionTickets = round((($currentMonthTickets - $prevMonthTickets) / $prevMonthTickets) * 100, 1);
        } else {
            $this->evolutionTickets = $currentMonthTickets > 0 ? 100 : 0;
        }

        // Indicateurs Checkouts
        $currentMonthCheckouts = end($this->monthlyCheckoutsData) ?: 0;
        $prevMonthCheckouts = prev($this->monthlyCheckoutsData) ?: 0;

        if ($prevMonthCheckouts > 0) {
            $this->evolutionCheckouts = round((($currentMonthCheckouts - $prevMonthCheckouts) / $prevMonthCheckouts) * 100, 1);
        } else {
            $this->evolutionCheckouts = $currentMonthCheckouts > 0 ? 100 : 0;
        }
    }

    /**
     * Charge les données récentes
     */
    private function loadRecentData()
    {
        $this->recentTickets = $this->getRecentTickets()->toArray();
        $this->recentEquipments = $this->getRecentEquipments()->toArray();
        $this->recentActivities = $this->getRecentActivities()->toArray();
    }

    /**
     * Vérifie le mode sombre
     */
    private function checkDarkMode()
    {
        $this->darkMode = session('theme', 'light') === 'dark';
    }

    /**
     * Change le thème
     */
    public function toggleTheme()
    {
        $this->darkMode = !$this->darkMode;
        $theme = $this->darkMode ? 'dark' : 'light';
        session(['theme' => $theme]);
        $this->dispatchBrowserEvent('themeChanged', ['theme' => $theme]);
    }

    /**
     * Propriété incidents paginés
     */
    public function getIncidentsProperty()
    {
        try {
            $query = Incident::with(['utilisateur', 'ordinateur', 'telephone'])
                ->when($this->search, function($query) {
                    $query->where(function($q) {
                        $q->where('id', 'like', '%'.$this->search.'%')
                          ->orWhere('description', 'like', '%'.$this->search.'%')
                          ->orWhereHas('utilisateur', function($q) {
                              $q->where('nom', 'like', '%'.$this->search.'%')
                                ->orWhere('prenom', 'like', '%'.$this->search.'%');
                          });
                    });
                })
                ->when($this->filters['date_start'], function($query) {
                    $query->whereDate('created_at', '>=', $this->filters['date_start']);
                })
                ->when($this->filters['date_end'], function($query) {
                    $query->whereDate('created_at', '<=', $this->filters['date_end']);
                })
                ->when($this->filters['priority'], function($query) {
                    $query->where('priorite', $this->filters['priority']);
                })
                ->orderBy($this->sortBy, $this->sortDirection);

            return $query->paginate($this->perPage);
        } catch (\Exception $e) {
            return Incident::where('id', 0)->paginate($this->perPage);
        }
    }

    /**
     * Charge les graphiques supplémentaires
     */
    private function chargerGraphiquesSupplementaires()
    {
        $this->userRoleData = $this->getUserRoleData();
        $this->softwareCategoryData = $this->getSoftwareCategoryData();
        $this->checkoutStatusData = $this->getCheckoutStatusData();
        $this->incidentPriorityData = $this->getIncidentPriorityData();
        $this->equipmentAgeData = $this->getEquipmentAgeData();
        $this->ticketResolutionTimeData = $this->getTicketResolutionTimeData();
        $this->departmentTicketData = $this->getDepartmentTicketData();
        $this->monthlyIncidentsData = $this->getMonthlyIncidentsData();
        $this->equipmentTypeData = $this->getEquipmentTypeData();
    }

    /**
     * Récupère les types d'équipement
     */
    private function getEquipmentTypeData()
    {
        $stats = $this->getDetailedEquipmentStats();
        $data = [];
        
        foreach ($stats as $type => $values) {
            $label = ucfirst($type);
            if ($type == 'materiel_reseaus') $label = 'Réseau';
            $data[$label] = $values['total'] ?? 0;
        }
        
        return $data;
    }

    /**
     * Récupère les rôles utilisateurs
     */
    private function getUserRoleData()
    {
        try {
            if (!Schema::hasTable('users')) {
                return ['Administrateur' => 0, 'Utilisateur' => 0];
            }

            $users = User::select('role', DB::raw('count(*) as total'))
                        ->groupBy('role')
                        ->get();

            $data = ['Administrateur' => 0, 'Utilisateur' => 0];
            
            foreach ($users as $user) {
                $role = strtolower($user->role);
                if (str_contains($role, 'admin') || $role === 'administrateur') {
                    $data['Administrateur'] = $user->total;
                } else {
                    $data['Utilisateur'] += $user->total;
                }
            }

            return $data;
        } catch (\Exception $e) {
            return ['Administrateur' => 1, 'Utilisateur' => 0];
        }
    }

    /**
     * Récupère les catégories de logiciels
     */
    private function getSoftwareCategoryData()
    {
        try {
            if (!Schema::hasTable('logiciels')) {
                return ['Bureautique' => 0, 'Sécurité' => 0, 'Développement' => 0, 'Graphisme' => 0];
            }

            $logiciels = Logiciel::select('categorie', DB::raw('count(*) as total'))
                                ->whereNotNull('categorie')
                                ->groupBy('categorie')
                                ->get();

            $data = ['Bureautique' => 0, 'Sécurité' => 0, 'Développement' => 0, 'Graphisme' => 0];
            
            foreach ($logiciels as $logiciel) {
                $categorie = strtolower($logiciel->categorie);
                if (str_contains($categorie, 'bureau')) {
                    $data['Bureautique'] = $logiciel->total;
                } elseif (str_contains($categorie, 'secur')) {
                    $data['Sécurité'] = $logiciel->total;
                } elseif (str_contains($categorie, 'dev') || str_contains($categorie, 'program')) {
                    $data['Développement'] = $logiciel->total;
                } elseif (str_contains($categorie, 'graph') || str_contains($categorie, 'design')) {
                    $data['Graphisme'] = $logiciel->total;
                }
            }

            return $data;
        } catch (\Exception $e) {
            return ['Bureautique' => 5, 'Sécurité' => 3, 'Développement' => 2, 'Graphisme' => 1];
        }
    }

    /**
     * Récupère les statuts des checkouts
     */
    private function getCheckoutStatusData()
    {
        try {
            if (!Schema::hasTable('checkouts')) {
                return ['En attente' => 0, 'Approuvé' => 0, 'Retourné' => 0, 'En retard' => 0];
            }

            $checkouts = Checkout::select('statut', DB::raw('count(*) as total'))
                                ->groupBy('statut')
                                ->get();

            $data = ['En attente' => 0, 'Approuvé' => 0, 'Retourné' => 0, 'En retard' => 0];
            
            foreach ($checkouts as $checkout) {
                $statut = strtolower($checkout->statut);
                if (str_contains($statut, 'attente') || str_contains($statut, 'pending')) {
                    $data['En attente'] = $checkout->total;
                } elseif (str_contains($statut, 'approuvé') || str_contains($statut, 'approved')) {
                    $data['Approuvé'] = $checkout->total;
                } elseif (str_contains($statut, 'retourné') || str_contains($statut, 'returned')) {
                    $data['Retourné'] = $checkout->total;
                } elseif (str_contains($statut, 'retard') || str_contains($statut, 'late')) {
                    $data['En retard'] = $checkout->total;
                }
            }

            return $data;
        } catch (\Exception $e) {
            return ['En attente' => 2, 'Approuvé' => 8, 'Retourné' => 5, 'En retard' => 1];
        }
    }

    /**
     * Récupère les priorités des incidents
     */
    private function getIncidentPriorityData()
    {
        return ['Haute' => 0, 'Moyenne' => 0, 'Basse' => 0];
    }

    /**
     * Récupère l'âge des équipements
     */
    private function getEquipmentAgeData()
    {
        try {
            $data = [
                '< 1 an' => 0,
                '1-3 ans' => 0,
                '3-5 ans' => 0,
                '> 5 ans' => 0
            ];

            $tables = [
                'ordinateurs' => Ordinateur::class,
                'imprimantes' => Imprimante::class,
                'telephones' => Telephone::class,
            ];

            foreach ($tables as $tableName => $modelClass) {
                if (Schema::hasTable($tableName)) {
                    $columns = Schema::getColumnListing($tableName);
                    
                    if (in_array('date_acquisition', $columns) || in_array('purchase_date', $columns)) {
                        $dateField = in_array('date_acquisition', $columns) ? 'date_acquisition' : 'purchase_date';
                        
                        $equipments = $modelClass::whereNotNull($dateField)->get();
                        
                        foreach ($equipments as $equipment) {
                            $acquisitionDate = Carbon::parse($equipment->$dateField);
                            $ageInYears = now()->diffInYears($acquisitionDate);
                            
                            if ($ageInYears < 1) {
                                $data['< 1 an']++;
                            } elseif ($ageInYears <= 3) {
                                $data['1-3 ans']++;
                            } elseif ($ageInYears <= 5) {
                                $data['3-5 ans']++;
                            } else {
                                $data['> 5 ans']++;
                            }
                        }
                    }
                }
            }

            return $data;
        } catch (\Exception $e) {
            return ['< 1 an' => 15, '1-3 ans' => 25, '3-5 ans' => 10, '> 5 ans' => 5];
        }
    }

    /**
     * Récupère le temps de résolution des tickets
     */
    private function getTicketResolutionTimeData()
    {
        try {
            if (!Schema::hasTable('tickets')) {
                return ['< 24h' => 0, '1-3 jours' => 0, '3-7 jours' => 0, '> 7 jours' => 0];
            }

            $tickets = Ticket::whereNotNull('closed_at')
                            ->orWhere(function($query) {
                                $query->where('statut', 'résolu')
                                      ->orWhere('statut', 'resolved')
                                      ->orWhere('statut', 'fermé')
                                      ->orWhere('statut', 'closed');
                            })
                            ->get();

            $data = ['< 24h' => 0, '1-3 jours' => 0, '3-7 jours' => 0, '> 7 jours' => 0];
            
            foreach ($tickets as $ticket) {
                $created = Carbon::parse($ticket->created_at);
                $closed = $ticket->closed_at ? Carbon::parse($ticket->closed_at) : now();
                $resolutionTime = $created->diffInDays($closed);
                
                if ($resolutionTime < 1) {
                    $data['< 24h']++;
                } elseif ($resolutionTime <= 3) {
                    $data['1-3 jours']++;
                } elseif ($resolutionTime <= 7) {
                    $data['3-7 jours']++;
                } else {
                    $data['> 7 jours']++;
                }
            }

            return $data;
        } catch (\Exception $e) {
            return ['< 24h' => 12, '1-3 jours' => 25, '3-7 jours' => 8, '> 7 jours' => 3];
        }
    }

    /**
     * Récupère les tickets par département
     */
    private function getDepartmentTicketData()
    {
        try {
            if (!Schema::hasTable('tickets')) {
                return ['IT' => 0, 'RH' => 0, 'Comptabilité' => 0, 'Marketing' => 0, 'Production' => 0];
            }

            $tickets = Ticket::select('departement', DB::raw('count(*) as total'))
                            ->whereNotNull('departement')
                            ->groupBy('departement')
                            ->get();

            $data = ['IT' => 0, 'RH' => 0, 'Comptabilité' => 0, 'Marketing' => 0, 'Production' => 0];
            
            foreach ($tickets as $ticket) {
                $dept = strtoupper($ticket->departement);
                if (str_contains($dept, 'IT') || str_contains($dept, 'INFORMATIQUE')) {
                    $data['IT'] = $ticket->total;
                } elseif (str_contains($dept, 'RH') || str_contains($dept, 'RESSOURCES')) {
                    $data['RH'] = $ticket->total;
                } elseif (str_contains($dept, 'COMPTA') || str_contains($dept, 'FINANCE')) {
                    $data['Comptabilité'] = $ticket->total;
                } elseif (str_contains($dept, 'MARKETING') || str_contains($dept, 'COMMERCIAL')) {
                    $data['Marketing'] = $ticket->total;
                } elseif (str_contains($dept, 'PRODUCTION') || str_contains($dept, 'OPERATIONS')) {
                    $data['Production'] = $ticket->total;
                }
            }

            return $data;
        } catch (\Exception $e) {
            return ['IT' => 35, 'RH' => 12, 'Comptabilité' => 8, 'Marketing' => 15, 'Production' => 20];
        }
    }

    /**
     * Récupère les incidents par mois
     */
    private function getMonthlyIncidentsData()
    {
        if (!Schema::hasTable('incidents')) {
            return array_fill(0, 12, 0);
        }

        $currentYear = date('Y');
        $monthlyData = [];

        for ($month = 1; $month <= 12; $month++) {
            $count = Incident::whereYear('created_at', $currentYear)
                          ->whereMonth('created_at', $month)
                          ->count();
            $monthlyData[] = $count;
        }

        return $monthlyData;
    }

    /**
     * Méthodes de tri
     */
    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $field;
        $this->resetPage();
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
     * Applique les filtres
     */
    public function applyFilters()
    {
        $this->resetPage();
        $this->chargerStatistiques();
        $this->chargerDonneesGraphiques();
        $this->chargerGraphiquesSupplementaires();
    }

    /**
     * Réinitialise les filtres
     */
    public function resetFilters()
    {
        $this->filters = [
            'date_start' => null,
            'date_end' => null,
            'department' => null,
            'priority' => null
        ];
        $this->applyFilters();
    }

    /**
     * Calcule les statistiques des incidents
     */
    private function calculateIncidentsStatistics()
    {
        try {
            $this->totalIncidents = Incident::count();
            $this->incidentsEnCours = Incident::where('statut', 'en_cours')->count();
            $this->incidentsResolus = Incident::where('statut', 'résolu')->count();
            $this->incidentsAnnules = Incident::where('statut', 'annulé')->count();
            
            $this->incidentsSemaine = Incident::where('created_at', '>=', now()->subWeek())->count();
            $this->incidentsEnAttente = Incident::where('statut', 'en_attente')->count();
            $this->incidentsMoisResolus = Incident::where('statut', 'résolu')
                ->whereMonth('created_at', now()->month)
                ->count();
                
            $this->incidentsPrioriteHaute = Incident::where('priorite', 'haute')->count();
            $this->incidentsImpactEleve = Incident::where('impact', 'élevé')->count();
            
            $lastWeek = Incident::whereBetween('created_at', [now()->subWeeks(2), now()->subWeek()])->count();
            $this->evolutionIncidents = $lastWeek > 0 ? 
                round((($this->incidentsSemaine - $lastWeek) / $lastWeek) * 100, 1) : 0;
            
            $this->tauxObjectif = $this->totalIncidents > 0 ? 
                min(round(($this->incidentsResolus / $this->totalIncidents) * 100, 1), 95) : 0;
                
        } catch (\Exception $e) {
            $this->resetIncidentStats();
        }
    }

    /**
     * Réinitialise les stats incidents
     */
    private function resetIncidentStats()
    {
        $this->totalIncidents = 0;
        $this->incidentsEnCours = 0;
        $this->incidentsResolus = 0;
        $this->incidentsAnnules = 0;
        $this->incidentsSemaine = 0;
        $this->incidentsEnAttente = 0;
        $this->incidentsMoisResolus = 0;
        $this->evolutionIncidents = 0;
        $this->tauxObjectif = 75;
        $this->incidentsPrioriteHaute = 0;
        $this->incidentsImpactEleve = 0;
    }

    /**
     * Données pour graphique incidents
     */
    public function getIncidentsChartDataProperty()
    {
        try {
            return [
                'Ordinateurs' => Incident::whereHas('ordinateur')->count(),
                'Téléphones' => Incident::whereHas('telephone')->count(),
                'Imprimantes' => Incident::whereHas('imprimante')->count(),
                'Périphériques' => Incident::whereHas('peripherique')->count(),
                'Réseau' => Incident::whereHas('materielReseau')->count(),
            ];
        } catch (\Exception $e) {
            return [
                'Ordinateurs' => 0,
                'Téléphones' => 0,
                'Imprimantes' => 0,
                'Périphériques' => 0,
                'Réseau' => 0,
            ];
        }
    }

    /**
     * Charge les statistiques principales
     */
    public function chargerStatistiques()
    {
        try {
            $totalUsers = User::count();
            $activeUsers = $this->getActiveUsersCount();

            $totalTickets = Ticket::count();
            $ticketsOuverts = $this->getTicketsByStatus(['ouvert', 'open']);
            $ticketsEnCours = $this->getTicketsByStatus(['en_cours', 'in_progress', 'en cours', 'in progress']);
            $ticketsFermes = $this->getTicketsByStatus(['fermé', 'closed', 'resolved', 'résolu']);

            $totalEquipments = $this->getTotalEquipmentsCount();
            $availableEquipments = $this->getAvailableEquipmentsCount();
            $equipmentStats = $this->getDetailedEquipmentStats();

            $totalCheckouts = Checkout::count();
            $pendingCheckouts = $this->getCheckoutsByStatus(['en_attente', 'pending']);
            $approvedCheckouts = $this->getCheckoutsByStatus(['approuvé', 'approved']);

            $totalIncidents = Incident::count();
            $incidentsEnCours = Incident::where('statut', 'en_cours')->count();

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
                'total_incidents' => $totalIncidents,
                'incidents_en_cours' => $incidentsEnCours,
                'equipment_stats' => $equipmentStats,
            ];

        } catch (\Exception $e) {
            $this->resetAllStats();
        }
    }

    /**
     * Réinitialise toutes les stats
     */
    private function resetAllStats()
    {
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
            'total_incidents' => 0,
            'incidents_en_cours' => 0,
            'equipment_stats' => [],
        ];
    }

    /**
     * Compte les utilisateurs actifs
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
        
        if (!in_array('is_active', $columns) && !in_array('actif', $columns) && 
            !in_array('status', $columns) && !in_array('statut', $columns)) {
            return User::count();
        }
        
        return $query->count();
    }

    /**
     * Compte les tickets par statut
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
     * Compte les checkouts par statut
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
     * Charge les données graphiques
     */
    public function chargerDonneesGraphiques()
    {
        $this->equipmentChartData = $this->getEquipmentChartData();
        $this->ticketStatusData = $this->getTicketStatusData();
        $this->equipmentStatusData = $this->getEquipmentStatusData();
        $this->monthlyTicketsData = $this->getMonthlyTicketsData();
        $this->monthlyCheckoutsData = $this->getMonthlyCheckoutsData();
        
        $this->incidentsChartData = $this->getIncidentsStatusData();
        $this->incidentTrendData = $this->getIncidentTrendData();
        $this->incidentsByPriority = $this->getIncidentsByPriority();
        $this->incidentsByType = $this->getIncidentsByType();
    }

    /**
     * Calcule le total équipements
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
     * Calcule les équipements disponibles
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
                    $available += $modelClass::count();
                }
            }
        }

        return $available;
    }

    /**
     * Statistiques détaillées équipements
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
     * Compte équipements par statut
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
     * Graphique équipements par type
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
     * Graphique tickets par statut
     */
    public function getTicketStatusData()
    {
        try {
            if (!Schema::hasTable('tickets')) {
                return ['Ouverts' => 0, 'En cours' => 0, 'Fermés' => 0];
            }

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

            return [
                'Ouverts' => $ouverts,
                'En cours' => $enCours,
                'Fermés' => $fermes,
            ];
            
        } catch (\Exception $e) {
            \Log::error('Erreur dans getTicketStatusData: ' . $e->getMessage());
            return ['Ouverts' => 0, 'En cours' => 0, 'Fermés' => 0];
        }
    }

    /**
     * Graphique statut équipements
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
     * Tickets par mois
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
     * Checkouts par mois
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
     * Tickets récents
     */
    private function getRecentTickets()
    {
        if (!Schema::hasTable('tickets')) {
            return collect();
        }

        $tickets = Ticket::latest()->take(10)->get();
        
        return $tickets->map(function($ticket) {
                $title = 'Sans titre';
                if (isset($ticket->titre)) $title = $ticket->titre;
                elseif (isset($ticket->sujet)) $title = $ticket->sujet;
                elseif (isset($ticket->title)) $title = $ticket->title;
                
                $status = 'inconnu';
                if (isset($ticket->statut)) $status = $ticket->statut;
                elseif (isset($ticket->status)) $status = $ticket->status;

                $priority = 'normale';
                if (isset($ticket->priorite)) $priority = $ticket->priorite;
                elseif (isset($ticket->priority)) $priority = $ticket->priority;

                $user = 'Non assigné';
                if (isset($ticket->user)) $user = $ticket->user->name ?? $ticket->user->nom ?? $ticket->user->email ?? 'Utilisateur';
                elseif (isset($ticket->utilisateur)) $user = $ticket->utilisateur->nom ?? 'Utilisateur';
                elseif (isset($ticket->user_id)) {
                    $u = User::find($ticket->user_id);
                    if ($u) $user = $u->name ?? $u->nom ?? $u->email ?? 'Utilisateur';
                }

                $isUrgent = in_array(strtolower($priority), ['urgent', 'haute', 'high', 'critique', 'critical']);

                return [
                    'id' => $ticket->id,
                    'title' => $title,
                    'status' => $status,
                    'status_class' => $this->getStatusClass($status),
                    'priority' => ucfirst($priority),
                    'priority_class' => $isUrgent ? 'danger' : 'light',
                    'is_urgent' => $isUrgent,
                    'user' => $user,
                    'created_at' => $ticket->created_at->diffForHumans(),
                    'raw_date' => $ticket->created_at
                ];
            })
            ->sortByDesc(function($ticket) {
                return ($ticket['is_urgent'] ? 1 : 0) * 1000000000 + $ticket['raw_date']->timestamp;
            })
            ->values();
    }

    /**
     * Équipements récents
     */
    private function getRecentEquipments()
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
                    $nameField = $config['name_field'];
                    $name = $config['type'];
                    if (isset($item->$nameField)) $name = $item->$nameField;
                    elseif (isset($item->modele)) $name = $item->modele;
                    elseif (isset($item->marque)) $name = $item->marque;
                    
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

        return $equipments->sortByDesc(function($item) {
            return strtotime($item['added_date']);
        })->take(5);
    }

    /**
     * Activités récentes
     */
    private function getRecentActivities()
    {
        $activities = collect();

        if (Schema::hasTable('tickets')) {
            $recentTickets = Ticket::latest()->take(2)->get();
            foreach ($recentTickets as $ticket) {
                $activities->push([
                    'icon' => 'ticket-perforated',
                    'description' => 'Nouveau ticket #' . $ticket->id,
                    'time' => $ticket->created_at->diffForHumans()
                ]);
            }
        }

        $recentEquipments = collect($this->recentEquipments)->take(2);
        foreach ($recentEquipments as $equipment) {
            $activities->push([
                'icon' => 'laptop',
                'description' => 'Nouvel équipement: ' . $equipment['name'],
                'time' => $equipment['added_date']
            ]);
        }

        if (Schema::hasTable('users')) {
            $recentUsers = User::latest()->take(1)->get();
            foreach ($recentUsers as $user) {
                $name = 'Utilisateur';
                if (isset($user->name)) $name = $user->name;
                elseif (isset($user->nom)) $name = $user->nom;
                elseif (isset($user->prenom)) $name = $user->prenom;
                
                $activities->push([
                    'icon' => 'person-plus',
                    'description' => 'Nouvel utilisateur: ' . $name,
                    'time' => $user->created_at->diffForHumans()
                ]);
            }
        }

        if (Schema::hasTable('checkouts')) {
            $recentCheckouts = Checkout::latest()->take(1)->get();
            foreach ($recentCheckouts as $checkout) {
                $activities->push([
                    'icon' => 'arrow-left-right',
                    'description' => 'Nouveau checkout',
                    'time' => $checkout->created_at->diffForHumans()
                ]);
            }
        }

        if (Schema::hasTable('incidents')) {
            $recentIncidents = Incident::latest()->take(1)->get();
            foreach ($recentIncidents as $incident) {
                $activities->push([
                    'icon' => 'exclamation-triangle',
                    'description' => 'Nouvel incident signalé',
                    'time' => $incident->created_at->diffForHumans()
                ]);
            }
        }

        if ($activities->isEmpty()) {
            $activities = collect([
                ['icon' => 'check-circle', 'description' => 'Système GPI Pivot initialisé', 'time' => 'Maintenant'],
                ['icon' => 'person-plus', 'description' => 'Bienvenue sur votre dashboard', 'time' => 'Aujourd\'hui'],
                ['icon' => 'laptop', 'description' => 'Tableau de bord prêt à l\'emploi', 'time' => 'Récemment'],
            ]);
        }

        return $activities;
    }

    /**
     * Classe CSS pour statut tickets
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
     * Classe CSS pour statut équipements
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
     * Change le filtre période
     */
    public function setPeriod($period)
    {
        $this->activityFilter = $period;
        $this->chargerStatistiques();
        $this->chargerDonneesGraphiques();
        $this->calculateIncidentsStatistics();
        $this->chargerGraphiquesSupplementaires();
        $this->dispatchBrowserEvent('periodChanged', ['period' => $period]);
    }

    /**
     * Actions
     */
    public function Visualiser($incidentId)
    {
        $this->dispatchBrowserEvent('showIncident', ['id' => $incidentId]);
    }

    public function SupprimerDemande($incidentId)
    {
        try {
            $incident = Incident::find($incidentId);
            if ($incident) {
                $incident->delete();
                $this->calculateIncidentsStatistics();
                $this->dispatchBrowserEvent('incidentDeleted');
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('error', ['message' => 'Erreur lors de la suppression.']);
        }
    }

    public function confirmDelete($incidentId)
    {
        $this->dispatchBrowserEvent('confirm-delete', ['id' => $incidentId]);
    }

    /**
     * Rafraîchit les données
     */
    public function refreshCharts()
    {
        $this->chargerStatistiques();
        $this->chargerDonneesGraphiques();
        $this->calculateIncidentsStatistics();
        $this->chargerGraphiquesSupplementaires();
        $this->loadRecentData();
        $this->dispatchBrowserEvent('chartsRefreshed');
    }

    /**
     * Exporte les données
     */
    public function exportData($type)
    {
        $this->dispatchBrowserEvent('exportData', ['type' => $type]);
    }

    /**
     * Calcule le temps de résolution moyen
     */
    private function getIncidentResolutionTime()
    {
        try {
            if (!Schema::hasTable('incidents')) {
                return 0;
            }

            $resolvedIncidents = Incident::where('statut', 'résolu')
                ->whereNotNull('resolved_at')
                ->get();

            if ($resolvedIncidents->isEmpty()) {
                return 0;
            }

            $totalTime = 0;
            $count = 0;

            foreach ($resolvedIncidents as $incident) {
                $created = Carbon::parse($incident->created_at);
                $resolved = Carbon::parse($incident->resolved_at);
                $totalTime += $created->diffInHours($resolved);
                $count++;
            }

            return $count > 0 ? round($totalTime / $count, 1) : 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Statuts incidents
     */
    private function getIncidentsStatusData()
    {
        if (!Schema::hasTable('incidents')) return [];
        return Incident::select('statut', DB::raw('count(*) as count'))
            ->groupBy('statut')
            ->pluck('count', 'statut')
            ->toArray();
    }

    /**
     * Tendance incidents
     */
    private function getIncidentTrendData()
    {
        if (!Schema::hasTable('incidents')) return ['labels' => [], 'data' => []];
        $data = Incident::select(
                DB::raw('count(*) as count'), 
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month")
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            
        return [
            'labels' => $data->pluck('month')->toArray(),
            'data' => $data->pluck('count')->toArray()
        ];
    }

    /**
     * Incidents par priorité
     */
    private function getIncidentsByPriority()
    {
        return [
            'Haute' => 0, 
            'Moyenne' => 0, 
            'Basse' => 0
        ];
    }

    /**
     * Incidents par type
     */
    private function getIncidentsByType()
    {
        if (!Schema::hasTable('incidents')) return [];
        return Incident::select('incident_nature', DB::raw('count(*) as count'))
            ->groupBy('incident_nature')
            ->pluck('count', 'incident_nature')
            ->toArray();
    }

    /**
     * Activités unifiées
     */
    public function getUnifiedActivitiesProperty()
    {
        $activities = collect();

        // 1. Tickets
        if (Schema::hasTable('tickets')) {
            $tickets = Ticket::with(['utilisateur', 'responsable'])
                ->when($this->onlyActive, function($query) {
                    $query->where(function($q) {
                        $q->whereIn('status', ['ouvert', 'open', 'en_cours', 'in_progress', 'en cours', 'in progress'])
                          ->orWhereIn('statut', ['ouvert', 'open', 'en_cours', 'in_progress', 'en cours', 'in progress']);
                    });
                })
                ->latest()
                ->take(20)
                ->get();

            foreach ($tickets as $ticket) {
                $priority = strtolower($ticket->priorite ?? $ticket->priority ?? 'normale');
                $status = strtolower($ticket->statut ?? $ticket->status ?? 'ouvert');
                
                $color = 'warning';
                if (in_array($priority, ['urgent', 'haute', 'high', 'critique', 'critical'])) $color = 'danger';
                elseif (in_array($status, ['en_cours', 'in_progress', 'en cours', 'in progress'])) $color = 'progress';
                elseif (in_array($status, ['résolu', 'resolved', 'fermé', 'closed'])) $color = 'success';

                $userName = 'Utilisateur';
                if ($ticket->utilisateur) {
                    $userName = $ticket->utilisateur->name ?? $ticket->utilisateur->nom ?? 'Utilisateur';
                }

                $activities->push([
                    'type' => 'Ticket',
                    'icon' => 'fas fa-ticket-alt',
                    'title' => $ticket->sujet ?? $ticket->titre ?? $ticket->title ?? 'Sans titre',
                    'user' => $userName,
                    'assigned_to' => $ticket->responsable->name ?? $ticket->responsable->nom ?? '---',
                    'date' => $ticket->created_at,
                    'status' => ucfirst(str_replace('_', ' ', $status)),
                    'priority' => ucfirst($priority),
                    'priority_level' => $this->getPriorityLevel($priority, $status),
                    'color' => $color
                ]);
            }
        }

        // 2. Incidents
        if (Schema::hasTable('incidents')) {
            $incidents = Incident::with(['utilisateur', 'technicien'])
                ->when($this->onlyActive, function($query) {
                    $query->whereNotIn('statut', ['résolu', 'resolved', 'annulé', 'cancelled']);
                })
                ->latest()
                ->take(20)
                ->get();

            foreach ($incidents as $incident) {
                $status = strtolower($incident->statut ?? 'en_cours');
                
                $color = 'danger';
                if (in_array($status, ['résolu', 'resolved'])) $color = 'success';
                elseif ($status === 'en_attente') $color = 'warning';
                elseif ($status === 'en_cours') $color = 'progress';

                $userName = 'Inconnu';
                if ($incident->utilisateur) {
                    $userName = $incident->utilisateur->name ?? $incident->utilisateur->nom ?? 'Inconnu';
                }

                $activities->push([
                    'type' => 'Incident',
                    'icon' => 'fas fa-exclamation-triangle',
                    'title' => $incident->incident_sujet ?? 'Incident signalé',
                    'user' => $userName,
                    'assigned_to' => $incident->technicien->name ?? $incident->technicien->nom ?? '---',
                    'date' => $incident->created_at,
                    'status' => ucfirst(str_replace('_', ' ', $status)),
                    'priority' => 'Urgent',
                    'priority_level' => in_array($status, ['résolu', 'resolved']) ? 5 : 1,
                    'color' => $color
                ]);
            }
        }

        // 3. Checkouts
        if (Schema::hasTable('checkouts')) {
            $checkouts = Checkout::with(['utilisateur', 'responsable'])
                ->when($this->onlyActive, function($query) {
                    $query->whereIn('statut', ['en_attente', 'pending', 'approuvé', 'approved', 'en_cours', 'in_progress']);
                })
                ->latest()
                ->take(20)
                ->get();

            foreach ($checkouts as $checkout) {
                $status = strtolower($checkout->statut ?? 'en_attente');
                
                $color = 'info';
                if (in_array($status, ['en_attente', 'pending'])) $color = 'warning';
                elseif (in_array($status, ['approuvé', 'approved', 'en_cours', 'in_progress'])) $color = 'progress';
                elseif (in_array($status, ['terminé', 'retourné', 'completed', 'returned'])) $color = 'success';

                $userName = 'Inconnu';
                if ($checkout->utilisateur) {
                    $userName = $checkout->utilisateur->name ?? $checkout->utilisateur->nom ?? 'Inconnu';
                }

                $activities->push([
                    'type' => 'Sortie',
                    'icon' => 'fas fa-exchange-alt',
                    'title' => 'Check-out : ' . ($checkout->materiel_type ?? 'Équipement'),
                    'user' => $userName,
                    'assigned_to' => $checkout->responsable->name ?? $checkout->responsable->nom ?? '---',
                    'date' => $checkout->created_at,
                    'status' => ucfirst($status),
                    'priority' => 'Info',
                    'priority_level' => 4,
                    'color' => $color
                ]);
            }
        }

        return $activities->sort(function($a, $b) {
            if ($a['priority_level'] != $b['priority_level']) {
                return $a['priority_level'] <=> $b['priority_level'];
            }
            return $b['date'] <=> $a['date'];
        })->values()->take(50);
    }

    private function getPriorityLevel($priority, $status)
    {
        $priority = strtolower($priority);
        $status = strtolower($status);

        if (in_array($status, ['résolu', 'resolved', 'fermé', 'closed'])) return 5;
        if (in_array($priority, ['urgent', 'haute', 'high', 'critique', 'critical'])) return 1;
        if (in_array($priority, ['moyenne', 'medium'])) return 2;
        if (in_array($status, ['en_cours', 'in_progress', 'en cours', 'in progress'])) return 2;
        if (in_array($status, ['ouvert', 'open'])) return 3;
        return 3;
    }

    /**
     * Rendu de la vue
     */
    public function render()
    {
        return view('livewire.acceuil.acceuil', [
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
            'totalIncidents' => $this->stats['total_incidents'] ?? 0,
            'incidentsEnCours' => $this->stats['incidents_en_cours'] ?? 0,

            'equipmentChartData' => $this->equipmentChartData,
            'ticketStatusData' => $this->ticketStatusData,
            'equipmentStatusData' => $this->equipmentStatusData,
            'monthlyTicketsData' => $this->monthlyTicketsData,
            'monthlyCheckoutsData' => $this->monthlyCheckoutsData,

            'userRoleData' => $this->userRoleData,
            'softwareCategoryData' => $this->softwareCategoryData,
            'checkoutStatusData' => $this->checkoutStatusData,
            'incidentPriorityData' => $this->incidentPriorityData,
            'equipmentAgeData' => $this->equipmentAgeData,
            'ticketResolutionTimeData' => $this->ticketResolutionTimeData,
            'departmentTicketData' => $this->departmentTicketData,
            'monthlyIncidentsData' => $this->monthlyIncidentsData,
            'incidentResolutionTime' => $this->getIncidentResolutionTime(),
            'averageIncidentResponse' => $this->averageIncidentResponse,

            'recentTickets' => $this->recentTickets,
            'recentEquipments' => $this->recentEquipments,
            'recentActivities' => $this->recentActivities,

            'totalIncidents' => $this->totalIncidents,
            'incidentsEnCours' => $this->incidentsEnCours,
            'incidentsResolus' => $this->incidentsResolus,
            'incidentsAnnules' => $this->incidentsAnnules,
            'incidentsChartData' => $this->incidentsChartData,

            'incidentsSemaine' => $this->incidentsSemaine,
            'incidentsEnAttente' => $this->incidentsEnAttente,
            'incidentsMoisResolus' => $this->incidentsMoisResolus,
            'evolutionIncidents' => $this->evolutionIncidents,
            'tauxObjectif' => $this->tauxObjectif,
            'incidentsPrioriteHaute' => $this->incidentsPrioriteHaute,
            'incidentsImpactEleve' => $this->incidentsImpactEleve,

            'Incidents' => $this->Incidents,
            'equipmentStats' => $this->stats['equipment_stats'] ?? [],
            'unifiedActivities' => $this->unifiedActivities,
        ]);
    }

    public function getTrendClass($data)
    {
        if (!is_array($data) || count($data) < 2) {
            return 'neutral';
        }
        
        $current = end($data);
        $previous = prev($data);
        
        if ($current > $previous) {
            return 'positive';
        } elseif ($current < $previous) {
            return 'negative';
        }
        
        return 'neutral';
    }

    public function getTrendIcon($data)
    {
        $trend = $this->getTrendClass($data);
        
        $icons = [
            'positive' => 'arrow-up',
            'negative' => 'arrow-down',
            'neutral' => 'minus'
        ];
        
        return $icons[$trend] ?? 'minus';
    }

    public function getTrendPercentage($data)
    {
        if (!is_array($data) || count($data) < 2) {
            return '0%';
        }
        
        $current = end($data);
        $previous = prev($data);
        
        if ($previous == 0) {
            return $current > 0 ? '+∞' : '0%';
        }
        
        $change = (($current - $previous) / $previous) * 100;
        $sign = $change > 0 ? '+' : '';
        
        return $sign . round($change, 1) . '%';
    }
}