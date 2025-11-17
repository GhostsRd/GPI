<div>
    <!-- Section des statistiques -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stats-widget border-0 shadow-sm dark-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-primary">{{ $totalCheckouts ?? 0 }}</h3>
                            <p class="stats-label text-black mb-0">Total Checkouts</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                <i class="fas fa-shopping-cart fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stats-widget border-0 shadow-sm dark-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-warning">{{ $enCoursCheckouts ?? 0 }}</h3>
                            <p class="stats-label text-black mb-0">En Cours</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar-sm rounded-circle bg-warning bg-opacity-25 text-warning d-flex align-items-center justify-content-center">
                                <i class="fas fa-clock fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stats-widget border-0 shadow-sm dark-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-success">{{ $validerCheckouts ?? 0 }}</h3>
                            <p class="stats-label text-black mb-0">Validés</p>
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
            <div class="card stats-widget border-0 shadow-sm dark-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-danger">{{ $fermerCheckouts ?? 0 }}</h3>
                            <p class="stats-label text-black mb-0">Fermés</p>
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
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Recherche</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-transparent">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" wire:model.live="search"
                               class="form-control" placeholder="ID, Utilisateur, Type matériel...">
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Statut</label>
                    <select wire:model.live="statut" class="form-select form-select-sm">
                        <option value="">Tous les statuts</option>
                        <option value="1">En Cours</option>
                        <option value="2">Validé</option>
                        <option value="3">Fermé</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Type de matériel</label>
                    <select wire:model.live="type_materiel" class="form-select form-select-sm">
                        <option value="">Tous les types</option>
                        <option value="ordinateur">Ordinateur</option>
                        <option value="Telephone">Téléphone</option>
                        <option value="Peripherique">Périphérique</option>
                        <option value="Touche">Téléphone Touche</option>
                        <option value="Android">Téléphone Android</option>
                        <option value="Tablette">Tablette</option>
                        <option value="Regulateur">Régulateur</option>
                        <option value="Clavier">Clavier</option>
                        <option value="Souris">Souris</option>
                        <option value="Webcam">Webcam</option>
                        <option value="Casque">Casque</option>
                        <option value="Scanner">Scanner</option>
                        <option value="Cable">Câble</option>
                        <option value="USB">USB</option>
                        <option value="Jabra">Jabra</option>
                        <option value="Powerbank">Powerbank</option>
                        <option value="Chargeur">Chargeur</option>
                        <option value="APN">APN</option>
                        <option value="Appareil Photo">Appareil Photo</option>
                        <option value="Dominos">Dominos</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-bold">Période</label>
                    <select wire:model.live="periode" class="form-select form-select-sm">
                        <option value="">Toute période</option>
                        <option value="today">Aujourd'hui</option>
                        <option value="week">Cette semaine</option>
                        <option value="month">Ce mois</option>
                        <option value="year">Cette année</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <button type="button" wire:click="resetFilters"
                            class="btn btn-outline-secondary btn-sm w-100" title="Réinitialiser les filtres">
                        <i class="fa fa-times"></i> Reset
                    </button>
                </div>
                <div class="col-md-1">
                    <button wire:click="deleteSelected" class="btn btn-danger btn-sm w-100" title="Supprimer les checkouts sélectionnés"
                        {{ empty($selectedCheckouts) ? 'disabled' : '' }}>
                        <i class="fas fa-trash"></i>
                        ({{ count($selectedCheckouts) }})
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau des checkouts -->
    <div class="table-container border-0 shadow-sm fade-in-up">
        <div class="table-header">
            <div class="table-title">
                Liste des Checkouts
            </div>
        </div>

        <div class="table-wrapper p-0 border-0 w-100 compact-mode">
            @if($checkouts && $checkouts->count() > 0)
                <table class="table border-0 shadow-sm text-center">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                        </th>
                        <th wire:click="sortBy('id')" class="sortable">
                            Référence
                            @if($sortField === 'id')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort text-muted"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('utilisateur_id')" class="sortable">
                            Utilisateur
                            @if($sortField === 'utilisateur_id')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort text-muted"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('materiel_type')" class="sortable">
                            Type de matériel
                            @if($sortField === 'materiel_type')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort text-muted"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('materiel_details')" class="sortable">
                            Détails du matériel
                            @if($sortField === 'materiel_details')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort text-muted"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('statut')" class="sortable">
                            Statut
                            @if($sortField === 'statut')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort text-muted"></i>
                            @endif
                        </th>
                        <th>Matériel attribué</th>
                        <th wire:click="sortBy('created_at')" class="sortable">
                            Date de Sortie
                            @if($sortField === 'created_at')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort text-muted"></i>
                            @endif
                        </th>
                        <th wire:click="sortBy('updated_at')" class="sortable">
                            Date de Remise
                            @if($sortField === 'updated_at')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                            @else
                                <i class="fas fa-sort text-muted"></i>
                            @endif
                        </th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    @foreach($checkouts as $checkout)
                        <tr style="cursor:pointer">
                            <td>
                                <input type="checkbox"
                                       wire:model="selectedCheckouts"
                                       value="{{ $checkout->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">
                                #{{ $checkout->id }}
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})" class="text-muted">
                                {{ $checkout->utilisateur->nom ?? 'N/A' }}
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">
                                <span class="badge bg-light text-dark text-capitalize">
                                    {{ $checkout->materiel_type }}
                                </span>
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">
                                <small class="text-muted">{{ Str::limit($checkout->materiel_details, 30) }}</small>
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">
                                @if($checkout->statut == 1)
                                    <span class="badge bg-warning">En Cours</span>
                                @elseif($checkout->statut == 2)
                                    <span class="badge bg-success">Validé</span>
                                @else
                                    <span class="badge bg-danger">Fermé</span>
                                @endif
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">
                                @if($checkout->equipement_id)
                                    <span class="badge bg-info">ID: {{ $checkout->equipement_id }}</span>
                                @else
                                    <span class="badge bg-secondary">Non attribué</span>
                                @endif
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">
                                <small>{{ $checkout->created_at->format('d M Y H:i') }}</small>
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">
                                <small>{{ $checkout->updated_at->format('d M Y H:i') }}</small>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn-action btn-view" 
                                            onclick="window.location.href='{{ url('/admin/checkout-view-'.$checkout->id) }}'">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button wire:click="editCheckout({{ $checkout->id }})"
                                            class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $checkout->id }})"
                                            class="btn-action btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Aucun checkout trouvé</h5>
                    <p class="text-muted">Aucun checkout ne correspond à vos critères de recherche.</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($checkouts && $checkouts->hasPages())
            <div class="mt-4 container d-flex justify-content-center">
                {{ $checkouts->links() }}
            </div>
        @endif
    </div>
</div>