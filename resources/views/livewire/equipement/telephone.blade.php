<div class="telephone-dashboard">
    <div class="dashboard-container">
        <!-- En-tête -->
        <div class="mb-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Gestion des Téléphones et Tablettes</h1>
            <p class="text-gray-600">Inventaire complet des équipements mobiles</p>
        </div>

        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-primary">{{ $stats['total'] ?? 0 }}</h3>
                                <p class="stats-label text-black mb-0">Total équipements</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                    <i class="fas fa-mobile-alt fa-lg"></i>
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
                                <h3 class="stats-number text-success">{{ $stats['enService'] ?? 0 }}</h3>
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
                                <h3 class="stats-number text-warning">{{ $stats['enStock'] ?? 0 }}</h3>
                                <p class="stats-label text-black mb-0">En stock</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-warning bg-opacity-25 text-warning d-flex align-items-center justify-content-center">
                                    <i class="fas fa-box fa-lg"></i>
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
                                <h3 class="stats-number text-danger">{{ $stats['horsService'] ?? 0 }}</h3>
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
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Recherche</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-transparent">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" wire:model.live="search"
                                   class="form-control" placeholder="Nom, usager, série, marque...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Statut</label>
                        <select wire:model.live="filterStatut" class="form-select form-select-sm">
                            <option value="">Tous les statuts</option>
                            <option value="En service">En service</option>
                            <option value="En stock">En stock</option>
                            <option value="Hors service">Hors service</option>
                            <option value="En maintenance">En maintenance</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Type</label>
                        <select wire:model.live="filterType" class="form-select form-select-sm">
                            <option value="">Tous les types</option>
                            <option value="Téléphone">Téléphone</option>
                            <option value="Tablette">Tablette</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Marque</label>
                        <select wire:model.live="filterFabricant" class="form-select form-select-sm">
                            <option value="">Toutes les marques</option>
                            @foreach($fabricants as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="d-flex gap-2">
                                <button wire:click="create" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i> Nouvel Équipement
                                </button>
                            <button wire:click="openImportModal" class="btn btn-outline-info btn-sm flex-fill" title="Importer des équipements">
                                <i class="fas fa-file-import me-1"></i> Importer
                            </button>
                            <button wire:click="exportToCsv" class="btn btn-outline-success btn-sm flex-fill" title="Exporter les équipements">
                                <i class="fas fa-file-export me-1"></i> Exporter
                            </button>

                            <button wire:click="confirmDeleteSelected" class="btn btn-danger btn-sm" 
                                {{ empty($selectedTelephones) ? 'disabled' : '' }}>
                            <i class="fas fa-trash me-1"></i>
                            Supprimer ({{ count($selectedTelephones) }})
                        </button>
                        </div>
                    </div>
                </div>
    
                
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container border-0 fade-in-up">
            <div class="table-header">
                <div class="table-title">
                    Liste des Équipements ({{ $telephones->total() }})
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
                        <th wire:click="sortBy('type')" class="sortable">
                            Type
                            @if($sortField === 'type')
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
                        <th>Marque/Modèle</th>
                        <th>Entité/Usager</th>
                        <th>Localisation</th>
                        <th>Numéro Série</th>
                        <th>IMEI</th>
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
                    @forelse($telephones as $telephone)
                        <tr class="statut_{{$telephone->statut}}" style="cursor:pointer">
                            <td>
                                <input type="checkbox"
                                       wire:model="selectedTelephones"
                                       value="{{ $telephone->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td wire:click="showDetails({{ $telephone->id }})">
                                <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                        <p class="text-gray-900 whitespace-no-wrap fw-semibold mb-0">
                                            {{ $telephone->nom }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td wire:click="showDetails({{ $telephone->id }})">
                                <span class="type-badge {{ $telephone->type === 'Téléphone' ? 'type-phone' : 'type-tablet' }}">
                                    {{ $telephone->type }}
                                </span>
                            </td>
                            <td wire:click="showDetails({{ $telephone->id }})">
                                @php
                                    $statutClasses = [
                                        'En service' => 'bg-green-100 text-green-800',
                                        'En stock' => 'bg-blue-100 text-blue-800',
                                        'Hors service' => 'bg-red-100 text-red-800',
                                        'En maintenance' => 'bg-yellow-100 text-yellow-800'
                                    ];
                                    $classe = $statutClasses[$telephone->statut] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="status-badge {{ $classe }}">
                                    {{ $telephone->statut }}
                                </span>
                            </td>
                            <td wire:click="showDetails({{ $telephone->id }})">
                                <p class="text-gray-900 whitespace-no-wrap fw-medium mb-0">
                                    {{ $telephone->marque ?? 'N/A' }}
                                </p>
                                <p class="text-gray-600 small mb-0">{{ $telephone->modele ?? '' }}</p>
                            </td>
                            <td wire:click="showDetails({{ $telephone->id }})">
                                <p class="text-gray-900 whitespace-no-wrap mb-0">
                                    {{ $telephone->entite ?? '-' }}
                                </p>
                                @if($telephone->usager)
                                    <p class="text-gray-600 small mb-0">{{ $telephone->usager }}</p>
                                @endif
                            </td>
                            <td wire:click="showDetails({{ $telephone->id }})">
                                <p class="text-gray-900 whitespace-no-wrap mb-0">
                                    {{ $telephone->lieu ?? 'N/A' }}
                                </p>
                                @if($telephone->emplacement_actuel)
                                    <p class="text-gray-600 small mb-0">{{ $telephone->emplacement_actuel }}</p>
                                @endif
                            </td>
                            <td wire:click="showDetails({{ $telephone->id }})" class="font-mono">
                                {{ $telephone->numero_serie ?? 'N/A' }}
                            </td>
                            <td wire:click="showDetails({{ $telephone->id }})" class="font-mono small">
                                @if($telephone->imei)
                                    {{ substr($telephone->imei, 0, 8) }}...
                                @else
                                    N/A
                                @endif
                            </td>
                            <td wire:click="showDetails({{ $telephone->id }})">
                                {{ $telephone->updated_at->format('d/m/Y H:i') }}
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button wire:click="edit({{ $telephone->id }})"
                                            class="btn-action btn-edit" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $telephone->id }})"
                                            class="btn-action btn-delete" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center py-4">
                                <i class="fas fa-mobile-alt fa-2x text-muted mb-2"></i>
                                <p class="text-muted">Aucun équipement trouvé</p>
                                @if($search || $filterStatut || $filterType || $filterFabricant)
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
            <div class="mt-4 container">
                {{ $telephones->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Formulaire -->
    @if($showModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas {{ $isEditing ? 'fa-edit' : 'fa-plus' }} me-2"></i>
                        {{ $isEditing ? 'Modifier l\'équipement' : 'Nouvel équipement' }}
                    </h5>
                    <button type="button" wire:click="closeModal" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <!-- Colonne 1 -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nom *</label>
                                    <input wire:model="nom" type="text" class="form-control" placeholder="Ex: TEL-IT-001, TAB-ADM-002">
                                    @error('nom') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Type *</label>
                                    <select wire:model="type" class="form-select">
                                        <option value="">Sélectionnez un type</option>
                                        <option value="Téléphone">Téléphone</option>
                                        <option value="Tablette">Tablette</option>
                                    </select>
                                    @error('type') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Marque *</label>
                                    <input wire:model="marque" type="text" class="form-control" placeholder="Ex: Apple, Samsung, Huawei">
                                    @error('marque') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Modèle *</label>
                                    <input wire:model="modele" type="text" class="form-control" placeholder="Ex: iPhone 14, Galaxy S23">
                                    @error('modele') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Colonne 2 -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Numéro de série *</label>
                                    <input wire:model="numero_serie" type="text" class="form-control" placeholder="Numéro de série unique">
                                    @error('numero_serie') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Statut *</label>
                                    <select wire:model="statut" class="form-select">
                                        <option value="">Sélectionnez un statut</option>
                                        <option value="En service">En service</option>
                                        <option value="En stock">En stock</option>
                                        <option value="En maintenance">En maintenance</option>
                                        <option value="Hors service">Hors service</option>
                                    </select>
                                    @error('statut') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Entité</label>
                                    <input wire:model="entite" type="text" class="form-control" placeholder="Ex: Direction, IT, Commercial">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Usager</label>
                                    <input wire:model="usager" type="text" class="form-control" placeholder="Personne assignée">
                                </div>
                            </div>

                            <!-- Colonne 3 -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Lieu *</label>
                                            <input wire:model="lieu" type="text" class="form-control" placeholder="Ex: Bureau 101, Entrepôt">
                                            @error('lieu') <span class="text-danger small">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">Emplacement actuel *</label>
                                            <input wire:model="emplacement_actuel" type="text" class="form-control" placeholder="Localisation précise">
                                            @error('emplacement_actuel') <span class="text-danger small">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label class="form-label">IMEI</label>
                                            <input wire:model="imei" type="text" class="form-control" placeholder="Numéro IMEI (15 chiffres)">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Services/Plugins</label>
                                    <textarea wire:model="services" class="form-control" rows="3" placeholder="Services installés, configurations..."></textarea>
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
                                {{ $isEditing ? 'Modifier' : 'Créer' }}
                            </button>
                        </div>
                    </form>
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
                    <h5 class="modal-title">Importer des Équipements</h5>
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
                            {{ $importSuccessCount }} équipement(s) importé(s) avec succès.
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeImportModal" class="btn btn-secondary">Annuler</button>
                    <button type="button" wire:click="importTelephones" class="btn btn-primary" 
                            {{ !$importFile ? 'disabled' : '' }}>
                        <i class="fas fa-upload me-2"></i>
                        {{ $isImporting ? 'Import en cours...' : 'Importer' }}
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

    <!-- Confirmation Modal -->
    @if($confirmingDelete)
        <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmer la suppression</h5>
                        <button type="button" wire:click="$set('confirmingDelete', false)" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Êtes-vous sûr de vouloir supprimer cet équipement ?</p>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="$set('confirmingDelete', false)" class="btn btn-secondary">
                            Annuler
                        </button>
                        <button wire:click="delete({{ $confirmingDelete }})" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif
</div>

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .telephone-dashboard {
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
        
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .type-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .type-phone {
            background-color: rgba(139, 92, 246, 0.1);
            color: #7c3aed;
            border: 1px solid rgba(139, 92, 246, 0.2);
        }
        
        .type-tablet {
            background-color: rgba(245, 158, 11, 0.1);
            color: #d97706;
            border: 1px solid rgba(245, 158, 11, 0.2);
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
        .statut_En service:hover {
            background-color: rgba(40, 167, 69, 0.05) !important;
        }
        
        .statut_En maintenance:hover {
            background-color: rgba(255, 193, 7, 0.05) !important;
        }
        
        .statut_Hors service:hover {
            background-color: rgba(220, 53, 69, 0.05) !important;
        }
        
        .statut_En stock:hover {
            background-color: rgba(13, 110, 253, 0.05) !important;
        }
    </style>
@endpush