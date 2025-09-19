@extends('layouts.utilisateur')

@section('content')
@foreach ($results as $res)
<div class="container  down ">
    <div class="row ">
        <div class="col-lg-4">

            <h3 id="titre-prof" style="color: #55dd24"> Collecteur</h3>
            <p id="text-prof">Information / Collecteur / {{$res->nom}} {{$res->prenom}}</p>
        </div>
        <div class="col-lg-2 offset-lg-3"></div>
    </div>
</div>
<div class="col-lg-3 offset-1  ">
    <button 
        class="btn down btn-sm btn-outline-primary fw-bold border-0 rounded-2 shadow-sm"
        data-aos="flip-left" duration="800">
        <a class="nav-link" href="{{route('user')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
              </svg>
              
            Retour
              

        </a></button>
</div>
    
<div class="container row mt-2 offset-1  " >

    
    <div class="carte-qr row  " >

        <div class="col-lg-8  p-2 bg-white  row border rounded-3 shadow-sm">
            
            <div class="col-lg-2 col-2">
                <div class="col-lg-5 col-sm-3 col-3 ">

                    <img class="shadow-sm rounded-2" width="100" height="80" src="{{asset('/images/logo.png')}}" alt="">
                </div>
                <br>
                <br><br><br> <br><br><br>
                <div class="mt-4 ">
                    <img class="shadow-sm" src="data:image/png;base64,{!! DNS2D::getBarcodePNG(json_encode([
                        'nom' => $res->nom,
                        'adresse' => $res->adresse,
                        'CIN' => $res->CIN,
                        'NIF' => $res->NIF,
                        'CIF' => $res->CIF,
                        'STAT' => $res->STAT,
                        'RCS' => $res->RCS,
                        'categorie' => $res->produit,
                    ]), 'QRCODE', 2, 2) !!}" alt="QR Code">

                </div>
            </div>
            <div class="col-lg-7 col-5">
                <div class="text-center fw-bold">
                    <div class="col-lg-6 col-sm-3 ">

                        <img class="shadow-sm rounded-2 offset-lg-11" width="50"
                            src="{{asset('/images/republique.png')}}" alt="">
                    </div>
                    <br>

                    <small>
                        MINISTERE DE L'INTERIEURE DE LA DECENTRALISATION
                        <br>
                        REGION D'IHOROMBE
                        <hr class="col-lg-2 offset-5">

                    </small>

                    <h4 class="fw-bold">CARTE DE COLLECTE</h4>

                </div>
                <div class="offset-2">
                    <small>
                        <label class="fw-bold">Mr/Mme :</label> {{$res->nom}} {{$res->prenom}}<br>
                        <label class="fw-bold">Domicile :</label> {{$res->adresse}} <br>
                        <label class="fw-bold">CIN :</label> {{$res->CIN}} <br>
                        <label class="fw-bold">NIF :</label> {{$res->NIF}} <label class="fw-bold">CIF N°</label> {{$res->NIF}}<br>
                        <label class="fw-bold">STAT :</label> {{$res->STAT}} <br>
                        <label class="fw-bold">RCS:</label> {{$res->RCS}} <br>
                    </small>


                </div>
                <div>
                    <hr>
                    <small>

                        <label class="fw-bold offset-2">COLLECTEUR DES PRODUITS:</label> <span
                            class="text-success text-capitalize fw-bold">{{$res->produit}}</span> <br>
                    </small>

                </div>

            </div>
            <div class="col-lg-3 col-2">
                <div class="col-lg-5 col-6 ">
                    <img class="shadow-sm rounded-2" width="120" src="{{asset('storage/'.$res->url_img)}}" alt="">

                </div>

                <br><br><br><br><br><br><br><br><br><br><br>
                <div>
                    <label class="fw-bold"> {{$res->created_at->translatedFormat('d F Y')}}</label>
                </div>
            </div>



        </div>

        <div class=" col-lg-2 offset-1 mt-4" >
            <div id='down' class="down fw-bold btn rounded-3 shadow-sm border-0 btn-outline-warning  non shadow-sm    ">
                  <a class="nav-link" href="javascript:window.print()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                  </svg>
                  
                  </a>
            </div>
        </div>


        @endforeach
    </div>
    
</div>

    <script>
        function printPage() {
                setTimeout(() => {
                    window.print();
                }, 10000); // Donne 500ms pour charger le QR code avant impression
            }
    </script>
    @endsection