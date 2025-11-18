<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $table = "checkouts";

    protected $fillable = [ "utilisateur_id","equipement_id","responsable_id","commentaire_id","statut","materiel_type","materiel_details","date_rendu"];


     public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'checkout_id');
    }
    public function responsable()
    {
        return $this->belongsTo(User::class, 'id');
    }

     public function telephone()
    {
        return $this->belongsTo(TelephoneTablette::class, 'equipement_id');
    }
    public function peripherique(){
        return $this->belongsTo(Peripherique::class, 'equipement_id');
    }

    public function ordinateur()
    {
        return $this->belongsTo(ordinateur::class, 'equipement_id');
    }
    public function materiel(){
        return $this->belongsTo(ordinateur::class, 'equipement_id');
    }
}
