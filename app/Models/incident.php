<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
        'utilisateur_id',
        'service_id',
        'departement_id',
        'type_materiel',
        'materiel_id',
        'date_incident',
        'nature_incident',
        'numero_rapport',
        'details_panne',
        'lieu_perte',
        'observation',
        'statut_final',
        'technicien_id'
    ];

    protected $casts = [
        'date_incident' => 'date',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'utilisateur_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'departement_id');
    }

    public function technicien()
    {
        return $this->belongsTo(User::class, 'technicien_id');
    }

    // Méthode pour récupérer le nom de l'équipement
    public function getNomEquipementAttribute()
    {
        if (!$this->materiel_id || !$this->type_materiel) {
            return 'N/A';
        }

        switch ($this->type_materiel) {
            case 'ordinateur':
                $equipement = Ordinateur::find($this->materiel_id);
                return $equipement ? ($equipement->nom ?? $equipement->modele ?? 'N/A') : 'N/A';
            case 'imprimante':
                $equipement = Imprimante::find($this->materiel_id);
                return $equipement ? ($equipement->modele ?? $equipement->marque ?? 'N/A') : 'N/A';
            case 'telephone':
                $equipement = Telephone::find($this->materiel_id);
                return $equipement ? ($equipement->modele ?? $equipement->marque ?? 'N/A') : 'N/A';
            case 'logiciel':
                $equipement = Logiciel::find($this->materiel_id);
                return $equipement ? ($equipement->nom ?? $equipement->version ?? 'N/A') : 'N/A';
            case 'peripherique':
                $equipement = Peripherique::find($this->materiel_id);
                return $equipement ? ($equipement->type ?? $equipement->marque ?? 'N/A') : 'N/A';
            case 'moniteur':
                $equipement = Moniteur::find($this->materiel_id);
                return $equipement ? ($equipement->modele ?? $equipement->marque ?? 'N/A') : 'N/A';
            case 'reseau':
                $equipement = MaterielReseau::find($this->materiel_id);
                return $equipement ? ($equipement->type ?? $equipement->modele ?? 'N/A') : 'N/A';
            default:
                return 'N/A';
        }
    }

    // Méthode pour récupérer le statut formaté
    public function getStatutFormateAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->statut_final));
    }
}