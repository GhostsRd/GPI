
    <div class="compact-mode">
        <!-- En-tête avec statistiques -->
        <div class="row g-3 mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="fw-bold">Inventaire des Équipements</h1>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
                            <i class="fas fa-upload me-1"></i> Importer
                        </button>
                        <a href="{{ route('equipement.export') }}" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-download me-1"></i> Exporter
                        </a>
                        <a href="{{ route('equipement.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Nouvel Équipement
                        </a>
                    </div>
                </div>
            </div>

            <!-- Cartes de statistiques -->
            <div class="col-xl-3 col-md-6">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-primary">{{ $stats['total'] }}</h3>
                                <p class="stats-label text-muted mb-0">Total Équipements</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center">
                                    <i class="fas fa-boxes fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-success">{{ $stats['en_stock'] }}</h3>
                                <p class="stats-label text-muted mb-0">En Stock</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center">
                                    <i class="fas fa-warehouse fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-warning">{{ $stats['en_pret'] }}</h3>
                                <p class="stats-label text-muted mb-0">En Prêt</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center">
                                    <i class="fas fa-hand-holding fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card stats-widget border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h3 class="stats-number text-danger">{{ $stats['en_maintenance'] }}</h3>
                                <p class="stats-label text-muted mb-0">En Maintenance</p>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-danger bg-opacity-10 text-danger d-flex align-items-center justify-content-center">
                                    <i class="fas fa-tools fa-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barre de recherche et filtres -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('equipement.index') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Recherche</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-transparent">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" name="search" value="{{ request('search') }}"
                                       class="form-control" placeholder="ID, Nom, Série, IP...">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold">Statut</label>
                            <select name="statut" class="form-select form-select-sm">
                                <option value="">Tous les statuts</option>
                                <option value="en_stock" {{ request('statut') == 'en_stock' ? 'selected' : '' }}>En Stock</option>
                                <option value="en_pret" {{ request('statut') == 'en_pret' ? 'selected' : '' }}>En Prêt</option>
                                <option value="en_maintenance" {{ request('statut') == 'en_maintenance' ? 'selected' : '' }}>En Maintenance</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold">Type</label>
                            <select name="type" class="form-select form-select-sm">
                                <option value="">Tous les types</option>
                                @foreach($types as $type)
                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold">Emplacement</label>
                            <select name="emplacement" class="form-select form-select-sm">
                                <option value="">Tous les emplacements</option>
                                @foreach($emplacements as $emplacement)
                                    <option value="{{ $emplacement }}" {{ request('emplacement') == $emplacement ? 'selected' : '' }}>{{ $emplacement }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold">Marque</label>
                            <select name="marque" class="form-select form-select-sm">
                                <option value="">Toutes les marques</option>
                                @foreach($marques as $marque)
                                    <option value="{{ $marque }}" {{ request('marque') == $marque ? 'selected' : '' }}>{{ $marque }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Messages de succès/erreur -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Tableau des équipements -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Nom Public</th>
                            <th>Emplacement</th>
                            <th>Marque/Modèle</th>
                            <th>Type</th>
                            <th>Série</th>
                            <th>Couleur</th>
                            <th>Technologie</th>
                            <th>IP</th>
                            <th>Date Entrée</th>
                            <th>Statut</th>
                            <th class="text-end pe-3">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($equipements as $equipement)
                            <tr>
                                <td class="ps-3 fw-medium">
                                    <span class="badge bg-dark">{{ $equipement->identification }}</span>
                                </td>
                                <td class="fw-medium">{{ $equipement->nom_public }}</td>
                                <td>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                            {{ $equipement->emplacement }}
                                        </span>
                                </td>
                                <td>
                                    <div class="small">{{ $equipement->marque }}</div>
                                    <div class="text-muted smaller">{{ $equipement->model }}</div>
                                </td>
                                <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary">
                                            {{ $equipement->type }}
                                        </span>
                                </td>
                                <td class="text-muted smaller">{{ $equipement->numero_serie }}</td>
                                <td>
                                        <span class="badge bg-{{ $equipement->couleur == 'noir' ? 'dark' : 'info' }}">
                                            {{ ucfirst($equipement->couleur) }}
                                        </span>
                                </td>
                                <td>
                                        <span class="badge bg-warning bg-opacity-10 text-warning">
                                            {{ ucfirst($equipement->technologie_impression) }}
                                        </span>
                                </td>
                                <td class="text-muted smaller">
                                    @if($equipement->adresse_ip)
                                        <code>{{ $equipement->adresse_ip }}</code>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-muted smaller">
                                    {{ $equipement->date_entree_stock->format('d/m/Y') }}
                                </td>
                                <td>
                                    @php
                                        $statutColors = [
                                            'en_stock' => 'success',
                                            'en_pret' => 'warning',
                                            'en_maintenance' => 'danger'
                                        ];
                                        $statutLabels = [
                                            'en_stock' => 'Stock',
                                            'en_pret' => 'Prêt',
                                            'en_maintenance' => 'Maintenance'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $statutColors[$equipement->statut] }}">
                                            {{ $statutLabels[$equipement->statut] }}
                                        </span>
                                </td>
                                <td class="text-end pe-3">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('equipement.edit', $equipement) }}"
                                           class="btn btn-outline-primary btn-sm"
                                           title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('equipement.destroy', $equipement) }}"
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?')"
                                                    title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center py-4 text-muted">
                                    <i class="fas fa-box-open fa-2x mb-2 d-block"></i>
                                    Aucun équipement trouvé
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $equipements->links() }}
        </div>
    </div>

    <!-- Modal Importation -->
    <div class="modal fade" id="importModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Importer des Équipements</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('equipement.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Fichier (CSV, Excel)</label>
                            <input type="file" name="fichier" class="form-control" accept=".csv,.xlsx,.xls" required>
                            <div class="form-text">
                                Formats acceptés: CSV, XLSX, XLS. Taille max: 10MB
                            </div>
                        </div>
                        <div class="alert alert-info">
                            <small>
                                <i class="fas fa-info-circle me-1"></i>
                                Le fichier doit contenir les colonnes: identification, nom_public, emplacement, marque, model, type, numero_serie, couleur, technologie_impression, reference_cartouche, date_entree_stock, adresse_ip, statut, description
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Importer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
