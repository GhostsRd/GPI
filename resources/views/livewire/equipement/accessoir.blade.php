<div>
    <!-- Styles CSS -->
    <style>
        :root {
            --dark-green: #3D3E14;
            --turquoise: #66C0B7;
            --off-white: #EDEDE8;
            --orange: #E35E2F;
            --soft-green: #83AF4B;
        }
        
        .dashboard-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.2s ease;
        }
        
        .dashboard-card:hover {
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        
        .stat-card {
            padding: 16px;
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }
        
        .badge-sm {
            font-size: 0.7rem;
            padding: 0.25em 0.5em;
        }
        
        .table th {
            font-size: 0.8rem;
            font-weight: 600;
            color: #495057;
            border-bottom: 1px solid #dee2e6;
        }
        
        .table td {
            font-size: 0.8rem;
            vertical-align: middle;
        }
        
        .btn {
            font-size: 0.8rem;
            border-radius: 6px;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        
        .search-box .form-control {
            padding-left: 30px;
            font-size: 0.875rem;
        }
    </style>

    <!-- Scripts pour les alertes -->
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('show-alert', (data) => {
                const alert = document.createElement('div');
                alert.className = `alert alert-${data.type} alert-dismissible fade show position-fixed`;
                alert.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
                alert.innerHTML = `
                    ${data.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                document.body.appendChild(alert);
                
                setTimeout(() => {
                    alert.remove();
                }, 5000);
            });
        });
    </script>

    <!-- Contenu principal -->
    <div class="container-fluid py-3">
        <!-- Header -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div>
                        <h1 class="h4 fw-semibold text-dark mb-0">
                            <i class="bi bi-box-arrow-up me-2 text-primary"></i> Gestion des Sorties de Périphériques
                        </h1>
                        <p class="text-muted small">Gérez les sorties et retours des périphériques</p>
                    </div>
                    <div class="d-flex gap-2 flex-wrap">
                        <button wire:click="openSortieModal" class="btn btn-success btn-sm d-flex align-items-center">
                            <i class="bi bi-box-arrow-up me-1"></i>
                            Nouvelle Sortie
                        </button>
                        <button wire:click="openRetourModal" class="btn btn-warning btn-sm d-flex align-items-center">
                            <i class="bi bi-box-arrow-in-down me-1"></i>
                            Retour Stock
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres -->
        <div class="dashboard-card p-3 mb-3">
            <div class="row g-3 align-items-end">
                <!-- Recherche -->
                <div class="col-md-3">
                    <label class="form-label small fw-medium text-muted">Recherche</label>
                    <div class="search-box position-relative">
                        <i class="bi bi-search position-absolute top-50 start-0 translate-middle-y ms-2 text-muted small"></i>
                        <input type="text" wire:model.live.debounce.300ms="search"
                               class="form-control form-control-sm ps-4 border-0 bg-light rounded-2"
                               placeholder="Nom, modèle, usager...">
                    </div>
                </div>

                <!-- Statut -->
                <div class="col-md-2">
                    <label class="form-label small fw-medium text-muted">Statut</label>
                    <select wire:model.live="filterStatut" class="form-select form-select-sm border-0 bg-light rounded-2">
                        <option value="">Tous les statuts</option>
                        @foreach($statuts as $statut)
                            <option value="{{ $statut }}">{{ $statut }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Type -->
                <div class="col-md-2">
                    <label class="form-label small fw-medium text-muted">Type</label>
                    <select wire:model.live="filterType" class="form-select form-select-sm border-0 bg-light rounded-2">
                        <option value="">Tous les types</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Entité -->
                <div class="col-md-2">
                    <label class="form-label small fw-medium text-muted">Entité</label>
                    <input type="text" wire:model.live="filterEntite" 
                           class="form-control form-control-sm border-0 bg-light rounded-2" 
                           placeholder="Entité...">
                </div>

                <!-- Actions -->
                <div class="col-md-3">
                    <div class="d-flex gap-2 justify-content-end">
                        <button wire:click="resetFilters" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-clockwise me-1"></i>
                            Réinitialiser
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des périphériques -->
        <div class="dashboard-card p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-semibold mb-0">Liste des Périphériques</h5>
                <span class="text-muted small">
                    {{ $peripheriques->total() }} périphérique(s) trouvé(s)
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Fabricant/Modèle</th>
                            <th>Statut</th>
                            <th>Entité</th>
                            <th>Lieu</th>
                            <th>Usager</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peripheriques as $peripherique)
                            <tr>
                                <td class="fw-medium small">{{ $peripherique->nom }}</td>
                                <td class="small">{{ $peripherique->type }}</td>
                                <td class="small">
                                    <div>{{ $peripherique->fabricant }}</div>
                                    <div class="text-muted">{{ $peripherique->modele }}</div>
                                </td>
                                <td>
                                    @php
                                        $statusClasses = [
                                            'En service' => 'badge bg-success badge-sm',
                                            'En stock' => 'badge bg-info badge-sm',
                                            'En réparation' => 'badge bg-warning badge-sm',
                                            'Hors service' => 'badge bg-danger badge-sm'
                                        ];
                                    @endphp
                                    <span class="{{ $statusClasses[$peripherique->statut] ?? 'badge bg-secondary badge-sm' }}">
                                        {{ $peripherique->statut }}
                                    </span>
                                </td>
                                <td class="small">{{ $peripherique->entite ?? 'N/A' }}</td>
                                <td class="small">{{ $peripherique->lieu ?? 'N/A' }}</td>
                                <td class="small">{{ $peripherique->usager ?? 'Non attribué' }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        @if($peripherique->statut === 'En stock')
                                            <button wire:click="quickSortie({{ $peripherique->id }})"
                                                    class="btn btn-sm btn-success border-0"
                                                    title="Sortie rapide">
                                                <i class="bi bi-box-arrow-up"></i>
                                            </button>
                                        @endif

                                        @if($peripherique->statut === 'En service')
                                            <button wire:click="quickRetour({{ $peripherique->id }})"
                                                    class="btn btn-sm btn-warning border-0"
                                                    title="Retour stock">
                                                <i class="bi bi-box-arrow-in-down"></i>
                                            </button>
                                        @endif

                                        <button wire:click="showHistorique({{ $peripherique->id }})"
                                                class="btn btn-sm btn-info border-0"
                                                title="Historique">
                                            <i class="bi bi-clock-history"></i>
                                        </button>

                                        <button wire:click="showDetails({{ $peripherique->id }})"
                                                class="btn btn-sm btn-outline-secondary border-0"
                                                title="Détails">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-3">
                                    <i class="fas fa-laptop display-6 text-muted d-block mb-2"></i>
                                    <p class="text-muted mb-0 small">Aucun périphérique trouvé</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted small">
                    @if($peripheriques->count() > 0)
                        Affichage de {{ $peripheriques->firstItem() }} à {{ $peripheriques->lastItem() }} sur {{ $peripheriques->total() }} périphériques
                    @else
                        Aucun périphérique
                    @endif
                </div>
                {{ $peripheriques->links() }}
            </div>
        </div>
    </div>

    <!-- Modal de sortie -->
    @if($showSortieModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title small fw-semibold">
                        <i class="bi bi-box-arrow-up me-1 text-success"></i>Sortie de Périphérique
                    </h5>
                    <button type="button" class="btn-close btn-close-sm" wire:click="closeModals"></button>
                </div>
                <form wire:submit.prevent="enregistrerSortie">
                    <div class="modal-body p-3">
                        <div class="row g-2">
                            <!-- Sélection du périphérique -->
                            <div class="col-12 mb-2">
                                <label class="form-label small fw-medium">Périphérique <span class="text-danger">*</span></label>
                                <select wire:model="peripheriqueId" 
                                        class="form-select form-select-sm @error('peripheriqueId') is-invalid @enderror">
                                    <option value="">Sélectionner un périphérique</option>
                                    @foreach($peripheriquesEnStock as $periph)
                                        <option value="{{ $periph->id }}">
                                            {{ $periph->nom }} - {{ $periph->type }} ({{ $periph->fabricant }} {{ $periph->modele }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('peripheriqueId') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <!-- Informations de sortie -->
                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Usager <span class="text-danger">*</span></label>
                                <input type="text" wire:model="usager"
                                       class="form-control form-control-sm @error('usager') is-invalid @enderror"
                                       placeholder="Nom de l'usager">
                                @error('usager') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Date de sortie <span class="text-danger">*</span></label>
                                <input type="datetime-local" wire:model="date_sortie"
                                       class="form-control form-control-sm @error('date_sortie') is-invalid @enderror">
                                @error('date_sortie') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Entité <span class="text-danger">*</span></label>
                                <input type="text" wire:model="entite"
                                       class="form-control form-control-sm @error('entite') is-invalid @enderror"
                                       placeholder="Entité organisationnelle">
                                @error('entite') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Lieu <span class="text-danger">*</span></label>
                                <input type="text" wire:model="lieu"
                                       class="form-control form-control-sm @error('lieu') is-invalid @enderror"
                                       placeholder="Lieu d'utilisation">
                                @error('lieu') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label small fw-medium">Commentaire</label>
                                <textarea wire:model="commentaire_sortie" class="form-control form-control-sm" rows="3"
                                          placeholder="Informations supplémentaires..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModals">Annuler</button>
                        <button type="submit" class="btn btn-success btn-sm">
                            <span wire:loading.remove>
                                <i class="bi bi-check me-1"></i>Enregistrer la sortie
                            </span>
                            <span wire:loading>
                                <i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-1"></i>
                                Enregistrement...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de retour -->
    @if($showRetourModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title small fw-semibold">
                        <i class="bi bi-box-arrow-in-down me-1 text-warning"></i>Retour au Stock
                    </h5>
                    <button type="button" class="btn-close btn-close-sm" wire:click="closeModals"></button>
                </div>
                <form wire:submit.prevent="enregistrerRetour">
                    <div class="modal-body p-3">
                        <div class="row g-2">
                            <!-- Sélection du périphérique -->
                            <div class="col-12 mb-2">
                                <label class="form-label small fw-medium">Périphérique <span class="text-danger">*</span></label>
                                <select wire:model="retourPeripheriqueId" 
                                        class="form-select form-select-sm @error('retourPeripheriqueId') is-invalid @enderror">
                                    <option value="">Sélectionner un périphérique</option>
                                    @foreach($peripheriquesEnService as $periph)
                                        <option value="{{ $periph->id }}">
                                            {{ $periph->nom }} - {{ $periph->usager }} ({{ $periph->entite }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('retourPeripheriqueId') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <!-- Informations de retour -->
                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">Date de retour <span class="text-danger">*</span></label>
                                <input type="datetime-local" wire:model="date_retour"
                                       class="form-control form-control-sm @error('date_retour') is-invalid @enderror">
                                @error('date_retour') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label small fw-medium">État du périphérique <span class="text-danger">*</span></label>
                                <select wire:model="etat_retour"
                                        class="form-select form-select-sm @error('etat_retour') is-invalid @enderror">
                                    @foreach($etats as $etat)
                                        <option value="{{ $etat }}">{{ $etat }}</option>
                                    @endforeach
                                </select>
                                @error('etat_retour') <div class="invalid-feedback small">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label small fw-medium">Commentaire</label>
                                <textarea wire:model="commentaire_retour" class="form-control form-control-sm" rows="3"
                                          placeholder="Observations sur l'état..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModals">Annuler</button>
                        <button type="submit" class="btn btn-warning btn-sm">
                            <span wire:loading.remove>
                                <i class="bi bi-check me-1"></i>Enregistrer le retour
                            </span>
                            <span wire:loading>
                                <i class="bi bi-arrow-repeat spinner-border spinner-border-sm me-1"></i>
                                Enregistrement...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal d'historique -->
    @if($showHistoriqueModal)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title small fw-semibold">
                        <i class="bi bi-clock-history me-1 text-info"></i>Historique des Mouvements
                    </h5>
                    <button type="button" class="btn-close btn-close-sm" wire:click="closeModals"></button>
                </div>
                <div class="modal-body p-3">
                    @if(count($historique) > 0)
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th class="small">Date</th>
                                        <th class="small">Type</th>
                                        <th class="small">Usager</th>
                                        <th class="small">Entité</th>
                                        <th class="small">Lieu</th>
                                        <th class="small">État</th>
                                        <th class="small">Commentaire</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($historique as $mouvement)
                                        <tr>
                                            <td class="small">{{ $mouvement->date_operation->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if($mouvement->type_operation === 'sortie')
                                                    <span class="badge bg-success badge-sm">Sortie</span>
                                                @else
                                                    <span class="badge bg-warning badge-sm">Retour</span>
                                                @endif
                                            </td>
                                            <td class="small">{{ $mouvement->usager ?? 'N/A' }}</td>
                                            <td class="small">{{ $mouvement->entite ?? 'N/A' }}</td>
                                            <td class="small">{{ $mouvement->lieu ?? 'N/A' }}</td>
                                            <td class="small">{{ $mouvement->etat }}</td>
                                            <td class="small">{{ $mouvement->commentaire ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-clock display-6 text-muted d-block mb-2"></i>
                            <p class="text-muted small">Aucun mouvement enregistré pour ce périphérique.</p>
                        </div>
                    @endif
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModals">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal de détails -->
    @if($showDetailsModal && $selectedPeripherique)
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title small fw-semibold">
                        <i class="bi bi-info-circle me-1 text-primary"></i>Détails du Périphérique
                    </h5>
                    <button type="button" class="btn-close btn-close-sm" wire:click="closeModals"></button>
                </div>
                <div class="modal-body p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-item mb-2">
                                <strong class="small">Nom:</strong>
                                <p class="mb-0 small">{{ $selectedPeripherique->nom }}</p>
                            </div>
                            <div class="detail-item mb-2">
                                <strong class="small">Type:</strong>
                                <p class="mb-0 small">{{ $selectedPeripherique->type }}</p>
                            </div>
                            <div class="detail-item mb-2">
                                <strong class="small">Fabricant:</strong>
                                <p class="mb-0 small">{{ $selectedPeripherique->fabricant ?? 'N/A' }}</p>
                            </div>
                            <div class="detail-item mb-2">
                                <strong class="small">Modèle:</strong>
                                <p class="mb-0 small">{{ $selectedPeripherique->modele ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item mb-2">
                                <strong class="small">Statut:</strong>
                                <p class="mb-0">
                                    @php
                                        $statusClasses = [
                                            'En service' => 'badge bg-success badge-sm',
                                            'En stock' => 'badge bg-info badge-sm',
                                            'En réparation' => 'badge bg-warning badge-sm',
                                            'Hors service' => 'badge bg-danger badge-sm'
                                        ];
                                    @endphp
                                    <span class="{{ $statusClasses[$selectedPeripherique->statut] ?? 'badge bg-secondary badge-sm' }}">
                                        {{ $selectedPeripherique->statut }}
                                    </span>
                                </p>
                            </div>
                            <div class="detail-item mb-2">
                                <strong class="small">Entité:</strong>
                                <p class="mb-0 small">{{ $selectedPeripherique->entite ?? 'N/A' }}</p>
                            </div>
                            <div class="detail-item mb-2">
                                <strong class="small">Lieu:</strong>
                                <p class="mb-0 small">{{ $selectedPeripherique->lieu ?? 'N/A' }}</p>
                            </div>
                            <div class="detail-item mb-2">
                                <strong class="small">Usager:</strong>
                                <p class="mb-0 small">{{ $selectedPeripherique->usager ?? 'Non attribué' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-secondary btn-sm" wire:click="closeModals">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Liens CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</div>
