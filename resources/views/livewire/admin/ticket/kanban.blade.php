<div>

            <div class="stats-header fade-in-up">
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card stats-widget border-0 shadow-sm dark-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h3 class="stats-number text-primary"></h3>
                                                <p class="stats-label text-light mb-0">Totals tickets</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm rounded-circle bg-primary bg-opacity-25 text-primary d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-boxes fa-lg"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card stats-widget border-0 shadow-sm dark-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h3 class="stats-number text-success"></h3>
                                                <p class="stats-label text-light mb-0">En cours</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm rounded-circle bg-success bg-opacity-25 text-success d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-warehouse fa-lg"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card stats-widget border-0 shadow-sm dark-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h3 class="stats-number text-warning"></h3>
                                                <p class="stats-label text-light mb-0">En Prêt</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm rounded-circle bg-warning bg-opacity-25 text-warning d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-hand-holding fa-lg"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="card stats-widget border-0 shadow-sm dark-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1">
                                                <h3 class="stats-number text-danger"></h3>
                                                <p class="stats-label text-light mb-0">Résolus</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <div class="avatar-sm rounded-circle bg-danger bg-opacity-25 text-danger d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-tools fa-lg"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Recherche</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-transparent">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" wire:model.live="recherche"
                                   class="form-control" placeholder="Référence, Sujet, Créé par...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Statut</label>
                        <select wire:model.live="state" class="form-select form-select-sm">
                            <option value="">Tous les statuts</option>
                            <option value="1">Creation</option>
                            <option value="2">Assigner</option>
                            <option value="3">En traitement</option>
                            <option value="4">Résolution</option>
                            <option value="5">Fermé</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Priorité</label>
                        <select wire:model.live="priorite" class="form-select form-select-sm">
                            <option value="">Toutes les priorités</option>
                            <option value="3">Basse</option>
                            <option value="2">Moyenne</option>
                            <option value="1">Haute</option>
                            <option value="0">Urgente</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Catégorie</label>
                        <select wire:model.live="categorie" class="form-select form-select-sm">
                            <option value="">Toutes les catégories</option>
                            <option value="Réseau">Réseau</option>
                            <option value="Logiciel">Logiciel</option>
                            <option value="Matériel">Matériel</option>
                            <option value="Sécurité">Sécurité</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Vue</label>
                        <select wire:change="changerVue" class="form-select form-select-sm">
                            <option value="kanban">Kanban</option>
                            <option value="tableau">Tableau</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" wire:click="$set(['search' => '', 'statut' => '', 'priorite' => '', 'categorie' => '', 'assigned_to' => ''])"
                                class="btn btn-outline-secondary btn-sm w-100" title="Réinitialiser les filtres">
                            <i class="fa fa-times"></i> filtrer
                        </button>
                    </div>
                </div>
            </div>
        </div>
 <div class="kanban-board shadow-sm bg-white rounded container-fluid mt-3 px-2">
    <div class="d-flex flex-nowrap overflow-auto">
        @foreach($steps as $step)
            <div class="kanban-column flex-shrink-0 mx-1"
                 ondragover="event.preventDefault()"
                 ondrop="handleDrop(event, {{ $step['id'] }})">

                <!-- En-tête -->
                <div class="kanban-header border-0 text-center py-2 rounded-top text-white fw-semibold"
                     style="background-color: #6c757d;">
                    {{ $step['name'] }}
                </div>

                <!-- Corps -->
                <div class="kanban-body  border-top-0 rounded-bottom bg-light p-2"
                     data-step="{{ $step['id'] }}"
                     style="min-height: 300px;">

                    @foreach($tickets->where('state', $step['id']) as $ticket)
                        <div wire:click="Visualiser({{ $ticket->id }})"
                             class="kanban-item card  shadow-sm mb-2 draggable-card  {{ $ticket->priorite == 1 ? 'border border-warning text-dark' : 'border border-success text-dark' }}"
                             draggable="true"
                             ondragstart="handleDragStart(event, {{ $ticket->id }})"
                             ondragend="handleDragEnd(event)"
                             wire:key="ticket-{{ $ticket->id }}"
                             data-ticket="{{ $ticket->id }}">

                            <div class="card-body p-2 small text-truncate">
                                <div class="fw-bold text-muted">{{ $ticket->sujet }}</div>
                                <p class="small mb-0">• Utilisateur : {{ $ticket->utilisateur->nom }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>



    {{-- petit style --}}
    <style>
    /* --- Structure générale --- */
.kanban-board {
  padding: 0;
  
}

.kanban-column {
  width: 227px;
  transition: transform 0.2s ease-in-out;
}

/* --- Header colonne --- */
.kanban-header {
  font-size: 15px;
  letter-spacing: 0.5px;
}

/* --- Corps de colonne --- */
.kanban-body {
  overflow-y: auto;
  min-height: 300px;
  max-height: 75vh;
  padding: 8px;
}

/* --- Cartes --- */
.kanban-item {
  cursor: grab;
  transition: all 0.25s ease-in-out;
  border-radius: 10px;
  transform-origin: center;
  scale: 0.95;
}

.kanban-item:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* --- Effet pendant le drag --- */
.kanban-item.dragging {
  opacity: 0.6;
  transform: rotate(3deg) scale(1.05);
  box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

.kanban-body.drag-over {
  background-color: #e9ecef;
  border: 2px dashed #adb5bd;
  transition: background-color 0.2s ease;
}

        .step-column { background: #ffffffff;  }
        .step-column.drag-over { outline:2px dashed rgba(13,110,253,0.35); background:#eef7ff; }
        .draggable-card { cursor:grab; }
        .draggable-card.dragging { opacity:0.6; transform:scale(0.995); }
    </style>

    {{-- JS minimal requis --}}
    <script>
        // dataTransfer key : on utilise 'text/plain' (compatible)
        function handleDragStart(e, ticketId) {
            e.dataTransfer.setData('text/plain', ticketId);
            e.dataTransfer.effectAllowed = 'move';
            // optional: add class for styling
            e.target.classList.add('dragging');
        }
        // handle drop: lit ticketId et émet Livewire
        function handleDrop(e, stepId) {
            e.preventDefault();
            const ticketId = e.dataTransfer.getData('text/plain');
            if (! ticketId) return;

            // Optimistic UI: déplacer l'élément dans le DOM immédiatement pour fluidité
            const el = document.querySelector('[data-ticket="' + ticketId + '"]');
            // trouver .tickets dans la colonne cible (currentTarget peut être un enfant)
            let container = e.currentTarget.querySelector('.tickets');
            if (!container) {
                // fallback : si currentTarget n'est pas la card .step, remonte
                container = e.target.closest('.step-column')?.querySelector('.tickets');
            }
            if (el && container) {
                el.classList.remove('dragging');
                container.appendChild(el);
            }

            // Appel Livewire: le composant doit écouter "moveTicket"
            Livewire.emit('moveTicket', ticketId, stepId);
        }

        // Remove dragging class on dragend (au cas où)
        document.addEventListener('dragend', (e) => {
            if (e.target && e.target.classList) e.target.classList.remove('dragging');
        });

        // Optionnel: notification listener
        window.addEventListener('notify', function (ev) {
            // ev.detail.message / type
            console.log(ev.detail.message);
        });
    </script>
</div>
