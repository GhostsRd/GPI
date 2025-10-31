<?php

namespace App\Http\Livewire\Utilisateur;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class Dashboard extends Component
{
    use WithPagination, WithFileUploads;

    // Propriétés pour la recherche et filtrage
    public $search = '';
    public $status = '';
    public $role = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    // Propriétés pour la création/édition
    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $phone;
    public $poste;
    public $lieu_travail;
    public $user_role = 'user';
    public $user_status = 'active';
    public $photo;
    public $currentPhoto;

    // Propriétés pour les statistiques
    public $totalUsers = 0;
    public $activeUsers = 0;
    public $inactiveUsers = 0;
    public $adminUsers = 0;
    public $recentUsers = [];

    // Propriétés pour les modals
    public $showUserModal = false;
    public $showDeleteModal = false;
    public $showCreateModal = false;
    public $showEditModal = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
        'role' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshDashboard' => '$refresh',
        'userUpdated' => 'loadStatistics'
    ];

    public function mount()
    {
        $this->loadStatistics();
    }

    /**
     * Charger les statistiques
     */
    public function loadStatistics()
    {
        $this->totalUsers = User::count();
        $this->activeUsers = User::where('status', 'active')->count();
        $this->inactiveUsers = User::where('status', 'inactive')->count();
        $this->adminUsers = User::where('role', 'admin')->count();
        $this->recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();
    }

    /**
     * Règles de validation
     */
    protected function rules()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                $this->showEditModal ? Rule::unique('users')->ignore($this->userId) : 'unique:users'
            ],
            'password' => $this->showEditModal ? 'nullable|min:8|confirmed' : 'required|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'poste' => 'nullable|string|max:255',
            'lieu_travail' => 'nullable|string|max:255',
            'user_role' => 'required|in:user,manager,admin',
            'user_status' => 'required|in:active,inactive,suspended',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];

        return $rules;
    }

    /**
     * Propriété computed pour les utilisateurs
     */
    public function getUsersProperty()
    {
        return User::when($this->search, function($query) {
                $query->where(function($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status, function($query) {
                $query->where('status', $this->status);
            })
            ->when($this->role, function($query) {
                $query->where('role', $this->role);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);
    }

    /**
     * Trier les colonnes
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    /**
     * Réinitialiser les filtres
     */
    public function resetFilters()
    {
        $this->reset(['search', 'status', 'role']);
        $this->resetPage();
    }

    /**
     * Afficher les détails d'un utilisateur
     */
    public function viewUser($userId)
    {
        $user = User::find($userId);
        
        if ($user) {
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->poste = $user->poste;
            $this->lieu_travail = $user->lieu_travail;
            $this->user_role = $user->role;
            $this->user_status = $user->status;
            $this->currentPhoto = $user->photo;
            
            $this->showUserModal = true;
        }
    }

    /**
     * Ouvrir le modal de création
     */
    public function createUser()
    {
        $this->resetCreateForm();
        $this->showCreateModal = true;
    }

    /**
     * Ouvrir le modal d'édition
     */
    public function editUser($userId)
    {
        $user = User::find($userId);
        
        if ($user) {
            $this->userId = $user->id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->poste = $user->poste;
            $this->lieu_travail = $user->lieu_travail;
            $this->user_role = $user->role;
            $this->user_status = $user->status;
            $this->currentPhoto = $user->photo;
            
            $this->showEditModal = true;
        }
    }

    /**
     * Créer un utilisateur
     */
    public function store()
    {
        $this->validate();

        try {
            $userData = [
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'phone' => $this->phone,
                'poste' => $this->poste,
                'lieu_travail' => $this->lieu_travail,
                'role' => $this->user_role,
                'status' => $this->user_status,
            ];

            // Gestion de l'upload de photo
            if ($this->photo) {
                $userData['photo'] = $this->photo->store('users', 'public');
            }

            User::create($userData);

            $this->resetCreateForm();
            $this->showCreateModal = false;
            $this->loadStatistics();

            $this->dispatchBrowserEvent('notification', [
                'type' => 'success',
                'title' => 'Succès',
                'message' => 'Utilisateur créé avec succès'
            ]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('notification', [
                'type' => 'error',
                'title' => 'Erreur',
                'message' => 'Erreur lors de la création de l\'utilisateur: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Mettre à jour un utilisateur
     */
    public function update()
    {
        $this->validate();

        try {
            $user = User::find($this->userId);
            
            if ($user) {
                $userData = [
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'poste' => $this->poste,
                    'lieu_travail' => $this->lieu_travail,
                    'role' => $this->user_role,
                    'status' => $this->user_status,
                ];

                // Mettre à jour le mot de passe seulement si fourni
                if ($this->password) {
                    $userData['password'] = Hash::make($this->password);
                }

                // Gestion de l'upload de photo
                if ($this->photo) {
                    // Supprimer l'ancienne photo
                    if ($user->photo) {
                        Storage::disk('public')->delete($user->photo);
                    }
                    $userData['photo'] = $this->photo->store('users', 'public');
                }

                $user->update($userData);

                $this->resetCreateForm();
                $this->showEditModal = false;
                $this->loadStatistics();

                $this->dispatchBrowserEvent('notification', [
                    'type' => 'success',
                    'title' => 'Succès',
                    'message' => 'Utilisateur mis à jour avec succès'
                ]);
            }

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('notification', [
                'type' => 'error',
                'title' => 'Erreur',
                'message' => 'Erreur lors de la mise à jour de l\'utilisateur: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Confirmer la suppression
     */
    public function confirmDelete($userId)
    {
        $this->userId = $userId;
        $user = User::find($userId);
        if ($user) {
            $this->name = $user->name;
        }
        $this->showDeleteModal = true;
    }

    /**
     * Supprimer un utilisateur
     */
    public function deleteUser()
    {
        try {
            $user = User::find($this->userId);
            
            if ($user) {
                // Empêcher la suppression de son propre compte
                if ($user->id === auth()->id()) {
                    $this->dispatchBrowserEvent('notification', [
                        'type' => 'error',
                        'title' => 'Erreur',
                        'message' => 'Vous ne pouvez pas supprimer votre propre compte'
                    ]);
                    return;
                }

                // Supprimer la photo si elle existe
                if ($user->photo) {
                    Storage::disk('public')->delete($user->photo);
                }

                $user->delete();

                $this->showDeleteModal = false;
                $this->loadStatistics();

                $this->dispatchBrowserEvent('notification', [
                    'type' => 'success',
                    'title' => 'Succès',
                    'message' => 'Utilisateur supprimé avec succès'
                ]);
            }

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('notification', [
                'type' => 'error',
                'title' => 'Erreur',
                'message' => 'Erreur lors de la suppression de l\'utilisateur: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Mettre à jour le statut d'un utilisateur
     */
    public function updateStatus($userId, $status)
    {
        try {
            $user = User::find($userId);
            
            if ($user) {
                $user->update(['status' => $status]);
                $this->loadStatistics();

                $this->dispatchBrowserEvent('notification', [
                    'type' => 'success',
                    'title' => 'Succès',
                    'message' => 'Statut mis à jour avec succès'
                ]);
            }

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('notification', [
                'type' => 'error',
                'title' => 'Erreur',
                'message' => 'Erreur lors de la mise à jour du statut'
            ]);
        }
    }

    /**
     * Tester les notifications
     */
    public function testNotification()
    {
        $this->dispatchBrowserEvent('notification', [
            'type' => 'success',
            'title' => 'Test réussi',
            'message' => 'La notification fonctionne correctement !'
        ]);
    }

    /**
     * Exporter les utilisateurs
     */
    public function exportUsers()
    {
        try {
            $this->dispatchBrowserEvent('notification', [
                'type' => 'info',
                'title' => 'Exportation',
                'message' => 'L\'exportation des utilisateurs a commencé. Fichier en préparation...'
            ]);

            // Simulation de téléchargement
            $this->dispatchBrowserEvent('start-download', [
                'url' => '#',
                'filename' => 'utilisateurs_' . date('Y-m-d') . '.xlsx'
            ]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('notification', [
                'type' => 'error',
                'title' => 'Erreur',
                'message' => 'Erreur lors de l\'exportation: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Réinitialiser le formulaire de création
     */
    public function resetCreateForm()
    {
        $this->reset([
            'userId',
            'name',
            'email',
            'password',
            'password_confirmation',
            'phone',
            'poste',
            'lieu_travail',
            'user_role',
            'user_status',
            'photo',
            'currentPhoto'
        ]);
        $this->resetErrorBag();
    }

    /**
     * Fermer tous les modals
     */
    public function closeModals()
    {
        $this->reset([
            'showUserModal',
            'showDeleteModal',
            'showCreateModal',
            'showEditModal'
        ]);
        $this->resetCreateForm();
    }

    /**
     * Mettre à jour la recherche en temps réel
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function updatingRole()
    {
        $this->resetPage();
    }

    /**
     * Rendu du composant
     */
    public function render()
    {
        return view('livewire.utilisateur.dashboard', [
            'users' => $this->users
        ]);
    }
}