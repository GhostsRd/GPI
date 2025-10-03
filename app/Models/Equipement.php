<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    use HasFactory;
    protected $fillable = [
        'identification',
        'nom_public',
        'emplacement',
        'marque',
        'model',
        'type',
        'numero_serie',
        'couleur',
        'technologie_impression',
        'reference_cartouche',
        'date_entree_stock',
        'adresse_ip',
        'statut',
        'description'
    ];

    protected $casts = [
        'date_entree_stock' => 'date',
    ];
}


