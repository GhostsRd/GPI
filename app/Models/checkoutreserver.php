<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class checkoutreserver extends Model
{
    use HasFactory;

    protected $fillable = ['equipement_id','statut','responsable_id','commentaire_id','commentaire','equipement_type','date_debut','date_fin','equipement_nombre'];

    public function ordinateur(){
          return $this->belongsTo(ordinateur::class, 'equipement_id');
    }

    public function responsable(){
          return $this->belongsTo(utilisateur::class, 'responsable_id');
    }
    public function commentaires(){
      return $this->hasMany(Commentaire::class, 'commentaire_id');
    }
    

    public function TelephoneTablette(){
         return $this->belongsTo(TelephoneTablette::class, 'equipement_id');
    }
}
