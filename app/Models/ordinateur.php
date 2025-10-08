<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordinateur extends Model

{
    use HasFactory;

    protected $fillable = [
        'nom',
        'entite',
        'sous_entite',
        'statut',
        'fabricant',
        'modele',
        'numero_serie',
        'utilisateur_id',
        'usager_id',
        'date_dernier_inventaire',
        'assistance_tickets',
        'reseau_ip',
        'disque_dur',
        'os_version',
        'os_noyau',
        'derniere_date_demarrage',
        'notes'
    ];

    protected $casts = [
        'date_dernier_inventaire' => 'date',
        'derniere_date_demarrage' => 'datetime',
    ];

    /**
     * Relation avec l'utilisateur principal
     */
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    /**
     * Relation avec l'usager secondaire
     */
    public function usager()
    {
        return $this->belongsTo(User::class, 'usager_id');
    }

    /**
     * Scope pour les ordinateurs en service
     */
    public function scopeEnService($query)
    {
        return $query->where('statut', 'En service');
    }

    /**
     * Scope pour les ordinateurs par statut
     */
    public function scopeParStatut($query, $statut)
    {
        return $query->where('statut', $statut);
    }

    /**
     * Accessor pour le nom complet de l'utilisateur
     */
    public function getUtilisateurNomAttribute()
    {
        return $this->utilisateur ? $this->utilisateur->name : 'Non attribué';
    }

    /**
     * Accessor pour le nom complet de l'usager
     */
    public function getUsagerNomAttribute()
    {
        return $this->usager ? $this->usager->name : 'Non attribué';
    }

}
