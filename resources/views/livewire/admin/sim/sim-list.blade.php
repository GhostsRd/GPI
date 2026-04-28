<div class="container-fluid py-4" style="background: var(--gray-50); min-height: 100vh;">
    <!-- Modern Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold text-gray-800 mb-1">
                <i class="bi bi-sim text-primary me-2"></i>Gestion de la Flotte SIM
            </h1>
            <p class="text-muted small mb-0">Gérez l'ensemble des numéros et cartes SIM de l'organisation.</p>
        </div>
        <div class="d-flex gap-2">
            <button wire:click="$set('showImportModal', true)" class="btn btn-sm btn-light border shadow-sm px-3">
                <i class="bi bi-file-earmark-arrow-up text-primary me-1"></i>Importer
            </button>
            <button wire:click="exportExcel" class="btn btn-sm btn-light border shadow-sm px-3">
                <i class="bi bi-file-earmark-excel text-success me-1"></i>Exporter Excel
            </button>
            <button wire:click="openCreateModal" class="btn btn-sm btn-primary shadow-sm px-3" style="background: var(--primary); border: none;">
                <i class="bi bi-plus-lg me-1"></i>Nouvelle SIM
            </button>
        </div>
    </div>

    <!-- Filters Bar -->
    <div class="card shadow-sm border-0 mb-4 overflow-hidden" style="border-radius: 12px;">
        <div class="card-body p-3 bg-white">
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label small fw-bold text-uppercase text-muted mb-1">Recherche</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" wire:model.debounce.300ms="search" placeholder="Numéro ou ICCID..." class="form-control border-start-0 ps-0 focus-none">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-uppercase text-muted mb-1">Statut</label>
                    <select wire:model="statusFilter" class="form-select form-select-sm focus-none">
                        <option value="">Tous les statuts</option>
                        <option value="available">Disponible</option>
                        <option value="assigned">Attribuée</option>
                        <option value="lost">Perdue</option>
                        <option value="repairing">En réparation</option>
                        <option value="deactivated">Désactivée</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-uppercase text-muted mb-1">Opérateur</label>
                    <select wire:model="operatorFilter" class="form-select form-select-sm focus-none">
                        <option value="">Tous les opérateurs</option>
                        <option value="Orange">Orange</option>
                        <option value="Telma">Telma</option>
                        <option value="Airtel">Airtel</option>
                    </select>
                </div>
                <div class="col-md-1 d-flex justify-content-end">
                    <button wire:click="$refresh" class="btn btn-sm btn-light border shadow-sm" title="Réinitialiser">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="card shadow-sm border-0 overflow-hidden" style="border-radius: 12px;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr class="text-muted small text-uppercase">
                        <th class="border-0 px-4 py-3">SIM / ICCID</th>
                        <th class="border-0 px-4">Opérateur</th>
                        <th class="border-0 px-4">Statut</th>
                        <th class="border-0 px-4">Utilisateur Actuel</th>
                        <th class="border-0 px-4 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($sims as $sim)
                        <tr class="transition">
                            <td class="px-4 py-3">
                                <div class="fw-bold text-dark">{{ $sim->phone_number }}</div>
                                <div class="text-muted" style="font-size: 0.75rem;">{{ $sim->iccid }}</div>
                            </td>
                            <td class="px-4">
                                <span class="badge rounded-pill border {{ $sim->operator == 'Orange' ? 'border-orange-subtle text-orange-700 bg-orange-50' : ($sim->operator == 'Telma' ? 'border-warning-subtle text-warning-800 bg-warning-50' : 'border-danger-subtle text-danger-700 bg-danger-50') }}"
                                      style="{{ $sim->operator == 'Orange' ? 'color: #f97316; border-color: #ffedd5; background: #fff7ed;' : ( $sim->operator == 'Telma' ? 'color: #a16207; border-color: #fef9c3; background: #fefce8;' : '' ) }}">
                                    {{ $sim->operator }}
                                </span>
                            </td>
                            <td class="px-4">
                                @php
                                    $statusClasses = [
                                        'available' => 'bg-success-subtle text-success border-success-subtle',
                                        'assigned' => 'bg-primary-subtle text-primary border-primary-subtle',
                                        'lost' => 'bg-danger-subtle text-danger border-danger-subtle',
                                        'repairing' => 'bg-warning-subtle text-warning border-warning-subtle',
                                        'deactivated' => 'bg-secondary-subtle text-secondary border-secondary-subtle',
                                    ];
                                    $statusClass = $statusClasses[$sim->status] ?? 'bg-light';
                                    
                                    // Override primary for Pivot theme
                                    if($sim->status == 'assigned') $statusStyle = "background-color: var(--primary-light) !important; color: var(--primary-dark) !important; border-color: var(--primary-light) !important;";
                                    else $statusStyle = "";
                                @endphp
                                <span class="badge rounded-pill border {{ $statusClass }}" style="{{ $statusStyle }}">
                                    <i class="bi bi-circle-fill me-1" style="font-size: 0.4rem; vertical-align: middle;"></i>
                                    {{ ucfirst($sim->status == 'available' ? 'Disponible' : ($sim->status == 'assigned' ? 'Attribuée' : ($sim->status == 'lost' ? 'Perdue' : ($sim->status == 'repairing' ? 'En réparation' : 'Désactivée')))) }}
                                </span>
                            </td>
                            <td class="px-4">
                                @if($sim->currentUser)
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold me-2" 
                                             style="width: 32px; height: 32px; font-size: 0.75rem; background: var(--primary-light) !important; color: var(--primary-dark) !important;">
                                            {{ strtoupper(substr($sim->currentUser->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <div class="small fw-bold text-dark">{{ $sim->currentUser->name }}</div>
                                            <div class="text-muted" style="font-size: 0.7rem;">{{ $sim->currentUser->poste ?? 'Utilisateur' }}</div>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-muted italic small">Non attribuée</span>
                                @endif
                            </td>
                            <td class="px-4 text-end">
                                <div class="btn-group btn-group-sm gap-1">
                                    @if($sim->status == 'assigned')
                                        <button wire:click="downloadAttribution({{ $sim->id }})" class="btn btn-outline-danger border-0 rounded" title="PV d'attribution">
                                            <i class="bi bi-file-earmark-pdf"></i>
                                        </button>
                                    @endif
                                    
                                    @if($sim->status == 'available')
                                        <button wire:click="openAssignModal({{ $sim->id }})" class="btn btn-outline-success border-0 rounded" title="Attribuer">
                                            <i class="bi bi-person-plus-fill"></i>
                                        </button>
                                    @elseif($sim->status == 'assigned')
                                        <button onclick="confirm('Récupérer cette carte ?') || event.stopImmediatePropagation()" wire:click="recoverSim({{ $sim->id }})" class="btn btn-outline-warning border-0 rounded" title="Récupérer">
                                            <i class="bi bi-person-dash-fill"></i>
                                        </button>
                                    @endif
                                    
                                    <button wire:click="openEditModal({{ $sim->id }})" class="btn btn-outline-primary border-0 rounded" title="Modifier">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-5 text-center">
                                <div class="py-4">
                                    <i class="bi bi-inbox text-muted opacity-25" style="font-size: 4rem;"></i>
                                    <p class="text-muted small mt-2">Aucune carte SIM trouvée</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($sims->hasPages())
            <div class="card-footer bg-white border-0 py-3 d-flex justify-content-center">
                {{ $sims->links() }}
            </div>
        @endif
    </div>

    <!-- Modals Interface (Consolidated into App style) -->
    <style>
        .modal-pivot {
            backdrop-filter: blur(8px);
            background: rgba(0,0,0,0.4);
        }
        .modal-content-pivot {
            border-radius: 20px;
            border: none;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .focus-none:focus { box-shadow: none !important; border-color: var(--primary) !important; }
    </style>

    @if($showFormModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center modal-pivot">
            <div class="bg-white modal-content-pivot w-full max-w-2xl p-4 p-md-5 animate__animated animate__fadeInUp">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 fw-bold text-dark mb-0">{{ $editingSimId ? 'Modifier la SIM' : 'Nouvelle SIM' }}</h2>
                    <button wire:click="$set('showFormModal', false)" class="btn-close shadow-none"></button>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Numéro de téléphone</label>
                        <input type="text" wire:model="phone_number" class="form-control form-control-sm focus-none py-2" placeholder="+261 ...">
                        @error('phone_number') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">ICCID</label>
                        <input type="text" wire:model="iccid" class="form-control form-control-sm focus-none py-2" placeholder="89261 ...">
                        @error('iccid') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Opérateur</label>
                        <select wire:model="operator" class="form-select form-select-sm focus-none py-2">
                            <option value="">Choisir...</option>
                            <option value="Orange">Orange</option>
                            <option value="Telma">Telma</option>
                            <option value="Airtel">Airtel</option>
                        </select>
                        @error('operator') <span class="text-danger small">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Date d'activation</label>
                        <input type="date" wire:model="activation_date" class="form-control form-control-sm focus-none py-2">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">Modèle Téléphone (Optionnel)</label>
                        <input type="text" wire:model="device_model" class="form-control form-control-sm focus-none py-2">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">IMEI</label>
                        <input type="text" wire:model="imei" class="form-control form-control-sm focus-none py-2">
                    </div>
                </div>
                <div class="mt-5 d-flex justify-content-end gap-2">
                    <button wire:click="$set('showFormModal', false)" class="btn btn-sm px-4 btn-light rounded-pill">Annuler</button>
                    <button wire:click="saveSim" class="btn btn-sm px-5 btn-primary rounded-pill shadow" style="background: var(--primary); border: none;">Enregistrer</button>
                </div>
            </div>
        </div>
    @endif

    @if($showImportModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center modal-pivot">
            <div class="bg-white modal-content-pivot w-full max-w-lg p-4 p-md-5 animate__animated animate__fadeInUp">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 fw-bold text-dark mb-0">Importer la Flotte SIM</h2>
                    <button wire:click="$set('showImportModal', false)" class="btn-close shadow-none"></button>
                </div>
                
                <div class="mb-4 bg-light p-3 rounded-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="small fw-bold text-muted mb-0">Colonnes attendues :</p>
                        <button wire:click="$set('showMappingModal', true)" class="btn btn-link btn-sm text-primary p-0 text-decoration-none small">
                             <i class="bi bi-info-circle me-1"></i>Voir le mapping détaillé
                        </button>
                    </div>
                    <div class="text-xs text-muted">
                        <code>Nom et Prénom</code>, <code>Service</code>, <code>Numéro de téléphone</code>, <code>MSISDN</code>, <code>Opérateur</code>, <code>Motif</code>...
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold">Fichier Excel ou CSV (Max 10Mo)</label>
                    <div class="border-2 border-dashed border-light rounded-3 p-4 text-center bg-gray-50 position-relative">
                        <input type="file" wire:model="importFile" class="position-absolute inset-0 opacity-0 cursor-pointer" style="width: 100%; height: 100%; top:0; left:0;">
                        @if($importFile)
                            <div class="text-success small fw-bold">
                                <i class="bi bi-check-circle-fill me-1"></i>{{ $importFile->getClientOriginalName() }}
                            </div>
                        @else
                            <div class="text-muted small">
                                <i class="bi bi-cloud-arrow-up fs-2 d-block mb-2"></i>
                                Cliquez ou glissez un fichier ici
                            </div>
                        @endif
                    </div>
                    @error('importFile') <span class="text-danger small mt-2 d-block">{{ $message }}</span> @enderror
                </div>

                <div wire:loading wire:target="importFile" class="text-center mb-3">
                    <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
                    <span class="ms-2 small text-muted">Chargement du fichier...</span>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button wire:click="$set('showImportModal', false)" class="btn btn-sm px-4 btn-light rounded-pill">Annuler</button>
                    <button wire:click="importSims" class="btn btn-sm px-5 btn-primary rounded-pill shadow" style="background: var(--primary); border: none;">
                        Lancer l'importation
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if($showMappingModal)
        <div class="fixed inset-0 z-[60] flex items-center justify-center modal-pivot" style="background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px);">
            <div class="bg-white modal-content-pivot w-full max-w-2xl p-4 p-md-5 animate__animated animate__zoomIn">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 fw-bold text-dark mb-0">Mapping des Colonnes (Aide)</h2>
                    <button wire:click="$set('showMappingModal', false)" class="btn-close shadow-none"></button>
                </div>

                <div class="alert alert-info border-0 shadow-sm rounded-4 mb-4 small">
                    <i class="bi bi-lightbulb-fill me-2"></i>
                    Le système est flexible ! Il reconnaît vos colonnes même si elles ont des noms légèrement différents ou des accents (é -> e).
                </div>

                <div class="table-responsive rounded-3 border border-light">
                    <table class="table table-sm table-hover mb-0 align-middle" style="font-size: 0.85rem;">
                        <thead class="bg-light text-muted">
                            <tr>
                                <th class="p-3">Champ Système</th>
                                <th class="p-3">Mots-clés Reconnus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-3 fw-bold">Nom et Prénom</td>
                                <td class="p-3"><code>Nom et Prénom</code>, <code>Utilisateur</code>, <code>Employé</code>, <code>Nom complet</code></td>
                            </tr>
                            <tr>
                                <td class="p-3 fw-bold">Service</td>
                                <td class="p-3"><code>Service</code>, <code>Département</code>, <code>Department</code>, <code>Unité</code></td>
                            </tr>
                            <tr>
                                <td class="p-3 fw-bold">N° Téléphone</td>
                                <td class="p-3"><code>Numéro de téléphone</code>, <code>Tel</code>, <code>Phone</code>, <code>Mobile</code></td>
                            </tr>
                            <tr>
                                <td class="p-3 fw-bold">MSISDN / ICCID</td>
                                <td class="p-3"><code>MSISDN</code>, <code>ICCID</code>, <code>Numéro SIM</code>, <code>N SIM</code></td>
                            </tr>
                            <tr>
                                <td class="p-3 fw-bold">Opérateur</td>
                                <td class="p-3"><code>Opérateur</code>, <code>Réseau</code>, <code>Operator</code></td>
                            </tr>
                            <tr>
                                <td class="p-3 fw-bold">Date Récup.</td>
                                <td class="p-3"><code>Date de récupération</code>, <code>Date activation</code>, <code>Date recup</code></td>
                            </tr>
                            <tr>
                                <td class="p-3 fw-bold">Observations</td>
                                <td class="p-3 text-muted">Mapping automatique de : <code>Motif</code>, <code>Responsable IT</code>, <code>Remarques</code></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="mt-4 text-center">
                    <button wire:click="$set('showMappingModal', false)" class="btn btn-primary px-5 rounded-pill shadow-sm" style="background: var(--primary); border: none;">
                        J'ai compris
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if($showAssignModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center modal-pivot">
            <div class="bg-white modal-content-pivot w-full max-w-md p-4 p-md-5 animate__animated animate__fadeInUp">
                <div class="mb-4">
                    <h2 class="h4 fw-bold text-dark mb-1">Attribuer la carte SIM</h2>
                    <p class="text-muted small">Choisissez un utilisateur actif dans la liste.</p>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-bold">Employé / Utilisateur</label>
                    <select wire:model="selectedUserId" class="form-select form-select-sm focus-none py-2">
                        <option value="">Sélectionner un utilisateur...</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->poste ?? 'Collaborateur' }})</option>
                        @endforeach
                    </select>
                    @error('selectedUserId') <span class="text-danger small">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4 pt-3 border-top">
                    <label class="form-label small fw-bold">Nom du signataire</label>
                    <input type="text" wire:model="assigneeName" placeholder="Validation par..." class="form-control form-control-sm focus-none py-2 mb-3">
                    @error('assigneeName') <span class="text-danger small mb-2 d-block">{{ $message }}</span> @enderror
                    
                    <div class="form-check small bg-light p-3 rounded-3">
                        <input type="checkbox" wire:model="signatureConfirmation" class="form-check-input" id="confirmSig">
                        <label class="form-check-label text-muted" for="confirmSig">
                            Je confirme que l'employé a reçu physiquement la carte SIM ainsi que les documents d'attribution.
                        </label>
                    </div>
                    @error('signatureConfirmation') <span class="text-danger small mt-2 d-block">{{ $message }}</span> @enderror
                </div>

                <div class="mt-4 d-flex justify-content-end gap-2">
                    <button wire:click="$set('showAssignModal', false)" class="btn btn-sm px-4 btn-light rounded-pill">Annuler</button>
                    <button wire:click="assignSim" class="btn btn-sm px-5 btn-success rounded-pill shadow-sm">Confirmer</button>
                </div>
            </div>
        </div>
    @endif
</div>
