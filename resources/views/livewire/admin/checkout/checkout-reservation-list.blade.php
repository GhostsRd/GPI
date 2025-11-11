<div>
     <div class="row mb-2">
                <div class="col-xl-3 col-md-6">
                    <div class="card stats-widget border-0 shadow-sm dark-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h3 class="stats-number text-primary">{{ $resolvedTickets ?? 'null'  }}</h3>
                                    <p class="stats-label text-black mb-0">Totals tickets</p>
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
                                    <h3 class="stats-number text-success">{{ $resolvedTickets ?? 'null'  }}</h3>
                                    <p class="stats-label text-black mb-0">En cours</p>
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
                                    <h3 class="stats-number text-warning">{{ $resolvedTickets ?? 'null'  }}</h3>
                                    <p class="stats-label text-black mb-0">En Prêt</p>
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
                                    <h3 class="stats-number text-danger">{{ $resolvedTickets ?? 'null' }}</h3>
                                    <p class="stats-label text-black mb-0">Résolus</p>
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
                    <div class="col-md-1">
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
                    <div class="col-md-1">
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
                        <label class="form-label small fw-bold">Vue</label>
                        <select wire:change="changerVue" class="form-select form-select-sm">
                            <option value="tableau">Tableau</option>
                            <option value="kanban">calendrier</option>
                        </select>
                    </div>
                     <div class="col-md-1">
                        <label class="form-label small fw-bold">Archiver</label>
                        <select wire:change="archiveActive" class="form-select form-select-sm">
                            <option value="false">Non active</option>
                            <option value="true">Active</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" wire:click="resetFilters"
                                class="btn btn-outline-secondary btn-sm w-100" title="Réinitialiser les filtres">
                            <i class="fa fa-times"></i> Reset
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="deleteSelected" class="btn btn-danger btn-sm w-100" title="Supprimer les tickets sélectionnés"
                            {{ empty($selectedTickets) ? 'disabled' : '' }}>
                            <i class="fas fa-trash"></i>
                            
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                            </svg>
                             {{-- ({{ count($selectedTickets ?? '5') }}) --}}
                        </button>
                    </div>
                    <div class="col-md-1">
                        <button wire:click="exportTickets" class="btn btn-success btn-sm w-100" title="Exporter les tickets">
                            <i class="bi bi-box-arrow-up-right"></i>
                            Exporter
                        </button>
                    </div>
                </div>
            </div>
        </div>

     <div class="table-container border-0 shadow-sm  fade-in-up">
       
            <div class="table-header">
                <div class="table-title">
                    
                    Reservation d'equipement
                </div>
            </div>

            <div class="table-wrapper  p-0 border-0 w-100 compact-mode">
         
                <table class="table border-0 shadow-sm text-center">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                        </th>

                         <th wire:click="sortBy('sujet')" class="sortable">
                            Utilisateur
                          
                        </th>
                        <th wire:click="sortBy('sujet')" class="sortable">
                            Type de materiel
                          
                        </th>
                        <th wire:click="sortBy('priorite')" class="sortable">
                            Date debut
                           
                        </th>
                        <th wire:click="sortBy('status')" class="sortable">
                            Date fin 
                        </th>
                         <th wire:click="sortBy('sujet')" class="sortable">
                            Nombre 
                          
                        </th>
                        <th wire:click="sortBy('created_at')" class="sortable">
                            Date creation
                          
                        </th>
                        <th wire:click="sortBy('created_at')" class="sortable">
                            Date de modification    
                          
                        </th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($matreservations as $reservation)
                        <tr  style="cursor:pointer" >
                            <td>
                                <input type="checkbox"
                                       wire:model="selectedTickets"
                                       value="{{ $reservation->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td wire:click="Visualiser({{ $reservation->id }})"
                                class="text-left">
                                <img 
                                title="{{ $reservation->responsable->nom ?? 'none' }}"
                                class="dropdown-toggle border border-primary border-2  p-0 m-0 rounded-pill" data-toggle="dropdown"
                                            src="https://ui-avatars.com/api/?name={{ $reservation->responsable->nom ?? 'none' }}"
                                            alt="Profil" width="40" height="40"
                                            class="rounded-circle me-2"> </td>

                            <td >{{ $reservation->equipement_type }}
                                @if ($reservation->statut == 0 )
                                    <span class="text-danger fw-bold"> <br> Demande annuler pour cette materiel <br> cliquer ici pour supprimer <br>
                                        <button class="btn btn-sm  btn-outline-danger" wire:click="supprimerDemande({{ $reservation->id }})"> Supprimer</button>
                                    </span>
                                @endif
                            </td>
                            <td wire:click="Visualiser({{ $reservation->id }})" >{{\Carbon\Carbon::parse($reservation->date_debut)->translatedFormat('d M Y ') }}</td>
                            <td wire:click="Visualiser({{ $reservation->id }})">{{\Carbon\Carbon::parse($reservation->date_fin)->translatedFormat('d M Y ') }}</td>
                            <td wire:click="Visualiser({{ $reservation->id }})">{{ $reservation->equipement_nombre }}</td>

                            <td wire:click="Visualiser({{ $reservation->id }})">{{ $reservation->created_at->format('d M Y H:i') }}</td>
                            <td wire:click="Visualiser({{ $reservation->id }})">{{ $reservation->updated_at->format('d M Y H:i') }}</td>
                            <td >
                                <div class="action-buttons">
                                    <button class="btn-action btn-view">
                                        <a href="{{ url('/admin/ticket-view-'.$reservation->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </button>
                                    <button wire:click="$dispatch('editTicket', {id: {{ $reservation->id }}})"
                                            class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $reservation->id }})"
                                            class="btn-action btn-delete">
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
            <div class="mt-4 container d-flex justify-content-center">
                {{-- {{ $checkouts->links() }} --}}
            </div>
        </div>

</div>
