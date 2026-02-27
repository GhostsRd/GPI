<div>
    <div class="table-container border-0 shadow-sm fade-in-up">
        <!-- En-tête avec boutons de contrôle -->
        <div class="table-header p-3 rounded-top d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, rgba(91, 196, 191, 0.05), transparent); border-bottom: 1px solid rgba(91, 196, 191, 0.15);">
            <div class="table-title fw-bold" style="color: #4AA39E;">
                <i class="bi bi-cart-check me-2" style="color: #5BC4BF;"></i>
                Liste des Checkouts
            </div>
            <div class="d-flex gap-2">
                <!-- Bouton Masquer les cartes -->
                <button class="btn btn-sm" id="toggleCardsBtn" title="Masquer/Afficher les statistiques" style="background: white; border: 1px solid rgba(91, 196, 191, 0.2); color: #5BC4BF; border-radius: 10px; padding: 0.4rem 1rem; transition: all 0.3s ease;" onmouseover="this.style.background='#5BC4BF'; this.style.color='white';" onmouseout="this.style.background='white'; this.style.color='#5BC4BF';">
                    <i class="fas fa-chart-simple me-1"></i>
                    <span id="toggleCardsText">Masquer les cartes</span>
                </button>
                <!-- Bouton Filtres -->
                <button class="btn btn-sm" id="toggleFiltersBtn" title="Masquer/Afficher les filtres" style="background: white; border: 1px solid rgba(91, 196, 191, 0.2); color: #5BC4BF; border-radius: 10px; padding: 0.4rem 1rem; transition: all 0.3s ease;" onmouseover="this.style.background='#5BC4BF'; this.style.color='white';" onmouseout="this.style.background='white'; this.style.color='#5BC4BF';">
                    <i class="fas fa-sliders me-1"></i>
                    <span id="toggleFiltersText">Masquer les filtres</span>
                </button>
            </div>
        </div>

        <!-- Statistiques des checkouts (masquable) -->
        <div id="statsCards" class="row p-3">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stats-widget border-0 shadow-sm" style="border-left: 4px solid #5BC4BF !important; border-radius: 16px; transition: all 0.3s ease;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number" style="background: linear-gradient(135deg, #5BC4BF, #4AA39E); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">{{ $this->stats['total'] }}</h3>
                                <p class="stats-label mb-0" style="color: #4AA39E;">Total checkouts</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle d-flex align-items-center justify-content-center" style="background: rgba(91, 196, 191, 0.15); color: #5BC4BF;">
                                    <i class="fas fa-shopping-cart fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stats-widget border-0 shadow-sm" style="border-left: 4px solid #F59E0B !important; border-radius: 16px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number" style="color: #F59E0B;">{{ $this->stats['en_cours'] }}</h3>
                                <p class="stats-label mb-0" style="color: #F59E0B;">En cours</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle d-flex align-items-center justify-content-center" style="background: rgba(245, 158, 11, 0.15); color: #F59E0B;">
                                    <i class="fas fa-clock fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stats-widget border-0 shadow-sm" style="border-left: 4px solid #10B981 !important; border-radius: 16px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number" style="color: #10B981;">{{ $this->stats['termine'] }}</h3>
                                <p class="stats-label mb-0" style="color: #10B981;">Terminés</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle d-flex align-items-center justify-content-center" style="background: rgba(16, 185, 129, 0.15); color: #10B981;">
                                    <i class="fas fa-check-circle fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card stats-widget border-0 shadow-sm" style="border-left: 4px solid #EF4444 !important; border-radius: 16px;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number" style="color: #EF4444;">{{ $this->stats['en_retard'] }}</h3>
                                <p class="stats-label mb-0" style="color: #EF4444;">En retard</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle d-flex align-items-center justify-content-center" style="background: rgba(239, 68, 68, 0.15); color: #EF4444;">
                                    <i class="fas fa-exclamation-triangle fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barre de recherche et filtres (masquable) -->
        <div id="filtersSection" class="card border-0 shadow-sm mb-4 mx-3" style="border-radius: 16px; border: 1px solid rgba(91, 196, 191, 0.15) !important;">
            <div class="card-body py-2">
                <div class="row g-2 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label small fw-bold" style="color: #4AA39E;">Recherche</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text" style="background: transparent; border-color: rgba(91, 196, 191, 0.2); color: #5BC4BF;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" wire:model.live="search"
                                   class="form-control form-control-sm" placeholder="ID, Utilisateur..."
                                   style="border-color: rgba(91, 196, 191, 0.2); border-left: none; border-radius: 0 8px 8px 0;">
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label small fw-bold" style="color: #4AA39E;">Statut</label>
                        <select wire:model.live="statutFilter" class="form-select form-select-sm" style="border-color: rgba(91, 196, 191, 0.2); border-radius: 8px;">
                            <option value="">Tous les statuts</option>
                            <option value="en_cours">En cours</option>
                            <option value="termine">Terminé</option>
                            <option value="annule">Annulé</option>
                            <option value="en_retard">En retard</option>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label class="form-label small fw-bold" style="color: #4AA39E;">Type matériel</label>
                        <select wire:model.live="typeMateriel" class="form-select form-select-sm" style="border-color: rgba(91, 196, 191, 0.2); border-radius: 8px;">
                            <option value="">Tous les types</option>
                            @foreach($this->typesMateriel as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label small fw-bold" style="color: #4AA39E;">Tri par</label>
                        <select wire:model.live="sortField" class="form-select form-select-sm" style="border-color: rgba(91, 196, 191, 0.2); border-radius: 8px;">
                            <option value="created_at">Date création</option>
                            <option value="id">Référence</option>
                            <option value="statut">Statut</option>
                            <option value="date_debut">Date début</option>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <label class="form-label small fw-bold" style="color: #4AA39E;">Ordre</label>
                        <select wire:model.live="sortDirection" class="form-select form-select-sm" style="border-color: rgba(91, 196, 191, 0.2); border-radius: 8px;">
                            <option value="desc">Décroissant</option>
                            <option value="asc">Croissant</option>
                        </select>
                    </div>

                    <div class="col-md-1">
                        <button type="button" wire:click="resetFilters"
                                class="btn btn-sm w-100 mt-3" title="Réinitialiser les filtres"
                                style="background: white; border: 1px solid rgba(91, 196, 191, 0.2); color: #5BC4BF; border-radius: 8px; transition: all 0.3s ease;"
                                onmouseover="this.style.background='#5BC4BF'; this.style.color='white';"
                                onmouseout="this.style.background='white'; this.style.color='#5BC4BF';">
                            <i class="fas fa-redo"></i>
                        </button>
                    </div>

                    <div class="col-md-1">
                        <button wire:click="deleteSelected" class="btn btn-sm w-100 mt-3" 
                                title="Supprimer les checkouts sélectionnés"
                                {{ empty($selectedTickets) ? 'disabled' : '' }}
                                style="background: #EF4444; border: none; color: white; border-radius: 8px; opacity: {{ empty($selectedTickets) ? '0.5' : '1' }};">
                            <i class="fas fa-trash"></i>
                            ({{ count($selectedTickets) }})
                        </button>
                    </div>

                    <div class="col-md-1">
                        <button wire:click="exportCheckouts" class="btn btn-sm w-100 mt-3" 
                                title="Exporter les checkouts"
                                style="background: #10B981; border: none; color: white; border-radius: 8px;">
                            <i class="fas fa-download"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des checkouts -->
        <div class="table-wrapper p-0 border-0 w-100 compact-mode mx-3">
            <table class="table table-hover border-0 shadow-sm text-center small" wire:poll.5s style="border-radius: 16px; overflow: hidden;">
                <thead style="background: rgba(91, 196, 191, 0.05);">
                    <tr>
                        <th class="py-2" style="width: 30px; color: #4AA39E;">
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern" style="accent-color: #5BC4BF;">
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('id')" style="width: 80px; color: #4AA39E;">
                            Référence
                            <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('utilisateur_id')" style="width: 120px; color: #4AA39E;">
                            Utilisateur
                            <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('materiel_type')" style="width: 120px; color: #4AA39E;">
                            Type matériel
                            <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th class="py-2" style="width: 150px; color: #4AA39E;">
                            Détails matériel
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('statut')" style="width: 120px; color: #4AA39E;">
                            Statut
                            <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                       
                        <th class="py-2 sortable" wire:click="sortBy('date_debut')" style="width: 100px; color: #4AA39E;">
                            Date début
                            <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('date_fin')" style="width: 100px; color: #4AA39E;">
                            Date fin
                            <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th class="py-2 sortable" wire:click="sortBy('created_at')" style="width: 120px; color: #4AA39E;">
                            Date création
                            <i class="bi bi-arrow-down-up ms-1"></i>
                        </th>
                        <th class="py-2" style="width: 80px; color: #4AA39E;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($checkouts as $checkout)
                        <tr class="hover-row" style="cursor:pointer; transition: all 0.2s ease;">
                            <td class="py-2">
                                <input type="checkbox"
                                       wire:model="selectedTickets"
                                       value="{{ $checkout->id }}"
                                       class="checkbox-modern"
                                       style="accent-color: #5BC4BF;">
                            </td>
                            <td class="py-2 fw-bold" wire:click="Visualiser({{ $checkout->id }})" style="color: #5BC4BF;">
                                #{{ $checkout->id }}
                            </td>
                            <td class="py-2" wire:click="Visualiser({{ $checkout->id }})">
                                <div class="d-flex align-items-center justify-content-center">
                                    @if (!empty($checkout->utilisateur->photo ))
                                          <img width="30" height="30" class="rounded-pill my-0 py-0"
                                            src="{{ asset('storage/' . $checkout->utilisateur->photo ) }}"
                                            alt="">
                                         <span class="text-muted small text-capitalize">{{ $checkout->utilisateur->nom ?? 'N/A' }}</span>

                                    @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($checkout->utilisateur->nom ?? 'Utilisateur') }}&size=24&background=5BC4BF&color=fff" 
                                         class="rounded-circle me-2" width="20" height="20">
                                         <span class="text-muted small">{{ $checkout->utilisateur->nom ?? 'N/A' }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-2" wire:click="Visualiser({{ $checkout->id }})">
                                <span class="badge small" style="background: rgba(91, 196, 191, 0.15); color: #4AA39E; border: 1px solid rgba(91, 196, 191, 0.3); padding: 0.35rem 0.65rem; border-radius: 20px;">
                                    {{ $checkout->materiel_type }}
                                </span>
                            </td>
                            <td class="py-2" wire:click="Visualiser({{ $checkout->id }})">
                                <small class="text-muted">
                                    @if ($checkout->materiel_type  == 'ordinateur' )
                                        {{ $checkout->ordinateur->nom ?? null }}  {{ $checkout->ordinateur->os_version ?? null }}
                                    @endif
                                    @if ($checkout->materiel_type  == 'telephone')
                                                {{ $checkout->telephone->nom ?? null }}  {{ $checkout->telephone->marque }}
                                    @endif
                                     @if ($checkout->materiel_type  == 'peripherique')
                                        @foreach ($Peripheriques as $peripherique)
                                        @if ($checkout->materiel_details == $peripherique->type )
                                              {{ $peripherique->nom ?? null}} {{ $peripherique->fabricant ?? null }}
                                            
                                         
                                            @endif
                                        @endforeach
                                    @endif
                                    @if (!empty($checkout->materiel_details ))
                                    {{ $checkout->materiel_details }}                                    
                                    @endif
                                </small>
                            </td>
                            <td class="py-2">
                                @if($checkout->statut == 'en_cours')
                                    <span class="badge small" style="background: rgba(245, 158, 11, 0.15); color: #F59E0B; border: 1px solid rgba(245, 158, 11, 0.3); padding: 0.35rem 0.65rem; border-radius: 20px;">
                                        <i class="bi bi-clock me-1"></i>En cours
                                    </span>
                                @elseif($checkout->statut == 'termine')
                                    <span class="badge small" style="background: rgba(16, 185, 129, 0.15); color: #10B981; border: 1px solid rgba(16, 185, 129, 0.3); padding: 0.35rem 0.65rem; border-radius: 20px;">
                                        <i class="bi bi-check-circle me-1"></i>Terminé
                                    </span>
                                @elseif($checkout->statut == 'annule')
                                    <span class="badge small" style="background: rgba(239, 68, 68, 0.15); color: #EF4444; border: 1px solid rgba(239, 68, 68, 0.3); padding: 0.35rem 0.65rem; border-radius: 20px;">
                                        <i class="bi bi-x-circle me-1"></i>Annulé
                                    </span>
                                @elseif($checkout->statut == 'en_retard')
                                    <span class="badge small" style="background: rgba(239, 68, 68, 0.15); color: #EF4444; border: 1px solid rgba(239, 68, 68, 0.3); padding: 0.35rem 0.65rem; border-radius: 20px;">
                                        <i class="bi bi-exclamation-triangle me-1"></i>En retard
                                    </span>
                                @else
                                    <span class="badge small" style="background: rgba(108, 117, 125, 0.15); color: #6c757d; border: 1px solid rgba(108, 117, 125, 0.3); padding: 0.35rem 0.65rem; border-radius: 20px;">
                                        {{ $checkout->statut }}
                                    </span>
                                @endif
                            </td>
                            
                            <td class="py-2 text-muted small" wire:click="Visualiser({{ $checkout->id }})">
                                {{ $checkout->date_debut?->format('d M Y') ?? 'N/A' }}
                            </td>
                            <td class="py-2 text-muted small" wire:click="Visualiser({{ $checkout->id }})">
                                {{ $checkout->date_fin?->format('d M Y') ?? 'N/A' }}
                            </td>
                            <td class="py-2 text-muted small" wire:click="Visualiser({{ $checkout->id }})">
                                {{ $checkout->created_at->format('d M Y') }}
                                <br>
                                <small class="text-muted">{{ $checkout->created_at->format('H:i') }}</small>
                            </td>
                            <td class="py-2">
                                <div class="action-buttons d-flex justify-content-center gap-1">
                                    <button class="btn-action btn-view btn-sm" 
                                            title="Voir détails"
                                            style="width: 24px; height: 24px; border-radius: 6px; border: none; background: transparent; color: #5BC4BF; transition: all 0.2s ease;"
                                            onmouseover="this.style.background='rgba(91, 196, 191, 0.1)'; this.style.transform='scale(1.1)';"
                                            onmouseout="this.style.background='transparent'; this.style.transform='scale(1)';">
                                        <a href="{{ url('/admin/checkout-view-'.$checkout->id) }}" style="color: #5BC4BF;">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </button>
                                    <button wire:click="$dispatch('editCheckout', {id: {{ $checkout->id }}})"
                                            class="btn-action btn-edit btn-sm" 
                                            title="Modifier"
                                            style="width: 24px; height: 24px; border-radius: 6px; border: none; background: transparent; color: #F59E0B; transition: all 0.2s ease;"
                                            onmouseover="this.style.background='rgba(245, 158, 11, 0.1)'; this.style.transform='scale(1.1)';"
                                            onmouseout="this.style.background='transparent'; this.style.transform='scale(1)';">
                                        <i class="fas fa-edit" style="color: #F59E0B;"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $checkout->id }})"
                                            class="btn-action btn-delete btn-sm" 
                                            title="Supprimer"
                                            style="width: 24px; height: 24px; border-radius: 6px; border: none; background: transparent; color: #EF4444; transition: all 0.2s ease;"
                                            onmouseover="this.style.background='rgba(239, 68, 68, 0.1)'; this.style.transform='scale(1.1)';"
                                            onmouseout="this.style.background='transparent'; this.style.transform='scale(1)';">
                                        <i class="fas fa-trash" style="color: #EF4444;"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="py-4 text-center" style="color: #6c757d;">
                                <i class="bi bi-cart me-2" style="color: #5BC4BF;"></i>Aucun checkout trouvé
                            </td>
                        </tr>
                    @endforelse
                    @if($checkouts->count() > 0)
                        <tr>
                            <td colspan="11" class="py-2 small" style="background: rgba(91, 196, 191, 0.03); color: #4AA39E;">
                                Affichage de {{ $checkouts->count() }} checkout(s) sur cette page
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($checkouts->hasPages())
        <div class="table-footer p-3 rounded-bottom mx-3" style="background: rgba(91, 196, 191, 0.03); border-top: 1px solid rgba(91, 196, 191, 0.15);">
            <div class="d-flex justify-content-between align-items-center">
                <div class="small" style="color: #4AA39E;">
                    @if($checkouts->total() > 0)
                    Affichage de {{ $checkouts->firstItem() }} à {{ $checkouts->lastItem() }} sur {{ $checkouts->total() }} checkouts
                    @else
                    Aucun checkout
                    @endif
                </div>
                <div class="pagination-container">
                    {{ $checkouts->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root {
    --primary: #5BC4BF;
    --primary-dark: #4AA39E;
    --primary-light: #7FD9D4;
    --primary-soft: rgba(91, 196, 191, 0.1);
    --primary-glow: rgba(91, 196, 191, 0.2);
}

.small {
    font-size: 0.75rem;
}

.table th, .table td {
    font-size: 0.75rem;
    padding: 0.5rem;
}

.compact-mode .table td, .compact-mode .table th {
    padding: 0.4rem 0.5rem;
}

.hover-row:hover {
    background: rgba(91, 196, 191, 0.03) !important;
    transition: all 0.2s ease;
    transform: scale(1.01);
    box-shadow: 0 4px 12px rgba(91, 196, 191, 0.1);
}

.badge {
    font-size: 0.7rem;
    font-weight: 500;
}

.btn-xs {
    padding: 0.15rem 0.4rem;
    font-size: 0.7rem;
    border-radius: 0.2rem;
}

.action-buttons .btn-action {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    border-radius: 0.2rem;
    background: transparent;
    transition: all 0.2s ease;
}

.action-buttons .btn-action:hover {
    background-color: rgba(91, 196, 191, 0.1);
    transform: scale(1.1);
}

.sortable {
    cursor: pointer;
    transition: color 0.2s ease;
}

.sortable:hover {
    color: #5BC4BF !important;
}

.table-header {
    border-bottom: 1px solid rgba(91, 196, 191, 0.15);
}

.table-footer {
    border-top: 1px solid rgba(91, 196, 191, 0.15);
}

.stats-widget {
    transition: transform 0.2s ease;
    border-radius: 16px !important;
}

.stats-widget:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(91, 196, 191, 0.15) !important;
}

.stats-number {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 0.2rem;
}

.stats-label {
    font-size: 0.8rem;
    font-weight: 500;
}

.avatar-sm {
    width: 40px;
    height: 40px;
    border-radius: 12px !important;
}

.form-control-sm, .form-select-sm {
    font-size: 0.75rem;
    border-color: rgba(91, 196, 191, 0.2) !important;
    border-radius: 8px !important;
}

.form-control-sm:focus, .form-select-sm:focus {
    border-color: #5BC4BF !important;
    box-shadow: 0 0 0 3px rgba(91, 196, 191, 0.15) !important;
    outline: none !important;
}

.checkbox-modern {
    width: 16px;
    height: 16px;
    accent-color: #5BC4BF;
}

/* Animations pour le masquage/affichage */
#statsCards, #filtersSection {
    transition: all 0.3s ease-in-out;
    overflow: hidden;
}

