<?php

namespace App\Http\Controllers\Documentation;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentPreviewController extends Controller
{
    /**
     * Sert le contenu du fichier de manière sécurisée.
     */
    public function stream($id)
    {
        $document = Document::findOrFail($id);

        // Vérification des permissions
        if (!auth()->check()) {
            abort(403, "Accès non autorisé");
        }

        // Vérification de l'autorisation de téléchargement
        if (request()->has('download') && $document->allow_download === false) {
            abort(403, "Le téléchargement de ce document n'est pas autorisé");
        }

        if (!$document->file_path) {
            abort(404, "Fichier non trouvé");
        }

        $disk = 'public';
        $path = $document->file_path;

        if (Str::startsWith($path, 'google:')) {
            $disk = 'google';
            $path = Str::replaceFirst('google:', '', $path);
        }

        if (!Storage::disk($disk)->exists($path)) {
            abort(404, "Le fichier n'existe pas sur le disque");
        }

        $mimeType = Storage::disk($disk)->mimeType($path);
        
        if ($disk === 'google') {
            // Pour Google Drive, on stream le contenu directement
            $stream = Storage::disk($disk)->readStream($path);
            return response()->stream(function() use ($stream) {
                fpassthru($stream);
                if (is_resource($stream)) {
                    fclose($stream);
                }
            }, 200, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline; filename="' . $document->file_name . '"',
                'Cache-Control' => 'public, max-age=3600',
            ]);
        }

        // Pour le stockage local
        return response()->file(Storage::disk($disk)->path($path), [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $document->file_name . '"',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Génère une URL temporaire ou publique pour les visionneuses externes (Office).
     */
    public function getPublicUrl($id)
    {
        $document = Document::findOrFail($id);
        
        // Si on est en local, on ne peut pas vraiment utiliser les visionneuses Google/MS
        if (config('app.env') === 'local') {
            return null;
        }

        if (!$document->file_path) {
            return null;
        }

        $disk = 'public';
        $path = $document->file_path;

        if (Str::startsWith($path, 'google:')) {
            $disk = 'google';
            $path = Str::replaceFirst('google:', '', $path);
        }

        // Pour les disques S3 ou Google Drive, on peut générer une URL temporaire
        if ($disk === 'google' || $disk === 's3') {
            return Storage::disk($disk)->temporaryUrl($path, now()->addMinutes(30));
        }

        // Pour le disque public, on retourne l'URL publique
        return Storage::disk($disk)->url($path);
    }
}
