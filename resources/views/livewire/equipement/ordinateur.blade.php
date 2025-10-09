<div>
    <div class="container-fluid">
        <!-- En-tête -->
        <div class="row mb-4">
            <div class="col-md-3">
                <h1 class="h3">Gestion des Ordinateurs</h1>
                <p class="text-muted">Gérez votre parc informatique</p>
            </div>
            <div class="col-md-7 text-end">
                 <div class="row">
                <div class="col-xl-3 col-md-3">
                    <div class="card stats-widget border-0 shadow-sm dark-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    {{-- <h3 class="stats-number text-primary">{{ $totalTickets }}</h3> --}}
                                    <p class="stats-label text-light mb-0">Totals tickets</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                        <i class="fas fa-boxes fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-3">
                    <div class="card stats-widget border-0 shadow-sm dark-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    {{-- <h3 class="stats-number text-success">{{ $inProgressTickets }}</h3> --}}
                                    <p class="stats-label text-light mb-0">En cours</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-success bg-opacity-25 text-success d-flex align-items-center justify-content-center">
                                        <i class="fas fa-warehouse fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-3">
                    <div class="card stats-widget border-0 shadow-sm dark-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    {{-- <h3 class="stats-number text-warning">{{ $pendingTickets }}</h3> --}}
                                    <p class="stats-label text-light mb-0">En Prêt</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-warning bg-opacity-25 text-warning d-flex align-items-center justify-content-center">
                                        <i class="fas fa-hand-holding fa-lg"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-3">
                    <div class="card stats-widget border-0 shadow-sm dark-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    {{-- <h3 class="stats-number text-danger">{{ $resolvedTickets }}</h3> --}}
                                    <p class="stats-label text-light mb-0">Résolus</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-danger bg-opacity-25 text-danger d-flex align-items-center justify-content-center">
                                        <i class="fas fa-tools fa-lg"></i>
                                    </div>
                                </div>
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
                                   class="form-control" placeholder="Référence, Sujet, Créé par...">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Priorité</label>
                        <input type="text" wire:model.live="entite" class="form-control"
                               placeholder="Entité...">
                    </div>
                    <div class="col-md-1">
                        <label class="form-label small fw-bold">Statut</label>
                        <select wire:model.live="statut" class="form-select">
                            <option value="">Tous les statuts</option>
                            @foreach($statuts as $statut)
                                <option value="{{ $statut }}">{{ $statut }}</option>
                            @endforeach
                        </select>
                    </div>
                      <div class="col-md-2">
                        <label class="form-label small fw-bold">Page</label>
                         
                        <select wire:model.live="perPage" class="form-select">
                            <option value="10">10 par page</option>
                            <option value="20">20 par page</option>
                            <option value="50">50 par page</option>
                            <option value="100">100 par page</option>
                        </select>
                
                    </div>
                    <div class="col-md-1">
                        <button wire:click="create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouveau
                </button>
                    </div>
                    <div class="col-md-2">
                        <button wire:click="deleteSelected" class="btn btn-danger btn-sm w-100" title="Supprimer les tickets sélectionnés"
                            {{ empty($selectedTickets) ? 'disabled' : '' }}>
                            <i class="fas fa-trash"></i>
                            Supprimer
                            {{-- Supprimer ({{ count($selectedTickets) }}) --}}
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="exportTickets" class="btn btn-success btn-sm w-100" title="Exporter les tickets">
                            <i class="fas fa-download"></i>
                            Exporter
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Filtres -->
        
       

        <!-- Messages flash -->
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Tableau -->
        <!-- Table Container -->
        <div class="table-container border-0   fade-in-up">
            <div class="table-header">
                <div class="table-title">
                    
                    Liste des ordinateurs
                </div>
            </div>

            <div class="table-wrapper p-0 border-0 w-100 compact-mode">
                <table class="table border-0 shadow-sm">
         
                    <thead>
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
                            <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                     @forelse($ordinateurs as $ordinateur)
                            <tr>
                                <td>
                                    <strong>{{ $ordinateur->nom }}</strong>
                                    @if($ordinateur->notes)
                                        <i class="fas fa-sticky-note text-warning"
                                           title="{{ $ordinateur->notes }}"></i>
                                    @endif
                                </td>
                                <td>
                                    {{ $ordinateur->entite }}
                                    @if($ordinateur->sous_entite)
                                        <br><small class="text-muted">{{ $ordinateur->sous_entite }}</small>
                                    @endif
                                </td>
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
                                <td>
                                    <code>{{ $ordinateur->numero_serie ?? 'N/A' }}</code>
                                </td>
                                <td>
                                    @if($ordinateur->utilisateur)
                                        {{ $ordinateur->utilisateur->name }}
                                    @else
                                        <span class="text-muted">Non attribué</span>
                                    @endif
                                </td>
                                <td>
                                    @if($ordinateur->reseau_ip)
                                        <code>{{ $ordinateur->reseau_ip }}</code>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($ordinateur->os_version)
                                        <small>{{ \Illuminate\Support\Str::limit($ordinateur->os_version, 20) }}</small>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <button wire:click="edit({{ $ordinateur->id }})"
                                                class="btn btn-outline-primary" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button wire:click="delete({{ $ordinateur->id }})"
                                                class="btn btn-outline-danger"
                                                title="Supprimer"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet ordinateur ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
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

                <!-- Pagination -->




        <!-- Statistiques rapides -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-chart-bar me-2"></i>Statistiques rapides
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            @foreach($stats as $statut => $count)
                                <div class="col-md-3">
                                    <div class="border rounded p-3">
                                        <h4 class="text-primary">{{ $count }}</h4>
                                        <small class="text-muted">{{ $statut }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
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
