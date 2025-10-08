<div>
   <div class="dashboard-header">
        <h4 class="text-muted" ><strong>Ticket / view</strong></h4>
        <p class="dashboard-subtitle">Vue d'ensemble de votre activité</p>
    </div>

 <div class="container-fluid p-lg-2 p-sm-2 p-md-2 mb-sm-2 mb-md-2 " >
    <div class="row h-100">
    
      <div class="col-lg-9  mb-md-2 mb-sm-2">
        {{-- <div class="container bg-white mt-0 pt-3 p-4 rounded-3 shadow_{{$ticketvals->priorite}} "> --}}
        
        <div class="container bg-white mt-0 pt-3 p-4 rounded-3 shadow-lg">
          <div class="row">
            <div class="col-lg-11 col-md-10 col-sm-10">
             <label class="fw-bold  mb-1 mt-0 pt-0" >Ticket #<span id="ticketId">{{$ticketId}}</span> — {{$ticketvals->sujet}}</label> 

             </div>
             <div class="col-lg-1 col-mg-1 col-sm-1">
                <svg wire:click="openAffectationModal"  width="30"  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
              <div class="dropdown">
  <button class="btn btn-outline-danger btn-sm dropdown-toggle d-flex align-items-center" 
          type="button" 
          id="dropdownMenuButtonExit" 
          data-bs-toggle="dropdown" 
          aria-expanded="false">

    <!-- Icône Exit -->
    <svg xmlns="http://www.w3.org/2000/svg" 
         width="20" 
         fill="none" 
         viewBox="0 0 24 24" 
         stroke-width="1.5" 
         stroke="currentColor" 
         class="me-2">
      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
    </svg>
    Exit
  </button>

  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButtonExit">
    <li><a class="dropdown-item" href="#">Déconnexion</a></li>
    <li><a class="dropdown-item" href="#">Fermer la session</a></li>
  </ul>
