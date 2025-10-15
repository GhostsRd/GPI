<div>
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Gestion des Logiciels</h1>
                    <button wire:click="create" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nouveau Logiciel
                    </button>
                </div>
            </div>
        </div>

        <!-- Cartes de statistiques -->
        <div class="col-md-12 text-end">
    <div class="row">
        <div class="col-xl-3 col-md-3 mb-3">
            <div class="card stats-widget border-0 shadow-sm dark-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-dark mb-1">{{ $stats['total'] }}</h3>
                            <p class="stats-label text-dark mb-0">Total Logiciels</p>
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

        <div class="col-xl-3 col-md-3 mb-3">
            <div class="card stats-widget border-0 shadow-sm dark-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-dark mb-1">{{ $stats['licences_critiques'] }}</h3>
                            <p class="stats-label text-dark mb-0">Licences Critiques</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar-sm rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center">
                                <i class="fas fa-exclamation-triangle fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-3 mb-3">
            <div class="card stats-widget border-0 shadow-sm dark-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-dark mb-1">{{ $stats['total_installations'] }}</h3>
                            <p class="stats-label text-dark mb-0">Installations</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar-sm rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center">
                                <i class="fas fa-download fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-3 mb-3">
            <div class="card stats-widget border-0 shadow-sm dark-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <h3 class="stats-number text-dark mb-1">{{ $stats['total_licences'] }}</h3>
                            <p class="stats-label text-dark mb-0">Licences Disponibles</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="avatar-sm rounded-circle bg-info bg-opacity-10 text-info d-flex align-items-center justify-content-center">
                                <i class="fas fa-key fa-lg"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


        <!-- Filtres et recherche -->
        <div class="card shadow mb-4">
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="search">Recherche</label>
                            <input type="text" class="form-control" id="search" wire:model.live="search" 
                                   placeholder="Nom, éditeur, version...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="editeur">Éditeur</label>
                            <select class="form-control" id="editeur" wire:model.live="editeur">
                                <option value="">Tous les éditeurs</option>
                                @foreach($editeurs as $editeur)
                                    <option value="{{ $editeur }}">{{ $editeur }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="systeme_exploitation">Système d'exploitation</label>
                            <select class="form-control" id="systeme_exploitation" wire:model.live="systeme_exploitation">
                                <option value="">Tous les systèmes</option>
                                @foreach($systemes as $systeme)
                                    <option value="{{ $systeme }}">{{ $systeme }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <button wire:click="resetFilters" class="btn btn-secondary btn-block">
                                Réinitialiser
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Messages flash -->
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Tableau des logiciels -->
        <div class="card shadow">
           
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th wire:click="sortBy('nom')" style="cursor: pointer;">
                                    Nom
                                    @if($sortField == 'nom')
                                        <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th>Éditeur</th>
                                <th>Version</th>
                                <th>Système d'exploitation</th>
                                <th wire:click="sortBy('nombre_installations')" style="cursor: pointer;">
                                    Installations
                                    @if($sortField == 'nombre_installations')
                                        <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th wire:click="sortBy('nombre_licences')" style="cursor: pointer;">
                                    Licences
                                    @if($sortField == 'nombre_licences')
                                        <i class="fas fa-sort-{{ $sortDirection == 'asc' ? 'up' : 'down' }}"></i>
                                    @endif
                                </th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logiciels as $logiciel)
                                <tr>
                                    <td>
                                        <strong>{{ $logiciel->nom }}</strong>
                                        @if($logiciel->description)
                                            <br><small class="text-muted">{{ Str::limit($logiciel->description, 50) }}</small>
                                        @endif
                                    </td>
                                    <td>{{ $logiciel->editeur ?? 'N/A' }}</td>
                                    <td>{{ $logiciel->version_nom ?? 'N/A' }}</td>
                                    <td>{{ $logiciel->version_systeme_exploitation ?? 'N/A' }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-info">{{ $logiciel->nombre_installations }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-secondary">{{ $logiciel->nombre_licences }}</span>
                                    </td>
                                    <td>
                                        @php
                                            $statutClass = [
                                                'Normal' => 'success',
                                                'Attention' => 'warning',
                                                'Critique' => 'danger',
                                                'Aucune licence' => 'secondary'
                                            ][$logiciel->statut_licences];
                                        @endphp
                                        <span class="badge badge-{{ $statutClass }}">
                                            {{ $logiciel->statut_licences }}
                                            @if($logiciel->statut_licences != 'Aucune licence')
                                                ({{ $logiciel->pourcentage_utilisation }}%)
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button wire:click="edit({{ $logiciel->id }})" 
                                                   class="btn btn-warning" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button wire:click="confirmDelete({{ $logiciel->id }})" 
                                                   class="btn btn-danger" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">
                                        Aucun logiciel trouvé
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Affichage de {{ $logiciels->firstItem() }} à {{ $logiciels->lastItem() }} sur {{ $logiciels->total() }} résultats
                    </div>
                    {{ $logiciels->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de création/édition -->
    @if($showModal)
    <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $modalTitle }}</h5>
                    <button type="button" class="close" wire:click="$set('showModal', false)">
                        <span>&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nom">Nom du logiciel *</label>
                                    <input type="text" class="form-control" id="nom" wire:model="nom" required>
                                    @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editeur_form">Éditeur</label>
                                    <input type="text" class="form-control" id="editeur_form" wire:model="editeur_form">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="version_nom">Version</label>
                                    <input type="text" class="form-control" id="version_nom" wire:model="version_nom">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="version_systeme_exploitation">Système d'exploitation</label>
                                    <input type="text" class="form-control" id="version_systeme_exploitation" 
                                           wire:model="version_systeme_exploitation" placeholder="Windows, macOS, Linux...">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_installations">Nombre d'installations</label>
                                    <input type="number" class="form-control" id="nombre_installations" 
                                           wire:model="nombre_installations" min="0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre_licences">Nombre de licences</label>
                                    <input type="number" class="form-control" id="nombre_licences" 
                                           wire:model="nombre_licences" min="0">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_achat">Date d'achat</label>
                                    <input type="date" class="form-control" id="date_achat" wire:model="date_achat">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="date_expiration">Date d'expiration</label>
                                    <input type="date" class="form-control" id="date_expiration" wire:model="date_expiration">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" wire:model="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('showModal', false)">Annuler</button>
                        <button type="submit" class="btn btn-primary">
                            {{ $editing ? 'Modifier' : 'Créer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de confirmation de suppression -->
    @if($showDeleteModal)
    <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation de suppression</h5>
                    <button type="button" class="close" wire:click="$set('showDeleteModal', false)">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir supprimer ce logiciel ? Cette action est irréversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="$set('showDeleteModal', false)">Annuler</button>
                    <button type="button" class="btn btn-danger" wire:click="delete">Supprimer</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@push('styles')
<style>
    .table th {
        border-top: none;
        font-weight: 600;
    }
    .badge {
        font-size: 0.85em;
    }
    .btn-group-sm > .btn {
        padding: 0.25rem 0.5rem;
    }
    .modal {
        backdrop-filter: blur(2px);
    }
</style>
@endpush