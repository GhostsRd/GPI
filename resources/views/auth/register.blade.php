<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Gestion de Parc & Support</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --accent-light: #1a5f7a;
            --accent-secondary-light: #2a9d8f;
            --accent-hover-light: #21867a;

            /* Dark theme variables */
            --accent-dark: #1a5f7a;
            --accent-secondary-dark: #2a9d8f;
            --accent-hover-dark: #21867a;

            /* Common variables */
            --bg-primary-light: #f8f9fa;
            --bg-secondary-light: #ffffff;
            --text-primary-light: #212529;
            --text-secondary-light: #6c757d;
            --border-light: #dee2e6;
            --input-bg-light: #ffffff;
            --shadow-light: rgba(0, 0, 0, 0.08);
            --card-shadow-light: rgba(0, 0, 0, 0.1);

            --bg-primary-dark: #121212;
            --bg-secondary-dark: #1e1e1e;
            --text-primary-dark: #e6e6e6;
            --text-secondary-dark: #a0a0a0;
            --border-dark: #2d2d2d;
            --input-bg-dark: #2d2d2d;
            --shadow-dark: rgba(0, 0, 0, 0.3);
            --card-shadow-dark: rgba(0, 0, 0, 0.4);

            /* Current theme variables (default to light) */
            --bg-primary: var(--bg-primary-light);
            --bg-secondary: var(--bg-secondary-light);
            --text-primary: var(--text-primary-light);
            --text-secondary: var(--text-secondary-light);
            --accent: var(--accent-light);
            --accent-secondary: var(--accent-secondary-light);
            --accent-hover: var(--accent-hover-light);
            --border: var(--border-light);
            --input-bg: var(--input-bg-light);
            --shadow: var(--shadow-light);
            --card-shadow: var(--card-shadow-light);
        }

        [data-theme="dark"] {
            --bg-primary: var(--bg-primary-dark);
            --bg-secondary: var(--bg-secondary-dark);
            --text-primary: var(--text-primary-dark);
            --text-secondary: var(--text-secondary-dark);
            --accent: var(--accent-dark);
            --accent-secondary: var(--accent-secondary-dark);
            --accent-hover: var(--accent-hover-dark);
            --border: var(--border-dark);
            --input-bg: var(--input-bg-dark);
            --shadow: var(--shadow-dark);
            --card-shadow: var(--card-shadow-dark);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: background-color 0.3s, color 0.3s, border-color 0.3s, transform 0.3s, opacity 0.3s, box-shadow 0.3s;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            line-height: 1.6;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%238B5FBF' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 40px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease forwards;
        }

        .hero-section {
            flex: 1;
            min-width: 300px;
            max-width: 500px;
            padding: 20px;
            opacity: 0;
            transform: translateX(-30px);
            animation: slideInLeft 0.8s ease 0.3s forwards;
        }

        .app-logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            color: var(--accent);
            transform: translateY(-10px);
            opacity: 0;
            animation: fadeInDown 0.6s ease 0.5s forwards;
        }

        .app-logo i {
            font-size: 2.5rem;
            margin-right: 12px;
            transition: transform 0.5s ease;
        }

        .app-logo:hover i {
            transform: rotate(15deg) scale(1.1);
        }

        .app-logo h1 {
            font-weight: 700;
            font-size: 1.8rem;
        }

        .hero-content h2 {
            font-size: 2.2rem;
            margin-bottom: 20px;
            background: linear-gradient(90deg, var(--accent), var(--accent-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease 0.7s forwards;
        }

        .hero-content p {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease 0.9s forwards;
        }

        .features {
            margin-top: 30px;
        }

        .feature {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            opacity: 0;
            transform: translateX(-20px);
        }

        .feature:nth-child(1) {
            animation: slideInLeft 0.6s ease 1.1s forwards;
        }
        .feature:nth-child(2) {
            animation: slideInLeft 0.6s ease 1.3s forwards;
        }
        .feature:nth-child(3) {
            animation: slideInLeft 0.6s ease 1.5s forwards;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--accent), var(--accent-secondary));
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .login-container {
            flex: 1;
            min-width: 320px;
            max-width: 450px;
            opacity: 0;
            transform: translateX(30px);
            animation: slideInRight 0.8s ease 0.3s forwards;
        }

        .theme-switcher {
            position: fixed;
            top: 20px;
            right: 20px;
            background: var(--bg-secondary);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px var(--shadow);
            border: 1px solid var(--border);
            z-index: 10;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            animation: fadeIn 0.8s ease 0.5s forwards;
        }

        .theme-switcher:hover {
            transform: rotate(15deg) scale(1.1);
            box-shadow: 0 5px 15px var(--shadow);
        }

        .card {
            background-color: var(--bg-secondary);
            border-radius: 16px;
            box-shadow: 0 10px 30px var(--card-shadow);
            overflow: hidden;
            border: 1px solid var(--border);
            width: 100%;
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.8s ease 0.7s forwards;
        }

        .card-header {
            padding: 24px 32px 0;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text-primary);
            background-color: transparent;
        }

        .card-body {
            padding: 24px 32px 32px;
        }

        .input-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            background-color: var(--input-bg);
            border-radius: 12px;
            padding: 8px 16px;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            transform: translateY(10px);
            opacity: 0;
        }

        .input-container:nth-of-type(1) {
            animation: fadeInUp 0.5s ease 0.9s forwards;
        }
        .input-container:nth-of-type(2) {
            animation: fadeInUp 0.5s ease 1.0s forwards;
        }
        .input-container:nth-of-type(3) {
            animation: fadeInUp 0.5s ease 1.1s forwards;
        }
        .input-container:nth-of-type(4) {
            animation: fadeInUp 0.5s ease 1.2s forwards;
        }
        .input-container:nth-of-type(5) {
            animation: fadeInUp 0.5s ease 1.3s forwards;
        }
        .input-container:nth-of-type(6) {
            animation: fadeInUp 0.5s ease 1.4s forwards;
        }
        .input-container:nth-of-type(7) {
            animation: fadeInUp 0.5s ease 1.5s forwards;
        }
        .input-container:nth-of-type(8) {
            animation: fadeInUp 0.5s ease 1.6s forwards;
        }
        .input-container:nth-of-type(9) {
            animation: fadeInUp 0.5s ease 1.7s forwards;
        }

        .input-container:focus-within {
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(139, 95, 191, 0.2);
            transform: translateY(-2px);
        }

        .input-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px var(--shadow);
        }

        .input-container i {
            color: var(--text-secondary);
            margin-right: 12px;
            flex-shrink: 0;
            width: 20px;
            transition: color 0.3s ease;
        }

        .input-container:focus-within i {
            color: var(--accent);
        }

        .form-control {
            border: none;
            background: transparent;
            padding: 12px 0;
            width: 100%;
            color: var(--text-primary);
            font-size: 1rem;
            outline: none;
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        /* Styles pour l'upload d'image */
        .image-upload-container {
            margin-bottom: 20px;
            opacity: 0;
            animation: fadeInUp 0.5s ease 1.4s forwards;
        }

        .image-upload-label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .image-upload-wrapper {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .image-preview {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 2px solid var(--border);
            overflow: hidden;
            background-color: var(--input-bg);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .image-preview:hover {
            border-color: var(--accent);
            transform: scale(1.05);
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-preview i {
            font-size: 24px;
            color: var(--text-secondary);
        }

        .image-upload-input {
            flex: 1;
        }

        .image-upload-input input[type="file"] {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid var(--border);
            background-color: var(--input-bg);
            color: var(--text-primary);
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .image-upload-input input[type="file"]:hover {
            border-color: var(--accent);
        }

        .image-upload-input input[type="file"]:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(139, 95, 191, 0.2);
        }

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            opacity: 0;
            animation: fadeIn 0.5s ease 1.8s forwards;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            accent-color: var(--accent);
            cursor: pointer;
        }

        .form-check-label {
            color: var(--text-secondary);
            cursor: pointer;
        }

        .btn {
            background: linear-gradient(135deg, var(--accent), var(--accent-secondary));
            color: white;
            border: none;
            padding: 14px 28px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            width: 100%;
            margin-bottom: 15px;
            position: relative;
            overflow: hidden;
            opacity: 0;
            animation: fadeIn 0.5s ease 1.9s forwards;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(139, 95, 191, 0.4);
        }

        .btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(139, 95, 191, 0.4);
        }

        .login-link {
            color: var(--accent);
            text-decoration: none;
            font-size: 0.9rem;
            text-align: center;
            display: block;
            margin-top: 10px;
            transition: all 0.3s ease;
            opacity: 0;
            animation: fadeIn 0.5s ease 2.0s forwards;
        }

        .login-link:hover {
            text-decoration: underline;
            transform: translateY(-2px);
        }

        .invalid-feedback {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
        }

        .password-toggle {
            cursor: pointer;
            margin-left: 10px;
            color: var(--text-secondary);
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--accent);
        }

        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.3;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                gap: 20px;
            }

            .hero-section {
                min-width: auto;
                max-width: 100%;
                text-align: center;
            }

            .app-logo {
                justify-content: center;
            }

            .card-header, .card-body {
                padding: 20px;
            }

            .feature {
                justify-content: center;
            }

            .image-upload-wrapper {
                flex-direction: column;
                align-items: flex-start;
            }

            .image-preview {
                align-self: center;
            }
        }
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
            <h2>Créer un compte administrateur</h2>
            <p>Rejoignez notre plateforme de gestion de parc informatique et de support utilisateur pour une expérience de gestion IT complète.</p>

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
            <div class="card-header">S'inscrire</div>

            <div class="card-body">
                @if ($errors->any())
                    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Upload d'image de profil --}}
                    <div class="image-upload-container">
                        <label class="image-upload-label">Photo de profil</label>
                        <div class="image-upload-wrapper">
                            <div class="image-preview" id="imagePreview">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="image-upload-input">
                                <input type="file" id="photo" name="photo" accept="image/*" class="form-control">
                            </div>
                        </div>
                        @error('photo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    {{-- Nom d'utilisateur --}}
                    <div class="input-container">
                        <i class="fas fa-user"></i>
                        <input id="name" type="text" placeholder="Nom d'utilisateur"
                               class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    {{-- Email --}}
                    <div class="input-container">
                        <i class="fas fa-envelope"></i>
                        <input id="email" type="email" placeholder="Votre e-mail"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    {{-- Téléphone --}}
                    <div class="input-container">
                        <i class="fas fa-phone"></i>
                        <input id="phone" type="tel" placeholder="Numéro de téléphone"
                               class="form-control @error('phone') is-invalid @enderror"
                               name="phone" value="{{ old('phone') }}" required autocomplete="tel">
                    </div>
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    {{-- Poste --}}
                    <div class="input-container">
                        <i class="fas fa-briefcase"></i>
                        <input id="poste" type="text" placeholder="Poste"
                               class="form-control @error('poste') is-invalid @enderror"
                               name="poste" value="{{ old('poste') }}" required>
                    </div>
                    @error('poste')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    {{-- Lieu de travail --}}
                    <div class="input-container">
                        <i class="fas fa-map-marker-alt"></i>
                        <input id="lieu_travail" type="text" placeholder="Lieu de travail"
                               class="form-control @error('lieu_travail') is-invalid @enderror"
                               name="lieu_travail" value="{{ old('lieu_travail') }}" required>
                    </div>
                    @error('lieu_travail')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    {{-- Mot de passe --}}
                    <div class="input-container">
                        <i class="fas fa-lock"></i>
                        <input id="password" type="password" placeholder="Mot de passe"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password" required autocomplete="new-password">
                        <i class="fas fa-eye-slash password-toggle" id="togglePassword"></i>
                    </div>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    {{-- Confirmation mot de passe --}}
                    <div class="input-container">
                        <i class="fas fa-lock"></i>
                        <input id="password-confirm" type="password" placeholder="Confirmer mot de passe"
                               class="form-control" name="password_confirmation" required autocomplete="new-password">
                        <i class="fas fa-eye-slash password-toggle" id="togglePasswordConfirm"></i>
                    </div>

                    {{-- Case à cocher Conditions --}}
                    <div class="form-check mt-3 mb-3">
                        <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                        <label class="form-check-label" for="terms">
                            J'accepte les <a href="#">conditions d'utilisation</a>
                        </label>
                    </div>

                    {{-- Bouton --}}
                    <button type="submit" class="btn">
                        <i class="fas fa-user-plus"></i> Créer un compte
                    </button>

                    <a href="{{ route('login') }}" class="login-link">
                        Déjà un compte ? Connectez-vous ici
                    </a>
                </form>
            </div>
        </div>
        
        <p style="text-align: center; margin-top: 20px; color: var(--text-secondary); opacity: 0; animation: fadeIn 0.5s ease 2.1s forwards;">
            © <span id="year"></span> IT Support Pivot • Gestion de Parc IT
        </p>
    </div>
