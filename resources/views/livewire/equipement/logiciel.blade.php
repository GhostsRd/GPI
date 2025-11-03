<div class="ticket-dashboard">
    <div class="dashboard-container">
        <!-- En-tête -->
        <div class="mb-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                <i class="fas fa-boxes me-2 text-primary"></i>Gestion des Logiciels
            </h1>
            <p class="text-gray-600">Inventaire complet des applications et licences</p>
        </div>

        <!-- Messages flash -->
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show small" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show small" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if (session()->has('warning'))
            <div class="alert alert-warning alert-dismissible fade show small" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        <!-- Statistiques -->
        @if($showStats)
        <div class="row mb-4">
            <!-- Total -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-primary">{{ $stats['total'] ?? 0 }}</h3>
                                <p class="stats-label text-black mb-0">Total Logiciels</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                    <i class="fas fa-boxes fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Licences critiques -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-warning">{{ $stats['licences_critiques'] ?? 0 }}</h3>
                                <p class="stats-label text-black mb-0">Licences Critiques</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-warning bg-opacity-25 text-warning d-flex align-items-center justify-content-center">
                                    <i class="fas fa-exclamation-triangle fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total installations -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-success">{{ $stats['total_installations'] ?? 0 }}</h3>
                                <p class="stats-label text-black mb-0">Total Installations</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-success bg-opacity-25 text-success d-flex align-items-center justify-content-center">
                                    <i class="fas fa-download fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Taux de conformité -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                @php
                                    $installations = $stats['total_installations'] ?? 0;
                                    $licences = $stats['total_licences'] ?? 1;
                                    $taux = $licences > 0 ? round(($installations / $licences) * 100) : 0;
                                @endphp
                                <h3 class="stats-number mb-0 {{ $taux <= 80 ? 'text-success' : ($taux <= 100 ? 'text-warning' : 'text-danger') }}">
                                    {{ $taux }}%
                                </h3>
                                <p class="stats-label text-black mb-0">Taux Conformité</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle {{ $taux <= 80 ? 'bg-success bg-opacity-25 text-success' : ($taux <= 100 ? 'bg-warning bg-opacity-25 text-warning' : 'bg-danger bg-opacity-25 text-danger') }} d-flex align-items-center justify-content-center">
                                    <i class="fas fa-chart-line fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

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
                            <input type="text" wire:model.live.debounce.300ms="search"
                                   class="form-control" placeholder="Nom, éditeur, version...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Éditeur</label>
                        <select wire:model.live="editeur" class="form-select form-select-sm">
                            <option value="">Tous les éditeurs</option>
                            @foreach($editeurs as $editeurOption)
                                <option value="{{ $editeurOption }}">{{ $editeurOption }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Système d'exploitation</label>
                        <select wire:model.live="systeme_exploitation" class="form-select form-select-sm">
                            <option value="">Tous les systèmes</option>
                            @foreach($systemes as $systeme)
                                <option value="{{ $systeme }}">{{ $systeme }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Statut licence</label>
                        <select wire:model.live="statutFilter" class="form-select form-select-sm">
                            <option value="">Tous les statuts</option>
                            <option value="Normal">Normal</option>
                            <option value="Attention">Attention</option>
                            <option value="Critique">Critique</option>
                            <option value="Aucune licence">Aucune licence</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" wire:click="resetFilters"
                                class="btn btn-outline-secondary btn-sm w-100" title="Réinitialiser les filtres">
                            <i class="fas fa-times"></i> Reset
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button type="button" wire:click="openImportModal" class="btn btn-info btn-sm w-100" title="Importer des logiciels">
                            <i class="fas fa-file-import"></i> Importer
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="deleteSelected" class="btn btn-danger btn-sm w-100" title="Supprimer les logiciels sélectionnés"
                            {{ empty($selectedLogiciels) ? 'disabled' : '' }}>
                            <i class="fas fa-trash"></i>
                            ({{ count($selectedLogiciels) }})
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="exportToCsv" class="btn btn-success btn-sm w-100" title="Exporter les logiciels">
                            <i class="fas fa-file-export"></i>
                            Exporter
                        </button>
                    </div>
                </div>

                <!-- Résultats du filtre -->
                @if($search || $editeur || $systeme_exploitation || $statutFilter)
                <div class="mt-3 pt-2 border-top">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <span class="text-muted small">Filtres actifs :</span>
                        @if($search)
                        <span class="badge bg-light text-dark border small d-flex align-items-center">
                            Recherche: "{{ $search }}"
                            <button wire:click="$set('search', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                        </span>
                        @endif
                        @if($editeur)
                        <span class="badge bg-light text-dark border small d-flex align-items-center">
                            Éditeur: {{ $editeur }}
                            <button wire:click="$set('editeur', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                        </span>
                        @endif
                        @if($systeme_exploitation)
                        <span class="badge bg-light text-dark border small d-flex align-items-center">
                            Système: {{ $systeme_exploitation }}
                            <button wire:click="$set('systeme_exploitation', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                        </span>
                        @endif
                        @if($statutFilter)
                        <span class="badge bg-light text-dark border small d-flex align-items-center">
                            Statut: {{ $statutFilter }}
                            <button wire:click="$set('statutFilter', '')" class="btn-close btn-close-sm ms-1" style="font-size: 0.6rem;"></button>
                        </span>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container border-0 fade-in-up">
            <div class="table-header">
                <div class="table-title">
                    Liste des Logiciels ({{ $logiciels->total() }})
                </div>
                <div class="d-flex gap-2">
                    <button wire:click="toggleStats" class="btn btn-outline-primary btn-sm d-flex align-items-center">
                        <i class="fas fa-chart-bar me-1"></i>
                        {{ $showStats ? 'Masquer' : 'Afficher' }} stats
                    </button>
                    <button wire:click="create" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus mr-2"></i>Nouveau Logiciel
                    </button>
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
                        <th wire:click="sortBy('editeur')" class="sortable">
                            Éditeur
                            @if($sortField === 'editeur')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th>Version</th>
                        <th>Système d'exploitation</th>
                        <th wire:click="sortBy('nombre_installations')" class="sortable">
                            Installations
                            @if($sortField === 'nombre_installations')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('nombre_licences')" class="sortable">
                            Licences
                            @if($sortField === 'nombre_licences')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('statut_licences')" class="sortable">
                            Statut
                            @if($sortField === 'statut_licences')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
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
                    @forelse($logiciels as $logiciel)
                        <tr class="statut_{{ str_replace(' ', '_', $logiciel->statut_licences) }}" style="cursor:pointer">
                            <td>
                                <input type="checkbox"
                                       wire:model="selectedLogiciels"
                                       value="{{ $logiciel->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td wire:click="showDetails({{ $logiciel->id }})">
                                <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                        <p class="text-gray-900 whitespace-no-wrap fw-semibold mb-0">
                                            {{ $logiciel->nom }}
                                        </p>
                                        @if($logiciel->description)
                                            <p class="text-gray-600 small mb-0">
                                                {{ Str::limit($logiciel->description, 50) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td wire:click="showDetails({{ $logiciel->id }})">{{ $logiciel->editeur ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $logiciel->id }})">{{ $logiciel->version_nom ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $logiciel->id }})">
                                <span class="os-badge">
                                    {{ $logiciel->version_systeme_exploitation ?? 'N/A' }}
                                </span>
                            </td>
                            <td wire:click="showDetails({{ $logiciel->id }})" class="text-center">
                                <span class="installation-badge">{{ $logiciel->nombre_installations }}</span>
                            </td>
                            <td wire:click="showDetails({{ $logiciel->id }})" class="text-center">
                                <span class="licence-badge">{{ $logiciel->nombre_licences }}</span>
                            </td>
                            <td wire:click="showDetails({{ $logiciel->id }})">
                                @php
                                    $statutClasses = [
                                        'Normal' => 'bg-green-100 text-green-800',
                                        'Attention' => 'bg-yellow-100 text-yellow-800',
                                        'Critique' => 'bg-red-100 text-red-800',
                                        'Aucune licence' => 'bg-gray-100 text-gray-800'
                                    ];
                                    $classe = $statutClasses[$logiciel->statut_licences] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="status-badge {{ $classe }}">
                                    {{ $logiciel->statut_licences }}
                                    @if($logiciel->statut_licences != 'Aucune licence')
                                        ({{ $logiciel->pourcentage_utilisation }}%)
                                    @endif
                                </span>
                            </td>
                            <td wire:click="showDetails({{ $logiciel->id }})">
                                {{ $logiciel->updated_at->format('d/m/Y H:i') }}
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button wire:click="showDetails({{ $logiciel->id }})"
                                            class="btn-action btn-info">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button wire:click="edit({{ $logiciel->id }})"
                                            class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $logiciel->id }})"
                                            class="btn-action btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="text-center py-4">
                                <i class="fas fa-boxes fa-2x text-muted mb-2"></i>
                                <p class="text-muted">Aucun logiciel trouvé</p>
                                @if($search || $editeur || $systeme_exploitation || $statutFilter)
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
                {{ $logiciels->links() }}
            </div>
        </div>
    </div>

    <!-- Modal pour créer/modifier un logiciel -->
    @if($showModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas {{ $editing ? 'fa-edit' : 'fa-plus' }} me-2"></i>
                        {{ $editing ? 'Modifier le Logiciel' : 'Nouveau Logiciel' }}
                    </h5>
                    <button type="button" wire:click="closeModal" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nom du logiciel *</label>
                                    <input type="text" class="form-control" wire:model="nom" required>
                                    @error('nom') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Éditeur</label>
                                    <input type="text" class="form-control" wire:model="editeur_form" placeholder="Microsoft, Adobe, Google...">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Version</label>
                                    <input type="text" class="form-control" wire:model="version_nom" placeholder="2023, CC 2023, v2.1...">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nombre d'installations</label>
                                    <input type="number" class="form-control" wire:model="nombre_installations" min="0">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Système d'exploitation</label>
                                    <input type="text" class="form-control" wire:model="version_systeme_exploitation" 
                                           placeholder="Windows, macOS, Linux...">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nombre de licences</label>
                                    <input type="number" class="form-control" wire:model="nombre_licences" min="0">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Date d'achat</label>
                                    <input type="date" class="form-control" wire:model="date_achat">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Date d'expiration</label>
                                    <input type="date" class="form-control" wire:model="date_expiration">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" wire:model="description" rows="3" placeholder="Description du logiciel..."></textarea>
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
                                {{ $editing ? 'Modifier' : 'Créer' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de détails du logiciel -->
    @if($showDetailsModal && $selectedLogiciel)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); z-index: 1050;" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Détails du Logiciel
                    </h5>
                    <button type="button" wire:click="closeDetailsModal" class="btn-close btn-close-white"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nom</label>
                                <p>{{ $selectedLogiciel->nom }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Éditeur</label>
                                <p>{{ $selectedLogiciel->editeur ?? 'Non spécifié' }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Version</label>
                                <p>{{ $selectedLogiciel->version_nom ?? 'Non spécifié' }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Système d'exploitation</label>
                                <p>{{ $selectedLogiciel->version_systeme_exploitation ?? 'Non spécifié' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Installations</label>
                                <p>{{ $selectedLogiciel->nombre_installations }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Licences</label>
                                <p>{{ $selectedLogiciel->nombre_licences }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Statut</label>
                                <span class="status-badge 
                                    @if($selectedLogiciel->statut_licences == 'Normal') bg-green-100 text-green-800
                                    @elseif($selectedLogiciel->statut_licences == 'Attention') bg-yellow-100 text-yellow-800
                                    @elseif($selectedLogiciel->statut_licences == 'Critique') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $selectedLogiciel->statut_licences }}
                                    @if($selectedLogiciel->statut_licences != 'Aucune licence')
                                        ({{ $selectedLogiciel->pourcentage_utilisation }}%)
                                    @endif
                                </span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Date d'achat</label>
                                <p>{{ $selectedLogiciel->date_achat ? $selectedLogiciel->date_achat->format('d/m/Y') : 'Non spécifiée' }}</p>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Date d'expiration</label>
                                <p>{{ $selectedLogiciel->date_expiration ? $selectedLogiciel->date_expiration->format('d/m/Y') : 'Non spécifiée' }}</p>
                            </div>
                        </div>
                    </div>
                    @if($selectedLogiciel->description)
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <p>{{ $selectedLogiciel->description }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Date de création</label>
                                <p>{{ $selectedLogiciel->created_at->format('d/m/Y à H:i') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Dernière modification</label>
                                <p>{{ $selectedLogiciel->updated_at->format('d/m/Y à H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="closeDetailsModal" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>
                        Fermer
                    </button>
                    <button type="button" wire:click="edit({{ $selectedLogiciel->id }})" class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i>
                        Modifier
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de confirmation de suppression -->
    @if($showDeleteModal && $selectedLogiciel)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la suppression</h5>
                    <button type="button" wire:click="closeDeleteModal" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle text-danger display-5"></i>
                        <h4 class="mt-2 h5">Êtes-vous sûr ?</h4>
                        <p class="text-muted small">
                            Vous êtes sur le point de supprimer le logiciel <strong>{{ $selectedLogiciel->nom }}</strong>. 
                            Cette action est irréversible.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="closeDeleteModal" class="btn btn-secondary">Annuler</button>
                    <button wire:click="deleteConfirmed" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal d'import -->
@if($showImportModal)
<div class="modal-backdrop fade show"></div>
<div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title small fw-semibold">
                    <i class="fas fa-file-import me-1 text-primary"></i>
                    Importer des Logiciels
                </h5>
                <button type="button" class="btn-close btn-close-sm" wire:click="closeImportModal"></button>
            </div>
            <div class="modal-body p-3">
                <div class="text-center mb-3">
                    <i class="fas fa-file-csv display-6 text-primary mb-3"></i>
                    <h6 class="fw-semibold">Importer depuis un fichier CSV</h6>
                    <p class="text-muted small">Téléchargez le template ou importez votre fichier CSV</p>
                </div>

                <div class="alert alert-info small">
                    <i class="fas fa-info-circle me-2"></i>
                    Formats supportés: CSV, TXT. Taille max: 10MB
                </div>
                
                <div class="mb-3">
                    <label class="form-label small fw-medium">Fichier CSV</label>
                    <input type="file" wire:model="importFile" 
                           class="form-control form-control-sm @error('importFile') is-invalid @enderror" 
                           accept=".csv,.txt">
                    @error('importFile') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <button type="button" wire:click="downloadImportTemplate" 
                            class="btn btn-outline-primary btn-sm w-100">
                        <i class="fas fa-download me-1"></i>
                        Télécharger le template
                    </button>
                </div>

                @if($importErrors && count($importErrors) > 0)
                <div class="alert alert-danger small">
                    <h6 class="alert-heading small">Erreurs détectées</h6>
                    <ul class="mb-0 small">
                        @foreach($importErrors as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-secondary btn-sm" wire:click="closeImportModal">
                    <i class="fas fa-times me-1"></i>
                    Annuler
                </button>
                <button type="button" class="btn btn-primary btn-sm" 
                        wire:click="storeImportFile" 
                        wire:loading.attr="disabled"
                        {{ !$importFile ? 'disabled' : '' }}>
                    <i class="fas fa-arrow-right me-1"></i>
                    <span wire:loading.remove>Suivant</span>
                    <span wire:loading>
                        <i class="fas fa-spinner fa-spin me-1"></i>
                        Chargement...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal Mapping -->
@if($showMappingModal)
<div class="modal-backdrop fade show"></div>
<div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title small fw-semibold">
                    <i class="fas fa-map-marked-alt me-1 text-warning"></i>
                    Mapping des Colonnes
                </h5>
                <button type="button" class="btn-close btn-close-sm" wire:click="cancelImport"></button>
            </div>
            <div class="modal-body p-3">
                <div class="alert alert-warning small">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Associez les colonnes de votre fichier aux champs du système.
                </div>

                <!-- Aperçu des données -->
                @if(count($csvPreview) > 0)
                <div class="mb-4">
                    <h6 class="small fw-semibold">Aperçu des données (5 premières lignes):</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered small">
                            <thead class="table-light">
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
                        <h6 class="small fw-semibold">Mapping des champs:</h6>
                        @foreach(['nom' => 'Nom*', 'editeur' => 'Éditeur', 'version_nom' => 'Version', 'version_systeme_exploitation' => 'Système d\'exploitation'] as $field => $label)
                        <div class="mb-3">
                            <label class="form-label small fw-medium">{{ $label }}</label>
                            <select wire:model="fieldMapping.{{ $field }}" 
                                    class="form-select form-select-sm @if($field === 'nom' && empty($fieldMapping['nom'])) is-invalid @endif">
                                <option value="">-- Sélectionner une colonne --</option>
                                @foreach($csvHeaders as $header)
                                <option value="{{ $header }}">{{ $header }}</option>
                                @endforeach
                            </select>
                            @if($field === 'nom' && empty($fieldMapping['nom']))
                            <div class="invalid-feedback small">Le champ nom est obligatoire</div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="col-md-6">
                        <h6 class="small fw-semibold">Champs optionnels :</h6>
                        @foreach(['nombre_installations' => 'Installations', 'nombre_licences' => 'Licences', 'date_achat' => 'Date achat', 'date_expiration' => 'Date expiration'] as $field => $label)
                        <div class="mb-3">
                            <label class="form-label small text-muted">{{ $label }}</label>
                            <select wire:model="fieldMapping.{{ $field }}" class="form-select form-select-sm">
                                <option value="">-- Optionnel --</option>
                                @foreach($csvHeaders as $header)
                                <option value="{{ $header }}">{{ $header }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                    </div>
                </div>

                @if($importErrors && count($importErrors) > 0)
                <div class="alert alert-danger small mt-3">
                    <h6 class="alert-heading small">Erreurs de mapping</h6>
                    <ul class="mb-0 small">
                        @foreach($importErrors as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-secondary btn-sm" wire:click="cancelImport">
                    <i class="fas fa-arrow-left me-1"></i>
                    Retour
                </button>
                <button type="button" class="btn btn-warning btn-sm" 
                        wire:click="processMappedData"
                        wire:loading.attr="disabled"
                        {{ empty($fieldMapping['nom']) ? 'disabled' : '' }}>
                    <i class="fas fa-check me-1"></i>
                    <span wire:loading.remove>Valider le mapping</span>
                    <span wire:loading>
                        <i class="fas fa-spinner fa-spin me-1"></i>
                        Traitement...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal Aperçu des données importées -->
@if($showImportedData)
<div class="modal-backdrop fade show"></div>
<div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header py-2">
                <h5 class="modal-title small fw-semibold">
                    <i class="fas fa-check-circle me-1 text-success"></i>
                    Aperçu des Données Importées
                </h5>
                <button type="button" class="btn-close btn-close-sm" wire:click="cancelImport"></button>
            </div>
            <div class="modal-body p-3">
                <div class="alert alert-success small">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>{{ $importSuccessCount }}</strong> enregistrement(s) prêt(s) à être importés.
                    @if(count($importErrors) > 0)
                    - <strong>{{ count($importErrors) }}</strong> erreur(s)
                    @endif
                </div>

                @if(count($importErrors) > 0)
                <div class="alert alert-danger small">
                    <h6 class="alert-heading small">Erreurs d'importation:</h6>
                    <ul class="mb-0 small">
                        @foreach($importErrors as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Aperçu des données mappées -->
                @if(count($importedData) > 0)
                <div class="table-responsive">
                    <table class="table table-sm table-bordered small">
                        <thead class="table-light">
                            <tr>
                                <th>Nom</th>
                                <th>Éditeur</th>
                                <th>Version</th>
                                <th>Système d'exploitation</th>
                                <th>Installations</th>
                                <th>Licences</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(array_slice($importedData, 0, 5) as $data)
                            <tr>
                                <td>{{ $data['nom'] }}</td>
                                <td>{{ $data['editeur'] ?? 'N/A' }}</td>
                                <td>{{ $data['version_nom'] ?? 'N/A' }}</td>
                                <td>{{ $data['version_systeme_exploitation'] ?? 'N/A' }}</td>
                                <td class="text-center">{{ $data['nombre_installations'] ?? 0 }}</td>
                                <td class="text-center">{{ $data['nombre_licences'] ?? 0 }}</td>
                                <td>
                                    @php
                                        $installations = $data['nombre_installations'] ?? 0;
                                        $licences = $data['nombre_licences'] ?? 0;
                                        
                                        if ($licences == 0) {
                                            $statut = 'Aucune licence';
                                            $badgeClass = 'bg-secondary';
                                        } elseif ($installations > $licences) {
                                            $statut = 'Critique';
                                            $badgeClass = 'bg-danger';
                                        } elseif ($installations == $licences) {
                                            $statut = 'Attention';
                                            $badgeClass = 'bg-warning';
                                        } else {
                                            $statut = 'Normal';
                                            $badgeClass = 'bg-success';
                                        }
                                    @endphp
                                    <span class="badge {{ $badgeClass }} badge-sm">
                                        {{ $statut }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            @if(count($importedData) > 5)
                            <tr>
                                <td colspan="7" class="text-center text-muted small">
                                    ... et {{ count($importedData) - 5 }} autre(s) logiciel(s)
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-secondary btn-sm" wire:click="cancelImport">
                    <i class="fas fa-times me-1"></i>
                    Annuler
                </button>
                <button type="button" class="btn btn-success btn-sm" 
                        wire:click="saveImportedData"
                        wire:loading.attr="disabled"
                        {{ count($importedData) === 0 ? 'disabled' : '' }}>
                    <i class="fas fa-save me-1"></i>
                    <span wire:loading.remove>Importer ({{ count($importedData) }})</span>
                    <span wire:loading>
                        <i class="fas fa-spinner fa-spin me-1"></i>
                        Import...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>
@endif

</div>

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .ticket-dashboard {
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
        
        .btn-info {
            background-color: #d1ecf1;
            color: #0c5460;
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
        
        .os-badge {
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-size: 0.75rem;
            background-color: #e9ecef;
            color: #495057;
        }
        
        .installation-badge {
            padding: 0.3rem 0.6rem;
            border-radius: 50px;
            background-color: #d1ecf1;
            color: #0c5460;
            font-weight: 600;
            font-size: 0.8rem;
        }
        
        .licence-badge {
            padding: 0.3rem 0.6rem;
            border-radius: 50px;
            background-color: #e2e3e5;
            color: #383d41;
            font-weight: 600;
            font-size: 0.8rem;
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
        .statut_Normal:hover {
            background-color: rgba(40, 167, 69, 0.05) !important;
        }
        
        .statut_Attention:hover {
            background-color: rgba(255, 193, 7, 0.05) !important;
        }
        
        .statut_Critique:hover {
            background-color: rgba(220, 53, 69, 0.05) !important;
        }
        
        .statut_Aucune_licence:hover {
            background-color: rgba(108, 117, 125, 0.05) !important;
        }
    </style>
@endpush