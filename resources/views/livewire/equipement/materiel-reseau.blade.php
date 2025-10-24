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

    <!-- Modal de formulaire -->
    @if($showForm)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $editMode ? 'Modifier le Matériel' : 'Nouveau Matériel' }}
                    </h5>
                    <button type="button" wire:click="cancelForm" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="saveMateriel">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nom *</label>
                                    <input type="text" wire:model="nom" class="form-control" required>
                                    @error('nom') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Entité</label>
                                    <select wire:model="entite" class="form-select">
                                        <option value="">Sélectionnez une entité</option>
                                        @foreach($entiteOptions as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Statut *</label>
                                    <select wire:model="statut" class="form-select" required>
                                        @foreach($statutOptions as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                    @error('statut') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Fabricant</label>
                                    <select wire:model="fabricant" class="form-select">
                                        <option value="">Sélectionnez un fabricant</option>
                                        @foreach($fabricantOptions as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <select wire:model="type" class="form-select">
                                        <option value="">Sélectionnez un type</option>
                                        @foreach($typeOptions as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Modèle</label>
                                    <input type="text" wire:model="modele" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Numéro de série</label>
                                    <input type="text" wire:model="numero_serie" class="form-control">
                                    @error('numero_serie') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Adresse IP</label>
                                    <input type="text" wire:model="reseau_ip" class="form-control" placeholder="192.168.1.1">
                                    @error('reseau_ip') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Lieu</label>
                                    <input type="text" wire:model="lieu" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" wire:click="cancelForm" class="btn btn-secondary">
                                Annuler
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
    <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5)" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="detailsModalLabel">
                        <i class="fas fa-desktop me-2"></i>Détails du Matériel
                    </h5>
                    <button type="button" class="btn-close btn-close-white" wire:click="closeDetailsModal"></button>
                </div>

                <div class="modal-body">
                    @if($selectedMateriel)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Nom du matériel</h6>
                                    <p class="fw-semibold">{{ $selectedMateriel->nom ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Entité</h6>
                                    <p class="fw-semibold">{{ $selectedMateriel->entite ?? 'Non spécifié' }}</p>
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
                                    <span class="{{ $statusClasses[$selectedMateriel->statut] ?? 'badge bg-secondary' }}">
                                        {{ $selectedMateriel->statut ?? 'Non défini' }}
                                    </span>
                                </div>

                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Fabricant</h6>
                                    <p class="fw-semibold">{{ $selectedMateriel->fabricant ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Type</h6>
                                    <p class="fw-semibold">{{ $selectedMateriel->type ?? 'Non spécifié' }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Modèle</h6>
                                    <p class="fw-semibold">{{ $selectedMateriel->modele ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Numéro de série</h6>
                                    <p class="fw-semibold font-monospace">{{ $selectedMateriel->numero_serie ?? 'Non renseigné' }}</p>
                                </div>

                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Adresse IP</h6>
                                    <p class="fw-semibold font-monospace">{{ $selectedMateriel->reseau_ip ?? 'Non configurée' }}</p>
                                </div>

                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Lieu</h6>
                                    <p class="fw-semibold">{{ $selectedMateriel->lieu ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Date d'ajout</h6>
                                    <p class="fw-semibold">{{ $selectedMateriel->created_at?->format('d/m/Y à H:i') ?? '—' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <h6 class="text-muted mb-1">Dernière mise à jour</h6>
                                    <p class="fw-semibold">{{ $selectedMateriel->updated_at?->format('d/m/Y à H:i') ?? '—' }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3"></i>
                            <p class="text-muted">Impossible de charger les détails du matériel.</p>
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeDetailsModal">Fermer</button>
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
        <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmer la suppression</h5>
                        <button type="button" wire:click="closeDeleteModal" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez-vous vraiment supprimer {{ $deleteId ? 'ce matériel' : 'les matériels sélectionnés' }} ?</p>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="closeDeleteModal" class="btn btn-secondary">Annuler</button>
                        <button wire:click="{{ $deleteId ? 'deleteMateriel' : 'deleteSelected' }}" class="btn btn-danger">Oui, supprimer</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal d'import -->
    @if($showImportModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Importer des Matériels Réseau</h5>
                    <button type="button" wire:click="closeImportModal" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Fichier à importer (CSV, Excel)</label>
                        <input type="file" wire:model="importFile" class="form-control" accept=".csv,.xlsx,.xls">
                        @error('importFile') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    
                    @if($importFile)
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Fichier sélectionné : {{ $importFile->getClientOriginalName() }}
                        </div>
                    @endif

                    @if(!empty($importErrors))
                        <div class="alert alert-danger">
                            <h6>Erreurs d'import :</h6>
                            <ul class="mb-0">
                                @foreach($importErrors as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($importSuccessCount > 0)
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ $importSuccessCount }} matériel(s) importé(s) avec succès.
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeImportModal" class="btn btn-secondary">Annuler</button>
                    <button type="button" wire:click="importMateriels" class="btn btn-primary" 
                            
                        <i class="fas fa-upload me-2"></i>
                        
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de mapping -->
    @if($showMappingModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mapping des colonnes</h5>
                    <button type="button" wire:click="closeMappingModal" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
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
                        <h6>Aperçu des données :</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        @foreach($csvHeaders as $header)
                                        <th>{{ $header }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($csvData as $row)
                                    <tr>
                                        @foreach($csvHeaders as $header)
                                        <td>{{ $row[$header] ?? '' }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeMappingModal" class="btn btn-secondary">Annuler</button>
                    <button type="button" wire:click="processMappedData" class="btn btn-primary">
                        <i class="fas fa-cogs me-2"></i>
                        Traiter les données
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Messages Flash -->
    @if (session()->has('message'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
            border-radius: 10px;
            transition: transform 0.2s;
        }
        
        .stats-widget:hover {
            transform: translateY(-5px);
        }
        
        .stats-number {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 0.2rem;
        }
        
        .stats-label {
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        .avatar-sm {
            width: 50px;
            height: 50px;
        }
        
        .table-container {
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }
        
        .table-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: #495057;
        }
        
        .table-wrapper {
            overflow-x: auto;
        }
        
        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
            padding: 0.75rem;
        }
        
        .table td {
            padding: 0.75rem;
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
        }
        
        .sortable {
            cursor: pointer;
            user-select: none;
        }
        
        .sortable:hover {
            background-color: #e9ecef;
        }
        
        .checkbox-modern {
            width: 18px;
            height: 18px;
            cursor: pointer;
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
            transition: all 0.2s;
        }
        
        .btn-edit {
            background-color: #fff3cd;
            color: #ffc107;
        }
        
        .btn-delete {
            background-color: #f8d7da;
            color: #dc3545;
        }
        
        .btn-action:hover {
            transform: scale(1.1);
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
            background-color: rgba(40, 167, 69, 0.05) !important;
        }
        
        .statut-en-maintenance:hover {
            background-color: rgba(255, 193, 7, 0.05) !important;
        }
        
        .statut-hors-service:hover {
            background-color: rgba(220, 53, 69, 0.05) !important;
        }
        
        .statut-en-stock:hover {
            background-color: rgba(13, 110, 253, 0.05) !important;
        }
        
        .font-mono {
            font-family: 'Courier New', monospace;
        }
    </style>
@endpush