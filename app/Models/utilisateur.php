<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class utilisateur extends Authenticatable
{
    use Notifiable;

    protected $table = 'utilisateurs';

    protected $fillable = [
        'matricule',
        'nom',
        'poste',
        'departement',
        'lieu_affectation',
        'photo',
        'sexe',
        'date_naissance',
        'date_embauche',
        'adresse',
        'email',
        'telephone',
        'password',
        'role',
    ];

    public function tickets()
    {
    return $this->hasMany(Ticket::class, 'utilisateur_id');
}

}
