<!DOCTYPE html>
<html lang="fr" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Support Pivot - Créer un compte</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #5BC4BF;
            --primary-dark: #4AA39E;
            --primary-light: #7FD9D4;
            --primary-soft: rgba(91, 196, 191, 0.1);
            --bg-body: #F8FAFC;
            --bg-card: rgba(255, 255, 255, 0.75);
            --text-main: #1E293B;
            --text-secondary: #64748B;
            --border-color: rgba(226, 232, 240, 0.8);
            --glass-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
            --accent-gradient: linear-gradient(135deg, #5BC4BF 0%, #4AA39E 100%);
        }

        [data-theme="dark"] {
            --bg-body: #0F172A;
            --bg-card: rgba(30, 41, 59, 0.7);
            --text-main: #F1F5F9;
            --text-secondary: #94A3B8;
            --border-color: rgba(51, 65, 85, 0.8);
            --glass-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            overflow-x: hidden;
            position: relative;
        }

        /* Ambient Background shapes */
        .bg-blob {
            position: fixed;
            width: 600px;
            height: 600px;
            background: var(--primary);
            filter: blur(140px);
            opacity: 0.12;
            border-radius: 50%;
            z-index: -1;
            pointer-events: none;
            animation: move 25s infinite alternate;
        }

        .bg-blob-1 { top: -150px; left: -150px; }
        .bg-blob-2 { bottom: -150px; right: -150px; animation-delay: -7s; }

        @keyframes move {
            0% { transform: scale(1) translate(0, 0); }
            100% { transform: scale(1.3) translate(150px, 150px); }
        }

        .container {
            width: 100%;
            max-width: 1200px;
            display: grid;
            grid-template-columns: 1fr 700px;
            gap: 60px;
            align-items: center;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s ease forwards;
        }

        /* Hero Section Styling */
        .hero-section {
            padding-right: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 40px;
        }

        .brand img {
            width: 50px;
            height: auto;
            filter: drop-shadow(0 5px 15px rgba(91, 196, 191, 0.3));
        }

        .brand h1 {
            font-size: 1.8rem;
            font-weight: 800;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero-title {
            font-size: 2.75rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 24px;
            letter-spacing: -1px;
        }

        .hero-description {
            font-size: 1.1rem;
            color: var(--text-secondary);
            margin-bottom: 40px;
            line-height: 1.6;
        }

        .steps-info {
            display: grid;
            gap: 24px;
        }

        .step-item {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .step-number {
            width: 40px;
            height: 40px;
            background: var(--primary);
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            flex-shrink: 0;
            box-shadow: 0 5px 15px rgba(91, 196, 191, 0.3);
        }

        .step-text {
            font-weight: 600;
            font-size: 1.05rem;
        }

        /* Modern Glass Card */
        .signup-card {
            background: var(--bg-card);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid var(--border-color);
            border-radius: 32px;
            padding: 48px;
            box-shadow: var(--glass-shadow);
        }

        .card-title {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .card-subtitle {
            color: var(--text-secondary);
            margin-bottom: 40px;
            font-size: 0.95rem;
        }

        /* Profile Upload Styling */
        .profile-upload-section {
            display: flex;
            align-items: center;
            gap: 24px;
            margin-bottom: 40px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 20px;
            border: 1px dashed var(--border-color);
        }

        [data-theme="dark"] .profile-upload-section {
            background: rgba(15, 23, 42, 0.4);
        }

        .avatar-preview {
            width: 80px;
            height: 80px;
            border-radius: 24px;
            background: var(--primary-soft);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 2rem;
            overflow: hidden;
            border: 2px solid white;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
            flex-shrink: 0;
            cursor: pointer;
        }

        .avatar-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .upload-info h4 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .upload-info p {
            font-size: 0.85rem;
            color: var(--text-secondary);
        }

        /* Form Grid */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        .field-group {
            position: relative;
        }

        .full-width {
            grid-column: span 2;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
            background: var(--bg-card);
            border: 2px solid var(--border-color);
            border-radius: 16px;
            padding: 0 16px;
            height: 56px;
        }

        .input-wrapper:focus-within {
            border-color: var(--primary);
            background: white;
            box-shadow: 0 10px 20px rgba(91, 196, 191, 0.05);
        }

        [data-theme="dark"] .input-wrapper:focus-within {
            background: #1E293B;
        }

        .input-wrapper i.prefix-icon {
            font-size: 1rem;
            color: var(--text-secondary);
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .input-wrapper:focus-within i.prefix-icon {
            color: var(--primary);
        }

        .input-field {
            width: 100%;
            border: none;
            background: transparent;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-main);
            outline: none;
        }

        .input-field::placeholder {
            color: var(--text-secondary);
            font-weight: 400;
        }

        select.input-field {
            cursor: pointer;
            appearance: none;
        }

        /* Select Arrow */
        .select-wrapper::after {
            content: "\f078";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.8rem;
            color: var(--text-secondary);
            pointer-events: none;
        }

        .password-toggle {
            cursor: pointer;
            color: var(--text-secondary);
            padding: 8px;
        }

        /* Checks */
        .check-group {
            display: grid;
            gap: 12px;
            margin-bottom: 32px;
        }

        .check-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            cursor: pointer;
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .check-item input {
            accent-color: var(--primary);
            width: 18px;
            height: 18px;
            margin-top: 2px;
        }

        .check-item a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
        }

        /* Buttons */
        .submit-btn {
            width: 100%;
            height: 60px;
            background: var(--accent-gradient);
            color: white;
            border: none;
            border-radius: 16px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 0 10px 25px rgba(91, 196, 191, 0.2);
            margin-bottom: 24px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 35px rgba(91, 196, 191, 0.3);
        }

        .login-prompt {
            text-align: center;
            font-size: 0.95rem;
            color: var(--text-secondary);
        }

        .login-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 700;
        }

        /* Theme Toggle */
        .theme-toggle {
            position: fixed;
            top: 32px;
            right: 32px;
            width: 48px;
            height: 48px;
            background: var(--bg-card);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 100;
            color: var(--primary);
            font-size: 1.2rem;
        }

        /* Alerts */
        .alert {
            padding: 16px;
            border-radius: 16px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            color: #EF4444;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .invalid-feedback {
            color: #EF4444;
            font-size: 0.75rem;
            margin-top: 5px;
            font-weight: 600;
            padding-left: 4px;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Mobile */
        @media (max-width: 1100px) {
            .container { grid-template-columns: 1fr; max-width: 700px; }
            .hero-section { text-align: center; padding-right: 0; }
            .brand { justify-content: center; }
            .hero-title { font-size: 2.25rem; }
            .steps-info { display: none; }
        }

        @media (max-width: 600px) {
            .form-grid { grid-template-columns: 1fr; }
            .full-width { grid-column: span 1; }
            .signup-card { padding: 32px 24px; }
        }
    </style>
</head>
<body>
    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>

    <div class="theme-toggle" id="themeSwitcher">
        <i class="fas fa-moon"></i>
    </div>

    <div class="container">
        <!-- Hero Section -->
        <div class="hero-section">
            <div class="brand">
                <img src="{{ asset('images/logoPivot.png') }}" alt="Pivot Logo">
                <h1>IT Support Pivot</h1>
            </div>

            <h2 class="hero-title">Rejoignez l'Écosystème Digital.</h2>
            <p class="hero-description">
                Créez votre accès personnel pour gérer vos équipements, soumettre des incidents et accéder aux ressources IT de l'entreprise.
            </p>

            <div class="steps-info">
                <div class="step-item">
                    <div class="step-number">1</div>
                    <div class="step-text">Complétez votre profil professionnel</div>
                </div>
                <div class="step-item">
                    <div class="step-number">2</div>
                    <div class="step-text">Validez votre adresse e-mail RH</div>
                </div>
                <div class="step-item">
                    <div class="step-number">3</div>
                    <div class="step-text">Accédez à votre espace sécurisé</div>
                </div>
            </div>
        </div>

        <!-- Signup Card -->
        <div class="signup-card">
            <h2 class="card-title">Inscription</h2>
            <p class="card-subtitle">Veuillez remplir les informations ci-dessous.</p>

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-circle-exclamation"></i>
                    <span>Erreur dans le formulaire</span>
                </div>
            @endif

            <form method="POST" action="{{ route('userinscription') }}" enctype="multipart/form-data">
                @csrf

                <!-- Profile Photo -->
                <div class="profile-upload-section">
                    <div class="avatar-preview" id="imagePreview" onclick="document.getElementById('photo').click()">
                        <i class="fas fa-camera"></i>
                    </div>
                    <div class="upload-info">
                        <h4>Photo de profil</h4>
                        <p>JPEG, PNG jusqu'à 2MB</p>
                        <input type="file" id="photo" name="photo" accept="image/*" style="display: none;" onchange="previewImage(this)">
                    </div>
                </div>

                <div class="form-grid">
                    <!-- Nom -->
                    <div class="field-group">
                        <div class="input-wrapper">
                            <i class="fas fa-user prefix-icon"></i>
                            <input type="text" name="nom" value="{{ old('nom') }}" class="input-field" placeholder="Nom complet" required autofocus>
                        </div>
                        @error('nom') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Email -->
                    <div class="field-group">
                        <div class="input-wrapper">
                            <i class="fas fa-envelope prefix-icon"></i>
                            <input type="email" name="email" value="{{ old('email') }}" class="input-field" placeholder="Email pro" required>
                        </div>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Téléphone -->
                    <div class="field-group">
                        <div class="input-wrapper">
                            <i class="fas fa-phone prefix-icon"></i>
                            <input type="tel" name="telephone" value="{{ old('telephone') }}" class="input-field" placeholder="Téléphone" required>
                        </div>
                        @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Date Naissance -->
                    <div class="field-group">
                        <div class="input-wrapper">
                            <i class="fas fa-calendar prefix-icon"></i>
                            <input type="date" name="date_naissance" value="{{ old('date_naissance') }}" class="input-field" required>
                        </div>
                        @error('date_naissance') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Poste -->
                    <div class="field-group">
                        <div class="input-wrapper">
                            <i class="fas fa-briefcase prefix-icon"></i>
                            <input type="text" name="poste" value="{{ old('poste') }}" class="input-field" placeholder="Poste" required>
                        </div>
                        @error('poste') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Lieu d'Affectation -->
                    <div class="field-group">
                        <div class="input-wrapper">
                            <i class="fas fa-location-dot prefix-icon"></i>
                            <input type="text" name="lieu_affectation" value="{{ old('lieu_affectation') }}" class="input-field" placeholder="Lieu d'affectation" required>
                        </div>
                        @error('lieu_affectation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Date d'Embauche -->
                    <div class="field-group">
                        <div class="input-wrapper">
                            <i class="fas fa-calendar-check prefix-icon"></i>
                            <input type="date" name="date_embauche" value="{{ old('date_embauche') }}" class="input-field" required title="Date d'embauche">
                        </div>
                        @error('date_embauche') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Département -->
                    <div class="field-group select-wrapper">
                        <div class="input-wrapper">
                            <i class="fas fa-building prefix-icon"></i>
                            <select name="departement" class="input-field" required>
                                <option value="" hidden>Département</option>
                                <option value="IT" {{ old('departement') == 'IT' ? 'selected' : '' }}>Informatique</option>
                                <option value="RH" {{ old('departement') == 'RH' ? 'selected' : '' }}>Ressources Humaines</option>
                                <option value="Finance" {{ old('departement') == 'Finance' ? 'selected' : '' }}>Finance</option>
                                <option value="Medicale" {{ old('departement') == 'Medicale' ? 'selected' : '' }}>Médical</option>
                            </select>
                        </div>
                        @error('departement') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Sexe -->
                    <div class="field-group select-wrapper">
                        <div class="input-wrapper">
                            <i class="fas fa-venus-mars prefix-icon"></i>
                            <select name="sexe" class="input-field" required>
                                <option value="" hidden>Sexe</option>
                                <option value="Homme" {{ old('sexe') == 'Homme' ? 'selected' : '' }}>Homme</option>
                                <option value="Femme" {{ old('sexe') == 'Femme' ? 'selected' : '' }}>Femme</option>
                            </select>
                        </div>
                        @error('sexe') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Adresse -->
                    <div class="field-group full-width">
                        <div class="input-wrapper">
                            <i class="fas fa-map-location-dot prefix-icon"></i>
                            <input type="text" name="adresse" value="{{ old('adresse') }}" class="input-field" placeholder="Adresse complète" required>
                        </div>
                        @error('adresse') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Password -->
                    <div class="field-group">
                        <div class="input-wrapper">
                            <i class="fas fa-lock prefix-icon"></i>
                            <input type="password" id="password" name="password" class="input-field" placeholder="Mot de passe" required>
                            <i class="fas fa-eye-slash password-toggle" onclick="togglePass('password', this)"></i>
                        </div>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="field-group">
                        <div class="input-wrapper">
                            <i class="fas fa-shield-check prefix-icon"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" placeholder="Confirmer" required>
                            <i class="fas fa-eye-slash password-toggle" onclick="togglePass('password_confirmation', this)"></i>
                        </div>
                    </div>
                </div>

                <div class="check-group">
                    <label class="check-item">
                        <input type="checkbox" name="terms" required>
                        <span>J'accepte les <a href="#">conditions d'utilisation</a></span>
                    </label>
                </div>

                <button type="submit" class="submit-btn">
                    <span>Finaliser l'inscription</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

                <p class="login-prompt">
                    Déjà membre ? <a href="{{ route('LoginUser') }}" class="login-link">Connectez-vous</a>
                </p>
            </form>

            <p style="text-align: center; margin-top: 40px; color: var(--text-secondary); font-size: 0.8rem;">
                © <span id="year"></span> IT Support Pivot • Registration Secure 256-bit
            </p>
        </div>
    </div>

    <script>
        document.getElementById('year').textContent = new Date().getFullYear();

        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}">`;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function togglePass(id, btn) {
            const input = document.getElementById(id);
            const type = input.type === 'password' ? 'text' : 'password';
            input.type = type;
            btn.classList.toggle('fa-eye');
            btn.classList.toggle('fa-eye-slash');
        }

        // Theme Switcher
        const themeSwitcher = document.getElementById('themeSwitcher');
        const html = document.documentElement;
        const themeIcon = themeSwitcher.querySelector('i');

        const savedTheme = localStorage.getItem('theme') || 'light';
        html.setAttribute('data-theme', savedTheme);
        updateThemeIcon(savedTheme);

        themeSwitcher.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);
        });

        function updateThemeIcon(theme) {
            if (theme === 'dark') {
                themeIcon.classList.replace('fa-moon', 'fa-sun');
            } else {
                themeIcon.classList.replace('fa-sun', 'fa-moon');
            }
        }
    </script>
</body>
</html>
