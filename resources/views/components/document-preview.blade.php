@props(['document'])

@php
    $extension = strtolower($document->file_extension ?? pathinfo($document->file_path, PATHINFO_EXTENSION));
    $type = $document->type ?? 'file';
    
    // Déterminer le type réel si non défini
    if ($type === 'file' || empty($type)) {
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp'])) $type = 'image';
        elseif (in_array($extension, ['mp4', 'webm', 'ogg'])) $type = 'video';
        elseif ($extension === 'pdf') $type = 'pdf';
        elseif (in_array($extension, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'])) $type = 'office';
    }

    $streamUrl = route('admin.documents.stream', $document->id);
    $isLocal = config('app.env') === 'local';
@endphp

<div class="document-preview-container w-100 h-100 d-flex flex-column align-items-center justify-content-center bg-light rounded" style="min-height: 400px; position: relative;">
    
    @if($type === 'image')
        <div class="preview-wrapper p-3 text-center">
            <img src="{{ $streamUrl }}" alt="{{ $document->title }}" class="img-fluid rounded shadow-sm" style="max-height: 70vh; object-fit: contain;">
        </div>

    @elseif($type === 'video')
        <div class="preview-wrapper w-100 p-2">
            <video controls class="w-100 rounded shadow" style="max-height: 70vh; background: #000;">
                <source src="{{ $streamUrl }}" type="video/{{ $extension === 'mp4' ? 'mp4' : ($extension === 'webm' ? 'webm' : 'ogg') }}">
                Votre navigateur ne supporte pas la lecture de vidéos.
            </video>
        </div>

    @elseif($type === 'pdf')
        <div class="preview-wrapper pdf-viewer-wrapper w-100 h-100" style="min-height: 800px; background: #525659; padding: 1.5rem 1rem; overflow-y: auto;">
            <div class="pdf-page-container shadow-lg" style="width: 100%; max-width: 1200px; margin: 0 auto; background: white; height: auto; min-height: 100%; box-shadow: 0 0 20px rgba(0,0,0,0.3) !important;">
                <iframe src="{{ $streamUrl }}#view=FitH" width="100%" height="1200px" style="border: none; display: block;" title="{{ $document->title }}"></iframe>
            </div>
        </div>

    @elseif($type === 'office')
        @if(!$isLocal)
            <div class="preview-wrapper pdf-viewer-wrapper w-100 h-100" style="min-height: 800px; background: #525659; padding: 1.5rem 1rem; overflow-y: auto;">
                @php
                    $fileUrl = $document->getFileUrl();
                    // On privilégie Office Online pour la fidélité de rendu
                    $previewUrl = "https://view.officeapps.live.com/op/embed.aspx?src=" . urlencode($fileUrl);
                    
                    // Fallback vers Google Docs Viewer si spécifié ou en secours
                    $googlePreviewUrl = "https://docs.google.com/viewer?url=" . urlencode($fileUrl) . "&embedded=true";
                @endphp
                
                <div class="pdf-page-container shadow-lg" style="width: 100%; max-width: 1200px; margin: 0 auto; background: white; height: auto; min-height: 100%;">
                    <iframe src="{{ $previewUrl }}" 
                            width="100%" height="1000px" style="border: none; display: block;"
                            onerror="this.src='{{ $googlePreviewUrl }}'"></iframe>
                </div>
                
                <div class="mt-3 text-center">
                    <div class="d-inline-flex gap-3 p-2 bg-dark bg-opacity-25 rounded-pill px-4">
                        <small class="text-white">Problème d'affichage ? </small>
                        <a href="{{ $googlePreviewUrl }}" target="_blank" class="text-info small fw-bold" style="text-decoration:none">
                            <i class="fab fa-google me-1"></i> Via Google Viewer
                        </a>
                        <span class="text-white-50">|</span>
                        <a href="{{ $fileUrl }}" target="_blank" class="text-info small fw-bold" style="text-decoration:none">
                            <i class="fas fa-external-link-alt me-1"></i> Lien direct
                        </a>
                    </div>
                </div>
            </div>
        @else
            {{-- Fallback pour le local --}}
            <div class="text-center p-5">
                <div class="mb-4">
                    @if(in_array($extension, ['doc', 'docx']))
                        <i class="fas fa-file-word fa-5x text-primary" style="color: #2b579a !important"></i>
                    @elseif(in_array($extension, ['xls', 'xlsx']))
                        <i class="fas fa-file-excel fa-5x text-success" style="color: #217346 !important"></i>
                    @else
                        <i class="fas fa-file-powerpoint fa-5x text-danger" style="color: #b7472a !important"></i>
                    @endif
                </div>
                <h4 class="mb-3">Aperçu indisponible en mode local</h4>
                <p class="text-muted mb-4">Les fichiers Office nécessitent un accès public par internet pour la prévisualisation via Microsoft/Google.</p>
                @if($document->allow_download !== false)
                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ $streamUrl }}?download=1" class="btn btn-primary shadow-sm px-4">
                            <i class="fas fa-download me-2"></i> Télécharger
                        </a>
                    </div>
                @endif
            </div>
        @endif

    @else
        <div class="text-center p-5">
            <div class="mb-4 text-secondary">
                <i class="fas fa-file-alt fa-5x"></i>
            </div>
            <h4>Aucun aperçu disponible</h4>
            <p class="text-muted mb-4">Ce format de fichier ({{ strtoupper($extension) }}) ne peut pas être visualisé directement dans le navigateur.</p>
            @if($document->allow_download !== false)
                <a href="{{ $streamUrl }}?download=1" class="btn btn-secondary shadow-sm">
                    <i class="fas fa-download me-2"></i> Télécharger le fichier
                </a>
            @endif
        </div>
    @endif

</div>

<style>
    .document-preview-container {
        background-image: 
            linear-gradient(45deg, #f0f0f0 25%, transparent 25%), 
            linear-gradient(-45deg, #f0f0f0 25%, transparent 25%), 
            linear-gradient(45deg, transparent 75%, #f0f0f0 75%), 
            linear-gradient(-45deg, transparent 75%, #f0f0f0 75%);
        background-size: 20px 20px;
        background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
        transition: all 0.3s ease;
    }
    .preview-wrapper {
        display: flex;
        align-items: flex-start; /* Changé de center pour éviter de couper le haut des documents longs */
        justify-content: center;
        flex-grow: 1;
        width: 100%;
        height: 100%;
    }

    /* Styles pour le mode plein écran */
    .fullscreen-mode .document-preview-container {
        position: fixed;
        inset: 0;
        z-index: 10001;
        background: #000;
        border-radius: 0 !important;
    }

    .fullscreen-mode .preview-wrapper img,
    .fullscreen-mode .preview-wrapper video {
        max-height: 95vh !important;
        width: auto;
        max-width: 100%;
    }

    .fullscreen-mode .preview-wrapper iframe {
        height: 100vh !important;
        border-radius: 0 !important;
    }

    /* Styles spécifiques pour le viewer PDF A4 */
    .pdf-viewer-wrapper::-webkit-scrollbar {
        width: 8px;
    }
    .pdf-viewer-wrapper::-webkit-scrollbar-track {
        background: #444;
    }
    .pdf-viewer-wrapper::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }
    
    .fullscreen-mode .pdf-viewer-wrapper {
        padding: 0 !important;
        background: #333 !important;
    }
    
    .fullscreen-mode .pdf-page-container {
        max-width: 100% !important;
        margin: 0 !important;
        box-shadow: none !important;
    }
    
    .fullscreen-mode .pdf-page-container iframe {
        height: 100vh !important;
        width: 100vw !important;
    }
</style>
