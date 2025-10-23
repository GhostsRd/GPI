<div>
     <div class="table-container border-0 shadow-sm  fade-in-up">
            <div class="table-header">
                <div class="table-title">
                    
                    Liste utilisateur
                </div>
            </div>

            <div class="table-wrapper  p-0 border-0 w-100 compact-mode">
         
                <table class="table border-0 shadow-sm text-center">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" wire:model="selectAll" class="checkbox-modern">
                        </th>
                        {{-- <th wire:click="sortBy('reference')" class="sortable">
                            Référence
                         
                        </th> --}}
                         
                        <th wire:click="sortBy('sujet')" class="sortable">
                            Nom
                          
                        </th>
                        <th wire:click="sortBy('priorite')" class="sortable">
                            Email
                           
                        </th>
                        <th wire:click="sortBy('status')" class="sortable">
                            Poste 
                        </th>
                         <th wire:click="sortBy('sujet')" class="sortable">
                            Departement
                          
                        </th>
                        <th wire:click="sortBy('created_at')" class="sortable">
                          lieu_affectation
                          
                        </th>
                        <th>
                            Telephone
                        </th>
                        <th wire:click="sortBy('created_at')" class="sortable">
                           adresse
                          
                        </th>
                        <th>
                            Action
                        </th>
                       
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($utilisateurs as $utilisateur)
                        <tr  style="cursor:pointer" >
                            <td>
                                <input type="checkbox"
                                       wire:model="selectedTickets"
                                       value="{{ $utilisateur->id }}"
                                       class="checkbox-modern">
                            </td>
                            {{-- <td wire:click="Visualiser({{ $utilisateur->id }})"># {{ $utilisateur->id }}</td> --}}
                            <td wire:click="Visualiser({{ $utilisateur->id }})"> {{ $utilisateur->nom }} </td>
                            <td wire:click="Visualiser({{ $utilisateur->id }})">{{ $utilisateur->email }}</td>
                            <td wire:click="Visualiser({{ $utilisateur->id }})" >{{ $utilisateur->poste }}</td>
                            <td wire:click="Visualiser({{ $utilisateur->id }})">{{ $utilisateur->departement }}</td>
                            <td wire:click="Visualiser({{ $utilisateur->id }})">{{ $utilisateur->lieu_affectation }}</td>
                            <td wire:click="Visualiser({{ $utilisateur->id }})">{{ $utilisateur->telephone }}</td>
                            <td wire:click="Visualiser({{ $utilisateur->id }})">{{ $utilisateur->adresse }}</td>


                          </td>
                            <td >
                                <div class="action-buttons">
                                    <button class="btn-action btn-view">
                                        <a href="{{ url('/admin/ticket-view-'.$utilisateur->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </button>
                                    <button wire:click="$dispatch('editTicket', {id: {{ $utilisateur->id }}})"
                                            class="btn-action btn-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $utilisateur->id }})"
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
                {{ $utilisateurs->links() }}
            </div>
        </div>

</div>
