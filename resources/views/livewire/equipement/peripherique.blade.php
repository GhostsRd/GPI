<div>
    <div class="container mx-auto p-6">
        <!-- En-tête -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Gestion des Périphériques</h1>
            <button wire:click="showForm" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Ajouter un Périphérique
            </button>
        </div>

        <!-- Messages de succès -->
        @if (session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulaire -->
        @if($showForm)
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
            <h2 class="text-xl font-semibold mb-4">
                {{ $editingId ? 'Modifier le Périphérique' : 'Nouveau Périphérique' }}
            </h2>
            
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nom -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nom">
                            Nom *
                        </label>
                        <input wire:model="nom" id="nom" type="text" 
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('nom') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Type -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                            Type *
                        </label>
                        <select wire:model="type" id="type" 
                                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Sélectionnez un type</option>
                            @foreach($types as $typeOption)
                                <option value="{{ $typeOption }}">{{ $typeOption }}</option>
                            @endforeach
                        </select>
                        @error('type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Statut -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="statut">
                            Statut *
                        </label>
                        <select wire:model="statut" id="statut" 
                                class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="">Sélectionnez un statut</option>
                            @foreach($statuts as $statutOption)
                                <option value="{{ $statutOption }}">{{ $statutOption }}</option>
                            @endforeach
                        </select>
                        @error('statut') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Fabricant -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="fabricant">
                            Fabricant
                        </label>
                        <input wire:model="fabricant" id="fabricant" type="text" 
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Modèle -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="modele">
                            Modèle
                        </label>
                        <input wire:model="modele" id="modele" type="text" 
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Entité -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="entite">
                            Entité
                        </label>
                        <input wire:model="entite" id="entite" type="text" 
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Lieu -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="lieu">
                            Lieu
                        </label>
                        <input wire:model="lieu" id="lieu" type="text" 
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Usager -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="usager">
                            Usager
                        </label>
                        <input wire:model="usager" id="usager" type="text" 
                               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                </div>

                <div class="flex items-center justify-end mt-6">
                    <button type="button" wire:click="$set('showForm', false)" 
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                        Annuler
                    </button>
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ $editingId ? 'Modifier' : 'Créer' }}
                    </button>
                </div>
            </form>
        </div>
        @endif

        <!-- Filtres -->
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Recherche -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Recherche</label>
                    <input wire:model.live="search" type="text" 
                           placeholder="Nom, modèle, fabricant..." 
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <!-- Filtre par statut -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Statut</label>
                    <select wire:model.live="filterStatut" 
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Tous les statuts</option>
                        @foreach($statuts as $statut)
                            <option value="{{ $statut }}">{{ $statut }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filtre par type -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                    <select wire:model.live="filterType" 
                            class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Tous les types</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <!-- Tableau -->
        <div class="bg-white shadow-md rounded overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Nom
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Fabricant/Modèle
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peripheriques as $peripherique)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap font-semibold">
                                        {{ $peripherique->nom }}
                                    </p>
                                    @if($peripherique->entite)
                                    <p class="text-gray-600 text-xs">{{ $peripherique->entite }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ $peripherique->type }}</p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <span class="relative inline-block px-3 py-1 font-semibold text-{{ $peripherique->statut === 'En service' ? 'green' : ($peripherique->statut === 'En stock' ? 'blue' : 'red') }}-900 leading-tight">
                                <span class="absolute inset-0 bg-{{ $peripherique->statut === 'En service' ? 'green' : ($peripherique->statut === 'En stock' ? 'blue' : 'red') }}-200 opacity-50 rounded-full"></span>
                                <span class="relative">{{ $peripherique->statut }}</span>
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $peripherique->fabricant }} 
                                @if($peripherique->modele)
                                / {{ $peripherique->modele }}
                                @endif
                            </p>
                            @if($peripherique->usager)
                            <p class="text-gray-600 text-xs">Usager: {{ $peripherique->usager }}</p>
                            @endif
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex space-x-2">
                                <button wire:click="edit({{ $peripherique->id }})" 
                                        class="text-blue-600 hover:text-blue-900">
                                    Modifier
                                </button>
                                <button wire:click="delete({{ $peripherique->id }})" 
                                        wire:confirm="Êtes-vous sûr de vouloir supprimer ce périphérique ?"
                                        class="text-red-600 hover:text-red-900">
                                    Supprimer
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                            Aucun périphérique trouvé.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $peripheriques->links() }}
        </div>
    </div>
</div>