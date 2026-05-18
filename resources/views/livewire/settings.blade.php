<div class="settings-container py-4 px-3 px-md-4">
    <!-- Inline Custom Premium Styles -->
    <style>
        .settings-container {
            font-family: 'Outfit', 'Inter', -apple-system, sans-serif;
            color: var(--text-color, #1e293b);
            max-width: 1200px;
            margin: 0 auto;
        }

        .settings-header {
            margin-bottom: 2rem;
            animation: fadeInDown 0.5s ease;
        }

        .settings-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.025em;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        [data-bs-theme="dark"] .settings-title {
            color: #f8fafc;
        }

        .settings-subtitle {
            font-size: 0.875rem;
            color: #64748b;
        }

        [data-bs-theme="dark"] .settings-subtitle {
            color: #94a3b8;
        }

        .settings-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 992px) {
            .settings-grid {
                grid-template-columns: 1.2fr 1fr;
            }
        }

        .settings-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.05), 0 2px 8px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(226, 232, 240, 0.8);
            padding: 1.75rem;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        [data-bs-theme="dark"] .settings-card {
            background: #1e293b;
            border-color: rgba(51, 65, 85, 0.8);
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.2), 0 2px 8px -1px rgba(0, 0, 0, 0.1);
        }

        .settings-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 4px 12px -2px rgba(0, 0, 0, 0.04);
        }

        [data-bs-theme="dark"] .settings-card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3), 0 4px 12px -2px rgba(0, 0, 0, 0.2);
        }

        .settings-card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f1f5f9;
        }

        [data-bs-theme="dark"] .settings-card-header {
            border-bottom-color: #334155;
        }

        .settings-card-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: rgba(13, 148, 136, 0.1);
            color: #0d9488;
        }

        .settings-card-title {
            font-size: 1.15rem;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }

        [data-bs-theme="dark"] .settings-card-title {
            color: #e2e8f0;
        }

        /* Form Controls */
        .settings-form-group {
            margin-bottom: 1.25rem;
        }

        .settings-label {
            font-size: 0.825rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 0.5rem;
            display: block;
        }

        [data-bs-theme="dark"] .settings-label {
            color: #cbd5e1;
        }

        .settings-input-wrapper {
            position: relative;
        }

        .settings-input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            pointer-events: none;
            transition: color 0.3s ease;
        }

        .settings-input {
            width: 100%;
            padding: 0.65rem 1rem 0.65rem 2.5rem;
            font-size: 0.9rem;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            background-color: #f8fafc;
            color: #0f172a;
            transition: all 0.2s ease;
        }

        [data-bs-theme="dark"] .settings-input {
            border-color: #475569;
            background-color: #0f172a;
            color: #f8fafc;
        }

        .settings-input:focus {
            outline: none;
            border-color: #0d9488;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.15);
        }

        [data-bs-theme="dark"] .settings-input:focus {
            background-color: #0f172a;
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.3);
        }

        .settings-input:focus + .settings-input-icon {
            color: #0d9488;
        }

        .settings-input.is-invalid {
            border-color: #ef4444;
        }

        .settings-input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15);
        }

        .invalid-feedback {
            font-size: 0.75rem;
            color: #ef4444;
            margin-top: 0.35rem;
            font-weight: 500;
        }

        /* Buttons */
        .btn-premium {
            background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%);
            color: #ffffff;
            font-weight: 600;
            padding: 0.65rem 1.5rem;
            font-size: 0.9rem;
            border-radius: 10px;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px -2px rgba(13, 148, 136, 0.3);
            cursor: pointer;
        }

        .btn-premium:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px -3px rgba(13, 148, 136, 0.4);
            filter: brightness(1.05);
            color: #ffffff;
        }

        .btn-premium:active {
            transform: translateY(1px);
        }

        /* Custom Toggle Switch Premium */
        .toggle-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 1.25rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        [data-bs-theme="dark"] .toggle-container {
            background: #0f172a;
            border-color: #334155;
        }

        .toggle-container:hover {
            border-color: #cbd5e1;
        }

        [data-bs-theme="dark"] .toggle-container:hover {
            border-color: #475569;
        }

        .toggle-text {
            flex-grow: 1;
            padding-right: 1.5rem;
        }

        .toggle-label {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        [data-bs-theme="dark"] .toggle-label {
            color: #f8fafc;
        }

        .toggle-desc {
            font-size: 0.775rem;
            color: #64748b;
            line-height: 1.4;
        }

        [data-bs-theme="dark"] .toggle-desc {
            color: #94a3b8;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 52px;
            height: 28px;
            flex-shrink: 0;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #cbd5e1;
            transition: .4s;
            border-radius: 34px;
        }

        [data-bs-theme="dark"] .slider {
            background-color: #475569;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        input:checked + .slider {
            background-color: #0d9488;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #0d9488;
        }

        input:checked + .slider:before {
            transform: translateX(24px);
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

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- Header Section -->
    <div class="settings-header">
        <h1 class="settings-title">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings text-teal-600"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
            Paramètres du Compte
        </h1>
        <p class="settings-subtitle">Gérez vos préférences personnelles, vos informations de profil et la sécurité de votre compte.</p>
    </div>

    <!-- Main Content Grid -->
    <div class="settings-grid">
        <!-- Left Column: Profile Information -->
        <div class="settings-card" style="animation-delay: 0.1s;">
            <div class="settings-card-header">
                <div class="settings-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
                <h2 class="settings-card-title">Informations Personnelles</h2>
            </div>

            <form wire:submit.prevent="updateProfile">
                <div class="settings-form-group">
                    <label class="settings-label">Nom complet</label>
                    <div class="settings-input-wrapper">
                        <input type="text" wire:model.defer="name" class="settings-input @error('name') is-invalid @enderror" placeholder="Ex: Jean Dupont">
                        <span class="settings-input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-type"><polyline points="4 7 4 4 20 4 20 7"></polyline><line x1="9" y1="20" x2="15" y2="20"></line><line x1="12" y1="4" x2="12" y2="20"></line></svg>
                        </span>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="settings-form-group">
                    <label class="settings-label">Adresse E-mail</label>
                    <div class="settings-input-wrapper">
                        <input type="email" wire:model.defer="email" class="settings-input @error('email') is-invalid @enderror" placeholder="exemple@gpi.com">
                        <span class="settings-input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </span>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="settings-form-group">
                    <label class="settings-label">Numéro de Téléphone</label>
                    <div class="settings-input-wrapper">
                        <input type="text" wire:model.defer="phone" class="settings-input @error('phone') is-invalid @enderror" placeholder="Ex: 034 00 000 00">
                        <span class="settings-input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </span>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="settings-form-group">
                    <label class="settings-label">Poste / Fonction</label>
                    <div class="settings-input-wrapper">
                        <input type="text" wire:model.defer="poste" class="settings-input @error('poste') is-invalid @enderror" placeholder="Ex: Administrateur Système">
                        <span class="settings-input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>
                        </span>
                        @error('poste')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="settings-form-group">
                    <label class="settings-label">Lieu d'affectation / Bureau</label>
                    <div class="settings-input-wrapper">
                        <input type="text" wire:model.defer="location" class="settings-input @error('location') is-invalid @enderror" placeholder="Ex: Bureau 101, Siège">
                        <span class="settings-input-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </span>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="pt-2 text-end">
                    <button type="submit" class="btn-premium">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                        Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Column: Safety & Password -->
        <div class="d-flex flex-column gap-4">
            <!-- 2FA Premium Switch Card -->
            <div class="settings-card" style="animation-delay: 0.2s;">
                <div class="settings-card-header">
                    <div class="settings-card-icon" style="background: rgba(14, 165, 233, 0.1); color: #0ea5e9;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    </div>
                    <h2 class="settings-card-title">Sécurité de connexion</h2>
                </div>

                <div class="toggle-container">
                    <div class="toggle-text">
                        <div class="toggle-label">
                            Double Authentification (2FA)
                            @if($two_factor_enabled)
                                <span class="badge bg-teal-100 text-teal-800 border border-teal-200 px-2 py-0.5 rounded text-xs font-semibold">Activée</span>
                            @else
                                <span class="badge bg-slate-100 text-slate-600 border border-slate-200 px-2 py-0.5 rounded text-xs font-semibold">Désactivée</span>
                            @endif
                        </div>
                        <div class="toggle-desc">Protégez votre compte en exigeant un code de validation à 6 chiffres envoyé sur votre adresse e-mail à chaque connexion.</div>
                    </div>
                    <label class="switch">
                        <input type="checkbox" wire:model="two_factor_enabled" wire:change="toggleTwoFactor">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>

            <!-- Password Form Card -->
            <div class="settings-card" style="animation-delay: 0.3s;">
                <div class="settings-card-header">
                    <div class="settings-card-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    </div>
                    <h2 class="settings-card-title">Modifier le mot de passe</h2>
                </div>

                <form wire:submit.prevent="updatePassword">
                    <div class="settings-form-group">
                        <label class="settings-label">Mot de passe actuel</label>
                        <div class="settings-input-wrapper">
                            <input type="password" wire:model.defer="current_password" class="settings-input @error('current_password') is-invalid @enderror" placeholder="••••••••">
                            <span class="settings-input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
                            </span>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="settings-form-group">
                        <label class="settings-label">Nouveau mot de passe</label>
                        <div class="settings-input-wrapper">
                            <input type="password" wire:model.defer="new_password" class="settings-input @error('new_password') is-invalid @enderror" placeholder="••••••••">
                            <span class="settings-input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
                            </span>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="settings-form-group">
                        <label class="settings-label">Confirmer le nouveau mot de passe</label>
                        <div class="settings-input-wrapper">
                            <input type="password" wire:model.defer="new_password_confirmation" class="settings-input" placeholder="••••••••">
                            <span class="settings-input-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            </span>
                        </div>
                    </div>

                    <div class="pt-2 text-end">
                        <button type="submit" class="btn-premium" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); box-shadow: 0 4px 12px -2px rgba(245, 158, 11, 0.3);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                            Mettre à jour le mot de passe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
