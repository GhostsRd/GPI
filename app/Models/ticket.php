<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;
    protected $table = "tickets";

    protected $fillable = ["id","utilisateur_id","responsable_id","impact","commentaire_id","categorie","state","equipementSeeder","sujet","priorite","details","status","quantite","archive"];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'ticket_id');
    }
    public function responsable()
    {
        return $this->belongsTo(User::class, 'responsable_id');
    }
}
