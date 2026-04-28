<?php

namespace App\Http\Livewire\Utilisateur\Sim;

use Livewire\Component;
use App\Models\SimCard;
use App\Models\SimHistory;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class MySims extends Component
{
    public function reportLoss($simId)
    {
        $sim = SimCard::where('id', $simId)
            ->where('current_user_id', Auth::id())
            ->firstOrFail();

        $sim->update(['status' => 'lost']);

        SimHistory::create([
            'sim_card_id' => $sim->id,
            'user_id' => Auth::id(),
            'action' => 'loss',
            'details' => ['reported_by' => Auth::user()->name]
        ]);

        $this->emit('toast', ['type' => 'warning', 'message' => 'Perte signalée. L\'administrateur a été informé.']);
    }

    public function downloadAttribution($simId)
    {
        $sim = SimCard::where('id', $simId)
            ->where('current_user_id', Auth::id())
            ->firstOrFail();

        // Récupérer les détails de la signature depuis l'historique
        $history = SimHistory::where('sim_card_id', $sim->id)
            ->where('action', 'attribution')
            ->orderBy('created_at', 'desc')
            ->first();

        $pdf = Pdf::loadView('pdf.sim-attribution', [
            'sim' => $sim,
            'user' => Auth::user(),
            'signedBy' => $history->details['signed_by'] ?? Auth::user()->name
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'attribution_sim_' . $sim->phone_number . '.pdf');
    }

    public function render()
    {
        $mySims = SimCard::where('current_user_id', Auth::id())->get();

        return view('livewire.utilisateur.sim.my-sims', [
            'mySims' => $mySims
        ]);
    }
}
