<div>
    <!-- Container pour les notifications -->
    <div id="notificationContainer"></div>

    <div class="container-fluid py-3">
        <!-- Header -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h1 class="h4 fw-semibold text-dark mb-0">Dashboard Utilisateurs</h1>
                        <p class="text-muted small">Gestion des utilisateurs de l'application</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <button class="btn btn-outline-primary btn-sm d-flex align-items-center" wire:click="testNotification">
                            <i class="bi bi-bell me-1"></i> Tester Notification
                        </button>
                        <button class="btn btn-outline-primary btn-sm d-flex align-items-center" wire:click="exportUsers">
                            <i class="bi bi-download me-1"></i> Exporter
                        </button>
                        <button class="btn btn-primary btn-sm d-flex align-items-center" wire:click="createUser">
                            <i class="bi bi-plus-circle me-1"></i> Nouvel Utilisateur
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-3">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="dashboard-card stat-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon icon-primary me-3">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div>
                            <h3 class="stat-number mb-0">{{ $totalUsers ?? 0 }}</h3>
                            <p class="text-muted small mb-0">Utilisateurs Totaux</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="dashboard-card stat-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon icon-success me-3">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div>
                            <h3 class="stat-number mb-0">{{ $activeUsers ?? 0 }}</h3>
                            <p class="text-muted small mb-0">Utilisateurs Actifs</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="dashboard-card stat-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon icon-warning me-3">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <div>
                            <h3 class="stat-number mb-0">{{ $inactiveUsers ?? 0 }}</h3>
                            <p class="text-muted small mb-0">Utilisateurs Inactifs</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="dashboard-card stat-card">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon icon-info me-3">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div>
                            <h3 class="stat-number mb-0">{{ $adminUsers ?? 0 }}</h3>
                            <p class="text-muted small mb-0">Administrateurs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and User List -->
        <div class="row">
            <!-- Left Column - Charts -->
            <div class="col-xl-8 col-lg-7 mb-3">
                <div class="dashboard-card p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-semibold mb-0">Activité des Utilisateurs</h5>
                    </div>
                    <div class="chart-container">
                        <canvas id="userActivityChart" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Right Column - Recent Users -->
            <div class="col-xl-4 col-lg-5 mb-3">
                <div class="dashboard-card p-3">
                    <h5 class="fw-semibold mb-3">Utilisateurs Récents</h5>
                    <div class="recent-users">
                        @foreach($recentUsers ?? [] as $utilisateur)
                            <div class="d-flex align-items-center mb-2">
                                @if($utilisateur->photo)
                                    <img src="{{ asset('storage/' . $utilisateur->photo) }}" alt="Photo profil" class="user-avatar me-2">
                                @else
                                    <div class="user-avatar me-2">
                                        {{ strtoupper(substr($utilisateur->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="flex-grow-1">
                                    <p class="mb-0 fw-medium small">{{ $utilisateur->name }}</p>
                                    <small class="text-muted">{{ $utilisateur->email }}</small>
                                </div>
                                <span class="badge badge-sm {{ $utilisateur->status === 'active' ? 'bg-success' : ($utilisateur->status === 'inactive' ? 'bg-warning' : 'bg-danger') }}">
                                    {{ $utilisateur->status === 'active' ? 'Actif' : ($utilisateur->status === 'inactive' ? 'Inactif' : 'Suspendu') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="row">
            <div class="col-12">
                <div class="dashboard-card p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h5 class="fw-semibold mb-0">Liste des Utilisateurs</h5>
                        <div class="d-flex gap-2 flex-wrap">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input type="text" class="form-control form-control-sm" placeholder="Rechercher..." wire:model.debounce.300ms="search">
                            </div>
                            <select class="form-select form-select-sm" wire:model="status" style="width: auto;">
                                <option value="">Tous les statuts</option>
                                <option value="active">Actif</option>
                                <option value="inactive">Inactif</option>
                                <option value="suspended">Suspendu</option>
                            </select>
                            <select class="form-select form-select-sm" wire:model="role" style="width: auto;">
                                <option value="">Tous les rôles</option>
                                <option value="user">Utilisateur</option>
                                <option value="manager">Manager</option>
                                <option value="admin">Administrateur</option>
                            </select>
                            <button class="btn btn-outline-secondary btn-sm" wire:click="resetFilters">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th wire:click="sortBy('name')" style="cursor: pointer;">
                                        Utilisateur
                                        @if($sortField === 'name')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                        @endif
                                    </th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Poste</th>
                                    <th wire:click="sortBy('role')" style="cursor: pointer;">
                                        Rôle
                                        @if($sortField === 'role')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('status')" style="cursor: pointer;">
                                        Statut
                                        @if($sortField === 'status')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                        @endif
                                    </th>
                                    <th>Dernière connexion</th>
                                    <th wire:click="sortBy('created_at')" style="cursor: pointer;">
                                        Date d'inscription
                                        @if($sortField === 'created_at')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} small"></i>
                                        @endif
                                    </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $utilisateur)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($utilisateur->photo)
                                                    <img src="{{ asset('storage/' . $utilisateur->photo) }}" alt="Photo profil" class="user-avatar me-2">
                                                @else
                                                    <div class="user-avatar me-2">
                                                        {{ strtoupper(substr($utilisateur->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="mb-0 fw-medium small">{{ $utilisateur->name }}</p>
                                                    <small class="text-muted">ID: {{ $utilisateur->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="small">{{ $utilisateur->email }}</td>
                                        <td class="small">{{ $utilisateur->phone ?? 'Non renseigné' }}</td>
                                        <td class="small">{{ $utilisateur->poste ?? 'Non renseigné' }}</td>
                                        <td>
                                            <span class="badge badge-sm {{ $utilisateur->role === 'admin' ? 'bg-orange' : ($utilisateur->role === 'manager' ? 'bg-turquoise' : 'bg-soft-green') }}">
                                                {{ $utilisateur->role === 'admin' ? 'Administrateur' : ($utilisateur->role === 'manager' ? 'Manager' : 'Utilisateur') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-sm {{ $utilisateur->status === 'active' ? 'bg-success' : ($utilisateur->status === 'inactive' ? 'bg-warning' : 'bg-danger') }}">
                                                {{ $utilisateur->status === 'active' ? 'Actif' : ($utilisateur->status === 'inactive' ? 'Inactif' : 'Suspendu') }}
                                            </span>
                                        </td>
                                        <td class="small">{{ $utilisateur->last_login_at ? $utilisateur->last_login_at->diffForHumans() : 'Jamais' }}</td>
                                        <td class="small">{{ $utilisateur->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <button class="action-btn btn-view" wire:click="viewUser({{ $utilisateur->id }})" title="Voir">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="action-btn btn-edit" wire:click="editUser({{ $utilisateur->id }})" title="Modifier">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button class="action-btn btn-delete" wire:click="confirmDelete({{ $utilisateur->id }})" title="Supprimer">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-3">
                                            <i class="bi bi-people display-6 text-muted d-block mb-2"></i>
                                            <p class="text-muted mb-0 small">Aucun utilisateur trouvé</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            @if($users->count() > 0)
                                Affichage de {{ $users->firstItem() }} à {{ $users->lastItem() }} sur {{ $users->total() }} utilisateurs
                            @else
                                Aucun utilisateur
                            @endif
                        </div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal pour visualiser l'utilisateur -->
    @if($showUserModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Profil Utilisateur</h5>
                    <button type="button" class="btn-close" wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <div class="profile-container">
                        <div class="profile-header">
                            <div class="profile-avatar">
                                @if($currentPhoto)
                                    <img src="{{ asset('storage/' . $currentPhoto) }}" alt="Photo de profil" class="user-avatar-large">
                                @else
                                    <img src="{{ asset('/images/avtar_1.png') }}" alt="Photo de profil">
                                @endif
                            </div>
                            <div class="profile-info">
                                <h2 class="h4">{{ $name }}</h2>
                                <p class="mb-2">{{ $poste ?? 'Non renseigné' }}</p>
                                <div class="profile-stats">
                                    <div>
                                        <span class="text-white">{{ $user_role === 'admin' ? 'Administrateur' : ($user_role === 'manager' ? 'Manager' : 'Utilisateur') }}</span>
                                        <small class="text-white">Rôle</small>
                                    </div>
                                    <div>
                                        <span class="text-white">{{ $user_status === 'active' ? 'Actif' : ($user_status === 'inactive' ? 'Inactif' : 'Suspendu') }}</span>
                                        <small class="text-white">Statut</small>
                                    </div>
                                    <div>
                                        <span class="text-white">{{ \Carbon\Carbon::parse($created_at ?? now())->diffForHumans() }}</span>
                                        <small class="text-white">Membre depuis</small>
                                    </div>
                                </div>
                                <div class="profile-actions mt-3">
                                    <button class="btn btn-primary btn-sm" wire:click="editUser({{ $userId }})">
                                        <i class="bi bi-pencil me-1"></i>Modifier
                                    </button>
                                    <button class="btn btn-outline-light btn-sm" wire:click="closeModals">
                                        <i class="bi bi-x me-1"></i>Fermer
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="profile-bio mt-3">
                            <h5 class="h6">À propos</h5>
                            <p class="mt-2 small">
                                {{ $poste ? "Spécialisé en {$poste}" : "Utilisateur de la plateforme" }} 
                                @if($lieu_travail)
                                    basé à {{ $lieu_travail }}.
                                @endif
                                Compte {{ $user_status === 'active' ? 'actif' : ($user_status === 'inactive' ? 'inactif' : 'suspendu') }}.
                            </p>
                        </div>

                        <div class="profile-details mt-3">
                            <h5 class="h6">Détails du Profil</h5>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="detail-item mb-2">
                                        <strong class="small"><i class="bi bi-envelope me-1"></i>Email</strong>
                                        <p class="mb-0 small">{{ $email }}</p>
                                    </div>
                                    <div class="detail-item mb-2">
                                        <strong class="small"><i class="bi bi-telephone me-1"></i>Téléphone</strong>
                                        <p class="mb-0 small">{{ $phone ?? 'Non renseigné' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item mb-2">
                                        <strong class="small"><i class="bi bi-briefcase me-1"></i>Poste</strong>
                                        <p class="mb-0 small">{{ $poste ?? 'Non renseigné' }}</p>
                                    </div>
                                    <div class="detail-item mb-2">
                                        <strong class="small"><i class="bi bi-geo-alt me-1"></i>Lieu de travail</strong>
                                        <p class="mb-0 small">{{ $lieu_travail ?? 'Non renseigné' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal pour créer un utilisateur -->
    @if($showCreateModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Créer un Nouvel Utilisateur</h5>
                    <button type="button" class="btn-close" wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Nom complet <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" wire:model="name" required>
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-sm" wire:model="email" required>
                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Mot de passe <span class="text-danger">*</span></label>
                                <input type="password" class="form-control form-control-sm" wire:model="password" required>
                                @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Confirmation du mot de passe <span class="text-danger">*</span></label>
                                <input type="password" class="form-control form-control-sm" wire:model="password_confirmation" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Téléphone</label>
                                <input type="tel" class="form-control form-control-sm" wire:model="phone">
                                @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Poste</label>
                                <input type="text" class="form-control form-control-sm" wire:model="poste">
                                @error('poste') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Lieu de travail</label>
                                <input type="text" class="form-control form-control-sm" wire:model="lieu_travail">
                                @error('lieu_travail') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Rôle <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" wire:model="user_role" required>
                                    <option value="user">Utilisateur</option>
                                    <option value="manager">Manager</option>
                                    <option value="admin">Administrateur</option>
                                </select>
                                @error('user_role') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Statut <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" wire:model="user_status" required>
                                    <option value="active">Actif</option>
                                    <option value="inactive">Inactif</option>
                                    <option value="suspended">Suspendu</option>
                                </select>
                                @error('user_status') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Photo de profil</label>
                                <input type="file" class="form-control form-control-sm" wire:model="photo" accept="image/*">
                                @error('photo') <span class="text-danger small">{{ $message }}</span> @enderror
                                @if($photo)
                                    <div class="mt-1">
                                        <small class="text-muted">Aperçu :</small>
                                        <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 80px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModals">Annuler</button>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle me-1"></i>Créer l'utilisateur
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal pour modifier l'utilisateur -->
    @if($showEditModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier l'Utilisateur</h5>
                    <button type="button" class="btn-close" wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Nom complet <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" wire:model="name" required>
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-sm" wire:model="email" required>
                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Nouveau mot de passe</label>
                                <input type="password" class="form-control form-control-sm" wire:model="password">
                                @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                                <small class="text-muted">Laissez vide pour ne pas modifier</small>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Confirmation du mot de passe</label>
                                <input type="password" class="form-control form-control-sm" wire:model="password_confirmation">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Téléphone</label>
                                <input type="tel" class="form-control form-control-sm" wire:model="phone">
                                @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Poste</label>
                                <input type="text" class="form-control form-control-sm" wire:model="poste">
                                @error('poste') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Lieu de travail</label>
                                <input type="text" class="form-control form-control-sm" wire:model="lieu_travail">
                                @error('lieu_travail') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Rôle <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" wire:model="user_role" required>
                                    <option value="user">Utilisateur</option>
                                    <option value="manager">Manager</option>
                                    <option value="admin">Administrateur</option>
                                </select>
                                @error('user_role') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Statut <span class="text-danger">*</span></label>
                                <select class="form-select form-select-sm" wire:model="user_status" required>
                                    <option value="active">Actif</option>
                                    <option value="inactive">Inactif</option>
                                    <option value="suspended">Suspendu</option>
                                </select>
                                @error('user_status') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label small">Photo de profil</label>
                                <input type="file" class="form-control form-control-sm" wire:model="photo" accept="image/*">
                                @error('photo') <span class="text-danger small">{{ $message }}</span> @enderror
                                
                                @if($currentPhoto)
                                    <div class="mt-1">
                                        <small class="text-muted">Photo actuelle :</small>
                                        <img src="{{ asset('storage/' . $currentPhoto) }}" class="img-thumbnail mt-1" style="max-height: 80px;">
                                    </div>
                                @endif
                                
                                @if($photo)
                                    <div class="mt-1">
                                        <small class="text-muted">Nouvelle photo :</small>
                                        <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 80px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModals">Annuler</button>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="bi bi-check-circle me-1"></i>Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de suppression -->
    @if($showDeleteModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="bi bi-exclamation-triangle text-danger display-5"></i>
                        <h4 class="mt-2 h5">Êtes-vous sûr ?</h4>
                        <p class="text-muted small">
                            Vous êtes sur le point de supprimer l'utilisateur <strong>{{ $name }}</strong>. 
                            Cette action est irréversible et supprimera toutes les données associées.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModals">Annuler</button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="deleteUser">
                        <i class="bi bi-trash me-1"></i>Supprimer définitivement
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <style>
        :root {
            --dark-green: #3D3E14;    /* Vert foncé / brun olive */
            --turquoise: #66C0B7;     /* Bleu turquoise clair */
            --off-white: #EDEDE8;     /* Blanc cassé */
            --orange: #E35E2F;        /* Orange vif */
            --soft-green: #83AF4F;    /* Vert tendre */
        }
        
        body {
            background-color: var(--off-white);
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
        
        .stat-number {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--turquoise);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.8rem;
            object-fit: cover;
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
        
        .action-btn:hover {
            background: #f8f9fa;
        }
        
        .badge-sm {
            font-size: 0.7rem;
            padding: 0.25em 0.5em;
        }
        
        /* Badges personnalisés avec la nouvelle palette */
        .bg-orange {
            background-color: var(--orange) !important;
        }
        
        .bg-turquoise {
            background-color: var(--turquoise) !important;
        }
        
        .bg-soft-green {
            background-color: var(--soft-green) !important;
        }
        
        .bg-dark-green {
            background-color: var(--dark-green) !important;
        }
        
        /* Boutons personnalisés */
        .btn-primary {
            background-color: var(--soft-green);
            border-color: var(--soft-green);
        }
        
        .btn-primary:hover {
            background-color: #75a046;
            border-color: #75a046;
        }
        
        .btn-outline-primary {
            color: var(--soft-green);
            border-color: var(--soft-green);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--soft-green);
            border-color: var(--soft-green);
            color: white;
        }
        
        .btn-success {
            background-color: var(--turquoise);
            border-color: var(--turquoise);
        }
        
        .btn-warning {
            background-color: var(--orange);
            border-color: var(--orange);
            color: white;
        }
        
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        
        .profile-container {
            max-width: 100%;
            margin: 0 auto;
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--soft-green) 0%, var(--dark-green) 100%);
            border-radius: 10px;
            color: white;
            margin-bottom: 1.5rem;
        }
        
        .profile-avatar img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255,255,255,0.3);
        }
        
        .profile-info h2 {
            margin: 0 0 0.25rem 0;
            font-size: 1.5rem;
        }
        
        .profile-info p {
            margin: 0 0 0.75rem 0;
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .profile-stats {
            display: flex;
            gap: 1.5rem;
            margin: 0.75rem 0;
        }
        
        .profile-stats div {
            text-align: center;
        }
        
        .profile-stats span {
            display: block;
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .profile-stats small {
            font-size: 0.75rem;
            opacity: 0.8;
        }
        
        .profile-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 0.75rem;
        }
        
        .profile-bio {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }
        
        .profile-details {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            border: 1px solid #e9ecef;
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
        
        .user-avatar-large {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
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
        
        .h1, .h2, .h3, .h4, .h5, .h6 {
            font-weight: 600;
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
        
        /* Graphique avec les nouvelles couleurs */
        .chart-container {
            position: relative;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialisation du graphique avec les nouvelles couleurs
            const ctx = document.getElementById('userActivityChart')?.getContext('2d');
            if (ctx) {
                const userActivityChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
                        datasets: [{
                            label: 'Nouveaux utilisateurs',
                            data: [12, 19, 3, 5, 2, 3],
                            borderColor: '#83AF4F', // Vert tendre
                            backgroundColor: 'rgba(131, 175, 79, 0.1)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    </script>
</div>