</div>

<script>
    // Create floating particles
    function createParticles() {
        const particlesContainer = document.getElementById('particles');
        const colors = ['#2647ae', '#d262da', '#7A4DAD', '#8B5FBF'];
        const particleCount = 15;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.classList.add('particle');

            const size = Math.random() * 20 + 5;
            const color = colors[Math.floor(Math.random() * colors.length)];

            particle.style.width = `${size}px`;
            particle.style.height = `${size}px`;
            particle.style.background = color;
            particle.style.left = `${Math.random() * 100}vw`;
            particle.style.top = `${Math.random() * 100}vh`;
            particle.style.animationDuration = `${Math.random() * 20 + 10}s`;
            particle.style.animationDelay = `${Math.random() * 5}s`;

            particlesContainer.appendChild(particle);
        }
    }

    createParticles();

    const themeSwitcher = document.getElementById('themeSwitcher');
    const htmlElement = document.documentElement;
    const themeIcon = themeSwitcher.querySelector('i');

    // Check for saved theme preference or respect OS preference
    const savedTheme = localStorage.getItem('theme') ||
        (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

    // Apply the saved theme
    htmlElement.setAttribute('data-theme', savedTheme);
    updateThemeIcon(savedTheme);

    themeSwitcher.addEventListener('click', () => {
        const currentTheme = htmlElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';

        htmlElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateThemeIcon(newTheme);

        // Add animation to theme switcher
        themeSwitcher.style.transform = 'scale(1.2)';
        setTimeout(() => {
            themeSwitcher.style.transform = '';
        }, 300);
    });

    function updateThemeIcon(theme) {
        if (theme === 'dark') {
            themeIcon.className = 'fas fa-sun';
        } else {
            themeIcon.className = 'fas fa-moon';
        }
    }

    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
    const passwordConfirm = document.getElementById('password-confirm');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Toggle the icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');

        // Add animation
        this.style.transform = 'scale(1.2)';
        setTimeout(() => {
            this.style.transform = '';
        }, 200);
    });

    togglePasswordConfirm.addEventListener('click', function () {
        // Toggle the type attribute
        const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirm.setAttribute('type', type);

        // Toggle the icon
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');

        // Add animation
        this.style.transform = 'scale(1.2)';
        setTimeout(() => {
            this.style.transform = '';
        }, 200);
    });

    // Gestion de l'upload d'image
    const profileImageInput = document.getElementById('photo');
    const imagePreview = document.getElementById('imagePreview');

    profileImageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            
            reader.addEventListener('load', function() {
                imagePreview.innerHTML = `<img src="${this.result}" alt="Aperçu de la photo de profil">`;
                imagePreview.style.borderColor = 'var(--accent)';
            });
            
            reader.readAsDataURL(file);
        }
    });

    // Permet de cliquer sur l'aperçu pour sélectionner un fichier
    imagePreview.addEventListener('click', function() {
        profileImageInput.click();
    });

    // Add hover effect to input containers
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            input.parentElement.style.transform = 'translateY(-2px)';
            input.parentElement.style.boxShadow = '0 5px 15px var(--shadow)';
        });

        input.addEventListener('blur', () => {
            input.parentElement.style.transform = '';
            input.parentElement.style.boxShadow = '';
        });
    });

    // Set current year in footer
    document.getElementById("year").textContent = new Date().getFullYear();
</script>
</body>
</html>