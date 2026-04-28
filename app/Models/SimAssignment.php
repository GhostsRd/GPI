<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SimAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sim_card_id',
        'user_id',
        'assigned_at',
        'returned_at',
        'status',
        'document_path',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
        'returned_at' => 'datetime',
    ];

    public function simCard(): BelongsTo
    {
        return $this->belongsTo(SimCard::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
