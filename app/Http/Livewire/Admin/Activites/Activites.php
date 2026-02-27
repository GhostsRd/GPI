<?php

namespace App\Http\Livewire\Admin\Activites;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Checkout;
use App\Models\Incident;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class Activites extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $typeFilter = 'all';
    public $onlyActive = false;
    public $perPage = 20;

    protected $queryString = ['search', 'typeFilter', 'onlyActive'];

    public function getUnifiedActivitiesProperty()
    {
        $activities = collect();

        // 1. Tickets
        if (Schema::hasTable('tickets')) {
            $ticketsQuery = Ticket::with(['utilisateur', 'responsable'])
                ->when($this->onlyActive, function($query) {
                    // Pour le modèle Ticket, on utilise 'state' (1: Nouveau, 2: Assigné, 3: En cours, 4: Résolu, 5: Fermé)
                    // Actif signifie state < 5
                    $query->where('state', '<', 5);
                })
                ->when($this->search, function($query) {
                    $query->where(function($q) {
                        $q->where('id', 'like', '%' . $this->search . '%')
                          ->orWhere('sujet', 'like', '%' . $this->search . '%')
                          ->orWhere('titre', 'like', '%' . $this->search . '%');
                    });
                });

            if ($this->typeFilter === 'all' || $this->typeFilter === 'ticket') {
                $tickets = $ticketsQuery->latest()->get();
                foreach ($tickets as $ticket) {
                    $priority = strtolower($ticket->priorite ?? $ticket->priority ?? 'normale');
                    $state = $ticket->state ?? 1;
                    
                    $color = 'warning';
                    if (in_array($priority, ['urgent', 'haute', 'high', 'critique', 'critical'])) $color = 'danger';
                    elseif ($state == 3) $color = 'primary'; // En cours
                    elseif ($state == 4 || $state == 5) $color = 'success'; // Résolu / Fermé

                    $statusText = match((int)$state) {
                        1 => 'Nouveau',
                        2 => 'Assigné',
                        3 => 'En cours',
                        4 => 'Résolu',
                        5 => 'Fermé',
                        default => 'Inconnu'
                    };

                    $activities->push([
                        'id' => $ticket->id,
                        'type' => 'Ticket',
                        'icon' => 'fas fa-ticket-alt',
                        'title' => $ticket->sujet ?? $ticket->titre ?? $ticket->title ?? 'Sans titre',
                        'user' => $ticket->utilisateur->nom ?? 'Inconnu',
                        'assigned_to' => $ticket->responsable->name ?? '---',
                        'date' => $ticket->created_at,
                        'status' => $statusText,
                        'priority' => ucfirst($priority),
                        'color' => $color
                    ]);
                }
            }
        }

        // 2. Incidents
        if (Schema::hasTable('incidents')) {
            $incidentsQuery = Incident::with(['utilisateur', 'technicien'])
                ->when($this->onlyActive, function($query) {
                    $query->whereNotIn('statut', ['résolu', 'resolved', 'annulé', 'cancelled']);
                })
                ->when($this->search, function($query) {
                    $query->where('id', 'like', '%' . $this->search . '%')
                          ->orWhere('incident_sujet', 'like', '%' . $this->search . '%');
                });

            if ($this->typeFilter === 'all' || $this->typeFilter === 'incident') {
                $incidents = $incidentsQuery->latest()->get();
                foreach ($incidents as $incident) {
                    $status = strtolower($incident->statut ?? 'en_cours');
                    
                    $color = 'danger';
                    if (in_array($status, ['résolu', 'resolved'])) $color = 'success';
                    elseif ($status === 'en_attente') $color = 'warning';
                    elseif ($status === 'en_cours') $color = 'primary';

                    $activities->push([
                        'id' => $incident->id,
                        'type' => 'Incident',
                        'icon' => 'fas fa-exclamation-triangle',
                        'title' => $incident->incident_sujet ?? 'Incident signalé',
                        'user' => $incident->utilisateur->nom ?? 'Inconnu',
                        'assigned_to' => $incident->technicien->name ?? '---',
                        'date' => $incident->created_at,
                        'status' => ucfirst(str_replace('_', ' ', $status)),
                        'priority' => 'Urgent',
                        'color' => $color
                    ]);
                }
            }
        }

        // 3. Checkouts
        if (Schema::hasTable('checkouts')) {
            $checkoutsQuery = Checkout::with(['utilisateur', 'responsable'])
                ->when($this->onlyActive, function($query) {
                    $query->whereIn('statut', ['en_attente', 'pending', 'approuvé', 'approved', 'en_cours', 'in_progress']);
                })
                ->when($this->search, function($query) {
                    $query->where('id', 'like', '%' . $this->search . '%')
                          ->orWhere('materiel_type', 'like', '%' . $this->search . '%');
                });

            if ($this->typeFilter === 'all' || $this->typeFilter === 'checkout') {
                $checkouts = $checkoutsQuery->latest()->get();
                foreach ($checkouts as $checkout) {
                    $status = strtolower($checkout->statut ?? 'en_attente');
                    
                    $color = 'info';
                    if (in_array($status, ['en_attente', 'pending'])) $color = 'warning';
                    elseif (in_array($status, ['approuvé', 'approved', 'en_cours', 'in_progress'])) $color = 'primary';
                    elseif (in_array($status, ['terminé', 'retourné', 'completed', 'returned'])) $color = 'success';

                    $activities->push([
                        'id' => $checkout->id,
                        'type' => 'Checkout',
                        'icon' => 'fas fa-exchange-alt',
                        'title' => 'Check-out : ' . ($checkout->materiel_type ?? 'Équipement'),
                        'user' => $checkout->utilisateur->nom ?? 'Inconnu',
                        'assigned_to' => $checkout->responsable->name ?? '---',
                        'date' => $checkout->created_at,
                        'status' => ucfirst($status),
                        'priority' => 'Info',
                        'color' => $color
                    ]);
                }
            }
        }

        return $activities->sortByDesc('date')->values();
    }

    public function render()
    {
        $activities = $this->unifiedActivities;
        $paginatedActivities = new \Illuminate\Pagination\LengthAwarePaginator(
            $activities->forPage($this->page, $this->perPage),
            $activities->count(),
            $this->perPage,
            $this->page,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        return view('livewire.admin.activites.activites', [
            'activities' => $paginatedActivities
        ])->layout('layouts.plain');
    }

    public function export($format = 'excel')
    {
        if ($format === 'pdf') {
            $this->dispatchBrowserEvent('print-activities');
            return;
        }

        $activities = $this->unifiedActivities;
        $fileName = 'export_activites_' . now()->format('Y-m-d_H-i-s') . '.xlsx';

        return \Maatwebsite\Excel\Facades\Excel::download(
            new \App\Exports\ActivitesExport($activities), 
            $fileName
        );
    }
}
