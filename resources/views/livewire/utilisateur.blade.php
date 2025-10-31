<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        .user-avatar-large {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
        }
        .btn-view { color: #17a2b8; }
        .btn-edit { color: #ffc107; }
        .btn-delete { color: #dc3545; }
        .action-btn:hover {
            background: #f8f9fa;
        }
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
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
    </style>
</head>
<body style="background: #f8f9fa;">
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
                    <button class="btn btn-primary d-flex align-items-center">
                        <i class="bi bi-bell me-2"></i> Tester Notification
                    </button>
                    <button class="btn btn-primary d-flex align-items-center">
                        <i class="bi bi-download me-2"></i> Exporter
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
                <h3 class="stat-number">{{ $totalUsers }}</h3>
                <p class="text-muted">Utilisateurs Totaux</p>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card stat-card">
                <div class="stat-icon icon-success">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h3 class="stat-number">{{ $activeUsers }}</h3>
                <p class="text-muted">Utilisateurs Actifs</p>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card stat-card">
                <div class="stat-icon icon-warning">
                    <i class="bi bi-clock-fill"></i>
                </div>
                <h3 class="stat-number">{{ $inactiveUsers }}</h3>
                <p class="text-muted">Utilisateurs Inactifs</p>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card stat-card">
                <div class="stat-icon icon-info">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h3 class="stat-number">{{ $adminUsers }}</h3>
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
                    @foreach($recentUsers as $utilisateur)
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
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Poste</th>
                            <th>Rôle</th>
                            <th>Statut</th>
                            <th>Dernière connexion</th>
                            <th>Date d'inscription</th>
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
                                    <button class="action-btn btn-view" data-bs-toggle="modal" data-bs-target="#viewUserModal" 
                                            data-user-id="{{ $utilisateur->id }}" title="Voir">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="action-btn btn-edit" data-bs-toggle="modal" data-bs-target="#editUserModal" 
                                            data-user-id="{{ $utilisateur->id }}" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="action-btn btn-delete" data-bs-toggle="modal" data-bs-target="#deleteUserModal" 
                                            data-user-id="{{ $utilisateur->id }}" title="Supprimer">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
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
<div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserModalLabel">Profil Utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="profile-container">
                    <div class="profile-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img id="viewUserPhoto" src="" alt="Photo de profil" class="user-avatar-large">
                            </div>
                            <div class="col">
                                <h2 id="viewUserName" class="text-white mb-1"></h2>
                                <p id="viewUserPoste" class="text-white mb-2"></p>
                                <div class="profile-stats">
                                    <div>
                                        <span class="text-white" id="viewUserTickets">0</span>
                                        <small class="text-white">Tickets assignés</small>
                                    </div>
                                    <div>
                                        <span class="text-white" id="viewUserRole">Utilisateur</span>
                                        <small class="text-white">Rôle</small>
                                    </div>
                                    <div>
                                        <span class="text-white" id="viewUserStatus">Actif</span>
                                        <small class="text-white">Statut</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile-bio mt-4">
                        <h5>Informations Personnelles</h5>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p><strong>Email:</strong> <span id="viewUserEmail"></span></p>
                                <p><strong>Téléphone:</strong> <span id="viewUserPhone"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Lieu de travail:</strong> <span id="viewUserLieuTravail"></span></p>
                                <p><strong>Dernière connexion:</strong> <span id="viewUserLastLogin"></span></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p><strong>Date d'inscription:</strong> <span id="viewUserCreatedAt"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour modifier l'utilisateur -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Modifier l'Utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editUserName" class="form-label">Nom complet</label>
                            <input type="text" class="form-control" id="editUserName" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editUserEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editUserEmail" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editUserPhone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="editUserPhone" name="phone">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editUserPoste" class="form-label">Poste</label>
                            <input type="text" class="form-control" id="editUserPoste" name="poste">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editUserLieuTravail" class="form-label">Lieu de travail</label>
                            <input type="text" class="form-control" id="editUserLieuTravail" name="lieu_travail">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editUserRole" class="form-label">Rôle</label>
                            <select class="form-select" id="editUserRole" name="role" required>
                                <option value="user">Utilisateur</option>
                                <option value="manager">Manager</option>
                                <option value="admin">Administrateur</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editUserStatus" class="form-label">Statut</label>
                            <select class="form-select" id="editUserStatus" name="status" required>
                                <option value="active">Actif</option>
                                <option value="inactive">Inactif</option>
                                <option value="suspended">Suspendu</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editUserPhoto" class="form-label">Photo de profil</label>
                            <input type="file" class="form-control" id="editUserPhoto" name="photo" accept="image/*">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-primary" id="saveUserChanges">Enregistrer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour supprimer l'utilisateur -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer l'utilisateur <strong id="deleteUserName"></strong> ?</p>
                <p class="text-danger">Cette action est irréversible et supprimera toutes les données associées à cet utilisateur.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteUser">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialisation du graphique
    const ctx = document.getElementById('userActivityChart').getContext('2d');
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

    // Gestion des modales
    const viewUserModal = new bootstrap.Modal(document.getElementById('viewUserModal'));
    const editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
    const deleteUserModal = new bootstrap.Modal(document.getElementById('deleteUserModal'));

    let currentUserId = null;

    // Événements pour les boutons d'action
    document.querySelectorAll('.btn-view').forEach(button => {
        button.addEventListener('click', function() {
            currentUserId = this.getAttribute('data-user-id');
            loadUserData(currentUserId, 'view');
        });
    });

    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            currentUserId = this.getAttribute('data-user-id');
            loadUserData(currentUserId, 'edit');
        });
    });

    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            currentUserId = this.getAttribute('data-user-id');
            const userName = this.closest('tr').querySelector('.fw-medium').textContent;
            document.getElementById('deleteUserName').textContent = userName;
        });
    });

    // Fonction pour charger les données utilisateur
    function loadUserData(userId, action) {
        // Ici, vous feriez un appel AJAX pour récupérer les données de l'utilisateur
        // Pour l'exemple, on utilise des données simulées
        fetch(`/api/users/${userId}`)
            .then(response => response.json())
            .then(user => {
                if (action === 'view') {
                    populateViewModal(user);
                    viewUserModal.show();
                } else if (action === 'edit') {
                    populateEditModal(user);
                    editUserModal.show();
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur lors du chargement des données utilisateur');
            });
    }

    function populateViewModal(user) {
        document.getElementById('viewUserName').textContent = user.name;
        document.getElementById('viewUserPoste').textContent = user.poste || 'Non renseigné';
        document.getElementById('viewUserEmail').textContent = user.email;
        document.getElementById('viewUserPhone').textContent = user.phone || 'Non renseigné';
        document.getElementById('viewUserLieuTravail').textContent = user.lieu_travail || 'Non renseigné';
        document.getElementById('viewUserLastLogin').textContent = user.last_login_at ? new Date(user.last_login_at).toLocaleDateString('fr-FR') : 'Jamais';
        document.getElementById('viewUserCreatedAt').textContent = new Date(user.created_at).toLocaleDateString('fr-FR');
        document.getElementById('viewUserRole').textContent = user.role === 'admin' ? 'Administrateur' : (user.role === 'manager' ? 'Manager' : 'Utilisateur');
        document.getElementById('viewUserStatus').textContent = user.status === 'active' ? 'Actif' : (user.status === 'inactive' ? 'Inactif' : 'Suspendu');
        
        if (user.photo) {
            document.getElementById('viewUserPhoto').src = `/storage/${user.photo}`;
        } else {
            document.getElementById('viewUserPhoto').src = '/images/default-avatar.png';
        }
    }

    function populateEditModal(user) {
        document.getElementById('editUserName').value = user.name;
        document.getElementById('editUserEmail').value = user.email;
        document.getElementById('editUserPhone').value = user.phone || '';
        document.getElementById('editUserPoste').value = user.poste || '';
        document.getElementById('editUserLieuTravail').value = user.lieu_travail || '';
        document.getElementById('editUserRole').value = user.role;
        document.getElementById('editUserStatus').value = user.status;
    }

    // Sauvegarder les modifications
    document.getElementById('saveUserChanges').addEventListener('click', function() {
        const formData = new FormData(document.getElementById('editUserForm'));
        
        fetch(`/api/users/${currentUserId}`, {
            method: 'PUT',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            editUserModal.hide();
            location.reload(); // Recharger la page pour voir les modifications
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors de la modification de l\'utilisateur');
        });
    });

    // Confirmer la suppression
    document.getElementById('confirmDeleteUser').addEventListener('click', function() {
        fetch(`/api/users/${currentUserId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            deleteUserModal.hide();
            location.reload(); // Recharger la page pour voir les modifications
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Erreur lors de la suppression de l\'utilisateur');
        });
    });
});
</script>
</body>
</html>