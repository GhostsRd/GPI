<div class="container-fluid py-4" style="background: var(--gray-50); min-height: 100vh;">
    <!-- Modern Header -->
    <div class="mb-4">
        <h1 class="h3 fw-bold text-gray-800 mb-1">
            <i class="bi bi-sim text-primary me-2"></i>Mes Cartes SIM
        </h1>
        <p class="text-muted small">Consultez les informations des cartes SIM qui vous sont attribuées.</p>
    </div>

    <div class="row g-4">
        @forelse($mySims as $sim)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm border-0 h-100 overflow-hidden" style="border-radius: 16px;">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div class="p-3 rounded-3" style="background: {{ strtolower($sim->operator) == 'orange' ? '#fff7ed' : (strtolower($sim->operator) == 'telma' ? '#fefce8' : '#fef2f2') }}; color: {{ strtolower($sim->operator) == 'orange' ? '#f97316' : (strtolower($sim->operator) == 'telma' ? '#a16207' : '#ef4444') }}; font-size: 1.5rem;">
                                <i class="bi bi-sim"></i>
                            </div>
                            <span class="badge rounded-pill border {{ $sim->status == 'assigned' ? 'bg-success-subtle text-success border-success-subtle' : 'bg-danger-subtle text-danger border-danger-subtle' }}" style="{{ $sim->status == 'assigned' ? 'background: var(--primary-light) !important; color: var(--primary-dark) !important; border-color: var(--primary-light) !important;' : '' }}">
                                {{ $sim->status == 'assigned' ? 'Active' : 'Perdue' }}
                            </span>
                        </div>
                        
                        <h3 class="h4 fw-bold text-dark mb-1">{{ $sim->phone_number }}</h3>
                        <p class="text-muted small mb-4" style="font-family: monospace;">ICCID: {{ $sim->iccid }}</p>
                        
                        <div class="py-3 mt-auto border-top border-light">
                            <div class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted">Opérateur</span>
                                <span class="fw-bold text-dark">{{ $sim->operator }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2 small">
                                <span class="text-muted">Modèle Tél</span>
                                <span class="fw-bold text-dark">{{ $sim->device_model ?: 'Non renseigné' }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3 small">
                                <span class="text-muted">IMEI</span>
                                <span class="fw-bold text-dark">{{ $sim->imei ?: 'N/A' }}</span>
                            </div>
                            
                            <div class="text-center mt-3">
                                <button wire:click="downloadAttribution({{ $sim->id }})" class="btn btn-sm btn-link text-primary text-decoration-none small d-inline-flex align-items-center gap-1">
                                    <i class="bi bi-file-earmark-pdf"></i> Télécharger PV d'attribution
                                </button>
                            </div>
                        </div>

                        @if($sim->status == 'assigned')
                            <button onclick="confirm('Voulez-vous vraiment signaler la perte de cette carte ?') || event.stopImmediatePropagation()" 
                                    wire:click="reportLoss({{ $sim->id }})" 
                                    class="btn w-100 mt-4 btn-outline-danger border-0 py-2 fw-bold d-flex align-items-center justify-content-center gap-2"
                                    style="background: #fef2f2; border-radius: 12px;">
                                <i class="bi bi-exclamation-triangle"></i> Signaler une perte
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="py-5 bg-white rounded-4 border-2 border-dashed border-light">
                    <i class="bi bi-sim text-muted opacity-25" style="font-size: 5rem;"></i>
                    <h3 class="h5 fw-bold text-gray-800 mt-3">Aucune carte SIM</h3>
                    <p class="text-muted small">Vous n'avez aucune carte SIM attribuée pour le moment.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
