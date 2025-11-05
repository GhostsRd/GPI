<div>
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
                         <th wire:click="sortBy('sujet')" class="sortable">
                            Materiel atribuer
                          
                        </th>
                        <th wire:click="sortBy('created_at')" class="sortable">
                            Date de Sortie
                          
                        </th>
                        <th wire:click="sortBy('created_at')" class="sortable">
                            Date de Remise
                          
                        </th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- @foreach($checkouts as $checkout)
                        <tr  style="cursor:pointer" >
                            <td>
                                <input type="checkbox"
                                       wire:model="selectedTickets"
                                       value="{{ $checkout->id }}"
                                       class="checkbox-modern">
                            </td>
                            <td wire:click="Visualiser({{ $checkout->id }})"># {{ $checkout->id }}</td>
                            <td wire:click="Visualiser({{ $checkout->id }})"> {{ $checkout->utilisateur->nom }} </td>
                            <td wire:click="Visualiser({{ $checkout->id }})">{{ $checkout->materiel_type }}</td>
                            <td wire:click="Visualiser({{ $checkout->id }})" >{{ $checkout->materiel_details }}</td>
                            <td wire:click="Visualiser({{ $checkout->id }})">{{ $checkout->statut }}</td>
                            <td wire:click="Visualiser({{ $checkout->id }})">{{ $checkout->equipement_id }}</td>

                         
                            <td wire:click="Visualiser({{ $checkout->id }})">{{ $checkout->created_at->format('d M Y H:i') }}</td>
                            <td wire:click="Visualiser({{ $checkout->id }})">{{ $checkout->updated_at->format('d M Y H:i') }}</td>
                            <td >
                                <div class="action-buttons">
                                    <button class="btn-action btn-view">
                                        <a href="{{ url('/admin/ticket-view-'.$checkout->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </button>
                                    <button wire:click="$dispatch('editTicket', {id: {{ $checkout->id }}})"
                                            class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $checkout->id }})"
                                            class="btn-action btn-delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach --}}
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4 container d-flex justify-content-center">
                {{-- {{ $checkouts->links() }} --}}
            </div>
        </div>

</div>
