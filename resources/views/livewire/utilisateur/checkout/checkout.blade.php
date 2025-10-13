<div>
      <div class="container mt-xs-4 main-content">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-sm-8 col-xs-8 text-center">
                    <div class="main_title">
                        <h2 class="text-success">Check In / Out </h2>
                        <p>
                          Accédez à l’ensemble des tickets, suivez leur statut et assurez une résolution rapide des problèmes. 
                          Simplifiez la gestion du support grâce à une interface claire et intuitive.
                      </p>
								              <a class="btn btn-success text-white fw-bold border p-2 px-4 mt-4 btn-lg rounded-pill shadow"  id="toggleSidebar"><span>Creer <svg width="15" xmlns="http://www.w3.org/2000/svg" fill="fill" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                        </span>
                                        </a>

                    </div>
                </div>

            </div>
  <section  >
             <nav class=" shadow-sm col-lg-12 navbar-light p-0 m-0">
				<div class=" cold  p-0 m-0">
					<input type="text" list="sujets" class="input-recherche rounded border-0 p-4 " wire:model="recherche" placeholder="Entrer votre recherche " style="border-color: none; width:100%;"  name="" id="">
				
              {{-- <datalist id="sujets" >
               @foreach ($tickets as $ticket )
                <option value="{{ $ticket->sujet }}">
               @endforeach
          </datalist> --}}
        </div>

			</nav>
      
         <table class=" rounded-3 col-lg-12 table-responsive table  border-0  shadow background-white rounded " style="background-color: white;">
            <thead class="bg-white "  >
               <tr class="border-bottom-0 ">
                        <th class="bg-white">Référence</th>
                        <th class="bg-white">Sujet</th>

                        <th class="bg-white">Categorie</th>
                        <th class="bg-white">Statut</th>
                        <th class="bg-white">Créé par</th>
                        <th class="bg-white">Assigné à</th>
                        <th class="bg-white">Équipement</th>
                        <th class="bg-white">Date création</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
            </thead>
            <tbody class="bg-white"  >
              </tbody>
            </table>
    
         <div class="mt-4">
 
        </div>
    </section>
</div>
