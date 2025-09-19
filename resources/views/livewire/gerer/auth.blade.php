<div>
    

    <div class="container   ">
        <div class="row ">
            <div class="col-lg-4">

                <h3  id="titre-prof " style="color:#55dd24;"> Regisseur</h3>
                <p id="text-prof">Paramétre  / Regisseur</p>   
            </div>
            <div class="col-lg-2 offset-lg-3"></div>
            <div class="col-lg-3 mt-5 ">
                <button wire:click="formAjout"
                    class="btn btn-sm btn-outline-primary offset-lg-8  fw-bold border-0 rounded-2 shadow-sm"
                    data-aos="flip-left" duration="800">
                    <a class="nav-link">
                        Ajout
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                          </svg>
                          

                    </a></button>
            </div>
        </div>
    </div> 

    <div class="container tb   p-2 rounded-2" style="font-size: 0.75rem">
        <form wire:submit.prevent="deleteSelected">
            <div class="bg-white rounded-3 ">
    
                <table class="  table  card-body  rounded-0  shadow-sm border-0 text-capitalize  " style="border:0;overflow:hidden" >
            <div class="row  p-2">
                <div class="col-lg-2">
                    <h5 id="titre-prof" class="m-1 fw-bold" style="color:#55dd24;" >Liste</h5>
                </div>
                <div class="col-lg-4 offset-lg-5">
                    <input type="text" wire:model.debounce.500="recherche"  class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="Recherche ...">
                </div>
                <div class="col-lg-1  ">
                
                    <button   
                {{$disabled}}
                    class=" btn btn-outline-danger border-0 btn-sm ms-4  rounded-5 anim">
                        <svg class="icon-32    " width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>                            
        
                        <sub class="text-primary fw-bold  rounded-5 "> {{$total}}</sub>
                        </button>
                </div>
            </div>
        
            <thead class="">
                <th class="border-0"><input type="checkbox" ></th>
                
                <th class="fw-bold p-2 border-0" >Nom d'utilsateur</th>
                <th class="fw-bold p-2 border-0" >email</th>
                <th class="fw-bold p-2 border-0" >code</th>

                
              
                
            </thead>
        <tbody class="p-2 border-0">
            

            @foreach ($users as $user )                           
            <tr class="mt-2">
                <td class="bg-white p-2 border-0" >
                    <input type="checkbox" wire:model="checkData" value="{{$user->id}}"  class="border-0">
                </td>

                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">{{$user->name }}</td>
                            
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="700">{{$user->email }}</td>

                

                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">
                                <a wire:click="sendMail('{{$user->id}}')" class=" btn btn-sm btn-outline-secondary  fw-bold border-0 rounded-2 shadow-sm">Envoyer code</a>
                            </td>
               
                  {{-- <td class="bg-white p-1 border-0" data-aos="flip-left" data-aos-delay="400">
                       
                        <svg  class="icon-32 text-warning" 
                        wire:click="formModifier('{{$dat->id}}','{{$dat->titre}}','{{$dat->description}}','{{$dat->prerequis}}','{{$dat->contexte}}','{{$dat->commentaire}}')" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                <path opacity="0.4" d="M19.9927 18.9534H14.2984C13.7429 18.9534 13.291 19.4124 13.291 19.9767C13.291 20.5422 13.7429 21.0001 14.2984 21.0001H19.9927C20.5483 21.0001 21.0001 20.5422 21.0001 19.9767C21.0001 19.4124 20.5483 18.9534 19.9927 18.9534Z" fill="currentColor"></path>                                <path d="M10.309 6.90385L15.7049 11.2639C15.835 11.3682 15.8573 11.5596 15.7557 11.6929L9.35874 20.0282C8.95662 20.5431 8.36402 20.8344 7.72908 20.8452L4.23696 20.8882C4.05071 20.8903 3.88775 20.7613 3.84542 20.5764L3.05175 17.1258C2.91419 16.4915 3.05175 15.8358 3.45388 15.3306L9.88256 6.95545C9.98627 6.82108 10.1778 6.79743 10.309 6.90385Z" fill="currentColor"></path>                                <path opacity="0.4" d="M18.1208 8.66544L17.0806 9.96401C16.9758 10.0962 16.7874 10.1177 16.6573 10.0124C15.3927 8.98901 12.1545 6.36285 11.2561 5.63509C11.1249 5.52759 11.1069 5.33625 11.2127 5.20295L12.2159 3.95706C13.126 2.78534 14.7133 2.67784 15.9938 3.69906L17.4647 4.87078C18.0679 5.34377 18.47 5.96726 18.6076 6.62299C18.7663 7.3443 18.597 8.0527 18.1208 8.66544Z" fill="currentColor"></path>                                </svg>                            

                    </td> --}}
            </tr>
        
          @endforeach
                    
                    
                    
                    
                    
                    
                </tbody>
                
            </table>
        </form>
        
    </div>
    <div id="modal" class="form shadow w-25  {{$form}}" method="POST">
          
        <div class="col-lg-12">
            <div class="row">
                <div class=" col-lg-10">

                    <h5 class="fw-bold  text-secondary title-form"><svg xmlns="http://www.w3.org/2000/svg" class="text-secondary" width="30" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                      </svg>
                      Ajouter regisseur
                    
                    </h5>
                </div>
                <div class="col-lg-2">

                    <span class="offset-7" >
                        <a href=""
                            >
                    
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" class="text-danger fw-bold" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                              </svg>
                        </a>
                    </span>
                </div>
            </div>
           <hr>
         
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="  input-container">
               

               
                <label for="contact" class="text-muted m-2 fw-bold">{{_("Nom d'utilisateur")}}</label>
                    <div class="col-md-6 col-lg-12">
                        <input id="name" type="text" placeholder="Nom d'utilisateur" class="form-control-sm form-control-plaintext shadow-sm border-0 ps-2 rounded-3 @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    </div>
                  </div>
            

           

            <div class=" row input-container">
                

                  <div class="col-lg-12">
                    <label for="contact" class="text-muted m-2 fw-bold">{{_('Email ')}}</label>
                    <input id="email" type="email" placeholder="Votre e-mail" class="form-control-sm form-control-plaintext shadow-sm border-0 ps-2 rounded-3 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                  
                  </div>
            </div>

            <div class="row mb-3 mt-2">
                
                <label for="contact" class="text-muted m-2 fw-bold">{{_('password ')}}</label>
                <div class="col-lg-12">
                    <input id="password" type="password" placeholder="Mot de passe" class="form-control-sm form-control-plaintext shadow-sm border-0 ps-2 rounded-3 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                 
                </div>
            </div>

            <div class="row mb-3">
                <label for="contact" class="text-muted m-2 fw-bold">{{_('Confirmer mot de passe ')}}</label>  
                <div class="col-lg-12">
                    <input id="password-confirm" placeholder="Confirmer mot de passe" type="password" class="form-control-sm form-control-plaintext shadow-sm border-0 ps-2 rounded-3" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <hr>
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-sm border-0 shadow-sm  btn-outline-primary mt-2 rounded-2 fw-bold"  >
                        {{ __('Enregistrer') }}
                    </button>
                </div>
            </div>
        </form>
          </div>

      
  </div>
  @if (session('notif'))

  <div class="row mynotif col-lg-5 rounded-3 active shadow  ">
      <div class="col-lg-1">

          <svg data-aos="fade-rigth" class="mt-1 notif-icon text-warning" xmlns="http://www.w3.org/2000/svg" class="text-warning " fill="none" width="30"  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
            </svg>

          
            
      </div>
      <div class="col-lg-10">
          <small>

              <span class="fw-bold">Notification</span> <br>
              
               <div >{{session('notif')}} <svg xmlns="http://www.w3.org/2000/svg"  style="color: #55dd24" width="18" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg></div>
          </small>
             
      </div>
      <div class="col-lg-1">
          <svg wire:click="exit" xmlns="http://www.w3.org/2000/svg" width="18" style="color: red" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
            
      </div>
      

  </div>
@endif
</div>
