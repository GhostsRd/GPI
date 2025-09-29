<div>
  <section class=" section_gap_top">
  <div class="stepper">
  <div class="hero">
    <div class="hero-content">
    <svg xmlns="http://www.w3.org/2000/svg" width="100" style="color:#5bc4bf" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
												<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
												</svg>
      <h2 class="">Creation ticket</h2>
      <p>Complète ces quelques informations pour créer le ticket.</p>
    </div>
  </div>
  <div class="form-area mt-4">
    <form id="multiForm" novalidate method="POST" wire:submit.prevent="store">
      <!-- Step 1 -->
      <div class="step active" data-step="1">
        <h4>Sujet</h4>
      
        <div class="mb-3">
          <!-- <label class="form-label">Sujet</label> -->
          <textarea wire:model="sujet" class="form-control" style="height: 40px;" name="sujet">
          </textarea>
        </div>
       <h4> Details</h4>
         <div class="mb-3">
          <!-- <label class="form-label">Sujet</label> -->
          <textarea class="form-control" wire:model="details" style="height: 99px;" name="details">
          </textarea>
        </div>
        <div class="mb-3">
          <h4 class="form-label">Categorie</h4>
          <select class="w-100" wire:model="categorie">
            <option value="">Selectionner une categorie</option>
            <option value="reseau">Reseau</option>
            <option value="support">support</option>
            <option value="assistance">Assistance</option>
          </select>
        </div>
         <br>
        <div class="mt-3">
       
          <h4 class="form-label">Equipement</h4>
          <input class="form-control" wire:model="equipement"  name="status">
        </div>
      </div>
      <!-- Step 2 -->
   

      <!-- Step 3 -->
    

      <div class="controls text-center">
      <button class="primary_btn tr-bg bg-none" type="submit" >Creer</button>
     
        </div>
    </form>
      {{-- <div class="progress-line mt-5"><i id="progressBar"></i></div> --}}
  </div>
</div>
</section>
  
</div>
