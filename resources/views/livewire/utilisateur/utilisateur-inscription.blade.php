<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Utilisateur - Gestion de Parc & Support</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <style>
      
    </style>
</head>
<body>
<div class="floating-particles" id="particles"></div>

<div class="theme-switcher" id="themeSwitcher">
    <i class="fas fa-moon"></i>
</div>

<div class="container">
    <div class="hero-section">
        <div class="app-logo">
            <img src="images/logoPivot.png" alt="Logo IT Support Pivot" style="width: 60px; height: auto;">
            <h1>IT Support Pivot</h1>
        </div>

        <div class="hero-content">
            <h2>Créer un compte utilisateur</h2>
            <p>Rejoignez notre plateforme de gestion de parc informatique et bénéficiez d'un support technique personnalisé pour tous vos besoins IT.</p>

            <div class="features">
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div>
                        <h3>Support dédié</h3>
                        <p>Assistance technique rapide et efficace</p>
                    </div>
                </div>

                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-laptop"></i>
                    </div>
                    <div>
                        <h3>Équipement attribué</h3>
                        <p>Gestion centralisée de votre matériel informatique</p>
                    </div>
                </div>

                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                    <div>
                        <h3>Gestion des tickets</h3>
                        <p>Suivez vos demandes d'assistance en temps réel</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-container">
        <div class="card">
            <div class="card-header">Inscription Utilisateur</div>

            <div class="card-body">
                <form  method="POST" action="{{ route('userinscription') }}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <div class="input-container">
                                <i class="fas fa-user"></i>
                                <input id="name" type="text" wire:model='nom' placeholder="Nom complet"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="nom" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-container">
                                <i class="fas fa-envelope"></i>
                                <input id="email" type="email" wire:model='email' placeholder="Adresse e-mail"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <div class="input-container">
                                <i class="fas fa-phone"></i>
                                <input id="phone" type="tel" placeholder="Numéro de téléphone"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       name="telephone" value="{{ old('phone') }}" required autocomplete="tel">
                            </div>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-container">
                                <i class="fas fa-id-card"></i>
                                <input id="matricule" wire:model="matricule" type="text" placeholder="Matricule"
                                       class="form-control @error('matricule') is-invalid @enderror"
                                       name="matricule" value="{{ old('matricule') }}" required>
                            </div>
                            @error('matricule')
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <div class="input-container">
                                <i class="fas fa-briefcase"></i>
                                <input id="poste"  type="text" placeholder="Poste occupé"
                                       class="form-control @error('poste') is-invalid @enderror"
                                       name="poste" value="{{ old('poste') }}" required>
                            </div>
                            @error('poste')
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-container">
                                <i class="fas fa-building"></i>
                                <select id="departement"  class="form-control @error('departement') is-invalid @enderror" name="departement" required>
                                    <option value="none">Sélectionnez votre département</option>
                                    <option value="IT">IT & Technologies</option>
                                    <option value="RH">Ressources Humaines</option>
                                    <option value="Finance">Finance & Comptabilité</option>
                                    <option value="Medicale">Medicale</option>
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>
                            @error('departement')
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <div class="input-container">
                                <i class="fas fa-map-marker-alt"></i>
                                <input id="adresse" type="text"  placeholder="adresse"
                                       class="form-control @error('adresse') is-invalid @enderror"
                                       name="adresse" value="{{ old('adresse') }}" required>
                            </div>
                            @error('adresse')
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                            @enderror
                        </div>
                          <div class="form-group">
                            <div class="input-container">
                                <i class="fas fa-building"></i>
                                <select id="sexe" wire.model='sexe' class="form-control @error('sexe') is-invalid @enderror" name="sexe" required>
                                    <option value="">Sélectionnez votre sexe</option>
                                    <option value="homme">Homme</option>
                                    <option value="femme">Femme</option>
                                    <option value="autre">Autre</option>
                                </select>
                            </div>
                            @error('sexe')
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                            @enderror
                        </div>

                      
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <div class="input-container">
                                <i class="fas fa-map-marker-alt"></i>
                                <input id="lieu_affectation"  type="text" placeholder="Lieu de travail"
                                       class="form-control @error('lieu_affectation') is-invalid @enderror"
                                       name="lieu_affectation" value="{{ old('lieu_affectation') }}" required>
                            </div>
                            @error('lieu_affectation')
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-container">
                                <i class="fas fa-calendar-alt"></i>
                                <input id="date_embauche" wire:model='date_embauche' type="date"
                                       class="form-control @error('date_embauche') is-invalid @enderror"
                                       name="date_embauche" value="{{ old('date_embauche') }}" required>
                            </div>
                            @error('date_embauche')
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <div class="input-container">
                                <i class="fas fa-lock"></i>
                                <input id="password"  type="password" placeholder="Mot de passe"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="new-password">
                                <i class="fas fa-eye-slash password-toggle" id="togglePassword"></i>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-container">
                                <i class="fas fa-lock"></i>
                                <input id="password-confirm" type="password" placeholder="Confirmer le mot de passe"
                                       class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <i class="fas fa-eye-slash password-toggle" id="togglePasswordConfirm"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                        <label class="form-check-label" for="terms">
                            J'accepte les <a href="#">conditions d'utilisation</a> et la <a href="#">politique de confidentialité</a>
                        </label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="newsletter" id="newsletter">
                        <label class="form-check-label" for="newsletter">
                            Je souhaite recevoir les actualités et mises à jour de la plateforme
                        </label>
                    </div>

                    <button type="submit" class="btn">
                        <i class="fas fa-user-plus"></i> Créer mon compte utilisateur
                    </button>

                    <a href="{{ route('login') }}" class="login-link">
                        Déjà un compte ? Connectez-vous ici
                    </a>
                </form>
            </div>
        </div>

        <p style="text-align: center; margin-top: 20px; color: var(--text-secondary); opacity: 0; animation: fadeIn 0.5s ease 2.4s forwards;">
            © <span id="year"></span> IT Support Pivot • Gestion de Parc IT
        </p>
    </div>
</div>

<script src="{{asset('js/login.js')}}"></script>

</body>
</html>
