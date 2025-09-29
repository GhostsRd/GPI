<div>


    <div class="container   ">
        <div class="row ">
            <div class="col-lg-4">

                <h3  id="titre-prof " style="color: #000000ff;"> Ticket    <svg xmlns="http://www.w3.org/2000/svg" width="20" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                              </svg></h3>
                <p id="text-prof">Ticket et support  / Ticket</p>
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

    <div class="container tb   p-2" style="font-size: 0.75rem">
        <form wire:submit.prevent="deleteSelected">
            <div class="bg-white ">

                <table class="  table  card-body  rounded-0  shadow-sm border-0 " style="border:0;overflow:hidden" >
            <div class="row  p-2">
                <div class="col-lg-2">
                    <h5 id="titre-prof" class="m-1 fw-bold" style="color: #040404ff;" >Liste</h5>
                </div>
                <div class="col-lg-4 offset-lg-5">
                    <input type="text" wire:model.debounce.500="recherche"  class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="Recherche ...">
                </div>
                <div class="col-lg-1  ">

                    <button
                {{-- {{$disabled}} --}}
                    class=" btn btn-outline-danger border-0 btn-sm ms-4  rounded-5 anim">
                        <svg class="icon-32    " width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                </svg>

                        {{-- <sub class="text-primary fw-bold  rounded-5 "> {{$total}}</sub> --}}
                        </button>
                </div>
            </div>

            <thead class="text-capitalize  ">
                <th class="border-0"><input type="checkbox" ></th>

                <th class="fw-bold p-2 border-0" >Reference </th>
                <th class="fw-bold p-2 border-0" >Sujet</th>
                <th class="fw-bold p-2 border-0" >Priorite</th>
                <th class="fw-bold p-2 border-0" >Status</th>
                <th class="fw-bold p-2 border-0" >Creer par</th>
                <th class="fw-bold p-2 border-0" >Assigne a </th>
                <th class="fw-bold p-2 border-0" >Equipement concerner</th>
                <th class="fw-bold p-2 border-0" >Date de creation</th>
                <th class="fw-bold p-2 border-0" >Action</th>







            </thead>
        <tbody class="p-2 border-0">
            <tr class="mt-2">
                            <td class="bg-white p-2 border-0" >
                                <input type="checkbox" wire:model="checkData" value="sfsef"  class="border-0">
                            </td>
                                        <td class="bg-white p-2 border-0" >
                               0011
                            </td>
                             <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">tSy mandeha le PC</td>

                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">True</td>

                            <td class="text-primary bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="700" >En coursP</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Tojo AF</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Leonce</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">LAPTOP1001</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">18 sept 2025</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400"> click me </td>
            </tr>
            <tr class="mt-2">
                            <td class="bg-white p-2 border-0" >
                                <input type="checkbox" wire:model="checkData" value="sfsef"  class="border-0">
                            </td>
                                        <td class="bg-white p-2 border-0" >
                               0011
                            </td>
                             <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">tSy mandeha le PC</td>

                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">True</td>

                            <td class="text-primary bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="700" >En coursP</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Tojo AF</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Leonce</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">LAPTOP1001</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">18 sept 2025</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400"> click me </td>
            </tr>
            <tr class="mt-2">
                            <td class="bg-white p-2 border-0" >
                                <input type="checkbox" wire:model="checkData" value="sfsef"  class="border-0">
                            </td>
                                        <td class="bg-white p-2 border-0" >
                               0011
                            </td>
                             <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">tSy mandeha le PC</td>

                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">True</td>

                            <td class="text-primary bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="700" >En coursP</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Tojo AF</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Leonce</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">LAPTOP1001</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">18 sept 2025</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400"> click me </td>
            </tr>
            <tr class="mt-2">
                            <td class="bg-white p-2 border-0" >
                                <input type="checkbox" wire:model="checkData" value="sfsef"  class="border-0">
                            </td>
                                        <td class="bg-white p-2 border-0" >
                               0011
                            </td>
                             <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">tSy mandeha le PC</td>

                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">True</td>

                            <td class="text-primary bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="700" >En coursP</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Tojo AF</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Leonce</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">LAPTOP1001</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">18 sept 2025</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400"> click me </td>
            </tr>
            <tr class="mt-2">
                            <td class="bg-white p-2 border-0" >
                                <input type="checkbox" wire:model="checkData" value="sfsef"  class="border-0">
                            </td>
                                        <td class="bg-white p-2 border-0" >
                               0011
                            </td>
                             <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">tSy mandeha le PC</td>

                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">True</td>

                            <td class="text-primary bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="700" >En coursP</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Tojo AF</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Leonce</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">LAPTOP1001</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">18 sept 2025</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400"> click me </td>
            </tr>
            <tr class="mt-2">
                            <td class="bg-white p-2 border-0" >
                                <input type="checkbox" wire:model="checkData" value="sfsef"  class="border-0">
                            </td>
                                        <td class="bg-white p-2 border-0" >
                               0011
                            </td>
                             <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">tSy mandeha le PC</td>

                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">True</td>

                            <td class="text-primary bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="700" >En coursP</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Tojo AF</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Leonce</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">LAPTOP1001</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">18 sept 2025</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400"> click me </td>
            </tr>
            <tr class="mt-2">
                            <td class="bg-white p-2 border-0" >
                                <input type="checkbox" wire:model="checkData" value="sfsef"  class="border-0">
                            </td>
                                        <td class="bg-white p-2 border-0" >
                               0011
                            </td>
                             <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">tSy mandeha le PC</td>

                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">True</td>

                            <td class="text-primary bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="700" >En coursP</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Tojo AF</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Leonce</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">LAPTOP1001</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">18 sept 2025</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400"> click me </td>
            </tr>
            <tr class="mt-2">
                            <td class="bg-white p-2 border-0" >
                                <input type="checkbox" wire:model="checkData" value="sfsef"  class="border-0">
                            </td>
                                        <td class="bg-white p-2 border-0" >
                               0011
                            </td>
                             <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">tSy mandeha le PC</td>

                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">True</td>

                            <td class="text-primary bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="700" >En coursP</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Tojo AF</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">Leonce</td>
                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">LAPTOP1001</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">18 sept 2025</td>
                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400"> click me </td>
            </tr>


            {{-- @foreach ($users as $user )
            <tr class="mt-2">
                            <td class="bg-white p-2 border-0" >
                                <input type="checkbox" wire:model="checkData" value="{{$user->id}}"  class="border-0">
                            </td>

                             <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">{{$user->nom }}</td>

                                <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">{{$user->prenom }}</td>

                            <td class="text-primary bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="700" >{{$user->email }}</td>

                            <td class="text-muted bg-white p-1 border-0" id="tdanim1" data-aos="fade-left"
                                data-aos-duration="400">
                                <small>

                                    <a wire:click="changeCode('{{$user->id}}')" class=" btn btn-sm btn-outline-secondary   border-0 rounded-2 shadow-sm">
                                        Renvoyer code
                                        <svg xmlns="http://www.w3.org/2000/svg" style="color: #55dd24;" width="15" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                          </svg>
                                        </a>
                                </small>
                            </td>
            </tr>

          @endforeach --}}






                </tbody>

            </table>
        </form>

    </div>
    <div id="modal" class="form shadow w-50 " method="POST">

        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-10">

                    <h5 class="fw-bold  text-secondary title-form"><svg xmlns="http://www.w3.org/2000/svg" class="text-secondary" width="30" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                      </svg>
                      Ajouter regisseur

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

                    <div class="col-lg-12">
                        <label for="projet" class="text-muted m-2 fw-bold">{{_('Nom *')}}</label>
                        <input type="text" id="nom" wire:model='nom'
                            class="form-control-plaintext shadow-sm border-1 bg-white p-1 ps-2  mt-1" placeholder="Nom"
                            required>

                        <label for="prerequis" class="text-muted m-2">{{_('Prenom ')}}</label>
                        <input type="text" wire:model="prenom"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm"
                            placeholder="Prenom " required>



                        <label for="contact" class="text-muted m-2 fw-bold">{{_('email ')}}</label>
                        <input type="email" wire:model="email" id="contact"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="email"
                            required>

                        <label for="number" class="text-muted m-2 fw-bold">{{_('Mot de passe ')}}</label>
                        <input type="text" wire:model="password" id="number"
                            class="form-control-plaintext p-1 ps-2 w-100  hover mt-1 rounded-5 shadow-sm" placeholder="mot de passe "
                            required>





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
