<div class="container-fluid py-4">
    <style>
        .config-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02), 0 1px 2px rgba(0, 0, 0, 0.03);
        }

        .config-header {
            background: white;
            border-bottom: 1px solid #f0f2f5;
            padding: 20px 24px;
        }

        .config-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            color: #1a1f36;
        }

        .search-input {
            padding: 8px 14px;
            border: 1px solid #e4e6ef;
            border-radius: 12px;
            font-size: 0.85rem;
            background: white;
            transition: all 0.2s;
            min-width: 240px;
        }

        .search-input:focus {
            outline: none;
            border-color: #c7c9d9;
        }

        .table-modern {
            width: 100%;
            margin-bottom: 0;
        }

        .table-modern thead th {
            background: white;
            padding: 16px 20px;
            font-weight: 500;
            font-size: 0.75rem;
            color: #8a8f9e;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            border-bottom: 1px solid #f0f2f5;
        }

        .table-modern tbody td {
            padding: 16px 20px;
            vertical-align: middle;
            border-bottom: 1px solid #f5f6f8;
            color: #2c313d;
            font-size: 0.9rem;
            background: white;
        }

        /* User section */
        .user-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            object-fit: cover;
            background: white;
        }

        .avatar-placeholder {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: #f8f9fc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            color: #6b7280;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
            color: #1a1f36;
            margin-bottom: 4px;
        }

        .user-email {
            font-size: 0.75rem;
            color: #8a8f9e;
        }

        /* Date styling */
        .date-wrapper {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            color: #5a6072;
        }

        .date-wrapper i {
            font-size: 0.9rem;
            opacity: 0.6;
        }

        /* Badge moderne */
        .badge-modern {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 12px;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-active {
            background: #ecfdf5;
            color: #059669;
        }

        .badge-inactive {
            background: #fef2f2;
            color: #dc2626;
        }

        /* Switch PLUS GRAND */
        .switch-modern {
            position: relative;
            display: inline-block;
            width: 56px;
            height: 28px;
        }

        .switch-modern input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider-modern {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #e4e6ef;
            transition: 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 28px;
        }

        .slider-modern:before {
            position: absolute;
            content: "";
            height: 24px;
            width: 24px;
            left: 2px;
            bottom: 2px;
            background-color: white;
            transition: 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 50%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        input:checked + .slider-modern {
            background-color: #10b981;
        }

        input:checked + .slider-modern:before {
            transform: translateX(28px);
        }

        /* Pagination moderne - TOUT BLANC */
        .pagination-wrapper {
            padding: 20px 24px;
            border-top: 1px solid #f0f2f5;
            background: white;
        }

        .pagination {
            display: flex;
            gap: 8px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .pagination li {
            display: inline-block;
        }

        .pagination a, 
        .pagination span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            border-radius: 10px;
            font-size: 0.85rem;
            color: #5a6072;
            text-decoration: none;
            transition: all 0.2s;
            background: white;
            border: 1px solid #e4e6ef;
        }

        .pagination a:hover {
            background: #f8f9fc;
            border-color: #c7c9d9;
            color: #1a1f36;
        }

        .pagination .active span {
            background: #1a1f36;
            border-color: #1a1f36;
            color: white;
        }

        .pagination .disabled span {
            opacity: 0.4;
            cursor: not-allowed;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 48px 20px;
            color: #a1a6b5;
            font-size: 0.85rem;
            background: white;
        }

        /* Alert moderne */
        .alert-modern {
            background: #ecfdf5;
            border: none;
            border-radius: 14px;
            padding: 12px 16px;
            font-size: 0.85rem;
            color: #065f46;
            margin-bottom: 20px;
        }
    </style>

    <div class="row mb-4">
        <div class="col-12">
            <h2 style="font-size: 1.5rem; font-weight: 600; color: #1a1f36; margin-bottom: 6px;">Configuration</h2>
            <p style="color: #8a8f9e; font-size: 0.85rem;">Gérez les accès utilisateurs</p>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert-modern alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" style="font-size: 0.7rem;"></button>
        </div>
    @endif

    <div class="config-card">
        <div class="config-header d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h5 class="config-title">Utilisateurs inscrits</h5>
            <div style="position: relative;">
                <i class="bi bi-search" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); font-size: 0.85rem; color: #c7c9d9;"></i>
                <input wire:model.debounce.300ms="search" type="text" class="search-input" placeholder="Rechercher..." style="padding-left: 36px;">
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Date d'inscription</th>
                        <th>Statut</th>
                        <th style="text-align: right;">Activation</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($utilisateurs as $user)
                        <tr>
                            <td>
                                <div class="user-wrapper">
                                    @if($user->photo)
                                        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->nom }}" class="user-avatar">
                                    @else
                                        <div class="avatar-placeholder">
                                            {{ strtoupper(substr($user->nom, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="user-info">
                                        <div class="user-name">{{ $user->nom }}</div>
                                        <div class="user-email">{{ $user->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="date-wrapper">
                                    <i class="bi bi-calendar3"></i>
                                    <span>{{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}</span>
                                </div>
                             </td>
                            <td>
                                <span class="badge-modern {{ $user->is_active ? 'badge-active' : 'badge-inactive' }}">
                                    <i class="bi {{ $user->is_active ? 'bi-circle-fill' : 'bi-circle' }}" style="font-size: 0.5rem;"></i>
                                    {{ $user->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </td>
                            <td style="text-align: right;">
                                <label class="switch-modern">
                                    <input type="checkbox" 
                                           wire:click="toggleStatus({{ $user->id }})"
                                           {{ $user->is_active ? 'checked' : '' }}>
                                    <span class="slider-modern"></span>
                                </label>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class="bi bi-person-x" style="font-size: 2rem; opacity: 0.5; display: block; margin-bottom: 12px;"></i>
                                    Aucun utilisateur trouvé
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($utilisateurs->hasPages())
            <div class="pagination-wrapper">
                {{ $utilisateurs->links() }}
            </div>
        @endif
    </div>
</div>