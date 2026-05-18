<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\utilisateur;

class Configuration extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleStatus($userId)
    {
        $user = utilisateur::find($userId);
        if ($user) {
            $user->is_active = !$user->is_active;
            $user->save();

            session()->flash('success', 'Le statut de l\'utilisateur a été mis à jour avec succès.');
        }
    }

    public function render()
    {
        $utilisateurs = utilisateur::where('role', 'user')
            ->where(function($query) {
                $query->where('nom', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.configuration', [
            'utilisateurs' => $utilisateurs
        ])->extends('layouts.app')->section('content');
    }
}
