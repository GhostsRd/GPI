<div>
	<aside class="chat-popup "  role="dialog" aria-modal="true" aria-label="Fenêtre de chat">
    <header class="chat-header">
      <div class="chat-avatar">GPIS</div>
      <div class="chat-title">
        <h4>GPISupport — Chat</h4>
        <p>Général · habituellement réponse sous 1h</p>
      </div>
      <button class="chat-close" id="chatClose" aria-label="Fermer">✕</button>
    </header>

    

    <div class="chat-messages" id="messages" aria-live="polite">
      <!-- sample messages -->

       @foreach($chats as $chat)


            @if( $chat->type == "utilisateur")
                    <div class="msg user"> {{$chat->message}}<small>Support · {{$chat->created_at}}</small></div>
            @else
                 <div class="msg agent">Bonjour {{$chat->message}}<small>Support · {{$chat->created_at}}</small></div>
            @endif
      @endforeach

    </div>

    <form class="chat-composer" wire:submit.prevent="storechat" >
      <textarea id="input" class="chat-input" wire:model="message" rows="1" placeholder="Écris un message..."></textarea>
      <button id="sendBtn" type="submit" class="btn-send">Envoyer</button>
    </form>
  </aside>

 

  <section class="features_area section_gap_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="main_title">
                        <h2>Gerer vos ticket </h2>
                        <p>
                          Accédez à l’ensemble des tickets, suivez leur statut et assurez une résolution rapide des problèmes. 
                          Simplifiez la gestion du support grâce à une interface claire et intuitive.
                      </p>
								<a class="primary_btn text- mt-4" data-bs-toggle="modal" data-bs-target="#ticketModal"><span>Creer <svg width="15" xmlns="http://www.w3.org/2000/svg" fill="fill" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                        </span>
                                        </a>


                    </div>
                </div>

            </div>
             <nav class="navbar navbar-expand-lg bg-white shadow-sm navbar-light p-0 m-0">
				<div class="container-fluid  p-0 m-0">
					<input type="text" class="input-recherche border-0 p-4 " wire:model="recherche" placeholder="Entrer votre recherche " style="border-color: none; width:100%;"  name="" id="">
				</div>

			</nav>
       <section>
         <table class="container-fluid table  border-0  shadow-sm background-white rounded " style="background-color: white;">
            <thead class="bg-white "  >
               <tr >
                       
                        <th class="bg-white">Référence</th>
                        <th class="bg-white">Sujet</th>
                        <th class="bg-white">Priorité</th>
                        <th class="bg-white">Categorie</th>
                        <th class="bg-white">Statut</th>
                        <th class="bg-white">Créé par</th>
                        <th class="bg-white">Assigné à</th>
                        <th class="bg-white">Équipement</th>
                        <th class="bg-white">Date création</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
            </thead>
            <tbody class="bg-white">
               @foreach ($tickets as $ticket )
             <tr class="priorite_{{$ticket->priorite}}">
                               
                                <td>{{ $ticket->id }}</td>
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
                                    {{-- <div class="action-buttons">
                                        <button 
                                                class="btn-action btn-view">
                                                <a class="" href="{{ url('/admin/ticket-view-'.$ticket->id) }}">view</a>
                                            
                                        </button>
                                  
                                    </div> --}}
                                </td>
                            </tr>
    @endforeach
            </tbody>
            </table>
       </section>
         <div class="mt-4">
          {{$tickets->links()}}
        </div>
    </section>

    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ticketModal">
  Créer un ticket
</button> --}}

    <!-- Modal -->
<div wire:ignore.self class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="ticketModalLabel">Demande de Ticket</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>

      <!-- Formulaire Livewire -->
      <form wire:submit.prevent="store">
        <div class="modal-body">
          <!-- Sujet -->
          <div class="mb-3">
            <label for="sujet" class="form-label">Sujet <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('sujet') is-invalid @enderror"
                  id="sujet" wire:model.debounce.500ms="sujet">
            @error('sujet')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Détails -->
          <div class="mb-3">
            <label for="details" class="form-label">Détails <span class="text-danger">*</span></label>
            <textarea class="form-control @error('details') is-invalid @enderror"
                      id="details" wire:model.debounce.500ms="details" rows="4"></textarea>
            @error('details')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie <span class="text-danger">*</span></label>
            <select id="categorie"
                    class="form-select @error('categorie') is-invalid @enderror"
                    wire:model="categorie">
                <option value="">-- Sélectionner une catégorie --</option>
                <option value="Réseau">Réseau</option>
                <option value="Logiciel">Logiciel</option>
                <option value="Matériel">Matériel</option>
                <option value="Sécurité">Sécurité</option>
                <option value="Autre">Autre</option>
            </select>
            @error('categorie')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-3">
            <label for="impact" class="form-label">Impact <span class="text-danger">*</span></label>
            <select id="impact"
                    class="form-select @error('impact') is-invalid @enderror"
                    wire:model="impact">
                <option value="">-- Sélectionner l'impact --</option>
                <option value="Utilisateur">Un utilisateur ou un groupe</option>
                <option value="Service">Un service ou département</option>
                <option value="Organisation">Toute l’organisation</option>
                <option value="Organisation">Autre</option>

            </select>
            @error('impact')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>



          <!-- Priorité -->
          <div class="mb-3">
            <label for="priorite" class="form-label">Priorité</label>
            <select class="form-select @error('priorite') is-invalid @enderror"
                    id="priorite" wire:model="priorite">
              <option value="">-- Sélectionner --</option>
              <option value="Basse">Basse</option>
              <option value="Normale">Normale</option>
              <option value="Haute">Haute</option>
              <option value="Critique">Critique</option>
            </select>
            @error('priorite')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

        <div class="mb-3">
        <label for="equipement" class="form-label">Équipement <span class="text-danger">*</span></label>
        <select id="equipement"
                class="form-select @error('equipementSeeder') is-invalid @enderror"
                wire:model="equipement">
            <option value="">-- Sélectionner un équipement --</option>
            <option value="PC">PC</option>
            <option value="Imprimante">Imprimante</option>
            <option value="Routeur">Routeur</option>
            <option value="Switch">Switch</option>
            <option value="Serveur">Serveur</option>
        </select>
        @error('equipementSeeder')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      
              </div>

        <!-- Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-sm btn-primary">Envoyer</button>
        </div>
      </form>
    </div>
  </div>
</div>





</div>
