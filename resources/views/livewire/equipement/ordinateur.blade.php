<div>
    <div class="container-fluid">

        <!-- 🧭 En-tête -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="h3 fw-bold mb-1 text-primary">Gestion des Ordinateurs</h1>
                <p class="text-muted mb-0">Gérez votre parc informatique efficacement</p>
            </div>
        </div>

        <!-- 📊 Cartes statistiques -->
        <div class="row mb-4">
            @foreach($stats as $statut => $count)
                <div class="col-xl-3 col-md-6 mb-3">
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

                    <div class="col-md-2">
                        <button wire:click="create" class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-plus me-1"></i> Nouveau
                        </button>
                    </div>

                    <div class="col-md-1">
                        <button wire:click="openImportModal" class="btn btn-info btn-sm w-100"
                                title="Importer des ordinateurs depuis Excel">
                            <i class="fas fa-file-import me-1"></i> Import
                        </button>
                    </div>
                    
                    <div class="col-md-1">
                        <button wire:click="exportOrdinateur" class="btn btn-success btn-sm w-100">
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
        <div class="card border-0 shadow-sm fade-in-up">
            <div class="card-header bg-light border-0">
                <strong class="text-secondary">Liste des ordinateurs</strong>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
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
                                        <div class="btn-group btn-group-sm" role="group">
                                            <!-- Bouton Voir Détails -->
                                            <button wire:click="showDetails({{ $ordinateur->id }})"
                                                    class="btn btn-outline-info" title="Voir détails">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <!-- Bouton Modifier -->
                                            <button wire:click="edit({{ $ordinateur->id }})"
                                                    class="btn btn-outline-primary" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <!-- Bouton Supprimer -->
                                            <button wire:click="delete({{ $ordinateur->id }})"
                                                    onclick="return confirm('Supprimer cet ordinateur ?')"
                                                    class="btn btn-outline-danger" title="Supprimer">
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
                <div class="card-footer bg-white border-0">
                    {{ $ordinateurs->links() }}
                </div>
            </div>
        </div>

        <!-- ⚙️ Modal (création / édition) -->
        @if($showModal)
            <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.4)" wire:ignore.self>
                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content border-0 shadow-lg rounded-3">

                        <!-- En-tête noir élégant -->
                        <div class="modal-header bg-dark text-white border-0 rounded-top-3 py-3 px-4">
                            <div class="d-flex align-items-center">
                                <div class="modal-icon bg-white bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-desktop text-white"></i>
                                </div>
                                <div>
                                    <h5 class="modal-title fw-bold mb-0">{{ $modalTitle }}</h5>
                                    <small class="text-white-50">Remplissez les informations de l'ordinateur</small>
                                </div>
                            </div>
                            <button type="button" class="btn-close btn-close-white bg-white bg-opacity-10 p-2 rounded"
                                    wire:click="closeModal" aria-label="Fermer"></button>
                        </div>

                        <!-- Corps du formulaire blanc -->
                        <div class="modal-body bg-white p-4">
                            <form wire:submit.prevent="save" class="needs-validation" novalidate>
                                <div class="row g-4">

                                    <!-- Section 1: Informations de base -->
                                    <div class="col-12">
                                        <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-info-circle me-2 text-primary"></i>Informations de base
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Nom <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-tag text-muted"></i>
                                            </span>
                                            <input type="text" wire:model="nom"
                                                   class="form-control border-start-0 @error('nom') is-invalid @enderror"
                                                   placeholder="Nom de l'ordinateur">
                                        </div>
                                        @error('nom') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Statut <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-circle text-muted"></i>
                                            </span>
                                            <select wire:model="statut_form"
                                                    class="form-select border-start-0 @error('statut_form') is-invalid @enderror">
                                                <option value="">Sélectionner un statut</option>
                                                @foreach($statuts as $statut)
                                                    <option value="{{ $statut }}">{{ $statut }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('statut_form') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <!-- Section 2: Matériel -->
                                    <div class="col-12 mt-4">
                                        <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-microchip me-2 text-primary"></i>Spécifications matérielles
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Fabricant</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-industry text-muted"></i>
                                            </span>
                                            <input type="text" wire:model="fabricant"
                                                   class="form-control border-start-0 @error('fabricant') is-invalid @enderror"
                                                   placeholder="ex: Dell, HP, Lenovo">
                                        </div>
                                        @error('fabricant') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Modèle</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-laptop text-muted"></i>
                                            </span>
                                            <input type="text" wire:model="modele"
                                                   class="form-control border-start-0 @error('modele') is-invalid @enderror"
                                                   placeholder="ex: Latitude 5420">
                                        </div>
                                        @error('modele') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Numéro de série</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-barcode text-muted"></i>
                                            </span>
                                            <input type="text" wire:model="numero_serie"
                                                   class="form-control border-start-0 @error('numero_serie') is-invalid @enderror"
                                                   placeholder="Numéro de série">
                                        </div>
                                        @error('numero_serie') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Disque dur</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-hdd text-muted"></i>
                                            </span>
                                            <input type="text" wire:model="disque_dur"
                                                   class="form-control border-start-0"
                                                   placeholder="ex: 512 Go SSD">
                                        </div>
                                    </div>

                                    <!-- Section 3: Réseau et OS -->
                                    <div class="col-12 mt-4">
                                        <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-network-wired me-2 text-primary"></i>Réseau et Système
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Adresse IP</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fas fa-wifi text-muted"></i>
                                            </span>
                                            <input type="text" wire:model="reseau_ip"
                                                   class="form-control border-start-0 @error('reseau_ip') is-invalid @enderror"
                                                   placeholder="ex: 192.168.1.100">
                                        </div>
                                        @error('reseau_ip') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Version OS</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0">
                                                <i class="fab fa-windows text-muted"></i>
                                            </span>
                                            <input type="text" wire:model="os_version"
                                                   class="form-control border-start-0"
                                                   placeholder="ex: Windows 11 Pro">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Version noyau</label>
                                        <input type="text" wire:model="os_noyau"
                                               class="form-control"
                                               placeholder="ex: 10.0.19045">
                                    </div>

                                    <!-- Section 4: Utilisateurs -->
                                    <div class="col-12 mt-4">
                                        <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-users me-2 text-primary"></i>Attribution utilisateurs
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Utilisateur principal</label>
                                        <select wire:model="utilisateur_id"
                                                class="form-select @error('utilisateur_id') is-invalid @enderror">
                                            <option value="">Sélectionner un utilisateur</option>
                                            @foreach($utilisateurs as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('utilisateur_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Usager secondaire</label>
                                        <select wire:model="usager_id" class="form-select">
                                            <option value="">Sélectionner un usager</option>
                                            @foreach($utilisateurs as $user)
                                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Section 5: Organisation -->
                                    <div class="col-12 mt-4">
                                        <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-building me-2 text-primary"></i>Organisation
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Entité</label>
                                        <input type="text" wire:model="entite_form"
                                               class="form-control @error('entite_form') is-invalid @enderror"
                                               placeholder="Entité organisationnelle">
                                        @error('entite_form') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Sous-entité</label>
                                        <input type="text" wire:model="sous_entite"
                                               class="form-control"
                                               placeholder="Sous-entité organisationnelle">
                                    </div>

                                    <!-- Section 6: Dates importantes -->
                                    <div class="col-12 mt-4">
                                        <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-calendar-alt me-2 text-primary"></i>Dates importantes
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Date dernier inventaire</label>
                                        <input type="date" wire:model="date_dernier_inventaire"
                                               class="form-control">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark">Dernier démarrage</label>
                                        <input type="datetime-local" wire:model="derniere_date_demarrage"
                                               class="form-control">
                                    </div>

                                    <!-- Section 7: Notes -->
                                    <div class="col-12 mt-4">
                                        <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-sticky-note me-2 text-primary"></i>Notes et informations
                                        </h6>
                                        <textarea wire:model="notes" class="form-control" rows="4"
                                                  placeholder="Informations supplémentaires, remarques, observations..."></textarea>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <!-- Pied de page -->
                        <div class="modal-footer bg-light border-0 rounded-bottom-3 py-3 px-4">
                            <button type="button" class="btn btn-outline-dark px-4" wire:click="closeModal">
                                <i class="fas fa-times me-2"></i>Annuler
                            </button>
                            <button type="button" class="btn btn-dark px-4" wire:click="save">
                                <i class="fas fa-save me-2"></i>{{ $editMode ? 'Modifier' : 'Créer' }}
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        @endif

        <!-- 👁️ Modal de détails de l'ordinateur -->
        @if($showDetailsModal)
            <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.4)" wire:ignore.self>
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content border-0 shadow-lg rounded-3">

                        <!-- En-tête bleu élégant -->
                        <div class="modal-header bg-primary text-white border-0 rounded-top-3 py-3 px-4">
                            <div class="d-flex align-items-center">
                                <div class="modal-icon bg-white bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="fas fa-laptop text-white"></i>
                                </div>
                                <div>
                                    <h5 class="modal-title fw-bold mb-0">Détails de l'Ordinateur</h5>
                                    <small class="text-white-50">Informations complètes de l'équipement</small>
                                </div>
                            </div>
                            <button type="button" class="btn-close btn-close-white bg-white bg-opacity-10 p-2 rounded"
                                    wire:click="closeDetailsModal" aria-label="Fermer"></button>
                        </div>

                        <!-- Corps de la modal -->
                        <div class="modal-body bg-white p-4">
                            @if($selectedOrdinateur)
                                <div class="row g-4">

                                    <!-- Section 1: Informations de base -->
                                    <div class="col-12">
                                        <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-info-circle me-2 text-primary"></i>Informations de base
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Nom</label>
                                        <p class="fw-semibold text-dark mb-0">{{ $selectedOrdinateur->nom }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Statut</label>
                                        <div>
                                        <span class="badge
                                            @if($selectedOrdinateur->statut == 'En service') bg-success
                                            @elseif($selectedOrdinateur->statut == 'En stock') bg-info
                                            @elseif($selectedOrdinateur->statut == 'En réparation') bg-warning
                                            @else bg-danger
                                            @endif">
                                            {{ $selectedOrdinateur->statut }}
                                        </span>
                                        </div>
                                    </div>

                                    <!-- Section 2: Matériel -->
                                    <div class="col-12 mt-4">
                                        <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-microchip me-2 text-primary"></i>Spécifications matérielles
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Fabricant</label>
                                        <p class="fw-semibold text-dark mb-0">{{ $selectedOrdinateur->fabricant ?? 'Non spécifié' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Modèle</label>
                                        <p class="fw-semibold text-dark mb-0">{{ $selectedOrdinateur->modele ?? 'Non spécifié' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Numéro de série</label>
                                        <p class="fw-semibold text-dark mb-0 font-monospace">{{ $selectedOrdinateur->numero_serie ?? 'Non renseigné' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Disque dur</label>
                                        <p class="fw-semibold text-dark mb-0">{{ $selectedOrdinateur->disque_dur ?? 'Non spécifié' }}</p>
                                    </div>

                                    <!-- Section 3: Réseau et OS -->
                                    <div class="col-12 mt-4">
                                        <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-network-wired me-2 text-primary"></i>Réseau et Système
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Adresse IP</label>
                                        <p class="fw-semibold text-dark mb-0 font-monospace">{{ $selectedOrdinateur->reseau_ip ?? 'Non configurée' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Version OS</label>
                                        <p class="fw-semibold text-dark mb-0">{{ $selectedOrdinateur->os_version ?? 'Non spécifié' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Version noyau</label>
                                        <p class="fw-semibold text-dark mb-0">{{ $selectedOrdinateur->os_noyau ?? 'Non spécifié' }}</p>
                                    </div>

                                    <!-- Section 4: Utilisateurs -->
                                    <div class="col-12 mt-4">
                                        <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-users me-2 text-primary"></i>Attribution utilisateurs
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Utilisateur principal</label>
                                        <p class="fw-semibold text-dark mb-0">{{ $selectedOrdinateur->utilisateur->name ?? 'Non attribué' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Usager secondaire</label>
                                        <p class="fw-semibold text-dark mb-0">{{ $selectedOrdinateur->usager->name ?? 'Non attribué' }}</p>
                                    </div>

                                    <!-- Section 5: Organisation -->
                                    <div class="col-12 mt-4">
                                        <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-building me-2 text-primary"></i>Organisation
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Entité</label>
                                        <p class="fw-semibold text-dark mb-0">{{ $selectedOrdinateur->entite ?? 'Non spécifiée' }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Sous-entité</label>
                                        <p class="fw-semibold text-dark mb-0">{{ $selectedOrdinateur->sous_entite ?? 'Non spécifiée' }}</p>
                                    </div>

                                    <!-- Section 6: Dates importantes -->
                                    <div class="col-12 mt-4">
                                        <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-calendar-alt me-2 text-primary"></i>Dates importantes
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Date dernier inventaire</label>
                                        <p class="fw-semibold text-dark mb-0">
                                            @if($selectedOrdinateur->date_dernier_inventaire)
                                                {{ \Carbon\Carbon::parse($selectedOrdinateur->date_dernier_inventaire)->format('d/m/Y') }}
                                            @else
                                                Non renseignée
                                            @endif
                                        </p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Dernier démarrage</label>
                                        <p class="fw-semibold text-dark mb-0">
                                            @if($selectedOrdinateur->derniere_date_demarrage)
                                                {{ \Carbon\Carbon::parse($selectedOrdinateur->derniere_date_demarrage)->format('d/m/Y H:i') }}
                                            @else
                                                Non renseigné
                                            @endif
                                        </p>
                                    </div>

                                    <!-- Section 7: Notes -->
                                    @if($selectedOrdinateur->notes)
                                        <div class="col-12 mt-4">
                                            <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                                <i class="fas fa-sticky-note me-2 text-primary"></i>Notes
                                            </h6>
                                            <div class="bg-light p-3 rounded">
                                                <p class="mb-0 text-dark">{{ $selectedOrdinateur->notes }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Section 8: Métadonnées -->
                                    <div class="col-12 mt-4">
                                        <h6 class="text-dark fw-semibold mb-3 pb-2 border-bottom">
                                            <i class="fas fa-database me-2 text-primary"></i>Métadonnées
                                        </h6>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Date de création</label>
                                        <p class="fw-semibold text-dark mb-0">{{ $selectedOrdinateur->created_at->format('d/m/Y à H:i') }}</p>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-muted small">Dernière modification</label>
                                        <p class="fw-semibold text-dark mb-0">{{ $selectedOrdinateur->updated_at->format('d/m/Y à H:i') }}</p>
                                    </div>

                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3"></i>
                                    <p class="text-muted">Impossible de charger les détails de l'ordinateur.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Pied de page -->
                        <div class="modal-footer bg-light border-0 rounded-bottom-3 py-3 px-4">
                            <button type="button" class="btn btn-outline-secondary px-4" wire:click="closeDetailsModal">
                                <i class="fas fa-times me-2"></i>Fermer
                            </button>
                            @if($selectedOrdinateur)
                                <button type="button" class="btn btn-primary px-4"
                                        wire:click="edit({{ $selectedOrdinateur->id }})"
                                        wire:click="closeDetailsModal">
                                    <i class="fas fa-edit me-2"></i>Modifier
                                </button>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        @endif

        <!-- 📤 Modal d'import Bootstrap -->
        @if($showImportModal)
        <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-file-import me-2"></i>
                            Importer des Ordinateurs
                        </h5>
                        <button type="button" wire:click="closeImportModal" class="btn-close btn-close-white"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Sélectionnez un fichier CSV à importer. Le fichier sera stocké temporairement pour le mapping.
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Fichier CSV</label>
                            <input type="file" wire:model="fichierExcel" class="form-control" accept=".csv,.txt">
                            @error('fichierExcel') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mt-3">
                            <button type="button" wire:click="downloadTemplate" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-download me-1"></i>
                                Télécharger le template
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="closeImportModal" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>
                            Annuler
                        </button>
                        <button type="button" wire:click="storeImportFile" class="btn btn-info" {{ !$fichierExcel ? 'disabled' : '' }}>
                            <i class="fas fa-arrow-right me-1"></i>
                            Suivant (Mapping)
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Modal Mapping -->
        @if($showMappingModal)
        <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-dark">
                        <h5 class="modal-title">
                            <i class="fas fa-map me-2"></i>
                            Mapping des Colonnes
                        </h5>
                        <button type="button" wire:click="cancelImport" class="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Associez chaque colonne de votre fichier aux champs de la base de données.
                        </div>

                        <!-- Aperçu des données -->
                        @if(count($csvPreview) > 0)
                        <div class="mb-4">
                            <h6>Aperçu des données (5 premières lignes):</h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            @foreach($csvHeaders as $header)
                                            <th>{{ $header }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($csvPreview as $row)
                                        <tr>
                                            @foreach($csvHeaders as $header)
                                            <td>{{ $row[$header] ?? '' }}</td>
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif

                        <!-- Formulaire de mapping -->
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Mapping des champs:</h6>
                                @foreach($fieldMapping as $field => $value)
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-capitalize">
                                        {{ str_replace('_', ' ', $field) }}
                                        @if($field === 'nom') <span class="text-danger">*</span> @endif
                                    </label>
                                    <select wire:model="fieldMapping.{{ $field }}" class="form-select form-select-sm">
                                        <option value="">-- Non mappé --</option>
                                        @foreach($csvHeaders as $header)
                                        <option value="{{ $header }}">{{ $header }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @endforeach
                            </div>
                            
                            <div class="col-md-6">
                                <h6>Instructions:</h6>
                                <div class="card bg-light">
                                    <div class="card-body small">
                                        <p><strong>Champs obligatoires:</strong></p>
                                        <ul>
                                            <li><strong>Nom:</strong> Identifiant unique de l'ordinateur</li>
                                        </ul>
                                        <p><strong>Champs optionnels:</strong></p>
                                        <ul>
                                            <li><strong>Entité/Sous-entité:</strong> Service/département</li>
                                            <li><strong>Statut:</strong> En service, En stock, Hors service, En réparation</li>
                                            <li><strong>Fabricant/Modèle:</strong> Marque et modèle</li>
                                            <li><strong>Numéro de série:</strong> Identifiant unique matériel</li>
                                            <li><strong>Utilisateur/Usager:</strong> Noms des personnes</li>
                                            <li><strong>Réseau IP:</strong> Adresse IP</li>
                                            <li><strong>Configuration:</strong> Disque dur, OS, etc.</li>
                                            <li><strong>Dates:</strong> Inventaire et démarrage</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="cancelImport" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>
                            Annuler
                        </button>
                        <button type="button" wire:click="processMappedData" class="btn btn-warning">
                            <i class="fas fa-cog me-1"></i>
                            Traiter les données
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Modal Aperçu des données importées -->
        @if($showImportedData)
        <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5);" tabindex="-1">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-check-circle me-2"></i>
                            Aperçu des Données Importées
                        </h5>
                        <button type="button" wire:click="cancelImport" class="btn-close btn-close-white"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success">
                            <i class="fas fa-info-circle me-2"></i>
                            {{ $importSuccessCount }} enregistrement(s) prêt(s) à être importés.
                            @if(count($importErrors) > 0)
                            <br><strong>{{ count($importErrors) }} erreur(s) détectée(s):</strong>
                            @endif
                        </div>

                        @if(count($importErrors) > 0)
                        <div class="alert alert-danger">
                            <h6>Erreurs d'importation:</h6>
                            <ul class="small mb-0">
                                @foreach($importErrors as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Aperçu des données mappées -->
                        @if(count($importedData) > 0)
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Entité</th>
                                        <th>Sous-entité</th>
                                        <th>Statut</th>
                                        <th>Fabricant</th>
                                        <th>Modèle</th>
                                        <th>N° Série</th>
                                        <th>Utilisateur</th>
                                        <th>Usager</th>
                                        <th>IP</th>
                                        <th>Disque dur</th>
                                        <th>OS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($importedData as $data)
                                    <tr>
                                        <td>{{ $data['nom'] }}</td>
                                        <td>{{ $data['entite'] ?? 'N/A' }}</td>
                                        <td>{{ $data['sous_entite'] ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $this->getBadgeColor($data['statut'] ?? 'En stock') }}">
                                                {{ $data['statut'] ?? 'En stock' }}
                                            </span>
                                        </td>
                                        <td>{{ $data['fabricant'] ?? 'N/A' }}</td>
                                        <td>{{ $data['modele'] ?? 'N/A' }}</td>
                                        <td class="font-monospace">{{ $data['numero_serie'] ?? 'N/A' }}</td>
                                        <td>{{ $data['utilisateur'] ?? 'N/A' }}</td>
                                        <td>{{ $data['usager'] ?? 'N/A' }}</td>
                                        <td class="font-monospace">{{ $data['reseau_ip'] ?? 'N/A' }}</td>
                                        <td>{{ $data['disque_dur'] ?? 'N/A' }}</td>
                                        <td>{{ $data['os_version'] ?? 'N/A' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" wire:click="cancelImport" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i>
                            Annuler
                        </button>
                        <button type="button" wire:click="saveImportedData" class="btn btn-success" {{ count($importedData) === 0 ? 'disabled' : '' }}>
                            <i class="fas fa-save me-1"></i>
                            Sauvegarder ({{ count($importedData) }})
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>