<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipementUtilisateur extends Model
{
    use HasFactory;

    protected $table = 'liaison_equipements';
    
    protected $fillable = [
        'utilisateur_id',
        'type',
        'ordinateur_id',
        'telephone_id',
        'flotte_id',
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

    public function utilisateur()
    {
        return $this->belongsTo(utilisateur::class);
    }

    public function ordinateur()
    {
        return $this->belongsTo(Ordinateur::class);
    }

    public function telephone()
    {
        return $this->belongsTo(Telephone::class);
    }

    public function flotte()
    {
        return $this->belongsTo(Flotte::class);
    }

    // Accesseur pour obtenir l'équipement lié
    public function getEquipementAttribute()
    {
        switch($this->type) {
            case 'ordinateur':
                return $this->ordinateur;
            case 'telephone':
                return $this->telephone;
            case 'flotte':
                return $this->flotte;
            default:
                return null;
        }
    }
}