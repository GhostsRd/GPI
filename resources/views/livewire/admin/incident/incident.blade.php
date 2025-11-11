<div>
     <div class="table-container border-0 shadow-sm  fade-in-up">
            <div class="table-header">
                <div class="table-title">
                    
                    Liste des incident
                </div>
            </div>

            <div class="table-wrapper  p-0 border-0 w-100 compact-mode">
         
                <table class="table border-0 shadow-sm text-center">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                        </th>
                        <th wire:click="sortBy('reference')" class="sortable">
                            Référence
                         
                        </th>
                         <th wire:click="sortBy('sujet')" class="sortable">
                            Utilisateur
                          
                        </th>
                        <th wire:click="sortBy('sujet')" class="sortable">
                            Type de materiel
                          
                        </th>
                        <th wire:click="sortBy('priorite')" class="sortable">
                            Details de materiel
                           
                        </th>
                        <th wire:click="sortBy('status')" class="sortable">
                            Statut 
                        </th>
                         <th class="sortable">
                                Rapport d'incident
                          
                        </th>
                        <th class="sortable">
                                Declaration de perte
                          
                        </th>
                        <th wire:click="sortBy('created_at')" class="sortable">
                            Date de creation
                          
                        </th>
                        <th wire:click="sortBy('created_at')" class="sortable">
                            Date de modification
                          
                        </th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="">
                    @foreach($Incidents as $incident)
                        <tr  style="cursor:pointer" >
                            <td>
                                <input type="checkbox"
                                       wire:model="selectedTickets"
                                       value="{{ $incident->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td wire:click="Visualiser({{ $incident->id }})"># {{ $incident->id }}</td>
                            <td wire:click="Visualiser({{ $incident->id }})" class="text-muted"> {{ $incident->utilisateur->nom }} </td>
                            <td wire:click="Visualiser({{ $incident->id }})">{{ $incident->equipement_type }}</td>
                            <td wire:click="Visualiser({{ $incident->id }})" >
                                @if ($incident->equipement_type == 'Ordinateur')
                                    {{ $incident->ordinateur->nom }}  {{ $incident->ordinateur->os_version }}
                                @endif
                                @if ($incident->equipement_type == 'Telephone')
                                    {{ $incident->telephone->nom }}  {{ $incident->ordinateur->marque }}
                                @endif
                            </td>
                            <td class="{{ $incident->statut == 0 ? 'text-danger border shadow-lg' : 'text-body-secondary' }} ">
                                  {{ $incident->statut == 1 ? 'En cours' : ($incident->statut == 0 ? 'Demande da\'annulation  ' : 'En cours de traitement') }}
                                  @if ($incident->statut == 0)
                                    <br> Clicker ici pour supprimer <br>
                                    <button wire:click="SupprimerDemande({{ $incident->id }})"  class="btn btn-danger btn-sm shadow-sm border-0"> Supprimer</button>
                                  @endif
                                </td>
                            <td>
                                
                                <a href="{{ asset('storage/' . $incident?->rapport_incident) }}"
                                                target="_blank" class="mx-1 my-1">
                                                <i class="bi bi-download"></i> 
                                            </a> <br>
                            </td>
                            <td>
                                 <a href="{{ asset('storage/' . $incident?->declaration_perte) }}"
                                                target="_blank" class="mx-1 my-1">
                                                <i class="bi bi-download"></i>
                                             
                                            </a>
                            </td>


                        
                            <td wire:click="Visualiser({{ $incident->id }})">{{ $incident->created_at->format('d M Y H:i') }}</td>
                            <td wire:click="Visualiser({{ $incident->id }})">{{ $incident->updated_at->format('d M Y H:i') }}</td>
                            <td >
                                <div class="action-buttons">
                                    <button class="btn-action btn-view">
                                        <a href="{{ url('/admin/ticket-view-'.$incident->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </button>
                                    <button wire:click="$dispatch('editTicket', {id: {{ $incident->id }}})"
                                            class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $incident->id }})"
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
                {{-- {{ $incidents->links() }} --}}
            </div>
        </div>

</div>
