<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class moniteur extends Model

{
    use HasFactory;

    protected $fillable = [
        'nom',
        'entite',
        'statut',
        'fabricant',
        'numero_serie',
        'utilisateur_id',
        'usager_id',
        'lieu',
        'type',
        'modele',
        'commentaires'
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
     * Scope pour les moniteurs en service
     */
    public function scopeEnService($query)
    {
        return $query->where('statut', 'En service');
    }

    /**
     * Scope pour les moniteurs par statut
     */
    public function scopeParStatut($query, $statut)
    {
        return $query->where('statut', $statut);
    }

    /**
     * Scope pour les moniteurs par entité
     */
    public function scopeParEntite($query, $entite)
    {
        return $query->where('entite', $entite);
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

    /**
     * Accessor pour l'affichage du statut avec couleur
     */
    public function getStatutCouleurAttribute()
    {
        return match ($this->statut) {
            'En service' => 'success',
            'En stock' => 'info',
            'En réparation' => 'warning',
            'Hors service' => 'danger',
            default => 'secondary'
        };
    }
}
