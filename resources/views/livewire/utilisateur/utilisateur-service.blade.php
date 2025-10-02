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
                            Is give may shall likeness made yielding spirit a itself togeth created 
                            after sea <br> is in beast beginning signs open god you're gathering ithe
                        </p>
								<a class="primary_btn mt-4" href="{{ route('utilisateurTicket')}}"><span>Creer <svg width="15" xmlns="http://www.w3.org/2000/svg" fill="fill" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                        </span>
                                        </a>
							
				
                    </div>
                </div>
               
            </div>
             <nav class="navbar navbar-expand-lg bg-white shadow-sm navbar-light p-0 m-0">
				<div class="container-fluid p-0 m-0">
					<input type="text" class=" border-0 p-3 " placeholder="Entrer votre recherche " style="border-color: none; width:100%;"  name="" id="">
				</div>
                
			</nav>
       <section>
         <table class="container-fluid table  border-none  shadow-sm background-white rounded" style="background-color: white;">
            <thead class="bg-white" >
                <th class="border-0"><input type="checkbox" ></th>
                
                <th class="fw-bold p-2 border-0" >Reference </th>
                <th class="fw-bold p-2 border-0" >Sujet</th>
                <th class="fw-bold p-2 border-0" >Priorite</th>
                <th class="fw-bold p-2 border-0" >categorie</th>
                <th class="fw-bold p-2 border-0" >Status</th>
                <th class="fw-bold p-2 border-0" >Creer par</th>
                <th class="fw-bold p-2 border-0" >Assigne a </th>
                <th class="fw-bold p-2 border-0" >Equipement concerner</th>
                <th class="fw-bold p-2 border-0" >Date de creation</th>
                <th class="fw-bold p-2 border-0" >Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
               @foreach ($tickets as $ticket )
            <tr class="mt-2">
                            <td class="bg-white p-2 border-0" >
                                <input type="checkbox" wire:model="checkData" value="sfsef"  class="border-0">
                            </td>
                                        <td class="bg-white p-2 border-0" >
                               {{$ticket->sujet}}
                            </td>
                             <td class="text-muted bg-white p-1 border-0" id="tdanim1" 
                                >{{$ticket->priorite}}</td>

                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" 
                           >True</td>   

                            <td class="text-primary bg-white p-1 border-0" id="tdanim1" 
                            >{{$ticket->categorie}}</td>  
                                 <td class="text-primary bg-white p-1 border-0" id="tdanim1" 
                                >{{$ticket->status}}</td>  
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" 
                                >{{$ticket->utilisateur_id}}</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" 
                              >{{$ticket->utilisateur_id}}</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" 
                              >{{$ticket->equipement}}</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" 
                                >{{$ticket->created_at}}</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" 
                               > <a href="{{ route('utilisateurWorkflow') }}">click me</a> </td>
            </tr>
    @endforeach
            </tbody>
            </table>    
       </section>
         <div class="mt-4">
          {{$tickets->links()}}
        </div>
    </section>





          
</div>
