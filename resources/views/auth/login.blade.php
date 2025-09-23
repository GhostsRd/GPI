<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion de Parc & Support</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Pivot theme variables - Bleu/Vert inspiré de l'image */
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
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%231a5f7a' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            overflow-x: hidden;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 40px;
            max-width: 1200px;
            width: 100%;
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

        .input-container:nth-child(1) {
            animation: fadeInUp 0.5s ease 0.9s forwards;
        }
        .input-container:nth-child(2) {
            animation: fadeInUp 0.5s ease 1.0s forwards;
        }

        .input-container:nth-child(3) {
            animation: fadeInUp 0.5s ease 0.9s forwards;
        }
        .input-container:nth-child(4) {
            animation: fadeInUp 0.5s ease 1.0s forwards;
        }

        .input-container:focus-within {
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(26, 95, 122, 0.2);
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

        .form-check {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            opacity: 0;
            animation: fadeIn 0.5s ease 1.1s forwards;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            accent-color: var(--accent);
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .form-check-input:hover {
            transform: scale(1.1);
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
            animation: fadeIn 0.5s ease 1.2s forwards;
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
            box-shadow: 0 8px 20px rgba(26, 95, 122, 0.4);
        }

        .btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(26, 95, 122, 0.4);
        }

        .forgot-link {
            color: var(--accent);
            text-decoration: none;
            font-size: 0.9rem;
            text-align: center;
            display: block;
            margin-top: 10px;
            transition: all 0.3s ease;
            opacity: 0;
            animation: fadeIn 0.5s ease 1.3s forwards;
        }

        .forgot-link:hover {
            text-decoration: underline;
            transform: translateY(-2px);
        }

        .invalid-feedback {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 20px 0;
            color: var(--text-secondary);
            opacity: 0;
            animation: fadeIn 0.5s ease 1.4s forwards;
        }

        .divider::before, .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background-color: var(--border);
        }

        .divider span {
            padding: 0 15px;
            font-size: 0.9rem;
        }

        .social-login {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
            opacity: 0;
            animation: fadeIn 0.5s ease 1.5s forwards;
        }

        .social-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .social-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--accent), var(--accent-secondary));
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 50%;
        }

        .social-btn i {
            position: relative;
            z-index: 1;
            transition: color 0.3s ease;
        }

        .social-btn:hover::before {
            opacity: 1;
        }

        .social-btn:hover {
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 5px 15px var(--shadow);
        }

        .social-btn:hover i {
            color: white;
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

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
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

                    <div class="input-container">
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
                        <a href="{{ route('register') }}" style="color: var(--accent); font-weight: 600; text-decoration: none;">
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

<script>
    // Create floating particles with Pivot colors
    function createParticles() {
        const particlesContainer = document.getElementById('particles');
        const colors = ['#1a5f7a', '#2a9d8f', '#21867a', '#264653'];
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

    // Add animation to social buttons on hover
    const socialBtns = document.querySelectorAll('.social-btn');
    socialBtns.forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.1)';
        });

        btn.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Set current year in footer
    document.getElementById("year").textContent = new Date().getFullYear();
</script>
</body>
</html>
