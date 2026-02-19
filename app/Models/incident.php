<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;
    protected $fillable = [ 'equipement_id','utilisateur_id','commentaire_id','statut','equipement_type','incident_sujet','incident_description','incident_nature','rapport_incident','declaration_perte'];

    public function utilisateur(){
         return $this->belongsTo(utilisateur::class, 'utilisateur_id');
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
    public function commentaire()
    {
        return $this->hasMany(Commentaire::class, 'incident_id');
    }
    public function technicien(){
        return $this->belongsTo(User::class, 'technicien_id');
    }
}