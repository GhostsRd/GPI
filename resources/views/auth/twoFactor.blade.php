<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification 2FA - GPI</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            /* Pivot theme variables - Bleu/Vert */
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

            /* Current theme variables */
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
            line-height: 1.5;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%231a5f7a' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            overflow-x: hidden;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 30px;
            max-width: 1100px;
            width: 100%;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease forwards;
        }

        .hero-section {
            flex: 1;
            min-width: 280px;
            max-width: 450px;
            padding: 15px;
            opacity: 0;
            transform: translateX(-30px);
            animation: slideInLeft 0.8s ease 0.3s forwards;
        }

        .app-logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            color: var(--accent);
            transform: translateY(-10px);
            opacity: 0;
            animation: fadeIn 0.8s ease 0.5s forwards;
        }

        .app-logo i {
            font-size: 2rem;
            margin-right: 10px;
            transition: transform 0.5s ease;
        }

        .app-logo h1 {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .hero-content h2 {
            font-size: 1.6rem;
            margin-bottom: 12px;
            background: linear-gradient(90deg, var(--accent), var(--accent-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease 0.7s forwards;
        }

        .hero-content p {
            font-size: 0.85rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease 0.9s forwards;
            color: var(--text-secondary);
        }

        .features {
            margin-top: 20px;
        }

        .feature {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
            opacity: 0;
            transform: translateX(-20px);
        }

        .feature:nth-child(1) { animation: slideInLeft 0.5s ease 1.1s forwards; }
        .feature:nth-child(2) { animation: slideInLeft 0.5s ease 1.2s forwards; }
        .feature:nth-child(3) { animation: slideInLeft 0.5s ease 1.3s forwards; }

        .feature-icon {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, var(--accent), var(--accent-secondary));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            color: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-icon i {
            font-size: 0.9rem;
        }

        .feature:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .feature h3 {
            font-size: 0.9rem;
            margin-bottom: 2px;
        }

        .feature p {
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .login-container {
            flex: 1;
            min-width: 300px;
            max-width: 400px;
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
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 2px 10px var(--shadow);
            border: 1px solid var(--border);
            z-index: 1000;
            color: var(--text-primary);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            opacity: 0;
            animation: fadeIn 0.8s ease 0.5s forwards;
        }

        .theme-switcher i {
            font-size: 0.9rem;
        }

        .theme-switcher:hover {
            transform: rotate(15deg) scale(1.1);
            box-shadow: 0 5px 15px var(--shadow);
        }

        .card {
            background-color: var(--bg-secondary);
            border-radius: 12px;
            box-shadow: 0 8px 25px var(--card-shadow);
            overflow: hidden;
            border: 1px solid var(--border);
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.8s ease 0.7s forwards;
        }

        .card-header {
            padding: 18px 24px 0;
            font-weight: 700;
            font-size: 1.2rem;
            color: var(--text-primary);
            background-color: transparent;
        }

        .card-body {
            padding: 18px 24px 24px;
        }

        .input-container {
            display: flex;
            align-items: center;
            margin-bottom: 14px;
            background-color: var(--input-bg);
            border-radius: 8px;
            padding: 6px 14px;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            transform: translateY(10px);
            opacity: 0;
            animation: fadeInUp 0.5s ease 0.9s forwards;
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
            margin-right: 10px;
            flex-shrink: 0;
            width: 16px;
            font-size: 0.85rem;
            transition: color 0.3s ease;
        }

        .input-container:focus-within i {
            color: var(--accent);
        }

        .form-control {
            border: none;
            background: transparent;
            padding: 8px 0;
            width: 100%;
            color: var(--text-primary);
            font-size: 1rem;
            outline: none;
            letter-spacing: 4px;
            text-align: center;
            font-weight: bold;
        }

        .form-control::placeholder {
            color: var(--text-secondary);
            font-size: 0.85rem;
            letter-spacing: normal;
            font-weight: normal;
        }

        .btn {
            background: linear-gradient(135deg, var(--accent), var(--accent-secondary));
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            width: 100%;
            text-align: center;
            text-decoration: none;
            margin-bottom: 12px;
            position: relative;
            overflow: hidden;
            opacity: 0;
            animation: fadeInUp 0.5s ease 1.1s forwards;
        }

        .btn i {
            font-size: 0.85rem;
            margin-right: 6px;
        }

        .btn:hover {
            background: linear-gradient(135deg, var(--accent-hover), var(--accent-secondary));
            box-shadow: 0 5px 15px var(--shadow);
            transform: translateY(-2px);
        }

        .btn:active {
            transform: translateY(0);
        }

        .status-alert {
            background-color: rgba(42, 157, 143, 0.1);
            border: 1px solid rgba(42, 157, 143, 0.2);
            color: var(--accent-secondary);
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.75rem;
            margin-bottom: 14px;
            opacity: 0;
            animation: fadeIn 0.5s ease 0.8s forwards;
        }

        .invalid-feedback {
            color: #e74c3c;
            font-size: 0.7rem;
            margin-top: 4px;
            margin-bottom: 8px;
            text-align: center;
        }

        .resend-link {
            color: var(--accent);
            text-decoration: none;
            font-size: 0.75rem;
            text-align: center;
            display: block;
            margin-top: 8px;
            transition: all 0.3s ease;
            opacity: 0;
            animation: fadeIn 0.5s ease 1.3s forwards;
            background: none;
            border: none;
            width: 100%;
            cursor: pointer;
        }

        .resend-link:hover {
            color: var(--accent-secondary);
            text-decoration: underline;
        }

        .footer-text {
            text-align: center;
            margin-top: 16px;
            color: var(--text-secondary);
            font-size: 0.7rem;
            opacity: 0;
            animation: fadeIn 0.5s ease 1.6s forwards;
        }

        /* Floating particles with custom colors */
        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            overflow: hidden;
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
                opacity: 0.3;
            }
            50% {
                opacity: 0.6;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Animations */
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

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
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

        /* Responsiveness */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                gap: 15px;
            }

            .hero-section {
                text-align: center;
                max-width: 100%;
            }

            .app-logo {
                justify-content: center;
            }

            .feature {
                text-align: left;
            }

            .card-header, .card-body {
                padding: 15px 20px;
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
            <img src="{{ asset('images/logoPivot.png') }}" alt="Logo Pivot" style="width: 60px; height: auto;">
            <h1>GPI</h1>
        </div>

        <div class="hero-content">
            <h2>Double Authentification</h2>
            <p>Pour assurer la sécurité de votre compte, un code de validation est requis.</p>

            <div class="features">
                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                    <div>
                        <h3>Code par e-mail</h3>
                        <p>Un e-mail contenant un code à 6 chiffres vous a été envoyé.</p>
                    </div>
                </div>

                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h3>Validité temporaire</h3>
                        <p>Le code expire après 10 minutes par mesure de sécurité.</p>
                    </div>
                </div>

                <div class="feature">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div>
                        <h3>Protection renforcée</h3>
                        <p>Empêche les accès non autorisés à votre tableau de bord.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="login-container">
        <div class="card">
            <div class="card-header">Validation 2FA</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="status-alert" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('verify.store') }}">
                    @csrf

                    <div class="input-container">
                        <i class="fas fa-key"></i>
                        <input id="code" type="text" placeholder="Code à 6 chiffres" 
                               class="form-control @error('code') is-invalid @enderror" 
                               name="code" required autocomplete="off" autofocus maxlength="6">
                    </div>
                    @error('code')
                    <div class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror

                    <button type="submit" class="btn">
                        <i class="fas fa-check-circle"></i> Vérifier le code
                    </button>
                </form>

                <form id="resend-form" method="POST" action="{{ route('verify.resend') }}" style="display: none;">
                    @csrf
                </form>

                <button type="button" class="resend-link" onclick="event.preventDefault(); document.getElementById('resend-form').submit();">
                    <i class="fas fa-redo-alt me-1"></i> Renvoyer un nouveau code
                </button>
            </div>
        </div>

        <div class="footer-text">
            © <span id="year"></span> GPI • Gestion de Parc Informatique
        </div>
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

            const size = Math.random() * 15 + 4;
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

    // Set current year in footer
    document.getElementById("year").textContent = new Date().getFullYear();
</script>
</body>
</html>
