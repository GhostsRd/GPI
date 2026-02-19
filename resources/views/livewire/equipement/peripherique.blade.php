<div class="peripherique-dashboard">
    <div class="dashboard-container">
        <!-- En-tête -->
        <div class="mb-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Gestion des Périphériques</h1>
            <p class="text-gray-600 small">Inventaire complet des équipements périphériques</p>
        </div>

        <!-- Cartes de statistiques -->
        <div class="row mb-4">
            <!-- Total Périphériques -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100 icon-primary">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-primary mb-1 small">{{ $stats['total'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Total Périphériques</p>
                            <div class="progress mt-2" style="height: 3px;">
                                <div class="progress-bar bg-primary" style="width: 100%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-sm ms-2">
                            <i class="fas fa-desktop fa-fw"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En service -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100 icon-success">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-success mb-1 small">{{ $stats['en_service'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">En Service</p>
                            <div class="progress mt-2" style="height: 3px;">
                                <div class="progress-bar bg-success" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['en_service'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-sm ms-2">
                            <i class="fas fa-check-circle fa-fw"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En stock -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100 icon-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-info mb-1 small">{{ $stats['en_stock'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">En Stock</p>
                            <div class="progress mt-2" style="height: 3px;">
                                <div class="progress-bar bg-info" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['en_stock'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-sm ms-2">
                            <i class="fas fa-box fa-fw"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hors service -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100 icon-danger">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-danger mb-1 small">{{ $stats['hors_service'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">Hors Service</p>
                            <div class="progress mt-2" style="height: 3px;">
                                <div class="progress-bar bg-danger" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['hors_service'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-sm ms-2">
                            <i class="fas fa-times-circle fa-fw"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- En réparation -->
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100 icon-warning">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number text-warning mb-1 small">{{ $stats['en_reparation'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0 fw-medium">En Réparation</p>
                            <div class="progress mt-2" style="height: 3px;">
                                <div class="progress-bar bg-warning" 
                                     style="width: {{ $stats['total'] > 0 ? ($stats['en_reparation'] / $stats['total'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-sm ms-2">
                            <i class="fas fa-tools fa-fw"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Taux de disponibilité -->
            @php
                $disponible = ($stats['en_service'] ?? 0) + ($stats['en_stock'] ?? 0);
                $total = $stats['total'] ?? 1;
                $taux = $total > 0 ? round(($disponible / $total) * 100) : 0;
                $tauxClass = $taux >= 80 ? 'success' : ($taux >= 60 ? 'warning' : 'danger');
            @endphp
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card h-100 icon-{{ $tauxClass }}">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="stat-number mb-1 text-{{ $tauxClass }} small">
                                {{ $taux }}%
                            </h3>
                            <p class="text-muted small mb-0 fw-medium">Disponibilité</p>
                            <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar bg-{{ $tauxClass }}" 
                                     style="width: {{ $taux }}%"></div>
                            </div>
                        </div>
                        <div class="stat-icon-sm ms-2">
                            <i class="fas fa-chart-line fa-fw"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-2">
        <div class="d-flex flex-wrap gap-2 align-items-center">
            <!-- Recherche -->
            <div class="flex-grow-1" style="min-width: 200px; max-width: 300px;">
                <div class="input-group input-group-sm">
                    <span class="input-group-text bg-transparent border-end-0 py-1">
                        <i class="fas fa-search text-muted small"></i>
                    </span>
                    <input type="text" wire:model.live="search"
                           class="form-control form-control-sm border-start-0 py-1" 
                           placeholder="Rechercher...">
                </div>
            </div>

            <!-- Filtres -->
            <select wire:model.live="filterStatut" class="form-select form-select-sm" style="width: 140px;" title="Statut">
                <option value="">📊 Statut</option>
                @foreach($statuts as $statut)
                    <option value="{{ $statut }}">{{ $statut }}</option>
                @endforeach
            </select>

            <select wire:model.live="filterType" class="form-select form-select-sm" style="width: 140px;" title="Type">
                <option value="">🖥️ Type</option>
                @foreach($types as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>

            <select wire:model.live="filterFabricant" class="form-select form-select-sm" style="width: 140px;" title="Fabricant">
                <option value="">🏭 Fabricant</option>
                @foreach($fabricants as $fabricant)
                    <option value="{{ $fabricant }}">{{ $fabricant }}</option>
                @endforeach
            </select>

            <!-- Actions -->
            <div class="d-flex gap-1">
                <button type="button" wire:click="resetFilters"
                        class="btn btn-outline-secondary btn-sm" title="Réinitialiser">
                    <i class="fas fa-times "></i>
                </button>

                <button wire:click="openImportModal" class="btn btn-outline-info btn-sm" title="Importer">
                    <i class="fas fa-file-import "></i>
                </button>

                <button wire:click="exportToCsv" class="btn btn-outline-success btn-sm" title="Exporter">
                    <i class="fas fa-file-export "></i>
                </button>

                <button wire:click="confirmBulkDelete" class="btn btn-outline-danger btn-sm" title="Supprimer sélection"
                    {{ empty($selectedPeripheriques) ? 'disabled' : '' }}>
                    <i class="fas fa-trash "></i>
                    <span class="small ms-1">{{ count($selectedPeripheriques) }}</span>
                </button>
            </div>
        </div>
    </div>
</div>

        <!-- Tableau des périphériques -->
        <div class="dashboard-card p-3">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <h5 class="fw-semibold mb-0 small">Liste des Périphériques ({{ $peripheriques->total() }})</h5>
                <button wire:click="showForm" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1 small"></i>
                    <span class="small">Nouveau</span>
                </button>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th class="small">
                                <input type="checkbox" wire:model="selectAll" class="form-check-input">
                            </th>
                            <th wire:click="sortBy('nom')" style="cursor: pointer;" class="small">
                                Nom
                                @if($sortField === 'nom')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort text-muted small"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('type')" style="cursor: pointer;" class="small">
                                Type
                                @if($sortField === 'type')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort text-muted small"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('statut')" style="cursor: pointer;" class="small">
                                Statut
                                @if($sortField === 'statut')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort text-muted small"></i>
                                @endif
                            </th>
                            <th class="small">Fabricant</th>
                            <th class="small">Modèle</th>
                            <th class="small">Entité</th>
                            <th class="small">Usager</th>
                            <th class="small">Lieu</th>
                            <th wire:click="sortBy('updated_at')" style="cursor: pointer;" class="small">
                                Dernière modif.
                                @if($sortField === 'updated_at')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort text-muted small"></i>
                                @endif
                            </th>
                            <th class="small">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($peripheriques as $peripherique)
                        <tr class="statut_{{ str_replace(' ', '_', $peripherique->statut) }}">
                            <td class="small">
                                <input type="checkbox"
                                       wire:model="selectedPeripheriques"
                                       value="{{ $peripherique->id }}"
                                       class="form-check-input">
                            </td>
                            <td class="fw-medium small">{{ $peripherique->nom }}</td>
                            <td class="small">
                                <span class="badge bg-light text-dark border small">
                                    {{ $peripherique->type }}
                                </span>
                            </td>
                            <td class="small">
                                @php
                                    $statusClasses = [
                                        'En service' => 'badge bg-success badge-sm',
                                        'En stock' => 'badge bg-info badge-sm',
                                        'En réparation' => 'badge bg-warning badge-sm',
                                        'Hors service' => 'badge bg-danger badge-sm'
                                    ];
                                @endphp
                                <span class="{{ $statusClasses[$peripherique->statut] ?? 'badge bg-secondary badge-sm' }}">
                                    {{ $peripherique->statut }}
                                </span>
                            </td>
                            <td class="small">{{ $peripherique->fabricant ?? 'N/A' }}</td>
                            <td class="small">{{ $peripherique->modele ?? 'N/A' }}</td>
                            <td class="small">{{ $peripherique->entite ?? '-' }}</td>
                            <td class="small">{{ $peripherique->usager ?? '-' }}</td>
                            <td class="small">{{ $peripherique->lieu ?? 'N/A' }}</td>
                            <td class="small">{{ $peripherique->updated_at->format('d/m/Y H:i') }}</td>
                            <td class="small">
                                <div class="d-flex gap-1">
                                    <!-- Bouton Voir Détails -->
                                    <button wire:click="showDetails({{ $peripherique->id }})"
                                            class="btn btn-sm btn-outline-info border-0"
                                            title="Voir détails">
                                        <i class="fas fa-eye small"></i>
                                    </button>
                                    <!-- Boutons Sortie/Retour selon le statut -->
                                    @if($peripherique->statut === 'En stock')
                                        <button wire:click="quickSortie({{ $peripherique->id }})"
                                                class="btn btn-sm btn-outline-success border-0"
                                                title="Sortir le périphérique">
                                            <i class="fas fa-sign-out-alt small"></i>
                                        </button>
                                    @endif
                                    
                                    @if($peripherique->statut === 'En service')
                                        <button wire:click="quickRetour({{ $peripherique->id }})"
                                                class="btn btn-sm btn-outline-warning border-0"
                                                title="Retourner le périphérique">
                                            <i class="fas fa-sign-in-alt small"></i>
                                        </button>
                                    @endif
                                    <!-- Bouton Modifier -->
                                    <button wire:click="edit({{ $peripherique->id }})"
                                            class="btn btn-sm btn-outline-primary border-0"
                                            title="Modifier">
                                        <i class="fas fa-edit small"></i>
                                    </button>
                                    <!-- Bouton Supprimer -->
                                    <button wire:click="confirmDelete({{ $peripherique->id }})"
                                            class="btn btn-sm btn-outline-danger border-0"
                                            title="Supprimer">
                                        <i class="fas fa-trash small"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-3">
                                <i class="fas fa-desktop text-muted d-block mb-2 small"></i>
                                <p class="text-muted mb-0 small">Aucun périphérique trouvé</p>
                                @if($search || $filterStatut || $filterType || $filterFabricant)
                                    <button wire:click="resetFilters" class="btn btn-outline-primary btn-sm mt-2">
                                        <i class="fas fa-refresh me-1 small"></i>
                                        <span class="small">Réinitialiser</span>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted small">
                    @if($peripheriques->count() > 0)
                        Affichage de {{ $peripheriques->firstItem() }} à {{ $peripheriques->lastItem() }} sur {{ $peripheriques->total() }} périphériques
                    @else
                        Aucun périphérique
                    @endif
                </div>
                <div class="small">
                    {{ $peripheriques->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import -->
@if($showImportModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-file-import me-2"></i>
                        Importer des périphériques
                    </h5>
                    <button type="button" wire:click="closeImportModal" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Sélectionnez un fichier CSV contenant les données des périphériques.
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Fichier CSV</label>
                        <input type="file" class="form-control" wire:model="importFile" accept=".csv,.txt">
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
                    <button type="button" wire:click="storeImportFile" class="btn btn-primary" 
                            {{ !$importFile ? 'disabled' : '' }}>
                        <i class="fas fa-arrow-right me-1"></i>
                        Suivant
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Modal Mapping -->
@if($showMappingModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-table me-2"></i>
                        Mapping des colonnes
                    </h5>
                    <button type="button" wire:click="cancelImport" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Associez les colonnes de votre fichier CSV aux champs de l'application.
                    </div>

                    <!-- Aperçu des données -->
                    @if(count($csvPreview) > 0)
                        <div class="mb-4">
                            <h6>Aperçu des données (5 premières lignes) :</h6>
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
                            <div class="mb-3">
                                <label class="form-label">Nom *</label>
                                <select class="form-select" wire:model="fieldMapping.nom">
                                    <option value="">Sélectionnez la colonne</option>
                                    @foreach($csvHeaders as $header)
                                        <option value="{{ $header }}">{{ $header }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Entité</label>
                                <select class="form-select" wire:model="fieldMapping.entite">
                                    <option value="">Sélectionnez la colonne</option>
                                    @foreach($csvHeaders as $header)
                                        <option value="{{ $header }}">{{ $header }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Statut</label>
                                <select class="form-select" wire:model="fieldMapping.statut">
                                    <option value="">Sélectionnez la colonne</option>
                                    @foreach($csvHeaders as $header)
                                        <option value="{{ $header }}">{{ $header }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Fabricant</label>
                                <select class="form-select" wire:model="fieldMapping.fabricant">
                                    <option value="">Sélectionnez la colonne</option>
                                    @foreach($csvHeaders as $header)
                                        <option value="{{ $header }}">{{ $header }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Type *</label>
                                <select class="form-select" wire:model="fieldMapping.type">
                                    <option value="">Sélectionnez la colonne</option>
                                    @foreach($csvHeaders as $header)
                                        <option value="{{ $header }}">{{ $header }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Lieu</label>
                                <select class="form-select" wire:model="fieldMapping.lieu">
                                    <option value="">Sélectionnez la colonne</option>
                                    @foreach($csvHeaders as $header)
                                        <option value="{{ $header }}">{{ $header }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Modèle</label>
                                <select class="form-select" wire:model="fieldMapping.modele">
                                    <option value="">Sélectionnez la colonne</option>
                                    @foreach($csvHeaders as $header)
                                        <option value="{{ $header }}">{{ $header }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Usager</label>
                                <select class="form-select" wire:model="fieldMapping.usager">
                                    <option value="">Sélectionnez la colonne</option>
                                    @foreach($csvHeaders as $header)
                                        <option value="{{ $header }}">{{ $header }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="cancelImport" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>
                        Annuler
                    </button>
                    <button type="button" wire:click="processMappedData" class="btn btn-primary">
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
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-eye me-2"></i>
                        Aperçu des données à importer
                    </h5>
                    <button type="button" wire:click="cancelImport" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    @if($importSuccessCount > 0)
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ $importSuccessCount }} ligne(s) prête(s) à être importée(s).
                        </div>

                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Type</th>
                                        <th>Statut</th>
                                        <th>Fabricant</th>
                                        <th>Lieu</th>
                                        <th>Modèle</th>
                                        <th>Usager</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($importedData as $data)
                                        <tr>
                                            <td>{{ $data['nom'] }}</td>
                                            <td>{{ $data['type'] }}</td>
                                            <td>{{ $data['statut'] }}</td>
                                            <td>{{ $data['fabricant'] }}</td>
                                            <td>{{ $data['lieu'] }}</td>
                                            <td>{{ $data['modele'] }}</td>
                                            <td>{{ $data['usager'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if(count($importErrors) > 0)
                        <div class="alert alert-danger mt-3">
                            <h6><i class="fas fa-exclamation-triangle me-2"></i>Erreurs détectées :</h6>
                            <ul class="mb-0">
                                @foreach($importErrors as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="cancelImport" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>
                        Annuler
                    </button>
                    @if($importSuccessCount > 0)
                        <button type="button" wire:click="saveImportedData" class="btn btn-success">
                            <i class="fas fa-save me-1"></i>
                            Importer {{ $importSuccessCount }} élément(s)
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Modal Formulaire -->
@if($showForm)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas {{ $editingId ? 'fa-edit' : 'fa-plus' }} me-2"></i>
                        {{ $editingId ? 'Modifier le Périphérique' : 'Nouveau Périphérique' }}
                    </h5>
                    <button type="button" wire:click="$set('showForm', false)" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save" style="max-height:400px;overflow-y: scroll;  -ms-overflow-style: none;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nom *</label>
                                    <input type="text" class="form-control" wire:model="nom" required
                                           placeholder="Entrez le nom du périphérique">
                                    @error('nom') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Type *</label>
                                    <select class="form-control" wire:model="type" required>
                                        <option value="">Sélectionnez un type</option>
                                        @foreach($types as $typeOption)
                                            <option value="{{ $typeOption }}">{{ $typeOption }}</option>
                                        @endforeach
                                    </select>
                                    @error('type') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Statut *</label>
                                    <select class="form-control" wire:model="statut" required>
                                        <option value="">Sélectionnez un statut</option>
                                        @foreach($statuts as $statutOption)
                                            <option value="{{ $statutOption }}">{{ $statutOption }}</option>
                                        @endforeach
                                    </select>
                                    @error('statut') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Fabricant</label>
                                    <input type="text" class="form-control" wire:model="fabricant"
                                           placeholder="Entrez le fabricant">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Modèle</label>
                                    <input type="text" class="form-control" wire:model="modele"
                                           placeholder="Entrez le modèle">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Entité</label>
                                    <input type="text" class="form-control" wire:model="entite"
                                           placeholder="Entrez l'entité">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Lieu</label>
                                    <input type="text" class="form-control" wire:model="lieu"
                                           placeholder="Entrez le lieu">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Usager</label>
                                    <input type="text" class="form-control" wire:model="usager"
                                           placeholder="Entrez l'usager">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" wire:click="$set('showForm', false)" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i>
                                Annuler
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                {{ $editingId ? 'Modifier' : 'Créer' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Confirmation Modal -->
@if($confirmingDelete)
<div class="modal fade show" 
     style="display: block; background: rgba(0,0,0,0.5);"
     tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-exclamation-triangle me-2"></i> Confirmation de suppression
                </h5>
                <button type="button" class="btn-close btn-close-white" wire:click="$set('confirmingDelete', false)"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-trash3 text-danger" style="font-size: 3rem;"></i>
                </div>
                @if($isBulkDelete)
                    <p class="fs-5 mb-1">Êtes-vous sûr de vouloir supprimer les <strong>{{ count($selectedPeripheriques) }}</strong> périphériques sélectionnés ?</p>
                @else
                    <p class="fs-5 mb-1">Êtes-vous sûr de vouloir supprimer le périphérique <strong>{{ $peripheriqueName }}</strong> ?</p>
                @endif
                <p class="text-muted small">Cette action est irréversible et toutes les données associées seront définitivement perdues.</p>
            </div>
            <div class="modal-footer bg-light border-0 justify-content-center p-3">
                <button type="button" class="btn btn-outline-secondary px-4" wire:click="$set('confirmingDelete', false)">
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

<!-- Modal Détails du Périphérique -->
@if($showDetailsModal && $selectedPeripherique)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Détails du Périphérique
                    </h5>
                    <button type="button" wire:click="closeDetailsModal" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Informations générales</h6>
                            <p><strong>Nom:</strong> {{ $selectedPeripherique->nom }}</p>
                            <p><strong>Type:</strong> {{ $selectedPeripherique->type }}</p>
                            <p><strong>Statut:</strong> 
                                @php
                                    $statusClasses = [
                                        'En service' => 'badge bg-success',
                                        'En stock' => 'badge bg-info',
                                        'En réparation' => 'badge bg-warning',
                                        'Hors service' => 'badge bg-danger'
                                    ];
                                @endphp
                                <span class="{{ $statusClasses[$selectedPeripherique->statut] ?? 'badge bg-secondary' }}">
                                    {{ $selectedPeripherique->statut }}
                                </span>
                            </p>
                            <p><strong>Fabricant:</strong> {{ $selectedPeripherique->fabricant ?? 'N/A' }}</p>
                            <p><strong>Modèle:</strong> {{ $selectedPeripherique->modele ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6>Localisation</h6>
                            <p><strong>Entité:</strong> {{ $selectedPeripherique->entite ?? 'N/A' }}</p>
                            <p><strong>Lieu:</strong> {{ $selectedPeripherique->lieu ?? 'N/A' }}</p>
                            <p><strong>Usager:</strong> {{ $selectedPeripherique->usager ?? 'N/A' }}</p>
                            <p><strong>Date création:</strong> {{ $selectedPeripherique->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Dernière modification:</strong> {{ $selectedPeripherique->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeDetailsModal" class="btn btn-secondary">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Modal Sortie de Périphérique -->
@if($showSortieModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        Sortie de Périphérique
                    </h5>
                    <button type="button" wire:click="$set('showSortieModal', false)" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="enregistrerSortie">
                        <div class="mb-3">
                            <label class="form-label">Périphérique *</label>
                            <select class="form-select form-select-sm" wire:model="sortiePeripheriqueId" required>
                                <option value="">Sélectionnez un périphérique</option>
                                @foreach($this->peripheriquesEnStock as $peripherique)
                                    <option value="{{ $peripherique->id }}">{{ $peripherique->nom }} ({{ $peripherique->type }})</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Usager *</label>
                            <input type="text" class="form-control form-control-sm" wire:model="sortieUsager" required
                                   placeholder="Nom de l'usager">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Entité/Service *</label>
                            <input type="text" class="form-control form-control-sm" wire:model="sortieEntite" required
                                   placeholder="Entité ou service">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Lieu d'utilisation *</label>
                            <input type="text" class="form-control form-control-sm" wire:model="sortieLieu" required
                                   placeholder="Lieu d'utilisation">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Date de sortie *</label>
                            <input type="datetime-local" class="form-control form-control-sm" wire:model="sortieDate" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Commentaire</label>
                            <textarea class="form-control form-control-sm" wire:model="sortieCommentaire" 
                                      placeholder="Commentaire optionnel" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="$set('showSortieModal', false)" class="btn btn-secondary btn-sm">
                        <i class="fas fa-times me-1"></i>
                        Annuler
                    </button>
                    <button type="button" wire:click="enregistrerSortie" class="btn btn-primary btn-sm">
                        <i class="fas fa-check me-1"></i>
                        Enregistrer la sortie
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Modal Retour de Périphérique -->
@if($showRetourModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Retour de Périphérique
                    </h5>
                    <button type="button" wire:click="$set('showRetourModal', false)" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="enregistrerRetour">
                        <div class="mb-3">
                            <label class="form-label">Périphérique *</label>
                            <select class="form-select form-select-sm" wire:model="retourPeripheriqueId" required>
                                <option value="">Sélectionnez un périphérique</option>
                                @foreach($this->peripheriquesEnService as $peripherique)
                                    <option value="{{ $peripherique->id }}">{{ $peripherique->nom }} ({{ $peripherique->type }}) - {{ $peripherique->usager }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Date de retour *</label>
                            <input type="datetime-local" class="form-control form-control-sm" wire:model="retourDate" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">État du retour</label>
                            <select class="form-select form-select-sm" wire:model="retourEtat">
                                <option value="Bon">Bon état</option>
                                <option value="Usure normale">Usure normale</option>
                                <option value="Endommagé">Endommagé</option>
                                <option value="Hors service">Hors service</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Commentaire</label>
                            <textarea class="form-control form-control-sm" wire:model="retourCommentaire" 
                                      placeholder="Commentaire sur l'état ou le retour" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="$set('showRetourModal', false)" class="btn btn-secondary btn-sm">
                        <i class="fas fa-times me-1"></i>
                        Annuler
                    </button>
                    <button type="button" wire:click="enregistrerRetour" class="btn btn-primary btn-sm">
                        <i class="fas fa-check me-1"></i>
                        Enregistrer le retour
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Flash Messages -->
@if (session()->has('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif

</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@push('styles')
<style>
/* Styles optimisés avec taille de police réduite */
.peripherique-dashboard {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 0.875rem;
}

.dashboard-card {
    background: #fff;
    border-radius: 8px;
    padding: 1rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
}

/* Icônes plus petites pour les statistiques */
.stat-icon-sm {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}

.stat-number.small {
    font-size: 1.4rem;
    font-weight: 700;
}

/* Couleurs des icônes */
.icon-primary .stat-icon-sm {
    background: rgba(13, 110, 253, 0.1);
    color: #0d6efd;
}
.icon-success .stat-icon-sm {
    background: rgba(25, 135, 84, 0.1);
    color: #198754;
}
.icon-info .stat-icon-sm {
    background: rgba(13, 202, 240, 0.1);
    color: #0dcaf0;
}
.icon-warning .stat-icon-sm {
    background: rgba(255, 193, 7, 0.1);
    color: #ffc107;
}
.icon-danger .stat-icon-sm {
    background: rgba(220, 53, 69, 0.1);
    color: #dc3545;
}

/* Table responsive */
.table-sm td, .table-sm th {
    padding: 0.5rem 0.3rem;
    font-size: 0.8rem;
}

.badge-sm {
    font-size: 0.7em;
    padding: 0.25em 0.5em;
}

.btn-sm {
    padding: 0.2rem 0.4rem;
    font-size: 0.8rem;
}

/* Barres de progression plus fines */
.progress {
    height: 3px !important;
}

/* Hover states */
.statut_En_service:hover {
    background-color: rgba(25, 135, 84, 0.03) !important;
}

.statut_En_stock:hover {
    background-color: rgba(13, 202, 240, 0.03) !important;
}

.statut_Hors_service:hover {
    background-color: rgba(220, 53, 69, 0.03) !important;
}

.statut_En_réparation:hover {
    background-color: rgba(255, 193, 7, 0.03) !important;
}

/* Responsive */
@media (max-width: 768px) {
    .peripherique-dashboard {
        font-size: 0.8rem;
    }
    
    .stat-number.small {
        font-size: 1.2rem;
    }
    
    .stat-icon-sm {
        width: 35px;
        height: 35px;
        font-size: 0.9rem;
    }
    
    .table-sm td, .table-sm th {
        font-size: 0.75rem;
        padding: 0.4rem 0.2rem;
    }
    
    .btn-sm {
        padding: 0.15rem 0.3rem;
        font-size: 0.75rem;
    }
}
</style>
<style>
/* Style pour les selects avec icônes */
.form-select-sm {
    font-size: 0.8rem;
    padding: 0.25rem 0.5rem;
}

/* Boutons plus compacts */
.btn-sm {
    padding: 0.2rem 0.4rem;
}

/* Input group plus compact */
.input-group-sm > .form-control,
.input-group-sm > .input-group-text {
    padding: 0.25rem 0.5rem;
    font-size: 0.8rem;
}

/* Responsive */
@media (max-width: 768px) {
    .d-flex.flex-wrap {
        gap: 0.5rem !important;
    }
    
    .flex-grow-1 {
        min-width: 150px !important;
        max-width: 100% !important;
    }
    
    select.form-select-sm {
        width: 120px !important;
    }
}
</style>
@endpush