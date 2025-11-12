<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueSortie extends Model
{
    use HasFactory;

    protected $fillable = [
        'peripherique_id',
        'type_operation',
        'usager',
        'entite',
        'lieu',
        'date_operation',
        'etat',
        'commentaire',
    ];

    protected $casts = [
        'date_operation' => 'datetime',
    ];

    /**
     * Relation avec le périphérique
     */
    public function peripherique()
    {
        return $this->belongsTo(Peripherique::class);
    }

    /**
     * Scope pour les sorties
     */
    public function scopeSorties($query)
    {
        return $query->where('type_operation', 'sortie');
    }

    /**
     * Scope pour les retours
     */
    public function scopeRetours($query)
    {
        return $query->where('type_operation', 'retour');
    }
}