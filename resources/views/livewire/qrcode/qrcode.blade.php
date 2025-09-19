<div>
    
<div class="container  col-lg-7 mt-4 offset-lg-3 ">
    
    @foreach ($results as $res)
    <div class="carte-qr ">

        
        <div class="col-lg-10 col-sm-12 p-2 bg-white  row border rounded-3 shadow-sm">
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
                        <label class="fw-bold">NIF :</label> {{$res->NIF}} CIF N° {{$res->NIF}}<br>
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
        <div class=" offset-2 col-lg-3 mt-4">
            <div id='down' class="btn rounded-3 shadow-sm btn-outline-success btn-sm non    ">
                <a class="nav-link" href="javascript:window.print()">Telecharger</a>
            </div>
        </div>
        <br>


        @endforeach
    </div>
    <script>
        function printPage() {
                setTimeout(() => {
                    window.print();
                }, 10000); // Donne 500ms pour charger le QR code avant impression
            }
    </script>
    
</div>
