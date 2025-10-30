<div class="materiel-dashboard">
    <div class="dashboard-container">
        <!-- En-tête -->
        <div class="mb-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Gestion des Matériels Réseau</h1>
            <p class="text-gray-600">Inventaire complet des équipements réseau</p>
        </div>

        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-primary">{{ $stats['total'] ?? 0 }}</h3>
                                <p class="stats-label text-black mb-0">Total matériels</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                    <i class="fas fa-network-wired fa-lg"></i>
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
                                <h3 class="stats-number text-success">{{ $stats['en_service'] ?? 0 }}</h3>
                                <p class="stats-label text-black mb-0">En service</p>
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

            <div class="col-xl-3 col-md-6">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-warning">{{ $stats['en_maintenance'] ?? 0 }}</h3>
                                <p class="stats-label text-black mb-0">En maintenance</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-warning bg-opacity-25 text-warning d-flex align-items-center justify-content-center">
                                    <i class="fas fa-tools fa-lg"></i>
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
                                <h3 class="stats-number text-danger">{{ $stats['hors_service'] ?? 0 }}</h3>
                                <p class="stats-label text-black mb-0">Hors service</p>
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
                                   class="form-control" placeholder="Nom, fabricant, modèle, série...">
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Statut</label>
                        <select wire:model.live="statutFilter" class="form-select form-select-sm">
                            <option value="">Tous les statuts</option>
                            @foreach($statutOptions as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Type</label>
                        <select wire:model.live="typeFilter" class="form-select form-select-sm">
                            <option value="">Tous les types</option>
                            @foreach($typeOptions as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Fabricant</label>
                        <select wire:model.live="fabricantFilter" class="form-select form-select-sm">
                            <option value="">Tous les fabricants</option>
                            @foreach($fabricantOptions as $fabricant)
                                <option value="{{ $fabricant }}">{{ $fabricant }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Entité</label>
                        <select wire:model.live="entiteFilter" class="form-select form-select-sm">
                            <option value="">Toutes les entités</option>
                            @foreach($entiteOptions as $entite)
                                <option value="{{ $entite }}">{{ $entite }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-1">
                        <button type="button" wire:click="resetFilters"
                                class="btn btn-outline-secondary btn-sm w-100" title="Réinitialiser les filtres">
                            <i class="fas fa-redo"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Actions groupées -->
                <div class="row mt-3">
                    <div class="col-md-6">
                        <button wire:click="showCreateForm" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Nouveau Matériel
                        </button>
                        <button wire:click="openImportModal" class="btn btn-outline-info btn-sm ms-2">
                            <i class="fas fa-file-import me-1"></i> Importer
                        </button>
                        <button wire:click="exportToCsv" class="btn btn-outline-success btn-sm ms-2">
                            <i class="fas fa-file-export me-1"></i> Exporter
                        </button>
                    </div>
                    <div class="col-md-6 text-end">
                        <button wire:click="confirmDelete" class="btn btn-danger btn-sm" 
                                {{ empty($selectedMateriels) ? 'disabled' : '' }}>
                            <i class="fas fa-trash me-1"></i>
                            Supprimer ({{ count($selectedMateriels) }})
                        </button>
                    </div>
                </div>
            </div>
        </div>

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

    <!-- Modal de formulaire - CENTRÉ ET AMÉLIORÉ -->
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

    <!-- Modal de détails - CENTRÉ ET AMÉLIORÉ -->
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

    <!-- Modal de confirmation de suppression - CENTRÉ ET AMÉLIORÉ -->
    @if($showDeleteModal)
    <div class="modal-backdrop fade show" style="z-index: 1050;"></div>
    <div class="modal fade show d-block" style="z-index: 1060;" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-gradient-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>Confirmation de suppression
                    </h5>
                    <button type="button" wire:click="closeDeleteModal" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body p-4 text-center">
                    <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                    <h6 class="fw-semibold mb-3">
                        Voulez-vous vraiment supprimer {{ $deleteId ? 'ce matériel' : 'les matériels sélectionnés' }} ?
                    </h6>
                    <p class="text-muted">Cette action est irréversible.</p>
                </div>
                <div class="modal-footer bg-light justify-content-center">
                    <button wire:click="closeDeleteModal" class="btn btn-outline-secondary">
                        <i class="fas fa-times me-2"></i>Annuler
                    </button>
                    <button wire:click="{{ $deleteId ? 'deleteMateriel' : 'deleteSelected' }}" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Oui, supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal d'import - CENTRÉ ET AMÉLIORÉ -->
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
                            Formats supportés : CSV, Excel (.xlsx, .xls)
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .materiel-dashboard {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .stats-widget {
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .stats-widget:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .stats-number {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
        }
        
        .stats-label {
            font-size: 0.85rem;
            color: #6c757d;
            font-weight: 500;
        }
        
        .avatar-sm {
            width: 48px;
            height: 48px;
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
        
        /* Styles pour les lignes selon le statut */
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
        
        /* Styles améliorés pour les modales */
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
        
        /* Amélioration de la pagination */
        .pagination {
            margin-bottom: 0;
        }
        
        .page-link {
            border-radius: 6px;
            margin: 0 2px;
            border: 1px solid #dee2e6;
        }
        
        /* Amélioration des badges */
        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
            border-radius: 6px;
            font-weight: 600;
        }
    </style>
@endpush