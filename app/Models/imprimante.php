<?php
// app/Models/Imprimante.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imprimante extends Model
{
    use HasFactory;

    protected $table = 'imprimantes';

    protected $fillable = [
        'nom',
        'entite',
        'statut',
        'fabricant',
        'reseau_ip',
        'numero_serie',
        'lieu',
        'type',
        'modele'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }

    public function usager()
    {
        return $this->belongsTo(Utilisateur::class, 'usager_id');
    }

    // Scopes pour faciliter les requêtes
    public function scopeEnService($query)
    {
        return $query->where('statut', 'En service');
    }

    public function scopeHorsService($query)
    {
        return $query->where('statut', 'Hors service');
    }

    public function scopeParFabricant($query, $fabricant)
    {
        return $query->where('fabricant', $fabricant);
    }

    public function scopeParEntite($query, $entite)
    {
        return $query->where('entite', $entite);
    }
}