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
                       @if(count($fabricantOptions))
    <select name="fabricant" wire:model="fabricant">
        @foreach($fabricantOptions as $fabricant)
            <option value="{{ $fabricant }}">{{ $fabricant }}</option>
        @endforeach
    </select>
@endif

                    </div>
                    <div class="col-md-1">
                        <button type="button" wire:click="resetFilters"
                                class="btn btn-outline-secondary btn-sm w-100" title="Réinitialiser les filtres">
                            <i class="fa fa-times"></i> Reset
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="deleteSelected" class="btn btn-danger btn-sm w-100" title="Supprimer les matériels sélectionnés"
                            {{ empty($selectedMateriels) ? 'disabled' : '' }}>
                            <i class="fas fa-trash"></i>
                            ({{ count($selectedMateriels) }})
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="exportToCsv" class="btn btn-success btn-sm w-100" title="Exporter les matériels">
                            <i class="fas fa-file-export"></i>
                            Exporter
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
                <button wire:click="showCreateForm" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-2"></i>Nouveau Matériel
                </button>
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
                        <th>Lieu</th>
                        <th>IP Réseau</th>
                        <th>Type</th>
                        <th>Modèle</th>
                        <th>N° Série</th>
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
                        <tr class="statut_{{$materiel->statut}}" style="cursor:pointer">
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
                                        'En service' => 'bg-green-100 text-green-800',
                                        'En stock' => 'bg-blue-100 text-blue-800',
                                        'Hors service' => 'bg-red-100 text-red-800',
                                        'En maintenance' => 'bg-yellow-100 text-yellow-800'
                                    ];
                                    $classe = $statutClasses[$materiel->statut] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="status-badge {{ $classe }}">
                                    {{ $materiel->statut }}
                                </span>
                            </td>
                            <td wire:click="showDetails({{ $materiel->id }})">{{ $materiel->fabricant ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $materiel->id }})">{{ $materiel->lieu ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $materiel->id }})" class="font-mono">{{ $materiel->reseau_ip ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $materiel->id }})">{{ $materiel->type ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $materiel->id }})">{{ $materiel->modele ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $materiel->id }})" class="font-mono">{{ $materiel->numero_serie ?? 'N/A' }}</td>
                            <td wire:click="showDetails({{ $materiel->id }})">{{ $materiel->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button wire:click="showEditForm({{ $materiel->id }})"
                                            class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $materiel->id }})"
                                            class="btn-action btn-delete">
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

    <!-- Formulaire Modal -->
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
                                    <input type="text" wire:model="nom" class="form-control">
                                    @error('nom') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Entité</label>
                                    <input type="text" wire:model="entite" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Statut *</label>
                                    <select wire:model="statut" class="form-select">
                                        @foreach($statutOptions as $option)
                                            <option value="{{ $option }}">{{ $option }}</option>
                                        @endforeach
                                    </select>
                                    @error('statut') <span class="text-danger small">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Fabricant</label>
                                    <input type="text" wire:model="fabricant" class="form-control">
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
                                <i class="fas fa-save mr-2"></i>
                                {{ $editMode ? 'Mettre à jour' : 'Créer' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Confirmation Modal -->
    @if($showDeleteModal)
        <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmer la suppression</h5>
                        <button type="button" wire:click="closeDeleteModal" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Voulez-vous vraiment supprimer les matériels sélectionnés ?</p>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="closeDeleteModal" class="btn btn-secondary">Annuler</button>
                        <button wire:click="deleteSelected" class="btn btn-danger">Oui, supprimer</button>
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
        
        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
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