<?php

namespace App\Http\Livewire\Admin\Checkout;

use Livewire\Component;
use App\Models\Checkout as CheckoutModel;
use App\Models\Utilisateur;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Models\liaison_equipement;
use Illuminate\Support\Facades\Auth;


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

    // Propriétés pour le modal Nouveau Checkout
    public $showModal = false;
    public $newUtilisateurId = '';
    public $newMaterielType = '';
    public $newMaterielDetails = '';
    public $newDateRendu = '';
    

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
            'checkouts' => $checkouts,
            'utilisateursList' => Utilisateur::orderBy('nom')->get(),
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

    public function exportExcel()
    {
        try {
            $checkouts = $this->getExportData();
            $fileName = 'export_checkouts_' . now()->format('Ymd_His') . '.xlsx';
            
            if (ob_get_level()) ob_end_clean();
            
            return \Maatwebsite\Excel\Facades\Excel::download(
                new \App\Exports\CheckoutsExport($checkouts), 
                $fileName,
                \Maatwebsite\Excel\Excel::XLSX
            );
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:error', ['message' => 'Erreur lors de l\'export Excel : ' . $e->getMessage()]);
        }
    }

    public function exportCSV()
    {
        try {
            $checkouts = $this->getExportData();
            $fileName = 'export_checkouts_' . now()->format('Ymd_His') . '.csv';
            
            if (ob_get_level()) ob_end_clean();
            
            return \Maatwebsite\Excel\Facades\Excel::download(
                new \App\Exports\CheckoutsCsvExport($checkouts), 
                $fileName,
                \Maatwebsite\Excel\Excel::CSV
            );
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:error', ['message' => 'Erreur lors de l\'export CSV : ' . $e->getMessage()]);
        }
    }

    public function exportPDF()
    {
        try {
            $checkouts = $this->getExportData();
            
            if (ob_get_level()) ob_end_clean();

            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('exports.checkouts', [
                'checkouts' => $checkouts,
                'is_pdf' => true
            ])->setPaper('a4', 'landscape');

            return response()->streamDownload(function() use ($pdf) {
                echo $pdf->output();
            }, 'export_checkouts_' . now()->format('Ymd_His') . '.pdf');
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:error', ['message' => 'Erreur lors de l\'export PDF : ' . $e->getMessage()]);
        }
    }

    protected function getExportData()
    {
        return CheckoutModel::with(['utilisateur', 'materiel'])
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

    public function nouveauCheckout()
    {
        $this->resetModalFields();
        $this->showModal = true;
    }

    public function fermerModal()
    {
        $this->showModal = false;
        $this->resetModalFields();
    }

    public function resetModalFields()
    {
        $this->newUtilisateurId = '';
        $this->newMaterielType = '';
        $this->newMaterielDetails = '';
        $this->newDateRendu = '';
        $this->resetValidation();
    }

    public function saveCheckout()
    {
        $this->validate([
            'newUtilisateurId' => 'required|exists:utilisateurs,id',
            'newMaterielType' => 'required|string',
            'newMaterielDetails' => 'nullable|string|max:255',
            'newDateRendu' => 'nullable|date',
        ], [
            'newUtilisateurId.required' => 'Veuillez sélectionner un utilisateur.',
            'newMaterielType.required' => 'Veuillez sélectionner un type de matériel.',
        ]);

        try {
            CheckoutModel::create([
                'utilisateur_id' => $this->newUtilisateurId,
                'responsable_id' => Auth::id(),
                'statut' => 1,
                'materiel_type' => $this->newMaterielType,
                'materiel_details' => $this->newMaterielDetails,
                'date_rendu' => $this->newDateRendu ?: null,
            ]);

            $this->showModal = false;
            $this->resetModalFields();
            $this->dispatchBrowserEvent('swal:success', ['message' => 'Checkout créé avec succès.']);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:error', ['message' => 'Erreur lors de la création : ' . $e->getMessage()]);
        }
    }

    /**
     * Insère les informations du checkout dans le compte utilisateur (liaison_equipements)
     */
    public function insererVersCompteUtilisateur($checkoutId)
    {
        $checkout = CheckoutModel::find($checkoutId);
        
        if (!$checkout) {
            $this->dispatchBrowserEvent('swal:error', ['message' => 'Checkout non trouvé.']);
            return;
        }

        if (!$checkout->utilisateur_id) {
            $this->dispatchBrowserEvent('swal:error', ['message' => 'Aucun utilisateur associé à ce checkout.']);
            return;
        }

        // Vérifier si une liaison existe déjà pour cet équipement et cet utilisateur
        $exists = liaison_equipement::where('utilisateur_id', $checkout->utilisateur_id)
            ->where(function($query) use ($checkout) {
                if ($checkout->materiel_type === 'ordinateur') {
                    $query->where('ordinateur_id', $checkout->equipement_id);
                } elseif ($checkout->materiel_type === 'telephone') {
                    $query->where('telephone_id', $checkout->equipement_id);
                } elseif ($checkout->materiel_type === 'peripherique') {
                    $query->where('peripherique_id', $checkout->equipement_id);
                }
            })->exists();

        if ($exists) {
            $this->dispatchBrowserEvent('swal:info', ['message' => 'Cet équipement est déjà lié au compte de cet utilisateur.']);
            return;
        }

        try {
            $liaison = new liaison_equipement();
            $liaison->utilisateur_id = $checkout->utilisateur_id;
            $liaison->type = $checkout->materiel_type;
            $liaison->date_attribution = now();
            $liaison->statut = 'actif';
            
            // Mapper l'ID d'équipement selon le type
            if ($checkout->materiel_type === 'ordinateur') {
                $liaison->ordinateur_id = $checkout->equipement_id;
            } elseif ($checkout->materiel_type === 'telephone') {
                $liaison->telephone_id = $checkout->equipement_id;
            } elseif ($checkout->materiel_type === 'peripherique') {
                $liaison->peripherique_id = $checkout->equipement_id;
            }

            $liaison->save();

            $this->dispatchBrowserEvent('swal:success', ['message' => 'Informations insérées dans le compte utilisateur avec succès.']);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('swal:error', ['message' => 'Erreur lors de l\'insertion : ' . $e->getMessage()]);
        }
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