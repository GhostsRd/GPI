<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordinateur extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'entite', 
        'sous_entite',
        'statut',
        'fabricant',
        'modele',
        'numero_serie',
        'utilisateur_id',
        'usager_id',
        'date_dernier_inventaire',
        'reseau_ip',
        'disque_dur',
        'os_version',
        'os_noyau',
        'derniere_date_demarrage',
        'notes'
    ];

    protected $casts = [
        'date_dernier_inventaire' => 'date',
        'derniere_date_demarrage' => 'datetime',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function usager()
    {
        return $this->belongsTo(Utilisateur::class, 'usager_id');
    }

      public function reservedCheckout()
    {
        return $this->belongsTo(checkoutreserver::class,'equipement_id');
    }
}