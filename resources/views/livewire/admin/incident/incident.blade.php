<div>
    <div class="table-container border-0 shadow-sm fade-in-up">
        <div class="table-header bg-light p-3 rounded-top">
            <div class="table-title fw-bold text-dark">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Liste des Incidents
            </div>
        </div>

        <!-- Statistiques des incidents -->
        <div class="row p-3">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-primary">{{ $this->stats['total'] }}</h3>
                                <p class="stats-label text-black mb-0">Total incidents</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                    <i class="fas fa-exclamation-triangle fa-lg"></i>
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
                                <h3 class="stats-number text-primary">{{ $this->stats['en_traitement'] }}</h3>
                                <p class="stats-label text-black mb-0">En traitement</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                    <i class="fas fa-cogs fa-lg"></i>
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
                                <h3 class="stats-number text-danger">{{ $this->stats['demande_annulation'] }}</h3>
                                <p class="stats-label text-black mb-0">Demande annulation</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-danger bg-opacity-25 text-danger d-flex align-items-center justify-content-center">
                                    <i class="fas fa-times-circle fa-lg"></i>
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
                            <option value="1">En cours</option>
                            <option value="2">En traitement</option>
                            <option value="0">Demande annulation</option>
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
                                title="Supprimer les incidents sélectionnés"
                                {{ empty($selectedTickets) ? 'disabled' : '' }}>
                            <i class="fas fa-trash"></i>
                            ({{ count($selectedTickets) }})
                        </button>
                    </div>

                    <div class="col-md-1">
                        <button wire:click="exportIncidents" class="btn btn-success btn-sm w-100 mt-3" 
                                title="Exporter les incidents">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des incidents -->
        <div class="table-wrapper p-0 border-0 w-100 compact-mode mx-3">
            <table class="table table-hover border-0 shadow-sm text-center small">
                <thead class="table-light">
                    <tr>
                        <th class="py-2" style="width: 30px;">
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('id')" style="width: 80px;">
                            Référence
                            @if($sortField === 'id')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="bi bi-arrow-down-up ms-1"></i>
                            @endif
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('utilisateur_id')" style="width: 120px;">
                            Utilisateur
                            @if($sortField === 'utilisateur_id')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="bi bi-arrow-down-up ms-1"></i>
                            @endif
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('equipement_type')" style="width: 120px;">
                            Type matériel
                            @if($sortField === 'equipement_type')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="bi bi-arrow-down-up ms-1"></i>
                            @endif
                        </th>
                        <th class="py-2" style="width: 150px;">
                            Détails matériel
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('statut')" style="width: 120px;">
                            Statut
                            @if($sortField === 'statut')
                                <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                            @else
                                <i class="bi bi-arrow-down-up ms-1"></i>
                            @endif
                        </th>
                        <th class="py-2" style="width: 120px;">
                            Rapport d'incident
                        </th>
                        <th class="py-2" style="width: 120px;">
                            Déclaration de perte
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
                        <th class="py-2" style="width: 80px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($incidents as $incident)
                        <tr class="hover-row" style="cursor:pointer">
                            <td class="py-2">
                                <input type="checkbox"
                                       wire:model="selectedTickets"
                                       value="{{ $incident->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td class="py-2 fw-bold text-primary" wire:click="Visualiser({{ $incident->id }})">
                                #{{ $incident->id }}
                            </td>
                            <td class="py-2" wire:click="Visualiser({{ $incident->id }})">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($incident->utilisateur->nom ?? 'Utilisateur') }}&size=24&background=random" 
                                         class="rounded-circle me-2" width="20" height="20">
                                    <span class="text-muted small">{{ $incident->utilisateur->nom ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="py-2" wire:click="Visualiser({{ $incident->id }})">
                                <span class="badge bg-light text-dark border small">
                                    {{ $incident->equipement_type }}
                                </span>
                            </td>
                            <td class="py-2" wire:click="Visualiser({{ $incident->id }})">
                                <small class="text-muted">
                                    @if ($incident->equipement_type == 'Ordinateur')
                                        {{ $incident->ordinateur->nom ?? 'N/A' }} - {{ $incident->ordinateur->os_version ?? '' }}
                                    @elseif ($incident->equipement_type == 'Telephone')
                                        {{ $incident->telephone->nom ?? 'N/A' }} - {{ $incident->telephone->marque ?? '' }}
                                    @else
                                        {{ $incident->equipement_details ?? 'N/A' }}
                                    @endif
                                </small>
                            </td>
                            <td class="py-2">
                                @if($incident->statut == 1)
                                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning small">
                                        <i class="bi bi-clock me-1"></i>En cours
                                    </span>
                                @elseif($incident->statut == 2)
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary small">
                                        <i class="bi bi-gear me-1"></i>En traitement
                                    </span>
                                @elseif($incident->statut == 0)
                                    <div class="d-flex flex-column gap-1">
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger small">
                                            <i class="bi bi-x-circle me-1"></i>Demande annulation
                                        </span>
                                        <button wire:click="SupprimerDemande({{ $incident->id }})"  
                                                class="btn btn-outline-danger btn-xs shadow-sm">
                                            Supprimer
                                        </button>
                                    </div>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary small">
                                        {{ $incident->statut }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-2">
                                @if($incident->rapport_incident)
                                    <a href="{{ asset('storage/' . $incident->rapport_incident) }}"
                                       target="_blank" 
                                       class="btn btn-outline-primary btn-xs d-flex align-items-center justify-content-center gap-1"
                                       title="Télécharger le rapport">
                                        <i class="bi bi-download"></i>
                                        <span>Télécharger</span>
                                    </a>
                                @else
                                    <span class="text-muted small">Non disponible</span>
                                @endif
                            </td>
                            <td class="py-2">
                                @if($incident->declaration_perte)
                                    <a href="{{ asset('storage/' . $incident->declaration_perte) }}"
                                       target="_blank" 
                                       class="btn btn-outline-primary btn-xs d-flex align-items-center justify-content-center gap-1"
                                       title="Télécharger la déclaration">
                                        <i class="bi bi-download"></i>
                                        <span>Télécharger</span>
                                    </a>
                                @else
                                    <span class="text-muted small">Non disponible</span>
                                @endif
                            </td>
                            <td class="py-2 text-muted small" wire:click="Visualiser({{ $incident->id }})">
                                {{ $incident->created_at->format('d M Y') }}
                                <br>
                                <small class="text-muted">{{ $incident->created_at->format('H:i') }}</small>
                            </td>
                            <td class="py-2 text-muted small" wire:click="Visualiser({{ $incident->id }})">
                                {{ $incident->updated_at->format('d M Y') }}
                                <br>
                                <small class="text-muted">{{ $incident->updated_at->format('H:i') }}</small>
                            </td>
                            <td class="py-2">
                                <div class="action-buttons d-flex justify-content-center gap-1">
                                    <button class="btn-action btn-view btn-sm" 
                                            title="Voir détails">
                                        <a href="{{ url('/admin/ticket-view-'.$incident->id) }}" class="text-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </button>
                                    <button wire:click="$dispatch('editTicket', {id: {{ $incident->id }}})"
                                            class="btn-action btn-edit btn-sm" 
                                            title="Modifier">
                                        <i class="fas fa-edit text-warning"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $incident->id }})"
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
                                <i class="bi bi-exclamation-triangle me-2"></i>Aucun incident trouvé
                            </td>
                        </tr>
                    @endforelse
                    @if($incidents->count() > 0)
                        <tr>
                            <td colspan="11" class="py-2 bg-light text-muted small">
                                Affichage de {{ $incidents->count() }} incident(s) sur cette page
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($incidents->hasPages())
        <div class="table-footer bg-light p-3 rounded-bottom mx-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    @if($incidents->total() > 0)
                    Affichage de {{ $incidents->firstItem() }} à {{ $incidents->lastItem() }} sur {{ $incidents->total() }} incidents
                    @else
                    Aucun incident
                    @endif
                </div>
                <div class="pagination-container">
                    {{ $incidents->links() }}
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