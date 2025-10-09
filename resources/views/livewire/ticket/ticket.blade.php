<div class="ticket-dashboard">
    <div class="dashboard-container">
        <!-- Stats Header -->
     

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card stats-widget border-0 shadow-sm dark-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h3 class="stats-number text-primary">{{ $totalTickets }}</h3>
                                    <p class="stats-label text-light mb-0">Totals tickets</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                        <i class="fas fa-boxes fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card stats-widget border-0 shadow-sm dark-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h3 class="stats-number text-success">{{ $inProgressTickets }}</h3>
                                    <p class="stats-label text-light mb-0">En cours</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-success bg-opacity-25 text-success d-flex align-items-center justify-content-center">
                                        <i class="fas fa-warehouse fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card stats-widget border-0 shadow-sm dark-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h3 class="stats-number text-warning">{{ $pendingTickets }}</h3>
                                    <p class="stats-label text-light mb-0">En Prêt</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-warning bg-opacity-25 text-warning d-flex align-items-center justify-content-center">
                                        <i class="fas fa-hand-holding fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card stats-widget border-0 shadow-sm dark-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h3 class="stats-number text-danger">{{ $resolvedTickets }}</h3>
                                    <p class="stats-label text-light mb-0">Résolus</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-danger bg-opacity-25 text-danger d-flex align-items-center justify-content-center">
                                        <i class="fas fa-tools fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <!-- Barre de recherche et filtres -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Recherche</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-transparent">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" wire:model.live="search"
                                   class="form-control" placeholder="Référence, Sujet, Créé par...">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label small fw-bold">Statut</label>
                        <select wire:model.live="statut" class="form-select form-select-sm">
                            <option value="">Tous les statuts</option>
                            <option value="ouvert">Ouvert</option>
                            <option value="en_cours">En Cours</option>
                            <option value="en_attente">En Attente</option>
                            <option value="résolu">Résolu</option>
                            <option value="fermé">Fermé</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Priorité</label>
                        <select wire:model.live="priorite" class="form-select form-select-sm">
                            <option value="">Toutes les priorités</option>
                            <option value="basse">Basse</option>
                            <option value="moyenne">Moyenne</option>
                            <option value="haute">Haute</option>
                            <option value="urgente">Urgente</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label small fw-bold">Catégorie</label>
                        <select wire:model.live="categorie" class="form-select form-select-sm">
                            <option value="">Toutes les catégories</option>
                            <option value="Réseau">Réseau</option>
                            <option value="Logiciel">Logiciel</option>
                            <option value="Matériel">Matériel</option>
                            <option value="Sécurité">Sécurité</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                      <div class="col-md-1">
                        <label class="form-label small fw-bold">Vue</label>
                        <select wire:change="changerVue" class="form-select form-select-sm">
                            <option value="tableau">Tableau</option>
                            <option value="kanban">Kanban</option>
                        </select>
                    </div>
                     <div class="col-md-1">
                        <label class="form-label small fw-bold">Archiver</label>
                        <select wire:change="archiveActive" class="form-select form-select-sm">
                            <option value="false">Non active</option>
                            <option value="true">Active</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" wire:click="resetFilters"
                                class="btn btn-outline-secondary btn-sm w-100" title="Réinitialiser les filtres">
                            <i class="fa fa-times"></i> Reset
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="deleteSelected" class="btn btn-danger btn-sm w-100" title="Supprimer les tickets sélectionnés"
                            {{ empty($selectedTickets) ? 'disabled' : '' }}>
                            <i class="fas fa-trash"></i>
                            
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                            </svg>
                             ({{ count($selectedTickets) }})
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="exportTickets" class="btn btn-success btn-sm w-100" title="Exporter les tickets">
                            <i class="bi bi-box-arrow-up-right"></i>
                            Exporter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container border-0  fade-in-up">
            <div class="table-header">
                <div class="table-title">
                    
                    Liste des Tickets
                </div>
            </div>

            <div class="table-wrapper p-0 border-0 w-100 compact-mode">
         
                <table class="table border-0 shadow-sm">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                        </th>
                        <th wire:click="sortBy('reference')" class="sortable">
                            Référence
                            @if($sortField === 'reference')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('sujet')" class="sortable">
                            Sujet
                            @if($sortField === 'sujet')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('priorite')" class="sortable">
                            Priorité
                            @if($sortField === 'priorite')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th>Catégorie</th>
                        <th wire:click="sortBy('status')" class="sortable">
                            Statut
                            @if($sortField === 'status')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th>Créé par</th>
                        <th>Assigné à</th>
                        <th>Équipement</th>
                        <th wire:click="sortBy('created_at')" class="sortable">
                            Date création
                            @if($sortField === 'created_at')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr class="priorite_{{$ticket->priorite}} bg-dark" style="cursor:pointer" >
                            <td>
                                <input type="checkbox"
                                       wire:model="selectedTickets"
                                       value="{{ $ticket->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td>{{ $ticket->id }}</td>
                            <td>{{ $ticket->sujet }}</td>
                            <td class="priority-{{ $ticket->priorite }}">
                                {{ ucfirst($ticket->priorite) }}
                            </td>
                            <td>
                                {{ $ticket->categorie }}
                            </td>
                            <td>
                                    <span class="status-badge status-{{ strtolower($ticket->status) }}">
                                        {{ $ticket->status }}
                                    </span>
                            </td>
                            <td>{{ $ticket->utilisateur->nom }}</td>
                            <td>{{ $ticket->responsable->name }}</td>
                            <td>{{ $ticket->equipement }}</td>
                            <td>{{ $ticket->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action btn-view">
                                        <a href="{{ url('/admin/ticket-view-'.$ticket->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </button>
                                    <button wire:click="$dispatch('editTicket', {id: {{ $ticket->id }}})"
                                            class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $ticket->id }})"
                                            class="btn-action btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 container">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mynotif active">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle text-success me-2"></i>
                <span>{{ session('message') }}</span>
            </div>
        </div>
    @endif

    <!-- Confirmation Modal -->
    @if($showDeleteModal)
        <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);">
            <div class="modal-dialog">
                <div class="modal-content p-3">
                    <h5>Confirmer la suppression</h5>
                    <p>Voulez-vous vraiment supprimer les tickets sélectionnés ?</p>
                    <button wire:click="deleteSelected" class="btn btn-danger">Oui, supprimer</button>
                    <button wire:click="closeDeleteModal" class="btn btn-secondary">Annuler</button>
                </div>
            </div>
        </div>
    @endif
</div>

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
@endpush
