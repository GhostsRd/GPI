<!-- resources/views/livewire/equipement/imprimante.blade.php -->

<div class="ticket-dashboard">
    <div class="dashboard-container">

        <!-- En-tête -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h4 fw-bold text-dark mb-0">
                <i class="fas fa-print me-2 text-primary"></i> Gestion des Imprimantes
            </h1>
            <button wire:click="create" class="btn btn-primary btn-sm shadow-sm">
                <i class="fas fa-plus me-2"></i> Nouvelle Imprimante
            </button>
        </div>

        <!-- Message flash -->
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        <!-- Statistiques -->
        <div class="row mb-4">
            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card stats-widget border-0 shadow-sm dark-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-primary mb-1">{{ $stats['total'] }}</h3>
                            <p class="stats-label text-black mb-0">Total</p>
                        </div>
                        <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                            <i class="fas fa-chart-pie fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card stats-widget border-0 shadow-sm dark-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-success mb-1">{{ $stats['en_service'] }}</h3>
                            <p class="stats-label text-black mb-0">En service</p>
                        </div>
                        <div class="avatar-sm rounded-circle bg-success bg-opacity-25 text-success d-flex align-items-center justify-content-center">
                            <i class="fas fa-check-circle fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card stats-widget border-0 shadow-sm dark-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-warning mb-1">{{ $stats['en_maintenance'] }}</h3>
                            <p class="stats-label text-black mb-0">En maintenance</p>
                        </div>
                        <div class="avatar-sm rounded-circle bg-warning bg-opacity-25 text-warning d-flex align-items-center justify-content-center">
                            <i class="fas fa-tools fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card stats-widget border-0 shadow-sm dark-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-info mb-1">{{ $stats['en_stock'] }}</h3>
                            <p class="stats-label text-black mb-0">En stock</p>
                        </div>
                        <div class="avatar-sm rounded-circle bg-info bg-opacity-25 text-info d-flex align-items-center justify-content-center">
                            <i class="fas fa-warehouse fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-4 mb-3">
                <div class="card stats-widget border-0 shadow-sm dark-card">
                    <div class="card-body d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-danger mb-1">{{ $stats['hors_service'] }}</h3>
                            <p class="stats-label text-black mb-0">Hors service</p>
                        </div>
                        <div class="avatar-sm rounded-circle bg-danger bg-opacity-25 text-danger d-flex align-items-center justify-content-center">
                            <i class="fas fa-times-circle fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Recherche</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-transparent">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" wire:model.live.debounce.300ms="search"
                                   class="form-control" placeholder="Nom, modèle, IP...">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Statut</label>
                        <select wire:model.live="filterStatut" class="form-select form-select-sm">
                            <option value="">Tous</option>
                            @foreach($statuts as $statut)
                                <option value="{{ $statut }}">{{ $statut }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Fabricant</label>
                        <select wire:model.live="filterFabricant" class="form-select form-select-sm">
                            <option value="">Tous</option>
                            @foreach($fabricants as $fabricant)
                                <option value="{{ $fabricant }}">{{ $fabricant }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Entité</label>
                        <select wire:model.live="filterEntite" class="form-select form-select-sm">
                            <option value="">Toutes</option>
                            @foreach($entites as $entite)
                                <option value="{{ $entite }}">{{ $entite }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button wire:click="resetFilters" class="btn btn-secondary btn-sm w-100">
                            <i class="fas fa-redo me-2"></i> Réinitialiser
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th wire:click="sortBy('nom')" class="text-uppercase small fw-bold cursor-pointer">
                                    Nom
                                    @if ($sortField === 'nom')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @else
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    @endif
                                </th>
                                <th wire:click="sortBy('entite')" class="text-uppercase small fw-bold cursor-pointer">
                                    Entité
                                    @if ($sortField === 'entite')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @else
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    @endif
                                </th>
                                <th wire:click="sortBy('statut')" class="text-uppercase small fw-bold cursor-pointer">
                                    Statut
                                    @if ($sortField === 'statut')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @else
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    @endif
                                </th>
                                <th>Fabricant</th>
                                <th>IP</th>
                                <th>Série</th>
                                <th>Lieu</th>
                                <th>Type</th>
                                <th>Modèle</th>
                                <th wire:click="sortBy('updated_at')" class="text-uppercase small fw-bold cursor-pointer">
                                    Dernière modif.
                                    @if ($sortField === 'updated_at')
                                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                                    @else
                                        <i class="fas fa-sort ms-1 text-muted"></i>
                                    @endif
                                </th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($imprimantes as $imprimante)
                                <tr>
                                    <td class="fw-semibold">{{ $imprimante->nom }}</td>
                                    <td>{{ $imprimante->entite }}</td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'En service' => 'badge bg-success bg-opacity-25 text-success',
                                                'En maintenance' => 'badge bg-warning bg-opacity-25 text-warning',
                                                'Hors service' => 'badge bg-danger bg-opacity-25 text-danger',
                                                'En stock' => 'badge bg-info bg-opacity-25 text-info'
                                            ];
                                        @endphp
                                        <span class="{{ $statusClasses[$imprimante->statut] ?? 'badge bg-secondary' }}">
                                            {{ $imprimante->statut }}
                                        </span>
                                    </td>
                                    <td>{{ $imprimante->fabricant }}</td>
                                    <td class="font-monospace">{{ $imprimante->reseau_ip }}</td>
                                    <td class="font-monospace">{{ $imprimante->numero_serie }}</td>
                                    <td>{{ $imprimante->lieu }}</td>
                                    <td>{{ $imprimante->type }}</td>
                                    <td>{{ $imprimante->modele }}</td>
                                    <td>{{ $imprimante->updated_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button wire:click="edit({{ $imprimante->id }})" 
                                                    class="btn btn-sm btn-outline-primary"
                                                    title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button wire:click="confirmDelete({{ $imprimante->id }})"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center text-muted py-3">Aucune imprimante trouvée.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $imprimantes->links() }}
        </div>
    </div>

    <!-- Modal pour créer/modifier une imprimante -->
    <div class="modal fade" id="imprimanteModal" tabindex="-1" aria-labelledby="imprimanteModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imprimanteModalLabel">
                        {{ $isEditing ? 'Modifier l\'imprimante' : 'Nouvelle Imprimante' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                    <div class="modal-body">
                        <div class="row g-3">
                            <!-- Colonne gauche -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom de l'imprimante *</label>
                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                           id="nom" wire:model="nom" required>
                                    @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="entite" class="form-label">Entité *</label>
                                    <select class="form-select @error('entite') is-invalid @enderror" 
                                            id="entite" wire:model="entite" required>
                                        <option value="">Sélectionner une entité</option>
                                        @foreach($entites as $entiteOption)
                                            <option value="{{ $entiteOption }}">{{ $entiteOption }}</option>
                                        @endforeach
                                    </select>
                                    @error('entite') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="statut" class="form-label">Statut *</label>
                                    <select class="form-select @error('statut') is-invalid @enderror" 
                                            id="statut" wire:model="statut" required>
                                        <option value="">Sélectionner un statut</option>
                                        @foreach($statuts as $statutOption)
                                            <option value="{{ $statutOption }}">{{ $statutOption }}</option>
                                        @endforeach
                                    </select>
                                    @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="fabricant" class="form-label">Fabricant *</label>
                                    <select class="form-select @error('fabricant') is-invalid @enderror" 
                                            id="fabricant" wire:model="fabricant" required>
                                        <option value="">Sélectionner un fabricant</option>
                                        @foreach($fabricants as $fabricantOption)
                                            <option value="{{ $fabricantOption }}">{{ $fabricantOption }}</option>
                                        @endforeach
                                    </select>
                                    @error('fabricant') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="modele" class="form-label">Modèle *</label>
                                    <input type="text" class="form-control @error('modele') is-invalid @enderror" 
                                           id="modele" wire:model="modele" required>
                                    @error('modele') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <!-- Colonne droite -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Type *</label>
                                    <select class="form-select @error('type') is-invalid @enderror" 
                                            id="type" wire:model="type" required>
                                        <option value="">Sélectionner un type</option>
                                        <option value="Laser">Laser</option>
                                        <option value="Jet d'encre">Jet d'encre</option>
                                        <option value="Multifonction">Multifonction</option>
                                        <option value="Thermique">Thermique</option>
                                    </select>
                                    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="reseau_ip" class="form-label">Adresse IP</label>
                                    <input type="text" class="form-control @error('reseau_ip') is-invalid @enderror" 
                                           id="reseau_ip" wire:model="reseau_ip" placeholder="192.168.1.100">
                                    @error('reseau_ip') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="numero_serie" class="form-label">Numéro de série</label>
                                    <input type="text" class="form-control @error('numero_serie') is-invalid @enderror" 
                                           id="numero_serie" wire:model="numero_serie">
                                    @error('numero_serie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="lieu" class="form-label">Lieu</label>
                                    <input type="text" class="form-control @error('lieu') is-invalid @enderror" 
                                           id="lieu" wire:model="lieu" placeholder="Bureau, étage...">
                                    @error('lieu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="date_achat" class="form-label">Date d'achat</label>
                                    <input type="date" class="form-control @error('date_achat') is-invalid @enderror" 
                                           id="date_achat" wire:model="date_achat">
                                    @error('date_achat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" wire:model="notes" rows="3" 
                                      placeholder="Informations supplémentaires..."></textarea>
                            @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">
                            {{ $isEditing ? 'Modifier' : 'Créer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer l'imprimante <strong>{{ $selectedImprimanteName }}</strong> ?</p>
                    <p class="text-danger">Cette action est irréversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger" wire:click="delete" data-bs-dismiss="modal">
                        <i class="fas fa-trash me-2"></i>Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Gestion de l'ouverture/fermeture des modals
    document.addEventListener('livewire:initialized', () => {
        // Modal création/édition
        Livewire.on('showImprimanteModal', () => {
            const modal = new bootstrap.Modal(document.getElementById('imprimanteModal'));
            modal.show();
        });

        Livewire.on('hideImprimanteModal', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('imprimanteModal'));
            if (modal) {
                modal.hide();
            }
        });

        // Modal suppression
        Livewire.on('showDeleteModal', () => {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        });

        Livewire.on('hideDeleteModal', () => {
            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
            if (modal) {
                modal.hide();
            }
        });

        // Fermer les modals quand on navigue
        Livewire.on('modalClosed', () => {
            ['imprimanteModal', 'deleteModal'].forEach(modalId => {
                const modalElement = document.getElementById(modalId);
                if (modalElement) {
                    const modal = bootstrap.Modal.getInstance(modalElement);
                    if (modal) {
                        modal.hide();
                    }
                }
            });
        });
    });

    // Empêcher la fermeture du modal lors de la soumission
    document.addEventListener('livewire:submit', () => {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            const bsModal = bootstrap.Modal.getInstance(modal);
            if (bsModal) {
                bsModal._config.backdrop = 'static';
                bsModal._config.keyboard = false;
            }
        });
    });
</script>
@endpush