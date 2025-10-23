<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Utilisateur - Gestion de Parc & Support</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <style>
        /* Styles pour l'upload d'image */
        .image-upload-container {
            margin-bottom: 25px;
            opacity: 0;
            animation: fadeInUp 0.5s ease 0.9s forwards;
        }

        .image-upload-label {
            display: block;
            margin-bottom: 10px;
            color: var(--text-primary);
            font-weight: 600;
            font-size: 1rem;
        }

        .image-upload-wrapper {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            flex-wrap: wrap;
        }

        .image-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 2px solid var(--border);
            overflow: hidden;
            background: linear-gradient(135deg, var(--accent), var(--accent-secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .image-preview:hover {
            border-color: var(--accent);
            transform: scale(1.05);
            box-shadow: 0 5px 15px var(--shadow);
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .image-preview i {
            font-size: 32px;
            color: white;
        }

        .image-upload-input {
            flex: 1;
            min-width: 200px;
        }

        .image-upload-input input[type="file"] {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid var(--border);
            background-color: var(--input-bg);
            color: var(--text-primary);
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 8px;
        }

        .image-upload-input input[type="file"]:hover {
            border-color: var(--accent);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px var(--shadow);
        }

        .image-upload-input input[type="file"]:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(139, 95, 191, 0.2);
        }

        .image-upload-input small {
            color: var(--text-secondary);
            font-size: 0.8rem;
            display: block;
            margin-top: 5px;
        }

        @media (max-width: 768px) {
            .image-upload-wrapper {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .image-preview {
                margin-bottom: 15px;
            }
            
            .image-upload-input {
                width: 100%;
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
                <form method="POST" action="{{ route('userinscription') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Section Upload Photo de Profil -->
                    <div class="image-upload-container">
                        <label class="image-upload-label">Photo de profil</label>
                        <div class="image-upload-wrapper">
                            <div class="image-preview" id="imagePreview">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="image-upload-input">
                                <input type="file" id="profile_image" name="profile_image" accept="image/*" class="form-control">
                                <small>
                                    Formats acceptés: JPEG, PNG, JPG, GIF • Max: 2MB
                                </small>
                            </div>
                        </div>
                        @error('profile_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

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
                                <input id="poste" type="text" placeholder="Poste occupé"
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
                                <select id="departement" class="form-control @error('departement') is-invalid @enderror" name="departement" required>
                                    <option value="">Sélectionnez votre département</option>
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
                                <input id="adresse" type="text" placeholder="Adresse"
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
                                <i class="fas fa-user-tag"></i>
                                <select id="sexe" class="form-control @error('sexe') is-invalid @enderror" name="sexe" required>
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
                                <input id="lieu_affectation" type="text" placeholder="Lieu de travail"
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
                                <input id="password" type="password" placeholder="Mot de passe"
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

                    <a href="{{ route('LoginUser') }}" class="login-link">
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

<script>
    // Gestion de l'upload d'image
    const profileImageInput = document.getElementById('profile_image');
    const imagePreview = document.getElementById('imagePreview');

    profileImageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            // Vérifier la taille du fichier (2MB max)
            if (file.size > 2 * 1024 * 1024) {
                alert('Le fichier est trop volumineux. Taille maximum: 2MB');
                this.value = '';
                return;
            }

            // Vérifier le type de fichier
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            if (!validTypes.includes(file.type)) {
                alert('Format de fichier non supporté. Utilisez JPEG, PNG, JPG ou GIF.');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            
            reader.addEventListener('load', function() {
                imagePreview.innerHTML = `<img src="${this.result}" alt="Aperçu de la photo de profil">`;
                imagePreview.style.borderColor = 'var(--accent)';
                
                // Animation de confirmation
                imagePreview.style.transform = 'scale(1.1)';
                setTimeout(() => {
                    imagePreview.style.transform = 'scale(1)';
                }, 300);
            });
            
            reader.readAsDataURL(file);
        }
    });

    // Permet de cliquer sur l'aperçu pour sélectionner un fichier
    imagePreview.addEventListener('click', function() {
        profileImageInput.click();
    });

    // Animation pour le conteneur d'upload
    const imageUploadContainer = document.querySelector('.image-upload-container');
    
    // Observer pour l'animation d'entrée
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });

    if (imageUploadContainer) {
        observer.observe(imageUploadContainer);
    }

    // Gestion du thème (si pas déjà dans login.js)
    const themeSwitcher = document.getElementById('themeSwitcher');
    const htmlElement = document.documentElement;
    const themeIcon = themeSwitcher?.querySelector('i');

    if (themeSwitcher && themeIcon) {
        // Vérifier le thème sauvegardé ou la préférence système
        const savedTheme = localStorage.getItem('theme') ||
            (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

        // Appliquer le thème sauvegardé
        htmlElement.setAttribute('data-theme', savedTheme);
        updateThemeIcon(savedTheme);

        themeSwitcher.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';

            htmlElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateThemeIcon(newTheme);

            // Animation du bouton
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
    }

    // Gestion de la visibilité des mots de passe
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
    const passwordConfirm = document.getElementById('password-confirm');

    if (togglePassword && password) {
        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
            
            this.style.transform = 'scale(1.2)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
        });
    }

    if (togglePasswordConfirm && passwordConfirm) {
        togglePasswordConfirm.addEventListener('click', function () {
            const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirm.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
            
            this.style.transform = 'scale(1.2)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
        });
    }

    // Set current year in footer
    document.getElementById("year").textContent = new Date().getFullYear();
</script>

</body>
</html>