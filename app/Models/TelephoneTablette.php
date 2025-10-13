<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelephoneTablette extends Model
{
    use HasFactory;

    // Spécifiez le nom de la table si différent du pluriel du modèle
    protected $table = 'telephones_tablettes';

    protected $fillable = [
        'nom',
        'entite',
        'usager',
        'lieu',
        'services',
        'type',
        'marque',
        'modele',
        'numero_serie',
        'statut',
        'emplacement_actuel',
        'imei'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scopes pour filtrer par statut
    public function scopeEnService($query)
    {
        return $query->where('statut', 'En service');
    }

    public function scopeEnStock($query)
    {
        return $query->where('statut', 'En stock');
    }

    public function scopeHorsService($query)
    {
        return $query->where('statut', 'Hors service');
    }

    public function scopeEnReparation($query)
    {
        return $query->where('statut', 'En réparation');
    }
}