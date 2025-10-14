<div class="peripherique-dashboard">
    <div class="container mx-auto">
        <!-- En-tête -->
        <div class="table-header">
            <div class="table-title">
                <i class="fas fa-desktop"></i>
                Gestion des Périphériques
            </div>
            <div class="table-actions">
                <button wire:click="showForm" class="btn-modern">
                    <i class="fas fa-plus"></i>
                    Ajouter un Périphérique
                </button>
            </div>
        </div>

        <!-- Messages de succès -->
        @if (session()->has('success'))
            <div class="alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulaire -->
        @if($showForm)
            <div class="form-container fade-in-up">
                <h2 class="table-title mb-4">
                    {{ $editingId ? 'Modifier le Périphérique' : 'Nouveau Périphérique' }}
                </h2>

                <form wire:submit.prevent="save">
                    <div class="form-grid">
                        <!-- Nom -->
                        <div class="form-group">
                            <label class="form-label" for="nom">
                                Nom *
                            </label>
                            <input wire:model="nom" id="nom" type="text"
                                   class="form-input"
                                   placeholder="Entrez le nom du périphérique">
                            @error('nom') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Type -->
                        <div class="form-group">
                            <label class="form-label" for="type">
                                Type *
                            </label>
                            <select wire:model="type" id="type" class="form-select">
                                <option value="">Sélectionnez un type</option>
                                @foreach($types as $typeOption)
                                    <option value="{{ $typeOption }}">{{ $typeOption }}</option>
                                @endforeach
                            </select>
                            @error('type') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Statut -->
                        <div class="form-group">
                            <label class="form-label" for="statut">
                                Statut *
                            </label>
                            <select wire:model="statut" id="statut" class="form-select">
                                <option value="">Sélectionnez un statut</option>
                                @foreach($statuts as $statutOption)
                                    <option value="{{ $statutOption }}">{{ $statutOption }}</option>
                                @endforeach
                            </select>
                            @error('statut') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Fabricant -->
                        <div class="form-group">
                            <label class="form-label" for="fabricant">
                                Fabricant
                            </label>
                            <input wire:model="fabricant" id="fabricant" type="text"
                                   class="form-input"
                                   placeholder="Entrez le fabricant">
                        </div>

                        <!-- Modèle -->
                        <div class="form-group">
                            <label class="form-label" for="modele">
                                Modèle
                            </label>
                            <input wire:model="modele" id="modele" type="text"
                                   class="form-input"
                                   placeholder="Entrez le modèle">
                        </div>

                        <!-- Entité -->
                        <div class="form-group">
                            <label class="form-label" for="entite">
                                Entité
                            </label>
                            <input wire:model="entite" id="entite" type="text"
                                   class="form-input"
                                   placeholder="Entrez l'entité">
                        </div>

                        <!-- Lieu -->
                        <div class="form-group">
                            <label class="form-label" for="lieu">
                                Lieu
                            </label>
                            <input wire:model="lieu" id="lieu" type="text"
                                   class="form-input"
                                   placeholder="Entrez le lieu">
                        </div>

                        <!-- Usager -->
                        <div class="form-group">
                            <label class="form-label" for="usager">
                                Usager
                            </label>
                            <input wire:model="usager" id="usager" type="text"
                                   class="form-input"
                                   placeholder="Entrez l'usager">
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 gap-2">
                        <button type="button" wire:click="$set('showForm', false)"
                                class="btn-modern secondary">
                            <i class="fas fa-times"></i>
                            Annuler
                        </button>
                        <button type="submit"
                                class="btn-modern">
                            <i class="fas fa-save"></i>
                            {{ $editingId ? 'Modifier' : 'Créer' }}
                        </button>
                    </div>
                </form>
            </div>
        @endif

        <!-- Filtres -->
        <div class="filter-container">
            <div class="filter-grid">
                <!-- Recherche -->
                <div class="form-group">
                    <label class="form-label">Recherche</label>
                    <div class="search-box">
                        <input wire:model.live="search" type="text"
                               placeholder="Nom, modèle, fabricant..."
                               class="form-input" >

                    </div>
                </div>

                <!-- Filtre par statut -->
                <div class="form-group">
                    <label class="form-label">Statut</label>
                    <select wire:model.live="filterStatut" class="form-select">
                        <option value="">Tous les statuts</option>
                        @foreach($statuts as $statut)
                            <option value="{{ $statut }}">{{ $statut }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtre par type -->
                <div class="form-group">
                    <label class="form-label">Type</label>
                    <select wire:model.live="filterType" class="form-select">
                        <option value="">Tous les types</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Tableau -->
        <div class="table-container">
            <div class="table-wrapper">
                <table class="modern-table">
                    <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nom
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Fabricant/Modèle
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($peripheriques as $peripherique)
                        <tr>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex items-center">
                                    <div class="ml-3">
                                        <p class="text-gray-900 whitespace-no-wrap font-semibold">
                                            {{ $peripherique->nom }}
                                        </p>
                                        @if($peripherique->entite)
                                            <p class="text-gray-600 text-xs">{{ $peripherique->entite }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">{{ $peripherique->type }}</p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                @if($peripherique->statut === 'En service')
                                    <span class="status-badge status-service">{{ $peripherique->statut }}</span>
                                @elseif($peripherique->statut === 'En stock')
                                    <span class="status-badge status-stock">{{ $peripherique->statut }}</span>
                                @else
                                    <span class="status-badge status-hors-service">{{ $peripherique->statut }}</span>
                                @endif
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ $peripherique->fabricant }}
                                    @if($peripherique->modele)
                                        / {{ $peripherique->modele }}
                                    @endif
                                </p>
                                @if($peripherique->usager)
                                    <p class="text-gray-600 text-xs">Usager: {{ $peripherique->usager }}</p>
                                @endif
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="action-buttons">
                                    <button wire:click="edit({{ $peripherique->id }})"
                                            class="btn-action btn-edit"
                                            title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $peripherique->id }})"
                                            class="btn-action btn-delete"
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="fas fa-desktop"></i>
                                </div>
                                <p>Aucun périphérique trouvé.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            {{ $peripheriques->links() }}
        </div>
    </div>

    <!-- Modal de confirmation de suppression -->
    @if($confirmingDelete)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 max-w-md mx-4">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">Confirmer la suppression</h3>
                        <p class="text-gray-600">Êtes-vous sûr de vouloir supprimer ce périphérique ?</p>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button wire:click="$set('confirmingDelete', false)"
                            class="btn-modern secondary">
                        Annuler
                    </button>
                    <button wire:click="delete({{ $confirmingDelete }})"
                            class="btn-modern bg-red-500 hover:bg-red-600">
                        <i class="fas fa-trash"></i>
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    /* Import de la police */
    @import url(https://fonts.googleapis.com/css?family=Nunito);
    @import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css);

    /* Variables CSS modernes */
    :root {
        --primary: #3b82f6;
        --primary-light: #60a5fa;
        --primary-dark: #2563eb;
        --primary-50: #eff6ff;
        --primary-100: #dbeafe;
        --secondary: #8b5cf6;
        --success: #10b981;
        --warning: #f59e0b;
        --error: #ef4444;
        --info: #06b6d4;
        --dark: #1e293b;
        --light: #f8fafc;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --border: #e2e8f0;
        --sidebar-bg: #1e293b;
        --sidebar-text: #f1f5f9;
        --sidebar-hover: #334155;
        --nav-bg: #1e293b;
        --nav-text: #f1f5f9;
        --main-bg: #ffffff;
        --card-bg: #ffffff;
        --shadow: rgba(0, 0, 0, 0.1);
        --shadow-lg: rgba(0, 0, 0, 0.2);
        --gradient-primary: linear-gradient(135deg, var(--primary), var(--secondary));
    }

    /* Application de la taille de police réduite */
    .peripherique-dashboard {
        background: var(--main-bg);
        min-height: 100vh;
        padding: 1.5rem;
        position: relative;
        font-size: 0.875rem;
        font-family: 'Nunito', sans-serif;
    }

    .peripherique-dashboard::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 20% 80%, rgba(59, 130, 246, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(139, 92, 246, 0.05) 0%, transparent 50%);
        pointer-events: none;
        z-index: 0;
    }

    /* RÉDUCTION DU TABLEAU */
    .table-container {
        background: var(--card-bg);
        border-radius: 14px;
        box-shadow: 0 2px 10px var(--shadow);
        border: 1px solid var(--border);
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    .table-header {
        padding: 1.25rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
        background: var(--card-bg);
        border-bottom: 1px solid var(--border);
    }

    .table-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table-title::before {
        content: '';
        width: 3px;
        height: 20px;
        background: var(--gradient-primary);
        border-radius: 2px;
    }

    .table-actions {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .btn-modern {
        background: var(--gradient-primary);
        color: white;
        border: none;
        padding: 0.6rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(59, 130, 246, 0.2);
    }

    .btn-modern:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 10px rgba(59, 130, 246, 0.3);
    }

    .btn-modern.secondary {
        background: transparent;
        color: var(--primary);
        border: 1px solid var(--primary-light);
        box-shadow: none;
    }

    .btn-modern.secondary:hover {
        background: var(--primary-50);
        transform: translateY(-1px);
    }

    .btn-modern.bg-red-500 {
        background: #ef4444;
    }

    .btn-modern.bg-red-500:hover {
        background: #dc2626;
    }

    .search-box {
        position: relative;
        min-width: 220px;
    }

    .search-box input {
        width: 100%;
        padding: 0.6rem 2.25rem 0.6rem 0.875rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        background: var(--card-bg);
        color: var(--dark);
    }

    .search-box input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }

    .search-box input::placeholder {
        color: var(--gray-400);
    }

    .search-icon {
        position: absolute;
        right: 0.875rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
        transition: color 0.3s ease;
    }

    .search-box:focus-within .search-icon {
        color: var(--primary);
    }

    .modern-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.8rem;
        background: var(--card-bg);
    }

    .modern-table thead {
        background: var(--gradient-primary);
    }

    .modern-table thead th {
        padding: 0.875rem 0.875rem;
        color: black;
        font-weight: 600;
        text-align: left;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        position: relative;
    }

    .modern-table thead th::after {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 1px;
        height: 16px;
        background: rgba(255, 255, 255, 0.2);
    }

    .modern-table thead th:last-child::after {
        display: none;
    }

    /* Styles pour les lignes du tableau avec animations */
    .modern-table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: all 0.2s ease;
        background: var(--card-bg);
    }

    .modern-table tbody tr:hover {
        background: var(--gray-50);
        transform: translateX(2px);
    }

    .modern-table tbody td {
        padding: 0.875rem 0.875rem;
        color: var(--dark);
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .modern-table tbody tr:hover td {
        color: var(--primary-dark);
    }

    /* Badges de statut améliorés */
    .status-badge {
        padding: 0.3rem 0.6rem;
        border-radius: 10px;
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
        text-align: center;
        min-width: 70px;
        transition: all 0.2s ease;
    }

    .status-service {
        background: rgba(232, 245, 233, 0.7);
        color: #2e7d32;
        border: 1px solid rgba(46, 125, 50, 0.2);
    }

    .status-stock {
        background: rgba(227, 242, 253, 0.7);
        color: #1565c0;
        border: 1px solid rgba(21, 101, 192, 0.2);
    }

    .status-hors-service {
        background: rgba(252, 228, 236, 0.7);
        color: #ad1457;
        border: 1px solid rgba(173, 20, 87, 0.2);
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
        font-size: 0.7rem;
    }

    .btn-action:hover {
        transform: scale(1.05);
    }

    .btn-edit {
        background: rgba(59, 130, 246, 0.1);
        color: var(--primary);
    }

    .btn-edit:hover {
        background: rgba(59, 130, 246, 0.2);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .btn-delete:hover {
        background: rgba(239, 68, 68, 0.2);
    }

    /* Formulaire moderne */
    .form-container {
        background: var(--card-bg);
        border-radius: 14px;
        box-shadow: 0 2px 10px var(--shadow);
        border: 1px solid var(--border);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        animation: fadeIn 0.4s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .form-group {
        margin-bottom: 0.5rem;
    }

    .form-label {
        display: block;
        color: var(--dark);
        font-weight: 600;
        font-size: 0.8rem;
        margin-bottom: 0.4rem;
    }

    .form-input {
        width: 100%;
        padding: 0.6rem 0.875rem;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        background: var(--card-bg);
        color: var(--dark);
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .form-select {
        width: 100%;
        padding: 0.6rem 0.875rem;
        border: 1.5px solid var(--border);
        border-radius: 8px;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        background: var(--card-bg);
        color: var(--dark);
        cursor: pointer;
    }

    .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Messages flash */
    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #065f46;
        padding: 0.875rem 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        animation: slideIn 0.3s ease-out;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Filtres */
    .filter-container {
        background: var(--card-bg);
        border-radius: 14px;
        box-shadow: 0 2px 10px var(--shadow);
        border: 1px solid var(--border);
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 1.5rem;
        gap: 0.5rem;
    }

    .pagination-btn {
        padding: 0.5rem 0.875rem;
        border: 1px solid var(--border);
        border-radius: 6px;
        background: var(--card-bg);
        color: var(--dark);
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .pagination-btn:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    .pagination-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    /* Enhanced Mobile Responsive Design */
    @media (max-width: 1024px) {
        .peripherique-dashboard {
            padding: 1.25rem;
        }
    }

    @media (max-width: 768px) {
        .peripherique-dashboard {
            padding: 1rem;
        }

        .table-header {
            flex-direction: column;
            align-items: stretch;
            padding: 1rem;
            gap: 0.875rem;
        }

        .table-actions {
            justify-content: space-between;
            width: 100%;
        }

        .search-box {
            min-width: 100%;
            order: -1;
        }

        .modern-table {
            font-size: 0.75rem;
        }

        .modern-table thead th,
        .modern-table tbody td {
            padding: 0.75rem 0.5rem;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .filter-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .peripherique-dashboard {
            padding: 0.75rem;
        }

        .table-header {
            padding: 0.75rem;
        }

        .btn-modern {
            padding: 0.5rem 0.875rem;
            font-size: 0.75rem;
        }

        .modern-table {
            font-size: 0.7rem;
        }
    }

    /* Soft Animations */
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

    .fade-in-up {
        animation: fadeInUp 0.4s ease-out;
    }

    .table-wrapper {
        overflow-x: auto;
        max-height: 500px;
        position: relative;
    }

    .table-wrapper::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }

    .table-wrapper::-webkit-scrollbar-track {
        background: var(--gray-100);
        border-radius: 8px;
    }

    .table-wrapper::-webkit-scrollbar-thumb {
        background: var(--primary);
        border-radius: 8px;
        opacity: 0.5;
    }

    .table-wrapper::-webkit-scrollbar-thumb:hover {
        background: var(--primary-dark);
        opacity: 0.7;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 2.5rem 1.5rem;
        color: var(--gray-500);
    }

    .empty-state-icon {
        font-size: 2rem;
        margin-bottom: 0.875rem;
        opacity: 0.4;
    }

    /* Focus States for Accessibility */
    .btn-modern:focus,
    .search-box input:focus,
    .btn-action:focus,
    .form-input:focus,
    .form-select:focus {
        outline: 2px solid var(--primary);
        outline-offset: 1px;
    }

    /* Modal styles */
    .fixed.inset-0 {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    .bg-black.bg-opacity-50 {
        background: rgba(0, 0, 0, 0.5);
    }

    .flex.items-center.justify-center {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .z-50 {
        z-index: 50;
    }

    .bg-white.rounded-lg {
        background: white;
        border-radius: 0.5rem;
    }

    .p-6 {
        padding: 1.5rem;
    }

    .max-w-md {
        max-width: 28rem;
    }

    .mx-4 {
        margin-left: 1rem;
        margin-right: 1rem;
    }

    .text-red-500 {
        color: #ef4444;
    }

    .text-red-600 {
        color: #dc2626;
    }

    .bg-red-100 {
        background: #fee2e2;
    }

    .text-lg {
        font-size: 1.125rem;
    }

    .font-semibold {
        font-weight: 600;
    }

    .text-gray-900 {
        color: #111827;
    }

    .text-gray-600 {
        color: #4b5563;
    }

    .mb-4 {
        margin-bottom: 1rem;
    }

    .mr-4 {
        margin-right: 1rem;
    }

    .w-12 {
        width: 3rem;
    }

    .h-12 {
        height: 3rem;
    }

    .rounded-full {
        border-radius: 9999px;
    }

    .text-xl {
        font-size: 1.25rem;
    }

    .flex.justify-end {
        justify-content: flex-end;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    .mt-1 {
        margin-top: 0.25rem;
    }

    .text-red-500.text-xs {
        color: #ef4444;
        font-size: 0.75rem;
    }

    .mt-2 {
        margin-top: 0.5rem;
    }

    .ml-1 {
        margin-left: 0.25rem;
    }

    .ml-3 {
        margin-left: 0.75rem;
    }

    .text-gray-400 {
        color: #9ca3af;
    }

    .mt-6 {
        margin-top: 1.5rem;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    .mb-4 {
        margin-bottom: 1rem;
    }

    /* Utility classes */
    .flex {
        display: flex;
    }

    .items-center {
        align-items: center;
    }

    .justify-end {
        justify-content: flex-end;
    }

    .whitespace-no-wrap {
        white-space: nowrap;
    }

    .font-semibold {
        font-weight: 600;
    }

    .text-xs {
        font-size: 0.75rem;
    }

    .text-gray-600 {
        color: #4b5563;
    }

    .text-gray-900 {
        color: #111827;
    }

    .container {
        width: 100%;
        margin-left: auto;
        margin-right: auto;
    }

    .mx-auto {
        margin-left: auto;
        margin-right: auto;
    }
</style>
