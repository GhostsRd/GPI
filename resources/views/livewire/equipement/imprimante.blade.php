<div>
    <!-- Container pour les notifications -->
   

    <div class="container-fluid py-3">
        <!-- Header -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h1 class="h4 fw-semibold text-dark mb-0">
    <i class="bi bi-printer me-2 text-primary"></i> Gestion des Imprimantes
</h1>
                        <p class="text-muted small">Gestion du parc d'imprimantes de l'entreprise</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <button class="btn btn-outline-primary btn-sm d-flex align-items-center" wire:click="toggleStats">
                            <i class="fas fa-chart-bar me-1"></i>
                            {{ $showStats ? 'Masquer' : 'Afficher' }} stats
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Message flash -->
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
        <div class="row mb-3">
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon icon-primary me-3">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <div>
                            <h3 class="stat-number mb-0">{{ $stats['total'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0">Total</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon icon-success me-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <h3 class="stat-number mb-0">{{ $stats['en_service'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0">En service</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon icon-warning me-3">
                            <i class="fas fa-tools"></i>
                        </div>
                        <div>
                            <h3 class="stat-number mb-0">{{ $stats['en_maintenance'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0">En maintenance</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon icon-info me-3">
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <div>
                            <h3 class="stat-number mb-0">{{ $stats['en_stock'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0">En stock</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-3">
                <div class="dashboard-card stat-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon icon-danger me-3">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div>
                            <h3 class="stat-number mb-0">{{ $stats['hors_service'] ?? 0 }}</h3>
                            <p class="text-muted small mb-0">Hors service</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Filtres avec boutons Import/Export -->
        <div class="dashboard-card p-3 mb-3">
            <div class="row g-2 align-items-end">
                <div class="col-md-2">
                    <label class="form-label small fw-medium">Recherche</label>
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" wire:model.live.debounce.300ms="search"
                               class="form-control form-control-sm" placeholder="Nom, modèle, IP...">
                    </div>
                </div>

                <div class="col-md-2">
                    <label class="form-label small fw-medium">Statut</label>
                    <select wire:model.live="statut" class="form-select form-select-sm">
                        <option value="">Tous</option>
                        @foreach($statuts as $statutOption)
                            <option value="{{ $statutOption }}">{{ $statutOption }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label small fw-medium">Fabricant</label>
                    <select wire:model.live="fabricant" class="form-select form-select-sm">
                        <option value="">Tous</option>
                        @foreach($fabricants as $fabricantOption)
                            <option value="{{ $fabricantOption }}">{{ $fabricantOption }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label small fw-medium">Entité</label>
                    <select wire:model.live="entite" class="form-select form-select-sm">
                        <option value="">Toutes</option>
                        @foreach($entites as $entiteOption)
                            <option value="{{ $entiteOption }}">{{ $entiteOption }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Boutons d'action -->
                <div class="col-md-4">
                    <div class="d-flex gap-2 flex-wrap">
                        <button wire:click="resetFilters" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-redo me-1"></i> RàZ
                        </button>
                        <button wire:click="openImportModal" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-file-import me-1"></i> Importer
                        </button>
                        <button wire:click="exportToCsv" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-file-export me-1"></i> Exporter
                        </button>
                        <button wire:click="create" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Ajouter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sélection multiple -->
            @if(count($selectedImprimantes) > 0)
            <div class="row mt-3">
                <div class="col-12">
                    <div class="alert alert-info py-2 small">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fas fa-check-circle me-2"></i>
                                {{ count($selectedImprimantes) }} imprimante(s) sélectionnée(s)
                            </span>
                            <div class="d-flex gap-2">
                                <button wire:click="deleteSelected" 
                                        wire:confirm="Êtes-vous sûr de vouloir supprimer les {{ count($selectedImprimantes) }} imprimantes sélectionnées ?"
                                        class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash me-1"></i> Supprimer
                                </button>
                                <button wire:click="$set('selectedImprimantes', [])" 
                                        class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-times me-1"></i> Annuler
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Tableau -->
        <div class="dashboard-card p-3">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <h5 class="fw-semibold mb-0">Liste des Imprimantes</h5>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th width="50">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           wire:model="selectAll"
                                           id="selectAll">
                                </div>
                            </th>
                            <th wire:click="sortBy('nom')" style="cursor: pointer;">
                                Nom
                                @if ($sortField === 'nom')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort text-muted small"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('entite')" style="cursor: pointer;">
                                Entité
                                @if ($sortField === 'entite')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort text-muted small"></i>
                                @endif
                            </th>
                            <th wire:click="sortBy('statut')" style="cursor: pointer;">
                                Statut
                                @if ($sortField === 'statut')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort text-muted small"></i>
                                @endif
                            </th>
                            <th>Fabricant</th>
                            <th>IP</th>
                            <th>Série</th>
                            <th>Lieu</th>
                            <th>Type</th>
                            <th>Modèle</th>
                            <th wire:click="sortBy('updated_at')" style="cursor: pointer;">
                                Dernière modif.
                                @if ($sortField === 'updated_at')
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                @else
                                    <i class="fas fa-sort text-muted small"></i>
                                @endif
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($imprimantes as $imprimante)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" 
                                           value="{{ $imprimante->id }}"
                                           wire:model="selectedImprimantes"
                                           id="imprimante_{{ $imprimante->id }}">
                                </div>
                            </td>
                            <td class="fw-medium small">{{ $imprimante->nom }}</td>
                            <td class="small">{{ $imprimante->entite }}</td>
                            <td>
                                @php
                                    $statusClasses = [
                                        'En service' => 'badge bg-success badge-sm',
                                        'En maintenance' => 'badge bg-warning badge-sm',
                                        'Hors service' => 'badge bg-danger badge-sm',
                                        'En stock' => 'badge bg-info badge-sm'
                                    ];
                                @endphp
                                <span class="{{ $statusClasses[$imprimante->statut] ?? 'badge bg-secondary badge-sm' }}">
                                    {{ $imprimante->statut }}
                                </span>
                            </td>
                            <td class="small">{{ $imprimante->fabricant }}</td>
                            <td class="small font-monospace">{{ $imprimante->reseau_ip }}</td>
                            <td class="small font-monospace">{{ $imprimante->numero_serie }}</td>
                            <td class="small">{{ $imprimante->lieu }}</td>
                            <td class="small">{{ $imprimante->type }}</td>
                            <td class="small">{{ $imprimante->modele }}</td>
                            <td class="small">{{ $imprimante->updated_at->format('d/m/Y H:i') }}</td>
                           
                                
   <td>
    <div class="d-flex gap-1">
        <!-- Bouton Voir Détails -->
        <button wire:click="showDetails({{ $imprimante->id }})"
                class="btn btn-sm btn-outline-info border-0"
                title="Voir détails">
            <i class="bi bi-eye"></i>
        </button>
        <!-- Bouton Modifier -->
        <button wire:click="edit({{ $imprimante->id }})"
                class="btn btn-sm btn-outline-primary border-0"
                title="Modifier">
            <i class="bi bi-pencil"></i>
        </button>
        <!-- Bouton Fichiers -->
        <!-- Bouton Supprimer -->
        <button wire:click="confirmDelete({{ $imprimante->id }})"
                class="btn btn-sm btn-outline-danger border-0"
                title="Supprimer">
            <i class="bi bi-trash"></i>
        </button>
    </div>
</td>

                           
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center py-3">
                                <i class="fas fa-print display-6 text-muted d-block mb-2"></i>
                                <p class="text-muted mb-0 small">Aucune imprimante trouvée</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted small">
                    @if($imprimantes->count() > 0)
                        Affichage de {{ $imprimantes->firstItem() }} à {{ $imprimantes->lastItem() }} sur {{ $imprimantes->total() }} imprimantes
                    @else
                        Aucune imprimante
                    @endif
                </div>
                {{ $imprimantes->links() }}
            </div>
        </div>
    </div>

    <!-- Modal pour créer/modifier une imprimante -->
    @if($showModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas {{ $isEditing ? 'fa-edit' : 'fa-plus' }} me-2"></i>
                        {{ $isEditing ? 'Modifier l\'imprimante' : 'Nouvelle Imprimante' }}
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeModal"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row g-3">
                            <!-- Colonne gauche -->
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="nom" class="form-label small">Nom de l'imprimante *</label>
                                    <input type="text" class="form-control form-control-sm @error('nom') is-invalid @enderror"
                                           id="nom" wire:model="nom" required>
                                    @error('nom') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="entite_form" class="form-label small">Entité</label>
                                    <input type="text" class="form-control form-control-sm @error('entite_form') is-invalid @enderror"
                                           id="entite_form" wire:model="entite_form" placeholder="Service, département...">
                                    @error('entite_form') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="statut_form" class="form-label small">Statut *</label>
                                    <select class="form-select form-select-sm @error('statut_form') is-invalid @enderror"
                                            id="statut_form" wire:model="statut_form" required>
                                        <option value="">Sélectionner un statut</option>
                                        @foreach($statuts as $statutOption)
                                            <option value="{{ $statutOption }}">{{ $statutOption }}</option>
                                        @endforeach
                                    </select>
                                    @error('statut_form') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="fabricant_form" class="form-label small">Fabricant</label>
                                    <input type="text" class="form-control form-control-sm @error('fabricant_form') is-invalid @enderror"
                                           id="fabricant_form" wire:model="fabricant_form" placeholder="HP, Canon, Epson...">
                                    @error('fabricant_form') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="numero_serie" class="form-label small">Numéro de série</label>
                                    <input type="text" class="form-control form-control-sm @error('numero_serie') is-invalid @enderror"
                                           id="numero_serie" wire:model="numero_serie">
                                    @error('numero_serie') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Colonne droite -->
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <label for="modele" class="form-label small">Modèle</label>
                                    <input type="text" class="form-control form-control-sm @error('modele') is-invalid @enderror"
                                           id="modele" wire:model="modele" placeholder="Modèle de l'imprimante">
                                    @error('modele') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="type" class="form-label small">Type</label>
                                    <select class="form-select form-select-sm @error('type') is-invalid @enderror"
                                            id="type" wire:model="type">
                                        <option value="">Sélectionner un type</option>
                                        @foreach($types as $typeOption)
                                            <option value="{{ $typeOption }}">{{ $typeOption }}</option>
                                        @endforeach
                                    </select>
                                    @error('type') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="reseau_ip" class="form-label small">Adresse IP</label>
                                    <input type="text" class="form-control form-control-sm @error('reseau_ip') is-invalid @enderror"
                                           id="reseau_ip" wire:model="reseau_ip" placeholder="192.168.1.100">
                                    @error('reseau_ip') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="lieu" class="form-label small">Lieu</label>
                                    <input type="text" class="form-control form-control-sm @error('lieu') is-invalid @enderror"
                                           id="lieu" wire:model="lieu" placeholder="Bureau, étage...">
                                    @error('lieu') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-2">
                                    <label for="commentaires" class="form-label small">Commentaires</label>
                                    <textarea class="form-control form-control-sm @error('commentaires') is-invalid @enderror"
                                              id="commentaires" wire:model="commentaires" rows="3"
                                              placeholder="Notes supplémentaires..."></textarea>
                                    @error('commentaires') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModal">Annuler</button>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <span wire:loading.remove>{{ $isEditing ? 'Modifier' : 'Créer' }}</span>
                            <span wire:loading>
                                <i class="fas fa-spinner fa-spin me-1"></i>
                                {{ $isEditing ? 'Modification...' : 'Création...' }}
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de détails de l'imprimante -->
    @if($showDetailsModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-info-circle me-2"></i>Détails de l'Imprimante
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeDetailsModal"></button>
                </div>
                <div class="modal-body">
                    @if($selectedImprimante)
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-print me-1"></i>Nom</strong>
                                    <p class="mb-0 small">{{ $selectedImprimante->nom }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-building me-1"></i>Entité</strong>
                                    <p class="mb-0 small">{{ $selectedImprimante->entite ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-circle me-1"></i>Statut</strong>
                                    <p class="mb-0">
                                        @php
                                            $statusClasses = [
                                                'En service' => 'badge bg-success badge-sm',
                                                'En maintenance' => 'badge bg-warning badge-sm',
                                                'Hors service' => 'badge bg-danger badge-sm',
                                                'En stock' => 'badge bg-info badge-sm'
                                            ];
                                        @endphp
                                        <span class="{{ $statusClasses[$selectedImprimante->statut] ?? 'badge bg-secondary badge-sm' }}">
                                            {{ $selectedImprimante->statut }}
                                        </span>
                                    </p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-industry me-1"></i>Fabricant</strong>
                                    <p class="mb-0 small">{{ $selectedImprimante->fabricant ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-barcode me-1"></i>Numéro de série</strong>
                                    <p class="mb-0 small font-monospace">{{ $selectedImprimante->numero_serie ?? 'Non renseigné' }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-cube me-1"></i>Modèle</strong>
                                    <p class="mb-0 small">{{ $selectedImprimante->modele ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-tag me-1"></i>Type</strong>
                                    <p class="mb-0 small">{{ $selectedImprimante->type ?? 'Non spécifié' }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-network-wired me-1"></i>Adresse IP</strong>
                                    <p class="mb-0 small font-monospace">{{ $selectedImprimante->reseau_ip ?? 'Non configurée' }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-map-marker-alt me-1"></i>Lieu</strong>
                                    <p class="mb-0 small">{{ $selectedImprimante->lieu ?? 'Non spécifié' }}</p>
                                </div>

                                @if($selectedImprimante->commentaires)
                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-comment me-1"></i>Commentaires</strong>
                                    <p class="mb-0 small">{{ $selectedImprimante->commentaires }}</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-calendar-plus me-1"></i>Date de création</strong>
                                    <p class="mb-0 small">{{ $selectedImprimante->created_at->format('d/m/Y à H:i') }}</p>
                                </div>

                                <div class="detail-item mb-2">
                                    <strong class="small"><i class="fas fa-calendar-check me-1"></i>Dernière modification</strong>
                                    <p class="mb-0 small">{{ $selectedImprimante->updated_at->format('d/m/Y à H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-exclamation-triangle display-6 text-warning d-block mb-2"></i>
                            <p class="text-muted small">Impossible de charger les détails de l'imprimante.</p>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="closeDetailsModal">Fermer</button>
                    @if($selectedImprimante)
                        <button type="button" class="btn btn-primary btn-sm" wire:click="edit({{ $selectedImprimante->id }})">
                            <i class="fas fa-edit me-1"></i>Modifier
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de confirmation de suppression -->
    @if($confirmingDelete)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation de suppression</h5>
                    <button type="button" class="btn-close" wire:click="closeDeleteModal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle text-danger display-5"></i>
                        <h4 class="mt-2 h5">Êtes-vous sûr ?</h4>
                        <p class="text-muted small">
                            Vous êtes sur le point de supprimer l'imprimante <strong>{{ $selectedImprimanteName }}</strong>. 
                            Cette action est irréversible.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="closeDeleteModal">Annuler</button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="deleteConfirmed">
                        <i class="fas fa-trash me-1"></i>Supprimer
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
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-file-import me-2"></i>Importer des Imprimantes
                    </h5>
                    <button type="button" class="btn-close" wire:click="closeImportModal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info small">
                        <i class="fas fa-info-circle me-2"></i>
                        Formats supportés: Excel (.xlsx, .xls), CSV. Taille max: 10MB
                    </div>
                    
                    <div class="mb-2">
                        <label class="form-label small">Fichier à importer</label>
                        <input type="file" wire:model="importFile" class="form-control form-control-sm" accept=".xlsx,.xls,.csv">
                        @error('importFile') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>

                    @if($importErrors)
                    <div class="alert alert-danger small">
                        <h6 class="alert-heading">Erreurs d'importation</h6>
                        <ul class="mb-0">
                            @foreach($importErrors as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if($importSuccessCount > 0)
                    <div class="alert alert-success small">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ $importSuccessCount }} imprimante(s) importé(s) avec succès !
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="closeImportModal">Annuler</button>
                    <button type="button" class="btn btn-primary btn-sm" wire:click="importImprimantes" 
                            wire:loading.attr="disabled" {{ !$importFile ? 'disabled' : '' }}>
                        <i class="fas fa-file-import me-1"></i>
                        <span wire:loading.remove>Importer</span>
                        <span wire:loading>Import en cours...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --dark-green: #3D3E14;
            --turquoise: #66C0B7;
            --off-white: #EDEDE8;
            --orange: #E35E2F;
            --soft-green: #83AF4F;
        }
        
        .dashboard-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.2s ease;
        }
        
        .dashboard-card:hover {
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        
        .stat-card {
            padding: 16px;
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        
        .icon-primary { background: rgba(131, 175, 79, 0.1); color: var(--soft-green); }
        .icon-success { background: rgba(102, 192, 183, 0.1); color: var(--turquoise); }
        .icon-warning { background: rgba(227, 94, 47, 0.1); color: var(--orange); }
        .icon-info { background: rgba(61, 62, 20, 0.1); color: var(--dark-green); }
        .icon-danger { background: rgba(220, 53, 69, 0.1); color: #dc3545; }
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 0.9rem;
        }
        
        .search-box .form-control {
            padding-left: 30px;
            font-size: 0.875rem;
        }
        
        .action-btn {
            border: none;
            background: none;
            padding: 4px 6px;
            border-radius: 4px;
            margin: 0 1px;
            transition: background-color 0.2s;
            font-size: 0.9rem;
        }
        
        .btn-view { color: var(--turquoise); }
        .btn-edit { color: var(--orange); }
        .btn-delete { color: #dc3545; }
        .btn-secondary { color: #6c757d; }
        
        .action-btn:hover {
            background: #f8f9fa;
        }
        
        .badge-sm {
            font-size: 0.7rem;
            padding: 0.25em 0.5em;
        }
        
        .table th {
            font-size: 0.8rem;
            font-weight: 600;
            color: #495057;
            border-bottom: 1px solid #dee2e6;
        }
        
        .table td {
            font-size: 0.8rem;
            vertical-align: middle;
        }
        
        .btn {
            font-size: 0.8rem;
        }
        
        .form-label {
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .modal-title {
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .detail-item {
            padding: 0.25rem 0;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-item strong {
            color: #495057;
            display: flex;
            align-items: center;
            margin-bottom: 0.125rem;
        }
        
        /* Styles pour centrer les modales */
        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
        }
        
        .modal-backdrop {
            z-index: 1040;
        }
        
        .modal {
            z-index: 1050;
        }
    </style>
</div>