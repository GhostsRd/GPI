<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe - Gestion de Parc & Support</title>
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
            <h2>Créer un nouveau mot de passe</h2>
            <p>Veuillez définir votre nouveau mot de passe pour sécuriser votre compte utilisateur.</p>
        </div>
    </div>

    <div class="login-container">
        <div class="card">
            <div class="card-header">Nouveau mot de passe</div>

            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-container">
                        <i class="fas fa-envelope"></i>
                        <input id="email" type="email" placeholder="Adresse e-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    @error('email')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror

                    <div class="input-container">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" placeholder="Nouveau mot de passe" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    </div>
                    @error('password')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror

                    <div class="input-container">
                        <i class="fas fa-check-circle"></i>
                        <input id="password-confirm" type="password" placeholder="Confirmer le mot de passe" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <button type="submit" class="btn">
                        <i class="fas fa-save"></i> {{ __('Mettre à jour le mot de passe') }}
                    </button>
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
