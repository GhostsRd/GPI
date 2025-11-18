<div>
    <div class="table-container border-0 shadow-sm fade-in-up">
        <div class="table-header bg-light p-3 rounded-top">
            <div class="table-title fw-bold text-dark">
                <i class="bi bi-cart-check me-2"></i>
                Liste des Checkouts 
            </div>
        </div>

        <!-- Statistiques des checkouts -->
        <div class="row p-3">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-primary">{{ $this->stats['total'] }}</h3>
                                <p class="stats-label text-black mb-0">Total checkouts</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                    <i class="fas fa-shopping-cart fa-lg"></i>
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
                                <h3 class="stats-number text-warning">{{ $this->stats['en_cours'] }}</h3>
                                <p class="stats-label text-black mb-0">En cours</p>
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
                                <h3 class="stats-number text-success">{{ $this->stats['termine'] }}</h3>
                                <p class="stats-label text-black mb-0">Terminés</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-success bg-opacity-25 text-success d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check-circle fa-lg"></i>
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
                                <h3 class="stats-number text-danger">{{ $this->stats['en_retard'] }}</h3>
                                <p class="stats-label text-black mb-0">En retard</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-danger bg-opacity-25 text-danger d-flex align-items-center justify-content-center">
                                    <i class="fas fa-exclamation-triangle fa-lg"></i>
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
                                   class="form-control form-control-sm" placeholder="ID, Utilisateur...">
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Statut</label>
                        <select wire:model.live="statutFilter" class="form-select form-select-sm">
                            <option value="">Tous les statuts</option>
                            <option value="en_cours">En cours</option>
                            <option value="termine">Terminé</option>
                            <option value="annule">Annulé</option>
                            <option value="en_retard">En retard</option>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Type matériel</label>
                        <select wire:model.live="typeMateriel" class="form-select form-select-sm">
                            <option value="">Tous les types</option>
                            @foreach($this->typesMateriel as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Tri par</label>
                        <select wire:model.live="sortField" class="form-select form-select-sm">
                            <option value="created_at">Date création</option>
                            <option value="id">Référence</option>
                            <option value="statut">Statut</option>
                            <option value="date_debut">Date début</option>
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
                                title="Supprimer les checkouts sélectionnés"
                                {{ empty($selectedTickets) ? 'disabled' : '' }}>
                            <i class="fas fa-trash"></i>
                            ({{ count($selectedTickets) }})
                        </button>
                    </div>

                    <div class="col-md-1">
                        <button wire:click="exportCheckouts" class="btn btn-success btn-sm w-100 mt-3" 
                                title="Exporter les checkouts">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des checkouts -->
        <div class="table-wrapper p-0 border-0 w-100 compact-mode mx-3">
            <table class="table table-hover border-0 shadow-sm text-center small">
                <thead class="table-light">
                    <tr>
                        <th class="py-2" style="width: 30px;">
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('id')" style="width: 80px;">
                            Référence
                            <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('utilisateur_id')" style="width: 120px;">
                            Utilisateur
                            <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('materiel_type')" style="width: 120px;">
                            Type matériel
                            <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th class="py-2" style="width: 150px;">
                            Détails matériel
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('statut')" style="width: 120px;">
                            Statut
                            <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                       
                        <th class="py-2 sortable" wire:click="sortBy('date_debut')" style="width: 100px;">
                            Date début
                            <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('date_fin')" style="width: 100px;">
                            Date fin
                            <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('created_at')" style="width: 120px;">
                            Date création
                            <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th class="py-2" style="width: 80px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($checkouts as $checkout)
                        <tr class="hover-row" style="cursor:pointer">
                            <td class="py-2">
                                <input type="checkbox"
                                       wire:model="selectedTickets"
                                       value="{{ $checkout->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td class="py-2 fw-bold text-primary" wire:click="Visualiser({{ $checkout->id }})">
                                #{{ $checkout->id }}
                            </td>
                            <td class="py-2" wire:click="Visualiser({{ $checkout->id }})">
                                <div class="d-flex align-items-center justify-content-center">
                                    @if (!empty($checkout->utilisateur->photo ))
                                          <img width="30" height="30" class="rounded-pill my-0 py-0"
                                            src="{{ asset('storage/' . $checkout->utilisateur->photo ) }}"
                                            alt="">
                                         <span class="text-muted small text-capitalize">{{ $checkout->utilisateur->nom ?? 'N/A' }}</span>

                                    @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($checkout->utilisateur->nom ?? 'Utilisateur') }}&size=24&background=random" 
                                         class="rounded-circle me-2" width="20" height="20">
                                         <span class="text-muted small">{{ $checkout->utilisateur->nom ?? 'N/A' }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-2" wire:click="Visualiser({{ $checkout->id }})">
                                <span class="badge bg-light text-dark border small">
                                    {{ $checkout->materiel_type }}
                                </span>
                            </td>
                            <td class="py-2" wire:click="Visualiser({{ $checkout->id }})">
                                <small class="text-muted">
                                    @if ($checkout->materiel_type  == 'ordinateur' )
                                        {{ $checkout->ordinateur->nom }}  {{ $checkout->ordinateur->os_version }}
                                    @endif
                                    @if ($checkout->materiel_type  == 'telephone')
                                                {{ $checkout->telephone->nom }}  {{ $checkout->telephone->marque }}
                                    @endif
                                     @if ($checkout->materiel_type  == 'peripherique')
                                        @foreach ($Peripheriques as $peripherique)
                                        @if ($checkout->materiel_details == $peripherique->type )
                                              {{ $peripherique->nom }} {{ $peripherique->fabricant }}
                                            
                                         
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (!empty($checkout->materiel_details ))
                                    {{ $checkout->materiel_details }}                                    
                                    @endif
                                </small>
                            </td>
                            <td class="py-2">
                                @if($checkout->statut == 'en_cours')
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning small">
                                        <i class="bi bi-clock me-1"></i>En cours
                                    </span>
                                @elseif($checkout->statut == 'termine')
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success small">
                                        <i class="bi bi-check-circle me-1"></i>Terminé
                                    </span>
                                @elseif($checkout->statut == 'annule')
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger small">
                                        <i class="bi bi-x-circle me-1"></i>Annulé
                                    </span>
                                @elseif($checkout->statut == 'en_retard')
                                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger small">
                                        <i class="bi bi-exclamation-triangle me-1"></i>En retard
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary small">
                                        {{ $checkout->statut }}
                                    </span>
                                @endif
                            </td>
                            
                            <td class="py-2 text-muted small" wire:click="Visualiser({{ $checkout->id }})">
                                {{ $checkout->date_debut?->format('d M Y') ?? 'N/A' }}
                            </td>
                            <td class="py-2 text-muted small" wire:click="Visualiser({{ $checkout->id }})">
                                {{ $checkout->date_fin?->format('d M Y') ?? 'N/A' }}
                            </td>
                            <td class="py-2 text-muted small" wire:click="Visualiser({{ $checkout->id }})">
                                {{ $checkout->created_at->format('d M Y') }}
                                <br>
                                <small class="text-muted">{{ $checkout->created_at->format('H:i') }}</small>
                            </td>
                            <td class="py-2">
                                <div class="action-buttons d-flex justify-content-center gap-1">
                                    <button class="btn-action btn-view btn-sm" 
                                            title="Voir détails">
                                        <a href="{{ url('/admin/checkout-view-'.$checkout->id) }}" class="text-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </button>
                                    <button wire:click="$dispatch('editCheckout', {id: {{ $checkout->id }}})"
                                            class="btn-action btn-edit btn-sm" 
                                            title="Modifier">
                                        <i class="fas fa-edit text-warning"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $checkout->id }})"
                                            class="btn-action btn-delete btn-sm" 
                                            title="Supprimer">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="py-4 text-center text-muted">
                                <i class="bi bi-cart me-2"></i>Aucun checkout trouvé
                            </td>
                        </tr>
                    @endforelse
                    @if($checkouts->count() > 0)
                        <tr>
                            <td colspan="11" class="py-2 bg-light text-muted small">
                                Affichage de {{ $checkouts->count() }} checkout(s) sur cette page
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($checkouts->hasPages())
        <div class="table-footer bg-light p-3 rounded-bottom mx-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    @if($checkouts->total() > 0)
                    Affichage de {{ $checkouts->firstItem() }} à {{ $checkouts->lastItem() }} sur {{ $checkouts->total() }} checkouts
                    @else
                    Aucun checkout
                    @endif
                </div>
                <div class="pagination-container">
                    {{ $checkouts->links() }}
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
