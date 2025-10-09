<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'date_expiration'
    ];

    protected $casts = [
        'date_achat' => 'date',
        'date_expiration' => 'date',
        'nombre_installations' => 'integer',
        'nombre_licences' => 'integer',
    ];

    /**
     * Relation avec les équipements (installations)
     */
    public function equipements()
    {
        return $this->belongsToMany(Equipement::class, 'logiciel_equipement')
                    ->withPivot('date_installation', 'version_installee', 'notes')
                    ->withTimestamps();
    }

    /**
     * Accessor pour le statut des licences
     */
    public function getStatutLicencesAttribute()
    {
        if ($this->nombre_licences == 0) {
            return 'Aucune licence';
        }

        $pourcentage = ($this->nombre_installations / $this->nombre_licences) * 100;

        if ($pourcentage >= 90) {
            return 'Critique';
        } elseif ($pourcentage >= 75) {
            return 'Attention';
        } else {
            return 'Normal';
        }
    }

    /**
     * Accessor pour le pourcentage d'utilisation
     */
    public function getPourcentageUtilisationAttribute()
    {
        if ($this->nombre_licences == 0) {
            return 0;
        }

        return round(($this->nombre_installations / $this->nombre_licences) * 100, 2);
    }

    /**
     * Scope pour les logiciels avec peu de licences
     */
    public function scopeLicencesCritiques($query)
    {
        return $query->whereRaw('nombre_installations >= nombre_licences * 0.9')
                    ->where('nombre_licences', '>', 0);
    }

    /**
     * Scope pour rechercher des logiciels
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('nom', 'like', "%{$search}%")
                    ->orWhere('editeur', 'like', "%{$search}%")
                    ->orWhere('version_nom', 'like', "%{$search}%");
    }

    /**
     * Vérifie si les licences sont dépassées
     */
    public function getLicencesDepasseesAttribute()
    {
        return $this->nombre_licences > 0 && $this->nombre_installations > $this->nombre_licences;
    }

    /**
     * Nombre de licences disponibles
     */
    public function getLicencesDisponiblesAttribute()
    {
        return max(0, $this->nombre_licences - $this->nombre_installations);
    }
}