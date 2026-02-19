<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'phone', 'poste', 'photo', 'lieu_travail', 
        'password', 'role', 'status', 'last_login_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    // Constantes pour les rôles
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';
    const ROLE_MANAGER = 'manager';

    // Constantes pour les statuts
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_SUSPENDED = 'suspended';

    // ==================== RELATIONS ====================

    // Relation avec les tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'responsable_id');
    }

    // RELATION AJOUTÉE : Documents bookmarkés (favoris)
    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany(
            Document::class,      // Modèle Document
            'bookmarks',          // Table pivot
            'user_id',            // Clé étrangère user dans pivot
            'document_id'         // Clé étrangère document dans pivot
        )->withTimestamps();
    }

    // Vérifier si un document est dans les favoris
    public function hasBookmarked($documentId): bool
    {
        return $this->bookmarks()->where('document_id', $documentId)->exists();
    }

    // Ajouter un document aux favoris
    public function addBookmark($documentId): void
    {
        $this->bookmarks()->attach($documentId);
    }

    // Retirer un document des favoris
    public function removeBookmark($documentId): void
    {
        $this->bookmarks()->detach($documentId);
    }

    // Basculer l'état d'un favori
    public function toggleBookmark($documentId): bool
    {
        if ($this->hasBookmarked($documentId)) {
            $this->removeBookmark($documentId);
            return false; // Retiré
        } else {
            $this->addBookmark($documentId);
            return true; // Ajouté
        }
    }

    // ==================== MÉTHODES UTILITAIRES ====================

    // Méthodes utilitaires pour les rôles
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    public function isManager(): bool
    {
        return $this->role === self::ROLE_MANAGER;
    }

    // Méthodes utilitaires pour les statuts
    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isInactive(): bool
    {
        return $this->status === self::STATUS_INACTIVE;
    }

    public function isSuspended(): bool
    {
        return $this->status === self::STATUS_SUSPENDED;
    }

    // Méthode pour formatter la dernière connexion
    public function getLastLoginFormatted(): string
    {
        return $this->last_login_at ? $this->last_login_at->format('Y-m-d H:i') : 'Jamais';
    }

    // Méthode pour obtenir la photo ou une image par défaut
    public function getPhotoUrl(): string
    {
        if ($this->photo) {
            // Vérifier si c'est une URL complète ou un chemin local
            if (filter_var($this->photo, FILTER_VALIDATE_URL)) {
                return $this->photo;
            }
            return asset('storage/' . $this->photo);
        }
        return asset('images/default-avatar.png');
    }

    // ==================== SCOPES ====================

    // Scope pour les utilisateurs actifs
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    // Scope pour les administrateurs
    public function scopeAdmins($query)
    {
        return $query->where('role', self::ROLE_ADMIN);
    }

    // Scope pour les utilisateurs normaux
    public function scopeUsers($query)
    {
        return $query->where('role', self::ROLE_USER);
    }

    // Scope pour les managers
    public function scopeManagers($query)
    {
        return $query->where('role', self::ROLE_MANAGER);
    }

    // Scope pour les utilisateurs avec favoris
    public function scopeWithBookmarks($query)
    {
        return $query->whereHas('bookmarks');
    }

    // ==================== AUTRES MÉTHODES ====================

    // Obtenir le nombre de favoris
    public function getBookmarksCountAttribute(): int
    {
        return $this->bookmarks()->count();
    }

    // Obtenir les documents récemment ajoutés aux favoris
    public function getRecentBookmarks($limit = 5)
    {
        return $this->bookmarks()
            ->with('category')
            ->orderBy('bookmarks.created_at', 'desc')
            ->take($limit)
            ->get();
    }

    // Vérifier si l'utilisateur peut accéder à la documentation
    public function canAccessDocumentation(): bool
    {
        return $this->isActive() && 
               ($this->isAdmin() || $this->isUser() || $this->isManager());
    }

    // Obtenir les statistiques de l'utilisateur
    public function getDocumentationStats(): array
    {
        return [
            'bookmarks_count' => $this->bookmarks_count,
            'recent_bookmarks' => $this->getRecentBookmarks(3)->count(),
            'has_access' => $this->canAccessDocumentation(),
        ];
    }
}