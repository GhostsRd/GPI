<
<div class="container-fluid">
    <!-- Alertes -->
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- En-tête -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="mb-0">
                    <i class="fas fa-mobile-alt me-2"></i>Gestion des Téléphones et Tablettes
                </h2>
                <button wire:click="create" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Nouvel équipement
                </button>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-md-2 col-6">
            <div class="card bg-primary text-white">
                <div class="card-body text-center p-3">
                    <h5 class="card-title mb-1">Total</h5>
                    <h3 class="mb-0">{{ $stats['total'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="card bg-success text-white">
                <div class="card-body text-center p-3">
                    <h5 class="card-title mb-1">En service</h5>
                    <h3 class="mb-0">{{ $stats['enService'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="card bg-info text-white">
                <div class="card-body text-center p-3">
                    <h5 class="card-title mb-1">En stock</h5>
                    <h3 class="mb-0">{{ $stats['enStock'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="card bg-warning text-white">
                <div class="card-body text-center p-3">
                    <h5 class="card-title mb-1">En réparation</h5>
                    <h3 class="mb-0">{{ $stats['enReparation'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="card bg-danger text-white">
                <div class="card-body text-center p-3">
                    <h5 class="card-title mb-1">Hors service</h5>
                    <h3 class="mb-0">{{ $stats['horsService'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-6">
            <div class="card bg-secondary text-white">
                <div class="card-body text-center p-3">
                    <h5 class="card-title mb-1">Téléphones</h5>
                    <h3 class="mb-0">{{ \App\Models\TelephoneTablette::where('type', 'Téléphone')->count() }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Recherche</label>
                    <input type="text" wire:model.live="search" class="form-control" 
                           placeholder="Nom, Usager, Série, Marque...">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Statut</label>
                    <select wire:model.live="filterStatut" class="form-select">
                        <option value="">Tous</option>
                        <option value="En service">En service</option>
                        <option value="En stock">En stock</option>
                        <option value="Hors service">Hors service</option>
                        <option value="En réparation">En réparation</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Type</label>
                    <select wire:model.live="filterType" class="form-select">
                        <option value="">Tous</option>
                        <option value="Téléphone">Téléphone</option>
                        <option value="Tablette">Tablette</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Par page</label>
                    <select wire:model.live="perPage" class="form-select">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <div class="text-muted small">
                        {{ $telephones->total() }} équipement(s) au total
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tableau -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="120">Nom</th>
                            <th width="100">Entité</th>
                            <th width="100">Usager</th>
                            <th width="120">Lieu</th>
                            <th width="80">Type</th>
                            <th width="120">Marque/Modèle</th>
                            <th width="120">Numéro Série</th>
                            <th width="100">Statut</th>
                            <th width="120" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($telephones as $telephone)
                        <tr>
                            <td>
                                <strong class="d-block">{{ $telephone->nom }}</strong>
                                @if($telephone->imei)
                                    <small class="text-muted">IMEI: {{ substr($telephone->imei, 0, 8) }}...</small>
                                @endif
                            </td>
                            <td>{{ $telephone->entite ?? '-' }}</td>
                            <td>{{ $telephone->usager ?? '-' }}</td>
                            <td>{{ $telephone->lieu }}</td>
                            <td>
                                <span class="badge bg-info">{{ $telephone->type }}</span>
                            </td>
                            <td>
                                <div class="small">{{ $telephone->marque }}</div>
                                <div class="text-muted small">{{ $telephone->modele }}</div>
                            </td>
                            <td>
                                <code class="small">{{ $telephone->numero_serie }}</code>
                            </td>
                            <td>
                                @php
                                    $badgeClass = [
                                        'En service' => 'bg-success',
                                        'En stock' => 'bg-primary',
                                        'Hors service' => 'bg-danger',
                                        'En réparation' => 'bg-warning'
                                    ][$telephone->statut];
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $telephone->statut }}</span>
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <button wire:click="edit({{ $telephone->id }})" 
                                            class="btn btn-outline-primary" 
                                            title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $telephone->id }})" 
                                            class="btn btn-outline-danger" 
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="fas fa-search fa-2x mb-3"></i>
                                    <p>Aucun équipement trouvé</p>
                                    @if($search || $filterStatut || $filterType)
                                        <button wire:click="$set(['search' => '', 'filterStatut' => '', 'filterType' => ''])" 
                                                class="btn btn-sm btn-outline-primary">
                                            Réinitialiser les filtres
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        @if($telephones->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Affichage de {{ $telephones->firstItem() }} à {{ $telephones->lastItem() }} 
                    sur {{ $telephones->total() }} équipement(s)
                </div>
                {{ $telephones->links() }}
            </div>
        </div>
        @endif
    </div>

    <!-- Modal Formulaire -->
    @if($showForm)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5)">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas {{ $isEditing ? 'fa-edit' : 'fa-plus' }} me-2"></i>
                        {{ $isEditing ? 'Modifier' : 'Ajouter' }} un équipement
                    </h5>
                    <button type="button" wire:click="closeForm" class="btn-close"></button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nom *</label>
                                    <input type="text" wire:model="nom" 
                                           class="form-control @error('nom') is-invalid @enderror">
                                    @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    <div class="form-text">Ex: TEL-IT-001, TAB-ADM-002</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Entité</label>
                                    <input type="text" wire:model="entite" 
                                           class="form-control @error('entite') is-invalid @enderror">
                                    @error('entite') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Usager</label>
                                    <input type="text" wire:model="usager" 
                                           class="form-control @error('usager') is-invalid @enderror">
                                    @error('usager') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Lieu *</label>
                                    <input type="text" wire:model="lieu" 
                                           class="form-control @error('lieu') is-invalid @enderror">
                                    @error('lieu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Type *</label>
                                    <select wire:model="type" 
                                            class="form-select @error('type') is-invalid @enderror">
                                        <option value="">Sélectionnez...</option>
                                        <option value="Téléphone">Téléphone</option>
                                        <option value="Tablette">Tablette</option>
                                    </select>
                                    @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Marque *</label>
                                    <input type="text" wire:model="marque" 
                                           class="form-control @error('marque') is-invalid @enderror">
                                    @error('marque') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Modèle *</label>
                                    <input type="text" wire:model="modele" 
                                           class="form-control @error('modele') is-invalid @enderror">
                                    @error('modele') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Numéro de série *</label>
                                    <input type="text" wire:model="numero_serie" 
                                           class="form-control @error('numero_serie') is-invalid @enderror">
                                    @error('numero_serie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Services/Plugins</label>
                                    <textarea wire:model="services" rows="2"
                                              class="form-control @error('services') is-invalid @enderror"></textarea>
                                    @error('services') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Statut *</label>
                                    <select wire:model="statut" 
                                            class="form-select @error('statut') is-invalid @enderror">
                                        <option value="En service">En service</option>
                                        <option value="En stock">En stock</option>
                                        <option value="Hors service">Hors service</option>
                                        <option value="En réparation">En réparation</option>
                                    </select>
                                    @error('statut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Emplacement actuel *</label>
                                    <input type="text" wire:model="emplacement_actuel" 
                                           class="form-control @error('emplacement_actuel') is-invalid @enderror">
                                    @error('emplacement_actuel') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">IMEI</label>
                                    <input type="text" wire:model="imei" 
                                           class="form-control @error('imei') is-invalid @enderror">
                                    @error('imei') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeForm" class="btn btn-secondary">Annuler</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>
                            {{ $isEditing ? 'Mettre à jour' : 'Créer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de suppression -->
    @if($showDeleteModal)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5)">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>Confirmation
                    </h5>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer cet équipement ?</p>
                    <p class="text-muted small">Cette action est irréversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="cancelDelete" class="btn btn-secondary">Annuler</button>
                    <button type="button" wire:click="delete" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Supprimer
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
