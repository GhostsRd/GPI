<?php

namespace App\Http\Livewire\Admin\Checkout;

use Livewire\Component;
use App\Models\Checkout as CheckoutModel;
use App\Models\Utilisateur;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Checkout extends Component
{   
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $statutFilter = '';
    public $typeMateriel = '';
    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $selectedTickets = [];
    public $selectAll = false;
    

    public function render()
    {
        $checkouts = CheckoutModel::with(['utilisateur', 'materiel'])
            ->when($this->statutFilter, function($query, $statut) {
                return $query->where('statut', $statut);
            })
            ->when($this->typeMateriel, function($query, $type) {
                return $query->where('materiel_type', $type);
            })
            ->when($this->search, function($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('id', 'like', "%{$search}%")
                      ->orWhere('materiel_details', 'like', "%{$search}%")
                      ->orWhere('raison', 'like', "%{$search}%")
                      ->orWhereHas('utilisateur', function($q) use ($search) {
                          $q->where('nom', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                      })
                      ->orWhereHas('materiel', function($q) use ($search) {
                          $q->where('nom', 'like', "%{$search}%")
                            ->orWhere('marque', 'like', "%{$search}%")
                            ->orWhere('modele', 'like', "%{$search}%");
                      });
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.admin.checkout.checkout', [
            'checkouts' => $checkouts
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        
        $this->sortField = $field;
    }

    public function resetFilters()
    {
        $this->reset(['statutFilter', 'typeMateriel', 'search', 'sortField', 'sortDirection', 'selectedTickets', 'selectAll']);
        $this->resetPage();
    }

    public function deleteSelected()
    {
        if (!empty($this->selectedTickets)) {
            CheckoutModel::whereIn('id', $this->selectedTickets)->delete();
            $this->selectedTickets = [];
            $this->selectAll = false;
            session()->flash('success', 'Checkouts sélectionnés supprimés avec succès.');
        }
    }

    public function exportCheckouts()
    {
        $checkouts = CheckoutModel::with(['utilisateur', 'materiel'])
            ->when($this->statutFilter, function($query, $statut) {
                return $query->where('statut', $statut);
            })
            ->when($this->typeMateriel, function($query, $type) {
                return $query->where('materiel_type', $type);
            })
            ->when($this->search, function($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('id', 'like', "%{$search}%")
                      ->orWhere('materiel_details', 'like', "%{$search}%")
                      ->orWhereHas('utilisateur', function($q) use ($search) {
                          $q->where('nom', 'like', "%{$search}%");
                      });
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        $fileName = 'checkouts_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        return new StreamedResponse(function () use ($checkouts) {
            $handle = fopen('php://output', 'w');
            
            // En-têtes CSV
            fputcsv($handle, [
                'ID', 'Utilisateur', 'Email', 'Type Matériel', 
                'Détails Matériel', 'Statut', 'Raison', 
                'Date Début', 'Date Fin', 'Date Création'
            ]);

            // Données
            foreach ($checkouts as $checkout) {
                $statut = match($checkout->statut) {
                    'en_cours' => 'En cours',
                    'termine' => 'Terminé',
                    'annule' => 'Annulé',
                    'en_retard' => 'En retard',
                    default => $checkout->statut
                };

                fputcsv($handle, [
                    $checkout->id,
                    $checkout->utilisateur->nom ?? 'N/A',
                    $checkout->utilisateur->email ?? 'N/A',
                    $checkout->materiel_type,
                    $checkout->materiel_details,
                    $statut,
                    $checkout->raison,
                    $checkout->date_debut?->format('Y-m-d') ?? 'N/A',
                    $checkout->date_fin?->format('Y-m-d') ?? 'N/A',
                    $checkout->created_at->format('Y-m-d H:i:s')
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }

    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'title' => 'Êtes-vous sûr?',
            'text' => 'Vous ne pourrez pas revenir en arrière!',
            'id' => $id
        ]);
    }

    public function deleteCheckout($id)
    {
        $checkout = CheckoutModel::find($id);
        if ($checkout) {
            // Supprimer les fichiers associés si nécessaire
            if ($checkout->document_attachment) {
                Storage::delete($checkout->document_attachment);
            }
            
            $checkout->delete();
            session()->flash('success', 'Checkout supprimé avec succès.');
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedTickets = CheckoutModel::when($this->statutFilter, function($query, $statut) {
                    return $query->where('statut', $statut);
                })
                ->when($this->typeMateriel, function($query, $type) {
                    return $query->where('materiel_type', $type);
                })
                ->when($this->search, function($query, $search) {
                    return $query->where(function($q) use ($search) {
                        $q->where('id', 'like', "%{$search}%")
                          ->orWhere('materiel_details', 'like', "%{$search}%")
                          ->orWhereHas('utilisateur', function($q) use ($search) {
                              $q->where('nom', 'like', "%{$search}%");
                          });
                    });
                })
                ->pluck('id')
                ->toArray();
        } else {
            $this->selectedTickets = [];
        }
    }

    public function Visualiser($id)
    {
        return redirect("/admin/checkout-view-".$id);
    }

    // Méthode pour changer le statut d'un checkout
    public function changerStatut($id, $nouveauStatut)
    {
        $checkout = CheckoutModel::find($id);
        if ($checkout) {
            $checkout->update(['statut' => $nouveauStatut]);
            session()->flash('success', 'Statut mis à jour avec succès.');
        }
    }

    // Propriété calculée pour les statistiques
    public function getStatsProperty()
    {
        $query = CheckoutModel::query();
        
        return [
            'total' => $query->count(),
            'en_cours' => (clone $query)->where('statut', 'en_cours')->count(),
            'termine' => (clone $query)->where('statut', 'termine')->count(),
            'annule' => (clone $query)->where('statut', 'annule')->count(),
            'en_retard' => (clone $query)->where('statut', 'en_retard')->count(),
        ];
    }

    // Propriété calculée pour les types de matériel disponibles
    public function getTypesMaterielProperty()
    {
        return CheckoutModel::distinct()
            ->whereNotNull('materiel_type')
            ->where('materiel_type', '!=', '')
            ->pluck('materiel_type')
            ->toArray();
    }

    // Propriété calculée pour les statuts disponibles
    public function getStatutsProperty()
    {
        return CheckoutModel::distinct()
            ->whereNotNull('statut')
            ->where('statut', '!=', '')
            ->pluck('statut')
            ->toArray();
    }
}