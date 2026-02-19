<div class="equipement-dashboard">
    <!-- Header Principal -->
    <header class="dashboard-header">
        <div class="header-content">
            <div class="header-left">
                <h1 class="dashboard-title">🚨 Gestion des Incidents</h1>
                <p class="dashboard-subtitle">Suivi et gestion complète des incidents matériels</p>
            </div>
            <div class="header-right">
                <div class="total-badge">
                    <span class="total-number">{{ $totalIncidents }}</span>
                    <span class="total-label">Incidents</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu Principal -->
    <main class="dashboard-main">
        <!-- Cartes Statistiques Principales -->
        <div class="stats-grid-simple">
            <!-- Carte 1: Total Incidents -->
            <div class="stat-card">
                <div class="stat-icon primary">
                    <span>🚨</span>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $totalIncidents }}</div>
                    <div class="stat-label">Total Incidents</div>
                    <div class="stat-description">Tous statuts confondus</div>
                </div>
            </div>

            <!-- Carte 2: Nouveaux Incidents -->
            <div class="stat-card">
                <div class="stat-icon warning">
                    <span>🆕</span>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $nouveauxIncidents }}</div>
                    <div class="stat-label">Nouveaux</div>
                    <div class="stat-description">En attente de traitement</div>
                </div>
            </div>

            <!-- Carte 3: En Cours -->
            <div class="stat-card">
                <div class="stat-icon info">
                    <span>🔄</span>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $enCoursIncidents }}</div>
                    <div class="stat-label">En Cours</div>
                    <div class="stat-description">En cours de résolution</div>
                </div>
            </div>

            <!-- Carte 4: Résolus -->
            <div class="stat-card">
                <div class="stat-icon success">
                    <span>✅</span>
                </div>
                <div class="stat-content">
                    <div class="stat-number">{{ $resolusIncidents + $closIncidents }}</div>
                    <div class="stat-label">Résolus/Clos</div>
                    <div class="stat-description">Incidents traités</div>
                </div>
            </div>
        </div>

        <!-- Barre d'actions et filtres -->
        <div class="table-section">
            <div class="table-header">
                <h3 class="table-title">📋 Liste des Incidents</h3>
                <div class="table-actions">
                    <div class="search-box">
                        <input type="text" wire:model.live="recherche" placeholder="Rechercher..." class="search-input">
                        <span class="search-icon">🔍</span>
                    </div>
                    <div class="filter-group">
                        <select wire:model.live="nature" class="filter-select">
                            <option value="">Toutes natures</option>
                            <option value="panne">Panne</option>
                            <option value="perte">Perte</option>
                            <option value="vol">Vol</option>
                            <option value="degat">Dégât</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                        <select wire:model.live="statut" class="filter-select">
                            <option value="">Tous statuts</option>
                            <option value="nouveau">Nouveau</option>
                            <option value="en_cours">En Cours</option>
                            <option value="resolu">Résolu</option>
                            <option value="clos">Clos</option>
                        </select>
                    </div>
                    <button wire:click="showCreateForm" class="btn-export">
                        <span>➕ Nouvel Incident</span>
                    </button>
                    @if(count($selectedIncidents) > 0)
                    <button wire:click="confirmBulkDelete" class="btn-export danger">
                        <span>🗑️ Supprimer ({{ count($selectedIncidents) }})</span>
                    </button>
                    @endif
                </div>
            </div>

            <!-- Tableau des incidents -->
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="sortable">
                                <input type="checkbox" wire:model.live="selectAll" class="table-checkbox">
                            </th>
                            <th class="sortable" wire:click="sortBy('numero_rapport')">
                                N° Rapport
                                @if($sortField === 'numero_rapport')
                                    <span class="sort-indicator">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </th>
                            <th class="sortable" wire:click="sortBy('date_incident')">
                                Date
                                @if($sortField === 'date_incident')
                                    <span class="sort-indicator">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </th>
                            <th>Nature</th>
                            <th>Équipement</th>
                            <th>Lieu</th>
                            <th class="sortable" wire:click="sortBy('statut_final')">
                                Statut
                                @if($sortField === 'statut_final')
                                    <span class="sort-indicator">{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                                @endif
                            </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($incidents as $incident)
                        <tr class="table-row {{ in_array($incident->id, $selectedIncidents) ? 'selected' : '' }}">
                            <td>
                                <input type="checkbox" value="{{ $incident->id }}" 
                                       wire:model.live="selectedIncidents" class="table-checkbox">
                            </td>
                            <td>
                                <div class="table-reference">{{ $incident->numero_rapport ?? 'N/A' }}</div>
                            </td>
                            <td>
                                <div class="table-date">{{ $incident->date_incident->format('d/m/Y') }}</div>
                            </td>
                            <td>
                                <div class="table-nature">{{ $incident->nature_incident }}</div>
                            </td>
                            <td>
                                <div class="category-info">
                                    <div class="category-badge {{ $this->getCategoryColor($incident->type_materiel) }}">
                                        <span class="category-icon">{{ $this->getCategoryIcon($incident->type_materiel) }}</span>
                                        <span>{{ $incident->type_materiel ? ucfirst($incident->type_materiel) : 'N/A' }}</span>
                                    </div>
                                </div>
                                <div class="equipement-details">{{ $incident->nom_equipement }}</div>
                            </td>
                            <td>
                                <div class="table-lieu">{{ $incident->lieu_perte ?? 'N/A' }}</div>
                            </td>
                            <td>
                                @php
                                    $statusConfig = $this->getStatusConfig($incident->statut_final);
                                @endphp
                                <span class="status-badge {{ $statusConfig['class'] }}">
                                    {{ $statusConfig['icon'] }} {{ $incident->statut_formate }}
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button wire:click="showEditForm({{ $incident->id }})" 
                                            class="btn-action edit" title="Modifier">
                                        <svg class="action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button wire:click="confirmDelete({{ $incident->id }})" 
                                            class="btn-action delete" title="Supprimer">
                                        <svg class="action-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="no-data">
                                <div class="no-data-content">
                                    <svg class="no-data-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <p class="no-data-text">Aucun incident trouvé</p>
                                    <p class="no-data-subtext">Aucun incident ne correspond à vos critères de recherche.</p>
                                    <button wire:click="showCreateForm" class="btn-export">
                                        <span>➕ Créer le premier incident</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($incidents->hasPages())
            <div class="table-pagination">
                {{ $incidents->links() }}
            </div>
            @endif
        </div>
    </main>
</div>

<!-- Modal de confirmation de suppression -->
@if($showDeleteModal)
<div class="modal fade show" 
     style="display: block; background: rgba(0,0,0,0.5);"
     tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="background: white;">
            <div class="modal-header bg-danger text-white border-0 p-3">
                <h5 class="modal-title fw-bold m-0" style="color: white;">
                    <i class="bi bi-exclamation-triangle me-2"></i> Confirmation de suppression
                </h5>
                <button type="button" class="btn-close btn-close-white" wire:click="cancelDelete"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <i class="bi bi-trash3 text-danger" style="font-size: 3rem;"></i>
                </div>
                @if($isBulkDelete)
                    <p class="fs-5 mb-1" style="color: #1e293b;">Êtes-vous sûr de vouloir supprimer les <strong>{{ count($selectedIncidents) }}</strong> incidents sélectionnés ?</p>
                @else
                    <p class="fs-5 mb-1" style="color: #1e293b;">Êtes-vous sûr de vouloir supprimer l'incident <strong>{{ $selectedIncidentNature }}</strong> ?</p>
                @endif
                <p class="text-muted small">Cette action est irréversible et toutes les données associées seront définitivement perdues.</p>
            </div>
            <div class="modal-footer bg-light border-0 justify-content-center p-3">
                <button type="button" class="btn btn-secondary px-4 me-2" wire:click="cancelDelete">
                    <i class="bi bi-x-lg me-1"></i> Annuler
                </button>
                <button type="button" class="btn btn-danger px-4" wire:click="deleteConfirmed">
                    <i class="bi bi-trash-fill me-1"></i> Confirmer la suppression
                </button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal Formulaire -->
@if($showForm)
<div class="modal-overlay">
    <div class="modal-container large">
        <div class="modal-header">
            <h3 class="modal-title">{{ $editMode ? 'Modifier l\'incident' : 'Nouvel Incident' }}</h3>
            <button wire:click="cancelForm" class="modal-close">
                <svg class="modal-close-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <form wire:submit.prevent="saveIncident" class="modal-form">
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Date Incident *</label>
                    <input type="date" wire:model="date_incident" class="form-input">
                    @error('date_incident') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Nature Incident *</label>
                    <input type="text" wire:model="nature_incident" placeholder="Ex: Panne, Perte, Vol..." class="form-input">
                    @error('nature_incident') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Numéro Rapport</label>
                    <input type="text" wire:model="numero_rapport" placeholder="Ex: INC-2024-001" class="form-input">
                    @error('numero_rapport') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Lieu Perte/Panne</label>
                    <input type="text" wire:model="lieu_perte" placeholder="Ex: Bureau 101, Salle de réunion..." class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Service</label>
                    <select wire:model="service_id" class="form-select">
                        <option value="">Sélectionner un service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Département</label>
                    <select wire:model="department_id" class="form-select">
                        <option value="">Sélectionner un département</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Technicien assigné</label>
                    <select wire:model="technicien_id" class="form-select">
                        <option value="">Sélectionner un technicien</option>
                        @foreach($techniciens as $technicien)
                            <option value="{{ $technicien->id }}">{{ $technicien->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Statut *</label>
                    <select wire:model="statut_final" class="form-select">
                        <option value="nouveau">Nouveau</option>
                        <option value="en_cours">En Cours</option>
                        <option value="resolu">Résolu</option>
                        <option value="clos">Clos</option>
                    </select>
                    @error('statut_final') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Type d'Équipement *</label>
                    <select wire:model="type_materiel" class="form-select">
                        <option value="">Sélectionner un type</option>
                        <option value="ordinateur">Ordinateur</option>
                        <option value="imprimante">Imprimante</option>
                        <option value="telephone">Téléphone</option>
                        <option value="logiciel">Logiciel</option>
                        <option value="peripherique">Périphérique</option>
                        <option value="moniteur">Moniteur</option>
                        <option value="reseau">Matériel Réseau</option>
                        <option value="autre">Autre</option>
                    </select>
                    @error('type_materiel') <span class="form-error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Équipement</label>
                    <select wire:model="materiel_id" class="form-select" {{ !$type_materiel ? 'disabled' : '' }}>
                        <option value="">Sélectionner un équipement</option>
                        @foreach($materiels as $materiel)
                            <option value="{{ $materiel->id }}">
                                {{ $materiel->nom ?? $materiel->modele ?? $materiel->type ?? 'N/A' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Détails de la Panne/Incident</label>
                    <textarea wire:model="details_panne" rows="4" placeholder="Décrivez en détail la panne ou l'incident..." class="form-textarea"></textarea>
                </div>

                <div class="form-group full-width">
                    <label class="form-label">Observations</label>
                    <textarea wire:model="observation" rows="3" placeholder="Observations supplémentaires..." class="form-textarea"></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" wire:click="cancelForm" class="btn-secondary">
                    Annuler
                </button>
                <button type="submit" class="btn-primary">
                    <svg class="btn-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ $editMode ? 'Modifier' : 'Créer' }} l'incident
                </button>
            </div>
        </form>
    </div>
</div>
@endif

<!-- Messages flash -->
@if (session()->has('message'))
<div class="flash-message success">
    <svg class="flash-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
    </svg>
    {{ session('message') }}
</div>
@endif

@if (session()->has('error'))
<div class="flash-message error">
    <svg class="flash-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
    {{ session('error') }}
</div>
@endif

<style>
    /* Variables CSS modernes - Mêmes que votre design */
    :root {
        --primary: #06b6d4;
        --primary-light: #22d3ee;
        --primary-dark: #0891b2;
        --primary-50: #f0fdff;
        --primary-100: #ccfbf1;
        --success: #10b981;
        --warning: #f59e0b;
        --info: #3b82f6;
        --danger: #ef4444;
        --dark: #1e293b;
        --light: #ffffff;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --border: #e2e8f0;
        --card-bg: #ffffff;
        --shadow: rgba(15, 23, 42, 0.08);
        --shadow-lg: rgba(15, 23, 42, 0.15);
        --gradient-primary: linear-gradient(135deg, var(--primary), #8b5cf6);
    }

    /* Reset et base */
    .equipement-dashboard {
        background: var(--gray-50);
        min-height: 100vh;
        padding: 1.5rem;
        font-family: 'Nunito', 'Inter', sans-serif;
        font-size: 0.875rem;
    }

    /* Header */
    .dashboard-header {
        margin-bottom: 2rem;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 1.5rem;
    }

    .header-left {
        flex: 1;
    }

    .dashboard-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.5rem;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .dashboard-subtitle {
        color: var(--gray-600);
        font-size: 0.9rem;
    }

    .total-badge {
        background: var(--gradient-primary);
        color: white;
        padding: 0.75rem 1.25rem;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(6, 182, 212, 0.2);
    }

    .total-number {
        display: block;
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1;
    }

    .total-label {
        font-size: 0.75rem;
        opacity: 0.9;
        font-weight: 600;
    }

    /* Cartes Statistiques Simplifiées */
    .stats-grid-simple {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: 10px;
        padding: 1.25rem;
        box-shadow: 0 1px 3px var(--shadow);
        border: 1px solid var(--border);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px var(--shadow-lg);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .stat-icon.primary {
        background: var(--primary-50);
        color: var(--primary);
    }

    .stat-icon.success {
        background: rgba(16, 185, 129, 0.1);
        color: var(--success);
    }

    .stat-icon.info {
        background: rgba(59, 130, 246, 0.1);
        color: var(--info);
    }

    .stat-icon.warning {
        background: rgba(245, 158, 11, 0.1);
        color: var(--warning);
    }

    .stat-content {
        flex: 1;
    }

    .stat-number {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        line-height: 1;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        color: var(--gray-600);
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 0.125rem;
    }

    .stat-description {
        color: var(--gray-500);
        font-size: 0.75rem;
    }

    /* Tableau */
    .table-section {
        background: var(--card-bg);
        border-radius: 12px;
        box-shadow: 0 1px 3px var(--shadow);
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .table-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .table-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0;
    }

    .table-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-box {
        position: relative;
        min-width: 200px;
    }

    .search-input {
        width: 100%;
        padding: 0.5rem 2.5rem 0.5rem 1rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 0.8rem;
        background: var(--gray-50);
        color: var(--dark);
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(6, 182, 212, 0.1);
    }

    .search-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
    }

    .filter-group {
        display: flex;
        gap: 0.5rem;
    }

    .filter-select {
        padding: 0.5rem 1rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 0.8rem;
        background: var(--gray-50);
        color: var(--dark);
        min-width: 120px;
    }

    .btn-export {
        background: var(--gradient-primary);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .btn-export:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(6, 182, 212, 0.3);
    }

    .btn-export.danger {
        background: linear-gradient(135deg, var(--danger), #dc2626);
    }

    .btn-export.danger:hover {
        box-shadow: 0 3px 10px rgba(239, 68, 68, 0.3);
    }

    .table-container {
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.8rem;
    }

    .data-table thead {
        background: var(--gradient-primary);
    }

    .data-table th {
        padding: 0.75rem 1rem;
        color: var(--gray-500);
        font-weight: 600;
        text-align: left;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        user-select: none;
    }

    .data-table th.sortable:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .sort-indicator {
        margin-left: 0.25rem;
        font-weight: bold;
    }

    .data-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: background-color 0.2s ease;
    }

    .data-table tbody tr:hover {
        background: var(--gray-50);
    }

    .data-table tbody tr.selected {
        background: var(--primary-50);
    }

    .data-table td {
        padding: 0.75rem 1rem;
        color: var(--dark);
        font-weight: 500;
    }

    .table-checkbox {
        width: 16px;
        height: 16px;
        border-radius: 3px;
        border: 1px solid var(--gray-300);
        cursor: pointer;
    }

    .table-reference {
        font-weight: 600;
        color: var(--primary);
    }

    .table-date {
        color: var(--gray-600);
    }

    .table-nature {
        font-weight: 500;
    }

    .table-lieu {
        color: var(--gray-600);
    }

    .equipement-details {
        font-size: 0.7rem;
        color: var(--gray-500);
        margin-top: 0.25rem;
    }

    /* Badges de catégorie */
    .category-badge {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 0.6rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.75rem;
        width: fit-content;
    }

    .category-badge.blue { background: var(--primary-50); color: var(--primary-dark); }
    .category-badge.green { background: rgba(16, 185, 129, 0.1); color: #065f46; }
    .category-badge.yellow { background: rgba(245, 158, 11, 0.1); color: #92400e; }
    .category-badge.purple { background: rgba(139, 92, 246, 0.1); color: #5b21b6; }
    .category-badge.red { background: rgba(239, 68, 68, 0.1); color: #991b1b; }
    .category-badge.indigo { background: rgba(79, 70, 229, 0.1); color: #3730a3; }

    .category-icon {
        font-size: 0.9rem;
    }

    /* Badges de statut */
    .status-badge {
        padding: 0.4rem 0.75rem;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
        text-align: center;
        min-width: 80px;
    }

    .status-badge.nouveau {
        background: rgba(59, 130, 246, 0.1);
        color: #1e40af;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .status-badge.en_cours {
        background: rgba(245, 158, 11, 0.1);
        color: #92400e;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .status-badge.resolu {
        background: rgba(16, 185, 129, 0.1);
        color: #065f46;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status-badge.clos {
        background: rgba(100, 116, 139, 0.1);
        color: #475569;
        border: 1px solid rgba(100, 116, 139, 0.3);
    }

    /* Actions */
    .action-buttons {
        display: flex;
        gap: 0.3rem;
    }

    .btn-action {
        width: 28px;
        height: 28px;
        border: none;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-action:hover {
        transform: scale(1.05);
    }

    .btn-action.edit {
        background: rgba(6, 182, 212, 0.1);
        color: var(--primary);
    }

    .btn-action.edit:hover {
        background: rgba(6, 182, 212, 0.2);
    }

    .btn-action.delete {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    .btn-action.delete:hover {
        background: rgba(239, 68, 68, 0.2);
    }

    .action-icon {
        width: 14px;
        height: 14px;
    }

    /* État vide */
    .no-data {
        text-align: center;
        padding: 3rem 1rem;
    }

    .no-data-content {
        max-width: 300px;
        margin: 0 auto;
    }

    .no-data-icon {
        width: 64px;
        height: 64px;
        color: var(--gray-300);
        margin-bottom: 1rem;
    }

    .no-data-text {
        color: var(--gray-600);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .no-data-subtext {
        color: var(--gray-500);
        font-size: 0.8rem;
        margin-bottom: 1.5rem;
    }

    /* Pagination */
    .table-pagination {
        padding: 1rem 1.25rem;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: center;
    }

    /* Modals */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        padding: 1rem;
    }

    .modal-container {
        background: var(--card-bg);
        border-radius: 12px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        max-height: 90vh;
        overflow-y: auto;
    }

    .modal-container.large {
        max-width: 800px;
    }

    .modal-header {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .modal-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .modal-icon.danger {
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger);
    }

    .modal-icon-svg {
        width: 20px;
        height: 20px;
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0;
        flex: 1;
    }

    .modal-close {
        background: none;
        border: none;
        color: var(--gray-400);
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .modal-close:hover {
        background: var(--gray-100);
        color: var(--gray-600);
    }

    .modal-close-icon {
        width: 20px;
        height: 20px;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-text {
        color: var(--gray-600);
        line-height: 1.6;
        margin: 0;
    }

    .modal-actions {
        padding: 1.5rem;
        border-top: 1px solid var(--border);
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
    }

    /* Formulaires */
    .modal-form {
        padding: 0;
    }

    .form-grid {
        padding: 1.5rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        font-weight: 600;
        color: var(--dark);
        font-size: 0.8rem;
    }

    .form-input,
    .form-select,
    .form-textarea {
        padding: 0.75rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 0.8rem;
        background: var(--gray-50);
        color: var(--dark);
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(6, 182, 212, 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 80px;
    }

    .form-error {
        color: var(--danger);
        font-size: 0.75rem;
        font-weight: 500;
    }

    .form-actions {
        padding: 1.5rem;
        border-top: 1px solid var(--border);
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
    }

    /* Boutons */
    .btn-primary {
        background: var(--gradient-primary);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(6, 182, 212, 0.3);
    }

    .btn-secondary {
        background: var(--gray-100);
        color: var(--gray-700);
        border: 1px solid var(--border);
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: var(--gray-200);
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--danger), #dc2626);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-danger:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(239, 68, 68, 0.3);
    }

    .btn-icon {
        width: 16px;
        height: 16px;
    }

    /* Messages flash */
    .flash-message {
        position: fixed;
        top: 1rem;
        right: 1rem;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 1100;
        animation: slideIn 0.3s ease;
    }

    .flash-message.success {
        background: var(--success);
        color: white;
    }

    .flash-message.error {
        background: var(--danger);
        color: white;
    }

    .flash-icon {
        width: 16px;
        height: 16px;
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .equipement-dashboard {
            padding: 1rem;
        }
        
        .header-content {
            flex-direction: column;
            text-align: center;
        }
        
        .stats-grid-simple {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .table-header {
            flex-direction: column;
            align-items: stretch;
        }
        
        .table-actions {
            justify-content: space-between;
            width: 100%;
        }
        
        .search-box {
            min-width: 100%;
        }

        .filter-group {
            width: 100%;
            justify-content: space-between;
        }

        .filter-select {
            flex: 1;
        }
    }

    @media (max-width: 480px) {
        .equipement-dashboard {
            padding: 0.75rem;
        }
        
        .stats-grid-simple {
            grid-template-columns: 1fr;
        }
        
        .stat-card {
            padding: 1rem;
        }

        .modal-container {
            margin: 0.5rem;
        }

        .form-grid {
            padding: 1rem;
        }

        .modal-actions {
            flex-direction: column;
        }

        .btn-primary,
        .btn-secondary,
        .btn-danger {
            width: 100%;
            justify-content: center;
        }
    }
</style>