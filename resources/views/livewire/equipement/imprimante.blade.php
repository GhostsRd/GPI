<div class="ticket-dashboard">
    <div class="dashboard-container">

        <!-- En-tête -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h4 fw-bold text-dark mb-0">
                <i class="fas fa-print me-2 text-primary"></i> Gestion des Imprimantes
            </h1>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-secondary btn-sm" wire:click="toggleStats">
                    <i class="fas fa-chart-bar me-1"></i>
                    {{ $showStats ? 'Masquer' : 'Afficher' }} stats
                </button>
            </div>
        </div>

        <!-- Message flash -->
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if (session()->has('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        <!-- Statistiques -->
        @if($showStats)
        <div class="row mb-4">
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card stats-widget border-0 shadow-sm dark-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-primary mb-1">{{ $stats['total'] ?? 0 }}</h3>
                            <p class="stats-label text-black mb-0">Total</p>
                        </div>
                        <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                            <i class="fas fa-chart-pie fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card stats-widget border-0 shadow-sm dark-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-success mb-1">{{ $stats['en_service'] ?? 0 }}</h3>
                            <p class="stats-label text-black mb-0">En service</p>
                        </div>
                        <div class="avatar-sm rounded-circle bg-success bg-opacity-25 text-success d-flex align-items-center justify-content-center">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card stats-widget border-0 shadow-sm dark-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-warning mb-1">{{ $stats['en_maintenance'] ?? 0 }}</h3>
                            <p class="stats-label text-black mb-0">En maintenance</p>
                        </div>
                        <div class="avatar-sm rounded-circle bg-warning bg-opacity-25 text-warning d-flex align-items-center justify-content-center">
                            <i class="fas fa-tools fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card stats-widget border-0 shadow-sm dark-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-info mb-1">{{ $stats['en_stock'] ?? 0 }}</h3>
                            <p class="stats-label text-black mb-0">En stock</p>
                        </div>
                        <div class="avatar-sm rounded-circle bg-info bg-opacity-25 text-info d-flex align-items-center justify-content-center">
                            <i class="fas fa-warehouse fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card stats-widget border-0 shadow-sm dark-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-danger mb-1">{{ $stats['hors_service'] ?? 0 }}</h3>
                            <p class="stats-label text-black mb-0">Hors service</p>
                        </div>
                        <div class="avatar-sm rounded-circle bg-danger bg-opacity-25 text-danger d-flex align-items-center justify-content-center">
                            <i class="fas fa-times-circle fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Filtres avec boutons Import/Export -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Recherche</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-transparent">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                   class="form-control" placeholder="Nom, modèle, IP...">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Statut</label>
                        <select wire:model.live="statut" class="form-select form-select-sm">
                            <option value="">Tous</option>
                            @foreach($statuts as $statutOption)
                                <option value="{{ $statutOption }}">{{ $statutOption }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Fabricant</label>
                        <select wire:model.live="fabricant" class="form-select form-select-sm">
                            <option value="">Tous</option>
                            @foreach($fabricants as $fabricantOption)
                                <option value="{{ $fabricantOption }}">{{ $fabricantOption }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Entité</label>
                        <select wire:model.live="entite" class="form-select form-select-sm">
                            <option value="">Toutes</option>
                            @foreach($entites as $entiteOption)
                                <option value="{{ $entiteOption }}">{{ $entiteOption }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="col-md-4">
                        <div class="d-flex gap-2">
                            <button wire:click="resetFilters" class="btn btn-outline-secondary btn-sm flex-fill">
                                <i class="fas fa-redo me-1"></i> RàZ
                            </button>
                            <button wire:click="openImportModal" class="btn btn-outline-info btn-sm flex-fill">
                                <i class="fas fa-file-import me-1"></i> Importer
                            </button>
                            <button wire:click="exportToCsv" class="btn btn-outline-success btn-sm flex-fill">
                                <i class="fas fa-file-export me-1"></i> Exporter
                            </button>
                            <button wire:click="create" class="btn btn-primary btn-sm flex-fill">
                                <i class="fas fa-plus me-1"></i> Ajouter
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sélection multiple -->
                @if(count($selectedImprimantes) > 0)
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="alert alert-info py-2">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ count($selectedImprimantes) }} imprimante(s) sélectionnée(s)
                                </span>
                                <div class="d-flex gap-2">
                                    <button wire:click="deleteSelected" 
                                            wire:confirm="Êtes-vous sûr de vouloir supprimer les {{ count($selectedImprimantes) }} imprimantes sélectionnées ?"
                                            class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash me-1"></i> Supprimer
                                    </button>
                                    <button wire:click="$set('selectedImprimantes', [])" 
                                            class="btn btn-outline-secondary btn-sm">
                                        <i class="fas fa-times me-1"></i> Annuler
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Tableau -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                        <tr>
                            <th width="50">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           wire:model="selectAll"
                                           id="selectAll">
                                </div>
                            </th>
                            <th wire:click="sortBy('nom')" class="text-uppercase small fw-bold cursor-pointer">
                                Nom
                                @if ($sortField === 'nom')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @else
                                    <i class="fas fa-sort ms-1 text-muted"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('entite')" class="text-uppercase small fw-bold cursor-pointer">
                                Entité
                                @if ($sortField === 'entite')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @else
                                    <i class="fas fa-sort ms-1 text-muted"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('statut')" class="text-uppercase small fw-bold cursor-pointer">
                                Statut
                                @if ($sortField === 'statut')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @else
                                    <i class="fas fa-sort ms-1 text-muted"></i>
                                @endif
                            </th>
                            <th>Fabricant</th>
                            <th>IP</th>
                            <th>Série</th>
                            <th>Lieu</th>
                            <th>Type</th>
                            <th>Modèle</th>
                            <th wire:click="sortBy('updated_at')" class="text-uppercase small fw-bold cursor-pointer">
                                Dernière modif.
                                @if ($sortField === 'updated_at')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                @else
                                    <i class="fas fa-sort ms-1 text-muted"></i>
                                @endif
                            </th>
                            <th class="text-uppercase small fw-bold">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($imprimantes as $imprimante)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               value="{{ $imprimante->id }}"
                                               wire:model="selectedImprimantes"
                                               id="imprimante_{{ $imprimante->id }}">
                                    </div>
                                </td>
                                <td class="fw-semibold">{{ $imprimante->nom }}</td>
                                <td>{{ $imprimante->entite }}</td>
                                <td>
                                    @php
                                        $statusClasses = [
                                            'En service' => 'badge bg-success bg-opacity-25 text-success',
                                            'En maintenance' => 'badge bg-warning bg-opacity-25 text-warning',
                                            'Hors service' => 'badge bg-danger bg-opacity-25 text-danger',
                                            'En stock' => 'badge bg-info bg-opacity-25 text-info'
                                        ];
                                    @endphp
                                    <span class="{{ $statusClasses[$imprimante->statut] ?? 'badge bg-secondary' }}">
                                        {{ $imprimante->statut }}
                                    </span>
                                </td>
                                <td>{{ $imprimante->fabricant }}</td>
                                <td class="font-monospace">{{ $imprimante->reseau_ip }}</td>
                                <td class="font-monospace">{{ $imprimante->numero_serie }}</td>
                                <td>{{ $imprimante->lieu }}</td>
                                <td>{{ $imprimante->type }}</td>
                                <td>{{ $imprimante->modele }}</td>
                                <td>{{ $imprimante->updated_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <!-- Bouton Voir Détails -->
                                        <button wire:click="showDetails({{ $imprimante->id }})"
                                                class="btn btn-sm btn-outline-info"
                                                title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <!-- Bouton Modifier -->
                                        <button wire:click="edit({{ $imprimante->id }})"
                                                class="btn btn-sm btn-outline-primary"
                                                title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Bouton Fichiers -->
                                        <button wire:click="openFileModal({{ $imprimante->id }})"
                                                class="btn btn-sm btn-outline-secondary"
                                                title="Fichiers attachés">
                                            <i class="fas fa-paperclip"></i>
                                        </button>
                                        <!-- Bouton Supprimer -->
                                        <button wire:click="confirmDelete({{ $imprimante->id }})"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center text-muted py-3">
                                    <i class="fas fa-print fa-2x mb-3 d-block"></i>
                                    Aucune imprimante trouvée.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $imprimantes->links() }}
        </div>
    </div>

    <!-- Modal pour créer/modifier une imprimante -->
    @if($showModal)
        <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5)" tabindex="-1" aria-labelledby="imprimanteModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="imprimanteModalLabel">
                            <i class="fas {{ $isEditing ? 'fa-edit' : 'fa-plus' }} me-2"></i>
                            {{ $isEditing ? 'Modifier l\'imprimante' : 'Nouvelle Imprimante' }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                    </div>
                    <form wire:submit.prevent="save">
                        <div class="modal-body">
                            <div class="row g-3">
                                <!-- Colonne gauche -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nom" class="form-label">Nom de l'imprimante *</label>
                                        <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                               id="nom" wire:model="nom" required>
                                        @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="entite_form" class="form-label">Entité</label>
                                        <input type="text" class="form-control @error('entite_form') is-invalid @enderror"
                                               id="entite_form" wire:model="entite_form" placeholder="Service, département...">
                                        @error('entite_form') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="statut_form" class="form-label">Statut *</label>
                                        <select class="form-select @error('statut_form') is-invalid @enderror"
                                                id="statut_form" wire:model="statut_form" required>
                                            <option value="">Sélectionner un statut</option>
                                            @foreach($statuts as $statutOption)
                                                <option value="{{ $statutOption }}">{{ $statutOption }}</option>
                                            @endforeach
                                        </select>
                                        @error('statut_form') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="fabricant_form" class="form-label">Fabricant</label>
                                        <input type="text" class="form-control @error('fabricant_form') is-invalid @enderror"
                                               id="fabricant_form" wire:model="fabricant_form" placeholder="HP, Canon, Epson...">
                                        @error('fabricant_form') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="numero_serie" class="form-label">Numéro de série</label>
                                        <input type="text" class="form-control @error('numero_serie') is-invalid @enderror"
                                               id="numero_serie" wire:model="numero_serie">
                                        @error('numero_serie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <!-- Colonne droite -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="modele" class="form-label">Modèle</label>
                                        <input type="text" class="form-control @error('modele') is-invalid @enderror"
                                               id="modele" wire:model="modele" placeholder="Modèle de l'imprimante">
                                        @error('modele') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="type" class="form-label">Type</label>
                                        <select class="form-select @error('type') is-invalid @enderror"
                                                id="type" wire:model="type">
                                            <option value="">Sélectionner un type</option>
                                            @foreach($types as $typeOption)
                                                <option value="{{ $typeOption }}">{{ $typeOption }}</option>
                                            @endforeach
                                        </select>
                                        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="reseau_ip" class="form-label">Adresse IP</label>
                                        <input type="text" class="form-control @error('reseau_ip') is-invalid @enderror"
                                               id="reseau_ip" wire:model="reseau_ip" placeholder="192.168.1.100">
                                        @error('reseau_ip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="lieu" class="form-label">Lieu</label>
                                        <input type="text" class="form-control @error('lieu') is-invalid @enderror"
                                               id="lieu" wire:model="lieu" placeholder="Bureau, étage...">
                                        @error('lieu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="commentaires" class="form-label">Commentaires</label>
                                        <textarea class="form-control @error('commentaires') is-invalid @enderror"
                                                  id="commentaires" wire:model="commentaires" rows="3"
                                                  placeholder="Notes supplémentaires..."></textarea>
                                        @error('commentaires') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Annuler</button>
                            <button type="submit" class="btn btn-primary">
                                <span wire:loading.remove>{{ $isEditing ? 'Modifier' : 'Créer' }}</span>
                                <span wire:loading>
                                    <i class="fas fa-spinner fa-spin me-1"></i>
                                    {{ $isEditing ? 'Modification...' : 'Création...' }}
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de détails de l'imprimante -->
    @if($showDetailsModal)
        <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5)" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="detailsModalLabel">
                            <i class="fas fa-info-circle me-2"></i>Détails de l'Imprimante
                        </h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="closeDetailsModal"></button>
                    </div>
                    <div class="modal-body">
                        @if($selectedImprimante)
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-1">Nom</h6>
                                        <p class="fw-semibold">{{ $selectedImprimante->nom }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <h6 class="text-muted mb-1">Entité</h6>
                                        <p class="fw-semibold">{{ $selectedImprimante->entite ?? 'Non spécifié' }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <h6 class="text-muted mb-1">Statut</h6>
                                        @php
                                            $statusClasses = [
                                                'En service' => 'badge bg-success',
                                                'En maintenance' => 'badge bg-warning',
                                                'Hors service' => 'badge bg-danger',
                                                'En stock' => 'badge bg-info'
                                            ];
                                        @endphp
                                        <span class="{{ $statusClasses[$selectedImprimante->statut] ?? 'badge bg-secondary' }}">
                                            {{ $selectedImprimante->statut }}
                                        </span>
                                    </div>

                                    <div class="mb-3">
                                        <h6 class="text-muted mb-1">Fabricant</h6>
                                        <p class="fw-semibold">{{ $selectedImprimante->fabricant ?? 'Non spécifié' }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <h6 class="text-muted mb-1">Numéro de série</h6>
                                        <p class="fw-semibold font-monospace">{{ $selectedImprimante->numero_serie ?? 'Non renseigné' }}</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-1">Modèle</h6>
                                        <p class="fw-semibold">{{ $selectedImprimante->modele ?? 'Non spécifié' }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <h6 class="text-muted mb-1">Type</h6>
                                        <p class="fw-semibold">{{ $selectedImprimante->type ?? 'Non spécifié' }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <h6 class="text-muted mb-1">Adresse IP</h6>
                                        <p class="fw-semibold font-monospace">{{ $selectedImprimante->reseau_ip ?? 'Non configurée' }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <h6 class="text-muted mb-1">Lieu</h6>
                                        <p class="fw-semibold">{{ $selectedImprimante->lieu ?? 'Non spécifié' }}</p>
                                    </div>

                                    @if($selectedImprimante->commentaires)
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-1">Commentaires</h6>
                                        <p class="fw-semibold">{{ $selectedImprimante->commentaires }}</p>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <h6 class="text-muted mb-1">Date de création</h6>
                                        <p class="fw-semibold">{{ $selectedImprimante->created_at->format('d/m/Y à H:i') }}</p>
                                    </div>

                                    <div class="mb-3">
                                        <h6 class="text-muted mb-1">Dernière modification</h6>
                                        <p class="fw-semibold">{{ $selectedImprimante->updated_at->format('d/m/Y à H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3"></i>
                                <p class="text-muted">Impossible de charger les détails de l'imprimante.</p>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeDetailsModal">Fermer</button>
                        @if($selectedImprimante)
                            <button type="button" class="btn btn-primary" wire:click="edit({{ $selectedImprimante->id }})">
                                <i class="fas fa-edit me-2"></i>Modifier
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de confirmation de suppression -->
    @if($confirmingDelete)
        <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5)" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                        <button type="button" class="btn-close" wire:click="closeDeleteModal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Êtes-vous sûr de vouloir supprimer l'imprimante <strong>{{ $selectedImprimanteName }}</strong> ?</p>
                        <p class="text-danger">Cette action est irréversible.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeDeleteModal">Annuler</button>
                        <button type="button" class="btn btn-danger" wire:click="deleteConfirmed">
                            <i class="fas fa-trash me-2"></i>Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal d'import -->
    @if($showImportModal)
        <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5)" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="importModalLabel">
                            <i class="fas fa-file-import me-2"></i>Importer des Imprimantes
                        </h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="closeImportModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Formats supportés: Excel (.xlsx, .xls), CSV. Taille max: 10MB
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Fichier à importer</label>
                            <input type="file" wire:model="importFile" class="form-control" accept=".xlsx,.xls,.csv">
                            @error('importFile') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        @if($importErrors)
                        <div class="alert alert-danger">
                            <h6 class="alert-heading">Erreurs d'importation</h6>
                            <ul class="mb-0 small">
                                @foreach($importErrors as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if($importSuccessCount > 0)
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ $importSuccessCount }} imprimante(s) importé(s) avec succès !
                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeImportModal">Annuler</button>
                        <button type="button" class="btn btn-info" wire:click="importImprimantes" 
                                wire:loading.attr="disabled" {{ !$importFile ? 'disabled' : '' }}>
                            <i class="fas fa-file-import me-1"></i>
                            <span wire:loading.remove>Importer</span>
                            <span wire:loading>Import en cours...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de mapping pour l'import -->
    @if($showMappingModal)
        <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5)" tabindex="-1" aria-labelledby="mappingModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="mappingModalLabel">
                            <i class="fas fa-columns me-2"></i>Mapping des Colonnes
                        </h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="closeMappingModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Associez les colonnes de votre fichier aux champs de la base de données.
                            <strong class="d-block mt-1">La colonne "Nom" est obligatoire.</strong>
                        </div>

                        @if($csvHeaders)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Champ de la base</th>
                                        <th>Colonne dans le fichier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fieldMapping as $field => $mappedHeader)
                                    <tr>
                                        <td class="fw-semibold">
                                            <span class="badge {{ $field === 'nom' ? 'bg-danger' : 'bg-secondary' }} me-2">
                                                {{ $field === 'nom' ? 'Obligatoire' : 'Optionnel' }}
                                            </span>
                                            {{ $field }}
                                        </td>
                                        <td>
                                            <select class="form-select form-select-sm" wire:model="fieldMapping.{{ $field }}">
                                                <option value="">-- Non mappé --</option>
                                                @foreach($csvHeaders as $header)
                                                <option value="{{ $header }}">
                                                    {{ $header }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif

                        @if($importErrors)
                        <div class="alert alert-danger mt-3">
                            <h6 class="alert-heading">Erreurs détectées</h6>
                            <ul class="mb-0 small">
                                @foreach($importErrors as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeMappingModal">Annuler</button>
                        <button type="button" class="btn btn-primary" wire:click="processMappedData" 
                                wire:loading.attr="disabled" {{ empty($fieldMapping['nom']) ? 'disabled' : '' }}>
                            <i class="fas fa-file-import me-1"></i>
                            <span wire:loading.remove>Traiter les données</span>
                            <span wire:loading>Traitement en cours...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de gestion des fichiers -->
    @if($showFileModal)
        <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5)" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-secondary text-white">
                        <h5 class="modal-title" id="fileModalLabel">
                            <i class="fas fa-paperclip me-2"></i>Fichiers attachés
                            @if($selectedImprimanteForFiles)
                                - {{ $selectedImprimanteForFiles->nom }}
                            @endif
                        </h5>
                        <button type="button" class="btn-close btn-close-white" wire:click="closeFileModal"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Upload de fichiers -->
                        <div class="mb-4">
                            <label class="form-label">Ajouter des fichiers</label>
                            <input type="file" wire:model="uploadedFiles" class="form-control" multiple
                                   accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx,.txt">
                            <div class="form-text">Formats supportés: images, PDF, Word, Excel, texte. Max 10MB par fichier.</div>
                            
                            @if(count($uploadedFiles) > 0)
                            <div class="mt-2">
                                <button wire:click="uploadFiles" class="btn btn-success btn-sm">
                                    <i class="fas fa-upload me-1"></i>Uploader {{ count($uploadedFiles) }} fichier(s)
                                </button>
                            </div>
                            @endif
                        </div>

                        <!-- Liste des fichiers -->
                        <div>
                            <h6 class="mb-3">Fichiers attachés ({{ count($attachedFiles) }})</h6>
                            
                            @if(count($attachedFiles) > 0)
                            <div class="list-group">
                                @foreach($attachedFiles as $file)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-file me-2 text-muted"></i>
                                        <span class="fw-semibold">{{ $file['name'] }}</span>
                                        <small class="text-muted ms-2">({{ $file['size'] }})</small>
                                        <br>
                                        <small class="text-muted">Ajouté le {{ $file['date'] }}</small>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ $file['url'] }}" target="_blank" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <button wire:click="deleteFile('{{ $file['path'] }}')"
                                                wire:confirm="Êtes-vous sûr de vouloir supprimer ce fichier ?"
                                                class="btn btn-outline-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-folder-open fa-2x mb-2"></i>
                                <p>Aucun fichier attaché</p>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeFileModal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
    // Fermer les modals avec la touche Echap
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            @this.dispatch('closeModal');
            @this.dispatch('closeDetailsModal');
            @this.dispatch('closeDeleteModal');
            @this.dispatch('closeImportModal');
            @this.dispatch('closeMappingModal');
            @this.dispatch('closeFileModal');
        }
    });

    // Gérer les clics en dehors des modals
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal')) {
            @this.dispatch('closeModal');
            @this.dispatch('closeDetailsModal');
            @this.dispatch('closeDeleteModal');
            @this.dispatch('closeImportModal');
            @this.dispatch('closeMappingModal');
            @this.dispatch('closeFileModal');
        }
    });
</script>
@endpush