#statsCards.hidden, #filtersSection.hidden {
    display: none !important;
}

.btn-outline-primary, .btn-outline-secondary {
    transition: all 0.2s ease;
}

.btn-outline-primary:hover, .btn-outline-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(91, 196, 191, 0.15);
}

.btn-outline-primary i, .btn-outline-secondary i {
    transition: transform 0.2s ease;
}

.btn-outline-primary:hover i, .btn-outline-secondary:hover i {
    transform: rotate(5deg);
}

/* Personnalisation de la pagination */
.pagination .page-link {
    color: #5BC4BF;
    border-color: rgba(91, 196, 191, 0.2);
    border-radius: 8px;
    margin: 0 2px;
}

.pagination .page-link:hover {
    background: #5BC4BF;
    color: white;
    border-color: #5BC4BF;
}

.pagination .active .page-link {
    background: #5BC4BF;
    border-color: #5BC4BF;
    color: white;
}

/* Animation fade-in */
.fade-in-up {
    animation: fadeInUp 0.6s ease forwards;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestionnaire pour masquer/afficher les cartes statistiques
    const toggleCardsBtn = document.getElementById('toggleCardsBtn');
    const statsCards = document.getElementById('statsCards');
    const toggleCardsText = document.getElementById('toggleCardsText');
    
    if (toggleCardsBtn && statsCards) {
        // Vérifier l'état sauvegardé dans localStorage
        const cardsHidden = localStorage.getItem('statsCardsHidden') === 'true';
        if (cardsHidden) {
            statsCards.classList.add('hidden');
            toggleCardsText.textContent = 'Afficher les cartes';
            toggleCardsBtn.innerHTML = '<i class="fas fa-chart-simple me-1"></i><span id="toggleCardsText">Afficher les cartes</span>';
        }
        
        toggleCardsBtn.addEventListener('click', function() {
            statsCards.classList.toggle('hidden');
            const isHidden = statsCards.classList.contains('hidden');
            localStorage.setItem('statsCardsHidden', isHidden);
            
            if (isHidden) {
                toggleCardsText.textContent = 'Afficher les cartes';
            } else {
                toggleCardsText.textContent = 'Masquer les cartes';
            }
        });
    }
    
    // Gestionnaire pour masquer/afficher les filtres
    const toggleFiltersBtn = document.getElementById('toggleFiltersBtn');
    const filtersSection = document.getElementById('filtersSection');
    const toggleFiltersText = document.getElementById('toggleFiltersText');
    
    if (toggleFiltersBtn && filtersSection) {
        // Vérifier l'état sauvegardé dans localStorage
        const filtersHidden = localStorage.getItem('filtersSectionHidden') === 'true';
        if (filtersHidden) {
            filtersSection.classList.add('hidden');
            toggleFiltersText.textContent = 'Afficher les filtres';
            toggleFiltersBtn.innerHTML = '<i class="fas fa-sliders me-1"></i><span id="toggleFiltersText">Afficher les filtres</span>';
        }
        
        toggleFiltersBtn.addEventListener('click', function() {
            filtersSection.classList.toggle('hidden');
            const isHidden = filtersSection.classList.contains('hidden');
            localStorage.setItem('filtersSectionHidden', isHidden);
            
            if (isHidden) {
                toggleFiltersText.textContent = 'Afficher les filtres';
            } else {
                toggleFiltersText.textContent = 'Masquer les filtres';
            }
        });
    }
});
</script>