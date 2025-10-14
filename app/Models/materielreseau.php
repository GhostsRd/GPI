<?php
// app/Models/MaterielReseau.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterielReseau extends Model
{
    use HasFactory;

    protected $table = 'materiels_reseau';

    protected $fillable = [
        'nom',
        'entite',
        'statut',
        'fabricant',
        'lieu',
        'reseau_ip',
        'type',
        'modele',
        'numero_serie'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scopes pour faciliter les requêtes
    public function scopeEnService($query)
    {
        return $query->where('statut', 'En service');
    }

    public function scopeEnMaintenance($query)
    {
        return $query->where('statut', 'En maintenance');
    }

    public function scopeHorsService($query)
    {
        return $query->where('statut', 'Hors service');
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('nom', 'LIKE', "%{$term}%")
              ->orWhere('entite', 'LIKE', "%{$term}%")
              ->orWhere('fabricant', 'LIKE', "%{$term}%")
              ->orWhere('type', 'LIKE', "%{$term}%")
              ->orWhere('modele', 'LIKE', "%{$term}%")
              ->orWhere('numero_serie', 'LIKE', "%{$term}%")
              ->orWhere('reseau_ip', 'LIKE', "%{$term}%");
        });
    }
}