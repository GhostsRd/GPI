<div class="container-fluid py-4" style="background: var(--gray-50); min-height: 100vh;">
    <!-- Modern Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 font-bold text-gray-800 mb-1">
                <i class="bi bi-sim text-primary me-2"></i>Tableau de Bord - Flotte SIM
            </h1>
            <p class="text-muted small mb-0">Vue d'ensemble et statistiques de gestion des cartes SIM.</p>
        </div>
        <div class="d-flex gap-2">
            <button wire:click="$refresh" class="btn btn-sm btn-light border shadow-sm">
                <i class="bi bi-arrow-clockwise me-1"></i>Actualiser
            </button>
            <a href="{{ route('admin.sim.list') }}" class="btn btn-sm btn-primary shadow-sm" style="background: var(--primary); border: none;">
                <i class="bi bi-list-ul me-1"></i>Voir la Flotte
            </a>
        </div>
    </div>

    <!-- Styles Localisés pour le Dashboard SIM -->
    <style>
        .sim-stat-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            box-shadow: var(--shadow);
        }
        .sim-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }
        .sim-icon-box {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 1.25rem;
        }
        .bg-teal-light { background: rgba(91, 196, 191, 0.1); color: var(--primary); }
        .bg-blue-light { background: #eff6ff; color: #3b82f6; }
        .bg-green-light { background: #ecfdf5; color: #10b981; }
        .bg-orange-light { background: #fff7ed; color: #f97316; }
        .bg-red-light { background: #fef2f2; color: #ef4444; }
        
        [data-bs-theme="dark"] .sim-stat-card {
            background: var(--gray-100);
            border-color: var(--gray-200);
        }
        
        .operator-pill {
            padding: 0.5rem 1rem;
            border-radius: 10px;
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
    </style>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="sim-stat-card">
                <div class="sim-icon-box bg-blue-light">
                    <i class="bi bi-sim"></i>
                </div>
                <div>
                    <p class="text-muted small text-uppercase fw-bold mb-0">Total SIM</p>
                    <h3 class="h2 fw-bold mb-0">{{ $stats['total'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="sim-stat-card">
                <div class="sim-icon-box bg-green-light">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <p class="text-muted small text-uppercase fw-bold mb-0">Disponibles</p>
                    <h3 class="h2 fw-bold mb-0">{{ $stats['available'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="sim-stat-card">
                <div class="sim-icon-box bg-orange-light">
                    <i class="bi bi-person-check"></i>
                </div>
                <div>
                    <p class="text-muted small text-uppercase fw-bold mb-0">Attribuées</p>
                    <h3 class="h2 fw-bold mb-0">{{ $stats['assigned'] }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="sim-stat-card">
                <div class="sim-icon-box bg-red-light">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <div>
                    <p class="text-muted small text-uppercase fw-bold mb-0">Perdues</p>
                    <h3 class="h2 fw-bold mb-0">{{ $stats['lost'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Operators breakdown -->
        <div class="col-lg-4">
            <div class="sim-stat-card flex-column align-items-stretch">
                <h3 class="h6 fw-bold mb-4">Répartition par Opérateur</h3>
                <div class="d-flex flex-column gap-3">
                    @foreach($operatorStats as $op)
                        <div class="operator-pill">
                            <div class="d-flex align-items-center">
                                <span class="rounded-circle me-2" style="width: 10px; height: 10px; background: {{ strtolower($op->operator) == 'orange' ? '#f97316' : (strtolower($op->operator) == 'telma' ? '#facc15' : '#ef4444') }}"></span>
                                <span class="fw-medium">{{ $op->operator }}</span>
                            </div>
                            <span class="badge bg-light text-dark border">{{ $op->count }}</span>
                        </div>
                    @endforeach
                </div>
                @if(count($operatorStats) == 0)
                    <p class="text-center text-muted small py-4 italic">Aucune donnée</p>
                @endif
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="col-lg-8">
            <div class="sim-stat-card flex-column align-items-stretch">
                <h3 class="h6 fw-bold mb-4">Activités Récentes</h3>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr class="text-muted small text-uppercase">
                                <th class="border-0">Date</th>
                                <th class="border-0">Action</th>
                                <th class="border-0">Numéro</th>
                                <th class="border-0">Auteur</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentHistories as $history)
                                <tr>
                                    <td class="small">{{ $history->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <span class="badge {{ $history->action == 'attribution' ? 'bg-success' : ($history->action == 'recovery' ? 'bg-primary' : 'bg-danger') }}" 
                                              style="{{ $history->action == 'attribution' ? '' : ($history->action == 'recovery' ? 'background: var(--primary) !important;' : '') }}">
                                            {{ ucfirst($history->action == 'attribution' ? 'Attribution' : ($history->action == 'recovery' ? 'Récupération' : 'Perte')) }}
                                        </span>
                                    </td>
                                    <td class="fw-medium">{{ $history->simCard->phone_number }}</td>
                                    <td class="small">{{ $history->user->name ?? $history->user->nom ?? 'Admin' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted small italic">Aucune activité récente</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
