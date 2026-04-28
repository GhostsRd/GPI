<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SimCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'iccid',
        'operator',
        'status',
        'activation_date',
        'current_user_id',
        'department',
        'device_model',
        'imei',
        'location',
        'remarks',
    ];

    protected $casts = [
        'activation_date' => 'date',
    ];

    // Relations
    public function currentUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'current_user_id');
    }

    public function assignments(): HasMany
    {
        return $this->hasMany(SimAssignment::class);
    }

    public function histories(): HasMany
    {
        return $this->hasMany(SimHistory::class);
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeAssigned($query)
    {
        return $query->where('status', 'assigned');
    }

    public function scopeLost($query)
    {
        return $query->where('status', 'lost');
    }
}
