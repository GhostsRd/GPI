<div>
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1>
                    <i class="fas fa-desktop me-2"></i>Gestion des Moniteurs
                </h1>
                <p class="text-muted">Gérez votre parc de moniteurs informatiques</p>
            </div>
            <div class="col-md-6 text-end">
                <button wire:click="create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouveau Moniteur
                </button>
            </div>
        </div>
        
        @if($showStats)
       
            <div class="card-body">
                <div class="col-md-12 text-end">
    <div class="row">
        @foreach($statsGlobales as $statut => $count)
            <div class="col-xl-3 col-md-3 mb-3">
                <div class="card stats-widget border-0 shadow-sm dark-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-dark mb-1">{{ $count }}</h3>
                                <p class="stats-label text-dark mb-0">{{ ucfirst($statut) }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-light border text-dark d-flex align-items-center justify-content-center">
                                    @switch($statut)
                                        @case('En service')
                                            <i class="fas fa-check-circle fa-lg"></i>
                                            @break
                                        @case('En stock')
                                            <i class="fas fa-warehouse fa-lg"></i>
                                            @break
                                        @case('En réparation')
                                            <i class="fas fa-tools fa-lg"></i>
                                            @break
                                        @case('Hors service')
                                            <i class="fas fa-times-circle fa-lg"></i>
                                            @break
                                        @default
                                            <i class="fas fa-chart-bar fa-lg"></i>
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
                   
                    </div>
              
        </div>
        @endif

        <!-- Filtres -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="search" class="form-label">Recherche</label>
                        <input type="text" wire:model.debounce.300ms="search" class="form-control"
                               placeholder="Nom, n° série, fabricant...">
                    </div>
                    <div class="col-md-2">
                        <label for="statut" class="form-label">Statut</label>
                        <select wire:model="statut" class="form-select">
                            <option value="">Tous les statuts</option>
                            @foreach(['En service', 'En stock', 'Hors service', 'En réparation'] as $statut)
                                <option value="{{ $statut }}">{{ $statut }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="entite" class="form-label">Entité</label>
                        <select wire:model="entite" class="form-select">
                            <option value="">Toutes les entités</option>
                            @foreach($entitesList as $entite)
                                <option value="{{ $entite }}">{{ $entite }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="fabricant" class="form-label">Fabricant</label>
                        <select wire:model="fabricant" class="form-select">
                            <option value="">Tous les fabricants</option>
                            @foreach($fabricantsList as $fabricant)
                                <option value="{{ $fabricant }}">{{ $fabricant }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button wire:click="resetFilters" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i> Effacer
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des moniteurs -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-white">
                        <tr>
                            <th>Nom</th>
                            <th>Entité</th>
                            <th>Statut</th>
                            <th>Fabricant</th>
                            <th>Modèle</th>
                            <th>N° Série</th>
                            <th>Utilisateur</th>
                            <th>Usager</th>
                            <th>Lieu</th>
                            <th>Type</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($moniteurs as $moniteur)
                            <tr>
                                <td>
                                    <strong>{{ $moniteur->nom }}</strong>
                                    @if($moniteur->commentaires)
                                        <i class="fas fa-sticky-note text-warning ms-1" title="{{ $moniteur->commentaires }}"></i>
                                    @endif
                                </td>
                                <td>{{ $moniteur->entite ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $statutColor = match($moniteur->statut) {
                                            'En service' => 'success',
                                            'En stock' => 'info',
                                            'En réparation' => 'warning',
                                            'Hors service' => 'danger',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $statutColor }}">
                                        {{ $moniteur->statut }}
                                    </span>
                                </td>
                                <td>{{ $moniteur->fabricant ?? 'N/A' }}</td>
                                <td>{{ $moniteur->modele ?? 'N/A' }}</td>
                                <td>
                                    <code class="small">{{ $moniteur->numero_serie ?? 'N/A' }}</code>
                                </td>
                                <td>
                                    @if($moniteur->utilisateur)
                                        <span class="badge bg-primary">{{ $moniteur->utilisateur->name }}</span>
                                    @else
                                        <span class="text-muted">Non attribué</span>
                                    @endif
                                </td>
                                <td>
                                    @if($moniteur->usager)
                                        <span class="badge bg-secondary">{{ $moniteur->usager->name }}</span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $moniteur->lieu ?? 'N/A' }}</td>
                                <td>
                                    @if($moniteur->type)
                                        <span class="badge bg-light text-dark">{{ $moniteur->type }}</span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button wire:click="edit({{ $moniteur->id }})"
                                                class="btn btn-outline-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button wire:click="confirmDelete({{ $moniteur->id }})"
                                                class="btn btn-outline-danger" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center text-muted py-4">
                                    <i class="fas fa-desktop fa-2x mb-3 d-block"></i>
                                    Aucun moniteur trouvé
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $moniteurs->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de création/édition -->
    @if($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5)">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ $isEditing ? 'Modifier le moniteur' : 'Nouveau moniteur' }}
                        </h5>
                        <button type="button" wire:click="closeModal" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="{{ $isEditing ? 'update' : 'store' }}">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nom" class="form-label">Nom *</label>
                                    <input type="text" wire:model="nom" class="form-control @error('nom') is-invalid @enderror">
                                    @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="entite_form" class="form-label">Entité</label>
                                    <input type="text" wire:model="entite_form" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="statut_form" class="form-label">Statut *</label>
                                    <select wire:model="statut_form" class="form-select">
                                        @foreach($statuts as $statut)
                                            <option value="{{ $statut }}">{{ $statut }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="fabricant_form" class="form-label">Fabricant</label>
                                    <input type="text" wire:model="fabricant_form" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="numero_serie" class="form-label">Numéro de série</label>
                                    <input type="text" wire:model="numero_serie" class="form-control @error('numero_serie') is-invalid @enderror">
                                    @error('numero_serie') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="utilisateur_id" class="form-label">Utilisateur</label>
                                    <select wire:model="utilisateur_id" class="form-select">
                                        <option value="">Sélectionner un utilisateur</option>
                                        @foreach($utilisateurs as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="usager_id" class="form-label">Usager</label>
                                    <select wire:model="usager_id" class="form-select">
                                        <option value="">Sélectionner un usager</option>
                                        @foreach($utilisateurs as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="lieu" class="form-label">Lieu</label>
                                    <input type="text" wire:model="lieu" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label for="type" class="form-label">Type</label>
                                    <select wire:model="type" class="form-select">
                                        <option value="">Sélectionner un type</option>
                                        @foreach($types as $typeItem)
                                            <option value="{{ $typeItem }}">{{ $typeItem }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="modele" class="form-label">Modèle</label>
                                    <input type="text" wire:model="modele" class="form-control">
                                </div>

                                <div class="col-12">
                                    <label for="commentaires" class="form-label">Commentaires</label>
                                    <textarea wire:model="commentaires" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer mt-4">
                                <button type="button" wire:click="closeModal" class="btn btn-secondary">Annuler</button>
                                <button type="submit" class="btn btn-primary">
                                    {{ $isEditing ? 'Mettre à jour' : 'Créer' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        // Gestion des notifications avec Toastr
        window.addEventListener('notify', event => {
            if (typeof toastr !== 'undefined') {
                toastr[event.detail.type](event.detail.message);
            } else {
                // Fallback si Toastr n'est pas disponible
                console.log(`${event.detail.type}: ${event.detail.message}`);
            }
        });

        // Gestion de la confirmation de suppression avec SweetAlert2
        window.addEventListener('swal:confirm', event => {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: event.detail.title,
                    text: event.detail.text,
                    icon: event.detail.type,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, supprimer!',
                    cancelButtonText: 'Annuler',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Appel de la méthode delete dans le composant Livewire
                        Livewire.emit('deleteConfirmed', event.detail.id);
                    }
                });
            } else {
                // Fallback si SweetAlert2 n'est pas disponible
                if (confirm(`${event.detail.title}\n${event.detail.text}`)) {
                    Livewire.emit('deleteConfirmed', event.detail.id);
                }
            }
        });

        // Fermer le modal avec la touche Echap
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                Livewire.emit('closeModal');
            }
        });

        // Fermer le modal en cliquant à l'extérieur
        document.addEventListener('click', function(event) {
            const modal = document.querySelector('.modal.show');
            if (modal && event.target === modal) {
                Livewire.emit('closeModal');
            }
        });
    </script>
@endpush

<style>
    /* Animation pour le modal */
    .modal.show {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Style pour les boutons de confirmation */
    .swal2-confirm {
        margin-right: 10px;
    }

    .swal2-cancel {
        margin-left: 10px;
    }

    /* Responsive pour le modal */
    @media (max-width: 768px) {
        .modal-dialog {
            margin: 20px;
        }
    }
</style>