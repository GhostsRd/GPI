<div>
       <section class="home_banner_area">
        <div class="profile-container">
    <div class="profile-header">
      <div class="profile-avatar">
        <img src="{{asset('/images/logoPivot.png')}}" alt="Photo de profil">
      </div>
      <div class="profile-info">
        <h2>Staff pivot</h2>
        <p> Ici vous pouvez reconnaitre a tous les staff a la'aide du bar de recherche </p>
        
        <div class="profile-actions">
          <button class="btn btn-success">Suivre</button>
          <button class="btn btn-outline-success">Message</button>
        </div>
      </div>
    </div>

    <div class="profile-bio p-0">
        <input type="text" class="input-recherche" wire:model.debounce.500="recherche" placeholder="Entrer le nom...">
    </div>

    <div class="">
 
         <table  class=" profile-details table  card-body  rounded-0  shadow-sm border-0 " style="border:0;overflow:hidden" >
        

                <thead class="text-capitalize  ">

                    <th class="fw-bold p-2 border-0" >Nom </th>
                    <th class="fw-bold p-2 border-0" >Poste</th>
                    <th class="fw-bold p-2 border-0" >departement</th>
                    <th class="fw-bold p-2 border-0" >lieu d'affectation</th>
                    <th class="fw-bold p-2 border-0" >adresse</th>
                    <th class="fw-bold p-2 border-0" >telephone </th>
                 




                </thead>
                <tbody class="p-2 border-0">

       
                        @foreach($utilisateurs as $utilisateur)

                            <tr class="mt-2" wire:click="visualiser('{{$utilisateur->id}}')" style="cursor:pointer">

                        
                                        <td class="bg-white p-2 border-0" >
                                        {{$utilisateur->nom }}
                                        </td>
                                        <td class="text-muted bg-white p-1 border-0" id="tdanim1"
                                           >
                                            {{$utilisateur->poste }}
                                            </td>

                                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" 
                                            >
                                            {{$utilisateur->departement }}
                                            </td>

                                        <td class="text-primary bg-white p-1 border-0" id="tdanim1" 
                                            data-aos-duration="700" >
                                            {{$utilisateur->lieu_affectation }}
                                            </td>
                                        <td class="text-muted bg-white p-1 border-0" id="tdanim1" 
                                            >
                                            {{$utilisateur->adresse }}
                                            </td>
                                        <td class="text-muted bg-white p-1 border-0" id="tdanim1" 
                                           >
                                            {{$utilisateur->telephone }}
                                            </td>
                                      
                                    
                            </tr>
                        @endforeach
                </tbody>
        </table>

    </div>
  </div>
</section>

            <div class="modal-overlay {{$form}}">
                <div class="profile-container">
                        <div class="profile-header">
                        <div class="profile-avatar">
                            <img src="{{asset('/images/avtar_1.png')}}" alt="Photo de profil">
                        </div>
                        <div class="profile-info">
                            <h2>{{ $nom }}</h2>
                            <p> {{ $poste }}</p>
                            
                        </div>
                        </div>

                    <div class="profile-bio">
                    Passionné de technologie, de programmation et de design. J'aime créer des solutions modernes et partager mes connaissances.
                    </div>

                        <div class="profile-details">
                            <h3>Détails</h3>
                            <ul>
                            <li><strong>Email</strong> {{ $email }}</li>
                            <li><strong>Téléphone</strong> {{ $telephone }}</li>
                            <li><strong>Lieu de travail</strong>{{ $lieu_affectation }}</li>
                            <li><strong>Adresse</strong> {{ $adresse }}</li>
                            </ul>
                        </div>
                <div class="modal-close text-center "><button wire:click="closeform" class="btn btn-outline-success border border-success">Close</button></div>
                </div>
            </div>
</div