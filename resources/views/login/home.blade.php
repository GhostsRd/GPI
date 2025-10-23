@extends("layouts.utilisateur")

@section("title")
    Home
@endsection


@section('content')


<div class="container ">
    {{-- <h5>A propos de vous</h5><br> --}}
@foreach ($valeurs as $val)

<div class="container rounded-3  p-2">
        <div class="row">

            <div class="col-lg-5">
                <img class="sh text-info shadow-sm rounded-2" width="250" src="{{asset('storage/'.$val->url_img)}}" alt="">
            </div>
            <div class="col-lg-6 border rounded-3">
                <h5 class="fw-bold m-2 m-2 text-info">Information du profile</h5>
                <div class="row">
                  <hr>
                    <div class="col-lg-5">
                        <label class="fw-bold m-2  ">  Nom d'utilisateur:</label>
                    </div>
                    <div class="col-lg-6 text-warning">
                        <label class="fw-bold m-2 text-warning">    {{$val->nom}}
                            {{$val->prenom}} </label>
                    
                    </div>
                    <hr>
                    <div class="col-lg-5">
                        <label class="fw-bold m-2  ">  CIN:</label>
                    </div>
                    <div class="col-lg-7 text-warning">
                        <label class="fw-bold m-2 text-warning">  
                            {{$val->cin}} </label>
                    
                    </div>
<hr>
<div class="col-lg-5">
                        <label class="fw-bold m-2  ">  Tel:</label>
                    </div>
                    <div class="col-lg-7 text-warning">
                        <label class="fw-bold m-2 text-warning">  
                            {{$val->tel}} </label>
                    
                    </div>
<hr>
                        <div class="row">
                      <div class="col-lg-5">
                          <label class="fw-bold m-2 ">Montant :</label> 
                  </div>
                    <div class="col-lg-7">
                        <label class="fw-bold m-2 text-warning">  {{$val->montant}} Ar</label> 
                      
                         </div>
                </div>
                                        
              
            </div>

        </div>
        
    </div>
    
</div>
@endforeach
<div class="container mt-4">
    
    
    <div class="container tb    p-2 rounded-2" style="font-size: 0.75rem">
        <form wire:submit.prevent="deleteSelected">
            <div class="bg-white rounded-3 ">
                
                <table class="  table  card-body  rounded-0  shadow-sm border-0 text-capitalize  " style="border:0;overflow:hidden" >
            <div class="row  p-2">
                <div class="col-lg-5">
                    <h5 id="titre-prof" class="m-1 fw-bold">Historique de votre compte </h5>
                </div>
               
            </div>
        
            <thead class="">

                <th class="fw-bold p-2 border-0" >Actif</th>
                <th class="fw-bold p-2 border-0" >Motif</th>
                <th class="fw-bold p-2 border-0" >Montant </th>
                <th class="fw-bold p-2 border-0 " >Destination</th>
                <th class="fw-bold p-2 border-0" >Date de transaction</th>
    
                
            </thead>
        <tbody class="p-2 border-0">
            

            @foreach ($transactions as $trans )                           
            <tr class="mt-2">
           
                <td class="bg-white p-2 border-0" data-aos="fade-left" data-aos-duration="400">
                    @foreach ($users as $item)
                        
                    @if ($item->id == $trans->sendeur)
                    <img width="35" class="rounded-5 shadow-sm" src="{{asset('storage/'.$item->url_img)}}" alt="">
                        {{$item->nom}} {{$item->prenom}}
                    @endif
                    @endforeach
                </td>
                <td class="bg-white p-2 border-0 text-danger fw-bold"  data-aos="fade-left" data-aos-duration="500">
                    {{$trans->motif}}
                </td>
                <td class="bg-white p-2 border-0" data-aos="fade-left" data-aos-duration="600">
                    {{$trans->montant}} Ar
                </td>
                <td class="bg-white p-2 border-0 " data-aos="fade-left" data-aos-duration="700" >
                    @foreach ($users as $item)
                        
                    @if ($item->id == $trans->receveur)
                    <img width="35" class="rounded-5 shadow-sm" src="{{asset('storage/'.$item->url_img)}}" alt="">
                        {{$item->nom}} {{$item->prenom}}
                    @endif
                    @endforeach
                </td>
                <td  class="text-muted bg-white p-1 border-0" id="tdanim2" data-aos="fade-left" data-aos-duration="800">{{
                    $ee = strftime(" %d %b %Y %Hh:%m",$trans->created_at->getTimestamp())
                }}</td>
                {{-- <td  class="text-muted bg-white p-1 border-0" id="tdanim1" wire:click="previsualiser('{{$user->url_img}}')">
                    @foreach ($valeurs as $item)
                    @if($item->id = $)
                    <img width="35" class="rounded-5" src="{{asset('storage/'.$trans->sendeur)}}" alt="">
                    @endforeach
                </td>
                 --}}
                 @endforeach
                 
                 
                 
                 
                 
                 
                </tbody>
                
            </table>
        </form>
        
    </div>
</div>


@endsection