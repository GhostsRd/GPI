<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class qrcode extends Model
{
    use HasFactory;
    protected $table = "collecteur";
    
    protected $fillable = ["id","nom","prenom","CIN","CIF","NIF","STAT","RCS","produit","adresse","url_img"];

}
