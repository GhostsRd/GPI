<div class="compact-mode">
    <!-- En-tête avec statistiques -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="fw-bold">Inventaire des Équipements</h1>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm" wire:click="$set('importModal', true)">
                        <i class="fas fa-upload me-1"></i> Importer
                    </button>
                    <button class="btn btn-outline-success btn-sm" wire:click="export">
                        <i class="fas fa-download me-1"></i> Exporter
                    </button>
                    <button class="btn btn-primary btn-sm" wire:click="create">
                        <i class="fas fa-plus me-1"></i> Nouvel Équipement
                    </button>
                </div>
            </div>
        </div>

        <!-- Cartes de statistiques -->
        <div class="col-xl-3 col-md-6">
            <div class="card stats-widget border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-primary">{{ $stats['total'] }}</h3>
                            <p class="stats-label text-muted mb-0">Total Équipements</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar-sm rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center">
                                <i class="fas fa-boxes fa-lg"></i>
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
                            <h3 class="stats-number text-success">{{ $stats['en_stock'] }}</h3>
                            <p class="stats-label text-muted mb-0">En Stock</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar-sm rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center">
                                <i class="fas fa-warehouse fa-lg"></i>
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
                            <h3 class="stats-number text-warning">{{ $stats['en_pret'] }}</h3>
                            <p class="stats-label text-muted mb-0">En Prêt</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar-sm rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center">
                                <i class="fas fa-hand-holding fa-lg"></i>
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
                            <h3 class="stats-number text-danger">{{ $stats['en_maintenance'] }}</h3>
                            <p class="stats-label text-muted mb-0">En Maintenance</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar-sm rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center">
                                <i class="fas fa-tools fa-lg"></i>
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
                               class="form-control" placeholder="ID, Nom, Série, IP...">
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Statut</label>
                    <select wire:model.live="statut" class="form-select form-select-sm">
                        <option value="">Tous les statuts</option>
                        <option value="en_stock">En Stock</option>
                        <option value="en_pret">En Prêt</option>
                        <option value="en_maintenance">En Maintenance</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Type</label>
                    <select wire:model.live="type" class="form-select form-select-sm">
                        <option value="">Tous les types</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Emplacement</label>
                    <select wire:model.live="emplacement" class="form-select form-select-sm">
                        <option value="">Tous les emplacements</option>
                        @foreach($emplacements as $emplacement)
                            <option value="{{ $emplacement }}">{{ $emplacement }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Marque</label>
                    <select wire:model.live="marque" class="form-select form-select-sm">
                        <option value="">Toutes les marques</option>
                        @foreach($marques as $marque)
                            <option value="{{ $marque }}">{{ $marque }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="button" wire:click="$set(['search' => '', 'statut' => '', 'type' => '', 'emplacement' => '', 'marque' => ''])"
                            class="btn btn-outline-secondary btn-sm w-100" title="Réinitialiser les filtres">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages de succès/erreur -->
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tableau des équipements -->
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <thead class="bg-light">
                    <tr>
                        <th class="ps-3">ID</th>
                        <th>Nom Public</th>
                        <th>Emplacement</th>
                        <th>Marque/Modèle</th>
                        <th>Type</th>
                        <th>Série</th>
                        <th>Couleur</th>
                        <th>Technologie</th>
                        <th>IP</th>
                        <th>Date Entrée</th>
                        <th>Statut</th>
                        <th class="text-end pe-3">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($equipements as $equipement)
                        <tr>
                            <td class="ps-3 fw-medium">
                                <span class="badge bg-dark">{{ $equipement->identification }}</span>
                            </td>
                            <td class="fw-medium">{{ $equipement->nom_public }}</td>
                            <td>
                                <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                    {{ $equipement->emplacement }}
                                </span>
                            </td>
                            <td>
                                <div class="small">{{ $equipement->marque }}</div>
                                <div class="text-muted smaller">{{ $equipement->model }}</div>
                            </td>
                            <td>
                                <span class="badge bg-primary bg-opacity-10 text-primary">
                                    {{ $equipement->type }}
                                </span>
                            </td>
                            <td class="text-muted smaller">{{ $equipement->numero_serie }}</td>
                            <td>
                                <span class="badge bg-{{ $equipement->couleur == 'noir' ? 'dark' : 'info' }}">
                                    {{ ucfirst($equipement->couleur) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-warning bg-opacity-10 text-warning">
                                    {{ ucfirst($equipement->technologie_impression) }}
                                </span>
                            </td>
                            <td class="text-muted smaller">
                                @if($equipement->adresse_ip)
                                    <code>{{ $equipement->adresse_ip }}</code>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-muted smaller">
                                {{ $equipement->date_entree_stock->format('d/m/Y') }}
                            </td>
                            <td>
                                @php
                                    $statutColors = [
                                        'en_stock' => 'success',
                                        'en_pret' => 'warning',
                                        'en_maintenance' => 'danger'
                                    ];
                                    $statutLabels = [
                                        'en_stock' => 'Stock',
                                        'en_pret' => 'Prêt',
                                        'en_maintenance' => 'Maintenance'
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statutColors[$equipement->statut] }}">
                                    {{ $statutLabels[$equipement->statut] }}
                                </span>
                            </td>
                            <td class="text-end pe-3">
                                <div class="btn-group btn-group-sm">
                                    <button wire:click="edit({{ $equipement->id }})"
                                            class="btn btn-outline-primary btn-sm"
                                            title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="delete({{ $equipement->id }})"
                                            class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?')"
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center py-4 text-muted">
                                <i class="fas fa-box-open fa-2x mb-2 d-block"></i>
                                Aucun équipement trouvé
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
        {{ $equipements->links() }}
    </div>
</div>

<!-- Modal Création/Édition -->
@if($showModal)
    <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" wire:click="closeModal">
        <div class="modal-dialog modal-lg" wire:click.stop>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $modalTitle }}</h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Identification *</label>
                                <input type="text" class="form-control form-control-sm" wire:model="identification">
                                @error('identification') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nom Public *</label>
                                <input type="text" class="form-control form-control-sm" wire:model="nom_public">
                                @error('nom_public') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Emplacement *</label>
                                <input type="text" class="form-control form-control-sm" wire:model="emplacement_form">
                                @error('emplacement_form') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Marque *</label>
                                <input type="text" class="form-control form-control-sm" wire:model="marque_form">
                                @error('marque_form') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Modèle *</label>
                                <input type="text" class="form-control form-control-sm" wire:model="model_form">
                                @error('model_form') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Type *</label>
                                <input type="text" class="form-control form-control-sm" wire:model="type_form">
                                @error('type_form') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Numéro de Série</label>
                                <input type="text" class="form-control form-control-sm" wire:model="numero_serie">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Couleur *</label>
                                <select class="form-select form-select-sm" wire:model="couleur">
                                    <option value="noir">Noir</option>
                                    <option value="blanc">Blanc</option>
                                    <option value="gris">Gris</option>
                                </select>
                                @error('couleur') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Technologie Impression</label>
                                <input type="text" class="form-control form-control-sm" wire:model="technologie_impression">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Référence Cartouche</label>
                                <input type="text" class="form-control form-control-sm" wire:model="reference_cartouche">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Date Entrée Stock *</label>
                                <input type="date" class="form-control form-control-sm" wire:model="date_entree_stock">
                                @error('date_entree_stock') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Adresse IP</label>
                                <input type="text" class="form-control form-control-sm" wire:model="adresse_ip">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Statut *</label>
                                <select class="form-select form-select-sm" wire:model="statut_form">
                                    <option value="en_stock">En Stock</option>
                                    <option value="en_pret">En Prêt</option>
                                    <option value="en_maintenance">En Maintenance</option>
                                </select>
                                @error('statut_form') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Description</label>
                                <textarea class="form-control form-control-sm" rows="3" wire:model="description"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Annuler</button>
                            <button type="submit" class="btn btn-primary">
                                {{ $editingId ? 'Modifier' : 'Créer' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif

