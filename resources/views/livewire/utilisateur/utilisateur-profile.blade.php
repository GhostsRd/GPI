<div class="profile-page-container py-5" style="margin-top: 60px;">
    <style>
        :root {
            --primary: #5BC4BF;
            --primary-dark: #4dadab;
            --orange: #e65e4b;
            --gray-100: #f8fafc;
            --gray-200: #e2e8f0;
            --gray-600: #475569;
            --gray-800: #1e293b;
        }

        .profile-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .profile-header-accent {
            height: 120px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            position: relative;
        }

        .avatar-section {
            margin-top: -60px;
            text-align: center;
            padding: 0 20px;
            z-index: 10;
            position: relative;
        }

        .profile-avatar-wrapper {
            position: relative;
            display: inline-block;
        }

        .profile-img-large {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 5px solid white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            object-fit: cover;
            background: #fff;
        }

        .camera-overlay {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 36px;
            height: 36px;
            background: var(--orange);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid white;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .camera-overlay:hover {
            transform: scale(1.1);
            background: #d45241;
        }

        .stat-box {
            text-align: center;
            padding: 10px;
            min-width: 90px;
        }

        .stat-v {
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--orange);
            margin-bottom: 2px;
            display: block;
        }

        .stat-l {
            font-size: 0.70rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--gray-600);
        }

        .info-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--gray-600);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 500;
            color: var(--gray-800);
            display: block;
            margin-bottom: 20px;
        }

        .btn-premium-primary {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-premium-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(91, 196, 191, 0.3);
            color: white;
        }

        .btn-premium-outline {
            background: white;
            color: var(--gray-600);
            border: 1px solid var(--gray-200);
            padding: 10px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-premium-outline:hover {
            background: var(--gray-100);
            border-color: var(--gray-600);
            color: var(--gray-800);
        }

        /* Modal Styles */
        .premium-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(8px);
            z-index: 10000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .premium-modal {
            background: white;
            border-radius: 24px;
            width: 100%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            padding: 32px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.15);
        }

        .form-group-premium {
            margin-bottom: 24px;
        }

        .form-group-premium label {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--gray-800);
            margin-bottom: 8px;
            display: block;
        }

        .form-control-premium {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid var(--gray-200);
            background: var(--gray-100);
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-control-premium:focus {
            outline: none;
            border-color: var(--primary);
            background: white;
            box-shadow: 0 0 0 4px rgba(91, 196, 191, 0.1);
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="profile-card">
                <div class="profile-header-accent"></div>
                
                <div class="avatar-section">
                    <div class="profile-avatar-wrapper">
                        @if($newPhoto)
                            <img src="{{ $newPhoto->temporaryUrl() }}" class="profile-img-large">
                        @elseif($photo)
                            <img src="{{ asset('storage/'.$photo) }}" class="profile-img-large">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($nom) }}&background=5BC4BF&color=fff&size=200" class="profile-img-large">
                        @endif
                        
                        <label for="profile_photo_input" class="camera-overlay">
                            <i class="fas fa-camera"></i>
                            <input type="file" id="profile_photo_input" wire:model="newPhoto" style="display:none">
                        </label>
                    </div>
                    
                    <h2 class="mt-3 mb-1 fw-800" style="color: var(--gray-800);">{{ $nom }}</h2>
                    <p class="text-muted fw-600 mb-4">{{ $poste ?? 'Non spécifié' }}</p>

                    <div class="d-flex justify-content-center gap-4 mb-4">
                        <div class="stat-box">
                            <span class="stat-v">{{ $stats['checkout'] }}</span>
                            <span class="stat-l">Checkouts</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-v">{{ $stats['reservations'] }}</span>
                            <span class="stat-l">Réservations</span>
                        </div>
                        <div class="stat-box">
                            <span class="stat-v">{{ $stats['tickets'] }}</span>
                            <span class="stat-l">Tickets</span>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-2 mb-4">
                        <button class="btn btn-sm btn-primary px-3" wire:click="follow" style="background: var(--primary); border: none;">
                            <i class="fas fa-plus"></i> Suivre
                        </button>
                        <button class="btn btn-sm btn-outline-secondary px-3" wire:click="sendMessage">
                            <i class="fas fa-envelope"></i> Message
                        </button>
                    </div>

                    <div class="pb-5">
                        <button class="btn-premium-primary" wire:click="toggleEditModal">
                            <i class="fas fa-edit"></i> Modifier le profil
                        </button>
                        <button class="btn-premium-outline ms-2" onclick="document.getElementById('logout-form').submit()">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </div>
                </div>

                <hr class="mx-5 my-0" style="opacity: 0.1;">

                <div class="p-5">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="info-label">Bio</span>
                            <p class="text-muted fst-italic mb-4">
                                Passionné de technologie, de programmation et de design. J'aime créer des solutions modernes et partager mes connaissances.
                            </p>

                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $email }}</span>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span class="info-label">Téléphone</span>
                                    <span class="info-value">{{ $telephone ?? '—' }}</span>
                                </div>
                                <div class="col-sm-6">
                                    <span class="info-label">Lieu d'affectation</span>
                                    <span class="info-value">{{ $lieu_affectation ?? '—' }}</span>
                                </div>
                            </div>
                            
                            <span class="info-label">Adresse</span>
                            <span class="info-value">{{ $adresse ?? '—' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    @if($showEditModal)
    <div class="premium-modal-overlay" wire:click.self="toggleEditModal">
        <div class="premium-modal animate__animated animate__zoomIn animate__faster">
            <h3 class="fw-800 mb-4" style="color: var(--gray-800);">Modifier mon profil</h3>
            
            <form wire:submit.prevent="saveProfile">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-premium">
                            <label>Nom complet</label>
                            <input type="text" class="form-control-premium" wire:model.defer="nom">
                            @error('nom') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-premium">
                            <label>Poste / Titre</label>
                            <input type="text" class="form-control-premium" wire:model.defer="poste">
                            @error('poste') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group-premium">
                    <label>Téléphone</label>
                    <input type="text" class="form-control-premium" wire:model.defer="telephone">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-premium">
                            <label>Lieu d'affectation</label>
                            <input type="text" class="form-control-premium" wire:model.defer="lieu_affectation">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-premium">
                            <label>Adresse</label>
                            <input type="text" class="form-control-premium" wire:model.defer="adresse">
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <button type="button" class="btn-premium-outline" wire:click="toggleEditModal">Annuler</button>
                    <button type="submit" class="btn-premium-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove>Enregistrer les modifications</span>
                        <span wire:loading><i class="fas fa-spinner fa-spin"></i> Enregistrement...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
