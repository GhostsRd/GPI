<?php

namespace App\Models\equipement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipement extends Model
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
        'description',
    ];

    protected $casts = [
        'date_entree_stock' => 'date',
    ];

    // Constantes pour les statuts
    const STATUT_EN_STOCK = 'en_stock';
    const STATUT_EN_PRET = 'en_pret';
    const STATUT_EN_MAINTENANCE = 'en_maintenance';

    // Constantes pour les couleurs
    const COULEUR_NOIR = 'noir';
    const COULEUR_BLANC = 'blanc';
    const COULEUR_GRIS = 'gris';

    // Scopes pour les filtres
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('identification', 'like', '%' . $search . '%')
                ->orWhere('nom_public', 'like', '%' . $search . '%')
                ->orWhere('numero_serie', 'like', '%' . $search . '%')
                ->orWhere('adresse_ip', 'like', '%' . $search . '%');
        });
    }

    public function scopeByStatut($query, $statut)
    {
        return $statut ? $query->where('statut', $statut) : $query;
    }

    public function scopeByType($query, $type)
    {
        return $type ? $query->where('type', $type) : $query;
    }

    public function scopeByEmplacement($query, $emplacement)
    {
        return $emplacement ? $query->where('emplacement', $emplacement) : $query;
    }

    public function scopeByMarque($query, $marque)
    {
        return $marque ? $query->where('marque', $marque) : $query;
    }
}

