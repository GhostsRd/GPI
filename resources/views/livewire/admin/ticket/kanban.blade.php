<div>
<div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label small fw-bold">Recherche</label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text bg-transparent">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" wire:model.live="search"
                                   class="form-control" placeholder="Référence, Sujet, Créé par...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Statut</label>
                        <select wire:model.live="statut" class="form-select form-select-sm">
                            <option value="">Tous les statuts</option>
                            <option value="ouvert">Ouvert</option>
                            <option value="en_cours">En Cours</option>
                            <option value="en_attente">En Attente</option>
                            <option value="résolu">Résolu</option>
                            <option value="fermé">Fermé</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-bold">Priorité</label>
                        <select wire:model.live="priorite" class="form-select form-select-sm">
                            <option value="">Toutes les priorités</option>
                            <option value="basse">Basse</option>
                            <option value="moyenne">Moyenne</option>
                            <option value="haute">Haute</option>
                            <option value="urgente">Urgente</option>
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
    <div class="container-fluid mt-4">
        <div class="row g-3">
            @foreach($steps as $step)
                <div class="col-md-2">
                    <div class=" step-column border  step-{{ $step['id'] }}"
                         ondragover="event.preventDefault()"
                         ondrop="handleDrop(event, {{ $step['id'] }})">
                        <div class="card-header text-center">
                            
                            <label class="fw-bold  mb-1 mt-0 pt-0">{{ $step['name'] }}</label>
                            <hr>
                        </div>

                        <div class="card-body tickets" data-step="{{ $step['id'] }}" style="min-height:200px;">
                            @foreach($tickets->where('state', $step['id']) as $ticket)
                                <div wire:click="Visualiser({{$ticket->id}})" class="card border-0 mb-2 draggable-card  {{$ticket->priorite == 1 ? 'bg-warning' : 'bg-secondary'}}"
                                     draggable="true"
                                     ondragstart="handleDragStart(event, {{ $ticket->id }})"
                                     wire:key="ticket-{{ $ticket->id }}"
                                     data-ticket="{{ $ticket->id }}">
                                    <div class="card-body p-2">
                                        {{ $ticket->sujet }}

                                    <p>• {{$ticket->utilisateur_id}}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- petit style --}}
    <style>
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
