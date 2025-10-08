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
        'name','commentaire_id', 'email', 'password', 'role', 'status', 'last_login_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];

    // Méthodes utilitaires
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function tickets()
    {
    return $this->hasMany(Ticket::class, 'responsable_id');
    }
    public function isActive()
    {
        return $this->status === 'active';
    }

    public function getLastLoginFormatted()
    {
        return $this->last_login_at ? $this->last_login_at->format('Y-m-d H:i') : 'Jamais';
    }
   
}
