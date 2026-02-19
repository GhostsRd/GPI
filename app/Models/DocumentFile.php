<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class DocumentFile extends Model
{
    use HasFactory;

    /**
     * Les attributs qui sont mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'document_id',
        'name',
        'original_name',
        'path',
        'disk',
        'mime_type',
        'extension',
        'size',
        'thumbnail_path',
        'description',
        'order',
        'download_count',
        'is_active',
        'metadata',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'size' => 'integer',
        'order' => 'integer',
        'download_count' => 'integer',
        'is_active' => 'boolean',
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Les valeurs par défaut pour les attributs du modèle.
     *
     * @var array<string, mixed>
     */
    protected $attributes = [
        'order' => 0,
        'download_count' => 0,
        'is_active' => true,
        'metadata' => '[]',
    ];

    /**
     * Boot du modèle.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($file) {
            if (empty($file->original_name) && !empty($file->name)) {
                $file->original_name = $file->name;
            }

            if (empty($file->extension) && !empty($file->original_name)) {
                $file->extension = pathinfo($file->original_name, PATHINFO_EXTENSION);
            }

            if (empty($file->disk)) {
                $file->disk = config('filesystems.default');
            }
        });

        static::deleting(function ($file) {
            // Supprimer le fichier physique si nécessaire
            if ($file->shouldDeleteFileOnModelDelete()) {
                Storage::disk($file->disk)->delete($file->path);
                
                if ($file->thumbnail_path) {
                    Storage::disk($file->disk)->delete($file->thumbnail_path);
                }
            }
        });
    }

    /**
     * Relation avec le document.
     */
    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    /**
     * Relation avec les favoris.
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(DocumentFavorite::class, 'document_id', 'document_id');
    }

    /**
     * Scope pour les fichiers actifs.
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
     * Scope pour les fichiers d'un document spécifique.
     */
    public function scopeForDocument($query, $documentId)
    {
        return $query->where('document_id', $documentId);
    }

    /**
     * Récupérer l'URL du fichier.
     */
    public function getUrlAttribute(): ?string
    {
        if (empty($this->path)) {
            return null;
        }

        return Storage::disk($this->disk)->url($this->path);
    }

    /**
     * Récupérer l'URL de la miniature.
     */
    public function getThumbnailUrlAttribute(): ?string
    {
        if (empty($this->thumbnail_path)) {
            return null;
        }

        return Storage::disk($this->disk)->url($this->thumbnail_path);
    }

    /**
     * Récupérer le chemin absolu du fichier.
     */
    public function getAbsolutePathAttribute(): ?string
    {
        if (empty($this->path)) {
            return null;
        }

        return Storage::disk($this->disk)->path($this->path);
    }

    /**
     * Vérifier si le fichier existe sur le disque.
     */
    public function exists(): bool
    {
        if (empty($this->path)) {
            return false;
        }

        return Storage::disk($this->disk)->exists($this->path);
    }

    /**
     * Récupérer la taille formatée.
     */
    public function getFormattedSizeAttribute(): string
    {
        if ($this->size >= 1073741824) {
            return number_format($this->size / 1073741824, 2) . ' GB';
        } elseif ($this->size >= 1048576) {
            return number_format($this->size / 1048576, 2) . ' MB';
        } elseif ($this->size >= 1024) {
            return number_format($this->size / 1024, 2) . ' KB';
        } else {
            return $this->size . ' octets';
        }
    }

    /**
     * Récupérer le type de fichier.
     */
    public function getFileTypeAttribute(): string
    {
        $mime = $this->mime_type;

        if (str_starts_with($mime, 'video/')) {
            return 'video';
        } elseif (str_starts_with($mime, 'image/')) {
            return 'image';
        } elseif ($mime === 'application/pdf') {
            return 'pdf';
        } elseif (in_array($mime, [
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        ])) {
            return 'document';
        } elseif (in_array($mime, [
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ])) {
            return 'spreadsheet';
        } elseif (in_array($mime, [
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation'
        ])) {
            return 'presentation';
        } elseif (str_starts_with($mime, 'text/')) {
            return 'text';
        } elseif (str_starts_with($mime, 'audio/')) {
            return 'audio';
        } else {
            return 'file';
        }
    }

    /**
     * Récupérer l'icône FontAwesome correspondante.
     */
    public function getIconAttribute(): string
    {
        $icons = [
            'video' => 'fas fa-video',
            'image' => 'fas fa-image',
            'pdf' => 'fas fa-file-pdf',
            'document' => 'fas fa-file-word',
            'spreadsheet' => 'fas fa-file-excel',
            'presentation' => 'fas fa-file-powerpoint',
            'text' => 'fas fa-file-alt',
            'audio' => 'fas fa-file-audio',
            'file' => 'fas fa-file',
        ];

        return $icons[$this->file_type] ?? 'fas fa-file';
    }

    /**
     * Récupérer la couleur associée au type.
     */
    public function getColorAttribute(): string
    {
        $colors = [
            'video' => '#FF9F1C', // Orange
            'image' => '#4CC9F0', // Bleu clair
            'pdf' => '#F56565', // Rouge
            'document' => '#4299E1', // Bleu
            'spreadsheet' => '#10B981', // Vert
            'presentation' => '#9F7AEA', // Violet
            'text' => '#718096', // Gris
            'audio' => '#ED8936', // Orange foncé
            'file' => '#A0AEC0', // Gris clair
        ];

        return $colors[$this->file_type] ?? '#5BC4BF'; // Vert turquoise par défaut
    }

    /**
     * Incrémenter le compteur de téléchargements.
     */
    public function incrementDownloadCount(): self
    {
        $this->increment('download_count');
        return $this;
    }

    /**
     * Vérifier si c'est une vidéo.
     */
    public function isVideo(): bool
    {
        return $this->file_type === 'video';
    }

    /**
     * Vérifier si c'est une image.
     */
    public function isImage(): bool
    {
        return $this->file_type === 'image';
    }

    /**
     * Vérifier si c'est un PDF.
     */
    public function isPdf(): bool
    {
        return $this->file_type === 'pdf';
    }

    /**
     * Vérifier si le fichier peut être prévisualisé.
     */
    public function canBePreviewed(): bool
    {
        return in_array($this->file_type, ['video', 'image', 'pdf', 'text']);
    }

    /**
     * Récupérer le nom sans extension.
     */
    public function getNameWithoutExtensionAttribute(): string
    {
        return pathinfo($this->original_name, PATHINFO_FILENAME);
    }

    /**
     * Déterminer si le fichier doit être supprimé physiquement lors de la suppression du modèle.
     */
    protected function shouldDeleteFileOnModelDelete(): bool
    {
        return config('documentation.delete_files_on_model_delete', true);
    }

    /**
     * Générer une miniature pour le fichier (pour les images et vidéos).
     */
    public function generateThumbnail($width = 300, $height = 300): bool
    {
        // Cette méthode devrait être implémentée avec une bibliothèque de traitement d'image
        // comme Intervention Image ou avec FFmpeg pour les vidéos
        
        return false; // Retourner false pour l'instant, à implémenter selon vos besoins
    }
}