<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipementIT extends Model
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

    // Scopes pour les filtres
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('identification', 'like', '%'.$search.'%')
                ->orWhere('nom_public', 'like', '%'.$search.'%')
                ->orWhere('numero_serie', 'like', '%'.$search.'%')
                ->orWhere('adresse_ip', 'like', '%'.$search.'%');
        });
    }

    public function scopeByStatut($query, $statut)
    {
        if ($statut) {
            return $query->where('statut', $statut);
        }
        return $query;
    }

    public function scopeByType($query, $type)
    {
        if ($type) {
            return $query->where('type', $type);
        }
        return $query;
    }

    public function scopeByEmplacement($query, $emplacement)
    {
        if ($emplacement) {
            return $query->where('emplacement', $emplacement);
        }
        return $query;
    }

    public function scopeByMarque($query, $marque)
    {
        if ($marque) {
            return $query->where('marque', $marque);
        }
        return $query;
    }
}
