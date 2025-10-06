<div class="ticket-dashboard">
    <div class="dashboard-container">
        <!-- Stats Header -->
        <div class="stats-header fade-in-up">
            <div class="row"> <!-- Ajout d'une div row manquante -->
                <div class="col-xl-3 col-md-6">
                    <div class="card stats-widget border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h3 class="stats-number text-primary">{{ $totalTickets }}</h3>
                                    <p class="stats-label text-muted mb-0">Totals tickets</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center">
                                        <i class="fas fa-boxes fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card stats-widget border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h3 class="stats-number text-success">{{ $inProgressTickets }}</h3>
                                    <p class="stats-label text-muted mb-0">En cours</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center">
                                        <i class="fas fa-warehouse fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card stats-widget border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h3 class="stats-number text-warning">{{ $pendingTickets }}</h3>
                                    <p class="stats-label text-muted mb-0">En Prêt</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center">
                                        <i class="fas fa-hand-holding fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card stats-widget border-0 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h3 class="stats-number text-danger">{{ $resolvedTickets }}</h3>
                                    <p class="stats-label text-muted mb-0">Résolus</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center">
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
        <div class="table-container fade-in-up">
            <div class="table-header">
                <div class="table-title">
                    <i class="fas fa-list"></i>
                    Liste des Tickets
                </div>
                <div class="table-actions">
                    <div class="search-box">
                        <input type="text" wire:model.debounce.500ms="search" placeholder="Rechercher...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                    <button wire:click="$dispatch('openCreateModal')" class="btn-modern">
                        <i class="fas fa-plus"></i>
                        Nouveau Ticket
                    </button>
                    <button wire:click="deleteSelected" class="btn-modern secondary"
                        {{ empty($selectedTickets) ? 'disabled' : '' }}>
                        <i class="fas fa-trash"></i>
                        Supprimer ({{ count($selectedTickets) }})
                    </button>
                    <select id="categorie"
                            class="btn-modern secondary @error('categorie') is-invalid @enderror"
                            wire:model="categorie">
                        <option value="">-- Filtrer par une catégorie --</option>
                        <option value="Réseau">Réseau</option>
                        <option value="Logiciel">Logiciel</option>
                        <option value="Matériel">Matériel</option>
                        <option value="Sécurité">Sécurité</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div> 
            </div>

            <div class="table-wrapper w-100">
                <table class="modern-table">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                        </th>
                        <th>Référence</th>
                        <th>Sujet</th>
                        <th>Priorité</th>
                        <th>Categorie</th>
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
                            <td>{{ $ticket->reference }}</td>
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
                            <td>{{ $ticket->created_by }}</td>
                            <td>{{ $ticket->assigned_to }}</td>
                            <td>{{ $ticket->equipment }}</td>
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
