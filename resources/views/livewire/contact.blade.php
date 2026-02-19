<!-- Section Héros Contact -->
<section class="contact-hero py-6">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-4">Contactez notre équipe</h1>
                <p class="lead mb-4">
                    Notre équipe d'experts est à votre écoute pour répondre à toutes vos questions 
                    et vous accompagner dans vos projets informatiques.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <div class="contact-badge">
                        <i class="fas fa-phone-alt me-2"></i>
                        <span>+261 34 </span>
                    </div>
                    <div class="contact-badge">
                        <i class="fas fa-envelope me-2"></i>
                        <span>helpdesk@pivotworks.org</span>
                    </div>
                    <div class="contact-badge">
                        <i class="fas fa-clock me-2"></i>
                        <span>Lun-Ven: 8h-17h</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="contact-illustration">
                    <div class="illustration-circle">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="illustration-dots">
                        <div class="dot dot-1"></div>
                        <div class="dot dot-2"></div>
                        <div class="dot dot-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Formulaire de Contact -->
<section class="contact-form-section py-6 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="section-header text-center mb-5">
                    <h2 class="section-title">Envoyez-nous un message</h2>
                    <p class="section-subtitle">
                        Nous vous répondrons dans les plus brefs délais
                    </p>
                </div>

                <div class="contact-form-card" data-aos="fade-up">
                    <form id="contactForm" class="needs-validation" novalidate>
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Votre nom" required>
                                    <label for="name">Votre nom complet</label>
                                    <div class="invalid-feedback">
                                        Veuillez saisir votre nom.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Votre email" required>
                                    <label for="email">Votre adresse email</label>
                                    <div class="invalid-feedback">
                                        Veuillez saisir une adresse email valide.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Sujet" required>
                                    <label for="subject">Sujet du message</label>
                                    <div class="invalid-feedback">
                                        Veuillez saisir un sujet.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <select class="form-select" id="department" required>
                                        <option value="">Sélectionnez un service</option>
                                        <option value="support">Support technique</option>
                                        <option value="maintenance">Maintenance</option>
                                        <option value="security">Sécurité IT</option>
                                        <option value="infrastructure">Infrastructure</option>
                                        <option value="other">Autre</option>
                                    </select>
                                    <label for="department">Service concerné</label>
                                    <div class="invalid-feedback">
                                        Veuillez sélectionner un service.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Votre message" id="message" 
                                              style="height: 150px" required></textarea>
                                    <label for="message">Votre message</label>
                                    <div class="invalid-feedback">
                                        Veuillez saisir votre message.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="consent" required>
                                    <label class="form-check-label small" for="consent">
                                        J'accepte que mes informations soient utilisées pour répondre à ma demande.
                                    </label>
                                    <div class="invalid-feedback">
                                        Vous devez accepter les conditions.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2"></i>Envoyer le message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Équipe -->
