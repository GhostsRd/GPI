<div class="ticket-dashboard">
    <div class="dashboard-container">
        <!-- Stats Header -->
        <div class="stats-header fade-in-up">
            <div class="stat-card">
                <div class="stat-icon primary">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <div class="stat-number">{{ $totalTickets }}</div>
                <div class="stat-label">Total Tickets</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon success">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number">{{ $inProgressTickets }}</div>
                <div class="stat-label">En Cours</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-number">{{ $pendingTickets }}</div>
                <div class="stat-label">En Attente</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon info">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number">{{ $resolvedTickets }}</div>
                <div class="stat-label">Résolus</div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container fade-in-up">
            <div class="table-header">
                <div class="table-title">
                    <i class="fas fa-list"></i>
                    Liste des Tickets
                </div>
                <div class="table-actions">
                    <div class="search-box">
                        <input type="text" wire:model.debounce.500ms="search" placeholder="Rechercher...">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                    <button wire:click="$dispatch('openCreateModal')" class="btn-modern">
                        <i class="fas fa-plus"></i>
                        Nouveau Ticket
                    </button>
                    <button wire:click="deleteSelected" class="btn-modern secondary"
                        {{ empty($selectedTickets) ? 'disabled' : '' }}>
                        <i class="fas fa-trash"></i>
                        Supprimer ({{ count($selectedTickets) }})
                    </button>

                </div>

            <div class="table-wrapper w-100">
                <table class="modern-table ">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                        </th>
                        <th>Référence</th>
                        <th>Sujet</th>
                        <th>Priorité</th>
                        <th>Categorie</th>
                        <th>Statut</th>
                        <th>Créé par</th>
                        <th>Assigné à</th>
                        <th>Équipement</th>
                        <th>Date création</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                    
                        

                            <tr class="priorite_{{$ticket->priorite}}">
                                <td>
                                    <input type="checkbox"
                                        wire:model="selectedTickets"
                                        value="{{ $ticket->id }}"
                                        class="checkbox-modern">
                                </td>
                                <td>{{ $ticket->reference }}</td>
                                <td>{{ $ticket->sujet }}</td>
                                <td class="priority-{{ $ticket->priorite }}">
                                    {{ ucfirst($ticket->priorite) }}
                                </td>
                                <td >
                                    {{ $ticket->categorie }}
                                </td>
                                <td>
                                    <span class="status-badge status-{{ strtolower($ticket->status) }}">
                                        {{ $ticket->status }}
                                    </span>
                                </td>
                                <td>{{ $ticket->created_by }}</td>
                                <td>{{ $ticket->assigned_to }}</td>
                                <td>{{ $ticket->equipment }}</td>
                                <td>{{ $ticket->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button 
                                                class="btn-action btn-view">
                                                <a class="" href="{{ url('/admin/ticket-view-'.$ticket->id) }}">view</a>
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button wire:click="$dispatch('editTicket', {id: {{ $ticket->id }}})"
                                                class="btn-action btn-edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button wire:click="deleteTicket({{ $ticket->id }})"
                                                class="btn-action btn-delete"
                                                onclick="return confirm('Supprimer ce ticket ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                
                   
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
        </div>
            <div class="mt-4 container">
                {{$tickets->links()}}
            </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mynotif active">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle text-success me-2"></i>
                <span>{{ session('message') }}</span>
            </div>
        </div>
    @endif
</div>

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
@endpush
