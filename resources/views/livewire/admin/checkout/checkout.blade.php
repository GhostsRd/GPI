<div>
    <div class="table-container border-0 shadow-sm rounded-4 overflow-hidden fade-in-up bg-white">
        <!-- En-tête simplifié -->
        <div class="p-4 border-bottom bg-white d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-cart-check fs-4" style="color: #5BC4BF;"></i>
                <h5 class="fw-semibold mb-0" style="color: #1e293b;">Checkouts</h5>
                <span class="badge bg-light text-dark rounded-pill ms-2">{{ $checkouts->total() }}</span>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-light rounded-3" id="toggleCardsBtn">
                    <i class="bi bi-grid me-1"></i>
                    <span id="toggleCardsText">Masquer stats</span>
                </button>
                <button class="btn btn-sm btn-light rounded-3" id="toggleFiltersBtn">
                    <i class="bi bi-funnel me-1"></i>
                    <span id="toggleFiltersText">Masquer filtres</span>
                </button>
                <button class="btn btn-sm text-white rounded-3" wire:click="nouveauCheckout" style="background: #5BC4BF;">
                    <i class="bi bi-plus-lg me-1"></i> Nouveau
                </button>
            </div>
        </div>

        <!-- Cartes stats simplifiées -->
        <div id="statsCards" class="row g-3 p-4 pb-0">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-3 hover-card">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted small mb-1">Total</p>
                                <h4 class="fw-bold mb-0" style="color: #5BC4BF;">{{ $this->stats['total'] }}</h4>
                            </div>
                            <div class="rounded-3 p-2" style="background: rgba(91, 196, 191, 0.1);">
                                <i class="bi bi-cart fs-5" style="color: #5BC4BF;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-3 hover-card">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted small mb-1">En cours</p>
                                <h4 class="fw-bold mb-0" style="color: #F59E0B;">{{ $this->stats['en_cours'] }}</h4>
                            </div>
                            <div class="rounded-3 p-2" style="background: rgba(245, 158, 11, 0.1);">
                                <i class="bi bi-clock fs-5" style="color: #F59E0B;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-3 hover-card">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted small mb-1">Terminés</p>
                                <h4 class="fw-bold mb-0" style="color: #10B981;">{{ $this->stats['termine'] }}</h4>
                            </div>
                            <div class="rounded-3 p-2" style="background: rgba(16, 185, 129, 0.1);">
                                <i class="bi bi-check-circle fs-5" style="color: #10B981;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm rounded-3 hover-card">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted small mb-1">En retard</p>
                                <h4 class="fw-bold mb-0" style="color: #EF4444;">{{ $this->stats['en_retard'] }}</h4>
                            </div>
                            <div class="rounded-3 p-2" style="background: rgba(239, 68, 68, 0.1);">
                                <i class="bi bi-exclamation-triangle fs-5" style="color: #EF4444;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres simplifiés -->
        <div id="filtersSection" class="p-4 border-bottom bg-white">
            <div class="row g-2 align-items-center">
                <div class="col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-0 rounded-3 me-1">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" wire:model.live="search" class="form-control form-control-sm bg-light border-0 rounded-3" placeholder="Rechercher...">
                    </div>
                </div>
                <div class="col-md-2">
                    <select wire:model.live="statutFilter" class="form-select form-select-sm bg-light border-0 rounded-3">
                        <option value="">Tous statuts</option>
                        <option value="en_cours">En cours</option>
                        <option value="termine">Terminé</option>
                        <option value="annule">Annulé</option>
                        <option value="en_retard">En retard</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select wire:model.live="typeMateriel" class="form-select form-select-sm bg-light border-0 rounded-3">
                        <option value="">Tous types</option>
                        @foreach($this->typesMateriel as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <select wire:model.live="sortField" class="form-select form-select-sm bg-light border-0 rounded-3">
                        <option value="created_at">Date création</option>
                        <option value="id">Référence</option>
                        <option value="statut">Statut</option>
                    </select>
                </div>
                <div class="col-md-1">
                    <select wire:model.live="sortDirection" class="form-select form-select-sm bg-light border-0 rounded-3">
                        <option value="desc">↓ Déc</option>
                        <option value="asc">↑ Cro</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="d-flex gap-1">
                        <button wire:click="resetFilters" class="btn btn-sm btn-light rounded-3" title="Réinitialiser">
                            <i class="bi bi-arrow-repeat"></i>
                        </button>
                        <button wire:click="deleteSelected" class="btn btn-sm btn-light text-danger rounded-3" {{ empty($selectedTickets) ? 'disabled' : '' }}>
                            <i class="bi bi-trash3"></i> ({{ count($selectedTickets) }})
                        </button>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light rounded-3" data-bs-toggle="dropdown">
                                <i class="bi bi-download"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3">
                                <li><a class="dropdown-item small" href="#" wire:click.prevent="exportExcel"><i class="bi bi-file-earmark-excel text-success me-2"></i>Excel</a></li>
                                <li><a class="dropdown-item small" href="#" wire:click.prevent="exportCSV"><i class="bi bi-file-earmark-text text-info me-2"></i>CSV</a></li>
                                <li><a class="dropdown-item small" href="#" wire:click.prevent="exportPDF"><i class="bi bi-file-earmark-pdf text-danger me-2"></i>PDF</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau simplifié -->
        <div class="table-responsive" style="max-height: 65vh; overflow-y: auto;">
            <table class="table table-sm table-hover align-middle mb-0">
                <thead class="bg-light" style="position: sticky; top: 0; z-index: 10;">
                    <tr class="small text-muted">
                        <th class="ps-4" style="width: 30px;">
                            <input type="checkbox" wire:model="selectAll" class="form-check-input rounded-1">
                        </th>
                        <th wire:click="sortBy('id')" class="sortable">Réf</th>
                        <th wire:click="sortBy('utilisateur_id')" class="sortable">Utilisateur</th>
                        <th>Type</th>
                        <th>Détails</th>
                        <th wire:click="sortBy('date_debut')" class="sortable">Début</th>
                        <th wire:click="sortBy('date_fin')" class="sortable">Fin</th>
                        <th wire:click="sortBy('statut')" class="sortable">Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($checkouts as $checkout)
                    <tr class="hover-row">
                        <td class="ps-4">
                            <input type="checkbox" wire:model="selectedTickets" value="{{ $checkout->id }}" class="form-check-input rounded-1">
                        </td>
                        <td class="fw-semibold text-primary" style="cursor: pointer;" wire:click="Visualiser({{ $checkout->id }})">#{{ $checkout->id }}</td>
                        <td style="cursor: pointer;" wire:click="Visualiser({{ $checkout->id }})">
                            <div class="d-flex align-items-center gap-2">
                                @if(!empty($checkout->utilisateur->photo))
                                    <img src="{{ asset('storage/' . $checkout->utilisateur->photo) }}" class="rounded-circle" width="24" height="24">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($checkout->utilisateur->nom ?? 'U') }}&size=24&background=5BC4BF&color=fff" class="rounded-circle" width="24" height="24">
                                @endif
                                <span class="small">{{ $checkout->utilisateur->nom ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td style="cursor: pointer;" wire:click="Visualiser({{ $checkout->id }})">
                            <span class="badge bg-light text-dark rounded-pill px-2 py-1">{{ $checkout->materiel_type }}</span>
                        </td>
                        <td class="small text-muted" style="cursor: pointer;" wire:click="Visualiser({{ $checkout->id }})">
                            @if($checkout->materiel_type == 'ordinateur')
                                {{ $checkout->ordinateur->nom ?? $checkout->materiel_details }}
                            @elseif($checkout->materiel_type == 'telephone')
                                {{ $checkout->telephone->nom ?? $checkout->materiel_details }}
                            @else
                                {{ $checkout->materiel_details ?? '-' }}
                            @endif
                        </td>
                        <td class="small" style="cursor: pointer;" wire:click="Visualiser({{ $checkout->id }})">{{ $checkout->date_debut?->format('d/m/Y') ?? '-' }}</td>
                        <td class="small" style="cursor: pointer;" wire:click="Visualiser({{ $checkout->id }})">{{ $checkout->date_fin?->format('d/m/Y') ?? '-' }}</td>
                        <td style="cursor: pointer;" wire:click="Visualiser({{ $checkout->id }})">
                            @php
                                $statusConfig = [
                                    'en_cours' => ['color' => '#F59E0B', 'icon' => 'bi-clock', 'text' => 'En cours'],
                                    'termine' => ['color' => '#10B981', 'icon' => 'bi-check-circle', 'text' => 'Terminé'],
                                    'annule' => ['color' => '#EF4444', 'icon' => 'bi-x-circle', 'text' => 'Annulé'],
                                    'en_retard' => ['color' => '#EF4444', 'icon' => 'bi-exclamation-triangle', 'text' => 'En retard'],
                                ];
                                $config = $statusConfig[$checkout->statut] ?? ['color' => '#6c757d', 'icon' => 'bi-question-circle', 'text' => ucfirst($checkout->statut)];
                            @endphp
                            <span class="badge rounded-pill px-2 py-1 small fw-normal" style="background: {{ $config['color'] }}10; color: {{ $config['color'] }}; border: 1px solid {{ $config['color'] }}20;">
                                <i class="bi {{ $config['icon'] }} me-1"></i>{{ $config['text'] }}
                            </span>
                        </td>
                        <td>
                            <button wire:click="confirmDelete({{ $checkout->id }})" class="btn btn-sm text-danger" title="Refuser">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                            Aucun checkout trouvé
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination simplifiée -->
        @if($checkouts->hasPages())
        <div class="p-3 border-top bg-white">
            <div class="d-flex justify-content-between align-items-center small text-muted">
                <span>{{ $checkouts->firstItem() ?? 0 }} - {{ $checkouts->lastItem() ?? 0 }} sur {{ $checkouts->total() }}</span>
                {{ $checkouts->links() }}
            </div>
        </div>
        @endif
    </div>

    <!-- Modal Nouveau Checkout -->
    @if($showModal)
    <div class="modal fade show d-block" tabindex="-1" style="background: rgba(0,0,0,0.5);" wire:click.self="fermerModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0" style="background: #5BC4BF;">
                    <h6 class="modal-title text-white fw-semibold"><i class="bi bi-plus-circle me-2"></i>Nouveau checkout</h6>
                    <button type="button" class="btn-close btn-close-white" wire:click="fermerModal"></button>
                </div>
                <div class="modal-body p-4">
                    <form wire:submit.prevent="saveCheckout">
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Utilisateur</label>
                            <select wire:model.defer="newUtilisateurId" class="form-select rounded-3">
                                <option value="">-- Sélectionner --</option>
                                @foreach($utilisateursList as $user)
                                    <option value="{{ $user->id }}">{{ $user->nom }} {{ $user->email ? '('.$user->email.')' : '' }}</option>
                                @endforeach
                            </select>
                            @error('newUtilisateurId') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Type matériel</label>
                            <select wire:model.defer="newMaterielType" class="form-select rounded-3">
                                <option value="">-- Sélectionner --</option>
                                <option value="ordinateur">Ordinateur</option>
                                <option value="telephone">Téléphone / Tablette</option>
                                <option value="peripherique">Périphérique</option>
                            </select>
                            @error('newMaterielType') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Détails</label>
                            <input type="text" wire:model.defer="newMaterielDetails" class="form-control rounded-3" placeholder="Ex: Dell Latitude 5520">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold text-muted">Date retour prévue</label>
                            <input type="date" wire:model.defer="newDateRendu" class="form-control rounded-3">
                            @error('newDateRendu') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                        <div class="d-flex gap-2 justify-content-end mt-4">
                            <button type="button" wire:click="fermerModal" class="btn btn-light rounded-3 px-4">Annuler</button>
                            <button type="submit" class="btn text-white rounded-3 px-4" style="background: #5BC4BF;">
                                <i class="bi bi-check-lg me-1"></i>Créer
                                <span wire:loading wire:target="saveCheckout" class="spinner-border spinner-border-sm ms-1"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    .hover-card {
        transition: all 0.2s ease;
    }
    .hover-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08) !important;
    }
    .hover-row {
        transition: background 0.15s ease;
    }
    .hover-row:hover {
        background: #f8fafc !important;
    }
    .sortable {
        cursor: pointer;
        user-select: none;
    }
    .sortable:hover {
        color: #5BC4BF !important;
    }
    .fade-in-up {
        animation: fadeInUp 0.3s ease;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    #statsCards.hidden, #filtersSection.hidden {
        display: none !important;
    }
    .table-responsive::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .table-responsive::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle stats cards
    const toggleCardsBtn = document.getElementById('toggleCardsBtn');
    const statsCards = document.getElementById('statsCards');
    const toggleCardsText = document.getElementById('toggleCardsText');
    if (toggleCardsBtn && statsCards) {
        const hidden = localStorage.getItem('statsCardsHidden') === 'true';
        if (hidden) statsCards.classList.add('hidden');
        toggleCardsBtn.addEventListener('click', () => {
            statsCards.classList.toggle('hidden');
            const isHidden = statsCards.classList.contains('hidden');
            localStorage.setItem('statsCardsHidden', isHidden);
            toggleCardsText.textContent = isHidden ? 'Afficher stats' : 'Masquer stats';
        });
    }
    // Toggle filters
    const toggleFiltersBtn = document.getElementById('toggleFiltersBtn');
    const filtersSection = document.getElementById('filtersSection');
    const toggleFiltersText = document.getElementById('toggleFiltersText');
    if (toggleFiltersBtn && filtersSection) {
        const hidden = localStorage.getItem('filtersSectionHidden') === 'true';
        if (hidden) filtersSection.classList.add('hidden');
        toggleFiltersBtn.addEventListener('click', () => {
            filtersSection.classList.toggle('hidden');
            const isHidden = filtersSection.classList.contains('hidden');
            localStorage.setItem('filtersSectionHidden', isHidden);
            toggleFiltersText.textContent = isHidden ? 'Afficher filtres' : 'Masquer filtres';
        });
    }
});
</script>