<div class="peripherique-dashboard">
    <div class="dashboard-container">
        <!-- En-tête -->
        <div class="mb-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Gestion des Périphériques</h1>
            <p class="text-gray-600">Inventaire complet des équipements périphériques</p>
        </div>

        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-primary">{{ $stats['total'] ?? 0 }}</h3>
                                <p class="stats-label text-black mb-0">Total Périphériques</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                    <i class="fas fa-desktop fa-lg"></i>
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
                                <h3 class="stats-number text-warning">{{ $stats['en_stock'] ?? 0 }}</h3>
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
                                   class="form-control" placeholder="Nom, modèle, fabricant...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Statut</label>
                        <select wire:model.live="filterStatut" class="form-select form-select-sm">
                            <option value="">Tous les statuts</option>
                            @foreach($statuts as $statut)
                                <option value="{{ $statut }}">{{ $statut }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Type</label>
                        <select wire:model.live="filterType" class="form-select form-select-sm">
                            <option value="">Tous les types</option>
                            @foreach($types as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Fabricant</label>
                        <select wire:model.live="filterFabricant" class="form-select form-select-sm">
                            <option value="">Tous les fabricants</option>
                            @foreach($fabricants as $fabricant)
                                <option value="{{ $fabricant }}">{{ $fabricant }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" wire:click="resetFilters"
                                class="btn btn-outline-secondary btn-sm w-100" title="Réinitialiser les filtres">
                            <i class="fa fa-times"></i> Reset
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="deleteSelected" class="btn btn-danger btn-sm w-100" title="Supprimer les périphériques sélectionnés"
                            {{ empty($selectedPeripheriques) ? 'disabled' : '' }}>
                            <i class="fas fa-trash"></i>
                            ({{ count($selectedPeripheriques) }})
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="exportToCsv" class="btn btn-success btn-sm w-100" title="Exporter les périphériques">
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
                    Liste des Périphériques ({{ $peripheriques->total() }})
                </div>
                <button wire:click="showForm" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus mr-2"></i>Nouveau Périphérique
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
                        <th>Fabricant/Modèle</th>
                        <th>Entité/Usager</th>
                        <th>Lieu</th>
                        <th wire:click="sortBy('updated_at')" class="sortable">
                            Dernière modif.
                            @if($sortField === 'updated_at')
                            <i class="fas fa-sort-<?php echo e($sortDirection === 'asc' ? 'up' : 'down'); ?>"></i>
                            @else
                                <i class="fas fa-sort"></i>
                            @endif
                        </th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($peripheriques as $peripherique)
                        <tr class="statut_{{ str_replace(' ', '_', $peripherique->statut) }}" style="cursor:pointer">
                            <td>
                                <input type="checkbox"
                                       wire:model="selectedPeripheriques"
                                       value="{{ $peripherique->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td wire:click="showDetails({{ $peripherique->id }})">
                                <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                        <p class="text-gray-900 whitespace-no-wrap fw-semibold mb-0">
                                            {{ $peripherique->nom }}
                                        </p>
                                        @if($peripherique->entite)
                                            <p class="text-gray-600 small mb-0">{{ $peripherique->entite }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td wire:click="showDetails({{ $peripherique->id }})">
                                <span class="type-badge type-{{ strtolower($peripherique->type) }}">
                                    {{ $peripherique->type }}
                                </span>
                            </td>
                            <td wire:click="showDetails({{ $peripherique->id }})">
                                @php
                                    $statutClasses = [
                                        'En service' => 'bg-green-100 text-green-800',
                                        'En stock' => 'bg-blue-100 text-blue-800',
                                        'Hors service' => 'bg-red-100 text-red-800',
                                        'En maintenance' => 'bg-yellow-100 text-yellow-800'
                                    ];
                                    $classe = $statutClasses[$peripherique->statut] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="status-badge {{ $classe }}">
                                    {{ $peripherique->statut }}
                                </span>
                            </td>
                            <td wire:click="showDetails({{ $peripherique->id }})">
                                <p class="text-gray-900 whitespace-no-wrap fw-medium mb-0">
                                    {{ $peripherique->fabricant ?? 'N/A' }}
                                </p>
                                <p class="text-gray-600 small mb-0">{{ $peripherique->modele ?? '' }}</p>
                            </td>
                            <td wire:click="showDetails({{ $peripherique->id }})">
                                <p class="text-gray-900 whitespace-no-wrap mb-0">
                                    {{ $peripherique->entite ?? '-' }}
                                </p>
                                @if($peripherique->usager)
                                    <p class="text-gray-600 small mb-0">{{ $peripherique->usager }}</p>
                                @endif
                            </td>
                            <td wire:click="showDetails({{ $peripherique->id }})">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $peripherique->lieu ?? 'N/A' }}
                                </p>
                            </td>
                            <td wire:click="showDetails({{ $peripherique->id }})">
                                {{ $peripherique->updated_at->format('d/m/Y H:i') }}
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button wire:click="edit({{ $peripherique->id }})"
                                            class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $peripherique->id }})"
                                            class="btn-action btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <i class="fas fa-desktop fa-2x text-muted mb-2"></i>
                                <p class="text-muted">Aucun périphérique trouvé</p>
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
                {{ $peripheriques->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Formulaire -->
    @if($showForm)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas {{ $editingId ? 'fa-edit' : 'fa-plus' }} me-2"></i>
                        {{ $editingId ? 'Modifier le Périphérique' : 'Nouveau Périphérique' }}
                    </h5>
                    <button type="button" wire:click="$set('showForm', false)" class="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
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
        <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirmer la suppression</h5>
                        <button type="button" wire:click="$set('confirmingDelete', false)" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Êtes-vous sûr de vouloir supprimer ce périphérique ?</p>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="$set('confirmingDelete', false)" class="btn btn-secondary">Annuler</button>
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

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .peripherique-dashboard {
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
            background-color: #e9ecef;
            color: #495057;
        }
        
        .type-ecran {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
            border: 1px solid rgba(13, 110, 253, 0.2);
        }
        
        .type-imprimante {
            background-color: rgba(111, 66, 193, 0.1);
            color: #6f42c1;
            border: 1px solid rgba(111, 66, 193, 0.2);
        }
        
        .type-clavier {
            background-color: rgba(253, 126, 20, 0.1);
            color: #fd7e14;
            border: 1px solid rgba(253, 126, 20, 0.2);
        }
        
        .type-souris {
            background-color: rgba(32, 201, 151, 0.1);
            color: #20c997;
            border: 1px solid rgba(32, 201, 151, 0.2);
        }
        
        .type-casque {
            background-color: rgba(214, 51, 132, 0.1);
            color: #d63384;
            border: 1px solid rgba(214, 51, 132, 0.2);
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
        .statut_En_service:hover {
            background-color: rgba(40, 167, 69, 0.05) !important;
        }
        
        .statut_En_stock:hover {
            background-color: rgba(13, 110, 253, 0.05) !important;
        }
        
        .statut_Hors_service:hover {
            background-color: rgba(220, 53, 69, 0.05) !important;
        }
        
        .statut_En_maintenance:hover {
            background-color: rgba(255, 193, 7, 0.05) !important;
        }
    </style>
@endpush