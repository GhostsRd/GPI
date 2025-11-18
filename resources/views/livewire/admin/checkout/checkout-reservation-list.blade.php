<div>
    <div class="table-container border-0 shadow-sm fade-in-up">
        <div class="table-header bg-light p-3 rounded-top">
            <div class="table-title fw-bold text-dark">
                <i class="bi bi-calendar-check me-2"></i>
                Réservations d'Équipement
            </div>
        </div>

        <!-- Statistiques des réservations -->
        <div class="row p-3">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-primary">{{ $this->stats['total'] }}</h3>
                                <p class="stats-label text-black mb-0">Total réservations</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                    <i class="fas fa-calendar-alt fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-success">{{ $this->stats['en_cours'] }}</h3>
                                <p class="stats-label text-black mb-0">En cours</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-success bg-opacity-25 text-success d-flex align-items-center justify-content-center">
                                    <i class="fas fa-play-circle fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-warning">{{ $this->stats['a_venir'] }}</h3>
                                <p class="stats-label text-black mb-0">À venir</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-warning bg-opacity-25 text-warning d-flex align-items-center justify-content-center">
                                    <i class="fas fa-clock fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-info">{{ $this->stats['termines'] }}</h3>
                                <p class="stats-label text-black mb-0">Terminées</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-info bg-opacity-25 text-info d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check-circle fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barre de recherche et filtres -->
        <div class="card border-0 shadow-sm mb-4 mx-3">
            <div class="card-body py-2">
                <div class="row g-2 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Recherche</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-transparent">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" wire:model.live="search"
                                   class="form-control form-control-sm" placeholder="Utilisateur, Type...">
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Type matériel</label>
                        <select wire:model.live="typeFilter" class="form-select form-select-sm">
                            <option value="">Tous les types</option>
                            @foreach($this->typesMateriel as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Statut</label>
                        <select wire:model.live="statutFilter" class="form-select form-select-sm">
                            <option value="">Tous les statuts</option>
                            <option value="1">Créé</option>
                            <option value="2">Validé</option>
                            <option value="3">En cours</option>
                            <option value="4">Rendu</option>
                            <option value="5">Archivé</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Période</label>
                        <select wire:model.live="periodeFilter" class="form-select form-select-sm">
                            <option value="">Toutes périodes</option>
                            <option value="today">Aujourd'hui</option>
                            <option value="week">Cette semaine</option>
                            <option value="month">Ce mois</option>
                            <option value="future">À venir</option>
                            <option value="past">Passées</option>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <label class="form-label small fw-bold">Tri par</label>
                        <select wire:model.live="sortField" class="form-select form-select-sm">
                            <option value="created_at">Date création</option>
                            <option value="date_debut">Date début</option>
                            <option value="date_fin">Date fin</option>
                            <option value="equipement_type">Type</option>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <label class="form-label small fw-bold">Ordre</label>
                        <select wire:model.live="sortDirection" class="form-select form-select-sm">
                            <option value="desc">Décroissant</option>
                            <option value="asc">Croissant</option>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <button type="button" wire:click="resetFilters"
                                class="btn btn-outline-secondary btn-sm w-100 mt-3" title="Réinitialiser les filtres">
                            <i class="fas fa-redo"></i>
                        </button>
                    </div>

                    <div class="col-md-1">
                        <button wire:click="deleteSelected" class="btn btn-danger btn-sm w-100 mt-3" 
                                title="Supprimer les réservations sélectionnées"
                                {{ empty($selectedReservations) ? 'disabled' : '' }}>
                            <i class="fas fa-trash"></i>
                            ({{ count($selectedReservations) }})
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des réservations -->
        <div class="table-wrapper p-0 border-0 w-100 compact-mode mx-3">
            <table class="table table-hover border-0 shadow-sm text-center small">
                <thead class="table-light">
                    <tr>
                        <th class="py-2" style="width: 30px;">
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                        </th>
                        <th class="py-2" style="width: 60px;">Utilisateur</th>
                        <th class="py-2 sortable" wire:click="sortBy('equipement_type')" style="width: 120px;">
                            Type matériel
                            @if($sortField === 'equipement_type')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="bi bi-arrow-down-up ms-1"></i>
                            @endif
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('date_debut')" style="width: 100px;">
                            Date début
                            @if($sortField === 'date_debut')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="bi bi-arrow-down-up ms-1"></i>
                            @endif
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('date_fin')" style="width: 100px;">
                            Date fin
                            @if($sortField === 'date_fin')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="bi bi-arrow-down-up ms-1"></i>
                            @endif
                        </th>
                        <th class="py-2" style="width: 80px;">
                            Quantité
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('created_at')" style="width: 120px;">
                            Date création
                            @if($sortField === 'created_at')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="bi bi-arrow-down-up ms-1"></i>
                            @endif
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('updated_at')" style="width: 120px;">
                            Date modification
                            @if($sortField === 'updated_at')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="bi bi-arrow-down-up ms-1"></i>
                            @endif
                        </th>
                        <th class="py-2" style="width: 100px;">Statut</th>
                        <th class="py-2" style="width: 80px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($matreservations as $reservation)
                        <tr class="hover-row" style="cursor:pointer">
                            <td class="py-2">
                                <input type="checkbox"
                                       wire:model="selectedReservations"
                                       value="{{ $reservation->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td class="py-2">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img width="32" height="32" class="rounded-circle border border-primary border-2"
                                         src="https://ui-avatars.com/api/?name={{ urlencode($reservation->responsable->nom ?? 'Utilisateur') }}&size=32&background=random"
                                         alt="{{ $reservation->responsable->nom ?? 'Utilisateur' }}"
                                         title="{{ $reservation->responsable->nom ?? 'Utilisateur' }}">
                                </div>
                            </td>
                            <td class="py-2">
                                <div class="d-flex flex-column align-items-center">
                                    <span class="badge bg-light text-dark border small mb-1">
                                        {{ $reservation->equipement_type }}
                                    </span>
                                    @if($reservation->statut == 0)
                                        <div class="mt-1">
                                            <span class="badge bg-danger bg-opacity-10 text-danger border border-danger small">
                                                Demande annulée
                                            </span>
                                            <button class="btn btn-outline-danger btn-xs mt-1"
                                                    wire:click="supprimerDemande({{ $reservation->id }})"
                                                    title="Supprimer cette demande">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="py-2 text-muted small" wire:click="Visualiser({{ $reservation->id }})">
                                {{ \Carbon\Carbon::parse($reservation->date_debut)->translatedFormat('d M Y') }}
                            </td>
                            <td class="py-2 text-muted small" wire:click="Visualiser({{ $reservation->id }})">
                                {{ \Carbon\Carbon::parse($reservation->date_fin)->translatedFormat('d M Y') }}
                            </td>
                            <td class="py-2 fw-bold text-primary" wire:click="Visualiser({{ $reservation->id }})">
                                {{ $reservation->equipement_nombre }}
                            </td>
                            <td class="py-2 text-muted small" wire:click="Visualiser({{ $reservation->id }})">
                                {{ $reservation->created_at->format('d M Y') }}
                                <br>
                                <small class="text-muted">{{ $reservation->created_at->format('H:i') }}</small>
                            </td>
                            <td class="py-2 text-muted small" wire:click="Visualiser({{ $reservation->id }})">
                                {{ $reservation->updated_at->format('d M Y') }}
                                <br>
                                <small class="text-muted">{{ $reservation->updated_at->format('H:i') }}</small>
                            </td>
                            <td class="py-2">
                                @php
                                    $statusConfig = match($reservation->statut) {
                                        0 => ['danger', 'Annulé', 'times-circle'],
                                        1 => ['secondary', 'Créé', 'clock'],
                                        2 => ['success', 'Validé', 'check-circle'],
                                        3 => ['warning', 'En cours', 'play-circle'],
                                        4 => ['primary', 'Rendu', 'check-double'],
                                        5 => ['dark', 'Archivé', 'archive'],
                                        default => ['secondary', 'Inconnu', 'question-circle']
                                    };
                                @endphp
                                <span class="badge bg-{{ $statusConfig[0] }} bg-opacity-10 text-{{ $statusConfig[0] }} border border-{{ $statusConfig[0] }} small">
                                    <i class="fas fa-{{ $statusConfig[2] }} me-1"></i>{{ $statusConfig[1] }}
                                </span>
                            </td>
                            <td class="py-2">
                                <div class="action-buttons d-flex justify-content-center gap-1">
                                    <button class="btn-action btn-view btn-sm" 
                                            title="Voir détails">
                                        <a href="{{ url('/admin/checkout-reservation-view-' . $reservation->id) }}" class="text-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </button>
                                    <button wire:click="$dispatch('editReservation', {id: {{ $reservation->id }}})"
                                            class="btn-action btn-edit btn-sm" 
                                            title="Modifier">
                                        <i class="fas fa-edit text-warning"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $reservation->id }})"
                                            class="btn-action btn-delete btn-sm" 
                                            title="Supprimer">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="py-4 text-center text-muted">
                                <i class="bi bi-calendar-x me-2"></i>Aucune réservation trouvée
                            </td>
                        </tr>
                    @endforelse
                    @if($matreservations->count() > 0)
                        <tr>
                            <td colspan="10" class="py-2 bg-light text-muted small">
                                Affichage de {{ $matreservations->count() }} réservation(s) sur cette page
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($matreservations->hasPages())
        <div class="table-footer bg-light p-3 rounded-bottom mx-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    @if($matreservations->total() > 0)
                    Affichage de {{ $matreservations->firstItem() }} à {{ $matreservations->lastItem() }} sur {{ $matreservations->total() }} réservations
                    @else
                    Aucune réservation
                    @endif
                </div>
                <div class="pagination-container">
                    {{ $matreservations->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
.small {
    font-size: 0.75rem;
}

.table th, .table td {
    font-size: 0.75rem;
    padding: 0.5rem;
}

.compact-mode .table td, .compact-mode .table th {
    padding: 0.4rem 0.5rem;
}

.hover-row:hover {
    background-color: #f8f9fa;
    transition: background-color 0.2s ease;
}

.badge {
    font-size: 0.7rem;
    font-weight: 500;
}

.btn-xs {
    padding: 0.15rem 0.4rem;
    font-size: 0.7rem;
    border-radius: 0.2rem;
}

.action-buttons .btn-action {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    border-radius: 0.2rem;
    background: transparent;
    transition: all 0.2s ease;
}

.action-buttons .btn-action:hover {
    background-color: #f8f9fa;
    transform: scale(1.1);
}

.sortable {
    cursor: pointer;
    transition: color 0.2s ease;
}

.sortable:hover {
    color: #0d6efd;
}

.table-header {
    border-bottom: 1px solid #dee2e6;
}

.table-footer {
    border-top: 1px solid #dee2e6;
}

.stats-widget {
    transition: transform 0.2s ease;
}

.stats-widget:hover {
    transform: translateY(-2px);
}

.stats-number {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 0.2rem;
}

.stats-label {
    font-size: 0.8rem;
    color: #6c757d;
}

.avatar-sm {
    width: 40px;
    height: 40px;
}

.form-control-sm, .form-select-sm {
    font-size: 0.75rem;
}

.checkbox-modern {
    width: 16px;
    height: 16px;
}
</style>