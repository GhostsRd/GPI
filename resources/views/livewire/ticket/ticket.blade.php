<div class="ticket-dashboard">
    <div class="dashboard-container">
        <!-- Stats Header (reste inchangé) -->
        <div class="stats-header fade-in-up">
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
                    <div class="col-md-2">
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
                    <div class="col-md-2">
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
                      <div class="col-md-2">
                        <label class="form-label small fw-bold">Vue</label>
                        <select wire:change="changerVue" class="form-select form-select-sm">
                            <option value="tableau">Tableau</option>
                            <option value="kanban">Kanban</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" wire:click="$set(['search' => '', 'statut' => '', 'priorite' => '', 'categorie' => '', 'assigned_to' => ''])"
                                class="btn btn-outline-secondary btn-sm w-100" title="Réinitialiser les filtres">
                            <i class="fa fa-times"></i> filtrer
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container fade-in-up">
            <div class="table-header">
                <div class="table-title">
                    <i class="fas fa-list"></i>
                    Liste des Tickets
                </div>
                <div class="table-actions">
                    <button wire:click="$dispatch('openCreateModal')" class="btn-modern">
                        <i class="fas fa-plus"></i>
                        Nouveau Ticket
                    </button>
                    <button wire:click="deleteSelected" class="btn-modern secondary"
                        {{ empty($selectedTickets) ? 'disabled' : '' }}>
                        <i class="fas fa-trash"></i>
                        Supprimer ({{ count($selectedTickets) }})
                    </button>
                </div>
            </div>

            <div class="table-wrapper w-100 compact-mode">
                <table class="modern-table table">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                        </th>
                        <th>Référence</th>
                        <th>Sujet</th>
                        <th>Priorité</th>
                        <th>Catégorie</th>
                        <th>Statut</th>
                        <th>Créé par</th>
                        <th>Assigné à</th>
                        <th>Équipement</th>
                        <th>Date création</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr class="priorite_{{$ticket->priorite}}">
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
                                        <a class="" href="{{ url('/admin/ticket-view-'.$ticket->id) }}">view</a>
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button wire:click="$dispatch('editTicket', {id: {{ $ticket->id }}})"
                                            class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="deleteTicket({{ $ticket->id }})"
                                            class="btn-action btn-delete"
                                            onclick="return confirm('Supprimer ce ticket ?')">
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
</div>

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
@endpush