<section class="team-section py-6 bg-white">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Notre équipe informatique</h2>
            <p class="section-subtitle">
                Des passionnés unis pour créer des solutions modernes et performantes.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Membre 1 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="team-card">
                    <div class="team-img-wrapper">
                        <img src="{{url('images/eliane.png')}}" class="team-img" alt="Lina Rakoto">
                        <div class="team-contact-overlay">
                            <div class="contact-icons">
                                <a href="mailto:lina.rakoto@gpi.mg" class="contact-icon email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <a href="tel:+261340000001" class="contact-icon phone">
                                    <i class="fas fa-phone-alt"></i>
                                </a>
                                <a href="#" class="contact-icon message" onclick="openContactModal('Lina Rakoto')">
                                    <i class="fas fa-comment-dots"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h5 class="team-name">Lina Rakoto</h5>
                        <p class="team-position">Directeur Support Administratif</p>
                        <p class="team-description">
                            Spécialiste en interfaces modernes et expériences utilisateurs.
                        </p>
                        <div class="team-skills">
                            <span class="skill-tag">Support</span>
                            <span class="skill-tag">Administration</span>
                            <span class="skill-tag">Gestion</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Membre 2 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="team-card">
                    <div class="team-img-wrapper">
                        <img src="{{url('images/nicolas.png')}}" class="team-img" alt="Nicola Rijavola">
                        <div class="team-contact-overlay">
                            <div class="contact-icons">
                                <a href="mailto:nicola.rijavola@gpi.mg" class="contact-icon email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <a href="tel:+261340000002" class="contact-icon phone">
                                    <i class="fas fa-phone-alt"></i>
                                </a>
                                <a href="#" class="contact-icon message" onclick="openContactModal('Nicola Rijavola')">
                                    <i class="fas fa-comment-dots"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h5 class="team-name">Nicola Rijavola</h5>
                        <p class="team-position">Responsable Parc Informatique</p>
                        <p class="team-description">
                            Expert en infrastructure réseau et gestion de parc informatique.
                        </p>
                        <div class="team-skills">
                            <span class="skill-tag">Réseau</span>
                            <span class="skill-tag">Infrastructure</span>
                            <span class="skill-tag">Parc Informatique</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Membre 3 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="team-card">
                    <div class="team-img-wrapper">
                        <img src="{{url('images/ely.png')}}" class="team-img" alt="Tantely Ely">
                        <div class="team-contact-overlay">
                            <div class="contact-icons">
                                <a href="mailto:tantely.ely@gpi.mg" class="contact-icon email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <a href="tel:+261340000003" class="contact-icon phone">
                                    <i class="fas fa-phone-alt"></i>
                                </a>
                                <a href="#" class="contact-icon message" onclick="openContactModal('Tantely Ely')">
                                    <i class="fas fa-comment-dots"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h5 class="team-name">Tantely Ely</h5>
                        <p class="team-position">Responsable Sécurité IT & Support UI/UX</p>
                        <p class="team-description">
                            Expert en sécurité informatique et conception d'interfaces utilisateur.
                        </p>
                        <div class="team-skills">
                            <span class="skill-tag">Sécurité</span>
                            <span class="skill-tag">UI/UX</span>
                            <span class="skill-tag">Support Technique</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Membre 4 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="team-card">
                    <div class="team-img-wrapper">
                        <img src="{{url('images/fandresena.png')}}" class="team-img" alt="Fandresena">
                        <div class="team-contact-overlay">
                            <div class="contact-icons">
                                <a href="mailto:fandresena@gpi.mg" class="contact-icon email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <a href="tel:+261340000004" class="contact-icon phone">
                                    <i class="fas fa-phone-alt"></i>
                                </a>
                                <a href="#" class="contact-icon message" onclick="openContactModal('Fandresena')">
                                    <i class="fas fa-comment-dots"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h5 class="team-name">Fandresena</h5>
                        <p class="team-position">Technicien de Maintenance</p>
                        <p class="team-description">
                            Spécialiste en maintenance préventive et corrective des équipements.
                        </p>
                        <div class="team-skills">
                            <span class="skill-tag">Maintenance</span>
                            <span class="skill-tag">Hardware</span>
                            <span class="skill-tag">Réparation</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Membre 5 -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                <div class="team-card">
                    <div class="team-img-wrapper">
                        <img src="{{url('images/hasina.png')}}" class="team-img" alt="Hasina Samuela">
                        <div class="team-contact-overlay">
                            <div class="contact-icons">
                                <a href="mailto:hasina.samuela@gpi.mg" class="contact-icon email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                                <a href="tel:+261340000005" class="contact-icon phone">
                                    <i class="fas fa-phone-alt"></i>
                                </a>
                                <a href="#" class="contact-icon message" onclick="openContactModal('Hasina Samuela')">
                                    <i class="fas fa-comment-dots"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="team-info">
                        <h5 class="team-name">Hasina Samuela</h5>
                        <p class="team-position">Support Utilisateurs & Maintenance</p>
                        <p class="team-description">
                            Expert en support utilisateur et maintenance des systèmes informatiques.
                        </p>
                        <div class="team-skills">
                            <span class="skill-tag">Support</span>
                            <span class="skill-tag">Maintenance</span>
                            <span class="skill-tag">Utilisateurs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal de Contact Rapide -->
