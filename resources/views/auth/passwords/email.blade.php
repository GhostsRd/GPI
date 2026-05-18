<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - Gestion de Parc & Support</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <style>
        :root { --accent: #5BC4BF; --text-secondary: #666; }
        .theme-switcher i { color: var(--accent); }
        .btn { background-color: var(--accent); border-color: var(--accent); color: white; width: 100%; margin-top: 15px;}
        .btn:hover { background-color: #4aa39e; color: white;}
        a { color: var(--accent) !important; }
        .input-container { margin-bottom: 15px; position: relative; }
        .input-container i { color: var(--accent); position: absolute; left: 15px; top: 15px;}
        .input-container input { padding-left: 45px !important; }
        .input-container input:focus { border-color: var(--accent); }
        .invalid-feedback { color: #e3342f; font-size: 80%; display: block; margin-top: 5px; text-align: left; }
        .alert-success { background-color: #d4edda; border-color: #c3e6cb; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; font-size: 0.9rem;}
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
            <img src="{{ asset('images/logoPivot.png') }}" alt="Logo IT Support Pivot" style="width: 60px; height: auto;">
            <h1>IT Support Pivot</h1>
        </div>

        <div class="hero-content">
            <h2>Mot de passe oublié ?</h2>
            <p>Pas d'inquiétude ! Entrez votre adresse e-mail professionnelle et nous vous enverrons un lien sécurisé pour créer un nouveau mot de passe.</p>
        </div>
    </div>

    <div class="login-container">
        <div class="card">
            <div class="card-header">Réinitialisation</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert-success" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="input-container">
                        <i class="fas fa-envelope"></i>
                        <input id="email" type="email" placeholder="Adresse e-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror

                    <button type="submit" class="btn">
                        <i class="fas fa-paper-plane"></i> {{ __('Envoyer le lien de réinitialisation') }}
                    </button>
                    
                    <p style="text-align: center; margin-top: 20px;">
                        <a href="{{ url('/utilisateur-login') }}" style="color: var(--text-secondary) !important; font-size: 0.9rem;">
                            <i class="fas fa-arrow-left"></i> Retour à la connexion
                        </a>
                    </p>
                </form>
            </div>
        </div>

        <p style="text-align: center; margin-top: 20px; color: var(--text-secondary);">
            © <span id="year"></span> IT Support Pivot • Gestion de Parc IT
        </p>
    </div>
</div>
<script src="{{asset('js/login.js')}}"></script>
<script>
    document.getElementById('year').textContent = new Date().getFullYear();
</script>
</body>
</html>
