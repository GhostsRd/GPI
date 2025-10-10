<div>

          
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
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
                     <div class="col-md-1">
                        <label class="form-label small fw-bold">Archiver</label>
                        <select wire:change="archiveActive" class="form-select form-select-sm">
                            <option value="false">Non active</option>
                            <option value="true">Active</option>
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
 <div class="shadow-sm bg-white col-lg-12 rounded  mt-3 ">
    <div class="d-flex flex-nowrap overflow-auto p-1">
        @foreach($steps as $step)
 
            <div class="kanban-column flex-shrink-0 mx-1"
                 ondragover="event.preventDefault()"
                 ondrop="handleDrop(event, {{ $step['id'] }})">

                <!-- En-tête -->
                <div class="kanban-header  border-0 px-2 text-left py-2 rounded-1  fw-semibold"
                     {{-- style="background-color: #84b0b4c4;"  --}}
                     >
                     <div class="progress mb-1 " style="height: 2px;">
                        <div class="progress-bar {{$step['id'] == 2 ? 'bg-warning' : ($step['id'] == 3 ? 'bg-success' :  ($step['id'] == 4 ? 'bg-danger' :  ($step['id'] == 5 ? 'bg-primary' :  'bg-info'  )  )  )}}" role="progressbar" aria-valuenow="100" style="width: 100%;" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                     <span class="text-muted mt-2">Status</span><br>
                     <span class="fw-bold ">{{ $step['name'] }} </span>
                    <span class="">({{count($tickets->where('state', $step['id']))}})</span> 
                        

                </div>

                <!-- Corps -->
                <div  class="kanban-body  border-top-0 rounded-bottom   p-2" 
                    data-step="{{ $step['id'] }}"
                     style="min-height: 300px;">
                        <div class="card shadow-sm text-align-center">
                                +
                        </div>

                    @foreach($tickets->where('state', $step['id']) as $ticket)
                        <div data-aos="fade-down" data-aos-duration="1000" wire:click="Visualiser({{ $ticket->id }})"
                             class="kanban-item    mb-2 draggable-card shadow-sm {{ $ticket->priorite == 0 ? 'border-start border-5 border-danger  ' : ($ticket->priorite == 1 ? 'border-start border-5 border-warning  ' : ' border-start border-success border-5 shadow-sm') }}"
                             draggable="true"
                             ondragstart="handleDragStart(event, {{ $ticket->id }})"
                             ondragend="handleDragEnd(event)"
                             wire:key="ticket-{{ $ticket->id }}"
                             data-ticket="{{ $ticket->id }}">
                            

                  
                            
                            <div  class="card-body  px-2 small d-flex flex-column justify-content-between" style="min-height: 60px;">
                                    <div class="d-flex text-muted justify-content-between pt-0 mt-0">
                                      #{{ $ticket->id }}
                                    </div>
                                <div class="fw-bold text-muted">{{ $ticket->sujet }}</div>
                                    
                                <div class="d-flex justify-content-end mt-1">
                                        {{-- <span title="commentaire" class="rounded-pill border px-2  border-secondary">{{count($ticket->commentaires)}}</span> --}}
                                    <img class="dropdown-toggle rounded-pill"
                                        data-toggle="dropdown"
                                        src="https://ui-avatars.com/api/?name={{ $ticket->utilisateur->nom }}"
                                        alt="Profil" 
                                        width="25" 
                                        height="25"
                                        title="Utilisateur : {{ $ticket->utilisateur->nom }}">
                                        <img class="dropdown-toggle rounded-pill {{ 
                                        $ticket->priorite == 0 
                                        ? 'border-danger border-2 border' 
                                        : ($ticket->priorite == 1 
                                            ? 'border-warning border-2 border' 
                                            : 'border-success border-2 border') }} "
                                        data-toggle="dropdown"
                                        src="https://ui-avatars.com/api/?name={{ $ticket->responsable->name }}"
                                        alt="Profil" 
                                        width="25" 
                                        height="25"
                                        title="Responsable : {{ $ticket->responsable->name }}">
                                </div>
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

.priority_0{
    background: hsla(0, 93%, 73%, 0.69);
}
.priority_1{
    background: rgba(240, 176, 81, 0.69);
}
.priority_3{
    background: rgba(254, 254, 147, 0.69);
}
.priority_2{
    /*background: rgba(147, 249, 254, 0.69);*/
    
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
