<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentCategory extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'color',
        'order',
        'is_active',
        'meta_title',
        'meta_description',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'order' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Les valeurs par défaut pour les attributs du modèle.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'order' => 0,
        'is_active' => true,
    ];

    /**
     * Boot du modèle.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = \Illuminate\Support\Str::slug($category->name);
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = \Illuminate\Support\Str::slug($category->name);
            }
        });
    }

    /**
     * Relation avec les documents.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'category_id');
    }

    /**
     * Scope pour les catégories actives.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope pour trier par ordre.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('name');
    }

    /**
     * Récupérer l'URL de la catégorie.
     */
    public function getUrlAttribute(): string
    {
        return route('documentation.category', ['slug' => $this->slug]);
    }

    /**
     * Récupérer le nombre de documents dans la catégorie.
     */
    public function getDocumentCountAttribute(): int
    {
        return $this->documents()->count();
    }

    /**
     * Récupérer les documents récents de la catégorie.
     */
    public function recentDocuments($limit = 5)
    {
        return $this->documents()
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Formater la couleur pour le CSS.
     */
    public function getCssColorAttribute(): string
    {
        if (empty($this->color)) {
            return '#5BC4BF'; // Couleur par défaut
        }

        return $this->color;
    }

    /**
     * Formater l'icône pour FontAwesome.
     */
    public function getFormattedIconAttribute(): string
    {
        $defaultIcons = [
            'guides' => 'fas fa-book',
            'tutorials' => 'fas fa-play-circle',
            'references' => 'fas fa-bookmark',
            'faq' => 'fas fa-question-circle',
            'security' => 'fas fa-shield-alt',
            'procedures' => 'fas fa-list-check',
        ];

        if (array_key_exists($this->slug, $defaultIcons)) {
            return $defaultIcons[$this->slug];
        }

        return $this->icon ?: 'fas fa-folder';
    }

    /**
     * Vérifier si la catégorie a des documents.
     */
    public function hasDocuments(): bool
    {
        return $this->documents()->exists();
    }
}