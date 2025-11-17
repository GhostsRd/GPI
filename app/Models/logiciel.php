<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Logiciel extends Model
{
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
        'statut_licences'
    ];

    protected $casts = [
        'date_achat' => 'date',
        'date_expiration' => 'date',
        'nombre_installations' => 'integer',
        'nombre_licences' => 'integer'
    ];

    // Scope pour les licences critiques
    public function scopeLicencesCritiques($query)
    {
        return $query->where('statut_licences', 'Critique')
                    ->orWhere(function($q) {
                        $q->where('nombre_installations', '>', DB::raw('nombre_licences'))
                         ->where('nombre_licences', '>', 0);
                    });
    }

    // Calcul du statut des licences (accessor)
    public function getStatutLicencesAttribute()
    {
        if ($this->nombre_licences == 0) {
            return 'Aucune licence';
        }

        $ratio = $this->nombre_installations / $this->nombre_licences;

        if ($ratio <= 0.8) {
            return 'Conforme';
        } elseif ($ratio <= 1.0) {
            return 'Alerte';
        } else {
            return 'Critique';
        }
    }
}