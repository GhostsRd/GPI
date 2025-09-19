<div>
    
    <div class="container   ">
        <div class="row ">
            <div class="col-lg-4">

                <h3  id="titre-prof" style="color: #55dd24"> Collecte de ristourne</h3>
                <p id="text-prof">Historique / Collecte de ristourne</p>   
            </div>
                      
        </div>
    </div> 

    <div class="container tb   p-2 rounded-2" style="font-size: 0.75rem">
        <form wire:submit.prevent="deleteSelected">
            <div class="bg-white rounded-3 ">
    
                <table class="  table  card-body  rounded-0  shadow-sm border-0 text-capitalize  " style="border:0;overflow:hidden" >
            <div class="row  p-2">
                <div class="col-lg-2">
                    <h5 id="titre-prof" class="m-1 fw-bold" style="font-size:1.2rem;color: #55dd24;">Liste </h5>
                </div>
                
                <div class="col-lg-4 offset-lg-3">
                    <input type="text" wire:model.debounce.500="recherche"  
                    class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="Rceherche ">
                </div>
              
                <div class="col-lg-2 ">
                    <select type="text" wire:model="selectoption" wire:click="listparregisseur"  
                    class="form-control-plaintext p-1 ps-2 w-100   mt-1 rounded-5 shadow-sm" placeholder="Rceherche ">
                    <option value="">Tout</option>
                    @foreach ($regisseurs as $item)
                    <option value="{{$item->name}}">{{$item->name}}</option>
                        
                    @endforeach
                    </select>
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
                <th class="fw-bold p-2 border-0" >Quantite</th>
                <th class="fw-bold p-2 border-0" >Unite</th>
               
                {{-- <th class="fw-bold p-2 border-0" >Quitance Image</th> --}}
                {{-- <th class="fw-bold p-2 border-0 text-center" >Receveur</th> --}}
                <th class="fw-bold p-2 border-0" >Ristourne</th>
                <th class="fw-bold p-2 border-0" >Collecteur</th>
                <th class="fw-bold p-2 border-0" >Produit</th>
                <th class="fw-bold p-2 border-0" >Regisseur</th>
                <th class="fw-bold p-2 border-0" >Commune</th>
                <th class="fw-bold p-2 border-0" >N Quitance</th>
                <th class="fw-bold p-2 border-0" >date_collecte</th>



                
            </thead>
        <tbody class="p-2 border-0  text-mutted">
            

            @foreach ($transactions as $collect )             
        
            <tr class="mt-2">
                <td class="bg-white p-2 border-0">
                    <input type="checkbox" wire:model="checkData" value="{{$collect->id}}" class="border-0">
                </td>
                {{-- <td class="text-muted bg-white p-1 border-0" id="tdanim1"
                    wire:click="previsualiser('{{$collect->url_img}}')">
                    <img width="40" class="rounded-5 shadow-sm" src="{{asset('storage/'.$collect->url_img)}}"
                        alt="">
                </td> --}}
                <td class="text-muted bg-white p-1 border-0" id="tdanim1">{{$collect->quantite}}</td>


                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                    data-aos-duration="400">{{$collect->unite}}</td>
                
                {{-- <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                    data-aos-duration="700">{{$collect->image_quitance}}</td> --}}
                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                    data-aos-duration="600">{{$collect->ristourne_calculee}}</td>
                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                    data-aos-duration="500">
                    @foreach ($collecteurs as $collecteur)
                        @if($collecteur->id == $collect->collecteur_id)
                          {{$collecteur->nom }} {{$collecteur->prenom }}
                        @endif
                    @endforeach

                </td>
                 <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                    data-aos-duration="400">
                    @foreach ($produits as $reg)
                    @if($reg->id == $collect->produit_id)
                      {{$reg->nature }}
                    @endif
                @endforeach

                  
                </td>
                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                    data-aos-duration="500">
   
                    @foreach ($regisseurs as $reg)
                    @if($reg->id == $collect->regisseur_id)
                      {{$reg->name }}
                    @endif
                @endforeach
                </td>
                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                    data-aos-duration="400">
               
                    <span class="badge " style="background:#24c1dd">{{$collect->commune}}</span>
                </td>
                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                    data-aos-duration="400">
                    {{$collect->numero_quitance}}
                </td>
                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                    data-aos-duration="600">
                     {{
                        $ee = strftime(" %d %b %Y %Hh:%m",$collect->created_at->getTimestamp());
                       }}</td>
               
              
               
            </tr>
            
          @endforeach
                    
                    
                    
                    
                    
                    
                </tbody>
                
            </table>
        </form>
        
    </div>
    {{$transactions->links()}}
</div
