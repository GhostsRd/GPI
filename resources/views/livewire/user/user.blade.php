<div>


    <div class="container   ">
        <div class="row ">
            <div class="col-lg-4">

                <h3 id="titre-prof" style="color: #55dd24"> Collecteur</h3>
                <p id="text-prof">Information / Collecteur</p>
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

                <table class="  table  card-body  rounded-0  shadow-sm border-0 text-capitalize  "
                    style="border:0;overflow:hidden">
                    <div class="row  p-2">
                        <div class="col-lg-2">
                            <h5 id="titre-prof" class="m-1 fw-bold" style="font-size:1.2rem;color: #55dd24;">Liste
                                </h5>
                        </div>
                        <div class="col-lg-4 offset-lg-5">
                            <input type="text" wire:model.debounce.500="recherche"
                                class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm"
                                placeholder="Recherche par profile ...">
                        </div>
                        <div class="col-lg-1  ">

                            <button {{$disabled}} class=" btn btn-outline-danger border-0 btn-sm ms-4  rounded-5 anim">
                                <svg class="icon-32    " width="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path
                                        d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>

                                <sub class="text-primary fw-bold  rounded-5 "> {{$total}}</sub>
                            </button>
                        </div>
                    </div>

                    <thead class="">
                        <th class="border-0"><input type="checkbox"></th>
                        <th class="fw-bold p-2 border-0">image</th>
                        <th class="fw-bold p-2 border-0 ">Nom</th>
                        <th class="fw-bold p-2 border-0">Prenom</th>
                        <th class="fw-bold p-2 border-0">CIN</th>
                        <th class="fw-bold p-2 border-0">adresse</th>
                        <th class="fw-bold p-2 border-0">Categorie</th>
                        <th class="fw-bold p-2 border-0">CIF</th>
                        <th class="fw-bold p-2 border-0">NIF</th>
                        <th class="fw-bold p-2 border-0">RCS</th>
                        <th class="fw-bold p-2 border-0">STAT</th>
                        <th class="fw-bold p-2 border-0">Carte collecte</th>
                     
                        

                    </thead>
                    <tbody class="p-2 border-0">


                        @foreach ($qrusers as $user )
                        <tr>
                            <td class="bg-white border-0"></td>
                        </tr>
                        <tr class="mt-2">
                            <td class="bg-white p-2 border-0">
                                <input type="checkbox" wire:model="checkData" value="{{$user->id}}" class="border-0">
                            </td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1">
                               
                                <img width="40" class="rounded-5 shadow-sm" wire:click="modifierForm('{{$user->id}}')" src="{{asset('storage/'.$user->url_img)}}"
                                    alt="">
                            </td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1">{{$user->nom}}</td>


                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">{{$user->prenom}}</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="600">{{$user->CIN}}</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="500">{{$user->adresse}}</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">
                                <span class="badge " style="background:#2cb6f1">{{$user->produit}}</span>
                                
                            </td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="700">{{$user->CIF}}</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="600">{{$user->NIF}}</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="500">{{$user->RCS}}</td>
                             <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">
                                {{$user->STAT}}
                            </td>
                            
                            
                           
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">
                                <a href="{{url('/find',$user->id)}}"  class=" btn btn-sm btn-outline-secondary  fw-bold border-0 rounded-2 shadow-sm">afficher
                                    <svg xmlns="http://www.w3.org/2000/svg" style="color: #55dd24;" width="10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                      </svg>
                                      
                                </a>
                            </td>
                            {{-- <td class="text-muted text-center offset-1 bg-white p-1 border-0 w-10  " id="tdanim2"
                                data-aos-duration="400" wire:click="previsualiser('{{$user->id}}')" width="400">

                                {!! DNS2D::getBarcodeHTML("http://192.168.43.125:8000/find/$user->id",
                                'QRCODE',2,2,'green', true)!!}



                            </td>

                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400" wire:click="previsualiserAdmin('{{$user->id}}')">
                                @if ($user->id == 53)
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-right"
                                data-aos-duration="600" wire:click="previsualiserAdmin('{{$user->id}}')">

                                {!! DNS2D::getBarcodeHTML("http://192.168.43.125:8000/retrait/$user->id",
                                'QRCODE',2,2,'red', true)!!}
                            </td>
                            @else
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-right"
                                data-aos-duration="600" wire:click="previsualiser2('{{$user->id}}')">

                                {!! DNS2D::getBarcodeHTML("http://192.168.43.125:8000/finding/$user->id",
                                'QRCODE',2,2,'blue', true)!!}
                                @endif
                            </td> --}}
                        </tr>

                        @endforeach
                    </tbody>
                    
                </table>
            </form>
            
        </div>
        <div class="">

            {{ $qrusers->links() }}
        </div>



    <div id="modal" class="form shadow w-50 {{$form}}" method="POST">

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-10">

                    <h5 class="fw-bold  text-secondary title-form"><svg xmlns="http://www.w3.org/2000/svg" class="text-secondary" width="30" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                      </svg>
                      Ajouter collecteur
                    
                    </h5>
                </div>
                <div class="col-lg-2">

                    <span class="offset-8" >
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
            <form wire:submit.prevent="create">
                @csrf
                <div class="row">

                    <div class="col-lg-6">
                        <label for="projet" class="text-muted m-2 fw-bold">{{_('Nom *')}}</label>
                        <input type="text" id="nom" wire:model='nom'
                            class="form-control-plaintext shadow-sm border-1 bg-white p-1 ps-2  mt-1" placeholder="Nom"
                            required>
    
                        <label for="prerequis" class="text-muted m-2">{{_('Prenom ')}}</label>
                        <input type="text" wire:model="prenom"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm"
                            placeholder="Prenom " required>
    
    
    
                        <label for="contact" class="text-muted m-2 fw-bold">{{_('CIN ')}}</label>
                        <input type="text" wire:model="CIN" id="contact"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="CIN"
                            required>
    
                        <label for="number" class="text-muted m-2 fw-bold">{{_('CIF ')}}</label>
                        <input type="text" wire:model="CIF" id="number"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="CIF "
                            required>
    
                        <label for="number" class="text-muted m-2 fw-bold">{{_('NIF ')}}</label>
                        <input type="text" wire:model="NIF" id="number"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="NIF "
                            required>
    
                      
    
                    </div>
    
                    <div class="col-lg-6">
                        <label for="contact" class="text-muted m-2 fw-bold">{{_('RCS ')}}</label>
                        <input type="text" wire:model="RCS" id="contact"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="RCS "
                            required>

                        <label for="contact" class="text-muted m-2 fw-bold">{{_('STAT ')}}</label>
                        <input type="text" wire:model="STAT" id="contact"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm"
                            placeholder="STAT " required>
    
                        <label for="contact" class="text-muted m-2 fw-bold">{{_('Adresse')}}</label>
                        <input type="text" wire:model="adresse" id="contact"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm"
                            placeholder="Adresse  " required>
    
                        <label for="contact" class="text-muted m-2 fw-bold">{{_('Categorie de produit ')}}</label>
                        {{-- <input type="text" wire:model="produit" id="contact"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm"
                            placeholder="Type de produit " required> --}}
                            <div class="row">
                                <div class="col-lg-10">
    
                                    <select  wire:model="produit" data-live-search="true" class="myselect badge-success  form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm">
                                        @foreach ($produits as $produit)
                                            <option class="border-0 p-2 " style="border: 0" value="{{$produit->categorie}}">
                                                <span class=" ">{{$produit->categorie}}</span>
                                                </option>
                                        @endforeach
                                    </select>
                                    
                                </div>
                                <div class="col-lg-2">
                                    <button
                                    class="btn  btn-sm btn-outline-secondary p-1 fw-bold border-0 rounded-3 shadow-sm"
                                    >
                                    <a class="nav-link" href="{{route("produit")}}">
                                   
                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                      </svg>
                                      
                                </a></button>
                                    
                                </div>
                            </div>
                            
                        <label for="contact" class="text-muted m-2 fw-bold">{{_('Image ')}}</label>
                        <input type="file" wire:model="photos" id="contact" max="1024"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm"
                            placeholder="image " required>
    
                    </div>
                </div>


                <hr>


                <div class="text-center">
                    <button type="submit"
                        class="btn btn-sm border-0 shadow-sm  btn-outline-primary mt-2 rounded-2 fw-bold">Enregistrer</button>
                    

                </div>

            </form>
        </div>


    </div>
   
    <div id="modal" class="form shadow w-50 {{$modifier}}" method="POST">
        @if(isset($id_qr))
            
        @foreach ($qrusers as $user )
        @if($user->id == $id_qr)
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-10">

                    <h5 class="fw-bold  text-secondary title-form">
                        <img width="30" class="rounded-5 shadow-sm"  src="{{asset('storage/'.$user->url_img)}}"
                                    alt="">
                      Modifier collecteur
                    
                    </h5>
                </div>
                <div class="col-lg-2">

                    <span class="offset-8" >
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
            <form method="post" action="{{route("update")}}">
                @csrf
               
                <div class="row">

                    <div class="col-lg-6">
                        <input type="hidden" name="id"  value="{{$user->id}}"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm"
                            placeholder="Prenom " required>

                        <label for="projet" class="text-muted m-2 fw-bold">{{_('Nom *')}}</label>
                        <input type="text"  name="nom" value="{{$user->nom}}"
                            class="form-control-plaintext shadow-sm border-1 bg-white p-1 ps-2  mt-1" 
                            
                            required>
    
                        <label for="prerequis" class="text-muted m-2">{{_('Prenom ')}}</label>
                           
                        <input type="text" name="prenom"  value="{{$user->prenom}}"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm"
                            placeholder="Prenom " required>
    
    
    
                        <label for="contact" class="text-muted m-2 fw-bold">{{_('CIN ')}}</label>
                        <input type="text" name="CIN" value="{{$user->CIN}}"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="CIN"
                            required>
    
                        <label for="number" class="text-muted m-2 fw-bold">{{_('CIF ')}}</label>
                        <input type="text" name="CIF"  value="{{$user->CIF}}"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="CIF "
                            required>
    
                        <label for="number" class="text-muted m-2 fw-bold">{{_('NIF ')}}</label>
                        <input type="text" name="NIF"  value="{{$user->NIF}}"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="NIF "
                            required>
    
                    
    
                    </div>
    
                    <div class="col-lg-6">
                        <label for="contact" class="text-muted m-2 fw-bold">{{_('RCS ')}}</label>
                        <input type="text" name="RCS" value="{{$user->RCS}}"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="RCS "
                            required>

                        <label for="contact" class="text-muted m-2 fw-bold">{{_('STAT ')}}</label>
                        
                        <input type="text" name="STAT" value="{{$user->STAT}}"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm"
                            placeholder="STAT " required>
    
                        <label for="contact" class="text-muted m-2 fw-bold">{{_('Adresse')}}</label>
                        <input type="text" name="adresse" value="{{$user->adresse}}"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm"
                            placeholder="Adresse  " required>
                            
                        <label for="produit" class="text-muted m-2 fw-bold">{{_('Categorie de produit ')}}</label>
                        <div class="row">
                            <div class="col-lg-10">

                                <select name="produit" class=" form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm">
                                    @foreach ($produits as $produit)
                                        <option class="border-0 p-2" style="border: 0" value="{{$produit->categorie}}">{{$produit->categorie}}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="col-lg-2">
                                <button
                                class="btn  btn-sm btn-outline-secondary p-1 fw-bold border-0 rounded-3 shadow-sm"
                                >
                                <a class="nav-link" href="{{route("produit")}}">
                               
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" fill="none"  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                  </svg>
                                  
                            </a></button>
                                
                            </div>
                        </div>
                        {{-- <input type="text" name="produit"  value="{{$user->produit}}"
                            
                            placeholder="Type de produit " required> --}}

                            
                        {{-- <label for="contact" class="text-muted m-2 fw-bold">{{_('Image ')}}</label>
                        <input type="file" name="photos" max="1024"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm"
                            placeholder="image " required> --}}
    
                    </div>
                </div>

             @endif
            @endforeach
                
                @endif
              
                
                

                <hr>


                <div class="text-center">
                    <button type="submit"
                        class="btn btn-sm border-0 shadow-sm  btn-outline-primary mt-2 rounded-2 fw-bold">Enregistrer</button>
                    

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