@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Ajouter un équipement IT</h1>

        @if(session('success'))
            <div class="bg-green-100 p-3 mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('equipements.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block font-medium">Type d'équipement</label>
                <select name="type_equipement" id="type_equipement" class="border p-2 w-full">
                    <option value="">-- Sélectionner --</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block font-medium">Nom</label>
                <input type="text" name="nom" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Entité</label>
                <input type="text" name="entite" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Statut</label>
                <input type="text" name="statut" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Fabricant</label>
                <input type="text" name="fabricant" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Modèle</label>
                <input type="text" name="modele" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Numéro de série</label>
                <input type="text" name="numero_serie" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Utilisateur / Usager</label>
                <input type="text" name="usager" class="border p-2 w-full">
            </div>

            <div class="mb-4">
                <label class="block font-medium">Lieu</label>
                <input type="text" name="lieu" class="border p-2 w-full">
            </div>

            <!-- Champs spécifiques selon le type (exemple pour ordinateur) -->
            <div id="ordinateur_fields" style="display:none;">
                <div class="mb-4">
                    <label class="block font-medium">Utilisateur</label>
                    <input type="text" name="utilisateur" class="border p-2 w-full">
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Adresse IP</label>
                    <input type="text" name="reseau_ip" class="border p-2 w-full">
                </div>
                <div class="mb-4">
                    <label class="block font-medium">OS Version</label>
                    <input type="text" name="systeme_exploitation_version" class="border p-2 w-full">
                </div>
                <div class="mb-4">
                    <label class="block font-medium">Taille disque</label>
                    <input type="text" name="composants_taille_disque" class="border p-2 w-full">
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter</button>
        </form>
    </div>

    <script>
        const typeSelect = document.getElementById('type_equipement');
        const ordinateurFields = document.getElementById('ordinateur_fields');

        typeSelect.addEventListener('change', function() {
            if(this.value === 'Ordinateur'){
                ordinateurFields.style.display = 'block';
            } else {
                ordinateurFields.style.display = 'none';
            }
        });
    </script>
@endsection
