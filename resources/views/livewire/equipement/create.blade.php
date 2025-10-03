<div>
    <!-- Bouton d'ouverture -->
    <button class="btn btn-primary btn-sm" wire:click="openCreateModal">
        <i class="fas fa-plus me-1"></i> Nouvel Équipement
    </button>

    <!-- Modal -->
    @if($isOpen)
        <div class="modal fade show d-block" style="background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-gradient-primary text-white">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-plus-circle me-2"></i>
                            Nouvel Équipement
                        </h5>
                        <button type="button" class="btn-close btn-close-white"
                                wire:click="closeCreateModal"></button>
                    </div>

                    <div class="modal-body p-4">
                        <form wire:submit.prevent="createEquipement">
                            <!-- Votre formulaire Livewire ici -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">ID Équipement *</label>
                                    <div class="input-group">
                                        <input type="text"
                                               class="form-control @error('equipementSeeder.identification') is-invalid @enderror"
                                               wire:model="equipement.identification">
                                        <button type="button"
                                                class="btn btn-outline-primary"
                                                wire:click="generateId">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </div>
                                    @error('equipementSeeder.identification')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Ajoutez les autres champs du formulaire -->
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button"
                                class="btn btn-outline-secondary"
                                wire:click="closeCreateModal">
                            <i class="fas fa-times me-1"></i> Annuler
                        </button>
                        <button type="button"
                                class="btn btn-primary"
                                wire:click="createEquipement">
                            <i class="fas fa-save me-1"></i> Créer
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show" wire:click="closeCreateModal"></div>
    @endif
</div>