</div>

            
             </div>
          </div>
     
        

          </span>
            <div class="meta mt-2">Créé par <strong>{{$utilisateurs->nom}}</strong> • <span id="createdAt">{{ \Carbon\Carbon::parse($ticketvals->created_at)->translatedFormat('d M Y') }}</span> • 
            @if($ticketvals->state == 1) <span class="badge open">Nouveau</span> @endif
            @if($ticketvals->state == 2) <span class="badge open" style="background:#fff7ed;color:var(--warn)">Assigné</span> @endif
            @if($ticketvals->state == 3) <span class="badge open" style="background:#eefbf7;color:var(--ok)">En cours</span> @endif
            @if($ticketvals->state == 4) <span class="badge open" style="background:#f0f9ff;color:#0369a1">Résolu</span> @endif
            @if($ticketvals->state == 5) <span class="badge closed">Fermé</span> @endif
        
           </div>

          <div class="row  p-3 fond-bg rounded-3">
            <div class="steps-container row" style="display:flex;align-items:center;">
              <div class="step {{$current[1]}} col-lg-1" wire:click="currentStep(1)" data-index="0">
                <div class="dot ">1</div>
                <div class="title">Nouveau</div>
                <div class="sub">Création</div>
              </div>
              <div class="connector col-lg-1">
                <div class="fill {{$progress}}"></div>
              </div>
              <div class="step {{$current[2]}} col-lg-2" wire:click="currentStep(2)" data-index="1">
                <div class="dot">2</div>
                <div class="title">Assigné</div>
                <div class="sub">Assigné à une équipe</div>
                
              </div>
              <div class="connector col-lg-1">
                <div class="fill {{$progress}}"></div>
              </div>
              <div class="step {{$current[3]}} col-lg-1" wire:click="currentStep(3)" data-index="2">
                <div class="dot">3</div>
                <div class="title">En cours</div>
                <div class="sub">Intervention</div>
                
              </div>
              <div class="connector col-lg-1">
                <div class="fill {{$progress}}"></div>
              </div>
              <div class="step {{$current[4]}} col-lg-1" wire:click="currentStep(4)" data-index="3">
                <div class="dot">4</div>
                <div class="title">Résolu</div>
                <div class="sub">Résolution proposée</div>  
              </div>
              <div class="connector col-lg-1">
                <div class="fill {{$progress}}"></div>
              </div>
              <div class="step {{$current[5]}} col-lg-1" wire:click="currentStep(5)" data-index="4">
                <div class="dot">5</div>
                <div class="title">Fermé</div>
                <div class="sub">Ticket fermé</div>
              </div>
            </div>
          </div>
          <div class="container-fluid mt-4 mb-3 ml-0">
            <h5>Details</h5>
            <p>{{$ticketvals->details}}</p>
          </div>
          <div class="container-fluid">
          <form wire:submit.prevent="postCommentaire">
            <h5 style="margin:14px 0 8px">Ajouter un commentaire pour la transition</h5>
            <textarea wire:model="comments"  class="custom-textarea" 
             name="message" 
            id="message" placeholder="Ex: Prise en main du ticket" ></textarea>
               </div>
              <div class="container-fluid mt-3">
                <div class="row ">
                  <div class="col-lg-3">
                          {{-- <button 
                              wire:click="submitForm" id="nextBtn"
                              class="btn btn-sm btn-primary border fw-bold relative flex items-center justify-center gap-2 px-3 py-2 rounded-md font-semibold"
                                >
                              <!-- Spinner : visible uniquement pendant le loading -->
                              <span wire:loading wire:target="submitForm" class="loader"></span>

                              <!-- Texte du bouton : caché pendant le loading -->
                              <span wire:loading.remove wire:target="submitForm">Envoyer</span>
                          </button> --}}

                        <button id="prevBtn" wire:click="previousStep" class="btn btn-sm btn-outline-primary border-0 fw-bold">Reculer</button>  
                        <button type="submit"  wire:click="nextStep" class="btn btn-sm btn-primary border fw-bold"><span  class="loader"></span> Passer</button>
                      
                    </div>
                </div>
            </form>
          </div>
            <hr>
            <div class="container-fluid mt-4 mb-2">
                    <h5 class="mb-3 text-lg font-semibold"><strong>Historique des activités</strong></h5>

                        <div class="timeline">


                        <!-- Item 1 -->
                           @foreach($commentaires as $comment)
                              <div class="timeline-item ">
                                  <div class="timeline-icon">
                                  <span class="icon-wrap" title="Assign">
                                      <!-- user assign icon -->
                                      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zM4 20c0-2.761 2.239-5 5-5h6c2.761 0 5 2.239 5 5v1H4v-1z" fill="var(--accent)"/>
                                      </svg>
                                  </span>
                                  </div>
                                  <div class="timeline-content">
                                  <div class="timeline-date">
                                  
                                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M12 7v5l4 2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg> 
                            

                                  {{ \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d M Y H:i') }}
                                  •      @if($comment->etat == 1) <span class="badge open">Nouveau</span> @endif
                                          @if($comment->etat == 2) <span class="badge open" style="background:#fff7ed;color:var(--warn)">Assigné</span> @endif
                                          @if($comment->etat == 3) <span class="badge open" style="background:#eefbf7;color:var(--ok)">En cours</span> @endif
                                          @if($comment->etat == 4) <span class="badge open" style="background:#f0f9ff;color:#0369a1">Résolu</span> @endif
                                          @if($comment->etat == 5) <span class="badge closed">Fermé</span> @endif
                                      
                                  
                                    •   <strong class="text-capitalize"> 
                                    @foreach($responsables as $resp)
                                      @if($comment->utilisateur_id == $resp->id)
                                              {{$resp->name}}
                                      @endif
                                    @endforeach
                                    </strong>  {{$comment->commentaire}} <strong>{{$ticketvals->categorie}}</strong>.</div>
                                      
                                  <button wire:click="destroyComment({{$comment->id}})" type="button" class="btn border-0 p-0 btn-outline-danger btn-sm mx-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                  </button>

                                  </div>


                              </div>
                           @endforeach

                           <div class="mt-4 container " style="font-size:0.8rem">
                              {{ $commentaires->links() }}
                                     </div>
  
            </div>

          </div>
          
        </div>
        
      </div>
      <div class="col-lg-3 mt-sm-4 mt-2">
        <aside class="shadow-sm p-4 bg-white rounded-2 h-100 side ">
          <div>
            <label class="fw-bold" style="margin:0 0 8px">Résumé</label>
            <div class="info"><span class="text-muted fw-bold" style="font-size: 0.8rem;">Priorité:</span> @if($ticketvals->priorite == 0) Eleve @endif</div>
            <div class="info"><span class="text-muted fw-bold" style="font-size: 0.8rem;">Assigné à:</span> Tech Support</div>
            <div class="info" style="margin-top:6px"><span class="text-muted fw-bold" style="font-size: 0.8rem;">Dernière mise à jour:</span> <span
                id="lastUpdate">{{ \Carbon\Carbon::parse($ticketvals->updated_at)->translatedFormat('d M Y') }}
    </span></div>
              </div>

              <div>
                <label style="margin:0 0 8px" class="fw-bold">Actions rapides</label>
                <div style="display:flex;flex-direction:column;gap:8px">
                  <button class="btn-ghost" id="markResolved">Marquer comme Résolu</button>
                  <button class="btn-ghost" id="markClosed">Fermer ticket</button>
                </div>
              </div>

              <div>
                <h4 style="margin:0 0 8px">États actuels</h4>
                <div style="display:flex;gap:8px;flex-wrap:wrap">
                  <span class="badge open">Nouveau</span>
                  <span class="badge open" style="background:#fff7ed;color:var(--warn)">Assigné</span>
                  <span class="badge open" style="background:#eefbf7;color:var(--ok)">En cours</span>
                  <span class="badge" style="background:#f0f9ff;color:#0369a1">Résolu</span>
                  <span class="badge closed">Fermé</span>
                </div>
              </div>
            </aside>
          </div>
</div>

<div class="modal fade" id="affectationModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog modal-dialog-centered"> <!-- 👈 centré verticalement -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Affecter un ticket</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
        <label for="assigned_to" class="form-label">Choisir un technicien</label>
        <select class="form-select" id="assigned_to" wire:model="assigned_to">
            <option value="">-- Sélectionner --</option>
            @foreach($responsables as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->poste }})</option>
            @endforeach
        </select>
        @error('assigned_to') 
            <div class="text-danger">{{ $message }}</div> 
        @enderror

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-success" wire:click="affecter">Valider</button>
      </div>
    </div>
  </div>
</div>




</div>
