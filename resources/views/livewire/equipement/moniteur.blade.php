<div class="ticket-dashboard">
    <div class="dashboard-container">
        <!-- En-tête -->
        <div class="mb-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Gestion des Moniteurs</h1>
            <p class="text-gray-600">Inventaire complet des écrans et moniteurs</p>
        </div>

        <!-- Statistiques -->
        <div class="row mb-4">
            @foreach($statsGlobales as $statut => $count)
            <div class="col-xl-3 col-md-6">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-primary">{{ $count }}</h3>
                                <p class="stats-label text-black mb-0">{{ ucfirst($statut) }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                    @switch($statut)
                                        @case('En service')
                                            <i class="fas fa-check-circle fa-lg"></i>
                                            @break
                                        @case('En stock')
                                            <i class="fas fa-warehouse fa-lg"></i>
                                            @break
                                        @case('En réparation')
                                            <i class="fas fa-tools fa-lg"></i>
                                            @break
                                        @case('Hors service')
                                            <i class="fas fa-times-circle fa-lg"></i>
                                            @break
                                        @default
                                            <i class="fas fa-desktop fa-lg"></i>
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Barre de recherche et filtres -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Recherche</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-transparent">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" wire:model.live="search"
                                   class="form-control" placeholder="Nom, n° série, fabricant...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Statut</label>
                        <select wire:model.live="statut" class="form-select form-select-sm">
                            <option value="">Tous les statuts</option>
                            @foreach(['En service', 'En stock', 'Hors service', 'En réparation'] as $statutOption)
                                <option value="{{ $statutOption }}">{{ $statutOption }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Entité</label>
                        <select wire:model.live="entite" class="form-select form-select-sm">
                            <option value="">Toutes les entités</option>
                            @foreach($entitesList as $entiteOption)
                                <option value="{{ $entiteOption }}">{{ $entiteOption }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Fabricant</label>
                        <select wire:model.live="fabricant" class="form-select form-select-sm">
                            <option value="">Tous les fabricants</option>
                            @foreach($fabricantsList as $fabricantOption)
                                <option value="{{ $fabricantOption }}">{{ $fabricantOption }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" wire:click="resetFilters"
                                class="btn btn-outline-secondary btn-sm w-100" title="Réinitialiser les filtres">
                            <i class="fas fa-redo"></i> Réinitialiser
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="openImportModal" class="btn btn-info btn-sm w-100" title="Importer des moniteurs">
                            <i class="fas fa-file-import"></i> Importer
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="exportToCsv" class="btn btn-success btn-sm w-100" title="Exporter les moniteurs">
                            <i class="fas fa-file-export"></i> Exporter
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="create" class="btn btn-primary btn-sm w-100" title="Ajouter un moniteur">
                            <i class="fas fa-plus"></i> Ajouter
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container border-0 fade-in-up">
            <div class="table-header">
                <div class="table-title">
                    Liste des Moniteurs ({{ $moniteurs->total() }})
                </div>
                <div class="d-flex gap-2">
                    @if(!empty($selectedMoniteurs))
                    <button wire:click="deleteSelected" class="btn btn-danger btn-sm" title="Supprimer les moniteurs sélectionnés">
                        <i class="fas fa-trash me-1"></i>
                        Supprimer ({{ count($selectedMoniteurs) }})
                    </button>
                    @endif
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
                        <th>Modèle</th>
                        <th>N° Série</th>
                        <th>Utilisateur</th>
                        <th>Usager</th>
                        <th>Lieu</th>
                        <th>Type</th>
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
                    @forelse($moniteurs as $moniteur)
                        <tr class="statut_{{ str_replace(' ', '_', $moniteur->statut) }}" style="cursor:pointer">
                            <td>
                                <input type="checkbox"
                                       wire:model="selectedMoniteurs"
                                       value="{{ $moniteur->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td wire:click="showDetails({{ $moniteur->id }})">
                                <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                        <p class="text-gray-900 whitespace-no-wrap fw-semibold mb-0">
                                            {{ $moniteur->nom }}
                                        </p>
                                        @if($moniteur->commentaires)
                                            <i class="fas fa-sticky-note text-warning ms-1" title="{{ $moniteur->commentaires }}"></i>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td wire:click="showDetails({{ $moniteur->id }})">{{ $moniteur->entite ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $moniteur->id }})">
                                @php
                                    $statutClasses = [
                                        'En service' => 'bg-green-100 text-green-800',
                                        'En stock' => 'bg-blue-100 text-blue-800',
                                        'Hors service' => 'bg-red-100 text-red-800',
                                        'En réparation' => 'bg-yellow-100 text-yellow-800'
                                    ];
                                    $classe = $statutClasses[$moniteur->statut] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="status-badge {{ $classe }}">
                                    {{ $moniteur->statut }}
                                </span>
                            </td>
                            <td wire:click="showDetails({{ $moniteur->id }})">{{ $moniteur->fabricant ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $moniteur->id }})">{{ $moniteur->modele ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $moniteur->id }})" class="font-mono">
                                {{ $moniteur->numero_serie ?? 'N/A' }}
                            </td>
                            <td wire:click="showDetails({{ $moniteur->id }})">
                                @if($moniteur->utilisateur)
                                    <span class="user-badge">{{ $moniteur->utilisateur->name }}</span>
                                @else
                                    <span class="text-muted small">Non attribué</span>
                                @endif
                            </td>
                            <td wire:click="showDetails({{ $moniteur->id }})">
                                @if($moniteur->usager)
                                    <span class="usager-badge">{{ $moniteur->usager->name }}</span>
                                @else
                                    <span class="text-muted small">N/A</span>
                                @endif
                            </td>
                            <td wire:click="showDetails({{ $moniteur->id }})">{{ $moniteur->lieu ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $moniteur->id }})">
                                @if($moniteur->type)
                                    <span class="type-badge">{{ $moniteur->type }}</span>
                                @else
                                    <span class="text-muted small">N/A</span>
                                @endif
                            </td>
                            <td wire:click="showDetails({{ $moniteur->id }})">
                                {{ $moniteur->updated_at->format('d/m/Y H:i') }}
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <!-- Bouton View -->
                                    <button wire:click="showDetails({{ $moniteur->id }})"
                                            class="btn-action btn-view"
                                            title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    
                                    <!-- Bouton Edit -->
                                    <button wire:click="edit({{ $moniteur->id }})"
                                            class="btn-action btn-edit"
                                            title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <!-- Bouton Delete -->
                                    <button wire:click="confirmDelete({{ $moniteur->id }})"
                                            class="btn-action btn-delete"
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <!-- Bouton Fichiers -->
                                    <button wire:click="openFileModal({{ $moniteur->id }})"
                                            class="btn-action btn-info"
                                            title="Gérer les fichiers">
                                        <i class="fas fa-paperclip"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="14" class="text-center py-4">
                                <i class="fas fa-desktop fa-2x text-muted mb-2"></i>
                                <p class="text-muted">Aucun moniteur trouvé</p>
                                @if($search || $statut || $entite || $fabricant)
                                    <button wire:click="resetFilters" class="btn btn-outline-primary btn-sm mt-2">
                                        <i class="fas fa-refresh me-1"></i>
                                        Réinitialiser les filtres
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $moniteurs->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Formulaire -->
    @if($showModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1050;" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas {{ $isEditing ? 'fa-edit' : 'fa-plus' }} me-2"></i>
                        {{ $isEditing ? 'Modifier le Moniteur' : 'Nouveau Moniteur' }}
                    </h5>
                    <button type="button" wire:click="closeModal" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nom *</label>
                                    <input type="text" wire:model="nom" class="form-control" required>
                                    @error('nom') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Entité</label>
                                    <input type="text" wire:model="entite_form" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Statut *</label>
                                    <select wire:model="statut_form" class="form-select" required>
                                        @foreach($statuts as $statut)
                                            <option value="{{ $statut }}">{{ $statut }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Fabricant</label>
                                    <input type="text" wire:model="fabricant_form" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Numéro de série</label>
                                    <input type="text" wire:model="numero_serie" class="form-control">
                                    @error('numero_serie') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Utilisateur</label>
                                    <select wire:model="utilisateur_id" class="form-select">
                                        <option value="">Sélectionner un utilisateur</option>
                                        @foreach($utilisateurs as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Usager</label>
                                    <select wire:model="usager_id" class="form-select">
                                        <option value="">Sélectionner un usager</option>
                                        @foreach($utilisateurs as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Lieu</label>
                                    <input type="text" wire:model="lieu" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <select wire:model="type" class="form-select">
                                        <option value="">Sélectionner un type</option>
                                        @foreach($types as $typeItem)
                                            <option value="{{ $typeItem }}">{{ $typeItem }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Modèle</label>
                                    <input type="text" wire:model="modele" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Commentaires</label>
                                    <textarea wire:model="commentaires" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" wire:click="closeModal" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>
                                Annuler
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                {{ $isEditing ? 'Mettre à jour' : 'Créer' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal Import -->
    @if($showImportModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1060;" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-file-import me-2"></i>
                        Importer des Moniteurs
                    </h5>
                    <button type="button" wire:click="closeImportModal" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Sélectionnez un fichier CSV à importer. Le fichier sera stocké temporairement pour le mapping.
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Fichier CSV</label>
                        <input type="file" wire:model="importFile" class="form-control" accept=".csv,.txt">
                        @error('importFile') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-3">
                        <button type="button" wire:click="downloadImportTemplate" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-download me-1"></i>
                            Télécharger le template
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeImportModal" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>
                        Annuler
                    </button>
                    <button type="button" wire:click="storeImportFile" class="btn btn-info" {{ !$importFile ? 'disabled' : '' }}>
                        <i class="fas fa-arrow-right me-1"></i>
                        Suivant (Mapping)
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal Mapping -->
    @if($showMappingModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1070;" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">
                        <i class="fas fa-map me-2"></i>
                        Mapping des Colonnes
                    </h5>
                    <button type="button" wire:click="cancelImport" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Associez chaque colonne de votre fichier aux champs de la base de données.
                    </div>

                    <!-- Aperçu des données -->
                    @if(count($csvPreview) > 0)
                    <div class="mb-4">
                        <h6>Aperçu des données (5 premières lignes):</h6>
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
                                    @foreach($csvPreview as $row)
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

                    <!-- Formulaire de mapping -->
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Mapping des champs:</h6>
                            @foreach($fieldMapping as $field => $value)
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-capitalize">
                                    {{ str_replace('_', ' ', $field) }}
                                    @if($field === 'nom') <span class="text-danger">*</span> @endif
                                </label>
                                <select wire:model="fieldMapping.{{ $field }}" class="form-select form-select-sm">
                                    <option value="">-- Non mappé --</option>
                                    @foreach($csvHeaders as $header)
                                    <option value="{{ $header }}">{{ $header }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="col-md-6">
                            <h6>Instructions:</h6>
                            <div class="card bg-light">
                                <div class="card-body small">
                                    <p><strong>Champs obligatoires:</strong></p>
                                    <ul>
                                        <li><strong>Nom:</strong> Identifiant unique du moniteur</li>
                                    </ul>
                                    <p><strong>Champs optionnels:</strong></p>
                                    <ul>
                                        <li><strong>Entité:</strong> Service/département</li>
                                        <li><strong>Statut:</strong> En service, En stock, Hors service, En réparation</li>
                                        <li><strong>Fabricant:</strong> Marque du moniteur</li>
                                        <li><strong>Numéro de série:</strong> Identifiant unique matériel</li>
                                        <li><strong>Lieu:</strong> Emplacement physique</li>
                                        <li><strong>Type:</strong> LCD, LED, 4K, etc.</li>
                                        <li><strong>Modèle:</strong> Référence modèle</li>
                                        <li><strong>Commentaires:</strong> Notes supplémentaires</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="cancelImport" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>
                        Annuler
                    </button>
                    <button type="button" wire:click="processMappedData" class="btn btn-warning">
                        <i class="fas fa-cog me-1"></i>
                        Traiter les données
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal Aperçu des données importées -->
    @if($showImportedData)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1080;" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-check-circle me-2"></i>
                        Aperçu des Données Importées
                    </h5>
                    <button type="button" wire:click="cancelImport" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success">
                        <i class="fas fa-info-circle me-2"></i>
                        {{ $importSuccessCount }} enregistrement(s) prêt(s) à être importés.
                        @if(count($importErrors) > 0)
                        <br><strong>{{ count($importErrors) }} erreur(s) détectée(s):</strong>
                        @endif
                    </div>

                    @if(count($importErrors) > 0)
                    <div class="alert alert-danger">
                        <h6>Erreurs d'importation:</h6>
                        <ul class="small mb-0">
                            @foreach($importErrors as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Aperçu des données mappées -->
                    @if(count($importedData) > 0)
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Entité</th>
                                    <th>Statut</th>
                                    <th>Fabricant</th>
                                    <th>N° Série</th>
                                    <th>Lieu</th>
                                    <th>Type</th>
                                    <th>Modèle</th>
                                    <th>Commentaires</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($importedData as $data)
                                <tr>
                                    <td>{{ $data['nom'] }}</td>
                                    <td>{{ $data['entite'] ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $statutColors = [
                                                'En service' => 'bg-success',
                                                'En stock' => 'bg-primary',
                                                'Hors service' => 'bg-danger',
                                                'En réparation' => 'bg-warning'
                                            ];
                                            $badgeColor = $statutColors[$data['statut'] ?? 'En stock'] ?? 'bg-secondary';
                                        @endphp
                                        <span class="badge {{ $badgeColor }}">
                                            {{ $data['statut'] ?? 'En stock' }}
                                        </span>
                                    </td>
                                    <td>{{ $data['fabricant'] ?? 'N/A' }}</td>
                                    <td class="font-mono">{{ $data['numero_serie'] ?? 'N/A' }}</td>
                                    <td>{{ $data['lieu'] ?? 'N/A' }}</td>
                                    <td>{{ $data['type'] ?? 'N/A' }}</td>
                                    <td>{{ $data['modele'] ?? 'N/A' }}</td>
                                    <td>{{ $data['commentaires'] ?? '' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="cancelImport" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>
                        Annuler
                    </button>
                    <button type="button" wire:click="saveImportedData" class="btn btn-success" {{ count($importedData) === 0 ? 'disabled' : '' }}>
                        <i class="fas fa-save me-1"></i>
                        Sauvegarder ({{ count($importedData) }})
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal Gestion des Fichiers -->
    @if($showFileModal && $selectedMoniteurForFiles)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1090;" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-paperclip me-2"></i>
                        Fichiers attachés - {{ $selectedMoniteurForFiles->nom }}
                    </h5>
                    <button type="button" wire:click="closeFileModal" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <!-- Upload de fichiers -->
                    <div class="mb-4">
                        <label class="form-label">Ajouter des fichiers</label>
                        <input type="file" wire:model="uploadedFiles" multiple class="form-control">
                        <div class="form-text">Formats supportés: JPG, PNG, PDF, DOC, XLS, TXT (max 10MB)</div>
                        @error('uploadedFiles.*') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    <!-- Liste des fichiers -->
                    <h6 class="text-muted border-bottom pb-2 mb-3">Fichiers attachés</h6>
                    @if(count($attachedFiles) > 0)
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Taille</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attachedFiles as $file)
                                    <tr>
                                        <td>{{ $file['name'] }}</td>
                                        <td>{{ $file['size'] }}</td>
                                        <td>{{ $file['date'] }}</td>
                                        <td>
                                            <button wire:click="downloadFile('{{ $file['path'] }}')" 
                                                    class="btn btn-sm btn-outline-primary" title="Télécharger">
                                                <i class="fas fa-download"></i>
                                            </button>
                                            <button wire:click="deleteFile('{{ $file['path'] }}')" 
                                                    class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center py-3">Aucun fichier attaché</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeFileModal" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>
                        Fermer
                    </button>
                    @if(count($uploadedFiles) > 0)
                    <button type="button" wire:click="uploadFiles" class="btn btn-primary">
                        <i class="fas fa-upload me-1"></i>
                        Uploader les fichiers
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Confirmation Modal -->
    @if($confirmingDelete)
        <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1100;" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">Confirmer la suppression</h5>
                        <button type="button" wire:click="$set('confirmingDelete', false)" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Êtes-vous sûr de vouloir supprimer ce moniteur ?</p>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="$set('confirmingDelete', false)" class="btn btn-secondary">Annuler</button>
                        <button wire:click="deleteConfirmed" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Flash Messages -->
    @if (session()->has('success'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1110">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1110">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    @if (session()->has('warning'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1110">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        // Gestion des notifications avec Toastr
        window.addEventListener('notify', event => {
            if (typeof toastr !== 'undefined') {
                toastr[event.detail.type](event.detail.message);
            } else {
                // Fallback si Toastr n'est pas disponible
                console.log(`${event.detail.type}: ${event.detail.message}`);
            }
        });

        // Gestion de la confirmation de suppression avec SweetAlert2
        window.addEventListener('swal:confirm', event => {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimer!',
                    cancelButtonText: 'Annuler',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Appel de la méthode delete dans le composant Livewire
                        Livewire.emit('deleteConfirmed', event.detail.id);
                    }
                });
            } else {
                // Fallback si SweetAlert2 n'est pas disponible
                if (confirm(`${event.detail.title}\n${event.detail.text}`)) {
                    Livewire.emit('deleteConfirmed', event.detail.id);
                }
            }
        });

        // Fermer le modal avec la touche Echap
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                Livewire.emit('closeModal');
            }
        });

        // Fermer le modal en cliquant à l'extérieur
        document.addEventListener('click', function(event) {
            const modal = document.querySelector('.modal.show');
            if (modal && event.target === modal) {
                Livewire.emit('closeModal');
            }
        });
    </script>
@endpush

<style>
    /* Animation pour le modal */
    .modal.show {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Style pour les boutons de confirmation */
    .swal2-confirm {
        margin-right: 10px;
    }

    .swal2-cancel {
        margin-left: 10px;
    }

    /* Responsive pour le modal */
    @media (max-width: 768px) {
        .modal-dialog {
            margin: 20px;
        }
    }

    /* Styles pour les badges de statut */
    .status-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Styles pour les boutons d'action */
    .btn-action {
        border: none;
        background: none;
        padding: 0.25rem 0.5rem;
        margin: 0 0.125rem;
        border-radius: 0.25rem;
        transition: all 0.2s;
    }

    .btn-action:hover {
        transform: scale(1.1);
    }

    .btn-view { color: #6c757d; }
    .btn-edit { color: #198754; }
    .btn-delete { color: #dc3545; }
    .btn-info { color: #0dcaf0; }

    /* Styles pour la table */
    .sortable {
        cursor: pointer;
        user-select: none;
    }

    .sortable:hover {
        background-color: #f8f9fa;
    }

    .checkbox-modern {
        width: 1.125rem;
        height: 1.125rem;
        cursor: pointer;
    }
</style>