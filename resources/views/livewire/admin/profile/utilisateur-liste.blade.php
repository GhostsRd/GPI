<div>
    <div class="table-container border-0 shadow-sm fade-in-up">
        <div class="table-header bg-light p-3 rounded-top">
            <div class="table-title fw-bold text-dark">
                <i class="bi bi-people me-2"></i>
                Liste des Utilisateurs
            </div>
        </div>

        <!-- Statistiques des utilisateurs -->
        <div class="row p-3">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-primary">{{ $this->stats['total'] }}</h3>
                                <p class="stats-label text-black mb-0">Total utilisateurs</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                    <i class="fas fa-users fa-lg"></i>
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
                                <h3 class="stats-number text-success">{{ $this->stats['actifs'] }}</h3>
                                <p class="stats-label text-black mb-0">Utilisateurs</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-success bg-opacity-25 text-success d-flex align-items-center justify-content-center">
                                    <i class="fas fa-user-check fa-lg"></i>
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
                                <h3 class="stats-number text-warning">{{ $this->stats['departements'] }}</h3>
                                <p class="stats-label text-black mb-0">Départements</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-warning bg-opacity-25 text-warning d-flex align-items-center justify-content-center">
                                    <i class="fas fa-building fa-lg"></i>
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
                                <h3 class="stats-number text-info">{{ $this->stats['lieux'] }}</h3>
                                <p class="stats-label text-black mb-0">Lieux d'affectation</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-info bg-opacity-25 text-info d-flex align-items-center justify-content-center">
                                    <i class="fas fa-map-marker-alt fa-lg"></i>
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
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Recherche</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-transparent">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" wire:model.live="search"
                                   class="form-control form-control-sm" placeholder="Nom, Email, Poste...">
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Département</label>
                        <select wire:model.live="departementFilter" class="form-select form-select-sm">
                            <option value="">Tous les départements</option>
                            @foreach($this->departements as $departement)
                                <option value="{{ $departement }}">{{ $departement }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Lieu</label>
                        <select wire:model.live="lieuFilter" class="form-select form-select-sm">
                            <option value="">Tous les lieux</option>
                            @foreach($this->lieuxAffectation as $lieu)
                                <option value="{{ $lieu }}">{{ $lieu }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Tri par</label>
                        <select wire:model.live="sortField" class="form-select form-select-sm">
                            <option value="created_at">Date création</option>
                            <option value="nom">Nom</option>
                            <option value="poste">Poste</option>
                            <option value="departement">Département</option>
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
                                title="Supprimer les utilisateurs sélectionnés"
                                {{ empty($selectedUsers) ? 'disabled' : '' }}>
                            <i class="fas fa-trash"></i>
                            ({{ count($selectedUsers) }})
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des utilisateurs -->
        <div class="table-wrapper p-0 border-0 w-100 compact-mode mx-3">
            <table class="table table-hover border-0 shadow-sm text-center small">
                <thead class="table-light">
                    <tr>
                        <th class="py-2" style="width: 30px;">
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                        </th>
                        <th class="py-2" style="width: 50px;">Photo</th>
                        <th class="py-2 sortable" wire:click="sortBy('nom')" style="width: 150px;">
                            Nom
                            @if($sortField === 'nom')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="bi bi-arrow-down-up ms-1"></i>
                            @endif
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('email')" style="width: 200px;">
                            Email
                            @if($sortField === 'email')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="bi bi-arrow-down-up ms-1"></i>
                            @endif
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('poste')" style="width: 120px;">
                            Poste
                            @if($sortField === 'poste')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="bi bi-arrow-down-up ms-1"></i>
                            @endif
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('departement')" style="width: 120px;">
                            Département
                            @if($sortField === 'departement')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="bi bi-arrow-down-up ms-1"></i>
                            @endif
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('lieu_affectation')" style="width: 120px;">
                            Lieu d'affectation
                            @if($sortField === 'lieu_affectation')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="bi bi-arrow-down-up ms-1"></i>
                            @endif
                        </th>
                        <th class="py-2" style="width: 100px;">
                            Téléphone
                        </th>
                        <th class="py-2" style="width: 150px;">
                            Adresse
                        </th>
                        <th class="py-2" style="width: 80px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($utilisateurs as $utilisateur)
                        <tr class="hover-row" style="cursor:pointer">
                            <td class="py-2">
                                <input type="checkbox"
                                       wire:model="selectedUsers"
                                       value="{{ $utilisateur->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td class="py-2">
                                @if (!empty($utilisateur->photo))
                                    <img width="40" height="40" class="rounded-circle shadow-sm" 
                                         src="{{ asset('storage/' . $utilisateur->photo) }}" 
                                         alt="Photo de {{ $utilisateur->nom }}"
                                         title="{{ $utilisateur->nom }}">
                                @else
                                    <img width="40" height="40" class="rounded-circle border border-primary border-2"
                                         src="https://ui-avatars.com/api/?name={{ urlencode($utilisateur->nom) }}&size=40&background=random"
                                         alt="Avatar de {{ $utilisateur->nom }}"
                                         title="{{ $utilisateur->nom }}">
                                @endif
                            </td>
                            <td class="py-2 fw-bold text-primary" wire:click="Visualiser({{ $utilisateur->id }})">
                                {{ $utilisateur->nom }}
                            </td>
                            <td class="py-2 text-muted" wire:click="Visualiser({{ $utilisateur->id }})">
                                {{ $utilisateur->email }}
                            </td>
                            <td class="py-2" wire:click="Visualiser({{ $utilisateur->id }})">
                                <span class="badge bg-light text-dark border small">
                                    {{ $utilisateur->poste }}
                                </span>
                            </td>
                            <td class="py-2" wire:click="Visualiser({{ $utilisateur->id }})">
                                <span class="badge bg-info bg-opacity-10 text-info border border-info small">
                                    {{ $utilisateur->departement }}
                                </span>
                            </td>
                            <td class="py-2" wire:click="Visualiser({{ $utilisateur->id }})">
                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning small">
                                    <i class="bi bi-geo-alt me-1"></i>{{ $utilisateur->lieu_affectation }}
                                </span>
                            </td>
                            <td class="py-2 text-muted small" wire:click="Visualiser({{ $utilisateur->id }})">
                                {{ $utilisateur->telephone }}
                            </td>
                            <td class="py-2 text-muted small" wire:click="Visualiser({{ $utilisateur->id }})">
                                {{ \Illuminate\Support\Str::limit($utilisateur->adresse, 25) }}
                            </td>
                            <td class="py-2">
                                <div class="action-buttons d-flex justify-content-center gap-1">
                                    <button class="btn-action btn-view btn-sm" 
                                            title="Voir profil">
                                        <a href="{{ route('userprofile', ['id' => $utilisateur->id]) }}" class="text-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </button>
                                    <button wire:click="$dispatch('editUser', {id: {{ $utilisateur->id }}})"
                                            class="btn-action btn-edit btn-sm" 
                                            title="Modifier">
                                        <i class="fas fa-edit text-warning"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $utilisateur->id }})"
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
                                <i class="bi bi-people me-2"></i>Aucun utilisateur trouvé
                            </td>
                        </tr>
                    @endforelse
                    @if($utilisateurs->count() > 0)
                        <tr>
                            <td colspan="10" class="py-2 bg-light text-muted small">
                                Affichage de {{ $utilisateurs->count() }} utilisateur(s) sur cette page
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($utilisateurs->hasPages())
        <div class="table-footer bg-light p-3 rounded-bottom mx-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    @if($utilisateurs->total() > 0)
                    Affichage de {{ $utilisateurs->firstItem() }} à {{ $utilisateurs->lastItem() }} sur {{ $utilisateurs->total() }} utilisateurs
                    @else
                    Aucun utilisateur
                    @endif
                </div>
                <div class="pagination-container">
                    {{ $utilisateurs->links() }}
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