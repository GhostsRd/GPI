<div class="materiel-dashboard">
    <div class="dashboard-container">
        <!-- En-tête -->
        <div class="mb-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Gestion des Matériels Réseau</h1>
            <p class="text-gray-600">Inventaire complet des équipements réseau</p>
        </div>

        <!-- Statistiques -->
        <div class="row mb-4">
            <!-- Total -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-primary mb-1">{{ $stats['total'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Total Matériel Réseau</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-primary" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-primary ms-3">
                            <i class="fas fa-network-wired"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En service -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-success mb-1">{{ $stats['en_service'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">En Service</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-success" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['en_service'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-success ms-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En maintenance -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-warning mb-1">{{ $stats['en_maintenance'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">En Maintenance</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-warning" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['en_maintenance'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-warning ms-3">
                            <i class="fas fa-tools"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En stock -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-info mb-1">{{ $stats['en_stock'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">En Stock</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-info" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['en_stock'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-info ms-3">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hors service -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-danger mb-1">{{ $stats['hors_service'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Hors Service</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-danger" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['hors_service'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg icon-danger ms-3">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Taux de disponibilité -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            @php
                                $disponible = $stats['en_service'] ?? 0;
                                $total = $stats['total'] ?? 1;
                                $taux = $total > 0 ? round(($disponible / $total) * 100) : 0;
                            @endphp
                            <h3 class="stat-number mb-1 {{ $taux >= 80 ? 'text-success' : ($taux >= 60 ? 'text-warning' : 'text-danger') }}">
                                {{ $taux }}%
                            </h3>
                            <p class="text-muted small mb-0 fw-medium">Disponibilité</p>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar {{ $taux >= 80 ? 'bg-success' : ($taux >= 60 ? 'bg-warning' : 'bg-danger') }}" 
                                     style="width: {{ $taux }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-lg {{ $taux >= 80 ? 'icon-success' : ($taux >= 60 ? 'icon-warning' : 'icon-danger') }} ms-3">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres avec boutons Import/Export -->
        <div class="dashboard-card p-3 mb-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-semibold mb-0 text-dark small">Filtres et Actions</h6>
                <div class="d-flex gap-2">
                    <button wire:click="resetFilters" class="btn btn-outline-secondary btn-sm" title="Réinitialiser les filtres">
                        <i class="fas fa-redo"></i>
                    </button>
                    <button class="btn btn-outline-secondary btn-sm d-md-none" title="Afficher/Masquer les filtres">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </div>

            <div class="row g-3 align-items-end" id="filters-container">
                <!-- Recherche -->
                <div class="col-md-3 col-sm-6">
                    <label class="form-label small fw-medium text-muted">Recherche</label>
                    <div class="search-box position-relative">
                        <i class="fas fa-search position-absolute top-50 start-0 translate-middle-y ms-2 text-muted small"></i>
                        <input type="text" wire:model.live.debounce.300ms="search"
                               class="form-control form-control-sm ps-4 border-0 bg-light rounded-2"
                               placeholder="Nom, modèle, IP...">
                    </div>
                </div>

                <!-- Statut -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium text-muted">Statut</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0 text-muted">
                            <i class="fas fa-circle"></i>
                        </span>
                        <select wire:model.live="statutFilter" class="form-select border-0 bg-light rounded-2">
                            <option value="">Tous les statuts</option>
                            @foreach($statutOptions as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Type -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium text-muted">Type</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0 text-muted">
                            <i class="fas fa-network-wired"></i>
                        </span>
                        <select wire:model.live="typeFilter" class="form-select border-0 bg-light rounded-2">
                            <option value="">Tous les types</option>
                            @foreach($typeOptions as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Fabricant -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium text-muted">Fabricant</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0 text-muted">
                            <i class="fas fa-industry"></i>
                        </span>
                        <select wire:model.live="fabricantFilter" class="form-select border-0 bg-light rounded-2">
                            <option value="">Tous les fabricants</option>
                            @foreach($fabricantOptions as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Entité -->
                <div class="col-md-2 col-sm-6">
                    <label class="form-label small fw-medium text-muted">Entité</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0 text-muted">
                            <i class="fas fa-building"></i>
                        </span>
                        <select wire:model.live="entiteFilter" class="form-select border-0 bg-light rounded-2">
                            <option value="">Toutes les entités</option>
                            @foreach($entiteOptions as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="col-md-3">
                    <div class="d-flex gap-2 flex-wrap justify-content-end">
                        <button wire:click="openImportModal" class="btn btn-outline-primary btn-sm d-flex align-items-center">
                            <i class="fas fa-file-import me-1"></i>
                            <span class="d-none d-sm-inline">Importer</span>
                        </button>
                        <button wire:click="exportToCsv" class="btn btn-outline-primary btn-sm d-flex align-items-center">
                            <i class="fas fa-file-export me-1"></i>
                            <span class="d-none d-sm-inline">Exporter</span>
                        </button>
                        <button wire:click="showCreateForm" class="btn btn-primary btn-sm d-flex align-items-center">
                            <i class="fas fa-plus me-1"></i>
                            <span class="d-none d-sm-inline">Nouveau</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Résultats du filtre -->
            @if($search || $statutFilter || $typeFilter || $fabricantFilter || $entiteFilter)
            <div class="mt-3 pt-2 border-top">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="text-muted small">Filtres actifs :</span>
                    @if($search)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Recherche: "{{ $search }}"
                        <button wire:click="$set('search', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    @if($statutFilter)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Statut: {{ $statutFilter }}
                        <button wire:click="$set('statutFilter', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    @if($typeFilter)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Type: {{ $typeFilter }}
                        <button wire:click="$set('typeFilter', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    @if($fabricantFilter)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Fabricant: {{ $fabricantFilter }}
                        <button wire:click="$set('fabricantFilter', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                    @if($entiteFilter)
                    <span class="badge bg-light text-dark border small d-flex align-items-center">
                        Entité: {{ $entiteFilter }}
                        <button wire:click="$set('entiteFilter', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                    </span>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Sélection multiple -->
        @if(count($selectedMateriels) > 0)
        <div class="row mt-3">
            <div class="col-12">
                <div class="alert alert-info py-2 small border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ count($selectedMateriels) }} matériel(s) sélectionné(s)
                        </span>
                        <div class="d-flex gap-2">
                            <button wire:click="confirmBulkDelete" 
                                    class="btn btn-outline-danger btn-sm d-flex align-items-center">
                                <i class="fas fa-trash me-1"></i>
                                <span>Supprimer</span>
                            </button>
                            <button wire:click="$set('selectedMateriels', [])" 
                                    class="btn btn-outline-secondary btn-sm d-flex align-items-center">
                                <i class="fas fa-times me-1"></i>
                                <span>Annuler</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Table Container -->
        <div class="table-container border-0 fade-in-up">
            <div class="table-header">
                <div class="table-title">
                    Liste des Matériels ({{ $materiels->total() }})
                </div>
            </div>

            <div class="table-wrapper p-0 border-0 w-100 compact-mode">
                <table class="table border-0 shadow-sm">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                        </th>
                        <th wire:click="sortBy('nom')" class="sortable">
                            Nom
                            @if($sortField === 'nom')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('entite')" class="sortable">
                            Entité
                            @if($sortField === 'entite')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('statut')" class="sortable">
                            Statut
                            @if($sortField === 'statut')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th>Fabricant</th>
                        <th>Type</th>
                        <th>Modèle</th>
                        <th>N° Série</th>
                        <th>IP Réseau</th>
                        <th>Lieu</th>
                        <th wire:click="sortBy('updated_at')" class="sortable">
                            Dernière modif.
                            @if($sortField === 'updated_at')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($materiels as $materiel)
                        <tr class="statut-{{ \Illuminate\Support\Str::slug($materiel->statut) }}" style="cursor:pointer">
                            <td>
                                <input type="checkbox"
                                       wire:model="selectedMateriels"
                                       value="{{ $materiel->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td wire:click="showDetails({{ $materiel->id }})">{{ $materiel->nom }}</td>
                            <td wire:click="showDetails({{ $materiel->id }})">{{ $materiel->entite ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $materiel->id }})">
                                @php
                                    $statutClasses = [
                                        'En service' => 'bg-success text-white',
                                        'En stock' => 'bg-info text-white',
                                        'Hors service' => 'bg-danger text-white',
                                        'En maintenance' => 'bg-warning text-dark'
                                    ];
                                    $classe = $statutClasses[$materiel->statut] ?? 'bg-secondary text-white';
                                @endphp
                                <span class="badge {{ $classe }}">
                                    {{ $materiel->statut }}
                                </span>
                            </td>
                            <td wire:click="showDetails({{ $materiel->id }})">{{ $materiel->fabricant ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $materiel->id }})">{{ $materiel->type ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $materiel->id }})">{{ $materiel->modele ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $materiel->id }})" class="font-mono">{{ $materiel->numero_serie ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $materiel->id }})" class="font-mono">{{ $materiel->reseau_ip ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $materiel->id }})">{{ $materiel->lieu ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $materiel->id }})">{{ $materiel->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button wire:click="showEditForm({{ $materiel->id }})"
                                            class="btn-action btn-edit" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $materiel->id }})"
                                            class="btn-action btn-delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center py-4">
                                <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                <p class="text-muted">Aucun matériel trouvé</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 container">
                {{ $materiels->links() }}
            </div>
        </div>
    </div>

    <!-- Modal de formulaire -->
    @if($showForm)
    <div class="modal-backdrop fade show" style="z-index: 1050;"></div>
    <div class="modal fade show d-block" style="z-index: 1060;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-gradient-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas {{ $editMode ? 'fa-edit' : 'fa-plus-circle' }} me-2"></i>
                        {{ $editMode ? 'Modifier le Matériel' : 'Nouveau Matériel' }}
                    </h5>
                    <button type="button" wire:click="cancelForm" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="saveMateriel">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                                    <input type="text" wire:model="nom" class="form-control" 
                                           placeholder="Nom du matériel" required>
                                    @error('nom') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold">Entité</label>
                                    <select wire:model="entite" class="form-select">
                                        <option value="">Sélectionnez une entité</option>
                                        @foreach($entiteOptions as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold">Statut <span class="text-danger">*</span></label>
                                    <select wire:model="statut" class="form-select" required>
                                        @foreach($statutOptions as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                    @error('statut') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold">Fabricant</label>
                                    <select wire:model="fabricant" class="form-select">
                                        <option value="">Sélectionnez un fabricant</option>
                                        @foreach($fabricantOptions as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold">Type</label>
                                    <select wire:model="type" class="form-select">
                                        <option value="">Sélectionnez un type</option>
                                        @foreach($typeOptions as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold">Modèle</label>
                                    <input type="text" wire:model="modele" class="form-control" 
                                           placeholder="Modèle du matériel">
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold">Numéro de série</label>
                                    <input type="text" wire:model="numero_serie" class="form-control" 
                                           placeholder="Numéro de série unique">
                                    @error('numero_serie') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold">Adresse IP</label>
                                    <input type="text" wire:model="reseau_ip" class="form-control" 
                                           placeholder="192.168.1.1">
                                    @error('reseau_ip') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group">
                                    <label class="form-label fw-semibold">Lieu</label>
                                    <input type="text" wire:model="lieu" class="form-control" 
                                           placeholder="Localisation du matériel">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer bg-light mt-4">
                            <button type="button" wire:click="cancelForm" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-2"></i>Annuler
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>
                                {{ $editMode ? 'Mettre à jour' : 'Créer' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de détails -->
    @if($showDetailsModal)
    <div class="modal-backdrop fade show" style="z-index: 1050;"></div>
    <div class="modal fade show d-block" style="z-index: 1060;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-gradient-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-network-wired me-2"></i>Détails du Matériel
                    </h5>
                    <button type="button" wire:click="closeDetailsModal" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body p-4">
                    @if($selectedMateriel)
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <h6 class="text-muted mb-2">Nom du matériel</h6>
                                    <p class="fw-semibold text-dark">{{ $selectedMateriel->nom ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="info-card">
                                    <h6 class="text-muted mb-2">Entité</h6>
                                    <p class="fw-semibold text-dark">{{ $selectedMateriel->entite ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="info-card">
                                    <h6 class="text-muted mb-2">Statut</h6>
                                    @php
                                        $statusClasses = [
                                            'En service' => 'badge bg-success',
                                            'En maintenance' => 'badge bg-warning text-dark',
                                            'Hors service' => 'badge bg-danger',
                                            'En stock' => 'badge bg-info'
                                        ];
                                    @endphp
                                    <span class="{{ $statusClasses[$selectedMateriel->statut] ?? 'badge bg-secondary' }}">
                                        {{ $selectedMateriel->statut ?? 'Non défini' }}
                                    </span>
                                </div>

                                <div class="info-card">
                                    <h6 class="text-muted mb-2">Fabricant</h6>
                                    <p class="fw-semibold text-dark">{{ $selectedMateriel->fabricant ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="info-card">
                                    <h6 class="text-muted mb-2">Type</h6>
                                    <p class="fw-semibold text-dark">{{ $selectedMateriel->type ?? 'Non spécifié' }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-card">
                                    <h6 class="text-muted mb-2">Modèle</h6>
                                    <p class="fw-semibold text-dark">{{ $selectedMateriel->modele ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="info-card">
                                    <h6 class="text-muted mb-2">Numéro de série</h6>
                                    <p class="fw-semibold text-dark font-monospace bg-light p-2 rounded">
                                        {{ $selectedMateriel->numero_serie ?? 'Non renseigné' }}
                                    </p>
                                </div>

                                <div class="info-card">
                                    <h6 class="text-muted mb-2">Adresse IP</h6>
                                    <p class="fw-semibold text-dark font-monospace bg-light p-2 rounded">
                                        {{ $selectedMateriel->reseau_ip ?? 'Non configurée' }}
                                    </p>
                                </div>

                                <div class="info-card">
                                    <h6 class="text-muted mb-2">Lieu</h6>
                                    <p class="fw-semibold text-dark">{{ $selectedMateriel->lieu ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="info-card">
                                    <h6 class="text-muted mb-2">Date d'ajout</h6>
                                    <p class="fw-semibold text-dark">{{ $selectedMateriel->created_at?->format('d/m/Y à H:i') ?? '—' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="info-card bg-light p-3 rounded">
                                    <h6 class="text-muted mb-2">Dernière mise à jour</h6>
                                    <p class="fw-semibold text-dark">{{ $selectedMateriel->updated_at?->format('d/m/Y à H:i') ?? '—' }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                            <p class="text-muted">Impossible de charger les détails du matériel.</p>
                        </div>
                    @endif
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" wire:click="closeDetailsModal">
                        <i class="fas fa-times me-2"></i>Fermer
                    </button>
                    @if($selectedMateriel)
                        <button type="button" class="btn btn-primary" wire:click="showEditForm({{ $selectedMateriel->id }})">
                            <i class="fas fa-edit me-2"></i>Modifier
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de confirmation de suppression -->
    @if($showDeleteModal)
    <div class="modal fade show" 
         style="display: block; background: rgba(0,0,0,0.5);"
         tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white border-0">
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-exclamation-triangle me-2"></i> Confirmation de suppression
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeDeleteModal"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-trash3 text-danger" style="font-size: 3rem;"></i>
                    </div>
                    @if($isBulkDelete)
                        <p class="fs-5 mb-1">Êtes-vous sûr de vouloir supprimer les <strong>{{ count($selectedMateriels) }}</strong> matériels réseau sélectionnés ?</p>
                    @else
                        <p class="fs-5 mb-1">Êtes-vous sûr de vouloir supprimer le matériel réseau <strong>{{ $selectedMaterielName }}</strong> ?</p>
                    @endif
                    <p class="text-muted small">Cette action est irréversible et toutes les données associées seront définitivement perdues.</p>
                </div>
                <div class="modal-footer bg-light border-0 justify-content-center p-3">
                    <button type="button" class="btn btn-outline-secondary px-4" wire:click="closeDeleteModal">
                        <i class="bi bi-x-lg me-1"></i> Annuler
                    </button>
                    <button type="button" class="btn btn-danger px-4" wire:click="deleteConfirmed">
                        <i class="bi bi-trash-fill me-1"></i> Confirmer la suppression
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal d'import -->
    @if($showImportModal)
    <div class="modal-backdrop fade show" style="z-index: 1050;"></div>
    <div class="modal fade show d-block" style="z-index: 1060;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-gradient-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-file-import me-2"></i>Importer des Matériels Réseau
                    </h5>
                    <button type="button" wire:click="closeImportModal" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-info border-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Importez vos matériels réseau depuis un fichier CSV ou Excel.
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label fw-semibold">Fichier à importer</label>
                        <input type="file" wire:model="importFile" class="form-control" accept=".csv,.xlsx,.xls">
                        <div class="form-text text-muted">
                            Formats supportés : CSV, Excel (.xlsx, .xls) - Taille max : 10MB
                        </div>
                        @error('importFile') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                    </div>
                    
                    @if($importFile)
                        <div class="alert alert-success border-0 mt-3">
                            <i class="fas fa-check-circle me-2"></i>
                            Fichier sélectionné : <strong>{{ $importFile->getClientOriginalName() }}</strong>
                        </div>
                    @endif

                    @if(!empty($importErrors))
                        <div class="alert alert-danger border-0 mt-3">
                            <h6 class="alert-heading">Erreurs d'import :</h6>
                            <ul class="mb-0">
                                @foreach($importErrors as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($importSuccessCount > 0)
                        <div class="alert alert-success border-0 mt-3">
                            <i class="fas fa-check-circle me-2"></i>
                            <strong>{{ $importSuccessCount }}</strong> matériel(s) importé(s) avec succès.
                        </div>
                    @endif
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" wire:click="closeImportModal" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Annuler
                    </button>
                    <button type="button" wire:click="importMateriels" class="btn btn-primary" {{ !$importFile ? 'disabled' : '' }}>
                        <i class="fas fa-upload me-2"></i>Importer
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de mapping -->
    @if($showMappingModal)
    <div class="modal-backdrop fade show" style="z-index: 1050;"></div>
    <div class="modal fade show d-block" style="z-index: 1060;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-gradient-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-table me-2"></i>Mapping des colonnes
                    </h5>
                    <button type="button" wire:click="closeMappingModal" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-info border-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Associez les colonnes de votre fichier aux champs du système.
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Champ système</th>
                                    <th>Colonne du fichier</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($importMapping as $field => $mappedHeader)
                                <tr>
                                    <td class="fw-bold">{{ $field }}</td>
                                    <td>
                                        <select wire:model="importMapping.{{ $field }}" class="form-select form-select-sm">
                                            <option value="">Non mappé</option>
                                            @foreach($csvHeaders as $header)
                                                <option value="{{ $header }}">{{ $header }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if(!empty($csvData))
                    <div class="mt-4">
                        <h6 class="fw-semibold mb-3">Aperçu des données :</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        @foreach($csvHeaders as $header)
                                        <th class="small">{{ $header }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($csvData as $row)
                                    <tr>
                                        @foreach($csvHeaders as $header)
                                        <td class="small">{{ $row[$header] ?? '' }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" wire:click="closeMappingModal" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Annuler
                    </button>
                    <button type="button" wire:click="processMappedData" class="btn btn-primary">
                        <i class="fas fa-cogs me-2"></i>Traiter les données
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Messages Flash -->
    @if (session()->has('message'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
            <div class="alert alert-success alert-dismissible fade show shadow-lg" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
            <div class="alert alert-danger alert-dismissible fade show shadow-lg" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        .materiel-dashboard {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .stat-icon-lg {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .icon-primary {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }

        .icon-success {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
        }

        .icon-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .icon-info {
            background-color: rgba(13, 202, 240, 0.1);
            color: #0dcaf0;
        }

        .icon-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }

        .stat-number {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .dashboard-card {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .dashboard-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .dashboard-card:nth-child(1):hover { border-left-color: #0d6efd; }
        .dashboard-card:nth-child(2):hover { border-left-color: #198754; }
        .dashboard-card:nth-child(3):hover { border-left-color: #ffc107; }
        .dashboard-card:nth-child(4):hover { border-left-color: #0dcaf0; }
        .dashboard-card:nth-child(5):hover { border-left-color: #dc3545; }
        .dashboard-card:nth-child(6):hover { border-left-color: #198754; }

        .progress {
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        .progress-bar {
            border-radius: 10px;
            transition: width 0.6s ease;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 1.5rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid #dee2e6;
        }
        
        .table-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #495057;
        }
        
        .table-wrapper {
            overflow-x: auto;
        }
        
        .table th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
            padding: 1rem;
            font-size: 0.875rem;
        }
        
        .table td {
            padding: 0.875rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f3f4;
            font-size: 0.875rem;
        }
        
        .sortable {
            cursor: pointer;
            user-select: none;
            transition: background-color 0.2s;
        }
        
        .sortable:hover {
            background-color: rgba(0,0,0,0.03);
        }
        
        .checkbox-modern {
            width: 18px;
            height: 18px;
            cursor: pointer;
            border-radius: 3px;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-action {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .btn-edit {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }
        
        .btn-delete {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }
        
        .btn-action:hover {
            transform: scale(1.1);
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        
        .fade-in-up {
            animation: fadeInUp 0.5s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .statut-en-service:hover {
            background-color: rgba(40, 167, 69, 0.03) !important;
        }
        
        .statut-en-maintenance:hover {
            background-color: rgba(255, 193, 7, 0.03) !important;
        }
        
        .statut-hors-service:hover {
            background-color: rgba(220, 53, 69, 0.03) !important;
        }
        
        .statut-en-stock:hover {
            background-color: rgba(13, 110, 253, 0.03) !important;
        }
        
        .font-mono {
            font-family: 'Courier New', monospace;
            font-size: 0.8rem;
        }
        
        .modal-content {
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        
        .modal-header {
            border-radius: 12px 12px 0 0;
            padding: 1.25rem 1.5rem;
        }
        
        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        }
        
        .bg-gradient-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        }
        
        .bg-gradient-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        }
        
        .info-card {
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f3f4;
        }
        
        .info-card:last-child {
            border-bottom: none;
        }
        
        .form-group {
            margin-bottom: 1.25rem;
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid #d1d5db;
            padding: 0.625rem 0.75rem;
            transition: all 0.2s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
            border-radius: 6px;
            font-weight: 600;
        }
    </style>
@endpush