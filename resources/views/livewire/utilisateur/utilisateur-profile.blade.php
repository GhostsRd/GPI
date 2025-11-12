<div class="container py-5" style="margin-top: 5%">
  <div class="card  shadow border-0 rounded-4 overflow-hidden">
    <div class="row pb-5 g-0 align-items-center">
      <!-- Avatar -->
      <div class="col-md-4 bg-light d-flex flex-column align-items-center justify-content-center p-4">
        <div class="position-relative">
          <img src="{{ asset('/images/avtar_1.png') }}" alt="Photo de profil"
               class="rounded-circle border border-3 border-primary shadow-sm" width="130" height="130">
          <button class="btn btn-sm btn-outline-secondary position-absolute bottom-0 end-0 rounded-circle"
                  title="Changer la photo">
            <i class="bi bi-camera"></i>
          </button>
        </div>

        <h4 class="mt-3 mb-0 text-dark fw-bold">
          {{ Auth::guard('utilisateur')->user()->nom }}
        </h4>
        <p class="text-muted mb-2">{{ Auth::guard('utilisateur')->user()->poste }}</p>

        <div class="d-flex justify-content-center gap-3 mt-2">
          <div class="text-center">
            <h6 class="mb-0 fw-bold text-primary">120</h6>
            <small class="text-muted">Checkout</small>
          </div>
          <div class="text-center">
            <h6 class="mb-0 fw-bold text-primary">350</h6>
            <small class="text-muted">Reservation de materiels</small>
          </div>
          <div class="text-center">
            <h6 class="mb-0 fw-bold text-primary">180</h6>
            <small class="text-muted">Tickets</small>
          </div>
        </div>

        <div class="mt-3">
          <button class="btn btn-sm btn-primary px-3 me-2">
            <i class="bi bi-person-plus"></i> Suivre
          </button>
          <button class="btn btn-sm btn-outline-secondary px-3">
            <i class="bi bi-envelope"></i> Message
          </button>
        </div>
      </div>

      <!-- Informations principales -->
      <div class="col-md-8 p-4">
        <h5 class="fw-bold text-secondary mb-3">
          <i class="bi bi-person-lines-fill text-primary me-2"></i> Profil
        </h5>

        <p class="text-muted fst-italic mb-4">
          Passionné de technologie, de programmation et de design. J’aime créer des solutions modernes
          et partager mes connaissances pour améliorer les pratiques numériques.
        </p>

        <div class="row">
          <div class="col-md-6 mb-3">
            <strong class="text-dark">Email :</strong><br>
            <span class="text-muted">{{ Auth::guard('utilisateur')->user()->email }}</span>
          </div>

          <div class="col-md-6 mb-3">
            <strong class="text-dark">Téléphone :</strong><br>
            <span class="text-muted">{{ Auth::guard('utilisateur')->user()->telephone }}</span>
          </div>

          <div class="col-md-6 mb-3">
            <strong class="text-dark">Lieu d’affectation :</strong><br>
            <span class="text-muted">{{ Auth::guard('utilisateur')->user()->lieu_affectation }}</span>
          </div>

          <div class="col-md-6 mb-3">
            <strong class="text-dark">Adresse :</strong><br>
            <span class="text-muted">{{ Auth::guard('utilisateur')->user()->adresse }}</span>
          </div>
        </div>

        <div class="d-flex justify-content-end mt-4">
          <button class="btn btn-outline-primary me-2">
            <i class="bi bi-pencil-square"></i> Modifier le profil
          </button>
          <button class="btn btn-outline-danger">
            <i class="bi bi-box-arrow-right"></i> Déconnexion
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
