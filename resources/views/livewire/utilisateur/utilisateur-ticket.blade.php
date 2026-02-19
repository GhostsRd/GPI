<div class="row g-3">
    <!-- Sidebar - Détails du ticket -->
    <div class="col-lg-4 col-xl-3">
        <div class="card sidebar-ticket shadow-sm border-0 rounded-4">
            <!-- En-tête -->
            <div class="card-header border-0 bg-transparent px-4 pt-4 pb-0">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" viewBox="0 0 24 24" 
                             fill="none" stroke="currentColor" stroke-width="1.5" class="text-primary">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                  d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h6 class="fw-bold ms-2 mb-0 text-dark small">Détails du ticket</h6>
                    </div>
                    <span class="badge px-3 py-1 small rounded-pill fw-medium
                        {{ $ticketvals->state == 1 ? 'bg-info' : ($ticketvals->state == 2 ? 'bg-primary' : ($ticketvals->state == 3 ? 'bg-warning' : 'bg-success')) }}">
                        {{ $ticketvals->state == 1 ? 'Assigné' : ($ticketvals->state == 2 ? 'En traitement' : ($ticketvals->state == 3 ? 'En attente' : 'Résolu')) }}
                    </span>
                </div>
                <div class="text-end">
                    <span class="text-muted smaller">#{{ $ticketvals->id }}</span>
                </div>
            </div>

            <!-- Corps -->
            <div class="card-body px-4 pt-3 pb-4">
                <form method="POST">
                    @csrf

                    <!-- Utilisateur -->
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}&background=4361ee&color=fff&size=40"
                             alt="Profil"
                             class="rounded-circle shadow-sm me-3" width="38" height="38">
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-semibold small">{{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}</h6>
                            <small class="text-muted smaller">{{ $ticketvals->utilisateur->email }}</small>
                        </div>
                    </div>

                    <!-- Sujet -->
                    <div class="mb-3 pt-2">
                        <label class="form-label fw-semibold text-secondary mb-1 small">Sujet</label>
                        <div class="ticket-value">{{ $ticketvals->sujet }}</div>
                    </div>

                    <!-- Priorité & Impact -->
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold text-secondary mb-1 small">Priorité</label>
                            <div>
                                <span class="badge priority-badge small px-2 py-1 rounded-2
                                    {{ $ticketvals->priorite == 0 ? 'bg-danger' : ($ticketvals->priorite == 1 ? 'bg-warning text-dark' : 'bg-success') }}">
                                    {{ $ticketvals->priorite == 0 ? 'Haute' : ($ticketvals->priorite == 1 ? 'Moyenne' : 'Basse') }}
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold text-secondary mb-1 small">Impact</label>
                            <div>
                                <span class="badge impact-badge small px-2 py-1 rounded-2 bg-warning text-dark">
                                    {{ $ticketvals->impact }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Détails -->
                    <div class="pt-2">
                        <label class="form-label fw-semibold text-secondary mb-1 small">Détails</label>
                        <div class="ticket-details text-muted smaller">
                            {{ $ticketvals->details }}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Contenu principal - Timeline -->
    <div class="col-lg-8 col-xl-9">
        <!-- En-tête timeline -->
        <div class="timeline-header mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="fw-bold mb-1 text-dark">📊 Évolution du Ticket #{{ $ticketvals->id }}</h5>
                    <p class="text-muted mb-0 smaller">Suivez le parcours complet de votre demande en temps réel.</p>
                </div>
                <button class="btn btn-outline-secondary btn-sm d-lg-none" id="toggleSidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" viewBox="0 0 24 24" fill="none" 
                         stroke="currentColor" stroke-width="2" class="me-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    Détails
                </button>
            </div>
        </div>

        <!-- Timeline -->
        <div class="timeline-modern">
            <!-- Étape 1: Création -->
            <div class="timeline-step {{ $ticketvals->state >= 1 ? 'active' : '' }}" data-step="1">
                <div class="step-header">
                    <div class="step-circle">
                        <div class="circle-inner">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}&background=4361ee&color=fff&size=36"
                                 alt="Profil" class="rounded-circle" width="36" height="36">
                        </div>
                    </div>
                    <div class="step-info">
                        <h6 class="step-title mb-1">Création</h6>
                        <small class="step-time">{{ \Carbon\Carbon::parse($ticketvals->created_at)->translatedFormat('d M Y H:i') }}</small>
                    </div>
                </div>
                <div class="step-content">
                    <div class="comment-box">
                        <div class="comment-header">
                            <span class="comment-author">Vous</span>
                            <span class="comment-action">avez créé le ticket</span>
                        </div>
                        <div class="comment-text smaller">{{ $ticketvals->details }}</div>
                    </div>
                </div>
            </div>

            <!-- Étape 2: Assignation -->
            @if($ticketvals->state >= 2)
            <div class="timeline-step {{ $ticketvals->state >= 2 ? 'active' : '' }}" data-step="2">
                <div class="step-header">
                    <div class="step-circle">
                        <div class="circle-inner bg-primary">
                            <span>2</span>
                        </div>
                    </div>
                    <div class="step-info">
                        <h6 class="step-title mb-1">Assignation</h6>
                        @foreach($commentaires as $comment)
                            @if($comment->etat == 2)
                                <small class="step-time">{{ \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d M Y H:i') }}</small>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="step-content">
                    @foreach($commentaires as $comment)
                        @if($comment->etat == 2)
                            <div class="comment-box">
                                <div class="comment-header">
                                    <span class="comment-author">
                                        @foreach($responsables as $resp)
                                            @if($comment->utilisateur_id == $resp->id)
                                                {{ $resp->name }}
                                            @endif
                                        @endforeach
                                    </span>
                                    <span class="comment-action">a assigné le ticket</span>
                                </div>
                                <div class="comment-text smaller">{{ $comment->commentaire }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Étape 3: Traitement -->
            @if($ticketvals->state >= 3)
            <div class="timeline-step {{ $ticketvals->state >= 3 ? 'active' : '' }}" data-step="3">
                <div class="step-header">
                    <div class="step-circle">
                        <div class="circle-inner bg-warning">
                            <span>3</span>
                        </div>
                    </div>
                    <div class="step-info">
                        <h6 class="step-title mb-1">Traitement</h6>
                        @foreach($commentaires as $comment)
                            @if($comment->etat == 3)
                                <small class="step-time">{{ \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d M Y H:i') }}</small>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="step-content">
                    @foreach($commentaires as $comment)
                        @if($comment->etat == 3)
                            <div class="comment-box">
                                <div class="comment-header">
                                    <span class="comment-author">
                                        @foreach($responsables as $resp)
                                            @if($comment->utilisateur_id == $resp->id)
                                                {{ $resp->name }}
                                            @endif
                                        @endforeach
                                    </span>
                                    <span class="comment-action">est en train de traiter</span>
                                </div>
                                <div class="comment-text smaller">{{ $comment->commentaire }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Étape 4: Résolution -->
            @if($ticketvals->state >= 4)
            <div class="timeline-step {{ $ticketvals->state >= 4 ? 'active' : '' }}" data-step="4">
                <div class="step-header">
                    <div class="step-circle">
                        <div class="circle-inner bg-success">
                            <span>4</span>
                        </div>
                    </div>
                    <div class="step-info">
                        <h6 class="step-title mb-1">Résolution</h6>
                        @foreach($commentaires as $comment)
                            @if($comment->etat == 4)
                                <small class="step-time">{{ \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d M Y H:i') }}</small>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="step-content">
                    @foreach($commentaires as $comment)
                        @if($comment->etat == 4)
                            <div class="comment-box">
                                <div class="comment-header">
                                    <span class="comment-author">
                                        @foreach($responsables as $resp)
                                            @if($comment->utilisateur_id == $resp->id)
                                                {{ $resp->name }}
                                            @endif
                                        @endforeach
                                    </span>
                                    <span class="comment-action">a résolu le ticket</span>
                                </div>
                                <div class="comment-text smaller">{{ $comment->commentaire }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Étape 5: Clôture -->
            @if($ticketvals->state >= 5)
            <div class="timeline-step {{ $ticketvals->state >= 5 ? 'active' : '' }}" data-step="5">
                <div class="step-header">
                    <div class="step-circle">
                        <div class="circle-inner bg-secondary">
                            <span>5</span>
                        </div>
                    </div>
                    <div class="step-info">
                        <h6 class="step-title mb-1">Clôture</h6>
                        @foreach($commentaires as $comment)
                            @if($comment->etat == 5)
                                <small class="step-time">{{ \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d M Y H:i') }}</small>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="step-content">
                    @foreach($commentaires as $comment)
                        @if($comment->etat == 5)
                            <div class="comment-box">
                                <div class="comment-header">
                                    <span class="comment-author">
                                        @foreach($responsables as $resp)
                                            @if($comment->utilisateur_id == $resp->id)
                                                {{ $resp->name }}
                                            @endif
                                        @endforeach
                                    </span>
                                    <span class="comment-action">a clos le ticket</span>
                                </div>
                                <div class="comment-text smaller">{{ $comment->commentaire }}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Styles CSS -->
<style>
:root {
    --primary-color: #4361ee;
    --secondary-color: #6c757d;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --danger-color: #dc3545;
    --info-color: #17a2b8;
    --light-color: #f8f9fa;
    --dark-color: #343a40;
    --border-radius: 8px;
    --box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    --transition: all 0.3s ease;
}

/* Classes de taille de texte */
.smaller {
    font-size: 0.8rem !important;
}

/* Sidebar ticket */
.sidebar-ticket {
    background: #fff;
    border: 1px solid #e9ecef;
    height: fit-content;
    position: sticky;
    top: 20px;
}

.sidebar-ticket .card-header {
    border-bottom: 1px solid #e9ecef;
}

.sidebar-ticket .ticket-value {
    background: #f8f9fa;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 0.9rem;
    color: var(--dark-color);
    border: 1px solid #e9ecef;
    margin-top: 4px;
}

.sidebar-ticket .ticket-details {
    background: #f8f9fa;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 0.85rem;
    line-height: 1.5;
    border: 1px solid #e9ecef;
    margin-top: 4px;
    white-space: pre-line;
}

/* Badges améliorés */
.priority-badge, .impact-badge {
    font-size: 0.75rem !important;
    font-weight: 500 !important;
    padding: 4px 8px !important;
}

/* Timeline moderne */
.timeline-modern {
    position: relative;
    padding-left: 30px;
}

.timeline-modern::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #e9ecef;
}

.timeline-step {
    position: relative;
    margin-bottom: 25px;
}

.timeline-step:last-child {
    margin-bottom: 0;
}

.timeline-step.active::before {
    background: var(--primary-color);
}

.step-header {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.step-circle {
    position: absolute;
    left: -30px;
    top: 0;
    z-index: 2;
}

.circle-inner {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #6c757d;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 600;
    border: 3px solid white;
    box-shadow: var(--box-shadow);
}

.timeline-step.active .circle-inner {
    background: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
}

.step-info {
    margin-left: 40px;
}

.step-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--dark-color);
    margin-bottom: 2px;
}

.timeline-step.active .step-title {
    color: var(--primary-color);
}

.step-time {
    font-size: 0.75rem;
    color: var(--secondary-color);
}

.step-content {
    margin-left: 40px;
}

.comment-box {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 12px;
    border-left: 3px solid #dee2e6;
    margin-top: 5px;
}

.timeline-step.active .comment-box {
    border-left-color: var(--primary-color);
    background: #f0f4ff;
}

.comment-header {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 5px;
}

.comment-author {
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--dark-color);
}

.comment-action {
    font-size: 0.75rem;
    color: var(--secondary-color);
}

.comment-text {
    font-size: 0.8rem;
    color: var(--dark-color);
    line-height: 1.4;
    margin: 0;
}

/* Bouton toggle pour mobile */
#toggleSidebar {
    font-size: 0.8rem;
    padding: 6px 12px;
}

/* Responsive */
@media (max-width: 992px) {
    .row {
        margin-left: -10px;
        margin-right: -10px;
    }
    
    .col-lg-4, .col-lg-8 {
        padding-left: 10px;
        padding-right: 10px;
    }
    
    .sidebar-ticket {
        margin-bottom: 20px;
        position: static;
    }
    
    .timeline-modern {
        padding-left: 25px;
    }
    
    .step-info {
        margin-left: 35px;
    }
    
    .step-content {
        margin-left: 35px;
    }
}

@media (max-width: 768px) {
    .timeline-modern {
        padding-left: 20px;
    }
    
    .step-circle {
        left: -25px;
    }
    
    .circle-inner {
        width: 28px;
        height: 28px;
        font-size: 0.7rem;
    }
    
    .step-info {
        margin-left: 30px;
    }
    
    .step-content {
        margin-left: 30px;
    }
    
    .step-title {
        font-size: 0.85rem;
    }
    
    .comment-box {
        padding: 10px;
    }
}

/* Animation pour le scroll */
.timeline-step {
    opacity: 0.7;
    transition: var(--transition);
}

.timeline-step.active {
    opacity: 1;
}

/* Retour en arrière */
.back-button {
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 1000;
    background: white;
    border: 1px solid #dee2e6;
    border-radius: 50px;
    padding: 8px 16px;
    font-size: 0.85rem;
    box-shadow: var(--box-shadow);
    display: flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    color: var(--dark-color);
    transition: var(--transition);
}

.back-button:hover {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
    transform: translateY(-2px);
}
</style>

<!-- Script pour toggle sidebar -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.querySelector('.sidebar-ticket');
    
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function() {
            sidebar.classList.toggle('d-none');
            this.textContent = sidebar.classList.contains('d-none') ? 'Afficher détails' : 'Masquer détails';
        });
    }
    
    // Animation au scroll
    const timelineSteps = document.querySelectorAll('.timeline-step');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });
    
    timelineSteps.forEach(step => {
        step.style.opacity = '0';
        step.style.transform = 'translateY(20px)';
        step.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(step);
    });
});
</script>