<div class="contact-modal-overlay" id="contactModal">
    <div class="contact-modal-container">
        <div class="contact-modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Envoyer un message à <span id="recipientName"></span></h5>
                <button type="button" class="modal-close" onclick="closeContactModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="quickContactForm">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="quickName" placeholder="Votre nom" required>
                        <label for="quickName">Votre nom</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="quickEmail" placeholder="Votre email" required>
                        <label for="quickEmail">Votre email</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Votre message" id="quickMessage" 
                                  style="height: 120px" required></textarea>
                        <label for="quickMessage">Votre message</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onclick="closeContactModal()">
                    Annuler
                </button>
                <button type="button" class="btn btn-primary" onclick="sendQuickMessage()">
                    <i class="fas fa-paper-plane me-2"></i>Envoyer
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="parallax-footer text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5 class="fw-bold mb-3">GPI Informatique</h5>
                <p class="small">
                    Votre partenaire de confiance pour toutes vos solutions informatiques.
                    Nous nous engageons à fournir un service de qualité et un support exceptionnel.
                </p>
            </div>
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5 class="fw-bold mb-3">Contact rapide</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        <span>Antananarivo, Madagascar</span>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-phone-alt me-2"></i>
                        <span>+261 34 00 000 00</span>
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-envelope me-2"></i>
                        <span>contact@gpi.mg</span>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h5 class="fw-bold mb-3">Liens rapides</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><a href="{{ url('/') }}" class="text-white text-decoration-none">Accueil</a></li>
                    <li class="mb-2"><a href="{{ url('/services') }}" class="text-white text-decoration-none">Services</a></li>
                    <li class="mb-2"><a href="{{ url('/contact') }}" class="text-white text-decoration-none">Contact</a></li>
                    <li class="mb-2"><a href="{{ url('/documentation') }}" class="text-white text-decoration-none">Documentation</a></li>
                </ul>
            </div>
        </div>
        <hr class="my-4 opacity-25">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0">&copy; 2025 GPI Informatique. Tous droits réservés.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="social-links">
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
:root {
    /* Palette basée sur #5BC4BF */
    --primary-main: #5BC4BF;
    --primary-dark: #4AA8A4;
    --primary-light: #7CD0CC;
    --primary-lighter: #A3E0DD;
    --primary-lightest: #D5F2F0;
    
    /* Neutres */
    --neutral-dark: #2D3748;
    --neutral-medium: #4A5568;
    --neutral-light: #718096;
    --neutral-lighter: #CBD5E0;
    --neutral-lightest: #F7FAFC;
    
    /* Couleurs d'état */
    --success-color: #48BB78;
    --warning-color: #ED8936;
    --danger-color: #F56565;
    --info-color: #4299E1;
}

/* Section Héros Contact */
.contact-hero {
    background: linear-gradient(135deg, var(--primary-main) 0%, var(--primary-dark) 100%);
    color: white;
    position: relative;
    overflow: hidden;
}

.contact-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.contact-badge {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    border-radius: 50px;
    padding: 10px 20px;
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.contact-badge:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
}

.contact-illustration {
    position: relative;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.illustration-circle {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: white;
    animation: pulse 4s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.illustration-dots {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

.dot {
    position: absolute;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    animation: float 6s ease-in-out infinite;
}

.dot-1 {
    top: 20%;
    left: 15%;
    animation-delay: 0s;
}

.dot-2 {
    top: 60%;
    right: 20%;
    animation-delay: -2s;
}

.dot-3 {
    bottom: 30%;
    left: 25%;
    animation-delay: -4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

/* Section Formulaire */
.contact-form-card {
    background: white;
    border-radius: 20px;
    padding: 3rem;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    border: 1px solid var(--neutral-lighter);
}

.form-control, .form-select {
    border: 2px solid var(--neutral-lighter);
    border-radius: 12px;
    padding: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-main);
    box-shadow: 0 0 0 3px rgba(91, 196, 191, 0.2);
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label {
    color: var(--primary-main);
}

.btn-primary {
    background: var(--primary-main);
    border: none;
    border-radius: 50px;
    padding: 1rem 3rem;
    font-weight: 600;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(91, 196, 191, 0.3);
}

/* Section Équipe */
.team-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid var(--neutral-lighter);
    height: 100%;
}

.team-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(91, 196, 191, 0.2);
}

.team-img-wrapper {
    position: relative;
    height: 250px;
    overflow: hidden;
}

.team-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.team-card:hover .team-img {
    transform: scale(1.05);
}

.team-contact-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to top, rgba(91, 196, 191, 0.9), transparent);
    display: flex;
    align-items: flex-end;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.4s ease;
    padding: 2rem;
}

