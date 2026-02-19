<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Document extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'category_id',
        'type',
        'reading_time',
        'views',
        'downloads',
        'is_published',
        'published_at',
        'file_name',
        'file_path',
        'file_size',
        'file_extension',
        'video_url',
        'tags',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'reading_time' => 'integer',
        'views' => 'integer',
        'downloads' => 'integer',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'file_size' => 'integer',
        'tags' => 'array',
    ];

    /**
     * Les valeurs par défaut pour les attributs du modèle.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'reading_time' => 5,
        'views' => 0,
        'downloads' => 0,
        'is_published' => true,
        'tags' => '[]',
    ];

    /**
     * Boot du modèle.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($document) {
            if (empty($document->slug)) {
                $document->slug = Str::slug($document->title);
            }
            
            if (empty($document->published_at) && $document->is_published) {
                $document->published_at = now();
            }
            
            // Générer un slug unique
            $originalSlug = $document->slug;
            $count = 1;
            while (self::where('slug', $document->slug)->exists()) {
                $document->slug = $originalSlug . '-' . $count;
                $count++;
            }
        });
    }

    /**
     * Relation avec la catégorie.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }

    /**
     * Scope pour les documents publiés.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
            ->orderBy('created_at', 'desc');
    }

    /**
     * Scope pour les documents d'une catégorie spécifique.
     */
    public function scopeInCategory($query, $categoryId)
    {
        if ($categoryId === 'all' || empty($categoryId)) {
            return $query;
        }
        
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope pour les documents d'un type spécifique.
     */
    public function scopeOfType($query, $type)
    {
        if (empty($type)) {
            return $query;
        }
        
        return $query->where('type', $type);
    }

    /**
     * Scope pour la recherche.
     */
    public function scopeSearch($query, $search)
    {
        if (empty($search)) {
            return $query;
        }
        
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    /**
     * Incrémenter le compteur de vues.
     */
    public function incrementViews(): self
    {
        $this->views++;
        $this->save();
        return $this;
    }

    /**
     * Incrémenter le compteur de téléchargements.
     */
    public function incrementDownloads(): self
    {
        $this->downloads++;
        $this->save();
        return $this;
    }

    /**
     * Vérifier si c'est une vidéo.
     */
    public function isVideo(): bool
    {
        return $this->type === 'video' || !empty($this->video_url);
    }

    /**
     * Vérifier si c'est un PDF.
     */
    public function isPdf(): bool
    {
        return $this->type === 'pdf' || 
               ($this->file_extension && strtolower($this->file_extension) === 'pdf');
    }

    /**
     * Vérifier si c'est une image.
     */
    public function isImage(): bool
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp'];
        return $this->type === 'image' || 
               ($this->file_extension && in_array(strtolower($this->file_extension), $imageExtensions));
    }

    /**
     * Récupérer l'URL du fichier.
     */
    public function getFileUrl(): ?string
    {
        if (!$this->file_path) {
            return null;
        }
        
        return Storage::url($this->file_path);
    }

    /**
     * Formater la taille du fichier.
     */
    public function getFormattedFileSize(): ?string
    {
        if (!$this->file_size) {
            return null;
        }
        
        $bytes = $this->file_size;
        if ($bytes == 0) return '0 B';
        
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = floor(log($bytes, 1024));
        
        return round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
    }

    /**
     * Accesseur pour la taille formatée.
     */
    public function getFormattedSizeAttribute(): ?string
    {
        return $this->getFormattedFileSize();
    }

    /**
     * Formater le temps de lecture.
     */
    public function getFormattedReadingTime(): string
    {
        if ($this->reading_time < 60) {
            return $this->reading_time . ' min';
        }

        $hours = floor($this->reading_time / 60);
        $minutes = $this->reading_time % 60;

        if ($minutes === 0) {
            return $hours . ' h';
        }

        return $hours . ' h ' . $minutes . ' min';
    }

    /**
     * Relation avec les vues du document
     */
    public function views(): HasMany
    {
        return $this->hasMany(DocumentView::class);
    }
    
    /**
     * Relation avec les téléchargements du document
     */
    public function downloads(): HasMany
    {
        return $this->hasMany(DocumentDownload::class);
    }

    /**
     * Récupérer les documents similaires.
     */
    public function similarDocuments($limit = 4)
    {
        if (!$this->category_id) {
            return collect();
        }
        
        return self::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->where('is_published', true)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }
}