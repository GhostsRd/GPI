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

    public function checkouts()
    {
        return $this->hasMany(Checkout::class, 'utilisateur_id');
    }

    public function reservations()
    {
        return $this->hasMany(checkoutreserver::class, 'responsable_id');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'user_id');
    }

    public function chat(){
        return $this->belongsTo(Chat::class,'targetmsg_id');
    }

    public function bookmarks()
    {
        return $this->belongsToMany(
            Document::class,
            'bookmarks',
            'user_id',
            'document_id'
        )->withTimestamps();
    }
}