.team-card:hover .team-contact-overlay {
    opacity: 1;
}

.contact-icons {
    display: flex;
    gap: 1rem;
}

.contact-icon {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary-main);
    text-decoration: none;
    transition: all 0.3s ease;
    transform: translateY(20px);
    opacity: 0;
}

.team-card:hover .contact-icon {
    transform: translateY(0);
    opacity: 1;
}

.contact-icon:hover {
    background: var(--primary-main);
    color: white;
    transform: scale(1.1);
}

.contact-icon:nth-child(1) { transition-delay: 0.1s; }
.contact-icon:nth-child(2) { transition-delay: 0.2s; }
.contact-icon:nth-child(3) { transition-delay: 0.3s; }

.team-info {
    padding: 2rem;
}

.team-name {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--neutral-dark);
    margin-bottom: 0.5rem;
}

.team-position {
    color: var(--primary-main);
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.team-description {
    color: var(--neutral-medium);
    font-size: 0.875rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.team-skills {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.skill-tag {
    background: var(--neutral-lightest);
    color: var(--neutral-medium);
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.team-card:hover .skill-tag {
    background: var(--primary-lighter);
    color: var(--primary-main);
}

/* Modal de Contact Rapide */
.contact-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 1060;
    padding: 1rem;
}

.contact-modal-container {
    max-width: 500px;
    width: 100%;
}

.contact-modal-content {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 25px 75px rgba(0, 0, 0, 0.2);
    animation: modalSlideUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

@keyframes modalSlideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modal-header {
    padding: 1.5rem;
    border-bottom: 1px solid var(--neutral-lighter);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--neutral-dark);
    margin: 0;
}

.modal-close {
    background: var(--neutral-lightest);
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--neutral-light);
    cursor: pointer;
    transition: all 0.3s ease;
}

.modal-close:hover {
    background: var(--neutral-lighter);
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    padding: 1.5rem;
    border-top: 1px solid var(--neutral-lighter);
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

/* Footer */
.parallax-footer {
    background: linear-gradient(135deg, var(--neutral-dark) 0%, var(--neutral-medium) 100%);
    position: relative;
    overflow: hidden;
}

.parallax-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%235BC4BF' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.social-links {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
}

.social-link {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
}

.social-link:hover {
    background: var(--primary-main);
    transform: translateY(-2px);
}

/* Responsive */
@media (max-width: 992px) {
    .contact-hero {
        padding: 4rem 0;
    }
    
    .contact-form-card {
        padding: 2rem;
    }
    
    .team-img-wrapper {
        height: 220px;
    }
}

@media (max-width: 768px) {
    .contact-badge {
        width: 100%;
        justify-content: center;
    }
    
    .contact-icons {
        gap: 0.75rem;
    }
    
    .contact-icon {
        width: 40px;
        height: 40px;
        font-size: 0.9rem;
    }
    
    .social-links {
        justify-content: center;
        margin-top: 1rem;
    }
}

@media (max-width: 576px) {
    .contact-form-card {
        padding: 1.5rem;
    }
    
    .team-info {
        padding: 1.5rem;
    }
    
    .modal-container {
        margin: 0 1rem;
    }
}

/* Section title global */
.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--neutral-dark);
    position: relative;
    display: inline-block;
    margin-bottom: 1rem;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 4px;
    background: var(--primary-main);
    border-radius: 2px;
}

