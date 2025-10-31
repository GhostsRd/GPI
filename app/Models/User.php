<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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

    // Méthodes utilitaires pour les rôles
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }

    public function isManager()
    {
        return $this->role === self::ROLE_MANAGER;
    }

    // Méthodes utilitaires pour les statuts
    public function isActive()
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isInactive()
    {
        return $this->status === self::STATUS_INACTIVE;
    }

    public function isSuspended()
    {
        return $this->status === self::STATUS_SUSPENDED;
    }

    // Relation avec les tickets
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'responsable_id');
    }

    // Méthode pour formatter la dernière connexion
    public function getLastLoginFormatted()
    {
        return $this->last_login_at ? $this->last_login_at->format('Y-m-d H:i') : 'Jamais';
    }

    // Méthode pour obtenir la photo ou une image par défaut
    public function getPhotoUrl()
    {
        return $this->photo ? asset('storage/' . $this->photo) : asset('images/default-avatar.png');
    }

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
}