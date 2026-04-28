<?php

namespace App\Http\Livewire\Admin\Sim;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SimCard;
use App\Models\User;
use App\Models\SimAssignment;
use App\Models\SimHistory;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SimCardsExport;
use App\Imports\SimCardsImport;
use Livewire\WithFileUploads;
use Barryvdh\DomPDF\Facade\Pdf;

class SimList extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $statusFilter = '';
    public $operatorFilter = '';
    
    // ... rest of properties ...

    public function exportExcel()
    {
        try {
            if (ob_get_level()) ob_end_clean();
            
            return Excel::download(
                new SimCardsExport, 
                'flotte_sim_' . now()->format('Y-m-d') . '.xlsx',
                \Maatwebsite\Excel\Excel::XLSX
            );
        } catch (\Exception $e) {
            $this->emit('toast', ['type' => 'error', 'message' => 'Erreur lors de l\'export : ' . $e->getMessage()]);
        }
    }

    public $importFile;
    public $showImportModal = false;
    public $showMappingModal = false;

    public function importSims()
    {
        $this->validate([
            'importFile' => 'required|file|max:10240',
        ]);

        try {
            $import = new SimCardsImport;
            
            $extension = strtolower($this->importFile->getClientOriginalExtension());
            
            if (in_array($extension, ['xlsx', 'xls'])) {
                $type = \Maatwebsite\Excel\Excel::XLSX;
            } elseif ($extension === 'csv') {
                $type = \Maatwebsite\Excel\Excel::CSV;
            } else {
                $type = \Maatwebsite\Excel\Excel::XLSX;
            }

            Excel::import($import, $this->importFile->getRealPath(), null, $type);
            
            $this->showImportModal = false;
            $this->importFile = null;

            $msg = $import->importedCount . ' carte(s) SIM importée(s)';
            if ($import->skippedCount > 0) {
                $msg .= ', ' . $import->skippedCount . ' ligne(s) ignorée(s)';
            }
            if (!empty($import->errors)) {
                $msg .= '. Erreurs: ' . implode('; ', array_slice($import->errors, 0, 3));
            }

            $this->emit('toast', ['type' => 'success', 'message' => $msg]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Import SIM error: ' . $e->getMessage() . "\n" . $e->getTraceAsString());
            $this->emit('toast', ['type' => 'error', 'message' => 'Erreur : ' . $e->getMessage()]);
        }
    }
    
    // Form variables
    public $editingSimId = null;
    public $phone_number, $iccid, $operator, $activation_date, $remarks;
    public $device_model, $imei, $location, $department;
    
    // Assignment variables
    public $assigningSimId = null;
    public $selectedUserId = null;
    public $signatureConfirmation = false;
    public $assigneeName = '';

    public $showFormModal = false;
    public $showAssignModal = false;

    protected $rules = [
        'phone_number' => 'required|string|unique:sim_cards,phone_number',
        'iccid' => 'required|string|unique:sim_cards,iccid',
        'operator' => 'required|string',
        'activation_date' => 'nullable|date',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showFormModal = true;
    }

    public function openEditModal($id)
    {
        $sim = SimCard::findOrFail($id);
        $this->editingSimId = $id;
        $this->phone_number = $sim->phone_number;
        $this->iccid = $sim->iccid;
        $this->operator = $sim->operator;
        $this->activation_date = $sim->activation_date ? $sim->activation_date->format('Y-m-d') : null;
        $this->remarks = $sim->remarks;
        $this->device_model = $sim->device_model;
        $this->imei = $sim->imei;
        $this->location = $sim->location;
        $this->department = $sim->department;
        
        $this->showFormModal = true;
    }

    public function resetForm()
    {
        $this->editingSimId = null;
        $this->phone_number = '';
        $this->iccid = '';
        $this->operator = '';
        $this->activation_date = null;
        $this->remarks = '';
        $this->device_model = '';
        $this->imei = '';
        $this->location = '';
        $this->department = '';
    }

    public function saveSim()
    {
        $rules = $this->rules;
        if ($this->editingSimId) {
            $rules['phone_number'] .= ',' . $this->editingSimId;
            $rules['iccid'] .= ',' . $this->editingSimId;
        }

        $this->validate($rules);

        $data = [
            'phone_number' => $this->phone_number,
            'iccid' => $this->iccid,
            'operator' => $this->operator,
            'activation_date' => $this->activation_date,
            'remarks' => $this->remarks,
            'device_model' => $this->device_model,
            'imei' => $this->imei,
            'location' => $this->location,
            'department' => $this->department,
        ];

        if ($this->editingSimId) {
            $sim = SimCard::find($this->editingSimId);
            $sim->update($data);
            $action = 'modification';
        } else {
            $sim = SimCard::create($data);
            $action = 'creation';
        }

        SimHistory::create([
            'sim_card_id' => $sim->id,
            'user_id' => Auth::id(),
            'action' => $action,
            'details' => ['message' => 'Mise à jour des informations de la carte SIM']
        ]);

        $this->showFormModal = false;
        $this->emit('toast', ['type' => 'success', 'message' => 'Carte SIM enregistrée avec succès']);
    }

    public function openAssignModal($id)
    {
        $this->assigningSimId = $id;
        $this->selectedUserId = null;
        $this->showAssignModal = true;
    }

    public function assignSim()
    {
        $this->validate([
            'selectedUserId' => 'required|exists:users,id',
            'assigneeName' => 'required|string|min:3',
            'signatureConfirmation' => 'accepted'
        ]);

        $sim = SimCard::findOrFail($this->assigningSimId);
        $user = User::find($this->selectedUserId);

        // Clôturer l'éventuelle attribution précédente
        SimAssignment::where('sim_card_id', $sim->id)->where('status', 'active')->update([
            'returned_at' => now(),
            'status' => 'returned'
        ]);

        // Créer l'attribution
        SimAssignment::create([
            'sim_card_id' => $sim->id,
            'user_id' => $this->selectedUserId,
            'assigned_at' => now(),
            'status' => 'active'
        ]);

        // Mettre à jour la carte SIM
        $sim->update([
            'status' => 'assigned',
            'current_user_id' => $this->selectedUserId,
            'department' => $user->poste ?? $sim->department
        ]);

        // Historique
        SimHistory::create([
            'sim_card_id' => $sim->id,
            'user_id' => Auth::id(),
            'action' => 'attribution',
            'details' => [
                'user_name' => $user->name, 
                'user_id' => $user->id,
                'signed_by' => $this->assigneeName,
                'signature_date' => now()->toDateTimeString()
            ]
        ]);

        $this->showAssignModal = false;
        $this->reset(['assigneeName', 'signatureConfirmation']);
        $this->emit('toast', ['type' => 'success', 'message' => 'Carte SIM attribuée à ' . $user->name]);
    }

    public function downloadAttribution($simId)
    {
        $sim = SimCard::with('currentUser')->findOrFail($simId);
        if (!$sim->currentUser) return;

        // Récupérer les détails de la signature depuis l'historique
        $history = SimHistory::where('sim_card_id', $sim->id)
            ->where('action', 'attribution')
            ->orderBy('created_at', 'desc')
            ->first();

        $pdf = Pdf::loadView('pdf.sim-attribution', [
            'sim' => $sim,
            'user' => $sim->currentUser,
            'signedBy' => $history->details['signed_by'] ?? $sim->currentUser->name
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'attribution_sim_' . $sim->phone_number . '.pdf');
    }

    public function recoverSim($id)
    {
        $sim = SimCard::findOrFail($id);
        
        // Clôturer l'attribution
        SimAssignment::where('sim_card_id', $sim->id)->where('status', 'active')->update([
            'returned_at' => now(),
            'status' => 'returned'
        ]);

        $prevUserId = $sim->current_user_id;

        // Mettre à jour la carte SIM
        $sim->update([
            'status' => 'available',
            'current_user_id' => null
        ]);

        // Historique
        SimHistory::create([
            'sim_card_id' => $sim->id,
            'user_id' => Auth::id(),
            'action' => 'recovery',
            'details' => ['previous_user_id' => $prevUserId]
        ]);

        $this->emit('toast', ['type' => 'success', 'message' => 'Carte SIM récupérée']);
    }

    public function render()
    {
        $query = SimCard::with('currentUser')
            ->when($this->search, function($q) {
                $q->where('phone_number', 'like', '%' . $this->search . '%')
                  ->orWhere('iccid', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter, function($q) {
                $q->where('status', $this->statusFilter);
            })
            ->when($this->operatorFilter, function($q) {
                $q->where('operator', $this->operatorFilter);
            });

        return view('livewire.admin.sim.sim-list', [
            'sims' => $query->paginate(10),
            'users' => User::active()->orderBy('name')->get()
        ]);
    }
}
