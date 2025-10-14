<!-- resources/views/livewire/equipement/imprimante.blade.php -->
<div class="bg-white rounded-lg shadow-md p-6">
    <!-- En-tête -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Gestion des Imprimantes</h1>
        <button wire:click="create" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center transition duration-200">
            <i class="fas fa-plus mr-2"></i> Nouvelle Imprimante
        </button>
    </div>

    <!-- Messages flash -->
    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex justify-between items-center">
            <span>{{ session('message') }}</span>
            <button type="button" class="text-green-700" onclick="this.parentElement.style.display='none'">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- Filtres -->
    <div class="bg-gray-50 p-4 rounded-lg mb-6">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <!-- Recherche -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                <input type="text" wire:model.live.debounce.300ms="search"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Nom, modèle, IP...">
            </div>

            <!-- Statut -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                <select wire:model.live="filterStatut" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Tous les statuts</option>
                    @foreach($statuts as $statut)
                        <option value="{{ $statut }}">{{ $statut }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Fabricant -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fabricant</label>
                <select wire:model.live="filterFabricant" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Tous les fabricants</option>
                    @foreach($fabricants as $fabricant)
                        <option value="{{ $fabricant }}">{{ $fabricant }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Entité -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Entité</label>
                <select wire:model.live="filterEntite" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Toutes les entités</option>
                    @foreach($entites as $entite)
                        <option value="{{ $entite }}">{{ $entite }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Bouton reset -->
            <div class="flex items-end">
                <button wire:click="resetFilters" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center w-full justify-center transition duration-200">
                    <i class="fas fa-redo mr-2"></i> Réinitialiser
                </button>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
            <div class="text-blue-800 font-bold text-xl">{{ $stats['total'] }}</div>
            <div class="text-blue-600 text-sm">Total</div>
        </div>
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
            <div class="text-green-800 font-bold text-xl">{{ $stats['en_service'] }}</div>
            <div class="text-green-600 text-sm">En service</div>
        </div>
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
            <div class="text-yellow-800 font-bold text-xl">{{ $stats['en_maintenance'] }}</div>
            <div class="text-yellow-600 text-sm">En maintenance</div>
        </div>
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
            <div class="text-blue-800 font-bold text-xl">{{ $stats['en_stock'] }}</div>
            <div class="text-blue-600 text-sm">En stock</div>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-lg p-4 text-center">
            <div class="text-red-800 font-bold text-xl">{{ $stats['hors_service'] }}</div>
            <div class="text-red-600 text-sm">Hors service</div>
        </div>
    </div>

    <!-- Tableau -->
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
            <tr>
                <th wire:click="sortBy('nom')" class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition duration-150">
                    Nom
                    @if($sortField === 'nom')
                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                    @else
                        <i class="fas fa-sort ml-1 text-gray-300"></i>
                    @endif
                </th>
                <th wire:click="sortBy('entite')" class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition duration-150">
                    Entité
                    @if($sortField === 'entite')
                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                    @else
                        <i class="fas fa-sort ml-1 text-gray-300"></i>
                    @endif
                </th>
                <th wire:click="sortBy('statut')" class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition duration-150">
                    Statut
                    @if($sortField === 'statut')
                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                    @else
                        <i class="fas fa-sort ml-1 text-gray-300"></i>
                    @endif
                </th>
                <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Fabricant
                </th>
                <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    IP
                </th>
                <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Série
                </th>
                <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Lieu
                </th>
                <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Type
                </th>
                <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Modèle
                </th>
                <th wire:click="sortBy('updated_at')" class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition duration-150">
                    Dernière modif.
                    @if($sortField === 'updated_at')
                        <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                    @else
                        <i class="fas fa-sort ml-1 text-gray-300"></i>
                    @endif
                </th>
                <th class="px-6 py-3 border-b border-gray-200 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($imprimantes as $imprimante)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $imprimante->nom }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $imprimante->entite }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @php
                            $statusClasses = [
                                'En service' => 'bg-green-100 text-green-800',
                                'En maintenance' => 'bg-yellow-100 text-yellow-800',
                                'Hors service' => 'bg-red-100 text-red-800',
                                'En stock' => 'bg-blue-100 text-blue-800'
                            ];
                        @endphp
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$imprimante->statut] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ $imprimante->statut }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $imprimante->fabricant }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">{{ $imprimante->reseau_ip }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-mono">{{ $imprimante->numero_serie }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $imprimante->lieu }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $imprimante->type }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $imprimante->modele }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $imprimante->updated_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <button wire:click="edit({{ $imprimante->id }})" class="text-blue-600 hover:text-blue-900 transition duration-200" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button wire:click="delete({{ $imprimante->id }})"
                                    wire:confirm="Êtes-vous sûr de vouloir supprimer cette imprimante ?"
                                    class="text-red-600 hover:text-red-900 transition duration-200" title="Supprimer">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="px-6 py-4 text-center text-sm text-gray-500">
                        Aucune imprimante trouvée.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $imprimantes->links() }}
    </div>