.section-subtitle {
    font-size: 1.125rem;
    color: var(--neutral-medium);
    max-width: 600px;
    margin: 0 auto;
}

/* Animation au scroll */
[data-aos] {
    transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

[data-aos="fade-up"] {
    opacity: 0;
    transform: translateY(30px);
}

[data-aos].aos-animate {
    opacity: 1;
    transform: translateY(0);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 100
    });
    
    // Validation du formulaire principal
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(event) {
            if (!contactForm.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            } else {
                event.preventDefault();
                submitContactForm();
            }
            
            contactForm.classList.add('was-validated');
        }, false);
    }
    
    // Validation du formulaire rapide
    const quickContactForm = document.getElementById('quickContactForm');
    if (quickContactForm) {
        quickContactForm.addEventListener('submit', function(event) {
            if (!quickContactForm.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            
            quickContactForm.classList.add('was-validated');
        }, false);
    }
});

// Fonctions pour le modal
let currentRecipient = '';

function openContactModal(name) {
    currentRecipient = name;
    document.getElementById('recipientName').textContent = name;
    document.getElementById('contactModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeContactModal() {
    document.getElementById('contactModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    resetQuickForm();
}

function resetQuickForm() {
    const form = document.getElementById('quickContactForm');
    if (form) {
        form.reset();
        form.classList.remove('was-validated');
    }
}

function sendQuickMessage() {
    const form = document.getElementById('quickContactForm');
    if (!form.checkValidity()) {
        form.classList.add('was-validated');
        return;
    }
    
    const name = document.getElementById('quickName').value;
    const email = document.getElementById('quickEmail').value;
    const message = document.getElementById('quickMessage').value;
    
    // Simuler l'envoi du message
    const submitBtn = document.querySelector('#contactModal .btn-primary');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Envoi en cours...';
    submitBtn.disabled = true;
    
    setTimeout(() => {
        // En production, envoyer les données au serveur
        console.log('Message envoyé à:', currentRecipient);
        console.log('De:', name, email);
        console.log('Message:', message);
        
        // Afficher un message de succès
        showNotification('Message envoyé avec succès à ' + currentRecipient, 'success');
        
        // Réinitialiser
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
        closeContactModal();
    }, 2000);
}

function submitContactForm() {
    const form = document.getElementById('contactForm');
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Envoi en cours...';
    submitBtn.disabled = true;
    
    // Simuler l'envoi du formulaire
    setTimeout(() => {
        // En production, envoyer les données au serveur via AJAX
        const formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            subject: document.getElementById('subject').value,
            department: document.getElementById('department').value,
            message: document.getElementById('message').value
        };
        
        console.log('Formulaire soumis:', formData);
        
        // Afficher un message de succès
        showNotification('Votre message a été envoyé avec succès !', 'success');
        
        // Réinitialiser le formulaire
        form.reset();
        form.classList.remove('was-validated');
        
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }, 2000);
}

function showNotification(message, type = 'success') {
    // Créer la notification
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
        ${message}
    `;
    
    // Ajouter au body
    document.body.appendChild(notification);
    
    // Afficher
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // Cacher après 5 secondes
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 5000);
}

// Styles pour les notifications
const style = document.createElement('style');
style.textContent = `
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: white;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    border-left: 4px solid var(--success-color);
    display: flex;
    align-items: center;
    transform: translateX(400px);
    transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1070;
    max-width: 350px;
}

.notification-success {
    border-left-color: var(--success-color);
}

.notification.show {
    transform: translateX(0);
}

.notification i {
    font-size: 1.25rem;
    color: var(--success-color);
}
`;
document.head.appendChild(style);

// Fermer le modal avec ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeContactModal();
    }
});

// Fermer le modal en cliquant à l'extérieur
document.getElementById('contactModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeContactModal();
    }
});
</script>

<!-- Inclure AOS pour les animations -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>