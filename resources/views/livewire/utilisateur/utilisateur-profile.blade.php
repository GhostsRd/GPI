<div>
   <section class="home_banner_area">
      <div class="profile-container">
            <div class="profile-header">
              <div class="profile-avatar">
                <img src="{{asset('/images/avtar_1.png')}}" alt="Photo de profil">
              </div>
              <div class="profile-info">
                <h2>{{ Auth::guard('utilisateur')->user()->nom }}</h2>
                <p> {{ Auth::guard('utilisateur')->user()->poste }}</p>
                <div class="profile-stats">
                  <div>
                    <span class="text-success">120</span>
                    <small class="text-success">Publications</small>
                  </div>
                  <div>
                    <span class="text-success">350</span>
                    <small class="text-success">Abonnés</small>
                  </div>
                  <div>
                    <span class="text-success">180</span>
                    <small class="text-success">Abonnements</small>
                  </div>
                </div>
                <div class="profile-actions">
                  <button class="btn btn-primary">Suivre</button>
                  <button class="btn btn-outline">Message</button>
                </div>
              </div>
            </div>

        <div class="profile-bio">
          Passionné de technologie, de programmation et de design. J'aime créer des solutions modernes et partager mes connaissances.
        </div>

              <div class="profile-details">
                <h3>Détails</h3>
                <ul>
                  <li><strong>Email</strong> {{ Auth::guard('utilisateur')->user()->email }}</li>
                  <li><strong>Téléphone</strong> {{ Auth::guard('utilisateur')->user()->telephone }}</li>
                  <li><strong>Lieu de travail</strong>{{ Auth::guard('utilisateur')->user()->lieu_affectation }}</li>
                  <li><strong>Adresse</strong> {{ Auth::guard('utilisateur')->user()->adresse }}</li>
                </ul>
              </div>
      </div>
   </section>
</div>