</div>

<!-- Modal -->
@if ($showModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50" x-data x-on:click.self="Livewire.emit('closeModal')">
        <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">
                        {{ $isEditing ? 'Modifier l\'imprimante' : 'Nouvelle Imprimante' }}
                    </h2>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition duration-200">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form wire:submit.prevent="save">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Colonne 1 -->
                        <div class="space-y-4">
                            <div>
                                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                                <input type="text" wire:model="nom" id="nom"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                       placeholder="Ex: IMP-IT-001" required>
                                @error('nom') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="entite" class="block text-sm font-medium text-gray-700 mb-1">Entité</label>
                                <input type="text" wire:model="entite" id="entite"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                       placeholder="Ex: Informatique, RH...">
                            </div>

                            <div>
                                <label for="statut" class="block text-sm font-medium text-gray-700 mb-1">Statut *</label>
                                <select wire:model="statut" id="statut"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" required>
                                    <option value="">Sélectionnez un statut</option>
                                    <option value="En service">En service</option>
                                    <option value="En stock">En stock</option>
                                    <option value="En maintenance">En maintenance</option>
                                    <option value="Hors service">Hors service</option>
                                </select>
                                @error('statut') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="fabricant" class="block text-sm font-medium text-gray-700 mb-1">Fabricant</label>
                                <input type="text" wire:model="fabricant" id="fabricant"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                       placeholder="Ex: HP, Canon, Epson...">
                            </div>

                            <div>
                                <label for="reseau_ip" class="block text-sm font-medium text-gray-700 mb-1">Adresse IP</label>
                                <input type="text" wire:model="reseau_ip" id="reseau_ip"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                       placeholder="192.168.1.100">
                                @error('reseau_ip') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Colonne 2 -->
                        <div class="space-y-4">
                            <div>
                                <label for="numero_serie" class="block text-sm font-medium text-gray-700 mb-1">Numéro de série</label>
                                <input type="text" wire:model="numero_serie" id="numero_serie"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                       placeholder="Ex: SN123456789">
                                @error('numero_serie') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label for="lieu" class="block text-sm font-medium text-gray-700 mb-1">Lieu</label>
                                <input type="text" wire:model="lieu" id="lieu"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                       placeholder="Ex: Bureau 101, Salle d'impression...">
                            </div>

                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                                <select wire:model="type" id="type"
                                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                                    <option value="">Sélectionnez un type</option>
                                    <option value="Laser">Laser</option>
                                    <option value="Jet d'encre">Jet d'encre</option>
                                    <option value="Multifonction">Multifonction</option>
                                    <option value="Thermique">Thermique</option>
                                </select>
                            </div>

                            <div>
                                <label for="modele" class="block text-sm font-medium text-gray-700 mb-1">Modèle</label>
                                <input type="text" wire:model="modele" id="modele"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                       placeholder="Ex: HP LaserJet Pro M404...">
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-4 border-t pt-6">
                        <button type="button" wire:click="closeModal"
                                class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition duration-200">
                            Annuler
                        </button>
                        <button type="submit"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg flex items-center transition duration-200">
                            <i class="fas fa-save mr-2"></i>
                            {{ $isEditing ? 'Mettre à jour' : 'Créer' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
