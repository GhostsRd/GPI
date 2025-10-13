<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Gestion des Matériels Réseau</h1>
        <p class="text-gray-600">Inventaire complet des équipements réseau</p>
    </div>

    <!-- Barre de Recherche et Filtres -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <div class="flex flex-col lg:flex-row gap-4 items-end">
            <!-- Recherche -->
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-2">Recherche</label>
                <div class="relative">
                    <input type="text" wire:model.debounce.300ms="search" 
                           placeholder="Rechercher par nom, fabricant, modèle, série..." 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
            
            <!-- Filtre Statut -->
            <div class="w-full lg:w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Statut</label>
                <select wire:model="statutFilter" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les statuts</option>
                    @foreach($statutOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filtre Type -->
            <div class="w-full lg:w-48">
                <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select wire:model="typeFilter" 
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les types</option>
                    @foreach($typeOptions as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Boutons d'action -->
            <div class="flex gap-2">
                <button wire:click="resetFilters" 
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-200 flex items-center">
                    <i class="fas fa-redo mr-2"></i>Réinitialiser
                </button>
                <button wire:click="exportToCsv" 
                        class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-200 flex items-center">
                    <i class="fas fa-file-export mr-2"></i>Exporter CSV
                </button>
                <button wire:click="showCreateForm" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 flex items-center">
                    <i class="fas fa-plus mr-2"></i>Nouveau
                </button>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <div class="text-2xl font-bold text-blue-600">{{ $stats['total'] }}</div>
            <div class="text-gray-600">Total</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <div class="text-2xl font-bold text-green-600">{{ $stats['en_service'] }}</div>
            <div class="text-gray-600">En service</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <div class="text-2xl font-bold text-yellow-600">{{ $stats['en_maintenance'] }}</div>
            <div class="text-gray-600">En maintenance</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <div class="text-2xl font-bold text-red-600">{{ $stats['hors_service'] }}</div>
            <div class="text-gray-600">Hors service</div>
        </div>
    </div>

    <!-- Formulaire Modal -->
    @if($showForm)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-800">
                        {{ $editMode ? 'Modifier le Matériel' : 'Nouveau Matériel' }}
                    </h3>
                    <button wire:click="cancelForm" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <form wire:submit.prevent="saveMateriel">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Colonne 1 -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nom *</label>
                                <input type="text" wire:model="nom" 
                                       class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('nom') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Entité</label>
                                <input type="text" wire:model="entite" 
                                       class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Statut *</label>
                                <select wire:model="statut" 
                                        class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    @foreach($statutOptions as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                                @error('statut') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fabricant</label>
                                <input type="text" wire:model="fabricant" 
                                       class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <!-- Colonne 2 -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Type</label>
                                <select wire:model="type" 
                                        class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Sélectionnez un type</option>
                                    @foreach($typeOptions as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Modèle</label>
                                <input type="text" wire:model="modele" 
                                       class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Numéro de série</label>
                                <input type="text" wire:model="numero_serie" 
                                       class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                @error('numero_serie') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Adresse IP</label>
                                <input type="text" wire:model="reseau_ip" 
                                       class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="192.168.1.1">
                                @error('reseau_ip') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Lieu</label>
                                <input type="text" wire:model="lieu" 
                                       class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" wire:click="cancelForm" 
                                class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-200">
                            Annuler
                        </button>
                        <button type="submit" 
                                class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-200 flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            {{ $editMode ? 'Mettre à jour' : 'Créer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Tableau -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">
                Liste des matériels ({{ $materiels->total() }})
            </h2>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('nom')">
                            Nom
                            @if($sortField === 'nom')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @else
                                <i class="fas fa-sort ml-1 text-gray-400"></i>
                            @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('entite')">
                            Entité
                            @if($sortField === 'entite')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @else
                                <i class="fas fa-sort ml-1 text-gray-400"></i>
                            @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('statut')">
                            Statut
                            @if($sortField === 'statut')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @else
                                <i class="fas fa-sort ml-1 text-gray-400"></i>
                            @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Fabricant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Lieu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">IP Réseau</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Modèle</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">N° Série</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('updated_at')">
                            Dernière modif.
                            @if($sortField === 'updated_at')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @else
                                <i class="fas fa-sort ml-1 text-gray-400"></i>
                            @endif
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($materiels as $materiel)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $materiel->nom }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-700">{{ $materiel->entite }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statutClasses = [
                                        'En service' => 'bg-green-100 text-green-800',
                                        'En stock' => 'bg-blue-100 text-blue-800',
                                        'Hors service' => 'bg-red-100 text-red-800',
                                        'En maintenance' => 'bg-yellow-100 text-yellow-800'
                                    ];
                                    $classe = $statutClasses[$materiel->statut] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $classe }}">
                                    {{ $materiel->statut }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $materiel->fabricant }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $materiel->lieu }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-mono">{{ $materiel->reseau_ip }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $materiel->type }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $materiel->modele }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-mono">{{ $materiel->numero_serie }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $materiel->updated_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button wire:click="showEditForm({{ $materiel->id }})" 
                                            class="text-blue-600 hover:text-blue-900 transition duration-150" 
                                            title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button wire:click="confirmDelete({{ $materiel->id }})" 
                                            class="text-red-600 hover:text-red-900 transition duration-150" 
                                            title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-6 py-4 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2 text-gray-300"></i>
                                <p>Aucun matériel trouvé</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($materiels->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $materiels->links() }}
            </div>
        @endif
    </div>

    <!-- Scripts pour les événements JavaScript -->
    <script>
        document.addEventListener('livewire:load', function() {
            // Écouter les événements de notification
            window.livewire.on('notify', (data) => {
                toastr[data.type](data.message);
            });

            // Écouter l'événement de confirmation de suppression
            window.livewire.on('show-delete-confirmation', () => {
                if (confirm('Êtes-vous sûr de vouloir supprimer ce matériel ?')) {
                    window.livewire.emit('deleteConfirmed');
                }
            });
        });

        // Configuration de toastr (assurez-vous d'avoir toastr inclus)
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };
    </script>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endpush
