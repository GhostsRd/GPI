<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;
    protected $table = "tickets";

    protected $fillable = ["id","utilisateur_id","responsable_it","categorie","equipement","sujet","priorite","details","status,quantite"];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }
    public function responsableIT()
    {
        return $this->belongsTo(ResponsableIT::class, 'responsable_it');
    }
}
