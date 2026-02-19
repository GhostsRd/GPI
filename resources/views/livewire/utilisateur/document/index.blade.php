@extends('layouts.app')

@section('title', 'Documentation')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold mb-4">Documentation</h1>
    
    <!-- Vous pouvez copier le contenu du composant Livewire ici -->
    @livewire('utilisateur.utilisateur-doc')
</div>
@endsection