<?php

namespace App\Http\Livewire\Equipement;

use Livewire\Component;
use App\Models\Ordinateur;
use App\Models\Imprimante;
use App\Models\Telephone;
use App\Models\Logiciel;
use App\Models\Peripherique;
use App\Models\Moniteur;
use App\Models\MaterielReseau;

class Equipement extends Component
{
    public $stats = [];
    public $chartData = [];
    public $loading = true;

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $this->stats = [
            [
                'title' => 'Ordinateurs',
                'count' => Ordinateur::count(),
                'color' => 'blue',
                'icon' => '💻',
                'route' => 'ordinateur'
            ],
            [
                'title' => 'Imprimantes',
                'count' => Imprimante::count(),
                'color' => 'green',
                'icon' => '🖨️',
                'route' => 'imprimante'
            ],
            [
                'title' => 'Téléphones',
                'count' => Telephone::count(),
                'color' => 'yellow',
                'icon' => '📱',
                'route' => 'telephone'
            ],
            [
                'title' => 'Logiciels',
                'count' => Logiciel::count(),
                'color' => 'purple',
                'icon' => '💾',
                'route' => 'logiciel'
            ],
            [
                'title' => 'Périphériques',
                'count' => Peripherique::count(),
                'color' => 'pink',
                'icon' => '⌨️',
                'route' => 'peripherique'
            ],
            [
                'title' => 'Moniteurs',
                'count' => Moniteur::count(),
                'color' => 'indigo',
                'icon' => '🖥️',
                'route' => 'moniteur'
            ],
            [
                'title' => 'Réseau',
                'count' => MaterielReseau::count(),
                'color' => 'red',
                'icon' => '🌐',
                'route' => 'materiel-reseau'
            ]
        ];

        $this->chartData = [
            'labels' => collect($this->stats)->pluck('title'),
            'data' => collect($this->stats)->pluck('count'),
            'colors' => [
                '#3B82F6', '#10B981', '#F59E0B', '#8B5CF6',
                '#EC4899', '#6366F1', '#EF4444'
            ]
        ];

        $this->loading = false;
    }

    // Méthode sécurisée pour éviter la division par zéro
    public function getPercentage($count)
    {
        return $this->totalEquipements > 0
            ? number_format(($count / $this->totalEquipements) * 100, 1)
            : 0;
    }

    // Méthode sécurisée pour la largeur de la barre de progression
    public function getProgressWidth($count)
    {
        return $this->totalEquipements > 0
            ? ($count / $this->totalEquipements) * 100
            : 0;
    }

    public function getTotalEquipementsProperty()
    {
        return collect($this->stats)->sum('count');
    }

    public function getCategoryWithMostItemsProperty()
    {
        $maxItem = collect($this->stats)->sortByDesc('count')->first();
        return $maxItem ?: ['count' => 0, 'title' => 'Aucun'];
    }
    public function getPourcentage($count)
    {
        return $this->totalEquipements > 0
            ? number_format(($count / $this->totalEquipements) * 100, 1)
            : 0;
    }
    public function getAveragePerCategoryProperty()
    {
        return $this->totalEquipements > 0
            ? number_format($this->totalEquipements / count($this->stats), 1)
            : 0;
    }

    public function render()
    {
        return view('livewire.equipement.equipement');
    }
}
