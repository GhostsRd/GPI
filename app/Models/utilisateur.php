<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class utilisateur extends Authenticatable
{
    use Notifiable;

    protected $table = 'utilisateurs';

    protected $fillable = [
        'matricule',
        'nom',
        'poste',
        'departement',
        'lieu_affectation',
        'photo',
        'sexe',
        'date_naissance',
        'date_embauche',
        'adresse',
        'email',
        'telephone',
        'password',
        'role',
        'two_factor_code',
        'two_factor_expires_at',
        'two_factor_enabled',
        'is_active',
    ];

    protected $casts = [
        'two_factor_expires_at' => 'datetime',
        'two_factor_enabled' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Désactive la colonne remember_token (non présente dans la table utilisateurs).
     */
    public function getRememberTokenName()
    {
        return null;
    }

    /**
     * Génère et enregistre un code 2FA pour l'utilisateur.
     */
    public function generateTwoFactorCode(): string
    {
        $code = str_pad(random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
        
        $this->forceFill([
            'two_factor_code' => $code,
            'two_factor_expires_at' => now()->addMinutes(10),
        ])->save();

        return $code;
    }

    /**
     * Réinitialise le code 2FA après validation réussie.
     */
    public function resetTwoFactorCode(): void
    {
        $this->forceFill([
            'two_factor_code' => null,
            'two_factor_expires_at' => null,
        ])->save();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPasswordFR($token));
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'utilisateur_id');
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class, 'utilisateur_id');
    }

    public function reservations()
    {
        return $this->hasMany(checkoutreserver::class, 'responsable_id');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'user_id');
    }

    public function chat(){
        return $this->belongsTo(Chat::class,'targetmsg_id');
    }

    public function bookmarks()
    {
        return $this->belongsToMany(
            Document::class,
            'bookmarks',
            'user_id',
            'document_id'
        )->withTimestamps();
    }
}
