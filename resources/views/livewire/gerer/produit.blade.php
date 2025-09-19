<div>


    <div class="container   ">
        <div class="row ">
            <div class="col-lg-4">

                <h3 id="titre-prof" style="color: #55dd24"> Produit</h3>
                <p id="text-prof">Paramétre / Produit</p>
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
                                placeholder="Recherche par nature ...">
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
                        <th class="fw-bold  border-0">Nature</th>
                        <th class="fw-bold  border-0 ">Categorie</th>
                        <th class="fw-bold  border-0">Unite</th>
                        <th class="fw-bold  border-0">Taux de ristourne</th>
                  


                    </thead>
                    <tbody class=" border-0">
                        @foreach ($produits as $produit )
                        <tr>
                            <td class="bg-white border-0"></td>
                        </tr>
                        <tr class="">
                            <td class="bg-white border-0">
                                <input type="checkbox" wire:model="checkData" value="{{$produit->id}}" class="border-0">
                            </td>
                            
                            <td class="text-muted bg-white  border-0" id="tdanim1">
                                {{$produit->nature}}
                            </td>


                            <td class="text-muted bg-white  border-0" id="tdanim1" 
                                >   <span class="badge " style="background: #55dd24">{{$produit->categorie}}</span>
                            
                            </td>
                            <td class="text-muted bg-white  border-0" id="tdanim1">{{$produit->unite}}</td>
                            <td class="text-muted bg-white  border-0" id="tdanim1" >{{$produit->taux_ristourne_par_unite}}</td>
                            
                            @endforeach
                    </tbody>

                </table>
        </form>

    </div>
    <div class="">

        {{ $produits->links() }}
    </div>



    <div id="modal" class="form shadow w-50 {{$form}}" method="POST">

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-10">

                    <h5 class="fw-bold  text-secondary title-form"><svg xmlns="http://www.w3.org/2000/svg" class="text-secondary" width="30" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                      </svg>
                      Ajouter produit
                    
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
               
                        <label for="projet" class="text-muted m-2 fw-bold">{{_('Nature *')}}</label>
                        <input type="text" id="nom" wire:model='nature'
                            class="form-control-plaintext shadow-sm border-1 bg-white p-1 ps-2  mt-1" placeholder="Nature"
                            required>
    

                        <label for="contact" class="text-muted m-2 fw-bold">{{_('Categorie *')}}</label>
                        <input type="text" wire:model="categorie" id="contact"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="categorie"
                            required>
    
                        <label for="number" class="text-muted m-2 fw-bold">{{_('Unite *')}}</label>
                        <input type="text" wire:model="unite" id="number"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="Unite "
                            required>
    
                        <label for="number" class="text-muted m-2 fw-bold">{{_('taux de ristourne/unite *')}}</label>
                        <input type="text" wire:model="taux_ristourne" id="number"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="Taux "
                            required>
    
                            <hr>


                            <div class="text-center">
                                <button type="submit"
                                    class="btn btn-sm  btn-outline-secondary border-0 shadow-sm mt-2 rounded-3 fw-bold">Enregistrer</button>
                                
            
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