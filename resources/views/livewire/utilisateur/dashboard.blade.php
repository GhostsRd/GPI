<div>
    <!-- Container pour les notifications -->
    <div id="notificationContainer"></div>

    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h1 class="h3 fw-bold text-dark mb-1">Dashboard Utilisateurs</h1>
                        <p class="text-muted">Gestion des utilisateurs de l'application</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <button class="btn btn-primary d-flex align-items-center" wire:click="testNotification">
                            <i class="bi bi-bell me-2"></i> Tester Notification
                        </button>
                        <button class="btn btn-primary d-flex align-items-center" wire:click="exportUsers">
                            <i class="bi bi-download me-2"></i> Exporter
                        </button>
                        <button class="btn btn-success d-flex align-items-center" wire:click="createUser">
                            <i class="bi bi-plus-circle me-2"></i> Nouvel Utilisateur
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="dashboard-card stat-card">
                    <div class="stat-icon icon-primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h3 class="stat-number">{{ $totalUsers ?? 0 }}</h3>
                    <p class="text-muted">Utilisateurs Totaux</p>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="dashboard-card stat-card">
                    <div class="stat-icon icon-success">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h3 class="stat-number">{{ $activeUsers ?? 0 }}</h3>
                    <p class="text-muted">Utilisateurs Actifs</p>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="dashboard-card stat-card">
                    <div class="stat-icon icon-warning">
                        <i class="bi bi-clock-fill"></i>
                    </div>
                    <h3 class="stat-number">{{ $inactiveUsers ?? 0 }}</h3>
                    <p class="text-muted">Utilisateurs Inactifs</p>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="dashboard-card stat-card">
                    <div class="stat-icon icon-info">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3 class="stat-number">{{ $adminUsers ?? 0 }}</h3>
                    <p class="text-muted">Administrateurs</p>
                </div>
            </div>
        </div>

        <!-- Charts and User List -->
        <div class="row">
            <!-- Left Column - Charts -->
            <div class="col-xl-8 col-lg-7 mb-4">
                <div class="dashboard-card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Activité des Utilisateurs</h5>
                    </div>
                    <div class="chart-container">
                        <canvas id="userActivityChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Right Column - Recent Users -->
            <div class="col-xl-4 col-lg-5 mb-4">
                <div class="dashboard-card p-4">
                    <h5 class="fw-bold mb-4">Utilisateurs Récents</h5>
                    <div class="recent-users">
                        @foreach($recentUsers ?? [] as $utilisateur)
                            <div class="d-flex align-items-center mb-3">
                                @if($utilisateur->photo)
                                    <img src="{{ asset('storage/' . $utilisateur->photo) }}" alt="Photo profil" class="user-avatar me-3">
                                @else
                                    <div class="user-avatar me-3">
                                        {{ strtoupper(substr($utilisateur->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="flex-grow-1">
                                    <p class="mb-0 fw-medium">{{ $utilisateur->name }}</p>
                                    <small class="text-muted">{{ $utilisateur->email }}</small>
                                </div>
                                <span class="badge {{ $utilisateur->status === 'active' ? 'bg-success' : ($utilisateur->status === 'inactive' ? 'bg-warning' : 'bg-danger') }}">
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
                <div class="dashboard-card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                        <h5 class="fw-bold mb-0">Liste des Utilisateurs</h5>
                        <div class="d-flex gap-2 flex-wrap">
                            <div class="search-box">
                                <i class="bi bi-search"></i>
                                <input type="text" class="form-control" placeholder="Rechercher..." wire:model.debounce.300ms="search">
                            </div>
                            <select class="form-select" wire:model="status" style="width: auto;">
                                <option value="">Tous les statuts</option>
                                <option value="active">Actif</option>
                                <option value="inactive">Inactif</option>
                                <option value="suspended">Suspendu</option>
                            </select>
                            <select class="form-select" wire:model="role" style="width: auto;">
                                <option value="">Tous les rôles</option>
                                <option value="user">Utilisateur</option>
                                <option value="manager">Manager</option>
                                <option value="admin">Administrateur</option>
                            </select>
                            <button class="btn btn-outline-secondary" wire:click="resetFilters">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th wire:click="sortBy('name')" style="cursor: pointer;">
                                        Utilisateur
                                        @if($sortField === 'name')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </th>
                                    <th>Email</th>
                                    <th>Téléphone</th>
                                    <th>Poste</th>
                                    <th wire:click="sortBy('role')" style="cursor: pointer;">
                                        Rôle
                                        @if($sortField === 'role')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </th>
                                    <th wire:click="sortBy('status')" style="cursor: pointer;">
                                        Statut
                                        @if($sortField === 'status')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
                                        @endif
                                    </th>
                                    <th>Dernière connexion</th>
                                    <th wire:click="sortBy('created_at')" style="cursor: pointer;">
                                        Date d'inscription
                                        @if($sortField === 'created_at')
                                            <i class="bi bi-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}"></i>
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
                                                    <img src="{{ asset('storage/' . $utilisateur->photo) }}" alt="Photo profil" class="user-avatar me-3">
                                                @else
                                                    <div class="user-avatar me-3">
                                                        {{ strtoupper(substr($utilisateur->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="mb-0 fw-medium">{{ $utilisateur->name }}</p>
                                                    <small class="text-muted">ID: {{ $utilisateur->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $utilisateur->email }}</td>
                                        <td>{{ $utilisateur->phone ?? 'Non renseigné' }}</td>
                                        <td>{{ $utilisateur->poste ?? 'Non renseigné' }}</td>
                                        <td>
                                            <span class="badge {{ $utilisateur->role === 'admin' ? 'bg-danger' : ($utilisateur->role === 'manager' ? 'bg-warning' : 'bg-primary') }}">
                                                {{ $utilisateur->role === 'admin' ? 'Administrateur' : ($utilisateur->role === 'manager' ? 'Manager' : 'Utilisateur') }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge {{ $utilisateur->status === 'active' ? 'bg-success' : ($utilisateur->status === 'inactive' ? 'bg-warning' : 'bg-danger') }}">
                                                {{ $utilisateur->status === 'active' ? 'Actif' : ($utilisateur->status === 'inactive' ? 'Inactif' : 'Suspendu') }}
                                            </span>
                                        </td>
                                        <td>{{ $utilisateur->last_login_at ? $utilisateur->last_login_at->diffForHumans() : 'Jamais' }}</td>
                                        <td>{{ $utilisateur->created_at->format('d/m/Y') }}</td>
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
                                        <td colspan="8" class="text-center py-4">
                                            <i class="bi bi-people display-4 text-muted d-block mb-2"></i>
                                            <p class="text-muted mb-0">Aucun utilisateur trouvé</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
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
    <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg">
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
                                <h2>{{ $name }}</h2>
                                <p>{{ $poste ?? 'Non renseigné' }}</p>
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
                                    <button class="btn btn-primary" wire:click="editUser({{ $userId }})">
                                        <i class="bi bi-pencil me-2"></i>Modifier
                                    </button>
                                    <button class="btn btn-outline-light" wire:click="closeModals">
                                        <i class="bi bi-x me-2"></i>Fermer
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="profile-bio mt-4">
                            <h5>À propos</h5>
                            <p class="mt-3">
                                {{ $poste ? "Spécialisé en {$poste}" : "Utilisateur de la plateforme" }} 
                                @if($lieu_travail)
                                    basé à {{ $lieu_travail }}.
                                @endif
                                Compte {{ $user_status === 'active' ? 'actif' : ($user_status === 'inactive' ? 'inactif' : 'suspendu') }}.
                            </p>
                        </div>

                        <div class="profile-details mt-4">
                            <h5>Détails du Profil</h5>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <div class="detail-item mb-3">
                                        <strong><i class="bi bi-envelope me-2"></i>Email</strong>
                                        <p class="mb-0">{{ $email }}</p>
                                    </div>
                                    <div class="detail-item mb-3">
                                        <strong><i class="bi bi-telephone me-2"></i>Téléphone</strong>
                                        <p class="mb-0">{{ $phone ?? 'Non renseigné' }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="detail-item mb-3">
                                        <strong><i class="bi bi-briefcase me-2"></i>Poste</strong>
                                        <p class="mb-0">{{ $poste ?? 'Non renseigné' }}</p>
                                    </div>
                                    <div class="detail-item mb-3">
                                        <strong><i class="bi bi-geo-alt me-2"></i>Lieu de travail</strong>
                                        <p class="mb-0">{{ $lieu_travail ?? 'Non renseigné' }}</p>
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
    <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Créer un Nouvel Utilisateur</h5>
                    <button type="button" class="btn-close" wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom complet <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="name" required>
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" wire:model="email" required>
                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Mot de passe <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" wire:model="password" required>
                                @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Confirmation du mot de passe <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" wire:model="password_confirmation" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" wire:model="phone">
                                @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Poste</label>
                                <input type="text" class="form-control" wire:model="poste">
                                @error('poste') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lieu de travail</label>
                                <input type="text" class="form-control" wire:model="lieu_travail">
                                @error('lieu_travail') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rôle <span class="text-danger">*</span></label>
                                <select class="form-select" wire:model="user_role" required>
                                    <option value="user">Utilisateur</option>
                                    <option value="manager">Manager</option>
                                    <option value="admin">Administrateur</option>
                                </select>
                                @error('user_role') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Statut <span class="text-danger">*</span></label>
                                <select class="form-select" wire:model="user_status" required>
                                    <option value="active">Actif</option>
                                    <option value="inactive">Inactif</option>
                                    <option value="suspended">Suspendu</option>
                                </select>
                                @error('user_status') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Photo de profil</label>
                                <input type="file" class="form-control" wire:model="photo" accept="image/*">
                                @error('photo') <span class="text-danger small">{{ $message }}</span> @enderror
                                @if($photo)
                                    <div class="mt-2">
                                        <small>Aperçu :</small>
                                        <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModals">Annuler</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle me-2"></i>Créer l'utilisateur
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
    <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modifier l'Utilisateur</h5>
                    <button type="button" class="btn-close" wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nom complet <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" wire:model="name" required>
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" wire:model="email" required>
                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nouveau mot de passe</label>
                                <input type="password" class="form-control" wire:model="password">
                                @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                                <small class="text-muted">Laissez vide pour ne pas modifier</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Confirmation du mot de passe</label>
                                <input type="password" class="form-control" wire:model="password_confirmation">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" wire:model="phone">
                                @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Poste</label>
                                <input type="text" class="form-control" wire:model="poste">
                                @error('poste') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Lieu de travail</label>
                                <input type="text" class="form-control" wire:model="lieu_travail">
                                @error('lieu_travail') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rôle <span class="text-danger">*</span></label>
                                <select class="form-select" wire:model="user_role" required>
                                    <option value="user">Utilisateur</option>
                                    <option value="manager">Manager</option>
                                    <option value="admin">Administrateur</option>
                                </select>
                                @error('user_role') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Statut <span class="text-danger">*</span></label>
                                <select class="form-select" wire:model="user_status" required>
                                    <option value="active">Actif</option>
                                    <option value="inactive">Inactif</option>
                                    <option value="suspended">Suspendu</option>
                                </select>
                                @error('user_status') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Photo de profil</label>
                                <input type="file" class="form-control" wire:model="photo" accept="image/*">
                                @error('photo') <span class="text-danger small">{{ $message }}</span> @enderror
                                
                                @if($currentPhoto)
                                    <div class="mt-2">
                                        <small>Photo actuelle :</small>
                                        <img src="{{ asset('storage/' . $currentPhoto) }}" class="img-thumbnail mt-1" style="max-height: 100px;">
                                    </div>
                                @endif
                                
                                @if($photo)
                                    <div class="mt-2">
                                        <small>Nouvelle photo :</small>
                                        <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail mt-1" style="max-height: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModals">Annuler</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Enregistrer les modifications
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
    <div class="modal fade show" style="display: block; background: rgba(0,0,0,0.5);" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" wire:click="closeModals"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="bi bi-exclamation-triangle text-danger display-4"></i>
                        <h4 class="mt-3">Êtes-vous sûr ?</h4>
                        <p class="text-muted">
                            Vous êtes sur le point de supprimer l'utilisateur <strong>{{ $name }}</strong>. 
                            Cette action est irréversible et supprimera toutes les données associées.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModals">Annuler</button>
                    <button type="button" class="btn btn-danger" wire:click="deleteUser">
                        <i class="bi bi-trash me-2"></i>Supprimer définitivement
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <style>
        .dashboard-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border: none;
        }
        .stat-card {
            padding: 20px;
            text-align: center;
        }
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 24px;
        }
        .icon-primary { background: #e3f2fd; color: #1976d2; }
        .icon-success { background: #e8f5e8; color: #388e3c; }
        .icon-warning { background: #fff3e0; color: #f57c00; }
        .icon-info { background: #e0f2f1; color: #00796b; }
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            object-fit: cover;
        }
        .search-box {
            position: relative;
        }
        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        .search-box .form-control {
            padding-left: 35px;
        }
        .action-btn {
            border: none;
            background: none;
            padding: 5px 8px;
            border-radius: 4px;
            margin: 0 2px;
            transition: background-color 0.2s;
        }
        .btn-view { color: #17a2b8; }
        .btn-edit { color: #ffc107; }
        .btn-delete { color: #dc3545; }
        .action-btn:hover {
            background: #f8f9fa;
        }
        .profile-container {
            max-width: 100%;
            margin: 0 auto;
        }
        .profile-header {
            display: flex;
            align-items: center;
            gap: 2rem;
            padding: 2rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            color: white;
            margin-bottom: 2rem;
        }
        .profile-avatar img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(255,255,255,0.3);
        }
        .profile-info h2 {
            margin: 0 0 0.5rem 0;
            font-size: 1.8rem;
        }
        .profile-info p {
            margin: 0 0 1rem 0;
            opacity: 0.9;
        }
        .profile-stats {
            display: flex;
            gap: 2rem;
            margin: 1rem 0;
        }
        .profile-stats div {
            text-align: center;
        }
        .profile-stats span {
            display: block;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .profile-stats small {
            font-size: 0.875rem;
            opacity: 0.8;
        }
        .profile-actions {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        .profile-bio {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }
        .profile-details {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            border: 1px solid #e9ecef;
        }
        .detail-item {
            padding: 0.5rem 0;
            border-bottom: 1px solid #f8f9fa;
        }
        .detail-item:last-child {
            border-bottom: none;
        }
        .detail-item strong {
            color: #495057;
            display: flex;
            align-items: center;
            margin-bottom: 0.25rem;
        }
        .user-avatar-large {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialisation du graphique
            const ctx = document.getElementById('userActivityChart')?.getContext('2d');
            if (ctx) {
                const userActivityChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
                        datasets: [{
                            label: 'Nouveaux utilisateurs',
                            data: [12, 19, 3, 5, 2, 3],
                            borderColor: '#4e73df',
                            backgroundColor: 'rgba(78, 115, 223, 0.1)',
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