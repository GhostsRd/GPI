<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentFavorite extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'document_id',
        'notes',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Le nom de la table associée au modèle.
     *
     * @var string
     */
    protected $table = 'document_favorites';

    /**
     * Désactiver les timestamps automatiques.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Boot du modèle.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($favorite) {
            // Vérifier qu'un utilisateur ne peut pas ajouter le même document en favori plusieurs fois
            $exists = static::where('user_id', $favorite->user_id)
                ->where('document_id', $favorite->document_id)
                ->exists();

            if ($exists) {
                return false;
            }
        });
    }

    /**
     * Relation avec l'utilisateur.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le document.
     */
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    /**
     * Scope pour un utilisateur spécifique.
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope pour un document spécifique.
     */
    public function scopeForDocument($query, $documentId)
    {
        return $query->where('document_id', $documentId);
    }

    /**
     * Scope pour les favoris récents.
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Ajouter un document aux favoris.
     */
    public static function addToFavorites($userId, $documentId, $notes = null): bool
    {
        $exists = static::where('user_id', $userId)
            ->where('document_id', $documentId)
            ->exists();

        if ($exists) {
            return false;
        }

        return static::create([
            'user_id' => $userId,
            'document_id' => $documentId,
            'notes' => $notes,
        ]) !== null;
    }

    /**
     * Retirer un document des favoris.
     */
    public static function removeFromFavorites($userId, $documentId): bool
    {
        return static::where('user_id', $userId)
            ->where('document_id', $documentId)
            ->delete() > 0;
    }

    /**
     * Vérifier si un document est dans les favoris.
     */
    public static function isFavorite($userId, $documentId): bool
    {
        return static::where('user_id', $userId)
            ->where('document_id', $documentId)
            ->exists();
    }

    /**
     * Récupérer les favoris d'un utilisateur avec pagination.
     */
    public static function getUserFavorites($userId, $perPage = 15)
    {
        return static::with(['document.category'])
            ->where('user_id', $userId)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Compter le nombre de favoris pour un document.
     */
    public static function countForDocument($documentId): int
    {
        return static::where('document_id', $documentId)->count();
    }

    /**
     * Compter le nombre de favoris pour un utilisateur.
     */
    public static function countForUser($userId): int
    {
        return static::where('user_id', $userId)->count();
    }

    /**
     * Formater la date d'ajout.
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('d/m/Y');
    }

    /**
     * Récupérer le temps écoulé depuis l'ajout.
     */
    public function getTimeAgoAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }
}