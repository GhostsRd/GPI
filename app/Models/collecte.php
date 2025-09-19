<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class collecte extends Model
{
    use HasFactory;
    protected $table = "collecte";
    protected $fillable = ["id","quantite","unite","date_collecte","image_quitance","ristourne_calculee","collecteur_id","produit_id","regisseur_id","commune","numero_quitance"];

}
