<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;
    protected $fillable = [ 'equipement_id','utilisateur_id','commentaire_id','statut','equipement_type','incident_sujet','incident_description','incident_nature','rapport_incident','declaration_perte', 'service_id', 'department_id', 'date_incident', 'details_panne', 'lieu_perte', 'observation', 'statut_final', 'technicien_id'];

    protected $casts = [
        'date_incident' => 'date',
    ];

    public function getNomEquipementAttribute()
    {
        switch ($this->equipement_type) {
            case 'ordinateur': return $this->ordinateur?->nom ?? 'Ordinateur #' . $this->equipement_id;
            case 'telephone': return $this->telephone?->modele ?? 'Téléphone #' . $this->equipement_id;
            case 'flotte': return $this->sim_card?->phone_number ?? $this->sim_card?->iccid ?? 'Carte SIM #' . $this->equipement_id;
            case 'moniteur': return $this->monitor?->modele ?? 'Moniteur #' . $this->equipement_id;
            case 'peripherique': return $this->peripherique?->nom ?? 'Périphérique #' . $this->equipement_id;
            case 'imprimante': return 'Imprimante #' . $this->equipement_id;
            case 'logiciel': return 'Logiciel #' . $this->equipement_id;
            case 'reseau': return 'Matériel Réseau #' . $this->equipement_id;
            default: return 'Équipement #' . $this->equipement_id;
        }
    }

    public function getStatutFormateAttribute()
    {
        return str_replace('_', ' ', ucfirst($this->statut_final ?? 'nouveau'));
    }

    public function service(){
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function ordinateur(){
        return $this->belongsTo(ordinateur::class,'equipement_id');
    }
    public function telephone(){
        return $this->belongsTo(TelephoneTablette::class,'equipement_id');
    }
    public function peripherique(){
        return $this->belongsTo(Peripherique::class,'equipement_id');
    }
    public function monitor(){
        return $this->belongsTo(moniteur::class,'equipement_id');
    }
    public function sim_card(){
        return $this->belongsTo(SimCard::class, 'equipement_id');
    }
      public function commentaire()
    {
        return $this->hasMany(Commentaire::class, 'incident_id');
    }
    public function technicien(){
        return $this->belongsTo(User::class, 'technicien_id');
    }

    public function utilisateur(){
        return $this->belongsTo(utilisateur::class, 'utilisateur_id');
    }



    public function utilisateur(){
        return $this->belongsTo(utilisateur::class, 'utilisateur_id');
    }


}