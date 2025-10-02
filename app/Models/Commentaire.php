<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_id',
        'utilisateur_id', 
        "etat",
        'commentaire',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
    public function utililateur()
    {
        return $this->belongsTo(utilisateur::class);
    }
}
