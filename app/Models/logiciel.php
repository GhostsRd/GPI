<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Logiciel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'editeur',
        'version_nom',
        'version_systeme_exploitation',
        'nombre_installations',
        'nombre_licences',
        'description',
        'date_achat',
        'date_expiration',
    ];

    protected $casts = [
        'date_achat' => 'date',
        'date_expiration' => 'date',
        'nombre_installations' => 'integer',
        'nombre_licences' => 'integer',
    ];

    // Accesseur pour le statut des licences
    public function getStatutLicencesAttribute()
    {
        if ($this->nombre_licences == 0) {
            return 'Aucune licence';
        }

        if ($this->nombre_installations > $this->nombre_licences) {
            return 'Critique';
        }

        if ($this->nombre_installations == $this->nombre_licences) {
            return 'Attention';
        }

        return 'Normal';
    }

    // Accesseur pour le pourcentage d'utilisation
    public function getPourcentageUtilisationAttribute()
    {
        if ($this->nombre_licences == 0) {
            return 0;
        }
        
        return round(($this->nombre_installations / $this->nombre_licences) * 100);
    }

    // Scope pour les licences critiques
    public function scopeLicencesCritiques($query)
    {
        return $query->where(function($q) {
            $q->where('nombre_installations', '>', DB::raw('nombre_licences'))
              ->where('nombre_licences', '>', 0);
        });
    }
}