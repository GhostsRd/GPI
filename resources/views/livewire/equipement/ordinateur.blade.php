<div>
    <div class="container-fluid">

        <!-- 🧭 En-tête -->
        <div class="row mb-4">
            <div class="col-md-3">
                <h1 class="h3 fw-bold mb-1 text-primary">Gestion des Ordinateurs</h1>
                <p class="text-muted mb-0">Gérez votre parc informatique efficacement</p>
            </div>
        </div>

        <!-- 📊 Cartes statistiques -->
        <div class="col-md-12 mb-4">
            <div class="row g-3">
                @foreach($stats as $statut => $count)
                    <div class="col-xl-3 col-md-6">
                        <div class="card border-0 shadow-sm stats-widget h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        <h3 class="stats-number text-dark mb-1 fw-bold">{{ $count }}</h3>
                                        <p class="stats-label text-muted mb-0">{{ ucfirst($statut) }}</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="avatar-sm rounded-circle bg-light border d-flex align-items-center justify-content-center">
                                            @switch($statut)
                                                @case('En service')
                                                    <i class="fas fa-laptop-code fa-lg text-success"></i>
                                                    @break
                                                @case('En stock')
                                                    <i class="fas fa-warehouse fa-lg text-info"></i>
                                                    @break
                                                @case('En réparation')
                                                    <i class="fas fa-tools fa-lg text-warning"></i>
                                                    @break
                                                @case('Hors service')
                                                    <i class="fas fa-times-circle fa-lg text-danger"></i>
                                                    @break
                                                @default
                                                    <i class="fas fa-desktop fa-lg text-secondary"></i>
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

        <!-- 🔎 Barre de recherche et filtres -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-muted">Recherche</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-transparent border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" wire:model.live="search" class="form-control border-start-0" placeholder="Nom, IP, OS...">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-muted">Entité</label>
                        <input type="text" wire:model.live="entite" class="form-control form-control-sm" placeholder="Entité...">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-muted">Statut</label>
                        <select wire:model.live="statut" class="form-select form-select-sm">
                            <option value="">Tous</option>
                            @foreach($statuts as $statut)
                                <option value="{{ $statut }}">{{ $statut }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold text-muted">Page</label>
                        <select wire:model.live="perPage" class="form-select form-select-sm">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    </div>
                    <div class="col-md-1">
                        <button wire:click="create" class="btn btn-primary btn-sm w-100">
                    <i class="fas fa-plus"></i> Nouveau
                </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="create" class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-plus me-1"></i> Nouveau
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="deleteSelected" class="btn btn-danger btn-sm w-100"
                            title="Supprimer les ordinateurs sélectionnés"
                            {{ empty($selectedTickets) ? 'disabled' : '' }}>
                            <i class="fas fa-trash me-1"></i> Suppr.
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="exportTickets" class="btn btn-success btn-sm w-100">
                            <i class="fas fa-file-export me-1"></i> Export
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ✅ Messages Flash -->
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- 🧾 Tableau principal -->
        <div class="table-container border-0 fade-in-up">
            <div class="table-header bg-light p-2 rounded-top border-bottom">
                <strong class="text-secondary">Liste des ordinateurs</strong>
            </div>

            <div class="table-wrapper p-0 border-0 w-100 compact-mode">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Entité</th>
                            <th>Statut</th>
                            <th>Fabricant</th>
                            <th>Modèle</th>
                            <th>N° Série</th>
                            <th>Utilisateur</th>
                            <th>IP</th>
                            <th>OS</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ordinateurs as $ordinateur)
                            <tr>
                                <td><strong>{{ $ordinateur->nom }}</strong></td>
                                <td>{{ $ordinateur->entite }}</td>
                                <td>
                                    <span class="badge 
                                        @if($ordinateur->statut == 'En service') bg-success
                                        @elseif($ordinateur->statut == 'En stock') bg-info
                                        @elseif($ordinateur->statut == 'En réparation') bg-warning
                                        @else bg-danger
                                        @endif">
                                        {{ $ordinateur->statut }}
                                    </span>
                                </td>
                                <td>{{ $ordinateur->fabricant }}</td>
                                <td>{{ $ordinateur->modele }}</td>
                                <td><code>{{ $ordinateur->numero_serie ?? 'N/A' }}</code></td>
                                <td>{{ $ordinateur->utilisateur->name ?? 'Non attribué' }}</td>
                                <td><code>{{ $ordinateur->reseau_ip ?? 'N/A' }}</code></td>
                                <td>{{ $ordinateur->os_version ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <button wire:click="edit({{ $ordinateur->id }})" class="btn btn-sm btn-outline-primary me-1" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="delete({{ $ordinateur->id }})"
                                        onclick="return confirm('Supprimer cet ordinateur ?')"
                                        class="btn btn-sm btn-outline-danger" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted py-4">
                                    <i class="fas fa-desktop fa-2x mb-2 d-block"></i>
                                    Aucun ordinateur trouvé
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- ⚙️ Modal (création / édition) -->
        @if($showModal)
            <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5)">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title">
                                <i class="fas fa-desktop me-2"></i>{{ $modalTitle }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" wire:click="closeModal"></button>
                        </div>
                        <div class="modal-body">
                            @include('livewire.equipement.partials.form-ordinateur')
                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal">Annuler</button>
                            <button type="button" class="btn btn-primary" wire:click="save">
                                <i class="fas fa-save me-2"></i>{{ $editMode ? 'Modifier' : 'Créer' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>


    <!-- Modal -->
    @if($showModal)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5)">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $modalTitle }}</h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="save">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nom *</label>
                                    <input type="text" wire:model="nom" class="form-control">
                                    @error('nom') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Statut *</label>
                                    <select wire:model="statut_form" class="form-select">
                                        @foreach($statuts as $statut)
                                            <option value="{{ $statut }}">{{ $statut }}</option>
                                        @endforeach
                                    </select>
                                    @error('statut_form') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Fabricant</label>
                                    <input type="text" wire:model="fabricant" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Modèle</label>
                                    <input type="text" wire:model="modele" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Numéro de série</label>
                                    <input type="text" wire:model="numero_serie" class="form-control">
                                    @error('numero_serie') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Adresse IP</label>
                                    <input type="text" wire:model="reseau_ip" class="form-control">
                                    @error('reseau_ip') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Utilisateur principal</label>
                                    <select wire:model="utilisateur_id" class="form-select">
                                        <option value="">Sélectionner un utilisateur</option>
                                        @foreach($utilisateurs as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Usager secondaire</label>
                                    <select wire:model="usager_id" class="form-select">
                                        <option value="">Sélectionner un usager</option>
                                        @foreach($utilisateurs as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Entité</label>
                                    <input type="text" wire:model="entite_form" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Sous-entité</label>
                                    <input type="text" wire:model="sous_entite" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Disque dur</label>
                                    <input type="text" wire:model="disque_dur" class="form-control"
                                           placeholder="ex: 512 Go SSD">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Version OS</label>
                                    <input type="text" wire:model="os_version" class="form-control"
                                           placeholder="ex: Windows 11 Pro">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Version noyau</label>
                                    <input type="text" wire:model="os_noyau" class="form-control"
                                           placeholder="ex: 10.0.19045">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Date dernier inventaire</label>
                                    <input type="date" wire:model="date_dernier_inventaire" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Dernier démarrage</label>
                                    <input type="datetime-local" wire:model="derniere_date_demarrage" class="form-control">
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Notes</label>
                                    <textarea wire:model="notes" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal">Annuler</button>
                        <button type="button" class="btn btn-primary" wire:click="save">
                            <i class="fas fa-save me-2"></i>
                            {{ $editMode ? 'Modifier' : 'Créer' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
