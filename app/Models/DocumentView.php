<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentView extends Model
{
     protected $fillable = [
        'document_id', 
        'user_id', 
        'ip_address', 
        'user_agent',
        'duration',
        'page_scroll',
    ];
    
    protected $casts = [
        'duration' => 'integer',
        'page_scroll' => 'integer',
    ];
    
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
