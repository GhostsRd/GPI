<div class="row">


    <div class="card col-lg-4  sidebar shadow-sm border-0 rounded-4 p-4 mt-3" id="sidebar">
  <!-- Header -->
  <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
    <div class="d-flex align-items-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="28" fill="none" viewBox="0 0 24 24"
        stroke-width="1.5" stroke="currentColor" class="me-2 text-primary">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
      </svg>
      <h5 class="fw-bold text-dark mb-0">Détails du ticket</h5>
    </div>

    <div class="text-end">
      <span class="text-muted small me-2">#{{ $ticketvals->id }}</span>
      <span class="badge px-3 py-2 text-white rounded-3 
        {{ $ticketvals->state == 1 ? 'bg-info' : ($ticketvals->state == 2 ? 'bg-primary' : ($ticketvals->state == 3 ? 'bg-warning' : 'bg-success')) }}">
        {{ $ticketvals->state == 1 ? 'Assigné' : ($ticketvals->state == 2 ? 'En traitement' : ($ticketvals->state == 3 ? 'En attente' : 'Résolu')) }}
      </span>
    </div>
  </div>

  <!-- Body -->
  <div class="card-body pt-0">
    <form method="POST">
      @csrf

      <!-- Utilisateur -->
      <div class="d-flex align-items-center mb-3">
        <img src="https://ui-avatars.com/api/?name={{ Auth::guard('utilisateur')->user()->nom ?? 'Guest'}}"
             alt="Profil"
             width="45" height="45"
             class="rounded-circle shadow-sm me-3">
        <div>
          <h6 class="mb-0 fw-semibold">{{ Auth::guard('utilisateur')->user()->nom ?? 'Guest' }}</h6>
          <small class="text-muted">{{ $ticketvals->utilisateur->email }}</small>
        </div>
      </div>

      <!-- Sujet -->
      <div class="mb-3 border-top pt-3">
        <label class="form-label fw-bold text-secondary mb-1">Sujet</label><br>
        <span class="text-dark">{{ $ticketvals->sujet }}</span>
      </div>

      <!-- Priorité & Impact -->
      <div class="row mb-3">
        <div class="col-md-6">
          <label class="form-label fw-bold text-secondary mb-1">Priorité</label><br>
          <span class="badge bg-danger px-3 py-1 text-capitalize">
            {{ $ticketvals->priorite == 0 ? 'Haute' : ($ticketvals->priorite == 1 ? 'Moyenne' : 'Basse') }}
          </span>
        </div>
        <div class="col-md-6">
          <label class="form-label fw-bold text-secondary mb-1">Impact</label><br>
          <span class="badge bg-warning text-dark px-3 py-1">{{ $ticketvals->impact }}</span>
        </div>
      </div>

      <!-- Détails -->
      <div class="border-top pt-3">
        <label class="form-label fw-bold text-secondary mb-1">Détails</label>
        <p class="mb-0 text-muted" style="white-space: pre-line;">
          {{ $ticketvals->details }}
        </p>
      </div>
    </form>
  </div>
</div>



	 <div class="col-lg-9 main-content container text-center mt-5">
   <button class=" px-2 mb-4  rounded-3 btn btn-outline-secondary border-0 shadow-sm"   id="toggleSidebar">Details</button>
          {{-- <h2 class="fw-bold text-primary">📊 Évolution du Ticket Num </h2> --}}
          {{-- <h4 class="modal-title text-success " id="ticketModalLabel">Évolution du Ticket #{{$ticketvals->id}}</h4>
          <p class="text-muted">Suivez le parcours complet de votre demande en temps réel.</p> --}}

          {{-- <a class="btn btn-success text-white fw-bold border p-2 px-4 mt-4 btn-lg rounded-pill shadow"  href="{{route('utilisateurService')}}"><span> <svg width="15" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
          </svg> Retour

            </span>
              </a> --}}

        

    <!-- === Timeline === -->
              <div class="col-lg-9 bg-white rounded-3 timeline animate-progress mt-0" id="ticketTimeline">
                  <div class="timeline-step {{ $ticketvals->state >= 1 ? 'active' : '' }} " data-step="1">
                  <div class="circle"> 
                    <img class="dropdown-toggle rounded-pill" data-toggle="dropdown" src="https://ui-avatars.com/api/?name={{ Auth::guard('utilisateur')->user()->nom ?? 'Guest'}}" alt="Profil" width="40" height="40" class="rounded-circle me-2"></div>
                  <h6>Création</h6>

                

                  <div class="comment-box">
                    <b>Vous</b> avez creer le ticket le<small> {{ \Carbon\Carbon::parse($ticketvals->created_at)->translatedFormat('d M Y H:i') }}</small><br>
                    <p>• {{$ticketvals->details}}</p>
                  </div>
                  
                </div>

                <div class="timeline-step {{ $ticketvals->state >= 2 ? 'active' : '' }}" data-step="2">
                  <div class="circle"><img src="{{url("images/Ely.jpg")}}" width="45" class="rounded-pill"></div>
                  <h6>Assignation</h6>
                  @foreach($commentaires as $comment)
                  @if($comment->etat == 2)
                  <div class="comment-box">
                    <b>@foreach($responsables as $resp)
                                                @if($comment->utilisateur_id == $resp->id)
                                                        {{$resp->name}}
                                                @endif
                    @endforeach:</b> {{$comment->commentaire}}<br>
                    <small>{{ \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d M Y H:i') }}</small>
                  </div>
                    @endif
                  @endforeach

                </div>
                <div class="timeline-step {{ $ticketvals->state >= 3 ? 'active' : '' }}" data-step="3">
                  <div class="circle">3</div>
                  <h6>Traitement</h6>
          @foreach($commentaires as $comment)
                  @if($comment->etat == 3)
                  <div class="comment-box">
                    <b>@foreach($responsables as $resp)
                                                @if($comment->utilisateur_id == $resp->id)
                                                        {{$resp->name}}
                                                @endif
                    @endforeach:</b> {{$comment->commentaire}}<br>
                    <small>{{ \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d M Y H:i') }}</small>
                  </div>
                  @endif
          @endforeach
                </div>

                <div class="timeline-step {{ $ticketvals->state >= 4 ? 'active' : '' }}" data-step="4">
                  <div class="circle">4</div>
                  <h6>Résolution</h6>
                  @foreach($commentaires as $comment)
                  @if($comment->etat == 4)
                  <div class="comment-box">
                    <b>@foreach($responsables as $resp)
                                                @if($comment->utilisateur_id == $resp->id)
                                                        {{$resp->name}}
                                                @endif
                    @endforeach:</b> {{$comment->commentaire}}<br>
                    <small>{{ \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d M Y H:i') }}</small>
                  </div>
                  @endif
                  @endforeach
                </div>

                <div class="timeline-step {{ $ticketvals->state >= 5 ? 'active' : '' }}" data-step="5">
                  <div class="circle">5</div>
                  <h6>Clôture</h6>
                  @foreach($commentaires as $comment)
                  @if($comment->etat == 5)
                  <div class="comment-box">
                    <b>@foreach($responsables as $resp)
                                                @if($comment->utilisateur_id == $resp->id)
                                                        {{$resp->name}}
                                                @endif
                    @endforeach:</b> {{$comment->commentaire}}<br>
                    <small>{{ \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d M Y H:i') }}</small>
                  </div>
                  @endif
                  @endforeach
                </div>

                


      </div>
    
  </div>


</div>
