<?php
// app/Models/Peripherique.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peripherique extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'entite',
        'statut',
        'fabricant',
        'lieu',
        'type',
        'modele',
        'usager'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Constantes pour les statuts
    const STATUT_EN_SERVICE = 'En service';
    const STATUT_EN_STOCK = 'En stock';
    const STATUT_HORS_SERVICE = 'Hors service';
    const STATUT_EN_REPARATION = 'En réparation';

    // Constantes pour les types
    const TYPE_CLAVIER = 'Clavier';
    const TYPE_SOURIS = 'Souris';
    const TYPE_WEBCAM = 'Webcam';
    const TYPE_CASQUE = 'Casque';
    const TYPE_ECRAN = 'Écran';
    const TYPE_IMPRIMANTE = 'Imprimante';

    /**
     * Scope pour filtrer par statut
     */
    public function scopeByStatut($query, $statut)
    {
        return $query->where('statut', $statut);
    }

    /**
     * Scope pour filtrer par type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope pour rechercher par nom ou modèle
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('nom', 'like', "%{$search}%")
                    ->orWhere('modele', 'like', "%{$search}%")
                    ->orWhere('fabricant', 'like', "%{$search}%");
    }

    /**
     * Accesseur pour le statut avec couleur
     */
    public function getStatutColorAttribute()
    {
        return match($this->statut) {
            'En service' => 'success',
            'En stock' => 'info',
            'En réparation' => 'warning',
            'Hors service' => 'danger',
            default => 'secondary'
        };
    }
}