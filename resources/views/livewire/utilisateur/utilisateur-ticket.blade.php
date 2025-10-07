<div>
	 <div class="container text-center mt-5">
    {{-- <h2 class="fw-bold text-primary">📊 Évolution du Ticket Num </h2> --}}
    <h4 class="modal-title text-success " id="ticketModalLabel">Évolution du Ticket #{{$ticketvals->id}}</h4>
    <p class="text-muted">Suivez le parcours complet de votre demande en temps réel.</p>

    <a class="btn btn-success text-white fw-bold border p-2 px-4 mt-4 btn-lg rounded-pill shadow"  href="{{route('utilisateurService')}}"><span> <svg width="15" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
</svg> Retour

   </span>
     </a>

    <!-- === Timeline === -->
    <div class="timeline animate-progress " id="ticketTimeline">
      <div class="timeline-step {{ $ticketvals->state >= 1 ? 'active' : '' }} " data-step="1">
        <div class="circle"> <img class="dropdown-toggle rounded-pill" data-toggle="dropdown" src="https://ui-avatars.com/api/?name={{ Auth::guard('utilisateur')->user()->nom ?? 'Guest'}}" alt="Profil" width="40" height="40" class="rounded-circle me-2"></div>
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
