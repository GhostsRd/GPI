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
            <h2>Gestion de Parc & Support Utilisateur</h2>
            <p>Connectez-vous à votre espace administrateur pour gérer votre parc informatique, suivre les demandes de support et superviser l'infrastructure IT.</p>

            <div class="features">
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <div>
                        <h3>Gestion centralisée</h3>
                        <p>Supervisez l'ensemble de votre parc informatique</p>
                    </div>
                </div>

                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div>
                        <h3>Support technique</h3>
                        <p>Gérez les demandes d'assistance utilisateur</p>
                    </div>
                </div>

                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div>
                        <h3>Sécurité avancée</h3>
                        <p>Protégez vos données et votre infrastructure</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="login-container">
        <div class="card">
            <div class="card-header">Connexion</div>

            <div class="card-body ">
                <form method="POST" action="{{ route('verifierlogin') }}">
                    @csrf

                    <div class="input-container">
                        <i class="fas fa-envelope"></i>
                        <input id="email" type="email" placeholder="Adresse e-mail professionnelle" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                    <br>
                    <div class="input-container ">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" placeholder="Mot de passe" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <i class="fas fa-eye-slash password-toggle" id="togglePassword"></i>
                    </div>
                    @error('password')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Se souvenir de moi') }}
                        </label>
                    </div>

                    <button type="submit" class="btn">
                        <i class="fas fa-sign-in-alt"></i> {{ __('Se connecter') }}
                    </button>

                    <p style="text-align: center; margin-top: 15px; opacity: 0; animation: fadeIn 0.5s ease 1.3s forwards;">
                        Pas encore de compte ?
                        <a href="{{ route('utilisateurInscription') }}" style="color: var(--accent); font-weight: 600; text-decoration: none;">
                            Créez un compte
                        </a>
                    </p>

                    <div class="divider">
                        <span>Ou continuer avec</span>
                    </div>

                    <div class="social-login">
                        <div class="social-btn">
                            <i class="fab fa-microsoft"></i>
                        </div>
                        <div class="social-btn">
                            <i class="fab fa-google"></i>
                        </div>
                        <div class="social-btn">
                            <i class="fab fa-apple"></i>
                        </div>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié ?') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <p style="text-align: center; margin-top: 20px; color: var(--text-secondary); opacity: 0; animation: fadeIn 0.5s ease 1.6s forwards;">
            © <span id="year"></span> IT Support Pivot • Gestion de Parc IT
        </p>
    </div>
</div>
<script src="{{asset('js/login.js')}}"></script>

</body>
</html>
