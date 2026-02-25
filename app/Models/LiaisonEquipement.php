<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiaisonEquipement extends Model
{
    use HasFactory;

    protected $table = 'liaison_equipements';
    
    protected $fillable = [
        'utilisateur_id',
        'type',
        'ordinateur_id',
        'telephone_id',
        'flotte_id',
        'imprimante_id',
        'moniteur_id',
        'peripherique_id',
        'date_attribution',
        'date_retour_prevue',
        'date_retour_effectif',
        'notes',
        'statut'
    ];

    protected $casts = [
        'date_attribution' => 'date',
        'date_retour_prevue' => 'date',
        'date_retour_effectif' => 'date'
    ];

    // Relation avec l'utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(utilisateur::class, 'utilisateur_id');
    }

    // Relation avec l'ordinateur
    public function ordinateur()
    {
        return $this->belongsTo(ordinateur::class, 'ordinateur_id');
    }

    // Relation avec le téléphone
    public function telephone()
    {
        return $this->belongsTo(Telephone::class, 'telephone_id');
    }

    // Relation avec la flotte
    public function flotte()
    {
        return $this->belongsTo(Flotte::class, 'flotte_id');
    }

    // Relation avec l'imprimante
    public function imprimante()
    {
        return $this->belongsTo(Imprimante::class, 'imprimante_id');
    }

    // Relation avec le moniteur
    public function moniteur()
    {
        return $this->belongsTo(moniteur::class, 'moniteur_id');
    }

    // Relation avec le périphérique
    public function peripherique()
    {
        return $this->belongsTo(Peripherique::class, 'peripherique_id');
    }
}